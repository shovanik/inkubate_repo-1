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
  
 <script language="javascript" type="text/javascript">
        $(function () {
            $("#image").change(function () {
                if (typeof (FileReader) != "undefined") {
                    var profile_pic_2 = $(".profile_pic_2");
                    profile_pic_2.html("");
                    var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
                    $($(this)[0].files).each(function () {
                        var file = $(this);
                        if (regex.test(file[0].name.toLowerCase())) {
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                var img = $("<img />");
                                img.attr("style", "height:134px;width: 126px");
                                img.attr("src", e.target.result);
                                profile_pic_2.append(img);
                            }
                            reader.readAsDataURL(file[0]);
                        } else {
                            alert(file[0].name + " is not a valid image file.");
                            profile_pic_2.html("");
                            return false;
                        }
                    });
                } else {
                    alert("This browser does not support HTML5 FileReader.");
                }
            });
        });
        
        
 var editor = CKEDITOR.instances.doc_desc;
var locked;
function limitChars(evt, limit, div_id){
    var string = $("#"+div_id+" span").html();
    var lastChar = string.split(" ").pop();
    console.log(lastChar+":"+limit);
    if(parseInt(lastChar) >= limit){
        
        
                evt.cancel();
        
         
        //evt.cancel();
        //return false;
    }

}

  //jQuery load function
$(window).load(function() {
    
    
    CKEDITOR.replace( 'doc_desc',
    { 
        toolbar :[['Source'],['Cut','Copy','Paste','PasteText','SpellChecker'],['Undo','Redo','-','SelectAll','RemoveFormat'],[ 'Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink' ], ['SpecialChar','PageBreak']],
        extraPlugins : 'wordcount',
        wordcount : {
            showCharCount : true,
            showWordCount : true
            
            
        }
    });
    
    
var editor = CKEDITOR.instances.doc_desc;
editor.on( 'key', function( evt ){
    limitChars(evt, 1500, 'cke_wordcount_doc_desc');
   
}); 

})    

$(document).ready(function() {
        CKEDITOR.config.readOnly = true;
        
        $('#note_pad').click(function(){
            
            CKEDITOR.instances['doc_desc'].setReadOnly(false);
            //$('.cke_editable p').focus();
            CKEDITOR.instances['doc_desc'].focus();
        })
    });   
    </script> 

<style>
.chosen-container { margin-bottom: 10px !important; }
.titinp_box { margin-bottom: 10px !important; }

.fileContainer {
    overflow: hidden;
    position: relative;
    width: 95% !important;
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
    
}

.fileContainer [type=file] {
    cursor: pointer;
}

