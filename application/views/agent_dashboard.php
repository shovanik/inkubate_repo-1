 <?=$this->load->view('template/inner_header_dashboard.php')?>
  <?php $usd = $this->session->userdata('logged_user'); 
//echo '<pre/>';print_r($user_notification);die;
//echo json_encode($user_notification);die;
$jsArray = array();
foreach($user_notification as $notification) {
   $jsArray[] = array($notification['id']); 
}
$notify = json_encode($jsArray);
//echo json_encode($jsArray);die;

//echo '<pre/>';print_r($pitchit_details);die;

$jsArray_pit = array();
if(!empty($pitchit_count))
{
foreach($pitchit_count as $pit_dtls) {
   $jsArray_pit[] = array($pit_dtls['pit_id']); 
}
$pit= json_encode($jsArray_pit);
}
else
{
 $pit = 0;   
}
//echo '<pre/>';print_r($author_view_details);die;
?>
<script>
function ajaxDiscovery(page)
{
		//$("#content_part").block();
 		//type = "format";
 		//var format_str = arr_format.join(",");
 		
 		$.ajax({
		   url      : '<?=base_url()?>'+'home/ajax_author_rcenttitle_search',
		   type     : 'POST',
		   data     : { 'page': page},
		   success  : function(resp){
		    //alert(resp);
		        if(resp != '0'){
		            $("#tab_1").html(resp);
		            //$("#edit_class" ).dialog( "close" );
		        }
		        //$("#content_part").unblock();
		   },
		   error    : function(resp){
		   	//$("#content_part").unblock();
		        $.prompt("Sorry, something isn't working right.", {title:'Error'});
		   }
		});
}


function ajaxDiscovery2(page)
{
		//$("#content_part").block();
 		//type = "format";
 		//var format_str = arr_format.join(",");
 		
 		$.ajax({
		   url      : '<?=base_url()?>'+'home/ajax_author_view_search',
		   type     : 'POST',
		   data     : { 'page': page},
		   success  : function(resp){
		    //alert(resp);
		        if(resp != '0'){
		            $("#tab_2").html(resp);
		            //$("#edit_class" ).dialog( "close" );
		        }
		        //$("#content_part").unblock();
		   },
		   error    : function(resp){
		   	//$("#content_part").unblock();
		        $.prompt("Sorry, something isn't working right.", {title:'Error'});
		   }
		});
 	}
  function ajaxDiscovery3(page)
{
		//$("#content_part").block();
 		//type = "format";
 		//var format_str = arr_format.join(",");
 		
 		$.ajax({
		   url      : '<?=base_url()?>'+'home/ajax_author_download_search',
		   type     : 'POST',
		   data     : { 'page': page},
		   success  : function(resp){
		    //alert(resp);
		        if(resp != '0'){
		            $("#tab_3").html(resp);
		            //$("#edit_class" ).dialog( "close" );
		        }
		        //$("#content_part").unblock();
		   },
		   error    : function(resp){
		   	//$("#content_part").unblock();
		        $.prompt("Sorry, something isn't working right.", {title:'Error'});
		   }
		});
 	}  
</script>
<!--<link rel='stylesheet' href='<?//=base_url()?>style/inner/vertical_merquee.css'/>
<script src="<?//=base_url()?>js/jquery.scrollbox.js"></script>-->
<script type="text/javascript" src="<?=base_url()?>js/jquery-ui.min.js"></script>
<script>

$(document).ready(function() {
    
   $('#notify').click(function(){
   
        //alert('hi');
         $.ajax({
           url      : '<?=base_url()?>'+'mail/details',
           type     : 'POST',
           data     : { 'id': <?=$notify;?> , 'notify': 'notify' },
           success  : function(resp){
            //alert(resp);
                if(resp < '1'){
                    $("#cnt").html(resp);
                    //$("#edit_class" ).dialog( "close" );
                }
           },
           error    : function(resp){
                $.prompt("Sorry, something isn't working right.", {title:'Error'});
           }
        });   
     
          
   });
   
  $('#pitchit').click(function(){
   
       var pit_wid = $('#pit_wid').val();
        //alert(pit_wid);
        
         $.ajax({
           url      : '<?=base_url()?>'+'work/pitchit_view',
           type     : 'POST',
           data     : { 'id': pit_wid },
           success  : function(resp){
            //alert(resp);
                if(resp == 0){
                    $("#pitcnt").html(resp);
                    //$("#edit_class" ).dialog( "close" );
                }
           },
           error    : function(resp){
                $.prompt("Sorry, something isn't working right.", {title:'Error'});
           }
        });   
     
          
   });
   
   
 $('.demo1').easyTicker({
		direction: 'up'
	});   
   
 });
</script>

<script type="text/javascript">
$(document).ready(function() {
	//Tooltips
	$(".tip_trigger").hover(function(){
		tip = $(this).find('.tip');
		tip.show(); //Show tooltip
	}, function() {
		tip.hide(); //Hide tooltip		  
	}).mousemove(function(e) {
		var mousex = e.pageX + 20; //Get X coodrinates
		var mousey = e.pageY + 20; //Get Y coordinates
		var tipWidth = tip.width(); //Find width of tooltip
		var tipHeight = tip.height(); //Find height of tooltip
		
		//Distance of element from the right edge of viewport
		var tipVisX = $(window).width() - (mousex + tipWidth);
		//Distance of element from the bottom of viewport
		var tipVisY = $(window).height() - (mousey + tipHeight);
		  
		if ( tipVisX < 20 ) { //If tooltip exceeds the X coordinate of viewport
			mousex = e.pageX - tipWidth - 20;
		} if ( tipVisY < 20 ) { //If tooltip exceeds the Y coordinate of viewport
			mousey = e.pageY - tipHeight - 20;
		} 
		tip.css({  top: mousey, left: mousex });
	});
    
    
    
  $(".tip_trigger1").hover(function(){
		tip1 = $(this).find('.tip1');
		tip1.show(); //Show tooltip
	}, function() {
		tip1.hide(); //Hide tooltip		  
	}).mousemove(function(e) {
		var mousex = e.pageX + 20; //Get X coodrinates
		var mousey = e.pageY + 20; //Get Y coordinates
		var tipWidth = tip1.width(); //Find width of tooltip
		var tipHeight = tip1.height(); //Find height of tooltip
		
		//Distance of element from the right edge of viewport
		var tipVisX = $(window).width() - (mousex + tipWidth);
		//Distance of element from the bottom of viewport
		var tipVisY = $(window).height() - (mousey + tipHeight);
		  
		if ( tipVisX < 20 ) { //If tooltip exceeds the X coordinate of viewport
			mousex = e.pageX - tipWidth - 20;
		} if ( tipVisY < 20 ) { //If tooltip exceeds the Y coordinate of viewport
			mousey = e.pageY - tipHeight - 20;
		} 
		tip1.css({  top: mousey, left: mousex });
	});
 
    
});

</script>

<script type="text/javascript">
$(document).ready(function () {
    $('#chkBoxHelp').click(function () {
        if ($(this).is(':checked')) {
            $(".txtAge").dialog({
                close: function () {
                    $('#chkBoxHelp').prop('checked', false);
                }
            });
        } else {
            $(".txtAge").dialog('X');
        }
    });
    
 
    
  
     
  $('#current4').click(function () {  
     
     $('.cd-popup').removeClass('is-visible');
     
     })   
    
});
</script>

<!-- this portion is for feeds popup-->
<script type="text/javascript">
$(document).ready(function () {

    $('#feeds_pop').click(function () {
        $("#feeds_list").dialog({
            close: function () {
            }
        });
    });

    $('#cancl_pop').click(function () {
        $("#feeds_list").dialog('close');
    }); 

});
</script>
<!-- this portion is for feeds popup-->

