<?=$this->load->view('template/inner_header.php')?>
<script src="<?=base_url()?>ckeditor/ckeditor.js"></script>
<style>
input.button {
margin: 0 15px 0 8px !important;
}
.auto_t_box{ border:none; background:none;}
</style>


<script type="text/javascript">
$(document).ready(function()
{
 
	$("#user_mail").val('<?php echo $this->uri->segment(3);?>');
	$("#user_email_id").val('<?php echo $this->uri->segment(3);?>');
  
    
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

function folder_message(id,str)
{
    //alert(id);
    window.location.href = '<?=base_url()?>home/folder/'+id+'/'+str;
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

            <div class="content_part">
            	
               
                <div class="mid_content mid_content_inner">
              
                	
                    <?=$this->load->view('template/mail_sidebar_1.php');?>
                    
                    
                    <div class="mid_content_inner_right2" style="padding-bottom:15px;">
							<div class="mid_content_inner_right_bottom">

                                <div class="top_compose">
                                
                                       <?php
                                       $usd = $this->session->userdata('logged_user');
                                       $frmAttrs   = array("id"=>'signupFrm',"class"=>'form-horizontal',"name"=>'myForm');
                                       echo form_open_multipart('mail/compose', $frmAttrs);
                                       ?>
                                        <!--<a href="#" class="closelabel_new"><img src="<?//=base_url()?>images/closelabel.png" alt="" /></a>-->
                                        <div class="text_field_box"><label style="float:left; margin-top:6px; width:3%">To</label>
                                        
                                        <?php if($this->uri->segment(3) == '') { ?>
                                        
                                        <input type="hidden" id="user_mail" name="user_mail" readonly="readonly"/>
                                         <div  class="auto_main" id="parent_email_selected">				
                                            <span id="email_selected">
                                            
                                            </span>
                                            <span>
                                            <input type="text" class="auto_t_box" id="email_input" name="email_input" onkeyup='FnShowSearch(this.value)'><ul id="dropdown_search" style="display:none;"></ul>
                                            </span>
                                           
  					</div>
  					
                                        <input type="hidden" id="user_email_id" name="user_email_id"/>
                                         <label class="com_plus"> <a href="#showAuthorList" class="nohover add_img" rel="facebox" data-url=""><img src="<?php echo base_url('images/plus_icon.png')?>" /></a></label>
                                        
                                        <?php } else {
                                            
                                            $single_user = $this->mwork->single_user($this->uri->segment(3));
                                            ?> 
                                         <div  class="auto_main" id="parent_email_selected">	
                                            <span id="email_selected">			
		                                    <span id="name<?=$this->uri->segment(3)?>" class="choosen"><?php echo $single_user['name_first'].' '.$single_user['name_middle'].' '.$single_user['name_last']?>                                            
		                                    <?php  if($this->uri->segment(4) == 'address_book') {?>
		                                    <img onclick="removeEmail(this,'<?=$this->uri->segment(3)?>')" src="<?=base_url()?>images/close_22.png">
		                                     <?php } ?>
		                                    </span> 
                                            </span>  
                                            <span>
                                            <input type="text" class="auto_t_box" id="email_input" name="email_input" onkeyup='FnShowSearch(this.value)'><ul id="dropdown_search" style="display:none;"></ul>
                                            </span>                                       
                                            <!--<div class="clear"></div>-->
  					</div>
                                        <input type="hidden" id="user_mail" name="user_mail" readonly="readonly" value="<?php echo $single_user['name_first'].' '.$single_user['name_middle'].' '.$single_user['name_last']?>"/>
                                        <input type="hidden" id="user_email_id" name="user_email_id" value="<?=$this->uri->segment(3)?>"/>
                                       <?php  if($this->uri->segment(4) == 'address_book') {?>
                                         <label class="com_plus"> <a href="#showAuthorList" class="nohover add_img" rel="facebox" data-url=""><img src="<?php echo base_url('images/plus_icon.png')?>" /></a></label>
                                        <?php } ?>
                                        <?php } ?>
                                         
                                       <!-- <label> <a href="javascript:;" class="hidetext4">cc</a></label>
                                        <div class="clear"></div>
                                            <div class="bottom_text4" style="display:none">
                                            <input name="cc" id="cc" type="text" value="" /></div>
                                            <div class="clear"></div>-->
                                         <!--<label>
                                            <a href="javascript:;" class="hidetext4">cc</a></label>
                                            <div class="clear"></div>
                                            <span id="status"></span>
                                            <div class="bottom_text4" style="display:none">
                                            <input name="text" type="text" value="" /></div>-->
                                            <div class="clear"></div>
                                        </div>
                                        <div class="text_field_box2"><label>Subject</label>
                                        
                                        <?php if($this->uri->segment(3) == '') {?>
                                        
                                        <input type="text" id="sub" name="sub" />
                                        
                                        <?php } else { ?>
                                        <?php  if($this->uri->segment(4) == 'address_book') {?>
                                         <input type="text" id="sub" name="sub" value="" />
                                        <?php }else{ 
                                            $pit_name = $this->mwork->get_pit($this->uri->segment(4));
                                            ?>
                                        <input type="text" id="sub" name="sub" readonly="readonly" value="<?=$pit_name['pitchit']?>" />
                                        <?php } ?>
                                        <?php } ?>
                                        
                                        </div>
                                        <div class="comm_tarea">
                                            <textarea class="ckeditor" cols="80" name="desc"  id="editor2" > </textarea>
                                        </div>
                                            <div class="clear"></div><br />
                                            
                                            <label class="fileContainer">
                                            <img src="<?=base_url()?>images/attachment_icon.png" alt=""   /> 
                                            <input type="file" id="image" name="image" onchange="myFunction()"/>
                                            <span id="demo_upload"></span>
                                        </label>
                                            
                                            
                                            <input name="submit" type="submit" value="Send" class="button" />
                                            <input name="draft" type="submit" value="Save Draft" class="button" style="margin-right:0 !important;"/>
                                            
                                            
                                            
                                       </form>  
                                       <div class="clear">  </div> 
                                </div>

</div>
  
					</div>
                    <div class="clear"></div>
                      
                </div>
                <div class="clear"></div>
             
<?=$this->load->view('template/inner_footer.php')?>
