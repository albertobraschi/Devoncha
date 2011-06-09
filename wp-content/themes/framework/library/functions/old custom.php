<?php
global $General,$wpdb;
if($_REQUEST['prdattid'])
{
	wp_delete_attachment($_REQUEST['prdattid']);
	exit;
}
function is_product($productsId)
{
	$blogCategoryIdStr = get_inc_categories("cat_exclude_");
	$blogCategoryIdArr = explode(',',$blogCategoryIdStr);
	$postCatArr = wp_get_post_categories( $post_id = $productsId);
	if(count(array_intersect($blogCategoryIdArr,$postCatArr))==0)
	{
		$editproduct = 1;
	}else
	{
		$editproduct = 0;
	}
	return $editproduct;
}

$editproduct = 0;
if($_GET['action'] == 'edit')
{
	if(is_product($_GET['post']))
	{
		$editproduct = 1;
	}
}


function ptthemes_meta_box_content_type() {
    global $post, $pt_metaboxes,$General;
	$product_type = get_post_meta($post->ID,'product_type',true);
	if($product_type=='')
	{
		$product_type = 'physical';	
	}
   ?>
   <table border="0" cellpadding="10" cellspacing="13" width="100%">
   	<tr>
    	<td width="2%"><input type="radio" name="product_type" id="product_type" onclick="check_product_type(this.value);" value="physical" <?php if($product_type=='physical'){?> checked="checked" <?php }?> /></td>
        <td><?php _e('Physical Product');?></td>
    </tr>
    <tr>
    	<td><input type="radio" name="product_type" id="product_type_digital" onclick="check_product_type(this.value);" value="digital" <?php if($product_type=='digital'){?> checked="checked" <?php }?> /></td>
        <td><?php _e('Download/Digital Product');?></td>
    </tr>
     <tr>
    	<td><input type="radio" name="product_type" id="product_type_virtual" onclick="check_product_type(this.value);" value="virtual" <?php if($product_type=='virtual'){?> checked="checked" <?php }?> /></td>
        <td><?php _e('Virtual/Service Product');?></td>
    </tr>
    <tr>
    	<td><input type="radio" name="product_type" id="product_type_donation" onclick="check_product_type(this.value);" value="donation" <?php if($product_type=='donation'){?> checked="checked" <?php }?> /></td>
        <td><?php _e('Donation Product');?></td>
    </tr>
    <tr id="donation_fields" style="display:none;">
    	<td colspan="2" valign="top"><div style="width:90px; float:left;"><?php _e('Amount');?>  :</div> <textarea name="donation_amt" id="donation_amt"><?php echo get_post_meta($post->ID,'donation_amt',true);?></textarea>
        <?php _e('comma seperated amount(in ' . $General->get_currency_code().' - '.$General->get_currency_symbol() . '). example:10,20,30,40,50');?>
        </td>
    </tr>
    <tr>
    	<td><input type="radio" name="product_type" id="product_type_affiliate" onclick="check_product_type(this.value);" value="affiliate" <?php if($product_type=='affiliate'){?> checked="checked" <?php }?> /></td>
        <td><?php _e('Affiliate Product');?></td>
    </tr>
    <tr id="affiliate_fields" style="display:none;">
    	<td colspan="2" valign="top">
       <p>
        <div style="width:100px; float:left;"><?php _e('Affiliate Link');?>  :</div> <input type="text" name="aff_link" id="aff_link" value="<?php echo get_post_meta($post->ID,'aff_link',true);?>" />
        <?php _e('On clicking the affiliate link, you will redirected to this url');?></p>
        <p>
        <div style="width:100px; float:left;"><?php _e('Link Button text');?>  :</div> <input type="text" name="aff_link_text" id="aff_link_text" value="<?php echo get_post_meta($post->ID,'aff_link_text',true);?>" />
        <?php _e('Text will be display on the affiliate link button');?></p>
        </td>
    </tr>
   </table>
   <script type="text/javascript">
   function check_product_type(ptype)
   {
	   document.getElementById('donation_fields').style.display = 'none';
	   document.getElementById('affiliate_fields').style.display = 'none';
	   if(ptype=='donation')
	   {
			document.getElementById('donation_fields').style.display = '';   
	   }else
	   if(ptype=='affiliate')
	   {
		   document.getElementById('affiliate_fields').style.display = '';   
	   }
   }
   if(document.getElementById('product_type_donation').checked)
   {
   	check_product_type(document.getElementById('product_type_donation').value)
   }else
   if(document.getElementById('product_type_affiliate').checked)
   {
   	check_product_type(document.getElementById('product_type_affiliate').value)
   }
   </script>
   <?php
}

function ptthemes_metabox_insert_type() {
   	global $post, $pt_metaboxes , $globals;
	$post_id = $post->ID;
	if ( !current_user_can( 'edit_post', $post_id ))
	return $post_id;
	if($_POST['product_type'])
	{
		update_post_meta($post->ID,'product_type',$_POST['product_type']);
	}
	if($_POST['donation_amt'])
	{
		update_post_meta($post->ID,'donation_amt',$_POST['donation_amt']);
	}
	if($_POST['aff_link'])
	{
		update_post_meta($post->ID,'aff_link',$_POST['aff_link']);
	}
	if($_POST['aff_link_text'])
	{
		update_post_meta($post->ID,'aff_link_text',$_POST['aff_link_text']);
	}
}

function ptthemes_meta_box_type() {
    if ( function_exists('add_meta_box') ) {
        add_meta_box('ptthemes-product-type',$GLOBALS['themename'].' Product Type Settings','ptthemes_meta_box_content_type','post','normal','high');
    }
}

if($_GET['action'] == 'edit')
{
	if(count(array_intersect($blogCategoryIdArr,$postCatArr))>0)
	{
		$editpost = 1;
	}
}
if($_GET['ptype']=='prd' || $_POST || $editproduct==1)
{
	add_action('admin_menu', 'ptthemes_meta_box_type');
	add_action('save_post', 'ptthemes_metabox_insert_type');
}




