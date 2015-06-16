  
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
      
             