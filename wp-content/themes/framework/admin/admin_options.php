<?php
$options_child = $options;
$options = array();
$options[] = array(	"type" => "maintabletop");
    /// General Settings
	if(apply_filters('templ_design_generalsettings_opt',true))
	{
	$options[] = array(	"name" => "General Settings",
						   "toggle" => "true",
						"type" => "subheadingtop");
			
		 if(apply_filters('templ_design_skin_opt',true))
		 {
			if($alt_stylesheets)
			{
				$options[] = array(	
								   "name"	=> 'Theme Skin',
								   "desc" => __("Please select the CSS skin of your blog here."),
					                "id" => $shortname."_alt_stylesheet",
					                "std" => ("Select a CSS skin:"),
					                "type" => "select",
					                "options" => $alt_stylesheets);
						
			}
		 }
		if(apply_filters('templ_design_customcss_opt',true))
		 {
			$options[] = array("name"	=> 'Customize Your Design',	
								   "label" => __("Use Custom Stylesheet"),
						            "desc" => __("If you want to make custom design changes using CSS enable and <a href='".$customcssurl."'>edit custom.css file here</a>."),
						            "id" => $shortname."_customcss",
						            "std" => "false",
						            "type" => "checkbox");	
		 }
		 if(apply_filters('templ_design_fevicon_opt',true))
		 {
		 
				$options[] = array("name"	=> 'Favicon',		
								   "desc" => __("Paste the full URL for your favicon image here if you wish to show it in browser address bar. <a href='http://www.favicon.cc/'>Create one here</a>"),
						            "id" => $shortname."_favicon",
						            "std" => "",
						            "type" => "text");	
		 }
          if(apply_filters('templ_design_headerlogo_opt',true))
		 {
		 	 $options[] = array(	"name" => __("Header Logo Image Path"),
				                    "desc" => __("Paste the full URL to your logo image here. eg. : <b>http://mysite.com/images/logo.png</b>"),
						            "id" => $shortname."_logo_url",
						            "std" => "",
						            "type" => "text");
		 }
		if(apply_filters('templ_design_blogtitle_opt',true))
		 {
			$options[] = array(	"name" => __("Display Blog Title instead of Logo"),
				                    "desc" => __("This option will overwrite your logo selection above - You can <a href='". $generaloptionsurl . "'>change your settings here</a>"),
						            "label" => __("Display Blog Title and Tagline."),
						            "id" => $shortname."_show_blog_title",
						            "std" => "true",
						            "type" => "checkbox");		
		 }
		if(apply_filters('templ_design_feedid_opt',true))
		 {
			$options[] = array(	"name" => __("Syndication / Feed"),
								   "desc" => __("If you are using a service like Feedburner to manage your RSS feed, enter Feed ID here. If you'd prefer to use the default WordPress feed, simply leave this box blank. eg. : <b>templatic/eKPs</b>"),
					                "id" => $shortname."_feed_name",
					                "std" => "",
					                "type" => "text");
		 }
		 if(apply_filters('templ_design_feedurl_opt',true))
		 {
				$options[] = array(	"name" => __("Feed URL link"),
								   "desc" => __("If you are using a service like Feedburner to manage your RSS feed, enter full URL of your feed here. If you'd prefer to use the default WordPress feed, simply leave this box blank. eg. :<b>http://feeds2.feedburner.com/templatic</b>"),
					                "id" => $shortname."_feed_url",
					                "std" => "",
					                "type" => "text");
		 }
			$options[] = array("name" => "", 
							   "desc" => "",
			    		            "id" =>"",
			    		            "std" => "",
			    		            "type" => "savebutton");
			
			$options[] = array(	"type" => "subheadingbottom");
		
	}
			
    /// Header Navigation Settings												
	if(apply_filters('templ_design_headernavsettings_opt',true)){			
		$options[] = array(	"name" => __("Header Navigation Settings"),
						    "toggle" => "true",
							"type" => "subheadingtop");
		
		if(apply_filters('templ_design_storelink_opt',true))
		{
			$options[] = array("name" => __("Display Store Link?"),	
							   "label" => __("Wish to display Store Link?"),
								"desc" => __("Do you wish to display 'Store' link in Header Navigation? Select 'Show' to display else 'Hide'"),
								"id" => $shortname."_storelink_display",
								"std" => "Show",
								"type" => "select",
								"options" => array('Show','Hide'));
		}
		if(apply_filters('templ_design_bloglink_opt',true))
		{
			$options[] = array("name" =>__( "Display Blog Categories Link?"),	
							   "label" =>__( "Wish to display Blog Categories Link?"),
								"desc" => __("Do you wish to display 'Blog Categories' link in Header Navigation? Select 'Show' to display else 'Hide'"),
								"id" => $shortname."_blogcatheader_display",
								"std" => "Show",
								"type" => "select",
								"options" => array('Show','Hide'));
		}
		if(apply_filters('templ_design_pages_opt',true))
		{
			$options[] = array("name" => __("Display Pages?"),	
							   "label" => __("Wish to display Pages?"),
								"desc" => __("Do you wish to display 'Pages' in Header Navigation? Select 'Show' to display else 'Hide'."),
								"id" => $shortname."_pageheader_display",
								"std" => "Show",
								"type" => "select",
								"options" => array('Show','Hide'));
								
		}
		if(apply_filters('templ_design_excludepage_opt',true))
		{
			$options[] = array(	"name" => __("Exclude Pages from Header Menu"),
								"label" =>__( "Exclude Pages from Header Menu"),
								"desc" => __("Enter a comma-separated list of the <code>Page ID's</code> that you'd like to display in header (on the right). (ie. <code>1,2,3,4</code>)"),
								"id" => $shortname."_categories_id",
								"std" => "",
								"type" => "multihead");	
								
			$options = pages_exclude($options);
		}
		if(apply_filters('templ_design_cats_opt',true)){
			$options[] = array("name" => __("Display Categories?"),	
							   "label" => __("Display Categories?"),
								"desc" => __("Do you wish to display 'Categories' in Header Navigation? Select 'Show' to display else 'Hide'."),
								"id" => $shortname."_catheader_display",
								"std" => "",
								"type" => "select",
								"options" => array('Hide','Show'));
		}
			
			if(apply_filters('templ_design_menucat_opt',true)){
			$options[] = array("name" => __("Menu Category"),	
							   "label" => __("Header Navigation Select Menu Category"),
								"desc" => __("Select categories that you'd like to display on the right side in header. Press ctrl to select more than one."),
								"id" => $shortname."_categories_id",
								"std" => "",
								 "type" => "multiselect",
								"options"=> get_categories_array(),);	
			}
			if(apply_filters('templ_design_breadcrumb_opt',true)){
				$options[] = array("name" => __("Breadcrumbs Navigation"),	
								   "label" => __("Show breadcrumbs navigation bar"),
						            "desc" => "i.e. Home > Blog > Title - <a href='". $breadcrumbsurl . "'>Change options here</a>",
						            "id" => $shortname."_breadcrumbs",
						            "std" => "true",
						            "type" => "checkbox");	
			}
			$options[] = array("name" => "", 
							   "desc" => "",
			    		            "id" =>"",
			    		            "std" => "",
			    		            "type" => "savebutton");
			
			$options[] = array(	"type" => "subheadingbottom");
	}
			
						
	/// Footer Navigation Settings												
			if(apply_filters('templ_design_footernavsettings_opt',true)){	
			$options[] = array(	"name" => __("Footer Navigation Settings"),
						        "toggle" => "true",
								"type" => "subheadingtop");
						
			if(apply_filters('templ_design_footerpages_opt',true)){
			$options[] = array(		"name" => __("Footer Navigation"),
							   		"label" => __("Show breadcrumbs navigation bar"),
                	                "desc" => __("Select categories that you'd like to display on the right side in footer. Press ctrl to select more than one."),
						            "id" => $shortname."_footerpages",
						            "std" => "",
						             "type" => "multiselect",
								"options"=> get_pages_array());	
			}
			$options[] = array("name" => "", 
							   "desc" => "",
			    		            "id" =>"",
			    		            "std" => "",
			    		            "type" => "savebutton");
			
			$options[] = array(	"type" => "subheadingbottom");
			}			
		
    /////////////////////////end///////////
													
