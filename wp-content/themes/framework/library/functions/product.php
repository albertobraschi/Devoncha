<?php 
ob_start();
if (!class_exists('Product')) {

	class Product {
		// Class initialization
		function Product() {
		}

		function have_products()
		{
			global $wpdb;
			$productCount = 0;
           	$products = $wpdb->get_var("SELECT COUNT(DISTINCT ID) FROM $wpdb->posts WHERE post_status = 'publish'");
			if($products)
			{
				$productCount = $products;
			}
			return $productCount;
		}
		function get_product_price($product_id)
		{
			global $General;
			if($product_id)
			{
				$data = get_post_meta( $product_id, 'key', true );
				$price = $data['price'];
				$specialprice = $data['specialprice'];
				$spPrdLstDate = $data['spPrdLstDate'];
				if($price!='')
				{
					if($spPrdLstDate!= ''  && $spPrdLstDate<date('Y-m-d'))
					{
						$specialprice = 0;
					}
					
					if($specialprice=='' || $specialprice==0 || $specialprice=='0.00')
					{
						$price_info = $General->get_product_price_tax_included($product_id,$price);
						if($price_info && $price>0)
						{
							$price = $price + $price_info[0];	
						}
						$finalPrice = '<span class="prdprice">'.$General->get_amount_format($price). '</span>';
					}else
					{
						$price_info = $General->get_product_price_tax_included($product_id,$specialprice);
						if($price_info && $specialprice>0)
						{
							$specialprice = $specialprice + $price_info[0];	
						}
						$finalPrice = '<span class="specialpirce">'.$General->get_amount_format($price) . '</span>&nbsp;&nbsp;<span class="prdprice">'.$General->get_amount_format($specialprice).'</span>'; 	 
					}
				}
				return $finalPrice;
			}		
		}
		function get_product_price_only($product_id)
		{
			global $General;
			if($product_id)
			{
				$data = get_post_meta( $product_id, 'key', true );
				 $price = $data['price'];
				$price_info = $General->get_product_price_tax_included($product_id,$price);
				if($price_info && $price>0)
				{
					$price = $price + $price_info[0];	
				}
				return $price;
			}		
		}
		function get_product_price_sale($product_id)
		{
			global $General;
			if($product_id)
			{
				$data = get_post_meta( $product_id, 'key', true );
				$price = $data['price'];
				$specialprice = $data['specialprice'];
				$spPrdLstDate = $data['spPrdLstDate'];
				if($spPrdLstDate!= ''  && $spPrdLstDate<date('Y-m-d'))
				{
					$specialprice = 0;
				}

				$finalPrice = $specialprice;
				$price_info = $General->get_product_price_tax_included($product_id,$finalPrice);
				if($price_info && $finalPrice>0)
				{
					$finalPrice = $finalPrice + $price_info[0];	
				}
				return $finalPrice;
			}		
		}
		function get_product_price_no_currency($product_id)
		{
			global $Product,$General;
			if($product_id)
			{
				if($Product->get_product_type($product_id)=='donation')
				{
					$donation_amt = get_post_meta($product_id,'donation_amt',true);
					if($donation_amt)
					{
						$donation_amt_arr = explode(',',$donation_amt);
						if(count($donation_amt_arr)==1)
						{
							return $donation_amt_arr[0];
						}
					}							
				}else
				{
					$data = get_post_meta( $product_id, 'key', true );
					$price = $data['price'];
					$specialprice = $data['specialprice'];
					$spPrdLstDate = $data['spPrdLstDate'];
					if($spPrdLstDate!= ''  && $spPrdLstDate<date('Y-m-d'))
					{
						$specialprice = 0;
					}
					if($specialprice=='' || $specialprice==0 || $specialprice=='0.00')
					{
						$finalPrice = $price;
					}else
					{
						$finalPrice = $specialprice; 	 
					}
					$price_info = $General->get_product_price_tax_included($product_id,$finalPrice);
					if($price_info && $finalPrice>0)
					{
						$finalPrice = $finalPrice + $price_info[0];	
					}
					return $finalPrice;
				}
			}		
		}
		function get_product_qty($product_id)
		{
			$data = get_post_meta( $product_id, 'key', true );

			if($data['productquentity']=='0')
			{
				return "<strong>Out of Stock</strong>";
			}elseif($data['productquentity']=='')
			{
				return "<strong>Unlimited</strong>";
			}
			return $data['productquentity'];
		}
		function get_product_custom_dl($product_id,$customename,$customeId = '',$return_js='',$select_text='')
		{
			global $General;
			$attribute_array = $General->product_current_orders_count($product_id,array('attribute'=>'1'));
			$att_str = $General->get_attribute_str($attribute_array);
			$returnarray = array();
			$data = get_post_meta( $product_id, 'key', true );
			$customval = $data[$customename];
			$customval_stock = substr($data[$customename.'_stock'],1,strlen($data[$customename.'_stock']));
			$customval_stock_arr = explode(',',$customval_stock);
			if($select_text=='')
			{
				$select_text = $customename;
			}
			if($customval != '')
			{
				if($customeId == '')
				{
					$customeId = $customename;
				}
				$customArr1 = explode(',',$customval);
				$dlstr = '';
				$dlstr .= '<select name="'.$customename.'" id="'.$customeId.'" onchange="checkstock(this.value)">'; 
				$dlstr .= '<option value="">'.__('select '.$select_text).'</option>';	
				for($i=0;$i<count($customArr1);$i++)
				{
					$cust_att =trim(preg_replace('/[(]([+-]+)(.*)[)]/','',$customArr1[$i]));
					if($customval_stock_arr[$i]!='')
					{
						$cust_stock = $customval_stock_arr[$i]-substr_count($att_str,','.$cust_att.',');
					}else
					{
						$cust_stock = '1';
					}
					//if($cust_stock>0)
					//{
						$dlstr .= '<option value="'.str_replace('"','',$customArr1[$i]).'">'.$customArr1[$i].'</option>';
					//}
					if($cust_stock<=0)
					{
						$js_string .= 'if(attval == "'.$customArr1[$i].'"){if(eval(\'document.getElementById("shoppingcart_button_1")\')){document.getElementById("shoppingcart_button_1").style.display="none";} if(eval(\'document.getElementById("shoppingcart_outofstock_msg1")\')){document.getElementById("shoppingcart_outofstock_msg1").innerHTML="this product is out of stock"}
						if(eval(\'document.getElementById("shoppingcart_button_2")\')){document.getElementById("shoppingcart_button_2").style.display="none";} if(eval(\'document.getElementById("shoppingcart_outofstock_msg2")\')){document.getElementById("shoppingcart_outofstock_msg2").innerHTML="this product is out of stock"}
						}';
					}
				}
				$dlstr .= '</select>';
			}else
			{
				$dlstr = '';
			}
			if($return_js)
			{
				return $js_string;	
			}else
			{
				return $dlstr;
			}
		}
		function get_donation_dl($pid)
		{
			$donation_amt = get_post_meta($pid,'donation_amt',true);
			if($donation_amt)
			{
				$donation_amt_arr = explode(',',$donation_amt);
				if(count($donation_amt_arr)==1)
				{
					global $General;
					return $General->get_amount_format($donation_amt_arr[0]);
				}else
				{
					for($i=0;$i<count($donation_amt_arr);$i++)
					{
						$returnstr .= '<option>'.$donation_amt_arr[$i].'</option>';
					}
					return '<select id="donation_amt" name="donation_amt" onchange="set_donation_amt(this.value);">'.$returnstr.'</select>';
				}
			}
		}
		function cart_detail_product_qty($pid,$product_qty)
		{
			global $General,$Product;
			if($pid)
			{
				if($Product->get_product_type($pid)=='donation')
				{
				?>
                	<input type="text" readonly="readonly" name="product_qty[]" size="8" value="<?php echo $product_qty; ?>" class="qty" />
                    <br /><span class="qty_dn"><?php _e(DONATION_PRD_TXT);?></span>
                <?php
				}elseif(get_option('ptthemes_qty_txt_cart_showhide')=='Readonly')
				{
				?>
                	<input type="text" readonly="readonly" name="product_qty[]" size="8" value="<?php echo $product_qty; ?>" class="qty" />
                <?php
				}else
				{
				?>
                	<input type="text" name="product_qty[]" size="8" value="<?php echo $product_qty; ?>" class="qty" />
                <?php	
				}
			}
		}
		function get_product_type($pid)
		{
			if(get_post_meta($pid,'product_type',true))	
			{
				return get_post_meta($pid,'product_type',true);
			}else
			{
				return 'physical';	
			}
		}
		function display_product_price_single($pid)
		{
			global $General,$Product;
			if($Product->get_product_type($pid)=='donation')
			{	
			?>
            <div class="row"><strong><?php _e('Donation Amount : ');?></strong><span class="dprice"><?php echo $General->get_currency_symbol().$this->get_donation_dl($pid);?></span></div>
            <?php
			}
			elseif($Product->get_product_price_sale($pid)>0)
			{
				$tatinfo = $General->get_product_price_tax_included($pid);
			?>
<p><?php _e(REGULAR_PRICE_TEXT);?>: <s> <?php echo $General->get_amount_format($Product->get_product_price_only($pid)); ?> </s></p>
<p><strong> <?php _e(SALE_PRICE_TEXT);?> :</strong> <span class="price"> <?php echo $General->get_amount_format($Product->get_product_price_sale($pid)); ?></span> </p>
<?php
if($tatinfo[1])
{
?>
<p class="taxincluded"><?php echo $tatinfo[1];?></p>
<?php	
}
?>
<?php
			}elseif($Product->get_product_price_only($pid)>0)
			{
				$tatinfo = $General->get_product_price_tax_included($pid);
			?>
<p><strong> <?php _e(PRICE_TEXT);?>: </strong><span class="price"><?php echo $General->get_amount_format($Product->get_product_price_only($pid)); ?></span> </p>
<?php
if($tatinfo[1])
{
?>
<p class="taxincluded"><?php echo $tatinfo[1];?></p>
<?php	
}
?>
<?php
			}	
		}
		function display_product_price_listing($pid)
		{
			global $General,$Product;
			if($Product->get_product_price_sale($pid)>0)
			{
				 echo '<s>'.$General->get_amount_format($Product->get_product_price_only($pid)).'</s>&nbsp;';
				 echo '<b>'.$General->get_amount_format($Product->get_product_price_sale($pid)).'</b>';
				 
			}else
			{
				if($Product->get_product_price_only($pid) != '')
				{
					if($General->is_storetype_catalog())
					 {
						echo $General->get_amount_format($Product->get_product_price_only($pid));	
					 }else
					 {
						echo $General->get_amount_format($Product->get_product_price_only($pid));
					 }
				}
			 }
		}
		function get_display_order_prd_li($page='prdlisting')
		{
			$display_arr = array();
			if($page=='prdlisting')
			{
				$keyword = "prdlist";	
			}elseif($page=='catlisting')
			{
				$keyword = "prdlstcat";
			}
			elseif($page=='homelisting')
			{
				$keyword = "prdlsthome";
			}
			
			if(get_option('ptthemes_'.$keyword.'title_showhide'))
			{
				$display_arr['title'] = get_option('ptthemes_'.$keyword.'title_order');
			}
			if(get_option('ptthemes_'.$keyword.'image_showhide'))
			{
				$display_arr['image'] = get_option('ptthemes_'.$keyword.'image_order');
			}
			if(get_option('ptthemes_'.$keyword.'price_showhide'))
			{
				$display_arr['price'] = get_option('ptthemes_'.$keyword.'price_order');
			}
			if(get_option('ptthemes_'.$keyword.'content_showhide'))
			{
				$display_arr['content'] = get_option('ptthemes_'.$keyword.'content_order');
			}
			if(get_option('ptthemes_'.$keyword.'button_showhide'))
			{
				$display_arr['button'] = get_option('ptthemes_'.$keyword.'button_order');
			}
			uasort($display_arr, 'cmp');
			return $display_arr;
			
		}
		function product_listing_li_default($post,$args=array())
		{
			global $Product,$General,$thumb_url;
			$image_width = $this->get_image_width($post->image_width);
			$image_height = $this->get_image_height($post->image_height);
			$product_image_arr = $this->get_product_image($post,'large','',1);
			$is_image_border = 0;
			if(is_category())
			{
				if(get_option('ptthemes_prdlstcatimage_border')){$is_image_border = 1;}
			}elseif(is_home() && $_REQUEST['ptype']=='store')
			{
				if(get_option('ptthemes_prdlistimage_border')){$is_image_border = 1;}
			}else
			{
				if(get_option('ptthemes_prdlsthomeimage_border')){$is_image_border = 1;}
			}
			$data = get_post_meta( $post->ID, 'key', true );
            $product_price = $Product->get_product_price($post->ID);
			?>
            <a href="<?php the_permalink() ?>" class="product_thumb" style="width:<?php echo $image_width;?>px; height:<?php echo $image_height;?>px">
            <?php
			if($Product->get_product_price_sale($post->ID)>0)
			{
			?>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/sale.png" alt="" class="sale_img" />
            <?php
			}
			$thumb_url .= $this->get_image_cutting_edge($args);
			?>  <img src="<?php echo bloginfo('template_url'); ?>/thumb.php?src=<?php echo $product_image_arr[0]; ?>&amp;w=<?php echo $image_width;?>&amp;h=<?php echo $image_height;?>&amp;zc=1&amp;q=80<?php echo $thumb_url;?>" alt=""  <?php if($is_image_border){?> border="1"<?php }?> /></a>
            
            <div class="content">
              <h3><a href="<?php the_permalink() ?>" title="Permanent Link to <?php the_title_attribute(); ?>">
                <?php the_title(); ?>
                </a></h3>
              <p class="contentp"><?php echo bm_better_excerpt(200, ' ... '); ?></p>
              <p class="sale_price" >
              <?php
			if($Product->get_product_type($post->ID)=='donation')
			{	
			?>
            <?php echo $General->get_currency_symbol().$this->get_donation_dl($post->ID);?>
            <?php
			}
			elseif($Product->get_product_price_sale($post->ID)>0)
			{
				echo '<s>'.$General->get_amount_format($Product->get_product_price_only($post->ID)).'</s>&nbsp;';
				echo '<b>'.$General->get_amount_format($Product->get_product_price_sale($post->ID)).'</b>';					 
			}elseif($Product->get_product_price_only($post->ID)>0)
			{
				if($Product->get_product_price_only($post->ID))
				{
					if($General->is_storetype_catalog())
					 {
						if($Product->get_product_price_only($post->ID)>0)
						{
							echo $General->get_amount_format($Product->get_product_price_only($post->ID));	
						}
					 }else
					 {
						echo $General->get_amount_format($Product->get_product_price_only($post->ID));
					 }
				}
			}	
				 ?>
              </p>
              <div class="viewdetails"> <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" class="highlight_button fl"><?php _e('Ver Detalhes');?></a> </div>
            </div>

            <?php
		}
		function get_image_height($image_height='')
		{
			if($image_height=='')
			{
				$image_height = get_option('ptthemes_image_height');	
			}
			return $image_height;
		}
		function get_image_width($image_width='')
		{
			if($image_width=='')
			{
				$image_width = get_option('ptthemes_image_width');	
			}
			return $image_width;
		}
		function product_listing_li_shorted($post,$display_order,$args=array())
		{
			global $Product,$General,$thumb_url;
			$image_width = $this->get_image_width($post->image_width);
			$image_height = $this->get_image_height($post->image_height);
			$product_image_arr = $this->get_product_image($post,'large');
			$data = get_post_meta( $post->ID, 'key', true );
            $product_price = $Product->get_product_price($post->ID);
			$content_strt_str ='';
			$content_strt_end ='';
			foreach($display_order as $key=>$val)
			{
				
				if($key=='image')
				{
					$is_image_border=0;
					if(is_category())
					{
						if(get_option('ptthemes_prdlstcatimage_border')){$is_image_border = 1;}
					}elseif(is_home() && $_REQUEST['ptype']=='store')
					{
						if(get_option('ptthemes_prdlistimage_border')){$is_image_border = 1;}
					}else
					{
						if(get_option('ptthemes_prdlsthomeimage_border')){$is_image_border = 1;}
					}
					
				?>
                 <a href="<?php the_permalink() ?>" class="product_thumb" style="width:<?php echo $image_width;?>px; height:<?php echo $image_height;?>px">
                   <?php	if($Product->get_product_price_sale($post->ID)>0){?>
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/sale.png" alt="" class="sale_img"  />
				<?php }?>
                <?php $thumb_url .= $this->get_image_cutting_edge($args);?>
                 <img src="<?php echo bloginfo('template_url'); ?>/thumb.php?src=<?php echo $product_image_arr[0]; ?>&amp;w=<?php echo $image_width;?>&amp;h=<?php echo $image_height;?>&amp;zc=1&amp;q=80<?php echo $thumb_url;?>" alt=""  <?php if($is_image_border){?> border="1"<?php }?> /></a>
               
                <?php	
				}
				if(($key=='title' || $key=='content' || $key=='price' || $key=='button') && $content_strt_str=='')
				{
					echo $content_strt_str = '<div class="content">';
					//$content_strt_end = '</div>';
				}
				if($key=='title'){?><h3><a href="<?php the_permalink() ?>" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3><?php }else
				if($key=='content'){?><p class="contentp"><?php echo bm_better_excerpt(200, ' ... '); ?></p><?php }else
             	if($key=='price'){?>
			  <p class="sale_price" >
              <?php
				if($Product->get_product_price_sale($post->ID)>0)
				{
					 echo '<s>'.$General->get_amount_format($Product->get_product_price_only($post->ID)).'</s>&nbsp;';
					 echo '<b>'.$General->get_amount_format($Product->get_product_price_sale($post->ID)).'</b>';
					 
				}else
				{
					if($Product->get_product_price_only($post->ID))
					{
						if($General->is_storetype_catalog())
						 {
							if($Product->get_product_price_only($post->ID)>0)
							{
								echo $General->get_amount_format($Product->get_product_price_only($post->ID));	
							}
						 }else
						 {
							echo $General->get_amount_format($Product->get_product_price_only($post->ID));
						 }
					}
				 }
				 ?>
              </p>
              <?php }else
			  if($key=='button'){?> <div class="viewdetails"> <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" class="highlight_button fl"><?php _e('Ver Detalhes');?></a> </div><?php }?>
            
            <?php 
			}
			
			?>
            
			</div>
            <?php
		}
		function product_listing_li($post,$args=array())
		{
			global $Product,$General;
			$data = get_post_meta( $post->ID, 'key', true );
            $product_price = $Product->get_product_price($post->ID);
			if(is_category())
			{
				$page = 'catlisting';	
			}elseif(is_home() && $_REQUEST['ptype']=='store')
			{
				$page = 'prdlisting';
			}else
			{
				$page = 'homelisting';
			}
			$display_order = $this->get_display_order_prd_li($page);

			$image_width = $this->get_image_width($post->image_width);
			$image_height = $this->get_image_height($post->image_height);
			global $thumb_style;
			if($thumb_style=='')
			{
				$li_height = $image_height+50;
				echo $thumb_style = '<style type="text/css">#content ul.thumb_view li { height:'.$li_height.'px;}</style>';	
			}			
		?>
        	<style>
				#content ul.thumb_view li { width:<?php echo $image_width;?>px; }
			</style>
        
        	<li> <div class="content_block">
            <?php
			if($display_order)
			{
				$this->product_listing_li_shorted($post,$display_order,$args);
			}else
			{
				$this->product_listing_li_default($post,$args);
			}
            ?>
          </div>
          <!-- content block #end -->
        </li>
        <?php
		}
		function related_product_listing_li($post)
		{
			$product_id = $post->ID;
			$product_post_title = $post->post_title;
			$productlink = $post->guid;
			$product_image_arr = $this->get_product_image($post->ID,'large',1);
			if($product_image_arr && $product_image_arr[0])
			{
				$imagepath = $product_image_arr[0];
			}
			if($imagepath)
			{
				$this->product_listing_li($post);	
			}
		}
		function show_favourite_link($post)
		{
			global $General;
		?>
           <?php if(get_option('ptthemes_print_showhide')=='Show' || get_option('ptthemes_print_showhide')==''){?>
            <li class="print"><a href="#" onclick="window.print();return false;"><?php _e(PRINT_TEXT);?></a> </li>
            <?php }?>
            <?php
            if(get_option('ptthemes_feed_name'))
            {
            ?>
            <li class="sharethis"><a class="a2a_dd" target="_blank" href="http://www.addtoany.com/subscribe?linkname=http%3A%2F%2F<?php echo stripslashes(get_option('ptthemes_feed_name'));  ?>&amp;linkurl=http%3A%2F%2F<?php echo stripslashes(get_option('ptthemes_feed_url'));  ?>"><?php _e(SHARE_THIS_TEXT);?></a>
                <script type="text/javascript">a2a_linkname="<?php echo stripslashes(get_option('ptthemes_feed_name'));  ?>";a2a_linkurl="<?php echo stripslashes(get_option('ptthemes_feed_url'));  ?>";</script>
                <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/library/js/feed.js"></script>
              </li>
            <?php }?>
             <?php
            if(get_option('ptthemes_rssfeed_showhide')=='Show' || get_option('ptthemes_rssfeed_showhide')=='')
            {
            ?>
              <li class="rss"><a href="<?php echo get_option('ptthemes_feed_url'); ?>"><?php _e(RSS_TEXT);?></a> </li>
            <?php }?>
             <?php
             if(get_option('ptthemes_tellfrnd_showhide')=='Show' || get_option('ptthemes_tellfrnd_showhide')=='')
             {
                include(TEMPLATEPATH . '/library/includes/tellafriend.php');
             } ?>
        <?php	
		}
		function show_product_weight($pid)
		{
			global $General;
			$data = get_post_meta( $pid, 'key', true );
			if(get_option('ptthemes_prd_weight_showhide')!='Hide' && $data[ 'weight'])
			{?>
            <div class="row"> <label class="pfield"><?php _e(WEIGHT_TEXT);?>: </label> <strong class="product_code_p"><?php echo $data['weight']; ?> <?php echo $General->get_product_weight_unit();?></strong></div>
            <?php }
		}
		function show_product_model_code($pid)
		{
			global $General;
			$data = get_post_meta( $pid, 'key', true );
			if($data['model']){
			?>
            <div class="row"> <label class="pfield"> <?php _e('Product Code');?>: </label> <strong class="product_code_p"><?php echo $data[ 'model']; ?> </strong></div>
   	        <?php }
		}
		function get_product_image($post,$img_size='thumb',$detail='',$numberofimgs='')
		{
			$return_arr = array();
			if($post->ID)
			{
				$images = $this->get_post_images($post->ID);
				if(is_array($images))
				{
					$return_arr = $images;
				}
			}
			$arrImages =&get_children('order=ASC&orderby=menu_order ID&post_type=attachment&post_mime_type=image&post_parent=' . $post->ID );
			if($arrImages) 
			{
				$counter=0;
			   foreach($arrImages as $key=>$val)
			   {
					$counter++;
					$id = $val->ID;
					if($img_size == 'large')
					{						
						$img_arr = wp_get_attachment_image_src($id,'full');	// THE FULL SIZE IMAGE INSTEAD
						if(!strstr($post->post_content,$img_arr[0]))
						{
							if($detail)
							{
								$img_arr['id']=$id;
								$return_arr[] = $img_arr;
							}else
							{
								$return_arr[] = $img_arr[0];
							}
						}
					}
					elseif($img_size == 'medium')
					{
						$img_arr = wp_get_attachment_image_src($id, 'medium'); //THE medium SIZE IMAGE INSTEAD
						if(!strstr($post->post_content,$img_arr[0]))
						{
							if($detail)
							{
								$img_arr['id']=$id;
								$return_arr[] = $img_arr;
							}else
							{
								$return_arr[] = $img_arr[0];
							}
						}
					}
					elseif($img_size == 'thumb')
					{
						$img_arr = wp_get_attachment_image_src($id, 'thumbnail'); // Get the thumbnail url for the attachment
						if(!strstr($post->post_content,$img_arr[0]))
						{
							if($detail)
							{
								$img_arr['id']=$id;
								$return_arr[] = $img_arr;
							}else
							{
								$return_arr[] = $img_arr[0];
							}
						}						
					}
					if($numberofimgs && $numberofimgs==$counter)
					{
						break;	
					}
			   }
			  return $return_arr;
			}			
		}

		function show_product_images($post)
		{
			global $thumb_url;
			//$product_image_arr = $this->get_product_image($pid);
			$product_image_arr = $this->get_product_image($post,'large');
			if($product_image_arr)
			{
		  if($product_image_arr[0]){ ?>         
            <a class="zoom product_main_img" rel="group" title="" href="<?php echo $product_image_arr[0]; ?>"  >
            <img src="<?php bloginfo('template_directory'); ?>/images/zoom.png" alt="" class="i_zoom" /> 
            <img src="<?php echo bloginfo('template_url'); ?>/thumb.php?src=<?php echo $product_image_arr[0]; ?><?php echo apply_filters('ec_prd_detail_bimg_resize_filter','&amp;w=300&amp;zc=1&amp;q=80')?><?php echo $thumb_url;?>" alt="" /></a>
          <?php }?>
          <?php if(count($product_image_arr)>1)
		  {
				for($im=1;$im<count($product_image_arr);$im++)
				{
					$ext_arr = explode('.',$product_image_arr[$im]);
					$fileext = strtolower($ext_arr[count($ext_arr)-1]);
					if(in_array($fileext,array('jpg','jpeg','gif','png')))
					{
				?>
                 <a class="zoom" rel="group" title="" href="<?php echo $product_image_arr[$im]; ?>"><img src="<?php echo bloginfo('template_url'); ?>/thumb.php?src=<?php echo $product_image_arr[$im]; ?><?php echo apply_filters('ec_prd_detail_timg_resize_filter','&amp;w=100&amp;h=105&amp;zc=1&amp;q=80')?><?php echo $thumb_url;?>" alt="" /></a>
                <?php
					}
				}
		  }
		  return true;
			}else
			{
				return false;	
			}
      }
		function show_addtocart_below_desc()
		{
			if(get_option('ptthemes_add_to_cart_button_position')=='Below Description' || get_option('ptthemes_add_to_cart_button_position')=='Above and Below Description')
			{
				return true;
			}else
			{
				return false;	
			}
		}
		function show_addtocart_above_desc()
		{
			if(get_option('ptthemes_add_to_cart_button_position')=='Above Description' || get_option('ptthemes_add_to_cart_button_position') == '' || get_option('ptthemes_add_to_cart_button_position')=='Above and Below Description')
			{
				return true;
			}else
			{
				return false;	
			}
		}
		function get_image_cutting_edge($args=array())
		{
			if($args['image_cut'])
			{
				$cut_post =$args['image_cut'];
			}else
			{
				$cut_post = get_option('ptthemes_image_x_cut');
			}
			if($cut_post)
			{
				
				if($cut_post=='top')
				{
					$thumb_url .= "&amp;a=t";	
				}elseif($cut_post=='bottom')
				{
					$thumb_url .= "&amp;a=b";	
				}elseif($cut_post=='left')
				{
					$thumb_url .= "&amp;a=l";
				}elseif($cut_post=='right')
				{
					$thumb_url .= "&amp;a=r";
				}elseif($cut_post=='top right')
				{
					$thumb_url .= "&amp;a=tr";
				}elseif($cut_post=='top left')
				{
					$thumb_url .= "&amp;a=tl";
				}elseif($cut_post=='bottom right')
				{
					$thumb_url .= "&amp;a=br";
				}elseif($cut_post=='bottom left')
				{
					$thumb_url .= "&amp;a=bl";
				}
			}
			return $thumb_url;
		}
		function get_post_images($pid)
		{
			$image_array = array();
			$pmeta = get_post_meta($pid, 'key', $single = true);
			if($pmeta['productimage'])
			{
				$image_array[] = $pmeta['productimage'];
			}
			if($pmeta['productimage1'])
			{
				$image_array[] = $pmeta['productimage1'];
			}
			if($pmeta['productimage2'])
			{
				$image_array[] = $pmeta['productimage2'];
			}
			if($pmeta['productimage3'])
			{
				$image_array[] = $pmeta['productimage3'];
			}
			if($pmeta['productimage4'])
			{
				$image_array[] = $pmeta['productimage4'];
			}
			if($pmeta['productimage5'])
			{
				$image_array[] = $pmeta['productimage5'];
			}
			if($pmeta['productimage6'])
			{
				$image_array[] = $pmeta['productimage6'];
			}
			return $image_array;
		}

		function get_js_header_prd_detail()
		{
			global $Product,$post;
			$data = get_post_meta( $post->ID, 'key', true );
		?>
        <script language="javascript" type="text/javascript">
		function chekc_stock()
		{
			$.ajax({
				url: '<?php echo site_url('/?page=cart&cartact=stock_chk&pid='.$post->ID); ?>',
				type: 'GET',
				dataType: 'html',
				timeout: 20000,
				error: function(){
					//alert('Error loading cart information');
				},
				success: function(html){
					if(html=='unlimited')
					{
						
					}else
					if(html>0)
					{
					}else
					{
						window.location.href='<?php echo $_SERVER['REQUEST_URI'];?>';	
					}
				}
			});
		}
		function checkstock(attval)
		{
			<?php
			if($data['is_check_outofstock']=='on'  && ($data['initstock'] !='' && $data['initstock']>=0))
			{
			?>
			if(eval('document.getElementById("shoppingcart_button_1")'))
			{
				document.getElementById("shoppingcart_button_1").style.display="";
			}
			if(eval('document.getElementById("shoppingcart_outofstock_msg1")'))
			{
				document.getElementById("shoppingcart_outofstock_msg1").innerHTML="";
			}
			if(eval('document.getElementById("shoppingcart_button_2")'))
			{
				document.getElementById("shoppingcart_button_2").style.display="";
			}
			if(eval('document.getElementById("shoppingcart_outofstock_msg2")'))
			{
				document.getElementById("shoppingcart_outofstock_msg2").innerHTML="";
			}
			<?php
			$product_color_js = $Product->get_product_custom_dl($post->ID,'size','',1);
			$product_color_js .= $Product->get_product_custom_dl($post->ID,'color','',1);
			$product_color_js .= $Product->get_product_custom_dl($post->ID,'attribute3','',1);
			$product_color_js .= $Product->get_product_custom_dl($post->ID,'attribute4','',1);
			$product_color_js .= $Product->get_product_custom_dl($post->ID,'attribute5','',1);
			echo $product_color_js;
			?>
			<?php }?>
		}
		</script>

        <?php	
		}
	} 
	// Start this plugin once all other plugins are fully loaded
}
if(!$Product)
{
	$Product = new Product();
}

?>