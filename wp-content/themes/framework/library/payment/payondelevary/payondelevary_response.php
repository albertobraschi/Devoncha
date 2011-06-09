<?php /*?><form name="frm_payment_method" id="frm_payment_method" action="<?php echo site_url(); ?>/?ptype=payment&paymentmethod=<?php echo $_POST['paymentmethod'];?>" method="post">
<table>
<tr><td><input type="radio" name="paydeltype" id="paydeltype1" value="cash" checked="checked" /></td><td>CASH PAYMENT</td></tr>
<tr><td><input type="radio" name="paydeltype" id="paydeltype2" value="cheque" /></td><td>CHEQUE/DD PAYMENT</td></tr>
<tr><td colspan="2">
<table>
<tr><td>Cheque/DD Number : </td><td><input type="text" name="chequenumber" id="chequenumber" /></td></tr>
<tr><td>Bank Detail : </td><td><input type="text" name="bankdetail" id="bankdetail"  /></td></tr>
<tr><td colspan="2">&nbsp;</td></tr>
</table></td></tr>
</table>
</form><?php */?>