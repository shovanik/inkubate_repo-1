<?=$this->load->view('template/inner_header.php')?>
<?php $usd = $this->session->userdata('logged_user');?>
 <script src="<?=base_url()?>ckeditor/ckeditor.js"></script>
 <script>
 function revise()
 {
    window.location.href = '<?=base_url()?>profile/editProfile/<?php echo $usd['id'];?>';
 }
 
function limitText(limitField, limitCount, limitNum) {
	if (limitField.value.length > limitNum) {
		limitField.value = limitField.value.substring(0, limitNum);
	} else {
		limitCount.value = limitNum - limitField.value.length;
	}
} 
 
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
 
 
<style>
.t_part {width:70%; padding: 20px; border: 1px dashed #333; margin: 0; background: #ededed;}
.t_part2 {width:100%;}
.left_new_link {width:73%; float: right;}
.profile_pic {width: 27%; float: left; padding: 0; margin: 0;}
.t_part_new { width:30%; float:right;}
.t_part_new .profile_right { float:right; text-align:right;}
.t_part_new .profile_right .button_pro {padding: 14px 40px 14px 18px;}
.frm_profile_new ul li {margin:0; padding:0 0 5px 0;}
.frm_profile_new h1 { padding: 5px 0; font-size: 20px; color: #333; border-bottom: 1px dashed #ccc; margin-bottom: 15px;}
.left_new_link h1 {padding-bottom:10px;}
.left_new_link p {line-height:20px;}
.onthe { padding:40px 10px 0 0;}
.profile_bot_sec_left {width:100%;}
.profile_bot_sec_right {width:100%;}

.author_bio_txt {padding-top: 30px;}
.auto_bio h1, .profile_bot_sec_left h1, .work_section_mob h1 { font-size: 22px; color: #333; border-bottom: 1px dashed #ccc; padding: 40px 0 5px 0; margin-bottom:10px;}

</style>
 
<script>
function catshow(cat){
        
           // var cat   = $(this).attr('data-cat');
            //alert(cat);
           
            $.ajax({
           url      : '<?=base_url()?>'+'profile/cat_details',
           type     : 'POST',
           data     : { 'id': cat},
           success  : function(resp){
            //alert(resp);
                if(resp != '0'){
                    var cat = resp.split('@');
                    $("#cate_cnt").html(cat[0]);
                    $("#cat_list").html(cat[1]);
                    $('.chosen-select').chosen({ max_selected_options: cat[0] });
                    //$("#edit_class" ).dialog( "close" );
                }
           },
           error    : function(resp){
                $.prompt("Sorry, something isn't working right.", {title:'Error'});
           }
        });
   
      }
</script> 

 

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

</style>
    
    <div class="content_part">
      <div class="mid_content index_sec pro">
        
        <div class="pitchits_section">
          <div class="">
         
         <?php 
          //echo '<pre/>';print_r($workdetails_test);die;
          foreach($workdetails_test  as $workdetails)
          {
          ?> 
          
     <div class="profile_top_sec profile_top_sec_new">
        	<div class="profile_top_left_sec t_part">
            
    
                <div class="profile_pic">
                <?php if(!empty($workdetails['photo'])) {?>
                    <img src="<?=base_url()?>uploadImage/<?=$workdetails['id']?>/profile/<?=$workdetails['photo']?>"/>
                 <?php } else {?>
                     <img src="<?=base_url()?>images/img_default_headshot.png"/>
                 <?php } ?>   
                </div>
                <div class="left_new_link">
              <h1><?php echo $workdetails['name_first'].' '.$workdetails['name_middle'].' '.$workdetails['name_last']?></h1>
              <p> Member since: <?php echo date('m/d/Y',strtotime($workdetails['created']))?> <br/>
    Works uploaded: <?php echo $work_count['count']?></p>
    
    <div class="frm_profile frm_profile_new">
    <h1>Personal Details</h1>
                  	
                    <ul>
                    
                       <li><label>personal email :&nbsp;<strong><?php if(!empty($workdetails['personal_email'])) { echo $workdetails['personal_email']; } ?></strong></label></li>
                       <li><label>phone :&nbsp;<strong><?php if(!empty($workdetails['phone'])) { echo $workdetails['phone']; } ?></strong></label></li>
                       
                       <li><label>age :&nbsp;<strong><?php if(!empty($workdetails['age'])) { echo $workdetails['age']; } ?></strong></label></li>
                       
                       <li><label>gender :&nbsp;<strong>
                       <?php  
                        if($workdetails['gender'] == '1') 
                        { echo 'Male'; } 
                        if($workdetails['gender'] == '0') 
                        { echo 'Female'; } 
                         
                        ?>
                        </strong></label></li>
                       
                       <li><label>address :&nbsp;<strong><?php if(!empty($workdetails['address'])) { echo $workdetails['address']; } ?></strong></label></li>
                    
                    </ul>
                    
                    
           <!--         <?php if($usd['user_type'] == '1') {?> 
                    
                    <ul>
                    
                        <li>
                        <h1 class="update_heading align_heading">Open to being contacted by publishers? <?php  if($workdetails['is_contacted'] == '1') { ?> YES <?php } else { ?> NO <?php } ?></h1> 
                        </li>
                    
                    </ul>
                    
                   <?php } ?>   -->
                    
                  </div>
    
    
    		</div>
            <div class="clear"></div>
          </div>
          
          	<div class="profile_top_right_sec t_part_new">
            
            
           	 <div class="profile_right">
              
              	<div class="profile_right_btn">
               		<!--<button class="button_pro">Cancel</button>-->
                    <!--<button class="button_pro with_icon" onclick="revise()">revise your profile</button>-->
                	
             	</div>
                <div class="on_the_web">
                	<p class="onthe">On the web</p>
                    <ul class="icon_social">
                      <?php $fb = $this->mprofile->get_user_web_link(1);
                            if(!empty($fb['url'])) {
                            ?>
                    	<li>
                        	<div class="social_icon">
                            <a href="<?php echo $fb['url'];?>"><img src="<?=base_url()?>images/icon-facebook.jpg"/></a>
                            
                            </div>
                   			
                         </li>
                        <?php } ?> 
                        <?php $twt = $this->mprofile->get_user_web_link(2);
                                if(!empty($twt['url'])) {
                                ?>

                         <li>
                         	<div class="social_icon">
                        		<a href="<?php echo $twt['url'];?>"><img src="<?=base_url()?>images/icon-twitter.jpg"/></a>
                            </div>
                   			
                         </li>
                        <?php } ?> 
                         <?php $rss = $this->mprofile->get_user_web_link(3);
                         if(!empty($rss['url'])) {
                         ?>
                         <li>
                         	<div class="social_icon">
                         		<a href="<?php echo $rss['url'];?>"><img src="<?=base_url()?>images/icon-rss.jpg"/></a>
                            </div>
                         </li>
                         <?php } ?>
                         <?php $oth = $this->mprofile->get_user_web_link(4);
                         if(!empty($oth['url'])) {
                         ?>
                         <li>
                        	<div class="social_icon social_text">
                         		<a href="<?php echo $oth['url'];?>">Other</a>
                            </div>	
                         </li>
                          <?php } ?>
                    </ul>
                    
                </div>
              </div>
              <div class="clear"></div>
            </div>
            
            <div class="clear"></div>
            
            <div class="profile_top_mid_sec t_part2">
            	<div class="profile_mid">
                  
                  <div class="auto_bio">
                  <h1><?php if($workdetails['user_type'] == 1){?>Author<?php } if($workdetails['user_type'] == 2) {?>Publisher<?php } ?> Bio</h1> 
                  <div class="editor_part" style="height: auto;">
                  <?php if(!empty($workdetails['bio'])) {?>
                  <?php echo html_entity_decode($workdetails['bio'], ENT_QUOTES, 'UTF-8');?>
                  <?php } ?>
                  </div>
                  
                  
                  </div>
              </div>
            </div>
            
            <div class="clear"></div>
        	
        </div>
         <div class="clear"></div>
         <div class="profile_bot_sec">
         	<div class="profile_bot_sec_left">
            	<div class="frm_profile">
                <h1 style="padding-top:10px;">Others</h1>
                
                  	<ul>
                    	<li><label>Have you been published by a professional publishing house? &nbsp;<strong><?php if(!empty($workdetails['traditionally_published'])) {if($workdetails['traditionally_published'] == '1') {?>yes<?php } else {?>no<?php } } ?> </strong></label></li>
                        
                        <li><label>Have you self published?&nbsp;<strong><?php if(!empty($workdetails['self_published'])) {if($workdetails['self_published'] == '1') {?>yes<?php } else {?>no<?php } } ?></strong></label></li>
                        
                        <li><label>Have you received literary awards?&nbsp;<strong><?php if(!empty($workdetails['literary_awards'])) {if($workdetails['literary_awards'] == '1') {?>yes<?php } else {?>no<?php } } ?></strong></label></li>
                        
                        <li><label>Has your work been reviewed?&nbsp;<strong><?php if(!empty($workdetails['work_been_reviewed'])) {if($workdetails['work_been_reviewed'] == '1') {?>yes<?php } else {?>no<?php } } ?></strong></label></li>
                        
                        <li><label>Have you published abroad?&nbsp;<strong><?php if(!empty($workdetails['published_abroad'])) {if($workdetails['published_abroad'] == '1') {?>yes<?php } else {?>no<?php } } ?></strong></label></li>
                        
                        <li><label>Are you part of a creative writing MFA program?&nbsp;<strong><?php if(!empty($workdetails['mfa_program'])) {if($workdetails['mfa_program'] == '1') {?>yes<?php } else {?>no<?php } } ?></strong></label></li>
                    </ul>
                    
                    <!--<ul>
                    
                        <li>
                        <h1 class="update_heading align_heading">Personal Details</h1> 
                        </li>
                    
                       <li><label>personal email :&nbsp;<strong><?php if(!empty($user_contact['personal_email'])) { echo $user_contact['personal_email']; } ?></strong></label></li>
                       <li><label>phone :&nbsp;<strong><?php if(!empty($user_contact['phone'])) { echo $user_contact['phone']; } ?></strong></label></li>
                       
                       <li><label>age :&nbsp;<strong><?php if(!empty($user_contact['age'])) { echo $user_contact['age']; } ?></strong></label></li>
                       
                       <li><label>gender :&nbsp;<strong><?php if(!empty($user_contact['gender'])) { if($user_contact['gender'] == '1') { echo 'Male'; } else { echo 'Female'; } } ?></strong></label></li>
                       
                       <li><label>address :&nbsp;<strong><?php if(!empty($user_contact['address'])) { echo $user_contact['address']; } ?></strong></label></li>
                    
                    </ul>-->
                    
                    
                    <?php if($workdetails['user_type'] == '1') {?> 
                    
                    <ul>
                    
                        <li>
                        <h1 class="update_heading align_heading">Open to being contacted by publishers? <?php  if($workdetails['is_contacted'] == '1') { ?> YES <?php } else { ?> NO <?php } ?></h1> 
                        </li>
                    
                    </ul>
                    
                   <?php } ?>   
                    
                  </div>
           
           
         
          <h1 class="update_heading align_heading">Categories</h1>  	
          <ul id="cat_list">
            
            <?php  
            $work_cat_details =  $this->mprofile->work_categ_details($workdetails['id']);
            //echo '<pre>';print_r($work_cat_details);die;
            if(!empty($work_cat_details))
                   { 
                    foreach($work_cat_details as $catdetails) { ?>
           
            <li class="cat_id" onclick="catshow(<?php echo $catdetails['pcid']?>)"><?php echo $catdetails['category_name']?></li>
            
            
         <?php } } else {?>  
         
         <li>There are no Categories!</li>
         
         <?php } ?> 
            </ul>
            
          <div class="clear"></div>
          
         <?php if($workdetails['user_type'] == '2') {?> 
          <h1 class="update_heading align_heading">Work Type</h1> 
          <ul>
           <li>
             <?php if(!empty($work_type_details)) {
                    if($work_type_details['work_type_id'] == '1') 
                    { 
                        echo 'Fiction'; 
                    }
                    if($work_type_details['work_type_id'] == '2') 
                    { 
                        echo 'NonFiction'; 
                    } 
                } 
                else 
                { 
                    echo 'No Type'; 
                } 
             ?>
             
           </li>
          </ul>
          
          <div class="clear"></div>
          <h1 class="update_heading align_heading">Work Form</h1> 
          <ul>
           <li>
             <?php 
             if(!empty($work_type_details)) {
                
                 $fiction_details  = $this->mwork->single_fiction_details($work_type_details['work_type_id'],$work_type_details['work_form_id']);
                 if(!empty($fiction_details))
                 {
                    echo $fiction_details['work_form_name']; 
                 }
                 else
                 {
                    echo 'No Form';
                 }
              }
              else
              {
                echo 'No Form';
              }   
             ?>
             
           </li>
          </ul>
              
          <?php } ?>
                
            </div>
            
            
          <?php } ?>  
            
            <div class="profile_bot_sec_right">
            	 
              <div class="work_section_mob" id="full_content_div">
          <h1 class="update_heading align_heading">Available work on Inkubate</h1>
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
                 
                 <img src="<?=base_url()?>uploadImage/<?=$details['user_id']?>/cover_image/thumbs/<?=$details['cover_image']?>" alt="" />
                
                <?php } else { ?>
                
                <img src="<?=base_url()?>images/img_default_cover_mywork.png" alt=""  />
                
                <?php } ?>
                
                </td>
                <td width="30%" align="center" >
                <!--<a href="<?//=base_url()?>work/editWork/<?//=$details['id']?>"></a>-->
                
                <p><strong><?=$details['title']?></strong></p>
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
                <!--<a href="#openModal_<?//=$details['id']?>" class="button_pro" style="display:none">Pitchit!</a>-->
                No
                <?php } ?> 
 <?php /*<div id="openModal_<?=$details['id']?>" class="modalDialog">
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
</div> */ ?>
   
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
      </div>
      <div class="clear"></div>
          
          
        </div>
        </div>
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
      
<?=$this->load->view('template/inner_footer.php')?>      