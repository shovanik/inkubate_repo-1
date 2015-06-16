<div id="bookshelf_format" style="display:none;">
  <div class="pop_con">
                
               
                
                   <div class="popcnlf">
                   
                    <strong><p class="fic_con"><a href="<?=base_url()?>discovery/typeSearch/1">All Fiction(<?php echo $count_allfiction; ?>)</a></p></strong>
                
                       <div class="clmfst">
                       
                          <ul>
                            
                            <?php  
                            $fiction  = $this->mbookshelf->allFormByFiction(1);
                            //echo '<pre/>';print_r($fiction);die;
                            
                             foreach($fiction as $fic)
                             {
                              
                               ?>
                            
                             <li><a href="<?=base_url()?>discovery/formatSearch/<?php echo $fic['work_form_id'];?>"><?php echo $fic['work_form_name'];?>(<?php echo $fic['work_form_count'];?>)</a></li>
                            <?php } ?> 
                             <!--<li><a href="#">Graphic Novel (2)</a></li>
                             <li><a href="#">Novel (865)</a></li>
                             <li><a href="#">Novella (34)</a></li>
                             <li><a href="#">Play (8)</a></li>
                             <li><a href="#">Poetry (46)</a></li>
                       
                             <li><a href="#">Short Story (180)</a></li>
                             <li><a href="#">Script (27)</a></li>
                             <li><a href="#">Artwork (1)</a></li>
                             <li><a href="#">Board Book (2)</a></li>
                             <li><a href="#">Children's Book (45)</a></li>
                             <li><a href="#">Picture Book (11)</a></li>-->
                       
                          </ul>
                       </div>
                       <div class="clear"></div>
                
                   </div>
                   
                   
                   <div class="popcnlf1">
                   
                   <strong><p class="fic_con"><a href="<?=base_url()?>discovery/typeSearch/2">All Non-Fiction(<?php echo $count_allnonfiction;?>)</a></p></strong>
                
                       <div class="clmfst">
                       
                          <ul>
                          
                            <?php  
                            $fiction  = $this->mbookshelf->allFormByFiction(2);
                            
                             foreach($fiction as $fic)
                             {
                            ?>
                            
                             <li><a href="<?=base_url()?>discovery/formatSearch/<?php echo $fic['work_form_id'];?>"><?php echo $fic['work_form_name'];?>(<?php echo $fic['work_form_count'];?>)</a></li>
                            <?php } ?> 
                            
                             <!--<li><a href="#">Collection (16)</a></li>
                             <li><a href="#">Graphic Novel (2)</a></li>
                             <li><a href="#">Novel (865)</a></li>
                             <li><a href="#">Novella (34)</a></li>
                             <li><a href="#">Play (8)</a></li>
                             <li><a href="#">Poetry (46)</a></li>
                       
                             <li><a href="#">Short Story (180)</a></li>
                             <li><a href="#">Script (27)</a></li>
                             <li><a href="#">Artwork (1)</a></li>
                             <li><a href="#">Board Book (2)</a></li>
                             <li><a href="#">Children's Book (45)</a></li>
                             <li><a href="#">Picture Book (11)</a></li>-->
                       
                          </ul>
                       </div>
                       <div class="clear"></div>
                
                   </div>
                   <div class="clear"></div>
                
                
                
                </div> 
 
  </div>
  
 <div id="bookshelf_writer" style="display:none;">
 
 
                      <div class="pop_con1">
     
                         <div class="popcnlf2">
                         
                          
                             <?php 
                              $writer_cnt = $this->mbookshelf->writers_count();
                              $trd_pub = $this->mbookshelf->get_tradition();
                              $self_pub = $this->mbookshelf->get_self_pub();
                              $award = $this->mbookshelf->get_award();
                              $review = $this->mbookshelf->get_review();
                              $mfa = $this->mbookshelf->get_mfa();
                              ?>
                         
                           <strong><p class="fic_con"><a href="<?=base_url()?>discovery/writers">All Writers (<?=count($writer_cnt)?>)</a></p></strong>
     
                             <div class="clmfst1">
                            
                              
                                 <ul>
                                 
                                     <li><a href="<?=base_url()?>discovery/writers_category/traditionally_published">Traditionally published (<?=count($trd_pub)?>)</a></li>
                                     <li><a href="<?=base_url()?>discovery/writers_category/self_published">Self-published (<?=count($self_pub)?>)</a></li>
                                     <li><a href="<?=base_url()?>discovery/writers_category/literary_awards">Received awards (<?=count($award)?>)</a></li>
                                     <li><a href="<?=base_url()?>discovery/writers_category/work_been_reviewed">Reviewed (<?=count($review)?>)</a></li>
                                     <li><a href="<?=base_url()?>discovery/writers_category/mfa_program">Creative writing MFA (<?=count($mfa)?>)</a></li>
                                   
                                 </ul>
     
                             </div>
     
                         </div>
                         
                         <div class="popcnrf">
                         
                         
                         <strong><p class="fic_con" style="color:#333;">By Last Name</p></strong>
                         
                             <div class="alphabet">
                             
                                <ul>
                                
                                    <li><a href="<?=base_url()?>discovery/writers_letter/a">A</a></li>
                                    <li><a href="<?=base_url()?>discovery/writers_letter/b">B</a></li>
                                    <li><a href="<?=base_url()?>discovery/writers_letter/c">C</a></li>
                                    <li><a href="<?=base_url()?>discovery/writers_letter/d">D</a></li>
                                    <li><a href="<?=base_url()?>discovery/writers_letter/e">E</a></li>
                                    <li><a href="<?=base_url()?>discovery/writers_letter/f">F</a></li>
                                    <li><a href="<?=base_url()?>discovery/writers_letter/g">G</a></li>
                                    <li><a href="<?=base_url()?>discovery/writers_letter/h">H</a></li>
                                    <li><a href="<?=base_url()?>discovery/writers_letter/i">I</a></li>
                                    <li><a href="<?=base_url()?>discovery/writers_letter/j">J</a></li>
                                    <li><a href="<?=base_url()?>discovery/writers_letter/k">K</a></li>
                                    <li><a href="<?=base_url()?>discovery/writers_letter/l">L</a></li>
                                    <li><a href="<?=base_url()?>discovery/writers_letter/m">M</a></li>
                                    <li><a href="<?=base_url()?>discovery/writers_letter/n">N</a></li>
                                    <li><a href="<?=base_url()?>discovery/writers_letter/o">O</a></li>
                                    <li><a href="<?=base_url()?>discovery/writers_letter/p">P</a></li>
                                    <li><a href="<?=base_url()?>discovery/writers_letter/q">Q</a></li>
                                    <li><a href="<?=base_url()?>discovery/writers_letter/r">R</a></li>
                                    <li><a href="<?=base_url()?>discovery/writers_letter/s">S</a></li>
                                    <li><a href="<?=base_url()?>discovery/writers_letter/t">T</a></li>
                                    <li><a href="<?=base_url()?>discovery/writers_letter/u">U</a></li>
                                    <li><a href="<?=base_url()?>discovery/writers_letter/v">V</a></li>
                                    <li><a href="<?=base_url()?>discovery/writers_letter/w">W</a></li>
                                    <li><a href="<?=base_url()?>discovery/writers_letter/x">X</a></li>
                                    <li><a href="<?=base_url()?>discovery/writers_letter/y">Y</a></li>
                                    <li><a href="<?=base_url()?>discovery/writers_letter/z">Z</a></li>
                                
                         
                                </ul>
                                <div class="clear"></div>
                             </div>
                         </div>
                         <div class="clear"></div>
  
                      </div>
 
 </div> 
    
 <div id="bookshelf_search" style="display:none;">
 
  <div class="pop_con2">
     
  
                            <div id="focus" style="width:100%;">
	<div style="background-color:#fff;" class="focus-block work-properties">

		<!-- block -->
		

		<!-- block [type of work] -->
		<div class="block block-type-of-work">
			<h3>Format</h3>
			<div class="label-inline  clearfix ">
				<input type="radio" checked="&quot;checked&quot;/" value="1" name="WorkTypeId" id="rdoWorkTypeIdFiction">
				<label for="rdoWorkTypeIdFiction">Fiction</label>
				<input type="radio" value="2" name="WorkTypeId" id="rdoWorkTypeIdNonFiction">
				<label for="rdoWorkTypeIdNonFiction">Non-Fiction</label>
			</div>

			<select class="input_box" name="WorkFormId" multiselect="multiselect" style="height:31px;">
				<option value="">Select type...</option>
					
			
					
					
			<option value="1" data-workform-type-id="1">Collection</option><option value="2" data-workform-type-id="1">Graphic Novel</option><option value="3" data-workform-type-id="1">Novel</option><option value="4" data-workform-type-id="1">Novella</option><option value="5" data-workform-type-id="1">Play</option><option value="6" data-workform-type-id="1">Poetry</option><option value="7" data-workform-type-id="1">Short Story</option><option value="8" data-workform-type-id="1">Script</option><option value="17" data-workform-type-id="1">Artwork</option><option value="18" data-workform-type-id="1">Board Book</option><option value="19" data-workform-type-id="1">Children's Book</option><option value="22" data-workform-type-id="1">Picture Book</option></select>
            <input type="hidden" value="" name="WorkFormatString" id="WorkFormatString" data-val-required="Please select a format" data-val="true">
		</div>
        <div class="block block-type-of-work">
        <h3>Keywords</h3>
        
        <input type="text" style="width:95%;" class="input_box" name="">
        </div>
        
         <h3>Search In</h3>
        <div class="block clearfix">
            <input type="checkbox" value="true" name="SelfPublished" id="SelfPublished" data-val-required="The Is this work self-published? field is required." data-val="true" class="questions"><input type="hidden" value="false" name="SelfPublished">
            <label for="SelfPublished">Tags</label>
        </div>
        <div class="block clearfix">
            <input type="checkbox" value="true" name="ReceivedAwards" id="ReceivedAwards" data-val-required="The Has this work received any awards? field is required." data-val="true" class="questions"><input type="hidden" value="false" name="ReceivedAwards">
            <label for="ReceivedAwards">Synposis</label>
        </div>
        <div class="block clearfix">
            <input type="checkbox" value="true" name="BeenReviewed" id="BeenReviewed" data-val-required="The Has this work been reviewed? field is required." data-val="true" class="questions"><input type="hidden" value="false" name="BeenReviewed">
            <label for="BeenReviewed">Titles</label>
        </div>
        <div class="block clearfix">
            <input type="checkbox" value="true" name="PublishedAbroad" id="PublishedAbroad" data-val-required="The Has this work been published abroad? field is required." data-val="true" class="questions"><input type="hidden" value="false" name="PublishedAbroad">
            <label for="PublishedAbroad">Excerpt</label>
        </div>

		<!-- field block [categories] -->

		<div data-max-category-count="3" class="block block-categories clearfix">
			<h3><label>Categories (<span class="category-assigned-count">0</span>/3)</label></h3>
			<a class="action" href="#"><strong>(see all)</strong></a>
			<div class="resp_cat">
				<!--<div class="field-validation-error no-display">No Matching Categories</div>-->
				<input type="text" class="input_box" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true">
				<span class="button button-small"><button style="height:46px !important;">Add</button></span>
			</div>
			<span class="note">Start typing a category (eg. Young Adult)</span><br>
			
			<ul class="term-list">
			</ul>
            <input type="hidden" value="" name="WorkCategoriesString" id="WorkCategoriesString" data-val-required="Please select a category" data-val="true">
		</div>
        
        
        <div class="block block-type-of-work">
        
           <h3>Added</h3>
           
           <div class="dates">
            <span class="fr_con">From</span> 
            <input type="text" class="input_box" id="StartDate" name="StartDate" value=""><img title="..." alt="..." src="/Content/img/interface/button-cal.png" class="ui-datepicker-trigger">
            <div class="clear"></div>
            <br><span class="fr_con">To</span> 
            <input type="text" class="input_box" id="EndDate" name="EndDate" value=""><img title="..." alt="..." src="/Content/img/interface/button-cal.png" class="ui-datepicker-trigger">
            <div class="clear"></div>
        </div>

		
		</div>

        <!-- field block [questions] -->
         <div class="block block-type-of-work">
        <h3>Narrow by</h3>
        <div class="block clearfix">
            <input type="checkbox" value="true" name="SelfPublished" id="SelfPublished" data-val-required="The Is this work self-published? field is required." data-val="true" class="questions"><input type="hidden" value="false" name="SelfPublished">
            <label for="SelfPublished">Self-published</label>
        </div>
        <div class="block clearfix">
            <input type="checkbox" value="true" name="ReceivedAwards" id="ReceivedAwards" data-val-required="The Has this work received any awards? field is required." data-val="true" class="questions"><input type="hidden" value="false" name="ReceivedAwards">
            <label for="ReceivedAwards">Published abroad</label>
        </div>
        <div class="block clearfix">
            <input type="checkbox" value="true" name="BeenReviewed" id="BeenReviewed" data-val-required="The Has this work been reviewed? field is required." data-val="true" class="questions"><input type="hidden" value="false" name="BeenReviewed">
            <label for="BeenReviewed">Received award(s)</label>
        </div>
        <div class="block clearfix">
            <input type="checkbox" value="true" name="PublishedAbroad" id="PublishedAbroad" data-val-required="The Has this work been published abroad? field is required." data-val="true" class="questions"><input type="hidden" value="false" name="PublishedAbroad">
            <label for="PublishedAbroad">Reviewed</label>
        </div>
        
        <div class="block clearfix">
            <input type="checkbox" value="true" name="PublishedAbroad" id="PublishedAbroad" data-val-required="The Has this work been published abroad? field is required." data-val="true" class="questions"><input type="hidden" value="false" name="PublishedAbroad">
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
				<span class="button button-large button-margin"><button value="Cancel" name="command" type="submit" class="not-bold cancel" style="margin-right:10px;">Search</button></span>
                <span class="button button-large button-margin"><button value="Cancel" name="command" type="submit" class="not-bold cancel">Cancel</button></span>				
						
			</div>
        </div>

	</div>
