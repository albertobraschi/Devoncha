*************************************************************************************************
		CHILD THEME FOR ECOMMERCE FRAME WORK
		------------------------------------------------------------
                         		USAGE GUIDE
****************************************************************************************************

######################################
HOW TO INTEGRATE DESIGN IN CHILD THEME
######################################
1)There are main files to set different page of e-commerce site throught your child theme. Which are listed below:
	- home_page.php
	- blog_listing.php
	- product_listing.php
	- store.php	
	- product_detail.php
	- blog_detail.php
	- content_page.php
	
       You can change middle/main content part of page by changing those pages. Outer structures are fix and you can control from wp-admin->Shopping Cart->Design settings. You just place the files and it will detected by framework and work according to coding inside.

2) Detail description of above pages are mention below:
    -- home_page.php:- If you want to change home page content section, you can do code in this file.
    -- blog_listing.php:- Blog lising page can be formatted or edited via this file.
    -- product_listing.php:- Product listing/Category page/Archive page can be formatted or edited via this file.
    -- store.php:- Store/All Products page can be formatted or edited via this file.
    -- product_detail.php:- Product Detail  page can be formatted or edited via this file.
    -- blog_detail.php :- Blog Detail page can be formatted or edited via this file.
    -- content_page.php :- Page/Content Detail page can be formatted or edited via this file.



######################################
HOW TO INSTALL  PAYMENT GATEWAY MODULES
######################################
1)Copy Payment Gateway folder and paste to library/payment folder
2)Go to wp-admin->Shopping Cart -> Payment  Options
You can see two Sections
	1)Manage Payment Options  -- All installed payment gateways listed
	2)Install New Payment Gateway -- Listing of all payment gateways with status
3)You can see current module in "Install New Payment Gateway" section with "Uninstall" label.
4)Install it and you  can see it in "Manage Payment Options" Section.
5)From "Settings" option you need to set necessary option.
6)Your Module is ready to use, you can see this option while checking out in payment options.

