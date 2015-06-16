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
.fict_pan_gnre {width:48%; float:left;}
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
.url_link { color: #39302c;}
.name_con a {color: #39302c !important;}
.pub_con a {color: #39302c !important;}
.pub_con_2 a {color: #39302c !important;}
.pub_con_22 a {color: #39302c !important;}
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
                    <img src="<?=base_url()?>uploadImage/<?=$user_id;?>/profile/<?=$user_photo['filename']?>"/>
                </div> 
                <?php } else {?>
                   <div class="profile_pic_2">
                    <img src="<?=base_url()?>images/img_default_headshot.png">
                   </div>
                 <?php } ?>   
                  <div class="clear"></div>
                
                <!--<div style="width:150px !important;">


             <?php $fb = $this->mprofile->get_user_web_link(1);
             if(!empty($fb['url'])) { 
               //echo $fb['url']; 
             ?>
             <span style="padding-right:17px"><a href="<?php echo $fb['url'];?>"><img src="<?=base_url()?>images/fb.png" alt=""></a></span>
             <?php } else {?>
             
             <span style="padding-right:17px"><img src="<?=base_url()?>images/fb.png" alt="No Facebook Link" title="No Facebook Link" ></span>
             
             <?php } ?>

			 <?php $rss = $this->mprofile->get_user_web_link(3);
             if(!empty($rss['url'])) { 
             ?>
             <span style="padding-right:17px"><a href="<?php echo $rss['url'];?>"><img src="<?=base_url()?>images/g+.png" alt=""></a></span>
             <?php } else {?>
             <span style="padding-right:17px"><img src="<?=base_url()?>images/g+.png" alt="No Google+ Link" title="No Google+ Link"></span>
             <?php } ?> 
             
             <?php $twt = $this->mprofile->get_user_web_link(2);
             if(!empty($twt['url'])) { 
             ?>
             <span style="padding-right:17px"><a href="<?php echo $twt['url'];?>"><img src="<?=base_url()?>images/tw.png" alt=""></a></span>
             <?php } else {?>
             <span style="padding-right:17px"><img src="<?=base_url()?>images/tw.png" alt="No Twitter Link" title="No Twitter Link"></span>
             <?php } ?>
             
             <?php $linkin = $this->mprofile->get_user_web_link(5);
             if(!empty($linkin['url'])) { 
             ?>
             <span><a href="<?php echo $linkin['url'];?>"><img src="<?=base_url()?>images/in.png" alt=""></a></span>
            
             <?php } else{?>
             <span><img src="<?=base_url()?>images/in.png" alt="No LinkedIn Link" title="No LinkedIn Link"></span>
             <?php } ?> 


                </div>-->

                
          </div>
          
          <div class="profile_right2">
          
           <span class="name_con">
             <a class="tooltips" href="javascript:void(0)" >
                          
             <?php if(!empty($user_contact['name_first'])) { $name = $user_contact['name_first']; } ?> <?php if(!empty($user_contact['name_last'])) { $name.=' '.$user_contact['name_last']; }  if(strlen($name) > 15)
                                                {
                                                   echo substr($name,0,15).'..';
                                                }
                                                else
                                                {
                                                    echo $name;
                                                }?> 
                <span class="tp_span2"> <?php if(!empty($user_contact['name_first'])) { echo $user_contact['name_first']; } ?> <?php if(!empty($user_contact['name_last'])) { echo $user_contact['name_last']; } ?></span>
                 <div class="clear"></div>
                
                </a> 
             </span>
             <span class="pub_con_1">Joined <?php if(!empty($user_contact['created'])) { echo date('Y', strtotime($user_contact['created'])); } ?></span>
             <span class="pub_con_1">
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

           <span class="pub_con">
             <a class="tooltips" href="javascript:void(0)" >
                          
             <?php if(!empty($user_contact['email'])) { if(strlen($user_contact['email']) > 22)
                                                {
                                                   echo substr($user_contact['email'],0,22).'..';
                                                }
                                                else
                                                {
                                                    echo $user_contact['email'];
                                                } } else { echo 'No Email'; }?>
                <span class="tp_span2"> <?php if(!empty($user_contact['email'])) { echo $user_contact['email']; } else { echo 'No Email'; }?></span>
                 <div class="clear"></div>
                
                </a> 
             </span>

           <span class="pub_con">
             <a class="tooltips" href="javascript:void(0)" >
                          
             <?php if(!empty($user_contact['company_name'])) { if(strlen($user_contact['company_name']) > 22)
                                                {
                                                   echo substr($user_contact['company_name'],0,22).'..';
                                                }
                                                else
                                                {
                                                    echo $user_contact['company_name'];
                                                } } else { echo 'No Company'; }?>
                <span class="tp_span2"> <?php if(!empty($user_contact['company_name'])) { echo $user_contact['company_name']; } else { echo 'No Company'; }?></span>
                 <div class="clear"></div>
                
                </a> 
             </span>

             <div class="clear"></div>
             
             
             <?php 
             $address = $user_contact['address'];
               if(!empty($address)) { if(strlen($address) > 28)
                                                {                                 
             ?>
             
             <span class="pub_con pub_address">
              <a class="tooltips" href="javascript:void(0)" >
              <?php 
               $address = $user_contact['address'];
               if(!empty($address)) { if(strlen($address) > 28)
                                                {                                 
                                    echo substr($address,0,28).'..';
                                                }
                                                else
                                                {
                                                    echo $address;
                                                } 
                                                } 
                              else { echo 'No Address'; }
             ?>
                <span class="tp_span2"> <?php if(!empty($user_contact['address'])) { echo $user_contact['address']; } else { echo 'No Address'; }?></span>
                 <div class="clear"></div> 
                 </a>            
             </span>
             
             <?php } else { ?>
             
             <span class="pub_con">
              <a class="tooltips" href="javascript:void(0)" >
              <?php 
             $address = $user_contact['address'];
               if(!empty($address)) { if(strlen($address) > 28)
                                                {                                 
                                    echo substr($address,0,28).'..';
                                                }
                                                else
                                                {
                                                    echo $address;
                                                } 
                                                } 
                              else { echo 'No Address'; }
             ?>
                <span class="tp_span2"> <?php if(!empty($user_contact['address'])) { echo $user_contact['address']; } else { echo 'No Address'; }?></span>
                 <div class="clear"></div> 
                 </a>            
             </span>
             
             <?php } } ?>


       <?php if(!empty($user_contact['city'])) { if(strlen($user_contact['city']) > 20)
                                                {
                                               
                                            ?>        

             <span class="pub_con_2 pub_city">
             <a class="tooltips" href="javascript:void(0)" >
                <?php if(!empty($user_contact['city'])) { if(strlen($user_contact['city']) > 20)
                                                {
                                                   echo substr($user_contact['city'],0,20).'..';
                                                }
                                                else
                                                {
                                                    echo $user_contact['city'];
                                                } 
                                                } 
                     else { echo 'No City'; }?>
                                                                <span class="tp_span2"> <?php if(!empty($user_contact['city'])) { echo $user_contact['city']; } else { echo 'No City'; }?></span>
                 <div class="clear"></div> 
                 </a>
                 </span>
                 
               <?php } else { ?>
               
               <span class="pub_con_2">
             <a class="tooltips" href="javascript:void(0)" >
                <?php if(!empty($user_contact['city'])) { if(strlen($user_contact['city']) > 20)
                                                {
                                                   echo substr($user_contact['city'],0,20).'..';
                                                }
                                                else
                                                {
                                                    echo $user_contact['city'];
                                                } 
                                                } 
                     else { echo 'No City'; }?>
                                                                <span class="tp_span2"> <?php if(!empty($user_contact['city'])) { echo $user_contact['city']; } else { echo 'No City'; }?></span>
                 <div class="clear"></div> 
                 </a>
                 </span>
               
               <?php } } ?>
                 
             <span class="pub_con_23"><a class="tooltips" href="javascript:void(0)" ><?php if(!empty($user_contact['state'])) { if(strlen($user_contact['state']) > 10)
                                                {
                                                   echo substr($user_contact['state'],0,10).'..';
                                                }
                                                else
                                                {
                                                    echo $user_contact['state'];
                                                } } else { echo 'No State'; }?>
                                                                <span class="tp_span2"> <?php if(!empty($user_contact['state'])) { echo $user_contact['state']; } else { echo 'No State'; }?></span>
                 <div class="clear"></div> 
                 </a></span>
             <span class="pub_con_23"><a class="tooltips" href="javascript:void(0)" ><?php if(!empty($user_contact['postal_code'])) { if(strlen($user_contact['postal_code']) > 10)
                                                {
                                                   echo substr($user_contact['postal_code'],0,10).'..';
                                                }
                                                else
                                                {
                                                    echo $user_contact['postal_code'];
                                                } } else { echo 'No Postal..'; }?>
                                                                <span class="tp_span2"> <?php if(!empty($user_contact['postal_code'])) { echo $user_contact['postal_code']; } else { echo 'No Postal Code'; }?></span>
                 <div class="clear"></div> 
                 </a></span>
             
             <?php 
             $user_country = $this->mprofile->get_user_country($user_contact['country']);
             if(!empty($user_country)) { if(strlen($user_country['country_name']) > 15)
                                                {
             ?>    
             
             <span class="pub_con_23 pub_country"><a class="tooltips" href="javascript:void(0)" >
             <?php 
             $user_country = $this->mprofile->get_user_country($user_contact['country']);
             if(!empty($user_country)) { if(strlen($user_country['country_name']) > 15)
                                                {
                                                   echo substr($user_country['country_name'],0,15).'..';
                                                }
                                                else
                                                {
                                                    echo $user_country['country_name'];
                                                } 
                                                } else { echo 'No Country'; }
                                                ?>
                <span class="tp_span2"> <?php if(!empty($user_country['country_name'])) { echo $user_country['country_name']; } else { echo 'No country'; }?></span>
                 <div class="clear"></div> 
                 </a>
                 </span>
                 
                <?php } else { ?>
                
                <span class="pub_con_23"><a class="tooltips" href="javascript:void(0)" >
             <?php 
             $user_country = $this->mprofile->get_user_country($user_contact['country']);
             if(!empty($user_country)) { if(strlen($user_country['country_name']) > 15)
                                                {
                                                   echo substr($user_country['country_name'],0,15).'..';
                                                }
                                                else
                                                {
                                                    echo $user_country['country_name'];
                                                } 
                                                } else { echo 'No Country'; }
                                                ?>
                <span class="tp_span2"> <?php if(!empty($user_country['country_name'])) { echo $user_country['country_name']; } else { echo 'No country'; }?></span>
                 <div class="clear"></div> 
                 </a>
                 </span>
                
                <?php } } ?> 
                         
             <span class="pub_con_5">
             <?php $oth = $this->mprofile->get_user_web_link(4); ?>
             <?php
             if(!empty($oth['url'])) { ?>
              <a class="tooltips" href="<?php echo $oth['url'];?>" >
              <?php } else { ?>
              <a class="tooltips" href="javascript:void(0)" >
              <?php } ?>
             <?php
             if(!empty($oth['url'])) { ?>
                 <?php if(strlen($oth['url']) > 30)
                                                {
                                                   echo substr($oth['url'],0,30).'..';
                                                }
                                                else
                                                {
                                                    echo $oth['url'];
                                                }?> 
             <?php   } else { echo 'No Web Url'; }
             ?>
                <span class="tp_span2"> <?php 
             if(!empty($oth['url'])) { ?>
                
               <?php echo $oth['url'];?> 
             <?php   } else { echo 'No Web Url'; }
             ?></span>
                 <div class="clear"></div>    
                 </a>         
             </span>

             <div class="clear"></div>
             
             <?php 
//             $user_id = $this->uri->segment(3);
//             $usd = $this->session->userdata('logged_user');
//             if($user_id == $usd['id']){
//                $fb = $this->mprofile->get_user_web_link(1);
//             }else{
//                $fb = $this->mprofile->getUserWebLinkById($user_id,1); 
//             }
             ?>
             <ul class="social_link">
             
             <li>
             <?php
              $fb = $this->mprofile->getUserWebLinkById($user_id,1); 
              if(!empty($fb['url'])) { 
             ?>
             <a href="<?php echo $fb['url'];?>"><img src="<?=base_url()?>images/fb.png" alt=""><?php echo $fb['url'];?></a>
             <?php } else {?>
             <img src="<?=base_url()?>images/fb.png" alt="">No Facebook
             <?php } ?>
             </li>
             
             <li>
             <?php
             $rss = $this->mprofile->getUserWebLinkById($user_id,3); 
             if(!empty($rss['url'])) {
             ?>
             <a href="<?php echo $rss['url'];?>"><img src="<?=base_url()?>images/g+.png" alt=""><?php echo $rss['url'];?></a>
             <?php } else {?>
             <img src="<?=base_url()?>images/g+.png" alt="">No Google+
             <?php } ?>
             </li>
             
             <li>
              <?php 
             $twt = $this->mprofile->getUserWebLinkById($user_id,2); 
             if(!empty($twt['url'])) { 
             ?>
             <a href="<?php echo $twt['url'];?>"><img src="<?=base_url()?>images/tw.png" alt=""><?php echo $twt['url'];?></a>
             <?php } else {?>
             <img src="<?=base_url()?>images/tw.png" alt="">No Twitter
             <?php } ?>
             </li>
             
             <li>
              <?php 
             $linkin = $this->mprofile->getUserWebLinkById($user_id,5); 
             if(!empty($linkin['url'])) { 
             ?>
             <a href="<?php echo $linkin['url'];?>"><img src="<?=base_url()?>images/in.png" alt=""><?php echo $linkin['url'];?></a>
             <?php } else {?>
             <img src="<?=base_url()?>images/in.png" alt="">No LinkedIn
             <?php } ?>
             </li>
             
             
             </ul>
             
             
             
             
             
              <div class="clear"></div>
             <span class="join_con1"><strong>Content Interest:</strong></span>
             <span class="fict_pan">
             
             <?php if(!empty($work_type_details)) { ?>
                
               <div class="fict_pan_in">
                 <span class="fc_pan">
                 
                  <?php  if($work_type_details['work_type_id'] == '1') { ?>
                 Fiction
                 <?php } else if($work_type_details['work_type_id'] == '2') {?>
                 Non-Fiction
                 <?php } else{?>
                 <p> No Type</p>
                 <?php }?>
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
//             if($user_id == $usd['id']){
//                $work_cat_details =  $this->mprofile->work_categ_details($usd['id']);
//             }else{
//                $work_cat_details = $this->mprofile->work_categ_details($user_id); 
//             }
             
            $work_cat_details = $this->mprofile->work_categ_details($user_id); 
            //echo '<pre>';print_r($work_cat_details);die;
            if(!empty($work_cat_details))
                   { 
                    foreach($work_cat_details as $catdetails) { ?>
              <span class="fict_pan">
              
               <div class="fict_pan_in" style="background:#8ac749">
                <span class="fc_pan"><?php echo $catdetails['category_name']?></span>
                <?php if($show_edit == 'Yes') {?>
                <span class="cls_pan">
                    <img src="<?=base_url()?>images/cross_2.png" alt="" onclick="catshow(<?php echo $catdetails['pcid']?>)">
                </span>
                <?php }?>

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
        <?php if($show_edit == 'Yes') {?>
        <div class="profuibutt_sec1">
              <?php if($usd['user_type'] == '1') { ?>
                <button class="upld_butt3" type="button" style="margin-right:27px; margin-top:18px;" onclick="revise()">Edit Profile</button>
                <button class="upld_butt3" style="background-color:#2e75b6; margin-top:18px;">View My Work</button>
                <?php } else {?>
                <button class="upld_butt3" type="button" style="margin-left: 223px; margin-top:18px;" onclick="revise()">Edit Profile</button>
                <?php } ?>
                <div class="clear"></div>
            </div>
        <?php }?>
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