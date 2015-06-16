<div id="tab_3">
          <h1><img src="<?=base_url()?>images/rou_03.png" alt="" /> Top 10 Title Downloads</h1>
   
   <table width="100%" border="0" class="tab_new_upp">
   <thead>       
  <tr>
    <th align="left" width="40%">Title</th>
    <th align="center" width="40%">Downloaded By</th>
    <th align="center" width="20%">Date</th>
  </tr>
  </thead>
  <tbody>
   <?php
      if(!empty($user_download_details))
      {
        foreach($user_download_details as $total_downloader)
        {
      ?>
  
  <tr>
    <td>
    
    <div style="cursor: pointer;"  onclick="openDialog(<?php echo $total_downloader['id'];?>,<?php echo $total_downloader['user_id'];?>)">
    <a href="javascript:void(0);" class="tooltips">
    <?php 
    if(strlen($total_downloader['title']) > 15)
        { ?>
         
      <div title="<?php echo $total_downloader['title']; ?>"><?php echo substr($total_downloader['title'],0,15).'...';?></div>
       <!-- <span class="tp_span tp_span22"> <?php echo $total_downloader['title']; ?> </span> -->
        <?php 
        }
        else
        {
          echo $total_downloader['title'];  
        }
    ?>
      
    </a>
     </div>
    </td>
    <td align="center">
    
   <?//=$total_downloader['name_first'].' '.$total_downloader['name_middle'].' '.$total_downloader['name_last']?>
    <?php if($total_downloader['user_type'] == '2') {?>
    <img src="<?=base_url()?>images/bow.png" alt="" />
    <?php } if($total_downloader['user_type'] == '3') {?>
    <img src="<?=base_url()?>images/hand.png" alt="" />
    <?php } if($total_downloader['user_type'] == '4') {?>
    <img src="<?=base_url()?>images/glass.png" alt="" />
    <?php } ?>
    
    </td>
    <td align="center">
    
    <?php 
     if(!empty($total_downloader['created_at']))
      {
      $date = $total_downloader['created_at'];
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
  
     <?php } } else { ?>
     
      <tr>
        <td></td>
        <td align="center">
         <p>No file downloaded</p>
        </td>
        <td align="center"></td>
    </tr>
     
     
     <?php } ?>
  </tbody>
</table>

    
<?php if($total_rows['count'] > 10) {?>
<div class="paginate_div">
<?php if($view_more > 0){ ?><a href="javascript:;" onclick="getPitchit(<?php echo $page+1;?>, 'tab_dem3', 'whats')" class="blue_but floright_martop">VIEW MORE</a><?php }else{?> <!--<a href="javascript:;" class="blue_but floright_martop">VIEW OLDER</a>--> <?php } ?>

<?php if($offset == "0"){?>&nbsp;<?php }else{ ?> <a href="javascript:;" class="green_but floright_martop" onclick="getPitchit(<?php echo $page-1;?>, 'tab_dem3', 'whats')">PREVIOUS</a> <?php } ?> 
 </div>
<?php } ?>

</div>