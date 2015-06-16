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
.img_sz_small_22
{
    border-radius: 50%;
    height: 60px;
    width: 60px;
	float:left;
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
              
                	<div class="bookself_top1">
                    
                    <div class="b_sec_left_main">
        	<label class="leb_left"><img src="<?=base_url()?>images/icon_p.png" alt="" /></label>
            <label class="b_left_t">All Pitchits!</label> 
            <div class="clear"></div>
        </div>
                    
                        <div class="pitchits_section_left2">                           
                           	
       						  <div class="pitchits_table book_table_new">
        	<table border="0" width="100%">
    <thead>                                                                                                                          
      <tr>
         <th width="10%" align="center">Image</th>
         <th width="20%" align="center">Title</th>
         <th width="40%" align="center">Pitchits!</th>
         <th width="10%" align="center">Date</th>
         <th width="20%" align="center">Action</th>
      </tr>
     </thead>
            <tbody>
            <?php 
               //echo '<pre/>';print_r($user_pitchit_details);die;
               //print_r($user_pit_details);die;
               //echo $user_pit_details['pitchit'];die;
               if(!empty($user_pitchit_details))
                {
                $i =1;    
                 foreach($user_pitchit_details as $pitch_details)
                 {
                  $user_category_details = $this->memail->get_user_work_categories($pitch_details['id']); 
                  
               ?>
                
                <tr class="pitchits_table_content">
                	<td valign="top" align="center">
                    
               <?php if(!empty($pitch_details['cover_image'])) { ?>
              <img src="<?=base_url()?>uploadImage/<?=$pitch_details['user_id']?>/cover_image/<?=$pitch_details['cover_image']?>" alt="" class="img_sz_small_22" />
              <?php } else { ?>
              <img src="<?=base_url()?>images/img_default_cover.png" alt="" class="img_sz_small_22" />
              
              <?php } ?>
                    
                    </td>
                    <td>
                    	<p class="list-detail_text"><?=$pitch_details['title']?></p>
						<p class="foot"><strong><?=$pitch_details['work_type_name']?></strong><br />
						<strong>Categories:</strong><br /> 
                        <strong>
                        
                        <?php if(!empty($user_category_details))
                         {
                         foreach($user_category_details as $categories)
                         {
                            echo $categories['category_name'].', ';
                         } } 
                       ?></p>
                        
                        </strong>
					</td>
                    <td valign="top"><a class="tooltips" href="javascript:void(0)">
                    "<?php 
                    if(strlen($pitch_details['pitchit']) <= 60)
                    {
                      echo $pitch_details['pitchit'];
                    }
                    else
                    {
                      echo substr($pitch_details['pitchit'],0,60).'..';  
                    }
                    ?>"
                    <span><?php  echo $pitch_details['pitchit']?></span></a></td>
                    <td align="center"><?php echo date('m/d/Y',strtotime($pitch_details['created_date']))?></td>
                   
                   <td align="left">
                   <a href="<?=base_url()?>home/compose_mail/<?=$pitch_details['user_id']?>/<?php echo $pitch_details['pit_id']?>">
                   <input type="button" class="share_btn" value="Reply" />
                   </a>
                   
                   <a href="<?=base_url()?>work/work_details/<?=$pitch_details['wid']?>">
                   <input type="button" class="share_btn" value="view work" />
                   </a>
                   
                   
                   </td>
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
