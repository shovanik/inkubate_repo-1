 <!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no" />
<title>notification</title>
<!--style sheet-->
	<link href="<?=base_url()?>style/inner/style.css" rel="stylesheet" />
    <link href="<?=base_url()?>style/inner/fancyfields.css" rel="stylesheet" type="text/css"/>
    <link href="<?=base_url()?>style/inner/facebox.css" rel="stylesheet" type="text/css"/>
	<link href="<?=base_url()?>style/inner/responsive.css" rel="stylesheet" />
    
    <link href="<?=base_url()?>style/inner/jquery.mmenu.all.css" rel="stylesheet" />
     
     
     <!--for nav part-->
    
 
    <!--for nav part-->
   
<!--style sheet-->
<!--jquery_link-->
 <script src="<?=base_url()?>js/jquery-1.8.2.min.js"></script>
 <script type="text/javascript" src="<?=base_url()?>js/jquery.mmenu.min.all.js"></script>
 <script src="<?=base_url()?>js/fancyfields-1.2.min.js" type="text/javascript"></script>
 <script type="text/javascript" src="<?=base_url()?>js/jquery.reveal.js"></script>

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
 
  });
 
   </script>
    
    
</head>

<body>

    
    <div class="main_wrapper">
    	<div class="wrapper_content">
        	<div class="header_section">
            	<div class="top_header">
                
                 
                	<h1 class="logo">
                     <a href="#menu" class="r_menu">&nbsp;</a>
                    	<img src="<?=base_url()?>images/logo.png" class="logo_img" />
                       
                        
                    </h1>
                   <ul class="top_links">
                            <li><a href="#">Home</a></li>
                            <li><a href="faq.html">FAQ</a></li>
                            <li><a href="#">Blog</a></li>
                           
                           
                            <li class="l_border"><a href="<?=base_url()?>home/logout">Log out</a></li>
                            <div class="clear"></div>
                        </ul>
                   
            <div class="clear"></div>
            </div>
                  
                        
                       
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
                <div class="nav_section">
                	
                    	<ul>
                            <li><a href="index.html"><span>My Dashboard</span></a></li>
                            <li><a href="profile.html"><span>Profile</span></a></li>
                            <li class="active"><a href="inbox.html"><span class="active">Inbox</span></a></li>
                            <li><a href="account.html"><span>Account</span></a></li>
						
                        <div class="clear"></div>
                        </ul>
                <div class="clear"></div>
                </div>
                
           
            <div class="content_part">
            	
               
                <div class="mid_content mid_content_inner">
                  <div class="subcrib">
                	
                    <div class="subcrib_heading"><h1>Subscriptions</h1></div>
                      <ul>
                    
                          <li>
                            <div class="sub_top">
                                <p>Free Trial</p>
                                <h1>0.00 <img src="<?=base_url()?>images/small_map.png" /> </h1>
                                <div class="clear"></div>
                                </div>
                            <div class="clear"></div>
                                <ul class="sub_cont">
                                    <li>Upload & refine your manuscripts and profile</li>
                                    <li>Demo writing analysis using our "Who do I write like?" tool1</li>
                                    <li>"Pitchit!"- compose and save - be ready when you go live!2</li>
                                    <li>Get notifications when your genera or tags come up in publisher or agent search</li>
                                    <li>Go live anytime or go live automatically in 30 days - cancel anytime3</li>
                                    <li><span><a class="button_pro" href="#">Choose Plan</a></span></li>
                                    
                                </ul>
                                <div class="clear"></div>
                
                          </li>
                          
                        
                          
                          
                          
                          <li>
            	<div class="sub_top">
                	<p>Basic Writer </p>
                    <h1>0.00 <img src="<?=base_url()?>images/small_map.png" /> </h1>
                    <div class="clear"></div>
                    </div>
                <div class="clear"></div>
                    <ul class="sub_cont">
                    	<li>1 live manuscript – Upload and refine as many as you want! </li>
                        <li>Perfect your profile or a synopsis using Inkubate’s on-line tools</li>
                        <li>Advanced interactive writing analysis using our "Who do I write like?" tool1</li>
                        <li>"Pitchit!"-1 free with 12 months membership - a $50 Value!2</li>
                        <li>Get notified when your profile or work is looked at by publishers or agents</li>
                        <li>Upgrade at any time and we will prorate your membership3</li>
                        <li><span><a class="button_pro" href="#">Choose Plan</a></span></li>
                        
                    </ul>
                    <div class="clear"></div>
              
                
            </li>
            
            
            
            
            
            
                           <li>
             <div class="trapezium">
             </div>
            	<div class="sub_top">
                <div class="best">
                	<img src="<?=base_url()?>images/ribon.png" />BEST VALUED
                </div>
                	<p>Professional</p>
                    <h1>0.00 <img src="<?=base_url()?>images/small_map.png" /> </h1>
                    <div class="clear"></div>
                    </div>
                <div class="clear"></div>
                    <ul class="sub_cont">
                    	<li>Up to 10 live manuscripts – Upload and refine as many as you want! </li>
                        <li>Perfect your profile or a synopsis using Inkubate’s on-line tools</li>
                        <li>Advanced interactive writing analysis using our "Who do I write like?" tool1</li>
                        <li>"Pitchit!" - 4 free with 12 months membership – a $200 Value!2</li>
                        <li>Get notified when your profile or work is looked at by publishers or agents</li>
                        <li>Upgrade or downgrade at any time and we will prorate your membership3</li>
                        <li>50% discount on Inkubate marketplace credits4</li>
                       
                        <li class="diferent"><span><a class="button_pro" href="#">Choose Plan</a></span></li>
                        <div class="clear"></div>
                    </ul>
                    <div class="clear"></div>
                <div class="shadow">
                	<img src="<?=base_url()?>images/drop_shadow.png" />
                </div>
            </li>
            
            
            
            
                          
                          <li class="last_list">
            
            
            
            	
            	<div class="sub_top">
                	<p>Free Trial</p>
                    <h1>0.00 <img src="<?=base_url()?>images/small_map.png" /> </h1>
                    <div class="clear"></div>
                    </div>
                <div class="clear"></div>
                    <ul class="sub_cont">
                    	<li>Unlimited live manuscripts</li>
                        <li>Perfect your profile or a synopsis using Inkubate’s on-line tools</li>
                        <li>Free LIVE professional profile or synopsis consultation - a $125 Inkubate marketplace value* </li>
                        <li>Advanced interactive writing analysis using our “Who do I write like?” tool1</li>
                        <li>“Pitchit!” 4 free with 12 months membership – a $200 Value!2</li>
                        <li>Get notified when your profile or work is looked at by publishers or agents</li>
                        <li>Upgrade or downgrade at any time and we will prorate your membership3</li>
                        <li>50% discount on Inkubate marketplace credits4</li>
                        <li><span><a class="button_pro" href="#">Choose Plan</a></span></li>
                        
                    </ul>
                    <div class="clear"></div>
                
           
            
            
            
            
            
            
            
            
            </li>
                    
                  
                    
                    
                      </ul>
                      <div class="clear"></div>
                    
                   </div>
                    
                <div class="clear"></div>
                    
                </div>
                <div class="clear"></div>
              
                <div class="footer">

			<div class="col-1 col">
				<img alt="Inkubate" src="<?=base_url()?>images/logo.png">
			</div>

			<div class="col-2 col">
				<strong>About Inkubate</strong>
				<ul>
					<li><a href="#">Tour</a></li>
					<li><a href="about.html">About</a></li>
					<li><a href="#">Terms of Use</a></li>
					<li><a href="#">Contact</a></li>
                    <li><a href="#">Team</a></li>
                    
				</ul>
			</div>

			<div class="col-3 col">
				<strong>Help</strong>
				<ul>
					<li><a href="faq.html">FAQ</a></li>
				</ul>
			</div>

			<div class="col-4 col">
				<strong>Community</strong>
				<ul>
					<li><a href="#">InkubateVoices</a></li>
                    <li><a target="_blank" onclick="" href="#">Twitter</a></li>
					<li><a target="_blank" onclick="" href="#">Facebook</a></li>
					<li><a onclick="" href="#">Blog</a></li>
				</ul>
			</div>
