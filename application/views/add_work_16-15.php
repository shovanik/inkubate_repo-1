<?=$this->load->view('template/inner_header.php')?>
<?php $usd = $this->session->userdata('logged_user');?>
 
<script src="<?=base_url()?>ckeditor/ckeditor.js"></script>
<!--<link type="text/css" rel="stylesheet" href="<?=base_url()?>style/inner/jquery-te-1.4.0.css"/>
<script type="text/javascript" src="<?=base_url()?>js/jquery-te-1.4.0.min.js" charset="utf-8"></script>-->
 
<script  type="text/javascript" src="<?=base_url()?>js/jquery.limit.js"></script>  

<link href="<?=base_url()?>style/inner/tagit/jquery.tagit.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url()?>style/inner/tagit/tagit.ui-zendesk.css" rel="stylesheet" type="text/css"/>


<script src="<?=base_url()?>js/tag-it.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript" src="<?=base_url()?>js/jquery.validate.js"></script>
<script>
$().ready(function() {
	
	$("#signupFrm").validate({
		rules: {
			Title: "required",
            cate_gory22: "required"
			
		},
		messages: {
			firstname: "Please enter your firstname",
			lastname: "Please enter your lastname",
			username: {
				required: "Please enter a username",
				minlength: "Your username must consist of at least 2 characters"
			},
			password: {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long"
			},
			confirm_password: {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long",
				equalTo: "Please enter the same password as above"
			},
			email: {
        		required: 'Email address is required',
        		email: 'Please enter a valid email address',
        		remote: 'Email already used'
        	},
			agree: "Please accept our policy"
		}
	});

});
</script>



    <script>
        $(function(){
            
$('#add_btn').click(function(){
   
  
            $('#singleFieldTags').tagit({
                //availableTags: sampleTags,
                // This will make Tag-it submit a single form value, as a comma-delimited field.
                singleField: true,
                tagLimit          : 5 
                //singleFieldNode: $('#mySingleField')
            });
            
            $('.add_btn').css('display','none');
            $('#add_btn').removeClass('add_btn');
            
            $('.add_btn2').css('display','block');
            $('#add_btn').addClass('add_btn2');
            
           }); 
         });
      </script>      

