<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no" />
<title><?=$title?></title>
<!--style sheet-->
	<link href="<?=base_url()?>style/inner/style.css" rel="stylesheet" />
    <link href="<?=base_url()?>style/inner/fancyfields.css" rel="stylesheet" type="text/css"/>
    <link href="<?=base_url()?>style/inner/jquery.fancybox.css" rel="stylesheet" type="text/css"/>
	<link href="<?=base_url()?>style/inner/responsive.css" rel="stylesheet" />
    <link href="<?=base_url()?>style/inner/jquery.mmenu.all.css" rel="stylesheet" />
    <link href="<?=base_url()?>style/inner/facebox.css" rel="stylesheet" type="text/css"/>
    <link href="<?=base_url()?>style/inner/archer.css" rel="stylesheet" type="text/css"/>
    
<!--style sheet-->
<!--jquery_link-->
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
 <script type="text/javascript" src="<?=base_url()?>js/jquery.mmenu.min.all.js"></script>
 <script src="<?=base_url()?>js/fancyfields-1.2.min.js" type="text/javascript"></script>
 <script type="text/javascript" src="<?=base_url()?>js/jquery.reveal.js"></script>
 <script type="text/javascript" src="<?=base_url()?>js/jquery.easing.min.js"></script>
 <script type="text/javascript" src="<?=base_url()?>js/jquery.easy-ticker.js"></script>
 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript" src="<?=base_url()?>js/modal.js"></script>
<script src="<?=base_url()?>assets/scripts/lazy_load/jquery-ias.min.js" type="text/javascript"></script>


<!--jquery_link-->



<script type="text/javascript">
	$(function() {
	$('nav#menu').mmenu();
	});
</script>
<script type="text/javascript">
$(function() {
    $(window).scroll(function() {
        if($(this).scrollTop() != 0) {
            $('#top').fadeIn();  
        } else {
            $('#top').fadeOut();
        }
    });
 
    $('#top').click(function() {
        $('body,html').animate({scrollTop:0},500);
    });  
});
</script>


<script type="text/javascript">
        $(document).ready(function () {
            $(".demo").fancyfields();
            $(".customSBDemo").fancyfields({ customScrollBar: true });

            $("#demoReset").click(function () {
                $(".demo").fancyfields("reset");
                $(".customSBDemo").fancyfields("reset");
            });
        });
	</script>
    
    
    <script type="text/javascript" language="javascript">
 
   $(document).ready(function() {
 
     $(".hidetext").click(function () {
 
     $(".bottom_text").toggle("slow")
	 $(".bottom_text").css("display","block")
 
  });
  $(".folder_option").click(function () {
	  $(".fold").toggle("slow") ;
	 
  })
 
  });
 
   </script>
    
  <script type="text/javascript" language="javascript">

 
   $(document).ready(function() {
 
     $(".hidetext2").click(function () {
     $(".bottom_text2").toggle("slow");
    
     if($("#invite_id").html() == "Click to deactivate")
     {
     	$("#invite_id").html("Click to Invite Friend");
     }
     else
     {
     	$("#invite_id").html("Click to deactivate");
     }
     
     $(".bottom_text3").hide();
     $(".bottom_text4").hide();
     $(".bottom_text5").hide();
 
  });
  
  $("#cross").click(function () {
     $(".bottom_text2").toggle("slow");
     if($("#invite_id").html() == "Click to deactivate")
     {
     	$("#invite_id").html("Click to Invite Friend");
     }
     else
     {
     	$("#invite_id").html("Click to deactivate");
     }
    
  });
  
   $(".hidetext3").click(function () {
     $(".bottom_text3").toggle("slow");
     
     $("#msg_id").hide();
     $(".tip_trigger").hover(function(){
		tip = $(this).find('.tip');
		tip.hide(); //Show tooltip
	});
     //$("#msg_id").html("Click to view Inkubate messages");
     //$("#notify").removeClass('tip_trigger');
    
     //$("#msg_id").hide();
     
     /*if($("#msg_id").html() == "Click to deactivate")
     {
     	$("#msg_id").html("Click to view Inkubate messages");
     }
     else
     {
     	$("#msg_id").html("Click to deactivate");
     }*/
     
     $(".bottom_text2").hide();
     $(".bottom_text4").hide();
     $(".bottom_text5").hide();
     //alert('hi');
 
  });
  
  $("#cross1").click(function () {
     $(".bottom_text3").toggle("slow");
     
     $("#msg_id").html("Click to view Inkubate messages");
     
     /*if($("#msg_id").html() == "Click to deactivate")
     {
     	$("#msg_id").html("Click to view Inkubate messages");
     }
     else
     {
     	$("#msg_id").html("Click to deactivate");
     }*/
    
  });
  
  $(".hidetext4").click(function () {
     $(".bottom_text4").toggle("slow");
     
     $("#pit_id").hide();
     $(".tip_trigger1").hover(function(){
		tip1 = $(this).find('.tip1');
		tip1.hide(); //Show tooltip
	});
     //$("#pit_id").html("Click to view PitchIt! messages");
     
     /*if($("#pit_id").html() == "Click to deactivate")
     {
     	$("#pit_id").html("Click to view PitchIt! messages");
     }
     else
     {
     	$("#pit_id").html("Click to deactivate");
     }*/
     
     $(".bottom_text3").hide();
     $(".bottom_text2").hide();
     $(".bottom_text5").hide();
 
  });
  
 
 $("#cross2").click(function () {
     $(".bottom_text4").toggle("slow");
     
     $("#pit_id").html("Click to view PitchIt! messages");
     
     /*if($("#pit_id").html() == "Click to deactivate")
     {
     	$("#pit_id").html("Click to view PitchIt! messages");
     }
     else
     {
     	$("#pit_id").html("Click to deactivate");
     }*/
    
  });
 
  $(".hidetext5").click(function () {
     $(".bottom_text5").toggle("slow");
     
     $("#pub_id").html("Click to view PitchIt! messages");
     
     /*if($("#pub_id").html() == "Click to deactivate")
     {
     	$("#pub_id").html("Click to show publishers");
     }
     else
     {
     	$("#pub_id").html("Click to deactivate");
     }*/
     
     $(".bottom_text2").hide();
     $(".bottom_text3").hide();
     $(".bottom_text4").hide();
 
  });
  
 $("#cross3").click(function () {
     $(".bottom_text5").toggle("slow");
     
     $("#pub_id").html("Click to view PitchIt! messages");
     
     /*if($("#pub_id").html() == "Click to deactivate")
     {
     	$("#pub_id").html("Click to show publishers");
     }
     else
     {
     	$("#pub_id").html("Click to deactivate");
     }*/
    
  });  
 
  });
 
 
 
