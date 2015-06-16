<?=$this->load->view('admin/template/header.php')?>

<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
	<!-- BEGIN SIDEBAR -->
	<div class="page-sidebar-wrapper">
		<div class="page-sidebar navbar-collapse collapse">
		
        <?=$this->load->view('admin/template/left_panel.php')?>
        	
		</div>
	</div>
	<!-- END SIDEBAR -->
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Modal title</h4>
						</div>
						<div class="modal-body">
							 Widget settings form goes here
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-success">Save changes</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<!-- BEGIN STYLE CUSTOMIZER -->
			<div class="theme-panel hidden-xs hidden-sm">
				<!--<div class="toggler">
					<i class="fa fa-gear"></i>
				</div>-->
				<div class="theme-options">
					<div class="theme-option theme-colors clearfix">
						<span>
						Theme Color </span>
						<ul>
							<li class="color-black current color-default tooltips" data-style="default" data-original-title="Default">
							</li>
							<li class="color-grey tooltips" data-style="grey" data-original-title="Grey">
							</li>
							<li class="color-blue tooltips" data-style="blue" data-original-title="Blue">
							</li>
							<li class="color-red tooltips" data-style="red" data-original-title="Red">
							</li>
							<li class="color-light tooltips" data-style="light" data-original-title="Light">
							</li>
						</ul>
					</div>
					<div class="theme-option">
						<span>
						Layout </span>
						<select class="layout-option form-control input-small">
							<option value="fluid" selected="selected">Fluid</option>
							<option value="boxed">Boxed</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
						Header </span>
						<select class="header-option form-control input-small">
							<option value="fixed" selected="selected">Fixed</option>
							<option value="default">Default</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
						Sidebar </span>
						<select class="sidebar-option form-control input-small">
							<option value="fixed">Fixed</option>
							<option value="default" selected="selected">Default</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
						Sidebar Position </span>
						<select class="sidebar-pos-option form-control input-small">
							<option value="left" selected="selected">Left</option>
							<option value="right">Right</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
						Footer </span>
						<select class="footer-option form-control input-small">
							<option value="fixed">Fixed</option>
							<option value="default" selected="selected">Default</option>
						</select>
					</div>
				</div>
			</div>
			<!-- END BEGIN STYLE CUSTOMIZER -->
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			Dashboard <small>statistics and more</small>
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="<?=base_url()?>admin/dashboard">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">Dashboard</a>
					</li>
				</ul>
				<div class="page-toolbar">
					<div id="dashboard-report-range" class="pull-right tooltips btn btn-fit-height btn-primary" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range">
						<i class="icon-calendar"></i>&nbsp; <span class="thin uppercase visible-lg-inline-block"></span>&nbsp; <i class="fa fa-angle-down"></i>
					</div>
				</div>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN OVERVIEW STATISTIC BARS-->
			<div class="row stats-overview-cont">
				<div class="col-md-2 col-sm-4">
					<div class="stats-overview stat-block">
						<div class="display stat ok huge">
							<span class="line-chart">
							5, 6, 7, 11, 14, 10, 15, 19, 15, 2 </span>
							<div class="percent">
								 +66%
							</div>
						</div>
						<div class="details">
							<div class="title">
								 Users
							</div>
							<div class="numbers">
								 1360
							</div>
						</div>
						<div class="progress">
							<span style="width: 40%;" class="progress-bar progress-bar-info" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100">
							<span class="sr-only">
							66% Complete </span>
							</span>
						</div>
					</div>
				</div>
				
				<div class="col-md-2 col-sm-4">
					<div class="stats-overview stat-block">
						<div class="display stat good huge">
							<span class="bar-chart">
							1,4,9,12, 10, 11, 12, 15, 12, 11, 9, 12, 15, 19, 14, 13, 15 </span>
							<div class="percent">
								 +86%
							</div>
						</div>
						<div class="details">
							<div class="title">
								 Revenue
							</div>
							<div class="numbers">
								 1550
							</div>
							<div class="progress">
								<span style="width: 56%;" class="progress-bar progress-bar-warning" aria-valuenow="56" aria-valuemin="0" aria-valuemax="100">
								<span class="sr-only">
								56% Complete </span>
								</span>
							</div>
						</div>
					</div>
				</div>
				
				
			</div>
			<!-- END OVERVIEW STATISTIC BARS-->
			<div class="clearfix">
			</div>
			
			<div class="clearfix">
			</div>
			<div class="row ">
				<div class="col-md-6 col-sm-6">
					<div class="portlet">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-bell"></i>Recently Joined Users
							</div>
                            <div class="tools">
								<a href="#" class="collapse"></a>
								
							</div>
							<!--<div class="actions">
								<div class="btn-group">
									<a class="btn btn-default btn-sm dropdown-toggle" href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
									Filter By <i class="fa fa-angle-down"></i>
									</a>
									<div class="dropdown-menu hold-on-click dropdown-checkboxes pull-right">
										<label><input type="checkbox"/> Finance</label>
										<label><input type="checkbox" checked=""/> Membership</label>
										<label><input type="checkbox"/> Customer Support</label>
										<label><input type="checkbox" checked=""/> HR</label>
										<label><input type="checkbox"/> System</label>
									</div>
								</div>
							</div>-->
						</div>
						<div class="portlet-body">
							<div class="table-scrollable">
								<table class="table table-striped table-bordered table-hover">
								<thead>
								<tr>
									<th>
										 From
									</th>
									<th>
										 Contact
									</th>
									<th>
										 Amount
									</th>
									<th>
									</th>
								</tr>
								</thead>
								<tbody>
								<tr>
									<td>
										<a href="#">Ikea</a>
									</td>
									<td>
										 Elis Yong
									</td>
									<td>
										 4560.60$ 
									</td>
									<td>
										<a href="#" class="btn btn-default btn-xs">View</a>
									</td>
								</tr>
								<tr>
									<td>
										<a href="#">Apple</a>
									</td>
									<td>
										 Daniel Kim
									</td>
									<td>
										 360.60$
									</td>
									<td>
										<a href="#" class="btn btn-default btn-xs">View</a>
									</td>
								</tr>
								<tr>
									<td>
										<a href="#">37Singals</a>
									</td>
									<td>
										 Edward Cooper
									</td>
									<td>
										 960.50$ 
									</td>
									<td>
										<a href="#" class="btn btn-default btn-xs">View</a>
									</td>
								</tr>
								<tr>
									<td>
										<a href="#">Google</a>
									</td>
									<td>
										 Paris Simpson
									</td>
									<td>
										 1101.60$ 
									</td>
									<td>
										<a href="#" class="btn btn-default btn-xs">View</a>
									</td>
								</tr>
								<tr>
									<td>
										<a href="#">Ikea</a>
									</td>
									<td>
										 Elis Yong
									</td>
									<td>
										 4560.60$ 
									</td>
									<td>
										<a href="#" class="btn btn-default btn-xs">View</a>
									</td>
								</tr>
								<tr>
									<td>
										<a href="#">Google</a>
									</td>
									<td>
										 Paris Simpson
									</td>
									<td>
										 1101.60$ 
									</td>
									<td>
										<a href="#" class="btn btn-default btn-xs">View</a>
									</td>
								</tr>
								</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-sm-6">
					<div class="portlet tasks-widget">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-check"></i>Notifications
							</div>
							<div class="tools">
								<a href="#" class="collapse"></a>
							</div>
							<div class="actions">
								<div class="btn-group">
									<!--<a class="btn btn-info btn-sm dropdown-toggle" href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
									More <i class="fa fa-angle-down"></i>
									</a>-->
									<ul class="dropdown-menu pull-right">
										<li>
											<a href="#"><i class="i"></i> All Project</a>
										</li>
										<li class="divider">
										</li>
										<li>
											<a href="#">AirAsia</a>
										</li>
										<li>
											<a href="#">Cruise</a>
										</li>
										<li>
											<a href="#">HSBC</a>
										</li>
										<li class="divider">
										</li>
										<li>
											<a href="#">Pending <span class="badge badge-important">
											4 </span>
											</a>
										</li>
										<li>
											<a href="#">Completed <span class="badge badge-success">
											12 </span>
											</a>
										</li>
										<li>
											<a href="#">Overdue <span class="badge badge-warning">
											9 </span>
											</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="portlet-body">
							<div class="task-content">
								<div class="scroller" style="height: 305px;" data-always-visible="1" data-rail-visible1="1">
									<!-- START TASK LIST -->
									<ul class="task-list">
										<li>
											
											<div class="task-title">
												<span class="task-title-sp">
												Present 2013 Year IPO Statistics at Board Meeting </span>
												
											</div>
											
										</li>
										<li>
											
											<div class="task-title">
												<span class="task-title-sp">
												Hold An Interview for Marketing Manager Position </span>
												
											</div>
											
										</li>
										<li>
											
											<div class="task-title">
												<span class="task-title-sp">
												AirAsia Intranet System Project Internal Meeting </span>
												
											</div>
											
										</li>
										<li>
											
											<div class="task-title">
												<span class="task-title-sp">
												Technical Management Meeting </span>
												
											</div>
											
										</li>
										<li>
											
											<div class="task-title">
												<span class="task-title-sp">
												Kick-off Company CRM Mobile App Development </span>
												
											</div>
											
										</li>
										<li>
											
											<div class="task-title">
												<span class="task-title-sp">
												Prepare Commercial Offer For SmartVision Website Rewamp </span>
												
											</div>
											
										</li>
										<li>
											
											<div class="task-title">
												<span class="task-title-sp">
												Sign-Off The Comercial Agreement With AutoSmart </span>
												
											</div>
											
										</li>
										<li>
											
											<div class="task-title">
												<span class="task-title-sp">
												Company Staff Meeting </span>
												
											</div>
											
										</li>
										<li class="last-line">
											
											<div class="task-title">
												<span class="task-title-sp">
												KeenThemes Investment Discussion </span>
												
											</div>
											
										</li>
									</ul>
									<!-- END START TASK LIST -->
								</div>
							</div>
							
						</div>
					</div>
				</div>
			</div>
			<div class="clearfix">
			</div>
			
			<div class="clearfix">
			</div>
			
			<div class="clearfix">
			</div>
			
		</div>
	</div>
	<!-- END CONTENT -->
    
</div>
<!-- END CONTAINER -->

<?=$this->load->view('admin/template/footer.php')?>

