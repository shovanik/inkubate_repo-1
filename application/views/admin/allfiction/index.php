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
                    <?php if($work_type == 1){?>
						      <a href="<?=base_url('admin/allfiction')?>"><?= $title;?></a>
                        <?php }else{?>
                              <a href="<?=base_url('admin/allnonfiction')?>"><?= $title;?></a> 
                        <?php }?>
						<i class="fa fa-angle-right"></i>
					</li>
					
				</ul>
				
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
                    <div class="col-md-6">
						<div class="form-group">
							<label class="control-label fiction"><?= $title;?></label>
							<select class="select2_category form-control" data-placeholder="Choose a Category" tabindex="1" onchange="getworkBySelect(this.value)">
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
								<i class="fa fa-cogs"></i>Total Works <span id="count_user_span">(<?php echo $count_totalwork; ?>)</span>
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse"></a>
								
							</div>
						</div>
						<div class="portlet-body flip-scroll" id="full_content_div">
							<table class="table table-bordered table-striped table-condensed flip-content">
                            <input type="hidden" name="wt_id" id="wt_id" value="<?= $work_type?>" />
							<thead class="flip-content">
    							<tr>
    								<th>Image</th>
    								<th>Details</th>
    								<th>Action</th>
    							</tr>
							</thead>
		<tbody id="search_result">
        <?php if(!empty($allfictionwork)) {
            foreach ($allfictionwork as $fictionwork) {
            ?>
            <tr class="itemld">
				<td style="width: 20%;">
                    <img src="<?= base_url('images/img_01.jpg');?>">
				</td>
				<td style="width: 50%;">
					<a href="<?= base_url('admin/work_details/'.$fictionwork['id']);?>"><strong><?= (isset($fictionwork['title']) && $fictionwork['title'] != "" )? $fictionwork['title'] : "";?></strong></a><br /> 
                    (<?= (isset($fictionwork['work_form_name']) && $fictionwork['work_form_name'] != "" )? $fictionwork['work_form_name'] : "";?>)<br />
                    by <strong><?= $fictionwork['name'];?></strong>, added <strong><?= date("F Y", strtotime($fictionwork['create_date']));?></strong><br /><br />
                    <?= (isset($fictionwork['extract']) && $fictionwork['extract'] != "" )? html_entity_decode(substr($fictionwork['extract'], 0, 150)) : "";?><br />
                    <?= (isset($fictionwork['category_name']) && $fictionwork['category_name']!= "")? "<strong>Categories :</strong> ".$fictionwork['category_name']:'';?><br />
                    <?= (isset($fictionwork['tag_name']) && $fictionwork['tag_name']!= "")? "<strong>Tags :</strong> ".$fictionwork['tag_name']:'';?>
				</td>
				<td style="width: 30%;">
					 <a href="#">Add to Judge's Bookshelf</a><br /> <br /> 
                     <a href="#">Remove from Judge's Bookshelf</a>
                </td>
			
		     </tr>
			
		<?php } } ?>
        
        <tr class="paginate pagination3"><td><?=$this->pagination->create_links()?></td></tr>
							
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
    
function getworkBySelect( value )
{
    var wt_id = $("#wt_id").val();
    $.ajax({
            url : base_url+"admin/allfictionBySearch",
            type : "post",
            data : {"value" : value, "wt_id" : wt_id},
            beforeSend : function(){
                 $("#search_result").html('<tr><td colspan="3" align="center"><img src="'+base_url+'assets/img/ajax-loader.gif"/></td></tr>'); 
            },
            success : function(data){
                data = data.split("appsbee");
                $("#count_user_span").html('('+data[1]+')');
                $("#search_result").html(data[0]);
                //console.log(data[0]);
                //alert(data)
            }
        })
    //window.location = base_url+"admin/allfiction/"+value;
}
</script>

<?=$this->load->view('admin/template/footer.php')?>