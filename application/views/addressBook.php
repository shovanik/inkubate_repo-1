<?=$this->load->view('template/inner_header.php')?>

<style>
.mail_link{color: #636363;}
.pagination ul li.inactive, .pagination ul li {background-color:#8dc63f !important; color: #FFFFFF; border: 1px solid #6a9a28!important;}
.pagination ul li.inactive:hover, .pagination ul li:hover {background-color:#6a9a28 !important; color: #FFFFFF!important; border: 1px solid #6a9a28!important;}
.search_right {float: left; padding-top: 10px; margin: 0 0 0 50px;}

 .filter_section_search {margin: 13px 0 0 114px;width: 43%;}
</style>

<script>

$(document).ready(function() {
    
     CKEDITOR.replace( 'desc', {
            removeButtons: 'Source',
            // The rest of options...
        }); 
    
   $('.del_msg').click(function(){
        
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
function folder_message(id,str)
{
    //alert(id);
    window.location.href = '<?=base_url()?>home/folder/'+id+'/'+str;
}
</script>

            <div class="content_part">
            	
              
                <div class="mid_content mid_content_inner">
              
                	
                   <?=$this->load->view('template/mail_sidebar.php');?>
                   
                    <div class="mid_content_inner_right address_noborder">
                    
                         <div class="mid_content_inner_right_top">
                         <span id="folder_msg"></span>
                                <h1>Address Book (<?php echo $count;?>)</h1>
                                
                                <div class="filter_section_search">
                                <input name="user_search" id="user_search" type="text" onfocus="javascript:if(this.value=='Search')this.value='';" onblur="javascript:if(this.value=='')this.value='Search';" value="Search" />
                                <input type="button" value="" onclick="globalSearch()"/>
                                
                                </div>
                                <!--<div class="search_right">
                                <form method="post" action="">
                                <input name="user_search" type="text" onfocus="javascript:if(this.value=='Search')this.value='';" onblur="javascript:if(this.value=='')this.value='Search';" value="Search" id="user_search"/>
                                <input name="search_button" type="button" value="" />
                                </form>
                                </div>-->
                                
                                <div class="clear"></div>
                                
                                
                                
                               <!--<div class="drop_menu_section">
                                   
                                   Author : <select >
                                   <option>abc</option>
                                   <option>abc</option>
                                   </select><input type="submit" value="Add" class="button"/>
                                        
                                        <div class="clear"></div>
                                        
                                        </div>-->
                                        <style>
                                        	.alphabet li{
                                        		float:left;
                                        		padding:5px;
                                        	}
                                        	.author_active{
                                        		color:green;
												font-weight: bold;
                                        	}
                                        </style>
                                        <script>
                                        
                                   $(document).ready(function(){
                                    $("#user_search").keyup(function(){
                                        
                                        var id = $("#user_search").val();
                                        var page = '<?=$page?>';
                                        var per_page = '<?=$per_page?>';
                                        
                                        //alert(id);
                                        //alert(page);
                                        //alert(per_page);
                                        if(id == '')
                                        {
                                          FnAuthorsPage('a',page,per_page);
                                        }
                                        else
                                        {
                                          FnAuthorsPage(id,page,per_page); 
                                        }
                                        
                                    })
                                    
                                    
                                    
                                })
                                        
                                        
                                       BASE = '<?php echo base_url();?>';
                                    function FnAuthorsPage(id,page,per_page)
				    {
				    	
				    	
				    		$(".author_active").removeClass();
				    		$("#"+id).addClass("author_active");
				    
				    
				    	
				    		$.ajax({
						type:'POST',
						url:BASE+'home/authors_alphabet_page',
						data:{id:id,page:page,per_page:per_page},
						dataType:'json',
						success:function(data){
						  
                            //event.preventDefault();
                           
						    var html = '';
						    if(data['status'] == "1")
						    {
							var ps = data['author_list'];
						
							for (var i = 0, p; p = ps[i++];) 
							{
							     
                                 var  name = p.name_first+" "+p.name_middle+" "+p.name_last;
							     html += '<span class="selectAuthor" data-num="'+i+'" style="background: #d0e6fe;color:#333;border-radius:4px;padding: 5px;margin: 0 10px 5px 0; float: left;width:45% ;cursor:pointer" data-id="'+p.id+'" data-name="'+p.name_first+" "+p.name_middle+" "+p.name_last+'" onclick="FnComposeMail(\''+p.id+'\',\''+name+'\')">';
                                 html +='<a href="javascript:void(0)" class="cd-popup-trigger" style="color: #333;" id="address_mail_pop">';
							     html += p.name_first+" "+p.name_middle+" "+p.name_last;
                                 html +='</a>';        
							     html += '</span>';
							     if(i%2==0)
							     {
								   
								  html += '<div class="clear" style="margin-bottom: 10px;"></div>';
								   
							     }	    
									    
							}
							html += '<div class="clear"></div>';
							html += data['pagination']; 
						    }
						    else if(data['status'] == "2")
						    {
						    	html = "User is not logged In.Please refresh the page and log in again.";
						    }
						    else
						    {
							html = 'No Address Available.';
						    }
						    
						    $(".author_dyn_data").html(html);   
						}
				     });
				    }
				    function FnComposeMail(id,name)
				    {
				    	//$("#compose_email").click();
				    	   
					  $('.cd-popup').addClass('is-visible');
        $('.reply-popup').removeClass('is-visible');
					    //$("#showAuthorList").css("display","none");
					    var ids = $("#user_email_id").val();
					     var arr = ids.split(",");
					     var index = arr.map(function(el) {
						   return parseInt(el);
					     }).indexOf(parseInt(id));
					     if(index <= -1)
					     {
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
						    $("#email_selected").append('<span class="choosen" id="name'+id+'" >'+name+'<img src="'+BASE+'images/close_22.png" onclick="removeEmail(this,'+id+')" ></span>');
					    }
				    }
				    
                                        </script>
                                	<ul class="alphabet">
                                	<li><a href="javascript:;" onclick="FnAuthorsPage('a','<?php echo $page;?>','<?php echo $per_page;?>')" class="author_active" id="a"><strong>A</strong></a></li>
                                	<li><a href="javascript:;" onclick="FnAuthorsPage('b','<?php echo $page;?>','<?php echo $per_page;?>')" id="b">B</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthorsPage('c','<?php echo $page;?>','<?php echo $per_page;?>')" id="c">C</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthorsPage('d','<?php echo $page;?>','<?php echo $per_page;?>')" id="d">D</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthorsPage('e','<?php echo $page;?>','<?php echo $per_page;?>')" id="e">E</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthorsPage('f','<?php echo $page;?>','<?php echo $per_page;?>')" id="f">F</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthorsPage('g','<?php echo $page;?>','<?php echo $per_page;?>')" id="g">G</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthorsPage('h','<?php echo $page;?>','<?php echo $per_page;?>')" id="h">H</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthorsPage('i','<?php echo $page;?>','<?php echo $per_page;?>')" id="i">I</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthorsPage('j','<?php echo $page;?>','<?php echo $per_page;?>')" id="j">J</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthorsPage('k','<?php echo $page;?>','<?php echo $per_page;?>')" id="k">K</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthorsPage('l','<?php echo $page;?>','<?php echo $per_page;?>')" id="l">L</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthorsPage('m','<?php echo $page;?>','<?php echo $per_page;?>')" id="m">M</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthorsPage('n','<?php echo $page;?>','<?php echo $per_page;?>')" id="n">N</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthorsPage('o','<?php echo $page;?>','<?php echo $per_page;?>')" id="o">O</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthorsPage('p','<?php echo $page;?>','<?php echo $per_page;?>')" id="p">P</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthorsPage('q','<?php echo $page;?>','<?php echo $per_page;?>')" id="q">Q</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthorsPage('r','<?php echo $page;?>','<?php echo $per_page;?>')" id="r">R</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthorsPage('s','<?php echo $page;?>','<?php echo $per_page;?>')" id="s">S</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthorsPage('t','<?php echo $page;?>','<?php echo $per_page;?>')" id="t">T</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthorsPage('u','<?php echo $page;?>','<?php echo $per_page;?>')" id="u">U</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthorsPage('v','<?php echo $page;?>','<?php echo $per_page;?>')" id="v">V</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthorsPage('w','<?php echo $page;?>','<?php echo $per_page;?>')" id="w">W</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthorsPage('x','<?php echo $page;?>','<?php echo $per_page;?>')" id="x">X</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthorsPage('y','<?php echo $page;?>','<?php echo $per_page;?>')" id="y">Y</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthorsPage('z','<?php echo $page;?>','<?php echo $per_page;?>')" id="z">Z</a></li>
                                	
                                	</ul>
                                	<div class="clear"></div>
                   		</div>
                    
                                <div class="mid_content_inner_right_bottom">
                                  <div class="author_dyn_data">
                                  
                                     <!--<ul class="mid_content_inner_right_bottom_box" id="delete_msg">-->
                                     
                                     <?php 
                                     //echo '<pre/>';print_r($author_list);die;
                                     if(!empty($author_list)) {
                                        $i = 0;
                                        foreach($author_list as $eachList) 
                                        {
                                        	$name = $eachList['name_first']." ".$eachList['name_middle']." ".$eachList['name_last'];
                                        	
                                        ?>
                                        	  
        <span data-num="<?php echo $i?>" style="background: #d0e6fe;color:#333;border-radius:4px;padding: 5px;margin: 0 10px 5px 0;float: left;width:45% ;cursor:pointer;" data-id="<?php echo $eachList['id']?>" data-name="<?php echo $eachList['name_first'].' '.$eachList['name_middle'].' '.$eachList['name_last'];?>" onclick="FnComposeMail('<?php echo $eachList['id'];?>','<?php echo $name;?>')">
						
                       <a href="#0" class="cd-popup-trigger" style="color: #333;">
                        <?php //echo word_wrap($eachList['email'],30)
							echo $eachList['name_first']." ".$eachList['name_middle']." ".$eachList['name_last'];
						?>
                       </a>
                        
						</span>
                     
					    <?php
						$i++;
						if($i%2==0)
						{
						    ?>
						    <div class="clear" style="margin-bottom: 10px;"></div>
						    <?php
						}
                                           }?>
                                           <div class="clear"></div>
                                           <?php 
                                           echo $pagination; 
                                        
                                        } ?> 
                                         
                                          
                                        
                                     <!--</ul>-->
                                
                                  </div>
                                </div>
                    
                    </div>
                    <div class="clear"></div>
                     
                   </div>
                <div class="clear"></div>
<?=$this->load->view('template/inner_footer.php')?>              
