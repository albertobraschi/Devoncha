<?php /*?><?php
if($General->is_show_stock_color() || $General->is_show_stock_size())
{

	$attribute_array = $General->product_current_orders_count($post->ID,array('attribute'=>'1'));
	$att_str = $General->get_attribute_str($attribute_array);
	
	$data = get_post_meta( $post->ID, 'key', true );
	if($General->is_show_stock_color())
	{
		if($data['color'])
		{
			_e('<h6>'.STOCK_COLOR_TEXT.'</h6>');
			$color = $data['color'];
			$color_arr = explode(',',$color);
			$color_stock = $data['color_stock'];
			$color_stock = substr($color_stock,1,strlen($color_stock));
			$color_stock_arr = explode(',',$color_stock);
			$color_stock_info_arr = array();
			for($i=0;$i<count($color_stock_arr);$i++)
			{
				
				$color_att = preg_replace('/[(]([+-]+)([0-9]+)[)]/','',$color_arr[$i]);
				if($color_stock_arr[$i]=='')
				{
					$color_stock = 'Unlimited';
					echo '<div class="att">'.$color_att.' - '.$color_stock.'</div>';
				}elseif($color_stock_arr[$i]=='0')
				{
					$color_stock = 'Out of stock';
					echo '<div class="att">'.$color_att.' - '.$color_stock.'</div>';
				}else
				{
					$color_att =trim(preg_replace('/[(]([+-]+)(.*)[)]/','',$color_att));
					$color_stock = $color_stock_arr[$i]-substr_count($att_str,','.$color_att.',');
					if($color_stock>0)
					{
						echo '<div class="att">'.$color_att.' - '.$color_stock.' '.STOCK_PICS_TEXT.'</div>';
					}else
					{
						$color_stock = 'Out of stock';
						echo '<div class="att">'.$color_att.' - '.$color_stock.'</div>';	
					}
				}
				
			}
		}
	}
	if($General->is_show_stock_size())
	{
		if($data['size'])
		{
			_e('<h6>'.STOCK_SIZE_TEXT.'</h6>');
			$size = $data['size'];
			$size_arr = explode(',',$size);
			$size_stock = $data['size_stock'];
			$size_stock = substr($size_stock,1,strlen($size_stock));
			$size_stock_arr = explode(',',$size_stock);
			$size_stock_info_arr = array();
			for($i=0;$i<count($size_stock_arr);$i++)
			{
				$size_att = preg_replace('/[(]([+-]+)([0-9]+)[)]/','',$size_arr[$i]);
				if($size_stock_arr[$i]=='')
				{
					$size_stock = 'Unlimited';
					echo '<div class="att">'.$size_att.' - '.$size_stock.'</div>';
				}elseif($size_stock_arr[$i]=='0')
				{
					$size_stock = 'Out of stock';
					echo '<div class="att">'.$size_att.' - '.$size_stock.'</div>';
				}else
				{
					$size_att =trim(preg_replace('/[(]([+-]+)(.*)[)]/','',$size_att));
					$size_stock = $size_stock_arr[$i]-substr_count($att_str,','.$size_att.',');
					if($size_stock>0)
					{
						echo '<div class="att">'.$size_att.' - '.$size_stock.' '.STOCK_PICS_TEXT.'</div>';
					}else
					{
						$size_stock = 'Out of stock';
						echo '<div class="att">'.$size_att.' - '.$size_stock.'</div>';	
					}
				}
			}
		}
	}
}
?><?php */?>