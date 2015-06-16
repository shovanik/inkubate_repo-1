 <?=$this->load->view('template/signup_header.php')?>
 <script src="//code.jquery.com/jquery-1.10.2.js"></script> 
  <script type="text/javascript" src="<?=base_url()?>js/jquery.validate.js"></script>
<script>
$().ready(function() {
	
	$("#signupFrm").validate({
		rules: {
			name_first: "required",
            name_last: "required",
            password: "required",
			/*desc: "required",*/
			
			con_password: {
				//required: true,
				
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
width: 100%;
display: inline;
color:#ff0000;
float:left;
margin-bottom: 7px;
font-size: 14px;
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
  
   <script type="text/javascript">
  (function() {
    var po = document.createElement('script');
    po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/client:plusone.js?onload=render';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(po, s);
  })();

  function render() {
    gapi.signin.render('customBtn', {
      'callback': 'signinCallback',
      'clientid': '151275758111-o7dub4hc3pulp984ustfr3qhuflh1h55.apps.googleusercontent.com',
      'cookiepolicy': 'http://billbahadur.com',
      'scope': 'https://www.googleapis.com/auth/plus.login'
    });
  }
  function signinCallback(authResult) {
    if (authResult['status']['signed_in']) {
            console.log(authResult);
            //document.getElementById('customBtn').setAttribute('style', 'display: none');
             /* get google plus id */
            $.ajax({
                type: "GET",
                url: "https://www.googleapis.com/oauth2/v2/userinfo?access_token="+authResult['access_token']
            })
            .done(function( data ){
                console.log(data);
                 
                 $.ajax({
                    url      : '<?=base_url()?>'+'googleplus_login/signup_googleplus',
                    type     : 'POST',
                    data     : { 'id': data.id , 'given_name': data.given_name , 'family_name': data.family_name , 'picture': data.picture, 'email': data.email},
                    success  : function(resp){
                        
                        //alert(resp);
                        if(resp == '1'){
                            
                            window.location.href = '<?=base_url()?>home/author';
                        }
                        else if(resp == '2'){
                            //location.reload();
                            window.location.href = '<?=base_url()?>home/publisher';
                        }
                        else if(resp == '3'){
                            //location.reload();
                            window.location.href = '<?=base_url()?>home/publisher';
                        }
                        else if(resp == '4'){
                            //location.reload();
                            window.location.href = '<?=base_url()?>home/publisher';
                        }
                        else {
                            //location.reload();
                            $("#google_plus_id").html(resp);
                        }
                        
                    },
                    error    : function(resp){
                        alert("Sorry, something isn't working right.");
                    }
                });
                
            });
        } else {
            console.log('Sign-in state: ' + authResult['error']);
        }
  }
  

  </script>
         
       
         
  <div class="p_body_total" id="google_plus_id">
    <div class="mid_wrapper">
   <!-- <h1>Sign-Up</h1>
    <p class="join_t">Join with</p>-->
    <div class="social_icons">
    <ul>
    <li>
    <!--<a href="javascript:window.open('document.aspx','mywindowtitle','width=500,height=150')">open window</a>
    <a href="<?//=$login_url?>" id="facebook"><img src="<?//=base_url()?>images/facebook.png" /></a></li>-->
    <a href="<?=$login_url?>" id="facebook"><img src="<?=base_url()?>images/facebook.png" /></a></li>
    <li><a href="<?=base_url()?>twtest"><img src="<?=base_url()?>images/twitter.png" /></a></li>
    <li>
   <!-- <button class="g-signin" id="customBtn"
          data-scope="email"
          data-clientid="151275758111-o7dub4hc3pulp984ustfr3qhuflh1h55.apps.googleusercontent.com"
          data-callback="onSignInCallback"
          data-theme="dark"
          data-cookiepolicy="http://billbahadur.com"> 
      </button>-->
    
    <span id="customBtn" class="customGPlusSignIn">
    <img src="<?=base_url()?>images/google+.png" style="cursor: pointer;"/>
  </span>
    </li>
    <li><a href="<?=base_url()?>linkedin_signup"><img src="<?=base_url()?>images/linkedin.png" /></a></li>
    </ul>
    </div>
    <div class="clear"></div>
    <p class="join_t">Or</p>
    <div class="clear"></div>
    <div class="signup_form">
    <div class="sign_inner">
   
   
    <?php
       $frmAttrs   = array("id"=>'signupFrm',"class"=>'form-horizontal');
       echo form_open('home/signUp', $frmAttrs);
     ?>   
   <!--<form id="signupFrm" class="form-horizontal" method="post" action="http://billbahadur.com/demo/inkubate/home/signUp" >-->
    <input type="text" id="name_first" name="name_first" value="" placeholder="First Name" />
    <input type="text" id="name_last" name="name_last" value="" placeholder="Last Name" />
    <input type="text" id="email" name="email" value="" placeholder="Email Address" />
    <input type="password" id="password" name="password" value="" placeholder="Create Password" />
    <input type="password" id="con_password" name="con_password" value="" placeholder="Confirm Password" />
    <input type="submit" value="Submit"/>
    
    </form>
    
    </div>
    </div>
    
    </div>
</div>
              
<?=$this->load->view('template/signup_footer.php')?>                 