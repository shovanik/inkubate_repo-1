<?php $usd = $this->session->userdata('logged_user');?>


<script type="text/javascript">

function SubmitForm1(type)
{
    //alert('fg');
    var pgnd = document.getElementById("user_email_id").value.trim();
        if(pgnd == "")
        {
            alert('Email should not be empty...');
            document.getElementById("user_email_id").focus();
            return false;
        }   
       else
       {
         document.getElementById('composeFrm').action='<?=base_url()?>mail/compose/'+type;
         document.getElementById('composeFrm').submit();
         //window.location.reload();
         return true;
        } 
     
     
}

function SubmitForm3(type)
{
    //alert('fg');
    var pgnd = document.getElementById("user_email_id_1").value.trim();
        if(pgnd == "")
        {
            alert('Email should not be empty...');
            document.getElementById("user_email_id_1").focus();
            return false;
        }   
       else
       {
         document.getElementById('composeFrm1').action='<?=base_url()?>mail/compose_forward/'+type;
         document.getElementById('composeFrm1').submit();
         //window.location.reload();
         return true;
        } 
     
     
}

function SubmitForm2(type)
{
    
     document.getElementById('replyFrm').action='<?=base_url()?>mail/replybox/'+type;
     document.getElementById('replyFrm').submit();
     //window.location.reload();
     return true;
}

function SubmitForm4(type)
{
    
     document.getElementById('replyFrm1').action='<?=base_url()?>mail/replyAllbox/'+type;
     document.getElementById('replyFrm1').submit();
     //window.location.reload();
     return true;
}

function SubmitForm5(type)
{
    
     document.getElementById('replyFrm5').action='<?=base_url()?>mail/draftAllbox/'+type;
     document.getElementById('replyFrm5').submit();
     //window.location.reload();
     return true;
}

$(document).ready(function()
{
    $('.cd-popup-close').click(function(event){
        event.preventDefault();
        
        document.getElementById('composeFrm').action='<?=base_url()?>mail/compose/draft';
        document.getElementById('composeFrm').submit();
     
           return true;
        
       //alert('hi');
    })
    
    $('.reply-popup-close').click(function(event){
        event.preventDefault();
        
        document.getElementById('replyFrm').action='<?=base_url()?>mail/replybox/draft';
        document.getElementById('replyFrm').submit();
     
         return true;
        
       //alert('hi');
    })
 
	//$("#user_mail").val('<?php //echo $this->uri->segment(3);?>');
	//$("#user_email_id").val('<?php //echo $this->uri->segment(3);?>');
  
    
/*$("#user_mail").keyup(function() 
{ 
var user_mail = $("#user_mail").val();
var msgbox = $("#status");

$("#status").html('<img src="<?//=base_url()?>images/ajax-loader.gif" align="absmiddle">&nbsp;Checking availability...');

$.ajax({  
    type: "POST",  
    url: "<?//=base_url()?>"+"mail/checkmail",  
    data: "user_mail="+ user_mail,  
    success: function(msg){  
    
    if(msg == 'OK')
    { 
        //msgbox.html('<img src="available.png" align="absmiddle">');
        msgbox.html('<font color="green">Email available</font>');
    }  
    else  
    {  
        msgbox.html(msg);
    }  
   
  
   } 
   
  }); 


return false;
});*/

$('.button').click(function(){
    
    var x = document.forms["myForm"]["user_mail"].value;
    if (x==null || x=="") {
        alert("Email must be filled out");
        return false;
    }
    
    /*var email=$('#user_mail').val();
    var filter = /[\w-]+@([\w-]+\.)+[\w-]+/;
 
   if (!filter.test(email)) {
    alert('Please enter a valid email address');
    return false;
   }*/
  

 });
 
 /*$('#folder_a').click(function(){
    
    //$('.hidetext').css('background','none');
    $('#folder_a').removeClass('hidetext');

   //alert('hi');
 });*/
 
 

});
function removeEmail(div,id)
{
	if(parseInt(id) > 0)
	{
		//alert(id);
		$("#name"+id).remove();
		var val = $("#user_email_id").val();
		var arr = val.split(",");
		//console.log(arr);
		var index = arr.map(function(el) {
		  return parseInt(el);
		}).indexOf(parseInt(id));	
		//alert(index);
		if(index > -1){
			arr.splice(index, 1);	
		}
		if(arr.length > 0){
			var v = arr.join(",");
			//alert(v);
			$("#user_email_id").val(v);
		}
		else
		{
			var v = "";
			$("#user_email_id").val(v);
		}
		
	}
}
</script>
<script>
function delete_folder(id, msg_type)
{
    if(confirm('Are you sure to delete the '+msg_type+'? Deleting of '+msg_type+' will not delete the messages, they will be moved to your inbox. Messages must be deleted individually.')){
    	 $.ajax({
           url      : '<?=base_url()?>'+'home/delete_folder',
           type     : 'POST',
           data     : { 'id':id, 'msg_type' : msg_type },
           success  : function(resp){
                if(resp.status=='0'){
                
                	alert("Please refresh the page and try again");
                }
                location.reload();
           },
           error    : function(resp){
                $.prompt("Sorry, something isn't working right.", {title:'Error'});
           }
          });   
    }
    else
    {
        //$('.bottom_text').css("display", "block");
        return false;
    }
}
</script>


