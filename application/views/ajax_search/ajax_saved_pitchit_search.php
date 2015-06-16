<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_new">
              <thead>
                <tr>
                  <th width="22%"><div>Pitched Work</div></th>
                  <th width="22%"><div>Sent By</div></th>
                  <th width="26%"><div>PitchIt! Message</div></th>
                  <!-- <th width="6%" class="center"><div>Edit</div></th> -->
                  <th width="14%" class="center"><div>Rank</div></th>
                  <th width="10%" class="center"><div>Keep</div></th>
                </tr>
              </thead>
              <tbody>
                
                
                <?php
                //echo '<pre/>';print_r($pitchit_details_limit);die; 
                   //echo '<pre/>';print_r($user_pitchit_details);die;
                   if(!empty($userSavedPitchitDetails))
                    {
                    $i =1;
                    $mvallpit_sv = 1;    
                     foreach($userSavedPitchitDetails as $pitch_details)
                     {
                        $pitchit_view = $this->memail->get_user_pitchit_view($pitch_details['wid']);
                        //$pitchit_view_user = $this->memail->get_user_pitchit_send_user($pitch_details['pitchit_user']);
                        $pitchit_view_user = $this->memail->get_user_pitchit_send_user_auth($pitch_details['wid']);
                        
                        //echo '<pre/>';print_r($pitchit_view_user);die;
                     ?>
                
               <tr>
                  <td align="center">
                  <span style="cursor: pointer;" onclick="openDialog(<?php echo $pitch_details['wid'];?>,<?php echo $pitch_details['user_id'];?>)"> 
                  <?php
                  if(strlen($pitch_details['title']) > 20){?>
                    <div title="<?php echo $pitch_details['title'];?>"><?php echo substr($pitch_details['title'],0,20).'..';?></div>
                  <?php } else {
                    echo $pitch_details['title'];
                  }?>
                 </span>
                  <script type="text/javascript">
                $(document).ready(function () {
                   
                   $('#pit_work_lat_first_save_'+<?=$pitch_details['pit_id']?>).click(function () {
                        
                            $('.pit_work_dialog').hide();
                            $('.pit_work_dialog_vw').hide();
                            $("#pit_work_dialog_lat_first_save_"+<?=$pitch_details['pit_id']?>).dialog({
                                
                                position:  {
                                            my: "left",
                                            at: "left",
                                            of: $('#tab2')
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
                   
                        $("#pit_work_dialog_lat_first_save_"+<?=$pitch_details['pit_id']?>).show();    
                        
                    });
                    
                     $('#cancl_pit_save_'+<?=$pitch_details['pit_id']?>).click(function () {
                       
                            //$("#pit_work_dialog_lat_first_save_"+<?=$pitch_details['pit_id']?>).dialog('close');
                            $("#pit_work_dialog_lat_first_save_"+<?=$pitch_details['pit_id']?>).hide();
                        
                    });
                    
                   
                    $('#save_pitch_'+<?=$pitch_details['pit_id']?>).click(function () {
                        
                    if(confirm('Are you sure to save this Pitchits!?'))
                       {
                        $.ajax({
                           url      : '<?=base_url()?>'+'work/pitchit_single_save',
                           type     : 'POST',
                           data     : { 'pit_id': <?=$pitch_details['pit_id']?> , 'wid' : <?=$pitch_details['wid']?> },
                           success  : function(resp){
                            //alert(resp);
                                if(resp == 1){
                                    $("#pit_save_"+<?=$pitch_details['pit_id']?>).html('Successfully Saved');
                                    $("#pit_save_td_"+<?=$pitch_details['pit_id']?>).html('Saved');
                                    //$("#edit_class" ).dialog( "close" );
                                }
                                else{
                                    $("#pit_save_"+<?=$pitch_details['pit_id']?>).html('Already Saved');
                                }
                           },
                           error    : function(resp){
                                $.prompt("Sorry, something isn't working right.", {title:'Error'});
                           }
                        });
                        
                      }  
                      else
                      {
                        return false;
                      }  
                        
                        
                    }); 
                    
                    
                });
                </script>
                  
                  <div id="pit_work_dialog_lat_first_save_<?=$pitch_details['pit_id']?>" style="display: none;" class="pit_work_dialog">
                  
                  <span style="color: green;" id="pit_save_<?=$pitch_details['pit_id']?>"></span>
                  
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
                    <p><strong>Original PitchIt!</strong></p>
                    <p><?=urldecode($pitch_details['pitchit']);?></p>
                     
                  <!--<a href="javascript:void(0);" class="cd-popup-trigger" id="save_pitch_<?php //echo $pitch_details['pit_id']?>">Save</a>-->
                  <a href="#0" class="cd-popup-trigger" id="cd-popup-trigger_first_vall_aps_<?php echo $pitch_details['pit_id']?>">Reply</a>
                  <a href="javascript:void(0);" id="cancl_pit_save_<?=$pitch_details['pit_id']?>" class="green_but">Close</a>
                  </div>
                  
        
        
        <script>
         jQuery(document).ready(function($){
  //open popup
  $('#cd-popup-trigger_first_vall_aps_'+<?php echo $pitch_details['pit_id']?>).on('click', function(event){
    event.preventDefault();
    $('#trigger_first_vall_aps_'+<?php echo $pitch_details['pit_id']?>).addClass('is-visible');
        $('#pit_work_dialog_lat_first_save_<?=$pitch_details['pit_id']?>').hide();
  });
  
  //close popup
  $('#trigger_first_vall_aps_'+<?php echo $pitch_details['pit_id']?>).on('click', function(event){
    if( $(event.target).is('.cd-popup-close') || $(event.target).is('#trigger_first_vall_aps_'+<?php echo $pitch_details['pit_id']?>) ) {
      event.preventDefault();
      $(this).removeClass('is-visible');
    }
  });
  //close popup when clicking the esc keyboard button
  $(document).keyup(function(event){
      if(event.which=='27'){
        $('#trigger_first_vall_aps_'+<?php echo $pitch_details['pit_id']?>).removeClass('is-visible');
      }
    });
    
     CKEDITOR.replace( 'editor27_<?php echo $mvallpit_sv; ?>', {
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
  <div class="cd-popup" role="alert" id="trigger_first_vall_aps_<?php echo $pitch_details['pit_id']?>">
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
                                              if(!empty($pitchit_view_user['name_first']))
                                              {
                                               echo $pitchit_view_user['name_first'].' ';
                                              }
                                              if(!empty($pitchit_view_user['name_midle']))
                                              {
                                               echo $pitchit_view_user['name_midle'].' ';
                                              }
                                              if(!empty($pitchit_view_user['name_last']))
                                              {
                                               echo $pitchit_view_user['name_last'];
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
                                          if(!empty($pitchit_view_user['name_first']))
                                          {
                                           $full_name.=$pitchit_view_user['name_first'].' ';
                                          }
                                          if(!empty($pitchit_view_user['name_midle']))
                                          {
                                           $full_name.=$pitchit_view_user['name_midle'].' ';
                                          }
                                          if(!empty($pitchit_view_user['name_last']))
                                          {
                                           $full_name.=$pitchit_view_user['name_last'];
                                          }
                                          ?>
                                        <input type="hidden" id="user_mail" name="user_mail" readonly="readonly" value="<?php echo $full_name;?>"/>
                                        <input type="hidden" id="user_email_id" name="user_email_id" value="<?=$pitchit_view_user['id'];?>"/>
            
                                        <!--<input type="hidden" id="user_email_id" name="user_email_id"/>
                                         <label class="com_plus"> <a href="#showAuthorList" class="nohover add_img" rel="facebox" data-url=""><img src="<?php echo base_url('images/plus_icon.png')?>" /></a></label>-->
                                         
                                     
                                            <div class="clear"></div>
                                        </div>
                                        <div class="text_field_box3"><label style="float:left; margin-top:9px;">Subject</label>
                                        
                                        <input type="text" id="sub" name="sub"  class="sub_mail_content" value="<?php echo ucwords($full_name);?> has pitched the title <?=$pitch_details['title']?> to you"/>
                                        <div class="clear"></div>
                                        
                                        </div>
                                        <div class="comm_tarea">
                                            <textarea class="ckeditor" cols="80" name="desc"  id="editor27_<?php echo $mvallpit_sv;?>" > </textarea>
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
                        //echo $pitchit_view_user['name_first'].' '.$pitchit_view_user['name_middle'].' '.$pitchit_view_user['name_last'];
                      ?>
                  <a href="<?=base_url()?>discovery/user_details/<?=$pitchit_view_user['id']?>">
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
                  
                  
                  <span id="pit_work_lat_first_save_<?=$pitch_details['pit_id']?>" style="cursor: pointer;">
                   
                  <?php if(strlen($pitch_details['pitchit']) > 30) {?>
                    <div class="new_tiptool" title="<?php echo $pitch_details['pitchit'];?>"><?php echo substr(urldecode($pitch_details['pitchit']),0,28).'..';?></div>
                  <?php } else { 
                      echo urldecode($pitch_details['pitchit']);
                   }?>
                  <!--<span id="pit_work_lat_<?=$pitch_details['id']?>" style="cursor: pointer;">
                  
                  <img src="<?=base_url()?>images/think.png" alt="" />
                  </span>-->
                  
                  </span>
              
                  </td>
                  
                  <td class="center">
                    <select name="rank" id="rank" style="width:50px;height:24px" onchange="changeRank(this.value, <?=$pitch_details['pit_id']?>)">
                      <option value="1" <?php if($pitch_details['rank'] == 1){?>selected<?php }?>>1</option>
                      <option value="2" <?php if($pitch_details['rank'] == 2){?>selected<?php }?>>2</option>
                      <option value="3" <?php if($pitch_details['rank'] == 3){?>selected<?php }?>>3</option>
                    </select>
                  </td>
                  <td class="center">
                  <?php $save_check = $this->memail->update_pitchit_single_savecheck($pitch_details['pit_id'],$pitch_details['wid']);?>
                  <span id="pit_save_td_<?=$pitch_details['pit_id']?>">
                  <?php //echo ($save_check['count'] == "0") ? 'Not Saved' : 'Saved';?>
                  <a href="javascript:void(0);" onClick="deletePitchit('<?php echo $pitch_details['pit_id']?>', '<?php echo $pitch_details['wid']?>')"><img src="<?php echo base_url();?>images/delete_new.png" alt=""></a>

                  </span>
                  </td>
                </tr>
               
               <?php $mvallpit_sv++;} } else {?>
               
                <tr class="hov_col">
                  <td align="center" colspan="5"><div style="text-align:center">There are no Pitchits!</div></td>
                </tr>
               
               <?php } ?>

              </tbody>
            </table>

<?php if(!empty($userSavedPitchitCount)) { if(count($userSavedPitchitCount) > 5) {?>
<div class="paginate_div">
<?php if($view_more > 0){ ?><a href="javascript:;" onclick="getPitchit(<?php echo $page+1;?>, 'tab2', 'pitchit')" class="blue_but floright_martop">VIEW MORE</a><?php }else{?> <!--<a href="javascript:;" class="blue_but floright_martop">VIEW OLDER</a>--> <?php } ?>

<?php if($offset == "0"){?>&nbsp;<?php }else{ ?> <a href="javascript:;" class="green_but floright_martop" onclick="getPitchit(<?php echo $page-1;?>, 'tab2', 'pitchit')">PREVIOUS</a> <?php } ?> 
 </div>
<?php } } ?>