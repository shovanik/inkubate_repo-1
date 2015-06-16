<?=$this->load->view('template/inner_header_dashboard.php');
$usd = $this->session->userdata('logged_user'); 
$jsArray = array();
foreach($user_notification_total as $notification) {
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
//echo $total_writer['count'];
//echo $writer_female_percent['count'];
//echo $writer_male_percent['count'];
//echo '<pre/>';print_r($pitchit_details);die;
?>
<script type="text/javascript" src="<?= base_url()?>js/jquery-ui.min.js"></script>
<script>
var base_url = '<?php echo base_url()?>';
$(document).ready(function() {
setTimeout(function() {
   $("#invite_msg_suc").html('');
   $( "#invite_msg_suc" ).removeClass( "invite_msg_success" );
   //$("#content_part").unblock();
   
      
}, 5000);
});

$(document).ready(function(){
    
    //$("#content_part").block();
    $('.demo1').css('position','relative');
    $('.demo1').css('overflow','hidden');
    //alert('hi');
    
}) 

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

   
   
 $('.demo1').easyTicker({
        direction: 'up',
        speed: 'slow',
        interval: 3000,
        mousePause: 1
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

    /*$('#feeds_pop').click(function () {
        $("#feeds_list").dialog({
            close: function () {
            }
        });
    }); */

   /* $('#cancl_pop').click(function () {
        $("#feeds_list").dialog('close');
    }); */
    
    $('#feeds_pop').click(function () {
        
     $.ajax({
        url: '<?=base_url()?>'+'feeds/feedurl_popup',
        
         beforeSend: function() {
        	$(".feed_loader_file").show();
        },
        
        success: function(data) {
            //alert(data);
          $("#feeds_list").load($.parseHTML(data)).dialog({modal:true}).dialog('open');
          $("#feeds_list").html(data);
          $('a[rel*=facebox]').facebox();
          $(".feed_loader_file").hide();
        }
      });
 
  });

});
</script>
<!-- this portion is for feeds popup-->

<style>
.box_align {margin: 0;}
.pitchits_section_new .pitchits_section_right { border: none; }
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

 .pitchits_section_new .pitchits_section_right { width: 734px; height: 100%; position: relative;}

.pitchits_section_left { width: 230px;}
#facebox .content { max-height: 110px; }

 #facebox .content input[type="button"] {float: right; background: #8dc63f; border: none; color:#fff; margin:3px 0 0 0; }
</style>

<style>

.bl_p span {top:0;}
.bl_p img {margin:0 5px 0 0;}
.date_sec {float:right; font-size:12px;}

.img_sz_small {
    border-radius: 50%;
    height: 32px;
    width: 32px;
}
.see_box a {color:#000;}
.see_box span { color:#7e7e7e;}
.see_box p { width:85%;}

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
    left: 76px !important;
}
.bottom_text4
{
    left: 141px !important;
}
.work_section .table_new tbody td {height:60px !important;} 

#feeds_list h3 { padding-bottom: 10px; font-size: 18px;}
#feeds_list {padding-top: 15px;}
#feeds_list input {vertical-align: middle; padding-right:5px; cursor: pointer;}

.top_welcome_section_right111 {
    float: right;
    padding-right: 11px;
    padding-top: 9px;
}
.invite_msg_success{ padding:10px 13px 0 27px; margin:24px 0 0 0; border-radius:10px; color:#fff; background:url(../images/img_1.png) no-repeat; position: absolute; right:9px; font-size:12px; width:198px; height:48px; z-index:10;}
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
               		
                    //alert(resp);
		
		$("#suc_msg").html('');
		$("#title").show();
		$("#tags").show();
		$("#review").show();
		$(".hide_sec").show();
		$(".pitchit_pop_icon").show();
		$(".think_pop_icon").show();
		$("#download").show();
		$("#ab").show();
		$("#savetitle").show()
           
               //$("#pit_work_dialog").css('display', "block");
               	   $("#title").html(resp.workdetails_test.title_text)
               	   $("#excerpt").html(resp.workdetails_test.extract)
               	   $("#synopsis").html(resp.workdetails_test.synopsis)
               	   $("#review").html(resp.workdetails_test.self_published_text);
               	   $("#tags").html(resp.workdetails_test.tag_text);
                   
                   $("#wid").val(id);
                   $("#titleval").val(id);
                   
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
                    //$("#download").html('<a href="<?//=base_url()?>discovery/download/'+id+'/'+resp.workdetails_test.file_asset_id+'/'+resp.workdetails_test.user_id+'/'+resp.workdetails_test.work_file+'">'+resp.workdetails_test.work_file+'</a>');
                    
                    $("#download").html('<a class="" href="<?=base_url()?>discovery/download/'+id+'/'+resp.workdetails_test.file_asset_id+'/'+resp.workdetails_test.user_id+'/'+resp.workdetails_test.work_file+'">Download Title</a>');
                    
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
                $('.pit_work_dialog_vw').show();
                $('.pit_work_dialog').hide();   
               },
               error    : function(resp){
                    $.prompt("Sorry, something isn't working right.", {title:'Error'});
               }
        });
 	
 }
 
 
  function savetitle()
 {
    //alert($("#titleval").val());
    $("#title_saved").css('display','block');
    var wid = $("#titleval").val();
    $.ajax({
               url      : '<?=base_url()?>'+'bookshelves/saveTitle',
               type     : 'POST',
               data     : { 'id': wid },
               success  : function(resp){
               	
		$("#title").css('display','none');
		$("#tags").css('display','none');
		$("#review").css('display','none');
		$(".hide_sec").css('display','none');
		$(".pitchit_pop_icon").css('display','none');
		$(".think_pop_icon").css('display','none');
		$("#download").css('display','none');
		$("#ab").css('display','none');
		$("#savetitle").css('display','none');
		
		 //#title #tags #review .hide_sec .pitchit_pop_icon .think_pop_icon #download #ab #savetitle
               if(resp == 1)
                   { 
			$("#suc_msg").html('<font color="green">Successfully saved the title</font>');
			
                   }
               else
                   {
		        $("#suc_msg").html('<font color="green">Already saved this title</font>');
		    
                   }    
               
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
 
 /*function feedurl_status(id)
 {
    $.ajax({
        url      : '<?//=base_url()?>'+'feeds/feedurl_status',
        type     : 'POST',
        data     : { 'id': id },
        success  : function(resp){
            if(resp == '1'){
                location.reload();
            }
        },
        error    : function(resp){
            alert("Sorry, something isn't working right.");
        }
    });
 }
*/

$(document).on('click' , '#cancl_pop' , function () {
       
        $('.ui-dialog').filter(function () {
            return $(this).css("display") === "block";
            }).find('.ui-dialog-content').dialog('close');
    });
        
  
    
    $(document).on('click' , '#cancl_pop_2' , function () {
        //console.log("clicked");
        //var dialog = this;
        //$(document).on('click' , '#feeds_list' , function () {
            //$(dialog).dialog('close');
        //});
        $('.ui-dialog').filter(function () {
            return $(this).css("display") === "block";
            }).find('.ui-dialog-content').dialog('close');
    }); 
 function feedurl_status(id)
 {
   
   $('#feed_url_id').attr('data-fruit',id);
   //alert(id);
 }
 
 function feed_url_id()
 {
    var id = $('#feed_url_id').attr("data-fruit");
   // alert(id); 
    $.ajax({
        url      : '<?=base_url()?>'+'feeds/feedurl_status_publisher',
        type     : 'POST',
        data     : { 'id': id },
        
         beforeSend: function() {
        	$(".feed_loader_file").show();
        },
        
        success  : function(resp){
            if(resp != '0'){
                //alert(resp);
                //location.reload();
                $(".feed_loader_file").hide();
                $('.demo1').easyTicker();
                $('#total_news_feed').html(resp);
               
               
            }
        },
        error    : function(resp){
            alert("Sorry, something isn't working right.");
        }
    });
 }
 
 
 
 function update_profile()
{
    window.location.href = '<?=base_url()?>profile/editProfile/<?php echo $usd['id'];?>';
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

function feedurl_delete(id)
 {
    if(confirm('Are you sure to delete this Feed?'))
      {
        $.ajax({
            url      : '<?=base_url()?>'+'feeds/feedurl_delete',
            type     : 'POST',
            data     : { 'id': id },
            success  : function(resp){
                if(resp == '1'){
                    location.reload();
                }
            },
            error    : function(resp){
                alert("Sorry, something isn't working right.");
            }
        });
      }
     else
     {
        return false;
     }   
 }
</script>
<script src="<?=base_url();?>js/publisher_dashboard.js" type="text/javascript"></script>

        
            <div class="content_part">
             
                <div class="mid_content index_sec">
              
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

          <!--<li style="visibility:hidden"><a href="#" class="green_icon hidetext2"></a><span class="green">02</span></li>-->
          <li><a href="javascript:void(0);" class="pink_icon hidetext3 tip_trigger1" id="notify" title="Click to view Inkubate messages">
	  <!-- <span class="tip1" id="msg_id">Click to view Inkubate messages</span> --></a>
	    <span class="pink" id="cnt"><?php echo count($user_notification_count)?></span></li>
          
          
          <li><a href="javascript:void(0);" class="orange_icon hidetext4 tip_trigger2" id="pitchit" title="Click to view PitchIt! messages">
            <!-- <span class="tip2" id="pit_id">Click to view PitchIt! messages</span> -->
          </a><span class="orange" id="pitcnt"><?php echo $pitchit_count['count'];?></span></li>
          
          
        </ul>
        
        <div class="bottom_text5" style="display:none;">
             
        </div>
        
        <div class="bottom_text2" style="display:none;">
          <div class="arror_top"><img src="<?=base_url()?>images/arror_top.png" alt="" /></div>
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
		    <input type="hidden" name="register_type" value="<?php echo $this->uri->segment(2); ?>" />
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
        
        
        <!-- ----------Start Notification----------- -->
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
                  <span>
                  
                  <?php
                  if(!empty($notification['created']))
                    {
                    $date = $notification['created'];
                    $timestamp = strtotime($date);
                    $new_date = date("m/d/y", $timestamp);
                    echo $new_date;
                   
                    }
                    else
                    {
                      echo 'N/A';  
                    }
                  ?>
                  
                  </span></h5>
                  <p><a href="<?=base_url()?>mail/details/<?php echo $notification['id']?>"><strong>Message:</strong> <span><?php echo $notification['subject']?></span></a></p>
                </div>
                <div class="clear"></div>
              </div>
              
              <?php } } else {?>
              
              <p style="margin: 6px 0 0 10px;">No new messages</p>
              
              <?php } ?>
              
              <div class="clear"></div>
              <div class="see_all"><a href="<?=base_url()?>home/inbox">See All</a></div>
            </div>
            
            <!-- ----------End Notification----------- -->
            
         <!-- ----------Start Pitchit----------- -->
            
            <div class="bottom_text4" style="display:none;">
              <div class="arror_top"><img src="<?=base_url()?>images/arror_top.png" alt="" /></div>
              <p class="heading">New (<?php echo count($pitchit_details_limit)?>)</p>
              <span style="float: right; margin-top: -31px; margin-right: 7px; cursor: pointer;" id="cross2"><img src="<?=base_url()?>images/close_22.png" alt="" /></span>
              
               <?php 
              
            if(!empty($pitchit_details_limit))
            {
              
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
               
               <?php 
               if(isset($pit_details['is_pitchit'])) {
               if($pit_details['is_pitchit'] == '1') { ?>
               
               <a href="<?=base_url()?>mail/details/<?=$pit_details['id']?>/1" class="noty_txt"><strong>Message:</strong> <span><?=$pit_details['subject']?></span></a>
               <?php } } else { ?>
               
               <a href="<?=base_url()?>mail/details/<?=$pit_details['id']?>/2" class="noty_txt"><strong>Message:</strong> <span><?=$pit_details['subject']?></span></a>
               
               <?php } ?>
               
               <br />
               <span style="margin-bottom:10px;">
               From :<b> <?php echo $pit_details['first'].' '.$pit_details['middle'].' '.$pit_details['last']?></b></span>
               </p>
               
                <div class="clear"></div>
              </div>
              
              <?php } } else {?>
              
              <p class="heading">There are no Pitchit! Message.</p>
              
              <?php } ?>
              
              <div class="clear"></div>
              <div class="see_all"><a href="<?=base_url()?>home/pitchits_inbox">See All</a></div>
            </div>
            
            <!-- ----------End Pitchit----------- -->   
        
      </div>
      <div class="top_welcome_section_right111">
      
      <span style="float:left; margin-right:7px;">
      
                 
                <?php if(!empty($user_photo['filename']) && file_exists("uploadImage/".$usd['id']."/profile/".$user_photo['filename'])) {?>
                <img src="<?=base_url()?>uploadImage/<?=$usd['id']?>/profile/<?=$user_photo['filename']?>" class="img_sz"/>
                
          <?php } elseif(!empty($latest_portrait['filename']) && file_exists("_assets/".strtolower($latest_portrait['user_guid'])."/".strtolower($latest_portrait['asset_guid']).".".$photo_extn)) { ?>
            <img src="<?=base_url()?>_assets/<?=strtolower($latest_portrait['user_guid'])?>/<?=strtolower($latest_portrait['asset_guid']).'.'.$photo_extn?>" class="img_sz"/>
          
          <?php } elseif($user_contact['social_source'] == 'twitter') { ?>
                        <img src="<?=$user_contact['social_image'];?>" style="border: 1px solid #444;" class="img_sz"/>
          
          <?php } elseif($user_contact['social_source'] == 'linkedin') { ?>
                        <img src="<?=$user_contact['social_image'];?>" style="border: 1px solid #444;" class="img_sz"/>
                        
          <?php } elseif($user_contact['social_source'] == 'facebook') { ?>
                        <img src="https://graph.facebook.com/<?=$user_contact['social_image'];?>/picture?type=large" style="border: 1px solid #444;" class="img_sz"/>
                <?php } elseif($user_contact['social_source'] == 'googleplus') { ?>
                    <img src="<?=$user_contact['social_image'];?>" style="border: 1px solid #444;" class="img_sz"/>                  
          
          <?php } elseif($user_contact['gender'] == "1") { ?>
                        <img src="<?=base_url()?>images/man_large.jpg" style="border: 1px solid #444;" class="img_sz"/>
                        
            <?php } elseif($user_contact['gender'] == "2") { ?>
                        <img src="<?=base_url()?>images/woman_large.jpg" style="border: 1px solid #444;" class="img_sz"/>            
          
                    <?php }else{?>
                        <img src="<?=base_url()?>images/ico_publishers1.png" style="border: 1px solid #444;" class="img_sz"/>
          <?php }?> 
                 
                 
      </span>
      
         <p style="font-size:12px; float:left;">Welcome<span class="prsn_con" style="padding-left:0 !important;">
            <?php if(!empty($user_contact['name_first'])) { $firstname = $user_contact['name_first']." "; } else { $firstname = '';} ?>
            <?php if(!empty($user_contact['name_middle'])) { $middlename = $user_contact['name_middle']." "; } else { $middlename = '';} ?>
            <?php if(!empty($user_contact['name_last'])) { $lastname = $user_contact['name_last']; } else { $lastname = '';} ?>
            
            <?php $fullname = $firstname.' '.$middlename.' '.$lastname;
               //echo strlen($fullname);
                if(strlen($fullname) > 15)
                 {
                    ?>
                 <a class="tooltips" href="javascript:void(0)" title="<?php echo $fullname; ?>">
            
              <?php echo substr($fullname,0,15).'..'; ?>
            
            <!-- <span class="tp_span9"><?php echo $fullname;?></span> -->
            
            </a>   
                  
                   
               <?php    
                 }
                 else
                 {
                   echo $fullname; 
                 }
            ?>
            
            
            
            </span><br />
              <span class="prsn_con" style="padding-left:0 !important;">Member since 
              <?php $date_crd = $usd['created'];
                        $timestamp_crd = strtotime($date_crd);
                        $new_date_crd = date("m/d/y", $timestamp_crd);
                        echo $new_date_crd;
                        ?>
                        </span><br />
              <span class="prsn_con" style="padding-left:0;}">Profile is <?php echo $val*10;?>% complete</span>
              
              <br />
               <button class="upld_butt3" style="background-color:#2e75b6; margin-top:0px;" onclick="update_profile()">Update Profile</button>
                 
             </p>
             <div class="clear"></div>  
      </div>
    </div>
                    
                    
    <div class="dasbord_news_section"> 
        <div class="dasbord_news_section_left_new">
        <div class="feed_loader_file"></div>
            <h1><img src="<?=base_url()?>images/heading_icon.png" alt="" />Dashboard News 
                <span id="feeds_pop" style="cursor: pointer;"><img src="<?=base_url()?>images/pro_edit.png" alt="" /></span></h1>
                
                <div id="total_news_feed">
                
                <div style="display: none;" id="feeds_list">
             
                    
                </div>
                
                 <div id="info_feed" style="display:none;">
                <div class="pop_new">
                 <h2>Add a Feed URL</h2>
                 <?php
                   $frmAttrs   = array("id"=>'folderFrm',"class"=>'form-horizontal','onsubmit' => 'return folderValdate();');
                   echo form_open('feeds/feed_add_author', $frmAttrs);
                 ?>
                 
                 <label class="rss_feed">RSS Feed:</label>
                 <input name="feeds_url" id="feeds_url" class="folder_create_name" type="text" placeholder="add only .xml file" />
                 <div class="folder_create_error" style="color:red"></div>
                 <div class="clear"></div>
                 <input type="hidden" class="form-control" id="user_id" name="user_id" value="<?=$usd['id']?>" />
                 <input name="button" type="submit" value="Add" />
                 </form> 
                 </div>
              </div>
          
        <div class="blue_back_new3" id="content_part"><!--<img src="<?=base_url()?>images/cup_icon.jpg" alt="" />Our Literary Blockbuster Challenge is now complete and our distinguished team of judges has selected the winners.-->
        <?php 
            //echo "<pre/>".print_r( $pitchit_details);
            
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
                                
                           if($i % 4 == 0)
                           {
                            $val22  = $pitchit_details;
                             
                            //echo $val22[$j]['pit_id'];
                            $pitch_inbox = "";
                            if(!empty($val22[$j]['pit_id']))
                            {
                                $pitch_inbox = $this->mpitchit->get_pitch_inbox($val22[$j]['pit_id']);
                               
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
                            
                            if(!empty($val22[$j]))
                            {
                            //print_r($val22);
                            ?>
                            
                             <li>
                    <label style="cursor: pointer;" onclick="pit_work_latpit_first(<?=$val22[$j]['pit_id']?>)">
                    <a href="<?=$pit_url?>">
                        <span class="black_t" ><img src="<?=base_url()?>images/pitchies_icon_das.png" alt="" /></span>
                     </a>   
                        <!--<p class="black_t"><?//= (strlen($feeds_row['pitchit']) > 78) ? substr($feeds_row['pitchit'], 0,78)."..." : $feeds_row['pitchit']; ?></p>-->
                        <a href="<?=$pit_url?>">
                        <p id="news_pit">
                        <span>Pitchit!:<br /><!--<small>abcde</small>--></span>&nbsp;&nbsp;&nbsp;
                        <strong>
                        from <?=$val22[$j]['first'].' '.$val22[$j]['middle'].' '.$val22[$j]['last']?> on <?= date("m/d/Y", strtotime($val22[$j]['created_date'])); ?></strong><br />
                        <?= (strlen($val22[$j]['pitchit']) > 78) ? substr(ucfirst($val22[$j]['pitchit']), 0,78)."..." : ucfirst($val22[$j]['pitchit']); ?>
                        
                        </p>
                       </a> 
                       </label> 
                        <div class="clear"></div>
                     
                    </li>
                            
                           <?php  
                            //echo $val22[$j];
                            $j++;
                            
                             } } else {
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
                        <?php  } } $i++; }} } else { ?>
                        
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
                        <?= (strlen($feeds_row['pitchit']) > 78) ? substr(ucfirst($feeds_row['pitchit']), 0,78)."..." : ucfirst($feeds_row['pitchit']); ?>
                        
                        </p>
                        </a>
                        
                        <div class="clear"></div>
                    </li>
                        
                        <?php } } ?>
                   
                </ul>
                        
            </div>
        
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
              <li id="current" class="hov_col"><a href="javascript:void(0)" name="tab1" onClick="getPitchit('1', 'tab1', 'pitchit')">Latest PitchIts!</a></li>
              <li  id="current2" class="hov_col"><a href="javascript:void(0)" name="tab2" onClick="getPitchit('1', 'tab2', 'pitchit')">Saved PitchIts!  <span><?=count($userSavedPitchitCount);?></span></a></li>
              <li id="current3" class="hov_col"><a href="javascript:void(0)" name="tab3" onClick="getPitchit('1', 'tab3', 'pitchit')">View All PitchIts! <span><?=count($userViewallPitchitCount);?>
              
              </span></a></li>
              <li id="current4" class="hov_col"><a href="javascript:void(0)" name="tab4" onClick="getPitchit('1', 'tab4', 'pitchit')">PitchIt! Responses<span>
              <?php //if(!empty($pitchit_details_limit_original)) { echo count($pitchit_details_limit_original); } else { echo '0'; } ?>
              <?php if(!empty($pitchit_resp_cnt['count'])) { echo $pitchit_resp_cnt['count']; } else { echo '0'; } ?>
              </span></a></li>
              <li id="current5" class="hov_col"><a href="javascript:void(0)" name="tab5" onClick="getPitchit('1', 'tab5', 'pitchit')">Total Viewed PitchIts! <span><?=count($totalViewPitchitCount);?></span></a></li>
             
            </ul>
          </div>
          <div class="pitchits_section_right" id="content">
          <div class="loader_file"></div>
          	<div style="display: block;" id="tab1">
               <?php echo $this->load->view('ajax_search/ajax_latest_pitchit_search.php')?>
            </div>
            <div style="display: none;" id="tab2"></div>
            <div style="display: none;" id="tab3"> </div>
            <div style="display: none;" id="tab4"></div>
            <div style="display: none;" id="tab5"></div>



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
    
    <!-- --------------pitchit Section----------------------------- -->
    
    <div class="pitchits_section"> 
    <div class="pitchits_left_main">
    <!-- <div class="publishers_section_left"> 
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
      </div> -->
      
      
      <div class="publishers_section_left box_align"> 
      
        
   <!----------------New Pie chart------------------>
   
   
    <h1 class="for_mobile"><img src="<?=base_url()?>images/cercel_icon_hand.png" alt="" />What's Happening!<span>
          <!--<a href="#" class="button_pro">View Detail</a>--></span></h1>
            <div class="clear"></div>
            <div class="publishers_section_left_pad">
              <ul >
                <li class="pad_right"><img src="<?=base_url()?>images/female.png" alt="" /> 
                <?php $male = ($writer_female_percent['count'] * 100)/$total_writer['count'];
                //echo $m = sprintf ("%.2f", $male);
                echo round($male,1);
               // echo $male;
                ?>% Female Writers</li>
                <li><img src="<?=base_url()?>images/male.png" alt="" /> 
                <?php $female = ($writer_male_percent['count'] * 100)/$total_writer['count'];
                //echo $f = sprintf ("%.2f", $female);
                echo round($female,1);
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
                
                <div class="myclick_para" title="The Most Recent Titles Submitted by Writers"><div class="myclick_span"><?php echo $total_rows['count']; ?></div>
                  Recent Titles</div>
                
                </a>
                <a href="#" class="aps_but"  name="tab_dem1">View List</a>
              </div>
              <div class="box_section">
                <div class="icon_section"><img src="<?=base_url()?>images/rou_02.png" alt="" /></div>
                <!--<a class="tooltips" href="<?//=base_url()?>discovery/view_profile_details" >-->
                <a class="tooltips" href="javascript:void(0)" name="tab_dem2" onClick="getPitchit('1', 'tab_dem2', 'whats')">
                
                <div class="myclick_para" title="Popular Writer Profiles Viewed by Other AEPs"><div class="myclick_span" ><?=$author_view_cnt['count']?></div>
                  Top 10 Profile Views</div>
                
                </a>      
                 <a href="#" class="aps_but" name="tab_dem2" onClick="getPitchit('1', 'tab_dem2', 'whats')">View List</a>          
                
              </div>
              <div class="clear"></div>
              <div class="box_section box_section_mar_right30">
                <div class="icon_section"><img src="<?=base_url()?>images/rou_03.png" alt="" /></div>
                <a class="tooltips" href="javascript:void(0)" name="tab_dem3" onClick="getPitchit('1', 'tab_dem3', 'whats')">
                
                <div class="myclick_para" title="Popular Writer Titles Downloaded by Other AEPs"><div class="myclick_span" ><?=$user_download_details_cnt['count']?></div>
                  Top 10 Title Downloads</div>
                
                </a>
                 <a href="#" class="aps_but" name="tab_dem3" onClick="getPitchit('1', 'tab_dem3', 'whats')">View List</a>
              </div>
              <div class="box_section">
                <div class="icon_section"><img src="<?=base_url()?>images/rou_04.png" alt="" /></div>
                
                <!--<a class="tooltips" href="<?=base_url()?>discovery/view_bookshelf_profile_details" >-->
                <a class="tooltips" href="javascript:void(0)" name="tab_dem4" onClick="getPitchit('1', 'tab_dem4', 'whats')">
                
                <div class="myclick_para" title="Recently Added Titles to Other AEP Bookshelves"><div class="myclick_span" ><?=$user_bookshelf_details_cnt['count']?></div>
                  Bookshelf Additions</div>
                
                </a>
                <a href="#" class="aps_but" name="tab_dem4" onClick="getPitchit('1', 'tab_dem4', 'whats')">View List</a>
              </div>
              <div class="clear"></div>
           
           </div>   
              
              <h3>Most Popular Submissions by Writers</h3>
              
     <?php
     //echo '<pre/>';print_r($user_popular_category_work);die;
        $i = 0;
        foreach($user_popular_search_work as $vtm)
        {
            $i = $i + $vtm['catcount'];
        }
        //echo $i;
     ?>
