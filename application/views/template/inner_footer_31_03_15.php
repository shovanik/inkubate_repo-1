<?php $usd = $this->session->userdata('logged_user');?>
<style>
.img_sz
{
    border-radius: 50%;
    height: 60px;
    width: 60px;
}
</style>
<div class="footer">

			<div class="col-1 col">
            <a href="<?=base_url()?>home">
				<img alt="Inkubate" src="<?=base_url()?>images/logo.png"/>
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
                
                
                <div class="top_welcome_section_right mob_display">
         	 <?php if(!empty($user_photo['filename'])) {?>
                    <img src="<?=base_url()?>uploadImage/<?=$usd['id']?>/profile/<?=$user_photo['filename']?>" class="img_sz"/>
                 <?php } else {?>
                     <img src="<?=base_url()?>images/img_default_headshot.png" class="img_sz"/>
                 <?php } ?> 
            <p><strong>Welcome</strong></p>
            <p><span><?php echo $usd['name_first'].' '.$usd['name_middle'].' '.$usd['name_last'];?></span><br />
              Member since <?php echo date('d F Y',strtotime($usd['created']))?></p>
          </div>
          	<div class="clear"></div>
            <div class="dasbord_news_section_right mob_display2">
            <h2>Profile is 75 % complete !</h2>
            <p class="bio_section"><span>Your Bio</span></p>
            <p class="bio_section photo"><span>Your Photo</span></p>
            <p class="bio_section work"><span>Your Work</span></p>
            <p class="bio_section social"><span>Social</span></p>
            <div class="clear"></div>
            	
            <a href="#" class="button_pro">Update Profile<img src="<?=base_url()?>images/arrow.png" alt="" /></a>
            <div class="clear"></div>
             </div>
            
            <div class="clear"></div>
            
            <li>&nbsp;</li>
                
                	<?php $usd = $this->session->userdata('logged_user');
                    if($usd['user_type'] == '1')
                     {?>
                	<li><a class="icon icon-data" href="<?=base_url()?>home/author">My Dashboard</a></li>
                    <?php } if($usd['user_type'] == '2') {?>  
                    <li><a class="icon icon-data" href="<?=base_url()?>home/publisher">My Dashboard</a></li>
                    <?php } ?>
                    <li><a class="icon icon-location" href="<?=base_url()?>profile">Profile</a></li>
                    <li><a class="icon icon-study" href="#">Message Center</a>
                    	<ul>
                        	<li><a class="icon icon-study" href="<?=base_url()?>home/inbox">Inbox</a></li>
                            <li><a class="icon icon-study" href="<?=base_url()?>home/DraftMail">Draft</a></li>	
                            <li><a class="icon icon-study" href="<?=base_url()?>home/SentMail">Sent Mail</a></li>	
                            <li><a class="icon icon-study" href="<?=base_url()?>home/TrashMail">Trash</a></li>	
                             <li><a class="icon icon-study" href="#">Folder</a></li>
                              <li><a class="icon icon-study" href="#" style="padding-left:30px;">Recent (2) Important</a></li>
                        </ul>
                    </li>
                    <li><a class="icon icon-photo" href="#">Account</a></li>
                    
                    <li><a class="icon icon-location" href="<?=base_url()?>home/faq">FAQ</a></li>
                    <li><a class="icon icon-study" href="#">Blog</a></li>
				</ul>
			</nav>
            
            
           
            
        </div> 

<a id="top">Back to Top</a>
<script>
function folderValdate()
{
	provided = "0";
	$('.folder_create_name').each(function() {
	
	    val = $(this).val();
	    if(val != "")
	    {
	    	provided = "1";
	    }
	});
	if(provided == "0")
	{	
		$(".folder_create_error").html('Please provide a folder Name.');
		return false;
	}
	else
	{
		$(".folder_create_error").html('');
	}
	//return false;
}

