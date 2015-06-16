<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_new">
              <thead>
                <tr>
                  <th width="22%"><div>Pitched Work</div></th>
                  <th width="22%"><div>Sent By</div></th>
                  <th width="25%"><div>PitchIt! Message</div></th>
                  <th width="6%" class="center"><div>Edit</div></th>
                  <th width="19%" class="center"><div>Rank</div></th>
                  <th width="6%" class="center"><div>Keep</div></th>
                </tr>
              </thead>
              <tbody>
                
                
                <?php
                //echo '<pre/>';print_r($pitchit_details_limit);die; 
                   //echo '<pre/>';print_r($user_pitchit_details);die;
                   if(!empty($userSavedPitchitDetails))
                    {
                    $i =1;    
                     foreach($userSavedPitchitDetails as $pitch_details)
                     {
                        $pitchit_view = $this->memail->get_user_pitchit_view($pitch_details['wid']);
                        $pitchit_view_user = $this->memail->get_user_pitchit_send_user($pitch_details['pitchit_user']);
                        
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
                     
                  <a href="javascript:void(0);" class="cd-popup-trigger" id="save_pitch_<?php echo $pitch_details['pit_id']?>">Save</a>
                  <a href="javascript:void(0);" id="cancl_pit_save_<?=$pitch_details['pit_id']?>" class="green_but">Close</a>
                  </div>
                  
        
                  
                  </td>
                  <td align="center">
                  
                  <?php 
                      if(!empty($pitchit_view_user))
                      {
                        $fullname = $pitchit_view_user['name_first'].' '.$pitchit_view_user['name_middle'].' '.$pitchit_view_user['name_last'];
                        //echo $pitchit_view_user['name_first'].' '.$pitchit_view_user['name_middle'].' '.$pitchit_view_user['name_last'];
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
                  
                  
                  <span id="pit_work_lat_first_save_<?=$pitch_details['pit_id']?>" style="cursor: pointer;">
                   
                  <?php if(strlen($pitch_details['pitchit']) > 30) {?>
                    <div class="new_tiptool" title="<?php echo $pitch_details['pitchit'];?>"><?php echo substr($pitch_details['pitchit'],0,28).'..';?></div>
                  <?php } else { 
                      echo $pitch_details['pitchit'];
                   }?>
                  <!--<span id="pit_work_lat_<?=$pitch_details['id']?>" style="cursor: pointer;">
                  
                  <img src="<?=base_url()?>images/think.png" alt="" />
                  </span>-->
                  
                  </span>
              
                  </td>
                  <td class="center"><?php //echo $pitchit_view;?>
                    <!--<input type="checkbox" name="edit" id="pit_work_dialog_lat_first_edit_<?=$pitch_details['pit_id']?>" value="<?=$pitch_details['pit_id']?>">-->
                    <div class="check_box"> 
                    <input type="checkbox" name="checkboxG4" id="pit_work_dialog_lat_first_edit_<?=$pitch_details['pit_id']?>" value="<?=$pitch_details['pit_id']?>" class="css-checkbox" />
                    <label for="pit_work_dialog_lat_first_edit_<?=$pitch_details['pit_id']?>" class="css-label"></label>
                  </div>

                    <script type="text/javascript">
                $(document).ready(function () {
                   
                   $('#pit_work_dialog_lat_first_edit_'+<?=$pitch_details['pit_id']?>).click(function () {
                        //$('.pit_work_dialog').hide();
                            //$('.pit_work_dialog_vw').hide();
                          if($("#pit_work_dialog_lat_first_edit_"+<?=$pitch_details['pit_id']?>).is(':checked')){
                            $("input[type='checkbox']").attr('disabled',true);
                             $("#pit_work_dialog_open_"+<?=$pitch_details['pit_id']?>).dialog({
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
                   
                          $("#pit_work_dialog_open_"+<?=$pitch_details['pit_id']?>).show();
                      }else{
                          $("#pit_work_dialog_open_"+<?=$pitch_details['pit_id']?>).hide();
                      }

                    });

                    $('#close_pitch_'+<?=$pitch_details['pit_id']?>).click(function () {
                       $("#pit_work_dialog_open_"+<?=$pitch_details['pit_id']?>).hide();
                       $('#pit_work_dialog_lat_first_edit_'+<?=$pitch_details['pit_id']?>).attr('checked', false);
                       $("input[type='checkbox']").attr('disabled',false);
                    });
                    
                    
                    
                });
                </script>
                <div id="pit_work_dialog_open_<?=$pitch_details['pit_id']?>" style="display: none;" class="pit_work_dialog">
                  <span style="color: green;" id="pit_save_<?=$pitch_details['pit_id']?>"></span>
                  
                    <h1>Saved <?=$pitch_details['title']?> Pitchit!</h1>
                    <!--<p>An AEP member will message you directly if he/she is interested in your work</p>-->
                    <p><strong>This PitchIt! was last edited on
                    
                     <?php 
                       if(!empty($pitch_details['modified_date']))
                        {
                        $date = $pitch_details['modified_date'];
                        $timestamp = strtotime($date);
                        $new_date = date("m/d/y", $timestamp);
                        echo $new_date;
                        }
                        else
                        {
                          echo 'N/A';  
                        }
                      ?>
                    
                    </strong></p>
                  <p id="pit_msg<?php echo $pitch_details['pit_id']?>"><?=$pitch_details['pitchit'];?></p>
                  <p id="hide_pit_msg<?php echo $pitch_details['pit_id']?>" style="display:none;">
                    <textarea name="pitchit_msg<?php echo $pitch_details['pit_id']?>" id="pitchit_msg<?php echo $pitch_details['pit_id']?>" cols="30" rows="4"><?=$pitch_details['pitchit'];?></textarea></p>
                  <a href="javascript:void(0);" onClick="showEditPitchit('<?php echo $pitch_details['pit_id']?>')" class="yellow_but" id="edit_pitch_<?php echo $pitch_details['pit_id']?>">Edit</a>
                  <a href="javascript:void(0);" onClick="savePitchit('<?php echo $pitch_details['pit_id']?>')"  class="blue_but" id="save_pitch<?=$pitch_details['pit_id']?>">Save</a>   
                  <a href="javascript:void(0);" class="green_but" id="close_pitch_<?php echo $pitch_details['pit_id']?>">Close</a>
                  <a href="javascript:void(0);" class="pitchit_pop_icon" id="pitch_icn" style="display: block;"><img src="<?=base_url()?>images/icon_p.png"></a>
                  </div>

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
               
               <?php } } else {?>
               
               <tr class="hov_col">
                  <td align="center"></td>
                  <td align="center"></td>
                  <td align="center">No saved Pitchits!</td>
                  <td align="center"></td>
                  <td align="center"></td>
                  <td align="center"></td>
                </tr>
               
               <?php } ?>

                <!--<tr>
                  <td width="20%" align="center">Book of Jobe</td>
                  <td width="20%" align="center">Peter Smith</td>
                  <td width="25%" align="center"><img src="<?//=base_url()?>images/think.png" alt="" /> Think you will…</td>
                  <td width="17%" align="center">5</td>
                  <td width="18%" align="center">12/16/14</td>
                </tr>
                <tr class="hov_col">
                  <td align="center">Book of Moses</td>
                  <td align="center">Joe Jones</td>
                  <td align="center">Thought you…</td>
                  <td align="center">4</td>
                  <td align="center">11/26/14</td>
                </tr>-->
           
                
              </tbody>
            </table>

            <?php if(count($userSavedPitchitCount) > 5) {?>
            <div class="paginate_div">
            <?php if($view_more > 0){ ?><a href="javascript:;" onclick="ajaxSavedPitchit(<?php echo $page_saved+1;?>)" class="blue_but floright_martop">VIEW MORE</a><?php }else{?> <!--<a href="javascript:;" class="blue_but floright_martop">VIEW OLDER</a>--> <?php } ?>

            <?php if($offset_saved == "0"){?>&nbsp;<?php }else{ ?> <a href="javascript:;" class="green_but floright_martop" onclick="ajaxSavedPitchit(<?php echo $page_saved-1;?>)">PREVIOUS</a> <?php } ?> 
             </div>
            <?php } ?>