//cufon font settings------------------------------
			 if(apply_filters('templ_design_cufonsettings_opt',true)){
			 $options[] = array(	"name" => "Cufon Settings",
						   "toggle" => "true",
						"type" => "subheadingtop");
				$options[] = array("name"	=> __('Cufon Fonts'),	
								   "label" => __("Enable cufon style being used for titles?"),
						            "desc" => __("This theme uses Rockwell fonts for headings in the site. You can disable this if you wish to."),
						            "id" => $shortname."_cufon_flag",
						            "std" => "false",
						            "type" => "checkbox");	
            $options[] = array("name" => "", 
							   "desc" => "",
			    		            "id" =>"",
			    		            "std" => "",
			    		            "type" => "savebutton");
			
			$options[] = array(	"type" => "subheadingbottom");
			 }
	//cufon font settings------------------------------
			 if(apply_filters('templ_design_captchasettings_opt',true)){
			 $options[] = array(	"name" => "Captcha Settings",
						   "toggle" => "true",
						"type" => "subheadingtop");
				$options[] = array("name"	=> __('Captcha on registration page'),	
								   "label" => __("Disable captcha on registration page?"),
						            "desc" => __("If you want to disable captcha on registration page, select the option."),
						            "id" => $shortname."_captcha_flag",
						            "std" => "false",
						            "type" => "checkbox");	
            $options[] = array("name" => "", 
							   "desc" => "",
			    		            "id" =>"",
			    		            "std" => "",
			    		            "type" => "savebutton");
			
			$options[] = array(	"type" => "subheadingbottom");
			} 
			
			$options[] = array(	"type" => "maintabletop");
		

