<?php
global $wpdb;
if($_REQUEST['install']!='' || $_REQUEST['uninstall']!='')
{
	if($_REQUEST['install'])
	{
		$foldername = $_REQUEST['install'];
	}else
	{
		$foldername = $_REQUEST['uninstall'];
	}
	if(file_exists(TEMPLATEPATH . '/library/payment/'.$foldername))
	{
		@include_once(TEMPLATEPATH . '/library/payment/'.$foldername.'/install.php');
	}else
	{
		$install_message = "Sorry there is no such payment gateway";	
	}
}
if($_GET['status']!='' && $_GET['id']!='')
{
	$paymentupdsql = "select option_value from $wpdb->options where option_id='".$_GET['id']."'";
	$paymentupdinfo = $wpdb->get_results($paymentupdsql);
	if($paymentupdinfo)
	{
		foreach($paymentupdinfo as $paymentupdinfoObj)
		{
			$option_value = unserialize($paymentupdinfoObj->option_value);
			$option_value['isactive'] = $_GET['status'];
			$option_value_str = serialize($option_value);
			$message = "Status Updated Successfully.";
		}
	}
	
	$updatestatus = "update $wpdb->options set option_value= '$option_value_str' where option_id='".$_GET['id']."'";
	$wpdb->query($updatestatus);
}

///////////update options start//////
if($_GET['payact']=='setting' && $_GET['id']!='')
{
	include_once(TEMPLATEPATH . '/library/includes/admin_paymet_settings.php');
	exit;
}
//////////update options end////////

//Authorize .net info for test - this is client's infor == Login ID :  3N6j7vVu6 ,  Transaction Key :  3c78aJAUPk86p6r5
//////////pay settings start////////
	$payOpts = array();
	$payOpts[] = array(
					"title"			=>	"Merchant Id",
					"fieldname"		=>	"merchantid",
					"value"			=>	"myaccount@paypal.com",
					"description"	=>	__('Example')." : myaccount@paypal.com",
					);
	$payOpts[] = array(
					"title"			=>	"Cancel Url",
					"fieldname"		=>	"cancel_return",
					"value"			=>	site_url("/?ptype=cancel_return&pmethod=paypal"),
					"description"	=>	__('Example')." : http://mydomain.com/cancel_return.php",
					);
	$payOpts[] = array(
					"title"			=>	"Return Url",
					"fieldname"		=>	"returnUrl",
					"value"			=>	site_url("/?ptype=return&pmethod=paypal"),
					"description"	=>	__('Example')." : http://mydomain.com/return.php",
					);
	$payOpts[] = array(
					"title"			=>	"Notify Url",
					"fieldname"		=>	"notify_url",
					"value"			=>	site_url("/?ptype=notifyurl&pmethod=paypal"),
					"description"	=>	__('Example')." : http://mydomain.com/notifyurl.php",
					);
								
	$paymethodinfo[] = array(
						"name" 		=> 'Paypal',
						"key" 		=> 'paypal',
						"isactive"	=>	'1', // 1->display,0->hide
						"display_order"=>'1',
						"payOpts"	=>	$payOpts,
						);
	//////////pay settings end////////
	
	//////////google checkout start////////
	//437603327048662  -- google checkout merchange ID
	
	$payOpts = array();
	$payOpts[] = array(
					"title"			=>	"Merchant Id",
					"fieldname"		=>	"merchantid",
					"value"			=>	"1234567890",
					"description"	=>	__('Example')." : 1234567890"
					);
												
	$paymethodinfo[] = array(
						"name" 		=> 'Google Checkout',
						"key" 		=> 'googlechkout',
						"isactive"	=>	'1', // 1->display,0->hide
						"display_order"=>'2',
						"payOpts"	=>	$payOpts,
						);

//////////google checkout end////////

