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
			
			<!-- END BEGIN STYLE CUSTOMIZER -->
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
						<a href="<?=base_url('categories/add_category')?>"><?= $title;?></a>
					</li>
				</ul>
				
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
                	<div class="portlet">
                    	<div class="portlet-title">
                        	<div class="caption">
                            <i class="fa fa-reorder"></i>
                           <?= $title;?>
                            </div>
                        </div>
                        
                        <div class="portlet-body">
                        	<form class="form-horizontal" role="form" method="post" action="<?= base_url('categories/add_category_process')?>">
                            <!--<div style="font-size: 16px; margin-left: 237px; color: #00CA00;">sfjgsdgfhgf</div>-->
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
                                                        
                                <div class="form-group">
                                <label class="col-md-3 control-label">Category :</label>
                                <div class="col-md-3">
                                <div class="radio-list">
									<label class="radio-inline">
                                        <input type="text" name="category" id="category" />
									</label>
								</div>
                                </div>
                                
                                </div>
                                
                                <div class="form-group">
                                <label class="col-md-3 control-label">Work Type :</label>
                                <div class="col-md-3">
                                <div class="radio-list">
											<label class="radio-inline">
											<input type="radio" name="work_type" id="work_type" value="1" checked> Fiction </label>
											<label class="radio-inline">
											<input type="radio" name="work_type" id="work_type" value="2"> Non Fiction </label>
											
											
										</div>
                                </div>
                                
                                </div>
                                
<!--<div class="form-group">
<label class="col-md-3 control-label"> Category : </label>
<div class="col-md-3" id="ajax_cat">
<select class="form-control" name="category" id="category"">
    <option value="">Select Category</option>
    <?php foreach($categories as $cat_row){?>
        <option value="<?= $cat_row['id']?>"><?= $cat_row['categories']?></option>
    <?php }?>
</select>
</div>
</div>


<div class="form-group">
<label class="col-md-3 control-label">Sub Category :</label>
<div class="col-md-3" id="ajax_subcat">
<select class="form-control" name="sub_cat" id="sub_cat">
    <option>Select Sub Category</option>
</select>
</div>
</div>-->

<div style="margin: 0 0 0 240px;">
					<button type="submit" class="btn btn-info">Save</button>
					<button type="button" class="btn btn-default">Cancel</button>
				</div>
                
                            </form>
                        </div>
                        
                    </div>
                
                
                </div>
			</div>
       
			<!-- END PAGE CONTENT-->
		</div>
	</div>
	<!-- END CONTENT -->
</div>
<script>
var base_url = '<?php echo base_url()?>';
function get_category( work_type )
{
    $("#work_type_hid").val(work_type);
    $.ajax({
            url : base_url+"categories/getCategory",
            type : "post",
            data : {"work_type" : work_type},
            beforeSend : function(){
                 //$("#search_result").html('<tr><td colspan="3" align="center"><img src="'+base_url+'assets/img/ajax-loader.gif"/></td></tr>'); 
            },
            success : function(data){
                //data = data.split("appsbee");
                //$("#count_user_span").html('('+data[1]+')');
                $("#ajax_cat").html(data);
                //console.log(data[0]);
                //alert(data)
            }
        })
    //window.location = base_url+"admin/allfiction/"+value;
}

function get_subcategory( cat_id )
{
    var work_type = $("#work_type_hid").val();
    $.ajax({
            url : base_url+"categories/getSubCategory",
            type : "post",
            data : {"work_type" : work_type, "cat_id" : cat_id},
            beforeSend : function(){
                 //$("#search_result").html('<tr><td colspan="3" align="center"><img src="'+base_url+'assets/img/ajax-loader.gif"/></td></tr>'); 
            },
            success : function(data){
                //data = data.split("appsbee");
                //$("#count_user_span").html('('+data[1]+')');
                $("#ajax_subcat").html(data);
                //console.log(data[0]);
                //alert(data)
            }
        })
    //window.location = base_url+"admin/allfiction/"+value;
}

</script>
<!-- END CONTAINER -->
<?=$this->load->view('admin/template/footer.php')?>