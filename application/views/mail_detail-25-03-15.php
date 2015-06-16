<?=$this->load->view('template/inner_header.php')?>

<?php //echo '<pre/>';print_r($folder_details);?>

<script src="<?=base_url()?>js/editor.js"></script>

<link href="<?=base_url()?>style/inner/bootstrap.min.css" rel="stylesheet">
<link href="http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<link href="<?=base_url()?>style/inner/editor.css" type="text/css" rel="stylesheet"/>

<script type="text/javascript">

function myFunction_img(){
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
        
       //alert(txt); 
    } 
    else {
        if (x.value == "") {
            txt += "Select one or more files.";
        } else {
            txt += "The files property is not supported by your browser!";
            txt  += "<br>The path of the selected file: " + x.value; // If the browser does not support the files property, it will return the path of the selected file instead. 
        }
    }
    
    document.getElementById("demo_upload_img").innerHTML = txt;
    
}

		$(document).ready( function() {
            
         $("#txtEditor").Editor(); 
         $("#txtEditor22").Editor();                   
         
    });
  </script>
  

  
<script>
function folder_message(id,str)
{
    //alert(id);
    window.location.href = '<?=base_url()?>home/folder/'+id+'/'+str;
}

function delete_details(id)
{
    //alert(id);
    if(confirm("Are you sure to move the last message to trash?")){
    window.location.href = '<?=base_url()?>mail/delete_details/'+id;
    }
    else
    {
        return false;
    }
}

function draft_details(id)
{
    //alert(id);
    if(confirm("Are you sure to save the last message as draft?")){
    window.location.href = '<?=base_url()?>mail/draft_details/'+id;
    }
    else
    {
        return false;
    }
}


$(document).ready(function() {
    
   $('#del_msg').click(function(){
        
      if(confirm("Are you sure to move this message to trash?")){
    window.location.href = '<?=base_url()?>mail/trash_details/'+<?php echo $this->uri->segment(3)?>;
    }
    else
    {
        return false;
    }   
          
   });
   
  
});


</script>
<script type="text/javascript">
window.document.onkeydown = function (e)
{
    if (!e){
        e = event;
    }
    if (e.keyCode == 27){
        lightbox_close();
    }
}
function lightbox_open(){
    window.scrollTo(0,0);
    document.getElementById('light').style.display='block';
    document.getElementById('fade').style.display='block';
    $('.Editor-editor').addClass('forward'); 
    $('.forward').keyup(function(){
    
    //alert($('.forward').text());
    var edt3 = $('.forward').text();
    $('#editor2').val(edt3);
    
    
    }); 
}
function lightbox_close(){
    $('.forward').text('');
    $('.Editor-editor').removeClass('forward');
    document.getElementById('light').style.display='none';
    document.getElementById('fade').style.display='none';
    
    
}

window.document.onkeydown = function (e)
{
    if (!e){
        e = event;
    }
    if (e.keyCode == 27){
        lightbox_close22();
    }
}
function lightbox_open22(){
    window.scrollTo(0,0);
    document.getElementById('light22').style.display='block';
    document.getElementById('fade22').style.display='block';
    $('.Editor-editor').addClass('reply'); 
    $('.reply').keyup(function(){
    
    //alert($('.reply').text());
    var edt3 = $('.reply').text();
    $('#editor3').val(edt3);
    
     //document.getElementById('editor3').value = $('.reply').text();
    
    });
}
function lightbox_close22(){
    $('.reply').text('');
    $('.Editor-editor').removeClass('reply');
    document.getElementById('light22').style.display='none';
    document.getElementById('fade22').style.display='none';
    
}

</script>