<div class="clear"></div>
		</div>
        <div class="sub-footer section clearfix">
			<strong>&copy; 2013 Inkubate.</strong> All rights reserved.
	
		</div>
            </div>
            </div>
            
            <nav id="menu">
				<ul>
                	<li><a class="icon icon-data" href="#">My Dashboard</a></li>
                    <li><a class="icon icon-location" href="#">Profile</a></li>
                    <li><a class="icon icon-study" href="#">Inbox</a></li>
                    <li><a class="icon icon-photo" href="#">Account</a></li>
                    <li><a class="icon icon-data" href="#">Home</a></li>
                    <li><a class="icon icon-location" href="faq.html">FAQ</a></li>
                    <li><a class="icon icon-study" href="#">Blog</a></li>
				</ul>
			</nav>
            
            
           
            
        </div> 

<a id="top">Back to Top</a>

<div id="info" style="display:none;">
 <h2>Add a New Folder</h2>
 
 <form action="" method="post">
 <label>Folder Name:</label>
 <input name="textfield" type="text" />
 <div class="clear"></div>
 <input name="button" type="button" value="Send" /> <input name="button" type="button" value="Cancel" class="white" />
 </form> 
 
  </div>
  
  
     <script type="text/javascript">
    jQuery(document).ready(function($) {
      $('a[rel*=facebox]').facebox({
        loadingImage : '<?=base_url()?>images/loading.gif',
        closeImage   : '<?=base_url()?>images/closelabel.png'
      })
    })
  </script>
  
</body>
</html>

