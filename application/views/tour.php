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
	   $('#slider-1').liquidSlider();

    });
    </script>
 

           
            <div class="content_part">
            	
               
                <div class="tour">
              
                	<div class="tour_content">
                    <p><img src="<?=base_url()?>images/hdr-take-the-tour.jpg"></p>
                    
                      <div class="tour_content">
                      
         					<!--slider part-->
                            
                            	<div class="liquid-slider" id="slider-1">
    <div>
      <h2 class="title">&nbsp;</h2>
      <p><img src="<?=base_url()?>images/tour-slide-1.jpg"></p>
    </div>
    <div>
      <h2 class="title">&nbsp;</h2>
      <p><img src="<?=base_url()?>images/tour-slide-2.jpg"></p>
    </div>
    <div>
      <h2 class="title">&nbsp;</h2>
      <p><img src="<?=base_url()?>images/tour-slide-3.jpg"></p>
    </div>
    <div>
      <h2 class="title">&nbsp;</h2>
      <p><img src="<?=base_url()?>images/tour-slide-4.jpg"></p>
    </div>
  </div>
                       <!--slider part-->
                      </div>
                        
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="clear"></div>
              
<?=$this->load->view('template/footer.php')?>
