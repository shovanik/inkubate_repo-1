<div class="work_tab54">
<div style="display: block;" id="tab5">
					<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_new">
						<thead>
							<tr>
								<th align="center" width="30%">Bookshelf</th>
								<th class="center" width="10%">Date</th>
								<th class="center" width="15%">Titles</th>
								<th class="center" width="15%">View</th>
                                <th class="center" width="15%">Share</th>
								<th class="center" width="15%">Delete</th>
							</tr>
						</thead>
						<tbody>
							
                <?php 
								//echo '<pre/>';print_r($share_bookshelf_with);
								if(!empty($share_bookshelf_with))
								{
								$i =1;    
								foreach($share_bookshelf_with as $details_r)
								{
								    $user_book_self = $this->mbookshelf->get_user_book_self_count($details_r['id']);
								    $user_book_self_id = $this->mbookshelf->get_bookshelf_first($details_r['id']);
                                    $bookshelf_user = $this->mbookshelf->get_bookshelf_user_first($details_r['shuid']);
                                    
                                    if(!empty($bookshelf_user['name_first']))
                                    {
                                        $first33 = $bookshelf_user['name_first'];
                                    }
                                    else
                                    {
                                        $first33 = '';
                                    }
                                    if(!empty($bookshelf_user['name_middle']))
                                    {
                                        $middle33 = $bookshelf_user['name_middle'];
                                    }
                                    else
                                    {
                                        $middle33 = '';
                                    }
                                    if(!empty($bookshelf_user['name_last']))
                                    {
                                        $last33 = $bookshelf_user['name_last'];
                                    }
                                    else
                                    {
                                        $last33 = '';
                                    }
                                    
                                    $full = $first33.' '.$middle33.' '.$last33;
								   // echo '<pre/>';print_r($user_book_self_id);die;
								?>
							<tr id="bookshelve<?php echo $details_r['share_id'];?>">
								<td align="center">
                                <p class="ali_text" title="<?php echo $details_r['name'];?> was shared by you" style="cursor: pointer;">
                                <?php echo $details_r['name'];?><br />
                      <?php /*<span title="<?php echo $full;?>" style="cursor: pointer;">shared with <?php echo substr($full,0,15);?></span> */?>
                                </p>
                                
                                </td>
								<td class="center">
                                <?php //echo date('m/d/Y',strtotime($details['create_date']));?>
                                
                                <?php $date_crd = $details_r['create_date'];
                                $timestamp_crd = strtotime($date_crd);
                                $new_date_crd = date("m/d/y", $timestamp_crd);
                                echo $new_date_crd;
                                ?>
                                
                                
                                </td>
								<td class="center"><?php echo $user_book_self;?></td>
								<td class="center" id="detail<?php echo $details_r['share_id'];?>">
									<?php /*<a href="<?=base_url()?>bookshelves/booklist/<?php echo $details['id'];?>"><img alt="" src="<?=base_url()?>images/list_view.png" /></a>*/ ?>
									<?php if(!empty($user_book_self_id)) {?>
									<ul class="tabs view_tab5" id="view_tab5">
										<li><a href="#" name="tab5<?php echo $details_r['share_id'];?>"><img alt="" src="<?=base_url()?>images/discevory_view.png" /></a></li>
									</ul>
									<?php }else{ ?>
									<img alt="" src="<?=base_url()?>images/discevory_view2.png" />
									<?php } ?>
								</td>
                                
                                
                               <!-- <td class="center" id="detail<?php //echo $details_r['share_id'];?>">
									
							     <span> Shared </span>
									
								</td> -->
                                
                                
                                <td class="center" id="detail<?php echo $details_r['share_id'];?>">
							
                                 <?php $bkslf23 = str_replace("'","`",$details_r['name']);?>
                                 
                                 <a href="#myDiv" class="various button_pro" onclick='share_book("<?php echo $details_r['id'];?>","<?php echo $bkslf23;?>")'>Share</a>
									
								</td>
                                
								<td class="center">
                               <input id="check_<?php echo $details_r['share_id']?>" name="check_<?php echo $details_r['share_id']?>" type="checkbox" value="1" class="del_t" onclick="del_share(<?php echo $details_r['share_id']?>)"/>
                                </td>
							</tr>
							<?php $i++; } } else {?>
                        <tr>
								<td colspan="6">
									<p>No BookShelves are Shared with.</p>
								</td>
							</tr>
                        <?php } 
                        
                            ?>
					
						</tbody>
					</table>
                    
                 <div class="paginate_div">