/* function ticker() {
    $('#ticker li:first').slideUp(function() {
        $(this).appendTo($('#ticker')).slideDown();
    });
}
setInterval(ticker, 3000);*/
 
 function googleplus_logout()
 {
    //gapi.auth.signOut();
    document.location.href = "https://www.google.com/accounts/Logout?continue=https://appengine.google.com/_ah/logout?continue=http://billbahadur.com/demo/inkubate/home/logout";
 }
   </script>

    
    <style>
.img_sz
{
   /* border-radius: 50%;*/
    height: 72px;
    width: 67px;
}

</style> 
     
</head>

<body>

<?php $usd = $this->session->userdata('logged_user'); ?>
<div class="main_wrapper">
  <div class="wrapper_content">
    <div class="header_section">
      <div class="top_header">
        <h1 class="logo"> <a href="#menu" class="r_menu">&nbsp;</a> 
        <a href="<?=base_url()?>home">
        <img src="<?=base_url()?>images/logo.png" class="logo_img" /> 
        </a>
        </h1>
        <ul class="top_links">
          <!--<li><a href="<?//=base_url()?>home">Home</a></li>
          <li><a href="<?//=base_url()?>home/faq">FAQ</a></li>
          <li><a href="#">Blog</a></li>-->
          <li class="l_border">
          
            <?php 
                            if($usd['social_source'] == 'googleplus')
                            {
                            ?>
                            <a href="javascript:void(0);" onclick="googleplus_logout()">Log out</a>
                            <?php } else { ?>
                            <a href="<?=base_url()?>home/logout">Log out</a>
                            <?php } ?>
                            
          </li>
          <div class="clear"></div>
        </ul>
        <div class="clear"></div>
      </div>
      <div class="clear"></div>
    </div>
    <div class="clear"></div>
    <div class="nav_section">
      <ul>
      <?php $usd = $this->session->userdata('logged_user');
      if($usd['user_type'] == '1') {
        if($this->uri->segment(2) == 'author') {?>
        <li  <?php if($this->uri->segment(2) == 'author') {?> class="active" <?php } ?>><a href="<?=base_url()?>home/author"><span <?php if($this->uri->segment(2) == 'author') {?> class="active" <?php } ?>>My Dashboard</span></a></li>
        <?php } else { ?>
        <li><a href="<?=base_url()?>home/author"><span>My Dashboard</span></a></li>
        
        <?php } } if($usd['user_type'] == '2' || $usd['user_type'] == '3' || $usd['user_type'] == '4') { 
            if($this->uri->segment(2) == 'publisher') {?> 
        <li  <?php if($this->uri->segment(2) == 'publisher') {?> class="active" <?php } ?>><a href="<?=base_url()?>home/publisher"><span <?php if($this->uri->segment(2) == 'publisher') {?> class="active" <?php } ?>>My Dashboard</span></a></li>
        <?php } else { ?>
        <li><a href="<?=base_url()?>home/publisher"><span>My Dashboard</span></a></li>
        
        <?php } } ?>
        
        <li  <?php if($this->uri->segment(1) == 'profile') {?> class="active" <?php } ?>><a href="<?=base_url()?>profile"><span  <?php if($this->uri->segment(1) == 'profile') {?> class="active" <?php } ?>>Profile</span></a></li>
        <li  <?php if($this->uri->segment(2) == 'inbox') {?> class="active" <?php } ?>><a href="<?=base_url()?>home/inbox"><span <?php if($this->uri->segment(2) == 'inbox') {?> class="active" <?php } ?>>Message Center</span></a></li>
        
        <?php 
        if($usd['user_type'] == '1') {?>
        <li <?php if($this->uri->segment(2) == 'addWork') {?> class="active" <?php } ?>><a href="<?=base_url()?>home/author/?mywork=1"><span <?php if($this->uri->segment(2) == 'addWork') {?> class="active" <?php } ?>>My Work</span></a></li>
	    <?php } ?>
                            
        <?php $usd = $this->session->userdata('logged_user');
                            if($usd['user_type'] == '2' || $usd['user_type'] == '3' || $usd['user_type'] == '4') {?>
                            <li <?php if($this->uri->segment(1) == 'discovery') {?> class="active" <?php } ?>><a href="<?=base_url()?>discovery"><span <?php if($this->uri->segment(1) == 'discovery') {?> class="active" <?php } ?>>Discovery</span></a></li>
                            
                            <li <?php if($this->uri->segment(1) == 'bookshelves') {?> class="active" <?php } ?>><a href="<?=base_url()?>bookshelves"><span <?php if($this->uri->segment(1) == 'bookshelves') {?> class="active" <?php } ?>>My Bookshelves</span></a></li>
                            
                            <?php } ?>
        <div class="clear"></div>
      </ul>
      <div class="clear"></div>
    </div>
