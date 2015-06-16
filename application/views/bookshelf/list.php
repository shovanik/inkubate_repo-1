 <?=$this->load->view('template/inner_header.php')?>
  <?php $usd = $this->session->userdata('logged_user'); ?>

<script>

  function del(id,bid)
  { 
        
        //alert(id);
      if(confirm("Are you sure you want to delete this from Bookshelf?")){  
        window.location.href = '<?=base_url()?>bookshelves/delete_books/'+id+'/'+bid; 
       }
       else { return false; } 
           
  } 
  
</script>
<link rel="stylesheet" href="<?=base_url()?>style/inner/jquery.bxslider.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?=base_url()?>style/inner/select.css" />

            <div class="content_part">
            <?php 
            $user_book_self_id = $this->mbookshelf->get_bookshelf_one($this->uri->segment(3));
            
            ?>	
               
                <div class="mid_content index_sec">
          <div class="top_content">
                <div class="top_left_con">
                <h2>Bookshelf: <span><?php echo $bookself_name['name'];?></span></h2>
                <span class="top_left_icon">
               <a href="<?=base_url()?>bookshelves/booklist/<?=$this->uri->segment(3)?>"><img alt="" src="<?=base_url()?>images/list_view.png" /></a>
               <?php if(!empty($user_book_self_id)) {?>
                 <a href="<?=base_url()?>work/carousel/<?=$user_book_self_id['Wid']?>/<?=$this->uri->segment(3)?>"><img alt="" src="<?=base_url()?>images/discevory_view.png" /></a>
               <?php } ?>  
                </span>
                </div>
                <div class="top_right_con">
                <a href="<?=base_url()?>bookshelves">View all Bookshelves</a>
                </div>
                </div>
          <div class="bookself_top" style="margin-bottom: 12px;">
<!--          <span class="sec_left">
          <label class="leb_left"><?php echo $bookself_name['name'];?></label> 
          <div class="clear"></div>
          </span>-->
          
          <div class="clear"></div>
          </div> 
                    
    <div class="work_section1 change_width1" style="margin-bottom: 12px;"> 
      
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_1">
       
        <tbody id="book_shelf">
          
          <?php 
              //echo '<pre/>';print_r($booklist);die;
               if(!empty($booklist))
                {
                $i =1;    
                 foreach($booklist as $details)
                 {
               
                 //$user_book_self = $this->mbookshelf->get_user_book_self($details['id']);
               ?>
          
          <tr>
            
            <td width="10%" align="center" valign="top">
            <?php if($details['photo'] != '') {?>
            <img src="<?=base_url()?>uploadImage/<?=$details['user_id']?>/cover_image/thumbs/<?=$details['photo']?>"/>
            <?php } else { ?>
            <img src="<?=base_url()?>images/img_default_cover.png" style="width: 100px; height: 100px;"/>
            <?php } ?>
            </td>
            <td width="70%" align="left" valign="top">
            <div class="list-detail">
                       <h3>
                           <a href="<?=base_url()?>work/work_details/<?php echo $details['id'];?>/<?php echo $details['bid'];?>"><?php echo $details['title'];?></a> <span>(<?php echo $details['form_name'];?>)</span>
                       </h3>
                       <p class="by">by <a href="#"><?php echo $details['name'];?></a>, added <?php echo date('Y',strtotime($details['create_date']));?></p>
                       <p class="list-detail_text"><?php echo substr($details['synopsis'],0,50).'...';?></p>
                       <p class="foot">
                           <strong>Categories:</strong> <?php 
            $user_book_cat = $this->mbookshelf->get_book_cat($details['id']);
            if(!empty($user_book_cat))
                {
                    foreach($user_book_cat as $cat)
                 {
            
             echo $cat['category_name'].',';
             
             } } ?> | <strong>Tags:</strong> Baseball, parenting, coaching
                       </p>
                   </div>
            </td>
           <!-- <td width="70%" align="left">
            <a href="<?=base_url()?>work/work_details/<?php echo $details['id'];?>/<?php echo $details['bid'];?>">
            <span style="color:#3c97ff; padding:0 10px; cursor: pointer; float: left;">
            <h3>
			<?php echo $details['title'];?>
            </h3>
            </span>
            </a>
            <span style="float: left;">(<?php echo $details['form_name'];?>)</span>
            <p style="clear: both; margin-left: 13px;">by<span style="color:#3c97ff; padding:0 10px; cursor: pointer;"><?php echo $details['name'];?></span>,added <?php echo date('Y',strtotime($details['create_date']));?></p>
            
            <p style="clear: both; margin-left: 13px;"><span><?php //echo substr($details['synopsis'],0,50).'...';?></span></p>
           
            <p style="clear: both; margin-left: 13px;"><strong>categories</strong>: 
            <?php 
            /*$user_book_cat = $this->mbookshelf->get_book_cat($details['id']);
            if(!empty($user_book_cat))
                {
                    foreach($user_book_cat as $cat)
                 {
            
             echo $cat['category_name'].',';
             
             } }*/ ?>
            </p>
            </td>-->
            
            <td width="20%" align="center">
         <div class="b_sec_list"> 
            <img src="<?=base_url()?>images/plus_btn.png" alt="" class="plus_img1" />
         <input type="button" value="Add to Bookshelf" class="b_btn_left" id=""><br>
                <a class="remove_bookself" href="#" onclick="del(<?php echo $details['id']?>,<?php echo $bookself_name['id'];?>)">Remove from bookshelf</a>       
               </div>       
            
                  
            <!--<span >
            <a href="#bookshelf_<?=$details['id']?>" rel="facebox">
            <input name="button" type="button" value="Add to Bookshelf" class="btn_viw" style="margin-bottom: 2px;"/>
            </a>
            <input name="button" type="button" value="Remove from Bookshelf" onclick="del(<?php echo $details['id']?>,<?php echo $bookself_name['id'];?>)" class="btn_viw" style=" font-size: 11px!important; font-weight: normal !important;"/>
            </span>-->
            
            
  <!--------------------Add bookshelf Popup--------------------->       
            <div id="bookshelf_<?=$details['id']?>" style="display:none;">
             <h2>Add to Bookshelf</h2>
             <?php
               $frmAttrs   = array("id"=>'addBookshelf',"class"=>'form-horizontal',"name"=>'myform');
               echo form_open('bookshelves/addToBookShelves', $frmAttrs);
             ?>
             <div style="width: 100%;">
             <span style="float: left; padding-right: 10px;">
            <div class="styled-select">
               <select name="bkself_id" id="bkself_id">
                  <option value="0">Select</option>
                  <?php 
                  $bself_list = $this->mbookshelf->get_rest_bookshelf($bookself_name['id']);
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
             <input type="hidden" name="wid" id="wid" value="<?=$details['id']?>" />
             <input name="button" class="add_bkslf" type="submit" value="Add"  />
             </span>
             <div class="clear"></div>
             </div>
             </form> 
             
              </div>
            
 <!-------------------------End Popup--------------------------------------------->           
            
            </td>
            
          </tr>
          
          <?php $i++; } } else { ?>
                <tr>
                <td width="10%" align="center"></td>
                <td width="80%" align="center"><p>Sorry! There are no Books.</p></td>
                <td width="10%" align="center"></td>
                
                </tr>
                <?php } ?>
        </tbody>
      </table>
    </div>
                    
                    <div class="clear"></div>
                    
                  
                    
                </div>
                <div class="clear"></div>
                 
                
<?=$this->load->view('template/inner_footer.php')?>             