function pinchitValdate()
{
	provided = "0";
	$('.pitchit_create_name').each(function() {
	
	    val = $(this).val();
	    if(val != "")
	    {
	    	provided = "1";
	    }
	});
	if(provided == "0")
	{	
		$(".pitchit_create_error").html('Please provide a pinchit Name.');
		return false;
	}
	else
	{
		$(".pitchit_create_error").html('');
	}
	//return false;
}
</script>

<div id="info" style="display:none;">
<div class="pop_new">
 <h2>Add a New Folder</h2>
 <?php
   $frmAttrs   = array("id"=>'folderFrm',"class"=>'form-horizontal','onsubmit' => 'return folderValdate();');
   echo form_open('home/addfolder', $frmAttrs);
 ?>
 
 <label>Folder Name:</label>
 <input name="folder" class="folder_create_name" type="text" />
 <div class="folder_create_error" style="color:red"></div>
 <div class="clear"></div>
 <input name="button" type="submit" value="Save" /> <input name="button" type="button" value="Cancel" class="white" onclick="cancl()" />
 </form> 
 </div>
  </div>

<div id="pitchits_info" style="display:none;">
<div class="pop_new">
 <h2>Add a New Pitchits</h2>
 <?php
   $frmAttrs   = array("id"=>'pitchitFrm',"class"=>'form-horizontal','onsubmit' => 'return pinchitValdate();');
   echo form_open('home/addpitchit', $frmAttrs);
 ?>
 
 <label>Pitchit Name:</label>
 <input name="pitchit" class="pitchit_create_name" type="text" />
 <div class="pitchit_create_error" style="color:red"></div>
 <div class="clear"></div>
 <input name="button" type="submit" value="Save" /> <input name="button" type="button" value="Cancel" class="white" onclick="cancl()" />
 </form> 
 </div>
  </div>

 <style>
 #facebox .content {width: 450px;}
 
 .pop_new input[type="text"]{margin-left: 0 !important; }
 .pop_new input[type="submit"]{ margin-right: 5px !important;}
 
 .inactive{
margin-top:10px;
float:left;
}
.pagination ul li.inactive,
.pagination ul li.inactive:hover{
    background-color:#999999;
    color:#FFFFFF;
    border:1px solid #333333;
    cursor: default;
}
.data ul li{
    list-style: none;
    font-family: verdana;
    margin: 5px 0 5px 0;
    color: #000;
    font-size: 13px;
}

.pagination{
    width: auto;
    height: 25px;
}
.pagination ul li{
    list-style: none;
    float: left;
    border: 1px solid #333333;
    padding: 2px 6px 2px 6px;
    margin: 0 3px 0 3px;
    font-family: arial;
    font-size: 14px;
    color: #fff;
    font-weight: bold;
    background-color: #666666;
}
.pagination ul li:hover{
    color: #ABC509;
    cursor: pointer;
}
.go_button
{
    background-color:#ABC509;border:1px solid #333333;color:#fff;padding:4px 6px 4px 6px;cursor:pointer;position:absolute;
}
.total
{
    float:right;font-family:arial;color:#666666;
}
 </style>
 
