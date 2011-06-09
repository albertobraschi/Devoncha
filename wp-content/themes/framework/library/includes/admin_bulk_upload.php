<?php
global $wpdb;
global $upload_folder_path;
if($_POST)
{
	if($_FILES['bulk_upload_csv']['name']!='' && $_FILES['bulk_upload_csv']['error']=='0')
	{
		$filename = $_FILES['bulk_upload_csv']['name'];
		$filenamearr = explode('.',$filename);
		$extensionarr = array('csv','CSV');
		if(in_array($filenamearr[count($filenamearr)-1],$extensionarr))
		{
			$destination_path = ABSPATH . $upload_folder_path."csv/";
			if (!file_exists($destination_path))
			{
				mkdir($destination_path, 0777);				
			}
			$target_path = $destination_path . $filename;
			$csv_target_path = $target_path;
			if(@move_uploaded_file($_FILES['bulk_upload_csv']['tmp_name'], $target_path)) 
			{
				$fd = fopen ($target_path, "rt");

////////////////////////////post image directory start//////////
				global $General;
				$imagecustomkeyarray = array('productimage','productimage1','productimage2','productimage3','productimage4','productimage5','productimage6','digital_product'); // custom images and digital product html key names
				$imagepath = $General->get_product_imagepath();
				if($imagepath == ''){$imagepath = 'products_img';}
				$destination_path = ABSPATH . "$upload_folder_path".$imagepath."/";
				if (!file_exists($destination_path))
				{
					$imagepatharr = explode('/',$imagepath);
					$upload_path = ABSPATH . "$upload_folder_path";
					if (!file_exists($upload_path))
					{
						@mkdir($upload_path, 0777);
					}
					for($i=0;$i<count($imagepatharr);$i++)
					{
					  if($imagepatharr[$i])
					  {
						   $year_path = ABSPATH . "$upload_folder_path".$imagepatharr[$i]."/";
						  if (!file_exists($year_path)){
							  @mkdir($year_path, 0777);
						  }     
						  //@mkdir($destination_path, 0777);
						}
					}
				}
				$target_path = $destination_path . $name;
				$image_user_path = site_url("/$upload_folder_path".$imagepath."/");
////////////////////////////post image directory end//////////

///////////post digital product start////////////
				$digital_product_path = $General->get_digital_productpath();
				if($digital_product_path == '')
				{
					$digital_product_path = 'digital_products';
				}
				$digital_destination_path = ABSPATH . "$upload_folder_path".$digital_product_path."/";
				
				$imagepatharr = array();
				if (!file_exists($digital_destination_path)){
				  $imagepatharr = explode('/',$digital_product_path);
				  $upload_path = ABSPATH . "$upload_folder_path";
				  if (!file_exists($upload_path)){
					mkdir($upload_path, 0777);
				  }
				  for($i=0;$i<count($imagepatharr);$i++)
				  {
					  if($imagepatharr[$i])
					  {
						  $year_path = ABSPATH . "$upload_folder_path".$imagepatharr[$i]."/";
						  if (!file_exists($year_path)){
							  mkdir($year_path, 0777);
						  }     
						  mkdir($digital_product_path, 0777);
						}
				  }
			   }
				$digital_target_path = $digital_destination_path . $name;
				$digital_user_path = site_url("/$upload_folder_path".$digital_product_path."/".$name);
/////////////////post digital product end////////

				$rowcount = 0;
				$customKeyarray = array();
				$notinsertd = array();
				$rowcount_inserted = 0;
				while (!feof ($fd))
				{
					$buffer = fgetcsv($fd, 4096);
					if($rowcount == 0)
					{
						for($k=3;$k<count($buffer);$k++)
						{
							$customKeyarray[$k] = $buffer[$k];
						}
					}else
					{
						$post_title = $buffer[0];
						$post_desc = $buffer[1];
						$post_cat = $buffer[2]; // comma seperated
						if($post_cat)
						{
							$post_cat_arr = explode(',',$post_cat);
						}else
						{
							$post_cat_arr = array('Uncategorized');
						}
						
						if($post_title!='')
						{
							$image_array = array();
							$post_meta = array();
							$post_info = array();
							$customArr = array();
							for($c=3;$c<count($buffer);$c++)
							{
								if($customKeyarray[$c]=='productimage')
								{
									$image_array[]=date('Y').'/'.date('m').'/'.$buffer[$c];
								}
								elseif(in_array($customKeyarray[$c],$imagecustomkeyarray))
								{
									if(trim($buffer[$c])!='')
									{
										if(trim($buffer[$c]) == 'digital_product')
										{
											$customArr[$customKeyarray[$c]] = $digital_user_path.$buffer[$c];
										}else
										{
											$customArr[$customKeyarray[$c]] = $image_user_path.$buffer[$c];
										}	
									}
								}else
								{
									$customArr[$customKeyarray[$c]] = $buffer[$c];
								}								
							}
							$customArr['posttype'] = 'product';
							
							$post_meta = array('key'=>$customArr,);
							$post_info[0] = array(
												"post_title"	=>	$post_title,
												"post_content"	=>	$post_desc,
												"post_meta"		=>	$post_meta,
												"post_image"	=>	$image_array,
												"post_category"	=>	$post_cat_arr,
												"post_tags"		=>	array('')
												);
							$inserted_data = insert_posts_bulk($post_info);
							if($inserted_data=='')
							{
								$rowcount_inserted++;
							}else
							{
								$notinsertd[] = $inserted_data;
							}
							
						}
						
					}
					$rowcount++;		
				}
				
				if($_POST){
					if($rowcount_inserted>0)
					{
						$image_folder = date('Y').'/'.date('m').'/';
						$message = "<br><br>csv uploaded successfully";
						$message .= "<br><br>Total of $rowcount_inserted records inserted</b><br>";
						$message .= "<br><br>Please upload images to '<b>wp-contents/uploads/$image_folder</b>' folder<br><br>";					
						
					}
					if($notinsertd)
					{
						$notinsertd_str = implode(', ',$notinsertd);
						$message .= "<br><br>Following Products are already exist so cannot dublicate:<br>$notinsertd_str</b><br><br>";
					}
					
				}
				@unlink($csv_target_path);
			}
			else
			{
				$msg = "muerror";
			}
		}else
		{
			$msg = "ferror";
			wp_redirect(site_url('/wp-admin/admin.php?page=bulkupload&emsg=csvonly'));exit;
		}
	}else
	{
		$msg = "ferror";
		wp_redirect(site_url('/wp-admin/admin.php?page=bulkupload&emsg=nofile'));exit;
	}
}

