<?php
/////////////////////////////////////////
// ************* Theme Options Page *********** //
add_action('admin_menu', 'mkt_add_product'); //Add new menu block to admin side

function mkt_add_product(){	
	if(function_exists(add_object_page))
    {
       add_object_page("Products",  __("Minha Loja"), 8, 'product_menu.php', 'theme_settings', site_url('/wp-content/themes/'.get_option( 'template' ).'/images/favicon.ico' )); // title of new sidebar
    }
    else
    {
       add_menu_page("Products",  __("Shopping Cart"), 8, 'product_menu.php', 'theme_settings', site_url('/wp-content/themes/'.get_option( 'template' ).'/images/favicon.ico')); // title of new sidebar
    }
	
	//add_submenu_page('product_menu.php', "Add Product", "Add Product", 8, 'newprd', 'add_product'); // sublink2
	add_submenu_page('product_menu.php', __('Add Product'), __("Adicionar Produto"), 8, 'product_menu.php', 'add_product'); // sublink2
	add_submenu_page('product_menu.php', __("Manage Products"), __("Gerenciar Produtos"), 8, 'newprd', 'product_listing'); //sublink1
	add_submenu_page('product_menu.php', __("Manage Orders"), __("Gerenciar Pedidos"), 8, 'manageorders', 'manage_orders'); // sublink4
	add_submenu_page('product_menu.php', __("Stock"), __("Gerenciar Estoque"), 8, 'stock', 'stock'); // sublink4
	add_submenu_page('product_menu.php', __("Manage Users"), __("Gerenciar Usuários"), 8, 'manageusers', 'manage_users'); // sublink4
	add_submenu_page('product_menu.php', __("Payment Options"), __("Opções de Pagamento"), 8, 'paymentoptions', 'payment_options'); // sublink4
	add_submenu_page('product_menu.php', __("Manage Shipping"), __("Gerenciar Envio"), 8, 'manageshipping', 'manage_shipping'); // sublink4
	add_submenu_page('product_menu.php', __("Manage Coupon"), __("Gerenciar Cupom"), 8, 'managecoupon', 'manage_coupon'); // sublink4
	add_submenu_page('product_menu.php', __("Bulk Upload"), __("Upload em Massa"), 8, 'bulkupload', 'bulk_upload'); // sublink6
	add_submenu_page('product_menu.php', __("Notifications"), __("Notificações"), 8, 'notification', 'notification'); // sublink6
	add_submenu_page('product_menu.php', __("Design Settings"), __("Configurações de Design"), 8, 'theme_settings', 'theme_settings'); // sublink5
	add_submenu_page('product_menu.php', __("General Settings"), __("Configurações Gerais"), 8, 'settings', 'general_settings'); // sublink5
	add_submenu_page('product_menu.php', __("Manage Tax"), __("Gerenciar Taxa"), 8, 'tax', 'manage_tax'); // sublink5
	add_submenu_page('product_menu.php', __("Manage Country"), __("Gerenciar País"), 8, 'country', 'manage_country'); // sublink5
	add_submenu_page('product_menu.php', __("Manage States"), __("Gerenciar Estado"), 8, 'state', 'manage_state'); // sublink5
	if(CHILDTEMPLATEPATH && file_exists(CHILDTEMPLATEPATH . '/product_menu.php'))
    {
        include(CHILDTEMPLATEPATH . '/product_menu.php');
    }
	/////////////////////AFFILIATE LINKS/////////////////////////////////
	add_submenu_page('product_menu.php', __("Manage Affiliate"), __("Gerenciar Afiliados"), 8, 'affiliates_settings', 'affiliates_settings');
}

//////AFFILIATE SETTINGS START/////
require_once (TEMPLATEPATH . '/library/includes/affiliates/set_affiliate_settings.php');
//////AFFILIATE SETTINGS END/////
function manage_users()
{
	if($_REQUEST['uid'])
	{
		include_once(TEMPLATEPATH . '/library/includes/admin_manage_users_frm.php');
	}else
	{
		include_once(TEMPLATEPATH . '/library/includes/admin_manage_users.php');
	}
}
function manage_tax()
{
	include_once(TEMPLATEPATH . '/library/includes/admin_manage_tax.php');
}
function manage_country()
{
	include_once(TEMPLATEPATH . '/library/includes/admin_manage_country.php');
}
function manage_state()
{
	include_once(TEMPLATEPATH . '/library/includes/admin_manage_state.php');
}
function notification()
{
	if($_REQUEST['file']!='')
	{
		include_once(TEMPLATEPATH . '/library/includes/admin_notification_edit.php');
	}else
	{
		include_once(TEMPLATEPATH . '/library/includes/admin_notification.php');
	}
}

function stock()
{
	include_once(TEMPLATEPATH . '/library/includes/admin_stock.php');
}

function product_listing()
{
	wp_redirect(site_url("/wp-admin/edit.php?ptype=prd"));
}
function add_product()
{
	wp_redirect(site_url("/wp-admin/post-new.php?ptype=prd"));
}

function payment_options()
{
	include_once(TEMPLATEPATH . '/library/includes/admin_paymethods.php');
}

function manage_shipping()
{
	include_once(TEMPLATEPATH . '/library/includes/admin_shippings.php');
}

function bulk_upload()
{
	include_once(TEMPLATEPATH . '/library/includes/admin_bulk_upload.php');
}

function theme_settings()
{
	mytheme_add_admin();
	//include_once(TEMPLATEPATH . '/library/functions/admin_settings.php');
}
function manage_coupon()
{
	if($_REQUEST['pagetype']=='addedit')
	{
		include_once(TEMPLATEPATH . '/library/includes/admin_coupon.php');
	}else
	{
		include_once(TEMPLATEPATH . '/library/includes/admin_manage_coupon.php');
	}
}

function manage_orders()
{
	//admin_order_detail.php
	if($_GET['oid'])
	{
		include_once(TEMPLATEPATH . '/library/includes/admin_order_detail.php');
	}else
	{
		include_once(TEMPLATEPATH . '/library/includes/admin_manage_orders.php');
	}
}

function general_settings()
{
	include_once(TEMPLATEPATH . '/library/includes/admin_settings.php');
}
?>