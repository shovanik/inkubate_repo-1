<script>

                    
function openDialog_viewall_pitch(id)
 {
    //alert(id);             
     $('.pit_work_dialog').hide();
     $('.pit_work_dialog_vw').hide();
     //$("#pit_work_vw_all_dialog_lat_first_recent_prd_firsttime_"+id).hide();
     $("#pit_work_vw_all_dialog_lat_first_recent_prd_firsttime2_"+id).show();
     
    $("#pit_work_vw_all_dialog_lat_first_recent_prd_firsttime2_"+id).dialog({
        
        position:  {
                    my: "left",
                    at: "left",
                    of: $('#tab3')
                }
        
    });
    //$("#pit_work_vw_all_dialog_lat_first_recent_prd_firsttime_"+id).show();
    
 }                    

function close_pitch2(id)
    {
        //alert('hi');
        $("#pit_work_vw_all_dialog_lat_first_recent_prd_firsttime2_"+id).hide();
        $('.pit_work_dialog').hide();
        $('.pit_work_dialog_vw').hide();
    }
                          
</script>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_new">
              <thead>
                <tr>
                  <th align="center">Pitched Work</th>
                  <th align="center">Sent By</th>
                  <th align="center">PitchIt! Message</th>
                  <th class="center">Times Viewed</th>
                  <th class="center">Date</th>
                </tr>
              </thead>
              <tbody>
              
               <?php 
   
                   if(!empty($userViewallPitchitDetails))
                   {
                   //echo '<pre/>';print_r($userAllPitchitDetails);//die; 
                   $mvallpit = 1;
                    foreach($userViewallPitchitDetails as $k => $pit_details)
                    { 
                        
                        //$pitchit_view_user = $this->memail->get_user_pitchit_writer($pit_details['user_id']);
                        $pitchit_msg = $this->memail->get_user_pitchit_msg($pit_details['pit_id']);
                        //echo '<pre/>';print_r($pitchit_msg);
                        $total_response_recent  = $this->memail->get_user_pitchit_msg_recent($pit_details['pit_id']);
                        $total_response_reply  = $this->memail->get_user_pitchit_msg_total_reply($pit_details['pit_id']);

                        $pitchit_view = $this->memail->get_user_pitchit_view($pit_details['wid']);
                        $pitchit_view_user = $this->memail->get_user_pitchit_send_user($pit_details['user_id']);

                        if(!empty($total_response_recent)){
                          $single_user = $this->mwork->single_user($total_response_recent['from_user_id']);
                        } else {
                          $single_user = $this->memail->get_user_pitchit_view_user($pit_details['pit_id']);   
                        }
                    
                    
                       $pitchit_msg_pub = $this->memail->get_user_pitchit_msg_from_pub($pit_details['pit_id']);
                      
                ?>
              
                <tr>
                  <td width="22%" align="center">
                  <span style="cursor: pointer;" onclick="openDialog(<?php echo $pit_details['id'];?>,<?php echo $pit_details['user_id'];?>)">
                  <?php
                  if(strlen($pit_details['title']) > 15){?>
                    <div title="<?php echo $pit_details['title'];?>"><?php echo substr($pit_details['title'],0,15).'..';?></div>
                  <?php } else {
                    echo $pit_details['title'];
                  }?>
                  </span>
                  </td>
                  
                  <td width="22%" align="center">
                  <?//=$pit_details['first'].' '.$pit_details['middle'].' '.$pit_details['last']?>
                  <a href="<?=base_url()?>discovery/user_details/<?=$pit_details['user_id']?>">
                  <?php 
                  //$fullname = $pitchit_view['first'].' '.$pitchit_view['middle'].' '.$pitchit_view['last'];
                  $fullname = $pitchit_view_user['name_first'].' '.$pitchit_view_user['name_middle'].' '.$pitchit_view_user['name_last'];
                  if(strlen($fullname) > 15){?>
                    <div title="<?php echo $fullname;?>"><?php echo substr($fullname,0,15).'..';?></div>
                  <?php } else {
                    echo $fullname;
                  }?>
                   
                   <!-- <span class="tp_span55"> <?php echo $fullname; ?></span>
                    <div class="clear"></div> -->
                   
                   </a>
                  </td>
                  <td width="28%" align="center"><?//=$pit_details['pitchit']?>
                  
                  
                   <script type="text/javascript">
                $(document).ready(function () {
                   
                   $('#pit_work_vw_all_'+<?=$pit_details['pit_id']?>).click(function () {
                        
                             $('.pit_work_dialog').hide();
                             $('.pit_work_dialog_vw').hide();
                             $("#pit_work_vw_all_dialog_lat_first_recent"+<?=$pit_details['pit_id']?>).show();
                        
                            $("#pit_work_vw_all_dialog_lat_first_recent"+<?=$pit_details['pit_id']?>).dialog({
                                
                                position:  {
                                            my: "left",
                                            at: "left",
                                            of: $('#tab3')
                                        }
                                
                            });
                            //$("#pit_work_vw_all_dialog_lat_first_recent"+<?//=$pit_details['pit_id']?>).show();
                            
                         $('#cancl_pit_rep_vwall_'+<?=$pit_details['pit_id']?>).click(function () {
                       
                            //$("#pit_work_vw_all_dialog_lat_first_recent"+<?=$pit_details['pit_id']?>).dialog('close');
                            $("#pit_work_vw_all_dialog_lat_first_recent"+<?=$pit_details['pit_id']?>).hide();
                            
                        
                       });    
                        
                    }); 
                    
               
                    
                    
                });
                </script>
                  
                  <div id="pit_work_vw_all_dialog_lat_first_recent<?=$pit_details['pit_id']?>" style="display: none;" class="pit_work_dialog">
                    <h1><?php echo !empty($total_response_recent['subject']) ? $total_response_recent['subject']:"";?></h1>
                    <!--<p>An AEP member has sent a message to you <?//=$total_response_recent['body']?></p>-->
                    <p>Reply to this person directly by clicking the conversation icon <img src="<?=base_url()?>images/think.png" alt=""/> below if you are interested in their work</p>
                     <p><?php echo !empty($total_response_recent['body']) ? $total_response_recent['body']:"";?></p>
                     
                  <!--<a href="#0" class="cd-popup-trigger" id="cd-popup-trigger_rep_vwall_<?php //echo $pit_details['id']?>">Reply</a>-->
                  
                  
                  <a href="javascript:void(0);" id="cancl_pit_rep_vwall_<?=$pit_details['pit_id']?>" class="green_but">Close</a>
                  <img src="<?=base_url()?>images/think.png" alt="" id="cd-popup-trigger_rep_vwall_<?php echo $pit_details['id']?>" style="cursor: pointer;"/>
                  
                  </div>
                  
                  
                  <!---------------First time reply---------------->      
                  
                  <div id="pit_work_vw_all_dialog_lat_first_recent_prd_firsttime2_<?=$pit_details['pit_id']?>" style="display: none;" class="pit_work_dialog">
                  
                  <?php //echo '<pre/>';print_r($pitchit_msg_pub);?>
                  
                    <h1><?=$pitchit_msg_pub['subject']?>
                    </h1>
                    
                    <!-- <p>Reply to this person directly by clicking the conversation icon <img src="<?//=base_url()?>images/think.png" alt=""/> below if you are interested in their work</p> -->
                    
                    <p>You have sent this message to the author.Please wait for author response </p>
                    
                     <p>Message : <?=$pitchit_msg_pub['body']?></p>
                  
                  <a href="javascript:void(0);" class="green_but" onclick="close_pitch2(<?=$pit_details['pit_id']?>);">Close</a>
                  <!-- <img src="<?//=base_url()?>images/think.png" alt="" id="cd-popup-trigger_rep_vwall_prd_<?php echo $pit_details['pit_id']?>" style="cursor: pointer;"/> -->
                  
                  </div>
            <!---------------End First time reply---------------->
                  
                  
                  <?php if($pitchit_msg['count'] > 0) {?>
                  <div class="pitchit_conversation_icon">
                  <img src="<?=base_url()?>images/think.png" alt="" id="pit_work_vw_all_<?=$pit_details['pit_id']?>" style="cursor: pointer;"/> 
                  <?php
                  if(strlen($total_response_recent['subject']) > 15){?>
                    <div title="<?php echo $total_response_recent['subject'];?>"><?php echo substr($total_response_recent['subject'],0,15).'..';?></div>
                  <?php } else {
                    echo $total_response_recent['subject'];
                  }
                  ?>
                 </div>
                  <?php } elseif($pitchit_msg_pub['count']) {?>
                  
                  <div class="pitchit_conversation_icon">
                  <img src="<?=base_url()?>images/think.png" alt="" onclick="openDialog_viewall_pitch(<?=$pit_details['pit_id']?>)" style="cursor: pointer;"/> 
                  <?php
                  if(strlen($pit_details['pitchit']) > 15){?>
                    <div title="<?php echo $pit_details['pitchit'];?>"><?php echo substr($pit_details['pitchit'],0,15).'..';?></div>
                  <?php } else {
                    echo $pit_details['pitchit'];
                  }
                  ?>
                 </div>
                  
                  <?php } else {?>
                  
                 <!--No Reply-->
                  
                  <span id="pit_work_lat_first_vall_<?=$mvallpit?>" style="cursor: pointer;">
                   
                  <?php if(strlen($pit_details['pitchit']) > 20) {?>
                      <div title="<?php echo $pit_details['pitchit'];?>"><?php echo substr($pit_details['pitchit'],0,20).'..';?></div>
                  <?php } else { 
                      echo $pit_details['pitchit']; 
                    }?>
                  
                  
                  </span>
                  
                  <?php } ?>
               
               <script type="text/javascript">
                $(document).ready(function () {
                   
                   $('#pit_work_lat_first_vall_'+<?=$mvallpit?>).click(function () {
                        
                            $('.pit_work_dialog').hide();
                            $('.pit_work_dialog_vw').hide();
                            
                            $("#pit_work_dialog_lat_first_vall_"+<?=$mvallpit?>).show(); 
                             
                            $("#pit_work_dialog_lat_first_vall_"+<?=$mvallpit?>).dialog({
                                position:  {
                                            my: "left",
                                            at: "left",
                                            of: $('#tab3')
                                        }
                            });
                            
               
                      
                         $.ajax({
                           url      : '<?=base_url()?>'+'work/pitchit_single_view',
                           type     : 'POST',
                           data     : { 'pit_id': <?=$pit_details['pit_id']?> , 'wid' : <?=$pit_details['wid']?> },
                           success  : function(resp){
                            //alert(resp);
                                if(resp > 0){
                                    
                                    $("#pit_view_all_count_<?=$mvallpit?>").html(resp);
                                    //$("#pitcnt").html(resp);
                                    //$("#edit_class" ).dialog( "close" );
                                }
                           },
                           error    : function(resp){
                                $.prompt("Sorry, something isn't working right.", {title:'Error'});
                           }
                        });   
                   
                          
                        
                    });
                    
                     $('#cancl_pit_vall_'+<?=$mvallpit?>).click(function () {
                       
                            $(".pit_work_dialog").hide();
                            $("#pit_work_dialog_lat_first_vall_"+<?=$mvallpit?>).hide();
                        
                    });
                    
                });
                </script>
                  
                  <div id="pit_work_dialog_lat_first_vall_<?=$mvallpit?>" style="display: none;" class="pit_work_dialog">
                    <h1><?=$pit_details['title']?> was sent by 
                    <?php 
                      if(!empty($pitchit_view_user))
                      {
                        echo $pitchit_view_user['name_first'].' '.$pitchit_view_user['name_middle'].' '.$pitchit_view_user['name_last'];
                      }
                      else
                      {
                        echo 'N/A';
                      }
                      ?>
                      on 
                      
                      <?php 
                       if(!empty($pit_details['created_date']))
                        {
                        $date = $pit_details['created_date'];
                        $timestamp = strtotime($date);
                        $new_date = date("m/d/y", $timestamp);
                        echo $new_date;
                        }
                        else
                        {
                          echo 'N/A';  
                        }
                      ?>
                     
                    </h1>
                    <!--<p>An AEP member will message you directly if he/she is interested in your work</p>-->
                    <p><strong>Original PitchIt! </strong></p>
                    <p><?=$pit_details['pitchit'];?></p>
                     
                  <a href="#0" class="cd-popup-trigger" id="cd-popup-trigger_first_vall_<?php echo $pit_details['pit_id']?>">Reply</a>
                  <a href="javascript:void(0);" id="cancl_pit_vall_<?=$mvallpit?>" class="green_but">Close</a>
                  </div>
                  
               
           <script>
         jQuery(document).ready(function($){
  //open popup
  $('#cd-popup-trigger_first_vall_'+<?php echo $pit_details['pit_id']?>).on('click', function(event){
    event.preventDefault();
    $('#trigger_first_vall_'+<?php echo $pit_details['pit_id']?>).addClass('is-visible');
  });
  
  //close popup
  $('#trigger_first_vall_'+<?php echo $pit_details['pit_id']?>).on('click', function(event){
    if( $(event.target).is('.cd-popup-close') || $(event.target).is('#trigger_first_vall_'+<?php echo $pit_details['pit_id']?>) ) {
      event.preventDefault();
      $(this).removeClass('is-visible');
    }
  });
  //close popup when clicking the esc keyboard button
  $(document).keyup(function(event){
      if(event.which=='27'){
        $('#trigger_first_vall_'+<?php echo $pit_details['pit_id']?>).removeClass('is-visible');
      }
    });
    
     CKEDITOR.replace( 'editor23_<?php echo $mvallpit; ?>', {
            removeButtons: 'Source',
            // The rest of options...
        });
    
});


function SubmitForm1(type,pit_id)
{
    //alert('fg');
   

     document.getElementById('composeFrm').action='<?=base_url()?>mail/compose/'+type+'/'+pit_id;
     document.getElementById('composeFrm').submit();
     //window.location.reload();
     
     return true;
}
         </script>         
    <?php 
//print_r($pitch_details);//die;
    ?>                              
  <div class="cd-popup" role="alert" id="trigger_first_vall_<?php echo $pit_details['pit_id']?>">
  <div class="cd-popup-container_reply">
    <div style=" width:100%; background:#000; padding:20px 0;">
    </div>
       <div class="top_compose">
                                
                                       <?php
                                       $usd = $this->session->userdata('logged_user');
                                       $frmAttrs   = array("id"=>'composeFrm',"class"=>'form-horizontal',"name"=>'myForm');
                                       echo form_open_multipart('mail/compose_pit_msg', $frmAttrs);
                                       ?>
                                        <!--<a href="#" class="closelabel_new"><img src="<?//=base_url()?>images/closelabel.png" alt="" /></a>-->
                                        <div class="text_field_box"><label style="float:left; margin-top:9px; width:3%">To</label>
                                        
                                        <?php   
                                            $single_user = $this->mwork->single_user($pit_details['pitchit_user']);
                                            ?>
                                            
                                         <div  class="auto_main" id="parent_email_selected">  
                                            <span id="email_selected">      
                                        <span id="name<?=$pit_details['pitchit_user'];?>" class="choosen">
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
                                        <img onclick="removeEmail(this,'<?=$pit_details['pitchit_user'];?>')" src="<?=base_url()?>images/close_22.png">
                                         <?php } ?>
                                        </span> 
                                            </span>  
                                            <span>
                                            <input type="text" class="auto_t_box" id="email_input" name="email_input" onkeyup='FnShowSearch(this.value)'><ul id="dropdown_search" style="display:none;"></ul>
                                            </span>                                       
                                            <!--<div class="clear"></div>-->
            </div>
                                        <?php 
                                        $full_name = "";
                                          if(!empty($single_user['name_first']))
                                          {
                                           $full_name.=$single_user['name_first'].' ';
                                          }
                                          if(!empty($single_user['name_midle']))
                                          {
                                           $full_name.=$single_user['name_midle'].' ';
                                          }
                                          if(!empty($single_user['name_last']))
                                          {
                                           $full_name.=$single_user['name_last'];
                                          }
                                          ?>
                                        <input type="hidden" id="user_mail" name="user_mail" readonly="readonly" value="<?php echo $full_name;?>"/>
                                        <input type="hidden" id="user_email_id" name="user_email_id" value="<?=$pit_details['pitchit_user'];?>"/>
            
                                        <!--<input type="hidden" id="user_email_id" name="user_email_id"/>
                                         <label class="com_plus"> <a href="#showAuthorList" class="nohover add_img" rel="facebox" data-url=""><img src="<?php echo base_url('images/plus_icon.png')?>" /></a></label>-->
                                         
                                     
                                            <div class="clear"></div>
                                        </div>
                                        <div class="text_field_box3"><label style="float:left; margin-top:9px;">Subject</label>
                                        
                                        <input type="text" id="sub" name="sub"  class="sub_mail_content" value="<?php echo ucwords($full_name);?> has pitched the title <?=$pit_details['title']?> to you"/>
                                        <div class="clear"></div>
                                        
                                        </div>
                                        <div class="comm_tarea">
                                            <textarea class="ckeditor" cols="80" name="desc"  id="editor23_<?php echo $mvallpit;?>" > </textarea>
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
                                            <input type="hidden" name="get_pitchit_id" id="get_pitchit_id" value="<?=$pit_details['pit_id']?>" />
                                            <input type="hidden" name="send_type" id="send_type" value="send" />
                                            <!--<input name="send" type="button" value="Send" class="button" onclick="SubmitForm1('send','<?//=$pitch_details['pit_id']?>')"/>-->
                                            <input name="send" type="submit" value="Send" class="button" style="margin-left: 10px;" />
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
               
                  
                  
                  
         <script>
         jQuery(document).ready(function($){
  //open popup
  $('#cd-popup-trigger_rep_vwall_'+<?php echo $pit_details['id']?>).on('click', function(event){
    event.preventDefault();
    $('#cd-popup_rep_vwall_'+<?php echo $pit_details['id']?>).addClass('is-visible');
  });
  
  //close popup
  $('#cd-popup_rep_vwall_'+<?php echo $pit_details['id']?>).on('click', function(event){
    if( $(event.target).is('.cd-popup-close') || $(event.target).is('#cd-popup_rep_vwall_'+<?php echo $pit_details['id']?>) ) {
      event.preventDefault();
      $(this).removeClass('is-visible');
    }
  });
  //close popup when clicking the esc keyboard button
  $(document).keyup(function(event){
      if(event.which=='27'){
        $('#cd-popup_rep_vwall_'+<?php echo $pit_details['id']?>).removeClass('is-visible');
      }
    });
    
    CKEDITOR.replace( 'editor3_<?php echo $mvallpit?>', {
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
                                  
  <div class="cd-popup" role="alert" id="cd-popup_rep_vwall_<?php echo $pit_details['id']?>">
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
                                            $single_user = $this->mwork->single_user($pit_details['user_id']);
                                            ?>
                                            
                                         <div  class="auto_main" id="parent_email_selected">  
                                            <span id="email_selected">      
                                        <span id="name<?=$pit_details['user_id'];?>" class="choosen">
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
                                        <img onclick="removeEmail(this,'<?=$pit_details['user_id'];?>')" src="<?=base_url()?>images/close_22.png">
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
                                        <input type="hidden" id="user_email_id" name="user_email_id" value="<?php echo !empty($total_response_recent['from_user_id']) ? $total_response_recent['from_user_id']:"";?>"/>
            
                                            <div class="clear"></div>
                                        </div>
                                        <div class="text_field_box3"><label style="float:left; margin-top:9px;">Subject</label>
                                        
                                        <input type="text" id="sub" name="sub"  class="sub_mail_content" value="Pitchit"/>
                                        <div class="clear"></div>
                                        
                                        </div>
                                        <div class="comm_tarea">
                                            <textarea class="ckeditor" cols="80" name="desc"  id="editor3_<?php echo $mvallpit?>" > </textarea>
                                        </div>
                                            <div class="clear"></div><br />
                                            
                                            <input type="hidden" name="is_pitchit" id="is_pitchit" value="1" />
                                            <input type="hidden" name="get_pitchit_id" id="get_pitchit_id" value="<?=$pit_details['pit_id']?>" />
                                            <input type="hidden" name="send_type" id="send_type" value="send" />
                                            
                                            <span style="display: none;"><input type="file" id="image" name="image" />
                                            <input name="draft" type="submit" value="Save Draft" class="button" style="margin-right:0 !important;"/>
                                            </span>
                                            
                                            <input name="submit" type="submit" value="Send" class="button" />
                                            
                                       </form>     
                                 
                                       <div class="clear">  </div> 
                                       
                                </div>
                                
    <a href="" class="cd-popup-close img-replace">Close</a>
        <div class="clear"></div>
  </div> 
     <div class="clear"></div>
</div>
                  
                  
                  
                  </td>
                  <td width="15%" class="center"><span id="pit_view_all_count_<?=$mvallpit?>"><?=$pitchit_view;?></span></td>
                  <td width="13%" class="center">
                  
                  <?php 
                       if(!empty($pit_details['created_date']))
                        {
                        $date = $pit_details['created_date'];
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
               
                  <?php $mvallpit++; } } else {?>

                <tr class="hov_col">
                  <td align="center" colspan="5"><div style="text-align:center">There are no Pitchits!</div></td>
                </tr>
                  
                  <?php } ?>
                
              </tbody>
            </table>

            <?php if(count($userViewallPitchitCount) > 5) {?>
            <div class="paginate_div">
            <?php if($view_more > 0){ ?><a href="javascript:;" onclick="getPitchit(<?php echo $page+1;?>, 'tab3', 'pitchit')" class="blue_but floright_martop">VIEW MORE</a><?php }else{?> <!--<a href="javascript:;" class="blue_but floright_martop">VIEW OLDER</a>--> <?php } ?>

            <?php if($offset == "0"){?>&nbsp;<?php }else{ ?> <a href="javascript:;" class="green_but floright_martop" onclick="getPitchit(<?php echo $page-1;?>, 'tab3', 'pitchit')">PREVIOUS</a> <?php } ?> 
             </div>
            <?php } ?>