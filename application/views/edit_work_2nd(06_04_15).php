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
		},
       
       errorPlacement: function(error, element) { error.appendTo($(".error_title")); } 
        
	});

});
</script>

  
  <?php 
        //echo '<pre/>';print_r($single_work_details);die;
         if(!empty($single_work_details))
           {
            
            foreach($single_work_details as $workdetails)
            {
                 
            $work_tag_details = $this->mwork->work_tags_details($workdetails['id']);
            $cnt_wrk_tag = count($work_tag_details); 
            
            
             $synopsis_len = strlen($workdetails['synopsis']);
             //echo $synopsis_len;die;
             $rest_len22 = 500 - $synopsis_len;
             
             $extract_len = strlen($workdetails['extract']);
             $rest_len23 = 1000 - $extract_len;
            
        ?>


    <script>
        $(function(){
            
$('#add_btn').click(function(){
   
   var tagcnt = <?php echo $cnt_wrk_tag;?>;
         var mintag = 5 - tagcnt;
         //alert(tagcnt);
         if(tagcnt >= 5) {
            
            alert('Already have 5 Tags');
            
            }
          else{
            
            $('#singleFieldTags').tagit({
                //availableTags: sampleTags,
                // This will make Tag-it submit a single form value, as a comma-delimited field.
                singleField: true,
                tagLimit          :  mintag
                //singleFieldNode: $('#mySingleField')
             });
             
            /*$('.add_btn').css('display','none');
            $('#add_btn').removeClass('add_btn');
            
            $('.add_btn2').css('display','block');
            $('#add_btn').addClass('add_btn2');*/  
             
          }
            
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
    
  function fiction_type(id)
  {
    //var nonfiction = $('#NonFiction').val();
            //alert(fiction);
            
       if(id != '')
       {
            
        $.ajax({
           url      : '<?=base_url()?>'+'work/details',
           type     : 'POST',
           data     : { 'id': id },
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
        
      }  
  }  

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
    limitChars(evt, 100, 'cke_wordcount_doc_desc');
   
});   
/*--------------Excerpt--------------*/    
    
    CKEDITOR.replace( 'doc_desc_22',
    { 
        toolbar :[['Source'],['Cut','Copy','Paste','PasteText','SpellChecker'],['Undo','Redo','-','SelectAll','RemoveFormat'],[ 'Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink' ], ['SpecialChar','PageBreak']],
        extraPlugins : 'wordcount',
        wordcount : {
            showCharCount : true,
            showWordCount : true
        }
    });
    

var editor22 = CKEDITOR.instances.doc_desc_22;
// Whether content has exceeded the maximum characters.
editor22.on( 'key', function( evt22 ){
    limitChars(evt22, 500, 'cke_wordcount_doc_desc_22');
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

<script language="javascript" type="text/javascript">
        $(function () {
            $("#image").change(function () {
                if (typeof (FileReader) != "undefined") {
                    var profile_pic = $(".profile_pic");
                    profile_pic.html("");
                    var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
                    $($(this)[0].files).each(function () {
                        var file = $(this);
                        if (regex.test(file[0].name.toLowerCase())) {
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                var img = $("<img />");
                                img.attr("style", "height:134px;width: 126px");
                                img.attr("src", e.target.result);
                                profile_pic.append(img);
                            }
                            reader.readAsDataURL(file[0]);
                        } else {
                            alert(file[0].name + " is not a valid image file.");
                            profile_pic.html("");
                            return false;
                        }
                    });
                } else {
                    alert("This browser does not support HTML5 FileReader.");
                }
            });
        });
    </script>
    
  <script>
	//$('.jqte-test').jqte();
	 function tagshow_new(tag){
            
            //event.preventDefault();
            //var tag   = $(this).attr('data-tag');
            //var tagid   = $(this).attr('data-tagid');
            //alert(tag);
           
            $.ajax({
           url      : '<?=base_url()?>'+'work/tag_details',
           type     : 'POST',
           data     : { 'id': tag, 'wid':<?php echo $workdetails['id'] ?>},
           success  : function(resp){
            //alert(resp);
            var data = resp.split("@");
            //alert(data[0]);
            //alert(data[1]);
                if(resp != '0'){
                    $(".tag_detail").html(data[1]);
                    //$("#edit_class" ).dialog( "close" );
                }
           },
           error    : function(resp){
                $.prompt("Sorry, something isn't working right.", {title:'Error'});
           }
        });
      } 
      
     
   function catshow(cat){
        
           // var cat   = $(this).attr('data-cat');
            //alert(<?php echo $workdetails['id'] ?>);
           
            $.ajax({
           url      : '<?=base_url()?>'+'work/cat_details',
           type     : 'POST',
           data     : { 'id': cat, 'wid':<?php echo $workdetails['id'] ?> },
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
.counter{
    color: red;
}
</style>

<style type="text/css">
#signupFrm label.error {
	margin-left: 1px;
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
ul.tagit {height: auto; margin-right: 2%; float: left;}
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
    
    border-radius: 5px !important;
    float: left;
    /*padding: .5em;*/
}

.fileContainer [type=file] {
    cursor: pointer;
}


.fileContainer1 {
    overflow: hidden;
    position: relative;
    
}

.fileContainer1 [type=file] {
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

.fileContainer1 {
    
    border-radius: 5px !important;
    float: left;
    /*padding: .5em;*/
}

.fileContainer1 [type=file] {
    cursor: pointer;
}
.chosen-container{ margin-top: 12px;}
.chosen-container-multi .chosen-choices {width: 164% !important;}
.cke_chrome{margin-top:10px !important;}

</style> 
 
<script type="text/javascript">
$(document).ready(function(){
  $("cate_gory_hid_chosen ul").prepend("<li class="search-choice"><span>Action &amp; Adventure</span><a class="search-choice-close" data-option-array-index="2"></a></li>")
})
</script>          
          
          <div class="content_part">
      <div class="mid_content index_sec pro">
        
        <div class="pitchits_section">
        
                <?php
                   $frmAttrs   = array("id"=>'signupFrm',"class"=>'form-horizontal');
                   echo form_open_multipart('work/editWork', $frmAttrs);
                ?> 
           <input type="hidden" name="wid" id="wid" value="<?php echo $this->uri->segment(3);?>" />     
          <div class="profile_left1">
              <!--<h1>Jay D Gale</h1>
              <p> Member since: 5/12/2011 <br>
    Works uploaded: 1</p>-->
    
                 <?php if($workdetails['cover_image'] != '') { ?>
                 
                 <div class="profile_pic">
                 
                 <img src="<?=base_url()?>uploadImage/<?=$usd['id']?>/cover_image/medium/<?=$workdetails['cover_image']?>" alt="" />
                     
                 </div>
                
                <?php } else { ?>
                
               
                <div class="profile_pic_2"> 
                
                <span class="prf_img_ins"><?php echo $workdetails['title'];?> </span>
                
                </div>
                
                <?php } ?>
                
                
                <label class="fileContainer">
                                <span class="upld_butt">UPLOAD COVER</span> 
                                <input type="file" id="image" name="image" onchange="myFunction()"/>
                                
                </label>
                <span id="demo_upload"></span>
                                
                <p class="syn_con" style="padding-top:5px;">Max size-4MB
     Your image will appear after you click Save work.</p>
          </div>
          
              <?php 
                 
                 $title_len = strlen($workdetails['title']);
                 $rest_len = 100 - $title_len;
                 
               ?>
          
          <div class="profile_right1">
              
           <!--<input name="" type="text" class="titinp_box" placeholder="Title Name">-->
           <span class="tit_pan1">
           <input type="text" value="<?php echo $workdetails['title'];?>" name="Title" id="Title" title="The Title field is required." data-val-length-max="100" data-val-length="Please use 100 characters or less." data-val="true" class="titinp_box" onKeyDown="limitText(this.form.Title,this.form.cout,100);" onKeyUp="limitText(this.form.Title,this.form.cout,100);" placeholder="Title Name"/>
           
            <p class="ctr">Characters Remaining: <em><input  type="text" name="cout" size="3" value="<?php echo $rest_len;?>" readonly="readonly" class="read_only"/></em></p>
            
            <p class="ctr"><span class="error_title"></span></p>  
            </span>
            
           
           <!--<input name="" type="text" class="titinp_box" placeholder="Title Tag">-->
           
           <span class="tit_pan1">
           
           <input type="text" class="titinp_box" name="tags" id="singleFieldTags" placeholder="Title Tags"/>
           
           <input type="button" value="Add" class="add_btn1" id="add_btn"/>
           <span class="tag">(5 Title Tag Maximum)</span>
           
           <span class="button-small"><input type="button" value="Add" class="add_btn2" id="add_btn" style="display: none;"/></span> 
           
           
           <p class="tag_detail">
             <?php 
                 $work_tag_details = $this->mwork->work_tags_details($workdetails['id']);
                 //echo '<pre/>';print_r($work_tag_details);die;
                  if(!empty($work_tag_details))
                   {
                    foreach($work_tag_details as $tagdetails) {
                    ?>
             <span class="cat_id" onclick="tagshow_new('<?php echo $tagdetails['id']?>')"><?php echo $tagdetails['tag_name']?></span>
            
            
            <?php } } ?>   
            </p>
              
            <span id="singleFieldTags"></span>
			<ul class="term-list">
			</ul>
            
            </span>
           
            
             <span class="tit_pan1">
             
                <select name="WorkTypeId" class="titinp_box1" id="WorkTypeId" onchange="fiction_type(this.value)">
           <option value="">---Title Type---</option>
           <option value="1" <?php if($workdetails['work_type_id'] == '1') { ?>selected="selected" <?php } ?>>Fiction</option>
           <option value="2" <?php if($workdetails['work_type_id'] == '2') { ?>selected="selected" <?php } ?>>Non-Fiction</option>
           </select>
             
             
             
             </span>
           
           
           
             <div class="clear"></div> 
            
          
          
           
           
           
             <span class="tit_pan1">
           
           <select class="titinp_box2" name="WorkFormId" id="work_form">
           
           <?php 
            
            //$form_details = $this->mwork->work_form_details($workdetails['work_type_id']);
            
            if(!empty($form_details)) {
                foreach($form_details as $each=>$details){
                ?>
				<option value="<?php echo $details['work_form_id']?>" <?php if($workdetails['work_form_id'] == $details['work_form_id']){?>selected="selected"
                <?php } ?>><?php echo $details['work_form_name']?></option>
			<?php } } else {?>
            
            <option value="">---Title Formats---</option>
            
            <?php } ?>
           
           </select>
           
           </span>
           <!--<select name="" class="titinp_box3"><option>Gene Categories</option></select>-->
           
            <span class="tit_pan2">
           
           <select data-placeholder="Genere Categories..." class="chosen-select titinp_box3" multiple="multiple" name="cate_gory_hid[]" id="cate_gory_hid" tabindex="4">
            <option value=""></option>
            
            <?php
            //$category_details  = $this->mwork->category_details(2);
            if(isset($category_details) && count($category_details) > 0)
            {
                //echo '<pre/>';print_r($category_details);
                $i=0;
                foreach($category_details as $eachList)
                {
                $wrk_cat = $this->mwork->work_cat_select($workdetails['id'],$eachList['id']);
                if(isset($wrk_cat) && $wrk_cat > 0)
                {
            ?> 
            <option value="<?php echo $eachList['id']?>" style="display: none;"><?php echo $eachList['category_name']?></option>
            <?php } else {?>
            <option value="<?php echo $eachList['id']?>"><?php echo $eachList['category_name']?></option>
            <?php } } } ?>
            
            </select>
           
           
           <ul id="cat_list" style="margin-top:5px;">
            
            <?php  
            $work_cat_details = $this->mwork->work_categ_details($workdetails['id']);
            if(!empty($work_cat_details))
                   { 
                    foreach($work_cat_details as $catdetails) { ?>
           
            <li class="cat_id" onclick="catshow(<?php echo $catdetails['wcid']?>)"><?php echo $catdetails['category_name']?></li>
            
            
         <?php } } ?>   
            </ul>
           </span>
            <div class="clear"></div>
            
             <?php 
              $cnt_syn = strlen($workdetails['synopsis']);
              ?>
            <div class="editsec1">
            <p>Type Your Synopsis Here.100 Character Maximum.</p>
              <!--<p class="syn_con">Your synopsis description will be saved when you click Save Work</p>-->
            <textarea name="synopsis" cols="55" rows="3" class="indexTextNormal" id="doc_desc"><?php echo $workdetails['synopsis'];?></textarea>
            
            <p class="ctr">Your synopsis description will be saved when you click Save Work</p>
            </div>
            
            <?php 
              $cnt_excpt = strlen($workdetails['extract']);
              ?>
            <div class="editsec1">
            <p>Type Your Excerpt Here.300 Character Maximum.</p>
             <!--<p class="syn_con">Your synopsis description will be saved when you click Save Work</p>-->
            <textarea name="excerpt" cols="55" rows="3" class="indexTextNormal" id="doc_desc_22"><?php echo $workdetails['extract'];?></textarea>
            
            <p class="ctr">Your excerpt description will be saved when you click Save Work</p>
            </div>
            <div class="clear"></div>
            
            <div class="rad_sec">
            
               <div class="radsec_lf">
                  <p class="syn_con">Has your title been reviewed?</p>
                  <span class="syn_con2">Yes</span>
                  <span class="rad_button"><input type="radio" value="1" name="BeenReviewed" id="BeenReviewed1" <?php if($workdetails['been_reviewed'] == '1') {?>checked<?php } ?>></span>
                  <span class="syn_con2">No</span>
                  <span class="rad_button"><input type="radio" value="0" name="BeenReviewed" id="BeenReviewed" <?php if($workdetails['been_reviewed'] == '0') {?>checked<?php } ?>></span>
                  <div class="clear"></div>
            
               </div>
               
                <div class="radsec_lf">
                  <p class="syn_con">Has your title received awards?</p>
                  <span class="syn_con2">Yes</span>
                  <span class="rad_button"><input type="radio" value="1" name="ReceivedAwards" id="ReceivedAwards1" <?php if($workdetails['received_awards'] == '1') {?> checked <?php } ?>></span>
                  <span class="syn_con2">No</span>
                  <span class="rad_button"><input type="radio" value="0" name="ReceivedAwards" id="ReceivedAwards" <?php if($workdetails['received_awards'] == '0') {?>checked<?php } ?>></span>
                  <div class="clear"></div>
            
               </div>
               
                <div class="radsec_lf" style="border-right:none;">
                  <p class="syn_con">Has your title been self-published?</p>
                  <span class="syn_con2">Yes</span>
                  <span class="rad_button"><input type="radio" value="1" name="SelfPublished" id="SelfPublished1" <?php if($workdetails['self_published'] == '1') {?>checked<?php } ?>></span>
                  <span class="syn_con2">No</span>
                  <span class="rad_button"><input type="radio" value="0" name="SelfPublished" id="SelfPublished" <?php if($workdetails['self_published'] == '0') {?>checked<?php } ?>></span>
                  <div class="clear"></div>
            
               </div>
               <div class="clear"></div>
            
            </div>
            
            <!--<button class="upld_butt1">Upload Manuscript</button>-->
            
            <label class="fileContainer1">
                                <span class="upld_butt1">Upload Manuscript </span>
                                <input type="file" id="image1" name="image1" onchange="myFunction1()"/>
                                
            </label>
            
            
            
            <label class="syn_con3">Please upload your manuscript here.Inkubate accepts DOC,DOCS and PDF files that are under 25MB in size.</label>
            <label><button class="upld_butt2" type="button">Edit Work</button></label>
            <label><button class="upld_butt2" type="button" style="background-color:#39302c;" onclick="del_work(<?=$workdetails['id']?>)">Delete Work</button></label>
            <label><button class="upld_butt2" style="background-color:#46b8ff;" value="Save" name="command" type="submit">Save Work</button></label>
            <div class="clear"></div>
            
            <span id="demo_upload1" ></span>
            
            <p>
              <?php if($workdetails['file_asset_id'] != '') {?>
                <a href="<?=base_url()?>discovery/download/<?=$workdetails['id']?>/<?=$workdetails['file_asset_id']?>/<?=$workdetails['user_id']?>/<?=$workdetails['file']?>" style="color: #70a1df;"><?=$workdetails['file']?></a>
                <?php } ?>
            </p>
            
            </div>
            
             
             
             
             
              
          </div>
          
          <div class="clear"></div>
          
          </form>
        </div>
       
        <div class="clear"></div>
      </div>
      <div class="clear"></div>
      
  
                          <div class="clear"></div>
                          
      <?php } } ?>                    
                
<link rel="stylesheet" href="<?=base_url()?>style/inner/chosen.css"/>
<script src="<?=base_url()?>js/chosen.jquery.js" type="text/javascript"></script>

<script type="text/javascript">

var maxcnt = 3 - <?php echo count($work_cat_details);?>;

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
  
  </script>      
  
  <script>

    function del_work(id)
{
    //alert(id);
    if(confirm("Are you sure to delete this title?")){
    window.location.href = '<?=base_url()?>work/delete_work/'+id;
    }
    else
    {
        return false;
    }
}
  </script>  
              
<?=$this->load->view('template/inner_footer.php')?>           