if($_GET['ptype']=='prd' || $_POST || $editproduct==1){

	$key = "key";
	$meta_boxes = array();
	$meta_boxes['image_title'] = 
	array(
		"name" => "image_title",
		"title" => "Product Images",
		"type" 		=> "seperator",
		"description" => "");
	
	$meta_boxes['productimage'] = 
	array(
		"name" => "productimage",
		"title" => "Upload Product Images",
		"type" 		=> "file",
		"default" 	=> "",
		"tabindex"	=>	'2',
		"description" => "Browse and insert images you want to publish for product.");
	
	$meta_boxes['button_image'] = 
	array("type"=> "button",);
	
	$meta_boxes['seperator_end_img'] = 
	array("type" 		=> "seperator_end",);

	$meta_boxes['digital_title'] = 
	array(
		"name" => "digital_title",
		"title" => "Digital Product",
		"type" 		=> "seperator",
		"description" => "");
	
	$meta_boxes['digital_product'] = 
		array(
			"name" => "digital_product",
			"title" => "Upload Digital Product",
			"type" 		=> "file",
			"default" 	=> "",
			"tabindex"	=>	'2',
			"description" => "Select Digital Product to upload. Upload the product, copy the complete URL and paste it in the textbox. We suggest to upload zip file");	
	
	$meta_boxes['button_digital'] = 
	array("type"=> "button",);
	
	$meta_boxes['seperator_end_dig'] = 
	array("type" 		=> "seperator_end",);
	
	$meta_boxes['price_title'] = 
	array(
		"name" => "price_title",
		"title" => "Product Price Settings",
		"type" 		=> "seperator",
		"description" => "");
	global $General;
	$meta_boxes['price'] = 
	array(
		"name" => "price",
		"title" => "Price (in ".$General->get_currency_code().")",
		"type" 		=> "text",
		"tabindex"	=>	'2',
		"description" => "Enter Product Original Price (price is in ".$General->get_currency_code()."(".$General->get_currency_symbol().")).");
	
	$meta_boxes['spPrdLstDate'] = 
	array(
		"name" => "spPrdLstDate",
		"title" => "Last Date of your Special Product",
		"type" 		=> "date",
		"tabindex"	=>	'2',
		"description" => "Last Date of your product as special product (in '<strong>YYYY-mm-dd</strong>' format only. Example :- ".date('Y-m-d')."). After this date your product will not be displayed in the special product list.");
		
	$meta_boxes['specialprice'] = 
	array(
		"name" => "specialprice",
		"title" => "Special Price (in ".$General->get_currency_code().")",
		"type" 		=> "text",
		"default" 	=> "0.00",
		"tabindex"	=>	'2',
		"description" => "Enter Special Price to be display (price is in ".$General->get_currency_code()."(".$General->get_currency_symbol().")).");
	
	$meta_boxes['button_price'] = 
	array("type"=> "button",);
	
	$meta_boxes['seperator_end_price'] = 
	array("type" 		=> "seperator_end",);
	
	$meta_boxes['att_title'] = 
	array(
		"name" => "att_title",
		"title" => "Product Code & Weight & Tax Settings",
		"type" 		=> "seperator",
		"description" => "");
	
	$meta_boxes['model'] = 
	array(
		"name" => "model",
		"title" => "Product Model",
		"type" 		=> "text",
		"default" 	=> "",
		"tabindex"	=>	'2',
		"description" => "Enter Product Model/Code");
	
	$meta_boxes['size_chart'] = 
	array(
		"name" => "size_chart",
		"title" => "Size Chart",
		"type" 		=> "textarea",
		"default" 	=> "",
		"tabindex"	=>	'2',
		"description" => "Enter Product Size Chart Image & Table Fromat Add");
	
	$meta_boxes['weight'] = 
	array(
		"name" => "weight",
		"title" => "Weight",
		"type" 		=> "text",
		"default" 	=> "",
		"tabindex"	=>	'2',
		"description" => "Enter Product Weight ( in ".$General->get_product_weight_unit().").");
		
	$meta_boxes['istaxable'] = 
	array(
		"name" => "istaxable",
		"title" => "Is taxable?",
		"type" 		=> "checkbox",
		"default" 	=> "0",
		"tabindex"	=>	'2',
		"description" => "Select whether product is taxable or not.");
	
	$meta_boxes['istax_included'] = 
	array(
		"name" => "istax_included",
		"title" => "Is Tax included with price?",
		"type" 		=> "checkbox",
		"default" 	=> "0",
		"tabindex"	=>	'2',
		"description" => "Select whether Tax is included with product price or not.");
	
	$valuearr = array();
	$valuearr= array_merge(array(array('id'=>'all','val'=>'All Taxes',)),get_taxes());
	
	$meta_boxes['prd_tax'] = 
	array(
		"name" => "prd_tax",
		"title" => "Select Taxes",
		"type" 		=> "multi-select",
		"default" 	=> "0",
		"tabindex"	=>	'2',
		"values"	=>	$valuearr,
		"description" => "Select tax, It will enable if product is taxable.");
	
	$meta_boxes['is_free_shipping'] = 
	array(
		"name" => "is_free_shipping",
		"title" => "Select for Free shipping",
		"type" 		=> "checkbox",
		"default" 	=> "",
		"tabindex"	=>	'2',
		"description" => "Wish to Free shipping for the product? Please select the option to apply, otherwise shipping cost will apply as per the setting from shipping management.");
	
	
	$meta_boxes['button_other'] = 
	array("type"=> "button",);
	
	$meta_boxes['button_other'] = 
	array("type"=> "button",);
	
	
	$meta_boxes['seperator_end_other'] = 
	array("type" 		=> "seperator_end",);
	
	$meta_boxes['att_title1'] = 
	array(
		"name" => "att_title1",
		"title" => "Product Attributes Settings",
		"type" 		=> "seperator",
		"description" => "");
	
	$meta_boxes['sizetitle'] = 
	array(
		"name" => "sizetitle",
		"title" => "Attribute 1 Title  (ex: Size)",
		"type" 		=> "text",
		"default" 	=> "",
		"tabindex"	=>	'2',
		"description" => "Product Attribute title 1");
	
	$meta_boxes['size'] = 
	array(
		"name" => "size",
		"title" => "Attribute 1 Value",
		"type" 		=> "select",
		"tabindex"	=>	'2',
		"default" 	=> "Size",
		"description" => "Product is available in various Sizes.  <b>Please press <u>Set Changes</u> button to get your changes effected.</b>'");
		
	$meta_boxes['colortitle'] = 
	array(
		"name" => "colortitle",
		"title" => "Attribute 2 Title (ex: Color)",
		"type" 		=> "text",
		"default" 	=> "",
		"tabindex"	=>	'2',
		"description" => "Product Attribute title 2");
	
	$meta_boxes['color'] = 
	array(
		"name" => "color",
		"title" => "Attribute 2 value ",
		"type" 		=> "select",
		"tabindex"	=>	'2',
		"default" 	=> "Color",
		"description" => "Product is available in various Colors. <b>Please press <u>Set Changes</u> button to get your changes effected.</b>'");
	
	$meta_boxes['size_stock'] = 
	array(
		"name" => "size_stock",
		"title" => "",
		"type" 		=> "hidden",
		"default" 	=> "",
		"tabindex"	=>	'2',
		"description" => "");
		
	$meta_boxes['color_stock'] = 
	array(
		"name" => "color_stock",
		"title" => "",
		"type" 		=> "hidden",
		"default" 	=> "",
		"tabindex"	=>	'2',
		"description" => "");
	
	$meta_boxes['att3title'] = 
	array(
		"name" => "att3title",
		"title" => "Attribute 3 Title (ex: Shape)",
		"type" 		=> "text",
		"default" 	=> "",
		"tabindex"	=>	'2',
		"description" => "Product Attribute title 3");
	
	$meta_boxes['attribute3'] = 
	array(
		"name" => "attribute3",
		"title" => "Attribute 3 Value",
		"type" 		=> "select",
		"tabindex"	=>	'2',
		"default" 	=> "attribute3",
		"description" => "Product is available in various Colors. <b>Please press <u>Set Changes</u> button to get your changes effected.</b>'");
	
	$meta_boxes['attribute3_stock'] = 
	array(
		"name" => "attribute3_stock",
		"title" => "",
		"type" 		=> "hidden",
		"default" 	=> "",
		"tabindex"	=>	'2',
		"description" => "");
	
	$meta_boxes['att4title'] = 
	array(
		"name" => "att4title",
		"title" => "Attribute 4 Title",
		"type" 		=> "text",
		"default" 	=> "",
		"tabindex"	=>	'2',
		"description" => "Product Attribute title 4");
	
	$meta_boxes['attribute4'] = 
	array(
		"name" => "attribute4",
		"title" => "Attribute 4 Value",
		"type" 		=> "select",
		"tabindex"	=>	'2',
		"default" 	=> "attribute3",
		"description" => "Product is available in various Colors. <b>Please press <u>Set Changes</u> button to get your changes effected.</b>'");
	
	$meta_boxes['attribute4_stock'] = 
	array(
		"name" => "attribute4_stock",
		"title" => "",
		"type" 		=> "hidden",
		"default" 	=> "",
		"tabindex"	=>	'2',
		"description" => "");
	
	$meta_boxes['att5title'] = 
	array(
		"name" => "att5title",
		"title" => "Attribute 5 Title",
		"type" 		=> "text",
		"default" 	=> "",
		"tabindex"	=>	'2',
		"description" => "Product Attribute title 5");
	
	$meta_boxes['attribute5'] = 
	array(
		"name" => "attribute5",
		"title" => "Attribute 5 Value",
		"type" 		=> "select",
		"tabindex"	=>	'2',
		"default" 	=> "attribute5",
		"description" => "Product is available in various Colors. <b>Please press <u>Set Changes</u> button to get your changes effected.</b>'");
	
	$meta_boxes['attribute5_stock'] = 
	array(
		"name" => "attribute5_stock",
		"title" => "",
		"type" 		=> "hidden",
		"default" 	=> "",
		"tabindex"	=>	'2',
		"description" => "");
	
	$meta_boxes['button_att'] = 
	array("type"=> "button",);
	
	$meta_boxes['seperator_end_att'] = 
	array("type" 		=> "seperator_end",);
	
	$meta_boxes['stock_title'] = 
	array(
		"name" => "stock_title",
		"title" => "Stock Settings",
		"type" 		=> "seperator",
		"description" => "");
	
	
	$meta_boxes['is_check_outofstock'] = 
	array(
		"name" => "is_check_outofstock",
		"title" => "Apply Stock Management",
		"type" 		=> "checkbox",
		"default" 	=> "0",
		"tabindex"	=>	'2',
		"description" => "Wish to apply stock management for the Product? Checkmark in order to apply stock management for the product");
		
	$meta_boxes['initstock'] = 
	array(
		"name" => "initstock",
		"title" => "Opening Stock",
		"type" 		=> "text",
		"default" 	=> "",
		"tabindex"	=>	'2',
		"description" => "Mention opening stock of this product. If the product is out of stock, keep the value as \"0\". Leave this textbox blank if you want to show the stock as unlimited.");
		
	$meta_boxes['minstock'] = 
	array(
		"name" => "minstock",
		"title" => "Low Stock Notification",
		"type" 		=> "text",
		"default" 	=> "0",
		"tabindex"	=>	'2',
		"description" => "Mention product stock here when you want to get a notification alerting you about low stock. Leave it blank if you do not need notification.");
		
	$meta_boxes['isshowstock'] = 
	array(
		"name" => "isshowstock",
		"title" => "Show available stock on your store?",
		"type" 		=> "checkbox",
		"default" 	=> "0",
		"tabindex"	=>	'2',
		"description" => "Select this if you want to show the figure of the product quantity in stock.");
		
	$meta_boxes['button_stock'] = 
	array("type"=> "button",);
	
	$meta_boxes['seperator_end_stock'] = 
	array("type" 		=> "seperator_end",);

	function create_meta_box() {
	global $key;
	
	if( function_exists( 'add_meta_box' ) ) {
	add_meta_box( 'new-meta-boxes', ucfirst( $key ) . ' -> Product Attributes', 'display_meta_box', 'post', 'normal', 'high' );
	}
	}
	
	function display_meta_box() {
	global $post, $meta_boxes, $key;
	?>
        
<div class="form-wrap">
<div class="feature-box">
  
  <script>var rootfolderpath = '<?php echo bloginfo('template_directory');?>/images/';</script>
  <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/library/js/dhtmlgoodies_calendar.js"></script>
  <link href="<?php bloginfo('template_directory'); ?>/library/css/dhtmlgoodies_calendar.css" rel="stylesheet" type="text/css" />
  <link href="<?php bloginfo('template_directory'); ?>/library/functions/custom.css" rel="stylesheet" type="text/css" />
  
  <script language="javascript" type="text/javascript">
		<!--
		function toggle(o){
			var e = document.getElementById(o);
			e.style.display = (e.style.display == 'none') ? 'block' : 'none';
			}
		function deleteMe(id_ref) {
					  var theImage = document.getElementById(id_ref);
					  theImage.value = '';
					  }
		function reloadFrame(imageName) {
						parent.frames[imageName].window.location.reload();						
					} 
		function addnewone(customfieldname)
		{
			
			addCustomField(customfieldname)  
		}
		
	
	function custom_evaluate(customfield)
	{
		var equationstr = '';
		var stockstr = '';
		var count = document.getElementById(customfield+'Count').value;
		for(i=0;i<=count;i++)
		{
			equationstr1 = '';
			if(eval(document.getElementById(customfield+'_name'+i)))
			{
				var name = document.getElementById(customfield+'_name'+i).value;
				var symbol = document.getElementById(customfield+'_amsym'+i).value;
				var price = document.getElementById(customfield+'_price'+i).value;
				var stock = document.getElementById(customfield+'_stock'+i).value;
				if(name != customfield && name != '')
				{
					equationstr1 = name;
					if(price != 'price' && price != '')
					{
						equationstr1 = equationstr1 + '(' + symbol + price + ')';
					}
					if(equationstr == '')
					{
						equationstr = equationstr1;
					}else
					{
						equationstr = equationstr + ',' + equationstr1;
					}
					stockstr = stockstr + ',' + stock;
				}				
			}			
		}
		document.getElementById(customfield+'_stock').value = stockstr;
		document.getElementById(customfield).value = equationstr;
		document.getElementById(customfield+'_success_span').innerHTML = 'Success ...';
		
	}
		//-->
	</script>
  <?php
	wp_nonce_field( plugin_basename( __FILE__ ), $key . '_wpnonce', false, true );
	
	foreach($meta_boxes as $meta_box) {
	$data = get_post_meta($post->ID, $key, true);
	
	if($meta_box['type'] == 'seperator')
	{
	?>
   <a href="javascript:void(0);" title="Show/hide additional information" class="head"  onclick="show_hide_op('<?php echo str_replace(' ','',$meta_box[ 'title' ]); ?>')"> 
   <span class="pos plus" id="<?php echo str_replace(' ','',$meta_box[ 'title' ]); ?>_span">+</span> <?php echo $meta_box[ 'title' ]; ?></a>
   <div class="options-box" style="display:none" id="<?php echo str_replace(' ','',$meta_box[ 'title' ]); ?>">
    <?php	
	}
	elseif($meta_box['type'] == 'seperator_end')
	{
	?>
    </div>
    <?php	
	}
	elseif($meta_box['type'] == 'hidden')
	{
		if(htmlspecialchars($data[$meta_box['name']]) !='')
		{
			$productSpPrice = htmlspecialchars($data[$meta_box['name']]);
		}else
		{
			$productSpPrice = $meta_box['default'];
		}
	?>
    <input type="hidden" id="<?php echo $meta_box[ 'name' ]; ?>" name="<?php echo $meta_box[ 'name' ]; ?>" value="<?php echo $productSpPrice; ?>" tabindex="<?php echo $meta_box[ 'tabindex' ]; ?>" />
    <?php
	}
	else
	{
	
	?>
  <div class="form-field form-required" <?php if($meta_box['type'] == 'hidden'){ echo 'style="display:none;"';}?> >
  <label for="<?php echo $meta_box[ 'name' ]; ?>"  <?php if($meta_box['type'] == 'seperator'){ echo 'style="display:none;"';}?>><?php echo $meta_box[ 'title' ]; ?></label>
  <div class="f_content">
    <?php
	if($meta_box['type'] == '')
	{
		$meta_box['type'] = 'text'; //set default as textbox
	}
	if($meta_box['type'] == 'text')
	{
		if($data[$meta_box['name']] != '')
		{
			$productSpPrice = htmlspecialchars($data[$meta_box['name']]);
		}else
		{
			$productSpPrice = $meta_box['default'];
		}
	?>
    <input type="text" name="<?php echo $meta_box[ 'name' ]; ?>" value="<?php echo $productSpPrice; ?>" tabindex="<?php echo $meta_box[ 'tabindex' ]; ?>" />
    <?php
	}
	elseif($meta_box['type'] == 'button')
	{
	?>
    <input type="submit" value="Update" accesskey="p" tabindex="5" id="publish" class="button-primary" name="save">
    <?php	
	}
	if($meta_box['type'] == 'date')
	{
		if(htmlspecialchars($data[$meta_box['name']]))
		{
			$productSpPrice = htmlspecialchars($data[$meta_box['name']]);
		}else
		{
			$productSpPrice = $meta_box['default'];
		}
		
	?>
    <input type="text" name="<?php echo $meta_box[ 'name' ]; ?>"  id="<?php echo $meta_box[ 'name' ]; ?>" value="<?php echo $productSpPrice; ?>" style="width:100px;" tabindex="<?php echo $meta_box[ 'tabindex' ]; ?>" />
    &nbsp;<img src="<?php echo bloginfo('template_directory');?>/images/cal.gif" alt="Calendar" onclick="displayCalendar(document.post.<?php echo $meta_box[ 'name' ]; ?>,'yyyy-mm-dd',this)" style="cursor: pointer;" align="absmiddle" border="0">
    <?php
	}
	elseif($meta_box['type'] == 'textarea')
	{
	?>
    <textarea tabindex="<?php echo $meta_box[ 'tabindex' ]; ?>"  name="<?php echo $meta_box[ 'name' ]; ?>"  id="<?php echo $meta_box[ 'name' ]; ?>"><?php echo htmlspecialchars( $data[ $meta_box[ 'name' ] ] ); ?></textarea>
    <?php	
	}
	elseif($meta_box['type'] == 'multi-select' || $meta_box['type'] == 'single-select')
	{
		if($meta_box['default'])
		{
			$data[ $meta_box[ 'name' ]] = array('id'=>$meta_box['default'],'val'=>'All Taxes',);
		}
		if(!$data[ $meta_box[ 'name' ]])
		{
			foreach($meta_box['values'] as $id=>$text)
			{
				$data[ $meta_box[ 'name' ]] = array('id'=>$id,'val'=>$text);	
				break;
			}
		}
	?>
        <select tabindex="<?php echo $meta_box[ 'tabindex' ]; ?>"  name="<?php echo $meta_box[ 'name' ]; ?>[]"  id="<?php echo $meta_box[ 'name' ]; ?>" <?php if($meta_box['type'] == 'multi-select'){echo ' multiple="multiple" style="height:50px; padding:5px;"';}?>>
        <?php
		if(!$data[ $meta_box[ 'name' ]])
		{
			$data[ $meta_box[ 'name' ]] = array('id'=>'all','val'=>'All Taxes',);	
		}elseif($meta_box['default'])
		{
			$data[ $meta_box[ 'name' ]] = array('id'=>$meta_box['default'],'val'=>'All Taxes',);
		}
		foreach($meta_box['values'] as $id=>$text)
		{
		?>
			<option value="<?php echo $text['id'];?>" <?php if(in_array($text['id'],$data[ $meta_box[ 'name' ]])){ echo 'selected="selected"';}?> ><?php echo $text['val'];?></option>
		<?php		
		}
		?>
        </select>
        <?php
	}
	elseif($meta_box['type'] == 'select')
	{
	?>
    <input type="hidden" id="<?php echo $meta_box[ 'name' ]; ?>" name="<?php echo $meta_box[ 'name' ]; ?>" value="<?php echo htmlspecialchars($data[$meta_box['name']]); ?>" style="width:70%;"  tabindex="<?php echo $meta_box[ 'tabindex' ]; ?>" />
	<div id="<?php echo $meta_box[ 'name' ]; ?>_div"></div>
    <input name="<?php echo $meta_box[ 'name' ]; ?>Id" id="<?php echo $meta_box[ 'name' ]; ?>Id" value="" type="hidden">
    <input name="<?php echo $meta_box[ 'name' ]; ?>Title" id="<?php echo $meta_box[ 'name' ]; ?>Title" value="" type="hidden">
    <input value="1" name="<?php echo $meta_box[ 'name' ]; ?>Count" id="<?php echo $meta_box[ 'name' ]; ?>Count" type="hidden">
   
    <div class="clear" >
    <a href="javascript:void(0)" class="smallLink" onClick="<?php echo $meta_box[ 'name' ]; ?>customClick('<?php echo $meta_box[ 'name' ]; ?>','','','');">
    <input class="button_n" type="button" tabindex="2" name="AddNew" value="Add New" style="width:auto;" />
    </a>&nbsp;
    <input class="button_n" type="button" tabindex="2" name="save" value="Set Changes" style="width:auto;" onclick="custom_evaluate('<?php echo $meta_box[ 'name' ]; ?>');" />
    </div>
    <span id="<?php echo $meta_box[ 'name' ]; ?>_success_span"></span>
    <?php
        $custom_evalstr .= "custom_evaluate('".$meta_box[ 'name' ]."'); ";
		?>
    <script>
       	<?php echo $meta_box[ 'name' ]; ?>Row = 1;
		function <?php echo $meta_box[ 'name' ]; ?>customClick(customfield,nameval,signval,priceval,stockval)
		{
			<?php echo $meta_box[ 'name' ]; ?>Row++;
		
			var email_div = customfield+'_div';
			var emailDiv=document.getElementById(email_div);
			var newDiv=document.createElement('div');
			newDiv.setAttribute('id',email_div+<?php echo $meta_box[ 'name' ]; ?>Row);
			newDiv.setAttribute('style','margin-top:5px');
			var newTextBox=document.createElement('input');
			
			newTextBox.type='text';
			newTextBox.setAttribute('id',customfield+'_name'+<?php echo $meta_box[ 'name' ]; ?>Row);
			newTextBox.setAttribute('name',customfield+'_name'+<?php echo $meta_box[ 'name' ]; ?>Row);
			newTextBox.setAttribute('class','textbox');
			newTextBox.setAttribute('size','15');
			newTextBox.setAttribute('maxlength','50');
			newTextBox.setAttribute('tabindex','2');
			newTextBox.setAttribute('style','width:auto');
			if(nameval){newTextBox.setAttribute('value',nameval);}else{newTextBox.setAttribute('value',customfield);}			
			newTextBox.setAttribute("onblur","if(this.value=='') this.value = '"+customfield+"';");
			newTextBox.setAttribute("onfocus","if(this.value=='"+customfield+"') this.value= '';");
			
			var newTextBox2=document.createElement('input');			
			newTextBox2.type='text';
			newTextBox2.setAttribute('id',customfield+'_price'+<?php echo $meta_box[ 'name' ]; ?>Row);
			newTextBox2.setAttribute('name',customfield+'_price'+<?php echo $meta_box[ 'name' ]; ?>Row);
			newTextBox2.setAttribute('class','textbox');
			newTextBox2.setAttribute('size','15');
			newTextBox2.setAttribute('maxlength','50');
			newTextBox2.setAttribute('tabindex','2');
			newTextBox2.setAttribute('style','width:auto');
			if(priceval){newTextBox2.setAttribute('value',priceval);}else{newTextBox2.setAttribute('value','price');};
			
			newTextBox2.setAttribute("onblur","if(this.value=='') this.value = 'price';");
			newTextBox2.setAttribute("onfocus","if(this.value=='price') this.value= '';");
			
			var newTextBox3=document.createElement('input');
			newTextBox3.type='text';
			newTextBox3.setAttribute('id',customfield+'_stock'+<?php echo $meta_box[ 'name' ]; ?>Row);
			newTextBox3.setAttribute('name',customfield+'_price'+<?php echo $meta_box[ 'name' ]; ?>Row);
			newTextBox3.setAttribute('class','textbox');
			newTextBox3.setAttribute('size','15');
			newTextBox3.setAttribute('maxlength','50');
			newTextBox3.setAttribute('tabindex','2');
			newTextBox3.setAttribute('style','width:auto');
			if(stockval){newTextBox3.setAttribute('value',stockval);}else{newTextBox3.setAttribute('value','');};
			
			
			comboNameArr = new Array('+','-');
			comboValueArr = new Array('+','-');
			
			var newComboBox = document.createElement('select');
			newComboBox.name = customfield+'_amsym'+<?php echo $meta_box[ 'name' ]; ?>Row;
			newComboBox.setAttribute('id',customfield+'_amsym'+<?php echo $meta_box[ 'name' ]; ?>Row);
			newComboBox.setAttribute('tabindex','2');
			newComboBox.setAttribute('class','textbox');
			
			for(i=0;i<comboNameArr.length;i++)
			{
				comboOptions = document.createElement('option');
				
				comboOptions.text = comboNameArr[i];
				comboOptions.value = comboValueArr[i];
				if(comboValueArr[i] == signval)
				{
					comboOptions.setAttribute('selected','selected');
				}
				newComboBox.appendChild(comboOptions);
			}
			
			nameStr = document.getElementById(customfield+'Title').value;
			valueStr = document.getElementById(customfield+'Id').value;
			
			if(nameStr!="" && valueStr!="")
			{
				comboNameArr1 = nameStr.split(",");
				comboValueArr1 = valueStr.split(",");
				
				for(j=0;j<comboNameArr1.length;j++)
				{
					comboOptions = document.createElement('option');
				
					comboOptions.text = comboNameArr1[j];
					comboOptions.value = comboValueArr1[j];
					//newComboBox.appendChild(comboOptions);
					try {
					newComboBox.add(comboOptions, null); //Standard
					}catch(error) {
					newComboBox.add(comboOptions); // IE only
					}
				}
			}	
			
			var newLink = document.createElement('a');
			newLink.setAttribute('class','smallLink');
			newLink.setAttribute('href','javascript:void(0)');
			newLink.setAttribute('tabindex','2');
			
			document.getElementById('<?php echo $meta_box[ 'name' ]; ?>Count').value = <?php echo $meta_box[ 'name' ]; ?>Row;
			
			var linkText=document.createTextNode('Remove');
			newLink.appendChild(linkText);
			newLink.onclick=function RemoveEntry() { var imDiv=document.getElementById(email_div);
		
			emailDiv.removeChild(this.parentNode);	
			}
		
			newDiv.appendChild(newTextBox);
			newDiv.appendChild(document.createTextNode('\u00A0\u00A0\u0040\u00A0\u00A0'));
			newDiv.appendChild(newComboBox);
			newDiv.appendChild(document.createTextNode('\u00A0\u00A0\u00A0'));
			newDiv.appendChild(newTextBox2);
			newDiv.appendChild(document.createTextNode('\u00A0\u00A0'));
			newDiv.appendChild(document.createTextNode('\u00A0\u0053\u0074\u006F\u0063\u006B\u00A0'));
			newDiv.appendChild(newTextBox3);
			newDiv.appendChild(newLink);
			emailDiv.appendChild(newDiv);
		}
       <?php
	   	$customValue = htmlspecialchars($data[$meta_box['name']]);
      	$customValueArr = explode(',',$customValue);
		if($customValueArr)
		{
			for($i=0;$i<count($customValueArr);$i++)
			{
				$counter = $i+2;
				$name = html_entity_decode(preg_replace('/([(])([+-]+)(.*)/','',$customValueArr[$i]));
				preg_match('/([+-])/', $customValueArr[$i], $match2);
				$symbol = $match2[0];
				preg_match('/([+-])(.*)/', $customValueArr[$i], $match3);
				$price = substr($match3[0],1,strlen($match3[0])-2);
			
			$stock_customValue = htmlspecialchars($data[$meta_box['name'].'_stock']);
			
			$stock = '';
			$stock_customValue = substr($stock_customValue,1,strlen($stock_customValue));
			$stock_val_arr = explode(',',$stock_customValue);
			$stock = $stock_val_arr[$i];
			?>
			<?php echo $meta_box[ 'name' ]; ?>customClick('<?php echo $meta_box[ 'name' ]; ?>','<?php echo $name;?>','<?php echo $symbol;?>','<?php echo $price;?>','<?php echo $stock;?>');
			<?php 
			}
		}
		?>
	    </script>
    <?php
	}elseif($meta_box['type'] == 'checkbox')
	{
		if(htmlspecialchars($data[$meta_box['name']]) == 'on') { $checked = 'checked="checked"';} else {$checked='';}
	?>
    <input type="checkbox" class="checkbox" name="<?php echo $meta_box[ 'name' ]; ?>" <?php echo $checked; ?> style="width:auto" tabindex="<?php echo $meta_box[ 'tabindex' ]; ?>"  />
    <?php
	}elseif($meta_box['type'] == 'radio')
	{
	
	}elseif($meta_box['type'] == 'file')
	{
		if($meta_box['name']=='digital_product')
		{
			$productSpPrice =  $data[$meta_box['name']];
	?>
    <input type="text" name="<?php echo $meta_box[ 'name' ]; ?>" value="<?php echo $productSpPrice; ?>" tabindex="<?php echo $meta_box[ 'tabindex' ]; ?>" />
     <a title="Add an Image" class="thickbox button" id="add_image" href="media-upload.php?post_id=<?php echo $post->ID?>&amp;type=image&amp;TB_iframe=1&amp;width=640&amp;height=393"><?php _e('Select Digital Product to Upload');?></a>
    <?php		
		}else
		{
		?>
        <p>
         <a title="Add an Image" class="thickbox button" id="add_image" href="media-upload.php?post_id=<?php echo $post->ID?>&amp;type=image&amp;TB_iframe=1&amp;width=640&amp;height=393"><?php _e('Select Image to Upload');?></a></p>
        <?php	
		}
	?>
       
        
     <?php
	 if($meta_box['name']=='productimage')
	 {
    global $Product; 
	$product_images = $Product->get_product_image($post,$img_size='thumb',1);
	if($product_images)
	{
	?>
   <div class="clearfix" style="clear:both;">
    <?php 
	for($im=0;$im<count($product_images);$im++)
	{
		$ext_arr = explode('.',$product_images[$im][0]);
		$fileext = strtolower($ext_arr[count($ext_arr)-1]);
		if(in_array($fileext,array('jpg','jpeg','gif','png')))
		{
		?>
        <style type="text/css"> 
		.prd_img { float:left; display:block; margin:5px 13px 13px 0; border:1px solid #ccc; padding:4px; position:relative; }
		.prd_img a { display:block; position:absolute; left:0; bottom:0; width:82px; text-align:center; padding:3px; background:#000; color:#fff; text-decoration:none;  }
		.prd_img a:hover { background:#666; }
        </style>
        <div class="prd_img" id="div_<?php echo $product_images[$im]['id'];?>">
        <img src="<?php echo $product_images[$im][0];?>" width="80"  />
        <a href="javascript:void(0);deleteimg('<?php echo $product_images[$im]['id'];?>')"><?php _e('Remove');?></a>
        </div>
        <?php		
		}
	?>    
    <?php }	?>
    <script language="javascript">
    function deleteimg(imgid)
	{
		document.getElementById('div_'+imgid).style.display='none';
		clientSideInclude(imgid);
	}

function clientSideInclude(imgid) {
   var req = false;
  // For Safari, Firefox, and other non-MS browsers
  if (window.XMLHttpRequest) {
    try {
      req = new XMLHttpRequest();
    } catch (e) {
      req = false;
    }
  } else if (window.ActiveXObject) {
    // For Internet Explorer on Windows
    try {
      req = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
      try {
        req = new ActiveXObject("Microsoft.XMLHTTP");
      } catch (e) {
        req = false;
      }
    }
  }
  if (req) {
	  url = "<?php echo site_url('/?prdattid=')?>"+imgid;
    req.open('GET', url, false);
    req.send(null);
  }  
 }

  

</script>


    </div>
    <?php } }?>
    <?php
	}
	?>
   <p class="clearfix"><?php echo $meta_box['description'];?></p>
    </div>
   
  </div>

  <?php } } ?>
</div></div>
<script type="text/javascript">
function show_hide_op(element_id)
{
	element_id_sp = element_id+'_span';
	if(document.getElementById(element_id).style.display)
	{
		document.getElementById(element_id).style.display = '';
		document.getElementById(element_id_sp).innerHTML = '<span class="minus"></span>';
	}else
	{
		document.getElementById(element_id).style.display = 'none';	
		document.getElementById(element_id_sp).innerHTML = '+';
	}
}
</script>
<?php
	}
	
	function save_meta_box( $post_id ) {
	global $post, $meta_boxes, $key;
	
	foreach( $meta_boxes as $meta_box ) {
	$data[ $meta_box[ 'name' ] ] = $_POST[ $meta_box[ 'name' ] ];
	}
	
	if ( !wp_verify_nonce( $_POST[ $key . '_wpnonce' ], plugin_basename(__FILE__) ) )
	return $post_id;
	
	if ( !current_user_can( 'edit_post', $post_id ))
	return $post_id;
	
	update_post_meta( $post_id, $key, $data );
	}
	
	add_action( 'admin_menu', 'create_meta_box' );
	add_action( 'save_post', 'save_meta_box' );
}

////////////post listing field changes start ////////////////////
	add_action('load-edit.php', 'filtering');
	
	
	function filtering() {
		add_filter('posts_where', 'product_filter_join');
		add_action('restrict_manage_posts', 'search_manage_posts');
	}
	
	function product_filter_join($join) {
		global $wpdb;
		$blogCategoryIdStr = get_inc_categories("cat_exclude_");
		$blogCategoryIdStr_arr = explode(',',$blogCategoryIdStr);
		for($i=0;$i<count($blogCategoryIdStr_arr);$i++)
		{
			if($blogCategoryIdStr_arr[$i])
			{
				$blogCategoryIdStr_arr1[] = $blogCategoryIdStr_arr[$i];
			}
		}
		if($blogCategoryIdStr_arr1)
		{
			$blogCategoryIdStr = implode(',',$blogCategoryIdStr_arr1);	
		}
		$blog_posts='';

		$blog_posts = $wpdb->get_var("SELECT group_concat(tr.object_id) FROM $wpdb->term_taxonomy tt join $wpdb->term_relationships tr on tr.term_taxonomy_id=tt.term_taxonomy_id where tt.term_id in ($blogCategoryIdStr)");
		if( $_REQUEST['ptype'] == 'prd' && $blog_posts!='') {
			$join .= " and $wpdb->posts.ID not in ($blog_posts)";
		} 
		return $join;
	}
	
	function search_manage_posts() {
		?>
<select name='ptype' id='ptype' class='postform'>
  <option value="0">
  <?php _e('View all posts and products') ?>
  </option>
  <option value="prd" <?php if( isset($_GET['ptype']) && $_GET['ptype']=='prd') echo 'selected="selected"' ?>>
  <?php _e('View only products'); ?>
  </option>
</select>
<?php 
	} 


add_filter('manage_posts_columns', 'product_custom_columns');
function product_custom_columns($defaults)
{  //lets remove some un-needed columns if it's a post
	if($_GET['ptype']=='prd')
	{
		global $General;
		unset($defaults['date']);
		unset($defaults['comments']);
		unset($defaults['author']);
		unset($defaults['tags']);
		$defaults['price'] = __('Price').'('.$General->get_currency_symbol().')';
		$defaults['istaxable'] = __('Is Taxable');
		$defaults['initstock'] = __('Stock');
		$defaults['pli'] = __('Main Image');
		if($General->is_storetype_digital())
		{
			$defaults['digprd'] = __('Digital Product');
		}
		$defaults['thumbs'] = __('Thumbnails');
	}else
	{
		 $defaults['isproduct'] = __('Is Product');  //ad the product column to the normal post lists
	}
	return $defaults;
}
add_action('manage_posts_custom_column', 'custom_column', 10, 2);
function custom_column($column_name, $post_id)
{   //defines what goes in the new columns
	global $wpdb,$General;
	$data = get_post_meta( $post_id, 'key', true );
	if( $column_name == 'isproduct' )
	{
		if(is_product($post_id))
		{
			echo "<center><font style=\"color:#006600;\"> ".__('Yes')."</font></center>";
		}else
		{
			echo "<center><font style=\"\"> ".__('No')."</font></center>";
		}
	}
	if( $column_name == 'price' )
	{
		echo $General->get_amount_format($data['price']);
	}
	if( $column_name == 'istaxable' )
	{
		if($data['istaxable']!='')
		{
			echo "<font style=\"color:#006600;\">  ".__('Yes')."</font>";
		}else
		{
			echo "<font style=\"\">  ".__('No')."</font>";
		}
	}
	if( $column_name == 'initstock' )
	{
		if($data['initstock']=='')
		{
			echo "Unlimited";
		}elseif($data['initstock']=='0')
		{
			echo "Out of Stock";
		}else
		{
			echo $General->product_current_orders_count($post_id).'/'.number_format($data['initstock']);
		}
	}
	if( $column_name == 'pli' )
	{
		if($data['productimage'])
		{
			echo "<a href=\"".$data['productimage']."\" target=_blank title=\"View Large Image\" ><font style=\"color:#006600;\"> ".__('Yes')."</font></a>";
		}else
		{
			echo "<center><font style=\"\"> ".__('No')."</font>";
		}
	}
	if($General->is_storetype_digital())
	{
		if( $column_name == 'digprd' )
		{
			if($data['digital_product'])
			{
				echo "<a href=\"".$data['digital_product']."\" target=_blank title=\"Download/Check Product\" ><font style=\"color:#006600;\"> ".__('Yes')."</font></a>";
			}else
			{
				echo "<font style=\"\"> ".__('No')."</font>";
			}
		}
	}
	if( $column_name == 'thumbs' )
	{
		if($data['productimage1'])
		{
			echo "<a href=\"".$data['productimage1']."\" target=_blank title=\"View Large Image\" ><font style=\"\"> IMG1 </font></a>";
		}else
		{
			//echo "<font style=\"color:#FF0000; font-weight:bold;\"> IMG1  </font>";
		}
		if($data['productimage2'])
		{
			echo "<a href=\"".$data['productimage2']."\" target=_blank title=\"View Large Image\" ><font style=\"\"> IMG2 </font></a>";
		}else
		{
			//echo "<font style=\"color:#FF0000; font-weight:bold;\"> IMG2  </font>";
		}
		if($data['productimage3'])
		{
			echo "<a href=\"".$data['productimage3']."\" target=_blank title=\"View Large Image\" ><font style=\"\"> IMG3 </font></a>";
		}else
		{
			//echo "<font style=\"color:#FF0000; font-weight:bold;\"> IMG3  </font>";
		}
		if($data['productimage4'])
		{
			echo "<a href=\"".$data['productimage4']."\" target=_blank title=\"View Large Image\" ><font style=\"\"> IMG4 </font></a>";
		}else
		{
			//echo "<font style=\"color:#FF0000; font-weight:bold;\" title=\"View Large Image\"> IMG4 </font>";
		}
		if($data['productimage5'])
		{
			echo "<a href=\"".$data['productimage5']."\" target=_blank ><font style=\"\"> IMG5 </font></a>";
		}else
		{
			//echo "<font style=\"color:#FF0000; font-weight:bold;\" title=\"View Large Image\"> IMG5</font>";
		}
	}
	 
	 $plugin_path = get_bloginfo('wpurl') . '/wp-content/plugins/' . dirname(plugin_basename(__FILE__)) . '/';
     if( $column_name == 'pli' ) { $title = "Main image not found. Edit product to insert.";}
     if( $column_name == 'thumbs' ) {$title = "Thumnail not found. Edit product to insert.";}
     $error = ' <img src="'.$plugin_path.'imgs/error.png" title="'.$title.'"/>';
   
}
////////////post listing field changes end ////////////////////
////////////DASHBOARD CUSTOM WIDGETS START/////
/**
 * Content of Dashboard-Widget
 */
function my_shoppingcart_summary() 
{
	global $General;
	$orderInfoArr = $General->get_total_orders();
	$currentMonthOrders = $orderInfoArr[0];
	$AllOrders = $orderInfoArr[1];
	$totalOrders = 0;
	$totalOrders_currenmonth = 0;
	$processingOrders_currentmonth = count($currentMonthOrders['processing']);
	$processingOrders = count($AllOrders['processing']);
	$approveOrders_currentmonth = count($currentMonthOrders['approve']);
	$approveOrders = count($AllOrders['approve']);
	$rejectOrders_currentmonth = count($currentMonthOrders['reject']);
	$rejectOrders = count($AllOrders['reject']);
	$cancelOrders_currentmonth = count($currentMonthOrders['cancel']);
	$cancelOrders = count($AllOrders['cancel']);
	$shippingOrders_currentmonth = count($currentMonthOrders['shipping']);
	$shippingOrders = count($AllOrders['shipping']);
	$deliveredOrders_currentmonth = count($currentMonthOrders['delivered']);
	$deliveredOrders = count($AllOrders['delivered']);
	foreach($currentMonthOrders as $key=>$value)
	{
		$totalOrders = $totalOrders + count($currentMonthOrders[$key]);
	}
	foreach($AllOrders as $key1=>$value1)
	{
		$totalOrders_currenmonth = $totalOrders_currenmonth + count($AllOrders[$key1]);
	}
	$currentmonth = date('m');
	
?>
<table border="0" cellspacing="8" cellpadding="0">
  <tr>
    <td width="140">&nbsp;</td>
    <td width="110" align="center"><strong><?php _e('Current  Month');?> </strong></td>
    <td width="90" align="center"><strong><?php _e('Up to Date');?></strong></td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td width="25%"><?php _e('Products');?></td>
    <td align="center"><a href="<?php echo site_url("/wp-admin/edit.php?ptype=prd&month=$currentmonth");?>"><?php echo $General->get_total_products(date('m'));?></a></td>
    <td align="center"><a href="<?php echo site_url("/wp-admin/edit.php?ptype=prd");?>"><?php echo $General->get_total_products();?></a></td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td width="25%"><?php _e('Total Orders');?></td>
    <td align="center"><?php if($totalOrders){?>
      <a href="<?php echo site_url("/wp-admin/admin.php?ptype=manageorders&month=$currentmonth");?>">
      <?php }?>
      <?php echo $totalOrders;?>
      <?php if($totalOrders){?>
      </a>
      <?php }?></td>
    <td align="center"><?php if($totalOrders_currenmonth){?>
      <a href="<?php echo site_url("/wp-admin/admin.php?ptype=manageorders");?>">
      <?php }?>
      <?php echo $totalOrders_currenmonth;?>
      <?php if($totalOrders_currenmonth){?>
      </a>
      <?php }?></td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td width="25%"><?php _e('Processing Orders');?></td>
    <td align="center"><?php if($processingOrders_currentmonth){?>
      <a href="<?php echo site_url("/wp-admin/admin.php?ptype=manageorders&month=$currentmonth&srch_status=processing");?>">
      <?php }?>
      <?php echo $processingOrders_currentmonth;?>
      <?php if($processingOrders_currentmonth){?>
      </a>
      <?php }?></td>
    <td align="center"><?php if($processingOrders){?>
      <a href="<?php echo site_url("/wp-admin/admin.php?ptype=manageorders&srch_status=processing");?>">
      <?php }?>
      <?php echo $processingOrders;?>
      <?php if($processingOrders){?>
      </a>
      <?php }?></td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td width="25%">Approve Orders</td>
    <td align="center"><?php if($approveOrders_currentmonth){?>
      <a href="<?php echo site_url("/wp-admin/admin.php?ptype=manageorders&month=$currentmonth&srch_status=approve");?>">
      <?php }?>
      <?php echo $approveOrders_currentmonth;?>
      <?php if($approveOrders_currentmonth){?>
      </a>
      <?php }?></td>
    <td align="center"><?php if($approveOrders_currentmonth){?>
      <a href="<?php echo site_url("/wp-admin/admin.php?ptype=manageorders&srch_status=approve");?>">
      <?php }?>
      <?php echo $approveOrders;?>
      <?php if($approveOrders_currentmonth){?>
      </a>

      <?php }?></td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td width="25%">Rejected Orders</td>
    <td align="center"><?php if($rejectOrders_currentmonth){?>
      <a href="<?php echo site_url("/wp-admin/admin.php?ptype=manageorders&month=$currentmonth&srch_status=reject");?>">
      <?php }?>
      <?php echo $rejectOrders_currentmonth;?>
      <?php if($rejectOrders_currentmonth){?>
      </a>
      <?php }?></td>
    <td align="center"><?php if($rejectOrders){?>
      <a href="<?php echo site_url("/wp-admin/admin.php?ptype=manageorders&srch_status=reject");?>">
      <?php }?>
      <?php echo $rejectOrders;?>
      <?php if($rejectOrders){?>
      </a>
      <?php }?></td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td width="25%">Cancel Orders</td>
    <td align="center"><?php if($cancelOrders_currentmonth){?>
      <a href="<?php echo site_url("/wp-admin/admin.php?ptype=manageorders&month=$currentmonth&srch_status=cancel");?>">
      <?php }?>
      <?php echo $cancelOrders_currentmonth;?>
      <?php if($cancelOrders_currentmonth){?>
      </a>
      <?php }?></td>
    <td align="center"><?php if($cancelOrders){?>
      <a href="<?php echo site_url("/wp-admin/admin.php?ptype=manageorders&srch_status=cancel");?>">
      <?php }?>
      <?php echo $cancelOrders;?>
      <?php if($cancelOrders){?>
      </a>
      <?php }?></td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td width="25%">Shipping Orders</td>
    <td align="center"><?php if($shippingOrders_currentmonth){?>
      <a href="<?php echo site_url("/wp-admin/admin.php?ptype=manageorders&month=$currentmonth&srch_status=shipping");?>">
      <?php }?>
      <?php echo $shippingOrders_currentmonth;?>
      <?php if($shippingOrders_currentmonth){?>
      </a>
      <?php }?></td>
    <td align="center"><?php if($shippingOrders){?>
      <a href="<?php echo site_url("/wp-admin/admin.php?ptype=manageorders&srch_status=shipping");?>">
      <?php }?>
      <?php echo $shippingOrders;?>
      <?php if($shippingOrders){?>
      </a>
      <?php }?></td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td width="25%">Complete Orders</td>
    <td align="center"><?php if($deliveredOrders_currentmonth){?>
      <a href="<?php echo site_url("/wp-admin/admin.php?ptype=manageorders&month=$currentmonth&srch_status=delivered");?>">
      <?php }?>
      <?php echo $deliveredOrders_currentmonth;?>
      <?php if($deliveredOrders_currentmonth){?>
      </a>
      <?php }?></td>
    <td align="center"><?php if($deliveredOrders){?>
      <a href="<?php echo site_url("/wp-admin/admin.php?ptype=manageorders&srch_status=delivered");?>">
      <?php }?>
      <?php echo $deliveredOrders;?>
      <?php if($deliveredOrders){?>
      </a>
      <?php }?></td>
    <td align="center">&nbsp;</td>
  </tr>
</table>
<?php	
}
 function my_orders_summary()
 {
 	global $General,$ord_db_table_name,$wpdb;
	
	print_r($order_info);
	$dashboard_orders =$General->get_dashboard_display_orders();
	if(!is_int($dashboard_orders) || $dashboard_orders<0)
	{
		$dashboard_orders = 10;
	}
	$order_info = $wpdb->get_results("select * from $ord_db_table_name order by ord_date desc limit $dashboard_orders");
?>
<table width="100%" border="0" cellpadding="0" cellspacing="8" >
  <?php
if($order_info){
?>
  <tr>
    <td width="100" ><strong><?php _e('Order Number');?></strong></td>
    <td align="center" width="200" ><strong><?php _e('Date');?></strong></td>
    <td width="200"><strong><?php _e('Bill Amount');?></strong></td>
    <td ><strong><?php _e('Status');?></strong></td>
  </tr>
  <?php
foreach ($order_info as $order_info)
{
?>
  <tr>
    <td ><a href="<?php echo site_url('/wp-admin/admin.php?ptype=manageorders&oid='.$order_info->oid);?>"><?php echo $order_info->oid;?></a></td>
    <td align="center"><?php echo date('Y/m/d H:i',strtotime($order_info->ord_date));?></td>
    <td><?php echo $order_info->payable_amt;?></td>
    <td><?php _e($General->getOrderStatus($order_info->ostatus));?></td>
  </tr>
  <?php }}else{?>
  <tr>
    <td colspan="4"><BR />
      <BR />
      <BR />
      <strong><?php _e('Sorry, Not a single order is there');?></strong><BR />
      <BR />
      <BR /></td>
  </tr>
  <?php }?>
</table>
<?php
 }
/**
 * add Dashboard Widget via function wp_add_dashboard_widget()
 */
function my_wp_dashboard_setup() 
{
	global $General;
	wp_add_dashboard_widget( 'my_shoppingcart_summary', __( 'Shopping Cart Summary' ), 'my_shoppingcart_summary' );
	if($General->get_dashboard_display_orders() != '' || $General->get_dashboard_display_orders()>0)
	{
		wp_add_dashboard_widget( 'my_orders_summary', __( 'Latest Order List' ), 'my_orders_summary' );
	}
}
/**
 * use hook, to integrate new widget
 */
if ( current_user_can( 'edit_post', $post_id ))
{
	add_action('wp_dashboard_setup', 'my_wp_dashboard_setup');
}
///////////DASHBOARD CUSTOM WIDGETS END/////////

function get_taxes()
{
	global $wpdb,$tax_db_table_name;
	$tax_sql = "select * from $tax_db_table_name where tax_status=1";
	$tax_res = $wpdb->get_results($tax_sql);
	$return_arr = array();
	foreach($tax_res as $tax_res_obj)
	{
		$return_arr[] = array('id'=>$tax_res_obj->tax_id,'val'=>$tax_res_obj->tax_title.' ('.$tax_res_obj->tax_amount.' '.$tax_res_obj->amount_type.')');
	}
	return $return_arr;
}
function get_shippings()
{
	global $wpdb,$shippings_db_table_name;
	$shipping_sql = "select * from $shippings_db_table_name";
	$shippinginfo = $wpdb->get_results($shipping_sql);
	foreach($shippinginfo as $shippinginfo_obj)
	{
		$title = $shippinginfo_obj->title;
		$shipping_id = $shippinginfo_obj->shipping_id;
		$return_arr[] = array('id'=>$shipping_id,'val'=>$title);
	}
	return $return_arr;
}
?>