<div id="showAuthorList" style="display:none;">
    <h2>Your Address Book</h2>
    <?php
    if(isset($author_list))
    {
    ?>
    <style>
                                        	.alphabet li{
                                        		float:left;
                                        		padding:5px;
                                        	}
                                        	.author_active{
                                        		color:green;
                                        	}
                                        </style>
    <ul class="alphabet">
                                	<li><a href="javascript:;" onclick="FnAuthors('a','<?php echo $page;?>','<?php echo $per_page;?>')"  id="a">A</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors('b','<?php echo $page;?>','<?php echo $per_page;?>')" id="b">B</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors('c','<?php echo $page;?>','<?php echo $per_page;?>')" id="c">C</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors('d','<?php echo $page;?>','<?php echo $per_page;?>')" id="d">D</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors('e','<?php echo $page;?>','<?php echo $per_page;?>')" id="e">E</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors('f','<?php echo $page;?>','<?php echo $per_page;?>')" id="f">F</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors('g','<?php echo $page;?>','<?php echo $per_page;?>')" id="g">G</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors('h','<?php echo $page;?>','<?php echo $per_page;?>')" id="h">H</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors('i','<?php echo $page;?>','<?php echo $per_page;?>')" id="i">I</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors('j','<?php echo $page;?>','<?php echo $per_page;?>')" id="j">J</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors('k','<?php echo $page;?>','<?php echo $per_page;?>')" id="k">K</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors('l','<?php echo $page;?>','<?php echo $per_page;?>')" id="l">L</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors('m','<?php echo $page;?>','<?php echo $per_page;?>')" id="m">M</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors('n','<?php echo $page;?>','<?php echo $per_page;?>')" id="n">N</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors('o','<?php echo $page;?>','<?php echo $per_page;?>')" id="o">O</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors('p','<?php echo $page;?>','<?php echo $per_page;?>')" id="p">P</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors('q','<?php echo $page;?>','<?php echo $per_page;?>')" id="q">Q</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors('r','<?php echo $page;?>','<?php echo $per_page;?>')" id="r">R</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors('s','<?php echo $page;?>','<?php echo $per_page;?>')" id="s">S</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors('t','<?php echo $page;?>','<?php echo $per_page;?>')" id="t">T</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors('u','<?php echo $page;?>','<?php echo $per_page;?>')" id="u">U</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors('v','<?php echo $page;?>','<?php echo $per_page;?>')" id="v">V</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors('w','<?php echo $page;?>','<?php echo $per_page;?>')" id="w">W</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors('x','<?php echo $page;?>','<?php echo $per_page;?>')" id="x">X</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors('y','<?php echo $page;?>','<?php echo $per_page;?>')" id="y">Y</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors('z','<?php echo $page;?>','<?php echo $per_page;?>')" id="z">Z</a></li>
                                	
                                	</ul>
                                	<div class="clear"></div>
    <?php 
    }
    ?>
    <div style="height: 200px; overflow-y: scroll;overflow-x: hidden; " class="dynamic_data">
    <?php
    if(isset($author_list) && count($author_list) > 0)
    {
        $i=0;
        foreach($author_list as $eachList)
        {
    ?>    
        <span class="selectAuthor" data-num="<?php echo $i?>" style="background: #d0e6fe;color:#333;border-radius:4px;padding: 5px;margin: 0 10px 5px 0;cursor:pointer; float: left;width:45% ;" data-id="<?php echo $eachList['id']?>" data-name="<?php echo $eachList['name_first'].' '.$eachList['name_middle'].' '.$eachList['name_last'];?>">
        <?php //echo word_wrap($eachList['email'],30)
        	echo $eachList['name_first']." ".$eachList['name_middle']." ".$eachList['name_last'];
        ?>
        </span>
        
    <?php
        $i++;
        if($i%2==0)
        {
            ?>
            <div class="clear" style="margin-bottom: 10px;"></div>
            <?php
        }
        }
        echo $pagination;
    }
    ?>
        <!--<input name="button" type="submit" value="Send" /> <input name="button" type="button" value="Cancel" class="white" onclick="cancl()" />-->
        </div>
   
</div>