<script type="text/javascript">
		$(document).ready( function() {
            
           
         //$("#txtEditor").Editor(); 
         //$("#txtEditor22").Editor();
         
         
         $('#Fiction').click(function(){
            
            
            var fiction = $('#Fiction').val();
            //alert(fiction);
            
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
       
       
    });
    
    
  //jQuery load function
$(window).load(function() {
	CKEDITOR.replace( 'doc_desc',
		{ 
		toolbar :[['Source'],['Cut','Copy','Paste','PasteText','SpellChecker'],['Undo','Redo','-','SelectAll','RemoveFormat'],[ 'Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink' ], ['SpecialChar','PageBreak']]
	});
function textCounter2(field, countfield, maxlimit)
{
	if (field.value.length > maxlimit) // if too long...trim it!
		field.value=field.value.substring(0, maxlimit);
	else  // otherwise, update counter
		countfield.value=field.value.length;
}
var editor = CKEDITOR.instances.doc_desc;
editor.on( 'key', function( evt ){
   // Update the counter with text length of editor HTML output.
   textCounter2( { value : evt.editor.getData() },this.form.grLenght2, 100 );
}, editor.element.$ );
// Whether content has exceeded the maximum characters.
var locked;
editor.on( 'key', function( evt ){
 
   var currentLength = editor.getData().length,
      maximumLength = 100;
   if( currentLength >= maximumLength )
   {
      if ( !locked )
      {
         // Record the last legal content.
         editor.fire( 'saveSnapshot' ), locked = 1;
                        // Cancel the keystroke.
         evt.cancel();
      }
      else
         // Check after this key has effected.
         setTimeout( function()
         {
            // Rollback the illegal one.  
            if( editor.getData().length > maximumLength )
               editor.execCommand( 'undo' );
            else
               locked = 0;
         }, 0 );
   }
	});
    
/*--------------Excerpt--------------*/    
    
 CKEDITOR.replace( 'doc_desc_22',
		{ 
		toolbar :[['Source'],['Cut','Copy','Paste','PasteText','SpellChecker'],['Undo','Redo','-','SelectAll','RemoveFormat'],[ 'Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink' ], ['SpecialChar','PageBreak']]
	});
function textCounter2_22(field, countfield, maxlimit)
{
	if (field.value.length > maxlimit) // if too long...trim it!
		field.value=field.value.substring(0, maxlimit);
	else  // otherwise, update counter
		countfield.value=field.value.length;
}
var editor22 = CKEDITOR.instances.doc_desc_22;
editor22.on( 'key', function( evt22 ){
   // Update the counter with text length of editor HTML output.
   textCounter2_22( { value : evt22.editor.getData() },this.form.grLenght2_22, 500 );
}, editor.element.$ );
// Whether content has exceeded the maximum characters.
var locked_22;
editor22.on( 'key', function( evt22 ){
 
   var currentLength_22 = editor.getData().length,
      maximumLength_22 = 500;
   if( currentLength_22 >= maximumLength_22 )
   {
      if ( !locked_22 )
      {
         // Record the last legal content.
         editor.fire( 'saveSnapshot' ), locked_22 = 1;
                        // Cancel the keystroke.
         evt22.cancel();
      }
      else
         // Check after this key has effected.
         setTimeout( function()
         {
            // Rollback the illegal one.  
            if( editor.getData().length > maximumLength_22 )
               editor.execCommand( 'undo' );
            else
               locked_22 = 0;
         }, 0 );
   }
	}); 
    
});  
  </script>

<script language="javascript" type="text/javascript">
function limitText(limitField, limitCount, limitNum) {
	if (limitField.value.length > limitNum) {
		limitField.value = limitField.value.substring(0, limitNum);
	} else {
		limitCount.value = limitNum - limitField.value.length;
	}
}
</script>

<script>
  $(function() {
    $( "#dialog" ).dialog({
      autoOpen: false,
      show: {
        effect: "blind",
        duration: 1000
      },
      hide: {
        effect: "explode",
        duration: 1000
      }
    });
 
    $( "#opener" ).click(function() {
      $( "#dialog" ).dialog( "open" );
    });
    
  });
  </script>
  
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

function myFunction1(){
    //alert('hi');
    var x = document.getElementById("image1");
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
    document.getElementById("demo_upload1").innerHTML = txt;
}
</script>

<script>
	$(document).ready( function() {
	   
       $('.edit_syn #contentarea').keyup(function(){
        
         var synop = $('.edit_syn #contentarea').html(); 
         $('#synopsis').val(synop); 
        
        });
         
       $('.edit_exp #contentarea').keyup(function(){
        
         var excerpt = $('.edit_exp #contentarea').html(); 
         $('#excerpt').val(excerpt);
         
        });  
         
   })
</script>

<style>
.counter{
    color: red;
}
</style>

<style type="text/css">
#signupFrm label.error {
	margin-left: 100px;
	width: auto;
	display: inline;
        color:#ff0000;
}
@media only screen and (min-width : 320px) and (max-width : 650px),
only screen and (min-device-width: 320px) and (max-device-width: 650px){
#signupFrm label.error { margin-left: 0 !important;}
}

@media only screen and (min-width : 651px) and (max-width : 800px),
only screen and (min-device-width: 651px) and (max-device-width: 800px){
#signupFrm label.error { margin-left: 0 !important;}
}
</style>

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
    /*padding: .5em;*/
}

.fileContainer [type=file] {
    cursor: pointer;
}