<script type="text/javascript">
      /*google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Percentage'],
          
          <?php /*
          foreach($user_popular_search_work as $vtm)
           {
            $catcnt = ($vtm['catcount'] * 100)/$i;
            $fcatcnt = sprintf ("%.2f", $catcnt);
          ?>
          ['<?php echo $fcatcnt."% ".$vtm['category_name'];?>',     <?php echo $fcatcnt;?>],
          
          <?php } */?>
        ]);

        var options = {
          //title: 'My Daily Activities',
          is3D: true,
          'width':400,
          'height':300
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }*/
      
      
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
        
          ["<?php echo $fcatcnt.'% '.$vtm['category_name'];?>", <?php echo $fcatcnt;?>],
          
          <?php } ?>
          
        ]);
                       
       var options = {
        is3D: true,
       'width':400,
       'height':185,
       enableInteractivity : false,
       chartArea:{left:10,top:20,width:"100%",height:300}
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
   
        
   <!-- ---------------End pie---------------------- -->     
    
        
      </div>
      </div>
      
    
      
      <div class="publishers_section_right" style="margin-top:0;" id="content_dem"> 
      <div class="whats_loader"></div>
      <div style="display: block;" id="tab_dem1">
      
      
      <!-- -------Popup dialog-------- -->
           
           <div class="pit_work_dialog_vw" style="display: none;" id="pit_work_dialog">
                  
                 <div id="suc_msg"></div>
                  <h4 id="title"></h4>

          <p ><span id="tags"><span><br><span id="review"></span></p>

          <div class="hide_sec">
            <h4>Synopsis</h4>
            <p id="synopsis"></p>
            <h4>Excerpt</h4>
            <p id="excerpt"></p>
          </div>
                            
          <span id="download"></span>
                              
                    
                    
    <a  href="#bookshelf_tt" id="ab" rel="facebox" class="ab" style=" width: 140px;">Add to Bookshelf</a>
    <a class="yellow2_but" id="savetitle" style="cursor: pointer;" onclick="savetitle()">Save Title</a>
    <input type="hidden" id="titleval" value="">
    
    <a href="javascript:void(0);" id="cancl_pit" class="green_but">Close</a>
  </div>
           
           <!-- --------End---------------- -->
      
      <!-- --------------------Add bookshelf Popup--------------------- -->      
            <div id="bookshelf_tt" style="display:none;">
            <span class="bookshelf_text"></span>
             <h2>Add to Bookshelf</h2>
             
             <div style="width: 100%;">
             <span style="float: left; padding-right: 10px;">
            <div class="styled-select">
               <select name="bkself_id" id="bkself_id"  class="select_box2" onchange="bselfid(this.value)">
                  <option value="">-----select-----</option>
                  <?php 
                  $bself_list = $this->mbookshelf->get_rest_bookshelf(1);
                  //echo '<pre/>';print_r($bself_list);die;
                  if(!empty($bself_list))
                  {
                   foreach($bself_list as $blist)
                   {
                  ?>
                  <option value="<?=$blist['id']?>"><?=$blist['name']?></option>
                  <?php } } ?>
               </select>
            </div>
              </span> 
                                      
             <span style="float: left;">
             <input type="hidden" name="aaa" id="aaa" value=""  />
             <input type="hidden" name="ggggg" id="ggggg" class="bbb" value=""  /> 
             <input type="hidden" name="wid" id="wid" value="" />
             <input name="button" class="add_bkslf" type="button" onclick="ad_bshelf()" value="Add"  />
             </span>
             <div class="clear"></div>
             </div>
            <!-- </form> -->
             
             
          
             
              </div>
              
          <!-- ----End--------------- -->    
      
      
      <?php echo $this->load->view('ajax_search/ajax_author_rcenttitle_search.php');?>
      </div>
      <div style="display: none;" id="tab_dem2"></div>
      <div style="display: none;" id="tab_dem3"></div>  
      <div style="display: none;" id="tab_dem4"></div>     
        
      </div>
      <div class="clear"></div> 
    </div>
    
   <div class="clear"></div> 
    <!-- ----------------End pitchit------------------------------- -->
                    
                    
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
    jQuery(document).ready(function($) {
      $('a[rel*=facebox]').facebox({
        loadingImage : '<?=base_url()?>images/loading.gif',
        closeImage   : '<?=base_url()?>images/closelabel.png'
      })
    })
 </script> 
 
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
          $(".pit_work_dialog").hide();
          $(".pit_work_dialog_vw").hide();
          
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
    
    
    
   	$('.ab').click(function(){
	   
       $('.bookshelf_text').text('');
	}) 
    
});



function ad_bshelf() {
		
		//var bk = $('#bkself_id :selected').val();
		//alert('===='+bk);
		var wid = $("#wid").val();
        var bkself_id = $(".bbb").val();
        //alert(wid);
        //alert(bkself_id);
		$.ajax({
			type:'POST',
			url:'<?=base_url()?>'+'bookshelves/addToBookShelvesAjax',
			data:{'bkself_id':bkself_id,'wid':wid},
			//dataType:'json',
			success:function(data){
				//alert(data);
			   if (data==1) {
				
                //$('a[rel*=facebox]').hide();
				//$("#facebox").hide();
                //$("#bookshelf_tt").hide();
                $(".bookshelf_text").text("successfully added to the Bookshelf");
                //alert(data);
			   }
			}
		});
   
	}
    
    
</script> 
                  
<script>
      function bselfid(id)
      {
        //alert(id);
        
        $('.bbb').val(id);
        
        //document.getElementById('aaa').value = id ;
                   
      }
</script>
<script src="<?=base_url()?>ckeditor/ckeditor.js"></script>
                
<?php echo $this->load->view('template/inner_footer_dashboard.php');?>             