<div id="showAuthorList_1" style="display:none;">
    <h2>Your Address Book</h2>
    <?php
    if(isset($author_list))
    {
    ?>
    <style>
                                        	.alphabet li{
                                        		float:left;
                                        		padding:5px;
                                        	}
                                        	.author_active{
                                        		color:green;
                                        	}
                                        </style>
    <ul class="alphabet">
                                	<li><a href="javascript:;" onclick="FnAuthors_1('a','<?php echo $page;?>','<?php echo $per_page;?>')"  id="a">A</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors_1('b','<?php echo $page;?>','<?php echo $per_page;?>')" id="b">B</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors_1('c','<?php echo $page;?>','<?php echo $per_page;?>')" id="c">C</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors_1('d','<?php echo $page;?>','<?php echo $per_page;?>')" id="d">D</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors_1('e','<?php echo $page;?>','<?php echo $per_page;?>')" id="e">E</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors_1('f','<?php echo $page;?>','<?php echo $per_page;?>')" id="f">F</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors_1('g','<?php echo $page;?>','<?php echo $per_page;?>')" id="g">G</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors_1('h','<?php echo $page;?>','<?php echo $per_page;?>')" id="h">H</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors_1('i','<?php echo $page;?>','<?php echo $per_page;?>')" id="i">I</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors_1('j','<?php echo $page;?>','<?php echo $per_page;?>')" id="j">J</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors_1('k','<?php echo $page;?>','<?php echo $per_page;?>')" id="k">K</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors_1('l','<?php echo $page;?>','<?php echo $per_page;?>')" id="l">L</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors_1('m','<?php echo $page;?>','<?php echo $per_page;?>')" id="m">M</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors_1('n','<?php echo $page;?>','<?php echo $per_page;?>')" id="n">N</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors_1('o','<?php echo $page;?>','<?php echo $per_page;?>')" id="o">O</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors_1('p','<?php echo $page;?>','<?php echo $per_page;?>')" id="p">P</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors_1('q','<?php echo $page;?>','<?php echo $per_page;?>')" id="q">Q</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors_1('r','<?php echo $page;?>','<?php echo $per_page;?>')" id="r">R</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors_1('s','<?php echo $page;?>','<?php echo $per_page;?>')" id="s">S</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors_1('t','<?php echo $page;?>','<?php echo $per_page;?>')" id="t">T</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors_1('u','<?php echo $page;?>','<?php echo $per_page;?>')" id="u">U</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors_1('v','<?php echo $page;?>','<?php echo $per_page;?>')" id="v">V</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors_1('w','<?php echo $page;?>','<?php echo $per_page;?>')" id="w">W</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors_1('x','<?php echo $page;?>','<?php echo $per_page;?>')" id="x">X</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors_1('y','<?php echo $page;?>','<?php echo $per_page;?>')" id="y">Y</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors_1('z','<?php echo $page;?>','<?php echo $per_page;?>')" id="z">Z</a></li>
                                	
                                	</ul>
                                	<div class="clear"></div>
    <?php 
    }
    ?>
    <div style="height: 200px; overflow-y: scroll;overflow-x: hidden; " class="dynamic_data">
    <?php
    if(isset($author_list) && count($author_list) > 0)
    {
        $i=0;
        foreach($author_list as $eachList)
        {
    ?>    
        <span class="selectAuthor_1" data-num="<?php echo $i?>" style="background: #d0e6fe;color:#333;border-radius:4px;padding: 5px;margin: 0 10px 5px 0;cursor:pointer; float: left;width:45% ;" data-id="<?php echo $eachList['id']?>" data-name="<?php echo $eachList['name_first'].' '.$eachList['name_middle'].' '.$eachList['name_last'];?>">
        <?php //echo word_wrap($eachList['email'],30)
        	echo $eachList['name_first']." ".$eachList['name_middle']." ".$eachList['name_last'];
        ?>
        </span>
        
    <?php
        $i++;
        if($i%2==0)
        {
            ?>
            <div class="clear" style="margin-bottom: 10px;"></div>
            <?php
        }
        }
        echo $pagination;
    }
    ?>
        <!--<input name="button" type="submit" value="Send" /> <input name="button" type="button" value="Cancel" class="white" onclick="cancl()" />-->
        </div>
   
</div>
 
