<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no" />
<title><?=$title?></title>
<!--style sheet-->
	<link href="<?=base_url()?>style/inner/style.css" rel="stylesheet" />
    <link href="<?=base_url()?>style/inner/fancyfields.css" rel="stylesheet" type="text/css"/>
    <link href="<?=base_url()?>style/inner/facebox.css" rel="stylesheet" type="text/css"/>
	<link href="<?=base_url()?>style/inner/responsive.css" rel="stylesheet" />
    <link href="<?=base_url()?>style/inner/jquery.mmenu.all.css" rel="stylesheet" />
    
    
    
<!--style sheet-->
<!--jquery_link-->

 <script type="text/javascript" src="<?=base_url()?>js/jquery-1.8.2.min.js"></script>
 
 
 <script type="text/javascript" src="<?=base_url()?>js/jquery.mmenu.min.all.js"></script>
 <script src="<?=base_url()?>js/fancyfields-1.2.min.js" type="text/javascript"></script>
 <script type="text/javascript" src="<?=base_url()?>js/jquery.reveal.js"></script>
 <script type="text/javascript" src="<?=base_url()?>js/jquery.easing.min.js"></script>
 <script type="text/javascript" src="<?=base_url()?>js/jquery.easy-ticker.js"></script>
 
 
 <script src="<?=base_url()?>assets/scripts/lazy_load/jquery-ias.min.js" type="text/javascript"></script>
 
<!--<script src="<?//=base_url()?>js/jquery.fancybox.pack.js"></script>
 <script type="text/javascript" src="<?=base_url()?>tinymce/js/tinymce/tinymce.min.js"></script>-->

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
     $(".bottom_text2").toggle("slow")
 
  });
   $(".hidetext3").click(function () {
     $(".bottom_text3").toggle("slow")
 
  });
  
    $(".hidetext4").click(function () {
 
     $(".bottom_text4").toggle("slow")
 
  });
  
  
});
 
 
 
 function ticker() {
    $('#ticker li:first').slideUp(function() {
        $(this).appendTo($('#ticker')).slideDown();
    });
}
setInterval(ticker, 3000);
 
 
   </script>
 
<script type="text/javascript" language="javascript">
 $(document).ready(function(e) { 
    $("#langs_current").click(function(){
									   
		//$('.update_results .up_img').removeClass('up_img');
		//
		if($('.update_results').hasClass('down_img')){
			$('.update_results').addClass('up_img');
			$('.update_results').removeClass('down_img');
		}else{
			$('.update_results').removeClass('up_img');
			$('.update_results').addClass('down_img');
		}
		$("#langz").fadeToggle( "fast", "linear" );
        return false;
     });
    
  
});
 
 function googleplus_logout()
 {
    //gapi.auth.signOut();
    document.location.href = "https://www.google.com/accounts/Logout?continue=https://appengine.google.com/_ah/logout?continue=http://inkubate.com/application/home/logout";
 }
   </script> 
 
 <style>
.img_sz
{
    border-radius: 50%;
    height: 60px;
    width: 60px;
}
.img_sz_small
{
    border-radius: 50%;
    height: 52px;
    width: 52px;
}
</style> 
  
</head>

<body>

    <?php $usd = $this->session->userdata('logged_user'); ?>
    <div class="main_wrapper">
    	<div class="wrapper_content">
        	<div class="header_section">
            	<div class="top_header">
                
                 
                	<h1 class="logo">
                     <a href="#menu" class="r_menu">&nbsp;</a>
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
                        <?php 
                        
                        if($usd['user_type'] == '1')
                        {
                        ?>
                            <li <?php if($this->uri->segment(2) == 'author') {?> class="active" <?php } ?>><a href="<?=base_url()?>home/author"><span <?php if($this->uri->segment(2) == 'author') {?> class="active" <?php } ?>>My Dashboard</span></a></li>
                        <?php } else { ?>
                        
                            <li <?php if($this->uri->segment(2) == 'publisher') {?> class="active" <?php } ?>><a href="<?=base_url()?>home/publisher"><span <?php if($this->uri->segment(2) == 'publisher') {?> class="active" <?php } ?>>My Dashboard</span></a></li>
                        
                        <?php } ?>   
                            
                            <li  <?php if($this->uri->segment(1) == 'profile') {?> class="active" <?php } ?>><a href="<?=base_url()?>profile"><span  <?php if($this->uri->segment(1) == 'profile') {?> class="active" <?php } ?>>Profile</span></a></li>
                            
                            <li <?php if($this->uri->segment(2) == 'inbox' || $this->uri->segment(2) == 'DraftMail' || $this->uri->segment(2) == 'SentMail' || $this->uri->segment(2) == 'TrashMail' || $this->uri->segment(2) == 'compose_mail' || $this->uri->segment(2) == 'details') {?> class="active" <?php } ?>><a href="<?=base_url()?>home/inbox"><span <?php if($this->uri->segment(2) == 'inbox' || $this->uri->segment(2) == 'DraftMail' || $this->uri->segment(2) == 'SentMail' || $this->uri->segment(2) == 'TrashMail' || $this->uri->segment(2) == 'compose_mail' || $this->uri->segment(2) == 'details') {?> class="active" <?php } ?>>Message Center</span></a></li>
                            <!--<li><a href="#"><span>Account</span></a></li>-->
						    
                            <?php $usd = $this->session->userdata('logged_user');
                            if($usd['user_type'] == '2' || $usd['user_type'] == '3' || $usd['user_type'] == '4') { ?>
                            <li <?php if($this->uri->segment(1) == 'discovery') {?> class="active" <?php } ?>><a href="<?=base_url()?>discovery"><span <?php if($this->uri->segment(1) == 'discovery') {?> class="active" <?php } ?>>Discovery</span></a></li>
                            
                            <li <?php if($this->uri->segment(1) == 'bookshelves') {?> class="active" <?php } ?>><a href="<?=base_url()?>bookshelves"><span <?php if($this->uri->segment(1) == 'bookshelves') {?> class="active" <?php } ?>>My Bookshelves</span></a></li>
                            
                            <?php } ?>
                       
                        <div class="clear"></div>
                    </ul>
                <div class="clear"></div>
                </div>
                
                
                <?php if($this->uri->segment(2) == 'inbox' || $this->uri->segment(2) == 'DraftMail' || $this->uri->segment(2) == 'SentMail' || $this->uri->segment(2) == 'TrashMail') {?>
                <div class="for_mob">
                	<ul>
                    	<li><a href="<?=base_url()?>home/compose_mail"><img src="<?=base_url()?>images/mail_compose_icon.png"/><span>Compose Mail</span></a></li>
                        <div class="clear"></div>
                    </ul>
                    </div>
                 <?php } ?>
                    
                    <!--<div class="fold" style="display:none">
                            	<ul>
                                <li><a href="#info" rel="facebox"><img src="<?//=base_url()?>images/plus.png" alt=""/></a></li>
                                <?php //if(!empty($folder_details)) {
                                     
                                    //print_r($folder_details);die;        
                               // foreach($folder_details as $key=>$fdetails) {
                                    
                                    
                                ?>
                                	<li>
                                    	<strong><?php //echo $fdetails['name']?> (2)</strong>
										
                                    </li>
                                    
                                 <?php //} }?>   
                                    
                                  <div class="clear"></div>
                                </ul>
                                
                            </div>
                <div class="clear"></div>-->
                
           