<script>

function folder_message(id,str,msg_type)
{
    //alert(id);
    //window.location.href = '<?=base_url()?>home/folder/'+id+'/'+encodeURIComponent(str)+'/'+msg_type;
    window.location.href = '<?=base_url()?>home/folder/'+id+'/'+msg_type;
}
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
function FnShowSearch(value)
{
	$("#dropdown_search").hide();
	if(value == "")
	{
		return false;
	}
	
	$.ajax({
                type:'POST',
                url:BASE+'home/search_authors',
		data:{value:value},
                dataType:'json',
                success:function(data){
                    var ps = data.email;
                    var html='';
                   
                    if(data.status == "1")
                    {
                    	$("#dropdown_search").html('');
                    	if(ps.length > 0)
                    	{
                    	for (var i = 0, p; p = ps[i++];) 
                        {
                            var html='';
                            var name = p.name_first+" "+p.name_middle+" "+p.name_last;
                            html += '<li>';
                            html += '<a href="javascript:;" onclick="FnAddEmail(\''+p.id+'\',\''+name+'\')">'+name+'</a>' ;
                            
                            
		            html += '</li>';
		            html += '<div class="clear"></div>';
                            $("#dropdown_search").append(html);                  
                        }
                        $("#dropdown_search").show();
                        }
                        
                    }
                }
     });
}

function FnShowSearch_1(value)
{
	$("#dropdown_search_1").hide();
	if(value == "")
	{
		return false;
	}
	
	$.ajax({
                type:'POST',
                url:BASE+'home/search_authors',
		data:{value:value},
                dataType:'json',
                success:function(data){
                    var ps = data.email;
                    var html='';
                   
                    if(data.status == "1")
                    {
                    	$("#dropdown_search_1").html('');
                    	if(ps.length > 0)
                    	{
                    	for (var i = 0, p; p = ps[i++];) 
                        {
                            var html='';
                            var name = p.name_first+" "+p.name_middle+" "+p.name_last;
                            html += '<li>';
                            html += '<a href="javascript:;" onclick="FnAddEmail_1(\''+p.id+'\',\''+name+'\')">'+name+'</a>' ;
                            
                            
		            html += '</li>';
		            html += '<div class="clear"></div>';
                            $("#dropdown_search_1").append(html);                  
                        }
                        $("#dropdown_search_1").show();
                        }
                        
                    }
                }
     });
}


function FnAddEmail_1(id,name)
{
	 var ids = $("#user_email_id_1").val();
	 
	 var arr = ids.split(",");
	 var index = arr.map(function(el) {
		return parseInt(el);
	}).indexOf(parseInt(id));
	if(index <= -1)
	{
		$("#email_selected_1").append('<span class="choosen" id="name'+id+'" >'+name+'<img src="'+BASE+'images/close_22.png" onclick="removeEmail(this,'+id+')" ></span>');
		
		
		var val = $("#user_mail_1").val();
	
		if(val.trim() != "")
		{
		    	val = val + ", " + name;   	
		    	$("#user_mail_1").val(val.trim());    	
		}
		else
		{
	    		$("#user_mail_1").val(name);
		}
	    
	        val = ids;
		if(val.trim() != "")
		{
	    		val = val + "," + id;
	    		$("#user_email_id_1").val(val.trim());
		}
		else
		{
	    		$("#user_email_id_1").val(id);
		}
	}
	$("#email_input_1").val('');
	$("#dropdown_search_1").hide();
	$("#dropdown_search_1").html('');
}