function insert_posts_bulk($post_info)
{
	global $wpdb,$current_user;
	for($i=0;$i<count($post_info);$i++)
	{
		$post_count = $wpdb->get_var("SELECT count(ID) FROM $wpdb->posts where post_title like \"$post_title\" and post_type='post' and post_status in ('publish','draft')");
		if(!$post_count)
		{
			$post_info_arr = array();
			$catids_arr = array();
			$my_post = array();
			$post_info_arr = $post_info[$i];
			if($post_info_arr['post_category'])
			{
				for($c=0;$c<count($post_info_arr['post_category']);$c++)
				{
					$catids_arr[] = get_cat_ID($post_info_arr['post_category'][$c]);
				}
			}
			if($catids_arr)
			{				
			}else
			{
				$catids_arr[] = 1;	
			}
			$my_post['post_title'] = $post_info_arr['post_title'];
			$my_post['post_content'] = $post_info_arr['post_content'];
			if($post_info_arr['post_author'])
			{
				$my_post['post_author'] = $post_info_arr['post_author'];
			}else
			{
				$my_post['post_author'] = 1;
			}
			$my_post['post_status'] = 'publish';
			$my_post['post_category'] = $catids_arr;
			$my_post['tags_input'] = $post_info_arr['post_tags'];
			$last_postid = wp_insert_post( $my_post );
			$post_meta = $post_info_arr['post_meta'];
			if($post_meta)
			{
				foreach($post_meta as $mkey=>$mval)
				{
					update_post_meta($last_postid, $mkey, $mval);
				}
			}
			
			$post_image = $post_info_arr['post_image'];
			if($post_image)
			{
				for($m=0;$m<count($post_image);$m++)
				{
					$menu_order = $m+1;
					$image_name_arr = explode('/',$post_image[$m]);
					$img_name = $image_name_arr[count($image_name_arr)-1];
					$img_name_arr = explode('.',$img_name);
					$post_img = array();
					$post_img['post_title'] = $img_name_arr[0];
					$post_img['post_status'] = 'attachment';
					$post_img['post_parent'] = $last_postid;
					$post_img['post_type'] = 'attachment';
					$post_img['post_mime_type'] = 'image/jpeg';
					$post_img['menu_order'] = $menu_order;
					$last_postimage_id = wp_insert_post( $post_img );
					update_post_meta($last_postimage_id, '_wp_attached_file', $post_image[$m]);					
					$post_attach_arr = array(
										"width"	=>	580,
										"height" =>	480,
										"hwstring_small"=> "height='150' width='150'",
										"file"	=> $post_image[$m],
										//"sizes"=> $sizes_info_array,
										);
					wp_update_attachment_metadata( $last_postimage_id, $post_attach_arr );
				}
			}
			return '';
		}else
		{
			return $post_title;
		}
	}
}
?>