</div>
  
                         <div class="clear"></div>
  
                      </div>
 
 </div>
 
  <div id="bookshelf_saved" style="display:none;">
 
 
                      <div class="pop_con3">
                
                         <strong><p>Recent Saved Searches</p></strong>
                         
                         <?php
                         
                         $saved_search = $this->mbookshelf->total_saved_search();
                         
                         if(!empty($saved_search))
                         {
                            foreach($saved_search as $total)
                            {
                                
                         
                         ?>
                         
                         <p class="fic_con" style="margin-top:15px;"><a href="<?=base_url()?>bookshelves/savedSearch/<?=$total['search_form_id']?>"><?=$total['saved_search_name']?></a></p>
                         <p style="color:#9a9a9a; font-size:12px;">Saved on <?=date('m/d/Y',strtotime($total['create_date']))?> </p>
                         
                           
                     <?php }
                           } ?>
                         
                         <strong><p style="margin-top:15px; margin-bottom:15px;">All Saved Searches</p></strong>
                         <select multiselect="multiselect" name="WorkFormId" class="input_box" style="width:79%;">
				<option value="">Select type...</option>
                <?php 
                foreach($saved_search as $total)
                            {
                ?>
				<option value="<?=$total['id']?>" onclick="goSavesearch(<?=$total['search_form_id']?>)"><?=$total['saved_search_name']?></option>
                <?php } ?>
                
			   </select>
            
            
            <p class="fic_con" style="margin-top:15px;"><a href="<?=base_url()?>discovery/ManageSavedSearches">Manage Saved Searches</a></p>
              
                
                      </div>
                      
             <script>
             function goSavesearch(fid)
             {
                window.location.href = '<?=base_url()?>bookshelves/savedSearch/'+fid;
             }
             </script>         
 
 </div> 