<div id="showAuthorList_draft" style="display:none;">
    <h2>Your Address Book</h2>
    <?php
    if(isset($author_list))
    {
    ?>
    <style>
    .alphabet li{
            float:left;
            padding:5px;
    }
    .author_active{
            color:green;
    }
    </style>
    <ul class="alphabet">
                                	<li><a href="javascript:;" onclick="FnAuthors_draft('a','<?php echo $page;?>','<?php echo $per_page;?>')"  id="a">A</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors_draft('b','<?php echo $page;?>','<?php echo $per_page;?>')" id="b">B</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors_draft('c','<?php echo $page;?>','<?php echo $per_page;?>')" id="c">C</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors_draft('d','<?php echo $page;?>','<?php echo $per_page;?>')" id="d">D</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors_draft('e','<?php echo $page;?>','<?php echo $per_page;?>')" id="e">E</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors_draft('f','<?php echo $page;?>','<?php echo $per_page;?>')" id="f">F</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors_draft('g','<?php echo $page;?>','<?php echo $per_page;?>')" id="g">G</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors_draft('h','<?php echo $page;?>','<?php echo $per_page;?>')" id="h">H</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors_draft('i','<?php echo $page;?>','<?php echo $per_page;?>')" id="i">I</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors_draft('j','<?php echo $page;?>','<?php echo $per_page;?>')" id="j">J</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors_draft('k','<?php echo $page;?>','<?php echo $per_page;?>')" id="k">K</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors_draft('l','<?php echo $page;?>','<?php echo $per_page;?>')" id="l">L</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors_draft('m','<?php echo $page;?>','<?php echo $per_page;?>')" id="m">M</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors_draft('n','<?php echo $page;?>','<?php echo $per_page;?>')" id="n">N</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors_draft('o','<?php echo $page;?>','<?php echo $per_page;?>')" id="o">O</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors_draft('p','<?php echo $page;?>','<?php echo $per_page;?>')" id="p">P</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors_draft('q','<?php echo $page;?>','<?php echo $per_page;?>')" id="q">Q</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors_draft('r','<?php echo $page;?>','<?php echo $per_page;?>')" id="r">R</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors_draft('s','<?php echo $page;?>','<?php echo $per_page;?>')" id="s">S</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors_draft('t','<?php echo $page;?>','<?php echo $per_page;?>')" id="t">T</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors_draft('u','<?php echo $page;?>','<?php echo $per_page;?>')" id="u">U</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors_draft('v','<?php echo $page;?>','<?php echo $per_page;?>')" id="v">V</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors_draft('w','<?php echo $page;?>','<?php echo $per_page;?>')" id="w">W</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors_draft('x','<?php echo $page;?>','<?php echo $per_page;?>')" id="x">X</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors_draft('y','<?php echo $page;?>','<?php echo $per_page;?>')" id="y">Y</a></li>
                                	<li><a href="javascript:;" onclick="FnAuthors_draft('z','<?php echo $page;?>','<?php echo $per_page;?>')" id="z">Z</a></li>
                                	
                                	</ul>
                                	<div class="clear"></div>
    <?php 
    }
    ?>
    <div style="height: 200px; overflow-y: scroll;overflow-x: hidden; " class="dynamic_data">
    <?php
    if(isset($author_list) && count($author_list) > 0)
    {
        $i=0;
        foreach($author_list as $eachList)
        {
    ?>    
        <span class="selectAuthor_draft" data-num="<?php echo $i?>" style="background: #d0e6fe;color:#333;border-radius:4px;padding: 5px;margin: 0 10px 5px 0;cursor:pointer; float: left;width:45% ;" data-id="<?php echo $eachList['id']?>" data-name="<?php echo $eachList['name_first'].' '.$eachList['name_middle'].' '.$eachList['name_last'];?>">
        <?php //echo word_wrap($eachList['email'],30)
        	echo $eachList['name_first']." ".$eachList['name_middle']." ".$eachList['name_last'];
        ?>
        </span>
        
    <?php
        $i++;
        if($i%2==0)
        {
            ?>
            <div class="clear" style="margin-bottom: 10px;"></div>
            <?php
        }
        }
        echo $pagination;
    }
    ?>
        <!--<input name="button" type="submit" value="Send" /> <input name="button" type="button" value="Cancel" class="white" onclick="cancl()" />-->
        </div>
   