<div id="wrapper">
 
  <?php require_once (TEMPLATEPATH . '/admin/admin_header.php');?>
 <div class="titlebg">
    <span class="head i_bulk"><?php _e('Bulk Upload'); ?></span>  
 </div> <!-- sub heading -->
 <div id="page" >
 <?php if($message){?>
 <div style="background-color: rgb(255, 251, 204);" id="message" class=""><?php echo $message;?></div>
 <?php }?>
  <div id="page" >

<?php if($_REQUEST['emsg']=='csvonly'){?>
<div id="emessage" class=""><?php _e('Invalid File type. Please upload  CSV(comma delimited) only.');?></div>
<?php }else if($_REQUEST['emsg']=='nofile'){?>
<div id="emessage" class=""><?php _e('Please upload CSV(comma delimited) file only.');?></div>
<?php }?>
 
<form action="<?php echo site_url('/wp-admin/admin.php?page=bulkupload')?>" method="post" name="bukl_upload_frm" enctype="multipart/form-data">

  <?php if($_REQUEST['msg']=='exist'){?>
  <div class="updated fade below-h2" id="message" style="background-color: rgb(255, 251, 204);" >
    <p><?php _e('Uploaded successully.'); ?></p>
  </div>
  <?php }?>
  <table width="75%" cellpadding="3" cellspacing="3" class="widefat post sub_table" >
    <tr>
      <td width="25%"><?php _e('Select CSV file'); ?> :</td>
      <td><input type="file" name="bulk_upload_csv" id="bulk_upload_csv"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    <td><input type="submit" name="submit" value="<?php _e('Submit'); ?>" onClick="return check_frm();" class="b_common action" > 
   	 </td>   
    </tr>
 	 <tr>
    	<td colspan="2"> <?php _e('<b><u>Note</u> :- </b>Only CSV(comma delimited) file is allowed. Everytime you upload a CSV, the records will be inserted, not updated.'); ?> </td>
         
    </tr>   
    <tr>
    	<td>&nbsp; </td>
    	<td> <?php _e('You may like to download'); ?> <a href="<?php echo site_url('/?ptype=csvdl')?>"><?php _e('sample CSV file'); ?></a> </td>
    </tr>
    <tr>
    	<td colspan="2"><h3 style="font-size:16px; font-weight:bold; margin-top:20px;"><a href="javascript:void(0);show_hide()"><?php _e('CSV file field description Guide'); ?></a></h3></td>
    </tr>
    <tr><td colspan="2">
    <table width="100%" id="guide_csv_upload" style="display:none;">
    <tr>
    	<td><b>Post Title</b></td>
        <td><?php _e('This is "Product Title". It\'s a mandatory field and it should not be left as blank. It must be in first column only.');?></td>
    </tr>
    <tr>
    	<td><b>Post Content</b></td>
        <td><?php _e('This is the product description. This should be in second column and can also be left as blank.');?></td>
    </tr>
     <tr>
    	<td><b>Post Category</b></td>
        <td><?php _e(' This is products category. It should always be in third column and if its left as blank, then all products will be inserted in "Uncategorised" category.
Note: Column Position of above three fields should not be changed. And for below product fields, you can change the column position, but don\'t change its column\'s name.
');?></td>
    </tr>
    <tr>
    	<td><b>digital_product</b></td>
        <td><?php _e('If you want to insert a digital product, then you\'ll need to first setup its path from wp-admin > Shopping cart > General settings > Product Settings > Digital Product Path. In this column, just enter the filename of the product. E.g. moneytransfer.zip');?></td>
    </tr>
     <tr>
    	<td><b>price</b></td>
        <td><?php _e('The price of this product');?></td>
    </tr>
    <tr>
    	<td><b>spPrdLstDate</b></td>
        <td><?php _e('This is the last date of special products price ');?></td>
    </tr>
     <tr>
    	<td><b>specialprice</b></td>
        <td><?php _e('This is products special price');?></td>
    </tr>
     <tr>
    	<td><b>model</b></td>
        <td><?php _e('Products model number');?></td>
    </tr>
    <tr>
    	<td><b>size_chart</b></td>
        <td><?php _e('This is products size chart. It can be image URL or basic HTML code.');?></td>
    </tr>
    <tr>
    	<td><b>is_free_shipping </b></td>
        <td><?php _e('If you have physical product and want to set shipping as free, then set it to "1" else write "0".');?></td>
    </tr>
    <tr>
    	<td><b>weight </b></td>
        <td><?php _e('This is products weight. Just enter the weight amount. You can set weight unit from wp-admin > Shopping cart > General settings > Shopping cart > Default Weight Unit. E.g. if products weight is 10 lbs, then just enter 10');?></td>
    </tr>
    <tr>
				
    	<td><b>Istaxable</b></td>		
<td><?php _e(' If you want to apply tax for this product, then write "1", else write "0".');?></td>
    </tr>
      <tr>
    	<td><b>sizetitle, colortitle, att3title, att4title, att5title </b></td>
        <td><?php _e('These are product attribute titles. You can write any attribute here e.g. size, shape, brand, type, etc.');?></td>
    </tr>
     <tr>
    	<td><b>size, color, attribute3, attribute4, attribute5 </b></td>
        <td><?php _e('These are product attribute values. Multiple values should be comma separated and price should be entered in brackets e.g. Red(-2), black(+2), Blue(+1).');?></td>
    </tr>
     <tr>
    	<td><b>size_stock, color_stock, attribute3_stock, attribute4_stock, attribute5_stock</b></td>
        <td><?php _e('You can manage stock for each and every attributes from here. E.g. for these product attributes: Red(-2), black(+2), Blue(+1), you can enter stock as10,15,50');?></td>
    </tr>
      <tr>
    	<td><b>is_check_outofstock</b></td>
        <td><?php _e('If you want to enable stock management for your product, then write "1" to enable stock management and "0" to disable.');?></td>
    </tr>
     <tr>
    	<td><b>Initstock</b></td>
        <td><?php _e('If you have enabled stock management, then you can write the initial stock (starting stock) value here. "0" means out of stock and if you leave it as blank, then it will consider it as unlimited stock.');?></td>
    </tr>
     <tr>
    	<td><b>minstock</b></td>
        <td><?php _e('If you want to set minimum stock alert, then set its limit here. E.g. 5. You\'ll receive an Email, if the product stock reaches 5 or less than 5.');?></td>
    </tr>
     <tr>
    	<td><b>isshowstock</b></td>
        <td><?php _e('To show stock details in "Product detail" page.');?></td>
    </tr>
    <tr>
    	<td><b>productimage</b></td>
        <td><?php _e('Filename of the products image should be inserted in this field. E.g. tie_01.jpg. If you want to insert more than one product, then you have to insert the column with same title, which would be "productimage", then just enter its filename e.g. tie_02.jpg. So only enter the name of the image file and not its full URL. Finally upload the CSV and then you\'ll be presented URL where you\'ll need to upload the images. Use an FTP client like FileZilla to upload the images at that path.
');?></td>
    </tr>
    </table>
    </td></tr>
  </table>
</form>
<script>
function check_frm()
{
	if(document.getElementById('bulk_upload_csv').value == '')
	{
		alert("<?php _e('Please select csv file to upload');?>");
		return false;
	}
	return true;
}
function show_hide()
{
	if(document.getElementById('guide_csv_upload').style.display=='none')
	{
			document.getElementById('guide_csv_upload').style.display = '';
	}else
	{
		document.getElementById('guide_csv_upload').style.display = 'none';	
	}
}
</script>

</div> <!-- page #end -->
 </div>   <!-- wrapper #end -->