<?php if($total_rows > $offset+5 ){ ?><a href="javascript:;" onclick="ajaxDiscovery_with(<?php echo $page+1;?>)" class="blue_but floright_martop">VIEW OLDER</a><?php }else{?> <a href="javascript:;" class="blue_but floright_martop">VIEW OLDER</a> <?php } ?>

<?php if($offset == "0"){?>&nbsp;<?php }else{ ?> <a href="javascript:;" class="green_but floright_martop" onclick="ajaxDiscovery_with(<?php echo $page-1;?>)">PREVIOUS</a> <?php } ?> 

 </div>
     
</div>   
                    
				</div>
                
                <?php if(!empty($share_bookshelf_with))
					{
					$i =1;    
					foreach($share_bookshelf_with as $details_test)
					{
						$workdetails_total  = $this->mwork->allWorkForBookshelf($details_test['id']);
                        //echo '<pre/>';print_r($workdetails_total);
                        //echo $workdetails_total[0]['title'];
					?>
				<div class="work_tab55">
					<div style="display: block;" id="tab5<?php echo $details_test['share_id'];?>" >
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_new orange1234" id="table_bookshelf">
							<thead>
								<tr>
									<th align="center" width="70%" colspan="3"><?php echo $details_test['name'];?></th>
									<th align="center" width="30%" colspan="2" id="delete_bookshelf"  onclick="del2(<?php echo $details_test['id'];?>)" style="cursor:pointer;">Delete this Bookshelf</th>
								</tr>
							</thead>
							<tbody id="detail_view">
								<tr class="hov_no">
									<td width="100%" colspan="5">
										<div class="demo">
											<div id="owl-demo3" class="owl-carousel">
												<?php 
                                                
                                                
                           foreach($workdetails_total as $key=>$total_work)
                            {
                                $latest_cover = $this->memail->get_latest_cover($total_work['user_id'],$total_work['asset_id']);
                                
                                //echo $total_work['title'];
                            ?>
            <div class="item" id="book<?php echo $total_work['wcid'];?>">
                    <h4><?php if(strlen($total_work['title']) > 18) { ?>
                    	<div title="<?=$total_work['title'];?>"><?=substr($total_work['title'],0,18)?>...</div> 
                    	<?php }else{ ?><?=$total_work['title']?><?php } ?></h4>
                    <div class="item_left_section">
                            <?php 
                            $full_name = $total_work['name'].' '.$total_work['name_middle'].' '.$total_work['name_last']; 
                            if(file_exists("uploadImage/".$total_work['user_id']."/cover_image/medium/".$total_work['photo']) && $total_work['photo'] != '') {?>
                            <img src="<?=base_url()?>uploadImage/<?=$total_work['user_id']?>/cover_image/medium/<?=$total_work['photo']?>" style="height:78px"/>
                            <?php } elseif( !empty($latest_cover) && file_exists("_assets/".strtolower($latest_cover['user_guid'])."/".strtolower($latest_cover['asset_guid']).".jpg")){?>
            <img src="<?=base_url()?>_assets/<?=strtolower($latest_cover['user_guid'])?>/<?=strtolower($latest_cover['asset_guid']).'.jpg'?>" style="height:79px;"/>
          
          <?php } else { ?>
<!--                            <img src="<?=base_url()?>images/img_default_cover.png"/>-->

<table class="no_profile_pic" width="100%">
<tr>
<td style="text-align: center; font-weight:600; line-height:15px; color:#fff; padding: 5px; font-size: 10px; cursor: pointer;"><?=$total_work['title']?></td>
</tr>
</table>
                          <!--  <div class="no_profile_pic">
                                <div style="text-align: center; font-weight:600; line-height:15px; padding-top:25px; font-size: 10px; cursor: pointer;" title="<?=$total_work['title']?>"><?=substr(strtoupper($total_work['title']),0,13)?></div>
                                <div style=" font-size: 10px; font-weight:600; line-height:15px; text-align: center; cursor: pointer" title="<?//=$full_name?>"><?//=substr(strtoupper($full_name),0,13)?></div>
                            </div>
                        -->
                            
<!--                        <div class="no_profile_pic"><div style="padding: 20px 0 0 0;text-align: center; position: relative;">    
                            <a class="tooltips" href="javascript:void(0)">
                   
                                <label style="color: #ffffff;"><?=substr(strtoupper($total_work['title']),0,6)?></label> 
                  
                  <span class="tp_span_disc"><?=$total_work['title']?></span>
 <div class="clear"></div>
                  
               </a> 
                            </div></div>-->
                            
                            <?php } ?>
                    </div>
                    <div class="item_right_section" style="width:98px; margin-top:5px !important;">
                    <?php 
                   	$full_name = $total_work['name'].' '.$total_work['name_middle'].' '.$total_work['name_last']; 
                    if(strlen($full_name) > 15)
                    {
                     	$full_name = '<a href="javascript:void(0);" class="tooltips" title="'.$full_name.'">'.substr($full_name,0,12).'...</a>';
                    }else{
                    	$full_name = $full_name;
                    }
                    
                    ?>
					<p>By <?php echo $full_name;?></p>
					<p>Format: 
					<?php
					if(strlen($total_work['type_name']) > 11)
                    {?>
                     	<span title="<?php echo $total_work['type_name'];?>"><?php echo substr($total_work['type_name'],0,8).'...';?></span>
                    <?php }else{
                    	echo $total_work['type_name'];
                    }
					?>

					</p>
                    <p>Genre: 
                    <?php
					if(strlen($total_work['form_name']) > 11)
                    {?>
                     	<span title="<?php echo $total_work['form_name'];?>"><?php echo substr($total_work['form_name'],0,8).'...';?></span>
                    <?php }else{
                    	echo $total_work['form_name'];
                    }
					?>
                    </p>
                    <a href="javascript:;" class="blue_but view_open" style="font-size:10px" onclick="openDialog_share(<?php echo $total_work['Wid'];?>)">VIEW</a>
                    <a href="#" class="green_bg" style="font-size:10px" onclick="delete_bookshelf_book(<?php echo $total_work['Wid'];?>)">DELETE</a>
													</div>
												</div>
												<?php } ?>
											</div>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
                
				<?php }
					} ?>
              
            </div>  
                    
        <script>
