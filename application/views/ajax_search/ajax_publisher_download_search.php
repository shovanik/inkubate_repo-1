<div style="display: block;" id="tab_3"> 

         <h1><img src="<?=base_url()?>images/rou_01.png" alt="" /> Title Downloads</h1>
   
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
      <a class="tooltips" href="javascript:void(0);">
    <div><?=(strlen($total_downloader['title']) > 20 ? '<div title="'.$total_downloader['title'].'">'.substr($total_downloader['title'],0,20).'...</div>' : $total_downloader['title']);?></div>
    
    <!-- <span class="tp_span tp_span22"> <?php echo $total_downloader['title']; ?> </span> -->
    </a>
    </td>
    <td align="center">
    
    
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
         <p>No one downloaded</p>
        </td>
        <td align="center"></td>
    </tr>
     
     
     <?php } ?>
  
  </tbody>
</table>

<!--<a href="#" class="button">VIEW OLDER</a>--> 


<div class="paginate_div">
<?php if($total_rows3 > $offset+10){ ?><a href="javascript:;" onclick="ajaxDiscovery3(<?php echo $page+1;?>)" class="blue_but floright_martop">VIEW OLDER</a><?php }else{?> <a href="javascript:;" class="blue_but floright_martop">VIEW OLDER</a> <?php } ?>

<?php if($offset == "0"){?>&nbsp;<?php }else{ ?> <a href="javascript:;" class="green_but floright_martop" onclick="ajaxDiscovery3(<?php echo $page-1;?>)">PREVIOUS</a> <?php } ?> 
 </div>

           
 </div>          