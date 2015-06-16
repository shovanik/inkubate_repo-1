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
.table_new tbody tr:hover {background:none!important;}
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
        	<img src="<?=base_url()?>images/icon_p.png" alt="" /><span>Latest Pitchits!</span> 
            <div class="clear"></div>
        </div>
       						  <div class="pitchits_table table_new">
        	<table border="0" width="100%">
            
                
                
                
                
                
    <thead>                                                                                                                          
      <tr>
         <th width="10%" align="center">No.</th>
         <th width="20%" align="center">Book</th>
         <th width="44%" align="center">Pitchit</th>
         <th width="17%" align="center">Date</th>
         <th width="9%" align="center">Views</th>
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
                </tr>
                
               <?php $i++; } }  else { ?>
               
                <tr class="pitchits_table_content">
                <td width="10%" align="center"></td>
                <td width="20%" align="center"></td>
                <td width="44%" align="center"><p>Sorry! There are no Pitchits.</p></td>
                <td width="17%" align="center"></td>
                <td width="9%" align="center"></td>
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
