<?=$this->load->view('template/inner_header.php')?>

<link href='<?=base_url()?>style/inner/reply_popup.css' rel='stylesheet' />
<script src="<?=base_url()?>js/editor.js"></script>

<link href="<?=base_url()?>style/inner/bootstrap.min.css" rel="stylesheet">
<link href="http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<link href="<?=base_url()?>style/inner/editor.css" type="text/css" rel="stylesheet"/>

<style>
.mail_link{color: #636363;}
.drop_cont {width: 80px;}
</style>

<script>

$(document).ready(function() {
    
  
     CKEDITOR.replace( 'replyall_text', {
            removeButtons: 'Source',
            // The rest of options...
        }); 
    
   $('#del_msg').click(function(){
        
        //alert('hi');
        var favorite = [];
            $.each($("input[name='check']:checked"), function(){            
                favorite.push($(this).val());
            });
          //alert("My favourite sports are: " + favorite.join(", "));
       if(favorite.length > 0)
       {
         $.ajax({
           url      : '<?=base_url()?>'+'home/delete_draft_msg',
           type     : 'POST',
           data     : { 'id':favorite },
           success  : function(data){
           	//alert(resp);
                /*if(resp != '0'){
                    $("#delete_msg").html(resp);
                    //$("#edit_class" ).dialog( "close" );
                }*/
        
                /////////////add anwar//////////////
                var drft_cnt = $("#drft_cnt").html();
                var rem_val = drft_cnt - favorite.length;
                $("#drft_total").html("Draft ("+parseInt(rem_val)+")");
                if(rem_val == '0'){
                    $("#drft_cnt").css('background', "none");
                }else{
                    $("#drft_cnt").html(parseInt(rem_val));
                }
                //////////////////////////
        
        
                var p;
                    var ps = data.draft_details;
                    var html='';
                    //var pg = parseInt(page) + 1;
                    console.log(ps);
                    //console.log(data);
                    //alert(data.status);
                    //var count = parseInt(data['count']);
                    if(data.status == "true")
                    {
                    	//alert("jasfkjsd");
                        for (var i = 0, p; p = ps[i++];) 
                        {
                            html += '<li class="mid_content_inner_right_bottom_box">';
                            html += '<div class="cb-styles" style="float:left; margin-left:15px;">';
                            html += '<input type="checkbox" id="checkbox67_'+p.id+'" name="check" class="css-checkbox lrg check1" value="'+p.id+'" >';
                            html += '<label for="checkbox67_'+p.id+'" name="checkbox67_lbl" class="css-label lrg web-two-style check1"></label>';
                            html += '</div>';
                            /*if(p.is_marked == "0"){
                            	html += '<span class="star_new" style="cursor:default;"></span>';
                            }else{
                            	html += '<span class="star_new marked" style="cursor:default;"></span>';
                            }*/
                            //html += '<span class="star_new"></span>';
                            
                            html += '<span class="lst_img">';
                            if(p.photo != "" && p.photo != null)
                            {
                           	html +='<img src="'+BASE+'uploadImage/'+p.to_user_id+'/profile/'+p.photo+'" alt="" class="img_sz_small">';
                            }
                            else
                            {
                            	html +='<img src="'+BASE+'images/img_default_headshot.png" alt="" class="img_sz_small">';
                            }
                            html += '</span>';
                            html += '<div class="bond">';
                            html += '<span class="soph_con">'+p.name+'</span>';
                            /*if(p.is_viewed == "1")
                            {
                            	html += '<span class="soph_con">'+p.name+'</span>';
                            }
                            else
                            {
                            	html += '<span class="soph_con" style="font-weight:bold !important;">'+p.name+'</span>';
                            }*/
                            
                            html += '<span class="for_mob_time">';
                             if(p.attach_file != "" && p.attach_file != null)
                             {
                                html += '<a href="'+BASE+'mail/download/'+p.from_user_id+'/'+p.attach_file+'" class="mail_link"><img src="'+BASE+'images/attachment_icon.png" alt="">&nbsp;'+p.attach_file+'</a>';
                                            
                            } else {         
         		    	html += '<a href="#info" rel="facebox">&nbsp;</a>';         
        		    }
                            html += '</span>';
                            html += '<span class="soph_con1 detail_for_mob"><a class="mail_link" href="'+BASE+'mail/details/'+p.id+'">'+p.subject+'</a></span>';
                           /* if(p.is_viewed == "1")
                            {
                            	
                            }
                            else
                            {
                            	html += '<span class="soph_con1 detail_for_mob" style="font-weight:bold !important;"><a class="mail_link" href="'+BASE+'mail/details/'+p.id+'">'+p.subject+'</a></span>';
                            	
                            	
                            }*/
                            
                            html += ' <div class="clear"></div>';		    
                            html += '</div>';
			    html += '<span class="atch">';
		            if(p.attach_file != "" && p.attach_file != null)
                             {
                                html += '<a href="'+BASE+'mail/download/'+p.from_user_id+'/'+p.attach_file+'" class="mail_link"><img src="'+BASE+'images/attachment_icon.png" alt="">&nbsp;'+p.attach_file+'</a>';
                                            
                            } 
                            else 
                            {         
         		    	html += '<a href="#info" rel="facebox">&nbsp;</a>';         
        		    }
        		    html += '</span>';
        		    html += '<span class="soph_con1">'+p.date+'</span>';
        		    /*if(p.is_viewed == "1")
                            {
                            	
                            }
                            else
                            {
                            	html += '<span class="soph_con1" style="font-weight:bold !important;">'+p.date+'</span>';
                            	
                            }*/
		            
		            html += '<div class="clear"></div>';
		            html += '</li>';
		            html += '<div class="clear"></div>';
                                              
                        }
                        $("#delete_msg").html(html);
                        $("#paginate").html(data.pagination);
                         $('#checkbox67').each(function() { //loop through each checkbox
                                                this.checked = false; //deselect all checkboxes with class "checkbox1"    
                                               
                                                           
                        }); 
                   } 
           },
           error    : function(resp){
                $.prompt("Sorry, something isn't working right.", {title:'Error'});
           }
        }); 
        
       }else{
        alert("Please select at least one message");
        window.reload();
        return false;
       }
          
          
   });
   
   
   $('.revice_msg').click(function(){
        
        var revice_id = $(this).find('span').attr('data-val');
        var favorite = [];
            $.each($("input[name='check']:checked"), function(){            
                favorite.push($(this).val());
            });
          //alert("My favourite sports are: " + favorite.join(", "));
       if(favorite.length > 0)
       {
         $.ajax({
           url      : '<?=base_url()?>'+'home/move_draft_msg',
           type     : 'POST',
           data     : { 'id':favorite , 'revice_id':revice_id },
           success  : function(resp){
                if(resp != '0'){
                    $("#delete_msg").html(resp);
                    //$("#edit_class" ).dialog( "close" );
                }
           },
           error    : function(resp){
                $.prompt("Sorry, something isn't working right.", {title:'Error'});
           }
        });   
      
      }    
          
   });
   
   $('#search').keyup(function(){
        
        //alert('hi');
        var search = $('#search').val();
      
         $.ajax({
           url      : '<?=base_url()?>'+'home/search_draft_msg',
           type     : 'POST',
           data     : { 'search':search },
           success  : function(resp){
                if(resp != '0'){
                    $("#delete_msg").html(resp);
                    //$("#edit_class" ).dialog( "close" );
                }
           },
           error    : function(resp){
                $.prompt("Sorry, something isn't working right.", {title:'Error'});
           }
          });   
        
         
          
   });  
   
    
});

</script>
<script>
var base_url = '<?php echo base_url()?>';
//alert('<img src="'+base_url+'assets/img/ajax-loader.gif"/');
  jQuery.ias({
        container : '#full_content_div',
        item: '.itemld',
        pagination: '.paginate',
        next: '.nextPage a',
        loader: '<img src="'+base_url+'assets/img/ajax-loader.gif">',
        onPageChange: function(pageNum, pageUrl, scrollOffset) {
            //console.log('Welcome on page ' + pageNum);
        },
        onRenderComplete : function(){
            //getRatingProduct();
            //getMerchantProductRating();
        },
        history:false
    });

</script>
<script>
function folder_message(id,str)
{
    //alert(id);
    window.location.href = '<?=base_url()?>home/folder/'+id+'/'+str;
}
</script>

            <div class="content_part">
            	
              
                <div class="mid_content mid_content_inner">
              
                	
                   <?=$this->load->view('template/mail_sidebar.php');?>
                   
                    <div class="mid_content_inner_right">
                    
                         <div class="mid_content_inner_right_top">
                         <span id="folder_msg"></span>
                         <h1 id="drft_total">Drafts (<?php echo $draft_count;?>)</h1>
                                <div class="search_right">
                                <form method="post" action="">
                                <!--<input name="search" type="text" onfocus="javascript:if(this.value=='Search')this.value='';" onblur="javascript:if(this.value=='')this.value='Search';" value="Search" id="search"/>
                                <input name="search_button" type="button" value="" />-->
                                </form>
                                </div>
                                <div class="clear"></div>
                                
                                
                                
                               <div class="drop_menu_section">
                                    <div class="drop_menu_section_left">
                                    
                                    <div class="cb-styles" style="float:left; margin:1px 10px 0 0; border:1px solid #CDCBCB; border-radius:5px; padding:6px;">
	
                                                <input type="checkbox" id="checkbox67" class="css-checkbox lrg" />
                                                <label for="checkbox67" class="css-label lrg web-two-style"></label>
					
					                </div>
                                    
                                    <div class="demo">
                                    <form action="" method="post">
                                        <div class="drop_cont">
                                            <ul class="dropdown2 trigger">
                                                <h2 class="dropdown-title">Action</h2>
                                                <li class="dropdown-list list" id="del_msg">Delete</li>
                                            </ul>
                                        </div>
                                    
                                     <!--<div class="refresh_icon"><a href="#"></a></div>-->
                                    
                                    <!--<select name="menu" id="sl2-ic" tabindex="2">
                                    <option>Action</option>
                                    <option value="delete" class="del_msg">Delete</option>
                                    </select>-->
                                    <?php /*<select name="menu" id="sl3-csb" tabindex="3">
                                    <option>Move to</option>
                                    <option value="1" class="revice_msg">Inbox</option>
                                    <?php if(!empty($folder_details)) {
                                     
                                    foreach($folder_details as $key=>$fdetails) {
                                    ?>
                                    
                                    
                                    <script>

                                    $(document).ready(function() {
                                        
                                       $('.fold_<?php echo $fdetails['id']?>').click(function(){
                                            
                                            //alert('hi');
                                            var favorite = [];
                                                $.each($("input[name='check']:checked"), function(){            
                                                    favorite.push($(this).val());
                                                });
                                              //alert("My favourite sports are: " + favorite.join(", "));
                                              
                                            if(favorite.length > 0)
                                                   {
                                                     $.ajax({
                                                       url      : '<?=base_url()?>'+'home/folder_msg',
                                                       type     : 'POST',
                                                       data     : { 'id':favorite , 'foldId' : <?php echo $fdetails['id']?> , 'foldname' : '<?php echo $fdetails['name']?>'  },
                                                       success  : function(resp){
                                                            if(resp != '0'){
                                                                $("#folder_msg").html(resp);
                                                                //$("#edit_class" ).dialog( "close" );
                                                            }
                                                       },
                                                       error    : function(resp){
                                                            $.prompt("Sorry, something isn't working right.", {title:'Error'});
                                                       }
                                                    });   
                                                    
                                                    }  
                                         
                                       });
                                       
                                        
                                    });
                                    
                                    </script>
                                    
                                    
                                    <option value="<?php echo $fdetails['id']?>" class="fold_<?php echo $fdetails['id']?>"><?php echo $fdetails['name']?></option>
                                    
                                    <?php } } ?>
                                    </select>*/?>
                                    
                                    </form>
                                    </div>
                                    
                                    </div>
                                        
                                        <!--<div class="drop_menu_section_right">
                                        <p>1- 50 of 112</p>
                                        <input type="button" class="arrow_left" value="" name="button"><input type="button" class="arrow_right" value="" name="button">
                                        </div>-->
                                        
                                        <div class="clear"></div>
                                        
                                        </div>
                                
                   </div>
                    
                                <div class="mid_content_inner_right_bottom">
                                  <div class="" id="full_content_div">
                                   <script>

$(document).ready(function() {
    $('#checkbox67').click(function(event) {  //on click 
        if(this.checked) { // check select status
            $('.check1').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"  
                     
            });
        }else{
            $('.check1').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"    
               
                           
            });         
        }
        
        
    });
    
    
});

