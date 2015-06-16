<?php 
                                     if(!empty($draft_details)) {
                                        
                                        foreach($draft_details as $details) {
                                            
                                            $s = $details['created'];
                                            $dt = new DateTime($s);
                                            $time = $dt->format('h:i A');
                                        
                                        ?>
                                        
                          
                                     
                                         <li class="mid_content_inner_right_bottom_box">
                                         
                                            <!--<span class="check_bx"><input name="checkbox" type="checkbox" value="" id="cb1" /></span>-->
                                            
                                            <div class="cb-styles" style="float:left; margin-left:15px;">
	
                         <input type="checkbox" id="checkbox67_<?php echo $details['id']?>" name="check" class="css-checkbox lrg check1" value="<?php echo $details['id']?>" />
                                                <label for="checkbox67_<?php echo $details['id']?>" name="checkbox67_lbl" class="css-label lrg web-two-style check1"></label>
					
											</div>
                                            
                                            <!--<span class="star_new"></span>-->
                                            <span class="lst_img"><img src="<?=base_url()?>images/img_indox.png" alt="" /></span>
                                            <div class="bond">
                                                <span class="soph_con"><?php echo $details['name']?></span>
                                                <span class="for_mob_time">
                                            <?php if(!empty($details['attach_file'])) {?> 
                                            
                                            <a href="<?=base_url()?>mail/download/<?=$details['from_user_id']?>/<?=$details['attach_file']?>" class="mail_link"><img src="<?=base_url()?>images/attachment_icon.png" alt="" />&nbsp;<?=$details['attach_file']?></a>
                                            
                                            <?php } else {?>
         
         <a href="#" class="mail_link">&nbsp;</a>
         
         <?php } ?> </span>
                                                
                                                <span class="soph_con1 detail_for_mob"><a class="mail_link" href="<?=base_url()?>mail/details/<?php echo $details['id']?>"><?php echo $details['subject']?></a></span>
                                                <div class="clear"></div>
                                            </div>
                                            <span class="atch">
                                            <?php if(!empty($details['attach_file'])) {?> 
                                            
                                            <a href="<?=base_url()?>mail/download/<?=$details['from_user_id']?>/<?=$details['attach_file']?>" class="mail_link"><img src="<?=base_url()?>images/attachment_icon.png" alt="" />&nbsp;<?=$details['attach_file']?></a>
                                            
                                            <?php } else {?>
         
         <a href="#" class="mail_link">&nbsp;</a>
         
         <?php } ?> </span>
                                            
                                            </span>
                                            <span class="soph_con1"><?php //echo $time?><?=date('m/d/Y',strtotime($details['created']))?></span>
                                            <div class="clear"></div>
                                        
                                
                                         </li>
                                         <div class="clear"></div>
                                         
                                        <?php } 
                                    } ?> 
