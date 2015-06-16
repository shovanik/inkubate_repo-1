<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_new">
              <thead>              	
                <tr>
                  <th align="center" width="30%">Search</th>
                  <th align="center" width="20%">Date</th>
                  <th align="center" width="20%">Titles Returned</th>
                  <th align="center" width="15%">View Search</th>
                  <th align="center" width="15%" class="center">Delete</th>
                </tr>
              </thead>
              <tbody>
              	<?php foreach($getSavedSearches as $val){ ?>
               <tr id="tr<?php echo $val['id'];?>">
                  <td align="center"><?php echo $val['saved_search_name'];?></td>
                  <td align="center"><?php echo date('m/d/Y', strtotime($val['create_date']));?></td>
                  <td align="center"> <?php echo $val['titles_returned'];?></td>
                  <td align="center" class="img_new">
                  <?php /*<input name="check" type="checkbox" id="checkbox<?php echo $val['id'];?>" value="<?php echo $val['id'];?>" onclick="fnViewSearches('<?php echo $val['id'];?>')">*/?>
                  <img src="<?=base_url()?>images/discevory_view.png" alt="" style="cursor:pointer;" onclick="fnViewSearches('<?php echo $val['id'];?>')">
                  </td>
                  <td align="center" class="center"><input name="check" type="checkbox" value="<?php echo $val['id'];?>" onclick="fnDeleteSearches('<?php echo $val['id'];?>',this)"></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
           <div class="button_right"><?php if($offset == "0"){?>&nbsp;<?php }else{ ?> <a href="javascript:;" class="green_but" onclick="ajaxSavedSearches(<?php echo $page_ss-1;?>)">PREVIOUS</a> <?php } ?> <?php if($total_rows_ss > $offset+5){ ?><a href="javascript:;" onclick="ajaxSavedSearches(<?php echo $page_ss+1;?>)" class="blue_but">VIEW MORE</a><?php }else{?> <a href="javascript:;" class="blue_but">VIEW MORE</a> <?php } ?></div>
 </div>
 <input type="hidden" name="saved_search_count" id="saved_search_count" value="<?php echo $total_rows_ss;?>">
