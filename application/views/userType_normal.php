<?=$this->load->view('template/signup_header.php')?>
 
<div class="p_body">
        <div class="mid_wrapper">
        <!--<h1>Publisher Sign-Up</h1>-->
        
        <div class="signup_form">
        <div class="sign_inner3">
        
        <?php
           $frmAttrs   = array("id"=>'signupFrm',"class"=>'form-horizontal');
           echo form_open('home/userType', $frmAttrs);
         ?>
        
        <p class="s_p">You are almost there.<br /> 
        We need just a few more details. Are you a…
        </p>
         
            <div class="radio_controlar">
            <div class="email_con2">
            <label>I am a Writer</label>
            <input type="radio" name="user_type" id="writer" value="1" />
            <div class="clear"></div>
            </div>
            
            <div class="email_con2">
            <label>I am an Agent</label>
            <input type="radio" name="user_type" id="Agent" value="3"/>
            <div class="clear"></div>
            </div>
            
            <div class="email_con2">
            <label>I am an Editor</label>
            <input type="radio" name="user_type" id="Editor" value="4"/>
            <div class="clear"></div>
            </div>
            
            <div class="email_con2">
            <label>I am a Publisher</label>
            <input type="radio" name="user_type" id="Publisher" value="2"/>
            <div class="clear"></div>
            </div>
            </div>



<div class="email_con">
<p class="chk_t4">By clicking Start Using Inkubate it means you are agreeing to Inkubate’s Service Terms and Privacy Policy
</p>
</div>

<div class="popup_con">

<input type="hidden" name="email" value="<?=$email?>"/>


<input type="submit" value="Start Using Inkubate" />
</div>

</form>

</div>
</div>

</div>
</div>

<?=$this->load->view('template/signup_footer.php')?> 