 <?=$this->load->view('template/signup_header.php')?>
  
  <script type="text/javascript" src="<?=base_url()?>js/jquery.validate.js"></script>
<script>
$().ready(function() {
	
	$("#signupFrm").validate({
		rules: {
			name: "required",
			/*desc: "required",*/
			
			con_password: {
				required: true,
				
				equalTo: "#password"
			},
			email: {
				required: true,
        		email: true,
        		remote: {
        			url: '<?=base_url()?>'+'home/register_email_exists',
        			type: "post",
        			data: {
        				email: function(){ return $("#email").val(); }
        			}
        		}
			},
            con_email: {
				required: true,
				email: true,
                equalTo: "#email"
			},
			type: "required"
		},
		messages: {
			firstname: "Please enter your firstname",
			lastname: "Please enter your lastname",
			username: {
				required: "Please enter a username",
				minlength: "Your username must consist of at least 2 characters"
			},
			password: {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long"
			},
			confirm_password: {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long",
				equalTo: "Please enter the same password as above"
			},
			email: {
        		required: 'Email address is required',
        		email: 'Please enter a valid email address',
        		remote: 'Email already used'
        	},
			agree: "Please accept our policy"
		}
	});

});
</script>

<script language="javascript" type="text/javascript">
function limitText(limitField, limitCount, limitNum) {
	if (limitField.value.length > limitNum) {
		limitField.value = limitField.value.substring(0, limitNum);
	} else {
		limitCount.value = limitNum - limitField.value.length;
	}
}
</script>

<style type="text/css">
#signupFrm label.error {
	margin-left: 153px;
	width: auto;
	display: inline;
        color:#ff0000;
}
@media only screen and (min-width : 320px) and (max-width : 650px),
only screen and (min-device-width: 320px) and (max-device-width: 650px){
#signupFrm label.error { margin-left: 0 !important;}
}

@media only screen and (min-width : 651px) and (max-width : 800px),
only screen and (min-device-width: 651px) and (max-device-width: 800px){
#signupFrm label.error { margin-left: 0 !important;}
}
</style> 

<script>
/*$(function(){
  $('input[type="radio"]').click(function(){
    if ($(this).is(':checked'))
    {
      //alert($(this).val());
      if($(this).val() == 2)
      {
        $('#work_type_div').css('display','block');
        $('#work_form_div').css('display','block');
      }
      else
      {
        $('#work_type_div').css('display','none');
        $('#work_form_div').css('display','none');
      }
      
    }
  });
});*/
</script> 

<script type="text/javascript">
		$(document).ready( function() {
		  
           $('#Fiction').click(function(){
            
            alert('he');
            
            var fiction = $('#Fiction').val();
            
            
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
            
           alert('hi');
           
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
         
  <div class="p_body">
    <div class="mid_wrapper">
    <h1>Publisher Sign-Up</h1>
    <p class="join_t">Join with</p>
    <div class="social_icons">
    <ul>
    <li><a href="<?=$login_url?>"><img src="<?=base_url()?>images/facebook.png" /></a></li>
    <li><a href="<?=base_url()?>twtest"><img src="<?=base_url()?>images/twitter.png" /></a></li>
    <li><a href="#"><img src="<?=base_url()?>images/google+.png" /></a></li>
    <li><a href="<?=base_url()?>linkedin_signup"><img src="<?=base_url()?>images/linkedin.png" /></a></li>
    </ul>
    </div>
    <div class="clear"></div>
    <p class="join_t">Or</p>
    <div class="clear"></div>
    <div class="signup_form">
    <div class="sign_inner">
    <form>
    <input type="text" value="" placeholder="Frist Name" />
    <input type="text" value="" placeholder="Last Name" />
    <input type="text" value="" placeholder="Email Address" />
    <input type="text" value="" placeholder="Create Password" />
    <input type="text" value="" placeholder="Confirm Password" />
    <input type="submit" value="Submit"/>
    
    </form>
    
    </div>
    </div>
    
    </div>
</div>
              
<?=$this->load->view('template/signup_footer.php')?>                 