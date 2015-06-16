 <?=$this->load->view('template/inner_header_discover.php')?>
  <?php $usd = $this->session->userdata('logged_user'); ?>

<script>

  function del(id)
  { 
        //var del = $(this).val();
        //alert(id);
        
         $.ajax({
           url      : '<?=base_url()?>'+'bookshelves/delete_bookshelf',
           type     : 'POST',
           data     : { 'id': id },
           success  : function(resp){
            //alert(resp);
                if(resp != '0'){
                    $("#book_shelf").html(resp);
                    //$("#edit_class" ).dialog( "close" );
                }
           },
           error    : function(resp){
                $.prompt("Sorry, something isn't working right.", {title:'Error'});
           }
        });
           
  } 
  
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

            <div class="content_part">
            	
                <div class="mid_content index_sec">
                
                <div class="bookslf_menu">
                
                   <ul>
                        <li><a href="#bookshelf_format" rel="facebox">Formats</a></li>
                        <li><a href="#bookshelf_writer" rel="facebox">Writers</a></li>
                        <li><a href="#bookshelf_search" rel="facebox">Search</a></li>
                        <li><a href="#bookshelf_saved" rel="facebox">My Saved Searches</a></li>
                    </ul>
                   <div class="clear"></div>
                </div>
                
                
                
          <div class="bookself_top">
         
          <span class="sec_left" style="margin-left: 20px;"><label class="leb_left">Writers</label> 
          <div class="clear"></div>
          </span>
          
          <div class="clear"></div>
          </div> 
         
          
          
      <div class="contact_conternt_left_writer" style="border-top:none;">      
                    
      <div class="pitchits_section_right work_section change_width"> 
      
      <div id="full_content_div">
      
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_new">
       
        <tbody id="book_shelf">
          
          <?php 
               //echo '<pre/>';print_r($writers_letter);die;
               if(!empty($writers_letter))
                {
                $i =1;    
                 foreach($writers_letter as $details)
                 {
               
                 //$user_book_self = $this->mbookshelf->get_user_book_self($details['id']);
               ?>
          
          <tr class="itemld">
            <td width="10%" align="center"><?php echo $details['id']?></td>
            <td width="20%" align="center">
            <?php if($details['photo'] != '') {?>
            <img src="<?=base_url()?>uploadImage/<?=$details['id']?>/profile/thumbs/<?=$details['photo']?>"/>
            <?php } else { ?>
            <img src="<?=base_url()?>images/img_default_cover.png" style="width: 100px; height: 100px;"/>
            <?php } ?>
            </td>
            <td width="70%" align="left">
            <a href="">
            <span class="spn">
            <h3 class="str"><?php echo $details['name_first'].' '.$details['name_middle'].' '.$details['name_last'];?></h3>
            </span>
            </a>
            
            <p class="parlf"><span><?php echo substr(html_entity_decode($details['bio'], ENT_QUOTES, 'UTF-8'),0,50).'...';?></span></p>
           
            <p class="parlf"><strong>works</strong>: 
            <?php 
            $writer_work = $this->mbookshelf->get_writer_work($details['id']);
            
             echo count($writer_work);
             
             ?>
            </p>
            </td>
            
          </tr>
          
          
          <?php $i++; }  ?>
          
          <tr class="paginate pagination3"><td><?=$this->pagination->create_links()?><?//=$this->ajax_pagination->create_links()?></td></tr> 
          
          <?php } else { ?>
                <tr>
                <td width="10%" align="center"></td>
                <td width="80%" align="center"><p>Sorry! There are no Writers.</p></td>
                <td width="10%" align="center"></td>
                
                </tr>
                <?php } ?>
        </tbody>
       </table>
      </div>
    </div>
    
    </div>
    
     
               <div class="clear"></div>
                    
                  
                    
                </div>
                <div class="clear"></div>
                
  <?=$this->load->view('template/search.php')?>
 
 
 <div id="bookshelf_save_add" style="display:none;">
 <h2>Save Search</h2>
 <?php
   $frmAttrs   = array("id"=>'addBookshelf',"class"=>'form-horizontal',"name"=>'myform');
   echo form_open('bookshelves/addBookShelves', $frmAttrs);
 ?>
 
 <input name="bookshelf" type="text" />
 <div class="clear"></div>
 <input name="button" class="add_bkslf" type="submit" value="Add" style="margin-left: 60px !important;" />
 </form> 
 
  </div>       
                
<?=$this->load->view('template/inner_footer.php')?>             

