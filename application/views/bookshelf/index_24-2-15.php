 <?=$this->load->view('template/inner_header.php')?>
  <?php $usd = $this->session->userdata('logged_user'); 
  
  //echo '<pre/>';print_r($saved_title_bookshelf);die;
  ?>
<link href="<?= base_url()?>style/inner/owl.carousel.css" rel="stylesheet" />
<script type="text/javascript" src="<?= base_url()?>js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?= base_url()?>js/owl.carousel.js"></script>
<script>

  function del(id)
  { 
        //var del = $(this).val();
        //alert(id);
        if(document.getElementById("check_"+id).checked == true){
        if(confirm('Are you sure to delete this Bookshelf?'))
        {
             $.ajax({
               url      : '<?=base_url()?>'+'bookshelves/delete_bookshelf_new',
               type     : 'POST',
               data     : { 'id': id },
               success  : function(resp){
                //alert(resp);
                    if(resp != '0'){
                        //$("#book_shelf").html(resp);
                        var row = document.getElementById("bookshelve"+id);
    			row.parentNode.removeChild(row);    
    			$("#tab1"+id).remove();         
                        //$("#edit_class" ).dialog( "close" );
                        $('a[rel*=facebox]').facebox();
                    }
               },
               error    : function(resp){
                    $.prompt("Sorry, something isn't working right.", {title:'Error'});
               }
            });
        }
        else
        {
            document.getElementById("check_"+id).checked = false;
            return false;
        }
        }
           
  } 
   function del2(id)
  { 
        //var del = $(this).val();
        //alert(id);
       
        if(confirm('Are you sure to delete this Bookshelf?'))
        {
             $.ajax({
               url      : '<?=base_url()?>'+'bookshelves/delete_bookshelf_new',
               type     : 'POST',
               data     : { 'id': id },
               success  : function(resp){
               		var row = document.getElementById("bookshelve"+id);
    			row.parentNode.removeChild(row);     
    			$("#tab1"+id).remove();        
    			$("#content").find("[id^='tab']").hide(); // Hide all content
    			$("#tabs li:first").attr("id","current"); // Activate the first tab
    			$("#content #tab1").fadeIn(); // Show first tab's content	
               },
               error    : function(resp){
                    $.prompt("Sorry, something isn't working right.", {title:'Error'});
               }
            });
        }
        else
        {
            
            return false;
        }
       
           
  } 
  function fnSearch()
  {
  	var val = $("#searchBookselve").val();
  	location.href = "<?=base_url()?>bookshelves/index/"+val;
  	
  }
  
   function del_savetitle(id,wcid)
  { 
        //var del = $(this).val();
        //alert(id);
        
        if(confirm('Are you sure to delete this save title?'))
        {
             $.ajax({
               url      : '<?=base_url()?>'+'bookshelves/delete_save_title',
               type     : 'POST',
               data     : { 'id': id , 'wcid':wcid},
               success  : function(resp){
                //alert(resp);
                    if(resp != ''){
                        $("#save_title_demo").html(resp);
                        //$("#owl-demo2").owlCarousel();
                        $("#owl-demo2").owlCarousel({
                            navigation : true,
                    		itemsDesktop:[$(document).width(), 3]
                          });
                        
                    }
               },
               error    : function(resp){
                    $.prompt("Sorry, something isn't working right.", {title:'Error'});
               }
            });
        }
        else
        {
            //document.getElementById("check_"+id).checked = false;
            return false;
        }
        
           
  }
  
</script>

<style>

.table_new tbody tr:hover {background:none!important;}

.work_section .table_new tbody td {height:60px !important;} 
.ui-dialog-title { display:none !important;}
.ui-dialog {width: 607px!important; background: none; border: none!important; left: 38% !important;top: 275px!important;}
.ui-draggable .ui-dialog-titlebar{display:none;}
.owl-item{ padding:0 !important;}
</style>


            <div class="content_part">
            	
               
                <div class="mid_content index_sec">
          
          
           
                    
    <div class="pitchits_section pitchits_section_new pitchits_section_new3 pitchits_section_new4">
         <div class="pit_work_dialog_lat_first popup_chng" style="display: none;" id="pit_work_dialog">
                  
                  <h4 id="title"></h4>