//check out commet settings------------------------------
if(apply_filters('templ_design_checkoutsettings_opt',true)){
	$options[] = array(	"name" => "Checkout",
						   "toggle" => "true",
						"type" => "subheadingtop");
				$options[] = array("name"	=> __('Comment on checkout page'),	
								   "label" => __("Enable comment on checkout page?"),
						            "desc" => __("If you want to enable comment on checkout page, select the option."),
						            "id" => $shortname."_order_add_comment_flag",
						            "std" => "false",
						            "type" => "checkbox");	
            $options[] = array("name" => "", 
							   "desc" => "",
			    		            "id" =>"",
			    		            "std" => "",
			    		            "type" => "savebutton");
			
			$options[] = array(	"type" => "subheadingbottom");
}
$options[] = array(	"type" => "maintabletop");
			

//product listing settings
if(apply_filters('templ_design_storesettings_opt',true)){
	$options[] = array(	"name" => __("Products Listing Settings -> For 'Store' or 'All Products' Page"),
						 "toggle" => "true",
							"type" => "subheadingtop");
		
	if(apply_filters('templ_design_storelistformat_opt',true)){
	$options[] = array("name" => __("Listing Format on 'Store' or 'All Products' Page"),	
					   "desc" => __("Display product listing either grid or normat listing format on 'Store' or 'All Products' Page"),
							"id" => $shortname."_prd_listing_format",
							"std" => "grid",
							"type" => "select",
							"options" => array('grid','list'));
	}
	if(apply_filters('templ_design_storeposts_opt',true)){
	$options[] = array("name" => __("Number of Products"),
					   "desc" => __("Display number of products on Store or All Products Page. The Number is for per page Products number."),
						"id" => $shortname."_storeprd_number",
						"std" => "16",
						"type" => "text",
						);
	}
	if(apply_filters('templ_design_storeistitle_opt',true)){
	$options[] = array("name" => __("Display Title?"),	
					   "label" => __("Check mark if you wish to display Product Title. Other related options will be effected only if this option is checked."),
						"desc" => "",
						"id" => $shortname."_prdlisttitle_showhide",
						"std" => "true",
						"type" => "checkbox");
	}
	if(apply_filters('templ_design_storetitleorder_opt',true)){
	$options[] = array(	"name" => __("Title Display order"),
						"desc" => "",
						"id" => $shortname."_prdlisttitle_order",
						"std" => "1",
						"type" => "select",
						"options" => array('1','2','3','4','5'));
	}
	if(apply_filters('templ_design_storeisimg_opt',true)){
	$options[] = array("name" => __("Display Image?"),
					   "label" =>__( "Check mark if you wish to display Product Image. Other related options will be effected only if this option is checked."),
						"desc" => "",
						"id" => $shortname."_prdlistimage_showhide",
						"std" => "true",
						"type" => "checkbox");
	}
	if(apply_filters('templ_design_storeimgorder_opt',true)){
	$options[] = array(	"name" => __("Image Display Order"),
						"desc" => "",
						"id" => $shortname."_prdlistimage_order",
						"std" => "",
						"type" => "select",
						"options" => array('1','2','3','4','5'));
	}
	if(apply_filters('templ_design_storeimgborder_opt',true)){
	$options[] = array("name" => __("Set Image Border?"),	
					   "label" => __("Check mark if wish to set image border."),
						"desc" => "",
						"id" => $shortname."_prdlistimage_border",
						"std" => "true",
						"type" => "checkbox");
	}
	if(apply_filters('templ_design_storeisprice_opt',true)){
	$options[] = array("name" => __("Display Price?"),	
					   "label" => __("Check mark if you wish to display Product Price. Other related options will be effected only if this option is checked."),
						"desc" => "",
						"id" => $shortname."_prdlistprice_showhide",
						"std" => "true",
						"type" => "checkbox");
	}
	if(apply_filters('templ_design_storepriceorder_opt',true)){
	$options[] = array(	"name" => __("Price Display order"),
						"desc" => "",
						"id" => $shortname."_prdlistprice_order",
						"std" => "",
						"type" => "select",
						"options" => array('1','2','3','4','5'));
	}
	if(apply_filters('templ_design_storeisdesc_opt',true)){
	$options[] = array("name" => __("Display Description?"),	
					   "label" => __("Check mark if you wish to display Product Description. Note that product description will only appear in listing view and not in grid view. Other related options will be effected only if this option is checked."),
						"desc" => "",
						"id" => $shortname."_prdlistcontent_showhide",
						"std" => "true",
						"type" => "checkbox");
	}
	if(apply_filters('templ_design_storedescorder_opt',true)){
	$options[] = array(	"name" => __("Description Display order"),
						"desc" => "",
						"id" => $shortname."_prdlistcontent_order",
						"std" => "",
						"type" => "select",
						"options" => array('1','2','3','4','5'));
	}
	if(apply_filters('templ_design_storeisbutton_opt',true)){
	$options[] = array("name" => __("Display View Button?"),		
					   "label" => __("Check mark if you wish to display Product View Button. Note that View button will only appear in listing view and not in gird view. Other related options will be effected only if this option is checked."),
						"desc" => "",
						"id" => $shortname."_prdlistbutton_showhide",
						"std" => "true",
						"type" => "checkbox");
	}
	if(apply_filters('templ_design_storebuttonorder_opt',true)){
	$options[] = array(	"name" => __("View Button Display order"),
						"desc" => "",
						"id" => $shortname."_prdlistbutton_order",
						"std" => "",
						"type" => "select",
						"options" => array('1','2','3','4','5'));
	}
	$options[] = array("name" => "", 
							   "desc" => "",
			    		            "id" =>"",
			    		            "std" => "",
			    		            "type" => "savebutton");
	
	$options[] = array(	"type" => "subheadingbottom");
}
if(apply_filters('templ_design_catsettigns_opt',true)){
	$options[] = array(	"name" => __("Products Listing Settings -> For 'Archive' or 'Category' Page"),
							"toggle" => "true",
							"type" => "subheadingtop");
	
	if(apply_filters('templ_design_catlistformat_opt',true)){	
	$options[] = array("name" => __("Listing Format"),		
					   "desc" => __("Display product listing either grid or normat listing format on 'Archive' or 'Category' Page"),
						"id" => $shortname."_prd_listing_format_cat",
						"std" => "grid",
						"type" => "select",
						"options" => array('grid','list'));
	}
	if(apply_filters('templ_design_catpostnumber_opt',true)){
	$options[] = array("name" => __("Number of Products"),
					   "desc" => __("Display number of products on Category or Archive Page. The Number is for per page Products number."),
						"std" => "12",
						"id" => "posts_per_page",
						"std" => "true",
						"type" => "text");
	}
	if(apply_filters('templ_design_catistitle_opt',true)){
	$options[] = array("name" => __("Display Title?"),		
					   "label" => __("Check mark if you wish to display Product Title. Other related options will be effected only if this option is checked."),
						"desc" => "",
						"id" => $shortname."_prdlstcattitle_showhide",
						"std" => "true",
						"type" => "checkbox");
	}
	if(apply_filters('templ_design_cattitleorder_opt',true)){
	$options[] = array(	"name" => __("Title Display Order"),
						"desc" => "",
						"id" => $shortname."_prdlstcattitle_order",
						"std" => "1",
						"type" => "select",
						"options" => array('1','2','3','4','5'));
	}
	if(apply_filters('templ_design_catisimg_opt',true)){
	$options[] = array("name" => __("Display Image?"),	
					   "label" => __("Check mark if you wish to display Product Image. Other related options will be effected only if this option is checked."),
						"desc" => "",
						"id" => $shortname."_prdlstcatimage_showhide",
						"std" => "true",
						"type" => "checkbox");
	}
	if(apply_filters('templ_design_catimgorder_opt',true)){
	$options[] = array(	"name" => __("Image Display Order"),
						"desc" => "",
						"id" => $shortname."_prdlstcatimage_order",
						"std" => "",
						"type" => "select",
						"options" => array('1','2','3','4','5'));
	}
	if(apply_filters('templ_design_catimgborder_opt',true)){
	$options[] = array("name" => __("Set Image Border?"),
					   "label" => __("Please check mark if you wish to set image border in listing."),
						"desc" => "",
						"id" => $shortname."_prdlstcatimage_border",
						"std" => "true",
						"type" => "checkbox");
	}
	if(apply_filters('templ_design_catisprice_opt',true)){
	$options[] = array("name" => __("Display Price?"),
					   "label" => __("Check mark if you wish to display Product Price. Other related options will be effected only if this option is checked."),
						"desc" => "",
						"id" => $shortname."_prdlstcatprice_showhide",
						"std" => "true",
						"type" => "checkbox");
	}
	if(apply_filters('templ_design_catpriceorder_opt',true)){
	$options[] = array(	"name" => __("Price Display order"),
						"desc" => "",
						"id" => $shortname."_prdlstcatprice_order",
						"std" => "",
						"type" => "select",
						"options" => array('1','2','3','4','5'));
	}
	if(apply_filters('templ_design_catisdesc_opt',true)){
	$options[] = array("name" => __("Display Product Description?"),
					   "label" => __("Check mark if you wish to display Product Description. Description will only appear in listing view and not in grid view.  Other related options will be effected only if this option is checked."),
						"desc" => "",
						"id" => $shortname."_prdlstcatcontent_showhide",
						"std" => "true",
						"type" => "checkbox");
	}
	if(apply_filters('templ_design_catdescorder_opt',true)){
	$options[] = array(	"name" => __("Description Display order"),
						"desc" => "",
						"id" => $shortname."_prdlstcatcontent_order",
						"std" => "",
						"type" => "select",
						"options" => array('1','2','3','4','5'));
	}
	if(apply_filters('templ_design_catisbutton_opt',true)){
	$options[] = array("name" => __("Display View Button?"),	
					   "label" => __("Check mark if you wish to display Product View Button. View Button will appear only in listing view and not in gird view. Other related options will be effected only if this option is checked."),
						"desc" => "",
						"id" => $shortname."_prdlstcatbutton_showhide",
						"std" => "true",
						"type" => "checkbox");
	}
	if(apply_filters('templ_design_catbuttonorder_opt',true)){
	$options[] = array(	"name" => __("Button Display order"),
						"desc" => "",
						"id" => $shortname."_prdlstcatbutton_order",
						"std" => "",
						"type" => "select",
						"options" => array('1','2','3','4','5'));
	}
	$options[] = array("name" => "", 
							   "desc" => "",
			    		            "id" =>"",
			    		            "std" => "",
			    		            "type" => "savebutton");
	
	$options[] = array(	"type" => "subheadingbottom");
}
if(apply_filters('templ_design_homesettings_opt',true)){
	$options[] = array(	"name" => __("Products Listing Settings -> For Home Page - Latest Products "),
							"toggle" => "true",
							"type" => "subheadingtop");
	
	if(apply_filters('templ_design_homeistitle_opt',true)){
	$options[] = array("name" => __("Display Product Title?"),
					   "label" => __("Check mark if you wish to display Product Title. Other related options will be effected only if this option is checked."),
						"desc" => "",
						"id" => $shortname."_prdlsthometitle_showhide",
						"std" => "true",
						"type" => "checkbox");
	}
	if(apply_filters('templ_design_hometitleorder_opt',true)){
	$options[] = array(	"name" => __("Title Display Order"),
						"desc" => "",
						"id" => $shortname."_prdlsthometitle_order",
						"std" => "1",
						"type" => "select",
						"options" => array('1','2','3','4','5'));
	}
	if(apply_filters('templ_design_homeisimg_opt',true)){
	$options[] = array("name" => __("Display Product Image?"),
					   "label" => __("Check mark if you wish to display Product Image. Other related options will be effected only if this option is checked."),
						"desc" => "",
						"id" => $shortname."_prdlsthomeimage_showhide",
						"std" => "true",
						"type" => "checkbox");
	}
	if(apply_filters('templ_design_homeimgorder_opt',true)){
	$options[] = array(	"name" => __("Image Display Order"),
						"desc" => "",
						"id" => $shortname."_prdlsthomeimage_order",
						"std" => "",
						"type" => "select",
						"options" => array('1','2','3','4','5'));
	}
	if(apply_filters('templ_design_homeimgborder_opt',true)){
	$options[] = array("name" => __("Set Image Border?"),
					   "label" => __("Wish to set Image border?"),
						"desc" => "",
						"id" => $shortname."_prdlsthomeimage_border",
						"std" => "true",
						"type" => "checkbox");
	}
	if(apply_filters('templ_design_homeisprice_opt',true)){
	$options[] = array("name" => __("Display Price?"),
					   "label" => __("Check mark if you wish to display Product Price. Other related options will be effected only if this option is checked."),
						"desc" => "",
						"id" => $shortname."_prdlsthomeprice_showhide",
						"std" => "true",
						"type" => "checkbox");
	}
	if(apply_filters('templ_design_homepriceorder_opt',true)){
	$options[] = array(	"name" => __("Price Display Order"),
						"desc" => "",
						"id" => $shortname."_prdlsthomeprice_order",
						"std" => "",
						"type" => "select",
						"options" => array('1','2','3','4','5'));
	}
	if(apply_filters('templ_design_homeisdesc_opt',true)){
	$options[] = array("name" => __("Display Description"),
					   "label" => __("Check mark if you wish to display Product Description. Other related options will be effected only if this option is checked."),
						"desc" => "",
						"id" => $shortname."_prdlsthomecontent_showhide",
						"std" => "true",
						"type" => "checkbox");
	}
	if(apply_filters('templ_design_homedescorder_opt',true)){
	$options[] = array(	"name" => __("Description Display Order"),
						"desc" => "",
						"id" => $shortname."_prdlsthomecontent_order",
						"std" => "",
						"type" => "select",
						"options" => array('1','2','3','4','5'));
	}
	if(apply_filters('templ_design_homeisbutton_opt',true)){
	$options[] = array("name" => __("Display View Button?"),
					   "label" => __("Check mark if you wish to display Product View Button. Other related options will be effected only if this option is checked."),
						"desc" => "",
						"id" => $shortname."_prdlsthomebutton_showhide",
						"std" => "true",
						"type" => "checkbox");
	}
	if(apply_filters('templ_design_homebuttonorder_opt',true)){
	$options[] = array(	"name" => __("View Button Display Order"),
						"desc" => "",
						"id" => $shortname."_prdlsthomebutton_order",
						"std" => "",
						"type" => "select",
						"options" => array('1','2','3','4','5'));
	}
	$options[] = array("name" => "", 
					   "desc" => "",
						"id" =>"",
						"std" => "",
						"type" => "savebutton");
	
	$options[] = array(	"type" => "subheadingbottom");
}
/// Blog Section Settings	
if(apply_filters('templ_design_imagesettings_opt',true)){
		$options[] = array(	"name" => __("Image default width & height Settings For Product Listing"),
						    "toggle" => "true",
							"type" => "subheadingtop");
			
		if(apply_filters('templ_design_imgwidth_opt',true)){
			$options[] = array(	"name" => __("Default Width (in pixel)"),
					                "desc" => __("Set the image Width. Image will be automatically resized to this width."),
					                "id" => $shortname."_image_width",
					                "std" => "",
					                "type" => "text");
		}
		if(apply_filters('templ_design_imgheight_opt',true)){
		$options[] = array(	"name" => __("Default Height (in pixel)"),
					                "desc" => __("Set the image Height. Image will be automatically resized to this Height."),
					                "id" => $shortname."_image_height",
					                "std" => "",
					                "type" => "text");
		}
		/*if(apply_filters('templ_design_imgcutedge_opt',true)){
		$options[] = array(	"name" => __("Default Image Cutting Edge"),
					                "desc" => __("Set Default Image Cutting Edge Position."),
					                "id" => $shortname."_image_x_cut",
					                "std" => "",
									"options" => array('center','top','bottom','left','right','top right','top left','bottom right','bottom left'),
					                "type" => "select");
		}*/
			$options[] = array("name" => "", 
							   "desc" => "",
			    		            "id" =>"",
			    		            "std" => "",
			    		            "type" => "savebutton");
			
			$options[] = array(	"type" => "subheadingbottom");
			//$options[] = array(	"type" => "subheadingbottom");
}
		/// Blog Section Settings												
