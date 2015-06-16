<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_new">
              <thead>
                <tr>
                  <th width="22%">Pitched Work</th>
                  <th width="22%">Viewed By</th>
                  <th width="28%">PitchIt! Message</th>
                  <th width="15%" class="center">Times Viewed</th>
                  <th width="13%" class="center">Date</th>
                </tr>
              </thead>
              <tbody>
                
                
                 <?php 
                   //echo '<pre/>';print_r($user_pitchit_details);die;
                   if(!empty($user_pitchit_details))
                    {
                    $i =1; 
                    $vp = 1;   
                     foreach($user_pitchit_details as $pitch_details)
                     {
                        $pitchit_view = $this->memail->get_user_pitchit_view($pitch_details['wid']);
                        $pitchit_view_user = $this->memail->get_user_pitchit_view_user($pitch_details['pit_id']);
                        
                        $pitchit_msg = $this->memail->get_user_pitchit_msg($pitch_details['pit_id']);
                        
                        $total_response_recent  = $this->memail->get_user_pitchit_msg_recent($pitch_details['pit_id']);
                        //echo '<pre/>';print_r($pitchit_view_user);die;
                        //$single_user = $this->mwork->single_user($total_response_recent['from_user_id']);
                        if(!empty($total_response_recent))
                        {
                          $single_user = $this->mwork->single_user($total_response_recent['from_user_id']);
                          if(isset($single_user['id']) && $single_user['id'] !=""){
                            $user_id =  $single_user['id'];
                          }
                        }
                        else
                        {
                          $single_user = $this->memail->get_user_pitchit_view_user($pitch_details['pit_id']); 
                          if(isset($single_user['user_id']) && $single_user['user_id'] !=""){
                            $user_id =  $single_user['user_id'];
                          }  
                        }
                        
                     ?>
                     
              <!--<tr style="cursor: pointer;" id="pit_work_lat_first_all_<?//=$pitch_details['id']?>">-->
              <tr>
              
                  <td align="center">
                  
                  <a class="tooltips" href="javascript:void(0)" >
                  <?//=$pitch_details['title']?>
                  <?php 
                  if(strlen($pitch_details['title']) > 12)
                  {?>
                <div title="<?php echo $pitch_details['title'];?>"><?php echo substr($pitch_details['title'],0,12).'...';?></div>
                    
                  <?php }
                  else
                  {
                    echo $pitch_details['title'];
                  }
                  ?>
                  
                  <!-- <span class="tp_span2"><?php echo $pitch_details['title'];?></span>
          <div class="clear"></div> -->
                  </a>
                  
                  <!--<span id="pit_work_<?//=$pitch_details['id']?>" style="cursor: pointer;">
                  </span>-->
                  
                  
                  <script type="text/javascript">
                $(document).ready(function () {
                   
                   $('#pit_work_'+<?=$vp?>).click(function () {
                        
                          $('.pit_work_dialog').hide();
                          
                            $("#pit_work_dialog_"+<?=$vp?>).dialog({
                                 position:  {
                                            my: "left",
                                            at: "left",
                                            of: $('#tab3')
                                        }
                            });
                            $("#pit_work_dialog_"+<?=$vp?>).show();
                        
                    });
                    
                    
                     $('#cancl_pit_'+<?=$vp?>).click(function () {
                       
                            //$(".pit_work_dialog_"+<?=$vp;?>).dialog('close');
                            $("#pit_work_dialog_"+<?=$vp;?>).hide();
                        
                    }); 
                    
                });
                </script>
                  
                  <div id="pit_work_dialog_<?=$vp;?>" style="display: none;" class="pit_work_dialog">
                  
                  <?php if(!empty($pitchit_view_user)) { ?>
                  
                    <h1><?=$pitch_details['title']?> was viewed by 
                    <?php 
                      echo $pitchit_view_user['name_first'].' '.$pitchit_view_user['name_middle'].' '.$pitchit_view_user['name_last'];
                      
                      ?>
                      on 
                      
                      <?php 
                       if(!empty($pitchit_view_user['date']))
                        {
                        $date = $pitchit_view_user['date'];
                        $timestamp = strtotime($date);
                        $new_date = date("m/d/y", $timestamp);
                        echo $new_date;
                        }
                        else
                        {
                          echo 'N/A';  
                        }
                      ?>
                      viewed <?=$pitchit_view;?> times
                    </h1>
                    
                    <?php } else {?>
                    
                    <h1><?=$pitch_details['title']?> was not viewed by any AEP member yet</h1>
                    
                    <?php } ?>
                    
                    <p>An AEP member will message you directly if he/she is interested in your work</p>
                    <p><strong>Original PitchIt! on 
                    
                     <?php 
                       if(!empty($pitch_details['created_date']))
                        {
                        $date = $pitch_details['created_date'];
                        $timestamp = strtotime($date);
                        $new_date = date("m/d/y", $timestamp);
                        echo $new_date;
                        }
                        else
                        {
                          echo 'No Date';  
                        }
                      ?>
                    
                    </strong></p>
                    <p><?=$pitch_details['pitchit'];?></p>
                    <a href="javascript:void(0);" id="cancl_pit_<?=$vp;?>" class="green_but">Close</a>
                    <!--<a href="###" onclick="click_edit_pit()">Edit</a><a href="#">Save</a><a href="#">Cancel</a><a href="#">PitchIt!</a>-->
                  </div>
                  
                  </td>
                  <td align="center">
                  <?php 
                  if(!empty($single_user))
                  {?>
                    <?php /* if(!empty($user_id)){?>
                      <a class="tooltips" href="<?php echo base_url();?>discovery/user_details/<?php echo $user_id;?>" > 
                    <?php }else{?>
                      <a class="tooltips" href="javascript:void(0)" > 
                    <?php }?>
                  <?php $full_name5 = $single_user['name_first'].' '.$single_user['name_middle'].' '.$single_user['name_last'];
                    
                       if(strlen($full_name5) > 20)
                        {?>
                    <div title="<?php echo $full_name5;?>"><?php echo substr($full_name5,0,18).'..';?></div>
                           
                        <?php }
                        else
                        {
                            echo $full_name5;
                        }
                  ?>
                  <!-- <span class="tp_span2"><?php echo $full_name5;?></span> -->
                  </a>
                  <?php */ ?>
                  
                  <?php if ($pitch_details['user_type'] == '2') {?>
                                <img src="<?=base_url()?>images/bow.png" alt="" />
                                <?php }if ($pitch_details['user_type'] == '3') {?>
                                <img src="<?=base_url()?>images/hand.png" alt="" />
                                <?php }if ($pitch_details['user_type'] == '4') {?>
                                <img src="<?=base_url()?>images/glass.png" alt="" />
                                <?php } ?>
                                
                  <?php
                  }
                  else
                  {
                    echo 'N/A';
                  }
                  ?>
                  </td>
                  <td align="center" style="cursor: pointer;" id="pit_work_lat_first_all_<?=$vp;?>" >
                  
                 <div class="think_img">
                  <?php if($pitchit_msg['count'] > 0) { ?>
                  
                  
                  <a class="tooltips" href="javascript:void(0)">
                  
                  <img src="<?=base_url()?>images/think.png" alt="" />
                                   
                  <?php
           if(strlen($pitch_details['pitchit']) > 22)
              {?>
           <label style="cursor:pointer" title="An AEP has respond to your pitch, click here to see the conversation"><?php echo substr($pitch_details['pitchit'],0,20).'..';?></label>
              
          <?php }
           else
              {
              echo $pitch_details['pitchit'];  
              }
                         
                  ?>
                  <!-- <span class="tp_span2">An AEP has respond to your pitch, click here to see the conversation</span>
                <div class="clear"></div> -->
                  
                  </a>
                  
                  <script type="text/javascript">
                $(document).ready(function () {
                   
                   $('#pit_work_lat_first_all_'+<?=$vp;?>).click(function () {
                        
                            $('.pit_work_dialog').hide();
                            $("#pit_work_dialog_lat_first_all_"+<?=$vp;?>).dialog({
                                 position:  {
                                            my: "left",
                                            at: "left",
                                            of: $('#tab3')
                                        }
                            });
                            $("#pit_work_dialog_lat_first_all_"+<?=$vp;?>).show();
                            
                         $('#cancl_pit_rep_all_'+<?=$vp;?>).click(function () {
                       
                            //$("#pit_work_dialog_lat_first_all_"+<?=$vp;?>).dialog('close');
                            $("#pit_work_dialog_lat_first_all_"+<?=$vp;?>).hide();
                        
                       });    
                        
                    }); 
                    
                });
                </script>
                  
                  <div id="pit_work_dialog_lat_first_all_<?=$vp;?>" style="display: none;" class="pit_work_dialog">
                    <h1><?=$total_response_recent['subject']?>
                    </h1>
                    <p>An AEP member has sent a message to you <?=$total_response_recent['body']?></p>
                    
                     
                  <a href="#0" class="cd-popup-trigger" id="cd-popup-trigger_first_all_<?php echo $vp;?>">Reply</a>
                  <a href="javascript:void(0);" id="cancl_pit_rep_all_<?=$vp;?>" class="green_but">Close</a>
                  
                  </div>
                  
                  
                  
                  
         <script>
         jQuery(document).ready(function($){
  //open popup
  $('#cd-popup-trigger_first_all_'+<?php echo $vp;?>).on('click', function(event){
    event.preventDefault();
    $('#cd-popup_first_all_'+<?php echo $vp;?>).addClass('is-visible');
  });
  
  //close popup
  $('#cd-popup_first_all_'+<?php echo $vp;?>).on('click', function(event){
    if( $(event.target).is('.cd-popup-close') || $(event.target).is('#cd-popup_first_all_'+<?php echo $vp;?>) ) {
      event.preventDefault();
      $(this).removeClass('is-visible');
    }
  });
  //close popup when clicking the esc keyboard button
  $(document).keyup(function(event){
      if(event.which=='27'){
        $('#cd-popup_first_all_'+<?php echo $vp;?>).removeClass('is-visible');
      }
    });
    
    CKEDITOR.replace( 'editor3_<?php echo $vp;?>', {
            removeButtons: 'Source',
            // The rest of options...
        }); 
    
});
         </script>         
                                  
  <div class="cd-popup" role="alert" id="cd-popup_first_all_<?php echo $vp;?>">
  <div class="cd-popup-container_reply">
    <div style=" width:100%; background:#000; padding:20px 0;">
    </div>
       <div class="top_compose">
                                
                                       <?php
                                       $usd = $this->session->userdata('logged_user');
                                       $frmAttrs   = array("id"=>'signupFrm',"class"=>'form-horizontal',"name"=>'myForm');
                                       echo form_open_multipart('mail/compose_pit_msg', $frmAttrs);
                                       ?>
                                        <!--<a href="#" class="closelabel_new"><img src="<?//=base_url()?>images/closelabel.png" alt="" /></a>-->
                                        <div class="text_field_box"><label style="float:left; margin-top:9px; width:3%">To</label>
                                        
                                            
                                         <div  class="auto_main" id="parent_email_selected">  
                                            <span id="email_selected">      
                                        <span id="name<?=$pitchit_view_user['user_id'];?>" class="choosen">
                                            <?php 
                                              if(!empty($single_user['name_first']))
                                              {
                                               echo $single_user['name_first'].' ';
                                              }
                                              if(!empty($single_user['name_midle']))
                                              {
                                               echo $single_user['name_midle'].' ';
                                              }
                                              if(!empty($single_user['name_last']))
                                              {
                                               echo $single_user['name_last'];
                                              }?>                                            
                                        <?php  if($this->uri->segment(4) == 'address_book') {?>
                                        <img onclick="removeEmail(this,'<?=$pitchit_view_user['user_id'];?>')" src="<?=base_url()?>images/close_22.png">
                                         <?php } ?>
                                        </span> 
                                            </span>  
                                            <span>
                                            <input type="text" class="auto_t_box" id="email_input" name="email_input" onkeyup='FnShowSearch(this.value)'><ul id="dropdown_search" style="display:none;"></ul>
                                            </span>                                       
                                            <!--<div class="clear"></div>-->
            </div>
                                        <input type="hidden" id="user_mail" name="user_mail" readonly="readonly" value="
                                        <?php 
                                          if(!empty($single_user['name_first']))
                                          {
                                           echo $single_user['name_first'].' ';
                                          }
                                          if(!empty($single_user['name_midle']))
                                          {
                                           echo $single_user['name_midle'].' ';
                                          }
                                          if(!empty($single_user['name_last']))
                                          {
                                           echo $single_user['name_last'];
                                          }?>"/>
                                        <input type="hidden" id="user_email_id" name="user_email_id" value="<?php
                                        
                                        if(!empty($total_response_recent))
                                        {
                                          echo $total_response_recent['from_user_id']; 
                                        }
                                        else
                                        {
                                          echo $pitchit_view_user['user_id'];  
                                        }
                                        
                                         ?>"/>
            
                                        <!--<input type="hidden" id="user_email_id" name="user_email_id"/>
                                         <label class="com_plus"> <a href="#showAuthorList" class="nohover add_img" rel="facebox" data-url=""><img src="<?php echo base_url('images/plus_icon.png')?>" /></a></label>-->
                                         
                                     
                                            <div class="clear"></div>
                                        </div>
                                        <div class="text_field_box3"><label style="float:left; margin-top:9px;">Subject</label>
                                        
                                        <input type="text" id="sub" name="sub"  class="sub_mail_content" value="Pitchit"/>
                                        <div class="clear"></div>
                                        
                                        </div>
                                        <div class="comm_tarea">
                                            <textarea class="ckeditor" cols="80" name="desc"  id="editor3_<?php echo $vp;?>" > </textarea>
                                        </div>
                                            <div class="clear"></div><br />
                                            
                                            <!--<label class="fileContainer">
                                            <img src="<?=base_url()?>images/attachment_icon.png" alt=""   /> 
                                            <input type="file" id="image" name="image" onchange="myFunction()"/>
                                            <span id="demo_upload"></span>
                                        </label>-->
                                            
                                            <span style="display: none;"><input type="file" id="image" name="image" />
                                            <input name="draft" type="submit" value="Save Draft" class="button" style="margin-right:0 !important;"/>
                                            </span>
                                            
                                            <input type="hidden" name="is_pitchit" id="is_pitchit" value="1" />
                                            <input type="hidden" name="get_pitchit_id" id="get_pitchit_id" value="<?=$pitch_details['pit_id']?>" />
                                            <input type="hidden" name="send_type" id="send_type" value="send" />
                                            
                                            <input name="submit" type="submit" value="Send" class="button" />
                                            <?php //if($usd['user_type'] == "2"){ ?>
                                            <!--<input name="draft" type="submit" value="Save Draft" class="button" style="margin-right:0 !important;"/>-->
                                            <?php //} ?>
                                            
                                       </form>     
                                 
                                       <div class="clear">  </div> 
                                       
                                </div>
                                
    <a href="" class="cd-popup-close img-replace">Close</a>
        <div class="clear"></div>
  </div> 
     <div class="clear"></div>
</div>
          
             
                   <?php } else {
                    
                  if(strlen($pitch_details['pitchit']) > 30)
                      {
                      ?>  
                  <span id="pit_work_vw223_<?=$pitch_details['pit_id']?>" title="<?=$pitch_details['pitchit']?>" style="cursor: pointer;">
                  <?=substr($pitch_details['pitchit'],0,30).'..'?>
                  </span>
                  
                     <?php  
                      }
                   else
                      {
                      ?>  
                      
                      <span id="pit_work_vw223_<?=$pitch_details['pit_id']?>" style="cursor: pointer;">
                  <?=substr($pitch_details['pitchit'],0,30).'..'?>
                  </span> 
                   <?php    
                      }
          ?>        
             
                  
                  <script type="text/javascript">
                $(document).ready(function () {
                   
                   $('#pit_work_vw223_'+<?=$pitch_details['pit_id']?>).click(function () {
                        
                            $('.pit_work_dialog').hide();
                            $("#pit_work_dialog_vw223_"+<?=$pitch_details['pit_id']?>).dialog({
                                
                                 position:  {
                                            my: "left",
                                            at: "left",
                                            of: $('#tab3')
                                        }
                            });
                            $("#pit_work_dialog_vw223_"+<?=$pitch_details['pit_id']?>).show();
                        
                    });
                    
                    
                     $('#cancl_pit_vw223_'+<?=$pitch_details['pit_id']?>).click(function () {
                       
                            //$(".pit_work_dialog_vw223_"+<?=$pitch_details['pit_id']?>).dialog('close');
                            $("#pit_work_dialog_vw223_"+<?=$pitch_details['pit_id']?>).hide();
                        
                    }); 
                    
                });
                </script>
                  
                  <div id="pit_work_dialog_vw223_<?=$pitch_details['pit_id']?>" style="display: none;" class="pit_work_dialog">
                  
                  
                    <p><strong> PitchIt!</strong></p>
                    <p><?=$pitch_details['pitchit'];?></p>
                    <a href="javascript:void(0);" id="cancl_pit_vw223_<?=$pitch_details['pit_id']?>" class="green_but">Close</a>
                    <!--<a href="###" onclick="click_edit_pit()">Edit</a><a href="#">Save</a><a href="#">Cancel</a><a href="#">PitchIt!</a>-->
                  </div>
             
             <?php 
                 
                    }     
                  ?>
                 
                  </div>
                  </td>
                  <td class="center"><?=$pitchit_view;?></td>
                  <td class="center">
                  <?php 
                   if(!empty($pitchit_view_user['date']))
                    {
                    $date = $pitchit_view_user['date'];
                    $timestamp = strtotime($date);
                    $new_date = date("m/d/y", $timestamp);
                    echo $new_date;
                    }
                    else
                    {
                      echo 'N/A';  
                    }
                  ?></td>
                </tr>
                
               <?php $vp++;} }  else {?> 
              
               <tr class="hov_col">
                  <td align="center"></td>
                  <td align="center"></td>
                  <td align="center">There are no Pitchits!</td>
                  <td align="center"></td>
                  <td align="center"></td>
                </tr>
                
                <?php } ?>
                
              </tbody>
            </table>

            <?php if(count($AuthorLatestPitchitCount) > 6) {?>
            <div class="paginate_div">
            <?php if($view_more > 0){ ?><a href="javascript:;" onclick="ajaxViewallPitchit(<?php echo $page_latest+1;?>)" class="blue_but floright_martop">VIEW MORE</a><?php }else{?> <!--<a href="javascript:;" class="blue_but floright_martop">VIEW OLDER</a>--> <?php } ?>

            <?php if($offset_latest == "0"){?>&nbsp;<?php }else{ ?> <a href="javascript:;" class="green_but floright_martop" onclick="ajaxViewallPitchit(<?php echo $page_latest-1;?>)">PREVIOUS</a> <?php } ?> 
             </div>
            <?php } ?>