</style> 
 
                
            <div class="content_part">
            	
               
                <div class="contact">
              
                	<div class="contact_conternt">
                    
                    
                    
                    	<div class="contact_conternt_left reg_left new_add">
                            <!--<h2>Request an Invitation</h2>-->
                                                    
                            
                           	 <!--<div class="contact_form">
                                <label>Name</label>
                                	<div class="frm_bond">
                              	 		<select class="reg_info_select">
                                	<option>option1</option>
                                    <option>option2</option>
                                </select>
                                	</div>
                                <label>Email</label>
                                	<div class="frm_bond">
                                		<input type="text" class="reg_info_tbox">
                                    </div>
                                <label>Confirm Email</label>
                                	<div class="frm_bond">
                                		<input type="text" class="reg_info_tbox">
                                    </div>
                                 <label>
                                 	Tell us about your work (optional)<br>
(500 character maximum; including spaces)
                                 </label>
                                 <div class="frm_bond">
                                		<textarea class="reg_info_tarea"></textarea>
                                    </div>
                                    <p>Characters Remaining: 1499</p>
                               
                               <div class="clear"></div>
                            </div>-->
                            
                            <div class="blue_back1">
                            <img alt="" src="<?=base_url()?>images/cup_icon.jpg"/>
                            <span class="wl_con">
                            Welcome <?=$usd['name_first']?>. This area of Inkubate is where you can upload and store your manuscripts for other Inkubate members to analyze and review your work. Please make sure to fill in as much detail as possible about your title, so your manuscripts and their associated metadata are easily discoverable by other Inkubate members. Please upload as many manuscripts as you like, there is no limit to what you can store within Inkubate. Thanks again for using Inkubate!
                            </span>
                            
                            <!--<span class="wl_con">
                            Welcome <?//=$usd['name_first']?> : This area of Inkubate is where you can upload, categorize, edit and store your manuscripts. Please make sure to fill in as much detail as possible about your titles, so that your works and associated metadata are easily discoverable by agents, editors and publishers.  Also, be sure to complete your bio and upload your photo. Your work is protected within Inkubate's secure platform! We're glad that you're here!
                            </span>-->
                            
                            <div class="clear"></div>
                            </div>
                            
                           <?php
                               $frmAttrs   = array("id"=>'signupFrm',"class"=>'form-horizontal');
                               echo form_open_multipart('work/addWork', $frmAttrs);
                             ?> 
                            
                            <div class="edit_pan">
                            <div class="editor-label">
                              <label for="Title" class="xyz">Title</label>
                            </div>
                            </div>
                            
                            
                 <div class="editor-field field-title">
                 
				<input type="text" value="" name="Title" id="Title" title="The Title field is required." data-val-length-max="100" data-val-length="Please use 100 characters or less." data-val="true" class="input_box1" onKeyDown="limitText(this.form.Title,this.form.cout,100);" onKeyUp="limitText(this.form.Title,this.form.cout,100);"/>
                <div class="ctr">Characters Remaining: <em><input  type="text" name="cout" size="3" value="100" readonly="readonly" class="read_only"/></em></div>
                
			    </div>
            
            
            
            
                        <div class="narrow-content-block">
                          
                          <div class="editor-label" style="margin-top:20px;">
					<label for="Synopsis" class="xyz">Synopsis</label>
					<p class="comment">Enter a short description of your work here.</p>
				</div>  
                
                  
                  <div class="edit_syn">
                  <!--<textarea name="synopsis" id="synopsis" class="jqte-test" ></textarea>
                  <textarea class="ckeditor" cols="80" name="synopsis"  id="editor2" ></textarea>-->
                  
                  <textarea name="synopsis" cols="55" rows="3" class="indexTextNormal" id="doc_desc" onkeydown="textCounter2(this.form.synopsis,this.form.grLenght2,100);" onkeyup="textCounter2(this.form.synopsis,this.form.grLenght2,100);"></textarea>
            <p>Length: <input readonly="readonly"  type="text" name="grLenght2" size="3" maxlength="3" value="0" class="read_only" /> (maximum <b>100</b> characters)</p>
                  
                  <!--<span  id="mincounter_syn">Characters : <span id="syn_cnt">100</span></span>
                  <span  id="counter_syn" style="display: none;">max 100 characters</span>-->
                 </div>
    
                  
                  
                  
                   <div class="editor-label">
					<label for="Synopsis" class="xyz">Excerpt</label>
					<p class="comment">Enter a longer sample of your work here (optional for artists).</p>
				</div>  
                
              
                  
                  <div class="edit_exp">
                  <!--<textarea name="excerpt" id="excerpt" class="jqte-test"></textarea>
                  <textarea class="ckeditor" cols="80" name="excerpt"  id="editor2" > </textarea>-->
                  
                  
                 <textarea name="excerpt" cols="55" rows="3" class="indexTextNormal" id="doc_desc_22" onkeydown="textCounter2_22(this.form.excerpt,this.form.grLenght2_22,500);" onkeyup="textCounter2_22(this.form.excerpt,this.form.grLenght2_22,500);"></textarea>
            <p>Length: <input readonly="readonly"  type="text" name="grLenght2_22" size="3" maxlength="3" value="0" class="read_only" /> (maximum <b>500</b> characters)</p> 
                  
                  
                  <!--<span  id="mincounter_exp">Characters : <span id="exp_cnt">500</span></span>
                  <span  id="counter_exp" style="display: none;">max 500 characters</span>-->
                  </div>
              
                            
                         
                         
                     <div style="background-color: #eeeeee; border: 1px solid #cccccc; padding-bottom: 5px; margin-top:20px; padding-left:5px;">
				    <!-- field block: asset -->
				        <div class="editor-label field-upload" style="margin-top:7px;">
					        <label class="xyz">Upload file</label>
					        <p class="comment1">Use this to add illustrations, text files or other material that will help  explain your work. If you have a complete manuscript, you should upload that.</p>
                            <p class="comment1">Allowed File Formats: DOC, DOCX, PDF</p>
				        </div>
				       <!-- <div class="editor-field btn-upload work-upload">
					        <div class="field-validation-error no-display tooBig">File is too big</div>
					        <div class="field-type-validation-error no-display wrongType">File must be ZIP, DOC, TXT, RTF, SCRIV, PAGES, TEX or PDF</div>-->
									
                            <div class="attachmentUpload"><div class="qq-uploader">
                            <!--<div class="qq-upload-drop-area" style="display: none;"><span>Drop files here to upload</span></div>-->
                            <div class="qq-upload-button" style="position: relative; overflow: hidden; direction: ltr;">
                            
                            <label class="fileContainer">
                                Browse 
                                <input type="file" id="image1" name="image1" onchange="myFunction1()"/>
                                
                            </label>
                            
                            </div>
                            <span id="demo_upload1"></span>
                            <div class="qq-upload-max-size">Maximum size: 25MB</div><ul class="qq-upload-list"></ul></div></div>
                            <!--<input type="hidden" name="fileWork" id="fileWork">-->

					        <!--<div class="file-upload-details no-display">
						        <img class="no-display image-set" alt="" src="http://www.inkubate.com/Content/img/interface/icon-yes.jpg">
						        <span></span>
					        </div>-->
				        </div>
                        
                        
                        <div class="block clearfix" style="margin-top:20px;">
                    <input type="checkbox" checked="&quot;checked&quot;" name="VisibilityId" class="questions" id="chkVisibilityId" value="1"/>
                    <label for="chkVisibilityId" class="xyz">Make this work visible to publishers</label>
                </div>
                        
                   <div class="editor-field btn-upload work-upload">
                <div class="buttons clearfix">
				    <span class="button button-large button-margin">
                    <input type="button" value="Cancel" name="command" type="submit" class="not-bold cancel" style="margin-right:6px;"/>
                    </span>	
                    <span class="button button-large button-check"><button class="form-save" value="Save" name="command" type="submit">Save Work</button></span>
                </div>
                </div>     
                        
                        
                        
                        
                </div>    
                         
                         
                         
                         
                         
                         
                            
                            
                   </div>         
                            
                        

                        </div>
                          
                        
                        
                        <div id="focus">
	<div class="focus-block work-properties">

		<!-- block -->
        
        
         <div class="top_welcome_section_right1">
         
          <?php if(!empty($user_photo['filename'])) {?>
                    <img src="<?=base_url()?>uploadImage/<?=$usd['id']?>/profile/<?=$user_photo['filename']?>" class="img_sz"/>
                 <?php } else {?>
                     <img src="<?=base_url()?>images/img_default_headshot.png" class="img_sz"/>
                 <?php } ?> 
                 
            <p><strong>Welcome</strong></p>
            <p><span><?php echo $usd['name_first'].' '.$usd['name_middle'].' '.$usd['name_last'];?></span><br/>
              Member since <?php echo date('d F Y',strtotime($usd['created']))?></p>
          </div>
          
          <div class="clear"></div>
        
        
        
		<!--<div class="block block-first" >
        
			<div class="buttons clearfix">
				<span class="button button-large button-margin">
                <input type="button" value="Cancel" name="command" type="submit" class="not-bold cancel" style="margin-right:7px;"/>
                </span>				
				<span class="button button-large button-check"><button class="form-save" value="Save" name="command" type="submit">Save Work</button></span>			
			</div>
		</div>-->

		<!-- block [type of work] -->
		<div class="block block-type-of-work">
			<h3>Format</h3>
            
			<div class="label-inline  clearfix ">
				<input type="radio" class="xyz" checked="checked" value="1" name="WorkTypeId" id="Fiction"/>
				<label for="rdoWorkTypeIdFiction" class="xyz">Fiction</label>
				<input type="radio" class="xyz" value="2" name="WorkTypeId" id="NonFiction"/>
				<label for="rdoWorkTypeIdNonFiction" class="xyz">Non-Fiction</label>
			</div>

			<select name="WorkFormId" class="input_box" id="work_form">
            
            <option value="0">----Genre----</option>
            
            <?php if(!empty($fiction_details)) {
                foreach($fiction_details as $each=>$details){
                ?>
				<option value="<?php echo $details['work_form_id']?>"><?php echo $details['work_form_name']?></option>
			<?php } } ?>		
			
			</select>
            
		</div>
        
        

		<!-- field block [categories] -->

		<div data-max-category-count="3" class="block block-categories clearfix">
        
           <label class="xyz">Categories</label>
           
			<!--<label class="xyz">Categories (<span class="category-assigned-count" id="cate_cnt">0</span>/3)</label>
			<a class="nohover action" id="opener" style="cursor: pointer;" ><strong>(see all)</strong></a>-->
			<div>
				<!--<div class="field-validation-error no-display">No Matching Categories</div>-->
                
          <select data-placeholder="Choose a Category..." class="chosen-select input_box" multiple="multiple" name="cate_gory_hid[]" id="cate_gory_hid" tabindex="4">
            <option value=""></option>
            
            <?php
            if(isset($category_details) && count($category_details) > 0)
            {
                //echo '<pre/>';print_r($category_details);
                $i=0;
                foreach($category_details as $eachList)
                {
            ?> 
            
            <option value="<?php echo $eachList['id']?>"><?php echo $eachList['category_name']?></option>
            <?php } } ?>
            </select>
                
                
				<!--<input type="text" class="input_box" name="cate_gory22" value="" id="cate_gory22" title="The category field is required." />
                <input type="hidden" class="input_box" name="cate_gory_hid" value="" id="cate_gory_hid" title="The category field is required." />-->
                
				<!--<span class="button button-small"><input type="button" value="Add" class="add_btn"/></span>-->
			</div>
			<span class="note">Start typing a category (eg. Young Adult)</span><br/>
			<!--<span class="note">Once you have selected a category, you must click 'Add'.</span>-->
            
            <span class="category"></span>
            
			<!-- list of cat -->
			<ul class="term-list">
			</ul>
            <input type="hidden" value="" name="WorkCategoriesString" id="WorkCategoriesString" data-val-required="Please select a category" data-val="true"/>
		</div>

		<!-- field block [tags] -->
		<div data-max-tag-count="5" class="block block-tags clearfix">
			<!--<label class="xyz">Tags (<span class="tag-assigned-count">0</span>/5)</label>
			<a href="#" class="action">see all</a>-->
            <label class="xyz">Tags (max 5)</label>
			<div>
				<input type="text" class="input_box" name="tags" id="singleFieldTags"/>
				<span class="button button-small">
                
                <input type="button" value="Add" class="add_btn" id="add_btn"/>
                <div class="clear"></div>
                 
                </span>
			</div>
			<p class="note">Enter word(s) to describe your work</p>
            <span class="button-small"><input type="button" value="Add" class="add_btn2" id="add_btn" style="display: none;"/></span>
                
                
			<!-- list of tags -->
            <span id="singleFieldTags"></span>
			<ul class="term-list">
			</ul>
		</div>

		<!-- field block [cover] -->
		<div class="block block-cover clearfix">
			<label class="xyz">Add a cover (optional)</label>
			<!--<div class="field-validation-error no-display tooBig">File is too big</div>
			<div class="field-type-validation-error no-display wrongType">File must be GIF, JPG, or PNG</div>-->
			<div class="thumb">
				<!--<img class="no-display image-set" alt="" src="http://www.inkubate.com/Content/img/interface/icon-yes.jpg">-->
				<img width="50" src="http://www.inkubate.com/Content/img/content/img_default_cover.png" class="placeholder"/><br />
                <span id="demo_upload"></span>
	         </div>
    
            <div class="upload"><div class="qq-uploader">
            <!--<div class="qq-upload-drop-area" style="display: none;"><span>Drop files here to upload</span></div>-->
            <div class="qq-upload-button" style="position: relative; overflow: hidden; direction: ltr;">
            
                 <label class="fileContainer">
                    Browse 
                    <input type="file" id="image" name="image" onchange="myFunction()"/>
                    
                </label>
                                                
            </div>
            <ul class="qq-upload-list"></ul></div></div>
                <input type="hidden" name="fileCover" id="fileCover">
			<span class="note clear">Maximum size of 4MB: GIF, JPG, PNG</span>
                    <span class="note clear">Don't worry, your image will appear after you save these edits.</span>
		</div>

        <!-- field block [questions] -->
        <div class="block clearfix">
            <input type="checkbox" value="1" name="SelfPublished" id="SelfPublished" title="The Is this work self-published? field is required." data-val="true" class="questions"/>
            
            <label for="SelfPublished" class="xyz">Is this work self-published?</label>
        </div>
        <div class="block clearfix">
            <input type="checkbox" value="1" name="ReceivedAwards" id="ReceivedAwards" title="The Has this work received any awards? field is required." data-val="true" class="questions"/>
            
            <label for="ReceivedAwards" class="xyz">Has this work received any awards?</label>
        </div>
        <div class="block clearfix">
            <input type="checkbox" value="1" name="BeenReviewed" id="BeenReviewed" title="The Has this work been reviewed? field is required." data-val="true" class="questions"/>
            
            <label for="BeenReviewed" class="xyz">Has this work been reviewed?</label>
        </div>
        <div class="block clearfix">
            <input type="checkbox" value="1" name="PublishedAbroad" id="PublishedAbroad" title="The Has this work been published abroad? field is required." data-val="true" class="questions"/>
            
            <label for="PublishedAbroad" class="xyz">Has this work been published abroad?</label>
        </div>

        <!-- field block [contest entry] 
        <div class="block clearflix" id="contest-entry-block" style="display: none;">
            <input class="questions" data-val="true" data-val-required="The Enter in contest field is required." id="IsContestEntry" name="IsContestEntry" type="checkbox" value="true" /><input name="IsContestEntry" type="hidden" value="false" />
            <label for="IsContestEntry">Enter in contest</label>
			After checking box, scroll up to agree to Terms of Use.        
        </div>-->
        <div class="block clearfix">
			<div class="buttons clearfix">
				<span class="button button-large button-margin">
                <input type="button" value="Cancel" name="command" type="submit" class="not-bold cancel" style="margin-right:6px;"/>
                </span>				
				<span class="button button-large button-check"><button class="form-save" value="Save" name="command" type="submit">Save Work</button></span>		
			</div>
        </div>

	</div>
    