<p ><span id="tags"><span><br>
<span id="review"></span>
</p>

<div class="hide_sec">
<h4>Synopsis</h4>

<p id="synopsis"></p>

<h4>Excerpt</h4>

<p id="excerpt"></p>
</div>
                  
<a href="#" class="pitchit_pop_icon"><img src="<?php echo base_url()?>/images/icon_p.png"></a>  
<a href="#" class="think_pop_icon"><img src="<?php echo base_url()?>/images/think.png"></a> 
<a  class="green_but" href="#bookshelf_add_1" rel="facebox">Add to Bookshelf</a><a href="javascript:void(0);" id="cancl_pit">Close</a>
                    
                    
                    
</div>
        <div class="filter_section">
        <form action="" method="post" onsubmit="return false;">
        <div class="filter_section_search">
        <input name="inputfield" type="text" value="<?php echo $search;?>" placeholder="Search Bookshelves" id="searchBookselve">
        <input name="search" type="button" value="" onclick="fnSearch()">        
        </div>
        <div class="filter_section_search_results">Total Bookshelves (<?php echo $bookshelf_count;?>)</div>
        </form>
        <div class="clear"></div>
        </div>
        
          <div class="pitchits_section_left">
          <div id="navigation_vert">
          <ul class="list">
          	<li><a href="#bookshelf" rel="facebox"><img src="<?= base_url()?>images/s_icon01.png" alt="" /> Create A Bookshelf</a></li>
          </ul>
            <ul class="list tabs" id="tabs">
                
                <li><a href="#" name="tab1"><img src="<?= base_url()?>images/s_icon02.png" alt="" /> My Bookshelves</a></li>
                <li><a href="#" name="tab3"><img src="<?= base_url()?>images/s_icon03.png" alt="" /> Saved Titles</a></li>
            </ul>
            
            </div>
          </div>
          <div class="pitchits_section_right pitchits_section_right_3" id="content">
          
          
          	<div style="display: block;" id="tab1">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_new">
              <thead>
                <tr>
                  <th align="center" width="40%">Bookshelf</th>
                  <th class="center" width="15%">Date</th>
                  <th class="center" width="15%">Titles</th>
                  <th class="center" width="15%">View</th>
                  <th class="center" width="15%">Delete</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                //echo '<pre/>';print_r($bookshelf_test);die;
                if(!empty($bookshelf_test))
                {
                $i =1;    
                foreach($bookshelf_test as $details)
                {
                    $user_book_self = $this->mbookshelf->get_user_book_self_count($details['id']);
                    $user_book_self_id = $this->mbookshelf->get_bookshelf_first($details['id']);
                   // echo '<pre/>';print_r($user_book_self_id);die;
                ?>
                <tr id="bookshelve<?php echo $details['id'];?>">
                  <td align="center"><?php echo $details['name'];?></td>
                  <td class="center"><?php echo date('m/d/Y',strtotime($details['create_date']));?></td>
                  <td class="center"><?php echo $user_book_self;?></td>
                  <td class="center" id="detail<?php echo $details['id'];?>">
                  <?php /*<a href="<?=base_url()?>bookshelves/booklist/<?php echo $details['id'];?>"><img alt="" src="<?=base_url()?>images/list_view.png" /></a>*/ ?>
            <?php if(!empty($user_book_self_id)) {?>
            <ul class="tabs">
            	<li><a href="#" name="tab1<?php echo $details['id'];?>"><img alt="" src="<?=base_url()?>images/discevory_view.png" /></a></li>
            </ul>	
            <?php }else{ ?>
            		<img alt="" src="<?=base_url()?>images/discevory_view2.png" />
            <?php } ?>
                  </td>
                  <td class="center"><input id="check_<?php echo $details['id']?>" name="check_<?php echo $details['id']?>" type="checkbox" value="1" class="del_t" onclick="del(<?php echo $details['id']?>)"></td>
                </tr>
                
                <?php $i++; } } else { ?>
                <tr>              
                <td colspan="5"><p>Sorry! There are no BookShelves.</p></td>
                </tr>
                <?php } ?>
                
                <tr class="hov_no">
                  <td colspan="5">
                  <div class="button_right">
                  <!--<a href="#" class="green_but">PREVIOUS</a> 
                  <a href="#" class="blue_but">VIEW MORE</a>--></div>
                  </td>
                </tr>
              </tbody>
            </table>
            
            
            </div>
            <?php if(!empty($bookshelf_test))
                {
                $i =1;    
                foreach($bookshelf_test as $details)
                {
                	$workdetails_total  = $this->mwork->allWorkForBookshelf($details['id']);
                ?>
          	<div style="display: block;" id="tab1<?php echo $details['id'];?>" >
          	
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_new orange1234" id="table_bookshelf">
              <thead>
                <tr>
                  <th align="center" width="70%" colspan="3"><?php echo $details['name'];?></th>
                  <th align="center" width="30%" colspan="2" id="delete_bookshelf"  onclick="del2(<?php echo $details['id'];?>)" style="cursor:pointer;">Delete this Bookshelf</th>
                </tr>
              </thead>
              <tbody id="detail_view">
              	
                <tr class="hov_no">
                  <td width="100%" colspan="5">
                  
                <div class="demo">
                <div id="owl-demo" class="owl-carousel">
                <?php foreach($workdetails_total as $key=>$total_work)
                {
                ?>
                <div class="item" id="book<?php echo $total_work['wcid'];?>">
                <h4><?php if(strlen($total_work['title']) > 18) { ?><?=substr($total_work['title'],0,18)?>... <?php }else{ ?><?=$total_work['title']?><?php } ?></h4>
                <div class="item_left_section">
                <?php if($total_work['photo'] != '') {?>
                <img src="<?=base_url()?>uploadImage/<?=$total_work['user_id']?>/cover_image/medium/<?=$total_work['photo']?>"/>
                <?php } else { ?>
                <img src="<?=base_url()?>images/img_default_cover.png"/>
                <?php } ?>
                </div>
                <div class="item_right_section">
                <p>
                Author: <?=$total_work['name']?><br>
                Format: <?=$total_work['type_name']?><br>
                Genre: <?=$total_work['form_name']?></p>
                <a href="javascript:;" class="blue_but view_open" onclick="openDialog(<?php echo $total_work['Wid'];?>)">VIEW</a><a href="#" class="green_bg" onclick="delete_bookshelf_book(<?php echo $total_work['Wid'];?>)">DELETE</a>
                
                </div>
                </div>
                <?php } ?>
                
                </div>
                </div>
                  
                  
                  </td>
                </tr>
                
              </tbody>
            </table>
           
            </div>
            <?php }
            
            } ?>
            <div style="display: block;" id="tab3">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_new">
              <thead>
                <tr>
                  <th align="center" width="70%" colspan="3">Saved Titles</th>
                  <!--<th align="center" width="30%" colspan="2">Delete this Bookshelf</th>-->
                </tr>
              </thead>
              <tbody>
                <tr class="hov_no">
                  <td width="100%" colspan="5">
                 
                <div id="save_title_demo"> 
                
                <div class="demo">
                
                <div id="owl-demo2" class="owl-carousel">
                
                    <?php
                    /*if(!empty($total_book)) 
                    {
                        foreach($total_book as $totalbooks)
                        {
                    ?>
                    
                    <div class="item">
                    <div class="item_left_section">
                    
                    <?php if(!empty($totalbooks['photo'])) { ?>
                    <img src="<?=base_url()?>uploadImage/<?=$totalbooks['user_id']?>/cover_image/<?=$totalbooks['photo']?>" />
                    <?php } else { ?>
                    <img src="<?= base_url()?>images/img_default_cover.png" alt="" />
                    <?php } ?>
                    </div>
                    <div class="item_right_section">
                    <p>Author: <?=$totalbooks['name_first'].' '.$totalbooks['name_middle'].' '.$totalbooks['name_last']?><br>
                    Format: <?=$totalbooks['type_name']?><br>
                    Genre:  <?=substr($totalbooks['category_name'],0,10).'...'?></p>
                    <a href="#" class="blue_but">VIEW</a><a href="#" class="green_bg">DELETE</a>
                    </div>
                    </div>
                    
                    <?php } } */?>
                    
                  
                   
                <?php 
                if(!empty($saved_title_bookshelf))
                {
                    foreach($saved_title_bookshelf as $key=>$total_work_saved)
                    {
                ?>
                <div class="item" id="book<?php echo $total_work_saved['wcid'];?>">
                <h4><?php if(strlen($total_work_saved['title']) > 18) { ?><?=substr($total_work_saved['title'],0,18)?>... <?php }else{ ?><?=$total_work_saved['title']?><?php } ?></h4>
                <div class="item_left_section">
                <?php if($total_work_saved['photo'] != '') {?>
                <img src="<?=base_url()?>uploadImage/<?=$total_work_saved['user_id']?>/cover_image/medium/<?=$total_work_saved['photo']?>"/>
                <?php } else { ?>
                <img src="<?=base_url()?>images/img_default_cover.png"/>
                <?php } ?>
                </div>
                <div class="item_right_section">
                <p>
                Author: <?=$total_work_saved['name']?><br>
                Format: <?=$total_work_saved['type_name']?><br>
                Genre: <?=$total_work_saved['form_name']?></p>
                <a href="javascript:;" class="blue_but view_open" onclick="openDialog(<?php echo $total_work_saved['Wid'];?>)">VIEW</a><a href="javascript:void(0);" class="green_bg" onclick="del_savetitle(<?php echo $total_work_saved['bid'];?>,<?php echo $total_work_saved['wcid'];?>)">DELETE</a>
                
                </div>
                </div>
                <?php } } else {?>
                
                <span>No result found</span> 
                   
                   
                 <?php } ?>   
                    <!--<div class="item">
                    <div class="item_left_section"><img src="<?//= base_url()?>images/cover_img01.jpg" alt="" /></div>
                    <div class="item_right_section">
                    <p>Author: Pete Smith<br>
                    Format: Non-Fiction<br>
                    Genre:  Childrens</p>
                    <a href="#" class="blue_but">VIEW</a><a href="#" class="green_bg">DELETE</a>
                    </div>
                    </div>-->
              
              </div>
                </div>
                </div>
                  
                  </td>
                </tr>
                
              </tbody>
            </table>
            </div>
            
          </div>
          
          <div class="clear"></div>
        </div>
                    
                    <div class="clear"></div>
                    
                  
                    
                </div>
                <div class="clear"></div>
                
 <div id="bookshelf" style="display:none;">
 <h2>Add New Bookshelf</h2>
 <?php
   $frmAttrs   = array("id"=>'addBookshelf',"class"=>'form-horizontal',"name"=>'myform');
   echo form_open('bookshelves/addBookShelves', $frmAttrs);
 ?>
 
 <label>Name:</label>
 <input name="bookshelf" type="text" />
 <div class="clear"></div>
 <input name="button" class="add_bkslf" type="submit" value="Add" style="margin-left: 60px !important;" />
 </form> 
 
  </div>
  
  <!--------------------Add bookshelf Popup--------------------->       
            <div id="bookshelf_add_1" style="display:none;">
             <h2>Add to Bookshelf</h2>
             <?php
               $frmAttrs   = array("id"=>'addBookshelf',"class"=>'form-horizontal',"name"=>'myform');
               echo form_open('bookshelves/addToBookShelves', $frmAttrs);
             ?>
             <div style="width: 100%;">
             <span style="float: left; padding-right: 10px;">
            <div class="styled-select">
               <select name="bkself_id" id="bkself_id" class="select_box2">
                  <option value="0">Select</option>
                  <?php 
                  $bself_list = $this->mbookshelf->get_rest_bookshelf(1);
                  //echo '<pre/>';print_r($bself_list);die;
                  if(!empty($bself_list))
                  {
                   foreach($bself_list as $blist)
                   {
                  ?>
                  <option value="<?=$blist['id']?>"><?=$blist['name']?></option>
                  <?php } } ?>
               </select>
            </div>
              </span>                          
             <span style="float: left;">
             <input type="hidden" name="wid" id="wid" value="" />
             <input name="button" class="add_bkslf" type="submit" value="Add"  />
             </span>
             <div class="clear"></div>
             </div>
             </form> 
             
              </div>
            
 <!-------------------------End Popup--------------------------------------------->
  
  

 <script type="text/javascript">
 function openDialog(id)
 {
 	$.ajax({
               url      : '<?=base_url()?>'+'bookshelves/show_book_detail',
               type     : 'POST',
               data     : { 'id': id },
               success  : function(resp){
               	   $("#title").html(resp.workdetails_test.title_text)
               	   $("#excerpt").html(resp.workdetails_test.extract)
               	   $("#synopsis").html(resp.workdetails_test.synopsis)
               	   $("#review").html(resp.workdetails_test.self_published_text);
                   
                   $("#wid").val(id);
                   
                   $(".pit_work_dialog_lat_first").dialog({
			close: function () {
			    
			}
		    });
               },
               error    : function(resp){
                    $.prompt("Sorry, something isn't working right.", {title:'Error'});
               }
        });
 	
 }
  $(document).ready(function () {
	
	    $('#cancl_pit').click(function () {
                       
                            $(".pit_work_dialog_lat_first").dialog('close');
                           
                        
             });
    
   });
