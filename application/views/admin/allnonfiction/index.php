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
			<h3 class="page-title"><?= $title;?></h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="<?=base_url()?>admin/dashboard">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?=base_url()?>admin/allfiction"><?= $title;?></a>
						<i class="fa fa-angle-right"></i>
					</li>
					
				</ul>
				
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
                    <div class="col-md-6">
						<div class="form-group">
							<label class="control-label fiction">All Fiction</label>
							<select class="select2_category form-control" data-placeholder="Choose a Category" tabindex="1">
                            <?php if(!empty($all_form)) {
                                foreach ($all_form as $forms) {
                                ?>
								<option value="<?php echo $forms['work_form_id']?>"><?php echo $forms['work_form_name']?>(<?php echo $forms['work_form_count']?>)</option>
								<?php } } ?>
							</select>
						</div>
					</div>
				<div class="col-md-12">
					
					<!-- BEGIN SAMPLE TABLE PORTLET-->
					<div class="portlet">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-cogs"></i>Create Index
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse"></a>
								
							</div>
						</div>
						<div class="portlet-body flip-scroll">
							<table class="table table-bordered table-striped table-condensed flip-content">
							<thead class="flip-content">
							<tr>
								<th>Image</th>
								<th>Details</th>
								<th class="numeric">Action</th>
							</tr>
							</thead>
							<tbody>
        <?php if(!empty($allfictionwork)) {
            foreach ($allfictionwork as $fictionwork) {
            ?>
            <tr>
				<td style="width: 20%;">
                    <img src="<?= base_url('images/img_default_headshot.png');?>">
				</td>
				<td style="width: 50%;">
					<a href=""><strong><?= $fictionwork['title'];?></strong></a><br /> 
                    (<?= $fictionwork['work_form_name'];?>)<br />
                    by <strong><?= $fictionwork['name'];?></strong>, added <strong><?= date("F Y", strtotime($fictionwork['create_date']));?></strong><br /><br />
                    <?= html_entity_decode(substr($fictionwork['extract'], 0, 150));?><br />
                    <?php echo (isset($fictionwork['category_name']) && $fictionwork['category_name']!= "")? "<strong>Categories :</strong> ".$fictionwork['category_name']:'';?><br />
                    <?php echo (isset($fictionwork['tag_name']) && $fictionwork['tag_name']!= "")? "<strong>Tags :</strong> ".$fictionwork['tag_name']:'';?>
				</td>
				<td style="width: 30%;">
					 <a href="#">Add to Judge's Bookshelf</a><br /> <br /> 
                     <a href="#">Remove from Judge's Bookshelf</a>
                </td>
			
		     </tr>
			
		<?php } } ?>
							
							
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