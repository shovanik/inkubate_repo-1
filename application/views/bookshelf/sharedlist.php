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

<link rel="stylesheet" type="text/css" href="<?=base_url()?>style/inner/select.css" />

            <div class="content_part">
            	
               
                <div class="mid_content index_sec">
          
          <div class="bookself_top" style="margin-bottom: 12px;">
          <span class="sec_left">
          <label class="leb_left">Bookshelf: <?php echo $bookself_name['name'];?>, shared by <?php echo $usd['name_first'].' '.$usd['name_middle'].' '.$usd['name_last']?></label> 
          <div class="clear"></div>
          </span>
          
          
          </div> 
          <span class="sec_left" style="margin-bottom: 12px;">
          <p>You can't make changes to this bookshelf, but you can add interesting books to your own.</p>
          </span>
           <div class="clear"></div>
                    
    <div class="pitchits_section_right work_section change_width" style="margin-bottom: 12px;"> 
      
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_new">
       
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
            
            <td width="10%" align="center">
            <?php if($details['photo'] != '') {?>
            <img src="<?=base_url()?>uploadImage/<?=$details['user_id']?>/cover_image/thumbs/<?=$details['photo']?>"/>
            <?php } else { ?>
            <img src="<?=base_url()?>images/img_default_cover.png" style="width: 100px; height: 100px;"/>
            <?php } ?>
            </td>
            <td width="70%" align="left">
            <a href="<?=base_url()?>work/work_details/<?php echo $details['id'];?>"><span style="color:#3c97ff; padding:0 10px; cursor: pointer; float: left;"><h3><?php echo $details['title'];?></h3></span></a><span style="float: left;">(<?php echo $details['form_name'];?>)</span>
            <p style="clear: both; margin-left: 13px;">by<span style="color:#3c97ff; padding:0 10px; cursor: pointer;"><?php echo $details['name'];?></span>,added <?php echo date('Y',strtotime($details['create_date']));?></p>
            <p style="clear: both; margin-left: 13px;"><span><?php echo substr($details['synopsis'],0,50).'...';?></span></p>
           
            <p style="clear: both; margin-left: 13px;"><strong>categories</strong>: 
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
            
            <td width="20%" align="center">
            
            <span >
            <a href="#bookshelf" rel="facebox">
            <input name="button" type="button" value="Add to Bookshelf" class="btn_viw" style="margin-bottom: 2px;"/>
            </a>
            <!--<input name="button" type="button" value="Remove from Bookshelf" onclick="del(<?php //echo $details['id']?>,<?php //echo $bookself_name['id'];?>)" class="btn_viw" style=" font-size: 11px!important; font-weight: normal !important;"/>-->
            </span>
            
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
                
 <div id="bookshelf" style="display:none;">
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
 <input type="hidden" name="wid" id="wid" value="<?=$this->uri->segment(3)?>" />
 <input name="button" class="add_bkslf" type="submit" value="Add"  />
 </span>
 <div class="clear"></div>
 </div>
 </form> 
 
  </div>
                 
                
<?=$this->load->view('template/inner_footer.php')?>             

