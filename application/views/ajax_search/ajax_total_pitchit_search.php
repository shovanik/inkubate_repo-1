<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_new">
              <thead>
                <tr>
                  <th width="22%" align="center">Pitched Work</th>
                  <th width="22%" align="center">Sent By</th>
                  <th width="28%" align="center">PitchIt! Message</th>
                  <th width="15%" class="center">Times Viewed</th>
                  <th width="13%" class="center">Date</th>
                </tr>
              </thead>
              <tbody>
                
                <?php 
                 //print_r($totalViewPitchit);
                 if(!empty($totalViewPitchit))
                 {
                    foreach($totalViewPitchit as $total_view)
                    {
                     
                
                ?>
                <tr class="">
                  <td align="left">
                  <?php
                  if(strlen($total_view['title']) > 20){?>
                    <div title="<?php echo $total_view['title'];?>"><?php echo substr($total_view['title'],0,18).'..';?></div>
                  <?php }else{
                    echo $total_view['title'];
                  }
                  ?>


                  
                  </td>
                  <td align="left">
                  <?//=$total_view['name_first'].' '.$total_view['name_middle'].' '.$total_view['name_last']?>
                  
                  <?php 
                  if(!empty($total_view['name_first']))
                  {
                    $first = $total_view['name_first'];
                  }
                  else
                  {
                    $first = '';
                  }
                  if(!empty($total_view['name_middle']))
                  {
                   $middle = $total_view['name_middle'];
                  }
                  else
                  {
                    $middle = '';
                  }
                  if(!empty($total_view['name_last']))
                  {
                   $last = $total_view['name_last'];
                  }
                  else
                  {
                    $last = '';
                  }
                  ?>
                  
                  <a href="<?php echo base_url()?>discovery/user_details<?php echo $total_view['user_id'];?>">
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
                  <td align="left">
                  
                  <span id="pit_work_vw_<?=$total_view['pitid']?>" style="cursor: pointer;">
                  <a href="javascript:void(0)" >
                  <?php 
                  if(strlen($total_view['pitchit']) > 25){?>
                    <div title="Click to show the PitchIt! message"><?php echo substr($total_view['pitchit'],0,25).'..';?></div>
                  <?php }else{
                    echo $total_view['pitchit'];
                  }
                  ?>
                  
                  <!-- <span class="tp_span2">Click to show the PitchIt! message</span>
 <div class="clear"></div> -->
 
                   </a>
                   
                  
                  </span>
                    
                  <script type="text/javascript">
                $(document).ready(function () {
                   
                   $('#pit_work_vw_'+<?=$total_view['pitid']?>).click(function () {
                        
                            $('.pit_work_dialog').hide();
                            $("#pit_work_dialog_vw_"+<?=$total_view['pitid']?>).dialog({
                                
                                position:  {
                                            my: "left",
                                            at: "left",
                                            of: $('#tab5')
                                           }
                                
                            });
                           $("#pit_work_dialog_vw_"+<?=$total_view['pitid']?>).show(); 
                        
                    });
                    
                    
                     $('#cancl_pit_vw_'+<?=$total_view['pitid']?>).click(function () {
                       
                            //$("#pit_work_dialog_vw_"+<?//=$total_view['pitid']?>).dialog('close');
                            $("#pit_work_dialog_vw_"+<?=$total_view['pitid']?>).hide();
                        
                    }); 
                    
                });
                </script>
                  
                  <div id="pit_work_dialog_vw_<?=$total_view['pitid']?>" style="display: none;" class="pit_work_dialog">
                  
                  <?php if($total_view['name_first'] != '' || $total_view['name_middle'] != '' || $total_view['name_last'] != '') { ?>
                  
                    <h1><?=$total_view['title']?> was Pitchited by 
                    <?php 
                      echo $total_view['name_first'].' '.$total_view['name_middle'].' '.$total_view['name_last'];
                      
                      ?>
                      on 
                      
                      <?php 
                       if(!empty($total_view['created_date']))
                        {
                        $date = $total_view['created_date'];
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
                    
                    <?php } else {?>
                    
                    <h1><?=$total_view['title']?> was not Pitchited by any Author</h1>
                    
                    <?php } ?>
                    
                    <p>Original PitchIt! on 
                     <?php 
                       if(!empty($total_view['created_date']))
                        {
                        $date = $total_view['created_date'];
                        $timestamp = strtotime($date);
                        $new_date = date("m/d/y", $timestamp);
                        echo $new_date;
                        }
                        else
                        {
                          echo 'N/A';  
                        }
                      ?>
                    
                   </p>
                    <p><?=$total_view['pitchit'];?></p>
                    <a href="javascript:void(0);" id="cancl_pit_vw_<?=$total_view['pitid']?>" class="green_but">Close</a>
                    <!--<a href="###" onclick="click_edit_pit()">Edit</a><a href="#">Save</a><a href="#">Cancel</a><a href="#">PitchIt!</a>-->
                  </div>
                  
                  </td>
                  <td class="center">1</td>
                  <td class="center">
                  <?php
                  
                  if(!empty($total_view['created_date']))
                        {
                        $date = $total_view['created_date'];
                        $timestamp = strtotime($date);
                        $new_date = date("m/d/y", $timestamp);
                        echo $new_date;
                        }
                        else
                        {
                          echo 'N/A';  
                        }
                  
                  ?>
                  </td>
                </tr>
                
                <?php } } else {?>
                  <tr>
                      <td align="center"></td>
                      <td align="center"></td>
                      <td align="center">There are no Pitchits!</td>
                      <td align="center"></td>
                      <td align="center"></td>
                  </tr>
                  <?php } ?>
                
                <!--<tr>
                  <td align="center">Jacobâ€™s Struggles</td>
                  <td align="center">James Scott</td>
                  <td align="center">Wanted to showâ€¦</td>
                  <td align="center">8</td>
                  <td align="center">9/12/14</td>
                </tr>-->
                
                
              </tbody>
            </table>

            <?php if(count($totalViewPitchitCount) > 5) {?>
            <div class="paginate_div">
            <?php if($view_more > 0){ ?><a href="javascript:;" onclick="ajaxTotalPitchit(<?php echo $page_total+1;?>)" class="blue_but floright_martop">VIEW MORE</a><?php }else{?> <!--<a href="javascript:;" class="blue_but floright_martop">VIEW OLDER</a>--> <?php } ?>

            <?php if($offset_total == "0"){?>&nbsp;<?php }else{ ?> <a href="javascript:;" class="green_but floright_martop" onclick="ajaxTotalPitchit(<?php echo $page_total-1;?>)">PREVIOUS</a> <?php } ?> 
             </div>
            <?php } ?>