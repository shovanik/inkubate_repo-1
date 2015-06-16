<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_new">
              <thead>
                <tr>
                  <th align="center" width="22%">Author</th>
                  <th align="center" width="25%">Title</th>
                  <th align="center" width="15%">Type</th>
                  <th align="center" width="18%">Format</th>
                  <th align="center" width="20%">Genre</th>
                </tr>
              </thead>
              <tbody id="containerid">
              	<?php
              	 if(!empty($discovery))
                {
                $i =1;    
                 foreach($discovery as $details)
                 {
               ?>
                <tr >
                  <td align="center">
                  <?php if($details['photo'] != '') {?>
		    <img src="<?=base_url()?>uploadImage/<?=$details['user_id']?>/cover_image/thumbs/<?=$details['photo']?>"/>
		    <?php } else { ?>
		    <img src="<?=base_url()?>images/img_default_cover.png"/>
		    <?php } ?>
            
            <?php if(strlen($details['name_first'].' '.$details['name_middle'].' '.$details['name_last']) > 10) {?>
            
             <a class="tooltips" href="<?=base_url()?>discovery/user_details/<?=$details['user_id'];?>">
                   
                 <label style="cursor: pointer;"><?php echo substr($details['name_first'].' '.$details['name_middle'].' '.$details['name_last'],0,10)."..."?></label> 
                  
                  <span class="tp_span_disc"><?php echo $details['name_first'].' '.$details['name_middle'].' '.$details['name_last'];?></span>
 <div class="clear"></div>
                  <?php //echo (strlen($details['name_first'].' '.$details['name_middle'].' '.$details['name_last']) > 15) ? substr($details['name_first'].' '.$details['name_middle'].' '.$details['name_last'],0,15)."..." : $details['name_first'].' '.$details['name_middle'].' '.$details['name_last'];?>
                   
                   
               </a> 
             <?php } else {?>
                    <a class="tooltips" href="<?=base_url()?>discovery/user_details/<?=$details['user_id'];?>">
             <?php echo $details['name_first'].' '.$details['name_middle'].' '.$details['name_last'];?>
                    </a>
             <?php } ?>
            
            
                   <?php //echo (strlen($details['name_first'].' '.$details['name_middle'].' '.$details['name_last']) > 10) ? substr($details['name_first'].' '.$details['name_middle'].' '.$details['name_last'],0,10)."..." : $details['name_first'].' '.$details['name_middle'].' '.$details['name_last'];?>
                   </td>
                   
                   <td align="center">
                    <a class="tooltips" href="javascript:(void)" onclick="openDialog(<?php echo $details['id'];?>)">
                        <?php if(strlen($details['title']) > 15) {?>
                        <label style="cursor: pointer;"><?php echo substr($details['title'],0,15)."...";?></label> 
                        <span class="tp_span_disc"><?php echo $details['title'];?></span>
                        <div class="clear"></div>
                    
                    <?php } else {?>
                        <?php echo $details['title'];?>
                        <?php } ?> 
                    </a>
                   </td>
<!--                  <td align="center"><span style="cursor: pointer;" onclick="openDialog(<?php echo $details['id'];?>)"><?php if(strlen($details['title']) > 15){ echo substr($details['title'],0,15)."..."; }else{ echo $details['title']; }?></span></td>-->
                  <td align="center"> <?php echo $details['type_name'];?></td>
                  <td align="center"><?php echo $details['form_name'];?></td>
                <td align="center">
                    <a class="tooltips" href="javascript:(void)">
                        <?php if(strlen($details['category_name']) > 11) {?>
                        <label style="cursor: pointer;"><?php echo substr($details['category_name'],0,11)."...";?></label> 
                        <span class="tp_span_disc"><?php echo $details['category_name'];?></span>
                        <div class="clear"></div>

                    <?php } else {?>
                        <?php echo $details['category_name'];?>
                        <?php } ?> 
                    </a>
                </td>
                </tr>
               
                <?php
                }
                }
                else
                {
                	?>
                		<tr>
                			<td colspan="5" align="center">No Result Found</td>
                		</tr>
                	<?php
                }
                 ?>
              </tbody>
            </table>
           <div class="button_right"><?php if($offset == "0"){?>&nbsp;<?php }else{ ?> <a href="javascript:;" class="green_but" onclick="ajaxDiscovery(<?php echo $page-1;?>)">PREVIOUS</a> <?php } ?> 
           <?php if($total_rows > $offset+5){ ?><a href="javascript:;" onclick="ajaxDiscovery(<?php echo $page+1;?>)" class="blue_but">VIEW MORE</a><?php }else{?>&nbsp;<?php } ?></div>
           <input type="hidden" name="show_seach_inp" id="show_search_inp" value="<?php echo $total_rows;?>">
           <?php if(is_array($s)){ ?>
           	<input type="hidden" name="arr" id="arr" value="">
           <?php }else{ ?>
           	<input type="hidden" name="arr" id="arr" value="<?php echo $s;?>">
           <?php } ?>
           <input type="hidden" name="type" id="type" value="<?php echo $type;?>">
           <?php $f =  (isset($search['format'])) ? $search['format'] : '';?>
	  <?php $t =  (isset($search['types'])) ? $search['types'] : '';?>
	  <?php $g =  (isset($search['genre'])) ? $search['genre'] : '';?>
	  <?php $sub =  (isset($subtype)) ? $subtype : '';?>
	  <?php $sc =  (isset($searchCriteria)) ? $searchCriteria : '';?>
	  <?php $so =  (isset($searchOptions)) ? $searchOptions : array();?>
	  <?php //$sv =  (isset($searchValues)) ? $searchValues : '';?>
           <input type="hidden" name="multiple_format" id="multiple_format" value="<?php echo $f;?>">
           <input type="hidden" name="multiple_types" id="multiple_types" value="<?php echo $t;?>">
           <input type="hidden" name="multiple_genre" id="multiple_genre" value="<?php echo $g;?>">
           <input type="hidden" name="subtype" id="subtype" value="<?php echo $sub;?>">
           <input type="hidden" name="searchCriteria" id="searchCriteria" value="<?php echo $sc;?>">
           <?php //print_r($so);?>
           <div style="display:none" id="searchOptionsId">
           <?php 
           	foreach($so as $val)
           	{
           		//print_r($val);
           		if($val['type'] == "format")
           		{
           		?>
           			<span class="tagers"><?php echo $val['work_form_name'];?> <a href="javascript:;" onclick="removeSearchFilter('<?php echo $val['type'];?>','<?php echo $val['work_form_id'];?>',this,'')">X</a></span>
           		<?php 
           		}
           		if($val['type'] == "types")
           		{ 
           		?>
           			<span class="tagers"><?php echo $val['work_type_name'];?> <a href="javascript:;" onclick="removeSearchFilter('<?php echo $val['type'];?>','<?php echo $val['work_type_id'];?>',this,'')">X</a></span>        			
           		<?php
           		}
           		if($val['type'] == "genre")
           		{
           		?>
           			<span class="tagers"><?php echo $val['category_name'];?> <a href="javascript:;" onclick="removeSearchFilter('<?php echo $val['type'];?>','<?php echo $val['id'];?>',this,'')">X</a></span>
           		<?php       
           		}
           		if($val['type'] == "multiple")
           		{
           			if($val['subtype'] == "format")
           			{?>
           				<span class="tagers"><?php echo $val['work_form_name'];?> <a href="javascript:;" onclick="removeSearchFilter('<?php echo $val['type'];?>','<?php echo $val['work_form_id'];?>',this,'<?php echo $val['subtype'];?>')">X</a></span>     
           			<?php
           			}
           			if($val['subtype'] == "types")
           			{?>
           				<span class="tagers"><?php echo $val['work_type_name'];?> <a href="javascript:;" onclick="removeSearchFilter('<?php echo $val['type'];?>','<?php echo $val['work_type_id'];?>',this,'<?php echo $val['subtype'];?>')">X</a></span>              
           			<?php
           			}
           			if($val['subtype'] == "genre")
           			{?>
           				<span class="tagers"><?php echo $val['category_name'];?><a href="javascript:;" onclick="removeSearchFilter('<?php echo $val['type'];?>','<?php echo $val['id'];?>',this,'<?php echo $val['subtype'];?>')">X</a></span>        
           			<?php
           			}
           		?>
           			
           		<?php
           		}
           		
           		if($val['type'] == "global")
           		{
           		?>
           			<span class="tagers"><?php echo $val['value'];?> <span>         
           		<?php
           		}
           		//echo "sdfksfkhs";
           	}
           ?>          
           </div>