<script type="text/javascript">
$(document).ready(function() {
    
    CKEDITOR.replace( 'reply_text', {
            removeButtons: 'Source',
            // The rest of options...
        }); 
     
   CKEDITOR.replace( 'desc', {
            removeButtons: 'Source',
            // The rest of options...
        }); 
        
   CKEDITOR.replace( 'forward_text', {
            removeButtons: 'Source',
            // The rest of options...
        });
   
   CKEDITOR.replace( 'replyall_text', {
            removeButtons: 'Source',
            // The rest of options...
        });            
    
    /*$('.reply_button').click(function(){
          
         
        var message_id = $('#reply_message_id').val();
        var reply_text = CKEDITOR.instances['reply_text'].getData();
        var user_mail = $('#reply_email').val();
        var sub = $('#reply_sub').val();
        var msg_type = $('#msg_type').val();
        var attchimage = $('#image1').val();
        
        //alert(attchimage);
        //alert('<?php echo base_url();?>mail/replybox');return false;
          
        $.ajax({
            url      : '<?php echo base_url();?>mail/replybox',
            type     : 'POST',
            data     : { 'message_id':message_id , 'editor3':reply_text ,'user_mail':user_mail , 'sub':sub, 'reply': 'Send', 'msg_type' : msg_type , 'draft': 'Save Draft' , 'image': attchimage},
            success  : function(resp){
                //alert(resp);
                        window.location.reload();
//                if(resp != '0'){
//                    //window.history.pushState("object or string", "Title", "http://192.168.0.1/INKUBATE/mail/details/14#close")
//                    //$('.popup').find( ".close" ).attr( "href", "#close" );
//                    $( ".close" ).click(function() {
//                          alert( "Handler for .click() called." );
//                        });
//                    $("#reply_post").html(resp);
//                    //$("#edit_class" ).dialog( "close" );
//                }
            },
            error    : function(resp){
                $.prompt("Sorry, something isn't working right.", {title:'Error'});
            }
        });   
         
    });*/
    
    
});


</script>
    
   <style>
   .img_sz_small
   {
    width: 49px !important;
    height: 49px!important;
   }
   </style> 
   <link href='<?=base_url()?>style/inner/reply_popup.css' rel='stylesheet' />
  <?php $usd = $this->session->userdata('logged_user');?>
            <div class="content_part">
            	
               
                <div class="mid_content mid_content_inner">
              
                	
                    <?=$this->load->view('template/mail_sidebar.php');?>
                    
                    <div class="mid_content_inner_right">
                    
                         
                         <div class="mid_content_inner_right_top pad_top10 bor_bot pad_bot10"> 
<!--<form action="" method="post">-->
<?php //echo '<pre/>';print_r($user_contact);die;?>
<?php if(!empty($user_contact['name_first'])) { $firstname = $user_contact['name_first']." "; } else { $firstname = '';} ?>
<?php if(!empty($user_contact['name_middle'])) { $middlename = $user_contact['name_middle']." "; } else { $middlename = '';} ?>
<?php if(!empty($user_contact['name_last'])) { $lastname = $user_contact['name_last']; } else { $lastname = '';} ?>
<?php $fullname = $firstname.' '.$middlename.' '.$lastname?>

<span>
                
    <a href="#0"  class="reply-popup-trigger"><input name="button" type="button" value="" class="button01" /></a>
    
    
    <?php
    $usd = $this->session->userdata('logged_user');
    $frmAttrs22   = array("id"=>'signupFrm22',"class"=>'form-horizontal');
    //echo form_open_multipart('mail/replybox', $frmAttrs22);
    $reply_user = $this->memail->reply_to_user($single_mail_details['from_user_id']);
    //print_r($single_mail_details);
    
    
    ?>
  
    <div class="reply-popup" role="alert">
    
	<div class="reply-popup-container">
            <div style=" width:100%; background:#000; padding:20px 0;"></div>
                <div class="top_reply">
                   
                   <form name="replyFrm" id="replyFrm" method="post" action="<?php echo base_url();?>mail/replybox" enctype="multipart/form-data"> 
                                
                    <div class="text_field_box">
                        <label style="float:left; margin-top:9px; width:3%">To</label>
                        <input type="hidden" id="reply_email" name="reply_email" value="<?php echo $reply_user['email']?>"/>
                        <input type="hidden" id="msg_type" name="msg_type" value="<?php echo $single_mail_details['is_pitchited']?>"/>
                        <input type="hidden" id="reply_message_id" name="reply_message_id" value="<?php echo $this->uri->segment(3)?>"/>
                        
                        <div  class="auto_main">				
