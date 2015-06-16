<!DOCTYPE html>

<html lang="en" class="no-js">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
<meta charset="utf-8"/>
<title><?=$title?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<meta name="MobileOptimized" content="320">
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=all" rel="stylesheet" type="text/css"/>
<link href="<?=base_url()?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url()?>assets/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url()?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url()?>assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
<link href="<?=base_url()?>assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url()?>assets/plugins/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url()?>assets/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL PLUGIN STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="<?=base_url()?>assets/css/style-conquer.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url()?>assets/css/style.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url()?>assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url()?>assets/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url()?>assets/css/pages/tasks.css" rel="stylesheet" type="text/css"/>
<link href="<?=base_url()?>assets/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="<?=base_url()?>assets/css/custom.css" rel="stylesheet" type="text/css"/>

<script src="<?=base_url()?>assets/plugins/jquery-1.11.0.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/scripts/lazy_load/jquery-ias.min.js" type="text/javascript"></script>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.html"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed">

<!-- BEGIN HEADER -->
<div class="header navbar navbar-fixed-top">
	<!-- BEGIN TOP NAVIGATION BAR -->
	<div class="header-inner">
		<!-- BEGIN LOGO -->
		<div class="page-logo">
            <a href="index-2.html">
                <img src="<?=base_url()?>assets/img/logo.png" alt="logo"/>
            </a>
        </div>
        <form class="search-form search-form-header" role="form" action="http://www.keenthemes.com/preview/conquer/index.html">
            <div class="input-icon right">
                <i class="icon-magnifier"></i>
                <input type="text" class="form-control input-sm" name="query" placeholder="Search...">
            </div>
        </form>
		<!-- END LOGO -->
		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
		<a href="javascript:;" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
		<img src="<?=base_url()?>assets/img/menu-toggler.png" alt=""/>
		</a>
		<!-- END RESPONSIVE MENU TOGGLER -->
		<!-- BEGIN TOP NAVIGATION MENU -->
		<ul class="nav navbar-nav pull-right">
			<!-- BEGIN NOTIFICATION DROPDOWN -->
			<li class="dropdown" id="header_notification_bar">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
				<i class="icon-bell"></i>
				<span class="badge badge-success">
				6 </span>
				</a>
				<ul class="dropdown-menu extended notification">
					<li>
						<p>
							 You have 14 new notifications
						</p>
					</li>
					<li>
						<ul class="dropdown-menu-list scroller" style="height: 250px;">
							<li>
								<a href="#">
								<span class="label label-sm label-icon label-success">
								<i class="fa fa-plus"></i>
								</span>
								New user registered. <span class="time">
								Just now </span>
								</a>
							</li>
							<li>
								<a href="#">
								<span class="label label-sm label-icon label-danger">
								<i class="fa fa-bolt"></i>
								</span>
								Server #12 overloaded. <span class="time">
								15 mins </span>
								</a>
							</li>
							<li>
								<a href="#">
								<span class="label label-sm label-icon label-warning">
								<i class="fa fa-bell"></i>
								</span>
								Server #2 not responding. <span class="time">
								22 mins </span>
								</a>
							</li>
							<li>
								<a href="#">
								<span class="label label-sm label-icon label-info">
								<i class="fa fa-bullhorn"></i>
								</span>
								Application error. <span class="time">
								40 mins </span>
								</a>
							</li>
							<li>
								<a href="#">
								<span class="label label-sm label-icon label-danger">
								<i class="fa fa-bolt"></i>
								</span>
								Database overloaded 68%. <span class="time">
								2 hrs </span>
								</a>
							</li>
							<li>
								<a href="#">
								<span class="label label-sm label-icon label-danger">
								<i class="fa fa-bolt"></i>
								</span>
								2 user IP blocked. <span class="time">
								5 hrs </span>
								</a>
							</li>
							<li>
								<a href="#">
								<span class="label label-sm label-icon label-warning">
								<i class="fa fa-bell"></i>
								</span>
								Storage Server #4 not responding. <span class="time">
								45 mins </span>
								</a>
							</li>
							<li>
								<a href="#">
								<span class="label label-sm label-icon label-info">
								<i class="fa fa-bullhorn"></i>
								</span>
								System Error. <span class="time">
								55 mins </span>
								</a>
							</li>
							<li>
								<a href="#">
								<span class="label label-sm label-icon label-danger">
								<i class="fa fa-bolt"></i>
								</span>
								Database overloaded 68%. <span class="time">
								2 hrs </span>
								</a>
							</li>
						</ul>
					</li>
					<li class="external">
						<a href="#">See all notifications <i class="fa fa-angle-right"></i></a>
					</li>
				</ul>
			</li>
			<!-- END NOTIFICATION DROPDOWN -->
			<!-- BEGIN INBOX DROPDOWN -->
			<li class="dropdown" id="header_inbox_bar">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
				<i class="icon-envelope-open"></i>
				<span class="badge badge-info">
				5 </span>
				</a>
				<ul class="dropdown-menu extended inbox">
					<li>
						<p>
							 You have 12 new messages
						</p>
					</li>
					<li>
						<ul class="dropdown-menu-list scroller" style="height: 250px;">
							<li>
								<a href="inbox14c8.html?a=view">
								<span class="photo">
								<img src="<?=base_url()?>assets/img/avatar2.jpg" alt=""/>
								</span>
								<span class="subject">
								<span class="from">
								Lisa Wong </span>
								<span class="time">
								Just Now </span>
								</span>
								<span class="message">
								Vivamus sed auctor nibh congue nibh. auctor nibh auctor nibh... </span>
								</a>
							</li>
							<li>
								<a href="inbox14c8.html?a=view">
								<span class="photo">
								<img src="<?=base_url()?>assets/img/avatar3.jpg" alt=""/>
								</span>
								<span class="subject">
								<span class="from">
								Richard Doe </span>
								<span class="time">
								16 mins </span>
								</span>
								<span class="message">
								Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
								</a>
							</li>
							<li>
								<a href="inbox14c8.html?a=view">
								<span class="photo">
								<img src="<?=base_url()?>assets/img/avatar1.jpg" alt=""/>
								</span>
								<span class="subject">
								<span class="from">
								Bob Nilson </span>
								<span class="time">
								2 hrs </span>
								</span>
								<span class="message">
								Vivamus sed nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
								</a>
							</li>
							<li>
								<a href="inbox14c8.html?a=view">
								<span class="photo">
								<img src="<?=base_url()?>assets/img/avatar2.jpg" alt=""/>
								</span>
								<span class="subject">
								<span class="from">
								Lisa Wong </span>
								<span class="time">
								40 mins </span>
								</span>
								<span class="message">
								Vivamus sed auctor 40% nibh congue nibh... </span>
								</a>
							</li>
							<li>
								<a href="inbox14c8.html?a=view">
								<span class="photo">
								<img src="<?=base_url()?>assets/img/avatar3.jpg" alt=""/>
								</span>
								<span class="subject">
								<span class="from">
								Richard Doe </span>
								<span class="time">
								46 mins </span>
								</span>
								<span class="message">
								Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
								</a>
							</li>
						</ul>
					</li>
					<li class="external">
						<a href="inbox.html">See all messages <i class="fa fa-angle-right"></i></a>
					</li>
				</ul>
			</li>
			<!-- END INBOX DROPDOWN -->
			<!-- BEGIN TODO DROPDOWN -->
			
			<li class="devider">
				 &nbsp;
			</li>
			<!-- BEGIN USER LOGIN DROPDOWN -->
			<li class="dropdown user">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
				<img alt="" src="<?=base_url()?>assets/img/avatar3_small.jpg"/>
				<span class="username username-hide-on-mobile">Nick </span>
				<i class="fa fa-angle-down"></i>
				</a>
				<ul class="dropdown-menu">
					<li>
						<a href="#"><i class="fa fa-user"></i> My Profile</a>
					</li>
					<li>
						<a href="#"><i class="fa fa-calendar"></i> My Calendar</a>
					</li>
					<li>
						<a href="#"><i class="fa fa-envelope"></i> My Inbox <span class="badge badge-danger">
						3 </span>
						</a>
					</li>
					<li>
						<a href="#"><i class="fa fa-tasks"></i> My Tasks <span class="badge badge-success">
						7 </span>
						</a>
					</li>
					<li class="divider">
					</li>
					<li>
						<a href="<?=base_url()?>admin/logout"><i class="fa fa-key"></i> Log Out</a>
					</li>
				</ul>
			</li>
			<!-- END USER LOGIN DROPDOWN -->
		</ul>
		<!-- END TOP NAVIGATION MENU -->
	</div>
	<!-- END TOP NAVIGATION BAR -->
</div>
<!-- END HEADER -->