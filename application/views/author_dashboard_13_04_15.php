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


$jsArray_pit = array();
if(!empty($pitchit_details_limit))
{
foreach($pitchit_details_limit as $pit_dtls) {
   $jsArray_pit[] = array($pit_dtls['id']); 
}
$pit= json_encode($jsArray_pit);
}
else
{
 $pit = 0;   
}
//echo json_encode($jsArray);die;
//echo '<pre/>';print_r($user_pitchit_details);die;
?>

<script type="text/javascript" src="<?=base_url()?>js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?= base_url()?>js/owl.carousel.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/ExpandSelect.js"></script>
<link rel="stylesheet" href="<?=base_url()?>style/inner/chosen.css"/>
<script src="<?=base_url()?>js/chosen.jquery.js" type="text/javascript"></script>

<link href="<?= base_url()?>style/inner/owl.carousel.css" rel="stylesheet" />


<script>

function ajaxDiscovery(page)
{
		//$("#content_part").block();
 		//type = "format";
 		//var format_str = arr_format.join(",");
 		
 		$.ajax({
		   url      : '<?=base_url()?>'+'home/ajax_publisher_search',
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
		   url      : '<?=base_url()?>'+'home/ajax_publisher_view_search',
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
		   url      : '<?=base_url()?>'+'home/ajax_publisher_download_search',
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
     
  function ajaxDiscovery4(page)
{
		//$("#content_part").block();
 		//type = "format";
 		//var format_str = arr_format.join(",");
 		
 		$.ajax({
		   url      : '<?=base_url()?>'+'home/ajax_publisher_bookshelved_search',
		   type     : 'POST',
		   data     : { 'page': page},
		   success  : function(resp){
		    //alert(resp);
		        if(resp != '0'){
		            $("#tab_4").html(resp);
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

<script type="text/javascript">
/* $(document).ready(function(){
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
 
});
    }
   }) */
 
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
  /*jQuery.ias({
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
    });*/

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
setTimeout(function() {
   $("#invite_msg_suc").html('');
   $( "#invite_msg_suc" ).removeClass( "invite_msg_success" )
      
}, 5000);
});
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
   
   $('#pitchit').click(function(){
   
        //alert('hi');
         $.ajax({
           url      : '<?=base_url()?>'+'mail/pitch_msgcnt',
           type     : 'POST',
           data     : { 'id': <?=$pit;?> , 'notify': 'notify' },
           success  : function(resp){
            //alert(resp);
                if(resp < '1'){
                    $("#pitcnt").html(resp);
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

<script type="text/javascript">
function getPurchaseDiv(){
	$("#purchase_tbody").hide(  );
	$("#purchase_confirm").show(  );
}

function backToFirst(){
	$("#purchase_tbody").show();
	$("#purchase_confirm").hide();
}
function backToCart(){
	$("#purchase_tbody").show();
	$("#purchase_confirm").hide();
    $('#package_id').css('background-color','#46b8ff');
    $('#package_price').css('background-color','#46b8ff');
    
    document.getElementById('package_id').click();
    
}

$(function(){

    $("#trigger_select").click(function(){
    
    $("#purchase_tbody").show();
	$("#purchase_confirm").hide();
        ExpandSelect('package_id');
   
    });
    
    
});

/*function pit_modal(id)
{
    $('.modalDialog').css('display','block');
    $('#pit_modal_'+id).attr('href','#openModal_'+id);
    $('.chosen-select').chosen();
    
}*/
</script>

<style>

.chosen-container .chosen-drop {
    -moz-border-bottom-colors: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    background: none repeat scroll 0 0 #fff;
    border-color: -moz-use-text-color #aaa #aaa;
    border-image: none;
    border-right: 1px solid #aaa;
    border-style: none solid solid;
    border-width: 0 1px 1px;
    box-shadow: 0 4px 5px rgba(0, 0, 0, 0.15);
    left: -9999px;
    position: absolute;
    top: 100%;
    width: 400px !important;
    z-index: 999999;
}


.chosen-container-multi .chosen-choices {
    background-color: #fff;
    background-image: linear-gradient(#eeeeee 1%, #ffffff 15%);
    border: 1px solid #aaa;
    cursor: text;
    height: auto !important;
    margin: 0;
    overflow: hidden;
    padding: 0 5px;
    position: relative;
    width: 400px !important;
}

.search-choice-close { background: url("../../images/chosen-sprite.png") no-repeat scroll -42px 1px rgba(0, 0, 0, 0) !important;}
.owl-item{ padding:0 !important;}
.pit_work_dialog_pos_mid {bottom: -418px !important; position: absolute !important;}
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
 
 .img_sz_small {
    border-radius: 50%;
    height: 32px;
    width: 32px;
}
.see_box a {color:#000;}
.see_box span { color:#7e7e7e;}
.see_box p { width:85%;}

.bl_p span {top:0;}
.bl_p img {margin:0 5px 0 0;}
.date_sec {float:right; font-size:12px;}

 .pitchits_section_new .pitchits_section_right { width: 734px;}

.pitchits_section_left { width: 230px;}
.invite_msg_success{ padding:10px 13px 0 27px; margin:24px 0 0 0; border-radius:10px; color:#fff; background:url(../images/img_1.png) no-repeat; position: absolute; right:9px; font-size:12px; width:198px; height:48px; z-index:10;}
</style>

<style>
.modalDialog {
    display: none;
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

.dasbord_news_section_left {min-height: 190px;}
.top_welcome_section_right111 {
    float: right;
    padding-right: 11px;
    padding-top: 9px;
}
</style>

<script language="javascript" type="text/javascript">

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

function update_profile()
{
    window.location.href = '<?=base_url()?>profile/editProfile/<?php echo $usd['id'];?>';
    
}
</script>
  

    <div class="content_part">
      <div class="mid_content index_sec mid_content_new">
        <div class="top_welcome_section index_for_mob">
          <div class="top_welcome_section_left">
          <?php 
          $mailinvite = $this->session->userdata('invite_mail');
          if($mailinvite != ""){ ?>
          	<div class="invite_msg_success" id="invite_msg_suc"><?php //echo $this->session->userdata('invite_mail');?>
          	You have successfully invited your friend!
          	</div>
          <?php $this->session->unset_userdata('invite_mail'); } ?>
          <ul>
              <li><a href="javascript:void(0);" class="green_icon hidetext2 tip_trigger" title="Click to Invite Friend">
              	<!-- <span class="tip" id="invite_id">Click to Invite Friend</span> --></a><!--<span class="green">02</span>--></li>
              <li><a href="javascript:void(0);" class="pink_icon hidetext3 tip_trigger1" id="notify" title="Click to show recent messages">
              	<!-- <span class="tip1" id="msg_id">Click to show recent messages</span> --></a><span class="pink" id="cnt"><?php echo count($user_notification_count)?></span></li>
              <li><a href="javascript:void(0);" class="orange_icon hidetext5 tip_trigger2" id="pitchit" title="Click to view PitchIt! messages">
              	<!-- <span class="tip2" id="pub_id">Click to view PitchIt! messages</span> --></a><span class="orange" id="pitcnt"><?php echo $pitchit_count['count'];?></span></li>
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
                  <h5>From: <?php echo $notification['name_first'].' '.$notification['name_middle'].' '.$notification['name_last']?>
                  <span><?php echo date('m/d/Y',strtotime($notification['created']))?></span></h5>
                  <p><a href="<?=base_url()?>mail/details/<?php echo $notification['id']?>"><strong>Message:</strong> <span><?php echo $notification['subject']?></span></a></p>
                  <input type="hidden" name="nt_id" id="nt_id" value="<?php echo $notification['id']?>" />
                </div>
                <div class="clear"></div>
              </div>
              
              <?php } } else {?>
              
              <p style="margin: 6px 0 0 10px;">No new messages</p>
              
              <?php } ?>
              
              <div class="clear"></div>
              <div class="see_all"><a href="<?=base_url()?>home/inbox">See All</a></div>
            </div>
            
            <!------------End Notification------------->
            
          <!------------show publisher Pitchit------------->
            <?php //echo '<pre/>';print_r($user_notification);die;?>
            <div class="bottom_text5" style="display:none;">
              <div class="arror_top"><img src="<?=base_url()?>images/arror_top.png" alt="" /></div>
              
              <!--<p class="heading">Pitchit Viewed (<?php //echo count($publisher_pitchit)?>)</p>-->
              <p class="heading">New (<?php echo count($pitchit_details_limit)?>)</p>
              
              <span style="float: right; margin-top: -31px; margin-right: 7px; cursor: pointer;" id="cross3"><img src="<?=base_url()?>images/close_22.png" alt="" /></span>
              
               <?php /*if(!empty($publisher_pitchit)) {
                
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
              
              <?php } } */?>
              
              <?php 
               
               //echo '<pre/>';print_r($pitchit_details);die;
              /* if(!empty($pitchit_details)) {
                
                foreach ($pitchit_details as $pit_details) {*/
                
            if(!empty($pitchit_details_limit))
        {
               /*$res = array();
               foreach($pitchit_details_limit as $keys=>$pit) 
               {
                $res[$pit["id"]] = $pit;
               }
           //echo '<pre/>';print_r($res);die; 
            foreach($res as $k => $pit_details)
            { */
              
              foreach($pitchit_details_limit as $k => $pit_details)
            {  
                ?>
              
              <div class="see_box"> 
              <span class="date_sec">
              <?php 
              
               if(!empty($pit_details['created']))
                    {
                    $date = $pit_details['created'];
                    $timestamp = strtotime($date);
                    $new_date = date("m/d/y", $timestamp);
                    echo $new_date;
                   
                    }
                    else
                    {
                      echo 'N/A';  
                    }
              
              ?>
              </span>
              <p class="bl_p">
        	                 
               <?php if(!empty($pit_details['cover_image'])) { ?>
              <img src="<?=base_url()?>uploadImage/<?=$pit_details['from_user_id']?>/cover_image/<?=$pit_details['cover_image']?>" alt="" class="img_sz_small" />
              <?php } else { ?>
              <img src="<?=base_url()?>images/img_default_cover.png" alt="" class="img_sz_small" />
              
              <?php } ?>
               
               <input type="hidden" id="pit_wid" name="pit_wid" value="<?//=$pit_details['wid']?>" />
               
               <a href="<?=base_url()?>mail/details/<?=$pit_details['id']?>" class="noty_txt"><strong>Message:</strong> <span><?=$pit_details['subject']?></span></a>
               
               <br />
               <span style="margin-bottom:10px;">
               From :<b> <?php echo $pit_details['first'].' '.$pit_details['middle'].' '.$pit_details['last']?></b></span>
               <?php /* if(!empty($pit_details['profile'])) { ?>
              <img src="<?=base_url()?>uploadImage/<?=$pit_details['user_id']?>/profile/<?=$pit_details['profile']?>" alt="" class="img_sz_small" style="width:25px; height:25px; padding:0; margin-top:15px;" />
              <?php } else { ?>
              <img src="<?=base_url()?>images/img_default_headshot.png" alt="" class="img_sz_small" style="width:25px; height:25px; padding:0; margin-top:15px;" />
              <?php } */?>
               
               </p>
               
                <div class="clear"></div>
              </div>
              
              <?php } } else {?>
              
              <p class="heading">There are no Pitchit! Message.</p>
              
              <?php } ?>
              
              
              <div class="clear"></div>
              <!--<div class="see_all"><a href="<?//=base_url()?>home/inbox">See All</a></div>-->
            </div>
            
            <!------------End Pitchit------------->  
            
          </div>
          <?php $usd = $this->session->userdata('logged_user');?>
          <div class="top_welcome_section_right111">
          
          <span style="float:left; margin-right:7px;">
          <?php if(!empty($user_photo['filename']) && file_exists("uploadImage/".$usd['id']."/profile/".$user_photo['filename'])) {?>
                <img src="<?=base_url()?>uploadImage/<?=$usd['id']?>/profile/<?=$user_photo['filename']?>" class="img_sz"/>
          <?php //}else if(!empty($user_photo['filename']) && file_exists("_assets/".."/".)){?>
            
          
          <?php } else {?>
                <img src="<?=base_url()?>images/img_default_headshot.png" class="img_sz"/>
          <?php } ?>   
          </span>       
                              
            <p style="font-size:12px; float:left;">Welcome<span class="prsn_con" style="padding-left:0px;">
            <?php if(!empty($user_contact['name_first'])) { $firstname = $user_contact['name_first']; } else { $firstname = '';} ?>
            <?php if(!empty($user_contact['name_middle'])) { $middlename = $user_contact['name_middle']; } else { $middlename = '';}?>
            <?php if(!empty($user_contact['name_last'])) { $lastname = $user_contact['name_last']; } else { $lastname = '';}?>
            
            <a class="tooltips" href="javascript:void(0)" >
            <?php $fullname = $firstname.' '.$middlename.' '.$lastname;
                 if(strlen(trim($fullname)) > 25)
                 {?>
                 <label style="cursor:pointer" title="<?php echo trim($fullname);?>"><?php echo substr(trim(ucwords($fullname)),0,25).'..'; ?></label>
                   
                 <?php }
                 else
                 {
                   echo trim($fullname); 
                 }
            ?>
            
            <!-- <span class="tp_span9"><?php echo trim($fullname);?></span> -->
            
            </a>
            </span><br />
              <span class="prsn_con" style="padding-left:0 !important;">Member since 
              
              <?php $date_crd = $usd['created'];
                        $timestamp_crd = strtotime($date_crd);
                        $new_date_crd = date("m/d/y", $timestamp_crd);
                        echo $new_date_crd;
                        ?>
              
              </span><br />
              <span class="prsn_con" style="padding-left:0;}">Profile is <?php echo $val*5;?>% complete</span>
				<br />
               <button class="upld_butt3" style="background-color:#2e75b6; margin-top:0px;" onclick="update_profile()">Update Profile</button>
              <div class="clear"></div>
              
                 </p>
              <div class="clear"></div>          
              
              <?php /*?><a href="<?=base_url()?>profile/editProfile/<?php echo $usd['id'];?>" class="button_pro">Update Profile<img src="<?=base_url()?>images/arrow.png" alt="" /></a><?php */?>
             
          </div>
        </div>
        <div class="dasbord_news_section">
          <div class="dasbord_news_section_left">
            <h1><img src="<?=base_url()?>images/heading_icon.png" alt="" />Dashboard News</h1>
            <div class="blue_back_new2"><!--<img src="<?//=base_url()?>images/cup_icon.jpg" alt="" />-->
            
           <?php /*Welcome <?=$usd['name_first']?> : This area of Inkubate is where you can upload, categorize, edit and store your manuscripts. Please make sure to fill in as much detail as possible about your titles, so that your works and associated metadata are easily discoverable by agents, editors and publishers.  Also, be sure to complete your bio and upload your photo. Your work is protected within Inkubate's secure platform! We're glad that you're here! */?>
           
           Welcome <?=$usd['name_first']?> : <?php if(!empty($news['content'])) { echo strip_tags($news['content']); } else { echo 'No data available';}?>
            
            </div>
          </div>
          <?php /*?><div class="dasbord_news_section_right no_display">
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
          
            <h2>Your Profile is <?php echo $total_percent;?> % complete !</h2>
            
            
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
             </div><?php */?>
          <div class="clear"></div>
        </div>
        
        
        <!---pitchit----------->
        
        <div class="pitchits_section pitchits_section_new">
          <div class="pitchits_section_left">
            <h1><img src="<?=base_url()?>images/icon_p.png" alt="" />My Pitchits!</h1>
            <ul class="list" id="tabs">
              <li id="current" class="hov_col"><a href="javascript:void(0)" name="tab1">Latest PitchIts!</a></li>
              <li class="hov_col"><a href="javascript:void(0)" name="tab2">Saved PitchIts!  <span id="pit_saved"><?=$user_pitchit_saved_details_cnt['count']?></span></a></li>
              <li class="hov_col"><a href="javascript:void(0)" name="tab3">View All PitchIts! <span><?=count($AuthorLatestPitchitCount)?></span></a></li>
              <li class="hov_col"><a href="javascript:void(0)" name="tab4">Total Viewed PitchIts! <span><?=$total_view_pitchit_cnt?></span></a></li>
              <li class="hov_col"><a href="javascript:void(0)" name="tab5">Available PitchIts! <span>
              <?php if($purchase_pitchit['sum_total'] > 0)
              { 
                echo ($purchase_pitchit['sum_total']-$pitchit_use_count['count']);
               } 
              else 
              { 
                echo '0'; 
              }
              ?></span></a></li>
              <li class="hov_col"><a href="javascript:void(0)" name="tab6">Purchase PitchIts! <span class="pad_no"><img style="margin:0px !important" src="<?=base_url()?>images/cart.png" alt="" /></span></a></li>
            </ul>
          </div>
          <div class="pitchits_section_right" id="content">
          <div class="loader_file"></div>
          	<div style="display: block;" id="tab1">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_new">
              <thead>
                <tr>
                  <th width="22%" >Pitched Work</th>
                  <th width="22%" >Viewed By</th>
                  <th width="28%" >PitchIt! Message</th>
                  <th width="15%" class="center">Times Viewed</th>
                  <th width="13%" class="center">Date</th>
                </tr>
              </thead>
              <tbody>
                
                <?php 
                   //echo '<pre/>';print_r($user_pitchit_details);die;
                   if(!empty($user_pitchit_details))
                    {
                    $i =1;   
                    $lp = 1; 
                     foreach($user_pitchit_details as $pitch_details)
                     {
                        $pitchit_view = $this->memail->get_user_pitchit_view_author($pitch_details['pvuid'],$pitch_details['pvpitid']);
                        //echo $this->db->last_query();
                        $pitchit_view_user = $this->memail->get_user_pitchit_view_user($pitch_details['pit_id']);
                        
                        $pitchit_msg = $this->memail->get_user_pitchit_msg_auth($pitch_details['pit_id'],$pitch_details['pvuid']);
                        $total_response_recent  = $this->memail->get_user_pitchit_msg_recent_auth($pitch_details['pit_id'],$pitch_details['pvuid']);
                        //echo '<pre/>';print_r($pitchit_view_user);die;
                        if(!empty($total_response_recent))
                        {
                        $single_user = $this->mwork->single_user($total_response_recent['from_user_id']);
                        if(isset($single_user['id']) && $single_user['id'] !="")
                        	$user_id =  $single_user['id'];
                        }
                        else
                        {
                         $single_user = $this->memail->get_user_pitchit_view_user($pitch_details['pit_id']); 
                         if(isset($single_user['user_id']) && $single_user['user_id'] !="")
                         	$user_id =  $single_user['user_id'];
                        }
                                          
                        /*$single_user = $this->mwork->single_user($pitch_details['puid']);
                        if(isset($single_user['id']) && $single_user['id'] !="")
                        
                        	$user_id =  $single_user['id'];
                        }  */                
                     ?>
                     
              <!--<tr style="cursor: pointer;" id="pit_work_lat_first_<?//=$pitch_details['id']?>">-->
              <tr>
              
                  <td align="center">
                  
                  <a class="tooltips" href="javascript:void(0)" >
                  <?php 
                  if(strlen($pitch_details['title']) > 20)
                  {?>
              		<div title="<?php echo $pitch_details['title'];?>"><?php echo substr($pitch_details['title'],0,18).'...';?></div>
                    
                  <?php }
                  else
                  {
                    echo $pitch_details['title'];
                  }
                  ?>
                  
                  <!-- <span class="tp_span2"><?php echo $pitch_details['title'];?></span>
 					<div class="clear"></div> -->
                  </a>
                  </td>
                  <td align="center">
                   <?php 
                  if(!empty($pitch_details['pvuid']))
                  {
                    ?>
                    <?php if(!empty($user_id)){?>
                   		<a class="tooltips" href="<?php echo base_url();?>discovery/user_details/<?php echo $pitch_details['pvuid'];?>" > 
                   	<?php }else{?>
                   		<a class="tooltips" href="javascript:void(0)" > 
                   	<?php }?>
                    <?php $full_name5 = $pitch_details['name_first'].' '.$pitch_details['name_middle'].' '.$pitch_details['name_last'];
                    
                       if(strlen($full_name5) > 20)
                        {?>
                    	<div title="<?php echo $full_name5;?>"><?php echo substr($full_name5,0,18).'..';?></div>
                           
                        <?php }
                        else
                        {
                            echo $full_name5;
                        }
                  ?>
                  <!-- <span class="tp_span2"><?php echo $full_name5;?></span> -->
                  </a>
                  <?php      
                  }
                  else
                  {
                    echo 'N/A';
                  }
                  ?>
                  </td>
                  <td align="center" style="cursor: pointer;" id="pit_work_lat_first_<?=$lp;?>" >
                  
                 <div class="think_img">
                  <?php if($pitchit_msg['count'] > 0) { ?>
                  
                  <a class="tooltips" href="javascript:void(0)" title="An AEP has respond to your pitch, click here to see the conversation">
                  
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
                  <!-- <span class="tp_span2">An AEP has respond to your pitch, click here to see the conversation</span>
                <div class="clear"></div> -->
                  
                  </a>
                  
                  <script type="text/javascript">
                $(document).ready(function () {
                   
                   
                   
                   $('#pit_work_lat_first_'+<?=$lp;?>).click(function () {
                        
                        $(".pit_work_dialog").hide();
                       //$("#pit_work_dialog_lat_first_"+<?//=$pitch_details['pit_id']?>).css('display','none');
                     
                        
                            $("#pit_work_dialog_lat_first_"+<?=$lp;?>).dialog({
                                
                                 position:  {
                                            my: "left",
                                            at: "left",
                                            of: $('#tab1')
                                        }
                                
                            });
                            $("#pit_work_dialog_lat_first_"+<?=$lp;?>).show();
                            //$(".pit_work_dialog").addClass('pit_work_dialog_pos_mid');
                          
                        
                    }); 
                    $('#cancl_pit_rep_'+<?=$lp;?>).click(function () {
                       
                            //$("#pit_work_dialog_lat_first_"+<?=$lp;?>).dialog('close');
                            //$('#chkBoxHelp_'+<?=$lp;?>).prop('checked', false);
                            $("#pit_work_dialog_lat_first_"+<?=$lp;?>).hide();
                        
                       });   
                });
                </script>
                  
                  <div id="pit_work_dialog_lat_first_<?=$lp;?>" style="display: none;" class="pit_work_dialog">
                    <h1><?=$total_response_recent['subject']?>
                    </h1>
                   <?php /* <p>An AEP member has sent a message to you <?=$total_response_recent['body']?></p> */ ?>
                    <p><?=$full_name5?> has sent a message to you</p>
                    <p>Message : <?=$total_response_recent['body']?></p>
                    
                  <a href="javascript:void(0);" id="cancl_pit_rep_<?=$lp;?>" class="green_but">Close</a>
                  <a href="#0" class="cd-popup-trigger" id="cd-popup-trigger_first_<?php echo $lp;?>" style="background: none !important;">
                  <img src="<?=base_url()?>images/think.png" alt="" /></a>
                  
                  </div>
                  
                  
                  
                  
         <script>
         jQuery(document).ready(function($){
	//open popup
	$('#cd-popup-trigger_first_'+<?php echo $lp;?>).on('click', function(event){
		event.preventDefault();
		$('#cd-popup_first_'+<?php echo $lp;?>).addClass('is-visible');
	});
	
	//close popup
	$('#cd-popup_first_'+<?php echo $lp;?>).on('click', function(event){
		if( $(event.target).is('.cd-popup-close') || $(event.target).is('#cd-popup_first_'+<?php echo $lp;?>) ) {
			event.preventDefault();
			$(this).removeClass('is-visible');
		}
	});
	//close popup when clicking the esc keyboard button
	$(document).keyup(function(event){
    	if(event.which=='27'){
    		$('#cd-popup_first_'+<?php echo $lp;?>).removeClass('is-visible');
	    }
    });
    
    
     CKEDITOR.replace( 'editor2_<?php echo $lp;?>', {
            removeButtons: 'Source',
            // The rest of options...
        }); 
    
});

function SubmitForm1(type)
{
    //alert('fg');
   

     document.getElementById('composeFrm').action='<?=base_url()?>mail/compose/'+type;
     document.getElementById('composeFrm').submit();
     //window.location.reload();
     
     return true;
}
         </script>         
                                  
  <div class="cd-popup" role="alert" id="cd-popup_first_<?php echo $lp;?>">
	<div class="cd-popup-container_reply">
    <div style=" width:100%; background:#000; padding:20px 0;">
    </div>
		   <div class="top_compose">
                                
               <?php
               $usd = $this->session->userdata('logged_user');
               $frmAttrs   = array("id"=>'composeFrm',"class"=>'form-horizontal',"name"=>'myForm');
               echo form_open_multipart('mail/compose_pit_msg', $frmAttrs);
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
<?php 
                $full_name = "";
                  if(!empty($single_user['name_first']))
                  {
                   $full_name.=$single_user['name_first'].' ';
                  }
                  if(!empty($single_user['name_midle']))
                  {
                   $full_name.=$single_user['name_midle'].' ';
                  }
                  if(!empty($single_user['name_last']))
                  {
                   $full_name.=$single_user['name_last'];
                  }
                  ?>
                <input type="hidden" id="user_mail" name="user_mail" readonly="readonly" value="<?php echo $full_name;?>"/>
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
                
                <input type="text" id="sub" name="sub"  class="sub_mail_content" value="<?php echo ucwords($full_name);?> has pitched the title <?=$pitch_details['title']?> to you"/>
                <div class="clear"></div>
                
                </div>
                <div class="comm_tarea">
                    <textarea class="ckeditor" cols="80" name="desc"  id="editor2_<?php echo $lp;?>" > </textarea>
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
                    <input type="hidden" name="send_type" id="send_type" value="send" />
                    
                    <!--<input name="send" type="button" value="Send" class="button" onclick="SubmitForm1('send')"/>-->
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
                      ?>  
                  <span id="pit_work_vw22_<?=$lp;?>" style="cursor: pointer;" title="<?=$pitch_details['pitchit'];?>">
                  <?=substr($pitch_details['pitchit'],0,30).'..'?>
                  </span>
                  
                     <?php  
                      }
                   else
                      {
                      ?>  
                      
                   <span id="pit_work_vw22_<?=$lp;?>" style="cursor: pointer;">
                  <?=$pitch_details['pitchit']?>
                  </span> 
                   <?php    
                      }
          ?>        
             
                  
                  <script type="text/javascript">
                $(document).ready(function () {
                   
                   $('#pit_work_vw22_'+<?=$lp;?>).click(function () {
                        
                            $('.pit_work_dialog').hide();
                            
                            $("#pit_work_dialog_vw22_"+<?=$lp;?>).dialog({
                                
                                
                                position:  {
                                            my: "left",
                                            at: "left",
                                            of: $('#tab1')
                                        },
                                
                                close: function () {
                                    
                                     //$('#pit_work').data('clicked', false);
                                }
                            });
                            $("#pit_work_dialog_vw22_"+<?=$lp;?>).show();
                            //$('.pit_work_dialog').addClass('pit_work_dialog_pos_mid');
                        
                    });
                    
                    
                     $('#cancl_pit_vw_'+<?=$lp;?>).click(function () {
                       
                            //$(".pit_work_dialog_vw22_"+<?=$lp;?>).dialog('close');
                            $("#pit_work_dialog_vw22_"+<?=$lp;?>).hide();
                            
                        
                    }); 
                    
                });
                </script>
                  
                  <div id="pit_work_dialog_vw22_<?=$lp;?>" style="display: none;" class="pit_work_dialog">
                  
                  
                  <h1><?=$pitch_details['title']?> was viewed by 
                    <?php 
                      if(!empty($full_name5))
                      {
                        echo $full_name5;
                      }
                      else
                      {
                        echo 'N/A';
                      }
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
                     viewed <?=$pitchit_view;?> times.
                    </h1>
                  <p>This person will message you directly if they are interested in your work.</p>
                    <p><strong> Original PitchIt! Message on 
                    
                    <?php 
                       if(!empty($pitch_details['created_date']))
                        {
                        $date_srt = $pitch_details['created_date'];
                        $timestamp_2 = strtotime($date_srt);
                        $new_date_crt = date("m/d/y", $timestamp_2);
                        echo $new_date_crt;
                       
                        }
                        else
                        {
                          echo 'N/A';  
                        }
                      ?>
                    
                    </strong></p>
                    <p><?=$pitch_details['pitchit'];?></p>
                    <a href="javascript:void(0);" id="cancl_pit_vw_<?=$lp;?>" class="green_but">Close</a>
                    <!--<a href="###" onclick="click_edit_pit()">Edit</a><a href="#">Save</a><a href="#">Cancel</a><a href="#">PitchIt!</a>-->
                  </div>
             
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
                
               <?php $lp++;} }  else {?> 
              
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

            <?php if(count($AuthorLatestPitchitCount) > 5) {?>
            <div class="paginate_div">
            <?php if(count($AuthorLatestPitchitCount) > $offset_latest){ ?><a href="javascript:;" onclick="ajaxLatestPitchit(<?php echo $page_latest+1;?>)" class="blue_but floright_martop">VIEW MORE</a><?php }else{?> <a href="javascript:;" class="blue_but floright_martop">VIEW OLDER</a> <?php } ?>

            <?php if($offset_latest == "0"){?>&nbsp;<?php }else{ ?> <a href="javascript:;" class="green_but floright_martop" onclick="ajaxLatestPitchit(<?php echo $page_latest-1;?>)">PREVIOUS</a> <?php } ?> 
             </div>
            <?php } ?> 

            </div>
            <div style="display: none;" id="tab2">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_new">
              <thead>
                <tr>
                              
                  <th width="21%">Pitched Work</th>
                  <th width="21%">Viewed By</th>
                  <th width="24%">PitchIt! Message</th>
                  <th width="6%" class="center">Edit</th>
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
                  <td width="20%" align="center">
                  	<?php
                  	if(strlen($pitch_details['title']) > 20)
                    {?>
                <div title="<?php echo $pitch_details['title']; ?>"><?php echo substr($pitch_details['title'],0,18).'..';?></div>
                    
                   <?php }
                    else
                    {
                     echo $pitch_details['title'];   
                    }
                   ?>
                  	

                  </td>
                  <td width="20%" align="center">
                  	<?php 
                      if(!empty($pitchit_view_user))
                      {
                    ?>    
                   <a href="<?=base_url()?>discovery/user_details/<?=$pitchit_view_user['user_id']?>" class="tooltips">
                   <?php 
                   $fullname = $pitchit_view_user['name_first'].' '.$pitchit_view_user['name_middle'].' '.$pitchit_view_user['name_last'];
                   if(strlen($fullname) > 20)
                    {?>
                <div title="<?php echo $fullname; ?>"><?php echo substr($fullname,0,18).'..';?></div>
                    
                   <?php }
                    else
                    {
                     echo $fullname;   
                    }
                   ?>
                   
                   	<!-- <span class="tp_span55"> <?php echo $fullname; ?></span>
 					<div class="clear"></div> -->
                   
                   </a>
                   <?php   
                      }
                      else
                      {
                        echo 'No Viewer';
                      }
                      ?>
					</td>
                  <td width="25%" align="center">
                  <?php 
                  if(strlen($pitch_details['pitchit']) > 28)
                  {
                    ?>
                    
                    <span id="pit_work_vw88_<?=$pitch_details['pit_id']?>" style="cursor: pointer;" title="<?=$pitch_details['pitchit'];?>">
                    <?=substr($pitch_details['pitchit'],0,25).'..'?>
                  
                  </span>
                  
                    <?php
                  }
                  else
                  {
                    ?>
                    <span id="pit_work_vw88_<?=$pitch_details['pit_id']?>" style="cursor: pointer;">
                  <?=$pitch_details['pitchit']?>
                  </span>
                  <?php  
                  }
                  
                  ?>
                  
                  <script type="text/javascript">
                $(document).ready(function () {
                   
                   $('#pit_work_vw88_'+<?=$pitch_details['pit_id']?>).click(function () {
                        
                            $('.pit_work_dialog').hide();
                            $(".pit_work_dialog_vw88_"+<?=$pitch_details['pit_id']?>).dialog({
                               
                               position:  {
                                            my: "left",
                                            at: "left",
                                            of: $('#tab2')
                                        }
                               
                            });
                             $(".pit_work_dialog_vw88_"+<?=$pitch_details['pit_id']?>).show();
                        
                    });
                    
                    
                     $('#cancl_pit_vw88_'+<?=$pitch_details['pit_id']?>).click(function () {
                       
                            //$(".pit_work_dialog_vw88_"+<?=$pitch_details['pit_id']?>).dialog('close');
                            $(".pit_work_dialog_vw88_"+<?=$pitch_details['pit_id']?>).hide();
                        
                    }); 
                    
                });
                </script>
                  
                  <div id="pit_work_dialog_vw88_<?=$pitch_details['pit_id']?>" style="display: none;" class="pit_work_dialog">
                  
                  
                    <p><strong> PitchIt!</strong></p>
                    <p><?=$pitch_details['pitchit'];?></p>
                    <a href="javascript:void(0);" id="cancl_pit_vw88_<?=$pitch_details['pit_id']?>" class="green_but">Close</a>
                    <!--<a href="###" onclick="click_edit_pit()">Edit</a><a href="#">Save</a><a href="#">Cancel</a><a href="#">PitchIt!</a>-->
                  </div>
             
                  
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
                    <!-- <span id="success_pit" style="color: green;"></span> -->
                    <h1>Saved <?=$pitch_details['title']?> Pitchit! <span id="success_pit_<?=$pitch_details['pit_id']?>" style="color: green; float:right; font-size:15px"></span></h1>
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
    var pit = $('#edittext-001_'+id).val();
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
                    //console.log(ps);
                    //console.log(data);
                    //alert(data.status);
                    //var count = parseInt(data['count']);
                    if(data.status == "true")
                    {
                        //window.location.reload();
                    	
                        for (var i = 0, p; p = ps[i++];) 
                        {
                            //alert(p.pitchit);
                            //html += '<textarea id="edittext-001_'+id+'" name="edit_pit" cols="" rows="">';
                            //html += p.pitchit;
                            //html += '</textarea>';
                        $("#pit_work_vw88_"+id).html(p.pitchit);
                        $("#edittext-001_"+id).val(p.pitchit);
                         $("#success_pit_"+id).html('Succesfully Edited');
                                            
                        }
                        
                       
                   } 
           },
           error    : function(resp){
                $.prompt("Sorry, something isn't working right.", {title:'Error'});
           }
          }); 
       }
       
     function do_pit(id,wid)
   {
    
    var pit = $('.edittext-001_'+id).val();
    //alert(pit);
    //alert(id);
    //alert(wid);
    //alert(pit);
    
    if(confirm("Congratulations! You are about to send this Pitchit! This cannot be undone. Are you sure you are ready to do this…did you check your spelling")){
         $.ajax({
           url      : '<?=base_url()?>'+'home/doPitchit',
           type     : 'POST',
           data     : { 'id':id ,'pit':pit,'wid':wid },
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
                            html += '<textarea class="edittext-001_'+id+'" name="edit_pit" cols="" rows="">';
                            html += p.pitchit;
                            html += '</textarea>';
                                            
                        }
                        $("#edit_pit_save").html(html);
                        $("#pit_save_img_"+id).attr('src','<?=base_url()?>images/icon033.png');
                        $("#success_pit_"+id).html('Succesfully Pitchited!');
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
                        $("#success_pit_"+id).html('Succesfully Pitchited!');
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
                        $("#success_pit_"+id).html('Succesfully Pitchited!');
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
                    <textarea id="edittext-001_<?=$pitch_details['pit_id']?>" class="edittext-001_<?=$pitch_details['pit_id']?>" name="edit_pit" cols="" rows="" disabled="disabled"><?=$pitch_details['pitchit']?></textarea>
                    </span>
                    <a href="javascript:document.getElementById('edittext-001_<?=$pitch_details['pit_id']?>').removeAttribute('disabled').focus();" class="col1">Edit</a>
                    <a href="javascript:void(0);" onclick="save_pit(<?=$pitch_details['pit_id']?>)">Save</a>
                    <a href="javascript:void(0);" id="cancl_pit_<?=$pitch_details['pit_id']?>" class="green_but">Close</a>
                    <a href="javascript:void(0);" onclick="do_pit(<?=$pitch_details['pit_id']?>,<?=$pitch_details['wid']?>)" class="pitchit_pop_icon">
                    <img src="<?php echo base_url();?>images/icon_p.png" id="pit_save_img_<?=$pitch_details['pit_id']?>">
                    </a>
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
            <div class="paginate_div">
            <?php if(count($AuthorLatestPitchitCount) > $offset_saved){ ?><a href="javascript:;" onclick="ajaxSavedPitchit(<?php echo $page_saved+1;?>)" class="blue_but floright_martop">VIEW MORE</a><?php }else{?> <a href="javascript:;" class="blue_but floright_martop">VIEW OLDER</a> <?php } ?>

            <?php if($offset_saved == "0"){?>&nbsp;<?php }else{ ?> <a href="javascript:;" class="green_but floright_martop" onclick="ajaxViewallPitchit(<?php echo $page_saved-1;?>)">PREVIOUS</a> <?php } ?> 
             </div>
            <?php } ?> 
            
            <!-- <a href="#" class="button_pro">View More</a> -->
            
            
            </div>
            <div style="display: none;" id="tab3">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_new">
              <thead>
                <tr>
                  <th width="22%">Pitched Work</th>
                  <th width="22%">Viewed By</th>
                  <th width="30%">PitchIt! Message</th>
                  <th width="15%" class="center">Times Viewed</th>
                  <th width="11%" class="center">Date</th>
                </tr>
              </thead>
              <tbody>
                
                
                 <?php 
                   //echo '<pre/>';print_r($user_pitchit_details);die;
                   if(!empty($user_pitchit_details))
                    {
                    $i =1; 
                    $vp = 1;   
                     foreach($user_pitchit_details as $pitch_details)
                     {
                        //$pitchit_view = $this->memail->get_user_pitchit_view($pitch_details['wid']);
                        $pitchit_view = $this->memail->get_user_pitchit_view_author($pitch_details['pvuid'],$pitch_details['pvpitid']);
                        $pitchit_view_user = $this->memail->get_user_pitchit_view_user($pitch_details['pit_id']);
                        
                        $pitchit_msg = $this->memail->get_user_pitchit_msg_auth($pitch_details['pit_id'],$pitch_details['pvuid']);
                        
                        $total_response_recent  = $this->memail->get_user_pitchit_msg_recent_auth($pitch_details['pit_id'],$pitch_details['pvuid']);
                        //echo '<pre/>';print_r($pitchit_view_user);die;
                        //$single_user = $this->mwork->single_user($total_response_recent['from_user_id']);
                        if(!empty($total_response_recent))
                        {
	                        $single_user = $this->mwork->single_user($total_response_recent['from_user_id']);
	                        if(isset($single_user['id']) && $single_user['id'] !=""){
	                        	$user_id =  $single_user['id'];
	                        }
                        }
                        else
                        {
                         	$single_user = $this->memail->get_user_pitchit_view_user($pitch_details['pit_id']); 
                         	if(isset($single_user['user_id']) && $single_user['user_id'] !=""){
                        		$user_id =  $single_user['user_id'];
                        	}  
                        }
                        
                     ?>
                     
              <!--<tr style="cursor: pointer;" id="pit_work_lat_first_all_<?//=$pitch_details['id']?>">-->
              <tr>
              
                  <td align="center">
                  
                  <a class="tooltips" href="javascript:void(0)" >
                  <?//=$pitch_details['title']?>
                  <?php 
                  if(strlen($pitch_details['title']) > 12)
                  {?>
              	<div title="<?php echo $pitch_details['title'];?>"><?php echo substr($pitch_details['title'],0,12).'...';?></div>
                    
                  <?php }
                  else
                  {
                    echo $pitch_details['title'];
                  }
                  ?>
                  
                  <!-- <span class="tp_span2"><?php echo $pitch_details['title'];?></span>
 					<div class="clear"></div> -->
                  </a>
                  
                  <!--<span id="pit_work_<?//=$pitch_details['id']?>" style="cursor: pointer;">
                  </span>-->
                  
                  
                  <script type="text/javascript">
                $(document).ready(function () {
                   
                   $('#pit_work_'+<?=$vp?>).click(function () {
                        
                          $('.pit_work_dialog').hide();
                          
                            $("#pit_work_dialog_"+<?=$vp?>).dialog({
                                 position:  {
                                            my: "left",
                                            at: "left",
                                            of: $('#tab3')
                                        }
                            });
                            $("#pit_work_dialog_"+<?=$vp?>).show();
                        
                    });
                    
                    
                     $('#cancl_pit_'+<?=$vp?>).click(function () {
                       
                            //$(".pit_work_dialog_"+<?=$vp;?>).dialog('close');
                            $("#pit_work_dialog_"+<?=$vp;?>).hide();
                        
                    }); 
                    
                });
                </script>
                  
                  <div id="pit_work_dialog_<?=$vp;?>" style="display: none;" class="pit_work_dialog">
                  
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
                    <a href="javascript:void(0);" id="cancl_pit_<?=$vp;?>" class="green_but">Close</a>
                    <!--<a href="###" onclick="click_edit_pit()">Edit</a><a href="#">Save</a><a href="#">Cancel</a><a href="#">PitchIt!</a>-->
                  </div>
                  
                  </td>
                  <td align="center">
                 
                  <?php 
                  if(!empty($pitch_details['pvuid']))
                  {
                    ?>
                    <?php if(!empty($user_id)){?>
                   		<a class="tooltips" href="<?php echo base_url();?>discovery/user_details/<?php echo $pitch_details['pvuid'];?>" > 
                   	<?php }else{?>
                   		<a class="tooltips" href="javascript:void(0)" > 
                   	<?php }?>
                    <?php $full_name5 = $pitch_details['name_first'].' '.$pitch_details['name_middle'].' '.$pitch_details['name_last'];
                    
                       if(strlen($full_name5) > 20)
                        {?>
                    	<div title="<?php echo $full_name5;?>"><?php echo substr($full_name5,0,18).'..';?></div>
                           
                        <?php }
                        else
                        {
                            echo $full_name5;
                        }
                  ?>
                  <!-- <span class="tp_span2"><?php echo $full_name5;?></span> -->
                  </a>
                  <?php      
                  }
                  else
                  {
                    echo 'N/A';
                  }
                  ?>
                 
                  </td>
                  <td align="center" style="cursor: pointer;" id="pit_work_lat_first_all_<?=$vp;?>" >
                  
                 <div class="think_img">
                  <?php if($pitchit_msg['count'] > 0) { ?>
                  
                  
                  <a class="tooltips" href="javascript:void(0)">
                  
                  <img src="<?=base_url()?>images/think.png" alt="" />
                                   
                  <?php
           if(strlen($pitch_details['pitchit']) > 22)
              {?>
           <label style="cursor:pointer" title="An AEP has respond to your pitch, click here to see the conversation"><?php echo substr($pitch_details['pitchit'],0,20).'..';?></label>
              
          <?php }
           else
              {
              echo $pitch_details['pitchit'];  
              }
                         
                  ?>
                  <!-- <span class="tp_span2">An AEP has respond to your pitch, click here to see the conversation</span>
                <div class="clear"></div> -->
                  
                  </a>
                  
                  <script type="text/javascript">
                $(document).ready(function () {
                   
                   $('#pit_work_lat_first_all_'+<?=$vp;?>).click(function () {
                        
                            $('.pit_work_dialog').hide();
                            $("#pit_work_dialog_lat_first_all_"+<?=$vp;?>).dialog({
                                 position:  {
                                            my: "left",
                                            at: "left",
                                            of: $('#tab3')
                                        }
                            });
                            $("#pit_work_dialog_lat_first_all_"+<?=$vp;?>).show();
                            
                         $('#cancl_pit_rep_all_'+<?=$vp;?>).click(function () {
                       
                            //$("#pit_work_dialog_lat_first_all_"+<?=$vp;?>).dialog('close');
                            $("#pit_work_dialog_lat_first_all_"+<?=$vp;?>).hide();
                        
                       });    
                        
                    }); 
                    
                });
                </script>
                  
                  <div id="pit_work_dialog_lat_first_all_<?=$vp;?>" style="display: none;" class="pit_work_dialog">
                    <h1><?=$total_response_recent['subject']?>
                    </h1>
                    <p><?=$full_name5?> has sent a message to you</p>
                    <p>Message : <?=$total_response_recent['body']?></p>
                     
                  <a href="#0" class="cd-popup-trigger" id="cd-popup-trigger_first_all_<?php echo $vp;?>">Reply</a>
                  <a href="javascript:void(0);" id="cancl_pit_rep_all_<?=$vp;?>" class="green_but">Close</a>
                  
                  </div>
                  
                  
                  
                  
         <script>
         jQuery(document).ready(function($){
	//open popup
	$('#cd-popup-trigger_first_all_'+<?php echo $vp;?>).on('click', function(event){
		event.preventDefault();
		$('#cd-popup_first_all_'+<?php echo $vp;?>).addClass('is-visible');
	});
	
	//close popup
	$('#cd-popup_first_all_'+<?php echo $vp;?>).on('click', function(event){
		if( $(event.target).is('.cd-popup-close') || $(event.target).is('#cd-popup_first_all_'+<?php echo $vp;?>) ) {
			event.preventDefault();
			$(this).removeClass('is-visible');
		}
	});
	//close popup when clicking the esc keyboard button
	$(document).keyup(function(event){
    	if(event.which=='27'){
    		$('#cd-popup_first_all_'+<?php echo $vp;?>).removeClass('is-visible');
	    }
    });
    
    CKEDITOR.replace( 'editor3_<?php echo $vp;?>', {
            removeButtons: 'Source',
            // The rest of options...
        }); 
    
});
         </script>         
                                  
  <div class="cd-popup" role="alert" id="cd-popup_first_all_<?php echo $vp;?>">
	<div class="cd-popup-container_reply">
    <div style=" width:100%; background:#000; padding:20px 0;">
    </div>
		   <div class="top_compose">
                                
                                       <?php
                                       $usd = $this->session->userdata('logged_user');
                                       $frmAttrs   = array("id"=>'signupFrm',"class"=>'form-horizontal',"name"=>'myForm');
                                       echo form_open_multipart('mail/compose_pit_msg', $frmAttrs);
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
                                            <textarea class="ckeditor" cols="80" name="desc"  id="editor3_<?php echo $vp;?>" > </textarea>
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
                                            <input type="hidden" name="send_type" id="send_type" value="send" />
                                            
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
                      ?>  
                  <span id="pit_work_vw223_<?=$pitch_details['pit_id']?>" title="<?=$pitch_details['pitchit']?>" style="cursor: pointer;">
                  <?=substr($pitch_details['pitchit'],0,30).'..'?>
                  </span>
                  
                     <?php  
                      }
                   else
                      {
                      ?>  
                      
                      <span id="pit_work_vw223_<?=$pitch_details['pit_id']?>" style="cursor: pointer;">
                  <?=substr($pitch_details['pitchit'],0,30).'..'?>
                  </span> 
                   <?php    
                      }
          ?>        
             
                  
                  <script type="text/javascript">
                $(document).ready(function () {
                   
                   $('#pit_work_vw223_'+<?=$pitch_details['pit_id']?>).click(function () {
                        
                            $('.pit_work_dialog').hide();
                            $("#pit_work_dialog_vw223_"+<?=$pitch_details['pit_id']?>).dialog({
                                
                                 position:  {
                                            my: "left",
                                            at: "left",
                                            of: $('#tab3')
                                        }
                            });
                            $("#pit_work_dialog_vw223_"+<?=$pitch_details['pit_id']?>).show();
                        
                    });
                    
                    
                     $('#cancl_pit_vw223_'+<?=$pitch_details['pit_id']?>).click(function () {
                       
                            //$(".pit_work_dialog_vw223_"+<?=$pitch_details['pit_id']?>).dialog('close');
                            $("#pit_work_dialog_vw223_"+<?=$pitch_details['pit_id']?>).hide();
                        
                    }); 
                    
                });
                </script>
                  
                  <div id="pit_work_dialog_vw223_<?=$pitch_details['pit_id']?>" style="display: none;" class="pit_work_dialog">
                  
                  
                    <p><strong> PitchIt!</strong></p>
                    <p><?=$pitch_details['pitchit'];?></p>
                    <a href="javascript:void(0);" id="cancl_pit_vw223_<?=$pitch_details['pit_id']?>" class="green_but">Close</a>
                    <!--<a href="###" onclick="click_edit_pit()">Edit</a><a href="#">Save</a><a href="#">Cancel</a><a href="#">PitchIt!</a>-->
                  </div>
             
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
                
               <?php $vp++;} }  else {?> 
              
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

            <?php if(count($AuthorLatestPitchitCount) > 6) {?>
            <div class="paginate_div">
            <?php if(count($AuthorLatestPitchitCount) > $offset_latest){ ?><a href="javascript:;" onclick="ajaxViewallPitchit(<?php echo $page_latest+1;?>)" class="blue_but floright_martop">VIEW MORE</a><?php }else{?> <a href="javascript:;" class="blue_but floright_martop">VIEW OLDER</a> <?php } ?>

            <?php if($offset_latest == "0"){?>&nbsp;<?php }else{ ?> <a href="javascript:;" class="green_but floright_martop" onclick="ajaxViewallPitchit(<?php echo $page_latest-1;?>)">PREVIOUS</a> <?php } ?> 
             </div>
            <?php } ?> 

            </div>
            
               <div style="display: none;" id="tab4">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_new">
              <thead>
                <tr>
                  <th width="22%">Pitched Work</th>
                  <th width="22%">Viewed By</th>
                  <th width="28%">PitchIt! Message</th>
                  <th width="15%" class="center">Times Viewed</th>
                  <th width="13%" class="center">Date</th>
                </tr>
              </thead>
              <tbody>
              
                  <?php
                  //echo '<pre/>';print_r($total_view_pitchit);//die;
                  if(!empty($total_view_pitchit))
                  {
                    foreach($total_view_pitchit as $total_viw)
                    {
                  ?>
              
                <tr>
                  <td>
                  
                  <a class="tooltips" href="javascript:void(0)" >
                  <?php 
                  if(strlen($total_viw['title']) > 20)
                  {?>
              	<div title="<?php echo $total_viw['title'];?>"><?php echo substr($total_viw['title'],0,18).'...';?></div>
                    
                 <?php }
                  else
                  {
                    echo $total_viw['title'];
                  }
                  ?>
                  
                  <!-- <span class="tp_span2"><?php echo $total_viw['title'];?></span>
 					<div class="clear"></div> -->
                  </a>
                  
                  </td>
                  <td>
                  <?//=$total_viw['name_first'].' '.$total_viw['name_middle'].' '.$total_viw['name_last']?>
                  
                  <a class="tooltips" href="<?php echo base_url();?>discovery/user_details/<?php echo $total_viw['pituser'];?>" > 
                    <?php $full_name5 = $total_viw['name_first'].' '.$total_viw['name_middle'].' '.$total_viw['name_last'];
                    
               if(strlen($full_name5) > 20)
                {?>
              	<div title="<?php echo $full_name5;?>"><?php echo substr($full_name5,0,18).'...';?></div>
                    
                 <?php }
                else
                {
                    echo $full_name5;
                }
                  ?>
                  <!-- <span class="tp_span2"><?php echo $full_name5;?></span> -->
                  </a>
                  
                  </td>
                  <td> 
                  
                  <span id="pit_work_vw_<?=$total_viw['pitid']?>" style="cursor: pointer;">
                  	<?php
                  	if(strlen($total_viw['pitchit']) > 28)
	                {?>
	              	<div title="<?php echo $total_viw['pitchit'];?>"><?=substr($total_viw['pitchit'],0,25).'..'?></div>
	                    
	                 <?php }
	                else
	                {
	                    echo $total_viw['pitchit'];
	                }
                  	?>
                  
                  </span>
                  
                  
                  <script type="text/javascript">
                $(document).ready(function () {
                   
                   $('#pit_work_vw_'+<?=$total_viw['pitid']?>).click(function () {
                        
                            $('.pit_work_dialog').hide();
                            $("#pit_work_dialog_vw_"+<?=$total_viw['pitid']?>).dialog({
                                
                                 position:  {
                                            my: "left",
                                            at: "left",
                                            of: $('#tab4')
                                        }
                            });
                            $("#pit_work_dialog_vw_"+<?=$total_viw['pitid']?>).show();
                        
                    });
                    
                    
                     $('#cancl_pit_vw_'+<?=$total_viw['pitid']?>).click(function () {
                       
                            //$("#pit_work_dialog_vw_"+<?=$total_viw['pitid']?>).dialog('close');
                            $("#pit_work_dialog_vw_"+<?=$total_viw['pitid']?>).hide();
                        
                    }); 
                    
                });
                </script>
                  
                  <div id="pit_work_dialog_vw_<?=$total_viw['pitid']?>" style="display: none;" class="pit_work_dialog">
                  
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
                    <a href="javascript:void(0);" id="cancl_pit_vw_<?=$total_viw['pitid']?>" class="green_but">Close</a>
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

            <?php if($total_view_pitchit_cnt > 6) {?>
            <div class="paginate_div">
            <?php if($total_view_pitchit_cnt > $offset_totalviewed){ ?><a href="javascript:;" onclick="ajaxTotalviewedPitchit(<?php echo $page_totalviewed+1;?>)" class="blue_but floright_martop">VIEW MORE</a><?php }else{?> <a href="javascript:;" class="blue_but floright_martop">VIEW OLDER</a> <?php } ?>

            <?php if($offset_totalviewed == "0"){?>&nbsp;<?php }else{ ?> <a href="javascript:;" class="green_but floright_martop" onclick="ajaxTotalviewedPitchit(<?php echo $page_totalviewed-1;?>)">PREVIOUS</a> <?php } ?> 
             </div>
            <?php } ?> 

            </div>
            
            <div style="display: none;" id="tab5">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_new">
              <thead>
                <tr>
                                    
                  <th width="17%"></th>
                  <th width="15%"></th>
                  <th width="35%"></th>
                  <th width="18%" class="center"></th>
                  <th width="15%" class="center"></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td colspan="5">
                  <div class="pad_20">
                    <h3>You have <?php if($purchase_pitchit['sum_total'] > 0){ echo ($purchase_pitchit['sum_total']-$pitchit_use_count['count']); } else { echo '0'; } ?> available PitchIts!</h3>
                   <p>0 are earned PitchIts!</p>
                   <p><?php echo $pitchit_use_count['count']?> Pitchits are done</p>
                   <p><?php if($purchase_pitchit['sum_total'] > 0){ echo $purchase_pitchit['sum_total']; } else { echo '0'; } ?> are purchased PitchIts!</p>
                   <p>Go to your <a href="#">My Work</a> section to use these PitchIts!</p>
                   
					</div>
                  </td>

                </tr>
              </tbody>
            </table>
            </div>
            <div style="display: none;" id="tab6">
            
           <script type="text/javascript">
 
	function SetTypeText(number)
	{
		var typeField = document.getElementById("cardType");
		//typeField.innerHTML = GetCardType(number);
        typeField.value = GetCardType(number);
        //alert(number);
	}
 
        function GetCardType(number)
        {            
            var re = new RegExp("^4");
            if (number.match(re) != null)
                return "Visa";
 
            re = new RegExp("^(34|37)");
            if (number.match(re) != null)
                return "American Express";
 
            re = new RegExp("^5[1-5]");
            if (number.match(re) != null)
                return "MasterCard";
 
            re = new RegExp("^6011");
            if (number.match(re) != null)
                return "Discover";
 
            return "";
        }
        
 /*document.querySelector('select[name=item]').addEventListener('change', function() {
    var total = 0,
        selected = this.selectedOptions,
        l = selected.length;
    for (var i = 0; i < l; i++) {
       total += parseInt(selected[i].value, 10);
    }
    
    //document.getElementById('selectedValue').textContent = total;
    document.getElementById('selectedValue').value = total;
   
});*/

/*$(document).ready(function(){
    
    $('#ExpDate').click(function() {
        
        $('#ExpDate').removeClass('tooltips');
        alert('hi');
        });
});*/

function package22(id)
{
    //alert(id);
    //document.getElementById('package_price').value = price;
    
    	$.ajax({
		   url      : '<?=base_url()?>'+'home/ajax_package_price',
		   type     : 'POST',
		   data     : { 'id': id},
		   success  : function(resp){
		    //alert(resp);
		        if(resp != '0'){
		            $("#package_price").val(resp);
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

function limitText_cvc(limitField, limitCount, limitNum) {
    if (limitField.value.length > limitNum) {
        limitField.value = limitField.value.substring(0, limitNum);
    } else {
        limitCount.value = limitNum - limitField.value.length;
    }
}

function limitText_ExpDate(limitField, limitCount, limitNum) {
    if (limitField.value.length > limitNum) {
        limitField.value = limitField.value.substring(0, limitNum);
    } else {
        limitCount.value = limitNum - limitField.value.length;
    }
}
      $(document).ready(function () {
        $('#chkBoxHelp_package').click(function () {
            if ($(this).is(':checked')) {
                
                //alert('chk');
                
            } else {
                //alert('notchk');
            }
        });
        
        
        $('#cvc').keyup(function(){
            
            var cvc_data = $('#cvc').val();
            
            if(cvc_data == '')
            {
                $('#cvc_span').css('display','none');
            }
            else
            {
              if(!isNaN(cvc_data))
                {
                   
                    //alert('correct');
                    $('#cvc_span').css('display','block');
                    //$('#cvc_span').html('<font color=green>available value</font>');
                    
                    
                }
                else
                {
                    //alert('not');
                    $('#cvc_span').css('display','block');
                    $('#cvc_span').html('<font color=red>numeric value only</font>')
                }  
            }     
        })
        
    
                    
         $('#purchase').click(function() {
            
            var userinfo = $("#MYFORM").serialize();
            
  	  $.ajax({
		   url      : '<?=base_url()?>'+'home/get_purchase',
		   type     : 'POST',
		   data     : userinfo,
		   success  : function(response){
		    //alert(resp);
		         
            //alert(response);
			if(response==1)
			{
                //$("#after_submit").html('');
				//$("#code").after('<label class="success" id="after_submit">Success ! valid captcha code.</label>');
				//change_captcha();
				//window.location.href = "<?=base_url()?>home/do_purchase/"+userinfo;
                
                $.ajax({
        		   url      : '<?=base_url()?>'+'home/do_purchase',
        		   type     : 'POST',
        		   data     : userinfo,
        		   success  : function(resp){
		      
                   //alert(resp);
                   if(resp == 1)
                   {
                    
                     $("#after_submit").html('');
    				 $("#code").after('<label class="success" id="after_submit">Thank you for purchasing pitchIts</label>');
                   }
                   else
                   {
                     $("#after_submit").html('');
				     $("#code").after('<label class="error" id="after_submit">Error ! Transaction</label>');
                   }
              }
                
			  });
            }
			else
			{
				$("#after_submit").html('');
				$("#code").after('<label class="error" id="after_submit">Error ! invalid captcha code .</label>');
                
			}
			
		   },
		   error    : function(resp){
		   	//$("#content_part").unblock();
		        $.prompt("Sorry, something isn't working right.", {title:'Error'});
		   }
		});
           
		
            
      });
        
        
   }) 
           
           
                 
     
</script> 
         
       <style>
      
.error{ color:#CC0000; font-size:12px; margin:4px; font-style:italic; width:200px;}
     
       [data-tip] {
	position:relative;

}
[data-tip]:before {
	content:'';
	/* hides the tooltip when not hovered */
	display:none;
	content:'';
	border-left: 5px solid transparent;
	border-right: 5px solid transparent;
	border-bottom: 5px solid #46b8ff;	
	position:absolute;
	top:30px;
	left:35px;
	z-index:8;
	font-size:0;
	line-height:0;
	width:0;
	height:0;
}
[data-tip]:after {
	display:none;
	content:attr(data-tip);
	position:absolute;
	top:35px;
	left:0px;
	padding:5px 8px;
	background:#46b8ff;
	color:#fff;
	z-index:9;
	font-size: 0.75em;
	line-height:18px;
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;
	white-space:normal;
	word-wrap:normal;
    width: 100px;
}
[data-tip]:hover:before,
[data-tip]:hover:after {
	display:block;
    margin-left: 86px;
}
       
       </style>     
            <form action="" method="post" name="MYFORM" id="MYFORM">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_new table_new3">
              <thead>
                <tr>
                  
                  <th width="17%"></th>
                  <th width="15%"></th>
                  <th width="35%"></th>
                  <th width="18%"></th>
                  <th width="15%"></th>
                  
                </tr>
              </thead>
              
              <tbody id="purchase_tbody">
                <tr>
                  <td colspan="5">
                  <h3>Please Review and Complete these Fields to Purchase PitchIts!</h3>
                  
                  
                            <table width="100%" border="0">
                            <tr>
                            <td><input name="name_first" id="name_first" type="text" placeholder="First Name" value="<?=$user_details_payment['name_first']?>"/></td>
                            <td><input name="name_last" id="name_last" type="text" placeholder="Last Name" value="<?=$user_details_payment['name_last']?>"/></td>
                            <td><input name="email" id="email" type="text" placeholder="E-Mail" value="<?=$user_details_payment['email']?>"/></td>
                            </tr>
                            <tr>
                            <td><input name="company" id="company" type="text" placeholder="Company" /> </td>
                            <td><input name="address" id="address" type="text" placeholder="Street Address" value="<?=$user_details_payment['address']?>"/> </td>
                            <td><input name="city" id="city" type="text" placeholder="City" /> </td>
                            </tr>
                            <tr>
                            <td>
                            <select name="menu" name="state" id="state">
                            
                            <option value="AL">Alabama</option>
                        	<option value="AK">Alaska</option>
                        	<option value="AZ">Arizona</option>
                        	<option value="AR">Arkansas</option>
                        	<option value="CA">California</option>
                        	<option value="CO">Colorado</option>
                        	<option value="CT">Connecticut</option>
                        	<option value="DE">Delaware</option>
                        	<option value="DC">District Of Columbia</option>
                        	<option value="FL">Florida</option>
                        	<option value="GA">Georgia</option>
                        	<option value="HI">Hawaii</option>
                        	<option value="ID">Idaho</option>
                        	<option value="IL">Illinois</option>
                        	<option value="IN">Indiana</option>
                        	<option value="IA">Iowa</option>
                        	<option value="KS">Kansas</option>
                        	<option value="KY">Kentucky</option>
                        	<option value="LA">Louisiana</option>
                        	<option value="ME">Maine</option>
                        	<option value="MD">Maryland</option>
                        	<option value="MA">Massachusetts</option>
                        	<option value="MI">Michigan</option>
                        	<option value="MN">Minnesota</option>
                        	<option value="MS">Mississippi</option>
                        	<option value="MO">Missouri</option>
                        	<option value="MT">Montana</option>
                        	<option value="NE">Nebraska</option>
                        	<option value="NV">Nevada</option>
                        	<option value="NH">New Hampshire</option>
                        	<option value="NJ">New Jersey</option>
                        	<option value="NM">New Mexico</option>
                        	<option value="NY">New York</option>
                        	<option value="NC">North Carolina</option>
                        	<option value="ND">North Dakota</option>
                        	<option value="OH">Ohio</option>
                        	<option value="OK">Oklahoma</option>
                        	<option value="OR">Oregon</option>
                        	<option value="PA">Pennsylvania</option>
                        	<option value="RI">Rhode Island</option>
                        	<option value="SC">South Carolina</option>
                        	<option value="SD">South Dakota</option>
                        	<option value="TN">Tennessee</option>
                        	<option value="TX">Texas</option>
                        	<option value="UT">Utah</option>
                        	<option value="VT">Vermont</option>
                        	<option value="VA">Virginia</option>
                        	<option value="WA">Washington</option>
                        	<option value="WV">West Virginia</option>
                        	<option value="WI">Wisconsin</option>
                        	<option value="WY">Wyoming</option>
                            
                            </select>
                            </td>
                            <td>
                            	<select name="menu" id="country" name="country">
                            	   <option value="">Country</option>
					               <option value="US">United States</option>
					               <?php foreach($countries as $country_row){?>
					               <option value="<?=$country_row['country_code'];?>"><?=$country_row['country_name'];?></option>
					               <?php }?>
                            	</select>
                            </td>
                            <td><input name="postal_code" id="postal_code" type="text" placeholder="Postal Code" value="<?=$user_details_payment['postal_code']?>"/></td>
                            </tr>
                            <tr>
                            <td><input name="ccNumber" type="text" placeholder="Card Number" id="ccNumber" onkeyup="SetTypeText(this.value)" />
                            <!--<select name="menu">
                            <option>Card Type</option>
                            <option>Card Type2</option>
                            </select>-->
                            </td>
                            <td><input name="cardType" type="text" placeholder="Card Type" id="cardType" value="" readonly="readonly" /></td>
                            <td>
                            
                            <input name="ExpDate" type="text" class="mid_input" placeholder="Exp Date" id="ExpDate" onKeyDown="limitText_ExpDate(this.form.ExpDate,this.form.cout,5);" onKeyUp="limitText_ExpDate(this.form.ExpDate,this.form.cout,5);"/>
                            
                            <div data-tip="This is the 3 digit code on the back of your card next to your signature">
                            <input name="cvc" id="cvc" type="text" class="small_input" placeholder="CVC" value="" onKeyDown="limitText_cvc(this.form.cvc,this.form.cout,3);" onKeyUp="limitText_cvc(this.form.cvc,this.form.cout,3);"/>
                            
                            <input  type="text" name="cout" size="3" value="100" readonly="readonly" class="read_only" style="display: none;"/>
                            
                            </div>
                            <span id="cvc_span" style="display: none;"></span>
                            <!--<a class="tooltips" href="javascript:void(0)" >
                               <span class="tp_span2">This is the 3 digit code on the back of your card next to your signature</span>
                                 <div class="clear"></div>
                             </a>-->
                           
                             
                            </td>
                            </tr>
                            <tr>
                            <td><input name="checkbox" type="checkbox" value="" id="chkBoxHelp_package" /> Save My Card Info</td>
                            <td>
                            
                            <select name="package_id" id="package_id" onchange="package22(this.value)">
                             <!--<select multiple name="item" style="width: 225px;" action="post" id="mySelect">-->
                            <option value="" ># of Pitchits!</option>
                            <?php
                            if(!empty($total_pitchit_package))
                            {
                                foreach($total_pitchit_package as $package)
                                {
                                    
                                
                            ?>
                            <option value="<?=$package['id']?>"><?php echo $package['package_name'];?></option>
                            <?php }
                            }
                            ?>
                            </select>
                            </td>
                            <td><input name="package_price" type="text" id="package_price" value="" />
                            
                            </td>
                            </tr>
                            <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>
                            <!--<input name="button" type="button" value="Edit Cart" />--> 
                            <input name="button" type="button" value="Checkout" style="margin-right:31px;" class="green_but flo_right" onclick="getPurchaseDiv();" /></td>
                            </tr>
                            </table>

                  
                  
                  </td>
                </tr>
                                                                                               
              </tbody>
              
              <tbody style="display: none;" id="purchase_confirm">
                <tr>
                  <td colspan="5">
                  <h3>Purchase Confirmation</h3>
                  
                  <script>
                  
                  $(document).ready(function () {
                    $('#chkBoxHelp_billing').click(function () {
                        if ($(this).is(':checked')) {
                            
                            //alert('chk');
                           var name_first = $("#name_first").val();
                           var name_last = $("#name_last").val();
                           var company = $("#company").val();
                           var address = $("#address").val();
                           var city = $("#city").val();
                           var state = $("#state").val();
                           var country = $("#country").val();
                           var postal_code = $("#postal_code").val();
                           var amount = $("#package_price").val();
                           //alert(postal_code);
                           
                           $("#name_first1").val(name_first);
                           $("#name_last1").val(name_last);
                           $("#company1").val(company);
                           $("#address1").val(address);
                           $("#city1").val(city);
                           $("#postal_code1").val(postal_code);
                           $("#total_amount").val(amount);
                          
                          $('#state1 option[value="' + state + '"]').prop('selected', true);
                          $('#country1 option[value="' + country + '"]').prop('selected', true);
                            
                        } else {
                            //alert('notchk');
                           $("#name_first1").val('');
                           $("#name_last1").val('');
                           $("#company1").val('');
                           $("#address1").val('');
                           $("#city1").val('');
                           $("#postal_code1").val('');
                           $("#total_amount").val('');
                           
                           var state = $("#state").val();
                           var country = $("#country").val();
                           
                          $('#state1 option[value="' + state + '"]').prop('selected', false);
                          $('#country1 option[value="' + country + '"]').prop('selected', false);
                            
                        }
                    });
                   
                     })           
                 
                  </script>
                  
                  <p class="pad_lef10"><input name="checkbox" type="checkbox" id="chkBoxHelp_billing" class="chkBoxHelp_billing" /> Billing Address Same as Home/Work Address on previous page</p>
                  
                            <table width="100%" border="0">
                            <tr>
                            <td><input name="name_first1" id="name_first1" type="text" placeholder="First Name" value="" /></td>
                            <td><input name="name_last1" id="name_last1" type="text" placeholder="Last Name" value=""/></td>
                            <td><input name="company1" id="company1" type="text" placeholder="Company" value=""/></td>
                            </tr>
                            <tr>
                            <td><input name="address1" id="address1" type="text" placeholder="Street Address" value=""/> </td>
                            <td><input name="city1" id="city1" type="text" placeholder="City" value=""/> </td>
                            <td>
                            <select name="menu" id="state1" name="state1">
                                <option value="AL">Alabama</option>
                            	<option value="AK">Alaska</option>
                            	<option value="AZ">Arizona</option>
                            	<option value="AR">Arkansas</option>
                            	<option value="CA">California</option>
                            	<option value="CO">Colorado</option>
                            	<option value="CT">Connecticut</option>
                            	<option value="DE">Delaware</option>
                            	<option value="DC">District Of Columbia</option>
                            	<option value="FL">Florida</option>
                            	<option value="GA">Georgia</option>
                            	<option value="HI">Hawaii</option>
                            	<option value="ID">Idaho</option>
                            	<option value="IL">Illinois</option>
                            	<option value="IN">Indiana</option>
                            	<option value="IA">Iowa</option>
                            	<option value="KS">Kansas</option>
                            	<option value="KY">Kentucky</option>
                            	<option value="LA">Louisiana</option>
                            	<option value="ME">Maine</option>
                            	<option value="MD">Maryland</option>
                            	<option value="MA">Massachusetts</option>
                            	<option value="MI">Michigan</option>
                            	<option value="MN">Minnesota</option>
                            	<option value="MS">Mississippi</option>
                            	<option value="MO">Missouri</option>
                            	<option value="MT">Montana</option>
                            	<option value="NE">Nebraska</option>
                            	<option value="NV">Nevada</option>
                            	<option value="NH">New Hampshire</option>
                            	<option value="NJ">New Jersey</option>
                            	<option value="NM">New Mexico</option>
                            	<option value="NY">New York</option>
                            	<option value="NC">North Carolina</option>
                            	<option value="ND">North Dakota</option>
                            	<option value="OH">Ohio</option>
                            	<option value="OK">Oklahoma</option>
                            	<option value="OR">Oregon</option>
                            	<option value="PA">Pennsylvania</option>
                            	<option value="RI">Rhode Island</option>
                            	<option value="SC">South Carolina</option>
                            	<option value="SD">South Dakota</option>
                            	<option value="TN">Tennessee</option>
                            	<option value="TX">Texas</option>
                            	<option value="UT">Utah</option>
                            	<option value="VT">Vermont</option>
                            	<option value="VA">Virginia</option>
                            	<option value="WA">Washington</option>
                            	<option value="WV">West Virginia</option>
                            	<option value="WI">Wisconsin</option>
                            	<option value="WY">Wyoming</option>
                            </select>
                            </td>
                            </tr>
                            <tr>
                            <td><select name="menu" id="country1" name="country1">
                            <option>USA</option>
                            
                            </select></td>
                            <td><input name="postal_code1" id="postal_code1" type="text" placeholder="Postal Code" value=""/></td>
                            <td><input name="total_amount" id="total_amount" type="text"  value=""/></td>
                            </tr>
                            
                            <tr>
                            <td class="captcha_abslt">
                            
                            <script>
                           
                            /*$('#refresh').click(function() {  
			                   
                               alert('hi');
                    			change_captcha();
                                
                    	 });*/
                    	 
                    	 function change_captcha()
                    	 {
                    	 	//document.getElementById('captcha').src="<?//=base_url()?>get_captcha.php?rnd=" + Math.random();
                            document.getElementById('captcha').src="<?=base_url()?>home/get_captcha?rnd="+ Math.random();
                            
                         }
                         
                            </script>
                            
                            <img src="<?=base_url()?>get_captcha.php?rnd=0" alt="" id="captcha" class="capture_code"/>
                            <img src="<?=base_url()?>images/refresh.jpg" width="25" alt="" id="refresh" onclick="change_captcha();" />
                            <span class="invite_msg">(Please type this sequence to the right box)</span>
                            </td>
                            <td>
                            
                            <input name="code" id="code" type="text" class="mid_input" placeholder="e.g. UHJIK" />
                            
                            <!--<span class="capture_code">JV14L5T</span>-->
                            
                            </td>
                            <td>
                            <input name="button" type="button" value="Back" onclick="backToFirst()" />
                            <input name="button" type="button" value="Edit Cart" id="trigger_select"/> 
                            <input name="button" type="button" value="Purchase" class="green_but" id="purchase" /></td>
                            </tr>
                            </table>

                  
                  </form>
                  </td>
                </tr>
                                                                                               
              </tbody>
              
            </table>
            </form>
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
          
          <h1 class="for_mobile"><img src="<?=base_url()?>images/cercel_icon_hand.png" alt="" />Who’s Looking?<span>
          <!--<a href="#" class="button_pro">View Detail</a>--></span></h1>
            <div class="clear"></div>
            <div class="publishers_section_left_pad">
              <ul>
                <li class="pad_right"><img src="<?=base_url()?>images/female.png" alt="" /> 
                <?php $male = ($aep_female_percent['count'] * 100)/$total_aep['count'];
                //echo $m = sprintf ("%.2f", $male);
                echo round($male);
                ?>% Female AEPs</li>
                <li><img src="<?=base_url()?>images/male.png" alt="" /> 
                <?php $female = ($aep_male_percent['count'] * 100)/$total_aep['count'];
                //echo $f = sprintf ("%.2f", $female);
                echo round($female);
                ?>% Male AEPs</li>
                <div class="clear"></div>
              </ul>
            </div>
          
          
            <!--<h1><img src="<?=base_url()?>images/click_icon.png" alt="" />My Clicks By Publishers</h1>-->
            <div class="publishers_section_left_pad">
            
            <div id="tabs_dem"> 
              <div class="box_section box_section_mar_right30">
                <div class="icon_section"><img src="<?=base_url()?>images/rou_01.png" alt="" /></div>
                <a class="tooltips" href="javascript:void(0)" name="tab_dem1">
                
                <div class="myclick_para" title="Your titles have been searched<?=$user_search_count['count']?> times by various agents, editors and publishers"><div class="myclick_span"><?=$user_search_count['count']?></div>
                  Title Searches</div>
                
                  <!-- <span class="tp_span"></span>
				<div class="clear"></div> -->
                </a>
                <a href="#" class="aps_but" name="tab_dem1">View List</a>
              </div>
              <div class="box_section">
                <div class="icon_section"><img src="<?=base_url()?>images/rou_02.png" alt="" /></div>
                <a class="tooltips" href="javascript:void(0)" name="tab_dem2" >
                
                <div class="myclick_para" title="Your profile has been looked at <?=$user_view_count['count']?> times by various agents, editors, and publishers."><div class="myclick_span" ><?=$user_view_count['count']?></div>
                  Profile Views</div>
                
                  <!-- <span class="tp_span"></span>
                  <div class="clear"></div> -->
                </a>      
                 <a href="#" class="aps_but" name="tab_dem2">View List</a>          
                
              </div>
              <div class="clear"></div>
              <div class="box_section box_section_mar_right30">
                <div class="icon_section"><img src="<?=base_url()?>images/rou_03.png" alt="" /></div>
                
                <a class="tooltips" href="javascript:void(0)" name="tab_dem3" >
                
                <div class="myclick_para" title="Your titles have been downloaded <?=$user_download_count['count']?> times by various agents, editors and publishers"><div class="myclick_span" ><?=$user_download_count['count']?></div>
                 Title Downloads</div>
                
                  <!-- <span class="tp_span"></span>
 <div class="clear"></div> -->
                </a>
                 <a href="#" class="aps_but" name="tab_dem3">View List</a>
              </div>
              <div class="box_section">
                <div class="icon_section"><img src="<?=base_url()?>images/rou_04.png" alt="" /></div>
                
                <a class="tooltips" href="javascript:void(0)" name="tab_dem4" >
                
                <div class="myclick_para" title="Your titles have been placed on bookshelves <?=$user_bookshelf_count['count']?> times by various agents, editors and publishers"><div class="myclick_span" ><?=$user_bookshelf_count['count']?></div>
                  Bookshelf Titles</div>
                
                  <!-- <span class="tp_span"></span>
 <div class="clear"></div> -->
                </a>
                <a href="#" class="aps_but" name="tab_dem4">View List</a>
              </div>
              <div class="clear"></div>
              
                 
           </div> 
              
              <h3>Most Popular Searches by AEPs</h3>
              
                 <?php
        $i = 0;
        foreach($user_popular_search_work as $vtm)
        {
            $i = $i + $vtm['catcount'];
        }
        //echo $i;
     ?>
<script type="text/javascript">
     /* google.load("visualization", "1.0", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Percentage'],
          
          <?php 
          foreach($user_popular_search_work as $vtm)
           {
            $catcnt = ($vtm['catcount'] * 100)/$i;
            $fcatcnt = sprintf ("%.2f", $catcnt);
          ?>
          ["<?php echo $fcatcnt.'% '.$vtm['category_name'];?>",     <?php echo $fcatcnt;?>],
          
          <?php } ?>
        ]);

        var options = {
          //title: 'My Daily Activities',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      } */
      
      
      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});

      google.setOnLoadCallback(drawChart);
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
        
        <?php 
          foreach($user_popular_search_work as $vtm)
           {
            $catcnt = ($vtm['catcount'] * 100)/$i;
            $fcatcnt = sprintf ("%.2f", $catcnt);
          ?>
        
          ["<?php echo  $fcatcnt.'% '.$vtm['category_name'];?>", <?php echo $fcatcnt;?>],
          
          <?php } ?>
          
        ]);

        // Set chart options
        /*var options = {'title':'How Much Pizza I Ate Last Night',
                       'width':400,
                       'height':300};*/
                       
       var options = {
        is3D: true,
       'width':400,
       'height':220,
       enableInteractivity : false,
       chartArea:{left:10,top:20,width:"100%",height:300},
       //legend: { position: 'labeled' }
       };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }


    </script> 
              
              
              <div align="center">
                <div id="piechart_3d" style="width: 100%; height: auto;"></div>
              </div>
             
            </div>
          </div>
          <div class="publishers_section_right" style="margin-top:0;" id="content_dem"> 
          
          
         <div style="display: block;" id="tab_dem1">
         <div id="tab_1">
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
    //echo '<pre/>';print_r($user_search_details);die;
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
     
     <?php  } } else {?>
   
   <tr>
    <td></td>
    <td align="center">
     <p>No Title Searched</p>
    </td>
    <td align="center"></td>
  </tr>  
     
     <?php } ?>
  
  </tbody>
</table>

<?php if($user_search_count['count'] > 10) {?>
<div class="paginate_div">
<?php if($total_rows > $offset){ ?><a href="javascript:;" onclick="ajaxDiscovery(<?php echo $page+1;?>)" class="blue_but floright_martop">VIEW OLDER</a><?php }else{?> <a href="javascript:;" class="blue_but floright_martop">VIEW OLDER</a> <?php } ?>

<?php if($offset == "0"){?>&nbsp;<?php }else{ ?> <a href="javascript:;" class="green_but floright_martop" onclick="ajaxDiscovery(<?php echo $page-1;?>)">PREVIOUS</a> <?php } ?> 
 </div>
<?php } ?> 
                     
      </div> 
      
   </div>    
      
      <div style="display: none;" id="tab_dem2">
      <div id="tab_2"> 
          <h1><img src="<?=base_url()?>images/rou_02.png" alt="" /> Profile Views</h1>
   
   <table width="100%" border="0" class="tab_new_upp">
   <thead>       
  <tr>
    <th align="left" width="40%">Title</th>
    <th align="center" width="40%">Viewed By</th>
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

<!--<a href="#" class="button">VIEW OLDER</a>-->  

<?php if($user_view_count['count'] > 10) {?>
<div class="paginate_div">
<?php if($total_rows2 > $offset){ ?><a href="javascript:;" onclick="ajaxDiscovery2(<?php echo $page+1;?>)" class="blue_but floright_martop">VIEW OLDER</a><?php }else{?> <a href="javascript:;" class="blue_but floright_martop">VIEW OLDER</a> <?php } ?>

<?php if($offset == "0"){?>&nbsp;<?php }else{ ?> <a href="javascript:;" class="green_but floright_martop" onclick="ajaxDiscovery2(<?php echo $page-1;?>)">PREVIOUS</a> <?php } ?> 
 </div>
<?php } ?> 
        
      </div>  
    </div>  
      
      
      <div style="display: none;" id="tab_dem3"> 
      
      <div id="tab_3"> 
      
          <h1><img src="<?=base_url()?>images/rou_03.png" alt="" /> Title Downloads</h1>
   
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
    <td>
    <a class="tooltips" href="javascript:void(0);">
    <div><?=(strlen($total_downloader['title']) > 20 ? '<div title="'.$total_downloader['title'].'">'.substr($total_downloader['title'],0,20).'...</div>' : $total_downloader['title']);?></div>
    
    <!-- <span class="tp_span tp_span22"> <?php echo $total_downloader['title']; ?> </span> -->
    </a>
    
    </td>
    <td align="center">
    
    
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
         <p>No one downloaded</p>
        </td>
        <td align="center"></td>
    </tr>
     
     
     <?php } ?>
  
  </tbody>
</table>

<!--<a href="#" class="button">VIEW OLDER</a>--> 

<?php if($user_download_count['count'] > 10) {?>
<div class="paginate_div">
<?php if($total_rows3 > $offset){ ?><a href="javascript:;" onclick="ajaxDiscovery3(<?php echo $page+1;?>)" class="blue_but floright_martop">VIEW OLDER</a><?php }else{?> <a href="javascript:;" class="blue_but floright_martop">VIEW OLDER</a> <?php } ?>

<?php if($offset == "0"){?>&nbsp;<?php }else{ ?> <a href="javascript:;" class="green_but floright_martop" onclick="ajaxDiscovery3(<?php echo $page-1;?>)">PREVIOUS</a> <?php } ?> 
 </div>
<?php } ?>


  </div>          
      </div> 
          
          
       <div style="display: none;" id="tab_dem4"> 
       
       <div id="tab_4"> 
       
          <h1><img src="<?=base_url()?>images/rou_04.png" alt="" /> Bookshelf Titles</h1>
   
   <table width="100%" border="0" class="tab_new_upp">
   <thead>       
  <tr>
    <th align="left" width="40%">Title</th>
    <th align="center" width="40%">Bookshelved By</th>
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
    <td>
    
    <a class="tooltips" href="javascript:void(0);">
    <div><?=(strlen($total_bookshelved_user['title']) > 20 ? '<div title="'.$total_bookshelved_user['title'].'">'.substr($total_bookshelved_user['title'],0,20).'...</div>' : $total_bookshelved_user['title']);?></div>
    
    <!-- <span class="tp_span tp_span22"> <?php echo $total_bookshelved_user['title']; ?> </span> -->
    </a>
    
    </td>
    <td align="center">
    
    
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
         <p>No one Bookshelved</p>
        </td>
        <td align="center"></td>
    </tr>
     
     
     <?php } ?>
  <!--<tr>
    <td>Jezebel’s Adventures</td>
    <td align="center"><img src="<?//=base_url()?>images/bow.png" alt="" /></td>
    <td align="center">1/22/15</td>
  </tr>-->
  
  </tbody>
</table>

<!--<a href="#" class="button">VIEW OLDER</a>--> 
<?php if($user_bookshelf_count['count'] > 10) {?>
<div class="paginate_div">
<?php if($total_rows4 > $offset){ ?><a href="javascript:;" onclick="ajaxDiscovery4(<?php echo $page+1;?>)" class="blue_but floright_martop">VIEW OLDER</a><?php }else{?> <a href="javascript:;" class="blue_but floright_martop">VIEW OLDER</a> <?php } ?>

<?php if($offset == "0"){?>&nbsp;<?php }else{ ?> <a href="javascript:;" class="green_but floright_martop" onclick="ajaxDiscovery4(<?php echo $page-1;?>)">PREVIOUS</a> <?php } ?> 
 </div>
<?php } ?>

   </div>         
      </div>   
          
          </div>
          <div class="clear"></div>
        </div>
        <div class="pitchits_section_right work_section work_section_mob pitchits_section_new5">
          <h1><img src="<?=base_url()?>images/work_img.png" alt="" />My Work 
          <span><a href="<?=base_url()?>home/addWork" class="button_pro">Add/Edit Titles <img src="<?=base_url()?>images/plus_icon.png" alt="" /></a> 
          <!--<a href="<?//=base_url()?>home/view_all_work" class="button_pro">View All</a>-->
          </span></h1>
         
         
         <div class="pit_work_dialog_lat_first_mywork_pit popup_chng" style="display: none;" id="pit_work_dialog">
                  
                  <span id="success_pit_suc" style="color: green;" style="display: none;"></span>
                  <span id="success_pit_err" style="color: green;" style="display: none;"></span>
                  
                  <header>
					<h3 style="padding-left:33% !important;border-bottom: 1px solid black; margin-bottom:8px">Write Your PitchIt! Message</h3>
					<p style="font-size:12px;">A PitchIt! message can be up to 140 characters in length. Your PitchIt! message will be sent to all AEPs who are interested in your type of content. If an AEP likes your work, they will respond directly to your PitchIt! Inbox. Good luck!</p>
				</header>
               <div class="clear"></div>
               <div id="show_create_msg" class="send_success"><p>Congratulations! Your PitchIt! was successfully sent.</p></div>
                <form style="margin-left:17% !important;">
                <textarea class="txt_pitchit" id="desc" name="desc" onKeyDown="limitText(this.form.desc,this.form.cout,140);" 
onKeyUp="limitText(this.form.desc,this.form.cout,140);"></textarea>

          <p>Characters Remaining: <input  type="text" name="cout" id="cout" size="3" value="140" readonly="readonly" class="read_only"/> </p>
            
            <?php
            //$category_details  = $this->mprofile->total_publisher_details($details['id'],$details['work_type_id'],$details['work_form_id']);
            /*$category_details  = $this->mprofile->total_publisher_details_forpitch();
            if(!empty($category_details))
            {*/
            ?>
            <!-- <p style="margin-top: 10px;"> <strong>Choose Publishers</strong> </p>
                   
     <select data-placeholder="Choose a publisher..." class="chosen-select input_box" multiple="multiple" name="cate_gory_hid[]" id="cate_gory_hid" >
            <option value=""></option> 
            
            <?php
            
            //echo '<pre/>';print_r($category_details);die;
            /*if(isset($category_details) && count($category_details) > 0)
            {
                //echo '<pre/>';print_r($category_details);
                //$i=0;
                foreach($category_details as $eachList)
                {*/
            
            ?> 
            <option value="<?php //echo $eachList['id']?>"><?php //echo $eachList['name_first'].' '.$eachList['name_middle'].' '.$eachList['name_last']?></option>
            <?php //} } ?>
     </select> -->
       <input type="hidden" name="cate_gory_hid[]" id="cate_gory_hid" value="" />
          <?php //} ?>
            
              <div class="clear"></div>
        <div class="form_but">
            <input type="hidden" name="work_pit" id="work_pit" value="" /> 
            
            <input type="hidden" name="pit_open" id="pit_open" value="1" />  
            <input name="send" type="button" value="Send" class="btn_viw1" style="cursor:pointer" onclick="create_pitchit()" />
            <input name="save" type="button" value="Save" class="blue_but" style="cursor:pointer" onclick="save_pitchit()"/>
            <input name="save" type="button" value="Close" class="green_but" style="cursor:pointer" id="cancl_work_pit" />
        </div>
             </form>                     
                <?php /* <a href="#" class="pitchit_pop_icon"><img src="<?php echo base_url()?>/images/icon_p.png"></a>  
                <a href="#" class="think_pop_icon"><img src="<?php echo base_url()?>/images/think.png"></a> 
                <a  class="green_but" href="#bookshelf_add_1" rel="facebox">Add to Bookshelf</a>
               <!-- <a href="javascript:void(0);" id="cancl_work_pit">Close</a>--> */?>
                    
        </div>
         
                
                <div class="demo">
                
                <div id="owl-demo2" class="owl-carousel">
                
                   
                <?php 
                if(!empty($user_work_details))
                {
                	//print_r($user_work_details);die;
                    //foreach($user_work_details as $key=>$total_work_saved)
                    foreach($user_work_details as $key=>$details)
                    {
                     $user_category_details = $this->memail->get_user_work_categories($details['id']); 
                ?>
                
                <div class="item" id="book<?php echo $details['id'];?>">
                <h4 style="margin-top:12px;"><?php if(strlen($details['title']) > 18) { ?><?=substr($details['title'],0,18)?>... <?php }else{ ?><?=$details['title']?><?php } ?></h4>
                
                <div class="item_left_section" style="width:85px; height:104px;">
                <?php if($details['cover_image'] != '') {?>
                <img src="<?=base_url()?>uploadImage/<?=$usd['id']?>/cover_image/medium/<?=$details['cover_image']?>" alt="" width="100%" height="100" />
                <?php } else { ?>
                <p style="width:100% !important; height:100px !important;color:#fff !important;" class="cvrsec_img"><?php /*?><img src="<?=base_url()?>images/img_default_cover_mywork.png"/><?php */?>
                <?php
                	/*$title = "";
                	if(strlen($details['title']) > 12){
                     	$title = '<a href="javascript:void(0);" style="color:#fff !important;" class="tooltips">'.substr($details['title'],0,9).'...<span class="tp_span28">'.$details['title'].'</span></a>';
                    }else{
                    	$title = $details['title'];
                    }*/
                    echo $details['title'];
                ?>
                </p>
                <?php } ?>
                </div>
                
                <div class="item_right_section" style="margin-top:0px; width:122px;">
                
                <!--<h4><?php if(strlen($details['title']) > 18) { ?><?=substr($details['title'],0,18)?>... <?php }else{ ?><?=$details['title']?><?php } ?></h4>--><br>
                <div style="height:70px;">
            	<?php 
               	$full_name = $details['name_first'].' '.$details['name_middle'].' '.$details['name_last']; 
                if(strlen($full_name) > 15)
                {
                 	$full_name = '<span style="cursor:pointer" title="'.$full_name.'">'.substr($full_name,0,12).'...</span>';
                }else{
                	$full_name = $full_name;
                }
                
                ?>
				<p>By <?php echo trim($full_name);?></span></p>
                <p>Format : <?=$details['work_type_name']?></p>
                <p>Genre : <?php if(!empty($user_category_details))
                     {
                     $cat_name = '';
                     foreach($user_category_details as $categories)
                     {
                        $cat_name .= $categories['category_name'].', ';
                        //trim($string, ",");
                     } 
                     $cat_name = trim($cat_name,', ');

                    if(strlen($cat_name) > 12){
                     	$cat_name = '<span style="cursor:pointer" title="'.$cat_name.'">'.substr(trim($cat_name),0,10).'...</span>';
                    }else{
                    	$cat_name = $cat_name;
                    }
                    echo $cat_name;

                    } 
					?></p>

                </div>
                
                
                
                <div class="btn_sec" style="margin:5px 0;">
                <span><a href="javascript:;" style="margin-right:2px" class="blue_but1 view_open" onclick="openDialog(<?php echo $details['id'];?>)">VIEW</a></span>
                
                <?php if($details['is_pitchited'] == '1') {?>
                
                <span class="p_icon" style="margin-right:2px; cursor:pointer;"><img src="<?=base_url()?>images/icon033.png" alt="" onclick="pitched_message();" /></span>
                
                <?php } else {?>
               
                <span><a style="margin-right:0px" href="javascript:void(0);" class="pitchit_pop_icon1" onclick="openDialogPitchit(<?php echo $details['id'];?>)"><img src="<?php echo base_url()?>/images/icon_p.png" id="img_grn_<?php echo $details['id'];?>" /></a></span> 
               
                <?php } ?>
                
                <span><a style="margin-right:0px" href="<?=base_url()?>work/editWork/<?=$details['id']?>" class="green_bg1">EDIT</a></span>
                
                <div class="clr"></div>
                
                </div>
                
                
                </div>
                <div class="clear"></div>
                
                
                </div>
                <?php } } else {?>
                
                <span>No result found</span> 
                   
                   
                 <?php } ?>   
                    <!--<div class="item">
                    <div class="item_left_section"><img src="<?//= base_url()?>images/cover_img01.jpg" alt="" /></div>
                    <div class="item_right_section">
                    <p>Author: Pete Smith<br>
                    Format: Non-Fiction<br>
                    Genre:  Childrens</p>
                    <a href="#" class="blue_but">VIEW</a><a href="#" class="green_bg">DELETE</a>
                    </div>
                    </div>-->
              
              </div>
                </div>
          
        </div>
        
        <div class="clear"></div>
        
        <div class="pit_work_dialog_lat_first_mywork popup_chng" style="display: none; width: 904px !important;" id="pit_work_dialog">
                  
                 
                <h4 id="title"></h4>

                <p ><span id="tags"><span><br>
                <span id="review"></span>
                </p>
                
                <div class="hide_sec">
                <h4>Synopsis</h4>
                
                <p id="synopsis"></p>
                
                <h4>Excerpt</h4>
                
                <p id="excerpt"></p>
                </div>
                                  
                <?php /* <a href="#" class="pitchit_pop_icon"><img src="<?php echo base_url()?>/images/icon_p.png"></a>  
                <a href="#" class="think_pop_icon"><img src="<?php echo base_url()?>/images/think.png"></a> 
                <a  class="green_but" href="#bookshelf_add_1" rel="facebox">Add to Bookshelf</a> */?>
                <a href="javascript:void(0);" id="cancl_pit" class="green_but">Close</a>
                    
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
        //$(".pit_work_dialog").hide();
         return;       
        }
        else{             
          $("#content").find("[id^='tab']").hide(); // Hide all content
          $("#tabs li").attr("id",""); //Reset id's
          $(this).parent().attr("id","current"); // Activate this
          $('#' + $(this).attr('name')).fadeIn(); // Show content for the current tab
          $(".pit_work_dialog").hide();
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
    
    
    
    $("#owl-demo2").owlCarousel({
        navigation : true,
		itemsDesktop:[$(document).width(), 4]
      });
     
    
});

function openDialog(id)
 {
 	$.ajax({
               url      : '<?=base_url()?>'+'bookshelves/show_book_detail_for_author',
               type     : 'POST',
               data     : { 'id': id },
               success  : function(resp){
               	   $("#title").html(resp.workdetails_test.title_text)
               	   $("#excerpt").html(resp.workdetails_test.extract)
               	   $("#synopsis").html(resp.workdetails_test.synopsis)
               	   $("#review").html(resp.workdetails_test.self_published_text);
                   
                   $("#wid").val(id);
                   
                   /*$(".pit_work_dialog_lat_first_mywork").dialog({
        			close: function () {
        			    
        			}
        		    });*/
                   
                   $(".pit_work_dialog_lat_first_mywork").css('display','block'); 
                    
               },
               error    : function(resp){
                    $.prompt("Sorry, something isn't working right.", {title:'Error'});
               }
        });
 	
 }
 
 $(document).ready(function () {
	
	    $('#cancl_pit').click(function () {
                       
                            //$(".pit_work_dialog_lat_first_mywork").dialog('close');
                            $(".pit_work_dialog_lat_first_mywork").css('display','none');
                           
                        
             });
        $('#cancl_work_pit').click(function () {
                       
                            $(".pit_work_dialog_lat_first_mywork_pit").dialog('close');
                           
                        
             });     
    
   });
   
  function openDialogPitchit(id)
 {
    
     //var pit_open = $("#pit_open").val();
    
    
    
     $("#work_pit").val(id);
      
      $("#success_pit_suc").css('display','none');
      $("#success_pit_suc").html('');
      $("#success_pit_err").css('display','none');
      $("#success_pit_err").html('');
      $('#desc').val(''); 
      $('#cout').val('140'); 
      //$('#cate_gory_hid').val(''); 
      
      
      //$("#cate_gory_hid option[value='']").attr('selected', false);
      //document.getElementById('cate_gory_hid').selectedIndex = -1;
                 
     $(".pit_work_dialog_lat_first_mywork_pit").dialog();
     $('.chosen-select').chosen(); 
     
     $('#cate_gory_hid').attr('data-placeholder','Choose a publisher...'); 
      $('#cate_gory_hid').val('').trigger('chosen:updated');
      
      
     //setTimeout($('.pit_work_dialog_lat_first_mywork_pit').dialog('close'), 10000);       
 	/*setTimeout(function(){
    $(".pit_work_dialog_lat_first_mywork_pit").dialog('close');
    }, 10000);*/
 } 
 
function limitText(limitField, limitCount, limitNum) {
    
	if (limitField.value.length > limitNum) {
		limitField.value = limitField.value.substring(0, limitNum);
	} else {
		limitCount.value = limitNum - limitField.value.length;
	}
} 
   
 function create_pitchit()
   {
    //alert(pit);
        var id = $("#work_pit").val();
        var desc = $('#desc').val();
        var cate_gory_hid = $('#cate_gory_hid').val();
        
        //var pit_open = $("#pit_open").val();
        //alert(cate_gory_hid);
        
         $.ajax({
           url      : '<?=base_url()?>'+'home/doCreatePitchit',
           type     : 'POST',
           data     : { 'id':id ,'desc':desc ,'cate_gory_hid':cate_gory_hid },
           success  : function(resp){
           		//$("#pit_work_dialog header").css('display','none');
           		$("#pit_work_dialog form").css('display','none');
           		$("#show_create_msg").css('display','block');
           		//return false;
           		setTimeout( function(){ 
				    if(resp == 1)
                    {  
                        $("#success_pit_suc").css('display','block');
                        $("#success_pit_suc").html('Succesfully Pitchited!');
                        $("#img_grn_"+id).attr('src','<?=base_url()?>images/icon033.png');
                        $("#pit_open").val(0);
                        $(".pit_work_dialog_lat_first_mywork_pit").dialog('close');
                        $("#show_create_msg").css('display','none');
                    }
                    else
                    {
                        $("#success_pit_err").css('display','block');
                        $("#success_pit_err").html('Pitchit! Fail');
                    }
				  }
				 , 3000 );
           		
           },
           error    : function(resp){
                $.prompt("Sorry, something isn't working right.", {title:'Error'});
           }
          });
          
       }
   function save_pitchit()
   {
    //alert(pit);
        var id = $("#work_pit").val();
        var desc = $('#desc').val();
        var cate_gory_hid = $('#cate_gory_hid').val();
        
        //alert(cate_gory_hid);
        
         $.ajax({
           url      : '<?=base_url()?>'+'home/doSavePitchit',
           type     : 'POST',
           data     : { 'id':id ,'desc':desc ,'cate_gory_hid':cate_gory_hid },
           success  : function(resp){
                
                //alert(resp);
                var res = resp.split("~");
                    if(res[0] == 1)
                    {  
                        
                        $("#success_pit_suc").css('display','block');
                        $("#success_pit_suc").html('Succesfully Saved Pitchit!');
                        $("#pit_saved").text(res[1]);
                        $("#img_grn_"+id).attr('src','<?=base_url()?>images/icon033.png');
                        $(".pit_work_dialog_lat_first_mywork_pit").dialog('close');
                        //window.location.href = '#pit_saved';
                        window.location.href = '<?=base_url()?>home/author';
                    }
                    else
                    {
                        $("#success_pit_err").css('display','block');
                        $("#success_pit_err").html('Save Fail');
                    } 
           },
           error    : function(resp){
                $.prompt("Sorry, something isn't working right.", {title:'Error'});
           }
          }); 
       }


function pitched_message()
{
	alert("This title has already been pitched!!!");
	//return false;
}  

function ajaxLatestPitchit(page)
{
    $.ajax({
		url      : '<?=base_url()?>'+'home/ajax_latest_pitchit_search_author',
		type     : 'POST',
		data     : { 'page_latest': page, 'limit_latest' : 6},
		beforeSend: function() {
        	$(".loader_file").show();
    	},
       success  : function(resp){
        //alert(resp);
            if(resp != '0'){
            	$(".loader_file").hide();
                $("#tab1").html(resp);
            }
            //$("#content").unblock();
       },
       error    : function(resp){
        //$("#content").unblock();
            $.prompt("Sorry, something isn't working right.", {title:'Error'});
       }
    });
        
} 

function ajaxSavedPitchit(page_saved)
{
    $.ajax({
       url      : '<?=base_url()?>'+'pitchit_search/ajax_saved_pitchit_search_author',
       type     : 'POST',
       data     : { 'page_saved': page_saved, 'limit_saved' : 6},
       beforeSend: function() {
        	$(".loader_file").show();
       },
       success  : function(resp){
        //alert(resp);
            if(resp != '0'){
                $("#tab2").html(resp);
                $(".loader_file").hide();
            }
            //$("#content_part").unblock();
       },
       error    : function(resp){
        //$("#content_part").unblock();
        	$(".loader_file").hide();
            $.prompt("Sorry, something isn't working right.", {title:'Error'});
       }
    });
        
}   

function ajaxViewallPitchit(page)
{
    $.ajax({
       url      : '<?=base_url()?>'+'home/ajax_viewall_pitchit_search_author',
       type     : 'POST',
       data     : { 'page_latest': page, 'limit_latest' : 6},
       beforeSend: function() {
        	$(".loader_file").show();
       },
       success  : function(resp){
        //alert(resp);
            if(resp != '0'){
                $("#tab3").html(resp);
                $(".loader_file").hide();
            }
            //$("#content_part").unblock();
       },
       error    : function(resp){
        //$("#content_part").unblock();
        	$(".loader_file").hide();
            $.prompt("Sorry, something isn't working right.", {title:'Error'});
       }
    });
        
} 

function ajaxTotalviewedPitchit(page)
{
    $.ajax({
       url      : '<?=base_url()?>'+'home/ajax_totalviewed_pitchit_search_author',
       type     : 'POST',
       data     : { 'page': page, 'limit' : 6},
       beforeSend: function() {
        	$(".loader_file").show();
       },
       success  : function(resp){
        //alert(resp);
            if(resp != '0'){
                $("#tab4").html(resp);
                $(".loader_file").hide();
            }
            //$("#content_part").unblock();
       },
       error    : function(resp){
        //$("#content_part").unblock();
        	$(".loader_file").hide();
            $.prompt("Sorry, something isn't working right.", {title:'Error'});
       }
    });
        
} 

function ajaxSavedPitchit(page_saved)
{
    $.ajax({
       url      : '<?=base_url()?>'+'pitchit_search/ajax_saved_pitchit_search_author',
       type     : 'POST',
       data     : { 'page_saved': page_saved, 'limit_saved' : 6},
       beforeSend: function() {
        	$(".loader_file").show();
       },
       success  : function(resp){
        //alert(resp);
            if(resp != '0'){
                $("#tab2").html(resp);
                $(".loader_file").hide();
            }
            //$("#content_part").unblock();
       },
       error    : function(resp){
        //$("#content_part").unblock();
        	$(".loader_file").hide();
            $.prompt("Sorry, something isn't working right.", {title:'Error'});
       }
    });
        
} 


</script>
      
<script src="<?=base_url()?>ckeditor/ckeditor.js"></script>      
      
<?=$this->load->view('template/inner_footer_dashboard.php')?>       