<!--                            <span id="email_selected"></span>-->
                            <span class="choosen">
                                
                                <?php echo $reply_user['name_first'].' '.$reply_user['name_last'];?>
<!--                                <ul id="dropdown_search" style="display:none;">
                                </ul>-->
                            </span>
                           

                        </div>

<!--                        <label class="com_plus"> <a href="#showAuthorList" class="nohover add_img" rel="facebox" data-url=""><img src="<?php echo base_url('images/plus_icon.png')?>" /></a></label>-->


                        <div class="clear"></div>
                    </div>
                    
                    <div class="text_field_box3"><label style="float:left; margin-top:9px;">Subject</label>
                        <input type="text" id="reply_sub" name="reply_sub"  class="sub_mail_content" value="<?php echo $single_mail_details['subject']?>" >
                        <div class="clear"></div>
                    </div>
                    
                    <div class="comm_tarea">
                        <textarea class="ckeditor" cols="80" name="reply_text"  id="reply_text" > </textarea>
                    </div>
                    <div class="clear"></div><br />
                                            
           
                     <div class="button_set">                   
                    
                    
                    
                    <input name="reply" name="reply" type="button" value="Send" class="reply_button" onclick="SubmitForm2('reply')"/>
                    <input name="draft" name="draft" type="button" value="Save Draft" class="reply_button" onclick="SubmitForm2('draft')"/>
					
                    <label class="fileContainer">
                        <img src="<?=base_url()?>images/attachment_icon.png" alt=""   /> 
                        <input type="file" id="image1" name="image" onchange="myFunction_img()"/>
                        <span id="demo_upload_img"></span>
                    </label>
                  
                    <a href="javascript:void(0);" onclick="delete_details(<?php echo $this->uri->segment(3);?>)"><img src="<?=base_url()?>images/delete_new.png" alt="" /></a>
					
					</div>
                    <div class="clear"></div> 
                    
                    </form>
                    
                </div>
                                
		<a href="#0" class="reply-popup-close img-replace">Close</a>
                <div class="clear"></div>
            </div> 
        <div class="clear"></div>
         
    </div>
   
    
    
    
    
<!--    <a href="#"  onclick="lightbox_open22();"><input name="button" type="button" value="" class="button01" /></a>-->
</span>
<!--<a href="#join_form_1" id="join_pop" ><input name="button" type="button" value="" class="button02" /></a>-->
<!--<a href="#" class="nohover" onclick="lightbox_open();" ><input name="button" type="button" value="" class="button03" /></a>-->




<span>
<a href="#0"  class="forward-popup-trigger"><input name="button" type="button" value="" class="button05" style="border-right: 0;" /></a>

<div class="forward-popup" role="alert">
	<div class="forward-popup-container">
    <div style=" width:100%; background:#000; padding:20px 0;">
    	
    </div>
		   <div class="top_forward">
                                
                                       <?php
                                       $usd = $this->session->userdata('logged_user');
                                       $frmAttrs   = array("id"=>'composeFrm1',"class"=>'form-horizontal',"name"=>'myForm');
                                       echo form_open_multipart('mail/compose_forward', $frmAttrs);
                                       ?>
                                        <!--<a href="#" class="closelabel_new"><img src="<?//=base_url()?>images/closelabel.png" alt="" /></a>-->
                                        <div class="text_field_box"><label style="float:left; margin-top:9px; width:3%">To</label>
                                        
                                        <input type="hidden" id="user_mail_1" name="user_mail_1" readonly="readonly"/>
                                         <div  class="auto_main" id="parent_email_selected">				
                                            <span id="email_selected_1">
                                            
                                            </span>
                                            <span>
                                            <input type="text" class="auto_t_box" id="email_input_1" name="email_input" onkeyup='FnShowSearch_1(this.value)'>
                                            <ul id="dropdown_search_1" style="display:none;">
                                            </ul>
                                            </span>
                                           
  					</div>
  					
                                        <input type="hidden" id="user_email_id_1" name="user_email_id_1"/>
                                         <label class="com_plus"> <a href="#showAuthorList_1" class="nohover add_img" rel="facebox" data-url=""><img src="<?php echo base_url('images/plus_icon.png')?>" /></a></label>
                                         
                                     
                                            <div class="clear"></div>
                                        </div>
                                        <div class="text_field_box3"><label style="float:left; margin-top:9px;">Subject</label>
                                        
                                        <input type="text" id="sub" name="sub"  class="sub_mail_content" value="" >
                                        <div class="clear"></div>
                                        
                                        </div>
                                        <div class="comm_tarea">
                                            <textarea class="ckeditor" cols="80" name="forward_text"  id="forward_text" > </textarea>
                                        </div>
                                            <div class="clear"></div><br />
                                            
                                        <div class="button_set button_set2"> 
                                            <input name="send" type="button" value="Send" class="forward_button" onclick="SubmitForm3('send')" />
                                            <?php //if($usd['user_type'] == "2"){ ?>
                                            <input name="draft" type="button" value="Save Draft" class="forward_button" style="margin-right:0 !important;" onclick="SubmitForm3('draft')"/>
                                            <?php //} ?>
                                            <label class="fileContainer">
                                            <img src="<?=base_url()?>images/attachment_icon.png" alt=""   /> 
                                            <input type="file" id="image" name="image" onchange="myFunction()"/>
                                            <span id="demo_upload"></span>
                                            </label>
                                            
                                       <a href="javascript:void(0);"><img src="<?=base_url()?>images/delete_new.png" alt="" /></a>
					
					                  </div>
                                      
                                       <div class="clear">  </div>
                                       </form> 
                                </div>
                                
		<a href="#0" class="forward-popup-close img-replace">Close</a>
        <div class="clear"></div>
	</div> 
     <div class="clear"></div>
