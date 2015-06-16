 <?=$this->load->view('template/inner_header_discover.php')?>
  <?php $usd = $this->session->userdata('logged_user'); ?>

<script type="text/javascript" src="<?=base_url()?>js/jquery-ui.min.js"></script>  
<script type="text/javascript" src="<?=base_url()?>js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/jquery.hoverIntent.minified.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/jquery.naviDropDown.js"></script>
<script type="text/javascript">
$(function(){
	
	$('#navigation_horiz').naviDropDown({
		dropDownWidth: '300px',
        slideDownDuration: 500, 
        slideUpDuration: 500
	});
	
	$('#navigation_vert').naviDropDown({
		//dropDownWidth: '300px',
		orientation: 'vertical',
        slideDownDuration: 500, 
        slideUpDuration: 500
	});
});
</script>

<script type="text/javascript">
$(document).ready(function() {
    $("#content").find("[id^='tab']").hide(); // Hide all content
    $("#tabs li:first").attr("id","current"); // Activate the first tab
    $("#content #tab1").fadeIn(); // Show first tab's content
    
    $('#tabs a').click(function(e) {
        e.preventDefault();
        if ($(this).closest("li").attr("id") == "current"){ //detection for current tab
         return;       
        }
        else{             
          $("#content").find("[id^='tab']").hide(); // Hide all content
          $("#tabs li").attr("id",""); //Reset id's
          $(this).parent().attr("id","current"); // Activate this
          $('#' + $(this).attr('name')).fadeIn(); // Show content for the current tab
        }
    });
});
</script>

<script type="text/javascript">
$(document).ready(function () {
    $('#chkBoxHelp').click(function () {
        if ($(this).is(':checked')) {
            $(".txtAge").dialog({
                close: function () {
                    $('#chkBoxHelp').prop('checked', false);
                }
            });
        } else {
            $(".txtAge").dialog('X');
        }
    });
});
</script>

  <script type="text/javascript">
                $(document).ready(function () {
                   
                   $('#pit_work_vw').click(function () {
                        
                            $(".pit_work_dialog_vw").dialog({
                                close: function () {
                                    
                                     //$('#pit_work').data('clicked', false);
                                }
                            });
                        
                    });
                    
                    
                     $('#cancl_pit_vw').click(function () {
                       
                            $(".pit_work_dialog_vw").dialog('close');
                            
                        
                    }); 
                    
                });
                </script>
                
            <div class="content_part">
            	
                <div class="mid_content index_sec">
                
              <div class="pitchits_section pitchits_section_new pitchits_section_new3">
        
        <div class="filter_section">
        <form action="" method="post">
        <div class="filter_section_search">
        <input name="inputfield" type="text" value="" placeholder="Travel">
        <input name="search" type="button" value="">
        
        </div>
        <div class="filter_section_search_results">
        Search Results (100) <a href="#"><img src="<?=base_url()?>images/circle_edit.png" alt="" /></a>
		<input name="inputfield" type="text" value="">
        
        </div>
        </form>
        <div class="clear"></div>
        </div>
        
          <div class="pitchits_section_left">
          <div id="navigation_vert">
            <ul class="list" id="tabs">
<li id="current"><a href="#" name="tab1"><img src="<?=base_url()?>images/filter_icon01.png" alt="" /> Filter by Format <img src="<?=base_url()?>images/plus.png" alt="" class="right_flo" /></a>
<div class="dropdown wid250" id="dropdown_four">
<ul class="list">
<li><a href="#" name="tab1">Artwork</a></li>
<li><a href="#" name="tab1">Board Book</a></li>
<li><a href="#" name="tab1">Children’s Book</a></li>
<li><a href="#" name="tab1">Comic</a></li>
<li><a href="#" name="tab1">Graphic Novel</a></li>
<li><a href="#" name="tab1">Novel</a></li>
<li><a href="#" name="tab1">Novella</a></li>
<li><a href="#" name="tab1">Picture Book</a></li>
<li><a href="#" name="tab1">Poetry</a></li>
<li><a href="#" name="tab1">Script</a></li>
<li><a href="#" name="tab1">Short Story</a></li>
<li><a href="#" class="green_bg" name="tab1">Click to Search by Filters</a></li>
<li><a href="#" class="orange_bg" name="tab1">Click to Save for Multiple Filters</a></li>
</ul>
</div>
</li>
<li id="current"><a href="#" name="tab1"><img src="<?=base_url()?>images/filter_icon02.png" alt="" /> Filter by Type <img src="<?=base_url()?>images/plus.png" alt="" class="right_flo" /></a>

