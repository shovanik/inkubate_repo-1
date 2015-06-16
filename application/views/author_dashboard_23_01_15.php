<?=$this->load->view('template/inner_header_dashboard.php')?>
<?php $usd = $this->session->userdata('logged_user'); 
//echo '<pre/>';print_r($user_notification);die;
//echo json_encode($user_notification);die;
//$category_details  = $this->mprofile->total_publisher_details();
//print_r($category_details);die;
$jsArray = array();
foreach($user_notification as $notification) {
   $jsArray[] = array($notification['id']); 
}
$notify = json_encode($jsArray);
//echo json_encode($jsArray);die;
//echo '<pre/>';print_r($total_view_pitchit);die;
?>
<script type="text/javascript" src="<?=base_url()?>js/jquery-ui.min.js"></script>

<link rel="stylesheet" href="<?=base_url()?>style/inner/chosen.css"/>
<script src="<?=base_url()?>js/chosen.jquery.js" type="text/javascript"></script>

<script type="text/javascript">
    var config = {
      '.chosen-select'           : {max_selected_options: 3},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
      values = [];
      $(".chosen-select").chosen().change(function(e, params){
      values = $(".chosen-select").chosen().val();
      if( values != null)
      {
      var cat = values.length;
      $('#cate_cnt').text(cat);
      }
      else
      {
       var cat = 0;
       $('#cate_cnt').text(cat); 
      }
 //values is an array containing all the results.
});
    }
  </script> 

<script type="text/javascript">

    
   $('#pit_work').click(function () {
        
            $(".pit_work_dialog").dialog({
                close: function () {
                    
                     //$('#pit_work').data('clicked', false);
                }
            });
        
    }); 
    

</script>
<script>
var base_url = '<?php echo base_url()?>';
//alert('<img src="'+base_url+'assets/img/ajax-loader.gif"/');
  jQuery.ias({
        container : '#full_content_div',
        item: '.itemld',
        pagination: '.paginate',
        next: '.nextPage a',
        loader: '<img src="'+base_url+'assets/img/ajax-loader.gif"/>',
        onPageChange: function(pageNum, pageUrl, scrollOffset) {
            //console.log('Welcome on page ' + pageNum);
            $('.chosen-select').chosen();
        },
        onRenderComplete : function(){
            //getRatingProduct();
            //getMerchantProductRating();
        },
        history:false
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
    
 
 $(".tip_trigger2").hover(function(){
		tip2 = $(this).find('.tip2');
		tip2.show(); //Show tooltip
	}, function() {
		tip2.hide(); //Hide tooltip		  
	}).mousemove(function(e) {
		var mousex = e.pageX + 20; //Get X coodrinates
		var mousey = e.pageY + 20; //Get Y coordinates
		var tipWidth = tip2.width(); //Find width of tooltip
		var tipHeight = tip2.height(); //Find height of tooltip
		
		//Distance of element from the right edge of viewport
		var tipVisX = $(window).width() - (mousex + tipWidth);
		//Distance of element from the bottom of viewport
		var tipVisY = $(window).height() - (mousey + tipHeight);
		  
		if ( tipVisX < 20 ) { //If tooltip exceeds the X coordinate of viewport
			mousex = e.pageX - tipWidth - 20;
		} if ( tipVisY < 20 ) { //If tooltip exceeds the Y coordinate of viewport
			mousey = e.pageY - tipHeight - 20;
		} 
		tip2.css({  top: mousey, left: mousex });
	}); 
    
    
    
  $(".tip_trigger22").hover(function(){
		tip22 = $(this).find('.tip22');
		tip22.show(); //Show tooltip
	}, function() {
		tip22.hide(); //Hide tooltip		  
	}).mousemove(function(e) {
		var mousex = e.pageX + 20; //Get X coodrinates
		var mousey = e.pageY + 20; //Get Y coordinates
		var tipWidth = tip22.width(); //Find width of tooltip
		var tipHeight = tip22.height(); //Find height of tooltip
		
		//Distance of element from the right edge of viewport
		var tipVisX = $(window).width() - (mousex + tipWidth);
		//Distance of element from the bottom of viewport
		var tipVisY = $(window).height() - (mousey + tipHeight);
		  
		if ( tipVisX < 20 ) { //If tooltip exceeds the X coordinate of viewport
			mousex = e.pageX - tipWidth - 20;
		} if ( tipVisY < 20 ) { //If tooltip exceeds the Y coordinate of viewport
			mousey = e.pageY - tipHeight - 20;
		} 
		tip22.css({  top: mousey, left: mousex });
	});      
      
    
});

</script>
<script>

