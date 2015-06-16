<?=$this->load->view('admin/template/header.php')?>
<script>
function cancel_news()
{
    window.location.href = '<?=base_url()?>dashboardnews';
}
</script>
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
			
			<!-- END BEGIN STYLE CUSTOMIZER -->
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			Edit Dashboard News
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="<?=base_url()?>admin/dashboard">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
					
					<li>
						<a href="<?=base_url()?>/dashboardnews/editDashboardNews">Edit Dashboard News</a>
					</li>
				</ul>
		      		
                
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
            <form class="form-horizontal" role="form" method="post" action="<?=base_url()?>dashboardnews/editDashboardNews">
			<div class="row">
				<div class="col-md-12">
                <textarea class="ckeditor" cols="80" name="content"  id="editor2" >
                
                 <?=$news['content'];?>
				
                
                </textarea></div>
                
                <div class="form-group">
                                        <label for="inputEmail1" class="col-md-2 control-label">Active</label>
                                        <div class="col-md-4">
                                            <input type="radio" class="form-control" id="feeds_url" name="active" value="1" <?php if($news['status'] == '1'){?> checked="checked" <?php } ?>/>Yes
                                        
                                            <input type="radio" class="form-control" id="feeds_url2" name="active" value="0" <?php if($news['status'] == '0'){?> checked="checked" <?php } ?>/>No
                                        </div>
                                </div>
				
                <div class="form-actions">
					<button type="submit" class="btn btn-info">Submit</button>
					<button type="button" class="btn btn-default" onclick="cancel_news()">Cancel</button>
				</div>
                	
			</div>
            </form>
			<!-- END PAGE CONTENT-->
		</div>
	</div>
	<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<?=$this->load->view('admin/template/footer.php')?>