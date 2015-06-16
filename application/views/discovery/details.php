 <?=$this->load->view('template/inner_header.php')?>
  <?php $usd = $this->session->userdata('logged_user'); ?>

<style>
#facebox .content { height: 170px !important;}
.para_lft { clear: both; margin-left: 13px;}    
</style>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>style/inner/select.css" />


            <div class="content_part">
            	
               
        <div class="mid_content index_sec" style="padding:25px;">
          <?php 
          //echo '<pre/>';print_r($workdetails_test);
          foreach($workdetails_test  as $workdetails)
          {
          ?>
          <div class="bookself_top">
          <span class="sec_left"><label class="leb_left"><?=$workdetails['title']?></label> 
          <div class="clear"></div>
          </span>
          
          <div class="clear"></div>
          </div> 
       
    
<!--##################################################################################################-->


   <div class="col-left">
            <a href="#" id="single_image" class="overlay-iframe_dynamic">
            <?php if($workdetails['photo'] != '') {?>
            <img src="<?=base_url()?>uploadImage/<?=$workdetails['user_id']?>/cover_image/medium/<?=$workdetails['photo']?>"/>
            <?php } else { ?>
            <img src="<?=base_url()?>images/img_default_cover.png"/>
            <?php } ?>
            </a> 
            
    </div>
    
    
    
    <div class="col-center">
        <h3 class="synopsis">Synopsis</h3>
        <div class="display-field">
            <p class="col_con">
            <?php 
            if($workdetails['synopsis'] != '')
            {
            echo html_entity_decode($workdetails['synopsis'], ENT_QUOTES, 'UTF-8');
            }
            else
            {
              echo 'No Synopsis';  
            }
            ?></p>

        </div>
        <h3 class="extract">Excerpt</h3>

        <div class="display-field">
            <p class="col_con">
            <?php 
            if($workdetails['extract'] != '')
            {
            echo html_entity_decode($workdetails['extract'], ENT_QUOTES, 'UTF-8');
            }
            else
            {
             echo 'No Excerpt';   
            }
            ?></p>

        </div>
        <h3 class="attachment">Download Manuscript</h3>
        <div class="display-field">
            <span class="file-upload-names">
                <?php if($workdetails['file_asset_id'] != '') {?>
                <a href="<?=base_url()?>discovery/download/<?=$workdetails['id']?>/<?=$workdetails['file_asset_id']?>/<?=$workdetails['user_id']?>/<?=$workdetails['work_file']?>" style="color: #70a1df;"><?=$workdetails['work_file']?></a>
                <?php } ?>
            </span>
            <div class="b_sec_left"> 
           <a href="#bookshelf" rel="facebox"> 
          <img src="<?=base_url()?>images/plus_btn.png" alt="" class="plus_img1" />
         <input type="button" value="Add New Bookshelf" class="b_btn_left" id="">
         </a>
          </div>
        </div>
        
    </div>
    
    
    
       <div class="col-right">
        
        <h3>Author</h3>
        <div class="display-field">
            <span style="color:#3c97ff; padding:0 10px; cursor: pointer;"><?php echo $workdetails['name'];?>
        </div>
        <br/>
        <h3>Type</h3>
        <div class="display-field">
            <?php echo $workdetails['type_name'];?>
        </div>
        <br/>
            <h3>Genre</h3>
            <div class="display-field">
                <?php echo $workdetails['form_name'];?>
            </div>  
            <br/>
        <h3>Categories</h3>
        <div class="display-field">
            <ul style="padding-left: 16px;">
            
            <?php 
            $user_book_tag = $this->mbookshelf->get_book_tag($workdetails['id']);
            if(!empty($user_book_tag))
                {
                    foreach($user_book_tag as $tag)
                 {
             ?>       
            <li style="list-style-type: disc;"><?php echo $tag['tag_name'];?></li>
            <?php
             
             } } 
             ?>
             
            </ul>
        </div>
        <br/>
        <!--<h3>Tags</h3>
        <div class="display-field">
          <?php 
            /*$user_book_tag = $this->mbookshelf->get_book_tag($workdetails['id']);
            if(!empty($user_book_tag))
                {
                    foreach($user_book_tag as $tag)
                 {
            
             echo $tag['tag_name'].', ';
             
             } } */?>     
      </div>
        <br/>-->
        <h3>Self Published</h3>
        <div class="display-field">
            <?php if($workdetails['self_published'] == 1) { echo 'Yes'; }else { 'No';}?>
        </div>
        <br/>
        <h3>Reviewed</h3>
        <div class="display-field">
            <?php if($workdetails['been_reviewed'] == 1) { echo 'Yes'; }else { 'No';}?>
        </div>
        <br/>
        <h3>Upload Date</h3>
        <div class="display-field">
           <?php echo date('m/d/Y',strtotime($workdetails['create_date']));?>
        </div>
    </div>    
    
    
    
                
                    <div class="clear"></div>
                    
                  
                    
                </div>
               
               <?php } ?> 
                
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
      $bself_list = $this->mbookshelf->get_bookshelf();
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

