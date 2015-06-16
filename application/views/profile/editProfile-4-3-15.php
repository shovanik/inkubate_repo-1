<?=$this->load->view('template/inner_header.php')?>
 <script src="<?=base_url()?>ckeditor/ckeditor.js"></script>
 <script>
function myFunction(){
    //alert('hi');
    var x = document.getElementById("image");
    var txt = "";
    if ('files' in image) {
        if (x.files.length == 0) {
            txt = "Select one or more files.";
        } else {
            for (var i = 0; i < x.files.length; i++) {
                /*txt += "<br><strong>" + (i+1) + ". file</strong><br>";*/
                var file = x.files[i];
                if ('name' in file) {
                    //txt += "name: " + file.name + "<br>";
                    txt += file.name ;
                }
                /*if ('size' in file) {
                    txt += "size: " + file.size + " bytes <br>";
                }*/
            }
        }
    } 
    else {
        if (x.value == "") {
            txt += "Select one or more files.";
        } else {
            txt += "The files property is not supported by your browser!";
            txt  += "<br>The path of the selected file: " + x.value; // If the browser does not support the files property, it will return the path of the selected file instead. 
        }
    }
    document.getElementById("demo_upload").innerHTML = txt;
}
</script>

<script>
 function go_profile()
 {
    //alert('kdfj');
    window.location.href = '<?=base_url()?>profile';
 }
 </script>

<script type="text/javascript">
		$(document).ready( function() {
		  
           $('#Fiction').click(function(){
            
            //alert('he');
            
            var fiction = $('#Fiction').val();
            
            
            $.ajax({
           url      : '<?=base_url()?>'+'work/details',
           type     : 'POST',
           data     : { 'id': fiction },
           success  : function(resp){
            //alert(resp);
                if(resp != '0'){
                    $("#work_form").html(resp);
                    //$("#edit_class" ).dialog( "close" );
                }
           },
           error    : function(resp){
                $.prompt("Sorry, something isn't working right.", {title:'Error'});
           }
        });
            
            
  });
         
          $('#NonFiction').click(function(){
            
           //alert('hi');
           
           var nonfiction = $('#NonFiction').val();
            //alert(fiction);
            
            $.ajax({
           url      : '<?=base_url()?>'+'work/details',
           type     : 'POST',
           data     : { 'id': nonfiction },
           success  : function(resp){
            //alert(resp);
                if(resp != '0'){
                    $("#work_form").html(resp);
                    //$("#edit_class" ).dialog( "close" );
                }
           },
           error    : function(resp){
                $.prompt("Sorry, something isn't working right.", {title:'Error'});
           }
        });
           
            
         })
        
    
    /*$('input[type="radio"]').click(function(){
    if ($(this).is(':checked'))
    {
      //alert($(this).val());
      if($(this).val() == 1)
      {
        $('#work_form_div').css('display','block');
      }
      if($(this).val() == 2)
      {
        $('#work_form_div').css('display','block');
      }
      
    }
  });*/  
      
       
    });
    
  
  </script>

<style>
.fileContainer {
    overflow: hidden;
    position: relative;
}

.fileContainer [type=file] {
    cursor: inherit;
    display: block;
    font-size: 999px;
    filter: alpha(opacity=0);
    min-height: 100%;
    min-width: 100%;
    opacity: 0;
    position: absolute;
    right: 0;
    text-align: right;
    top: 0;
}

/* Example stylistic flourishes */

.fileContainer {
    
    border-radius: .5em;
    float: left;
    padding: .5em;
}

.fileContainer [type=file] {
    cursor: pointer;
}