</div>

</span>

<span>
<a href="#0"  class="replyall-popup-trigger"><input name="button" type="button" value="" class="button06" style=" width: 10%;" /></a>

<div class="replyall-popup" role="alert">
    
	<div class="replyall-popup-container">
            <div style=" width:100%; background:#000; padding:20px 0;"></div>
                <div class="top_replyall">
                   
                   <form name="replyFrm1" id="replyFrm1" method="post" action="<?php echo base_url();?>mail/replyAllbox" enctype="multipart/form-data"> 
                                
                    <div class="text_field_box">
                        <label style="float:left; margin-top:9px; width:3%">To</label>
                        <input type="hidden" id="reply_email" name="reply_email" value="<?php echo $reply_user['email']?>,<?php echo $user_contact['email']?>"/>
                        <input type="hidden" id="msg_type" name="msg_type" value="<?php echo $single_mail_details['is_pitchited']?>"/>
                        <input type="hidden" id="reply_message_id" name="reply_message_id" value="<?php echo $this->uri->segment(3)?>"/>
                        
                        <div  class="auto_main">				
<!--                            <span id="email_selected"></span>-->
                            <span class="choosen">
                                
                                <?php echo $reply_user['name_first'].' '.$reply_user['name_last'];?>
<!--                                <ul id="dropdown_search" style="display:none;">
                                </ul>-->
                            </span>
                           
                            <span class="choosen">
                                
                                <?php echo $fullname;?>
<!--                                <ul id="dropdown_search" style="display:none;">
                                </ul>-->
                            </span>

                        </div>

<!--                        <label class="com_plus"> <a href="#showAuthorList" class="nohover add_img" rel="facebox" data-url=""><img src="<?php echo base_url('images/plus_icon.png')?>" /></a></label>-->


                        <div class="clear"></div>
                    </div>
                    
                    <div class="text_field_box3"><label style="float:left; margin-top:9px;">Subject</label>
                        <input type="text" id="reply_sub" name="reply_sub"  class="sub_mail_content" value="<?php echo $single_mail_details['subject']?>" >
                        <div class="clear"></div>
                    </div>
                    
                    <div class="comm_tarea">
                        <textarea class="ckeditor" cols="80" name="replyall_text"  id="replyall_text" > </textarea>
                    </div>
                    <div class="clear"></div><br />
                                            
           
                     <div class="button_set">                   
                    
                    
                    
                    <input name="reply" name="reply" type="button" value="Send" class="reply_button" onclick="SubmitForm4('reply')"/>
                    <input name="draft" name="draft" type="button" value="Save Draft" class="reply_button" onclick="SubmitForm4('draft')"/>
					
                    <label class="fileContainer">
                        <img src="<?=base_url()?>images/attachment_icon.png" alt=""   /> 
                        <input type="file" id="image1" name="image" onchange="myFunction_img()"/>
                        <span id="demo_upload_img"></span>
                    </label>
                  
                    <a href="javascript:void(0);" onclick="delete_details(<?php echo $this->uri->segment(3);?>)"><img src="<?=base_url()?>images/delete_new.png" alt="" /></a>
					
					</div>
                    <div class="clear"></div> 
                    
                    </form>
                    
                </div>
                                
		<a href="#0" class="replyall-popup-close img-replace">Close</a>
                <div class="clear"></div>
            </div> 
        <div class="clear"></div>
         
    </div>

