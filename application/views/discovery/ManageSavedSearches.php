 <?=$this->load->view('template/inner_header_discover.php')?>
  <?php $usd = $this->session->userdata('logged_user'); ?>

<script src='<?=base_url()?>js/jquery-ui-1.10.2.custom.js'></script>
 <link href='<?=base_url()?>style/inner/jquery-ui-1.8.21.custom.css' rel='stylesheet' />
  
 <script type="text/javascript">
		$(document).ready( function() {
      //alert('hi');
       
      $("#start_date").datepicker({
       dateFormat : 'yy-m-d'
      })
       $("#end_date").datepicker({
       dateFormat : 'yy-m-d'
   })  
        
   })
 </script>

<script>

  function del(id)
  { 
        //var del = $(this).val();
        //alert(id);
        
         $.ajax({
           url      : '<?=base_url()?>'+'bookshelves/delete_bookshelf',
           type     : 'POST',
           data     : { 'id': id },
           success  : function(resp){
            //alert(resp);
                if(resp != '0'){
                    $("#book_shelf").html(resp);
                    //$("#edit_class" ).dialog( "close" );
                }
           },
           error    : function(resp){
                $.prompt("Sorry, something isn't working right.", {title:'Error'});
           }
        });
           
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
        },
        onRenderComplete : function(){
            //getRatingProduct();
            //getMerchantProductRating();
        },
        history:false
    });

</script>