</style>
    
    <div class="content_part">
      <div class="mid_content index_sec pro">
        
        <div class="pitchits_section">
          <div class="profile_left">
          <?php $usd = $this->session->userdata('logged_user');?>
              <h1><?php echo $usd['name_first'].' '.$usd['name_middle'].' '.$usd['name_last']?></h1>
              <p> Member since: <?php echo date('m/d/Y',strtotime($usd['created']))?> <br/>
    Works uploaded: <?php echo count($work_count)?></p>
                
                 <?php
                   $usd = $this->session->userdata('logged_user');
                   $frmAttrs   = array("id"=>'signupFrm',"class"=>'form-horizontal',"name"=>'myForm');
                   echo form_open_multipart('profile/editProfile', $frmAttrs);
                   //echo '<pre/>';print_r($user_bio);die;
                   ?>
                
                <div class="profile_pic">
                   <?php if(!empty($user_photo['filename'])) {?>
                    <img src="<?=base_url()?>uploadImage/<?=$usd['id']?>/profile/medium/<?=$user_photo['filename']?>"/>
                 <?php } else {?>
                     <img src="<?=base_url()?>images/img_default_headshot.png"/>
                 <?php } ?> 
                    
                </div>
                
                <label class="fileContainer">
                <span class="button_pro">Browse</span>
                <input type="file" id="image" name="image" onchange="myFunction()" />
                <span id="demo_upload"></span>
                </label>
                <div class="clear"></div>
                <p class="browse_txt">Don't worry, your image will<br/>
     appear after you save your<br/>
     profile.</p>
     <div class="on_the_web">
                	<p class="onthe1">On the web</p>
                    <ul>
                    	<li>
                        	<div class="social_icon">
                            	<img src="<?=base_url()?>images/icon-facebook.jpg"/>
                            </div>
                            <?php $fb = $this->mprofile->get_user_web_link(1);?>
                   			<input type="text" name="facebook" value="<?php if(!empty($fb['url'])) { echo $fb['url'];}?>"/>
                         </li>
                         <li>
                         	<div class="social_icon">
                        		<img src="<?=base_url()?>images/icon-twitter.jpg"/>
                            </div>
                            <?php $twt = $this->mprofile->get_user_web_link(2);?>
                   			<input type="text" name="twitter" value="<?php if(!empty($twt['url'])) { echo $twt['url']; }?>"/>
                         </li>
                         <li>
                         	<div class="social_icon">
                         		<img src="<?=base_url()?>images/icon-rss.jpg"/>
                            </div>
                            <?php $rss = $this->mprofile->get_user_web_link(3);?>
                   			<input type="text" name="rss" value="<?php if(!empty($rss['url'])) { echo $rss['url']; } ?>"/>
                         </li>
                         <li>
                        	<div class="social_icon social_text">
                         		Other
                            </div>
                            <?php $oth = $this->mprofile->get_user_web_link(4);?>
                   			<input type="text" name="other" value="<?php if(!empty($oth['url'])) { echo $oth['url']; } ?>"/>
                         </li>
                    </ul>
                    
                </div>
          </div>
          
          <div class="prrfile_bond">
              <div class="profile_mid">
                  
                  <p class="author_bio_txt"> <strong>Type your Bio here</strong> </p>
                  <div class="editor_part">
                  <?php if(!empty($user_bio['biography'])) {?>
                    <textarea class="ckeditor" cols="80" name="desc"  id="editor2" ><?php echo $user_bio['biography']?> </textarea>
                 <?php } else {?>
                     <textarea class="ckeditor" cols="80" name="desc"  id="editor2" > </textarea>
                 <?php } ?>
                  
                  </div>
                  <div class="frm_profile">
                  	<ul>
                    	<li><input type="checkbox" name="traditionally_published" value="1" <?php if(!empty($user_bio['traditionally_published'])) {if($user_bio['traditionally_published'] == '1') { ?>checked = "checked"<?php } } ?>/><label class="pro_lable">Have you been published by a professional publishing house? </label></li>
                        <li><input type="checkbox" name="self_published" value="1" <?php if(!empty($user_bio['self_published'])) {if($user_bio['self_published'] == '1') { ?>checked = "checked"<?php } } ?>/><label class="pro_lable">Have you self published?</label></li>
                        <li><input type="checkbox" name="literary_awards" value="1" <?php if(!empty($user_bio['literary_awards'])) { if($user_bio['literary_awards'] == '1') { ?>checked = "checked"<?php } } ?>/><label class="pro_lable">Have you received literary awards?</label></li>
                        <li><input type="checkbox" name="work_been_reviewed" value="1" <?php if(!empty($user_bio['work_been_reviewed'])) { if($user_bio['work_been_reviewed'] == '1') { ?>checked = "checked"<?php } } ?>/><label class="pro_lable">Has your work been reviewed?</label></li>
                        <li><input type="checkbox" name="published_abroad" value="1" <?php if(!empty($user_bio['published_abroad'])) { if($user_bio['published_abroad'] == '1') { ?>checked = "checked"<?php } } ?>/><label class="pro_lable">Have you published abroad?</label></li>
                        <li><input type="checkbox" name="mfa_program" value="1" <?php if(!empty($user_bio['mfa_program'])) { if($user_bio['mfa_program'] == '1') { ?>checked = "checked"<?php } } ?>/><label class="pro_lable">Are you part of a creative writing MFA program?</label></li>
                        
                    </ul>
                    <div class="clear"></div>
                    
                    <h1 class="update_heading align_heading">Personal Details</h1>
                    
                    <div class="personal_details">
                   
                    <div class="personal_details_left">
                    <label>Phone</label>
                    <input type="text" name="phone" id="phone" value="<?php if(!empty($user_contact['phone'])) { echo $user_contact['phone']; } ?>" />
                    <label>Personal Email</label>
                    <input type="text" name="personal_email" id="personal_email" value="<?php if(!empty($user_contact['personal_email'])) { echo $user_contact['personal_email']; } ?>" />
                    <label>Age</label>
                    <input type="text" name="age" id="age" value="<?php if(!empty($user_contact['age'])) { echo $user_contact['age']; } ?>" />
                    </div>
                    <div class="personal_details_right">
                    <label>Address</label>
                    <textarea cols="" rows="" name="add" id="add"><?php if(!empty($user_contact['address'])) { echo $user_contact['address']; } ?></textarea>
                    <div class="gender_controlar">
                    <div class="gender_left">
                    <label>Gender :</label>
                    </div>
                    <div class="gender_right">
                    <span class="male_con"><label>Male</label>
                    <input type="radio" name="gender" value="1" <?php  if($user_contact['gender'] == '1') { ?> checked = "checked" <?php } ?>/>
                    </span>
                    <span class="female_con">
                    <label>Female</label>
                    <input type="radio" name="gender" value="0" <?php  if($user_contact['gender'] == '0') { ?> checked = "checked" <?php } ?>/>
                    </span>
                    </div>
                    </div>
                    </div>
                  
                    </div>
                     <div class="clear"></div>
                   <?php if($usd['user_type'] == '1') {?> 
                   
                    
                    <ul>
                    
                        <li>
                        <h1 class="update_heading align_heading">Open to being contacted by publishers?</h1> 
                        
                        <input type="radio" name="is_contacted" value="1" <?php  if($user_contact['is_contacted'] == '1') { ?> checked = "checked" <?php } ?>/><label class="pro_lable">yes</label>
                        
                        <input type="radio" name="is_contacted" value="0" <?php if($user_contact['is_contacted'] == '0') { ?> checked = "checked" <?php } ?>/><label class="pro_lable">no</label>
                        
                        </li>
                    
                    </ul>
        
     
        
     <p style="margin-bottom: 10px;"> <strong>Choose a Category</strong> </p>
                   
     <select data-placeholder="Choose a Category..." class="chosen-select input_box" multiple="multiple" name="cate_gory_hid[]" id="cate_gory_hid" tabindex="4">
            <option value=""></option>
            
            <?php
            $category_details  = $this->mprofile->total_category_details();
            //echo '<pre/>';print_r($category_details);die;
            if(isset($category_details) && count($category_details) > 0)
            {
                //echo '<pre/>';print_r($category_details);
                $i=0;
                foreach($category_details as $eachList)
                {
            $wrk_cat = $this->mprofile->work_cat_select($usd['id'],$eachList['id']);
                if(isset($wrk_cat) && $wrk_cat > 0)
                {
            ?> 
            <option value="<?php echo $eachList['id']?>" style="display: none;"><?php echo $eachList['category_name']?></option>
            <?php } else {?>
            <option value="<?php echo $eachList['id']?>"><?php echo $eachList['category_name']?></option>
            <?php } } } ?>
     </select>
     
     <?php } if($usd['user_type'] == '2') {?>
    
           <div class="label-inline  clearfix " style="margin-top: 10px;">
				<input type="radio" class="xyz" value="1" <?php if(!empty($work_type_details)) { if($work_type_details['work_type_id'] == '1') { ?> checked="checked" <?php } } ?> name="WorkTypeId" id="Fiction"/>
				<label for="rdoWorkTypeIdFiction" class="xyz">Fiction</label>
				<input type="radio" class="xyz" value="2" <?php if(!empty($work_type_details)) { if($work_type_details['work_type_id'] == '2') { ?> checked="checked" <?php } } ?> name="WorkTypeId" id="NonFiction"/>
				<label for="rdoWorkTypeIdNonFiction" class="xyz">Non-Fiction</label>
			</div>
            
           
            <label>Work Form</label>
            
                                    <select name="work_form" id="work_form">
                                     
                                     <option value="0">---Genre---</option>
                                      <?php 
                                      if(!empty($work_type_details)) {
                                      $fiction_details  = $this->mwork->fiction_details($work_type_details['work_type_id']);
                                      foreach($fiction_details as $details)
                                      {
                                        
                                      ?>
                                       <option value="<?php echo $details['work_form_id']?>" <?php if($work_type_details['work_form_id'] == $details['work_form_id']){?> selected="selected" <?php } ?>><?php echo $details['work_form_name']?></option>
                                      <?php } } ?> 
                                    </select>
                             
            
           <?php } ?>         
                  </div>
              </div>
              <div class="profile_right">
              
              	<div class="profile_right_btn">
               		
                    <!--<button class="button_pro">Save edits</button>-->
                    <input type="button" class="button_pro" value="Cancel" onclick="go_profile()"/>
                	<input type="submit" class="button_pro" value="Save edits"/>
                    
             	</div>
                
               
              </div>
              <div class="clear"></div>
              <div class="work_section_mob">
          <h1 class="update_heading">Available work on Inkubate</h1>
          <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_new">
            <thead>
              <tr>
                <th width="20%" align="center">Book Cover</th>
                <th width="30%" align="center">Title</th>
                <th width="30%" align="center">Type</th>
                <th width="20%" align="center">Category</th>
              </tr>
            </thead>
            <tbody>
              
              
              
                 <?php if(!empty($user_work_details))
                    {
                 foreach($user_work_details as $details)
                 {
               
                 $user_category_details = $this->memail->get_user_work_categories($details['id']);
               ?>
                <tr>
                <td width="20%" align="center">
                
                <?php if($details['cover_image'] != '') { ?>
                 
                 <img src="<?=base_url()?>uploadImage/<?=$usd['id']?>/cover_image/thumbs/<?=$details['cover_image']?>" alt="" />
                
                <?php } else { ?>
                
                <img src="<?=base_url()?>images/img_default_cover.png" alt="" />
                
                <?php } ?>
                
                </td>
                <td width="30%" align="center"><a href="#"><?=$details['title']?></a></td>
                <td width="30%" align="center"><?=$details['work_type_name']?></td>
                <td width="20%" align="center"> 
                
                <?php if(!empty($user_category_details))
                     {
                     foreach($user_category_details as $categories)
                     {
                        echo $categories['category_name'].', ';
                     } } ?>
                
                </td>
                </tr>
                <?php  } } else { ?>
                <tr>
                <td width="0%" align="center"></td>
                <td width="0%" align="center"><p>Sorry! There are no works.</p></td>
                <td width="0%" align="center"></td>
                <td width="0%" align="center"></td>
                </tr>
                <?php } ?>
              
              
              
            </tbody>
          </table>
        </div>
          </div>
          
          <div class="clear"></div>
          
        </div>
        
        <div class="clear"></div>
      </div>
      <div class="clear"></div>
      
  <link rel="stylesheet" href="<?=base_url()?>style/inner/chosen.css"/>
<script src="<?=base_url()?>js/chosen.jquery.js" type="text/javascript"></script>

<script type="text/javascript">
    var config = {
      '.chosen-select'           : {max_selected_options: 3},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"15%"}
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
      
<?=$this->load->view('template/inner_footer.php')?>      