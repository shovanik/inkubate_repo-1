 <?=$this->load->view('template/header.php')?>
  
  
  <script type="text/javascript" src="<?=base_url()?>js/jquery.validate.js"></script>
<script>
$().ready(function() {
	
	$("#signupFrm").validate({
		rules: {
			fname: "required",
            lname: "required",
            zip: "required",
            dob: "required",
			password: "required",
			
			con_password: {
				required: true,
				
				equalTo: "#password"
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

<script>

$(document).ready(function(){
    /* Dialog */
 $("#dob").datepicker({
    dateFormat : 'yy-m-d',
    changeMonth: true,
    changeYear: true,
    yearRange: '1970:<?php echo date('Y');?>'
});
 
});
 
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
           
            <div class="content_part">
                <div class="contact">
                	<div class="contact_conternt">
                    	<div class="contact_conternt_left reg_left">
                            <h2>Final Step Request an Invitation</h2>
                                                    
                             <p>Inkubate is currently in beta testing for members only</p>
                           	 <div class="contact_form">
                             
                             <?php
                               $frmAttrs   = array("id"=>'signupFrm',"class"=>'form-horizontal');
                               echo form_open('home/step2', $frmAttrs);
                             ?>
                                 
                                <label>First Name</label>
                                <input type="text" class="contant_tbox" id="fname" name="fname" />
                                <label>Middle Name</label>
                                <input type="text" class="contant_tbox" id="mname" name="mname" />
                                <label>Last Name</label>
                                <input type="text" class="contant_tbox" id="lname" name="lname" />
                                <label>Password</label>
                                <input type="password" class="contant_tbox" id="password" name="password" />
                                <label>Confirm Password</label>
                                <input type="password" class="contant_tbox" id="con_password" name="con_password" />
                                <label>Zip Code</label>
                                <input type="text" class="contant_tbox" id="zip" name="zip" />
                                <label>Date of Birth</label>
                                <input type="text" class="contant_tbox" id="dob" name="dob" />
                                
                               <p style="margin-top:10px;">
                               <input type="hidden" id="unqid" name="unqid" value="<?php echo $unqid;?>"/>
                               <input type="submit" value="Submit Request" class="log_btn"/></p>
                               <div class="clear"></div>
                             </form>  
                            </div>
                                

                        </div>
                        <div class="reg_conternt_right">
                         	
                           

                            <h3 class="reg_right_head"><img src="<?=base_url()?>images/hdr-on-inkubate-you-can.png"></h3>
                            <ul class="reg_right_list">
                            	<li class="num_1">Post your work for publishers & agents</li>
                                <li class="num_2">Create a profile that promotes your work</li>
                                <li class="num_3">Get noticed, get paid</li>
                                <li class="num_4">And who knows—get published!</li>
                                <li class="no_padding"><a href="#"><img src="<?=base_url()?>images/focus-still-not-sure-take-tour.jpg"></a></li>
                            	
                            </ul>
                            
                            
                        </div>
                        
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="clear"></div>
              
<?=$this->load->view('template/footer.php')?>    

            