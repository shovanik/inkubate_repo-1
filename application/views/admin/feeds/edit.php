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
			
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			Edit feeds Url
			</h3>
			<div class="page-bar">
                            <ul class="page-breadcrumb">
                                <li>
                                    <i class="fa fa-home"></i>
                                    <a href="<?=base_url()?>admin/dashboard">Home</a>
                                    <i class="fa fa-angle-right"></i>
                                </li>

                                    <li>
                                        <a href="<?=base_url()?>feeds/edit/<?= $details['id'];?>"><?= $title;?></a>
                                    </li>
                            </ul>
		      		
                
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
                            
                            <form class="form-horizontal" role="form" method="post" action="<?=base_url()?>feeds/edit">
                                <input type="hidden" name="id" id="id" value="<?= $details['id'];?>">
                                <div class="form-group">
                                        <label for="inputEmail1" class="col-md-2 control-label">Url :</label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" id="feeds_url" name="feeds_url" value="<?= $details['feeds_url'];?>">
                                        </div>
                                </div>
                                
                                
                                <div class="form-group">
                                        <div class="col-md-offset-2 col-md-10">
                                            <button type="submit" class="btn btn-info" name="save" id="save">Save</button>
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