$(document).ready(function() {
    $("#content").find("[id^='tab']").hide(); // Hide all content
    $("#tabs li:first").attr("id","current"); // Activate the first tab
    $("#content #tab1").fadeIn(); // Show first tab's content
    
    $('body').on('click', '.tabs a', function(e) {
        e.preventDefault();
        if ($(this).closest("li").attr("id") == "current"){ //detection for current tab
         return;       
        }
        else{             
          $("#content").find("[id^='tab']").hide(); // Hide all content
          $(".tabs li").attr("id",""); //Reset id's
          if( $('#' + $(this).attr('name')) == "tab1" &&  $('#' + $(this).attr('name')) == "tab3"){
          	$(this).parent().attr("id","current"); // Activate this
          	$('#' + $(this).attr('name')).fadeIn(); // Show content for the current tab
          }
          else
          {
          	//console.log($(this).attr('name'));
          	$('.table_new').show();
          	//setTimeout(function(){ alert("asjdfsdaljkf");$('.table_new').show()},500);
          	$('#' + $(this).attr('name')).fadeIn(); // Show content for the current tab
          	// Show content for the current tab
          }
          
         
          
        }
    });
});
</script> 

<script>
  $(document).ready(function() {
    $("#owl-demo, #owl-demo2, #owl-demo3").owlCarousel({
      navigation : true,
  itemsDesktop:[$(document).width(), 3]
    });
  });
  
</script>                  