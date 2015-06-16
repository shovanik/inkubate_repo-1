 <?=$this->load->view('template/header.php')?>
  
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
           
            <div class="content_part">
                <div class="contact">
                	<div class="contact_conternt">
                    	<div class="contact_conternt_left reg_left">
                            <h2>Cool, Glad to Meet You!</h2>
                                                    
                             <!--<p>Inkubate is currently in beta testing for members only</p>-->
                           	 <div class="contact_form">
                             
                             <?php
                               $frmAttrs   = array("id"=>'signupFrm',"class"=>'form-horizontal');
                               echo form_open('home/signUp', $frmAttrs);
                             ?>
                                 
                                <label>Name</label>
                                <input type="text" class="contant_tbox" id="name" name="name" />
                                <label>Email</label>
                                <input type="text" class="contant_tbox" id="email" name="email" />
                                <label>Confirm Email</label>
                                <input type="text" class="contant_tbox" id="con_email" name="con_email"/>
                                <label>Describe yourself</label>
                                
                                <input type="radio" id="type" name="type" value="1" checked="checked"/><span class="tag">Writer</span>
                                <input type="radio" id="type" name="type" value="2"/><span class="tag">Publisher</span>
                                <input type="radio" id="type" name="type" value="3"/><span class="tag">Literary Agent</span>
                                <input type="radio" id="type" name="type" value="4"/><span class="tag">Other</span>
                                
                                <!--<div style="display: none;" id="work_type_div">
                                <label>Work Type</label>
                                    <select name="work_type" id="work_type">
                                       <option value="1" id="Fiction">Fiction</option>
                                       <option value="2" id="NonFiction">Non-Fiction</option>
                                    </select>
                                </div>
                                <div style="display: none;" id="work_form_div">
                                <label>Work Form</label>
                                    <select name="work_form" id="work_form">
                                     
                                      <?php 
                                      //foreach($fiction_details as $details)
                                      //{
                                      ?>
                                       <option value="<?php //echo $details['work_form_id']?>"><?php //echo $details['work_form_name']?></option>
                                      <?php //} ?> 
                                    </select>
                                </div>-->
                                
                                <label>Tell us about your work (optional)</label>
                                <label>(500 character maximum; including spaces)</label>
                                
                               <textarea class="contact_tarea" id="desc" name="desc" onKeyDown="limitText(this.form.desc,this.form.cout,500);" 
onKeyUp="limitText(this.form.desc,this.form.cout,500);"></textarea>

                               <p>Characters Remaining: <input  type="text" name="cout" size="3" value="500" readonly="readonly" class="read_only"/> </p>
                               <p style="margin-top:10px;">
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