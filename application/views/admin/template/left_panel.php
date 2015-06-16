<!-- BEGIN SIDEBAR MENU -->
			<!-- DOC: for circle icon style menu apply page-sidebar-menu-circle-icons class right after sidebar-toggler-wrapper -->
			<ul class="page-sidebar-menu">
				<li class="sidebar-toggler-wrapper">
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
					<div class="sidebar-toggler">
					</div>
					<div class="clearfix">
					</div>
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
				</li>
				<li class="sidebar-search-wrapper">
					<form class="search-form" role="form" action="" method="get">
						<div class="input-icon right">
							<i class="icon-magnifier"></i>
							<input type="text" class="form-control" name="query" placeholder="Search...">
						</div>
					</form>
				</li>
                
				<li <?php if($this->uri->segment(2) == 'dashboard') {?>class="start active" <?php } ?>>
					<a href="<?=base_url()?>admin/dashboard">
					<i class="icon-home"></i>
					<span class="title">Dashboard</span>
					<span class="selected"></span>
					</a>
				</li>
				<li <?php if($this->uri->segment(1) == 'aboutus' || $this->uri->segment(1) == 'contactus'  || $this->uri->segment(1) == 'tour' || $this->uri->segment(1) == 'tags' || $this->uri->segment(1) == 'categories' || $this->uri->segment(1) == 'dashboardnews') {?>class="active" <?php } ?>>
					<a href="javascript:;">
					<i class="icon-puzzle"></i>
					<span class="title">Manage Site Content</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
                        <li <?php if($this->uri->segment(1) == 'dashboardnews') {?>class="active" <?php } ?>>
							<a href="<?=base_url()?>dashboardnews">
							<i class="icon-anchor"></i>
							Edit Dashboard News</a>
						</li>
						<li <?php if($this->uri->segment(1) == 'aboutus') {?>class="active" <?php } ?>>
							<a href="<?=base_url()?>aboutus">
							<i class="icon-anchor"></i>
							Edit About/FAQ</a>
						</li>
						<li <?php if($this->uri->segment(1) == 'contactus') {?>class="active" <?php } ?>>
							<a href="<?=base_url()?>contactus">
							<i class="icon-book-open"></i>
							Edit Contact Us</a>
						</li>
						<li <?php if($this->uri->segment(1) == 'tour') {?>class="active" <?php } ?>>
							<a href="<?=base_url()?>tour">
							<i class="icon-pin"></i>
							Edit Tour</a>
						</li>
						<li <?php if($this->uri->segment(1) == 'tags') {?>class="active" <?php } ?>>
							<a href="<?=base_url()?>tags">
							<i class="icon-vector"></i>
							<!--<span class="badge badge-warning">new</span>-->
                            Edit Tags</a>
						</li>
						<li <?php if($this->uri->segment(1) == 'categories') {?>class="active" <?php } ?>>
							<a href="<?=base_url()?>categories">
							<i class="icon-cursor"></i>
							View Categories</a>
						</li>
                        <li <?php if($this->uri->segment(1) == 'subcategories') {?>class="active" <?php } ?>>
							<a href="<?=base_url('subcategories')?>">
							<i class="icon-cursor"></i>
							View Subcategories</a>
						</li>
						
					</ul>
				</li>
				<li <?php if($this->uri->segment(1) == 'anonymousrequests' || $this->uri->segment(1) == 'assignmentrequests'  || $this->uri->segment(1) == 'invitation') {?>class="active" <?php } ?>>
					<a href="javascript:;">
					<i class="icon-present"></i>
					<span class="title">Manage Invitation Requests</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li <?php if($this->uri->segment(1) == 'anonymousrequests') {?>class="active" <?php } ?>>
							<a href="<?=base_url()?>anonymousrequests">
							From Non-Users</a>
						</li>
						<li <?php if($this->uri->segment(1) == 'assignmentrequests') {?>class="active" <?php } ?>>
							<a href="<?=base_url()?>assignmentrequests">
							From Users</a>
						</li>
						<li <?php if($this->uri->segment(1) == 'invitation') {?>class="active" <?php } ?>>
							<a href="<?=base_url()?>invitation">
							Send an Invitation</a>
						</li>
						
					</ul>
				</li>
				<li <?php if($this->uri->segment(1) == 'createindex' || $this->uri->segment(2) == 'allfiction' || $this->uri->segment(2) == 'allnonfiction') {?>class="active" <?php } ?>>
					<a href="javascript:;">
					<i class="icon-calendar"></i>
					<span class="title">Search Works</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
                    <?php $AllFiction  = $this->madmin->allFiction(); 
                          $AllNonFiction  = $this->madmin->allNonFiction();
                    ?>
						<li <?php if($this->uri->segment(2) == 'allfiction') {?>class="active" <?php } ?>>
							<a href="<?=base_url()?>admin/allfiction">All Fiction(<?php echo $AllFiction;?>)</a>
                        </li>
                        <li <?php if($this->uri->segment(2) == 'allnonfiction') {?>class="active" <?php } ?>>
                            <a href="<?=base_url()?>admin/allnonfiction">All Non-Fiction(<?php echo $AllNonFiction;?>)</a>
						</li>
						<li <?php if($this->uri->segment(1) == 'createindex') {?>class="active" <?php } ?>>
							<a href="<?=base_url()?>createindex">
							Create Index</a>
						</li>
						
					</ul>
				</li>
				<li >
					<a href="javascript:;">
					<i class="icon-docs"></i>
					<span class="title">Reporting</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						
						<li>
							<a href="http://www.google.com/analytics/" target="_blank">
							Google Analytics</a>
						</li>
						
					</ul>
				</li>
				<li <?php if($this->uri->segment(1) == 'informationrequest') {?>class="active" <?php } ?>>
					<a href="javascript:;">
					<i class="icon-share"></i>
					<span class="title">Review Information Requests</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li <?php if($this->uri->segment(1) == 'informationrequest') {?>class="active" <?php } ?>>
							<a href="<?=base_url()?>informationrequest">
							<i class="icon-settings"></i> Review requests from publishers
							</a>
							
						</li>
						
					</ul>
				</li>
				<li <?php if($this->uri->segment(1) == 'userlist' || $this->uri->segment(1) == 'contestuserlist') {?>class="active" <?php } ?>>
					<a href="javascript:;">
					<i class="icon-briefcase"></i>
					<span class="title">Manage User Profiles and Works</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li <?php if($this->uri->segment(1) == 'userlist') {?>class="active" <?php } ?>>
							<a href="<?=base_url()?>userlist">
							View Users</a>
						</li>
						<li <?php if($this->uri->segment(1) == 'contestuserlist') {?>class="active" <?php } ?>>
							<a href="<?=base_url()?>contestuserlist">
							View Contest Users</a>
						</li>
						<li>
							<a href="#">
							Download Users With Works</a>
						</li>
						<li>
							<a href="#">
							Download All Users</a>
						</li>
						<li>
							<a href="#">
							Download Invitations</a>
						</li>
						<li>
							<a href="#">
							Create a User</a>
						</li>
					</ul>
				</li>
                                
             <li <?php if($this->uri->segment(2) == 'add' || $this->uri->segment(2) == 'index' || $this->uri->segment(2) == 'feeds_list' && $this->uri->segment(1) == 'feeds') {?>class="active" <?php } ?>>
					<a href="javascript:;">
					<i class="icon-docs"></i>
					<span class="title">Manage Feeds</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
                                            <li <?php if($this->uri->segment(2) == 'add') {?>class="active" <?php } ?>>
                                                <a href="<?=base_url()?>feeds/add">
                                                Add feeds url</a>
                                            </li>
                                            <li <?php if($this->uri->segment(2) == 'index') {?>class="active" <?php } ?>>
                                                <a href="<?=base_url()?>feeds/index">
                                                View feeds url</a>
                                            </li>
                                            
                                            <li <?php if($this->uri->segment(2) == 'feeds_list') {?>class="active" <?php } ?>>
                                                <a href="<?=base_url()?>feeds/feeds_list">
                                                View feeds list</a>
                                            </li>
						
					</ul>
				</li>
                
              <li <?php if($this->uri->segment(1) == 'pitchit') {?>class="active" <?php } ?>>
					<a href="javascript:;">
					<i class="icon-share"></i>
					<span class="title">Manage Pitchits!</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
                                            
                                            <li <?php if($this->uri->segment(2) == 'pitchAdd') {?>class="active" <?php } ?>>
                                                <a href="<?=base_url()?>pitchit/pitchAdd">
                                                Add Pitchits Package</a>
                                            </li>
                                            <li <?php if($this->uri->segment(2) == 'pitchDetails') {?>class="active" <?php } ?>>
                                                <a href="<?=base_url()?>pitchit/pitchDetails">
                                                Pitchit Package List</a>
                                            </li>
                                            
                                            <li <?php if($this->uri->segment(2) == 'pitchitHour') {?>class="active" <?php } ?>>
                                                <a href="<?=base_url()?>pitchit/pitchitHour">
                                                Pitchit Control List</a>
                                            </li>
                                            
						
					</ul>
				</li>  
				
			</ul>
        <!-- END SIDEBAR MENU -->    