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

<script type="text/javascript">
		$(document).ready( function() {
            
           
         //$("#txtEditor").Editor(); 
         //$("#txtEditor22").Editor();
         
         
         $('#Fiction').click(function(){
            
            
            var fiction = $('#Fiction').val();
            //alert(fiction);
            
            $.ajax({
           url      : '<?=base_url()?>'+'work/details',
           type     : 'POST',
           data     : { 'id': fiction },
           success  : function(resp){
            //alert(resp);
                if(resp != '0'){
                    $("#work_form").html(resp);
                    //$("#edit_class" ).dialog( "close" );
                }
           },
           error    : function(resp){
                $.prompt("Sorry, something isn't working right.", {title:'Error'});
           }
        });
            
            
  });
         
          $('#NonFiction').click(function(){
            
           //alert('hi');
           
           var nonfiction = $('#NonFiction').val();
            //alert(fiction);
            
            $.ajax({
           url      : '<?=base_url()?>'+'work/details',
           type     : 'POST',
           data     : { 'id': nonfiction },
           success  : function(resp){
            //alert(resp);
                if(resp != '0'){
                    $("#work_form").html(resp);
                    //$("#edit_class" ).dialog( "close" );
                }
           },
           error    : function(resp){
                $.prompt("Sorry, something isn't working right.", {title:'Error'});
           }
        });
           
            
         })
        
      
       
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
         
          <span class="sec_left" style="margin-left: 20px;"><label class="leb_left">Results</label> 
          <div class="clear"></div>
          </span>
          
          <div class="clear"></div>
          </div> 
          <p class="page-header" style="margin-left: 18px;">
          <?php echo $form_name['work_form_name'];?>
          </p> 
         
          <a href="#bookshelf_save_add" rel="facebox" data-fruit ="" class="bself_share" >
          <input name="button" type="button" value="save this search" class="btn_viw" style="margin-right: 0 !important; margin-left: 30px;"/>
          </a>
          <div class="clear"></div>
          
          
      <div class="contact_conternt_left" style="border-top:none;">      
                    
                    <div class="pitchits_section_right work_section change_width"> 
      
      <div id="full_content_div">
      
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_new">
       
        <tbody id="book_shelf">
          
          <?php
          //echo $cnt; die;
               //echo '<pre/>';print_r($discovery);die;
               if(!empty($discovery))
                {
                //$i =1;    
                 foreach($discovery as $details)
                 {
               
                 //$user_book_self = $this->mbookshelf->get_user_book_self($details['id']);
               ?>
          
          <tr class="itemld">
            <td width="10%" align="center"><?php echo $details['i']?></td>
            <td width="20%" align="center">
            <?php if($details['photo'] != '') {?>
            <img src="<?=base_url()?>uploadImage/<?=$details['user_id']?>/cover_image/thumbs/<?=$details['photo']?>"/>
            <?php } else { ?>
            <img src="<?=base_url()?>images/img_default_cover.png" style="width: 100px; height: 100px;"/>
            <?php } ?>
            </td>
            <td width="70%" align="left">
            <a href="<?=base_url()?>work/work_details/<?php echo $details['id'];?>"><span class="spn">
            <h3 class="str"><?php echo $details['title'];?></h3>
            </span></a><span style="float: left;">(<?php echo $details['form_name'];?>)</span>
            <p class="parlf">by<span class="spn">
            
            <a href="<?=base_url()?>discovery/user_details/<?php echo $details['user_id'];?>">
            <?php echo $details['name'];?>
            </a>
            
            </span>,added <?php echo date('Y',strtotime($details['create_date']));?></p>
            <p class="parlf"><span><?php echo substr(html_entity_decode($details['synopsis'], ENT_QUOTES, 'UTF-8'),0,50).'...';?></span></p>
           
            <p class="parlf"><strong>categories</strong>: 
            <?php 
            $user_book_cat = $this->mbookshelf->get_book_cat($details['id']);
            if(!empty($user_book_cat))
                {
                    foreach($user_book_cat as $cat)
                 {
            
             echo $cat['category_name'].',';
             
             } } ?>
            </p>
            </td>
            
          </tr>
          
          
          <?php  }  ?>
          
          <tr class="paginate pagination3"><td><?=$this->pagination->create_links()?><?//=$this->ajax_pagination->create_links()?></td></tr> 
          
          <?php } else { ?>
                <tr>
                <td width="10%" align="center"></td>
                <td width="80%" align="center"><p>Sorry! There are no Books.</p></td>
                <td width="10%" align="center"></td>
                
                </tr>
                <?php } ?>
        </tbody>
       </table>
      </div>
    </div>
    
    </div>
    
     
  <?=$this->load->view('template/search_right.php')?>   
     
                    
                    <div class="clear"></div>
                    
                  
                    
                </div>
                <div class="clear"></div>
                
 <?=$this->load->view('template/search.php')?>
 
 
 <div id="bookshelf_save_add" style="display:none;">
 <h2>Save Search</h2>
 <?php
   $frmAttrs   = array("id"=>'save',"class"=>'form-horizontal',"name"=>'myform');
   echo form_open('bookshelves/addSavedSearch', $frmAttrs);
 ?>
 
 <input name="save_search" id="save_search" type="text" />
 <div class="clear"></div>
 <input type="hidden" name="fid" id="fid" value="<?=$this->uri->segment(3)?>"/>
 <input name="button" class="add_bkslf" type="submit" value="Add" style="margin-left: 60px !important;" />
 </form> 
 
  </div>       
                
<?=$this->load->view('template/inner_footer.php')?>             

