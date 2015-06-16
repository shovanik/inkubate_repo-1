<div class="footer">

			<div class="col-1 col">
              <a href="<?=base_url()?>home">
				<img alt="Inkubate" src="<?=base_url()?>images/logo.png">
              </a>
			</div>

			<div class="col-2 col">
				<strong>About Inkubate</strong>
				<ul>
					<li><a href="<?=base_url()?>home/tour">Tour</a></li>
					<li><a href="<?=base_url()?>home/about">About</a></li>
					<li><a href="<?=base_url()?>home/terms">Terms of Use</a></li>
					<li><a href="<?=base_url()?>home/contact">Contact</a></li>
                    <li><a href="<?=base_url()?>home/team">Team</a></li>
                    
				</ul>
			</div>

			<div class="col-3 col">
				<strong>Help</strong>
				<ul>
					<li><a href="<?=base_url()?>home/faq">FAQ</a></li>
				</ul>
			</div>

			<div class="col-4 col">
				<strong>Community</strong>
				<ul>
					<li><a href="#">InkubateVoices</a></li>
                    <li><a target="_blank" onclick="" href="#">Twitter</a></li>
					<li><a target="_blank" onclick="" href="#">Facebook</a></li>
					<li><a onclick="" href="#">Blog</a></li>
				</ul>
			</div>
<div class="clear"></div>
		</div>
        <div class="sub-footer section clearfix">
			<strong>&copy; 2014 Inkubate.</strong> All rights reserved.
	
		</div>
            </div>
            </div>
            <nav id="menu">
				<ul>
					 <li><a class="icon icon-data" href="<?=base_url()?>home">Home</a></li>
                    <li><a class="icon icon-location" href="<?=base_url()?>home/faq">FAQ</a></li>
                    <li><a class="icon icon-study" href="#">Blog</a></li>
                    <li><a class="icon icon-photo" href="<?=base_url()?>home/publishers">Publishers</a></li>
                    <li><a class="icon icon-wallet" href="<?=base_url()?>home/investors">Investors</a></li>
                    <li><a class="icon icon-wallet" href="<?=base_url()?>home/about">What is Inkubate?</a></li>
                    <li><a class="icon icon-wallet" href="<?=base_url()?>home/tour">Take the Tour</a></li>
                    <!--<li><a class="icon icon-wallet" href="#">Contest</a></li>-->
                    <li><a class="icon icon-wallet button litebox" href="https://www.youtube.com/watch?v=kU_q_fxiMPw&feature=player_detailpage" target="_self" data-litebox-group="group-2">Watch our Video</a></li>
				</ul>
			</nav>
        </div>

		<a id="top">Back to Top</a>
        
<?php if($this->uri->segment(2) == 'team') {?>

<div class="abc" style="position:fixed; width:100%;height:100%; background:url(<?=base_url()?>images/team_bg.png); top:0">
    <div class="swp" style=" text-align:center; margin-top:10%">
        <img src="<?=base_url()?>images/swipe-icon.png">
        <div class="clear"></div>
        <input type="button" class="bca" value="Ok Got It" />
    </div>
</div>

<?php } ?>  
 
 <script type="text/javascript">
			$('.litebox').liteBox();
            
   $(document).ready(function() {
	$(".litebox").click(function(){
	   
	//$("#menu").css("display", "none" );
    $('nav#menu').addClass('mm-menu mm-horizontal mm-offcanvas');	
	//$('nav#menu').mmenu();
	
})
    
});
		</script>
         
 <script type="text/javascript">

