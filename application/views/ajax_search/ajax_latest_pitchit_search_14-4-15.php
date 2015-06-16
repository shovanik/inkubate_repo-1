
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_new">
              <thead>
                <tr>
                  <th width="22%"><div>Pitched Work</div></th>
                  <th width="22%"><div>Sent By</div></th>
                  <th width="28%"><div>PitchIt! Message</div></th>
                  <th width="15%" class="center"><div>Times Viewed</div></th>
                  <th width="13%" class="center"><div>Date</div></th>
                </tr>
              </thead>
              <tbody>
                
                
                <?php
                //echo '<pre/>';print_r($pitchit_details_limit);die; 
                   //echo '<pre/>';print_r($user_pitchit_details);die;
                   if(!empty($userLatestPitchitDetails))
                    {
                    $i =1;    
                     foreach($userLatestPitchitDetails as $pitch_details)
                     {
                        $pitchit_view = $this->memail->get_user_pitchit_view($pitch_details['wid']);
                        //$pitchit_view = $this->memail->get_user_pitchit_view($pitch_details['pvuid'],$pitch_details['pwid'],$pitch_details['pvpitid']);
                        $pitchit_view_user = $this->memail->get_user_pitchit_send_user($pitch_details['pitchit_user']);
                        
                        //echo '<pre/>';print_r($pitchit_view_user);die;
                     ?>
                
               <tr class="">
                  <td align="center">
                  <span style="cursor: pointer;" onclick="openDialog(<?php echo $pitch_details['wid'];?>,<?php echo $pitch_details['user_id'];?>)">
                  <?php
                  if(strlen($pitch_details['title']) > 20){?>
                    <div title="<?php echo $pitch_details['title'];?>"><?php echo substr($pitch_details['title'],0,20).'..';?></div>
                  <?php }else{
                    echo $pitch_details['title'];
                  }
                  ?>
                  
                  </span>
                  
                  
                  
                  <script type="text/javascript">
                $(document).ready(function () {
                   
                   $('#pit_work_lat_first_'+<?=$pitch_details['pit_id']?>).click(function () {
                        
                            $('.pit_work_dialog').hide();
                            $('.pit_work_dialog_vw').hide();
                            $("#pit_work_dialog_lat_first_"+<?=$pitch_details['pit_id']?>).dialog({
                                position:  {
                                            my: "left",
                                            at: "left",
                                            of: $('#tab1')
                                        }
                            });
                            
               
                      
                         $.ajax({
                           url      : '<?=base_url()?>'+'work/pitchit_single_view',
                           type     : 'POST',
                           data     : { 'pit_id': <?=$pitch_details['pit_id']?> , 'wid' : <?=$pitch_details['wid']?> },
                           success  : function(resp){
                            //alert(resp);
                                if(resp == 0){
                                    //$("#pitcnt").html(resp);
                                    //$("#edit_class" ).dialog( "close" );
                                }
                           },
                           error    : function(resp){
                                $.prompt("Sorry, something isn't working right.", {title:'Error'});
                           }
                        });   
                   
                        $("#pit_work_dialog_lat_first_"+<?=$pitch_details['pit_id']?>).show();    
                        
                    });
                    
                     $('#cancl_pit_'+<?=$pitch_details['pit_id']?>).click(function () {
                       
                            //$("#pit_work_dialog_lat_first_"+<?//=$pitch_details['pit_id']?>).dialog('close');
                            $("#pit_work_dialog_lat_first_"+<?=$pitch_details['pit_id']?>).hide();
                        
                    });
                    
                });
                </script>
                  
                  <div id="pit_work_dialog_lat_first_<?=$pitch_details['pit_id']?>" style="display: none;" class="pit_work_dialog">
                    <h1><?=$pitch_details['title']?> was sent by 
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
                       if(!empty($pitch_details['created_date']))
                        {
                        $date = $pitch_details['created_date'];
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
                    <p><strong>Original PitchIt!
                    
                     <?php 
                       /*if(!empty($pitch_details['created_date']))
                        {
                        $date = $pitch_details['created_date'];
                        $timestamp = strtotime($date);
                        $new_date = date("m/d/y", $timestamp);
                        echo $new_date;
                        }
                        else
                        {
                          echo 'No Date';  
                        }*/
                      ?>
                    
                    </strong></p>
                    <p><?=$pitch_details['pitchit'];?></p>
                     
                  <a href="#0" class="cd-popup-trigger" id="cd-popup-trigger_first_<?php echo $pitch_details['pit_id']?>">Reply</a>
                  <a href="javascript:void(0);" id="cancl_pit_<?=$pitch_details['pit_id']?>" class="green_but">Close</a>
                  </div>
                  
                  
                  
                  
         <script>
         jQuery(document).ready(function($){
  //open popup
  $('#cd-popup-trigger_first_'+<?php echo $pitch_details['pit_id']?>).on('click', function(event){
    event.preventDefault();
    $('#cd-popup_first_'+<?php echo $pitch_details['pit_id']?>).addClass('is-visible');
  });
  
  //close popup
  $('#cd-popup_first_'+<?php echo $pitch_details['pit_id']?>).on('click', function(event){
    if( $(event.target).is('.cd-popup-close') || $(event.target).is('#cd-popup_first_'+<?php echo $pitch_details['pit_id']?>) ) {
      event.preventDefault();
      $(this).removeClass('is-visible');
    }
  });
  //close popup when clicking the esc keyboard button
  $(document).keyup(function(event){
      if(event.which=='27'){
        $('#cd-popup_first_'+<?php echo $pitch_details['pit_id']?>).removeClass('is-visible');
      }
    });
    
     CKEDITOR.replace( 'editor2_<?php echo $pitch_details['pit_id']?>', {
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
  <div class="cd-popup" role="alert" id="cd-popup_first_<?php echo $pitch_details['pit_id']?>">
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
                                            $single_user = $this->mwork->single_user($pitch_details['pitchit_user']);
                                            ?>
                                            
                                         <div  class="auto_main" id="parent_email_selected">  
                                            <span id="email_selected">      
                                        <span id="name<?=$pitch_details['pitchit_user'];?>" class="choosen">
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
                                        <img onclick="removeEmail(this,'<?=$pitch_details['pitchit_user'];?>')" src="<?=base_url()?>images/close_22.png">
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
                                        <input type="hidden" id="user_email_id" name="user_email_id" value="<?=$pitch_details['pitchit_user'];?>"/>
            
                                        <!--<input type="hidden" id="user_email_id" name="user_email_id"/>
                                         <label class="com_plus"> <a href="#showAuthorList" class="nohover add_img" rel="facebox" data-url=""><img src="<?php echo base_url('images/plus_icon.png')?>" /></a></label>-->
                                         
                                     
                                            <div class="clear"></div>
                                        </div>
                                        <div class="text_field_box3"><label style="float:left; margin-top:9px;">Subject</label>
                                        
                                        <input type="text" id="sub" name="sub"  class="sub_mail_content" value="<?php echo ucwords($full_name);?> has pitched the title <?=$pitch_details['title']?> to you"/>
                                        <div class="clear"></div>
                                        
                                        </div>
                                        <div class="comm_tarea">
                                            <textarea class="ckeditor" cols="80" name="desc"  id="editor2_<?php echo $pitch_details['pit_id']?>" > </textarea>
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
                  
                  
                  
                  
                  
                  </td>
                  <td align="center">
                  
                  
                  
                  <?php 
                  if(!empty($pitchit_view_user))
                  {
                    $fullname = $pitchit_view_user['name_first'].' '.$pitchit_view_user['name_middle'].' '.$pitchit_view_user['name_last'];
                  ?>    
                  <a href="<?=base_url()?>discovery/user_details/<?=$pitch_details['pitchit_user']?>">
                  <?php 
                  if(strlen($fullname) > 20){?>
                    <div title="<?php echo $fullname;?>"><?php echo substr($fullname,0,18).'..';?></div>
                  <?php }else{
                    echo $fullname;   
                  }
                   ?>
                   
                   <!-- <span class="tp_span55"> <?php echo $fullname; ?></span>
 <div class="clear"></div> -->
                   
                   </a>
                   <?php   
                      }
                      else
                      {
                        echo 'No Sender';
                      }
                      ?>
                  
                  </td>
                  <td align="center">
                  
                  
                  <span id="pit_work_lat_first_<?=$pitch_details['pit_id']?>" style="cursor: pointer;">
                   
                  <?php if(strlen($pitch_details['pitchit']) > 30) {?>
                      <div title="<?php echo $pitch_details['pitchit'];?>"><?php echo substr($pitch_details['pitchit'],0,30).'..';?></div>
                  <?php } else { 
                      echo $pitch_details['pitchit']; 
                    }?>
                  <!--<span id="pit_work_lat_<?=$pitch_details['id']?>" style="cursor: pointer;">
                  
                  <img src="<?=base_url()?>images/think.png" alt="" />
                  </span>-->
                  
                  </span>
              
                  </td>
                  <td class="center" ><?=$pitchit_view?></td>
                  <td class="center" >
                  
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
               
               <?php } } else {?>
               
               <tr class="hov_col">
                  <td align="center"></td>
                  <td align="center"></td>
                  <td align="center">There are no Latest Pitchits!</td>
                  <td align="center"></td>
                  <td align="center"></td>
                </tr>
               
               <?php } ?>
               </tbody>
            </table>

            <?php if(count($userLatestPitchitCount) > 5) {?>
            <div class="paginate_div">
            <?php if($view_more > 0){ ?><a href="javascript:;" onclick="ajaxLatestPitchit(<?php echo $page_latest+1;?>)" class="blue_but floright_martop">VIEW MORE</a><?php }else{?> <!--<a href="javascript:;" class="blue_but floright_martop">VIEW OLDER</a>--> <?php } ?>

            <?php if($offset_latest == "0"){?>&nbsp;<?php }else{ ?> <a href="javascript:;" class="green_but floright_martop" onclick="ajaxLatestPitchit(<?php echo $page_latest-1;?>)">PREVIOUS</a> <?php } ?> 
             </div>
            <?php } ?>