$(document).ready(function() {
    
   $('#notify').click(function(){
   
        
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

 });
 

</script>


<style>
.pitchits_section_new .pitchits_section_right { border: none;}
.pitchits_section_new .pitchits_section_right .table_new tbody td {border-bottom: 1px solid #e5e5e5; border-top: none; line-height: 18px;   vertical-align: middle;}
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
</style>

<style>
.modalDialog {
    position: fixed;
    font-family: Arial, Helvetica, sans-serif;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    background: rgba(0, 0, 0, 0.8);
    z-index: 99999;
    opacity:0;
    -webkit-transition: opacity 400ms ease-in;
    -moz-transition: opacity 400ms ease-in;
    transition: opacity 400ms ease-in;
    pointer-events: none;
}
.modalDialog:target {
    opacity:1;
    pointer-events: auto;
}
.modalDialog > div {
    width: 30%;
    position: relative;
    margin: 10% auto;
    padding: 13px 20px 13px 20px;
    border-radius: 10px;
    background: #fff;
   
}
.close {
    background: #606061;
    color: #FFFFFF;
    line-height: 25px;
    position: absolute;
    right: -12px;
    text-align: center;
    top: -10px;
    width: 24px;
    text-decoration: none;
    font-weight: bold;
    -webkit-border-radius: 12px;
    -moz-border-radius: 12px;
    border-radius: 12px;
    -moz-box-shadow: 1px 1px 3px #000;
    -webkit-box-shadow: 1px 1px 3px #000;
    box-shadow: 1px 1px 3px #000;
}
.close:hover {
    background: #00d9ff;
}
.table_new tbody tr:hover {background:none!important;}

.work_section .table_new tbody td {height:60px !important;} 
.blue_back {height: 120px !important;padding: 10px 60px 0 35px !important; width: 743px ;line-height: 18px;}
.dasbord_news_section_left {min-height: 190px;}
</style>

<script language="javascript" type="text/javascript">
function limitText(limitField, limitCount, limitNum) {
	if (limitField.value.length > limitNum) {
		limitField.value = limitField.value.substring(0, limitNum);
	} else {
		limitCount.value = limitNum - limitField.value.length;
	}
}
BASE = "<?php echo base_url();?>";
function inviteValidate()
{
	$("#friendNameError").html("");
	$("#friendEmailError").html("");
	if($("#friend_name").val() == "" || $("#friend_name").val() == "Your Friend’s Name")
	{
		$("#friendNameError").html("Please provide a friend Name");
		return false;
	}
	if($("#friend_email").val() == "" || $("#friend_email").val() == "Your Friend’s Email")
	{
		$("#friendEmailError").html("Please provide a friend email");
		return false;
	}
	var email=$('#friend_email').val();
	var filter = /[\w-]+@([\w-]+\.)+[\w-]+/;
	
	if (!filter.test(email)) {
	   $("#friendEmailError").html("Please enter a valid email");	   
	    return false;
	}
	$.ajax({
                type:'POST',
                url:BASE+'home/invite_email_exist',
		data:{email:$("#friend_email").val()},
                dataType:'json',
                success:function(data){
                    var html = '';
                    if(data['status'] == "1")
                    {
                    	if(data['user_type'] == "1")
                    	{
                    		$("#friendEmailError").html("This person is already a member. You can contact him through message center..");	 
                    	}
                    	else if(data['user_type'] == "3")
                    	{
                    		$("#friendEmailError").html("This person is already a member. But right now you cannot contact him as his membership has not yet been activated.");	
                    	}
                    	else
                    	{
                    		$("#friendEmailError").html("You cannot invite him as he is already publisher on inkubate.");	 
                    	}
                        return false;
                    }                   
                    else
                    {
                        $("#frmInvite").submit()
                    }
                }
     });
}
</script>
  

    <div class="content_part">
      <div class="mid_content index_sec mid_content_new">
        <div class="top_welcome_section index_for_mob">
          <div class="top_welcome_section_left">
          <?php 
          $mailinvite = $this->session->userdata('invite_mail');
          if($mailinvite != ""){ ?>
          	<div style="margin:10px 0 0 10px; color:green"><?php //echo $this->session->userdata('invite_mail');?>
          	You have successfully invited your friend!
          	</div>
          <?php $this->session->unset_userdata('invite_mail'); } ?>
          <ul>
              <li><a href="#" class="green_icon hidetext2 tip_trigger" ><span class="tip" id="invite_id">Click to Invite Friend</span></a><!--<span class="green">02</span>--></li>
              <li><a href="#" class="pink_icon hidetext3 tip_trigger1" id="notify"><span class="tip1" id="msg_id">Click to show recent messages</span></a><span class="pink" id="cnt"><?php echo count($user_notification_count)?></span></li>
              <li><a href="#" class="orange_icon hidetext5 tip_trigger2"><span class="tip2" id="pub_id">Click to show publishers</span></a><span class="orange"><?php echo count($publisher_pitchit)?></span></li>
            </ul>
            
            <div class="bottom_text4" style="display:none;">
             
           </div>
            
            <div class="bottom_text2" style="display:none;">
              <div class="arror_top"><img src="<?=base_url()?>images/arror_top.png" alt="" />
              </div>
              <span style="float: right; margin-top: -24px; cursor: pointer;" id="cross"><img src="<?=base_url()?>images/close_22.png" alt="" /></span>
              <h4><span>Your Invites <!--<strong>2</strong>--></span></h4>
             
                <table width="100%" border="0">
                <?php
                               $frmAttrs   = array("id"=>'frmInvite');
                               echo form_open('home/invite', $frmAttrs);
                 ?>
                
                  <tr>
                    <td><input type="text" id="friend_name" name="friend_name" value="Your Friend’s Name" onblur="javascript:if(this.value=='')this.value='Your Friend’s Name';" onfocus="javascript:if(this.value=='Your Friend’s Name')this.value='';" />
                    <div id="friendNameError" style="color:red"></div>
                    </td>
                  </tr>
                  <tr>
                    <td><input type="text" id="friend_email" name="friend_email" value="Your Friend’s Email" onblur="javascript:if(this.value=='')this.value='Your Friend’s Email';" onfocus="javascript:if(this.value=='Your Friend’s Email')this.value='';" />
                    <div id="friendEmailError" style="color:red"></div>
                    </td>
                  </tr>
                  </form>
                  <tr>
                    <td><a class="button_pro" href="javascript:;"  onclick="inviteValidate()">Send<img alt="" src="<?=base_url()?>images/arrow.png"/></a></td>
                  </tr>
                </table>
              
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
                  <input type="hidden" name="nt_id" id="nt_id" value="<?php echo $notification['id']?>" />
                </div>
                <div class="clear"></div>
              </div>
              
              <?php } } ?>
              
              <div class="clear"></div>
              <div class="see_all"><a href="<?=base_url()?>home/inbox">See All</a></div>
            </div>
            
            <!------------End Notification------------->
            
          <!------------show publisher Pitchit------------->
            <?php //echo '<pre/>';print_r($user_notification);die;?>
            <div class="bottom_text5" style="display:none;">
              <div class="arror_top"><img src="<?=base_url()?>images/arror_top.png" alt="" /></div>
              <p class="heading">Pitchit Viewed (<?php echo count($publisher_pitchit)?>)</p>
              <span style="float: right; margin-top: -31px; margin-right: 7px; cursor: pointer;" id="cross3"><img src="<?=base_url()?>images/close_22.png" alt="" /></span>
              
               <?php if(!empty($publisher_pitchit)) {
                
                foreach ($publisher_pitchit as $pit) {
                
                ?>
              
              <div class="see_box"> 
              <?php if(!empty($pit['photo'])) { ?>
              <img src="<?=base_url()?>uploadImage/<?=$pit['user_id']?>/profile/<?=$pit['photo']?>" alt="" class="img_sz_small" />
              <?php } else { ?>
              <img src="<?=base_url()?>images/img_default_headshot.png" alt="" class="img_sz_small" />
              
              <?php } ?>
                <div>
                  <h5><?php echo $pit['name_first'].' '.$pit['name_middle'].' '.$pit['name_last']?>
                  </h5>has viewed the "<?=substr($pit['pitchit'],0,10).'...'?>" 
                  
                </div>
                <div class="clear"></div>
              </div>
              
              <?php } } ?>
              
              <div class="clear"></div>
              <!--<div class="see_all"><a href="<?//=base_url()?>home/inbox">See All</a></div>-->
            </div>
            
            <!------------End Pitchit------------->  
            
          </div>
          <?php $usd = $this->session->userdata('logged_user');?>
          <div class="top_welcome_section_right">
          
          <?php if(!empty($user_photo['filename'])) {?>
                    <img src="<?=base_url()?>uploadImage/<?=$usd['id']?>/profile/<?=$user_photo['filename']?>" class="img_sz"/>
                 <?php } else {?>
                     <img src="<?=base_url()?>images/img_default_headshot.png" class="img_sz"/>
                 <?php } ?>          
                              
            <p style="color:#9a9a9a;"><strong>Welcome</strong><br /><?php echo $usd['name_first'].' '.$usd['name_middle'].' '.$usd['name_last'];?><br />
              <span style=" font-size: 11px;">Member since <?php echo date('m/d/Y',strtotime($usd['created']))?></span></p>
          </div>
        </div>
        <div class="dasbord_news_section">
          <div class="dasbord_news_section_left">
            <h1><img src="<?=base_url()?>images/heading_icon.png" alt="" />Dashboard News</h1>
            <div class="blue_back"><img src="<?=base_url()?>images/cup_icon.jpg" alt="" />
            
            Welcome <?=$usd['name_first']?> : This area of Inkubate is where you can upload, categorize, edit and store your manuscripts. Please make sure to fill in as much detail as possible about your titles, so that your works and associated metadata are easily discoverable by agents, editors and publishers.  Also, be sure to complete your bio and upload your photo. Your work is protected within Inkubate's secure platform! We're glad that you're here!
            
            </div>
          </div>
          <div class="dasbord_news_section_right no_display">
          <?php 
            $chck_bio = $this->mprofile->check_bio($usd['id']);
            $chck_photo = $this->mprofile->check_photo($usd['id']);
            $chck_work = $this->mprofile->check_work($usd['id']);
            $chck_social = $this->mprofile->check_social($usd['id']);
            
            if(!empty($chck_bio)){if($chck_bio > 0)    { $bio = 1; }} else {$bio = 0;}
            if(!empty($chck_photo)){if($chck_photo > 0)  { $photo = 1; }} else {$photo = 0;}
            if(!empty($chck_work)){if($chck_work > 0)   { $work = 1; }} else {$work = 0;}
            if(!empty($chck_social)){if($chck_social > 0) { $social = 1; }} else {$social = 0;}
            
            $total_percent = 25 * ($bio+$photo+$work+$social);
            ?>
          
            <h2>Profile is <?php echo $total_percent;?> % complete !</h2>
            
            
            <?php if($chck_bio > 0) {?>
            <div class="bio_section_33"><span>Your Bio</span></div>
            <?php } else {?>
            <div class="bio_section_22"><span>Your Bio</span></div>
            <?php } if($chck_photo > 0) {?>
            <div class="bio_section_33"><span>Your Photo</span></div>
            <?php } else {?>
            <div class="bio_section_22"><span>Your Photo</span></div>
            <?php } if($chck_work > 0) {?>
            <div class="bio_section_33"><span>Your Work</span></div>
            <?php } else {?>
            <div class="bio_section_22"><span>Your Work</span></div>
            <?php } if($chck_social > 0) {?>
            <div class="bio_section_33"><span>Social</span></div>
            <?php } else {?>
            <div class="bio_section_22"><span>Social</span></div>
            <?php } ?>
            <a href="<?=base_url()?>profile/editProfile/<?php echo $usd['id'];?>" class="button_pro">Update Profile<img src="<?=base_url()?>images/arrow.png" alt="" /></a> </div>
          <div class="clear"></div>
        </div>
        
        
        <!---pitchit----------->
        
        <div class="pitchits_section pitchits_section_new">
          <div class="pitchits_section_left">
            <h1><img src="<?=base_url()?>images/icon_p.png" alt="" />My Pitchits!</h1>
            <ul class="list" id="tabs">
              <li id="current" class="hov_col"><a href="javascript:void(0)" name="tab1">Latest PitchIts!</a></li>
              <li class="hov_col"><a href="javascript:void(0)" name="tab2">Saved PitchIts!  <span><?=$user_pitchit_saved_details_cnt['count']?></span></a></li>
              <li class="hov_col"><a href="javascript:void(0)" name="tab3">View All PitchIts! <span><?=count($user_pitchit_details)?></span></a></li>
              <li class="hov_col"><a href="javascript:void(0)" name="tab4">Total Viewed PitchIts! <span><?=$total_view_pitchit_cnt?></span></a></li>
              <li class="hov_col"><a href="javascript:void(0)" name="tab5">Earned PitchIts! <span>5</span></a></li>
              <li class="hov_col"><a href="javascript:void(0)" name="tab6">Purchase PitchIts! <span class="pad_no"><img src="<?=base_url()?>images/cart.png" alt="" /></span></a></li>
            </ul>
          </div>
          <div class="pitchits_section_right" id="content">
          
          	<div style="display: block;" id="tab1">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_new">
              <thead>
                <tr>
                  <th width="17%" >Pitched Work</th>
                  <th width="15%" >Viewed By</th>
                  <th width="35%" >PitchIt! Message</th>
                  <th width="18%" class="center">Times Viewed</th>
                  <th width="15%" class="center">Date</th>
                </tr>
              </thead>
              <tbody>
                
                <?php 
                   //echo '<pre/>';print_r($user_pitchit_details);die;
                   if(!empty($user_pitchit_details))
                    {
                    $i =1;    
                     foreach($user_pitchit_details as $pitch_details)
                     {
                        $pitchit_view = $this->memail->get_user_pitchit_view($pitch_details['wid']);
                        $pitchit_view_user = $this->memail->get_user_pitchit_view_user($pitch_details['pit_id']);
                        
                        $pitchit_msg = $this->memail->get_user_pitchit_msg($pitch_details['pit_id']);
                        $total_response_recent  = $this->memail->get_user_pitchit_msg_recent($pitch_details['pit_id']);
                        //echo '<pre/>';print_r($pitchit_view_user);die;
                        if(!empty($total_response_recent))
                        {
                        $single_user = $this->mwork->single_user($total_response_recent['from_user_id']);
                        }
                        else
                        {
                         $single_user = $this->memail->get_user_pitchit_view_user($pitch_details['pit_id']);   
                        }
                                          
                                            
                     ?>
                     
              <!--<tr style="cursor: pointer;" id="pit_work_lat_first_<?//=$pitch_details['id']?>">-->
              <tr>
              
                  <td align="center">
                  
                  <a class="tooltips" href="javascript:void(0)" >
                  <?php 
                  if(strlen($pitch_details['title']) > 18)
                  {
                    echo substr($pitch_details['title'],0,18).'...';
                  }
                  else
                  {
                    echo $pitch_details['title'];
                  }
                  ?>
                  
                  <span class="tp_span2"><?php echo $pitch_details['title'];?></span>
 <div class="clear"></div>
                  </a>
                  </td>
                  <td align="center">
                   <?php 
                  if(!empty($single_user))
                  {
                    echo $single_user['name_first'].' '.$single_user['name_middle'].' '.$single_user['name_last'];
                  }
                  else
                  {
                    echo 'N/A';
                  }
                  ?>
                  </td>
                  <td align="center" style="cursor: pointer;" id="pit_work_lat_first_<?=$pitch_details['pit_id']?>" >
                  
                 <div class="think_img">
                  <?php if($pitchit_msg['count'] > 0) { ?>
                  
                  <a class="tooltips" href="javascript:void(0)">
                  
                  <img src="<?=base_url()?>images/think.png" alt="" />
                                   
                  <?php
           if(strlen($pitch_details['pitchit']) > 16)
                      {
                      echo substr($pitch_details['pitchit'],0,16).'..';
                      }
                   else
                      {
                      echo $pitch_details['pitchit'];  
                      }
                         
                  ?>
                  <span class="tp_span2">An AEP has respond to your pitch, click here to see the conversation</span>
                <div class="clear"></div>
                  
                  </a>
                  
                  <script type="text/javascript">
                $(document).ready(function () {
                   
                   $('#pit_work_lat_first_'+<?=$pitch_details['pit_id']?>).click(function () {
                        
                            $(".pit_work_dialog_lat_first_"+<?=$pitch_details['pit_id']?>).dialog({
                                close: function () {
                                    
                                     //$('#pit_work').data('clicked', false);
                                }
                            });
                            
                         $('#cancl_pit_rep_'+<?=$pitch_details['pit_id']?>).click(function () {
                       
                            $(".pit_work_dialog_lat_first_"+<?=$pitch_details['pit_id']?>).dialog('close');
                            //$('#chkBoxHelp_'+<?=$pitch_details['pit_id']?>).prop('checked', false);
                        
                       });    
                        
                    }); 
                    
                });
                </script>
                  
                  <div class="pit_work_dialog_lat_first_<?=$pitch_details['pit_id']?>" style="display: none;" id="pit_work_dialog">
                    <h1><?=$total_response_recent['subject']?>
                    </h1>
                    <p>An AEP member has sent a message to you <?=$total_response_recent['body']?></p>
                    
                     
                  <a href="#0" class="cd-popup-trigger" id="cd-popup-trigger_first_<?php echo $pitch_details['id']?>">Reply</a>
                  <a href="javascript:void(0);" id="cancl_pit_rep_<?=$pitch_details['pit_id']?>" class="col3">Cancel</a>
                  
                  </div>
                  
                  
                  
                  
         <script>
         jQuery(document).ready(function($){
	//open popup
	$('#cd-popup-trigger_first_'+<?php echo $pitch_details['id']?>).on('click', function(event){
		event.preventDefault();
		$('#cd-popup_first_'+<?php echo $pitch_details['id']?>).addClass('is-visible');
	});
	
	//close popup
	$('#cd-popup_first_'+<?php echo $pitch_details['id']?>).on('click', function(event){
		if( $(event.target).is('.cd-popup-close') || $(event.target).is('#cd-popup_first_'+<?php echo $pitch_details['id']?>) ) {
			event.preventDefault();
			$(this).removeClass('is-visible');
		}
	});
	//close popup when clicking the esc keyboard button
	$(document).keyup(function(event){
    	if(event.which=='27'){
    		$('#cd-popup_first_'+<?php echo $pitch_details['id']?>).removeClass('is-visible');
	    }
    });
    
});
         </script>         
                                  
  <div class="cd-popup" role="alert" id="cd-popup_first_<?php echo $pitch_details['id']?>">
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
                                       
                                       <?php //$single_user = $this->mwork->single_user($pitchit_view_user['user_id']);
                                       
                                       ?>
                                       
                                         <div  class="auto_main" id="parent_email_selected">	
                                            <span id="email_selected">			
		                                    <span id="name<?=$pitchit_view_user['user_id'];?>" class="choosen">
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
		                                    <img onclick="removeEmail(this,'<?=$pitchit_view_user['user_id'];?>')" src="<?=base_url()?>images/close_22.png">
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
                                        <input type="hidden" id="user_email_id" name="user_email_id" value="<?php 
                                        
                                        if(!empty($total_response_recent))
                                        {
                                          echo $total_response_recent['from_user_id']; 
                                        }
                                        else
                                        {
                                          echo $pitchit_view_user['user_id'];  
                                        }
                                        ?>"/>
  					
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
          
             
                  <?php } else {
                    
                  if(strlen($pitch_details['pitchit']) > 30)
                      {
                      echo substr($pitch_details['pitchit'],0,30).'..';
                      }
                   else
                      {
                      echo $pitch_details['pitchit'];  
                      }
          ?>        
             
             <?php 
                 
                    }     
                  ?>
                 
                  </div>
                  </td>
                  <td class="center"><?=$pitchit_view;?></td>
                  <td class="center">
                  <?php 
                   if(!empty($pitchit_view_user['date']))
                    {
                    $date = $pitchit_view_user['date'];
                    $timestamp = strtotime($date);
                    $new_date = date("m/d/y", $timestamp);
                    echo $new_date;
                    }
                    else
                    {
                      echo 'N/A';  
                    }
                  ?></td>
                </tr>
                
               <?php } }  else {?> 
              
               <tr class="hov_col">
                  <td align="center"></td>
                  <td align="center"></td>
                  <td align="center">There are no Pitchits!</td>
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
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_new">
              <thead>
                <tr>
                              
                  <th width="17%">Pitched Work</th>
                  <th width="15%">Viewed By</th>
                  <th width="25%">PitchIt! Message</th>
                  <th width="15%" class="center">Edit</th>
                  <th width="28%" class="center">Keep</th>
                </tr>
              </thead>
              <tbody>
              
              <?php 
                   //echo '<pre/>';print_r($user_pitchit_saved_details);
                   if(!empty($user_pitchit_saved_details))
                    {
                    $i =1;    
                     foreach($user_pitchit_saved_details as $pitch_details)
                     {
                        $pitchit_view = $this->memail->get_user_pitchit_view($pitch_details['wid']);
                        $pitchit_view_user = $this->memail->get_user_pitchit_view_user($pitch_details['pit_id']);
                        
                        $pitchit_msg = $this->memail->get_user_pitchit_msg($pitch_details['pit_id']);
                        //echo '<pre/>';print_r($pitchit_view_user);
                     ?>
              
                <tr>
                  <td width="20%" align="center"><?=$pitch_details['title']?></td>
                  <td width="20%" align="center">
                  <?php 
                  if(!empty($pitchit_view_user))
                  {
                    if($pitchit_view_user['name_first'] != '')
                    {
                     echo $pitchit_view_user['name_first'];
                    }
                    if($pitchit_view_user['name_middle'] != '')
                    {
                     echo $pitchit_view_user['name_middle'];
                    }
                    if($pitchit_view_user['name_last'] != '')
                    {
                     echo $pitchit_view_user['name_last'];
                    }
                    
                  }
                  else
                  {
                    echo 'No Viewer';
                  }
                  ?>
                  </td>
                  <td width="25%" align="center">
                  <?php 
                  if(strlen($pitch_details['pitchit']) <= 10)
                  {
                    echo $pitch_details['pitchit'];
                  }
                  else
                  {
                    echo substr($pitch_details['pitchit'],0,10).'...';
                  }
                  
                  ?>
                  </td>
                  <td width="17%" align="center" class="center"><input type="checkbox" id="chkBoxHelp_<?=$pitch_details['pit_id']?>" name="HelpCheckbox" value="Help" />
                  
                  
                  <script>
                  $(document).ready(function () {
                    $('#chkBoxHelp_'+<?=$pitch_details['pit_id']?>).click(function () {
                        if ($(this).is(':checked')) {
                            $("#txtAge_"+<?=$pitch_details['pit_id']?>).dialog({
                                close: function () {
                                    $('#chkBoxHelp_'+<?=$pitch_details['pit_id']?>).prop('checked', false);
                                }
                            });
                        } else {
                            $("#txtAge_"+<?=$pitch_details['pit_id']?>).dialog('X');
                        }
                    });
                       })           
                  </script>
                  
                    <div class="txtAge" style="display: none;" id="txtAge_<?=$pitch_details['pit_id']?>">
                    <span id="success_pit" style="color: green;"></span>
                    <h1>Saved <?=$pitch_details['title']?> Pitchit!</h1>
                    <p><strong>This PitchIt! was last edited on 
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
                          echo 'No Edit Date';  
                        }
                    
                    ?>
                    </strong></p>
                    
                    <script>
 //BASE = "<?//=base_url()?>";

  function save_pit(id)
   {
    var pit = $('#edittext-001_<?=$pitch_details['pit_id']?>').val();
    //alert(pit);
         $.ajax({
           url      : '<?=base_url()?>'+'home/editPitchit',
           type     : 'POST',
           data     : { 'id':id ,'pit':pit },
           success  : function(data){
                var p;
                    var ps = data.messages;
                    var html='';
                    //var pg = parseInt(page) + 1;
                    console.log(ps);
                    //console.log(data);
                    //alert(data.status);
                    //var count = parseInt(data['count']);
                    if(data.status == "true")
                    {
                        //window.location.reload();
                    	//alert("jasfkjsd");
                        for (var i = 0, p; p = ps[i++];) 
                        {
                            html += '<textarea id="edittext-001_'+id+'" name="edit_pit" cols="" rows="">';
                            html += p.pitchit;
                            html += '</textarea>';
                                            
                        }
                        $("#edit_pit_save").html(html);
                        $("#success_pit").html('Succesfully Edited');
                   } 
           },
           error    : function(resp){
                $.prompt("Sorry, something isn't working right.", {title:'Error'});
           }
          }); 
       }
       
     function do_pit(id)
   {
    var pit = $('#edittext-001_<?=$pitch_details['pit_id']?>').val();
    //alert(pit);
         $.ajax({
           url      : '<?=base_url()?>'+'home/doPitchit',
           type     : 'POST',
           data     : { 'id':id ,'pit':pit },
           success  : function(data){
                var p;
                    var ps = data.messages;
                    var html='';
                    //var pg = parseInt(page) + 1;
                    console.log(ps);
                    //console.log(data);
                    //alert(data.status);
                    //var count = parseInt(data['count']);
                    if(data.status == "true")
                    {
                        //window.location.reload();
                    	//alert("jasfkjsd");
                        for (var i = 0, p; p = ps[i++];) 
                        {
                            html += '<textarea id="edittext-001_'+id+'" name="edit_pit" cols="" rows="">';
                            html += p.pitchit;
                            html += '</textarea>';
                                            
                        }
                        $("#edit_pit_save").html(html);
                        $("#success_pit").html('Succesfully Pitchited!');
                   } 
           },
           error    : function(resp){
                $.prompt("Sorry, something isn't working right.", {title:'Error'});
           }
          }); 
       }     
       
       
  $(document).ready(function() {
    
    $('.delt_msg').click(function() {
      
      var id = <?=$pitch_details['pit_id']?>;
      
      if(confirm('Are you sure to delete this Pitchit?'))
      {
         $.ajax({
           url      : '<?=base_url()?>'+'home/delPitchit',
           type     : 'POST',
           data     : { 'id':id },
           success  : function(data){
                var p;
                    var ps = data.messages;
                    var html='';
                    //var pg = parseInt(page) + 1;
                    console.log(ps);
                    //console.log(data);
                    //alert(data.status);
                    //var count = parseInt(data['count']);
                    if(data.status == "true")
                    {
                        window.location.reload();
                    	//alert("jasfkjsd");
                        for (var i = 0, p; p = ps[i++];) 
                        {
                            html += '<textarea id="edittext-001_'+id+'" name="edit_pit" cols="" rows="">';
                            html += p.pitchit;
                            html += '</textarea>';
                                            
                        }
                        $("#edit_pit_save").html(html);
                        $("#success_pit").html('Succesfully Pitchited!');
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
                 
        
        
    })
    
  })      
     function delt_pit(id)
   {
    //var pit = $('#edittext-001_<?//=$pitch_details['pit_id']?>').val();
    //alert(pit);
    
      if(confirm('Are you sure to delete this Pitchit?'))
      {
         $.ajax({
           url      : '<?=base_url()?>'+'home/delPitchit',
           type     : 'POST',
           data     : { 'id':id },
           success  : function(data){
                var p;
                    var ps = data.messages;
                    var html='';
                    //var pg = parseInt(page) + 1;
                    console.log(ps);
                    //console.log(data);
                    //alert(data.status);
                    //var count = parseInt(data['count']);
                    if(data.status == "true")
                    {
                        window.location.reload();
                    	//alert("jasfkjsd");
                        for (var i = 0, p; p = ps[i++];) 
                        {
                            html += '<textarea id="edittext-001_'+id+'" name="edit_pit" cols="" rows="">';
                            html += p.pitchit;
                            html += '</textarea>';
                                            
                        }
                        $("#edit_pit_save").html(html);
                        $("#success_pit").html('Succesfully Pitchited!');
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
                    
    } 
    
   $(document).ready(function () {
                    $('#cancl_pit_'+<?=$pitch_details['pit_id']?>).click(function () {
                       
                            $("#txtAge_"+<?=$pitch_details['pit_id']?>).dialog('close');
                            $('#chkBoxHelp_'+<?=$pitch_details['pit_id']?>).prop('checked', false);
                        
                    });
                       }) 
       
</script>
                    
                    <span id="edit_pit_save">
                    <textarea id="edittext-001_<?=$pitch_details['pit_id']?>" name="edit_pit" cols="" rows="" disabled="disabled"><?=$pitch_details['pitchit']?></textarea>
                    </span>
                    <a href="javascript:document.getElementById('edittext-001_<?=$pitch_details['pit_id']?>').removeAttribute('disabled').focus();" class="col1">Edit</a>
                    <a href="javascript:void(0);" onclick="save_pit(<?=$pitch_details['pit_id']?>)">Save</a>
                    <a href="javascript:void(0);" id="cancl_pit_<?=$pitch_details['pit_id']?>" class="col3">Cancel</a>
                    <a href="javascript:void(0);" onclick="do_pit(<?=$pitch_details['pit_id']?>)" class="col4">PitchIt!</a>
                    </div>
                    
                    
                  </td>
                  <td width="18%" align="center">
                   <div class="demo">
                                  <select name="menu" id="sl2-ic" tabindex="2">
                                    
                                    <option value="yes" class="yes_msg">Yes</option>
                                    <option value="delete" class="delt_msg" >Delete</option>
                                    
                                    </select>
                                    <a href="#" class="arrow_right_button"><img src="<?=base_url()?>images/arrow_right.jpg" alt="" /></a>
                        </div>             
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
                
              </tbody>
            </table>
            
            <?php if($user_pitchit_saved_details_cnt['count'] > 6) {?>
            <a href="#" class="button_pro">View More</a>
            <?php } ?>
            
            </div>
            <div style="display: none;" id="tab3">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_new">
              <thead>
                <tr>
                  <th width="17%">Pitched Work</th>
                  <th width="15%">Viewed By</th>
                  <th width="35%">PitchIt! Message</th>
                  <th width="18%" class="center">Times Viewed</th>
                  <th width="15%" class="center">Date</th>
                </tr>
              </thead>
              <tbody>
                
                
                 <?php 
                   //echo '<pre/>';print_r($user_pitchit_details);die;
                   if(!empty($user_pitchit_details))
                    {
                    $i =1;    
                     foreach($user_pitchit_details as $pitch_details)
                     {
                        $pitchit_view = $this->memail->get_user_pitchit_view($pitch_details['wid']);
                        $pitchit_view_user = $this->memail->get_user_pitchit_view_user($pitch_details['pit_id']);
                        
                        $pitchit_msg = $this->memail->get_user_pitchit_msg($pitch_details['pit_id']);
                        
                        $total_response_recent  = $this->memail->get_user_pitchit_msg_recent($pitch_details['pit_id']);
                        //echo '<pre/>';print_r($pitchit_view_user);die;
                        //$single_user = $this->mwork->single_user($total_response_recent['from_user_id']);
                        if(!empty($total_response_recent))
                        {
                        $single_user = $this->mwork->single_user($total_response_recent['from_user_id']);
                        }
                        else
                        {
                         $single_user = $this->memail->get_user_pitchit_view_user($pitch_details['pit_id']);   
                        }
                        
                     ?>
                     
              <!--<tr style="cursor: pointer;" id="pit_work_lat_first_all_<?//=$pitch_details['id']?>">-->
              <tr>
              
                  <td align="center">
                  
                  <a class="tooltips" href="javascript:void(0)" >
                  <?//=$pitch_details['title']?>
                  <?php 
                  if(strlen($pitch_details['title']) > 18)
                  {
                    echo substr($pitch_details['title'],0,18).'...';
                  }
                  else
                  {
                    echo $pitch_details['title'];
                  }
                  ?>
                  
                  <span class="tp_span2"><?php echo $pitch_details['title'];?></span>
 <div class="clear"></div>
                  </a>
                  
                  <!--<span id="pit_work_<?//=$pitch_details['id']?>" style="cursor: pointer;">
                  </span>-->
                  
                  
                  <script type="text/javascript">
                $(document).ready(function () {
                   
                   $('#pit_work_'+<?=$pitch_details['id']?>).click(function () {
                        
                            $(".pit_work_dialog_"+<?=$pitch_details['id']?>).dialog({
                                close: function () {
                                    
                                     //$('#pit_work').data('clicked', false);
                                }
                            });
                        
                    });
                    
                    
                     $('#cancl_pit_'+<?=$pitch_details['id']?>).click(function () {
                       
                            $(".pit_work_dialog_"+<?=$pitch_details['id']?>).dialog('close');
                            //$('#chkBoxHelp_'+<?=$pitch_details['pit_id']?>).prop('checked', false);
                        
                    }); 
                    
                });
                </script>
                  
                  <div class="pit_work_dialog_<?=$pitch_details['id']?>" style="display: none;" id="pit_work_dialog">
                  
                  <?php if(!empty($pitchit_view_user)) { ?>
                  
                    <h1><?=$pitch_details['title']?> was viewed by 
                    <?php 
                      echo $pitchit_view_user['name_first'].' '.$pitchit_view_user['name_middle'].' '.$pitchit_view_user['name_last'];
                      
                      ?>
                      on 
                      
                      <?php 
                       if(!empty($pitchit_view_user['date']))
                        {
                        $date = $pitchit_view_user['date'];
                        $timestamp = strtotime($date);
                        $new_date = date("m/d/y", $timestamp);
                        echo $new_date;
                        }
                        else
                        {
                          echo 'N/A';  
                        }
                      ?>
                      viewed <?=$pitchit_view;?> times
                    </h1>
                    
                    <?php } else {?>
                    
                    <h1><?=$pitch_details['title']?> was not viewed by any AEP member yet</h1>
                    
                    <?php } ?>
                    
                    <p>An AEP member will message you directly if he/she is interested in your work</p>
                    <p><strong>Original PitchIt! on 
                    
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
                    
                    </strong></p>
                    <p><?=$pitch_details['pitchit'];?></p>
                    <a href="javascript:void(0);" id="cancl_pit_<?=$pitch_details['id']?>" class="col3">Cancel</a>
                    <!--<a href="###" onclick="click_edit_pit()">Edit</a><a href="#">Save</a><a href="#">Cancel</a><a href="#">PitchIt!</a>-->
                  </div>
                  
                  </td>
                  <td align="center">
                  <?php 
                  if(!empty($single_user))
                  {
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
                          }
                  }
                  else
                  {
                    echo 'N/A';
                  }
                  ?>
                  </td>
                  <td align="center" style="cursor: pointer;" id="pit_work_lat_first_all_<?=$pitch_details['id']?>" >
                  
                 <div class="think_img">
                  <?php if($pitchit_msg['count'] > 0) { ?>
                  
                  
                  <a class="tooltips" href="javascript:void(0)">
                  
                  <img src="<?=base_url()?>images/think.png" alt="" />
                                   
                  <?php
           if(strlen($pitch_details['pitchit']) > 16)
                      {
                      echo substr($pitch_details['pitchit'],0,16).'..';
                      }
                   else
                      {
                      echo $pitch_details['pitchit'];  
                      }
                         
                  ?>
                  <span class="tp_span2">An AEP has respond to your pitch, click here to see the conversation</span>
                <div class="clear"></div>
                  
                  </a>
                  
                  <script type="text/javascript">
                $(document).ready(function () {
                   
                   $('#pit_work_lat_first_all_'+<?=$pitch_details['id']?>).click(function () {
                        
                            $(".pit_work_dialog_lat_first_all_"+<?=$pitch_details['id']?>).dialog({
                                close: function () {
                                    
                                     //$('#pit_work').data('clicked', false);
                                }
                            });
                            
                         $('#cancl_pit_rep_all_'+<?=$pitch_details['id']?>).click(function () {
                       
                            $(".pit_work_dialog_lat_first_all_"+<?=$pitch_details['id']?>).dialog('close');
                            //$('#chkBoxHelp_'+<?=$pitch_details['pit_id']?>).prop('checked', false);
                        
                       });    
                        
                    }); 
                    
                });
                </script>
                  
                  <div class="pit_work_dialog_lat_first_all_<?=$pitch_details['id']?>" style="display: none;" id="pit_work_dialog">
                    <h1><?=$total_response_recent['subject']?>
                    </h1>
                    <p>An AEP member has sent a message to you <?=$total_response_recent['body']?></p>
                    
                     
                  <a href="#0" class="cd-popup-trigger" id="cd-popup-trigger_first_all_<?php echo $pitch_details['id']?>">Reply</a>
                  <a href="javascript:void(0);" id="cancl_pit_rep_all_<?=$pitch_details['id']?>" class="col3">Cancel</a>
                  
                  </div>
                  
                  
                  
                  
         <script>
         jQuery(document).ready(function($){
	//open popup
	$('#cd-popup-trigger_first_all_'+<?php echo $pitch_details['id']?>).on('click', function(event){
		event.preventDefault();
		$('#cd-popup_first_all_'+<?php echo $pitch_details['id']?>).addClass('is-visible');
	});
	
	//close popup
	$('#cd-popup_first_all_'+<?php echo $pitch_details['id']?>).on('click', function(event){
		if( $(event.target).is('.cd-popup-close') || $(event.target).is('#cd-popup_first_all_'+<?php echo $pitch_details['id']?>) ) {
			event.preventDefault();
			$(this).removeClass('is-visible');
		}
	});
	//close popup when clicking the esc keyboard button
	$(document).keyup(function(event){
    	if(event.which=='27'){
    		$('#cd-popup_first_all_'+<?php echo $pitch_details['id']?>).removeClass('is-visible');
	    }
    });
    
});
         </script>         
                                  
  <div class="cd-popup" role="alert" id="cd-popup_first_all_<?php echo $pitch_details['id']?>">
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
                                        
                                            
                                         <div  class="auto_main" id="parent_email_selected">	
                                            <span id="email_selected">			
		                                    <span id="name<?=$pitchit_view_user['user_id'];?>" class="choosen">
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
		                                    <img onclick="removeEmail(this,'<?=$pitchit_view_user['user_id'];?>')" src="<?=base_url()?>images/close_22.png">
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
                                        <input type="hidden" id="user_email_id" name="user_email_id" value="<?php
                                        
                                        if(!empty($total_response_recent))
                                        {
                                          echo $total_response_recent['from_user_id']; 
                                        }
                                        else
                                        {
                                          echo $pitchit_view_user['user_id'];  
                                        }
                                        
                                         ?>"/>
  					
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
          
             
                  <?php } else {
                    
                  if(strlen($pitch_details['pitchit']) > 30)
                      {
                      echo substr($pitch_details['pitchit'],0,30).'..';
                      }
                   else
                      {
                      echo $pitch_details['pitchit'];  
                      }
          ?>        
             
             <?php 
                 
                    }     
                  ?>
                 
                  </div>
                  </td>
                  <td class="center"><?=$pitchit_view;?></td>
                  <td class="center">
                  <?php 
                   if(!empty($pitchit_view_user['date']))
                    {
                    $date = $pitchit_view_user['date'];
                    $timestamp = strtotime($date);
                    $new_date = date("m/d/y", $timestamp);
                    echo $new_date;
                    }
                    else
                    {
                      echo 'N/A';  
                    }
                  ?></td>
                </tr>
                
               <?php } }  else {?> 
              
               <tr class="hov_col">
                  <td align="center"></td>
                  <td align="center"></td>
                  <td align="center">There are no Pitchits!</td>
                  <td align="center"></td>
                  <td align="center"></td>
                </tr>
                
                <?php } ?>
                
              </tbody>
            </table>
            </div>
            
               <div style="display: none;" id="tab4">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_new">
              <thead>
                <tr>
                  <th width="17%">Pitched Work</th>
                  <th width="15%">Viewed By</th>
                  <th width="35%">PitchIt! Message</th>
                  <th width="18%" class="center">Times Viewed</th>
                  <th width="15%" class="center">Date</th>
                </tr>
              </thead>
              <tbody>
              
                  <?php
                  //echo '<pre/>';print_r($total_view_pitchit);die;
                  if(!empty($total_view_pitchit))
                  {
                    foreach($total_view_pitchit as $total_viw)
                    {
                  ?>
              
                <tr>
                  <td><?=$total_viw['title']?></td>
                  <td><?=$total_viw['name_first'].' '.$total_viw['name_middle'].' '.$total_viw['name_last']?></td>
                  <td> 
                  
                  <span id="pit_work_vw_<?=$total_viw['pitid']?>" style="cursor: pointer;">
                  <?=substr($total_viw['pitchit'],0,25).'..'?>
                  </span>
                  
                  
                  <script type="text/javascript">
                $(document).ready(function () {
                   
                   $('#pit_work_vw_'+<?=$total_viw['pitid']?>).click(function () {
                        
                            $(".pit_work_dialog_vw_"+<?=$total_viw['pitid']?>).dialog({
                                close: function () {
                                    
                                     //$('#pit_work').data('clicked', false);
                                }
                            });
                        
                    });
                    
                    
                     $('#cancl_pit_vw_'+<?=$total_viw['pitid']?>).click(function () {
                       
                            $(".pit_work_dialog_vw_"+<?=$total_viw['pitid']?>).dialog('close');
                            //$('#chkBoxHelp_'+<?=$pitch_details['pit_id']?>).prop('checked', false);
                        
                    }); 
                    
                });
                </script>
                  
                  <div class="pit_work_dialog_vw_<?=$total_viw['pitid']?>" style="display: none;" id="pit_work_dialog">
                  
                  <?php if($total_viw['name_first'] != '' || $total_viw['name_middle'] != '' || $total_viw['name_last'] != '') { ?>
                  
                    <h1><?=$total_viw['title']?> was viewed by 
                    <?php 
                      echo $total_viw['name_first'].' '.$total_viw['name_middle'].' '.$total_viw['name_last'];
                      
                      ?>
                      on 
                      
                      <?php 
                       if(!empty($total_viw['pitdate']))
                        {
                        $date = $total_viw['pitdate'];
                        $timestamp = strtotime($date);
                        $new_date = date("m/d/y", $timestamp);
                        echo $new_date;
                        }
                        else
                        {
                          echo 'N/A';  
                        }
                      ?>
                      viewed <?//=$pitchit_view;?> 1 times
                    </h1>
                    
                    <?php } else {?>
                    
                    <h1><?=$total_viw['title']?> was not viewed by any AEP member yet</h1>
                    
                    <?php } ?>
                    
                    <p>An AEP member will message you directly if he/she is interested in your work</p>
                    <p><strong>Original PitchIt! on 
                    
                     <?php 
                       if(!empty($total_viw['pitdate']))
                        {
                        $date = $total_viw['pitdate'];
                        $timestamp = strtotime($date);
                        $new_date = date("m/d/y", $timestamp);
                        echo $new_date;
                        }
                        else
                        {
                          echo 'No Date';  
                        }
                      ?>
                    
                    </strong></p>
                    <p><?=$total_viw['pitchit'];?></p>
                    <a href="javascript:void(0);" id="cancl_pit_vw_<?=$total_viw['pitid']?>" class="col3">Cancel</a>
                    <!--<a href="###" onclick="click_edit_pit()">Edit</a><a href="#">Save</a><a href="#">Cancel</a><a href="#">PitchIt!</a>-->
                  </div>
                  
                  
                  </td>
                  <td class="center">1</td>
                  <td class="center">
                  
                  <?php 
                       if(!empty($total_viw['pitdate']))
                        {
                        $date = $total_viw['pitdate'];
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
                      <td align="center"></td>
                      <td align="center"></td>
                      <td align="center">There are no Pitchits!</td>
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
                                    
                  <th width="17%">Pitched Work</th>
                  <th width="15%">Viewed By</th>
                  <th width="35%">PitchIt! Message</th>
                  <th width="18%" class="center">Times Viewed</th>
                  <th width="15%" class="center">Date</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Book of Jobe</td>
                  <td>Peter Smith</td>
                  <td>Think you will…</td>
                  <td class="center">5</td>
                  <td class="center">12/16/14</td>
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
                <tr>
                  <td align="center">A Rabbi’s Journey</td>
                  <td align="center">David Fredricks</td>
                  <td align="center">We talked last…</td>
                  <td align="center">5</td>
                  <td align="center">7/06/14</td>
                </tr>
                
              </tbody>
            </table>
            </div>
            <div style="display: none;" id="tab6">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_new">
              <thead>
                <tr>
                  
                  <th width="17%">Pitched Work</th>
                  <th width="15%">Viewed By</th>
                  <th width="35%">PitchIt! Message</th>
                  <th width="18%" class="center">Times Viewed</th>
                  <th width="15%" class="center">Date</th>
                  
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td width="20%" align="center">Book of Jobe</td>
                  <td width="20%" align="center">Peter Smith</td>
                  <td width="25%" align="center"><img src="<?=base_url()?>images/think.png" alt="" /> Think you will…</td>
                  <td width="17%" align="center" class="center">5</td>
                  <td width="18%" align="center" class="center">12/16/14</td>
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
                <tr>
                  <td align="center">A Rabbi’s Journey</td>
                  <td align="center">David Fredricks</td>
                  <td align="center">We talked last…</td>
                  <td align="center">5</td>
                  <td align="center">7/06/14</td>
                </tr>
                
              </tbody>
            </table>
            </div>
            
          </div>
                     
          <div class="clear"></div>
        </div>
        
        <!-----end------------->
        
        
        <!--<div class="pitchits_section">
          <div class="pitchits_section_left change_possition">
           
            <h1>
            <a class="tooltips" href="javascript:void(0)" >
                  <img src="<?=base_url()?>images/icon_p.png" alt=""/>
                  <span>What is Pitchit?<br />It will be filled</span>
                  </a>My Pitchits!</h1><ul class="list">
                <?php 
                $total_pit = $this->memail->get_user_total_pitchit_view();
                $total_savepit = $this->mwork->get_user_save_pitchit_view();
                ?>
              <li class="hov_col"><a href="<?=base_url()?>home/savePitchit"><img src="<?=base_url()?>images/icon04_new.png" alt="" />Total Saved Pitchits!<span><?=$total_savepit?></span></a></li>
              <li class="hov_col"><img src="<?=base_url()?>images/icon01_new.png" alt="" />Total Pitchits! Viewed <span><?=$total_pit?></span></li>
              <li><img src="<?=base_url()?>images/icon02_new.png" alt="" />Total Pitchits! <span><?php echo count($user_pitchit_details);?></span></li>
              <li class="hov_col"><img src="<?=base_url()?>images/icon03_new.png" alt="" />Earned Pitchits! <span>10</span></li>
              <li class="no"><img src="<?=base_url()?>images/icon04_new.png" alt="" />Remaining Pitchits! <span><?php echo $remn = (10 - count($user_pitchit_details)) ?></span></li>
            </ul>
          </div>
          <div class="pitchits_section_right change_possition">
            <h1><a class="tooltips" href="javascript:void(0)" >
                  <img src="<?=base_url()?>images/icon_p.png" alt=""/>
                  <span>What is Pitchit?<br/>It will be filled</span>
                  </a>
            Latest Pitchits! <span><a href="<?=base_url()?>home/view_all_pitchit" class="button_pro">View All</a></span></h1>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_new">
              <thead>
                <tr>
                  <th width="10%" align="center">No.</th>
                  <th width="15%" align="center">Date</th>
                  <th width="20%" align="center">Book</th>
                  <th width="35%" align="center">Pitchit</th>
                  <th width="15%" align="center">Views</th>
                </tr>
              </thead>
              <tbody>
              <?php 
               //echo '<pre/>';print_r($user_pitchit_details);die;
               if(!empty($user_pitchit_details))
                {
                $i =1;    
                 foreach($user_pitchit_details as $pitch_details)
                 {
                    $pitchit_view = $this->memail->get_user_pitchit_view($pitch_details['wid']);
               ?>
                <tr>
                  <td width="10%" align="center"><?=$i?></td>
                  <td width="15%" align="center"><?php echo date('m/d/Y',strtotime($pitch_details['created_date']))?></td>
                  <td width="20%" align="center"><?=$pitch_details['title']?></td>
                  <td width="35%" align="center">
                  <a class="tooltips" href="javascript:void(0)" >
                  <?=substr($pitch_details['pitchit'],0,10).'..'?>
                  <span><?=$pitch_details['pitchit']?></span>
                  </a>
                  </td>
                  <td width="15%" align="center"><?=$pitchit_view;?></td>
                </tr>
               <?php $i++; } } else {?> 
               
                  <td width="10%" align="center"></td>
                  <td width="15%" align="center"></td>
                  <td width="20%" align="center">Sorry! There are no Pitchits.</td>
                  <td width="35%" align="center"></td>
                  <td width="15%" align="center"></td>
               
               <?php } ?>
              </tbody>
            </table>
          </div>
          <div class="clear"></div>
        </div>-->
        
        
        <div class="publishers_section">
          <div class="publishers_section_left">
            <h1><img src="<?=base_url()?>images/click_icon.png" alt="" />My Clicks By Publishers</h1>
            <div class="publishers_section_left_pad">
              <div class="box_section box_section_mar_right30">
                <div class="icon_section"><img src="<?=base_url()?>images/rou_01.png" alt="" /></div>
                
                <a class="tooltips" href="javascript:void(0)" >
                
                <div class="myclick_para"><div class="myclick_span"><?=$user_search_count['count']?></div>
                  Search Returns</div>
                
                  <span class="tp_span">Your work has been searched <?=$user_search_count['count']?> times by various agents, editors and publishers</span>
 <div class="clear"></div>
                </a>
                
              </div>
              <div class="box_section">
                <div class="icon_section"><img src="<?=base_url()?>images/rou_02.png" alt="" /></div>
                <a class="tooltips" href="<?=base_url()?>discovery/view_profile_details" >
                
                <div class="myclick_para" ><div class="myclick_span" ><?=$user_view_count['count']?></div>
                  Profile Views</div>
                
                  <span class="tp_span">Your profile has been looked at <?=$user_view_count['count']?> times by various agents, editors, and publishers.</span>
                  <div class="clear"></div>
                </a>                
                
              </div>
              <div class="clear"></div>
              <div class="box_section box_section_mar_right30">
                <div class="icon_section"><img src="<?=base_url()?>images/rou_03.png" alt="" /></div>
                
                <a class="tooltips" href="<?=base_url()?>discovery/view_download_profile_details" >
                
                <div class="myclick_para" ><div class="myclick_span" ><?=$user_download_count['count']?></div>
                  Downloads</div>
                
                  <span class="tp_span">Your work has been downloaded <?=$user_download_count['count']?> times by various agents, editors and publishers</span>
 <div class="clear"></div>
                </a>
                
              </div>
              <div class="box_section">
                <div class="icon_section"><img src="<?=base_url()?>images/rou_04.png" alt="" /></div>
                
                <a class="tooltips" href="<?=base_url()?>discovery/view_bookshelf_profile_details" >
                
                <div class="myclick_para"><div class="myclick_span" ><?=$user_bookshelf_count['count']?></div>
                  Bookshelf Additions</div>
                
                  <span class="tp_span">Great news! Your <?=$user_bookshelf_count['count']?> works have been placed on a bookshelf by various agents, editors and publishers</span>
 <div class="clear"></div>
                </a>
               
              </div>
              <div class="clear"></div>
            </div>
          </div>
          <div class="publishers_section_right" style="margin-top:0;">
            <h1 class="for_mobile"><img src="<?=base_url()?>images/cercel_icon.png" alt="" />AEPs' Demographics<span><a href="#" class="button_pro">View Detail</a></span></h1>
            <div class="clear"></div>
            <div class="publishers_section_left_pad">
              <ul>
                <li><img src="<?=base_url()?>images/female.png" alt="" /> 69% Female</li>
                <li><img src="<?=base_url()?>images/male.png" alt="" /> 31% Male</li>
                <div class="clear"></div>
              </ul>
              <div class="clear"></div>
              <h3>Most Popular Genera</h3>
              <div align="center">
                <div id="piechart_3d" style="width: 100%; height: auto;"></div>
              </div>
            </div>
          </div>
          <div class="clear"></div>
        </div>
        <div class="pitchits_section_right work_section work_section_mob">
          <h1><img src="<?=base_url()?>images/work_img.png" alt="" />My Work <span><a href="<?=base_url()?>home/addWork" class="button_pro">Add Work <img src="<?=base_url()?>images/plus_icon.png" alt="" /></a> 
          <!--<a href="<?//=base_url()?>home/view_all_work" class="button_pro">View All</a>-->
          </span></h1>
          
          <div class="table_cont_new" id="full_content_div">
          
          	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_new">
            <thead>
              <tr>
                
                <th width="12%" align="center">Book Cover</th>
                <th width="30%" align="center">Title</th>
                <th width="14%" align="center">Tags</th>
                <th width="24%" align="center">Date Added</th>
                <th width="20%" align="center">Pitchited</th>
              </tr>
            </thead>
            <tbody>
              
              
               <?php 
               //echo '<pre/>';print_r($user_work_details);die;
               if(!empty($user_work_details))
                {
                $i =1;    
                 foreach($user_work_details as $details)
                 {
               
                 $user_category_details = $this->memail->get_user_work_categories($details['id']);
               ?>
               <tr class="itemld">
                <td width="12%" align="center" >
                 <?php if($details['cover_image'] != '') { ?>
                 
                 <img src="<?=base_url()?>uploadImage/<?=$usd['id']?>/cover_image/thumbs/<?=$details['cover_image']?>" alt="" />
                
                <?php } else { ?>
                
                <img src="<?=base_url()?>images/img_default_cover_mywork.png" alt=""  />
                
                <?php } ?>
                
                </td>
                <td width="30%" align="center" ><a href="<?=base_url()?>work/editWork/<?=$details['id']?>"><p><strong><?=$details['title']?></strong></p></a>
                    <p><?=$details['work_type_name']?><br />
                    Categories: 
                    <span>
                    <?php if(!empty($user_category_details))
                     {
                     foreach($user_category_details as $categories)
                     {
                        echo $categories['category_name'].', ';
                     } } ?>
                    </span></p></td>
                 
                <td width="14%" align="center" >
                
                <?php 
                 $work_tag_details = $this->mwork->work_tags_details($details['id']);
                 //echo '<pre/>';print_r($work_tag_details);die;
                  if(!empty($work_tag_details))
                   {
                    foreach($work_tag_details as $tagdetails) {
                     echo $tagdetails['tag_name'].', ';
                     
                     } }
                 ?>  
                
                </td>   
                    
                <td width="24%" align="center"><?php echo date('m/d/Y',strtotime($details['create_date']))?></td>
                <!--<td width="24%" align="center"><img src="<?//=base_url()?>images/flag.png" alt="" /></td>-->
                <td width="20%" align="center">
                <!--<a href="#bookshelf_pitchit_<?//=$details['id']?>" rel="facebox" class="button_pro" style="display:none">Pitchit!</a>-->
                
                <?php if($details['is_pitchited'] == '1') {?>
                <span>
                <!--<img src="<?=base_url()?>images/flag.png" alt="" />-->
                YES
                </span>
                <?php } else {?>
                <a href="#openModal_<?=$details['id']?>" class="button_pro" style="display:none">Pitchit!</a>
                <?php } ?> 
 <div id="openModal_<?=$details['id']?>" class="modalDialog">
    <div>	
    <a href="#close" title="Close" class="close">X</a>

        	    <header>
					<h3>Pitchit Content</h3>
				</header>
           <div class="clear"></div>
           
             <?php
               $frmAttrs   = array("id"=>'signupFrm',"class"=>'form-horizontal');
               echo form_open('work/addPitchit', $frmAttrs);
             ?>
           
             <textarea class="txt_pitchit" id="desc" name="desc" onKeyDown="limitText(this.form.desc,this.form.cout,140);" 
onKeyUp="limitText(this.form.desc,this.form.cout,140);"></textarea>

          <p>Characters Remaining: <input  type="text" name="cout" size="3" value="140" readonly="readonly" class="read_only"/> </p>
            
            <?php
            $category_details  = $this->mprofile->total_publisher_details($details['id'],$details['work_type_id'],$details['work_form_id']);
            if(!empty($category_details))
            {
            ?>
            <p style="margin-top: 10px;"> <strong>Choose Publishers</strong> </p>
                   
     <select data-placeholder="Choose a publisher..." class="chosen-select input_box" multiple="multiple" name="cate_gory_hid[]" id="cate_gory_hid" tabindex="4">
            <option value=""></option>
            
            <?php
            //$category_details  = $this->mprofile->total_publisher_details($details['id'],$details['work_type_id'],$details['work_form_id']);
            //echo '<pre/>';print_r($category_details);die;
            if(isset($category_details) && count($category_details) > 0)
            {
                //echo '<pre/>';print_r($category_details);
                //$i=0;
                foreach($category_details as $eachList)
                {
            
            ?> 
            <option value="<?php echo $eachList['id']?>"><?php echo $eachList['name_first'].' '.$eachList['name_middle'].' '.$eachList['name_last']?></option>
            <?php } } ?>
     </select>
       
          <?php } ?>
            
              <div class="clear"></div>
            <input type="hidden" name="wid" id="wid" value="<?=$details['id']?>" />  
            <input name="send" type="submit" value="Send" class="btn_viw1" style="margin-top: 15px;" />
            <input name="save" type="submit" value="Save" class="btn_viw1" style="margin-top: 15px;" />
          </form>            
            
    </div>
</div>  
   
                </td>
                </tr>
           
 
                  
                  
                   
                <?php  $i++; } ?>
               
              <?php $cnt_page = $this->memail->getCountWorks();
              if($cnt_page > 4)
              {
              ?>  
              <tr class="paginate pagination3">
              <td></td>
              <td></td>                            
              <td><?=$this->pagination->create_links()?><?//=$this->ajax_pagination->create_links()?></td>
              <td></td>
              <td></td>                            
              </tr>
              <?php } ?> 
                
                <?php } else { ?>
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
          </div>
        </div>
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
});
</script>
      
<script src="<?=base_url()?>ckeditor/ckeditor.js"></script>      
      
<?=$this->load->view('template/inner_footer_dashboard.php')?>       
