  <h2><?php _e('Framework');?></h2>
<form method="post">
  <?php foreach ($options as $value) { 
	
	switch ( $value['type'] ) {
		case 'text':
		option_wrapper_header($value);
		?>
  <input class="text_input" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes( get_settings( $value['id'] )); } else { echo stripslashes($value['std']); } ?>" />
  <?php
		option_wrapper_footer($value);
		break;
		
		case 'select':
		option_wrapper_header($value);
		?>
  <select class="select_input" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
    <?php foreach ($value['options'] as $option) { ?>
    <option<?php if ( get_settings( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option>
    <?php } ?>
  </select>
  <?php
		option_wrapper_footer($value);
		break;
		
		
		case 'multiselect':
		option_wrapper_header($value);
		if(is_array(get_settings($value['id'])))
		{
			$saved_val = get_settings( $value['id']);
		}else
		{
			$saved_val = array();	
		}
		?>
  <select class="select_input" name="<?php echo $value['id']; ?>[]" id="<?php echo $value['id']; ?>" multiple="multiple" style="height:80px;">
    <?php 
	if($value['options'])
	{
	foreach ($value['options'] as $option) { ?>
    <option<?php if ( in_array($option['id'],$saved_val)) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?> value="<?php echo $option['id']; ?>"><?php echo $option['title']; ?></option>
    <?php } } ?>
  </select>
  <?php
		option_wrapper_footer($value);
		break;
		
		
		
		case 'textarea':
		$ta_options = $value['options'];
		option_wrapper_header($value);
		?>
  <textarea name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" cols="<?php echo $ta_options['cols']; ?>" rows="8"><?php  if( get_settings($value['id']) != "") { echo stripslashes(get_settings($value['id'])); } else { echo $value['std']; } ?>
</textarea>
  <?php
		option_wrapper_footer($value);
		break;
		
		case 'textarea2':
		$ta_options = $value['options'];
		option_wrapper_header($value);
		?>
  <textarea name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" cols="<?php echo $ta_options['cols']; ?>" rows="2"><?php  if( get_settings($value['id']) != "") { echo stripslashes(get_settings($value['id'])); } else { echo $value['std']; } ?>
</textarea>
  <?php
		option_wrapper_footer($value);
		break;

		case "radio":
		option_wrapper_header($value);
		
 		foreach ($value['options'] as $key=>$option) { 
				$radio_setting = get_settings($value['id']);
				if($radio_setting != ''){
		    		if ($key == get_settings($value['id']) ) {
						$checked = "checked=\"checked\"";
						} else {
							$checked = "";
						}
				}else{
					if($key == $value['std']){
						$checked = "checked=\"checked\"";
					}else{
						$checked = "";
					}
				}?>
  <input type="radio" name="<?php echo $value['id']; ?>" value="<?php echo $key; ?>" <?php echo $checked; ?> />
  <?php echo $option; ?><br />
  <?php 
		}
		 
		option_wrapper_footer($value);
		break;
		
		case "checkbox":
		option_wrapper_header($value);
						if(get_settings($value['id'])){
							$checked = "checked=\"checked\"";
						}else{
							$checked = "";
						}
					?>
  <input <?php echo $value['disabled']; ?> class="input_checkbox" type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
  &nbsp;
  <label for="<?php echo $value['id']; ?>"><?php _e($value['label']); ?></label>
  <br />
  <?php
		option_wrapper_footer($value);
		break;
		
		case "multicheck":
		option_wrapper_header($value);
		
 		foreach ($value['options'] as $key=>$option) {
	 			$pn_key = $value['id'] . '_' . $key;
				$checkbox_setting = get_settings($pn_key);
				if($checkbox_setting != ''){
		    		if (get_settings($pn_key) ) {
						$checked = "checked=\"checked\"";
						} else {
							$checked = "";
						}
				}else{
					if($key == $value['std']){
						$checked = "checked=\"checked\"";
					}else{
						$checked = "";
					}
				}?>
  <input type="checkbox" name="<?php echo $pn_key; ?>" id="<?php echo $pn_key; ?>" value="true" <?php echo $checked; ?> />
  <label for="<?php echo $pn_key; ?>"><?php echo $option; ?></label>
  <br />
  <?php 
		}
		 
		option_wrapper_footer($value);
		break;
		
		case "label":
		?>
  <div class="subheading"><?php _e($value['name']); ?> 
  <p class="description"><?php _e($value['desc']); ?></p>
  </div>
  
  <?php
		break;
		
		case "heading":
		?>
  <div class="box-title"><?php _e($value['name']); ?> </div>
  <div class="fr submit submit-title">
    <input name="save" type="submit" value="<?php _e('Save changes');?>" />
    <input type="hidden" name="action" value="save" />
  </div>
  <?php
		break;
		case "savebutton":
		?>
  <?php /*?><div class="box-title"><?php _e($value['name']); ?> </div><?php */?>
  <div class="row_button clearfix ">
    <input name="save" type="submit" class="b_save" value="<?php _e('Save changes');?>" />
    <input type="hidden" name="action" value="save" />
  </div>
  <?php
		break;
		case "subheadingtop":
		?>
  <div class="feature-box">
    <div class="subheading">
      <?php if ($value['toggle'] <> "") { ?>
      <a href="" title="Show/hide additional information"><span class="pos"> <?php _e($value['name']); ?></span><span class="neg"><?php _e($value['name']); ?></span></a>
      <?php } ?>
     </div>
    <div class="options-box">
  
      <?php
		break;
		
		case "subheadingbottom":
		?>
    </div>
  </div>
  <?php
		break;
		
		case "wraptop":
		?>
   <div class="wrap-dropdown">
      <?php
		break;
		case "wrapbottom":
		?>
    </div>
  <?php
		break;
		case "multihead":
		option_wrapper_header2($value);
		break;
		
		case "maintabletop":
		?>
  <div class="maintable">
    <?php
		break;
		case "maintablebottom":
		?>
  </div>
  <?php
		break;
		case "maintablebreak":
		?>
  <br/>
  <?php
		break;
		default:
		break;
	}
}?>

  <div class="row_button2">
    <input name="save" type="submit" class="b_save_none" value="<?php _e('Save changes');?>" />
    <input type="hidden" name="action" value="save" />
 
</form>
<form method="post">
 
    <input name="reset" class="b_normal" type="submit" value="<?php _e('Reset');?>" onclick="return check_fonfirm();" />
    <input type="hidden" name="action" value="reset" />
  
</form></div>
<script type="text/javascript">
function check_fonfirm()
{
	if(confirm("<?php _e('Are you sure want to Reset Settings?');?>"))
	{
		return true;	
	}else
	{
		return false;	
	}
}
</script>
