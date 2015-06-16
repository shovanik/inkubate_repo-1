 <?=$this->load->view('template/inner_header.php')?>
  <?php $usd = $this->session->userdata('logged_user'); ?>
  <!--start slider-->

<link rel="stylesheet" href="<?=base_url()?>style/inner/jquery.bxslider.css" type="text/css" />

<script type="text/javascript" src="<?=base_url()?>js/jquery.bxslider.js"></script>

<script>
$(document).ready(function(){
  $('.slider1').bxSlider({
    slideWidth: 200,
    minSlides: 1,
    maxSlides: 3,
    slideMargin: 10
  });
});
</script>
<!--end slider-->

<script>
 BASE = "<?=base_url()?>";
    
   function single_work(wid){
        
        //alert(wid);
        var favorite = wid;
        $('.pic_con .active01').removeClass('active01');
        $('#div_work_'+favorite).addClass('active01');
        
        
       
         $.ajax({
           url      : '<?=base_url()?>'+'work/work_dtls',
           type     : 'POST',
           data     : { 'id':favorite },
           success  : function(data){
                var p;
                var q;
                    var ps = data.messages;
                    var qs = data.cat;
                    var html='';
                    //var pg = parseInt(page) + 1;
                    console.log(qs);
                    //console.log(data);
                    //alert(data.status);
                    //var count = parseInt(data['count']);
                    if(data.status == "true")
                    {
                    	//alert("jasfkjsd");
                        for (var i = 0, p; p = ps[i++];) 
                        {
                            html += '<div class="bookself_top">';
                            html += '<span class="sec_left"><label class="leb_left">'+p.title+'</label>';
                            html += '<div class="clear"></div>';
                            html += '</span>';
                            html += '<div class="clear"></div>';
                            html += '</div>';
                            
                            
                            html += '<div class="col-left"><br>';
                            html += '<a href="#" id="single_image" class="overlay-iframe_dynamic">';
                            
                            if(p.photo != "") { 
                            html += '<img src="'+BASE+'uploadImage/'+p.user_id+'/cover_image/medium/'+p.photo+'">';
                            } else { 
                            html += '<img src="'+BASE+'images/img_default_cover.png">';
                            } 
                            
                            html += '</a>';
                            html += '</div>';
                            
                            html += '<div class="col-center">';
                            html += '<h3 class="synopsis">Synopsis</h3>';
                            html += '<div class="display-field">';
                            html += '<p class="col_con">';
                            
                            if(p.synopsis != "") { 
                                
                            var varTitle = $('<textarea />').html(p.synopsis).text();
                                
                            html += varTitle;
                             } else { 
                            html += 'No Synopsis';
                            } 
                            
                            html += '</p>';
                            html += '</div>';
                            html += '<h3 class="extract">Excerpt</h3>';
                            html += '<div class="display-field">';
                            html += '<p class="col_con">';
                            
                            if(p.extract != "") { 
                                
                            var varextract = $('<textarea />').html(p.extract).text(); 
                                
                            html += varextract;
                            } else { 
                            html += 'No Excerpt';
                            } 
                            
                            html += '</p></div>';
                            html += '<h3 class="attachment">Download Manuscript</h3>';
                            html += '<div class="display-field">';
                            html += '<span class="file-upload-names">';
                            
                            if(p.file_asset_id != "") { 
                            html += '<a href="'+BASE+'discovery/download/'+p.id+'/'+p.file_asset_id+'/'+p.user_id+'/'+p.work_file+'" style="color: #70a1df;">'+p.work_file+'</a>';
                             }
                            html += '</span></div>';
                            html += '<a href="#bookshelf" rel="facebox">';
                            html += '<input name="button" type="button" value="Add to Bookshelf" class="btn_viw"/>';
                            html += '</a></div>';
                            
                            html += '<div class="col-right">';
                            html += '<h3>Author</h3>';
                            html += '<div class="display-field">';
                            html += '<span style="color:#3c97ff; padding:0 10px; cursor: pointer;">'+p.name;
                            html += '</div><br/>';
                            html += '<h3>Type</h3>';
                            html += '<div class="display-field">'+p.type_name;
                            html += '</div><br/><h3>Genre</h3>';
                            html += '<div class="display-field">'+p.form_name;
                            html += '</div><br/><h3>Categories</h3>';
                            html += '<div class="display-field">';
                            html += '<ul style="padding-left: 16px;">';
                            
                            for (var j = 0, q; q = qs[j++];) 
                            {
                            html += '<li style="list-style-type: disc;">'+q.tag_name+'</li>';
                            }
                            
                            html += '</ul></div><br/>';
                            html += '<h3>Self Published</h3>';
                            html += '<div class="display-field">';
                            if(p.self_published == 1) { 
                            html += 'Yes';
                            } else { 
                            html += 'No';
                            } 
                            html += '</div><br/><h3>Reviewed</h3>';
                            html += '<div class="display-field">';
                            if(p.been_reviewed == 1) { 
                            html += 'Yes';
                            } else { 
                            html += 'No';
                            } 
                            html += '</div><br/><h3>Upload Date</h3>';
                            html += '<div class="display-field">';
                            html += p.create_date;
                            html += '</div></div><div class="clear"></div>';
    
                       
                           
                        }
                        $("#work_dtls").html(html);
                      
                   } 
           },
           error    : function(resp){
                $.prompt("Sorry, something isn't working right.", {title:'Error'});
           }
          });   
        
   }
 
 </script>  

