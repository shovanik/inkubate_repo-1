<script type="text/javascript">
$(document).ready(function () {

    $('.demo1').css('position','relative');
    $('.demo1').css('overflow','hidden');
    
    $('.demo1').easyTicker({
        direction: 'up',
        speed: 'slow',
        interval: 3000,
        mousePause: 1
	}); 

});
</script>   
      <div style="display: none;" id="feeds_list">
             <h3>Show All Feeds Link
                <a href="#info_feed" class="nohover" rel="facebox"><img alt="" src="<?=base_url()?>images/plus.png"/></a>
                </h3>
                <div class="min_height_sec02">
               
                <ul>
                 <?php
                 
                    if(is_array($feeds_url) && count($feeds_url) >0){
                        $i = 1;
                        foreach($feeds_url as $url_list){
                            $usd = $this->session->userdata('logged_user');
                            $feeds = $this->mfeeds->feedurl_status($usd['id'], $url_list['id']);
                            if(is_array($feeds) && count($feeds) >0){
                                $checked = '';
                            }else{
                                $checked = 'checked="checked"';
                            }
                ?>   
                    <li><strong><input type="checkbox" <?= $checked;?> onclick="feedurl_status('<?= $url_list['id'];?>')"></strong> 
                    <?= (strlen($url_list['feeds_url']) > 40) ? substr($url_list['feeds_url'], 0,40)."..." : $url_list['feeds_url']; ?>
                    <img width="16" style="position:relative; top:2px; padding-right: 0px; cursor: pointer;" alt="" src="<?=base_url()?>images/del_icon.png" onclick="feedurl_delete('<?= $url_list['id'];?>')"/>
<!--                        <span><a href="javascript:(void);" onclick="delete_feeds_url('<?= $url_list['id'];?>')"><img src="<?=base_url()?>images/delete_new.png" alt="" /></a></span>-->
                    </li>
                <?php $i++;}
                    }else{?>
                        <li><strong>There are no feeds...</strong></li>
                    <?php }?>
                </ul>
                
                
                    
                  
                        <a href="javascript:void(0);" id="cancl_pop" class="closed_but"><img src="<?=base_url()?>images/close.png" alt="" /></a>
                    </div>
                    
                    <div class="save_changes">
                    <a href="javascript:void(0);" id="feed_url_id" onclick="feed_url_id()" data-fruit="">save changes</a>
                    <a href="javascript:void(0);" id="cancl_pop_2">cancel</a>
                   
                    </div>
                     <div class="clear"></div>
                </div>
                
              <div id="info_feed" style="display:none;">
                <div class="pop_new">
                 <h2>Add a Feed Url</h2>
                 <?php
                   $frmAttrs   = array("id"=>'folderFrm',"class"=>'form-horizontal','onsubmit' => 'return folderValdate();');
                   echo form_open('feeds/feed_add_author', $frmAttrs);
                 ?>
                 
                 <label>Rss Link:</label>
                 <input name="feeds_url" id="feeds_url" class="folder_create_name" type="text" placeholder="add only .xml file" />
                 <div class="folder_create_error" style="color:red"></div>
                 <div class="clear"></div>
                 <input type="hidden" class="form-control" id="user_id" name="user_id" value="<?=$usd['id']?>" />
                 <input name="button" type="submit" value="Add" />
                 </form> 
                 </div>
              </div>  
                
            
           <!-- <div class="blue_back_new2">
           
           Welcome <?//=$usd['name_first']?> : <?php //if(!empty($news['content'])) { echo strip_tags($news['content']); } else { echo 'No data available';}?>
            
            </div> -->
            
           <div class="blue_back_new3" id="content_part">
        <?php 
            //echo "<pre/>".print_r( $feeds_details);die;
            
            
            foreach($pitchit_details as $index => $array){
                $pitchit_details[$index]['type'] = "pitchit";
            }
            
            //$merge_array = array_merge($feeds_details, $pitchit_details);
            //$merge_array = $feeds_details;
            //$merge_array = array("red","green","blue","yellow","brown");;
            if(!empty($feeds_details))
            {
            
            shuffle($feeds_details);
            
            /*========================Short By Create Time Portion==============================*/
             foreach ($feeds_details as $value){
                $create_date[]  = $value['create_date'];
            } 
            array_multisort($create_date, SORT_DESC, $feeds_details); 
            }
            /*=======================Short By Create Time Portion===============================*/  
            //echo "<pre/>".print_r($merge_array);die;
        ?>
            <div class="<?php if(!empty($feeds_details) && count($feeds_details) >4){?>demo1<?php } elseif(!empty($pitchit_details) && count($pitchit_details) >4) {?> demo1 <?php } else {?> noticker <?php } ?> demo3 demo_new">
                <ul>
                    <?php
                    
                   if(!empty($feeds_details))
                   { 
                    
                    $i=1;
                    $j = 0;
                     $merge_array_cnt = count($feeds_details); 
                    if(count($feeds_details) >0){
                        foreach($feeds_details as $feeds_row){
                           
                            if(isset($feeds_row['type']) && $feeds_row['type'] == "feeds"){
                      
                    ?>
                    <li>
                    <?php 
                    if($feeds_row['source'] == 'PublishersWeekly' || $feeds_row['source'] == 'WSJ') 
                        {
                    ?>
                    <span><?=$feeds_row['image']?> </span>
                    <?php } else {?>
                        <span class="bd_st"><?=$feeds_row['image']?> </span>
                      <?php } ?>  
                        <p>
                        <span>News:<br /><!--<small>abcde</small>--></span>
                        <strong>
			   <a href="<?php echo $feeds_row['link']; ?>" target="_blank">
                        <?php 
                        if($feeds_row['source'] == 'PublishersWeekly' || $feeds_row['source'] == 'WSJ') 
                        {
                             if($feeds_row['source'] == 'PublishersWeekly') 
                             {
                               echo 'Publishers Weekly'; 
                             } 
                             if($feeds_row['source'] == 'WSJ') 
                             {
                               echo 'Wall Street Journal'; 
                             }
                         }
                         else
                         {
                            echo $feeds_row['source'];
                         }   
                        ?>
			
                        <strong> (<?= date("m/d/Y", strtotime($feeds_row['create_date'])); ?>) - </strong></a>
                        <a href="<?php echo $feeds_row['link']; ?>" target="_blank">
                        <?= ($feeds_row['title'] != "") ? ((strlen($feeds_row['title']) > 50) ? substr($feeds_row['title'], 0,50)."..." : $feeds_row['title']) : "No Title"; ?>
                        </a></strong><br /><a href="<?php echo $feeds_row['link']; ?>" target="_blank">
                        <?= (strlen($feeds_row['description']) > 110) ? substr($feeds_row['description'], 0,110)."..." : $feeds_row['description']; ?> 
                        </a>
                        </p>
                        <div class="clear"></div>
                    </li>
                        <?php  }  $i++; }} } else {?>
                        
                       <?php foreach($pitchit_details as $feeds_row){ 
                            $pitch_inbox = "";
                            if(!empty($feeds_row['pit_id']))
                            {
                                $pitch_inbox = $this->mpitchit->get_pitch_inbox($feeds_row['pit_id']);
                               
                            }  
                            if(!empty($pitch_inbox) && count($pitch_inbox) > 0)
                            {
                              $pit_url = base_url().'mail/details/'.$pitch_inbox['id'];
                            }
                            else
                            {
                               $pit_url = base_url().'home/pitchits_inbox';
                               //$pit_url = base_url().'mail/details/'.$pitch_inbox['id']; 
                            } 
                        ?> 
                        
                        <li>
                        
                        <a href="<?=$pit_url?>">
                        <span class="black_t"><img src="<?=base_url()?>images/pitchies_icon_das.png" alt="" /></span>
                        </a>
                        <!--<p class="black_t"><?//= (strlen($feeds_row['pitchit']) > 78) ? substr($feeds_row['pitchit'], 0,78)."..." : $feeds_row['pitchit']; ?></p>-->
                        
                        <a href="<?=$pit_url?>">
                        <p>
                        <span>Pitchit!:<br /><!--<small>abcde</small>--></span>&nbsp;&nbsp;&nbsp;
                        <strong>
                        from <?=$feeds_row['first'].' '.$feeds_row['middle'].' '.$feeds_row['last']?> on <?= date("m/d/Y", strtotime($feeds_row['created_date'])); ?></strong><br />
                        <?= (strlen($feeds_row['pitchit']) > 78) ? substr($feeds_row['pitchit'], 0,78)."..." : $feeds_row['pitchit']; ?>
                        
                        </p>
                        </a>
                        
                        <div class="clear"></div>
                    </li>
                        
                        <?php } } ?>
                </ul>
                        
            </div>
        
        </div> 