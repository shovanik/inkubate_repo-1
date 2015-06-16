<?php $usd = $this->session->userdata('logged_user');?>
<script>
function delete_folder(id)
{
    if(confirm("Are you sure you want to delete this folder?")){
    	 $.ajax({
           url      : '<?=base_url()?>'+'home/delete_folder',
           type     : 'POST',
           data     : { 'id':id },
           success  : function(resp){
                if(resp.status=='0'){
                
                	alert("Please refresh the page and try again");
                }
                location.reload();
           },
           error    : function(resp){
                $.prompt("Sorry, something isn't working right.", {title:'Error'});
           }
          });   
    }
    else
    {
        return false;
    }
}
</script>
                    <div class="mid_content_inner_left">
                    
                    <?php if($usd['user_type'] == '2') {?>
                        <div class="compose_button"><a href="<?=base_url()?>home/compose_mail" class="button_pro">Compose Mail<img src="<?=base_url()?>images/mail_compose_icon.png" alt=""/></a></div>
                     <?php } ?> 
                     <?php if($usd['user_type'] == '1') {?>
                        <div class="compose_button"><a href="<?=base_url()?>home/compose_mail_author" class="button_pro">Compose Mail<img src="<?=base_url()?>images/mail_compose_icon.png" alt=""/></a></div>
                     <?php } ?>   
                        <ul class="inbox_menu">
                        <li <?php if(isset($mail_sidebar) && $mail_sidebar == "1"){ ?>class="active"<?php } ?>><a href="<?=base_url()?>home/inbox"><img src="<?=base_url()?>images/icon_indox01.png" alt=""/>Inbox<?php echo ($mail_count[0]['count'] > 0) ? '<span class="pink">'.$mail_count[0]['count'].'</span>' : "";?></a></li>
			 <?php if($usd['user_type'] == '1') {?>
                         <li <?php if(isset($mail_sidebar) && $mail_sidebar == "4"){ ?>class="active"<?php } ?>><a href="<?=base_url()?>home/addressBook" ><img src="<?=base_url()?>images/icon_indox02.png" alt=""/>AddressBook</a></li>
			<?php } ?>
                        <?php if($usd['user_type'] == '2') {?>
                        
                        <li <?php if(isset($mail_sidebar) && $mail_sidebar == "2"){ ?>class="active"<?php } ?>><a href="<?=base_url()?>home/DraftMail"><img src="<?=base_url()?>images/icon_indox02.png" alt=""/>Draft<?php echo (isset($draft_count) && $draft_count > 0) ? '<span class="pink">'.$draft_count.'</span>' : "";?></a></li>
                        <li <?php if(isset($mail_sidebar) && $mail_sidebar == "3"){ ?>class="active"<?php } ?>><a href="<?=base_url()?>home/SentMail"><img src="<?=base_url()?>images/icon_indox03.png" alt=""/>Sent Mail</a></li>
                        <li <?php if(isset($mail_sidebar) && $mail_sidebar == "4"){ ?>class="active"<?php } ?>><a href="<?=base_url()?>home/addressBook" ><img src="<?=base_url()?>images/icon_indox02.png" alt=""/>AddressBook</a></li>
                        
                        <?php } ?>
                        
                        <li <?php if(isset($mail_sidebar) && $mail_sidebar == "5"){ ?>class="active"<?php } ?>><a href="<?=base_url()?>home/TrashMail" ><img src="<?=base_url()?>images/icon_indox04.png" alt=""/>Trash</a></li>
                        
                        <li <?php if(isset($mail_sidebar) && $mail_sidebar == "6"){ ?>class="active"<?php } ?> style="position:relative">
                        	<a class="hidetext no_effect" href="javascript:;">
                            	<img src="<?=base_url()?>images/icon_indox05.png" alt="">Folder<span class="plus"></span><br/>
                        
                        <!--<span style="display:none;" class="bottom_text"><strong>Recent (2)</strong><br />
                        Important</span>-->
                        
                         <?php if(!empty($folder_details)) {
                                 
                                //print_r($folder_details);die;        
                            foreach($folder_details as $key=>$fdetails) {
                                
                              $folder_msg_cnt  = $this->memail->folder_msg_cnt_usr($fdetails['id']);  
                            ?>
                                        
                        <span style="display:none;" class="bottom_text">
                        
                        <strong>
                        <span href="javascript:;" onclick="folder_message(<?php echo $fdetails['id']?>,'<?php echo $fdetails['name']?>')">
                        <?php echo $fdetails['name']?> (<?php echo count($folder_msg_cnt);?>)
                        </span>
                        &nbsp;&nbsp;&nbsp;
                        <span href="javascript:;" onclick="delete_folder('<?php echo $fdetails['id']?>');" style="cursor:pointer;">
                        <img src="<?=base_url()?>images/del_icon.png" alt="" width="16" style="position:relative; top:2px;"/>
                        </span>
                        </strong>
                       
                        </span>
                        
                        <?php } } ?>
                        </a>
                       
                        	<a href="#info" class="nohover" rel="facebox"><img src="<?=base_url()?>images/plus.png" alt=""/></a>
                        </li>
                        </ul>
                        
                    </div>