function FnAddEmail(id,name)
{
	 var ids = $("#user_email_id").val();
	 
	 var arr = ids.split(",");
	 var index = arr.map(function(el) {
		return parseInt(el);
	}).indexOf(parseInt(id));
	if(index <= -1)
	{
		$("#email_selected").append('<span class="choosen" id="name'+id+'" >'+name+'<img src="'+BASE+'images/close_22.png" onclick="removeEmail(this,'+id+')" ></span>');
		
		
		var val = $("#user_mail").val();
	
		if(val.trim() != "")
		{
		    	val = val + ", " + name;   	
		    	$("#user_mail").val(val.trim());    	
		}
		else
		{
	    		$("#user_mail").val(name);
		}
	    
	        val = ids;
		if(val.trim() != "")
		{
	    		val = val + "," + id;
	    		$("#user_email_id").val(val.trim());
		}
		else
		{
	    		$("#user_email_id").val(id);
		}
	}
	$("#email_input").val('');
	$("#dropdown_search").hide();
	$("#dropdown_search").html('');
}
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
<div class="cd-popup" role="alert">
	<div class="cd-popup-container">
    <div style=" width:100%; background:#000; padding:20px 0;">
    	
    </div>
		   <div class="top_compose">
                                
                                       <?php
                                       $usd = $this->session->userdata('logged_user');
                                       $frmAttrs   = array("id"=>'composeFrm',"class"=>'form-horizontal',"name"=>'myForm');
                                       echo form_open_multipart('mail/compose', $frmAttrs);
                                       ?>
                                        <!--<a href="#" class="closelabel_new"><img src="<?//=base_url()?>images/closelabel.png" alt="" /></a>-->
                                        <div class="text_field_box"><label style="float:left; margin-top:9px; width:3%">To</label>
                                        
                                        <input type="hidden" id="user_mail" name="user_mail" readonly="readonly"/>
                                         <div  class="auto_main" id="parent_email_selected">				
                                            <span id="email_selected">
                                            
                                            </span>
                                            <span>
                                            <input type="text" autocomplete="off" class="auto_t_box" id="email_input" name="email_input" onkeyup='FnShowSearch(this.value)'>
                                            <ul id="dropdown_search" style="display:none;">
                                            </ul>
                                            </span>
                                           
  					</div>
  					
                                        <input type="hidden" id="user_email_id" name="user_email_id"/>
                                         <label class="com_plus"> <a href="#showAuthorList" class="nohover add_img" rel="facebox" data-url=""><img src="<?php echo base_url('images/plus_icon.png')?>" /></a></label>
                                         
                                     
                                            <div class="clear"></div>
                                        </div>
                                        <div class="text_field_box3"><label style="float:left; margin-top:9px;">Subject</label>
                                        
                                        <input type="text" id="sub" name="sub"  class="sub_mail_content" value="" >
                                        <div class="clear"></div>
                                        
                                        </div>
                                        <div class="comm_tarea">
                                            <textarea class="ckeditor" cols="80" name="desc"  id="desc" > </textarea>
                                        </div>
                                            <div class="clear"></div><br />
                                            
                                        <div class="button_set button_set2"> 
                                            <input name="send" type="button" value="Send" class="button" onclick="SubmitForm1('send')" />
                                            <?php //if($usd['user_type'] == "2"){ ?>
                                            <input name="draft" type="button" value="Save Draft" class="button" style="margin-right:0 !important;" onclick="SubmitForm1('draft')"/>
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
                                
		<a href="#0" class="cd-popup-close img-replace">Close</a>
        <div class="clear"></div>
	</div> 
     <div class="clear"></div>