$(document).ready(function() {
    $("#content").find("[id^='tab']").hide(); // Hide all content
    $("#tabs li:first").attr("id","current"); // Activate the first tab
    $("#content #tab1").fadeIn(); // Show first tab's content
    
    $('.tabs a').click(function(e) {
        e.preventDefault();
        if ($(this).closest("li").attr("id") == "current"){ //detection for current tab
         return;       
        }
        else{             
          $("#content").find("[id^='tab']").hide(); // Hide all content
          $(".tabs li").attr("id",""); //Reset id's
          if( $('#' + $(this).attr('name')) == "tab1" &&  $('#' + $(this).attr('name')) == "tab3"){
          	$(this).parent().attr("id","current"); // Activate this
          	$('#' + $(this).attr('name')).fadeIn(); // Show content for the current tab
          }
          else
          {
          	//console.log($(this).attr('name'));
          	$('.table_new').show();
          	//setTimeout(function(){ alert("asjdfsdaljkf");$('.table_new').show()},500);
          	$('#' + $(this).attr('name')).fadeIn(); // Show content for the current tab
          	// Show content for the current tab
          }
          
         
          
        }
    });
});
</script>                
 <script>
    $(document).ready(function() {
      $("#owl-demo, #owl-demo2").owlCarousel({
        navigation : true,
		itemsDesktop:[$(document).width(), 3]
      });
    });

</script>               
<?=$this->load->view('template/inner_footer.php')?>             
<script>
function delete_bookshelf_book(id)
{
	if(confirm('Are you sure to delete this Book from your Bookshelf?'))
        {
             $.ajax({
               url      : '<?=base_url()?>'+'bookshelves/delete_books_by_id/',
               type     : 'POST',
               data     : { 'id': id },
               success  : function(resp){   
               		$("#book"+id).parent().remove()  ;       		   
    			//$("#book"+id).remove();            				
               },
               error    : function(resp){
                    $.prompt("Sorry, something isn't working right.", {title:'Error'});
               }
            });
        }
        else
        {
            
            return false;
        }
    
}
</script>