<div id="dialog" title="All Categories">

<script>
$(document).ready(function () {
   $("input[name='chk']").change(function () {
      var maxAllowed = 3;
      var cnt = $("input[name='chk']:checked").length;
      //alert(cnt)
        $('#cate_cnt').text(cnt);
        
         var favorite = [];
         var favorite1 = [];
         
         
         if (cnt <= maxAllowed) 
      { 
            $.each($("input[name='chk']:checked"), function(){            
                favorite.push($(this).val());
            });
           $('#cate_gory22').val(favorite.join(", ")); 
           
           $.each($("input[name='chk']:checked"), function(){            
                favorite1.push($(this).data('fruit'));
            });
           $('#cate_gory_hid').val(favorite1.join(", ")); 
          //alert("My favourite sports are: " + favorite.join(", "));
       } 
      else if (cnt > maxAllowed) 
      {
        //alert($('#cate_gory22').val());
        $('#cate_cnt').text(cnt-1);
        
        /*var str = favorite.splice(0, 3);
        //var str = $('#cate_gory22').val();
        //str = str.substring(0, str.length - 3);
        $('#cate_gory22').val(str); 
        
        var str1 = favorite1.splice(0, 3);
        $('#cate_gory_hid').val(str1);*/
        
         $(this).prop("checked", "");
         alert('Select maximum ' + maxAllowed + ' categories!');
     }
     else{
        alert('error!');
     }
     //$(document).trigger('close.facebox');
  });

  
});
</script>



    <!--<h2>All Categories</h2>
    <h4>select upto 3 categories</h4>-->
    <div style="height: 500px; overflow-y: scroll;overflow-x: hidden; ">
    
    <form name='joe' id="form1">
    <?php
    if(isset($category_details) && count($category_details) > 0)
    {
        //echo '<pre/>';print_r($category_details);
        $i=0;
        foreach($category_details as $eachList)
        {
    ?>    
        <span class="showCategory" data-num="<?php echo $i?>" style="background: #d0e6fe;color:#333;border-radius:4px;padding: 5px;margin: 0 10px 5px 0;cursor:pointer; float: left;width:89% ;">
        <!--<input type='checkbox' name='chk' value='<?php //echo $eachList['category_name']?>' data-fruit='<?php //echo $eachList['id']?>'/>-->
        <?php echo word_wrap($eachList['category_name'],30)?></span>
        
    <?php
        $i++;
        if($i%2==0)
        {
            ?>
            <div class="clear" style="margin-bottom: 10px;"></div>
            <?php
        }
        }
    }
    ?>
        <!--<input name="button" type="submit" value="Send" /> <input name="button" type="button" value="Cancel" class="white" onclick="cancl()" />-->
        </form>
        
       
        </div>
    
</div>

  
</div>


                     
                        
                        <div class="clear"></div>
                    </div>
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
  
  <script>
	//$('.jqte-test').jqte();
	
  </script>  
              
<?=$this->load->view('template/inner_footer.php')?>           

