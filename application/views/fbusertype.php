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
    
    <div class="signup_form">
    <div class="sign_inner3">
    
    <?php
               $frmAttrs   = array("id"=>'signupFrm',"class"=>'form-horizontal');
               echo form_open('home/user', $frmAttrs);
             ?>
    
    <p class="s_p">You are almost there. 
    We need just a few more details. Are you a…
    </p>
    <div class="radio_controlar">
    <div class="email_con2">
    <label>I am a Writer</label>
    <input type="radio" name="writer" id="writer" value="1" />
    <div class="clear"></div>
    </div>
    
    <div class="email_con2">
    <label>I am an Agent</label>
    <input type="radio" name="Agent" id="Agent" value="3"/>
    <div class="clear"></div>
    </div>
    
    <div class="email_con2">
    <label>I am an Editor</label>
    <input type="radio" name="Editor" id="Editor" value="3"/>
    <div class="clear"></div>
    </div>
    
    <div class="email_con2">
    <label>I am a Publisher</label>
    <input type="radio" name="Publisher" id="Publisher" value="2"/>
    <div class="clear"></div>
    </div>
    </div>
    
    
    
    <div class="email_con">
    <p class="chk_t4">By clicking Start Using Inkubate it means you are agreeing to Inkubate’s Service Terms and Privacy Policy
    </p>
    </div>
    
    <div class="popup_con">
    <input type="submit" value="Start Using inkubate" />
    </div>
    
    </form>
    
    </div>
    </div>
    
    </div>
</div>
              
<?=$this->load->view('template/signup_footer.php')?>                 