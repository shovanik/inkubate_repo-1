 
      <?php
       $usd = $this->session->userdata('logged_user');
       //$frmAttrs   = array("id"=>'signupFrm',"class"=>'form-horizontal',"name"=>'myForm');
       //echo form_open_multipart('discovery/refine', $frmAttrs);
       ?>         
        
  <div id="focus">
	<div class="focus-block work-properties" style="background-color:#fff;">

		<!-- block -->
		

		<!-- block [type of work] -->
		<div class="block block-type-of-work">
        
			<h3>Format</h3>
			<div class="label-inline  clearfix ">
            
                <input type="radio" class="xyz" checked="checked" value="1" name="group1" id="Fiction"/>
                <label for="rdoWorkTypeIdFiction" class="xyz">Fiction</label>
				<input type="radio" class="xyz" value="2" name="group1" id="NonFiction"/>
				<label for="rdoWorkTypeIdNonFiction" class="xyz">Non-Fiction</label>
                
			</div>

			<select name="work_form" class="input_box" id="work_form">
            
            <?php if(!empty($fiction_details)) {
                foreach($fiction_details as $each=>$details){
                ?>
				<option value="<?php echo $details['work_form_id']?>"><?php echo $details['work_form_name']?></option>
			<?php } } ?>		
			
			</select>
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
            <input type="text" value="" name="start" id="start_date" class="text-date"/>
            <div class="clear"></div>
            <br /><span class="fr_con">To</span> 
            <input type="text" value="" name="end" id="end_date" class="text-date"/>
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