</span>
<span>

<?php //echo '<pre/>';print_r($msg_status);die;?>
<!--<input name="button" type="button" value="" class="button07" style="border-right: 0;" />-->

</span>
<div class="drop_cont2" style="margin-left: 10px;">
                                        <input type="hidden" name="msg_type" id="msg_type1" value="<?=$msg_status;?>"/>
                                        <ul class="dropdown2 folder">
                                            <!--<input name="button" type="button" value="" class="button07" style="border-right: 0;" />-->
                                           <img src="<?=base_url()?>images/icon_52.png" style="border-right: 0; margin-top: 8px; cursor: pointer;"/>
                                    <?php 
                                    if($msg_status == 'pitchit'){
                                        $folder_details = $pitchit_details;
                                    }
                                    
                                    if(!empty($folder_details)) {
                                     
                                    foreach($folder_details as $key=>$fdetails) {
                                    ?>
                                    
                                    
                                    <script>

                                    $(document).ready(function() {
                                        
                                       $('#fold_<?php echo $fdetails['id']?>').click(function(){
                                            
                                            var msg_type = $("#msg_type1").val();
                                            
                                            //alert(msg_type);
                                              var favorite = [];
                                              favorite.push(<?php echo $single_mail_details['id']?>);
                                              //var favorite = [];
                                         
                                                  $.ajax({
                                                    url      : '<?=base_url()?>'+'home/folder_msg',
                                                    type     : 'POST',
                                                    data     : { 'id': favorite , 'foldId' : <?php echo $fdetails['id']?> , 'foldname' : "<?php echo $fdetails['name']?>", 'msg_type' : msg_type  },
                                                    success  : function(resp){//return false;
                                                         if(resp.status == "true")
                                                         {
                                                             if(msg_type == "inbox")msg_type = "folder";
                                                             if(resp.exists != "")
                                                             {
                                                                     html = "<p style='color:green;'>Mail successfully added to "+msg_type+" "+resp.exists+"</p>";
                                                             }
                                                             if(resp.success != "")
                                                             {
                                                                     html = "<p style='color:green;'>Mail successfully added to "+msg_type+" "+resp.success+"</p>";
                                                             }
                                                             $("#folder_msg").html(html)
                                                             $("#folder_msg").focus();
                                                         }
                                                         else
                                                         {
                                                             $("#folder_msg").html("Sorry please refresh the page and try again.");
                                                         }

                                                        setTimeout(function(){location.reload();},100);
                                                    },
                                                    error    : function(resp){
                                                         $.prompt("Sorry, something isn't working right.", {title:'Error'});
                                                    }
                                                 });   
                                            
                                            //alert('hi');
                                                 
                                       });
                                       
                                        
                                    });
                                    
                                    </script>
                                    
                                    <li class="dropdown-list2 folderlist" id="fold_<?php echo $fdetails['id']?>"><?php echo $fdetails['name']?></li>
                                    <!--<option value="<?php echo $fdetails['id']?>" class="fold_<?php echo $fdetails['id']?>"><?php echo $fdetails['name']?></option>-->
                                    
                                    <?php } } ?>
                                    
                                    </ul>
                                        </div>
