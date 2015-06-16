<?=$this->load->view('template/inner_header_dashboard.php')?>
<?php $usd = $this->session->userdata('logged_user'); ?>

<link rel='stylesheet' href='<?=base_url()?>style/inner/tooltips.css'/>
	<script src="<?=base_url()?>js/tooltips.js"></script>
	<script>
		$(function() {
			$("a[title]").tooltips();
		});
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

<style>
.modalDialog {
    position: fixed;
    font-family: Arial, Helvetica, sans-serif;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    background: rgba(0, 0, 0, 0.8);
    z-index: 99999;
    opacity:0;
    -webkit-transition: opacity 400ms ease-in;
    -moz-transition: opacity 400ms ease-in;
    transition: opacity 400ms ease-in;
    pointer-events: none;
}
.modalDialog:target {
    opacity:1;
    pointer-events: auto;
}
.modalDialog > div {
    width: 30%;
    position: relative;
    margin: 10% auto;
    padding: 13px 20px 13px 20px;
    border-radius: 10px;
    background: #fff;
   
}
.close {
    background: #606061;
    color: #FFFFFF;
    line-height: 25px;
    position: absolute;
    right: -12px;
    text-align: center;
    top: -10px;
    width: 24px;
    text-decoration: none;
    font-weight: bold;
    -webkit-border-radius: 12px;
    -moz-border-radius: 12px;
    border-radius: 12px;
    -moz-box-shadow: 1px 1px 3px #000;
    -webkit-box-shadow: 1px 1px 3px #000;
    box-shadow: 1px 1px 3px #000;
}
.close:hover {
    background: #00d9ff;
}
</style>

<script language="javascript" type="text/javascript">
function limitText(limitField, limitCount, limitNum) {
	if (limitField.value.length > limitNum) {
		limitField.value = limitField.value.substring(0, limitNum);
	} else {
		limitCount.value = limitNum - limitField.value.length;
	}
}
</script>

    <div class="content_part">
      
      <div class="mid_content">
              
                	<div class="pitchits_section">
                    
                    
                    
                        <div class="pitchits_section_left2">                           
                           	<div class="pitchits_heading">
        	<img src="<?=base_url()?>images/icon_p.png" alt="" /><span>My Saved Pitchits!</span> 
            <div class="clear"></div>
        </div>
       						  <div class="pitchits_table table_new">
        	<table border="0" width="100%">
            
                
                
                
                
                
    <thead>                                                                                                                          
      <tr>
         <th width="10%" align="center">No.</th>
         <th width="20%" align="center">Title</th>
         <th width="40%" align="center">Pitchits!</th>
         <th width="15%" align="center">Date</th>
         <th width="5%" align="center">Views</th>
         <th width="10%" align="center">Action</th>
      </tr>
      
     </thead>
                
            <tbody>
            
            <?php 
               //echo '<pre/>';print_r($user_pitchit_details);die;
               if(!empty($user_pitchit_details))
                {
                $i =1;    
                 foreach($user_pitchit_details as $pitch_details)
                 {
                  $user_category_details = $this->memail->get_user_work_categories($pitch_details['wid']);
                  $pitchit_view = $this->memail->get_user_pitchit_view($pitch_details['wid']);  
               ?>
                
                <tr class="pitchits_table_content">
                	<td valign="top" align="center"><?=$i?></td>
                    <td>
                    	<p><?=$pitch_details['title']?></p>
						<p><?=$pitch_details['work_type_name']?></p>
						<p>Categories: <span class="c_name">
                        
                        <?php if(!empty($user_category_details))
                         {
                         foreach($user_category_details as $categories)
                         {
                            echo $categories['category_name'].', ';
                         } } 
                       ?>
                        
                        </span></p>
					</td>
                    <td valign="top"><a class="tooltips" href="javascript:void(0)">"<?=substr($pitch_details['pitchit'],0,60).'..'?>"<span>Pitchits!
                    
                    <p><?=$pitch_details['pitchit']?></p>
                    
                    </span></a></td>
                    <td align="center"><?php echo date('m/d/Y',strtotime($pitch_details['created_date']))?></td>
                    <td align="center"><?=$pitchit_view;?></td>
                    <td align="center"><a href="#openModal_<?=$pitch_details['pit_id']?>"><input name="edit" type="button" value="Edit" class="btn_viw1" style="margin-top: 15px;" /></a></td>
                </tr>
                
        <div id="openModal_<?=$pitch_details['pit_id']?>" class="modalDialog">
            <div>	
            <a href="#close" title="Close" class="close">X</a>
        
                	    <header>
        					<h3>Pitchit Content</h3>
        				</header>
                   <div class="clear"></div>
                   
                     <?php
                       $frmAttrs   = array("id"=>'signupFrm',"class"=>'form-horizontal');
                       echo form_open('work/editPitchit', $frmAttrs);
                       
                      
                     $title_len = strlen($pitch_details['pitchit']);
                     $rest_len = 140 - $title_len;
                 
                     ?>
                   
                     <textarea class="txt_pitchit" id="desc" name="desc" onKeyDown="limitText(this.form.desc,this.form.cout,140);" 
        onKeyUp="limitText(this.form.desc,this.form.cout,140);"><?=$pitch_details['pitchit']?></textarea>
        
                  <p>Characters Remaining: <input  type="text" name="cout" size="3" value="<?=$rest_len?>" readonly="readonly" class="read_only"/> </p>
                    
                      <div class="clear"></div>
                    <input type="hidden" name="pid" id="pid" value="<?=$pitch_details['pit_id']?>" /> 
                    <input type="hidden" name="wid" id="wid" value="<?=$pitch_details['id']?>" /> 
                    <input name="send" type="submit" value="Send" class="btn_viw1" style="margin-top: 15px;" />
                    
                  </form>            
                    
            </div>
        </div>    
                
                
               <?php $i++; } }  else { ?>
               
                <tr class="pitchits_table_content">
                <td width="10%" align="center"></td>
                <td width="20%" align="center"></td>
                <td width="40%" align="center"><p>Sorry! There are no Saved Pitchits.</p></td>
                <td width="15%" align="center"></td>
                <td width="5%" align="center"></td>
                <td width="10%" align="center"></td>
                </tr>
                <?php } ?> 
                
                </tbody>
            </table>
        </div>
                           
                        </div>
                        <div class="clear"></div>
                    
                    
                    </div>
                </div>
      
      
      <div class="clear"></div>
<?=$this->load->view('template/inner_footer_dashboard.php')?>       