<script>
function delete_bookshelf_book()
{
    if(confirm("Are you sure you want to delete this from Bookshelf?")){  
        window.location.href = '<?=base_url()?>bookshelves/delete_books/'+id+'/'+bid; 
       }
       else { return false; } 
}
</script>

<style>
.bx-wrapper .bx-pager .bx-pager-item, .bx-wrapper .bx-controls-auto .bx-controls-auto-item{display:none;}
.bx-wrapper{max-width:100%!important;}
.mid_content{margin-top:0;}

#facebox .content {
    
    height: 170px !important;
    }
.para_lft
{
   clear: both; 
   margin-left: 13px; 
}    
</style>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>style/inner/select.css" />


            <div class="content_part">
            	<div class="top_content">
                <div class="top_left_con">
                <h2>Bookshelf: <span><?php echo $bookself_name['name'];?></span></h2>
                <span class="top_left_icon">
               <a href="<?=base_url()?>bookshelves/booklist/<?=$this->uri->segment(4)?>"><img alt="" src="<?=base_url()?>images/list_view.png" /></a>
                 <a href="<?=base_url()?>work/carousel/<?=$this->uri->segment(3)?>/<?=$this->uri->segment(4)?>"><img alt="" src="<?=base_url()?>images/discevory_view.png" /></a>
                </span>
                </div>
                <div class="top_right_con">
                <a href="<?=base_url()?>bookshelves">View all Bookshelves</a>
                </div>
                </div>
                <div class="clear"></div>
                
           <div id="carousel">
                <div class="slider1">
                        <?php 
                        
                        //echo '<pre/>';print_r($workdetails_total);die;
                        if(!empty($workdetails_total))
                        {
                            //$count = count($workdetails_total);
                            //for($i=$count-1;$i>=0;$i--){
                            //$v = krsort($workdetails_total);
                            //$total_work = $workdetails_total[$i]; 
                            $count = 0;
                            foreach($workdetails_total as $key=>$total_work)
                            {
                        ?>
                        <div class="slide">
                            <div class="pic_con <?php if($key == '0') { ?>active01<?php } ?>" onclick="single_work(<?=$total_work['Wid']?>)" id="div_work_<?=$total_work['Wid']?>">
                            <div class="slide_img">
                                <?php if($total_work['photo'] != '') {?>
                                <img src="<?=base_url()?>uploadImage/<?=$total_work['user_id']?>/cover_image/medium/<?=$total_work['photo']?>"/>
                                <?php } else { ?>
                                <img src="<?=base_url()?>images/img_default_cover.png"/>
                                <?php } ?>
                                </div>
                                
                                <div class="slide_img_text">
                                <h2 class="slide_img_h"><?=$total_work['title']?></h2>
                                <span class="author_1">by <?=$total_work['name']?></span><br />
                                <span class="function_t">
                                    <?=$total_work['type_name']?><br/>
                                    <?=$total_work['form_name']?><br/>
                                    </span>
                                    <div class="clear"></div>
                                    <a href="#" class="delete_btn" onclick="delete_bookshelf_book(<?=$total_work['wcid']?>)">Delete</a>
                                </div>
                                
                             </div>
                          </div>
                          <?php 
                          $count++;
                          } } 
                          $j = 3 - $count;
                          ?> 
                          <?php for($i=0;$i<$j&& $j > 0;$i++){ ?>
                          <div class="slide">&nbsp;</div>   
                           <?php } ?>   
                             
                           
                        </div> 
 
 </div>    
        <div class="mid_content index_sec" style="padding:25px; border-top:0;"  id="work_dtls">
         
         
         
         
         
         
          <?php 
          //echo '<pre/>';print_r($workdetails_test);
          foreach($workdetails_test  as $workdetails)
          {
          ?>
          <div class="bookself_top">
          <span class="sec_left"><label class="leb_left"><?=$workdetails['title']?></label> 
          <div class="clear"></div>
          </span>
          
          <div class="clear"></div>
          </div> 
       
    
<!--##################################################################################################-->


   <div class="col-left">
            <br/>
            <a href="#" id="single_image" class="overlay-iframe_dynamic">
            <?php if($workdetails['photo'] != '') {?>
            <img src="<?=base_url()?>uploadImage/<?=$workdetails['user_id']?>/cover_image/medium/<?=$workdetails['photo']?>"/>
            <?php } else { ?>
            <img src="<?=base_url()?>images/img_default_cover.png"/>
            <?php } ?>
            </a> 
            
            
    </div>
    
    
    
    <div class="col-center">
        <h3 class="synopsis">
            Synopsis</h3>
        <div class="display-field">
            <p class="col_con">
            <?php 
            if($workdetails['synopsis'] != '')
            {
            echo html_entity_decode($workdetails['synopsis'], ENT_QUOTES, 'UTF-8');
            }
            else
            {
              echo 'No Synopsis';  
            }
            ?></p>

        </div>
        <h3 class="extract">
            Excerpt</h3>

        <div class="display-field">
            <p class="col_con">
            <?php 
            if($workdetails['extract'] != '')
            {
            echo html_entity_decode($workdetails['extract'], ENT_QUOTES, 'UTF-8');
            }
            else
            {
             echo 'No Excerpt';   
            }
            ?></p>

        </div>
        <h3 class="attachment">Download Manuscript</h3>
        <div class="display-field">
            <span class="file-upload-names">
                <?php if($workdetails['file_asset_id'] != '') {?>
                <a href="<?=base_url()?>discovery/download/<?=$workdetails['id']?>/<?=$workdetails['file_asset_id']?>/<?=$workdetails['user_id']?>/<?=$workdetails['work_file']?>" style="color: #70a1df;"><?=$workdetails['work_file']?></a>
                <?php } ?>
            </span>
            <div class="b_sec_left"> 
           <a href="#bookshelf" rel="facebox"> 
          <img src="<?=base_url()?>images/plus_btn.png" alt="" class="plus_img1" />
         <input type="button" value="Add New Bookshelf" class="b_btn_left" id="">
         </a>
          </div>
        </div>
       
       <!--<a href="#bookshelf" rel="facebox">
            <input name="button" type="button" value="Add to Bookshelf" class="btn_viw"/>
       </a>--> 
        
    </div>
    
    
    
       <div class="col-right">
        
        <h3>Author</h3>
        <div class="display-field">
            <span style="color:#3c97ff; padding:0 10px; cursor: pointer;"><?php echo $workdetails['name'];?>
        </div>
        <br/>
        <h3>Type</h3>
        <div class="display-field">
            <?php echo $workdetails['type_name'];?>
        </div>
        <br/>
            <h3>Genre</h3>
            <div class="display-field">
                <?php echo $workdetails['form_name'];?>
            </div>  
            <br/>
        <h3>Categories</h3>
        <div class="display-field">
            <ul style="padding-left: 16px;">
            
            <?php 
            $user_book_tag = $this->mbookshelf->get_book_tag($workdetails['id']);
            if(!empty($user_book_tag))
                {
                    foreach($user_book_tag as $tag)
                 {
             ?>       
            <li style="list-style-type: disc;"><?php echo $tag['tag_name'];?></li>
            <?php
             
             } } 
             ?>
             
            </ul>
        </div>
        <br/>
        <!--<h3>Tags</h3>
        <div class="display-field">
          <?php 
            /*$user_book_tag = $this->mbookshelf->get_book_tag($workdetails['id']);
            if(!empty($user_book_tag))
                {
                    foreach($user_book_tag as $tag)
                 {
            
             echo $tag['tag_name'].', ';
             
             } } */?>     
      </div>
        <br/>-->
        <h3>Self Published</h3>
        <div class="display-field">
            <?php if($workdetails['self_published'] == 1) { echo 'Yes'; }else { 'No';}?>
        </div>
        <br/>
        <h3>Reviewed</h3>
        <div class="display-field">
            <?php if($workdetails['been_reviewed'] == 1) { echo 'Yes'; }else { 'No';}?>
        </div>
        <br/>
        <h3>Upload Date</h3>
        <div class="display-field">
           <?php echo date('m/d/Y',strtotime($workdetails['create_date']));?>
        </div>
    </div>    
    
    
    
                
                    <div class="clear"></div>
                    
                  
                    
                </div>
               
               <?php } ?> 
                
                <div class="clear"></div>
                
 <div id="bookshelf" style="display:none;">
 <h2>Add to Bookshelf</h2>
 <?php
   $frmAttrs   = array("id"=>'addBookshelf',"class"=>'form-horizontal',"name"=>'myform');
   echo form_open('bookshelves/addToBookShelves', $frmAttrs);
 ?>
 <div style="width: 100%;">
 <span style="float: left; padding-right: 10px;">
<div class="styled-select">
   <select name="bkself_id" id="bkself_id">
      <option value="0">Select</option>
      <?php 
      $bself_list = $this->mbookshelf->get_bookshelf();
      //echo '<pre/>';print_r($bself_list);die;
      if(!empty($bself_list))
      {
       foreach($bself_list as $blist)
       {
      ?>
      <option value="<?=$blist['id']?>"><?=$blist['name']?></option>
      <?php } } ?>
   </select>
</div>
  </span>                          
 <span style="float: left;">
 <input type="hidden" name="wid" id="wid" value="<?=$this->uri->segment(3)?>" />
 <input name="button" class="add_bkslf" type="submit" value="Add"  />
 </span>
 <div class="clear"></div>
 </div>
 </form> 
 
  </div>
                 
                
<?=$this->load->view('template/inner_footer.php')?>             