<style>
.box_align {margin: 0;}
.pitchits_section_new .pitchits_section_right { border: none;}
.pitchits_section_new .pitchits_section_right .table_new tbody td {border-bottom: 1px solid #e5e5e5; border-top: none; line-height: 18px;   vertical-align: middle;}
.pitchits_section_new .pitchits_section_right .table_new tbody td a {color:#544c47;}
.chosen-choices
{
    margin-top: 15px !important;
    height: 0px !important;
}
.pitchits_section_new .ui-dialog {
    left: inherit !important;
    right: inherit !important;
    top: inherit !important;
}
.pitchits_section_new .ffSelectMenuWrapper {top:36px !important;}
.pitchits_section_new .ffSelectWrapper { width:70px; padding: 0 3px; background: url("<?=base_url()?>images/drop_menu_bg.png") no-repeat -20px 0; border-left: 1px solid #ccc; border-radius: 3px 0 0 3px; float: left; margin: 0;}
.pitchits_section_new .ffSelect > a > span { padding: 0; overflow:inherit; text-overflow:inherit; white-space:inherit;}
.pitchits_section_new .ffSelect > a {width: 60px !important;}
.pitchits_section_new .arrow_right_button { float: left;}

 .pitchits_section_new .ffSelectMenuWrapper {left: -8px; top: 36px !important;width: 85px;}
 .pitchits_section_new h1 {height:51px;}
.table_new2 tbody tr:hover { background:none; transform: none !important; cursor: none;}

</style>

<style>
.img_sz_small_22
{
    border-radius: 50%;
    height: 40px;
    width: 40px;
	float:left;
}
.img_sz_small_24
{
    border-radius: 50%;
    height: 30px;
    width: 30px;
	float:left;
}
.bottom_text3
{
    left: 10px !important;
}
.bottom_text4
{
    left: 75px !important;
}
.work_section .table_new tbody td {height:60px !important;} 
</style>

<script>
function delete_feeds_url(id)
{
    if(confirm("Do you want to delete this feeds url ?")){
         $.ajax({
           url      : '<?=base_url()?>'+'feeds/delete_feeds_url',
           type     : 'POST',
           data     : { 'id': id },
           success  : function(resp){
            //alert(resp);
                if(resp == '1'){
                    location.reload();
                }
           },
           error    : function(resp){
                $.prompt("Sorry, something isn't working right.", {title:'Error'});
           }
        });
    } 
}

function openDialog(id,uid)
 {
 	//alert(uid);
 	$.ajax({
               url      : '<?=base_url()?>'+'bookshelves/show_book_detail_for_publisher',
               type     : 'POST',
               data     : { 'id': id ,'uid' : uid },
               success  : function(resp){
               		
		   
               	   $("#title").html(resp.workdetails_test.title_text)
               	   $("#excerpt").html(resp.workdetails_test.extract)
               	   $("#synopsis").html(resp.workdetails_test.synopsis)
               	   $("#review").html(resp.workdetails_test.self_published_text);
               	   $("#tags").html(resp.workdetails_test.tag_text);
                   
                   $("#wid").val(id);
                   
                   if(resp.workdetails_test.pitch_count == 0)
                   {
                    $("#pitch_icn").css('display','none');
                   }
                   else
                   {
                    $("#pitch_icn").css('display','block');
                   }
                   
                   if(resp.workdetails_test.pitch_count_conversation == 0)
                   {
                    $("#think_icn").css('display','none');
                   }
                   else
                   {
                    $("#think_icn").css('display','block');
                   }
                   
                   if(resp.workdetails_test.work_file != '')
                   {
                    $("#download").css('display','block');
                    $("#download").html('<a href="<?=base_url()?>discovery/download/'+id+'/'+resp.workdetails_test.file_asset_id+'/'+resp.workdetails_test.user_id+'/'+resp.workdetails_test.work_file+'">'+resp.workdetails_test.work_file+'</a>');
                   }
                   else
                   {
                    $("#download").css('display','none');
                    //$("#download").hide();
                   }
                   
               	   $(".pit_work_dialog_vw").dialog({
			close: function () {
			    
			}
		    });
                   
               },
               error    : function(resp){
                    $.prompt("Sorry, something isn't working right.", {title:'Error'});
               }
        });
 	
 }
 
 $(document).ready(function() {
    
    $('#cancl_pit').click(function () {
                       
                            $(".pit_work_dialog_vw").dialog('close');
                           
                        
             		});
    
 })
</script>
        
            <div class="content_part">
            	
               
                <div class="mid_content index_sec">
              
                	<div class="top_welcome_section index_for_mob"> 
      <div class="top_welcome_section_left">
        <ul>
          <!--<li style="visibility:hidden"><a href="#" class="green_icon hidetext2"></a><span class="green">02</span></li>-->
          <li><a href="#" class="pink_icon hidetext3 tip_trigger" id="notify"><span class="tip" id="msg_id">Click to show recent messages</span></a><span class="pink" id="cnt"><?php echo count($user_notification_count)?></span></li>
          <li><a href="#" class="orange_icon hidetext4 tip_trigger1" id="pitchit"><span class="tip1" id="pit_id">Click to show pitchits</span></a><span class="orange" id="pitcnt"><?php echo count($pitchit_count);?></span></li>
        </ul>
        
        <div class="bottom_text5" style="display:none;">
             
        </div>
        
        <div class="bottom_text2" style="display:none;">
          <div class="arror_top"><img src="<?=base_url()?>images/arror_top.png" alt="" /></div>
          <h4><span>Your Invites <strong>2</strong></span></h4>
          <form action="" method="post">
            <table width="100%" border="0">
              <tr>
                <td><input type="text" value="Your Friend’s Name" onblur="javascript:if(this.value=='')this.value='Your Friend’s Name';" onfocus="javascript:if(this.value=='Your Friend’s Name')this.value='';" name="textfield"/></td>
              </tr>
              <tr>
                <td><input type="text" value="Your Friend’s Email" onblur="javascript:if(this.value=='')this.value='Your Friend’s Email';" onfocus="javascript:if(this.value=='Your Friend’s Email')this.value='';" name="textfield"/></td>
              </tr>
              <tr>
                <td><a class="button_pro" href="#">Send<img alt="" src="<?=base_url()?>images/arrow.png"/></a></td>
              </tr>
            </table>
          </form>
        </div>
        
        
        <!------------Start Notification------------->
            <?php //echo '<pre/>';print_r($user_notification);die;?>
            <div class="bottom_text3" style="display:none;">
              <div class="arror_top"><img src="<?=base_url()?>images/arror_top.png" alt="" /></div>
              <p class="heading">New (<?php echo count($user_notification_count)?>)</p>
              <span style="float: right; margin-top: -31px; margin-right: 7px; cursor: pointer;" id="cross1"><img src="<?=base_url()?>images/close_22.png" alt="" /></span>
              
               <?php if(!empty($user_notification)) {
                
                foreach ($user_notification as $notification) {
                
                ?>
              
              <div class="see_box"> 
              <?php if(!empty($notification['photo'])) { ?>
              <img src="<?=base_url()?>uploadImage/<?=$notification['from_user_id']?>/profile/<?=$notification['photo']?>" alt="" class="img_sz_small" />
              <?php } else { ?>
              <img src="<?=base_url()?>images/img_default_headshot.png" alt="" class="img_sz_small" />
              
              <?php } ?>
                <div>
                  <h5><?php echo $notification['name_first'].' '.$notification['name_middle'].' '.$notification['name_last']?>
                  <span><?php echo date('m/d/Y',strtotime($notification['created']))?></span></h5>
                  <p><a href="<?=base_url()?>mail/details/<?php echo $notification['id']?>"><?php echo $notification['subject']?></a></p>
                </div>
                <div class="clear"></div>
              </div>
              
              <?php } } ?>
              
              <div class="clear"></div>
              <div class="see_all"><a href="<?=base_url()?>home/inbox">See All</a></div>
            </div>
            
            <!------------End Notification------------->
            
         <!------------Start Pitchit------------->
            
            <div class="bottom_text4" style="display:none;">
              <div class="arror_top"><img src="<?=base_url()?>images/arror_top.png" alt="" /></div>
              <p class="heading">New (<?php echo count($pitchit_details_limit)?>)</p>
              <span style="float: right; margin-top: -31px; margin-right: 7px; cursor: pointer;" id="cross2"><img src="<?=base_url()?>images/close_22.png" alt="" /></span>
              
               <?php 
               
               //echo '<pre/>';print_r($pitchit_details);die;
              /* if(!empty($pitchit_details)) {
                
                foreach ($pitchit_details as $pit_details) {*/
                
            if(!empty($pitchit_details_limit))
        {
               $res = array();
               foreach($pitchit_details_limit as $keys=>$pit) 
               {
                $res[$pit["id"]] = $pit;
               }
           //echo '<pre/>';print_r($res);die; 
            foreach($res as $k => $pit_details)
            { 
                
                ?>
              
              <div class="see_box"> 
              <p class="bl_p">
        	   <span>
               
               <?php if(!empty($pit_details['cover_image'])) { ?>
              <img src="<?=base_url()?>uploadImage/<?=$pit_details['user_id']?>/cover_image/<?=$pit_details['cover_image']?>" alt="" class="img_sz_small" />
              <?php } else { ?>
              <img src="<?=base_url()?>images/img_default_cover.png" alt="" class="img_sz_small" />
              
              <?php } ?>
               
               <input type="hidden" id="pit_wid" name="pit_wid" value="<?=$pit_details['wid']?>" />
               
               <a href="<?=base_url()?>home/view_pitchit/<?=$pit_details['wid']?>" class="noty_txt"><?=$pit_details['pitchit']?></a><br />
               <span style="margin-bottom:10px;">
               by :<b> <?php echo $pit_details['first'].' '.$pit_details['middle'].' '.$pit_details['last']?></b></span>
               <?php if(!empty($pit_details['profile'])) { ?>
              <img src="<?=base_url()?>uploadImage/<?=$pit_details['user_id']?>/profile/<?=$pit_details['profile']?>" alt="" class="img_sz_small" style="width:25px; height:25px; padding:0; margin-top:15px;" />
              <?php } else { ?>
              <img src="<?=base_url()?>images/img_default_headshot.png" alt="" class="img_sz_small" style="width:25px; height:25px; padding:0; margin-top:15px;" />
              <?php } ?>
               </span>
               </p>
                <div class="clear"></div>
              </div>
              
              <?php } } else {?>
              
              <p class="heading">Sorry! There are no Pitchits.</p>
              
              <?php } ?>
              
              <div class="clear"></div>
              <div class="see_all"><a href="<?=base_url()?>home/view_total_pitchits">See All</a></div>
            </div>
            
            <!------------End Pitchit------------->   
        
      </div>
      <div class="top_welcome_section_right">
      
      <?php if(!empty($user_photo['filename'])) {?>
                    <img src="<?=base_url()?>uploadImage/<?=$usd['id']?>/profile/<?=$user_photo['filename']?>" class="img_sz" style="padding:0;"/>
                 <?php } else {?>
                     <img src="<?=base_url()?>images/img_default_headshot.png" class="img_sz" style="padding:0;"/>
                 <?php } ?> 
      
        <p style="color:#9a9a9a;"><strong>Welcome</strong><br /><?php echo $usd['name_first'].' '.$usd['name_middle'].' '.$usd['name_last'];?><br />
             <span style=" font-size: 11px;">Member since <?php echo date('m/d/Y',strtotime($usd['created']))?><?php //echo date('d F Y',strtotime($usd['created']))?></span></p>
      </div>
    </div>
                    
                    
    <div class="dasbord_news_section"> 
        <div class="dasbord_news_section_left_new">
            <h1><img src="<?=base_url()?>images/heading_icon.png" alt="" />Dashboard News 
                <span id="feeds_pop" style="cursor: pointer;"><img src="<?=base_url()?>images/pro_edit.png" alt="" /></span></h1>
                
                <div style="display: none;" id="feeds_list">
                <div class="min_height_sec">
                
                <ul>
                 <?php
                 
                    if(is_array($feeds_url) && count($feeds_url) >0){
                        $i = 1;
                        foreach($feeds_url as $url_list){
                        
                ?>   
                <li><strong><?= $i;?>.</strong> <?= (strlen($url_list['feeds_url']) > 40) ? substr($url_list['feeds_url'], 0,40)."..." : $url_list['feeds_url']; ?><span><a href="javascript:(void);" onclick="delete_feeds_url('<?= $url_list['id'];?>')"><img src="<?=base_url()?>images/delete_new.png" alt="" /></a></span></li>
                <?php $i++;}
                    }else{?>
                        <li><strong>There are no feeds...</strong></li>
                    <?php }?>
                </ul>
                    
                        <a href="javascript:void(0);" id="cancl_pop" class="closed_but"><img src="<?=base_url()?>images/close.png" alt="" /></a>
                    </div>
                </div>
          
        <div class="blue_back_new3"><!--<img src="<?=base_url()?>images/cup_icon.jpg" alt="" />Our Literary Blockbuster Challenge is now complete and our distinguished team of judges has selected the winners.-->
        <?php 
            //echo "<pre>".print_r( $feeds_details )."</pre>";die;
            
            foreach($pitchit_details as $index => $array){
                $pitchit_details[$index]['type'] = "pitchit";
            }
            
            $merge_array = array_merge($feeds_details, $pitchit_details);
            //echo "<pre/>".print_r($merge_array);die;7278094129
            /*========================Short By Create Time Portion==============================*/
            foreach ($merge_array as $value){
                $create_date[]  = $value['create_date'];
            } 
            array_multisort($create_date, SORT_DESC, $merge_array);
            /*=======================Short By Create Time Portion===============================*/  
            //echo "<pre/>".print_r($merge_array);die;
        ?>
            <div class="<?php if(count($merge_array) >4){?>demo1<?php }?> demo3 demo_new">
                <ul>
                    <?php
                        
                    if(count($merge_array) >0){
                        foreach($merge_array as $feeds_row){
                            if(isset($feeds_row['type']) && $feeds_row['type'] == "feeds"){
                    ?>
                    <li>
                        <span><img src="<?=base_url()?>images/news_icon_das.png" alt="" /> News :</span>
                        <p><strong><a href="<?= $feeds_row['link']; ?>" target="_blank"><?= ($feeds_row['title'] != "") ? $feeds_row['title'] : "No Title"; ?></a></strong><br />
                        <?= (strlen($feeds_row['description']) > 90) ? substr($feeds_row['description'], 0,90)."..." : $feeds_row['description']; ?> <strong> <?= date("m/d/Y", strtotime($feeds_row['create_date'])); ?></strong></p>
                        <div class="clear"></div>
                    </li>
                        <?php }else{?>
                    
                    <li>
                        <span class="black_t"><img src="<?=base_url()?>images/pitchies_icon_das.png" alt="" /> Pitchit! :</span>
                        <p class="black_t">Think you will really like this non fiction story of Jobe.</p>
                        <div class="clear"></div>
                    </li>
                    <?php }}}?>
                </ul>
                        
            </div>
        
        </div>
      </div>
      
      <div class="clear"></div>
    </div>
    
    <!-------pitchit reply---------------------->
    
    <div class="pitchits_section pitchits_section_new">
          <div class="pitchits_section_left">
            <h1><img src="<?=base_url()?>images/icon_p.png" alt="" />My Pitchits!</h1>
            <ul class="list" id="tabs">
              <li id="current" class="hov_col"><a href="javascript:void(0)" name="tab1" >Latest PitchIts!</a></li>
              <li  id="current2" class="hov_col"><a href="javascript:void(0)" name="tab2">Saved PitchIts!  <span><?=$total_pit_save_cnt['count']?></span></a></li>
              <li id="current3" class="hov_col"><a href="javascript:void(0)" name="tab3" >View All PitchIts! <span>
              <?php
                      $res = array();
                       foreach($pitchit_details_limit as $keys=>$pit) 
                       {
                        $res[$pit["id"]] = $pit;
                       }
                  echo count($res);     
              ?>
              </span></a></li>
              <li id="current4" class="hov_col"><a href="javascript:void(0)" name="tab4" >PitchIt! Responses<span><?=$total_response_cnt['count']?></span></a></li>
              <li id="current5" class="hov_col"><a href="javascript:void(0)" name="tab5" >Total Viewed PitchIts! <span><?=count($total_view_pitchit)?></span></a></li>
             
            </ul>
          </div>
          <div class="pitchits_section_right" id="content">
          
          	<div style="display: block;" id="tab1">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_new table_new2">
              <thead>
                <tr>
                  <th width="22%"><div>Pitched Work</div></th>
                  <th width="22%"><div>Sent By</div></th>
                  <th width="25%"><div>PitchIt! Message</div></th>
                  <th width="18%" class="center"><div>Times Viewed</div></th>
                  <th width="13%" class="center"><div>Date</div></th>
                </tr>
              </thead>
              <tbody>
                
                
                <?php
                //echo '<pre/>';print_r($pitchit_details_limit);die; 
                   //echo '<pre/>';print_r($user_pitchit_details);die;
                   if(!empty($user_pitchit_details))
                    {
                    $i =1;    
                     foreach($user_pitchit_details as $pitch_details)
                     {
                        $pitchit_view = $this->memail->get_user_pitchit_view($pitch_details['wid']);
                        $pitchit_view_user = $this->memail->get_user_pitchit_send_user($pitch_details['pitchit_user']);
                        
                        //echo '<pre/>';print_r($pitchit_view_user);die;
                     ?>
                
               <tr >
                  <td align="center">
                  
                  
                  <?=$pitch_details['title']?>
                  
                  
                  
                  <script type="text/javascript">
                $(document).ready(function () {
                   
                   $('#pit_work_lat_first_'+<?=$pitch_details['pit_id']?>).click(function () {
                        
                            $(".pit_work_dialog_lat_first_"+<?=$pitch_details['pit_id']?>).dialog({
                                close: function () {
                                    
                                     //$('#pit_work').data('clicked', false);
                                }
                            });
                            
               
                      
                         $.ajax({
                           url      : '<?=base_url()?>'+'work/pitchit_single_view',
                           type     : 'POST',
                           data     : { 'pit_id': <?=$pitch_details['pit_id']?> , 'wid' : <?=$pitch_details['wid']?> },
                           success  : function(resp){
                            //alert(resp);
                                if(resp == 0){
                                    //$("#pitcnt").html(resp);
                                    //$("#edit_class" ).dialog( "close" );
                                }
                           },
                           error    : function(resp){
                                $.prompt("Sorry, something isn't working right.", {title:'Error'});
                           }
                        });   
                   
                            
                        
                    });
                    
                     $('#cancl_pit_'+<?=$pitch_details['pit_id']?>).click(function () {
                       
                            $(".pit_work_dialog_lat_first_"+<?=$pitch_details['pit_id']?>).dialog('close');
                            //$('#chkBoxHelp_'+<?=$pitch_details['pit_id']?>).prop('checked', false);
                        
                    });
                    
                });
                </script>
                  
                  <div class="pit_work_dialog_lat_first_<?=$pitch_details['pit_id']?>" style="display: none;" id="pit_work_dialog">
                    <h1><?=$pitch_details['title']?> was send by 
                    <?php 
                      if(!empty($pitchit_view_user))
                      {
                        echo $pitchit_view_user['name_first'].' '.$pitchit_view_user['name_middle'].' '.$pitchit_view_user['name_last'];
                      }
                      else
                      {
                        echo 'N/A';
                      }
                      ?>
                      on 
                      
                      <?php 
                       if(!empty($pitch_details['created_date']))
                        {
                        $date = $pitch_details['created_date'];
                        $timestamp = strtotime($date);
                        $new_date = date("m/d/y", $timestamp);
                        echo $new_date;
                        }
                        else
                        {
                          echo 'N/A';  
                        }
                      ?>
                     
                    </h1>
                    <!--<p>An AEP member will message you directly if he/she is interested in your work</p>-->
                    <p><strong>Original PitchIt!
                    
                     <?php 
                       /*if(!empty($pitch_details['created_date']))
                        {
                        $date = $pitch_details['created_date'];
                        $timestamp = strtotime($date);
                        $new_date = date("m/d/y", $timestamp);
                        echo $new_date;
                        }
                        else
                        {
                          echo 'No Date';  
                        }*/
                      ?>
                    
                    </strong></p>
                    <p><?=$pitch_details['pitchit'];?></p>
                     
                  <a href="#0" class="cd-popup-trigger" id="cd-popup-trigger_first_<?php echo $pitch_details['pit_id']?>">Reply</a>
                  <a href="javascript:void(0);" id="cancl_pit_<?=$pitch_details['pit_id']?>" class="col3">Cancel</a>
                  </div>
                  
                  
                  
                  
         <script>
         jQuery(document).ready(function($){
	//open popup
	$('#cd-popup-trigger_first_'+<?php echo $pitch_details['pit_id']?>).on('click', function(event){
		event.preventDefault();
		$('#cd-popup_first_'+<?php echo $pitch_details['pit_id']?>).addClass('is-visible');
	});
	
	//close popup
	$('#cd-popup_first_'+<?php echo $pitch_details['pit_id']?>).on('click', function(event){
		if( $(event.target).is('.cd-popup-close') || $(event.target).is('#cd-popup_first_'+<?php echo $pitch_details['pit_id']?>) ) {
			event.preventDefault();
			$(this).removeClass('is-visible');
		}
	});
	//close popup when clicking the esc keyboard button
	$(document).keyup(function(event){
    	if(event.which=='27'){
    		$('#cd-popup_first_'+<?php echo $pitch_details['pit_id']?>).removeClass('is-visible');
	    }
    });
    
});
         </script>         
                                  
  <div class="cd-popup" role="alert" id="cd-popup_first_<?php echo $pitch_details['pit_id']?>">
	<div class="cd-popup-container_reply">
    <div style=" width:100%; background:#000; padding:20px 0;">
    </div>
		   <div class="top_compose">
                                
                                       <?php
                                       $usd = $this->session->userdata('logged_user');
                                       $frmAttrs   = array("id"=>'signupFrm',"class"=>'form-horizontal',"name"=>'myForm');
                                       echo form_open_multipart('mail/compose', $frmAttrs);
                                       ?>
                                        <!--<a href="#" class="closelabel_new"><img src="<?//=base_url()?>images/closelabel.png" alt="" /></a>-->
                                        <div class="text_field_box"><label style="float:left; margin-top:9px; width:3%">To</label>
                                        
                                        <?php   
                                            $single_user = $this->mwork->single_user($pitch_details['pitchit_user']);
                                            ?>
                                            
                                         <div  class="auto_main" id="parent_email_selected">	
                                            <span id="email_selected">			
		                                    <span id="name<?=$pitch_details['pitchit_user'];?>" class="choosen">
                                            <?php 
                                              if(!empty($single_user['name_first']))
                                              {
                                               echo $single_user['name_first'].' ';
                                              }
                                              if(!empty($single_user['name_midle']))
                                              {
                                               echo $single_user['name_midle'].' ';
                                              }
                                              if(!empty($single_user['name_last']))
                                              {
                                               echo $single_user['name_last'];
                                              }?>                                            
		                                    <?php  if($this->uri->segment(4) == 'address_book') {?>
		                                    <img onclick="removeEmail(this,'<?=$pitch_details['pitchit_user'];?>')" src="<?=base_url()?>images/close_22.png">
		                                     <?php } ?>
		                                    </span> 
                                            </span>  
                                            <span>
                                            <input type="text" class="auto_t_box" id="email_input" name="email_input" onkeyup='FnShowSearch(this.value)'><ul id="dropdown_search" style="display:none;"></ul>
                                            </span>                                       
                                            <!--<div class="clear"></div>-->
  					</div>
                                        <input type="hidden" id="user_mail" name="user_mail" readonly="readonly" value="
                                        <?php 
                                          if(!empty($single_user['name_first']))
                                          {
                                           echo $single_user['name_first'].' ';
                                          }
                                          if(!empty($single_user['name_midle']))
                                          {
                                           echo $single_user['name_midle'].' ';
                                          }
                                          if(!empty($single_user['name_last']))
                                          {
                                           echo $single_user['name_last'];
                                          }?>"/>
                                        <input type="hidden" id="user_email_id" name="user_email_id" value="<?=$pitch_details['pitchit_user'];?>"/>
  					
                                        <!--<input type="hidden" id="user_email_id" name="user_email_id"/>
                                         <label class="com_plus"> <a href="#showAuthorList" class="nohover add_img" rel="facebox" data-url=""><img src="<?php echo base_url('images/plus_icon.png')?>" /></a></label>-->
                                         
                                     
                                            <div class="clear"></div>
                                        </div>
                                        <div class="text_field_box3"><label style="float:left; margin-top:9px;">Subject</label>
                                        
                                        <input type="text" id="sub" name="sub"  class="sub_mail_content" value="Pitchit"/>
                                        <div class="clear"></div>
                                        
                                        </div>
                                        <div class="comm_tarea">
                                            <textarea class="ckeditor" cols="80" name="desc"  id="editor2" > </textarea>
                                        </div>
                                            <div class="clear"></div><br />
                                            
                                            <!--<label class="fileContainer">
                                            <img src="<?=base_url()?>images/attachment_icon.png" alt=""   /> 
                                            <input type="file" id="image" name="image" onchange="myFunction()"/>
                                            <span id="demo_upload"></span>
                                        </label>-->
                                            
                                            <span style="display: none;"><input type="file" id="image" name="image" />
                                            <input name="draft" type="submit" value="Save Draft" class="button" style="margin-right:0 !important;"/>
                                            </span>
                                            
                                            <input type="hidden" name="is_pitchit" id="is_pitchit" value="1" />
                                            <input type="hidden" name="get_pitchit_id" id="get_pitchit_id" value="<?=$pitch_details['pit_id']?>" />
                                            
                                            <input name="submit" type="submit" value="Send" class="button" />
                                            <?php //if($usd['user_type'] == "2"){ ?>
                                            <!--<input name="draft" type="submit" value="Save Draft" class="button" style="margin-right:0 !important;"/>-->
                                            <?php //} ?>
                                            
                                       </form>     
                                 
                                       <div class="clear">  </div> 
                                       
                                </div>
                                
		<a href="" class="cd-popup-close img-replace">Close</a>
        <div class="clear"></div>
	</div> 
     <div class="clear"></div>
</div>
                  
                  
                  
                  
                  
                  </td>
                  <td align="center">
                  
                  <?php 
                      if(!empty($pitchit_view_user))
                      {
                        echo $pitchit_view_user['name_first'].' '.$pitchit_view_user['name_middle'].' '.$pitchit_view_user['name_last'];
                      }
                      else
                      {
                        echo 'No Sender';
                      }
                      ?>
                  
                  </td>
                  <td align="center">
                  
                  
                  <span id="pit_work_lat_first_<?=$pitch_details['pit_id']?>" style="cursor: pointer;">
                   
                  <?php if(strlen($pitch_details['pitchit']) <= 30) { echo $pitch_details['pitchit']; } else { echo substr($pitch_details['pitchit'],0,30).'...'; }?>
                  <!--<span id="pit_work_lat_<?=$pitch_details['id']?>" style="cursor: pointer;">
                  
                  <img src="<?=base_url()?>images/think.png" alt="" />
                  </span>-->
                  
                  </span>
              
                  </td>
                  <td align="center" ><?=$pitchit_view?></td>
                  <td align="center" >
                  
                  <?php 
                       if(!empty($pitch_details['created_date']))
                        {
                        $date = $pitch_details['created_date'];
                        $timestamp = strtotime($date);
                        $new_date = date("m/d/y", $timestamp);
                        echo $new_date;
                        }
                        else
                        {
                          echo 'No Date';  
                        }
                      ?>
                  
                  </td>
                </tr>
               
               <?php } } else {?>
               
               <tr class="hov_col">
                  <td align="center"></td>
                  <td align="center"></td>
                  <td align="center">There are no Latest Pitchits!</td>
                  <td align="center"></td>
                  <td align="center"></td>
                </tr>
               
               <?php } ?>

                <!--<tr>
                  <td width="20%" align="center">Book of Jobe</td>
                  <td width="20%" align="center">Peter Smith</td>
                  <td width="25%" align="center"><img src="<?//=base_url()?>images/think.png" alt="" /> Think you will…</td>
                  <td width="17%" align="center">5</td>
                  <td width="18%" align="center">12/16/14</td>
                </tr>
                <tr class="hov_col">
                  <td align="center">Book of Moses</td>
                  <td align="center">Joe Jones</td>
                  <td align="center">Thought you…</td>
                  <td align="center">4</td>
                  <td align="center">11/26/14</td>
                </tr>-->
           
                
              </tbody>
            </table>
            </div>
            <div style="display: none;" id="tab2">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_new table_new2">
              <thead>
                <tr>
                  <th width="22%"><div>Pitched Work</div></th>
                  <th width="22%"><div>Sent By</div></th>
                  <th width="25%"><div>PitchIt! Message</div></th>
                  <th width="18%" class="center"><div>Times Viewed</div></th>
                  <th width="13%" class="center"><div>Keep</div></th>
                </tr>
              </thead>
              <tbody>
                
                
                <?php
                //echo '<pre/>';print_r($pitchit_details_limit);die; 
                   //echo '<pre/>';print_r($user_pitchit_details);die;
                   if(!empty($user_pitchit_details))
                    {
                    $i =1;    
                     foreach($user_pitchit_details as $pitch_details)
                     {
                        $pitchit_view = $this->memail->get_user_pitchit_view($pitch_details['wid']);
                        $pitchit_view_user = $this->memail->get_user_pitchit_send_user($pitch_details['pitchit_user']);
                        
                        //echo '<pre/>';print_r($pitchit_view_user);die;
                     ?>
                
               <tr id="pit_work_lat_first_save_<?=$pitch_details['pit_id']?>">
                  <td align="center">
                  
                  
                  <?=$pitch_details['title']?>
                  
                  
                  
                  <script type="text/javascript">
                $(document).ready(function () {
                   
                   $('#pit_work_lat_first_save_'+<?=$pitch_details['pit_id']?>).click(function () {
                        
                            $(".pit_work_dialog_lat_first_save_"+<?=$pitch_details['pit_id']?>).dialog({
                                close: function () {
                                    
                                     //$('#pit_work').data('clicked', false);
                                }
                            });
                            
               
                      
                         $.ajax({
                           url      : '<?=base_url()?>'+'work/pitchit_single_view',
                           type     : 'POST',
                           data     : { 'pit_id': <?=$pitch_details['pit_id']?> , 'wid' : <?=$pitch_details['wid']?> },
                           success  : function(resp){
                            //alert(resp);
                                if(resp == 0){
                                    //$("#pitcnt").html(resp);
                                    //$("#edit_class" ).dialog( "close" );
                                }
                           },
                           error    : function(resp){
                                $.prompt("Sorry, something isn't working right.", {title:'Error'});
                           }
                        });   
                   
                            
                        
                    });
                    
                     $('#cancl_pit_save_'+<?=$pitch_details['pit_id']?>).click(function () {
                       
                            $(".pit_work_dialog_lat_first_save_"+<?=$pitch_details['pit_id']?>).dialog('close');
                            //$('#chkBoxHelp_'+<?=$pitch_details['pit_id']?>).prop('checked', false);
                        
                    });
                    
                   
                    $('#save_pitch_'+<?=$pitch_details['pit_id']?>).click(function () {
                        
                    if(confirm('Are you sure to save this Pitchits!?'))
                       {
                        $.ajax({
                           url      : '<?=base_url()?>'+'work/pitchit_single_save',
                           type     : 'POST',
                           data     : { 'pit_id': <?=$pitch_details['pit_id']?> , 'wid' : <?=$pitch_details['wid']?> },
                           success  : function(resp){
                            //alert(resp);
                                if(resp == 1){
                                    $("#pit_save_"+<?=$pitch_details['pit_id']?>).html('Successfully Saved');
                                    $("#pit_save_td_"+<?=$pitch_details['pit_id']?>).html('Saved');
                                    //$("#edit_class" ).dialog( "close" );
                                }
                                else{
                                    $("#pit_save_"+<?=$pitch_details['pit_id']?>).html('Already Saved');
                                }
                           },
                           error    : function(resp){
                                $.prompt("Sorry, something isn't working right.", {title:'Error'});
                           }
                        });
                        
                      }  
                      else
                      {
                        return false;
                      }  
                        
                        
                    }); 
                    
                    
                });
                </script>
                  
                  <div class="pit_work_dialog_lat_first_save_<?=$pitch_details['pit_id']?>" style="display: none;" id="pit_work_dialog">
                  
                  <span style="color: green;" id="pit_save_<?=$pitch_details['pit_id']?>"></span>
                  
                    <h1><?=$pitch_details['title']?> was send by 
                    <?php 
                      if(!empty($pitchit_view_user))
                      {
                        echo $pitchit_view_user['name_first'].' '.$pitchit_view_user['name_middle'].' '.$pitchit_view_user['name_last'];
                      }
                      else
                      {
                        echo 'N/A';
                      }
                      ?>
                      on 
                      
                      <?php 
                       if(!empty($pitch_details['created_date']))
                        {
                        $date = $pitch_details['created_date'];
                        $timestamp = strtotime($date);
                        $new_date = date("m/d/y", $timestamp);
                        echo $new_date;
                        }
                        else
                        {
                          echo 'N/A';  
                        }
                      ?>
                     
                    </h1>
                    <!--<p>An AEP member will message you directly if he/she is interested in your work</p>-->
                    <p><strong>Original PitchIt!
                    
                     <?php 
                       /*if(!empty($pitch_details['created_date']))
                        {
                        $date = $pitch_details['created_date'];
                        $timestamp = strtotime($date);
                        $new_date = date("m/d/y", $timestamp);
                        echo $new_date;
                        }
                        else
                        {
                          echo 'No Date';  
                        }*/
                      ?>
                    
                    </strong></p>
                    <p><?=$pitch_details['pitchit'];?></p>
                     
                  <a href="javascript:void(0);" class="cd-popup-trigger" id="save_pitch_<?php echo $pitch_details['pit_id']?>">Save</a>
                  <a href="javascript:void(0);" id="cancl_pit_save_<?=$pitch_details['pit_id']?>" class="col3">Cancel</a>
                  </div>
                  
        
                  
                  </td>
                  <td align="center">
                  
                  <?php 
                      if(!empty($pitchit_view_user))
                      {
                        echo $pitchit_view_user['name_first'].' '.$pitchit_view_user['name_middle'].' '.$pitchit_view_user['name_last'];
                      }
                      else
                      {
                        echo 'No Sender';
                      }
                      ?>
                  
                  </td>
                  <td align="center">
                  
                  
                  <span id="pit_work_lat_first_save_<?=$pitch_details['pit_id']?>" style="cursor: pointer;">
                   
                  <?php if(strlen($pitch_details['pitchit']) <= 30) { echo $pitch_details['pitchit']; } else { echo substr($pitch_details['pitchit'],0,30).'...'; }?>
                  <!--<span id="pit_work_lat_<?=$pitch_details['id']?>" style="cursor: pointer;">
                  
                  <img src="<?=base_url()?>images/think.png" alt="" />
                  </span>-->
                  
                  </span>
              
                  </td>
                  <td align="center" ><?=$pitchit_view?></td>
                  <td align="center" >
                  <?php $save_check = $this->memail->update_pitchit_single_savecheck($pitch_details['pit_id'],$pitch_details['wid']);?>
                  <span id="pit_save_td_<?=$pitch_details['pit_id']?>">
                  <?php 
                      if($save_check['count'] == '0')
                      {
                        echo 'Not Saved';
                      }
                      else
                      {
                        echo 'Saved';
                      } 
                      ?>
                  </span>
                  </td>
                </tr>
               
               <?php } } else {?>
               
               <tr class="hov_col">
                  <td align="center"></td>
                  <td align="center"></td>
                  <td align="center">No saved Pitchits!</td>
                  <td align="center"></td>
                  <td align="center"></td>
                </tr>
               
               <?php } ?>

                <!--<tr>
                  <td width="20%" align="center">Book of Jobe</td>
                  <td width="20%" align="center">Peter Smith</td>
                  <td width="25%" align="center"><img src="<?//=base_url()?>images/think.png" alt="" /> Think you will…</td>
                  <td width="17%" align="center">5</td>
                  <td width="18%" align="center">12/16/14</td>
                </tr>
                <tr class="hov_col">
                  <td align="center">Book of Moses</td>
                  <td align="center">Joe Jones</td>
                  <td align="center">Thought you…</td>
                  <td align="center">4</td>
                  <td align="center">11/26/14</td>
                </tr>-->
           
                
              </tbody>
            </table>
            
            <?php if(count($user_pitchit_details) > 5) { ?>
            <a href="#" class="button_pro">View More</a>
            <?php } ?>
            
            </div>
            <div style="display: none;" id="tab3">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_new">
              <thead>
                <tr>
                  <th align="center">Pitched Work</th>
                  <th align="center">Sent By</th>
                  <th align="center">PitchIt! Message</th>
                  <th align="center">Times Viewed</th>
                  <th align="center">Date</th>
                </tr>
              </thead>
              <tbody>
              
               <?php 
   
                   if(!empty($pitchit_details_limit))
                   {
                       $res = array();
                       foreach($pitchit_details_limit as $keys=>$pit) 
                       {
                        $res[$pit["id"]] = $pit;
                       }
                   //echo '<pre/>';print_r($res);die; 
                    foreach($res as $k => $pit_details)
                    {  
                    
                ?>
              
                <tr>
                  <td width="20%" align="center"><?=$pit_details['title']?></td>
                  <td width="20%" align="center"><?=$pit_details['first'].' '.$pit_details['middle'].' '.$pit_details['last']?></td>
                  <td width="25%" align="center"><?=$pit_details['pitchit']?></td>
                  <td width="17%" align="center">1</td>
                  <td width="18%" align="center">
                  
                  <?php 
                       if(!empty($pit_details['created_date']))
                        {
                        $date = $pit_details['created_date'];
                        $timestamp = strtotime($date);
                        $new_date = date("m/d/y", $timestamp);
                        echo $new_date;
                        }
                        else
                        {
                          echo 'No Date';  
                        }
                      ?>
                  
                  </td>
                </tr>
               
                  <?php } } else {?>
                  
                  <tr>
                  <td width="20%" align="center"></td>
                  <td width="20%" align="center"></td>
                  <td width="25%" align="center">There are no Pitchits!</td>
                  <td width="17%" align="center"></td>
                  <td width="18%" align="center"></td>
                </tr>
                  
                  <?php } ?>
                
              </tbody>
            </table>
            </div>
            <div style="display: none;" id="tab4">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_new">
              <thead>
                <tr>
                  <th align="center">Pitched Work</th>
                  <th align="center">Sent To</th>
                  <th align="center">PitchIt! Reply</th>
                  <th align="center">Times Replied</th>
                  <th align="center">Date</th>
                </tr>
              </thead>
              <tbody>
              
               <?php 
                   //echo '<pre/>';print_r($pitchit_details_limit);die;
                                      
                   if(!empty($pitchit_details_limit))
                    {
                    $i =1; 
                    
                    
                       $res = array();
                       foreach($pitchit_details_limit as $keys=>$pit) 
                       {
                        $res[$pit["id"]] = $pit;
                       }
                       foreach($res as $k =>$pitch_details)
                     {
                        //$pitchit_view = $this->memail->get_user_pitchit_view($pitch_details['wid']);
                        $pitchit_view_user = $this->memail->get_user_pitchit_writer($pitch_details['user_id']);
                        $pitchit_msg = $this->memail->get_user_pitchit_msg($pitch_details['pit_id']);
                        //echo '<pre/>';print_r($pitchit_view_user);die;
                        $total_response_recent  = $this->memail->get_user_pitchit_msg_recent($pitch_details['pit_id']);
                        $total_response_reply  = $this->memail->get_user_pitchit_msg_total_reply($pitch_details['pit_id']);
                        
                     ?>
              
              
                <tr >
                  <td width="20%" align="center"><?=$pitch_details['title']?>
                  
               <script type="text/javascript">
                $(document).ready(function () {
                   
                   $('#pit_work_'+<?=$pitch_details['pit_id']?>).click(function () {
                        
                            $(".pit_work_dialog_lat_first_recent"+<?=$pitch_details['pit_id']?>).dialog({
                                close: function () {
                                    
                                     //$('#pit_work').data('clicked', false);
                                }
                            });
                            
                         $('#cancl_pit_rep_'+<?=$pitch_details['pit_id']?>).click(function () {
                       
                            $(".pit_work_dialog_lat_first_recent"+<?=$pitch_details['pit_id']?>).dialog('close');
                            //$('#chkBoxHelp_'+<?=$pitch_details['pit_id']?>).prop('checked', false);
                        
                       });    
                        
                    }); 
                    
                });
                </script>
                  
                  <div class="pit_work_dialog_lat_first_recent<?=$pitch_details['pit_id']?>" style="display: none;" id="pit_work_dialog">
                    <h1><?=$total_response_recent['subject']?>
                    </h1>
                    <p>An AEP member has sent a message to you <?=$total_response_recent['body']?></p>
                    
                     
                  <a href="#0" class="cd-popup-trigger" id="cd-popup-trigger_rep_<?php echo $pitch_details['id']?>">Reply</a>
                  <a href="javascript:void(0);" id="cancl_pit_rep_<?=$pitch_details['pit_id']?>" class="col3">Cancel</a>
                  
                  </div>
                  
                  </td>
                  <td width="20%" align="center">
                  <?php 
                  if(!empty($pitchit_view_user['name_first']))
                  {
                   echo $pitchit_view_user['name_first'].' ';
                  }
                  if(!empty($pitchit_view_user['name_midle']))
                  {
                   echo $pitchit_view_user['name_midle'].' ';
                  }
                  if(!empty($pitchit_view_user['name_last']))
                  {
                   echo $pitchit_view_user['name_last'];
                  }
                  ?>
                  
                  </td>
                  <td width="25%" align="center">
                  
                  <?php if($pitchit_msg['count'] > 0) {?>
                  
                  <img src="<?=base_url()?>images/think.png" alt="" id="pit_work_<?=$pitch_details['pit_id']?>" style="cursor: pointer;"/> 
                  <?=$total_response_recent['subject']?>…
                 
                  <?php } else {?>
                  No Reply
                  <?php } ?>
         <script>
         jQuery(document).ready(function($){
	//open popup
	$('#cd-popup-trigger_rep_'+<?php echo $pitch_details['id']?>).on('click', function(event){
		event.preventDefault();
		$('#cd-popup_rep_'+<?php echo $pitch_details['id']?>).addClass('is-visible');
	});
	
	//close popup
	$('#cd-popup_rep_'+<?php echo $pitch_details['id']?>).on('click', function(event){
		if( $(event.target).is('.cd-popup-close') || $(event.target).is('#cd-popup_rep_'+<?php echo $pitch_details['id']?>) ) {
			event.preventDefault();
			$(this).removeClass('is-visible');
		}
	});
	//close popup when clicking the esc keyboard button
	$(document).keyup(function(event){
    	if(event.which=='27'){
    		$('#cd-popup_rep_'+<?php echo $pitch_details['id']?>).removeClass('is-visible');
	    }
    });
    
});
         </script>         
                                  
  <div class="cd-popup" role="alert" id="cd-popup_rep_<?php echo $pitch_details['id']?>">
	<div class="cd-popup-container_reply">
    <div style=" width:100%; background:#000; padding:20px 0;">
    </div>
		   <div class="top_compose">
                                
                                       <?php
                                       $usd = $this->session->userdata('logged_user');
                                       $frmAttrs   = array("id"=>'signupFrm',"class"=>'form-horizontal',"name"=>'myForm');
                                       echo form_open_multipart('mail/compose', $frmAttrs);
                                       ?>
                                        <!--<a href="#" class="closelabel_new"><img src="<?//=base_url()?>images/closelabel.png" alt="" /></a>-->
                                        <div class="text_field_box"><label style="float:left; margin-top:9px; width:3%">To</label>
                                        
                                        <?php   
                                            $single_user = $this->mwork->single_user($pitch_details['user_id']);
                                            ?>
                                            
                                         <div  class="auto_main" id="parent_email_selected">	
                                            <span id="email_selected">			
		                                    <span id="name<?=$pitch_details['user_id'];?>" class="choosen">
                                            <?php 
                                              if(!empty($single_user['name_first']))
                                              {
                                               echo $single_user['name_first'].' ';
                                              }
                                              if(!empty($single_user['name_midle']))
                                              {
                                               echo $single_user['name_midle'].' ';
                                              }
                                              if(!empty($single_user['name_last']))
                                              {
                                               echo $single_user['name_last'];
                                              }?>                                            
		                                    <?php  if($this->uri->segment(4) == 'address_book') {?>
		                                    <img onclick="removeEmail(this,'<?=$pitch_details['user_id'];?>')" src="<?=base_url()?>images/close_22.png">
		                                     <?php } ?>
		                                    </span> 
                                            </span>  
                                            <span>
                                            <input type="text" class="auto_t_box" id="email_input" name="email_input" onkeyup='FnShowSearch(this.value)'><ul id="dropdown_search" style="display:none;"></ul>
                                            </span>                                       
                                            <!--<div class="clear"></div>-->
  					</div>
                                        <input type="hidden" id="user_mail" name="user_mail" readonly="readonly" value="
                                        <?php 
                                          if(!empty($single_user['name_first']))
                                          {
                                           echo $single_user['name_first'].' ';
                                          }
                                          if(!empty($single_user['name_midle']))
                                          {
                                           echo $single_user['name_midle'].' ';
                                          }
                                          if(!empty($single_user['name_last']))
                                          {
                                           echo $single_user['name_last'];
                                          }?>"/>
                                        <input type="hidden" id="user_email_id" name="user_email_id" value="<?=$total_response_recent['from_user_id'];?>"/>
  					
                                        <!--<input type="hidden" id="user_email_id" name="user_email_id"/>
                                         <label class="com_plus"> <a href="#showAuthorList" class="nohover add_img" rel="facebox" data-url=""><img src="<?php echo base_url('images/plus_icon.png')?>" /></a></label>-->
                                         
                                     
                                            <div class="clear"></div>
                                        </div>
                                        <div class="text_field_box3"><label style="float:left; margin-top:9px;">Subject</label>
                                        
                                        <input type="text" id="sub" name="sub"  class="sub_mail_content" value="Pitchit"/>
                                        <div class="clear"></div>
                                        
                                        </div>
                                        <div class="comm_tarea">
                                            <textarea class="ckeditor" cols="80" name="desc"  id="editor2" > </textarea>
                                        </div>
                                            <div class="clear"></div><br />
                                            
                                            <!--<label class="fileContainer">
                                            <img src="<?=base_url()?>images/attachment_icon.png" alt=""   /> 
                                            <input type="file" id="image" name="image" onchange="myFunction()"/>
                                            <span id="demo_upload"></span>
                                        </label>-->
                                            
                                            <input type="hidden" name="is_pitchit" id="is_pitchit" value="1" />
                                            <input type="hidden" name="get_pitchit_id" id="get_pitchit_id" value="<?=$pitch_details['pit_id']?>" />
                                            
                                            <span style="display: none;"><input type="file" id="image" name="image" />
                                            <input name="draft" type="submit" value="Save Draft" class="button" style="margin-right:0 !important;"/>
                                            </span>
                                            <input name="submit" type="submit" value="Send" class="button" />
                                            <?php //if($usd['user_type'] == "2"){ ?>
                                            <!--<input name="draft" type="submit" value="Save Draft" class="button" style="margin-right:0 !important;"/>-->
                                            <?php //} ?>
                                            
                                       </form>     
                                 
                                       <div class="clear">  </div> 
                                       
                                </div>
                                
		<a href="" class="cd-popup-close img-replace">Close</a>
        <div class="clear"></div>
	</div> 
     <div class="clear"></div>
</div>
                  
                  
                  
                  </td>
                  <td width="17%" align="center"><?=$total_response_reply['count']?></td>
                  <td width="18%" align="center">
                  
                  <?php 
                       if(!empty($pitch_details['created_date']))
                        {
                        $date = $pitch_details['created_date'];
                        $timestamp = strtotime($date);
                        $new_date = date("m/d/y", $timestamp);
                        echo $new_date;
                        }
                        else
                        {
                          echo 'No Date';  
                        }
                      ?>
                  
                  </td>
                </tr>
                
               <?php } } else { ?>
               
               <tr class="hov_col">
                  <td align="center"></td>
                  <td align="center"></td>
                  <td align="center">There are no responses till now!</td>
                  <td align="center"></td>
                  <td align="center"></td>
                </tr>
               
               <?php } ?> 
                
                
              </tbody>
            </table>
            </div>
            <div style="display: none;" id="tab5">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_new">
              <thead>
                <tr>
                  <th align="center">Pitched Work</th>
                  <th align="center">Sent By</th>
                  <th align="center">PitchIt! Message</th>
                  <th align="center">Times Viewed</th>
                  <th align="center">Date</th>
                </tr>
              </thead>
              <tbody>
                
                <?php 
                 
                 if(!empty($total_view_pitchit))
                 {
                    foreach($total_view_pitchit as $total_view)
                    {
                     
                
                ?>
                <tr class="hov_col">
                  <td align="left"><?=$total_view['title']?></td>
                  <td align="left"><?=$total_view['name_first'].' '.$total_view['name_middle'].' '.$total_view['name_last']?></td>
                  <td align="left">
                  
                  <span id="pit_work_vw_<?=$total_view['pitid']?>" style="cursor: pointer;">
                  <a class="tooltips" href="javascript:void(0)" >
                  <?php 
                  if(strlen($total_view['pitchit']) > 25)
                  {
                   echo substr($total_view['pitchit'],0,25).'...';
                  }
                  else
                  {
                    echo $total_view['pitchit'];
                  }
                  ?>
                  
                  <span class="tp_span2">Click to show the Pitchits!</span>
 <div class="clear"></div>
 
                   </a>
                   
                  
                  </span>
                    
                  <script type="text/javascript">
                $(document).ready(function () {
                   
                   $('#pit_work_vw_'+<?=$total_view['pitid']?>).click(function () {
                        
                            $(".pit_work_dialog_vw_"+<?=$total_view['pitid']?>).dialog({
                                close: function () {
                                    
                                     //$('#pit_work').data('clicked', false);
                                }
                            });
                        
                    });
                    
                    
                     $('#cancl_pit_vw_'+<?=$total_view['pitid']?>).click(function () {
                       
                            $(".pit_work_dialog_vw_"+<?=$total_view['pitid']?>).dialog('close');
                            //$('#chkBoxHelp_'+<?=$pitch_details['pit_id']?>).prop('checked', false);
                        
                    }); 
                    
                });
                </script>
                  
                  <div class="pit_work_dialog_vw_<?=$total_view['pitid']?>" style="display: none;" id="pit_work_dialog">
                  
                  <?php if($total_view['name_first'] != '' || $total_view['name_middle'] != '' || $total_view['name_last'] != '') { ?>
                  
                    <h1><?=$total_view['title']?> was Pitchited by 
                    <?php 
                      echo $total_view['name_first'].' '.$total_view['name_middle'].' '.$total_view['name_last'];
                      
                      ?>
                      on 
                      
                      <?php 
                       if(!empty($total_view['created_date']))
                        {
                        $date = $total_view['created_date'];
                        $timestamp = strtotime($date);
                        $new_date = date("m/d/y", $timestamp);
                        echo $new_date;
                        }
                        else
                        {
                          echo 'N/A';  
                        }
                      ?>
                      
                    </h1>
                    
                    <?php } else {?>
                    
                    <h1><?=$total_view['title']?> was not Pitchited by any Author</h1>
                    
                    <?php } ?>
                    
                    <p>Original PitchIt! on 
                     <?php 
                       if(!empty($total_view['created_date']))
                        {
                        $date = $total_view['created_date'];
                        $timestamp = strtotime($date);
                        $new_date = date("m/d/y", $timestamp);
                        echo $new_date;
                        }
                        else
                        {
                          echo 'N/A';  
                        }
                      ?>
                    
                   </p>
                    <p><?=$total_view['pitchit'];?></p>
                    <a href="javascript:void(0);" id="cancl_pit_vw_<?=$total_view['pitid']?>" class="col3">Cancel</a>
                    <!--<a href="###" onclick="click_edit_pit()">Edit</a><a href="#">Save</a><a href="#">Cancel</a><a href="#">PitchIt!</a>-->
                  </div>
                  
                  </td>
                  <td align="center">1</td>
                  <td align="center">
                  <?php
                  
                  if(!empty($total_view['created_date']))
                        {
                        $date = $total_view['created_date'];
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
                
                <?php } } ?>
                
                <!--<tr>
                  <td align="center">Jacob’s Struggles</td>
                  <td align="center">James Scott</td>
                  <td align="center">Wanted to show…</td>
                  <td align="center">8</td>
                  <td align="center">9/12/14</td>
                </tr>-->
                
                
              </tbody>
            </table>
            </div>
            <div style="display: none;" id="tab6">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_new">
              <thead>
                <tr>
                  <th align="center">Pitched Work</th>
                  <th align="center">Sent By</th>
                  <th align="center">PitchIt! Message</th>
                  <th align="center">Times Viewed</th>
                  <th align="center">Date</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td width="20%" align="center">Book of Jobe</td>
                  <td width="20%" align="center">Peter Smith</td>
                  <td width="25%" align="center"><img src="<?=base_url()?>images/think.png" alt="" /> Think you will…</td>
                  <td width="17%" align="center">5</td>
                  <td width="18%" align="center">12/16/14</td>
                </tr>
                <tr class="hov_col">
                  <td align="center">Book of Moses</td>
                  <td align="center">Joe Jones</td>
                  <td align="center">Thought you…</td>
                  <td align="center">4</td>
                  <td align="center">11/26/14</td>
                </tr>
                <tr>
                  <td align="center">Book of Isaac</td>
                  <td align="center">Paula James</td>
                  <td align="center">Best book ever…</td>
                  <td align="center">5</td>
                  <td align="center">10/06/14</td>
                </tr>
                <tr>
                  <td align="center">Book of Jacob</td>
                  <td align="center">Susan Peters</td>
                  <td align="center">You might like…</td>
                  <td align="center">2</td>
                  <td align="center">9/12/14</td>
                </tr>
                <tr>
                  <td align="center">Jacob’s Struggles</td>
                  <td align="center">James Scott</td>
                  <td align="center">Wanted to show…</td>
                  <td align="center">8</td>
                  <td align="center">9/12/14</td>
                </tr>
                
                
              </tbody>
            </table>
            </div>
            
          </div>
                     
          <div class="clear"></div>
        </div>
        
        <!-----end------------->
    
    <!----------------pitchit Section------------------------------->
    
    <div class="pitchits_section"> 
    <div class="pitchits_left_main">
    <!--<div class="publishers_section_left"> 
        <h1><img src="<?=base_url()?>images/icon_p.png" alt="" />Pitchits <span><a href="<?=base_url()?>home/view_total_pitchits" style="margin: 7px 10px 0 0; float: right;font-size: 16px;" class="button_pro">View All Pitchits</a></span></h1>
        <ul class="list">
        
        <?php 
        //echo '<pre/>';print_r(array_unique($pitchit_details_limit , SORT_REGULAR));die;
        
        //echo '<pre/>';print_r($pitchit_details_limit);die;
        /*$temp = array();
        foreach($pitchit_details_limit as $key=>$each){
                $temp[] = $each['id'];   //array_push($temp, $each['pitchit_id'])
            }
       echo '<pre/>'; print_r($temp);die; */
        
        if(!empty($pitchit_details_limit))
        {
               $res = array();
               foreach($pitchit_details_limit as $keys=>$pit) 
               {
                $res[$pit["id"]] = $pit;
               }
           //echo '<pre/>';print_r($res);die; 
            foreach($res as $k => $pit_details)
            {
        ?>
        
          <p class="bl_pit">
        	<span>
            <?php if(!empty($pit_details['cover_image'])) { ?>
              <img src="<?=base_url()?>uploadImage/<?=$pit_details['user_id']?>/cover_image/<?=$pit_details['cover_image']?>" alt="" class="img_sz_small_24" />
              <?php } else { ?>
              <img src="<?=base_url()?>images/img_default_cover.png" alt="" class="img_sz_small_24" />
              
              <?php } ?></span>
            <label>
            <a href="<?=base_url()?>home/view_pitchit/<?=$pit_details['wid']?>" class="slide_pitch">
            <?php echo $pit_details['pitchit'];?>
            </a>
            
            </label>
            	<div class="clear"></div>
            </p> 
            <div class="clear" style="margin-bottom: 8px;"></div>
            
         <?php } }  else { ?> 
         
         <li>There are no pitchits till now.</li>
         
         <?php } ?>
         
        </ul>
       <div class="clear"></div>
      </div>-->
      
      
      <div class="publishers_section_left box_align"> 
      
        
   <!----------------New Pie chart------------------>
   
   
    <h1 class="for_mobile"><img src="<?=base_url()?>images/cercel_icon_hand.png" alt="" />What's Happening!<span>
          <!--<a href="#" class="button_pro">View Detail</a>--></span></h1>
            <div class="clear"></div>
            <div class="publishers_section_left_pad">
              <ul>
                <li><img src="<?=base_url()?>images/female.png" alt="" /> 
                <?php $male = ($writer_female_percent['count'] * 100)/$total_writer['count'];
                //echo $m = sprintf ("%.2f", $male);
                echo round($male);
                ?>% Female Writers</li>
                <li><img src="<?=base_url()?>images/male.png" alt="" /> 
                <?php $female = ($writer_male_percent['count'] * 100)/$total_writer['count'];
                //echo $f = sprintf ("%.2f", $female);
                echo round($female);
                ?>% Male Writers</li>
                <div class="clear"></div>
              </ul>
            </div>
          
          
            <!--<h1><img src="<?=base_url()?>images/click_icon.png" alt="" />My Clicks By Publishers</h1>-->
            <div class="publishers_section_left_pad">
           
           <div id="tabs_dem"> 
              <div class="box_section box_section_mar_right30">
                <div class="icon_section"><img src="<?=base_url()?>images/rou_01.png" alt="" /></div>
                <a class="tooltips" href="javascript:void(0)" name="tab_dem1" >
                
                <div class="myclick_para"><div class="myclick_span"><?php echo $user_recently_add_titles_cnt; ?></div>
                  Recent Titles</div>
                
                  <span class="tp_span">Recent <?php echo $user_recently_add_titles_cnt; ?> work has been added by various writers</span>
 <div class="clear"></div>
                </a>
                <a href="#" class="aps_but"  name="tab_dem1">View List</a>
              </div>
              <div class="box_section">
                <div class="icon_section"><img src="<?=base_url()?>images/rou_02.png" alt="" /></div>
                <!--<a class="tooltips" href="<?//=base_url()?>discovery/view_profile_details" >-->
                <a class="tooltips" href="javascript:void(0)" name="tab_dem2" >
                
                <div class="myclick_para" ><div class="myclick_span" ><?=$author_view_cnt['count']?></div>
                  Profile Views</div>
                
                  <span class="tp_span">You have been looked at <?=$author_view_cnt['count']?> various writers profiles.</span>
                  <div class="clear"></div>
                </a>      
                 <a href="#" class="aps_but" name="tab_dem2" >View List</a>          
                
              </div>
              <div class="clear"></div>
              <div class="box_section box_section_mar_right30">
                <div class="icon_section"><img src="<?=base_url()?>images/rou_03.png" alt="" /></div>
                
                <!--<a class="tooltips" href="<?//=base_url()?>discovery/view_download_profile_details" >-->
                <a class="tooltips" href="javascript:void(0)" name="tab_dem3" >
                
                <div class="myclick_para" ><div class="myclick_span" ><?=$user_download_details_cnt['count']?></div>
                  Downloads</div>
                
                  <span class="tp_span">You have been downloaded <?=$user_download_details_cnt['count']?> files of different writer's works</span>
 <div class="clear"></div>
                </a>
                 <a href="#" class="aps_but" name="tab_dem3" >View List</a>
              </div>
              <div class="box_section">
                <div class="icon_section"><img src="<?=base_url()?>images/rou_04.png" alt="" /></div>
                
                <!--<a class="tooltips" href="<?=base_url()?>discovery/view_bookshelf_profile_details" >-->
                <a class="tooltips" href="javascript:void(0)" name="tab_dem4" >
                
                <div class="myclick_para"><div class="myclick_span" ><?=$user_bookshelf_details_cnt['count']?></div>
                  Bookshelf Additions</div>
                
                  <span class="tp_span">Great news! You bookshelved <?=$user_bookshelf_details_cnt['count']?> books of various writers</span>
 <div class="clear"></div>
                </a>
                <a href="#" class="aps_but" name="tab_dem4" >View List</a>
              </div>
              <div class="clear"></div>
           
           </div>   
              
              <h3>Most Popular Submissions by Writers</h3>
              
     <?php
        $i = 0;
        foreach($user_popular_category_work as $vtm)
        {
            $i = $i + $vtm['catcount'];
        }
        //echo $i;
     ?>
<script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Percentage'],
          
          <?php 
          foreach($user_popular_category_work as $vtm)
           {
            $catcnt = ($vtm['catcount'] * 100)/$i;
            $fcatcnt = sprintf ("%.2f", $catcnt);
          ?>
          ['<?php echo $fcatcnt."% ".$vtm['category_name'];?>',     <?php echo $fcatcnt;?>],
          
          <?php } ?>
        ]);

        var options = {
          //title: 'My Daily Activities',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script> 
     
              <div align="center">
                <div id="piechart_3d" style="width: 100%; height: auto;"></div>
              </div>
              
              
            </div>
   
        
   <!-----------------End pie------------------------>     
        
        
         <h1><img src="<?=base_url()?>images/you_icon.png" alt="" />Searches</h1>
        <ul class="list">
          <li><p class="tot"><img src="<?=base_url()?>images/icon_p1.png" alt="" /><a href="<?=base_url()?>discovery/ManageSavedSearches">Total Saved Searches</a><span><?php echo $save_search_count['count']?></span></p></li>
          <li class="hov_col"><p class="tot"><img src="<?=base_url()?>images/icon_p2.png" alt="" /><a href="<?=base_url()?>bookshelves">In My Bookshelves</a><span><?php echo count($bookshelf_test)?></span></p></li>
          <!--<li><p class="tot"><img src="<?//=base_url()?>images/icon_p3.png" alt="" />Saved Search Alerts<span>0</span></p></li>-->
          
        </ul> 
        
        
      </div>
      </div>
      
      <div class="publishers_section_right" style="margin-top:0;" id="content_dem"> 
      
      <div style="display: block;" id="tab_dem1">
      
      <div style="display: block;" id="tab_1">
      
          <h1><img src="<?=base_url()?>images/rou_01.png" alt="" /> Recently Added Titles</h1>
   
   <table width="100%" border="0" class="tab_new_upp">
   <thead>       
  <tr>
    <th align="left" width="40%">Title</th>
    <th align="center" width="40%">Submitted By</th>
    <th align="center" width="20%">Date</th>
  </tr>
  </thead>
  <tbody>
  
    <?php
    //echo '<pre/>';print_r($user_recently_add_titles);die;
      if(!empty($user_recently_add_titles))
      {
        foreach($user_recently_add_titles as $total_title)
        {
      ?>
  
  <tr>
    <td><span style="cursor: pointer;"  onclick="openDialog(<?php echo $total_title['id'];?>,<?php echo $total_title['user_id'];?>)"><?=$total_title['title']?></span></td>
    <td align="center">
    <a href="<?=base_url()?>discovery/user_details/<?php echo $total_title['user_id'];?>">
    <?php if(!empty($total_title['filename'])) {?>
                    <img src="<?=base_url()?>uploadImage/<?=$total_title['user_id']?>/profile/<?=$total_title['filename']?>" class="img_sz_small_24" style="padding:0;"/>
                 <?php } else {?>
                     <img src="<?=base_url()?>images/img_default_headshot.png" class="img_sz_small_24" style="padding:0;"/>
                 <?php } ?> 
    <?=$total_title['name_first'].' '.$total_title['name_middle'].' '.$total_title['name_last']?>
    </a>
    </td>
    <td align="center">
    
    <?php 
                if(!empty($total_title['create_date']))
                    {
                    $date = $total_title['create_date'];
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
         <p>No Title Added</p>
        </td>
        <td align="center"></td>
    </tr>
     
     <?php } ?>
  </tbody>
</table>

   <!---------Popup dialog---------->
           
           <div class="pit_work_dialog_vw" style="display: none;" id="pit_work_dialog">
                  
                 
                  <h4 id="title"></h4>

<p ><span id="tags"><span><br>
<span id="review"></span>
</p>

<h4>Excerpt</h4>

<p id="excerpt"></p>

<h4>Synopsis</h4>

<p id="synopsis"></p>
                  
<a href="#" class="pitchit_pop_icon" id="pitch_icn"><img src="<?php echo base_url()?>/images/icon_p.png"></a>  
<a href="#" class="think_pop_icon" id="think_icn"><img src="<?php echo base_url()?>/images/think.png"></a> 
                    <!--<a class="green_but" href="#bookshelf" rel="facebox">Add to Bookshelf</a>-->
  <span id="download"></span>
                    
                    <?php /*if($workdetails['file_asset_id'] != '') {?>
                <a href="<?=base_url()?>discovery/download/<?=$workdetails['id']?>/<?=$workdetails['file_asset_id']?>/<?=$workdetails['user_id']?>/<?=$workdetails['work_file']?>" style="color: #70a1df;"><?=$workdetails['work_file']?></a>
                <?php } */?>
                    
                    <a href="javascript:void(0);" id="cancl_pit">Close</a>
                  </div>
           
           <!----------End------------------>

<?php if($user_recently_add_titles_cnt > 10) {?>
<div class="paginate_div">
<?php if($total_rows > $offset){ ?><a href="javascript:;" onclick="ajaxDiscovery(<?php echo $page+1;?>)" class="blue_but floright_martop">VIEW OLDER</a><?php }else{?> <a href="javascript:;" class="blue_but floright_martop">VIEW OLDER</a> <?php } ?>

<?php if($offset == "0"){?>&nbsp;<?php }else{ ?> <a href="javascript:;" class="green_but floright_martop" onclick="ajaxDiscovery(<?php echo $page-1;?>)">PREVIOUS</a> <?php } ?> 
 </div>
<?php } ?> 
<!--<a href="#" class="button">VIEW OLDER</a> 
        <h1><img src="<?//=base_url()?>images/cercel_icon.png" alt="" />AEPs' Demographics<span><a href="#" class="button_pro">View Detail</a></span></h1>
        <div class="publishers_section_left_pad">
          
          <h3>Most Popular Genera</h3>
          <div align="center"> 
          
          	<div id="piechart_3d" style="width: 100%; height: auto;"></div>

          </div>
        </div>-->
     
     </div>   
        
     </div>
     
     
     <div style="display: none;" id="tab_dem2">
  
  <div id="tab_2">
          <h1><img src="<?=base_url()?>images/rou_02.png" alt="" /> Top 10 Profile Views</h1>
   
   <table width="100%" border="0" class="tab_new_upp">
   <thead>       
  <tr>
    <th align="left" width="40%">Title</th>
    <th align="center" width="40%">Submitted By</th>
    <th align="center" width="20%">Date</th>
  </tr>
  </thead>
  <tbody>
      <?php
      if(!empty($author_view_details))
      {
        foreach($author_view_details as $total_viewer)
        {
      ?>
  <tr>
    <td><?//=$total_viewer['name_first'].' '.$total_viewer['name_middle'].' '.$total_viewer['name_last']?>
    <span style="cursor: pointer;"  onclick="openDialog(<?php echo $total_viewer['wid'];?>,<?php echo $total_viewer['wuid'];?>)"><?=$total_viewer['title']?></span>
    </td>
    <td align="center">
    
    <a href="<?=base_url()?>discovery/user_details/<?php echo $total_viewer['wuid'];?>">
    <?php if(!empty($total_viewer['filename'])) {?>
                    <img src="<?=base_url()?>uploadImage/<?=$total_viewer['wuid']?>/profile/<?=$total_viewer['filename']?>" class="img_sz_small_24" style="padding:0;"/>
                 <?php } else {?>
                     <img src="<?=base_url()?>images/img_default_headshot.png" class="img_sz_small_24" style="padding:0;"/>
                 <?php } ?> 
    <?=$total_viewer['name_first'].' '.$total_viewer['name_middle'].' '.$total_viewer['name_last']?>
    </a>
   
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
         <p>No title viewed</p>
        </td>
        <td align="center"></td>
    </tr>
     
     <?php } ?>
  </tbody>
</table>

      <?php if($author_view_cnt['count'] > 10) {?>
<div class="paginate_div">
<?php if($total_rows2 > $offset){ ?><a href="javascript:;" onclick="ajaxDiscovery2(<?php echo $page+1;?>)" class="blue_but floright_martop">VIEW OLDER</a><?php }else{?> <a href="javascript:;" class="blue_but floright_martop">VIEW OLDER</a> <?php } ?>

<?php if($offset == "0"){?>&nbsp;<?php }else{ ?> <a href="javascript:;" class="green_but floright_martop" onclick="ajaxDiscovery2(<?php echo $page-1;?>)">PREVIOUS</a> <?php } ?> 
 </div>
<?php } ?> 
     
    </div>
      
     </div>
     
  
  <div style="display: none;" id="tab_dem3">
  
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
    <td><span style="cursor: pointer;"  onclick="openDialog(<?php echo $total_downloader['id'];?>,<?php echo $total_downloader['user_id'];?>)"><?=$total_downloader['title']?></span></td>
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
         
  <?php if($user_download_details_cnt['count'] > 10) {?>
    <div class="paginate_div">
    <?php if($total_rows3 > $offset){ ?><a href="javascript:;" onclick="ajaxDiscovery3(<?php echo $page+1;?>)" class="blue_but floright_martop">VIEW OLDER</a><?php }else{?> <a href="javascript:;" class="blue_but floright_martop">VIEW OLDER</a> <?php } ?>
    
    <?php if($offset == "0"){?>&nbsp;<?php }else{ ?> <a href="javascript:;" class="green_but floright_martop" onclick="ajaxDiscovery3(<?php echo $page-1;?>)">PREVIOUS</a> <?php } ?> 
     </div>
    <?php } ?>  
    
    </div>  
      
     </div>  
     
     
  <div style="display: none;" id="tab_dem4">
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
      if(!empty($bookshelf_profiles))
      {
        foreach($bookshelf_profiles as $total_bookshelved_user)
        {
      ?>
  
  <tr>
    <td><?=$total_bookshelved_user['title']?></td>
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
  
  <!--<tr>
    <td>Tales from the Road</td>
    <td align="center"><img src="<?//=base_url()?>images/hand.png" alt="" /></td>
    <td align="center">1/22/15</td>
  </tr>-->
  
  </tbody>
</table>

<?php if($user_bookshelf_details_cnt['count'] > 10 ) { ?>
<a href="#" class="button">VIEW OLDER</a> 
 <?php } ?>
      
     </div>     
        
      </div>
      <div class="clear"></div> 
    </div>
    
   <div class="clear"></div> 
    <!------------------End pitchit--------------------------------->
                    
                    
   <?php /* <div class="pitchits_section_right work_section change_width"> 
      <h1><img src="<?=base_url()?>images/work_img.png" alt="" />Latests Work <span> <a href="#" class="button_pro">View All</a></span></h1>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_new">
        <thead>
          <tr>
            <th width="10%" align="center">No.</th>
            <th width="20%" align="center">Book Cover</th>
            <th width="30%" align="center">Title</th>
            <th width="25%" align="center">Author</th>
            <th width="15%" align="center">AEP Views</th>
          </tr>
        </thead>
        
       <tbody>
              
              
               <?php 
               //echo '<pre/>';print_r($bookshelf_latest_list);die;
               if(!empty($bookshelf_latest_list))
                    {
                    $i =1;    
                 foreach($bookshelf_latest_list as $details)
                 {
               
                 $user_category_details = $this->memail->get_user_work_categories($details['Wid']);
               ?>
               <tr>
                <td width="6%" align="center"><?=$i;?></td>
                <td width="12%" align="center">
                 <?php if($details['photo'] != '') { ?>
                 
                 <img src="<?=base_url()?>uploadImage/<?=$usd['id']?>/cover_image/thumbs/<?=$details['photo']?>" alt="" />
                
                <?php } else { ?>
                
                <img src="<?=base_url()?>images/img_default_cover_mywork.png" alt="" />
                
                <?php } ?>
                
                </td>
                <td width="34%" align="center"><a href="<?=base_url()?>work/work_details/<?=$details['id']?>"><p><strong><?=$details['title']?></strong></p></a>                 <p><?=$details['type_name']?><br />
                    Categories: 
                    <span>
                    <?php if(!empty($user_category_details))
                     {
                     foreach($user_category_details as $categories)
                     {
                        echo $categories['category_name'].', ';
                     } } ?>
                    </span></p>
                </td>
                <td width="24%" align="center"><?=$details['name']?></td>
                <td width="24%" align="center"><span style="color:#3c97ff; padding:0 10px;">35</span><img src="<?=base_url()?>images/eye.png" alt="" style="float:right; margin-top:-2px; margin-right:5px;" /></td>
                </tr>
                <?php  $i++; } } else { ?>
                <tr>
                <td width="6%" align="center"></td>
                <td width="12%" align="center"></td>
                <td width="24%" align="center"><p>Sorry! There are no works.</p></td>
                <td width="34%" align="center"></td>
                <td width="24%" align="center"></td>
                </tr>
                <?php } ?>
              
              <!--<tr class="hov_col">
                <td align="center">2</td>
                <td align="center"><img src="<?//=base_url()?>images/img_01.jpg" alt="" /></td>
                <td align="center"><p><strong>MH 370 - Full Story</strong><br />
                    Non-fiction<br />
                    Categories: <span>Journalism</span></p></td>
                <td align="center">Mar 21, 2014</td>
                <td align="center"><a href="#" class="button_pro" style="display:none">Pitchit!</a></td>
              </tr>-->
              
            </tbody>  
        
        
      </table>
    </div> */?>
                    
                    <div class="clear"></div>
                    
                  
                    
                </div>
                <div class="clear"></div>
 
<script type="text/javascript">
$(document).ready(function() {
    $("#content").find("[id^='tab']").hide(); // Hide all content
    $("#tabs li:first").attr("id","current"); // Activate the first tab
    $("#content #tab1").fadeIn(); // Show first tab's content
    
    $('#tabs a').click(function(e) {
        e.preventDefault();
        if ($(this).closest("li").attr("id") == "current"){ //detection for current tab
         return;       
        }
        else{             
          $("#content").find("[id^='tab']").hide(); // Hide all content
          $("#tabs li").attr("id",""); //Reset id's
          $(this).parent().attr("id","current"); // Activate this
          $('#' + $(this).attr('name')).fadeIn(); // Show content for the current tab
        }
    });
    
    
    $("#content_dem").find("[id^='tab_dem']").hide(); // Hide all content
    $("#tabs_dem div:first").attr("id","current"); // Activate the first tab
    $("#content_dem #tab_dem1").fadeIn(); // Show first tab's content
    
    $('#tabs_dem a').click(function(e) {
        e.preventDefault();
        if ($(this).closest("div").attr("id") == "current"){ //detection for current tab
         return;       
        }
        else{             
          $("#content_dem").find("[id^='tab_dem']").hide(); // Hide all content
          $("#tabs_dem div").attr("id",""); //Reset id's
          $(this).parent().attr("id","current"); // Activate this
          $('#' + $(this).attr('name')).fadeIn(); // Show content for the current tab
        }
    });
    
    
});
</script> 
                  

<script src="<?=base_url()?>ckeditor/ckeditor.js"></script>
                
<?=$this->load->view('template/inner_footer_dashboard.php')?>             