<span><input name="button" type="button" value="" class="button08" style="border-right: 0;" onclick="draft_details(<?php echo $this->uri->segment(3);?>)" /></span>
<span><input name="button" type="button" value="" class="button04" style="border-right: 0;" onclick="delete_details(<?php echo $this->uri->segment(3);?>)" /></span>

                                

   <?php /* <div class="drop_cont">
        <ul class="dropdown trigger">
            <h2 class="dropdown-title">Action</h2>
            <li class="dropdown-list list" id="del_msg" >Delete</li>
            <li class="dropdown-list list" id="mark_msg">Mark as Read</li>
            <li class="dropdown-list list" id="unmark_msg">Mark as Unread</li>
        </ul>
    </div> */ ?>
     
    
<!--<span class="bt">
    <select name="menu" id="sl2-ic" tabindex="2">
<option>Action</option>
<option value="delete" class="del_msg">Delete</option>
</select></span>-->

<span class="bt1">
<!--<select name="menu" id="sl3-csb" tabindex="3">
<option>Move to</option>
<option value="delete" class="del_msg">Trash</option>
</select>-->
</span>


<!--<div class="search_right">
<a href="#"><img alt="" src="<?//=base_url()?>images/close.png"/></a>
</div>
</form>-->

<div class="clear"></div>
</div>




   <div class="mid_content_inner_right_top pad_top10 bor_bot pad_bot10">

       <p class="fv_con">

       <span id="re_id">
       
       <?php echo $single_mail_details['subject'];?> 
       
       </span>
       
       </p>


    </div>

                                
                                
                                
                                
                         <div class="mail_detail">
                         
                     <div id="reply_post">
<?php 

//echo '<pre/>';print_r($reply_mail_details);die;
if(!empty($reply_mail_details)){
    
       foreach ($reply_mail_details  as $reply_data)
      {     
    ?>
    <script>
    $(document).ready(function(){
        
        $('#re_id').text("Re: <?php echo $reply_data['subject']?>");
        
    })
    </script>
    
 <div class="mid_content_inner_right_bottom_box_new new_bg">
 <p class="right_date"><span>Date </span>: <strong><?php echo date('m/d/y',strtotime($reply_data['msg_created']))?></strong></p>
            <div class="drop_menu_section_left">
            <div class="prof">
               
                <div class="drop_menu_section_left_text">
                
                <div class="left_tex">
                
                <?php if(!empty($user_photo['filename'])) {?>
                    <img src="<?=base_url()?>uploadImage/<?=$usd['id']?>/profile/<?=$user_photo['filename']?>" class="img_sz_small"/>
                 <?php } else {?>
                     <img src="<?=base_url()?>images/img_default_headshot.png" class="img_sz_small"/>
                 <?php } ?>
                 
                 <div class="clear"></div>
    <?php if(!empty($reply_data['filename'])) { ?>
                <img src="<?=base_url()?>uploadImage/<?=$reply_data['to_user_id']?>/profile/<?=$reply_data['filename']?>" alt="" class="img_sz_small" />
                <?php } else { ?>
                  <img src="<?=base_url()?>images/img_default_headshot.png" alt="" class="img_sz_small" />
                  
             <?php }?>
                 
                 </div>
                 
                <div class="right_tex">
               <?php /* <p><strong>Re : <?php echo $reply_data['subject']?></strong></p> */?>
                <p class="font_12"><span>From</span>:  
                <strong><?php //echo $usd['name_first']?>
                
                <?php echo $fullname = $firstname.' '.$middlename.' '.$lastname; ?>
                </strong>
                <!--<img src="<?//=base_url()?>images/add_con.png" alt="" />-->
                <br />
                <span>To </span>: <strong><?php echo $reply_data['name_first'].' '.$reply_data['name_last']?> </strong>
                <!--<img src="<?//=base_url()?>images/add_con.png" alt="" />-->
                </p>
                </div>
            </div>
            </div>
            </div>
            
            
            
            <div class="drop_menu_section_right">
            <!--<a href="#" class="attachment_icon pad_top30"><img alt="" src="<?//=base_url()?>images/attachment_icon.png"/></a>-->
            
            <?php if(!empty($reply_data['attach_file'])) {?>
<a href="<?=base_url()?>mail/download/<?=$reply_data['from_user_id']?>/<?=$reply_data['attach_file']?>" class="attachment_icon"><img alt="" src="<?=base_url()?>images/attachment_icon.png" title="<?php echo $reply_data['attach_file'];?>"/><?php //echo $reply_data['attach_file'];?></a>
<?php } ?>
            
            </div>
            <div class="clear"></div>
            </div>
            <div class="comment">
            <p><?php echo $reply_data['body'];?></p>
            
            </div>
     <?php } } ?>       



