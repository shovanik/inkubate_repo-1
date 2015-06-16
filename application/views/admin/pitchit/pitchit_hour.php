<?=$this->load->view('admin/template/header.php')?>

<div class="clearfix">
</div>

<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("button").click(function(){
            var favorite = [];
            $.each($("input[name='pit']:checked"), function(){            
                favorite.push($(this).val());
            });
            var hour_id = $('#hour_id').val();
            var pitchit_id = favorite.join(", ");
            //alert(pitchit_id);
            //alert("My favourite pitchit are: " + pitchit +' , '+hour_id);
           if(pitchit_id != '')
         { 
            $.ajax({
            url      : '<?=base_url()?>'+'pitchit/add_pitchit_hour',
            type     : 'POST',
            data     : { 'pitchit_id': pitchit_id , 'hour_id':hour_id },
            success  : function(resp){
                
                //alert(resp);
                if(resp != '0'){
                    //location.reload();
                    $('#allow_success').text('Successfully allow the seleted pitchits! time');
                    $('#all_pitchit').html(resp);
                }
            },
            error    : function(resp){
                alert("Sorry, something isn't working right.");
            }
           });
           
         }
         else
         {
            alert('Please select one pitchits!');
         }
           
            
        });
    });
    
   function select_hour(hid)
   {
     //alert(hid);
     $('#hour_id').val(hid);
   } 
</script>
<style>
.select_hour{float:left;  width:60%;}
.set_time{float:left; margin:27px 0 0 15px;}
.set_time_btn{background:#39302c; border:none; outline:none; cursor:pointer; padding:6px 15px; text-align:center; color:#fff; font-size:14px; border-radius:8px; -moz-border-radius:8px; -webkit-border-radius:8px; -ms-border-radius:8px; -o-border-radius:8px;}
.set_time_btn:hover{background:#181413;}
</style>

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
						<a href="<?=base_url()?>pitchit/pitchitHour"><?= $title;?></a>
						<i class="fa fa-angle-right"></i>
					</li>
					
				</ul>
				
               <?php
               //$start = '2014-06-01 14:00:00';
               //$start = date("Y-m-d h:i:s");;
                //display the converted time
                //echo date('Y-m-d H:i:s',strtotime('+48 hour +20 minutes',strtotime($start)));
               ?> 
                
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
            
            <span style="color: #2FF329;" id="allow_success"></span>
                    <div class="col-md-6">
                    <div class="select_hour">
						<div class="form-group">
							<label class="control-label fiction">Select Hour</label>
							<select class="select2_category form-control" data-placeholder="Choose a Category" tabindex="1" onchange="select_hour(this.value)">
                            <option value="">-----Select Hour-----</option>
                            <?php if(!empty($all_hour)) {
                                foreach ($all_hour as $hour) {
                                ?>
								<option value="<?php echo $hour['hour']?>"><?php echo $hour['hour']?></option>
								<?php } } ?>
							</select>
						</div>
                        <input type="hidden" name="hour_id" id="hour_id" value=""/>	
                        </div>
                        <div class="set_time"><button type="button" class="set_time_btn">Set Time</button></div>
                        <div class="clear"></div>
                        
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
						<div class="portlet-body flip-scroll" id="all_pitchit">
							<table class="table table-bordered table-striped table-condensed flip-content">
							<thead class="flip-content">
							<tr>
								<th>Select</th>
								<th>Pitchit</th>
								<th class="numeric">Created at</th>
                                <th class="numeric">Allow time(hours)</th>
							</tr>
							</thead>
							<tbody>
        <?php if(!empty($allPitchit)) {
            foreach ($allPitchit as $pitchit) {
            ?>
            <tr>
				<td style="width: 10%;">
                    <input type="checkbox" value="<?=$pitchit['pit_id']?>" name="pit">
				</td>
				<td style="width: 50%;">
					
                    <strong><?=$pitchit['pitchit']?></strong>
                    
				</td>
				<td style="width: 20%;">
				
                     <?php 
                        if(!empty($pitchit['created_date']))
                            {
                            $date = $pitchit['created_date'];
                            $timestamp = strtotime($date);
                            $new_date = date("m/d/y", $timestamp);
                            echo $new_date;
                            }
                            else
                            {
                              echo 'N/A';  
                            }
                        ?>
                
                </td>
			
            <td style="width: 20%;">
					 <?php 
                     if(!empty($pitchit['allow_hour']))
                     {
                        echo $pitchit['allow_hour'];
                     }
                     else
                     {
                        echo 'Life Time';
                     }
                     ?>
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