</div>

                    <div class="mid_content_inner_left">
                    <div class="compose_button"><a href="#0" class="button_pro cd-popup-trigger">Compose Mail<img src="<?=base_url()?>images/mail_compose_icon.png" alt=""/></a></div>
                    
                        <ul class="inbox_menu">
                        <li <?php if(isset($mail_sidebar) && $mail_sidebar == "1"){ ?>class="active"<?php } ?>><a href="<?=base_url()?>home/inbox"><img src="<?=base_url()?>images/icon_indox01.png" alt=""/>Inbox<?php echo ($mail_count[0]['count'] > 0) ? '<span class="pink">'.$mail_count[0]['count'].'</span>' : "";?></a></li>
			 <?php if($usd['user_type'] == '1') {?>
                         <!--<li <?php if(isset($mail_sidebar) && $mail_sidebar == "4"){ ?>class="active"<?php } ?>><a href="<?=base_url()?>home/addressBook" ><img src="<?=base_url()?>images/icon_indox02.png" alt=""/>AddressBook</a></li>-->
			<?php } ?>
                        <?php //if($usd['user_type'] == '2') {?>
                        
                        <li <?php if(isset($mail_sidebar) && $mail_sidebar == "2"){ ?>class="active"<?php } ?>><a href="<?=base_url()?>home/DraftMail"><img src="<?=base_url()?>images/icon_indox02.png" alt=""/>Drafts<?php echo (isset($draft_count) && $draft_count > 0) ? '<span class="pink" id="drft_cnt">'.$draft_count.'</span>' : "";?></a></li>
                        <li <?php if(isset($mail_sidebar) && $mail_sidebar == "3"){ ?>class="active"<?php } ?>><a href="<?=base_url()?>home/SentMail"><img src="<?=base_url()?>images/icon_indox03.png" alt=""/>Sent Mail<?php //echo (isset($sentmail_count) && $sentmail_count > 0) ? '<span class="pink" id="sntml_cnt">'.$sentmail_count.'</span>' : "";?></a></li>
                        <li <?php if(isset($mail_sidebar) && $mail_sidebar == "4"){ ?>class="active"<?php } ?>><a href="<?=base_url()?>home/addressBook" ><img src="<?=base_url()?>images/icon_indox02.png" alt=""/>Address Book</a></li>
                        <li <?php if(isset($mail_sidebar) && $mail_sidebar == "5"){ ?>class="active"<?php } ?>><a href="<?=base_url()?>home/TrashMail" ><img src="<?=base_url()?>images/icon_indox04.png" alt=""/>Trash</a></li>
                        
                        <?php //} ?>
                        
                        
                        
                        <li <?php if(isset($mail_sidebar) && $mail_sidebar == "6"){ ?>class="active"<?php } ?> style="position:relative">
                        
                        
                            <a class="<?php if(!empty($folder_details)) { ?>hidetext<?php } ?>  no_effect" href="javascript:;" id="folder_a">
                           
                            
                            	<img src="<?=base_url()?>images/icon_indox05.png" alt="">Message Folders<span class="plus"></span><br/>
                        
                        <!--<span style="display:none;" class="bottom_text"><strong>Recent (2)</strong><br />
                        Important</span>-->
                        
                         <?php if(!empty($folder_details)) {
                                 
                                //print_r($folder_details);die;        
                            foreach($folder_details as $key=>$fdetails) {
                                
                              $folder_msg_cnt  = $this->memail->folder_msg_cnt_usr($fdetails['id']); 
                              if(strlen($fdetails['name']) > 10)
                                $rest = substr($fdetails['name'], 0, 10)."...";
                              else{
                                  $rest = $fdetails['name'];
                              }
                            ?>
                                        
                        <div style="display:none;" class="bottom_text">
                        
                        
                        <table width="100%" border="0">
  <tr>
    <td width="54%"><span href='javascript:;' onclick='folder_message(<?php echo $fdetails['id']?>,"<?php echo htmlspecialchars($fdetails['name'],ENT_QUOTES)?>","folder")' title='<?php echo ucfirst($fdetails['name'])?>'> <?php echo ucfirst($rest);?></span></td>
    <td width="24%"><span> (<?php echo $folder_msg_cnt;?>)</span></td>
    <td width="22%"><span href="javascript:;" onclick="delete_folder('<?php echo $fdetails['id']?>', 'folder');" style="cursor:pointer;">
                        <img src="<?=base_url()?>images/del_icon.png" alt="" width="16" style="position:relative; top:2px; padding-right: 0px;"/>
                        </span></td>
  </tr>
  
</table>

                        
                        
                        
                        <?php /*?><strong>
                            <span href='javascript:;' onclick='folder_message(<?php echo $fdetails['id']?>,"<?php echo htmlspecialchars($fdetails['name'],ENT_QUOTES)?>","folder")' title='<?php echo $fdetails['name']?>'>
                            <?php echo $rest;?> (<?php echo $folder_msg_cnt;?>)
                        </span>
                            
                            
                        &nbsp;&nbsp;&nbsp;
                        <span href="javascript:;" onclick="delete_folder('<?php echo $fdetails['id']?>', 'folder');" style="cursor:pointer;">
                        <img src="<?=base_url()?>images/del_icon.png" alt="" width="16" style="position:relative; top:2px; padding-right: 0px;"/>
                        </span>
                        </strong><?php */?>
                       
                        </div>
                        
                        <?php } } ?>
                        
                        </a>
                       
                            <a href="#info" class="nohover" rel="facebox"><img src="<?=base_url()?>images/plus.png" alt=""/></a>
                        </li>
                        
                        
                        
                        <li <?php if(isset($mail_sidebar) && $mail_sidebar == "7"){ ?>class="active"<?php } ?>><a href="<?=base_url()?>home/pitchits_inbox" style="padding-left: 24px;"><img src="<?=base_url()?>images/icon_p.png" alt="" height="20" class="pad_top"/>Pitchits Inbox<?php echo ($pitchit_count > 0) ? '<span class="pink">'.$pitchit_count.'</span>' : "";?></a></li>
                        
                        <li <?php if(isset($mail_sidebar) && $mail_sidebar == "6"){ ?>class="active"<?php } ?> style="position:relative">
                        
                          
                            <a class="<?php if(!empty($pitchit_details)) { ?>hidetext2<?php } ?> no_effect" href="javascript:;" id="pitchit_a" style="padding-left: 26px;">
                            
                            
                                <img src="<?=base_url()?>images/icon_p.png" alt="" height="20" class="pad_top">PitchIt! Folders<span class="plus"></span><br/>
                        
                        <?php if(!empty($pitchit_details)) {
                                 
                                //print_r($folder_details);die;        
                            foreach($pitchit_details as $key=>$pdetails) {
                                
                              $pitchit_msg_cnt  = $this->memail->pitchit_msg_cnt_usr($pdetails['id']); 
                              if(strlen($pdetails['name']) > 10)
                                $rest = substr($pdetails['name'], 0, 10)."...";
                              else{
                                  $rest = $pdetails['name'];
                              }
                            ?>
                                        
                        <div style="display:none;" class="bottom_pitchit">
                        
                        
                        
                        <table width="100%" border="0">
  <tr>
    <td width="54%"><span href="javascript:;" onclick='folder_message(<?php echo $pdetails['id']?>,"<?php echo $pdetails['name']?>","pitchit")' title="<?php echo ucfirst($pdetails['name'])?>">
                            <?php echo ucfirst($rest);?></span></td>
    <td width="24%"><span> (<?php echo $pitchit_msg_cnt;?>)</span></td>
    <td width="22%">
    <span href="javascript:;" onclick="delete_folder('<?php echo $pdetails['id']?>', 'pitchit');" style="cursor:pointer;">
                        <img src="<?=base_url()?>images/del_icon.png" alt="" width="16" style="position:relative; top:2px; padding-right: 0px;"/>
                        </span>
    </td>
  </tr>
  
</table>
                        
                        
                        <?php /*<strong>
                            <span href="javascript:;" onclick='folder_message(<?php echo $pdetails['id']?>,"<?php echo $pdetails['name']?>","pitchit")' title="<?php echo $pdetails['name']?>">
                            <?php echo $rest;?> (<?php echo $pitchit_msg_cnt;?>)
                        </span>
                            
                            
                        &nbsp;&nbsp;&nbsp;
                        <span href="javascript:;" onclick="delete_folder('<?php echo $pdetails['id']?>', 'pitchit');" style="cursor:pointer;">
                        <img src="<?=base_url()?>images/del_icon.png" alt="" width="16" style="position:relative; top:2px; padding-right: 0px;"/>
                        </span>
                        </strong> */?>
                       
                        </div>
                        
                        <?php } } ?>
                        
                      
                        </a>
                      
                        
                            <a href="#pitchits_info" class="nohover" rel="facebox"><img src="<?=base_url()?>images/plus.png" alt=""/></a>
                        </li>
                        
                        </ul>
                        
                    </div>



<script src="<?=base_url()?>js/main.js"></script>
<script src="<?=base_url()?>ckeditor/ckeditor.js"></script>