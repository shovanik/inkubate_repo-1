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
        	<img src="<?=base_url()?>images/icon_p.png" alt="" /><span>Bookshelved Works</span> 
            <div class="clear"></div>
        </div>
       						  <div class="pitchits_table table_new">
        	<table border="0" width="100%">
            
                
                
                
                
                
    <thead>                                                                                                                          
      <tr>
         <th width="10%" align="center">Image</th>
         <th width="20%" align="center">Name</th>
         <th width="30%" align="center">Work Title</th>
         <th width="20%" align="center">Bookshelf</th>
         <th width="20%" align="center">Bookshelved Date</th>
         
      </tr>
      
     </thead>
                
            <tbody>
            
            <?php 
               //echo '<pre/>';print_r($profiles);die;
               if(!empty($profiles))
                {
                $i =1;    
                 foreach($profiles as $pitch_details)
                 {
                  //$user_category_details = $this->memail->get_user_work_categories($pitch_details['wid']);
                  //$pitchit_view = $this->memail->get_user_pitchit_view($pitch_details['wid']);  
               ?>
                
                <tr class="pitchits_table_content">
                	<td valign="top" align="center">
                    <?php if($pitch_details['photo'] != '') {?>
                    <img src="<?=base_url()?>uploadImage/<?=$pitch_details['user_id']?>/profile/thumbs/<?=$pitch_details['photo']?>"/>
                    <?php } else { ?>
                    <img src="<?=base_url()?>images/img_default_headshot.png"/>
                    <?php } ?>
                    </td>
                    
                    <td align="center"><?php echo $pitch_details['name_first'].' '.$pitch_details['name_middle'].' '.$pitch_details['name_last'];?></td>
                    <td align="center"><?php echo $pitch_details['title'];?></td>
                    <td align="center"><?php echo $pitch_details['bookshelf_name'];?></td>
                    <td align="center"><?php echo date('m/d/Y',strtotime($pitch_details['created_date']))?></td>
                    
                </tr>
                
               <?php $i++; } }  else { ?>
               
                <tr class="pitchits_table_content">
                <td width="10%" align="center"></td>
                <td width="20%" align="center"></td>
                <td width="30%" align="center"><p>Sorry! There are no Bookshelved Work.</p></td>
                <td width="20%" align="center"></td>
                <td width="20%" align="center"></td>
               
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
