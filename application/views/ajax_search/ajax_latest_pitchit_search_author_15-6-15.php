<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_new">
              <thead>
                <tr>
                  <th width="22%" >Pitched Work</th>
                  <th width="22%" >Viewed By</th>
                  <th width="29%" >PitchIt! Message</th>
                  <th width="15%" class="center">Times Viewed</th>
                  <th width="12%" class="center">Date</th>
                </tr>
              </thead>
              <tbody>
                
                <?php 
                   //echo '<pre/>';print_r($user_pitchit_details);die;
                   if(!empty($user_pitchit_details))
                    {
                    $i =1;   
                    $lp = 1; 
                     foreach($user_pitchit_details as $pitch_details)
                     {
                        $pitchit_view = $this->memail->get_user_pitchit_view_author($pitch_details['pvuid'],$pitch_details['pvpitid']);
                        //echo $this->db->last_query();
                        $pitchit_view_user = $this->memail->get_user_pitchit_view_user($pitch_details['pit_id']);
                        
                        $pitchit_msg = $this->memail->get_user_pitchit_msg($pitch_details['pit_id'],$pitch_details['pvuid']);
                        $total_response_recent  = $this->memail->get_user_pitchit_msg_recent($pitch_details['pit_id']);
                        //echo '<pre/>';print_r($pitchit_view_user);die;
                        if(!empty($total_response_recent))
                        {
                        $single_user = $this->mwork->single_user($total_response_recent['from_user_id']);
                        if(isset($single_user['id']) && $single_user['id'] !="")
                          $user_id =  $single_user['id'];
                        }
                        else
                        {
                         $single_user = $this->memail->get_user_pitchit_view_user($pitch_details['pit_id']); 
                         if(isset($single_user['user_id']) && $single_user['user_id'] !="")
                          $user_id =  $single_user['user_id'];
                        }
                            
                     ?>
                     
             
              <tr>
              
                  <td align="center">
                  
                  <a class="tooltips" href="javascript:void(0)" >
                  <?php 
                  if(strlen($pitch_details['title']) > 20)
                  {?>
                  <div title="<?php echo $pitch_details['title'];?>"><?php echo substr($pitch_details['title'],0,18).'...';?></div>
                    
                  <?php }
                  else
                  {
                    echo $pitch_details['title'];
                  }
                  ?>
                  </a>
                  </td>
                  <td align="center">
                   <?php 
                  if(!empty($pitch_details['pvuid']))
                  {
                    ?>
                    <?php if(!empty($user_id)){?>
                      <a class="tooltips" href="<?php echo base_url();?>discovery/user_details/<?php echo $pitch_details['pvuid'];?>" > 
                    <?php }else{?>
                      <a class="tooltips" href="javascript:void(0)" > 
                    <?php }?>
                    <?php $full_name5 = $pitch_details['name_first'].' '.$pitch_details['name_middle'].' '.$pitch_details['name_last'];
                    
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
                  <?php      
                  }
                  else
                  {
                    echo 'N/A';
                  }
                  ?>
                  </td>
                  <td align="center" style="cursor: pointer;" id="pit_work_lat_first_<?=$lp;?>" >
                  
                 <div class="think_img">
                  <?php if($pitchit_msg['count'] > 0) { ?>
                  
                  <a class="tooltips" href="javascript:void(0)" title="An AEP has respond to your pitch, click here to see the conversation">
                  
                  <img src="<?=base_url()?>images/think.png" alt="" />
                                   
                  <?php
           if(strlen($pitch_details['pitchit']) > 16)
                      {

                      echo substr($pitch_details['pitchit'],0,16).'..';
                      }
                   else
                      {
                      echo $pitch_details['pitchit'];  
                      }
                         
                  ?>
                
                  </a>
                  
                  <script type="text/javascript">
                $(document).ready(function () {
                   
                   
                   
                   $('#pit_work_lat_first_'+<?=$lp;?>).click(function () {
                        
                        $(".pit_work_dialog").hide();
                       //$("#pit_work_dialog_lat_first_"+<?//=$pitch_details['pit_id']?>).css('display','none');
                     
                        
                            $("#pit_work_dialog_lat_first_"+<?=$lp;?>).dialog({
                                
                                 position:  {
                                            my: "left",
                                            at: "left",
                                            of: $('#tab1')
                                        }
                                
                            });
                            $("#pit_work_dialog_lat_first_"+<?=$lp;?>).show();
                            //$(".pit_work_dialog").addClass('pit_work_dialog_pos_mid');
                          
                        
                    }); 
                    $('#cancl_pit_rep_'+<?=$lp;?>).click(function () {
                       
                            //$("#pit_work_dialog_lat_first_"+<?=$lp;?>).dialog('close');
                            //$('#chkBoxHelp_'+<?=$lp;?>).prop('checked', false);
                            $("#pit_work_dialog_lat_first_"+<?=$lp;?>).hide();
                        
                       });   
                });
                </script>
                  
                  <div id="pit_work_dialog_lat_first_<?=$lp;?>" style="display: none;" class="pit_work_dialog">
                    <h1><?=$total_response_recent['subject']?>
                    </h1>
                   <?php /* <p>An AEP member has sent a message to you <?=$total_response_recent['body']?></p> */ ?>
                    <p><?=$full_name5?> has sent a message to you <?=$total_response_recent['body']?></p>
                    
                  <a href="javascript:void(0);" id="cancl_pit_rep_<?=$lp;?>" class="green_but">Close</a>
                  <a href="#0" class="cd-popup-trigger" id="cd-popup-trigger_first_<?php echo $lp;?>" style="background: none !important;">
                  <img src="<?=base_url()?>images/think.png" alt="" /></a>
                  
                  </div>
                  
                  
                  
                  
 <script>
 jQuery(document).ready(function($){
  //open popup
  $('#cd-popup-trigger_first_'+<?php echo $lp;?>).on('click', function(event){
    event.preventDefault();
    $('#cd-popup_first_'+<?php echo $lp;?>).addClass('is-visible');
  });
  
  //close popup
  $('#cd-popup_first_'+<?php echo $lp;?>).on('click', function(event){
    if( $(event.target).is('.cd-popup-close') || $(event.target).is('#cd-popup_first_'+<?php echo $lp;?>) ) {
      event.preventDefault();
      $(this).removeClass('is-visible');
    }
  });
  //close popup when clicking the esc keyboard button
  $(document).keyup(function(event){
      if(event.which=='27'){
        $('#cd-popup_first_'+<?php echo $lp;?>).removeClass('is-visible');
      }
    });
    
    
     CKEDITOR.replace( 'editor2_<?php echo $lp;?>', {
            removeButtons: 'Source',
            // The rest of options...
        }); 
    
});

function SubmitForm1(type)
{
    //alert('fg');
   

     document.getElementById('composeFrm').action='<?=base_url()?>mail/compose/'+type;
     document.getElementById('composeFrm').submit();
     //window.location.reload();
     
     return true;
}
         </script>         
                                  
  <div class="cd-popup" role="alert" id="cd-popup_first_<?php echo $lp;?>">
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
               
               <?php //$single_user = $this->mwork->single_user($pitchit_view_user['user_id']);
               
               ?>
               
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
                
                <input type="text" id="sub" name="sub"  class="sub_mail_content" value="<?php echo ucwords($full_name);?> has pitched the title <?=$pitch_details['title']?> to you"/>
                <div class="clear"></div>
                
                </div>
                <div class="comm_tarea">
                    <textarea class="ckeditor" cols="80" name="desc"  id="editor2_<?php echo $lp;?>" > </textarea>
                </div>
                    <div class="clear"></div><br />
                    <span style="display: none;"><input type="file" id="image" name="image" />
                    <input name="draft" type="submit" value="Save Draft" class="button" style="margin-right:0 !important;"/>
                    </span>
                    
                    <input type="hidden" name="is_pitchit" id="is_pitchit" value="1" />
                    <input type="hidden" name="get_pitchit_id" id="get_pitchit_id" value="<?=$pitch_details['pit_id']?>" />
                    <input type="hidden" name="send_type" id="send_type" value="send" />
                    
                    <input name="submit" type="submit" value="Send" class="button" />
                    
                    
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
                  <span id="pit_work_vw22_<?=$lp;?>" style="cursor: pointer;" title="<?=$pitch_details['pitchit'];?>">
                  <?=substr($pitch_details['pitchit'],0,30).'..'?>
                  </span>
                  
                     <?php  
                      }
                   else
                      {
                      ?>  
                      
                   <span id="pit_work_vw22_<?=$lp;?>" style="cursor: pointer;">
                  <?=$pitch_details['pitchit']?>
                  </span> 
                   <?php    
                      }
          ?>        
             
                  
                  <script type="text/javascript">
                $(document).ready(function () {
                   
                   $('#pit_work_vw22_'+<?=$lp;?>).click(function () {
                        
                            $('.pit_work_dialog').hide();
                            
                            $("#pit_work_dialog_vw22_"+<?=$lp;?>).dialog({
                                
                                
                                position:  {
                                            my: "left",
                                            at: "left",
                                            of: $('#tab1')
                                        },
                                
                                close: function () {
                                    
                                     //$('#pit_work').data('clicked', false);
                                }
                            });
                            $("#pit_work_dialog_vw22_"+<?=$lp;?>).show();
                            //$('.pit_work_dialog').addClass('pit_work_dialog_pos_mid');
                        
                    });
                    
                    
                     $('#cancl_pit_vw_'+<?=$lp;?>).click(function () {
                       
                            //$(".pit_work_dialog_vw22_"+<?=$lp;?>).dialog('close');
                            $("#pit_work_dialog_vw22_"+<?=$lp;?>).hide();
                            
                        
                    }); 
                    
                });
                </script>
                  
                  <div id="pit_work_dialog_vw22_<?=$lp;?>" style="display: none;" class="pit_work_dialog">
                  
                  
                  <h1><?=$pitch_details['title']?> was viewed by 
                    <?php 
                      if(!empty($full_name5))
                      {
                        echo $full_name5;
                      }
                      else
                      {
                        echo 'N/A';
                      }
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
                     viewed <?=$pitchit_view;?> times.
                    </h1>
                  <p>This person will message you directly if they are interested in your work.</p>
                    <p><strong> Original PitchIt! Message on 
                    
                    <?php 
                       if(!empty($pitch_details['created_date']))
                        {
                        $date_srt = $pitch_details['created_date'];
                        $timestamp_2 = strtotime($date_srt);
                        $new_date_crt = date("m/d/y", $timestamp_2);
                        echo $new_date_crt;
                       
                        }
                        else
                        {
                          echo 'N/A';  
                        }
                      ?>
                    
                    </strong></p>
                    <p><?=$pitch_details['pitchit'];?></p>
                    <a href="javascript:void(0);" id="cancl_pit_vw_<?=$lp;?>" class="green_but">Close</a>
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
                
               <?php $lp++;} }  else {?> 
              
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

<?php if(count($AuthorLatestPitchitCount) > 5) {?>
<div class="paginate_div">
<?php if($view_more > 0){ ?><a href="javascript:;" onclick="ajaxLatestPitchit(<?php echo $page_latest+1;?>)" class="blue_but floright_martop">VIEW MORE</a><?php }else{?> <!--<a href="javascript:;" class="blue_but floright_martop">VIEW OLDER</a>--> <?php } ?>

<?php if($offset_latest == "0"){?>&nbsp;<?php }else{ ?> <a href="javascript:;" class="green_but floright_martop" onclick="ajaxLatestPitchit(<?php echo $page_latest-1;?>)">PREVIOUS</a> <?php } ?> 
 </div>
<?php } ?>