if(apply_filters('templ_design_blogsettings_opt',true)){
		$options[] = array(	"name" => __("Blog Section Settings"),
						 "toggle" => "true",
							"type" => "subheadingtop");
				//$options[] = array(	"type" => "multihead");
				if(apply_filters('templ_design_blogcats_opt',true)){
				$options[] = array(	"name" => __("Select Categories As Blog Categories"),
					"toggle" => "true",
					"type" => "multihead");
						
				$options = category_exclude($options);
				//$options[] = array(	"type" => "subheadingbottom");
				}
				if(apply_filters('templ_design_blogcontent_opt',true)){
				$options[] = array("name" => __("Content Display"),
								   "label" => __("Display Full Post Content"),
						            "desc" => __("Instead of default Post excerpts display Full Post Content in Blog Section"),
						            "id" => $shortname."_postcontent_full",
						            "std" => "false",
						            "type" => "checkbox");	
				}
			$options[] = array("name" => "", 
							   "desc" => "",
			    		            "id" =>"",
			    		            "std" => "",
			    		            "type" => "savebutton");
			
			$options[] = array(	"type" => "subheadingbottom");
}
 						
	/// Stats and Scripts											
if(apply_filters('templ_design_scriptsettings_opt',true)){				
		$options[] = array(	"name" => __("Stats and Scripts"),
						     "toggle" => "true",
								"type" => "subheadingtop");
										
			if(apply_filters('templ_design_headerscript_opt',true)){
			$options[] = array(	"name" => __("Header Scripts"),
					                "desc" => __("If you need to add scripts to your header (like <a href='http://haveamint.com/'>Mint</a> tracking code), do so here."),
					                "id" => $shortname."_scripts_header",
					                "std" => "",
					                "type" => "textarea");
			}
			if(apply_filters('templ_design_footerscript_opt',true)){
			$options[] = array(	"name" => __("Footer Scripts"),
					                "desc" => __("If you need to add scripts to your footer (like <a href='http://www.google.com/analytics/'>Google Analytics</a> tracking code), do so here."),
					                "id" => $shortname."_google_analytics",
					                "std" => "",
					                "type" => "textarea");
			}
			$options[] = array("name" => "", 
							   "desc" => "",
			    		            "id" =>"",
			    		            "std" => "",
			    		            "type" => "savebutton");
			
			$options[] = array(	"type" => "subheadingbottom");
}
	/// SEO Options
