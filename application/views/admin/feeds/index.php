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
                <h3 class="page-title"><?= $title;?></h3>
                <div class="page-bar">
                    <ul class="page-breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>
                            <a href="<?=base_url()?>admin/dashboard">Home</a>
                            <i class="fa fa-angle-right"></i>
                        </li>

                        <li>
                            <a href="<?=base_url()?>feeds/addfeedsurl"><?= $title;?></a>
                        </li>
                    </ul>
                    
                </div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
                            <div class="col-md-12">
					               
    <?php if($this->session->flashdata('success') && $this->session->flashdata('success')!=""){?>
        <div style="color: #00CA00; font-size: 18px; margin-bottom: 5px; text-align: center;">
            <?=$this->session->flashdata('success')?>
        </div>
    <?php }?>
    
    <?php if($this->session->flashdata('error') && $this->session->flashdata('error')!=""){?>
        <div style="color: red; font-size: 18px; margin-bottom: 5px; text-align: center;">
            <?=$this->session->flashdata('error')?>
        </div>
    <?php }?>
                                <div>
                        <!--        <div style="text-align: left;">
                                    <div class="form-group">
                                        <div class="col-md-3" id="ajax_cat">

                                        </div>
                                        </div>
                                </div>-->
                                <div style="text-align: right; margin-right: 5px;"><a href="<?=base_url()?>feeds/add"><button type="button" class="btn-info">Add New</button></a></div>
                                </div>
                                <div class="portlet">
                                    <div class="portlet-title">
                                            <div class="caption">
                                                    <i class="fa fa-cogs"></i>All Feeds url <span id="count_span">(<?= $countfeedsurl;?>)</span>
                                            </div>
                                            <div class="tools">
                                                    <a href="javascript:;" class="collapse"></a>

                                            </div>
                                    </div>
                                    <div class="portlet-body flip-scroll">
                                        <table class="table table-bordered table-striped table-condensed flip-content">
                                        <thead class="flip-content">
                                            <tr>
                                                <th> No.</th>
                                                <th>Link</th>
                                                <th class="numeric">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="ajax_subcat">
                                        <?php 
                                            if($feedsurl_list >0){
                                                $i = 1;
                                                foreach($feedsurl_list as $feedsurl_row){
                                            ?>
                                            <tr>
                                                <td><?= $i;?></td>
                                                <td> <?= $feedsurl_row['feeds_url'];?></td>
                                                <td class="numeric">
                                                    <a href="<?=base_url()?>feeds/edit/<?= $feedsurl_row['id'];?>" title="Edit">
                                                    <div class="fa-item col-md-3 col-sm-4"><i class="fa fa-edit"></i></div></a>
<!--                                                    <a href="javascript:(void)" onclick="delete_category('<?= $feedsurl_row['id'];?>')">Delete</a>-->
                                                </td>
                                            </tr>
                                        <?php $i++;}}?>
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
<!-- END CONTAINER -->
<?=$this->load->view('admin/template/footer.php')?>