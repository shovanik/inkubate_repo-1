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
						<a href="<?=base_url()?>admin/dashboard">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?=base_url('userlist/userdetails/'.$user_details['id'])?>"><?= $title;?></a>
						<i class="fa fa-angle-right"></i>
					</li>
					
				</ul>
				
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
					<div style="font-size: 20px; font-weight: bold;">
                    <?php 
                    if(!empty($user_details['name_first']) || !empty($user_details['name_middle']) || !empty($user_details['name_last']) ) 
                        echo $user_details['name_first']." ".$user_details['name_middle']." ".$user_details['name_last'];
                    
                    ?></div>
                    <table class="table table-bordered table-striped table-condensed flip-content" >
							<thead class="flip-content">
							<tr>
								<th>Image</th>
								<th>Biography</th>
								<th>Address</th>
                            </tr>
							</thead>
							<tbody id="search_result">
                                <tr class="itemld">
    								<td style="width: 20%;">
                                    <?php if(empty($user_details['image'])){?>
                                        <img src="<?=base_url('images/img_default_headshot.png')?>" />
                                    <?php }else{?>
    									 <img src="<?=base_url()?>uploadImage/<?=$user_details['id']?>/profile/medium/<?=$user_photo['image']?>" alt="<?= $user_photo['image'];?>" />
    								<?php }?>
                                    </td>
    								<td>
    									<?php if(!empty($user_biography['biography'])) echo html_entity_decode($user_biography['biography']);?>
    								</td>
    								<td class="numeric" style="width: 25%;">
    									<strong>Zip Code :</strong> <br /><?php if(!empty($user_details['postal_code'])) echo $user_details['postal_code'];?><br />
                                        <strong>Email :</strong> <br /><?php if(!empty($user_details['email'])) echo $user_details['email'];?><br />
                                        <strong>Member Since :</strong> <br /><?php if(!empty($user_details['created'])) echo date('m/d/Y',strtotime($user_details['created']));?><br />
                                        <strong>Date Of Birth :</strong> <br /><?php if(!empty($user_details['date_of_birth'])) echo date('m/d/Y',strtotime($user_details['date_of_birth']));?><br />
                                        <strong>Works Uploaded :</strong> <br /><?php echo (count($user_work) > 0) ? count($user_work) : "0";?>
    								</td>
                                </tr>                             
							</tbody>
                            
							</table>
						
				
                    
					<!-- BEGIN SAMPLE TABLE PORTLET-->
					<div class="portlet">
						<div class="portlet-title">
							<div class="caption">
								
							</div>
							<div class="tools">
                                <!--<input type="text" name="user_search" id="user_search" placeholder="Search..." />-->
								<a href="javascript:;" class="collapse"></a>
								
							</div>
						</div>
						<div class="portlet-body flip-scroll" id="full_content_div">
							<table class="table table-bordered table-striped table-condensed flip-content" >
							<thead class="flip-content">
							<tr>
								<th>Book Cover</th>
								<th>Title</th>
								<th>Type</th>
                                <th>Category</th>
								
							</tr>
							</thead>
							<tbody id="search_result">
                            
                            <?php
                            //echo '<pre/>';print_r($totaluser);die;
                            if(!empty($user_work))
                            {
                                 foreach($user_work as $user)
                                 { 
                            ?>
							<tr class="itemld">
								<td>
									 <img src="<?=base_url('images/img_01.jpg')?>" alt="" />
								</td>
								<td>
									<?= $user['title'];?>
								</td>
								<td class="numeric">
									<?= $user['work_type_name'];?>
								</td>
                                
                                <td class="numeric">
									<?= $user['category_name'];?>
								</td>
                                								
							</tr>
						     <?php } } ?>
                             <tr class="paginate pagination3"><td><?=$this->pagination->create_links()?><?//=$this->ajax_pagination->create_links()?></td></tr>                             
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
//alert('<img src="'+base_url+'assets/img/ajax-loader.gif"/');
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
    
    
$(document).ready(function(){
    $("#user_search").keyup(function(){
        var value = $("#user_search").val();
        $.ajax({
            url : base_url+"userlist/user_search",
            type : "post",
            data : {"value" : value},
            beforeSend : function(){
                 $("#search_result").html('<tr><td colspan="3" align="center"><img src="'+base_url+'assets/img/ajax-loader.gif"/></td></tr>'); 
            },
            success : function(data){
                data = data.split("appsbee");
                $("#count_user_span").html('('+data[1]+')');
                $("#search_result").html(data[0]);
                //alert(data)
            }
        })
    })
})

</script>

<?=$this->load->view('admin/template/footer.php')?>