if(apply_filters('templ_design_seosettings_opt',true)){				
		$options[] = array(	"name" => __("SEO Options"),
						    "toggle" => "true",
								"type" => "subheadingtop");
						
			if(apply_filters('templ_design_metadesc_opt',true)){
			$options[] = array(	"name" => __("Meta Description"),
					                "desc" => __("You should use meta descriptions to provide search engines with additional information about topics that appear on your site. This only applies to your home page."),
					                "id" => $shortname."_meta_description",
					                "std" => "",
					                "type" => "textarea");
			}
			if(apply_filters('templ_design_metakw_opt',true)){
				$options[] = array(	"name" => __("Meta Keywords (comma separated)"),
					                "desc" => __("Meta keywords are rarely used nowadays but you can still provide search engines with additional information about topics that appear on your site. This only applies to your home page."),
						            "id" => $shortname."_meta_keywords",
						            "std" => "",
						            "type" => "text");
			}
			if(apply_filters('templ_design_metaauthor_opt',true)){
				$options[] = array(	"name" => __("Meta Author"),
					                "desc" => __("You should write your <em>full name</em> here but only do so if this blog is writen only by one outhor. This only applies to your home page."),
						            "id" => $shortname."_meta_author",
						            "std" => "",
						            "type" => "text");
			}
			$options[] = array("name" => "", 
							   "desc" => "",
			    		            "id" =>"",
			    		            "std" => "",
			    		            "type" => "savebutton");
			
			$options[] = array(	"type" => "subheadingbottom");
}
/// Product Settings	