</script>             

<script>

function draft_send(id)
{
    //alert(id);
    
    $.ajax({
           url      : '<?=base_url()?>'+'home/draft_send',
           type     : 'POST',
           data     : { 'id':id },
           success  : function(data){
            
            var res = data.split("~");
            
            $('#reply_email').val(res[0]);
            $('#fullname').html(res[1]);
            $('#reply_sub').val(res[2]);
            //$('#reply_body').val(res[3]);
            CKEDITOR.instances['replyall_text'].setData(res[3]);
            //alert(res[1]);
            $('#message_id').val(id);
            
            },
         error    : function(resp){
                $.prompt("Sorry, something isn't working right.", {title:'Error'});
           }
          });    
    
} 

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

</script>

 <div class="replyall-popup" role="alert">
    
	<div class="replyall-popup-container">
            <div style=" width:100%; background:#000; padding:20px 0;"></div>
                <div class="top_replyall">
                   
                   <form name="replyFrm5" id="replyFrm5" method="post" action="<?php echo base_url();?>mail/draftAllbox" enctype="multipart/form-data"> 
                                
                    <div class="text_field_box">
                        <label style="float:left; margin-top:9px; width:3%">To</label>
                        <input type="hidden" id="reply_email" name="reply_email" value="<?php //echo $reply_user['email']?>,<?php //echo $user_contact['email']?>"/>
                        <input type="hidden" id="msg_type" name="msg_type" value="<?php //echo $single_mail_details['is_pitchited']?>"/>
                        <input type="hidden" id="reply_message_id" name="reply_message_id" value="<?php //echo $this->uri->segment(3)?>"/>
                        
                        <input type="hidden" id="message_id" name="message_id" value="<?php //echo $this->uri->segment(3)?>"/>
                        
                        <div  class="auto_main">				
