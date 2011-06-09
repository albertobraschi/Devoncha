<?php /*?><form name="frm_payment_method" id="frm_payment_method" action="<?php echo site_url(); ?>/?ptype=payment&paymentmethod=<?php echo $_POST['paymentmethod'];?>" method="post"><?php */?>
 <tr id="ewayoptions" style="display:none;" >
       <td colspan="2" >
<div >
  <table class="table">
    <tr>
      <td class="row3" width="150">Card Holder Name : </td>
      <td class="row3"><input type="text" value="" id="cardholder_name" name="cardholder_name" class="formFieldMedium"/></td>
    </tr>
    <tr>
      <td class="row3">Credit/Debit Card number : </td>
      <td class="row3"><input type="text" autocomplete="off" size="25" maxlength="25" id="cc_number" name="cc_number" class="formField"/></td>
    </tr>
    <tr>
      <td class="row3">Expiry Date : </td>
      <td class="row3"><select class="formFieldMedium" id="cc_month" name="cc_month">
          <option selected="selected" value="">month</option>
          <option value="01">01</option>
          <option value="02">02</option>
          <option value="03">03</option>
          <option value="04">04</option>
          <option value="05">05</option>
          <option value="06">06</option>
          <option value="07">07</option>
          <option value="08">08</option>
          <option value="09">09</option>
          <option value="10">10</option>
          <option value="11">11</option>
          <option value="12">12</option>
        </select>
        <select class="formFieldMedium" id="cc_year" name="cc_year">
          <option selected="selected" value="">year</option>
          <?php for($y=date('Y');$y<date('Y')+5;$y++){?>
          <option value="<?php echo $y;?>"><?php echo $y;?></option>
          <?php }?>
        </select>
      </td>
    </tr>
   </table>

</div></td>
</tr>
<?php /*?></form><?php */?>
