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
						<a href="<?=base_url('admin/work_details/'.$workdetails[0]['id'])?>"><?= $title;?></a>
						<i class="fa fa-angle-right"></i>
					</li>
					
				</ul>
				
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
                    <div class="col-md-6">
						<div class="form-group">
							<label class="control-label fiction"><?php ?></label>
							
						</div>
					</div>
				<div class="col-md-12">
					
					<!-- BEGIN SAMPLE TABLE PORTLET-->
					<!--<div class="portlet">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-cogs"></i>The Sparks of Undivided Duality
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse"></a>
								
							</div>
						</div>
						
					</div>-->
<style>
.work_details h4{ color:#000; font-weight:bold !important; font-size:14px !important;}
.work_details article{ padding-bottom:3px !important;}
.work_details ul{ padding-left:15px !important;}
.img_box{ border:#CCC solid 1px; margin-bottom:15px; text-align:center; padding:20px 0; margin-top:15px;}
.fileinput-button input{cursor: pointer;direction: ltr; margin: 0; opacity: 0;position: absolute; right: 0;  top: 0;} 

</style>
<?php //print_r($workdetails);?>
                    
    <div class="headline">
		<h3><?php if($workdetails[0]['title']!=""){ echo $workdetails[0]['title'];}?></h3>
	</div>
    <div class="row work_details">
        <div class="col-md-3">
        	<div class="img_box">
            <img src="<?= base_url('images/img_01.jpg');?>">
            </div>
           
            <span class="btn btn-success fileinput-button">
            <i class="fa fa-plus"></i>
            <span>Add to Judge's Bookshelf</span>
            <input type="file" multiple="" name="files[]">
            </span>
            
        </div>
        
        <div class="col-md-6">
        	   <h4>Synopsis</h4>
        <p><?= (isset($workdetails[0]['synopsis']) && $workdetails[0]['synopsis'] != "" )? html_entity_decode(substr($workdetails[0]['synopsis'], 0, 250)) : "";?></p>
               <h4>Excerpt</h4>
        <p><?= (isset($workdetails[0]['extract']) && $workdetails[0]['extract'] != "" )? html_entity_decode(substr($workdetails[0]['extract'], 0, 250)) : "";?></p>
                <h4>Attachment</h4>
        </div>
        
        <div class="col-md-3">
        <article>
        <h4>Visibility</h4>
		<p><?= (isset($workdetails[0]['visibility_name']) && $workdetails[0]['visibility_name'] != "" )? $workdetails[0]['visibility_name'] : "";?> </p>
        </article>
        
        <article>
        <h4>Author</h4>
		<p><a href="<?= base_url('userlist/userdetails/'.$workdetails[0]['user_id']);?>"><?= (isset($workdetails[0]['name']) && $workdetails[0]['name'] != "" )? $workdetails[0]['name'] : "";?></a> </p>
        </article>
        
        <article>
        <h4>Type</h4>
		<p><?= (isset($workdetails[0]['work_type_name']) && $workdetails[0]['work_type_name'] != "" )? $workdetails[0]['work_type_name'] : "";?></p>
        </article>
        
        <article>
        <h4>Form</h4>
		<p><?= (isset($workdetails[0]['work_form_name']) && $workdetails[0]['work_form_name'] != "" )? $workdetails[0]['work_form_name'] : "";?></p>
        </article>
        
        <article>
        <h4>Categories</h4>
		<ul>
        <li><?= (isset($workdetails[0]['category_name']) && $workdetails[0]['category_name'] != "" )? $workdetails[0]['category_name'] : "";?></li>
        </ul>
        </article>
        
        <?php if(isset($workdetails[0]['category_name']) && $workdetails[0]['category_name'] != ""){?>
            <article>
                <h4>Tags</h4>
                <p><?= $workdetails[0]['tag_name']?></p>
			</article>
        <?php }?>
        
        <article>
        <h4>Upload Date </h4>
		<p>October 2011</p>
        </article>
        
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

<script>
var base_url = '<?php echo base_url()?>';
jQuery.ias({
        container : '#full_content_div',
        item: '.itemld',
        pagination: '.paginate',
        next: '.nextPage a',
        loader: '<img src="'+base_url+'assets/img/ajax-loader.gif"/>',
        onPageChange: function(pageNum, pageUrl, scrollOffset) {
            //console.log('Welcome on page ' + pageNum);
        },
        onRenderComplete : function(){
            //getRatingProduct();
            //getMerchantProductRating();
        },
        history:false
    });
</script>

<?=$this->load->view('admin/template/footer.php')?>