<script type="text/javascript">
		$(document).ready( function() {
            
           
         //$("#txtEditor").Editor(); 
         //$("#txtEditor22").Editor();
         
         
         $('#Fiction').click(function(){
            
            
            var fiction = $('#Fiction').val();
            //alert(fiction);
            
            $.ajax({
           url      : '<?=base_url()?>'+'work/details',
           type     : 'POST',
           data     : { 'id': fiction },
           success  : function(resp){
            //alert(resp);
                if(resp != '0'){
                    $("#work_form").html(resp);
                    //$("#edit_class" ).dialog( "close" );
                }
           },
           error    : function(resp){
                $.prompt("Sorry, something isn't working right.", {title:'Error'});
           }
        });
            
            
  });
         
          $('#NonFiction').click(function(){
            
           //alert('hi');
           
           var nonfiction = $('#NonFiction').val();
            //alert(fiction);
            
            $.ajax({
           url      : '<?=base_url()?>'+'work/details',
           type     : 'POST',
           data     : { 'id': nonfiction },
           success  : function(resp){
            //alert(resp);
                if(resp != '0'){
                    $("#work_form").html(resp);
                    //$("#edit_class" ).dialog( "close" );
                }
           },
           error    : function(resp){
                $.prompt("Sorry, something isn't working right.", {title:'Error'});
           }
        });
           
            
         })
        
      
       
    });
    
  
  </script>
  
  <script>
 BASE = "<?=base_url()?>";
  
   function del_save_search(favorite){
        
        //alert('hi');
        //var favorite = $('#search_id').val();
        //var d = new Date('2015-01-08 04:54:09');
        //alert(d);
       
       if(confirm('Are you sure to delete this saved search?'))
       {
         $.ajax({
           url      : '<?=base_url()?>'+'discovery/delete_saved_search',
           type     : 'POST',
           data     : { 'id':favorite },
           success  : function(data){
            
            //alert(data);
            
                var p;
                    var ps = data.messages;
                    var html='';
                    //var pg = parseInt(page) + 1;
                    console.log(ps);
                    //console.log(data);
                    //alert(data.status);
                    //var count = parseInt(data['count']);
                    if(data.status == "true")
                    {
                    	//alert("jasfkjsd");
                        for (var i = 0, p; p = ps[i++];) 
                        {
                            html += '<tr class="itemld">';
                            html += '<td width="70%" align="left">';
                            html += ' <a href="'+BASE+'bookshelves/savedSearch/'+p.search_form_id+'">';
                            html += '<span class="spn">';
                            html += '<h3 class="str">'+p.saved_search_name+'</h3>';
                            html += '</span>';
                            html += '</a>';
                            html += '<span style="float: left;">Work Form :'+p.work_form_name+'</span>';
                            html += '<p class="parlf">saved on '+p.create_date+'</p>';
                            html += '</td>';
                            html += '<td width="30%" align="center">';
                            html += '<input name="button" type="button" value="delete" class="btn_viw" style="margin-right: 0 !important; margin-left: 30px;" onclick="del_save_search('+p.id+')"/>';
                            html += '</td>';
                            html += '</tr>';
                           
                        }
                        $("#book_shelf").html(html);
                        /*$("#paginate").html(data.pagination);
                         $('#checkbox67').each(function() { //loop through each checkbox
                                                this.checked = false; //deselect all checkboxes with class "checkbox1"    
                                               
                                                           
                        });*/ 
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

            <div class="content_part">
            	
                <div class="mid_content index_sec">
                
                <div class="bookslf_menu">
                
                   <ul>
                        <li><a href="#bookshelf_format" rel="facebox">Formats</a></li>
                        <li><a href="#bookshelf_writer" rel="facebox">Writers</a></li>
                        <li><a href="#bookshelf_search" rel="facebox">Search</a></li>
                        <li><a href="#bookshelf_saved" rel="facebox">My Saved Searches</a></li>
                    </ul>
                   <div class="clear"></div>
                </div>
                
                
                
          <div class="bookself_top">
         
          <span class="sec_left"><label class="leb_left"><img src="<?=base_url()?>images/work_img.png" alt="" /></label><label class="leb_left">Saved Searches</label> 
          <div class="clear"></div>
          </span>
          
          <div class="clear"></div>
          </div> 
          
          
      <div class="contact_conternt_manage">      
                    
                    <div class="pitchits_section_right work_section change_width"> 
      
      <div id="full_content_div">
      
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_new">
       
        <tbody id="book_shelf">
          
          <?php 
               //echo '<pre/>';print_r($discovery);die;
               if(!empty($discovery))
                {
                $i =1;    
                 foreach($discovery as $details)
                 {
               
                 //$user_book_self = $this->mbookshelf->get_user_book_self($details['id']);
               ?>
          
          <tr class="itemld">
            
            <td width="70%" align="left">
            <a href="<?=base_url()?>bookshelves/savedSearch/<?php echo $details['search_form_id'];?>">
            <span class="spn">
            <h3 class="str"><?php echo $details['saved_search_name'];?></h3>
            </span>
            </a>
            <span style="float: left;">Work Form : <?php echo $details['work_form_name'];?></span>
            <p class="parlf">saved on <?php echo date('m/d/Y',strtotime($details['create_date']));?></p>
          
            </td>
            
            <td width="30%" align="center">
            
            <input name="button" type="button" value="delete" class="btn_viw" style="margin-right: 0 !important; margin-left: 30px;" onclick="del_save_search(<?php echo $details['id'];?>)"/>
            
            </td>
            
          </tr>
          
          
          <?php  }  ?>
          
          <!--<tr class="paginate pagination3"><td><?//=$this->pagination->create_links()?><?//=$this->ajax_pagination->create_links()?></td></tr> -->
          
          <?php } else { ?>
                <tr>
                <td width="10%" align="center"></td>
                <td width="80%" align="center"><p>Sorry! There are no Saved Search.</p></td>
                <td width="10%" align="center"></td>
                
                </tr>
                <?php } ?>
        </tbody>
       </table>
      </div>
    </div>
    
    </div>
    
<?//=$this->load->view('template/search_right.php')?>     
     
                    
                    <div class="clear"></div>
                    
                  
                    
                </div>
                <div class="clear"></div>
                
<?=$this->load->view('template/search.php')?>         
                
<?=$this->load->view('template/inner_footer.php')?>             

