<?=$this->load->view('template/inner_header.php')?>

<style>
.mail_link
{
    color: #636363;
}

</style>


<script>

$(document).ready(function() {
    
     CKEDITOR.replace( 'desc', {
            removeButtons: 'Source',
            // The rest of options...
        }); 
    
   $('#del_msg').click(function(){
       var msg_type = $("#msg_type").val(); 
        //alert('hi');
        var favorite = [];
            $.each($("input[name='check']:checked"), function(){            
                favorite.push($(this).val());
            });
          //alert("My favourite sports are: " + favorite.join(", "));
       
       if(favorite.length > 0)
       {
         $.ajax({
           url      : '<?=base_url()?>'+'home/delete_folder_msg/<?=$foldid;?>/<?=$title;?>',
           type     : 'POST',
           data     : { 'id':favorite, 'msg_type' : msg_type },
           success  : function(data){
               
                /*if(resp != '0'){
                    $("#delete_msg").html(resp);
                    //$("#edit_class" ).dialog( "close" );
                }*/
                var p;
                    var ps = data.messages;
                    var html='';
                    //var pg = parseInt(page) + 1;
                    console.log(ps);
                    //console.log(data);
                    //alert(data.status);
                    //var count = parseInt(data['count']);
                    if(data.status == "true")
                    {
                        window.location.reload();
                    	//alert("jasfkjsd");
                        for (var i = 0, p; p = ps[i++];) 
                        {
                            html += '<li class="mid_content_inner_right_bottom_box">';
                            html += '<div class="cb-styles" style="float:left; margin-left:15px;">';
                            html += '<input type="checkbox" id="checkbox67_'+p.id+'" name="check" class="css-checkbox lrg check1" value="'+p.id+'" >';
                            html += '<label for="checkbox67_'+p.id+'" name="checkbox67_lbl" class="css-label lrg web-two-style check1"></label>';
                            html += '</div>';
                            if(p.is_marked == "0"){
                            	html += '<span class="star_new" style="cursor:default;"></span>';
                            }else{
                            	html += '<span class="star_new marked" style="cursor:default;"></span>';
                            }
                            //html += '<span class="star_new"></span>';
                            
                            html += '<span class="lst_img">';
                            if(p.photo != "" && p.photo != null)
                            {
                           	html +='<img src="'+BASE+'uploadImage/'+p.from_user_id+'/profile/'+p.photo+'" alt="" class="img_sz_small">';
                            }
                            else
                            {
                            	html +='<img src="'+BASE+'images/img_default_headshot.png" alt="" class="img_sz_small">';
                            }
                            html += '</span>';
                            html += '<div class="bond">';
                            html += '<span class="soph_con">'+p.name+'</span>';
                            
                            html += '<span class="for_mob_time">';
                             if(p.attach_file != "" && p.attach_file != null)
                             {
                                html += '<a href="'+BASE+'mail/download/'+p.from_user_id+'/'+p.attach_file+'" class="mail_link"><img src="'+BASE+'images/attachment_icon.png" alt="">&nbsp;'+p.attach_file+'</a>';
                                            
                            } else {         
         		    	html += '<a href="#info" rel="facebox">&nbsp;</a>';         
        		    }
                            html += '</span>';
                            console.log(p.is_viewed);
                            html += '<span class="soph_con1 detail_for_mob"><a class="mail_link" href="'+BASE+'mail/details/'+p.id+'">'+p.subject+'</a></span>';
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
		            
		            html += '<div class="clear"></div>';
		            html += '</li>';
		            html += '<div class="clear"></div>';
                                              
                        }
                        //alert(html);
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
            alert("Please select atleast one message");
        }  
          
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
        loader: '<img src="'+base_url+'assets/img/ajax-loader.gif"/>',
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
                                     


            <div class="content_part">
            	
              
                <div class="mid_content mid_content_inner">
              
                	
                    
                    <?=$this->load->view('template/mail_sidebar.php');?>
                    
                    <div class="mid_content_inner_right">
                    
                         <div class="mid_content_inner_right_top">
                         <span id="folder_msg"></span>
                                <h1><?php echo $title;?> (<?php echo $folder_count;?>)</h1>
                                <div class="search_right">
                                <form method="post" action="">
                                <!--<input name="search" type="text" onfocus="javascript:if(this.value=='Search')this.value='';" onblur="javascript:if(this.value=='')this.value='Search';" value="Search" id="search"/>
                                <input name="search_button" type="button" value="" />-->
                                </form>
                                </div>
                                <div class="clear"></div>
                                
                                
                                
                               <div class="drop_menu_section">
                                    <div class="drop_menu_section_left">
                                    
                                    <div class="cb-styles" style="float:left; margin:5px 10px 0 0; border:1px solid #CDCBCB; border-radius:5px; padding:6px;">
	
                                                <input type="checkbox" id="checkbox67" class="css-checkbox lrg" />
                                                <label for="checkbox67" class="css-label lrg web-two-style"></label>
					
					                </div>
                                    
                                    <div class="demo">
                                    <form action="" method="post">
                                    
                                    <!--<div class="outer_border">
                                    <input type="checkbox" id="cb2" class="cb2" value="" />
                                    <div class="clear"></div>
                                    </div>-->
                                    
                                    <!--<div class="refresh_icon"><a href="#"></a></div>-->
                                    
                                    <!--<select name="menu" id="sl2-ic" tabindex="2">
                                    <option>Action</option>
                                    <option value="delete" class="del_msg">Delete</option>
                                    
                                    </select>-->
                                    
                                    <div class="drop_cont">
                                        <input type="hidden" name="msg_type" id="msg_type" value="<?= $msg_type;?>">
                                            <ul class="dropdown trigger">
                                                <h2 class="dropdown-title">Action</h2>
                                                <li class="dropdown-list list" id="del_msg">Delete</li>
                                            </ul>
                                        </div>
                                    
                                    <div class="drop_cont" style="margin-left: 10px;">
                                        <ul class="dropdown folder">
                                            <h2 class="dropdown-title">Move to</h2>
                                    <?php 
                                    if($msg_type == 'pitchit'){
                                        $folder_details = $pitchit_details;
                                    }
                                    if(!empty($folder_details)) {
                                     
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
                                                            /*if(resp != '0'){
                                                                $("#folder_msg").html(resp);
                                                                //$("#edit_class" ).dialog( "close" );
                                                            }*/
                                                            if(resp.status == "true")
                                                            {
                                                            	if(resp.exists != "")
                                                            	{
                                                            		html = "<p style='color:green;'>Mail successfully added to folder "+resp.exists+"</p>";
                                                            	}
                                                            	if(resp.success != "")
                                                            	{
                                                            		html = "<p style='color:green;'>Mail successfully added to folder "+resp.success+"</p>";
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
                                                    
                                                    }  
                                         
                                       });
                                       
                                        
                                    });
                                    
                                    </script>
                                    
                                    <li class="dropdown-list folderlist" id="fold_<?php echo $fdetails['id']?>"><?php echo $fdetails['name']?></li>
                                    <!--<option value="<?php echo $fdetails['id']?>" class="fold_<?php echo $fdetails['id']?>"><?php echo $fdetails['name']?></option>-->
                                    
                                    <?php } } ?>
                                    
                                        </ul>
                                    </div>
                                    
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
                                  <div class=""  id="full_content_div">
                                  
                                     <ul class="mid_content_inner_right_bottom_box itemld" id="delete_msg" >
                                     
                                     <?php if(!empty($mail_details)) {
                                        
                                        foreach($mail_details as $key=>$details) {
                                            
                                            $s = $details['created'];
                                            $dt = new DateTime($s);
                                            $time = $dt->format('h:i A');
                                        
                                        ?>
                                     
                           
                                         <li class="mid_content_inner_right_bottom_box">
                                         
                                            <!--<span class="check_bx"><input name="check" type="checkbox" value="<?php echo $details['id']?>" id="checkBoxID" class="cb1 test_<?php echo $key ?>" data-keycheck="<?php echo $key ?>"  /></span>-->
                                            
                                            <div class="cb-styles" style="float:left; margin-left:15px;">
	
                         <input type="checkbox" id="checkbox67_<?php echo $details['id']?>" name="check" class="css-checkbox lrg check1" value="<?php echo $details['id']?>" />
                                                <label for="checkbox67_<?php echo $details['id']?>" name="checkbox67_lbl" class="css-label lrg web-two-style check1"></label>
					
											</div>
                                            
                                            <span class="star_new"></span>
                                            <span class="lst_img"><?php if(!empty($details['photo'])) { ?>
                                            <img src="<?=base_url()?>uploadImage/<?=$details['from_user_id']?>/profile/<?=$details['photo']?>" alt="" class="img_sz_small" />
                                            <?php } else { ?>
                                              <img src="<?=base_url()?>images/img_default_headshot.png" alt="" class="img_sz_small" />
                                              
                                              <?php } ?></span>
                                            <div class="bond">
                                                <span class="soph_con"><?php echo $details['name']?></span>
                                                <span class="for_mob_time">
                                            <!--<a href="#info" rel="facebox"><img src="<?=base_url()?>images/attachment_icon.png" alt="" /></a></span>--> 
                                            <?php if(!empty($details['attach_file'])) {?>        
                                           <a href="<?=base_url()?>mail/download/<?=$details['attach_file']?>" class="mail_link"><img src="<?=base_url()?>images/attachment_icon.png" alt="" />&nbsp;<?=$details['attach_file']?></a>
                                      
                                      <?php } else {?>
         
        <a href="#" class="mail_link" style="width:16px;">&nbsp;</a>
         
         <?php } ?>      </span> 
                                                
                                                <span class="soph_con1 detail_for_mob"><a class="mail_link" href="<?=base_url()?>mail/details/<?php echo $details['message_id']?>"><?php echo $details['subject']?></a></span>
                                                <div class="clear"></div>
                                            </div>
                                            <span class="atch">
                                            
                                             <?php if(!empty($details['attach_file'])) {?>                                  
                                            <a href="<?=base_url()?>mail/download/<?=$details['attach_file']?>" class="mail_link"><img src="<?=base_url()?>images/attachment_icon.png" alt="" />&nbsp;<?=$details['attach_file']?></a>
         <?php } else {?>
         
         <a href="#" class="mail_link" style="width:16px;">&nbsp;</a>
         
         <?php } ?>   </span>
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
                
<!--#################dropdown#####################-->
<script>
var folder = '.folder';
var folderlist = '.folderlist';
function toggleFolder() {
  $(folderlist).slideToggle(200, 'linear');
}

$(folder).on('click', function () {
	toggleFolder();
});
</script>
<?=$this->load->view('template/inner_footer.php')?>              

