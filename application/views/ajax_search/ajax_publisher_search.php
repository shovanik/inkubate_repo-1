<div style="display: block;" id="tab_1"> 
          <h1><img src="<?=base_url()?>images/rou_01.png" alt="" /> Title Searches</h1>
<table width="100%" border="0" class="tab_new_upp">
   <thead>       
  <tr>
    <th align="left" width="40%">Title</th>
    <th align="center" width="40%">Searched By</th>
    <th align="center" width="20%">Date</th>
  </tr>
  </thead>
  <tbody>
  
    <?php
      if(!empty($user_search_details))
      {
        foreach($user_search_details as $total_searcher)
        {
      ?>
  
  <tr>
    <td>
      <a class="tooltips" href="javascript:void(0);">
      <div><?=(strlen($total_searcher['title']) > 20 ? '<div title="'.$total_searcher['title'].'">'.substr($total_searcher['title'],0,20).'...</div>' : $total_searcher['title']);?></div>
      
      <!-- <span class="tp_span tp_span22"> <?php echo $total_searcher['title']; ?> </span> -->
      </a>
    </td>
    <td align="center">
    
     <?php if($total_searcher['user_type'] == '2') {?>
    <img src="<?=base_url()?>images/bow.png" alt="" />
    <?php } if($total_searcher['user_type'] == '3') {?>
    <img src="<?=base_url()?>images/hand.png" alt="" />
    <?php } if($total_searcher['user_type'] == '4') {?>
    <img src="<?=base_url()?>images/glass.png" alt="" />
    <?php } ?>
    
    </td>
    <td align="center">
    
     <?php 
                   if(!empty($total_searcher['created_date']))
                    {
                    $date = $total_searcher['created_date'];
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
     
     <?php  } }?>
  
  </tbody>
</table>

<div class="paginate_div">
<?php if($total_rows > ($offset+10) ){ ?><a href="javascript:;" onclick="ajaxDiscovery(<?php echo $page+1;?>)" class="blue_but floright_martop">VIEW OLDER</a><?php }else{?> <a href="javascript:;" class="blue_but floright_martop">VIEW OLDER</a> <?php } ?>

<?php if($offset == "0"){?>&nbsp;<?php }else{ ?> <a href="javascript:;" class="green_but floright_martop" onclick="ajaxDiscovery(<?php echo $page-1;?>)">PREVIOUS</a> <?php } ?> 
 </div>
           
 </div>          