</div>
  
     <script type="text/javascript">
    jQuery(document).ready(function($) {
      $('a[rel*=facebox]').facebox({
        loadingImage : '<?=base_url()?>images/loading.gif',
        closeImage   : '<?=base_url()?>images/closelabel.png'
      })
    })
    
    function cancl()
    {
        //alert('hi');
        document.getElementById('facebox').style.display = 'none';
        document.getElementById('facebox_overlay').style.display = 'none';
    }
  </script>
<script type="text/javascript">
    BASE = '<?php echo base_url();?>';
    //$(document).bind('reveal.facebox', function() { ...stuff to do after the facebox and contents are revealed... })
    
    $(document).bind('reveal.facebox', function() { 
        $(".selectAuthor").on('click' , function(){
            var name   = $(this).attr('data-name');
             var id   = $(this).attr('data-id');
            cancl();
            //$("#showAuthorList").css("display","none");
            var ids = $("#user_email_id").val();
	     var arr = ids.split(",");
	     var index = arr.map(function(el) {
		   return parseInt(el);
	     }).indexOf(parseInt(id));
	     if(index <= -1)
	     {
            var val = $("#user_mail").val();
            if(val.trim() != "")
            {
            	val = val + ", " + name;
            	$("#user_mail").val(val.trim());
            }
            else
            {
            	$("#user_mail").val(name);
            }
            var val = ids;
            if(val.trim() != "")
            {
            	val = val + "," + id;
            	$("#user_email_id").val(val.trim());
            }
            else
            {
            	$("#user_email_id").val(id);
            }
            
            $("#email_selected").append('<span class="choosen" id="name'+id+'">'+name+'<img src="'+BASE+'images/close_22.png" onclick="removeEmail(this,'+id+')"></span>');
            }
        })
        
        
      $(".selectAuthor_1").on('click' , function(){
        
       
            var name   = $(this).attr('data-name');
             var id   = $(this).attr('data-id');
            cancl();
            //$("#showAuthorList").css("display","none");
            var ids = $("#user_email_id_1").val();
	     var arr = ids.split(",");
	     var index = arr.map(function(el) {
		   return parseInt(el);
	     }).indexOf(parseInt(id));
	     if(index <= -1)
	     {
            var val = $("#user_mail_1").val();
            if(val.trim() != "")
            {
            	val = val + ", " + name;
            	$("#user_mail_1").val(val.trim());
            }
            else
            {
            	$("#user_mail_1").val(name);
            }
            var val = ids;
            if(val.trim() != "")
            {
            	val = val + "," + id;
            	$("#user_email_id_1").val(val.trim());
            }
            else
            {
            	$("#user_email_id_1").val(id);
            }
            
            $("#email_selected_1").append('<span class="choosen" id="name'+id+'">'+name+'<img src="'+BASE+'images/close_22.png" onclick="removeEmail(this,'+id+')"></span>');
            }
            
            //alert('hi'); 
            
        }) 
        
    
    
    $(".selectAuthor_draft").on('click' , function(){
        
       
        var name   = $(this).attr('data-name');
         var id   = $(this).attr('data-id');
        cancl();
        //$("#showAuthorList").css("display","none");
        var ids = $("#user_email_id_draft").val();
         var arr = ids.split(",");
         var index = arr.map(function(el) {
               return parseInt(el);
         }).indexOf(parseInt(id));
         if(index <= -1)
         {
        var val = $("#user_mail_draft").val();
        if(val.trim() != "")
        {
            val = val + ", " + name;
            $("#user_mail_draft").val(val.trim());
        }
        else
        {
            $("#user_mail_draft").val(name);
        }
        var val = ids;
        if(val.trim() != "")
        {
            val = val + "," + id;
            $("#user_email_id_draft").val(val.trim());
        }
        else
        {
            $("#user_email_id_draft").val(id);
        }

        $("#email_selected_draft").append('<span class="choosen" id="name'+id+'">'+name+'<img src="'+BASE+'images/close_22.png" onclick="removeEmail_draft(this,'+id+')"></span>');
        }

        //alert('hi'); 

    })
        
        
})
    
    //this function to load set of authors for each page in the publisher compose mail popup
    function FnAuthors(id,page,per_page)
    {
    
    $.ajax({
                type:'POST',
                url:BASE+'home/authors_page',
		data:{id:id,page:page,per_page:per_page},
                dataType:'json',
                success:function(data){
                    var html = '';
                    if(data['status'] == "1")
                    {
                        var ps = data['author_list'];
                        
                        for (var i = 0, p; p = ps[i++];) 
                        {
                             html += '<span class="selectAuthor" data-num="'+i+'" style="background: #d0e6fe;color:#333;border-radius:4px;padding: 5px;margin: 0 10px 5px 0;cursor:pointer; float: left;width:45% ;" data-id="'+p.id+'" data-name="'+p.name_first+" "+p.name_middle+" "+p.name_last+'">';
		             html += p.name_first+" "+p.name_middle+" "+p.name_last;        
		             html += '</span>';
                             if(i%2==0)
			     {
				   
				  html += '<div class="clear" style="margin-bottom: 10px;"></div>';
				   
			     }	    
				            
                        }
                        html += data['pagination']; 
                    }
                    else if(data['status'] == "2")
                    {
                    	html = "User is not logged In.Please refresh the page and log in again.";
                    }
                    else
                    {
                        html = 'No Authors Available.';
                    }
                    
                    $(".dynamic_data").html(html);
                    $(".selectAuthor").on('click' , function(){
			    var name   = $(this).attr('data-name');
			     var id   = $(this).attr('data-id');
			    cancl();
			    //$("#showAuthorList").css("display","none");
			    var ids = $("#user_email_id").val();
			     var arr = ids.split(",");
			     var index = arr.map(function(el) {
				   return parseInt(el);
			     }).indexOf(parseInt(id));
			     if(index <= -1)
			     {
				    var val = $("#user_mail").val();
				    if(val.trim() != "")
				    {
				    	val = val + ", " + name;
				    	
				    	$("#user_mail").val(val.trim());
				    	
				    }
				    else
				    {
				    	$("#user_mail").val(name);
				    }
				    val = ids;
				    if(val.trim() != "")
				    {
				    	val = val + "," + id;
				    	$("#user_email_id").val(val.trim());
				    }
				    else
				    {
				    	$("#user_email_id").val(id);
				    }
				    $("#email_selected").append('<span class="choosen" id="name'+id+'" >'+name+'<img src="'+BASE+'images/close_22.png" onclick="removeEmail(this,'+id+')" ></span>');
			    }
			})
                    
                }
     });
    }
    
    
    
   function FnAuthors_1(id,page,per_page)
    {
    
    $.ajax({
                type:'POST',
                url:BASE+'home/authors_page',
		data:{id:id,page:page,per_page:per_page},
                dataType:'json',
                success:function(data){
                    var html = '';
                    if(data['status'] == "1")
                    {
                        var ps = data['author_list'];
                        
                        for (var i = 0, p; p = ps[i++];) 
                        {
                             html += '<span class="selectAuthor_1" data-num="'+i+'" style="background: #d0e6fe;color:#333;border-radius:4px;padding: 5px;margin: 0 10px 5px 0;cursor:pointer; float: left;width:45% ;" data-id="'+p.id+'" data-name="'+p.name_first+" "+p.name_middle+" "+p.name_last+'">';
		             html += p.name_first+" "+p.name_middle+" "+p.name_last;        
		             html += '</span>';
                             if(i%2==0)
			     {
				   
				  html += '<div class="clear" style="margin-bottom: 10px;"></div>';
				   
			     }	    
				            
                        }
                        html += data['pagination']; 
                    }
                    else if(data['status'] == "2")
                    {
                    	html = "User is not logged In.Please refresh the page and log in again.";
                    }
                    else
                    {
                        html = 'No Authors Available.';
                    }
                    
                    $(".dynamic_data").html(html);
                    $(".selectAuthor_1").on('click' , function(){
			    var name   = $(this).attr('data-name');
			     var id   = $(this).attr('data-id');
			    cancl();
			    //$("#showAuthorList").css("display","none");
			    var ids = $("#user_email_id_1").val();
			     var arr = ids.split(",");
			     var index = arr.map(function(el) {
				   return parseInt(el);
			     }).indexOf(parseInt(id));
			     if(index <= -1)
			     {
				    var val = $("#user_mail_1").val();
				    if(val.trim() != "")
				    {
				    	val = val + ", " + name;
				    	
				    	$("#user_mail_1").val(val.trim());
				    	
				    }
				    else
				    {
				    	$("#user_mail_1").val(name);
				    }
				    val = ids;
				    if(val.trim() != "")
				    {
				    	val = val + "," + id;
				    	$("#user_email_id_1").val(val.trim());
				    }
				    else
				    {
				    	$("#user_email_id_1").val(id);
				    }
				    $("#email_selected_1").append('<span class="choosen" id="name'+id+'" >'+name+'<img src="'+BASE+'images/close_22.png" onclick="removeEmail(this,'+id+')" ></span>');
			    }
			})
                    
                }
     });
    }
    
