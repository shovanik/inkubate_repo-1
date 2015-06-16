<?=$this->load->view('template/inner_header_dashboard.php')?>
<?php $usd = $this->session->userdata('logged_user');?>

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
      <div class="mid_content index_sec">
        
        <div class="pitchits_section_right work_section work_section_mob">
          <h1><img src="<?=base_url()?>images/work_img.png" alt="" />My Work</h1>
          
          <div class="table_cont_new" id="full_content_div">
          
          	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_new">
            <thead>
              <tr>
                
                <th width="12%" align="center">Book Cover</th>
                <th width="30%" align="center">Title</th>
                <th width="14%" align="center">Tags</th>
                <th width="24%" align="center">Date Added</th>
                <th width="20%" align="center">Pitchited</th>
              </tr>
            </thead>
            <tbody>
              
              
               <?php 
               //echo '<pre/>';print_r($user_work_details);die;
               if(!empty($user_work_details))
                    {
                    $i =1;    
                 foreach($user_work_details as $details)
                 {
               
                 $user_category_details = $this->memail->get_user_work_categories($details['id']);
               ?>
               <tr class="itemld">
                
                <td width="12%" align="center">
                 <?php if($details['cover_image'] != '') { ?>
                 
                 <img src="<?=base_url()?>uploadImage/<?=$usd['id']?>/cover_image/thumbs/<?=$details['cover_image']?>" alt="" />
                
                <?php } else { ?>
                
                <img src="<?=base_url()?>images/img_default_cover.png" alt="" />
                
                <?php } ?>
                
                </td>
                <td width="30%" align="center"><a href="<?=base_url()?>work/editWork/<?=$details['id']?>"><p><strong><?=$details['title']?></strong></p></a><br />
                    <p><?=$details['work_type_name']?><br />
                    Categories: 
                    <span>
                    <?php if(!empty($user_category_details))
                     {
                     foreach($user_category_details as $categories)
                     {
                        echo $categories['category_name'].', ';
                     } } ?>
                    </span></p></td>
                    
                <td width="14%" align="center">
                
                <?php 
                 $work_tag_details = $this->mwork->work_tags_details($details['id']);
                 //echo '<pre/>';print_r($work_tag_details);die;
                  if(!empty($work_tag_details))
                   {
                    foreach($work_tag_details as $tagdetails) {
                     echo $tagdetails['tag_name'].', ';
                     
                     } }
                 ?> 
                
                </td>
                    
                <td width="24%" align="center"><?php echo date('m/d/Y',strtotime($details['create_date']))?></td>
                <!--<td width="24%" align="center"><img src="<?//=base_url()?>images/flag.png" alt="" /></td>-->
                <td width="20%" align="center">
                
                <?php if($details['is_pitchited'] == '1') {?>
                <span>
                <!--<img src="<?//=base_url()?>images/flag.png" alt="" />-->
                YES
                </span>
                <?php } else {?>
                <a href="#openModal_<?=$details['id']?>" class="button_pro" style="display:none">Pitchit!</a>
                <?php } ?> 
                
                </td>
                </tr>
                
                
    <div id="openModal_<?=$details['id']?>" class="modalDialog">
    <div>	
    <a href="#close" title="Close" class="close">X</a>

        	    <header>
					<h3>Pitchit Content</h3>
				</header>
           <div class="clear"></div>
           
             <?php
               $frmAttrs   = array("id"=>'signupFrm',"class"=>'form-horizontal');
               echo form_open('work/addPitchit', $frmAttrs);
             ?>
           
             <textarea class="txt_pitchit" id="desc" name="desc" onKeyDown="limitText(this.form.desc,this.form.cout,140);" 
onKeyUp="limitText(this.form.desc,this.form.cout,140);"></textarea>

          <p>Characters Remaining: <input  type="text" name="cout" size="3" value="140" readonly="readonly" class="read_only"/> </p>
            
              <div class="clear"></div>
            <input type="hidden" name="wid" id="wid" value="<?=$details['id']?>" />  
            <input name="button" type="submit" value="Send" class="btn_viw1" style="margin-top: 15px;" />
          </form>            
            
      </div>
   </div>
                
                
                <?php  $i++; } ?>
                
                <tr class="paginate pagination3"><td><?=$this->pagination->create_links()?><?//=$this->ajax_pagination->create_links()?></td></tr>
                
                <?php } else { ?>
                <tr>
                <td width="6%" align="center"></td>
                <td width="12%" align="center"></td>
                <td width="24%" align="center"><p>Sorry! There are no works.</p></td>
                <td width="34%" align="center"></td>
                <td width="24%" align="center"></td>
                </tr>
                <?php } ?>
              
              <!--<tr class="hov_col">
                <td align="center">2</td>
                <td align="center"><img src="<?//=base_url()?>images/img_01.jpg" alt="" /></td>
                <td align="center"><p><strong>MH 370 - Full Story</strong><br />
                    Non-fiction<br />
                    Categories: <span>Journalism</span></p></td>
                <td align="center">Mar 21, 2014</td>
                <td align="center"><a href="#" class="button_pro" style="display:none">Pitchit!</a></td>
              </tr>-->
              
            </tbody>
          </table>
          </div>
        </div>
        <div class="clear"></div>
      </div>
      <div class="clear"></div>
<?=$this->load->view('template/inner_footer_dashboard.php')?>       
