<h1><img src="<?=base_url()?>images/rou_01.png" alt="" /> Recently Added Titles</h1>
   
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
    //echo '<pre/>';print_r($user_recently_add_titles);die;
      if(!empty($user_recently_add_titles))
      {
        foreach($user_recently_add_titles as $total_title)
        {
      ?>
  
  <tr>
    <td>
    
              
    <div style="cursor: pointer;"  onclick="openDialog(<?php echo $total_title['id'];?>,<?php echo $total_title['user_id'];?>)">
    
    <a class="tooltips" href="javascript:void(0)">
    
    <?php if(strlen($total_title['title']) < 15) 
    { 
        echo $total_title['title']; 
     
    } 
    else 
    { ?>
        
      <div title="<?php echo $total_title['title'];?>"><?php echo substr($total_title['title'],0,15).'...';?></div>  
      
     <!--<span class="tp_span tp_span22"> <?php echo $total_title['title']; ?> </span>-->
  <?php     
    }
  ?>
    
    
    
    </a>
    </div>
    </td>
    <td>
    <a href="<?=base_url()?>discovery/user_details/<?php echo $total_title['user_id'];?>" class="tooltips">
    <?php if(!empty($total_title['filename'])) {?>
                    <img src="<?=base_url()?>uploadImage/<?=$total_title['user_id']?>/profile/<?=$total_title['filename']?>" class="img_sz_small_24" style="padding:0;"/>
                   
            <?php } elseif($total_title['gender'] == "1") { ?>
                        <img src="<?=base_url()?>images/man_large.jpg" style="border: 1px solid #444;" class="img_sz_small_24" style="padding:0;"/>
                        
            <?php } elseif($total_title['gender'] == "2") { ?>
                        <img src="<?=base_url()?>images/woman_large.jpg" style="border: 1px solid #444;" class="img_sz_small_24" style="padding:0;"/>            
          
          
                    <?php }else{?>
                        <img src="<?=base_url()?>images/ico_writers1.png" style="border: 1px solid #444;" class="img_sz_small_24" style="padding:0;"/>
            <?php }?>   
                    
                 <?php /*} else {?>
                     <img src="<?=base_url()?>images/img_default_headshot.png" class="img_sz_small_24" style="padding:0;"/>
                 <?php } */?> 
     
      <?php $fullname1 = $total_title['name_first'].' '.$total_title['name_middle'].' '.$total_title['name_last'];
          if(strlen($fullname1) > 15)
          {?>
           
          <div title="<?php echo $fullname1;?>"><?php echo substr($fullname1,0,15).'...';?></div>
           <!-- <span class="tp_span tp_span22"> <?php echo $fullname1; ?> </span> -->
         <?php  
          }
          else
          {
            echo $fullname1;
          }
      ?>
      
      
    </a>
    </td>
    <td align="center">
    
    <?php 
      if(!empty($total_title['create_date']))
          {
          $date = $total_title['create_date'];
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
         <p>No Title Added</p>
        </td>
        <td align="center"></td>
    </tr>
     
     <?php } ?>
  </tbody>
</table>

   

<div class="paginate_div">
<?php if($total_rows['count'] > $offset){ ?><a href="javascript:;" onclick="getPitchit(<?php echo $page+1;?>, 'tab_dem1', 'whats')" class="blue_but floright_martop">VIEW OLDER</a><?php }else{?> <!-- <a href="javascript:;" class="blue_but floright_martop">VIEW OLDER</a> --> <?php } ?>
<?php if($offset == "0"){?>&nbsp;<?php }else{ ?> <a href="javascript:;" class="green_but floright_martop" onclick="getPitchit(<?php echo $page-1;?>, 'tab_dem1', 'whats')">PREVIOUS</a> <?php } ?> 
</div>