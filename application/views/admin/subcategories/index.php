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
			<?= $title;?>
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="<?=base_url('admin/dashboard')?>">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?=base_url('subcategories')?>"><?= $title;?></a>
						<i class="fa fa-angle-right"></i>
					</li>
					
				</ul>
				
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
					<?php if($this->session->flashdata('success') && $this->session->flashdata('success')!=""){?>
                        <div style="color: #00CA00; font-size: 16px; margin-left: 237px;">
                            <?=$this->session->flashdata('success')?>
                        </div>
                    <?php }?>
                
                    <?php if($this->session->flashdata('error') && $this->session->flashdata('error')!=""){?>
                        <div style="color: red; font-size: 16px; margin-left: 237px;">
                            <?=$this->session->flashdata('error')?>
                        </div>
                    <?php }?>
					<!-- BEGIN SAMPLE TABLE PORTLET-->
    <div>
        <div style="text-align: left;">
            <div class="form-group">
                <div class="col-md-3" id="ajax_cat">
                <select class="form-control" name="category" id="category" onchange="get_subcategory(this.value)">
                    <option value="">Select Category</option>
                    <?php foreach($categories as $cat_row){?>
                        <option value="<?= $cat_row['id']?>"><?= $cat_row['categories']?></option>
                    <?php }?>
                </select>
                </div>
                </div>
        </div>
        <div style="text-align: right; margin-right: 5px;"><a href="<?= base_url('subcategories/add_subcategory')?>"><button type="button" class="btn-info">Add New</button></a></div>
	</div>
                    <div class="portlet">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-cogs"></i>All Sub Category <span id="count_span">(<?php echo $count_subcategory; ?>)</span>
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
        								<th>Sub Category</th>
        								<th class="numeric">Action</th>
        							</tr>
    							</thead>
							<tbody id="ajax_subcat">
                                <?php 
                                $i = 1;
                                foreach($subcategories as $row_cat){?>
    							<tr>
    								<td><?= $i;?></td>
    								<td><?= $row_cat['categories']?></td>
    								<td class="numeric"><a href="<?= base_url('subcategories/edit_subcategory/'.$row_cat['id'])?>">Edit</a> <br />
                                    <a href="javascript:(void)" onclick="delete_category('<?php echo $row_cat['id'];?>')">Delete</a></td>
    							</tr>
                                <?php $i++;}?>
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
function get_subcategory( cat_id )
{
    $.ajax({
            url : base_url+"categories/getSubCategory",
            type : "post",
            data : { "cat_id" : cat_id},
            beforeSend : function(){
                 $("#ajax_subcat").html('<tr><td colspan="3" align="center"><img src="'+base_url+'assets/img/ajax-loader.gif"/></td></tr>'); 
            },
            success : function(data){
                //data = data.split("appsbee");
                $("#count_span").html('('+data[1]+')');
                $("#ajax_subcat").html(data);
                //console.log(data[0]);
                //alert(data)
            }
        })
    //window.location = base_url+"admin/allfiction/"+value;
}

function delete_category( id )
{
    var r = confirm("Do you want to delete sub category?");
    if (r == true) {
        window.location = base_url+'subcategories/deleteSubCategory/'+id;
    } else {
        return false;
    }
}
</script>


<?=$this->load->view('admin/template/footer.php')?>