for($i=0;$i<count($paymethodinfo);$i++)
{
	$paymentsql = "select * from $wpdb->options where option_name like 'payment_method_".$paymethodinfo[$i]['key']."' order by option_id asc";
	$paymentinfo = $wpdb->get_results($paymentsql);
	if(count($paymentinfo)==0)
	{
		$paymethodArray = array(
						"option_name"	=>	'payment_method_'.$paymethodinfo[$i]['key'],
						"option_value"	=>	serialize($paymethodinfo[$i]),
						);
		$wpdb->insert( $wpdb->options, $paymethodArray );
	}
}


$paymentsql = "select * from $wpdb->options where option_name like 'payment_method_%'";
$paymentinfo = $wpdb->get_results($paymentsql);
?>

<div id="wrapper">
 
  <?php require_once (TEMPLATEPATH . '/admin/admin_header.php');?>
 <div class="titlebg">
    <span class="head i_mange_paymethod"><?php _e("Gerenciar Formas de Pagamento");?></span>  
 </div> <!-- sub heading -->

<?php if($message){?>
<div class="updated fade below-h2" id="message" style="background-color: rgb(255, 251, 204);" >
  <p><?php _e($message);?> </p>
</div>
<?php }?>
 
 
<div class="tabber">
    <div class="tabbertab">
             <h2> <?php _e('Já Instalado');?> </h2>
            <table width="100%"  class="widefat post" >
  <thead>
    <tr>
      <th width="180"><strong><?php _e('Nome do Método');?></strong></th>
      <th width="85"><strong><?php _e('Está Ativo?');?></strong></th>
      <th width="85" align="center"><strong><?php _e('Ordem');?></strong></th>
      <th width="85" align="center"><strong><?php _e('Action');?></strong></th>
      <th width="85" align="center"><strong><?php _e('Settings');?></strong></th>
      <th>&nbsp;</th>
    </tr>
    <?php
if($paymentinfo)
{
	foreach($paymentinfo as $paymentinfoObj)
	{
		$paymentInfo = unserialize($paymentinfoObj->option_value);
	
		$option_id = $paymentinfoObj->option_id;
		$paymentInfo['option_id'] = $option_id;
		$paymentOptionArray[$paymentInfo['display_order']][] = $paymentInfo;
	}
	ksort($paymentOptionArray);
	
	
	foreach($paymentOptionArray as $key=>$paymentInfoval)
	{
		for($i=0;$i<count($paymentInfoval);$i++)
		{
			$paymentInfo = $paymentInfoval[$i];
			$option_id = $paymentInfo['option_id'];
			if($paymentInfo['name'])
			{
		?>
    <tr>
      <td><?php echo $paymentInfo['name'];?></td>
      <td><?php if($paymentInfo['isactive']){echo "Sim";}else{echo "Não";}?></td>
      <td><?php echo $paymentInfo['display_order'];?></td>
      <td><?php if($paymentInfo['isactive']==1)
	{
		echo '<a href="'.site_url('/wp-admin/admin.php?page=paymentoptions&status=0&id='.$option_id).'">'.__('Deactivate').'</a>';
	}else
	{
		echo '<a href="'.site_url('/wp-admin/admin.php?page=paymentoptions&status=1&id='.$option_id).'">'.__('Activate').'</a>';
	}
	?></td>
      <td><?php
    echo '<a href="'.site_url('/wp-admin/admin.php?page=paymentoptions&payact=setting&id='.$option_id).'">'.__('Settings').'</a>';
	?></td>
      <td>&nbsp;</td>
    </tr>
    <?php
			}
		}
	}
}
?>
  </thead>
</table>
     </div> <!-- tab 1-->
      <div class="tabbertab">
             <h2> <?php _e('Instalar Novo / Ver Opções');?> </h2>
            <?php include(TEMPLATEPATH . '/library/includes/add_new_paymethod.php');?>
     </div> <!-- tab 1-->

</div> <!-- tabber #end -->
 </div>   <!-- wrapper #end -->