</style>
    
    <div class="content_part">
    
      <div class="mid_content index_sec pro">
        
        <div class="pitchits_section">
        
                  <?php
                   $usd = $this->session->userdata('logged_user');
                   $frmAttrs   = array("id"=>'signupFrm',"class"=>'form-horizontal',"name"=>'myForm');
                   echo form_open_multipart('profile/editProfile', $frmAttrs);
                   //echo '<pre/>';print_r($user_bio);die;
                   ?>
        
          <div class="profile_left1">
              <!--<h1>Jay D Gale</h1>
              <p> Member since: 5/12/2011 <br>
    Works uploaded: 1</p>-->
    
               <?php if(!empty($user_photo['filename'])) {?>
                <div class="profile_pic">
                    <img src="<?=base_url()?>uploadImage/<?=$usd['id']?>/profile/medium/<?=$user_photo['filename']?>"/>
                 </div>   
                 <?php } else {?>
                    
                <div class="profile_pic_2">
                    
                    <span class="prf_img_ins">Insert Profile Image Here</span>
                    
                 </div>
                 <?php } ?> 
                    
                
                <label class="fileContainer">
                                <span class="upld_butt" style="padding: 0 35px !important;">BROWSE</span> 
                                <input type="file" id="image" name="image" onchange="myFunction()"/>
                                
                </label>
                <span id="demo_upload"></span>
                
                
                <p class="syn_con" style="padding-top:20px;">
                Your image will appear after you click save
                </p>
          </div>
          
          <div class="profile_right1">
          
             <div class="profrgt_top">
             
               <input name="name_first" type="text" class="prfuitxtfld_box" placeholder="First Name" value="<?php if(!empty($user_contact['name_first'])) { echo $user_contact['name_first']; } ?>">
               <input name="name_last" type="text" class="prfuitxtfld_box" placeholder="Last Name" value="<?php if(!empty($user_contact['name_last'])) { echo $user_contact['name_last']; } ?>">
               
               <select name="gender" class="prfuislct_box">
               <option value="">Gender</option>
               <option value="1" <?php if($user_contact['gender'] == '1') { ?> selected <?php } ?>>Male</option>
               <option value="2" <?php if($user_contact['gender'] == '2') { ?> selected <?php } ?>>Female</option>
               </select>
               
               <input name="age" type="text" class="prfuitxtfld_box1" placeholder="Age" value="<?php if(!empty($user_contact['age'])) { echo $user_contact['age']; } ?>">
               <input name="personal_email" type="text" class="prfuitxtfld_box1" placeholder="Email" value="<?php if(!empty($user_contact['personal_email'])) { echo $user_contact['personal_email']; } ?>">
               
               <select name="user_type" class="prfuislct_box">
               <option value="">Profile Type</option>
               <option value="1" <?php if($user_contact['user_type'] == '1') { ?> selected <?php } ?>>Writer</option>
               <option value="3" <?php if($user_contact['user_type'] == '3') { ?> selected <?php } ?>>Agent</option>
               <option value="4" <?php if($user_contact['user_type'] == '4') { ?> selected <?php } ?>>Editor</option>
               <option value="2" <?php if($user_contact['user_type'] == '2') { ?> selected <?php } ?>>Publisher</option>
               </select>
               <div class="clear"></div>
               
               <input name="address" type="text" class="prfuitxtfld_box" placeholder="Street Address" value="<?php if(!empty($user_contact['address'])) { echo $user_contact['address']; } ?>">
               <input name="city" type="text" class="prfuitxtfld_box" placeholder="City" value="<?php if(!empty($user_contact['city'])) { echo $user_contact['city']; } ?>">
               
               <select name="state" class="prfuislct_box1">
               <option>State</option>
                            <option value="AL" <?php if($user_contact['state'] == 'AL') { ?> selected <?php } ?>>Alabama</option>
                        	<option value="AK" <?php if($user_contact['state'] == 'AK') { ?> selected <?php } ?>>Alaska</option>
                        	<option value="AZ" <?php if($user_contact['state'] == 'AZ') { ?> selected <?php } ?>>Arizona</option>
                        	<option value="AR" <?php if($user_contact['state'] == 'AR') { ?> selected <?php } ?>>Arkansas</option>
                        	<option value="CA" <?php if($user_contact['state'] == 'CA') { ?> selected <?php } ?>>California</option>
                        	<option value="CO" <?php if($user_contact['state'] == 'CO') { ?> selected <?php } ?>>Colorado</option>
                        	<option value="CT" <?php if($user_contact['state'] == 'CT') { ?> selected <?php } ?>>Connecticut</option>
                        	<option value="DE" <?php if($user_contact['state'] == 'DE') { ?> selected <?php } ?>>Delaware</option>
                        	<option value="DC" <?php if($user_contact['state'] == 'DC') { ?> selected <?php } ?>>District Of Columbia</option>
                        	<option value="FL" <?php if($user_contact['state'] == 'FL') { ?> selected <?php } ?>>Florida</option>
                        	<option value="GA" <?php if($user_contact['state'] == 'GA') { ?> selected <?php } ?>>Georgia</option>
                        	<option value="HI" <?php if($user_contact['state'] == 'HI') { ?> selected <?php } ?>>Hawaii</option>
                        	<option value="ID" <?php if($user_contact['state'] == 'ID') { ?> selected <?php } ?>>Idaho</option>
                        	<option value="IL" <?php if($user_contact['state'] == 'IL') { ?> selected <?php } ?>>Illinois</option>
                        	<option value="IN" <?php if($user_contact['state'] == 'IN') { ?> selected <?php } ?>>Indiana</option>
                        	<option value="IA" <?php if($user_contact['state'] == 'IA') { ?> selected <?php } ?>>Iowa</option>
                        	<option value="KS" <?php if($user_contact['state'] == 'KS') { ?> selected <?php } ?>>Kansas</option>
                        	<option value="KY" <?php if($user_contact['state'] == 'KY') { ?> selected <?php } ?>>Kentucky</option>
                        	<option value="LA" <?php if($user_contact['state'] == 'LA') { ?> selected <?php } ?>>Louisiana</option>
                        	<option value="ME" <?php if($user_contact['state'] == 'ME') { ?> selected <?php } ?>>Maine</option>
                        	<option value="MD" <?php if($user_contact['state'] == 'MD') { ?> selected <?php } ?>>Maryland</option>
                        	<option value="MA" <?php if($user_contact['state'] == 'MA') { ?> selected <?php } ?>>Massachusetts</option>
                        	<option value="MI" <?php if($user_contact['state'] == 'MI') { ?> selected <?php } ?>>Michigan</option>
                        	<option value="MN" <?php if($user_contact['state'] == 'MN') { ?> selected <?php } ?>>Minnesota</option>
                        	<option value="MS" <?php if($user_contact['state'] == 'MS') { ?> selected <?php } ?>>Mississippi</option>
                        	<option value="MO" <?php if($user_contact['state'] == 'MO') { ?> selected <?php } ?>>Missouri</option>
                        	<option value="MT" <?php if($user_contact['state'] == 'MT') { ?> selected <?php } ?>>Montana</option>
                        	<option value="NE" <?php if($user_contact['state'] == 'NE') { ?> selected <?php } ?>>Nebraska</option>
                        	<option value="NV" <?php if($user_contact['state'] == 'NV') { ?> selected <?php } ?>>Nevada</option>
                        	<option value="NH" <?php if($user_contact['state'] == 'NH') { ?> selected <?php } ?>>New Hampshire</option>
                        	<option value="NJ" <?php if($user_contact['state'] == 'NJ') { ?> selected <?php } ?>>New Jersey</option>
                        	<option value="NM" <?php if($user_contact['state'] == 'NM') { ?> selected <?php } ?>>New Mexico</option>
                        	<option value="NY" <?php if($user_contact['state'] == 'NY') { ?> selected <?php } ?>>New York</option>
                        	<option value="NC" <?php if($user_contact['state'] == 'NC') { ?> selected <?php } ?>>North Carolina</option>
                        	<option value="ND" <?php if($user_contact['state'] == 'ND') { ?> selected <?php } ?>>North Dakota</option>
                        	<option value="OH" <?php if($user_contact['state'] == 'OH') { ?> selected <?php } ?>>Ohio</option>
                        	<option value="OK" <?php if($user_contact['state'] == 'OK') { ?> selected <?php } ?>>Oklahoma</option>
                        	<option value="OR" <?php if($user_contact['state'] == 'OR') { ?> selected <?php } ?>>Oregon</option>
                        	<option value="PA" <?php if($user_contact['state'] == 'PA') { ?> selected <?php } ?>>Pennsylvania</option>
                        	<option value="RI" <?php if($user_contact['state'] == 'RI') { ?> selected <?php } ?>>Rhode Island</option>
                        	<option value="SC" <?php if($user_contact['state'] == 'SC') { ?> selected <?php } ?>>South Carolina</option>
                        	<option value="SD" <?php if($user_contact['state'] == 'SD') { ?> selected <?php } ?>>South Dakota</option>
                        	<option value="TN" <?php if($user_contact['state'] == 'TN') { ?> selected <?php } ?>>Tennessee</option>
                        	<option value="TX" <?php if($user_contact['state'] == 'TX') { ?> selected <?php } ?>>Texas</option>
                        	<option value="UT" <?php if($user_contact['state'] == 'UT') { ?> selected <?php } ?>>Utah</option>
                        	<option value="VT" <?php if($user_contact['state'] == 'VT') { ?> selected <?php } ?>>Vermont</option>
                        	<option value="VA" <?php if($user_contact['state'] == 'VA') { ?> selected <?php } ?>>Virginia</option>
                        	<option value="WA" <?php if($user_contact['state'] == 'WA') { ?> selected <?php } ?>>Washington</option>
                        	<option value="WV" <?php if($user_contact['state'] == 'WV') { ?> selected <?php } ?>>West Virginia</option>
                        	<option value="WI" <?php if($user_contact['state'] == 'WI') { ?> selected <?php } ?>>Wisconsin</option>
                        	<option value="WY" <?php if($user_contact['state'] == 'WY') { ?> selected <?php } ?>>Wyoming</option>
               </select>
               
               <select name="country" class="prfuislct_box1">
               <option value="">Country</option>
               <option value="USA">USA</option>
               </select>
               
               <input name="postal_code" type="text" class="prfuitxtfld_box1" placeholder="Postal Code" value="<?php if(!empty($user_contact['postal_code'])) { echo $user_contact['postal_code']; } ?>">
               <div class="clear"></div>
               
               <input name="company_name" type="text" class="prfuitxtfld_box" placeholder="Company Name" value="<?php if(!empty($user_contact['company_name'])) { echo $user_contact['company_name']; } ?>">
               
               <select name="industry" class="prfuislct_box1">
               <option>Industry</option>
               
               <option value="Trade_Publishing" <?php if($user_contact['industry'] == 'Trade_Publishing') { ?> selected <?php } ?>>Trade Publishing</option>
               <option value="Education_Publishing" <?php if($user_contact['industry'] == 'Education_Publishing') { ?> selected <?php } ?>>Education Publishing</option>
               <option value="Film_Publishing" <?php if($user_contact['industry'] == 'Film_Publishing') { ?> selected <?php } ?>>Film Publishing</option>
               <option value="Magazine_Publishing" <?php if($user_contact['industry'] == 'Magazine_Publishing') { ?> selected <?php } ?>>Magazine Publishing</option>
               <option value="Music_Publishing" <?php if($user_contact['industry'] == 'Music_Publishing') { ?> selected <?php } ?>>Music Publishing</option>
               <option value="News_Publishing" <?php if($user_contact['industry'] == 'News_Publishing') { ?> selected <?php } ?>>News Publishing</option>
               <option value="Self_Publishing" <?php if($user_contact['industry'] == 'Self_Publishing') { ?> selected <?php } ?>>Self Publishing</option>
               <option value="Scholarly_Publishing" <?php if($user_contact['industry'] == 'Scholarly_Publishing') { ?> selected <?php } ?>>Scholarly Publishing</option>
               <option value="STM_Publishing" <?php if($user_contact['industry'] == 'STM_Publishing') { ?> selected <?php } ?>>STM Publishing</option>
               <option value="Television_Publishing" <?php if($user_contact['industry'] == 'Television_Publishing') { ?> selected <?php } ?>>Television Publishing</option>
               <option value="Vanity_Publishing" <?php if($user_contact['industry'] == 'Vanity_Publishing') { ?> selected <?php } ?>>Vanity Publishing</option>
               
               </select>
               
               <input name="job_title" type="text" class="prfuitxtfld_box" placeholder="Job Title" value="<?php if(!empty($user_contact['job_title'])) { echo $user_contact['job_title']; } ?>">
               <div class="clear"></div>
             
             </div>
             
             <br />
             
             <?php $oth = $this->mprofile->get_user_web_link(4);?> 
             <input name="web" type="text" class="prfuitxtfld_box" placeholder="Website Url" value="<?php if(!empty($oth['url'])) { echo $oth['url']; } ?>">
             
             <?php $fb = $this->mprofile->get_user_web_link(1);?>
             <input name="facebook" type="text" class="prfuitxtfld_box" placeholder="Facebook ID" value="<?php if(!empty($fb['url'])) { echo $fb['url'];}?>">
             
             <?php $twt = $this->mprofile->get_user_web_link(2);?>
             <input name="twitter" type="text" class="prfuitxtfld_box" placeholder="Twitter Handle" value="<?php if(!empty($twt['url'])) { echo $twt['url']; }?>">
             
             <?php $rss = $this->mprofile->get_user_web_link(3);?>
             <input name="googleplus" type="text" class="prfuitxtfld_box" placeholder="Google + ID" value="<?php if(!empty($rss['url'])) { echo $rss['url']; } ?>">
             <?php $linkin= $this->mprofile->get_user_web_link(5);?>
             <input name="linkedin" type="text" class="prfuitxtfld_box" placeholder="LinkedIn ID" value="<?php if(!empty($linkin['url'])) { echo $linkin['url']; } ?>">
             <div class="clear"></div>
             
             
            
             
            
            <div class="editsec2">
            <p class="ed_icon">
            <a href="javascript:void(0)" id="note_pad" class="tooltips"><img src="<?=base_url()?>images/edit.png" alt="">
            
            <span class="tp_span" style="top: 21px !important;">Create Your Bio</span>
            
            </a></p>
              <!--<p class="syn_con">Your synopsis description will be saved when you click Save Work</p>-->
              <?php if(!empty($user_bio['biography'])) {?>
               <textarea name="desc" cols="55" rows="3" class="indexTextNormal" id="doc_desc"><?php  echo $user_bio['biography']; ?></textarea>
               <?php } else {?>
                     <textarea class="indexTextNormal" cols="80" name="desc"  id="doc_desc" > </textarea>
               <?php } ?>
            
            </div>
            
            <div class="profuislcbox_pan">
            
                <p class="prsnl_con">Additional Personal Information</p>
            
                <!--<select name="" class="prfuislct_box2"><option>Genre Interest</option></select>-->
                
                <select data-placeholder="What is Your Genre Interest?" class="chosen-select prfuislct_box2" multiple="multiple" name="cate_gory_hid[]" id="cate_gory_hid" tabindex="4">
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
                <?php
                //print_r($user_bio);die;
                ?>
                <select name="WorkTypeId" class="prfuislct_box2">
                <option>-----------Title Interest Type----------</option>
                <option value="1" <?php if(!empty($work_type_details)) { if($work_type_details['work_type_id'] == '1') { ?> selected <?php } } ?>>
                Fiction
                </option>
                <option value="2" <?php if(!empty($work_type_details)) { if($work_type_details['work_type_id'] == '2') { ?> selected <?php } } ?>>
                Non-Fiction
                </option>
                </select>
                
                <?php if($usd['user_type'] == '1') { ?>
                
                <select name="self_published" class="prfuislct_box2">
                <option value="">--------------Are You Published?---------------- </option>
                <option value="1" <?php if(!empty($user_bio['self_published'])) {if($user_bio['self_published'] == '1') { ?> selected <?php } } ?>>Yes</option>
                <option value="2" <?php if(!empty($user_bio['self_published'])) {if($user_bio['self_published'] == '2') { ?> selected <?php } } ?>>No</option>
                </select>
                
                <select name="literary_awards" class="prfuislct_box2">
                <option value="">----------Received Literary Awards?---------</option>
                <option value="1" <?php if(!empty($user_bio['literary_awards'])) {if($user_bio['literary_awards'] == '1') { ?> selected <?php } } ?>>Yes</option>
                <option value="2" <?php if(!empty($user_bio['literary_awards'])) {if($user_bio['literary_awards'] == '2') { ?> selected <?php } } ?>>No</option>
                </select>
                
                <select name="mfa_program" class="prfuislct_box2">
                <option>--------In Creative Writing MFA Program?--------</option>
                <option value="1" <?php if(!empty($user_bio['mfa_program'])) {if($user_bio['mfa_program'] == '1') { ?> selected <?php } } ?>>Yes</option>
                <option value="2" <?php if(!empty($user_bio['mfa_program'])) {if($user_bio['mfa_program'] == '2') { ?> selected <?php } } ?>>No</option>
                </select>
                
                <!--<select name="" class="prfuislct_box2"><option># of Manuscripts You Have Created</option></select>-->
               
                <input name="manuscript_total" id="manuscript_total"type="text" class="titinp_box" placeholder="# of Manuscripts You Have Created" value="<?php echo $user_contact['manuscript_total']?>" onKeyDown="limitText_manu(this.form.manuscript_total,6);" onKeyUp="limitText_manu(this.form.manuscript_total,6);">
                <input  type="text" name="cout" size="3" value="100" readonly="readonly" class="read_only" style="display: none;"/>
                <span id="manu_span" style="display: none;"></span>
                
                
                <select name="title_publish" class="prfuislct_box2">
                <option># of Titles You Have Published</option>
                <option value="1" <?php if(!empty($user_contact['title_publish'])) {if($user_contact['title_publish'] == '1') { ?> selected <?php } } ?>>1-100</option>
                <option value="2" <?php if(!empty($user_contact['title_publish'])) {if($user_contact['title_publish'] == '2') { ?> selected <?php } } ?>>101-500</option>
                <option value="3" <?php if(!empty($user_contact['title_publish'])) {if($user_contact['title_publish'] == '3') { ?> selected <?php } } ?>>501-2000</option>
                <option value="4" <?php if(!empty($user_contact['title_publish'])) {if($user_contact['title_publish'] == '4') { ?> selected <?php } } ?>>2001-5000</option>
                <option value="5" <?php if(!empty($user_contact['title_publish'])) {if($user_contact['title_publish'] == '5') { ?> selected <?php } } ?>>Over 5000</option>
                </select>
              
              <?php } if($usd['user_type'] == '2' || $usd['user_type'] == '3' || $usd['user_type'] == '4') { ?>
              
              
              <select name="interested_title" class="prfuislct_box2">
                <option value="">--------------Interested in New Titles?---------------- </option>
                <option value="1" <?php if(!empty($user_bio['interested_title'])) {if($user_bio['interested_title'] == '1') { ?> selected <?php } } ?>>Yes</option>
                <option value="2" <?php if(!empty($user_bio['interested_title'])) {if($user_bio['interested_title'] == '2') { ?> selected <?php } } ?>>No</option>
                </select>
                
                <!--<select name="" class="prfuislct_box2"><option># of Manuscripts You Have Created</option></select>-->
                <input name="manuscript_total" id="manuscript_total" type="text" class="titinp_box" placeholder="# of Manuscripts Viewed Yearly" value="<?php echo $user_contact['manuscript_total']?>">
                <span id="manu_span" style="display: none;"></span>
                
                <select name="title_publish" class="prfuislct_box2">
                <option># of Titles Published Yearly</option>
                <option value="1" <?php if(!empty($user_contact['title_publish'])) {if($user_contact['title_publish'] == '1') { ?> selected <?php } } ?>>1-100</option>
                <option value="2" <?php if(!empty($user_contact['title_publish'])) {if($user_contact['title_publish'] == '2') { ?> selected <?php } } ?>>101-500</option>
                <option value="3" <?php if(!empty($user_contact['title_publish'])) {if($user_contact['title_publish'] == '3') { ?> selected <?php } } ?>>501-2000</option>
                <option value="4" <?php if(!empty($user_contact['title_publish'])) {if($user_contact['title_publish'] == '4') { ?> selected <?php } } ?>>2001-5000</option>
                <option value="5" <?php if(!empty($user_contact['title_publish'])) {if($user_contact['title_publish'] == '5') { ?> selected <?php } } ?>>Over 5000</option>
                </select>
                
                
                <select name="offer_ebook" class="prfuislct_box2">
                <option value="">----------Do You Offer eBooks?---------</option>
                <option value="1" <?php if(!empty($user_bio['offer_ebook'])) {if($user_bio['offer_ebook'] == '1') { ?> selected <?php } } ?>>Yes</option>
                <option value="2" <?php if(!empty($user_bio['offer_ebook'])) {if($user_bio['offer_ebook'] == '2') { ?> selected <?php } } ?>>No</option>
                </select>
              
              
              <?php } ?>
            
            </div>
            <div class="clear"></div>
           
            
            
            <div class="profuibutt_sec">
                <button class="upld_butt2" type="button" style="margin-right:14%; margin-top: 0px;">Edit Profile</button>
                <button class="upld_butt2" type="submit" style="background-color:#46b8ff; margin-top: 0px;">Save Profile</button>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
             
             
          </div>
          
          <div class="clear"></div>
          
        </div>
        
      
        <div class="clear"></div>
      </div>
      <div class="clear"></div>
      

      <div class="clear"></div>
  
  <?php $work_cat_details =  $this->mprofile->work_categ_details($usd['id']); ?> 
      
  <link rel="stylesheet" href="<?=base_url()?>style/inner/chosen.css"/>
