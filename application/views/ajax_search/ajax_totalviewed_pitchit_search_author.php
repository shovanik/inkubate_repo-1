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
                  //echo '<pre/>';print_r($total_view_pitchit);//die;
                  if(!empty($total_view_pitchit))
                  {
                    foreach($total_view_pitchit as $total_viw)
                    {
                  ?>
              
                <tr>
                  <td>
                  
                  <a class="tooltips" href="javascript:void(0)" >
                  <?php 
                  if(strlen($total_viw['title']) > 20)
                  {?>
                <div title="<?php echo $total_viw['title'];?>"><?php echo substr($total_viw['title'],0,18).'...';?></div>
                    
                 <?php }
                  else
                  {
                    echo $total_viw['title'];
                  }
                  ?>
                  
                  <!-- <span class="tp_span2"><?php echo $total_viw['title'];?></span>
          <div class="clear"></div> -->
                  </a>
                  
                  </td>
                  <td>
                  <?//=$total_viw['name_first'].' '.$total_viw['name_middle'].' '.$total_viw['name_last']?>
                  
                  <a class="tooltips" href="<?php echo base_url();?>discovery/user_details/<?php echo $total_viw['pituser'];?>" > 
                    <?php 
                    /*$full_name5 = $total_viw['name_first'].' '.$total_viw['name_middle'].' '.$total_viw['name_last'];
                    
                   if(strlen($full_name5) > 20)
                    {?>
                    <div title="<?php echo $full_name5;?>"><?php echo substr($full_name5,0,18).'...';?></div>
                        
                     <?php }
                        else
                        {
                            echo $full_name5;
                        } */
                      ?>
                  
                  <?php if(!empty($total_viw['pituser'])) { ?>
                  
                    <?php if ($total_viw['user_type'] == '2') {?>
                    <img src="<?=base_url()?>images/bow.png" alt="" />
                    <?php }if ($total_viw['user_type'] == '3') {?>
                    <img src="<?=base_url()?>images/hand.png" alt="" />
                    <?php }if ($total_viw['user_type'] == '4') {?>
                    <img src="<?=base_url()?>images/glass.png" alt="" />
                    <?php } ?>
                    
                 <?php } else { echo 'N/A'; } ?>
                  
                  </a>
                  
                  </td>
                  <td> 
                  
                  <span id="pit_work_vw_<?=$total_viw['pitid']?>" style="cursor: pointer;">
                    <?php
                    if(strlen($total_viw['pitchit']) > 28)
                  {?>
                  <div title="<?php echo $total_viw['pitchit'];?>"><?=substr($total_viw['pitchit'],0,25).'..'?></div>
                      
                   <?php }
                  else
                  {
                      echo $total_viw['pitchit'];
                  }
                    ?>
                  
                  </span>
                  
                  
                  <script type="text/javascript">
                $(document).ready(function () {
                   
                   $('#pit_work_vw_'+<?=$total_viw['pitid']?>).click(function () {
                        
                            $('.pit_work_dialog').hide();
                            $("#pit_work_dialog_vw_"+<?=$total_viw['pitid']?>).dialog({
                                
                                 position:  {
                                            my: "left",
                                            at: "left",
                                            of: $('#tab4')
                                        }
                            });
                            $("#pit_work_dialog_vw_"+<?=$total_viw['pitid']?>).show();
                        
                    });
                    
                    
                     $('#cancl_pit_vw_'+<?=$total_viw['pitid']?>).click(function () {
                       
                            //$("#pit_work_dialog_vw_"+<?=$total_viw['pitid']?>).dialog('close');
                            $("#pit_work_dialog_vw_"+<?=$total_viw['pitid']?>).hide();
                        
                    }); 
                    
                });
                </script>
                  
                  <div id="pit_work_dialog_vw_<?=$total_viw['pitid']?>" style="display: none;" class="pit_work_dialog">
                  
                  <?php if($total_viw['name_first'] != '' || $total_viw['name_middle'] != '' || $total_viw['name_last'] != '') { ?>
                  
                    <h1><?=$total_viw['title']?> was viewed by 
                    <?php 
                      echo $total_viw['name_first'].' '.$total_viw['name_middle'].' '.$total_viw['name_last'];
                      
                      ?>
                      on 
                      
                      <?php 
                       if(!empty($total_viw['pitdate']))
                        {
                        $date = $total_viw['pitdate'];
                        $timestamp = strtotime($date);
                        $new_date = date("m/d/y", $timestamp);
                        echo $new_date;
                        }
                        else
                        {
                          echo 'N/A';  
                        }
                      ?>
                      viewed <?//=$pitchit_view;?> 1 times
                    </h1>
                    
                    <?php } else {?>
                    
                    <h1><?=$total_viw['title']?> was not viewed by any AEP member yet</h1>
                    
                    <?php } ?>
                    
                    <p>An AEP member will message you directly if he/she is interested in your work</p>
                    <p><strong>Original PitchIt! on 
                    
                     <?php 
                       if(!empty($total_viw['pitdate']))
                        {
                        $date = $total_viw['pitdate'];
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
                    <p><?=$total_viw['pitchit'];?></p>
                    <a href="javascript:void(0);" id="cancl_pit_vw_<?=$total_viw['pitid']?>" class="green_but">Close</a>
                    <!--<a href="###" onclick="click_edit_pit()">Edit</a><a href="#">Save</a><a href="#">Cancel</a><a href="#">PitchIt!</a>-->
                  </div>
                  
                  
                  </td>
                  <td class="center">1</td>
                  <td class="center">
                  
                  <?php 
                       if(!empty($total_viw['pitdate']))
                        {
                        $date = $total_viw['pitdate'];
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
                
                
              </tbody>
            </table>

            <?php if($total_view_pitchit_cnt > 6) {?>
            <div class="paginate_div">
            <?php if($view_more > 0){ ?><a href="javascript:;" onclick="ajaxTotalviewedPitchit(<?php echo $page_totalviewed+1;?>)" class="blue_but floright_martop">VIEW MORE</a><?php }else{?> <!--<a href="javascript:;" class="blue_but floright_martop">VIEW OLDER</a>--> <?php } ?>

            <?php if($offset_totalviewed == "0"){?>&nbsp;<?php }else{ ?> <a href="javascript:;" class="green_but floright_martop" onclick="ajaxTotalviewedPitchit(<?php echo $page_totalviewed-1;?>)">PREVIOUS</a> <?php } ?> 
             </div>
            <?php } ?> 