 <?=$this->load->view('template/inner_header.php')?>
  <?php $usd = $this->session->userdata('logged_user'); ?>

<script>

  function del(id)
  { 
        //var del = $(this).val();
        //alert(id);
        if(confirm('Are you sure to delete this Bookshelf?'))
        {
             $.ajax({
               url      : '<?=base_url()?>'+'bookshelves/delete_bookshelf',
               type     : 'POST',
               data     : { 'id': id },
               success  : function(resp){
                //alert(resp);
                    if(resp != '0'){
                        $("#book_shelf").html(resp);
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
            return false;
        }
           
  } 
  
</script>

<style>

.table_new tbody tr:hover {background:none!important;}

.work_section .table_new tbody td {height:60px !important;} 

</style>


            <div class="content_part">
            	
               
                <div class="mid_content index_sec">
          
          <div class="bookself_top1">
          <span class="b_sec_left_main"><label class="leb_left"><img src="<?=base_url()?>images/my_book.png" alt="" /></label><label class="b_left_t">My Bookshelves</label> 
          <div class="clear"></div>
          </span>
          <div class="b_sec_left"> 
          
          <a href="#bookshelf" rel="facebox">
          <img src="<?=base_url()?>images/plus_btn.png" alt="" class="plus_img" />
         <input type="submit" value="Add New Bookshelf" class="b_btn_left" id="">
          </a>
          </div>
          
         <p class="b-header">Share, view the contents, or delete your bookshelves.</p>  
          </div> 
           
                    
    <div class="book_table_main1"> 
      
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="book_table_new">
        <thead>
          <tr>
            <th class="share"></th>
            <th class="">Bookshelf</th>
            <th class="items">Items</th>
            <th class="browse_view">Browsing View</th>
            <th class="manage_view">Manage list</th>
          </tr>
        </thead>
        <tbody id="book_shelf">
          
          <?php 
               //echo '<pre/>';print_r($bookshelf_test);die;
               if(!empty($bookshelf_test))
                {
                $i =1;    
                 foreach($bookshelf_test as $details)
                 {
               
                 $user_book_self = $this->mbookshelf->get_user_book_self($details['id']);
                 $user_book_self_id = $this->mbookshelf->get_bookshelf_one($details['id']);
                 //echo '<pre/>';print_r($user_book_self_id);die;
               ?>
          
          <tr>
           
            <!--<a href="#" class="share_btn">Share</a>-->
            <td>
            <a href="#bookshelf_share_<?php echo $details['id']?>" rel="facebox" data-fruit ="<?php echo $details['name'];?>"class="share_btn">Share</a>
           <!-- <a href="#bookshelf_share_<?php echo $details['id']?>" rel="facebox" data-fruit ="<?php echo $details['name'];?>" class="share_btn" >
            <input name="button" type="button" value="Share" class="btn_viw"/>
            </a>-->
            
            
        <div id="bookshelf_share_<?php echo $details['id']?>" style="display:none;">
        
         <h2>Share my "<?php echo $details['name'];?>" Bookshelf with:</h2>
         <?php
           //$frmAttrs   = array("id"=>'addBookshelf',"class"=>'form-horizontal',"name"=>'myform');
           //echo form_open('bookshelves/BookShelves_share', $frmAttrs);
         ?>
         <form action="<?=base_url()?>bookshelves/BookShelves_share" method="post">
         <label>Email:</label>
         <input name="email" id="email" type="text" />
         <div class="clear"></div>
         
         <label class="bself_label">Note:</label>
         <textarea class="bself_note" name="note" id="note"></textarea>
         <div class="clear"></div>
         
         <input type="hidden" name="bself_id" id="bself_id" value="<?php echo $details['id']?>"/> 
         <input name="button" class="add_bkslf" type="submit" value="Send" style="margin-left: 60px !important;" />
         </form> 
         
         </div>  
          
            
            </td>
           
            <td><strong><?php echo $details['name'];?></strong></td>
            <!--<td width="30%" align="center"><?php echo $details['name'];?></td>
            <td width="20%" align="center"><?php echo count($user_book_self);?></p></td>-->
            <td>
            <?php echo count($user_book_self);?>
            </td>
            <td>
            <a href="<?=base_url()?>bookshelves/booklist/<?php echo $details['id'];?>"><img alt="" src="<?=base_url()?>images/list_view.png" /></a>
            <?php if(!empty($user_book_self_id)) {?>
            <a href="<?=base_url()?>work/carousel/<?=$user_book_self_id['Wid']?>/<?php echo $details['id'];?>"><img alt="" src="<?=base_url()?>images/discevory_view.png" /></a>
            <?php } ?>
            </td>
            
            <td><span class="del_t" onclick="del(<?php echo $details['id']?>)" style="cursor: pointer;">Delete</span></td>
          </tr>
          
          
          <?php $i++; } } else { ?>
                <tr>
                <td ></td>
                <td></td>
                <td><p>Sorry! There are no BookShelves.</p></td>
                <td></td>
                <td></td>
                
                </tr>
                <?php } ?>
        </tbody>
      </table>
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
  

                 
                
<?=$this->load->view('template/inner_footer.php')?>             