<script src="<?=base_url()?>js/chosen.jquery.js" type="text/javascript"></script>

<script type="text/javascript">
    
var maxcnt = 5 - <?php echo count($work_cat_details);?>;

if(maxcnt > 0)
{
   var maxcnt =  maxcnt;
}
else
{
  var maxcnt =  -1;   
}
    var config = {
      '.chosen-select'           : {max_selected_options: maxcnt },
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
      //alert(values);
      if( values != null)
      {
      var cat = <?php echo count($work_cat_details);?> + values.length;
      //alert(cat);
      $('#cate_cnt').text(cat);
      }
      else
      {
       var cat = <?php echo count($work_cat_details);?>;
      //alert(cat);
      $('#cate_cnt').text(cat); 
      }
 //values is an array containing all the results.
});
    }
    
 $('#manuscript_total').keyup(function(){
            
            var cvc_data = $('#manuscript_total').val();
            
            if(cvc_data == '')
            {
                $('#manu_span').css('display','none');
            }
            else
            {
              if(isNaN(cvc_data))
                {
                   
                    //alert('correct');
                    $('#manu_span').css('display','block');
                    $('#manu_span').html('<font color=red>numeric value only</font>');
                    
                    
                }
                else
                {
                   $('#manu_span').css('display','none'); 
                }
                 
            }     
        }) 
        
  function limitText_manu(limitField,limitNum) {
    if (limitField.value.length > limitNum) {
        limitField.value = limitField.value.substring(0, limitNum);
    } 
    }       
  </script>     
      
<?=$this->load->view('template/inner_footer.php')?>      