<!--                            <span id="email_selected"></span>-->
                            <span class="choosen" id="fullname">
                                
                                <?php //echo $reply_user['name_first'].' '.$reply_user['name_last'];?>
<!--                                <ul id="dropdown_search" style="display:none;">
                                </ul>-->
                            </span>
                           
                           

                        </div>

<!--                        <label class="com_plus"> <a href="#showAuthorList" class="nohover add_img" rel="facebox" data-url=""><img src="<?php echo base_url('images/plus_icon.png')?>" /></a></label>-->


                        <div class="clear"></div>
                    </div>
                    
                    <div class="text_field_box3"><label style="float:left; margin-top:9px;">Subject</label>
                        <input type="text" id="reply_sub" name="reply_sub"  class="sub_mail_content" value="<?php //echo $single_mail_details['subject']?>" >
                        <div class="clear"></div>
                    </div>
                    
                    <div class="comm_tarea">
                        <textarea class="ckeditor" cols="80" name="replyall_text"  id="replyall_text" > </textarea>
                    </div>
                    <div class="clear"></div><br />
                                            
           
                     <div class="button_set">                   
                    
                    
                    
                    <input name="reply" name="reply" type="button" value="Send" class="reply_button" onclick="SubmitForm5('reply')"/>
                    
                    <label class="fileContainer">
                        <img src="<?=base_url()?>images/attachment_icon.png" alt=""   /> 
                        <input type="file" id="image1" name="image" onchange="myFunction_img()"/>
                        <span id="demo_upload_img"></span>
                    </label>
                    
                    <?php /* <input name="draft" name="draft" type="button" value="Save Draft" class="reply_button" onclick="SubmitForm4('draft')"/>
					
                    
                  
                    <a href="javascript:void(0);" onclick="delete_details(<?php echo $this->uri->segment(3);?>)"><img src="<?=base_url()?>images/delete_new.png" alt="" /></a> */ ?>
					
					</div>
                    <div class="clear"></div> 
                    
                    </form>
                    
                </div>
                                
		<a href="#0" class="replyall-popup-close img-replace">Close</a>
                <div class="clear"></div>
            </div> 
        <div class="clear"></div>
         
    </div>

                                     <ul class="mid_content_inner_right_bottom_box itemld" id="delete_msg">
                                    
                                     <?php 
                                     //echo '<pre/>';print_r($draft_details);die;
                                     if(!empty($draft_details)) {
                                        
                                        foreach($draft_details as $details) {
                                            
                                            $s = $details['created'];
                                            $dt = new DateTime($s);
                                            $time = $dt->format('h:i A');
                                        
                                        ?>
                                        
                          
                                     
                                         <li class="mid_content_inner_right_bottom_box">
                                         
                                            <!--<span class="check_bx"><input name="checkbox" type="checkbox" value="" id="cb1" /></span>-->
                                            
                                            <div class="cb-styles" style="float:left; margin-left:15px;">
	
                         <input type="checkbox" id="checkbox67_<?php echo $details['id']?>" name="check" class="css-checkbox lrg check1" value="<?php echo $details['id']?>" />
                                                <label for="checkbox67_<?php echo $details['id']?>" name="checkbox67_lbl" class="css-label lrg web-two-style check1"></label>
					
											</div>
                                            
                                            <!--<span class="star_new"></span>-->
                                            <span class="lst_img">
                                             <?php if(!empty($details['photo'])) { ?>
                                            <img src="<?=base_url()?>uploadImage/<?=$details['to_user_id']?>/profile/<?=$details['photo']?>" alt="" class="img_sz_small" />
                                            <?php } else { ?>
                                              <img src="<?=base_url()?>images/img_default_headshot.png" alt="" class="img_sz_small" />
                                              
                                              <?php } ?>
                                            </span>
                                            <div class="bond">
                                                <div class="soph_con">
                                                <a class="tooltips replyall-popup-trigger" href="javascript:void(0)" onclick="draft_send(<?=$details['id']?>)">
                                                
                                                <?php //echo $details['name'].' '.$details['name_middle'].' '.$details['name_last']
                                                
                                                $full_name = $details['name'].' '.$details['name_middle'].' '.$details['name_last'];
                                                if(strlen($full_name) > 15)
                                                {
                                                   echo substr($full_name,0,15).'..';
                                                }
                                                else
                                                {
                                                    echo $full_name;
                                                }
                                                
                                                ?>
                                                
                                                <span class="tp_span2"><?php echo $full_name;?></span>
                                                 <div class="clear"></div>
                                                
                                                </a>
                                                </div>
                                                <span class="for_mob_time">
                                            <?php if(!empty($details['attach_file'])) {?> 
                                            
                                            <a href="<?=base_url()?>mail/download/<?=$details['from_user_id']?>/<?=$details['attach_file']?>" class="mail_link"><img src="<?=base_url()?>images/attachment_icon.png" alt="" />&nbsp;<?=$details['attach_file']?></a>
                                            
                                            <?php } else {?>
         
         <a href="#" class="mail_link">&nbsp;</a>
         
         <?php } ?> </span>
         
         
        
                                                
                         <span class="soph_con1 detail_for_mob">
                       <?php /* <a class="mail_link " href="<?=base_url()?>mail/details/<?php echo $details['id']?>"><?php echo $details['subject']?></a> */ ?>
                         <a class="mail_link replyall-popup-trigger" href="javascript:void(0)" onclick="draft_send(<?=$details['id']?>)"><?php echo $details['subject']?></a>
                         </span>
                                                <div class="clear"></div>
                                            </div>
                                            <span class="atch">
                                            <?php if(!empty($details['attach_file'])) {?> 
                                            
                                            <a href="<?=base_url()?>mail/download/<?=$details['from_user_id']?>/<?=$details['attach_file']?>" class="mail_link"><img src="<?=base_url()?>images/attachment_icon.png" alt="" />&nbsp;<?=$details['attach_file']?></a>
                                            
                                            <?php } else {?>
         
         <a href="#" class="mail_link">&nbsp;</a>
         
         <?php } ?> </span>
                                            
                                            </span>
                                            <span class="soph_con1"><?php //echo $time?><?=date('m/d/Y',strtotime($details['created']))?></span>
                                            <div class="clear"></div>
                                        
                                
                                         </li>
                                         <div class="clear"></div>
                                         
                                        <?php } } ?> 
                                         
                                          
                                        
                                     </ul>
                                <ul class="paginate pagination3"><li id="paginate"><?=$this->pagination->create_links()?><?//=$this->ajax_pagination->create_links()?></li></ul>
                                  </div>
                                </div>
                    
                    </div>
                    <div class="clear"></div>
                     
                   </div>
                <div class="clear"></div>

<?=$this->load->view('template/inner_footer.php')?>              