<div class="dropdown wid250" id="dropdown_four">
<ul class="list">
<li><a href="#">Fiction</a></li>
<li><a href="#">Non-Fiction</a></li>
<li><a href="#" class="green_bg">Click to Search by Filters</a></li>
<li><a href="#" class="orange_bg">Click to Save for Multiple Filters</a></li>
</ul>
</div>
</li>
<li id="current"><a href="#" name="tab1"><img src="<?=base_url()?>images/filter_icon03.png" alt="" /> Filter by Genre <img src="<?=base_url()?>images/plus.png" alt="" class="right_flo" /></a>

<div class="dropdown" id="dropdown_five">
<ul class="list">
<li><a href="#">Action &amp; Adventure</a></li>
<li><a href="#">Animals</a></li>
<li><a href="#">Art and Architecture</a></li>
<li><a href="#">Autobiography/Memoir</a></li>
<li><a href="#">Biography</a></li>
<li><a href="#">Children (7 Yrs and Under)</a></li>
<li><a href="#">Children (8-12 Yrs)</a></li>
<li><a href="#">Classics</a></li>
<li><a href="#">Cooking/Food</a></li>
<li><a href="#">Comedy</a></li>
<li><a href="#">Comics</a></li>
<li><a href="#">Computing</a></li>
<li><a href="#">Crafts/Hobbies</a></li>
<li><a href="#">Crime</a></li>
</ul>
<ul class="list">
<li><a href="#">Drama</a></li>
<li><a href="#">Economics</a></li>
<li><a href="#">Energy</a></li>
<li><a href="#">Entertainment</a></li>
<li><a href="#">Fantasy</a></li>
<li><a href="#">Government</a></li>
<li><a href="#">Health/Wellness</a></li>
<li><a href="#">Historical</a></li>
<li><a href="#">Home and Garden</a></li>
<li><a href="#">Horror</a></li>
<li><a href="#">Humor</a></li>
<li><a href="#">Language</a></li>
<li><a href="#">Military/War</a></li>
<li><a href="#">Music</a></li>
</ul>
<ul class="list">
<li><a href="#">Murder/Mystery</a></li>
<li><a href="#">Philosophy</a></li>
<li><a href="#">Poetry</a></li>
<li><a href="#">Politics</a></li>
<li><a href="#">Reference</a></li>
<li><a href="#">Religion</a></li>
<li><a href="#">Romance</a></li>
<li><a href="#">Science Fiction</a></li>
<li><a href="#">Sports and Fitness</a></li>
<li><a href="#">Teen</a></li>
<li><a href="#">Thrillers</a></li>
<li><a href="#">Travel</a></li>
<li><a href="#">Young Adult</a></li>
<li><a href="#">Westerns</a></li>
<li><a href="#" class="green_bg">Click to Search by Filters</a></li>
<li><a href="#" class="orange_bg">Click to Save for Multiple Filters</a></li>
</ul>
</div>
</li>
<li id="current"><a href="#" name="tab1"><img src="<?=base_url()?>images/filter_icon04.png" alt="" /> Multiple Filters <img src="<?=base_url()?>images/plus.png" alt="" class="right_flo" /></a>

<div class="dropdown" id="dropdown_five">
<ul class="list">
<li><a href="#">Filters by Format</a></li>
<li><a href="#">Fiction</a></li>
<li><a href="#">Non Fiction</a></li>
</ul>
<ul class="list">
<li><a href="#">Filters by Type</a></li>
<li><a href="#">Graphic Novel</a></li>
<li><a href="#">Novel</a></li>
<li><a href="#">Picture Book</a></li>
<li><a href="#">Short Story</a></li>
</ul>
<ul class="list">
<li><a href="#">Filters by Genre</a></li>
<li><a href="#">Action &amp; Adventure</a></li>
<li><a href="#">Murder Mystery</a></li>
<li><a href="#">Science Fiction</a></li>
<li><a href="#">Travel</a></li>
<li><a href="#" class="green_bg">Click to Search by Filters</a></li>
</ul>
</div>


