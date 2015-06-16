<?=$this->load->view('template/header.php')?>

<script>
    $(document).ready(function() {

      var owl = $("#owl-demo"),
          status = $("#owlStatus");

      owl.owlCarousel({
        navigation : true,
        afterAction : afterAction
      });

      function updateResult(pos,value){
        status.find(pos).find(".result").text(value);
      }

      function afterAction(){
        updateResult(".owlItems", this.owl.owlItems.length);
        updateResult(".currentItem", this.owl.currentItem);
        updateResult(".prevItem", this.prevItem);
        updateResult(".visibleItems", this.owl.visibleItems);
        updateResult(".dragDirection", this.owl.dragDirection);
      }

    });
    </script>

           
            <div class="content_part">
            	
               
                <div class="team">
              
                	<div class="team_content">
                    <h2>Team</h2>
                    <p>Inkubate was born out of a belief that there is a smarter, easier way for the publishing industry to identify promising new work and bring it to market faster.</p>
                    <p>We invite you to join Inkubate and be part of the future of publishing - It’s better here.</p>
                    
                  <div class="team_content">
                  	<!--<div class="swiper-container">
                        <div class="swiper-wrapper">
                          <div class="swiper-slide red-slide">
                            <div class="title"><img src="images/stacy-clark.jpg"></div>
                          </div>
                          <div class="swiper-slide blue-slide">
                            <div class="title"><img src="images/erik-dodier.jpg"></div>
                          </div>
                          <div class="swiper-slide orange-slide">
                            <div class="title"><img src="images/greg-dumont.jpg"></div>
                          </div>
                          <div class="swiper-slide green-slide">
                            <div class="title"><img src="images/jay-gale.jpg"></div>
                          </div>
                          <div class="swiper-slide pink-slide">
                            <div class="title"><img src="images/tj-obrey.jpg"></div>
                          </div>
                          
                        </div>
                         <div class="pagination"></div>
 					</div>-->
                       <div id="owl-demo" class="owl-carousel">
                  
                            <div class="item">
                            	<div class="title">
                                	<img src="<?=base_url()?>images/stacy-clark.jpg">
                                    <p><a href="#">Stacy Clark,</a></p>
                                    <p>Co-Founder and Principal, Writer Relations</p>
                                </div>
                            </div>
                            <div class="item"> 
                                <div class="title">
                                	<img src="<?=base_url()?>images/erik-dodier.jpg">
                                     <p><a href="#">Erik Dodier,</a></p>
                                    <p>Principal, Business Development</p>
                                </div>
                            </div>
                            <div class="item"> 
                                <div class="title">
                                	<img src="<?=base_url()?>images/greg-dumont.jpg">
                                     <p><a href="#">Greg DuMont,</a></p>
                                    <p>Principal, Strategic Planning and Funding</p>
                                </div>
                            </div>
                            <div class="item">
                                <div class="title">
                               		<img src="<?=base_url()?>images/jay-gale.jpg">
                                     <p><a href="#">Jay Gale,</a></p>
                                    <p>Co-Founder and Principal, Publisher Relations</p>
                                </div>
                            </div>
                            <div class="item">
                                <div class="title">
                                	<img src="<?=base_url()?>images/tj-obrey.jpg">
                                     <p><a href="#">Thomas Obrey,</a></p>
                                    <p>Principal, Technology Development</p>
                                </div>
                            </div>
                            
                
             			 </div>
     
                   
                  </div>
                        
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="clear"></div>
                
<?=$this->load->view('template/footer.php')?>              