</div>    
                           

<div class="mid_content_inner_right_bottom_box_new">
<p class="right_date"><span>Date </span>: <strong><?php echo date('m/d/y',strtotime($single_mail_details['msg_created']))?></strong></p>
<div class="drop_menu_section_left">
<div class="prof">
    <div class="drop_menu_section_left_text">
     <?php //echo '<pre/>';print_r($single_mail_details);die;
    foreach ($from_user as $from_user_details) { ?>
    <div class="left_tex">
    <?php if(!empty($from_user_details['photo'])) { ?>
                <img src="<?=base_url()?>uploadImage/<?=$from_user_details['from_user_id']?>/profile/<?=$from_user_details['photo']?>" alt="" class="img_sz_small" />
                <?php } else { ?>
                  <img src="<?=base_url()?>images/img_default_headshot.png" alt="" class="img_sz_small" />
                  
    <?php }?>
    <div class="clear"></div>
    <?php if(!empty($single_mail_details['filename'])) { ?>
                <img src="<?=base_url()?>uploadImage/<?=$single_mail_details['to_user_id']?>/profile/<?=$single_mail_details['filename']?>" alt="" class="img_sz_small" />
                <?php } else { ?>
                  <img src="<?=base_url()?>images/img_default_headshot.png" alt="" class="img_sz_small" />
                  
             <?php }?>
    
    </div>
    <div class="right_tex">
    <p class="font_12"><span>From</span>: &nbsp;<strong><?php  echo $from_user_details['name'].' '.$from_user_details['name_last']; ?></strong>
    <!--<img src="<?=base_url()?>images/add_con.png" alt="" />--><br />
    <span>To </span>: &nbsp;<strong><?php echo $single_mail_details['name_first'].' '.$single_mail_details['name_last'];?> </strong><!--<img src="<?=base_url()?>images/add_con.png" alt="" />--><br /></p>
    <!--<p><span>Subject </span>: &nbsp;<strong><?php //echo $single_mail_details['subject'];?></strong></p>-->
    
    </div>
    <div class="clear"></div>
    </div>
    
   <?php } ?>
    
</div>
</div>

<div class="drop_menu_section_right">
<!--<p>Message 4 of 112</p>
<input name="button" type="button" value="" class="arrow_left" /><input name="button" type="button" value="" class="arrow_right" /><br />-->
<?php if(!empty($single_mail_details['attach_file'])) {?>
<a href="<?=base_url()?>mail/download/<?=$single_mail_details['from_user_id']?>/<?=$single_mail_details['attach_file']?>" class="attachment_icon"><img alt="" src="<?=base_url()?>images/attachment_icon.png" title="<?php echo $single_mail_details['attach_file'];?>"/><?php //echo $single_mail_details['attach_file'];?></a>
<?php } ?>
</div>
<div class="clear"></div>
</div>
<?php /*<div class="comment">
<?php if($single_mail_details['is_pitchited'] == '1') {?>
<p>View the Pitchit : <a href="<?php echo $single_mail_details['body'];?>">click here</a></p>
<?php } else {?>
<p><?php echo $single_mail_details['body'];?></p>
<?php } ?>
</div>*/?>

<div class="comment">

<p><?php echo $single_mail_details['body'];?></p>

</div>





<div class="clear"></div>
</div> 
<span class="shw"></span>     
    <div class="clear"></div>
    </div>
    <div class="clear"></div>


</div>
<div class="clear"></div>
<!-----Forward--------->
   <script>
var folder = '.folder';
var folderlist = '.folderlist';
function toggleFolder() {
   // alert('hello');
  $(folderlist).slideToggle(200, 'linear');
}

$(".folder").on('click', function () {
	toggleFolder();
});

</script>
             
<?=$this->load->view('template/inner_footer.php')?>

