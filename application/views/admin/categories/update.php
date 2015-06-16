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
						<a href="<?=base_url('categories')?>"><?= $title;?></a>
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
                        	<form class="form-horizontal" role="form" method="post" action="<?= base_url('categories/update_category')?>">
                            <input type="hidden" name="work_type_hid" id="work_type_hid" value="<?php if($category_by_id['work_type_id'] == 1){echo 1;}else{echo 2;}?>" />
                                <div class="form-group">
                                <label class="col-md-3 control-label">Select Work Type :</label>
                                <div class="col-md-3">
                                <div class="radio-list">
											<label class="radio-inline">
											<input type="radio" name="optionsRadios" id="optionsRadios4" value="1" onchange="get_category(this.value)" <?php if($category_by_id['work_type_id'] == 1){?>checked<?php }?>> Fiction </label>
											<label class="radio-inline">
											<input type="radio" name="optionsRadios" id="optionsRadios5" value="2" onchange="get_category(this.value)"<?php if($category_by_id['work_type_id'] == 2){?>checked<?php }?>> Non Fiction </label>
											
											
										</div>
                                </div>
                                
                                </div>
                                
<div class="form-group">
<label class="col-md-3 control-label"> Category : </label>
<div class="col-md-3" id="ajax_cat">
<select class="form-control" name="category" id="category" onchange="get_subcategory(this.value)">
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
</div>

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