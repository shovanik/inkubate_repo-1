<div id="tab_2"> 
         <h1><img src="<?=base_url()?>images/rou_01.png" alt="" /> Profile Views</h1>
   
   <table width="100%" border="0" class="tab_new_upp">
   <thead>       
  <tr>
    <th align="left" width="40%">Name</th>
    <th align="center" width="40%">AEP Type</th>
    <th align="center" width="20%">Date</th>
  </tr>
  </thead>
  <tbody>
  
      <?php
      if(!empty($user_view_details))
      {
        foreach($user_view_details as $total_viewer)
        {
      ?>
  <tr>
    <td><?//=$total_viewer['name_first'].' '.$total_viewer['name_middle'].' '.$total_viewer['name_last']?>
      <a class="tooltips" href="javascript:void(0);">
    <div><?=(strlen($total_viewer['title']) > 20 ? '<div title="'.$total_viewer['title'].'">'.substr($total_viewer['title'],0,20).'...</div>' : $total_viewer['title']);?></div>
    
    <!-- <span class="tp_span tp_span22"> <?php echo $total_viewer['title']; ?> </span> -->
    </a>
    </td>
    <td align="center">
    <?php if($total_viewer['user_type'] == '2') {?>
    <img src="<?=base_url()?>images/bow.png" alt="" />
    <?php } if($total_viewer['user_type'] == '3') {?>
    <img src="<?=base_url()?>images/hand.png" alt="" />
    <?php } if($total_viewer['user_type'] == '4') {?>
    <img src="<?=base_url()?>images/glass.png" alt="" />
    <?php } ?>
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
         <p>No one viewed</p>
        </td>
        <td align="center"></td>
    </tr>
     
     <?php } ?>
  <!--<tr>
    <td>Jezebel’s Adventures</td>
    <td align="center"><img src="<?//=base_url()?>images/hand.png" alt="" /></td>
    <td align="center">1/22/15</td>
  </tr>-->
    
  </tbody>
</table>

<div class="paginate_div">
<?php if($total_rows2 > ($offset+10) ){ ?><a href="javascript:;" onclick="ajaxDiscovery2(<?php echo $page+1;?>)" class="blue_but floright_martop">VIEW MORE</a><?php }else{?> <a href="javascript:;" class="blue_but floright_martop">VIEW OLDER</a> <?php } ?>

<?php if($offset == "0"){?>&nbsp;<?php }else{ ?> <a href="javascript:;" class="green_but floright_martop" onclick="ajaxDiscovery2(<?php echo $page-1;?>)">PREVIOUS</a> <?php } ?> 
 </div>
           
 </div>          