/******************************************
* Snow Effect Script- By Altan d.o.o. (http://www.altan.hr/snow/index.html)
* Visit Dynamic Drive DHTML code library (http://www.dynamicdrive.com/) for full source code
* Last updated Nov 9th, 05' by DD. This notice must stay intact for use
******************************************/
  
  //Configure below to change URL path to the snow image
  /*var snowsrc="<?//=base_url()?>images/snow3.gif"
  var snowarr=["<?//=base_url()?>images/snow.gif","<?//=base_url()?>images/snow2.gif","<?//=base_url()?>images/snow3.gif"];
  // Configure below to change number of snow to render
  var no = 100;
  var count=0;
  // Configure whether snow should disappear after x seconds (0=never):
  var hidesnowtime = 5000;
  // Configure how much snow should drop down before fading ("windowheight" or "pageheight")
  var snowdistance = "pageheight";

///////////Stop Config//////////////////////////////////

  var ie4up = (document.all) ? 1 : 0;
  var ns6up = (document.getElementById&&!document.all) ? 1 : 0;

	function iecompattest(){
	return (document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body
	}

  var dx, xp, yp;    // coordinate and position variables
  var am, stx, sty;  // amplitude and step variables
  var i, doc_width = 800, doc_height = 600; 
  
  if (ns6up) {
    doc_width = self.innerWidth;
    doc_height = self.innerHeight;
  } else if (ie4up) {
    doc_width = iecompattest().clientWidth;
    doc_height = iecompattest().clientHeight;
  }

  dx = new Array();
  xp = new Array();
  yp = new Array();
  am = new Array();
  stx = new Array();
  sty = new Array();

  //snowsrc=(snowsrc.indexOf("dynamicdrive.com")!=-1)? "snow.gif" : snowsrc

  for (i = 0; i < no; ++ i) {
	  count=i%3;  
	  
    dx[i] = 0;                        // set coordinate variables
    xp[i] = Math.random()*(doc_width-50);  // set position variables
    yp[i] = Math.random()*doc_height;
    am[i] = Math.random()*20;         // set amplitude variables
    stx[i] = 0.02 + Math.random()/10; // set step variables
    sty[i] = 0.7 + Math.random();     // set step variables
		if (ie4up||ns6up) {
      if (i == 0) {
        document.write("<div id=\"dot"+ i +"\" style=\"POSITION: absolute; Z-INDEX: "+ i +"; VISIBILITY: visible; TOP: 15px; LEFT: 15px;\"><a href=\"http://dynamicdrive.com\"><img src='"+snowarr[count]+"' border=\"0\"><\/a><\/div>");
      } else {
        document.write("<div id=\"dot"+ i +"\" style=\"POSITION: absolute; Z-INDEX: "+ i +"; VISIBILITY: visible; TOP: 15px; LEFT: 15px;\"><img src='"+snowarr[count]+"' border=\"0\"><\/div>");
		//alert(snowsrc);
      }
    }
  }

  function snowIE_NS6() {  // IE and NS6 main animation function
    doc_width = ns6up?window.innerWidth-10 : iecompattest().clientWidth-10;
		doc_height=(window.innerHeight && snowdistance=="windowheight")? window.innerHeight : (ie4up && snowdistance=="windowheight")?  iecompattest().clientHeight : (ie4up && !window.opera && snowdistance=="pageheight")? iecompattest().scrollHeight : iecompattest().offsetHeight;
    for (i = 0; i < no; ++ i) {  // iterate for every dot
      yp[i] += sty[i];
      if (yp[i] > doc_height-50) {
        xp[i] = Math.random()*(doc_width-am[i]-30);
        yp[i] = 0;
        stx[i] = 0.02 + Math.random()/10;
        sty[i] = 0.7 + Math.random();
      }
      dx[i] += stx[i];
      document.getElementById("dot"+i).style.top=yp[i]+"px";
      document.getElementById("dot"+i).style.left=xp[i] + am[i]*Math.sin(dx[i])+"px";  
    }
    snowtimer=setTimeout("snowIE_NS6()", 10);
  }

	function hidesnow(){
		if (window.snowtimer) clearTimeout(snowtimer)
		for (i=0; i<no; i++) document.getElementById("dot"+i).style.visibility="hidden"
	}
		

if (ie4up||ns6up){
    snowIE_NS6();
		if (hidesnowtime>0)
		setTimeout("hidesnow()", hidesnowtime*500)
		}*/

</script> 
</body>
</html>

