<div id="sidebar_r">
                 		
                      <div class="featured_pro"> 
                        <h3><?php _e('Featured Product');?></h3>
                        <p><a href="#"><?php _e('Coating Crumbs');?></a> </p>
                        
                        <a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/p1.png" alt=""  /></a>
                        
                        <p class="details"> <a href="#"> <img src="<?php bloginfo('template_directory'); ?>/images/spacer.png" alt="" class="arrow"  /> <?php _e('Ver Detalhes');?></a></p>
                        
                      </div> <!-- featured pro #end -->
                      
                      
                      <h3><?php _e('Our Products');?></h3>
                      
                     <ul>
					<?php
					$ex_catIdArr = get_categories('exclude=9999999' . get_inc_categories("cat_exclude_") .',1');
					$catIdArr = array();
					foreach($ex_catIdArr as $ex_catIdArrObj)
					{
						$catIdArr[] = $ex_catIdArrObj->term_id;
					}
					$includeCats = implode(',',$catIdArr);
					wp_list_categories('orderby=name&title_li=&include='.$includeCats);
					?>
                     </ul>
 			     <?php if ( function_exists('dynamic_sidebar')) { // Show on the front page ?>
									<?php dynamic_sidebar('Front Page Sidebar Left'); ?>  
                             <?php } ?>
                        <bR />
                   <?php
                   global $General;
				   $userInfo = $General->getLoginUserInfo();
				   if($General->getLoginUserInfo())
				   {
				   ?>
                   <?php _e('Welcome');?> <?php echo $userInfo['display_name'];?>,<br />
                   <a href="<?php echo site_url(); ?>/?ptype=account"><?php _e('My Account');?></a><Br />
                   <a href="<?php echo site_url(); ?>/?ptype=account&type=editprofile"><?php _e('Edit Profile');?></a><Br />
                   <a href="<?php echo $General->get_url_login(site_url()); ?>/?ptype=login&action=logout"><?php _e('LogOut');?></a>
                   <?php
				   }else
				   {
				   ?>
                   <a href="<?php echo $General->get_url_login(site_url()); ?>/?ptype=login"><?php _e('LogIn');?></a>
                   <?php
				   }
				   ?>    
                    </div> <!-- sidebar_r #end -->