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
         
          <span class="sec_left" style="margin-left: 20px;"><label class="leb_left">Results</label> 
          <div class="clear"></div>
          </span>
          
          <div class="clear"></div>
          </div> 
          <p class="page-header" style="margin-left: 18px;">
          <?php if($form_name == '1')
          {
            echo 'Fiction';
          }
          if($form_name == '2')
          {
            echo 'Non-Fiction'; 
          }
          ?>
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
               //echo '<pre/>';print_r($discovery);die;
               if(!empty($discovery))
                {
                $i =1;    
                 foreach($discovery as $details)
                 {
               
                 //$user_book_self = $this->mbookshelf->get_user_book_self($details['id']);
               ?>
          
          <tr class="itemld">
            <td width="10%" align="center"><?php echo $i?></td>
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
            <p class="parlf">by<span class="spn"><?php echo $details['name'];?></span>,added <?php echo date('Y',strtotime($details['create_date']));?></p>
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
          
          
          <?php $i++; }  ?>
          
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
    
     
     
        
        
        
        
        
        <div id="focus">
	<div class="focus-block work-properties" style="background-color:#fff;">

		<!-- block -->
		

		<!-- block [type of work] -->
		<div class="block block-type-of-work">
			<h3>Format</h3>
			<div class="label-inline  clearfix ">
				<input type="radio" id="rdoWorkTypeIdFiction" name="WorkTypeId" value="1" checked="&quot;checked&quot;/">
				<label for="rdoWorkTypeIdFiction">Fiction</label>
				<input type="radio" id="rdoWorkTypeIdNonFiction" name="WorkTypeId" value="2">
				<label for="rdoWorkTypeIdNonFiction">Non-Fiction</label>
			</div>

			<select multiselect="multiselect" name="WorkFormId" class="input_box">
				<option value="">Select type...</option>
					
			
					
					
			<option data-workform-type-id="1" value="1">Collection</option><option data-workform-type-id="1" value="2">Graphic Novel</option><option data-workform-type-id="1" value="3">Novel</option><option data-workform-type-id="1" value="4">Novella</option><option data-workform-type-id="1" value="5">Play</option><option data-workform-type-id="1" value="6">Poetry</option><option data-workform-type-id="1" value="7">Short Story</option><option data-workform-type-id="1" value="8">Script</option><option data-workform-type-id="1" value="17">Artwork</option><option data-workform-type-id="1" value="18">Board Book</option><option data-workform-type-id="1" value="19">Children's Book</option><option data-workform-type-id="1" value="22">Picture Book</option></select>
            <input type="hidden" data-val="true" data-val-required="Please select a format" id="WorkFormatString" name="WorkFormatString" value="">
		</div>
        <div class="block block-type-of-work">
        <h3>Keywords</h3>
        
        <input name="" type="text" class="input_box" style="width:95%;" />
        </div>
        
         <h3>Search In</h3>
        <div class="block clearfix">
            <input type="checkbox" class="questions" data-val="true" data-val-required="The Is this work self-published? field is required." id="SelfPublished" name="SelfPublished" value="true"><input type="hidden" name="SelfPublished" value="false">
            <label for="SelfPublished">Tags</label>
        </div>
        <div class="block clearfix">
            <input type="checkbox" class="questions" data-val="true" data-val-required="The Has this work received any awards? field is required." id="ReceivedAwards" name="ReceivedAwards" value="true"><input type="hidden" name="ReceivedAwards" value="false">
            <label for="ReceivedAwards">Synposis</label>
        </div>
        <div class="block clearfix">
            <input type="checkbox" class="questions" data-val="true" data-val-required="The Has this work been reviewed? field is required." id="BeenReviewed" name="BeenReviewed" value="true"><input type="hidden" name="BeenReviewed" value="false">
            <label for="BeenReviewed">Titles</label>
        </div>
        <div class="block clearfix">
            <input type="checkbox" class="questions" data-val="true" data-val-required="The Has this work been published abroad? field is required." id="PublishedAbroad" name="PublishedAbroad" value="true"><input type="hidden" name="PublishedAbroad" value="false">
            <label for="PublishedAbroad">Excerpt</label>
        </div>

		<!-- field block [categories] -->

		<div class="block block-categories clearfix" data-max-category-count="3">
			<h3><label>Categories (<span class="category-assigned-count">0</span>/3)</label></h3>
			<a href="#" class="action"><strong>(see all)</strong></a>
			<div>
				<!--<div class="field-validation-error no-display">No Matching Categories</div>-->
				<input type="text" aria-haspopup="true" aria-autocomplete="list" role="textbox" autocomplete="off" class="input_box">
				<span class="button button-small"><button>Add</button></span>
			</div>
			<span class="note">Start typing a category (eg. Young Adult)</span><br>
			
			<ul class="term-list">
			</ul>
            <input type="hidden" data-val="true" data-val-required="Please select a category" id="WorkCategoriesString" name="WorkCategoriesString" value="">
		</div>
        
        
        <div class="block block-type-of-work">
        
           <h3>Added</h3>
           
           <div class="dates">
            <span class="fr_con">From</span> 
            <input type="text" value="" name="StartDate" id="StartDate" class="text-date hasDatepicker"><img class="ui-datepicker-trigger" src="/Content/img/interface/button-cal.png" alt="..." title="...">
            <div class="clear"></div>
            <br /><span class="fr_con">To</span> 
            <input type="text" value="" name="EndDate" id="EndDate" class="text-date hasDatepicker"><img class="ui-datepicker-trigger" src="/Content/img/interface/button-cal.png" alt="..." title="...">
            <div class="clear"></div>
        </div>

		</div>

        <!-- field block [questions] -->
         <div class="block block-type-of-work">
        <h3>Features</h3>
        <div class="block clearfix">
            <input type="checkbox" class="questions" data-val="true" data-val-required="The Is this work self-published? field is required." id="SelfPublished" name="SelfPublished" value="true"><input type="hidden" name="SelfPublished" value="false">
            <label for="SelfPublished">Self-published</label>
        </div>
        <div class="block clearfix">
            <input type="checkbox" class="questions" data-val="true" data-val-required="The Has this work received any awards? field is required." id="ReceivedAwards" name="ReceivedAwards" value="true"><input type="hidden" name="ReceivedAwards" value="false">
            <label for="ReceivedAwards">Published abroad</label>
        </div>
        <div class="block clearfix">
            <input type="checkbox" class="questions" data-val="true" data-val-required="The Has this work been reviewed? field is required." id="BeenReviewed" name="BeenReviewed" value="true"><input type="hidden" name="BeenReviewed" value="false">
            <label for="BeenReviewed">Received award(s)</label>
        </div>
        <div class="block clearfix">
            <input type="checkbox" class="questions" data-val="true" data-val-required="The Has this work been published abroad? field is required." id="PublishedAbroad" name="PublishedAbroad" value="true"><input type="hidden" name="PublishedAbroad" value="false">
            <label for="PublishedAbroad">Reviewed</label>
        </div>
        
        <div class="block clearfix">
            <input type="checkbox" class="questions" data-val="true" data-val-required="The Has this work been published abroad? field is required." id="PublishedAbroad" name="PublishedAbroad" value="true"><input type="hidden" name="PublishedAbroad" value="false">
            <label for="PublishedAbroad">Contest entry</label>
        </div>
        </div>

        <!-- field block [contest entry] 
        <div class="block clearflix" id="contest-entry-block" style="display: none;">
            <input class="questions" data-val="true" data-val-required="The Enter in contest field is required." id="IsContestEntry" name="IsContestEntry" type="checkbox" value="true" /><input name="IsContestEntry" type="hidden" value="false" />
            <label for="IsContestEntry">Enter in contest</label>
			After checking box, scroll up to agree to Terms of Use.        
        </div>-->
        <div class="block clearfix">
			<div class="buttons clearfix">
				<span class="button button-large button-margin"><button class="not-bold cancel" type="submit" name="command" value="Cancel">Update Search</button></span>				
						
			</div>
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

