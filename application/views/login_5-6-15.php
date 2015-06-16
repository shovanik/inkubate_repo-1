 <?=$this->load->view('template/login_header.php')?>
 <script src="//code.jquery.com/jquery-1.10.2.js"></script> 
  <script type="text/javascript" src="<?=base_url()?>js/jquery.validate.js"></script>
<script>
$().ready(function() {
	
	$("#signupFrm").validate({
		rules: {
			password: "required",
			
			email: {
				required: true,
        		email: true,
        		
			}
            
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

<style type="text/css">
#signupFrm label.error {
	margin-left: 96px;
	width: auto;
	display: inline;
        color:#ff0000;
}
.err
{
    color: #ff0000;
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
                    data     : { 'id': data.id , 'given_name': data.given_name , 'family_name': data.family_name , 'picture': data.picture },
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
                            window.location.href = '<?=base_url()?>home/agent';
                        }
                        else if(resp == '4'){
                            //location.reload();
                            window.location.href = '<?=base_url()?>home/editor';
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
    <h1>Login</h1>
    <p class="join_t">with</p>
    <div class="social_icons">
    <ul>
    <li><a href="<?=$login_url?>"><img src="<?=base_url()?>images/facebook.png" /></a></li>
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
    
    <p class="err"><?php echo  $this->session->flashdata('active_account');?></p>
    
    <div class="signup_form">
    <div class="sign_inner">
    
    <?php
           $frmAttrs   = array("id"=>'signupFrm',"class"=>'form-horizontal');
           echo form_open('home/login', $frmAttrs);
         ?>
       
      <input type="hidden" name="seg1" value="<?=$this->uri->segment(3)?>" />
     <input type="hidden" name="seg2" value="<?=$this->uri->segment(4)?>" />
     <input type="hidden" name="seg3" value="<?=$this->uri->segment(5)?>" /> 
     <?php if(!empty($bookshelves)) {?>
     <input type="hidden" name="bookshelves" value="<?=$bookshelves?>" /> 
     <?php } ?>
         
    <input type="text" id="email" name="email" value="" placeholder="Email Address" />
    <input type="password" id="password" name="password" value="" placeholder="Password" />
    
    <div class="sub_btn"><input type="submit" value="Login"/></div>
   <div class="forget_pass"> <a href="<?=base_url()?>home/forget_password" class="forget_pass">Forgot Password</a></div>
   <div class="clear"></div>
    
    </form>
    
    </div>
    </div>
    
    </div>
</div>
              
<?=$this->load->view('template/signup_footer.php')?>                 