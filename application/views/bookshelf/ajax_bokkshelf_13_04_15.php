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
                  
                  <td class="center" id="detail<?php echo $details['id'];?>">
                  
                  <a href="#share_bookshelf" rel="facebox" class="button_pro" onclick="share_book(<?php echo $details['id'];?>,'<?php echo $details['name'];?>')">Share</a>
                  
                  </td>
                  
                  <td class="center"><input id="check_<?php echo $details['id']?>" name="check_<?php echo $details['id']?>" type="checkbox" value="1" class="del_t" onclick="del(<?php echo $details['id']?>)"></td>
                </tr>
                
                <?php $i++; } } else { ?>
                <tr>              
                <td colspan="5"><p>Sorry! There are no BookShelves.</p></td>
                </tr>
                <?php } ?>
                
               
              </tbody>
            </table>


<div class="paginate_div">
<?php if($total_rows > $offset+5 ){ ?><a href="javascript:;" onclick="ajaxDiscovery(<?php echo $page+1;?>)" class="blue_but floright_martop">VIEW OLDER</a><?php }else{?> <a href="javascript:;" class="blue_but floright_martop">VIEW OLDER</a> <?php } ?>

<?php if($offset == "0"){?>&nbsp;<?php }else{ ?> <a href="javascript:;" class="green_but floright_martop" onclick="ajaxDiscovery(<?php echo $page-1;?>)">PREVIOUS</a> <?php } ?> 
 </div>
     
</div>

<?php if(!empty($bookshelf_test))
                {
                $i =1;    
                foreach($bookshelf_test as $details)
                {
                	$workdetails_total  = $this->mwork->allWorkForBookshelf($details['id']);
                    
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
                //echo '<pre/>';print_r($workdetails_total);
                foreach($workdetails_total as $key=>$total_work)
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
           </div> 
           
          
           
            <?php }
            
            } ?>  
          
     
    <!--------------------Share Bookshelf------------------------->
<script>
function share_book(id,name)
{
    $('#bself_id').val(id);
    $('#bkslf_name').text(name);
    $('#note').text('Please take a look at the list of "'+name+'" I have saved to my bookshelf on Inkubate.com');
}
</script>

<div id="share_bookshelf" style="display:none;" >

<div class="content_share">
	<h2>Share my "<span id="bkslf_name"></span>" Bookshelf with:</h2>
	<?php
		$frmAttrs   = array("id"=>'addBookshelf',"class"=>'form-horizontal',"name"=>'myform');
		echo form_open('bookshelves/BookShelves_share', $frmAttrs);
		?>
	<label class="share_eml">Email:</label>
	<input name="bookshelf" type="text" id="email" name="email" placeholder="Email Address" />
	<div class="clear"></div>
    <h2>Note:</h2>
    <label>Note:</label>
    <textarea rows="3" cols="40" id="note" name="note"></textarea>
    <div class="clear"></div>
    <input type="hidden" id="share_bkslf" name="share_bkslf" value="" />
	<input name="button" class="add_bkslf" type="submit" value="Send" style="margin-left: 53px !important;" />
	</form> 
 </div>   
    
</div> 
            
      <script>
$(document).ready(function() {
    $("#content").find("[id^='tab']").hide(); // Hide all content
    $("#tabs li:first").attr("id","current"); // Activate the first tab
    $("#content #tab1").fadeIn(); // Show first tab's content
    
    $('body').on('click', '.tabs a', function(e) {
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
