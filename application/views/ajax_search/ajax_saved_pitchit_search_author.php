<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_new">
              <thead>
                <tr>
                              
                  <th width="21%">Pitched Work</th>
                  <th width="21%">Viewed By</th>
                  <th width="24%">PitchIt! Message</th>
                  <th width="6%" class="center">Edit</th>
                  <th width="28%" class="center">Keep</th>
                </tr>
              </thead>
              <tbody>
              
              <?php 
                   //echo '<pre/>';print_r($user_pitchit_saved_details);
                   if(!empty($user_pitchit_saved_details))
                    {
                    $i =1;    
                     foreach($user_pitchit_saved_details as $pitch_details)
                     {
                        $pitchit_view = $this->memail->get_user_pitchit_view($pitch_details['wid']);
                        $pitchit_view_user = $this->memail->get_user_pitchit_view_user($pitch_details['pit_id']);
                        
                        $pitchit_msg = $this->memail->get_user_pitchit_msg($pitch_details['pit_id']);
                        //echo '<pre/>';print_r($pitchit_view_user);
                     ?>
              
                <tr>
                  <td width="20%" align="center">
                    <?php
                    if(strlen($pitch_details['title']) > 20)
                    {?>
                <div title="<?php echo $pitch_details['title']; ?>"><?php echo substr($pitch_details['title'],0,18).'..';?></div>
                    
                   <?php }
                    else
                    {
                     echo $pitch_details['title'];   
                    }
                   ?>
                    

                  </td>
                  <td width="20%" align="center">
                    <?php 
                      if(!empty($pitchit_view_user))
                      {
                    ?>    
                   <a href="<?=base_url()?>discovery/user_details/<?=$pitchit_view_user['user_id']?>" class="tooltips">
                   <?php 
                   $fullname = $pitchit_view_user['name_first'].' '.$pitchit_view_user['name_middle'].' '.$pitchit_view_user['name_last'];
                   if(strlen($fullname) > 20)
                    {?>
                <div title="<?php echo $fullname; ?>"><?php echo substr($fullname,0,18).'..';?></div>
                    
                   <?php }
                    else
                    {
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
                        echo 'No Viewer';
                      }
                      ?>
          </td>
                  <td width="25%" align="center">
                  <?php 
                  if(strlen($pitch_details['pitchit']) > 28)
                  {
                    ?>
                    
                    <span id="pit_work_vw88_<?=$pitch_details['pit_id']?>" style="cursor: pointer;" title="<?=$pitch_details['pitchit'];?>">
                    <?=substr($pitch_details['pitchit'],0,25).'..'?>
                  
                  </span>
                  
                    <?php
                  }
                  else
                  {
                    ?>
                    <span id="pit_work_vw88_<?=$pitch_details['pit_id']?>" style="cursor: pointer;">
                  <?=$pitch_details['pitchit']?>
                  </span>
                  <?php  
                  }
                  
                  ?>
                  
                  <script type="text/javascript">
                $(document).ready(function () {
                   
                   $('#pit_work_vw88_'+<?=$pitch_details['pit_id']?>).click(function () {
                        
                            $('.pit_work_dialog').hide();
                            $(".pit_work_dialog_vw88_"+<?=$pitch_details['pit_id']?>).dialog({
                               
                               position:  {
                                            my: "left",
                                            at: "left",
                                            of: $('#tab2')
                                        }
                               
                            });
                             $(".pit_work_dialog_vw88_"+<?=$pitch_details['pit_id']?>).show();
                        
                    });
                    
                    
                     $('#cancl_pit_vw88_'+<?=$pitch_details['pit_id']?>).click(function () {
                       
                            //$(".pit_work_dialog_vw88_"+<?=$pitch_details['pit_id']?>).dialog('close');
                            $(".pit_work_dialog_vw88_"+<?=$pitch_details['pit_id']?>).hide();
                        
                    }); 
                    
                });
                </script>
                  
                  <div id="pit_work_dialog_vw88_<?=$pitch_details['pit_id']?>" style="display: none;" class="pit_work_dialog">
                  
                  
                    <p><strong> PitchIt!</strong></p>
                    <p><?=$pitch_details['pitchit'];?></p>
                    <a href="javascript:void(0);" id="cancl_pit_vw88_<?=$pitch_details['pit_id']?>" class="green_but">Close</a>
                    <!--<a href="###" onclick="click_edit_pit()">Edit</a><a href="#">Save</a><a href="#">Cancel</a><a href="#">PitchIt!</a>-->
                  </div>
             
                  
                  </td>
                  <td width="17%" align="center" class="center"><input type="checkbox" id="chkBoxHelp_<?=$pitch_details['pit_id']?>" name="HelpCheckbox" value="Help" />
                  
                  
                  <script>
                  $(document).ready(function () {
                    $('#chkBoxHelp_'+<?=$pitch_details['pit_id']?>).click(function () {
                        if ($(this).is(':checked')) {
                            $("#txtAge_"+<?=$pitch_details['pit_id']?>).dialog({
                                close: function () {
                                    $('#chkBoxHelp_'+<?=$pitch_details['pit_id']?>).prop('checked', false);
                                }
                            });
                        } else {
                            $("#txtAge_"+<?=$pitch_details['pit_id']?>).dialog('X');
                        }
                    });
                       })           
                  </script>
                  
                    <div class="txtAge" style="display: none;" id="txtAge_<?=$pitch_details['pit_id']?>">
                    <!-- <span id="success_pit" style="color: green;"></span> -->
                    <h1>Saved <?=$pitch_details['title']?> Pitchit! <span id="success_pit_<?=$pitch_details['pit_id']?>" style="color: green; float:right; font-size:15px"></span></h1>
                    <p><strong>This PitchIt! was last edited on 
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
                          echo 'No Edit Date';  
                        }
                    
                    ?>
                    </strong></p>
                    
                    <script>
 //BASE = "<?//=base_url()?>";

  function save_pit(id)
   {
    var pit = $('#edittext-001_'+id).val();
    //alert(pit);
         $.ajax({
           url      : '<?=base_url()?>'+'home/editPitchit',
           type     : 'POST',
           data     : { 'id':id ,'pit':pit },
           success  : function(data){
                var p;
                    var ps = data.messages;
                    var html='';
                    //var pg = parseInt(page) + 1;
                    //console.log(ps);
                    //console.log(data);
                    //alert(data.status);
                    //var count = parseInt(data['count']);
                    if(data.status == "true")
                    {
                        //window.location.reload();
                      
                        for (var i = 0, p; p = ps[i++];) 
                        {
                            //alert(p.pitchit);
                            //html += '<textarea id="edittext-001_'+id+'" name="edit_pit" cols="" rows="">';
                            //html += p.pitchit;
                            //html += '</textarea>';
                        $("#pit_work_vw88_"+id).html(p.pitchit);
                        $("#edittext-001_"+id).val(p.pitchit);
                         $("#success_pit_"+id).html('Succesfully Edited');
                                            
                        }
                        
                       
                   } 
           },
           error    : function(resp){
                $.prompt("Sorry, something isn't working right.", {title:'Error'});
           }
          }); 
       }
       
     function do_pit(id,wid)
   {
    
    var pit = $('.edittext-001_'+id).val();
    //alert(pit);
    //alert(id);
    //alert(wid);
    //alert(pit);
    
    if(confirm("Congratulations! You are about to send this Pitchit! This cannot be undone. Are you sure you are ready to do this…did you check your spelling")){
         $.ajax({
           url      : '<?=base_url()?>'+'home/doPitchit',
           type     : 'POST',
           data     : { 'id':id ,'pit':pit,'wid':wid },
           success  : function(data){
                var p;
                    var ps = data.messages;
                    var html='';
                    //var pg = parseInt(page) + 1;
                    console.log(ps);
                    //console.log(data);
                    //alert(data.status);
                    //var count = parseInt(data['count']);
                    if(data.status == "true")
                    {
                        //window.location.reload();
                      //alert("jasfkjsd");
                        for (var i = 0, p; p = ps[i++];) 
                        {
                            html += '<textarea class="edittext-001_'+id+'" name="edit_pit" cols="" rows="">';
                            html += p.pitchit;
                            html += '</textarea>';
                                            
                        }
                        $("#edit_pit_save").html(html);
                        $("#pit_save_img_"+id).attr('src','<?=base_url()?>images/icon033.png');
                        $("#success_pit_"+id).html('Succesfully Pitchited!');
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
          
    }     
       
       
  $(document).ready(function() {
    
    $('.delt_msg').click(function() {
      
      var id = <?=$pitch_details['pit_id']?>;
      
      if(confirm('Are you sure to delete this Pitchit?'))
      {
         $.ajax({
           url      : '<?=base_url()?>'+'home/delPitchit',
           type     : 'POST',
           data     : { 'id':id },
           success  : function(data){
                var p;
                    var ps = data.messages;
                    var html='';
                    //var pg = parseInt(page) + 1;
                    console.log(ps);
                    //console.log(data);
                    //alert(data.status);
                    //var count = parseInt(data['count']);
                    if(data.status == "true")
                    {
                        window.location.reload();
                      //alert("jasfkjsd");
                        for (var i = 0, p; p = ps[i++];) 
                        {
                            html += '<textarea id="edittext-001_'+id+'" name="edit_pit" cols="" rows="">';
                            html += p.pitchit;
                            html += '</textarea>';
                                            
                        }
                        $("#edit_pit_save").html(html);
                        $("#success_pit_"+id).html('Succesfully Pitchited!');
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
                 
        
        
    })
    
  })      
     function delt_pit(id)
   {
    //var pit = $('#edittext-001_<?//=$pitch_details['pit_id']?>').val();
    //alert(pit);
    
      if(confirm('Are you sure to delete this Pitchit?'))
      {
         $.ajax({
           url      : '<?=base_url()?>'+'home/delPitchit',
           type     : 'POST',
           data     : { 'id':id },
           success  : function(data){
                var p;
                    var ps = data.messages;
                    var html='';
                    //var pg = parseInt(page) + 1;
                    console.log(ps);
                    //console.log(data);
                    //alert(data.status);
                    //var count = parseInt(data['count']);
                    if(data.status == "true")
                    {
                        window.location.reload();
                      //alert("jasfkjsd");
                        for (var i = 0, p; p = ps[i++];) 
                        {
                            html += '<textarea id="edittext-001_'+id+'" name="edit_pit" cols="" rows="">';
                            html += p.pitchit;
                            html += '</textarea>';
                                            
                        }
                        $("#edit_pit_save").html(html);
                        $("#success_pit_"+id).html('Succesfully Pitchited!');
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
                    
    } 
    
   $(document).ready(function () {
                    $('#cancl_pit_'+<?=$pitch_details['pit_id']?>).click(function () {
                       
                            $("#txtAge_"+<?=$pitch_details['pit_id']?>).dialog('close');
                            $('#chkBoxHelp_'+<?=$pitch_details['pit_id']?>).prop('checked', false);
                        
                    });
                       }) 
       
</script>
                    
                    <span id="edit_pit_save">
                    <textarea id="edittext-001_<?=$pitch_details['pit_id']?>" class="edittext-001_<?=$pitch_details['pit_id']?>" name="edit_pit" cols="" rows="" disabled="disabled"><?=$pitch_details['pitchit']?></textarea>
                    </span>
                    <a href="javascript:document.getElementById('edittext-001_<?=$pitch_details['pit_id']?>').removeAttribute('disabled').focus();" class="col1">Edit</a>
                    <a href="javascript:void(0);" onclick="save_pit(<?=$pitch_details['pit_id']?>)">Save</a>
                    <a href="javascript:void(0);" id="cancl_pit_<?=$pitch_details['pit_id']?>" class="green_but">Close</a>
                    <a href="javascript:void(0);" onclick="do_pit(<?=$pitch_details['pit_id']?>,<?=$pitch_details['wid']?>)" class="pitchit_pop_icon">
                    <img src="<?php echo base_url();?>images/icon_p.png" id="pit_save_img_<?=$pitch_details['pit_id']?>">
                    </a>
                    </div>
                    
                    
                  </td>
                  <td width="18%" align="center">
                   <div class="demo">
                                  <select name="menu" id="sl2-ic" tabindex="2">
                                    
                                    <option value="yes" class="yes_msg">Yes</option>
                                    <option value="delete" class="delt_msg" >Delete</option>
                                    
                                    </select>
                                    <a href="#" class="arrow_right_button"><img src="<?=base_url()?>images/arrow_right.jpg" alt="" /></a>
                        </div>             
                  </td>
                </tr>
                
                <?php } } else {?>
                
               <tr class="hov_col">
                  <td align="center"></td>
                  <td align="center"></td>
                  <td align="center">No saved Pitchits!</td>
                  <td align="center"></td>
                  <td align="center"></td>
                </tr>
                
                <?php } ?>
                
              </tbody>
            </table>
            
            <?php if($user_pitchit_saved_details_cnt['count'] > 6) {?>
            <div class="paginate_div">
            <?php if($view_more > 0){ ?><a href="javascript:;" onclick="ajaxSavedPitchit(<?php echo $page_saved+1;?>)" class="blue_but floright_martop">VIEW MORE</a><?php }else{?> <!--<a href="javascript:;" class="blue_but floright_martop">VIEW OLDER</a>--> <?php } ?>

            <?php if($offset_saved == "0"){?>&nbsp;<?php }else{ ?> <a href="javascript:;" class="green_but floright_martop" onclick="ajaxViewallPitchit(<?php echo $page_saved-1;?>)">PREVIOUS</a> <?php } ?> 
             </div>
            <?php } ?>