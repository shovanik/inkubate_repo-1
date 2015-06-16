<div class="footer">

			<div class="col-1 col">
            <a href="<?=base_url()?>home">
				<img alt="Inkubate" src="<?=base_url()?>images/logo.png"/>
             </a>   
			</div>

			<div class="col-2 col">
				<strong>About Inkubate</strong>
				<ul>
					<li><a href="<?=base_url()?>home/tour">Tour</a></li>
					<li><a href="a<?=base_url()?>home/about">About</a></li>
					<li><a href="<?=base_url()?>home/terms">Terms of Use</a></li>
					<li><a href="<?=base_url()?>home/contact">Contact</a></li>
                    <li><a href="<?=base_url()?>home/team">Team</a></li>
                    
				</ul>
			</div>

			<div class="col-3 col">
				<strong>Help</strong>
				<ul>
					<li><a href="<?=base_url()?>home/faq">FAQ</a></li>
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
			<strong>&copy; 2014 Inkubate.</strong> All rights reserved.
	
		</div>
            </div>
            </div>
            
            <nav id="menu">
				<ul>
                
                
                <div class="top_welcome_section_right mob_display">
         	 <img src="<?=base_url()?>images/profile_img.png" alt="" />
            <p><strong>Welcome</strong></p>
            <p><span>Jay D Gale</span><br />
              Member since May 2011</p>
          </div>
          	<div class="clear"></div>
            <div class="dasbord_news_section_right mob_display2">
            <h2>Profile is 75 % complete !</h2>
            <p class="bio_section"><span>Your Bio</span></p>
            <p class="bio_section photo"><span>Your Photo</span></p>
            <p class="bio_section work"><span>Your Work</span></p>
            <p class="bio_section social"><span>Social</span></p>
            <div class="clear"></div>
            	
            <a href="#" class="button_pro">Update Profile<img src="<?=base_url()?>images/arrow.png" alt="" /></a>
            <div class="clear"></div>
             </div>
            
            <div class="clear"></div>
            
            <li>&nbsp;</li>
                
                	<?php $usd = $this->session->userdata('logged_user');
                    if($usd['user_type'] == '1')
                     {?>
                	<li><a class="icon icon-data" href="<?=base_url()?>home/author">My Dashboard</a></li>
                    <?php } if($usd['user_type'] == '2') {?>  
                    <li><a class="icon icon-data" href="<?=base_url()?>home/publisher">My Dashboard</a></li>
                    <?php } ?>
                    <li><a class="icon icon-location" href="#">Profile</a></li>
                    <li><a class="icon icon-study" href="#">Message Center</a>
                    	<ul>
                        	<li><a class="icon icon-study" href="<?=base_url()?>home/inbox">Inbox</a></li>
                            <li><a class="icon icon-study" href="<?=base_url()?>home/DraftMail">Draft</a></li>	
                            <li><a class="icon icon-study" href="<?=base_url()?>home/SentMail">Sent Mail</a></li>	
                            <li><a class="icon icon-study" href="<?=base_url()?>home/TrashMail">Trash</a></li>	
                             <li><a class="icon icon-study" href="#">Folder</a></li>
                              <li><a class="icon icon-study" href="#" style="padding-left:30px;">Recent (2) Important</a></li>
                        </ul>
                    </li>
                    <li><a class="icon icon-photo" href="#">Account</a></li>
                    
                    <li><a class="icon icon-location" href="<?=base_url()?>home/faq">FAQ</a></li>
                    <li><a class="icon icon-study" href="#">Blog</a></li>
				</ul>
			</nav>
            
            
           
            
        </div> 

<a id="top">Back to Top</a>

<div id="info" style="display:none;">
 <h2>Add a New Folder</h2>
 <?php
   $frmAttrs   = array("id"=>'signupFrm',"class"=>'form-horizontal');
   echo form_open('home/addfolder', $frmAttrs);
 ?>
 
 <label>Folder Name:</label>
 <input name="textfield" type="text" />
 <div class="clear"></div>
 <input name="button" type="button" value="Send" /> <input name="button" type="button" value="Cancel" class="white" onclick="cancl()" />
 </form> 
 
  </div>
  
  
     <script type="text/javascript">
    jQuery(document).ready(function($) {
      $('a[rel*=facebox]').facebox({
        loadingImage : '<?=base_url()?>images/loading.gif',
        closeImage   : '<?=base_url()?>images/closelabel.png'
      })
    })
    
    function cancl()
    {
        //alert('hi');
        document.getElementById('facebox').style.display = 'none';
        document.getElementById('facebox_overlay').style.display = 'none';
    }
  </script>
  
</body>
</html>

