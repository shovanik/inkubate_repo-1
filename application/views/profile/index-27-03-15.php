<?=$this->load->view('template/inner_header.php')?>
<?php $usd = $this->session->userdata('logged_user');?>
 <script src="<?=base_url()?>ckeditor/ckeditor.js"></script>
 <script>
 function revise()
 {
    window.location.href = '<?=base_url()?>profile/editProfile/<?php echo $usd['id'];?>';
 }
 
function limitText(limitField, limitCount, limitNum) {
	if (limitField.value.length > limitNum) {
		limitField.value = limitField.value.substring(0, limitNum);
	} else {
		limitCount.value = limitNum - limitField.value.length;
	}
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
            $('.chosen-select').chosen();
        },
        onRenderComplete : function(){
            //getRatingProduct();
            //getMerchantProductRating();
        },
        history:false
    });

</script>
 
 
<style>
.t_part {width:70%; padding: 20px; border: 1px dashed #333; margin: 0; background: #ededed;}
.t_part2 {width:100%;}
.left_new_link {width:73%; float: right;}
.profile_pic {width: 27%; float: left; padding: 0; margin: 0;}
.t_part_new { width:30%; float:right;}
.t_part_new .profile_right { float:right; text-align:right;}
.t_part_new .profile_right .button_pro {padding: 14px 40px 14px 18px;}
.frm_profile_new ul li {margin:0; padding:0 0 5px 0;}
.frm_profile_new h1 { padding: 5px 0; font-size: 20px; color: #333; border-bottom: 1px dashed #ccc; margin-bottom: 15px;}
.left_new_link h1 {padding-bottom:10px;}
.left_new_link p {line-height:20px;}
.onthe { padding:40px 10px 0 0;}
.profile_bot_sec_left {width:100%;}
.profile_bot_sec_right {width:100%;}

.author_bio_txt {padding-top: 30px;}
.auto_bio h1, .profile_bot_sec_left h1, .work_section_mob h1 { font-size: 22px; color: #333; border-bottom: 1px dashed #ccc; padding: 40px 0 5px 0; margin-bottom:10px;}
.join_con2_2 {padding: 0px 1% 18px 1%; margin: 0; color: #696969; font-size: 14px; float: left; word-break: break-all; }

</style>
 
<script>
function catshow(cat){
        
           // var cat   = $(this).attr('data-cat');
            //alert(cat);
         if(confirm('Are you sure to delete this category?'))
         {  
            $.ajax({
           url      : '<?=base_url()?>'+'profile/cat_details',
           type     : 'POST',
           data     : { 'id': cat},
           success  : function(resp){
            //alert(resp);
                if(resp != '0'){
                    var cat = resp.split('@');
                    //$("#cate_cnt").html(cat[0]);
                    $(".fict_pan_gnre").html(cat[1]);
                    $('.chosen-select').chosen({ max_selected_options: cat[0] });
                    //$("#edit_class" ).dialog( "close" );
                }
           },
           error    : function(resp){
                $.prompt("Sorry, something isn't working right.", {title:'Error'});
           }
        });
      }
      else
      {
        return false;
      }  
   
      }
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
.url_link { color: #696969;}
</style>
    
    <div class="content_part">
      <div class="mid_content index_sec pro">
        
        <div class="pitchits_section">
        
         <div class="prof3_pan">
          <div class="profile_left2">
              <!--<h1>Jay D Gale</h1>
              <p> Member since: 5/12/2011 <br>
    Works uploaded: 1</p>-->
    
               <?php if(!empty($user_photo['filename'])) {?>
                <div class="profile_pic">
                
                    <img src="<?=base_url()?>uploadImage/<?=$usd['id']?>/profile/<?=$user_photo['filename']?>"/>
                 </div>   
                 <?php } else {?>
                   <div class="profile_pic_2">
                    <img src="<?=base_url()?>images/img_default_headshot.png">
                   </div>
                 <?php } ?>   
                
                
                
          </div>
          
          <div class="profile_right2">
          
             <span class="name_con"><?php if(!empty($user_contact['name_first'])) { echo $user_contact['name_first']; } ?> <?php if(!empty($user_contact['name_last'])) { echo $user_contact['name_last']; } ?></span>
             <span class="pub_con11">Joined <?php if(!empty($user_contact['created'])) { echo date('Y', strtotime($user_contact['created'])); } ?></span>
             <span class="pub_con12">
             <?php if(!empty($user_contact['user_type'])) 
             {
                if($user_contact['user_type'] == '1') 
                {
                    echo 'Writer';
                }
                if($user_contact['user_type'] == '2') 
                {
                    echo 'Publisher';
                }
                if($user_contact['user_type'] == '3') 
                {
                    echo 'Agent';
                }
                if($user_contact['user_type'] == '4') 
                {
                    echo 'Editor';
                }
             } 
             ?>
             </span>
             <span class="pub_con"><?php if(!empty($user_contact['email'])) { echo $user_contact['email']; } else { echo 'No Email'; }?></span>
             <span class="pub_con13"><?php if(!empty($user_contact['company_name'])) { echo $user_contact['company_name']; } else { echo 'No Company'; }?></span>
             <div class="clear"></div>
             
             <span class="adrs_con1"><?php if(!empty($user_contact['address'])) { echo $user_contact['address']; } else { echo 'No Address'; }?></span>
             <span class="pub_con1"><?php if(!empty($user_contact['city'])) { echo $user_contact['city']; } else { echo 'No City'; }?></span>
             <span class="pub_con14"><?php if(!empty($user_contact['state'])) { echo $user_contact['state']; } else { echo 'No State'; }?></span>
             <span class="pub_con15"><?php if(!empty($user_contact['postal_code'])) { echo $user_contact['postal_code']; } else { echo 'No Postal Code'; }?></span>
             <span class="pub_con16"><?php if(!empty($user_contact['country'])) { echo $user_contact['country']; } else { echo 'No Country'; }?></span>
             <span class="adrs_con2">
             <?php $oth = $this->mprofile->get_user_web_link(4);
             if(!empty($oth['url'])) { ?>
                
              <a class="url_link" href="<?php echo $oth['url'];?>"> <?php echo $oth['url'];?> </a>
             <?php   } else { echo 'No Web Url'; }
             ?>
             </span>
             <div class="clear"></div>
             
             <?php $fb = $this->mprofile->get_user_web_link(1);
             if(!empty($fb['url'])) { 
               //echo $fb['url']; 
             ?>
             <span class="fb_icon"><a href="<?php echo $fb['url'];?>"><img src="<?=base_url()?>images/fb.png" alt=""></a></span>
             <span class="join_con2_2"><a class="url_link" href="<?php echo $fb['url'];?>"><?php echo $fb['url'];?></a></span>
             <?php } else {?>
             
             <span class="fb_icon"><img src="<?=base_url()?>images/fb.png" alt=""></span>
             <span class="join_con2_2">No Facebook</span>
             
             <?php } ?>
             
             <?php $rss = $this->mprofile->get_user_web_link(3);
             if(!empty($rss['url'])) { 
             ?>
             <span class="fb_icon"><a href="<?php echo $rss['url'];?>"><img src="<?=base_url()?>images/g+.png" alt=""></a></span>
             <span class="join_con2_2"><a class="url_link" class="url_link" href="<?php echo $rss['url'];?>"><?php echo $rss['url'];?></a></span>
             <?php } else {?>
             <span class="fb_icon"><img src="<?=base_url()?>images/g+.png" alt=""></span>
             <span class="join_con2_2">No Google+</span>
             <?php } ?> 
             
             <?php $twt = $this->mprofile->get_user_web_link(2);
             if(!empty($twt['url'])) { 
             ?>
             <span class="fb_icon"><a href="<?php echo $twt['url'];?>"><img src="<?=base_url()?>images/tw.png" alt=""></a></span>
             <span class="join_con2_2"><a class="url_link" href="<?php echo $twt['url'];?>"><?php echo $twt['url'];?></a></span>
             <?php } else {?>
             <span class="fb_icon"><img src="<?=base_url()?>images/tw.png" alt=""></span>
             <span class="join_con2_2">No Twitter</span>
             <?php } ?>
             
             <?php $linkin = $this->mprofile->get_user_web_link(5);
             if(!empty($linkin['url'])) { 
             ?>
             <span class="fb_icon"><a href="<?php echo $linkin['url'];?>"><img src="<?=base_url()?>images/in.png" alt=""></a></span>
             <span class="join_con2_2"><a class="url_link" href="<?php echo $linkin['url'];?>"><?php echo $linkin['url'];?></a></span>
            
             <?php } else{?>
             <span class="fb_icon"><img src="<?=base_url()?>images/in.png" alt=""></span>
             <span class="join_con2_2">No LinkedIn</span>
             <?php } ?> 
             
              <div class="clear"></div>
             <span class="join_con1"><strong>Content Interest:</strong></span>
             <span class="fict_pan">
             
             <?php if(!empty($work_type_details)) { ?>
                
               <div class="fict_pan_in">
                 <span class="fc_pan">
                 
                  <?php  if($work_type_details['work_type_id'] == '1') { ?>
                 Fiction
                 <?php } if($work_type_details['work_type_id'] == '2') {?>
                 Non-Fiction
                 <?php 
                 }                  
                 ?>
                 </span>
                <!-- <span class="cls_pan"><img src="<?//=base_url()?>images/cross_2.png" alt=""></span>-->
                 <div class="clear"></div>
                 
               </div>
              <?php } else { ?> 
               <p> No Type</p>
               <?php } ?>
             </span>
             
             <span class="join_con"><strong>Genre Interest:</strong></span>
             
             <span class="fict_pan_gnre">
             <?php  
            $work_cat_details =  $this->mprofile->work_categ_details($usd['id']);
            //echo '<pre>';print_r($work_cat_details);die;
            if(!empty($work_cat_details))
                   { 
                    foreach($work_cat_details as $catdetails) { ?>
              <span class="fict_pan">
              
               <div class="fict_pan_in" style="background:#8ac749">
                 <span class="fc_pan"><?php echo $catdetails['category_name']?></span>
                 <span class="cls_pan">
                 
                 <img src="<?=base_url()?>images/cross_2.png" alt="" onclick="catshow(<?php echo $catdetails['pcid']?>)">
                 
                 </span>
                 <div class="clear"></div>
               </div>
               
             </span>
             
             <?php } } ?>
             
            </span> 
             <div class="clear"></div>
             
             
          
          </div>
         
          <div class="clear"></div>
          <?php if(!empty($user_bio['biography'])) {?>
          <p class="full_con"> <?php echo $user_bio['biography'];?> </p>
          <?php } else {?>
          <p class="full_con"> Sorry! no biography.</p>
          <?php } ?>
        </div>
        
        <div class="profuibutt_sec1">
              <?php if($usd['user_type'] == '1') { ?>
                <button class="upld_butt3" type="button" style="margin-right:27px; margin-top:18px;" onclick="revise()">Edit Profile</button>
                <button class="upld_butt3" style="background-color:#2e75b6; margin-top:18px;">View My Work</button>
                <?php } else {?>
                <button class="upld_butt3" type="button" style="margin-left: 223px; margin-top:18px;" onclick="revise()">Edit Profile</button>
                <?php } ?>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
        
        
        <div class="clear"></div>
      </div>
        </div>
       
 <link rel="stylesheet" href="<?=base_url()?>style/inner/chosen.css"/>
<script src="<?=base_url()?>js/chosen.jquery.js" type="text/javascript"></script>

<script type="text/javascript">
    var config = {
      '.chosen-select'           : {max_selected_options: 3},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
      values = [];
      $(".chosen-select").chosen().change(function(e, params){
      values = $(".chosen-select").chosen().val();
      if( values != null)
      {
      var cat = values.length;
      $('#cate_cnt').text(cat);
      }
      else
      {
       var cat = 0;
       $('#cate_cnt').text(cat); 
      }
 //values is an array containing all the results.
});
    }
  </script>      
      
<?=$this->load->view('template/inner_footer.php')?>      