</li>
<li><a href="#" name="tab5"><img src="<?=base_url()?>images/circle_edit.png" alt="" /> My Saved Searches</a></li>
            </ul>
            
            </div>
          </div>
          <div class="pitchits_section_right" id="content">
          
          
          	<div style="display: block;" id="tab1">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_new">
              <thead>
                <tr>
                  <th align="center" width="22%">Author</th>
                  <th align="center" width="25%">Title</th>
                  <th align="center" width="15%">Type</th>
                  <th align="center" width="18%">Format</th>
                  <th align="center" width="20%">Genre</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td align="center"><img src="<?=base_url()?>images/pro_01.png" alt="" /> Jay Gale</td>
                  <td align="center"><span id="pit_work_vw" style="cursor: pointer;">Tales from the Road</span></td>
                  <td align="center"> Non-Fiction</td>
                  <td align="center">Novel</td>
                  <td align="center">Action &amp; Adventure</td>
                </tr>
                <tr>
                  <td align="center"><img src="<?=base_url()?>images/pro_02.png" alt="" /> Stacy Clark</td>
                  <td align="center"><span id="pit_work_vw" style="cursor: pointer;">Jezebel's Adventures</span></td>
                  <td align="center">Fiction</td>
                  <td align="center">Graphic Novel</td>
                  <td align="center">Travel</td>
                </tr>
                <tr>
                  <td align="center"><img src="<?=base_url()?>images/pro_01.png" alt="" /> Fred Holmes</td>
                  <td align="center"><span id="pit_work_vw" style="cursor: pointer;">The Mean Streets</span></td>
                  <td align="center">Fiction</td>
                  <td align="center">Short Story</td>
                  <td align="center">Murder Mystery</td>
                </tr>
                <tr>
                  <td align="center"><img src="<?=base_url()?>images/pro_02.png" alt="" /> Lucy Gray</td>
                  <td align="center"><span id="pit_work_vw" style="cursor: pointer;">Lonesome Travel</span></td>
                  <td align="center">Non-Fiction</td>
                  <td align="center">Picture Book</td>
                  <td align="center">Travel</td>
                </tr>
                <tr>
                  <td align="center"><img src="<?=base_url()?>images/pro_01.png" alt="" /> Peter Smith</td>
                  <td align="center"><span id="pit_work_vw" style="cursor: pointer;">The Dark Side</span></td>
                  <td align="center">Fiction</td>
                  <td align="center">Novel</td>
                  <td align="center">Science Fiction</td>
                </tr>
                
              </tbody>
            </table>
           
           
           <!---------Popup dialog---------->
           
           <div class="pit_work_dialog_vw" style="display: none;" id="pit_work_dialog">
                  
                  <h4>Tales from the Road by Jay Gale was added on 12/16/11.</h4>

<p>Tags: Music, Adventure, Friendship, Brotherhood
This work has been reviewed and self published.
</p>

<h4>Excerpt</h4>

<p>About two young men on a journey across the world as musical roadies for the band U2.</p>

<h4>Synopsis</h4>

<p>The two main characters, Joe and John met in college through a mutual love of U2’s music. Instead of getting corporate jobs after receiving their business degrees, the two friends decide get jobs with the band U2 and travel the world and experience many interesting adventures along the way that teach them life long lessons about relationships and business.</p>
                  
                  
                    <a href="javascript:void(0);" class="green_but">Add to Bookshelf</a><a href="javascript:void(0);" id="cancl_pit_vw">Close</a>
                  </div>
           
           <!----------End------------------>
           
            
            
            </div>
          	<div style="display: block;" id="tab5">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_new">
              <thead>
                <tr>
                  <th align="center" width="30%">Search</th>
                  <th align="center" width="20%">Date</th>
                  <th align="center" width="20%">Titles Returned</th>
                  <th align="center" width="15%">View Search</th>
                  <th align="center" width="15%" class="center">Delete</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td align="center">Non Fiction Novels</td>
                  <td align="center">12/27/14</td>
                  <td align="center" class="center"> 75</td>
                  <td align="center" class="center"><input name="check" type="checkbox" value=""></td>
                  <td align="center" class="center"><input name="check" type="checkbox" value=""></td>
                </tr>
                <tr>
                  <td align="center">Fiction Graphic Novels</td>
                  <td align="center">12/10/14</td>
                  <td align="center" class="center"> 125</td>
                  <td align="center" class="center"><input name="check" type="checkbox" value=""></td>
                  <td align="center" class="center"><input name="check" type="checkbox" value=""></td>
                </tr>
                <tr>
                  <td align="center">Travel Books</td>
                  <td align="center">11/27/14</td>
                  <td align="center" class="center"> 122</td>
                  <td align="center" class="center"><input name="check" type="checkbox" value=""></td>
                  <td align="center" class="center"><input name="check" type="checkbox" value=""></td>
                </tr>
                <tr>
                  <td align="center">Science Fiction Adventures</td>
                  <td align="center">11/7/14</td>
                  <td align="center" class="center"> 15</td>
                  <td align="center" class="center"><input name="check" type="checkbox" value=""></td>
                  <td align="center" class="center"><input name="check" type="checkbox" value=""></td>
                </tr>
                <tr>
                  <td align="center">Sports and Fitness Books</td>
                  <td align="center">10/20/14</td>
                  <td align="center" class="center"> 38</td>
                  <td align="center" class="center"><input name="check" type="checkbox" value=""></td>
                  <td align="center" class="center"><input name="check" type="checkbox" value=""></td>
                </tr>
                
              </tbody>
            </table>
            </div>
            
          </div>
          <div class="button_right"><a href="#" class="green_but">PREVIOUS</a> <a href="#" class="blue_but">VIEW MORE</a></div>
          <div class="clear"></div>
        </div>
                  
                    
                </div>
                <div class="clear"></div>
                
<?=$this->load->view('template/search.php')?>         
                
<?=$this->load->view('template/inner_footer.php')?>             

