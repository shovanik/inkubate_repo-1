<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no" />
<title><?php echo $title;?></title>
<!--style sheet-->
	<link href="<?=base_url()?>style/style.css" rel="stylesheet" />
	<link href="<?=base_url()?>style/responsive.css" rel="stylesheet" />
    <link href="<?=base_url()?>style/jquery.mmenu.all.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?=base_url()?>style/liquid-slider.css"/>
    <link href="<?=base_url()?>style/owl.carousel.css" rel="stylesheet" />
    <link href="<?=base_url();?>style/jquery-ui-1.8.21.custom.css" rel="stylesheet"/>
    <link href="<?=base_url();?>style/modal.css" rel="stylesheet"/>
    <link href="<?=base_url();?>style/litebox.css" rel="stylesheet" type="text/css" media="all" />
    
<!--style sheet-->
<!--jquery_link-->
 <script src="<?=base_url()?>js/jquery-1.8.2.min.js"></script>
 <script src="<?=base_url()?>js/jquery-ui-1.8.21.custom.min.js"></script>
 <script type="text/javascript" src="<?=base_url()?>js/jquery.mmenu.min.all.js"></script>
 <script type="text/javascript" src="<?=base_url()?>js/owl.carousel.js"></script>
 <script src="<?=base_url()?>js/jquery.touchSwipe.min.js"></script>
 <script src="<?=base_url()?>js/jquery.liquid-slider.js"></script>
 <script src="<?=base_url()?>js/litebox.min.js" type="text/javascript"></script>

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





</head>

<?php if($this->uri->segment(2) == 'team') {?>


<script>
		window.onload=function() {
  		//alert('window.onload')
		}
$(document).ready(function() {
	$(".abc").css("");
	$(".bca").click(function(){;
	$(".abc").hide()	
	
})
    
});
	</script>

<body onLoad="window.scroll(0, 390)">>
<?php } else {?>
<body style="overflow-x:hidden">
<?php } ?>
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
                            <li><a href="<?=base_url()?>home">Home</a></li>
                            <li><a href="<?=base_url()?>home/faq">FAQ</a></li>
                            <li><a href="#">Blog</a></li>
                            <li><a href="<?=base_url()?>home/publishers">Publishers!</a></li>
                            <li><a href="<?=base_url()?>home/investors">Investors</a></li>
                            <li class="l_border"><a href="<?=base_url()?>home/login">Login</a></li>
                            <div class="clear"></div>
                        </ul>
                   
            <div class="clear"></div>
            </div>
                  
                        
                        <div class="clear"></div>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
                <div class="nav_section">
                	<ul>
                    	<li><a href="<?=base_url()?>home/about">What is Inkubate?</a></li>
                        <li><a href="<?=base_url()?>home/tour">Take the Tour</a></li>
                        <!--<li><a href="#">Contest</a></li>
                        <li><a href="#join_form_1" id="join_pop">Watch our Video</a></li>-->
                        <li><a href="https://www.youtube.com/watch?v=kU_q_fxiMPw&feature=player_detailpage" target="_self" class="button litebox" data-litebox-group="group-2">Watch our Video</a></li>
                        <li class="right"><a href="<?=base_url()?>home/signUp">Join!</a></li>
                        <div class="clear"></div>
                    </ul>
                    
                   <!--<a href="#x" class="overlay" id="join_form_1"></a>
                     <div class="popup">
                        
                        <iframe width="420" height="315" src="http://www.youtube.com/embed/kU_q_fxiMPw?autoplay=1"></iframe>
                        
                        <a class="close" href="#close"></a>
                   </div> -->
                    
                    
                <div class="clear"></div>
                </div>
                <div class="for_mob">
                	<ul>
                    	<li><a href="<?=base_url()?>home/login">Login</a></li>
                        <li class="right"><a href="<?=base_url()?>home/signUp">Join!</a></li>
                        <div class="clear"></div>
                    </ul>
                <div class="clear"></div>
                </div>