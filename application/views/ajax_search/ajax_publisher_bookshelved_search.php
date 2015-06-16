<h1><img src="<?=base_url()?>images/rou_04.png" alt="" /> Recent Titles Added to Bookshelves</h1>
   
   <table width="100%" border="0" class="tab_new_upp">
   <thead>       
  <tr>
    <th align="left" width="40%">Title</th>
    <th align="center" width="40%">Added By</th>
    <th align="center" width="20%">Date</th>
  </tr>
  </thead>
  <tbody>
  
  
   <?php
   //echo '<pre/>';print_r($bookshelf_profiles);die;
      if(!empty($bookshelf_profiles))
      {
        foreach($bookshelf_profiles as $total_bookshelved_user)
        {
      ?>
  
  <tr>
    <td>
    
    <?//=$total_bookshelved_user['title']?>
    
    <div style="cursor: pointer;"  onclick="openDialog(<?php echo $total_bookshelved_user['wcid'];?>,<?php echo $total_bookshelved_user['wuid'];?>)">
    <a href="javascript:void(0);" class="tooltips">
    <?php 
    if(strlen($total_bookshelved_user['title']) > 15)
        {
           
        ?>
        <div title="<?php echo $total_bookshelved_user['title']; ?>"><?php echo substr($total_bookshelved_user['title'],0,15).'...';?></div>
        <!-- <span class="tp_span tp_span22"> <?php echo $total_bookshelved_user['title']; ?> </span> -->
        <?php  
        }
        else
        {
            echo $total_bookshelved_user['title'];
        }
    
    ?>
    
    
    </a>
    </div>
    </td>
    <td align="center">
    
    
    <?php //echo $total_bookshelved_user['name_first'].' '.$total_bookshelved_user['name_middle'].' '.$total_bookshelved_user['name_last']?>
    
    <?php if($total_bookshelved_user['user_type'] == '2') {?>
    <img src="<?=base_url()?>images/bow.png" alt="" />
    <?php } if($total_bookshelved_user['user_type'] == '3') {?>
    <img src="<?=base_url()?>images/hand.png" alt="" />
    <?php } if($total_bookshelved_user['user_type'] == '4') {?>
    <img src="<?=base_url()?>images/glass.png" alt="" />
    <?php } ?>
    
    
    </td>
    <td align="center">
    
    <?php 
     if(!empty($total_bookshelved_user['created_date']))
      {
      $date = $total_bookshelved_user['created_date'];
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
         <p>No Bookshelved Yet</p>
        </td>
        <td align="center"></td>
     </tr>
     
     
     <?php } ?>
  
  </tbody>
</table>


<?php if($total_rows['count'] > 10) {?>
<div class="paginate_div">
<?php if($view_more > 0){ ?><a href="javascript:;" onclick="getPitchit(<?php echo $page+1;?>, 'tab_dem4', 'whats')" class="blue_but floright_martop">VIEW MORE</a><?php }else{?> <!--<a href="javascript:;" class="blue_but floright_martop">VIEW OLDER</a>--> <?php } ?>

<?php if($offset == "0"){?>&nbsp;<?php }else{ ?> <a href="javascript:;" class="green_but floright_martop" onclick="getPitchit(<?php echo $page-1;?>, 'tab_dem4', 'whats')">PREVIOUS</a> <?php } ?> 
 </div>
<?php } ?>