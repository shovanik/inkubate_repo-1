<?=$this->load->view('template/inner_header.php');

?>
<?php $usd = $this->session->userdata('logged_user'); 
	//echo '<pre/>';print_r($share_bookshelf_test);die;
	?>
<script type="text/javascript" src="<?= base_url()?>js/jquery-ui.min.js"></script>
<link href="<?= base_url()?>style/inner/owl.carousel.css" rel="stylesheet" />
<script type="text/javascript" src="<?= base_url()?>js/owl.carousel.js"></script>
  <link href='<?=base_url()?>style/inner/reply_popup.css' rel='stylesheet' />
<script>
	function ajaxDiscovery(page)
	{
			//$("#content_part").block();
	 		//type = "format";
	 		//var format_str = arr_format.join(",");
	 		var id;
	        var uid;
	        
	 		$.ajax({
			   url      : '<?=base_url()?>'+'bookshelves/ajax_bokkshelf',
			   type     : 'POST',
			   data     : { 'page': page},
			   success  : function(resp){
			    //alert(resp);
			        if(resp != '0'){
			           
			            $(".work_main_tab22").html(resp);
			         //   alert(resp)
	                    $(".owl-carousel").owlCarousel({
	                        navigation : true,
	                	itemsDesktop:[$(document).width(200), 3]
	                      });
	                     //$('.owl-carousel').show(); 
	                    //openDialog(id,uid);
			            //$("#edit_class" ).dialog( "close" );
	                  $('a[rel*=facebox]').facebox();  
			        }
			        //$("#content_part").unblock();
			   },
			   error    : function(resp){
			   	//$("#content_part").unblock();
			        $.prompt("Sorry, something isn't working right.", {title:'Error'});
			   }
			});
	        
	}
	
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
	  	//location.href = "<?//=base_url()?>bookshelves/index/"+val;
	    
	    $.ajax({
	               url      : '<?=base_url()?>'+'bookshelves/search_book_title',
	               type     : 'POST',
	               data     : { 'val': val },
	               success  : function(resp){
	                //alert(resp);
	                    if(resp != ''){
	                        
	                        $(".work_main_tab").hide();
	                        $(".work_tab22").hide();
	                        $(".work_tab33").hide();
	                        $("#work_tab").css('display','block');
	                        $("#work_tab").html(resp);
	                        //$("#owl-demo2").owlCarousel();
	                        $("#owl-demo33").owlCarousel({
	                            navigation : true,
	                    		itemsDesktop:[$(document).width(), 3]
	                          });
	                          
	                          //alert('hi');
	                    }
	                    
	               },
	               error    : function(resp){
	                    $.prompt("Sorry, something isn't working right.", {title:'Error'});
	               }
	            });
	  	
	  }
	  
	  $(document).ready(function(){
	    
	    $('#tab_book1').click(function(){
	        
	        //alert('hi');
            /*$('#tab_book2').css('background','none');
           $('#tab_book2').css('color','none'); */
           
	        $(".work_main_tab").show();
	        $(".work_tab22").show();
	        
	        $("#work_tab").css('display','none');
	        
	    })
	    
	    $('#tab_book2').click(function(){
	        
           $('#tab_book1').css('background','#fff');
           $('#tab_book1').css('color','#000'); 
            
           /*$('#tab_book2').css('background','#46b8ff');
           $('#tab_book2').css('color','#fff');*/
         
	       $(".work_tab33").show();
           $("#work_tab").css('display','none');
	        
           //alert('hi'); 
	    })
        
       $('.view_tab').click(function(){
        
        $('#tab_book1').css('background','#46b8ff');
        $('#tab_book1').css('color','#fff');
        
       }) 
	    
	  })
	  
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
    .list li:hover {background:#46b8ff;}
    
    .button_pro{ height: 30px !important; font-size: 11px !important; padding: 0 14px !important; line-height: 28px;}
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
			<a href="javascript:void()" class="pitchit_pop_icon" onclick=""><img src="<?php echo base_url()?>/images/icon_p.png"></a>  
            <a href="javascript:void()" class="reply-popup-trigger think_pop_icon" id="conversationMail" onclick=""><img src="<?php echo base_url()?>/images/think.png"></a> 
			<a  class="blue_but" href="#bookshelf_add_1" rel="facebox">Add to Bookshelf</a><a href="javascript:void(0);" id="cancl_pit" class="green_but">Close</a>
		</div>
		<div class="filter_section">
			<form action="" method="post" onsubmit="return false;">
				<div class="filter_section_search">
                                    <input name="inputfield" type="text" value="Search Bookshelves" id="searchBookselve" onfocus="if(this.value == 'Search Bookshelves') {this.value=''}" onblur="if(this.value == '') {this.value='Search Bookshelves'}" value="<?php echo $search;?>">
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
					<li><a href="#" name="tab1" id="tab_book1"><img src="<?= base_url()?>images/s_icon02.png" alt="" /> My Bookshelves</a></li>
					<li><a href="#" name="tab3" id="tab_book2"><img src="<?= base_url()?>images/s_icon03.png" alt="" /> Saved Titles</a></li>
				</ul>
			</div>
		</div>
		<div class="pitchits_section_right pitchits_section_right_3" id="content">
			<div class="work_main_tab22">
				<div style="display: block;" id="tab1" class="work_main_tab">
					<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_new">
						<thead>
							<tr>
								<th align="center" width="30%">Bookshelf</th>
								<th class="center" width="10%">Date</th>
								<th class="center" width="15%">Titles</th>
								<th class="center" width="15%">View</th>
                                <th class="center" width="15%">Share</th>
								<th class="center" width="15%">Delete</th>
							</tr>
						</thead>
						<tbody>
                        
                        <?php 
								//echo '<pre/>';print_r($bookshelf_test);die;
								if(!empty($share_bookshelf_test))
								{
								$i =1;    
								foreach($share_bookshelf_test as $details_r)
								{
								    $user_book_self = $this->mbookshelf->get_user_book_self_count($details_r['id']);
								    $user_book_self_id = $this->mbookshelf->get_bookshelf_first($details_r['id']);
                                    $bookshelf_user = $this->mbookshelf->get_bookshelf_user_first($details_r['uid']);
                                    
                                    if(!empty($bookshelf_user['name_first']))
                                    {
                                        $first33 = $bookshelf_user['name_first'];
                                    }
                                    else
                                    {
                                        $first33 = '';
                                    }
                                    if(!empty($bookshelf_user['name_middle']))
                                    {
                                        $middle33 = $bookshelf_user['name_middle'];
                                    }
                                    else
                                    {
                                        $middle33 = '';
                                    }
                                    if(!empty($bookshelf_user['name_last']))
                                    {
                                        $last33 = $bookshelf_user['name_last'];
                                    }
                                    else
                                    {
                                        $last33 = '';
                                    }
                                    
                                    $full = $first33.' '.$middle33.' '.$last33;
								   // echo '<pre/>';print_r($user_book_self_id);die;
								?>
							<tr id="bookshelve<?php echo $details_r['id'];?>">
								<td align="center">
                                <p class="ali_text">
                                <?php echo $details_r['name'];?><br />
                                <span>shared by <?php echo $full;?></span>
                                </p>
                                
                                </td>
								<td class="center">
                                <?php //echo date('m/d/Y',strtotime($details['create_date']));?>
                                
                                <?php $date_crd = $details_r['create_date'];
                                $timestamp_crd = strtotime($date_crd);
                                $new_date_crd = date("m/d/y", $timestamp_crd);
                                echo $new_date_crd;
                                ?>
                                
                                
                                </td>
								<td class="center"><?php echo $user_book_self;?></td>
								<td class="center" id="detail<?php echo $details_r['id'];?>">
									<?php /*<a href="<?=base_url()?>bookshelves/booklist/<?php echo $details['id'];?>"><img alt="" src="<?=base_url()?>images/list_view.png" /></a>*/ ?>
									<?php if(!empty($user_book_self_id)) {?>
									<ul class="tabs view_tab" id="view_tab">
										<li><a href="#" name="tab1<?php echo $details_r['id'];?>"><img alt="" src="<?=base_url()?>images/discevory_view.png" /></a></li>
									</ul>
									<?php }else{ ?>
									<img alt="" src="<?=base_url()?>images/discevory_view2.png" />
									<?php } ?>
								</td>
                                
                                
                                <td class="center" id="detail<?php echo $details_r['id'];?>">
									
							     <span> Shared </span>
									
								</td>
                                
								<td class="center">
                               <?php /* <input id="check_<?php echo $details_r['id']?>" name="check_<?php echo $details_r['id']?>" type="checkbox" value="1" class="del_t" onclick="del(<?php echo $details_r['id']?>)"> */ ?>
                                </td>
							</tr>
							<?php $i++; } } ?>
                        
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
								<td class="center">
                                <?php //echo date('m/d/Y',strtotime($details['create_date']));?>
                                
                                <?php $date_crd = $details['create_date'];
                                $timestamp_crd = strtotime($date_crd);
                                $new_date_crd = date("m/d/y", $timestamp_crd);
                                echo $new_date_crd;
                                ?>
                                
                                
                                </td>
								<td class="center"><?php echo $user_book_self;?></td>
								<td class="center" id="detail<?php echo $details['id'];?>">
									<?php /*<a href="<?=base_url()?>bookshelves/booklist/<?php echo $details['id'];?>"><img alt="" src="<?=base_url()?>images/list_view.png" /></a>*/ ?>
									<?php if(!empty($user_book_self_id)) {?>
									<ul class="tabs view_tab" id="view_tab">
										<li><a href="#" name="tab1<?php echo $details['id'];?>"><img alt="" src="<?=base_url()?>images/discevory_view.png" /></a></li>
									</ul>
									<?php }else{ ?>
									<img alt="" src="<?=base_url()?>images/discevory_view2.png" />
									<?php } ?>
								</td>
                                
                                
                                <td class="center" id="detail<?php echo $details['id'];?>">
									
							     <a href="#share_bookshelf" rel="facebox" class="button_pro" onclick="share_book(<?php echo $details['id'];?>,'<?php echo $details['name'];?>')">Share</a>
									
								</td>
                                
								<td class="center"><input id="check_<?php echo $details['id']?>" name="check_<?php echo $details['id']?>" type="checkbox" value="1" class="del_t" onclick="del(<?php echo $details['id']?>)"></td>
							</tr>
							<?php $i++; } } else { ?>
							<tr>
								<td colspan="6">
									<p>No BookShelves are created by you.</p>
								</td>
							</tr>
							<?php } 
                            if($total_rows > 5)
                             {
                            ?>
							<tr class="hov_no">
								<td colspan="6">
									<div class="button_right"><?php if($offset == "0"){?>&nbsp;<?php }else{ ?> <a href="javascript:;" class="green_but" onclick="ajaxDiscovery(<?php echo $page-1;?>)">PREVIOUS</a> <?php } ?> <?php if($total_rows > $offset){ ?><a href="javascript:;" onclick="ajaxDiscovery(<?php echo $page+1;?>)" class="blue_but">VIEW MORE</a><?php }else{?><a href="javascript:;" class="blue_but">VIEW MORE</a> <?php } ?></div>
								</td>
							</tr>
                           <?php } ?> 
						</tbody>
					</table>
				</div>
				<?php if(!empty($bookshelf_test))
					{
					$i =1;    
					foreach($bookshelf_test as $details)
					{
						$workdetails_total  = $this->mwork->allWorkForBookshelf($details['id']);
                        //echo '<pre/>';print_r($workdetails_total);
					?>
				<div class="work_tab22">
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
												<?php 
                                                
                                                
                                                foreach($workdetails_total as $key=>$total_work)
                    {
                    ?>
            <div class="item" id="book<?php echo $total_work['wcid'];?>">
                    <h4><?php if(strlen($total_work['title']) > 18) { ?>
                    	<div title="<?=$total_work['title'];?>"><?=substr($total_work['title'],0,18)?>...</div> 
                    	<?php }else{ ?><?=$total_work['title']?><?php } ?></h4>
                    <div class="item_left_section">
                            <?php 
                            $full_name = $total_work['name'].' '.$total_work['name_middle'].' '.$total_work['name_last']; 
                            if(file_exists("uploadImage/".$total_work['user_id']."/cover_image/medium/".$total_work['photo']) && $total_work['photo'] != '') {?>
                            <img src="<?=base_url()?>uploadImage/<?=$total_work['user_id']?>/cover_image/medium/<?=$total_work['photo']?>" style="height:78px"/>
                            <?php } else { ?>
<!--                            <img src="<?=base_url()?>images/img_default_cover.png"/>-->

<table class="no_profile_pic" width="100%">
<tr>
<td style="text-align: center; font-weight:600; line-height:15px; color:#fff; padding: 5px; font-size: 10px; cursor: pointer;"><?=$total_work['title']?></td>
</tr>
</table>
                          <!--  <div class="no_profile_pic">
                                <div style="text-align: center; font-weight:600; line-height:15px; padding-top:25px; font-size: 10px; cursor: pointer;" title="<?=$total_work['title']?>"><?=substr(strtoupper($total_work['title']),0,13)?></div>
                                <div style=" font-size: 10px; font-weight:600; line-height:15px; text-align: center; cursor: pointer" title="<?//=$full_name?>"><?//=substr(strtoupper($full_name),0,13)?></div>
                            </div>
                        -->
                            
<!--                        <div class="no_profile_pic"><div style="padding: 20px 0 0 0;text-align: center; position: relative;">    
                            <a class="tooltips" href="javascript:void(0)">
                   
                                <label style="color: #ffffff;"><?=substr(strtoupper($total_work['title']),0,6)?></label> 
                  
                  <span class="tp_span_disc"><?=$total_work['title']?></span>
 <div class="clear"></div>
                  
               </a> 
                            </div></div>-->
                            
                            <?php } ?>
                    </div>
                    <div class="item_right_section" style="width:98px; margin-top:5px !important;">
                    <?php 
                   	$full_name = $total_work['name'].' '.$total_work['name_middle'].' '.$total_work['name_last']; 
                    if(strlen($full_name) > 15)
                    {
                     	$full_name = '<a href="javascript:void(0);" class="tooltips" title="'.$full_name.'">'.substr($full_name,0,12).'...</a>';
                    }else{
                    	$full_name = $full_name;
                    }
                    
                    ?>
					<p>By <?php echo $full_name;?></p>
					<p>Format : 
					<?php
					if(strlen($total_work['type_name']) > 9)
                    {?>
                     	<span title="<?php echo $total_work['type_name'];?>"><?php echo substr($total_work['type_name'],0,6).'...';?></span>
                    <?php }else{
                    	echo $total_work['type_name'];
                    }
					?>

					</p>
                    <p>Genre : 
                    <?php
					if(strlen($total_work['form_name']) > 10)
                    {?>
                     	<span title="<?php echo $total_work['form_name'];?>"><?php echo substr($total_work['form_name'],0,7).'...';?></span>
                    <?php }else{
                    	echo $total_work['form_name'];
                    }
					?>
                    </p>
                    <a href="javascript:;" class="blue_but view_open" style="font-size:8px" onclick="openDialog(<?php echo $total_work['Wid'];?>)">VIEW</a>
                    <a href="#" class="green_bg" style="font-size:8px" onclick="delete_bookshelf_book(<?php echo $total_work['Wid'];?>)">DELETE</a>
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
				</div>
				<?php }
					} ?>
			</div>
			<div id="work_tab" style="display: none;"> 
			</div>
			<div class="work_tab33">
				<div style="display: block;" id="tab3">
					<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_new gray1234">
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
                                        Genre:  <?=substr($totalbooks['category_name'],0,10).'...'?>
                                </p>
                                <a href="#" class="blue_but">VIEW</a><a href="#" class="green_bg">DELETE</a>
                        </div>
                </div>
                <?php } } */?>



                <?php 
                        if(!empty($saved_title_bookshelf))
                        {
                            foreach($saved_title_bookshelf as $key=>$total_work_saved)
                            {
                            	$full_name_saved = $total_work['name'].' '.$total_work['name_middle'].' '.$total_work['name_last'];
                        ?>



                <div class="item" id="book<?php echo $total_work_saved['wcid'];?>">


                        <h4><?php if(strlen($total_work_saved['title']) > 18) { ?>
                        	<div title="<?=$total_work_saved['title'];?>"><?=substr($total_work_saved['title'],0,18)?>...</div>
                        	<?php }else{ ?>
                        	<?=$total_work_saved['title']?><?php } ?></h4>
                        <div class="item_left_section">
                                <?php if($total_work_saved['photo'] != '') {?>
                                <img src="<?=base_url()?>uploadImage/<?=$total_work_saved['user_id']?>/cover_image/medium/<?=$total_work_saved['photo']?>" style="height:79px;"/>
                                <?php } else { ?>
<!--                                <img src="<?=base_url()?>images/img_default_cover.png"/>-->
                                <!-- <div class="no_profile_pic">
                                	<div style="text-align: center; font-weight:600; line-height:15px; padding:5px; font-size: 10px; cursor: pointer;"><?=$total_work_saved['title'];?></div> 
                                <div style=" font-size: 7px; margin-top: -15px; text-align: center; cursor: pointer" title="<?//=$full_name_saved?>"><?//=substr(strtoupper($full_name_saved),0,13)?></div>
                                </div>-->
                                <table class="no_profile_pic" width="100%">
								<tbody><tr>
								<td style="text-align: center; font-weight:600; line-height:15px; color:#fff; padding: 5px; font-size: 10px; cursor: pointer;"><?=$total_work_saved['title'];?></td>
								</tr>
								</tbody></table>
                                <?php } ?>
                        </div>
                        <div class="item_right_section" style="width:98px; margin-top:5px">
                                <p>
                                        Author : <?//=$total_work_saved['name']?>

                    <?php 
                   //echo strlen($total_work['name']); 
                   
                    if(strlen($full_name_saved) > 10)
                    {
                        ?>
                     <a href="javascript:void(0);" class="tooltips" title="<?=$full_name_saved?>">   
                    <?php    
                     echo substr($full_name_saved,0,10).'..';
                     ?>
                     <!-- <span class="tp_span28"><?=$full_name_saved?></span> -->
                    </a>
                    <?php 
                    }
                    else
                    {
                      echo $full_name_saved;  
                    }
                    ?>

                    <br>
            <p>Format : 
            	<?php
					if(strlen($total_work_saved['type_name']) > 13)
                    {?>
                     	<div title="<?php echo $total_work_saved['type_name'];?>"><?php echo substr($total_work_saved['type_name'],0,10).'...';?></div>
                    <?php }else{
                    	echo $total_work_saved['type_name'];
                    }
					?>
            </p>
            <p>Genre : 
            	<?php
					if(strlen($total_work_saved['form_name']) > 13)
                    {?>
                     	<div title="<?php echo $total_work_saved['form_name'];?>"><?php echo substr($total_work_saved['form_name'],0,10).'...';?></div>
                    <?php }else{
                    	echo $total_work_saved['form_name'];
                    }
					?>
    		</p>
    <a href="javascript:;" class="blue_but view_open" onclick="openDialog(<?php echo $total_work_saved['Wid'];?>)" style="font-size: 8px;">VIEW</a>
    <a href="javascript:void(0);" class="green_bg" onclick="del_savetitle(<?php echo $total_work_saved['bid'];?>,<?php echo $total_work_saved['wcid'];?>)" style="font-size: 8px;">DELETE</a>
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

<!--------------------Share Bookshelf------------------------->
<script>
function share_book(id,name)
{
    //alert(id);
    $('#bself_id').val(id);
    $('#bkslf_name').text(name);
    $('#note').text('Please take a look at the list of "'+name+'" I have saved to my bookshelf on Inkubate.com');
}
</script>

<div id="share_bookshelf" style="display:none;">

<div class="content_share">
	<h2>Share my "<span id="bkslf_name"></span>" Bookshelf with:</h2>
	<?php
		$frmAttrs   = array("id"=>'addBookshelf',"class"=>'form-horizontal',"name"=>'myform');
		echo form_open('bookshelves/BookShelves_share', $frmAttrs);
		?>
	<label class="share_eml">Email:</label>
	<input name="email" id="email" type="text" placeholder="Email Address" />
	<div class="clear"></div>
    <h2>Note:</h2>
    <label>Note:</label>
    <textarea rows="3" cols="40" id="note" name="note"></textarea>
    <div class="clear"></div>
    <input type="hidden" id="bself_id" name="bself_id" value="" />
	<input name="button" class="add_bkslf" type="submit" value="Send" style="margin-left: 53px !important;" />
	</form> 
 
 </div>   
    
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
        	
            $(".pit_work_dialog_lat_first").css('display', "block");
            $("#title").html(resp.workdetails_test.title_text)
            $("#excerpt").html(resp.workdetails_test.extract)
            $("#synopsis").html(resp.workdetails_test.synopsis)
            $("#review").html(resp.workdetails_test.self_published_text);
            
            $(".pitchit_pop_icon").attr("onClick", "FnComposeMail('"+resp.workdetails_test.user_id+"', '"+resp.workdetails_test.full_name+"')");
            $("#conversationMail").attr("onClick", "FnComposeMail('"+resp.workdetails_test.user_id+"', '"+resp.workdetails_test.full_name+"')");
            //alert(resp.workdetails_test.user_id);return false;
            $("#wid").val(id);

            $(".pit_work_dialog_lat_first").dialog({
                close: function () {

                }
            });
        },
        error : function(resp){
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
           
<script>
	function delete_bookshelf_book(id)
	{
		if(confirm('Are you sure to delete this Book from your Bookshelf?'))
	        {
	             $.ajax({
	               url      : '<?=base_url()?>'+'bookshelves/delete_books_by_id',
	               type     : 'POST',
	               data     : { 'id': id },
	               success  : function(resp){ 
	                
	               		$("#book"+id).parent().remove()  ;       		   
	    			//$("#book"+id).remove(); 
	                //alert(resp);           				
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
 

<span>
    <div class="reply-popup" role="alert">
    
	<div class="reply-popup-container">
            <div style=" width:100%; background:#000; padding:20px 0;"></div>
                <div class="top_reply">
                   
                   <form name="replyFrm" id="replyFrm" method="post" action="<?php echo base_url();?>mail/replybox" enctype="multipart/form-data"> 
                                
                    <div class="text_field_box">
                        <label style="float:left; margin-top:9px; width:3%">To</label>
                        <input type="hidden" id="reply_email" name="reply_email" value="<?php //echo $reply_user['email']?>"/>
                        <input type="hidden" id="msg_type" name="msg_type" value="<?php //echo $single_mail_details['is_pitchited']?>"/>
                        <input type="hidden" id="reply_message_id" name="reply_message_id" value="<?php //echo $this->uri->segment(3)?>"/>
                        
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
                        <input type="text" id="reply_sub" name="reply_sub"  class="sub_mail_content" value="<?php //echo $single_mail_details['subject']?>" >
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
    </span>

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

             <input type="text" id="sub" name="sub" class="sub_mail_content" value="" >
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
<script>
$(document).ready(function()
{
    $('.cd-popup-close').click(function(event){
        event.preventDefault();
        $('.cd-popup').removeClass('is-visible');
        //window.location='<?=base_url()?>bookshelves';
        //document.getElementById('composeFrm').action='<?=base_url()?>mail/compose/draft';
        //document.getElementById('composeFrm').submit();
     
           return true;
    })
});

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
function FnComposeMail(id,name)
{
    $('.cd-popup').addClass('is-visible');
    $(".pit_work_dialog_lat_first").css('display', "none");

    $("#email_selected").html('<span class="choosen" id="fullname">'+name+'</span>');
    $("#user_mail").val(name);
    $("#user_email_id").val(id);

    var ids = $("#user_email_id").val();
    var arr = ids.split(",");
    var index = arr.map(function(el) {
        return parseInt(el);
    }).indexOf(parseInt(id));
         if(index <= -1)
         {
            var val = $("#user_mail").val();
            if(val.trim() != ""){
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
//            $("#email_selected").append('<span class="choosen" id="name'+id+'" >'+name+'<img src="'+BASE+'images/close_22.png" onclick="removeEmail(this,'+id+')" ></span>');
            $("#email_selected").append('<span class="choosen" id="name'+id+'" >'+name+'</span>');
        }
}

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

<script src="<?=base_url()?>ckeditor/ckeditor.js"></script>

<?php
       //print_r($author_list);                                 
echo $this->load->view('template/inner_footer.php')?> 