function FnAuthors_draft(id,page,per_page)
{

    $.ajax({
            type:'POST',
            url:BASE+'home/authors_page',
            data:{id:id,page:page,per_page:per_page},
            dataType:'json',
            success:function(data){
                var html = '';
                if(data['status'] == "1")
                {
                    var ps = data['author_list'];

                    for (var i = 0, p; p = ps[i++];) 
                    {
                         html += '<span class="selectAuthor_draft" data-num="'+i+'" style="background: #d0e6fe;color:#333;border-radius:4px;padding: 5px;margin: 0 10px 5px 0;cursor:pointer; float: left;width:45% ;" data-id="'+p.id+'" data-name="'+p.name_first+" "+p.name_middle+" "+p.name_last+'">';
                         html += p.name_first+" "+p.name_middle+" "+p.name_last;        
                         html += '</span>';
                         if(i%2==0)
                         {

                              html += '<div class="clear" style="margin-bottom: 10px;"></div>';

                         }	    

                    }
                    html += data['pagination']; 
                }
                else if(data['status'] == "2")
                {
                    html = "User is not logged In.Please refresh the page and log in again.";
                }
                else
                {
                    html = 'No Authors Available.';
                }

                $(".dynamic_data").html(html);
                $(".selectAuthor_draft").on('click' , function(){
                        var name   = $(this).attr('data-name');
                         var id   = $(this).attr('data-id');
                        cancl();
                        //$("#showAuthorList").css("display","none");
                        var ids = $("#user_email_id_draft").val();
                         var arr = ids.split(",");
                         var index = arr.map(function(el) {
                               return parseInt(el);
                         }).indexOf(parseInt(id));
                         if(index <= -1)
                         {
                                var val = $("#user_mail_draft").val();
                                if(val.trim() != "")
                                {
                                    val = val + ", " + name;

                                    $("#user_mail_draft").val(val.trim());

                                }
                                else
                                {
                                    $("#user_mail_draft").val(name);
                                }
                                val = ids;
                                if(val.trim() != "")
                                {
                                    val = val + "," + id;
                                    $("#user_email_id_draft").val(val.trim());
                                }
                                else
                                {
                                    $("#user_email_id_draft").val(id);
                                }alert('<span class="choosen" id="name'+id+'" >'+name+'<img src="'+BASE+'images/close_22.png" onclick="removeEmail_draft(this,'+id+')" ></span>')
                                $("#email_selected_draft").append('<span class="choosen" id="name'+id+'" >'+name+'<img src="'+BASE+'images/close_22.png" onclick="removeEmail_draft(this,'+id+')" ></span>');
                        }
                    })

            }
 });
}
    
</script>

<!---this is for Action dropdown-->
<script>
var trigger = '.trigger';
var list = '.list';
function toggleIt() {
  $(list).slideToggle(200, 'linear');
}

$(trigger).on('click', function () {
	toggleIt();
});
</script>
<!---this is for Action dropdown--> 
  
</body>
</html>