$options[] = array(	"type" => "maintabletop");
if(apply_filters('templ_design_prdsettings_opt',true)){				
		$options[] = array(	"name" => __("Product  Details  Page Settings"),
						    "toggle" => "true",
						"type" => "subheadingtop");
										
	if(apply_filters('templ_design_isqtytxtondetail_opt',true)){
	$options[] = array(		"name" => __("Display quantity textbox"),
					   		"desc" => __("Do you want to display quantity textbox on Detail page"),
							"id" => $shortname."_qty_txt_showhide",
							"std" => "Show",
							"type" => "select",
							"options" => array('Show','Hide'));
	}
	if(apply_filters('templ_design_isqtytxtoncart_opt',true)){
	$options[] = array(	"name" => __("Set quantity textbox on Shopping Cart page"),
					   "desc" => __("Do you want to set quantity textbox on Shopping Cart page to be editable?"),
							"id" => $shortname."_qty_txt_cart_showhide",
							"std" => "Show",
							"type" => "select",
							"options" => array('Editable','Readonly'));
	}
	if(apply_filters('templ_design_maxqtydecimal_opt',true)){		
	$options[] = array(	"name" => __("Maximum number of Quantity Decimal"),
					   "desc" => __("Maximum number of quantity Decimal in case of <u>quantity textbox=show</u>"),
						"id" => $shortname."_max_qty_decimal",
						"std" => "3",
						"type" => "text");
	}
	if(apply_filters('templ_design_isprdweight_opt',true)){
			$options[] = array("name" => __("Show or Hide Product Weight"),	
							   "desc" => __("Select wish to either Show or Hide Product Weight on Product detail page "),
							"id" => $shortname."_prd_weight_showhide",
							"std" => "Show",
							"type" => "select",
							"options" => array('Show','Hide'));
	}
	if(apply_filters('templ_design_istellfrnd_opt',true)){
			$options[] = array("name" => __("Show or Hide 'Tell a Friend'"),
							   "desc" => __("Select wish to either Show or Hide 'Tell a Friend' on Product detail page "),
							"id" => $shortname."_tellfrnd_showhide",
							"std" => "Show",
							"type" => "select",
							"options" => array('Show','Hide'));
	}
	if(apply_filters('templ_design_isaddcomment_opt',true)){
			$options[] = array("name" => __("Show or Hide 'Add Comment'"),
							   "desc" => __("Select wish to either Show or Hide 'Add Comment' on Product detail page "),
							"id" => $shortname."_addcomment_showhide",
							"std" => "Show",
							"type" => "select",
							"options" => array('Show','Hide'));
	}
			////////////////////start /////////////////
	if(apply_filters('templ_design_add2cartpos_opt',true)){
		$options[] = array(	"name" => __("Add to Cart/Send Inquiry Button Position"),
					  		"desc" => __("Select Add to Cart Button Position in Product Detail Page"),
							"id" => $shortname."_add_to_cart_button_position",
							"std" => "",
							"type" => "select",
							"options" => array('Above Description','Below Description','Above and Below Description'));
	}
	if(apply_filters('templ_design_isrelatedprd_opt',true)){
	$options[] = array(	"name" => __("Show or Hide Related produts"),
				   			"desc" => __("Wish to either Show or Hide related produts on product detail page"),
							"id" => $shortname."_related_prd_single",
							"std" => "Show",
							"type" => "select",
							"options" => array('Show','Hide'));
	}
	if(apply_filters('templ_design_relatedprdnum_opt',true)){	
	$options[] = array(	"name" => __("Number of Related products"),
					   "desc" => __("Number of Related products display on Detail page"),
							"id" => $shortname."_related_prd_number",
							"std" => "5",
							"type" => "text");
	}
	$options[] = array("name" => "", 
							   "desc" => "",
			    		            "id" =>"",
			    		            "std" => "",
			    		            "type" => "savebutton");
	
	$options[] = array(	"type" => "subheadingbottom");
}
//site layout settings
if(apply_filters('templ_design_sitelayoutsettings_opt',true)){
$options[] = array(	"name" => __("Site Pages Layout setting"),
						    "toggle" => "true",
						"type" => "subheadingtop");
										
		if(apply_filters('templ_design_homelayout_opt',true)){
		$options[] = array("name" => __("Home Page Layout setting"),	
						   "desc" => "",
							"id" => $shortname."_home_design_settings",
							"std" => "Show",
							"type" => "select",
							"options" => array('With Right Sidebar','With Left Sidebar','3 column content with left & right sidebar','2 column sidebar in right side','2 column sidebar in left side','Full page'));
		}
		if(apply_filters('templ_design_contenlayout_opt',true)){
		$options[] = array("name" => __("Content Page Layout setting"),
						   "desc" => __("Select layout of Content pages, e.g. About, Contact Ua"),
							"id" => $shortname."_inner_design_settings",
							"std" => "Show",
							"type" => "select",
							"options" => array('With Right Sidebar','With Left Sidebar','3 column content with left & right sidebar','2 column sidebar in right side','2 column sidebar in left side','Full page'));						
		}
		if(apply_filters('templ_design_prdlistlayout_opt',true)){
		$options[] = array("name" => __("Product Listing Page Layout setting"),	
						   "desc" => "",
							"id" => $shortname."_product_design_settings",
							"std" => "Show",
							"type" => "select",
							"options" => array('With Right Sidebar','With Left Sidebar','3 column content with left & right sidebar','2 column sidebar in right side','2 column sidebar in left side','Full page'));						
		}
		if(apply_filters('templ_design_bloglistlayout_opt',true)){
		$options[] = array("name" => __("Blog Listing Page Layout setting"),
						   "desc" => "",
							"id" => $shortname."_blog_design_settings",
							"std" => "Show",
							"type" => "select",
							"options" => array('With Right Sidebar','With Left Sidebar','3 column content with left & right sidebar','2 column sidebar in right side','2 column sidebar in left side','Full page'));						
		}
		if(apply_filters('templ_design_prddetaillayout_opt',true)){
		$options[] = array("name" => __("Product Detail Page Layout setting"),
						   "desc" => "",
							"id" => $shortname."_product_detail_design_settings",
							"std" => "Show",
							"type" => "select",
							"options" => array('With Right Sidebar','With Left Sidebar','3 column content with left & right sidebar','2 column sidebar in right side','2 column sidebar in left side','Full page'));						
		}
		if(apply_filters('templ_design_blogdetaillayout_opt',true)){
		$options[] = array("name" => __("Blog Detail Page Layout setting"),
						   "desc" => "",
							"id" => $shortname."_blog_detail_design_settings",
							"std" => "Show",
							"type" => "select",
							"options" => array('With Right Sidebar','With Left Sidebar','3 column content with left & right sidebar','2 column sidebar in right side','2 column sidebar in left side','Full page'));						
		}
		if(apply_filters('templ_design_storelistlayout_opt',true)){
		$options[] = array(	"name" => __("Store Listing Page Layout setting"),
						   "desc" => "",
							"id" => $shortname."_store_design_settings",
							"std" => "Show",
							"type" => "select",
							"options" => array('With Right Sidebar','With Left Sidebar','3 column content with left & right sidebar','2 column sidebar in right side','2 column sidebar in left side','Full page'));						
		}
		if(apply_filters('templ_design_cartlayout_opt',true)){
		$options[] = array("name" => __("Shopping Cart Page Layout setting"),	
						   "desc" => "",
							"id" => $shortname."_cart_design_settings",
							"std" => "Show",
							"type" => "select",
							"options" => array('With Right Sidebar','With Left Sidebar','3 column content with left & right sidebar','2 column sidebar in right side','2 column sidebar in left side','Full page'));
		}
		if(apply_filters('templ_design_checkoutlayout_opt',true)){
		$options[] = array("name" => __("Checkout Page Layout setting"),	
						   "desc" => "",
							"id" => $shortname."_checkout_design_settings",
							"std" => "Show",
							"type" => "select",
							"options" => array('With Right Sidebar','With Left Sidebar','3 column content with left & right sidebar','2 column sidebar in right side','2 column sidebar in left side','Full page'));
		}
		if(apply_filters('templ_design_pageslayout_opt',true)){
		$options[] = array("name" => __("All Other Pages Layout setting"),
						   "desc" => "",
							"id" => $shortname."_all_pages_settings",
							"std" => "Show",
							"type" => "select",
							"options" => array('With Right Sidebar','With Left Sidebar','3 column content with left & right sidebar','2 column sidebar in right side','2 column sidebar in left side','Full page'));
		}
	$options[] = array("name" => "", 
					   "desc" => "",
						"id" =>"",
						"std" => "",
						"type" => "savebutton");
	
	$options[] = array(	"type" => "subheadingbottom");
}
$options[] = array(	"type" => "maintablebottom");

$options = apply_filters('templ_admin_design_options',$options);
?>