<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_new">
              <thead>
                <tr>
                  <th align="center">Pitched Work</th>
                  <th align="center">Sent To</th>
                  <th align="center">PitchIt! Reply</th>
                  <th class="center">Times Replied</th>
                  <th class="center">Date</th>
                </tr>
              </thead>
              <tbody>
              
               <?php 
                   //echo '<pre/>';print_r($pitchit_details_limit_original);//die;
                                      
                   if(!empty($pitchit_details_limit_original))
                    {
                    $i =1; 
                    
                    
                       $res = array();
                       /*foreach($pitchit_details_limit_original as $keys=>$pit) 
                       {
                        $res[$pit["id"]] = $pit;
                       }*/
                       //echo '<pre/>';print_r($res);
                       foreach($pitchit_details_limit_original as $k =>$pitch_details)
                     {
                        //$pitchit_view = $this->memail->get_user_pitchit_view($pitch_details['wid']);
                        $pitchit_view_user = $this->memail->get_user_pitchit_writer($pitch_details['user_id']);
                        $pitchit_msg = $this->memail->get_user_pitchit_msg($pitch_details['pit_id']);
                        //echo '<pre/>';print_r($pitchit_view_user);
                        $total_response_recent  = $this->memail->get_user_pitchit_msg_recent($pitch_details['pit_id']);
                        $total_response_reply  = $this->memail->get_user_pitchit_msg_total_reply($pitch_details['pit_id']);
                        
                     ?>
              
              
                <tr >
                  <td width="22%" align="center">
                  <?php
                  if(strlen($pitch_details['title']) > 20){?>
                    <div title="<?php echo $pitch_details['title'];?>"><?php echo substr($pitch_details['title'],0,18).'..';?></div>
                  <?php } else {
                    echo $pitch_details['title'];
                  }
                  ?>
                  
               <script type="text/javascript">
                $(document).ready(function () {
                   
                   $('#pit_work_'+<?=$pitch_details['pit_id']?>).click(function () {
                        
                           $('.pit_work_dialog').hide();
                            $("#pit_work_dialog_lat_first_recent"+<?=$pitch_details['pit_id']?>).dialog({
                                
                                position:  {
                                            my: "left",
                                            at: "left",
                                            of: $('#tab4')
                                        }
                                
                            });
                            $("#pit_work_dialog_lat_first_recent"+<?=$pitch_details['pit_id']?>).show();
                            
                         $('#cancl_pit_rep_'+<?=$pitch_details['pit_id']?>).click(function () {
                       
                            //$("#pit_work_dialog_lat_first_recent"+<?=$pitch_details['pit_id']?>).dialog('close');
                            $("#pit_work_dialog_lat_first_recent"+<?=$pitch_details['pit_id']?>).hide();
                            
                        
                       });    
                        
                    }); 
                    
                });
                </script>
                  
                  <div id="pit_work_dialog_lat_first_recent<?=$pitch_details['pit_id']?>" style="display: none;" class="pit_work_dialog">
                    <h1><?=$total_response_recent['subject']?>
                    </h1>
                    <p>An AEP member has sent a message to you <?=$total_response_recent['body']?></p>
                    
                     
                  <a href="#0" class="cd-popup-trigger" id="cd-popup-trigger_rep_<?php echo $pitch_details['id']?>">Reply</a>
                  <a href="javascript:void(0);" id="cancl_pit_rep_<?=$pitch_details['pit_id']?>" class="green_but">Close</a>
                  
                  </div>
                  
                  </td>
                  <td width="22%" align="center">
                  <?php 
                  if(!empty($pitchit_view_user['name_first']))
                  {
                    $first = $pitchit_view_user['name_first'];
                  }
                  else
                  {
                    $first = '';
                  }
                  if(!empty($pitchit_view_user['name_middle']))
                  {
                   $middle = $pitchit_view_user['name_middle'];
                  }
                  else
                  {
                    $middle = '';
                  }
                  if(!empty($pitchit_view_user['name_last']))
                  {
                   $last = $pitchit_view_user['name_last'];
                  }
                  else
                  {
                    $last = '';
                  }
                  ?>
                  
                  <a href="<?php echo base_url();?>discovery/user_details/<?php echo $pitch_details['user_id']?>">
                  <?php 
                  $fullname = $first.' '.$middle.' '.$last;
                  if(strlen($fullname) > 20){?>
                    <div title="<?php echo $fullname;?>"><?php echo substr($fullname,0,18).'..';?></div>
                  <?php }else{
                    echo $fullname;   
                  }
                  ?>
                   
                   <!-- <span class="tp_span55"> <?php echo $fullname; ?></span>
 <div class="clear"></div> -->
                   
                   </a>
                  
                  </td>
                  <td width="28%" align="center">
                  
                  <?php if($pitchit_msg['count'] > 0) {?>
                  <div class="pitchit_conversation_icon">
                  <img src="<?=base_url()?>images/think.png" alt="" id="pit_work_<?=$pitch_details['pit_id']?>" style="cursor: pointer;"/>
                  <?php
                  if(strlen($total_response_recent['subject']) > 15){?>
                    <div title="<?php echo $total_response_recent['subject'];?>"><?php echo substr($total_response_recent['subject'],0,15).'..';?></div>
                  <?php } else {
                    echo $total_response_recent['subject'];
                  }
                  ?>
                 </div>
                 
                  <?php } else {?>
                  No Reply
                  <?php } ?>
         <script>
         jQuery(document).ready(function($){
  //open popup
  $('#cd-popup-trigger_rep_'+<?php echo $pitch_details['id']?>).on('click', function(event){
    event.preventDefault();
    $('#cd-popup_rep_'+<?php echo $pitch_details['id']?>).addClass('is-visible');
  });
  
  //close popup
  $('#cd-popup_rep_'+<?php echo $pitch_details['id']?>).on('click', function(event){
    if( $(event.target).is('.cd-popup-close') || $(event.target).is('#cd-popup_rep_'+<?php echo $pitch_details['id']?>) ) {
      event.preventDefault();
      $(this).removeClass('is-visible');
    }
  });
  //close popup when clicking the esc keyboard button
  $(document).keyup(function(event){
      if(event.which=='27'){
        $('#cd-popup_rep_'+<?php echo $pitch_details['id']?>).removeClass('is-visible');
      }
    });
    
    CKEDITOR.replace( 'editor4_<?php echo $pitch_details['id']?>', {
            removeButtons: 'Source',
            // The rest of options...
        });
    
});

function SubmitForm11(type)
{
    //alert('fg');
   

     document.getElementById('composeFrm22').action='<?=base_url()?>mail/compose/'+type;
     document.getElementById('composeFrm22').submit();
     //window.location.reload();
     
     return true;
}
         </script>         
                                  
  <div class="cd-popup" role="alert" id="cd-popup_rep_<?php echo $pitch_details['id']?>">
  <div class="cd-popup-container_reply">
    <div style=" width:100%; background:#000; padding:20px 0;">
    </div>
       <div class="top_compose">
                                
                                       <?php
                                       $usd = $this->session->userdata('logged_user');
                                       $frmAttrs   = array("id"=>'composeFrm22',"class"=>'form-horizontal',"name"=>'myForm');
                                       echo form_open_multipart('mail/compose_pit_msg', $frmAttrs);
                                       ?>
                                        <!--<a href="#" class="closelabel_new"><img src="<?//=base_url()?>images/closelabel.png" alt="" /></a>-->
                                        <div class="text_field_box"><label style="float:left; margin-top:9px; width:3%">To</label>
                                        
                                        <?php   
                                            $single_user = $this->mwork->single_user($pitch_details['user_id']);
                                            ?>
                                            
                                         <div  class="auto_main" id="parent_email_selected">  
                                            <span id="email_selected">      
                                        <span id="name<?=$pitch_details['user_id'];?>" class="choosen">
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
                                        <img onclick="removeEmail(this,'<?=$pitch_details['user_id'];?>')" src="<?=base_url()?>images/close_22.png">
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
                                        <input type="hidden" id="user_email_id" name="user_email_id" value="<?=$total_response_recent['from_user_id'];?>"/>
            
                                        <!--<input type="hidden" id="user_email_id" name="user_email_id"/>
                                         <label class="com_plus"> <a href="#showAuthorList" class="nohover add_img" rel="facebox" data-url=""><img src="<?php echo base_url('images/plus_icon.png')?>" /></a></label>-->
                                         
                                     
                                            <div class="clear"></div>
                                        </div>
                                        <div class="text_field_box3"><label style="float:left; margin-top:9px;">Subject</label>
                                        
                                        <input type="text" id="sub" name="sub"  class="sub_mail_content" value="Pitchit"/>
                                        <div class="clear"></div>
                                        
                                        </div>
                                        <div class="comm_tarea">
                                            <textarea class="ckeditor" cols="80" name="desc"  id="editor4_<?php echo $pitch_details['id']?>" > </textarea>
                                        </div>
                                            <div class="clear"></div><br />
                                            
                                            <!--<label class="fileContainer">
                                            <img src="<?=base_url()?>images/attachment_icon.png" alt=""   /> 
                                            <input type="file" id="image" name="image" onchange="myFunction()"/>
                                            <span id="demo_upload"></span>
                                        </label>-->
                                            
                                            <input type="hidden" name="is_pitchit" id="is_pitchit" value="1" />
                                            <input type="hidden" name="get_pitchit_id" id="get_pitchit_id" value="<?=$pitch_details['pit_id']?>" />
                                            <input type="hidden" name="send_type" id="send_type" value="send" />
                                            
                                            <span style="display: none;"><input type="file" id="image" name="image" />
                                            <input name="draft" type="submit" value="Save Draft" class="button" style="margin-right:0 !important;"/>
                                            </span>
                                            
                                            <input name="submit" type="submit" value="Send" class="button" />
                                            
                                            <!--<input name="send" type="button" value="Send" class="button" onclick="SubmitForm11('send')"/>-->
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
                  
                  
                  
                  </td>
                  <td width="15%" class="center"><?=$total_response_reply['count']?></td>
                  <td width="13%" class="center">
                  
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
                  
                  </td>
                </tr>
                
               <?php } } else { ?>
               
               <tr class="hov_col">
                  <td align="center"></td>
                  <td align="center"></td>
                  <td align="center">There are no responses till now!</td>
                  <td align="center"></td>
                  <td align="center"></td>
                </tr>
               
               <?php } ?> 
                
                
              </tbody>
            </table>

            <?php if(count($pitchit_details_limit_total) > 5) {?>
            <div class="paginate_div">
            <?php if($view_more > 0){ ?><a href="javascript:;" onclick="ajaxResponsePitchit(<?php echo $page_resp+1;?>)" class="blue_but floright_martop">VIEW MORE</a><?php }else{?> <!--<a href="javascript:;" class="blue_but floright_martop">VIEW OLDER</a>--> <?php } ?>

            <?php if($offset_resp == "0"){?>&nbsp;<?php }else{ ?> <a href="javascript:;" class="green_but floright_martop" onclick="ajaxResponsePitchit(<?php echo $page_resp-1;?>)">PREVIOUS</a> <?php } ?> 
             </div>
            <?php } ?>