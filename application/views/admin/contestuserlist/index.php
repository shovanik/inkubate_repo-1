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
			
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			Contest Users
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="<?=base_url()?>admin/dashboard">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">Contest Users</a>
						<i class="fa fa-angle-right"></i>
					</li>
					
				</ul>
				
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
					
					<!-- BEGIN SAMPLE TABLE PORTLET-->
					<div class="portlet">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-cogs"></i>Contest Users
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse"></a>
								
							</div>
						</div>
						<div class="portlet-body flip-scroll">
							<table class="table table-bordered table-striped table-condensed flip-content">
							<thead class="flip-content">
							<tr>
								<th>
									 Code
								</th>
								<th>
									 Company
								</th>
								<th class="numeric">
									 Price
								</th>
								<th class="numeric">
									 Change
								</th>
								<th class="numeric">
									 Change %
								</th>
								<th class="numeric">
									 Open
								</th>
								<th class="numeric">
									 High
								</th>
								<th class="numeric">
									 Low
								</th>
								<th class="numeric">
									 Volume
								</th>
							</tr>
							</thead>
							<tbody>
							<tr>
								<td>
									 AAC
								</td>
								<td>
									 AUSTRALIAN AGRICULTURAL COMPANY LIMITED.
								</td>
								<td class="numeric">
									 $1.38
								</td>
								<td class="numeric">
									 -0.01
								</td>
								<td class="numeric">
									 -0.36%
								</td>
								<td class="numeric">
									 $1.39
								</td>
								<td class="numeric">
									 $1.39
								</td>
								<td class="numeric">
									 $1.38
								</td>
								<td class="numeric">
									 9,395
								</td>
							</tr>
							<tr>
								<td>
									 AAD
								</td>
								<td>
									 ARDENT LEISURE GROUP
								</td>
								<td class="numeric">
									 $1.15
								</td>
								<td class="numeric">
									 +0.02
								</td>
								<td class="numeric">
									 1.32%
								</td>
								<td class="numeric">
									 $1.14
								</td>
								<td class="numeric">
									 $1.15
								</td>
								<td class="numeric">
									 $1.13
								</td>
								<td class="numeric">
									 56,431
								</td>
							</tr>
							<tr>
								<td>
									 AAX
								</td>
								<td>
									 AUSENCO LIMITED
								</td>
								<td class="numeric">
									 $4.00
								</td>
								<td class="numeric">
									 -0.04
								</td>
								<td class="numeric">
									 -0.99%
								</td>
								<td class="numeric">
									 $4.01
								</td>
								<td class="numeric">
									 $4.05
								</td>
								<td class="numeric">
									 $4.00
								</td>
								<td class="numeric">
									 90,641
								</td>
							</tr>
							<tr>
								<td>
									 ABC
								</td>
								<td>
									 ADELAIDE BRIGHTON LIMITED
								</td>
								<td class="numeric">
									 $3.00
								</td>
								<td class="numeric">
									 +0.06
								</td>
								<td class="numeric">
									 2.04%
								</td>
								<td class="numeric">
									 $2.98
								</td>
								<td class="numeric">
									 $3.00
								</td>
								<td class="numeric">
									 $2.96
								</td>
								<td class="numeric">
									 862,518
								</td>
							</tr>
							<tr>
								<td>
									 ABP
								</td>
								<td>
									 ABACUS PROPERTY GROUP
								</td>
								<td class="numeric">
									 $1.91
								</td>
								<td class="numeric">
									 0.00
								</td>
								<td class="numeric">
									 0.00%
								</td>
								<td class="numeric">
									 $1.92
								</td>
								<td class="numeric">
									 $1.93
								</td>
								<td class="numeric">
									 $1.90
								</td>
								<td class="numeric">
									 595,701
								</td>
							</tr>
							<tr>
								<td>
									 ABY
								</td>
								<td>
									 ADITYA BIRLA MINERALS LIMITED
								</td>
								<td class="numeric">
									 $0.77
								</td>
								<td class="numeric">
									 +0.02
								</td>
								<td class="numeric">
									 2.00%
								</td>
								<td class="numeric">
									 $0.76
								</td>
								<td class="numeric">
									 $0.77
								</td>
								<td class="numeric">
									 $0.76
								</td>
								<td class="numeric">
									 54,567
								</td>
							</tr>
							<tr>
								<td>
									 ACR
								</td>
								<td>
									 ACRUX LIMITED
								</td>
								<td class="numeric">
									 $3.71
								</td>
								<td class="numeric">
									 +0.01
								</td>
								<td class="numeric">
									 0.14%
								</td>
								<td class="numeric">
									 $3.70
								</td>
								<td class="numeric">
									 $3.72
								</td>
								<td class="numeric">
									 $3.68
								</td>
								<td class="numeric">
									 191,373
								</td>
							</tr>
							<tr>
								<td>
									 ADU
								</td>
								<td>
									 ADAMUS RESOURCES LIMITED
								</td>
								<td class="numeric">
									 $0.72
								</td>
								<td class="numeric">
									 0.00
								</td>
								<td class="numeric">
									 0.00%
								</td>
								<td class="numeric">
									 $0.73
								</td>
								<td class="numeric">
									 $0.74
								</td>
								<td class="numeric">
									 $0.72
								</td>
								<td class="numeric">
									 8,602,291
								</td>
							</tr>
							<tr>
								<td>
									 AGG
								</td>
								<td>
									 ANGLOGOLD ASHANTI LIMITED
								</td>
								<td class="numeric">
									 $7.81
								</td>
								<td class="numeric">
									 -0.22
								</td>
								<td class="numeric">
									 -2.74%
								</td>
								<td class="numeric">
									 $7.82
								</td>
								<td class="numeric">
									 $7.82
								</td>
								<td class="numeric">
									 $7.81
								</td>
								<td class="numeric">
									 148
								</td>
							</tr>
							<tr>
								<td>
									 AGK
								</td>
								<td>
									 AGL ENERGY LIMITED
								</td>
								<td class="numeric">
									 $13.82
								</td>
								<td class="numeric">
									 +0.02
								</td>
								<td class="numeric">
									 0.14%
								</td>
								<td class="numeric">
									 $13.83
								</td>
								<td class="numeric">
									 $13.83
								</td>
								<td class="numeric">
									 $13.67
								</td>
								<td class="numeric">
									 846,403
								</td>
							</tr>
							<tr>
								<td>
									 AGO
								</td>
								<td>
									 ATLAS IRON LIMITED
								</td>
								<td class="numeric">
									 $3.17
								</td>
								<td class="numeric">
									 -0.02
								</td>
								<td class="numeric">
									 -0.47%
								</td>
								<td class="numeric">
									 $3.11
								</td>
								<td class="numeric">
									 $3.22
								</td>
								<td class="numeric">
									 $3.10
								</td>
								<td class="numeric">
									 5,416,303
								</td>
							</tr>
							</tbody>
							</table>
						</div>
					</div>
					<!-- END SAMPLE TABLE PORTLET-->
					
					<!-- BEGIN SAMPLE TABLE PORTLET-->
					
					<!-- BEGIN SAMPLE TABLE PORTLET-->
					
					<!-- BEGIN SAMPLE TABLE PORTLET-->
					
				</div>
			</div>
			<!-- END PAGE CONTENT-->
		</div>
	</div>
	<!-- END CONTENT -->
</div>
<?=$this->load->view('admin/template/footer.php')?>