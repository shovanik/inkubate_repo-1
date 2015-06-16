<div class="footer">
        <div class="col-1 col"> 
        <a href="<?=base_url()?>home">
        <img alt="Inkubate" src="<?=base_url()?>images/logo.png"/> 
        </a>
        </div>
        <div class="col-2 col"> <strong>About Inkubate</strong>
          <ul>
            <li><a href="<?=base_url()?>home/tour">Tour</a></li>
					<li><a href="<?=base_url()?>home/about">About</a></li>
					<li><a href="<?=base_url()?>home/terms">Terms of Use</a></li>
					<li><a href="<?=base_url()?>home/contact">Contact</a></li>
                    <li><a href="<?=base_url()?>home/team">Team</a></li>
          </ul>
        </div>
        <div class="col-3 col"> <strong>Help</strong>
          <ul>
            <li><a href="<?=base_url()?>faq">FAQ</a></li>
          </ul>
        </div>
        <div class="col-4 col"> <strong>Community</strong>
          <ul>
            <li><a href="#">InkubateVoices</a></li>
            <li><a target="_blank" onclick="" href="#">Twitter</a></li>
            <li><a target="_blank" onclick="" href="#">Facebook</a></li>
            <li><a onclick="" href="#">Blog</a></li>
          </ul>
        </div>
        <div class="clear"></div>
      </div>
      <div class="sub-footer section clearfix"> <strong>&copy; 2014 Inkubate.</strong> All rights reserved. </div>
    </div>
  </div>
  <nav id="menu">
  
  
 	
    <ul>
    	<?php $usd = $this->session->userdata('logged_user');?>	
   		<div class="top_welcome_section_right mob_display">
         	 <?php if(!empty($user_photo['filename'])) {?>
                    <img src="<?=base_url()?>uploadImage/<?=$usd['id']?>/profile/<?=$user_photo['filename']?>" class="img_sz"/>
                 <?php } else {?>
                     <img src="<?=base_url()?>images/img_default_headshot.png" class="img_sz"/>
                 <?php } ?> 
            <p><strong>Welcome</strong></p>
            <p><span><?php echo $usd['name_first'].' '.$usd['name_middle'].' '.$usd['name_last'];?></span><br />
              Member since <?php echo date('d F Y',strtotime($usd['created']))?></p>
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
      <?php if($this->uri->segment(2) == 'author') {?>     
      <li><a class="icon icon-data" href="<?=base_url()?>home/author">My Dashboard</a></li>
      <?php } if($this->uri->segment(2) == 'publisher') {?> 
      <li><a class="icon icon-data" href="<?=base_url()?>home/publisher">My Dashboard</a></li>
      <?php } ?>
      <li><a class="icon icon-location" href="<?=base_url()?>profile">Profile</a></li>
      <li><a class="icon icon-study" href="<?=base_url()?>home/inbox">Inbox</a></li>
      <li><a class="icon icon-photo" href="#">Account</a></li>
      <li><a class="icon icon-location" href="<?=base_url()?>home/faq">FAQ</a></li>
      <li><a class="icon icon-study" href="#">Blog</a></li>
      <li><a class="icon icon-study" href="<?=base_url()?>home/logout">Logout</a></li>
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
    <input name="button" type="button" value="Send" />
    <input name="button" type="button" value="Cancel" class="white" />
  </form>
</div>


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
  
</body>
</html>