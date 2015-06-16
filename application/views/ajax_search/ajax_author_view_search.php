<div id="tab_2">
          <h1><img src="<?=base_url()?>images/rou_02.png" alt="" /> Top 10 Profile Views</h1>
   
   <table width="100%" border="0" class="tab_new_upp">
   <thead>       
  <tr>
    <th align="left" width="40%">Title</th>
    <th align="center" width="40%">Submitted By</th>
    <th align="center" width="20%">Date</th>
  </tr>
  </thead>
  <tbody>
      <?php
      if(!empty($author_view_details))
      {
        foreach($author_view_details as $total_viewer)
        {
      ?>
  <tr>
  
  
  
    <td><?//=$total_viewer['name_first'].' '.$total_viewer['name_middle'].' '.$total_viewer['name_last']?>
    
    <?php if($total_viewer['wid'] != '') { ?> 
    
    <div style="cursor: pointer;"  onclick="openDialog(<?php echo $total_viewer['wid'];?>,<?php echo $total_viewer['wuid'];?>)">
    
    <a href="javascript:void(0);" class="tooltips">
        <?php 
        if(strlen($total_viewer['title']) > 20)
        {?>
          
        <div title="<?php echo $total_viewer['title'];?>"><?php echo substr($total_viewer['title'],0,20).'..';?></div>
        <!-- <span class="tp_span tp_span22"><?=$total_viewer['title']?></span> -->
      <?php     
        }
        else
            {
              echo $total_viewer['title'];  
            }
        ?>
    
    
    </a>
    
    </div>
    
    <?php } else { ?>
    
    <span> No Title Viewed </span>
    
    <?php } ?>
    
    </td>
    <td>
    
    <a href="<?=base_url()?>discovery/user_details/<?php echo $total_viewer['wuid'];?>" class="tooltips">
    <?php if(!empty($total_viewer['filename'])) {?>
        <img src="<?=base_url()?>uploadImage/<?=$total_viewer['wuid']?>/profile/<?=$total_viewer['filename']?>" class="img_sz_small_24" style="padding:0;"/>
    <?php } elseif($total_viewer['gender'] == "1") { ?>
                        <img src="<?=base_url()?>images/man_large.jpg" style="border: 1px solid #444;" class="img_sz_small_24" style="padding:0;"/>
                        
     <?php } elseif($total_viewer['gender'] == "2") { ?>
                        <img src="<?=base_url()?>images/woman_large.jpg" style="border: 1px solid #444;" class="img_sz_small_24" style="padding:0;"/>            
      <?php }else{?>
                        <img src="<?=base_url()?>images/ico_writers1.png" style="border: 1px solid #444;" class="img_sz_small_24" style="padding:0;"/>
            <?php }?>
    
    
      <?php $fullname1 = $total_viewer['name_first'].' '.$total_viewer['name_middle'].' '.$total_viewer['name_last'];
          if(strlen($fullname1) > 15)
          {?>
           
          <div title="<?php echo $fullname1;?>"><?php echo substr($fullname1,0,15).'...';?></div>
          <!-- <span class="tp_span tp_span22"> <?php //echo $fullname1; ?> </span>  -->
         <?php  
          }
          else
          {
          ?>
           <label class="prof_name"> <?php echo $fullname1;?> </label>
        <?php    
          }
      ?>
    
    
    </a>
   
    </td>
    <td align="center">
    <?php 
                   if(!empty($total_viewer['created_date']))
                    {
                    $date = $total_viewer['created_date'];
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
        <td></td>
        <td align="center">
         <p>No title viewed</p>
        </td>
        <td align="center"></td>
    </tr>
     
     <?php } ?>
  </tbody>
</table>
</div>

<?php if($total_rows['count'] > 10) {?>
<div class="paginate_div">
<?php if($view_more > 0){ ?><a href="javascript:;" onclick="getPitchit(<?php echo $page+1;?>, 'tab_dem2', 'whats')" class="blue_but floright_martop">VIEW MORE</a><?php }else{?> <!--<a href="javascript:;" class="blue_but floright_martop">VIEW OLDER</a>--> <?php } ?>

<?php if($offset == "0"){?>&nbsp;<?php }else{ ?> <a href="javascript:;" class="green_but floright_martop" onclick="getPitchit(<?php echo $page-1;?>, 'tab_dem2', 'whats')">PREVIOUS</a> <?php } ?> 
 </div>
<?php } ?>