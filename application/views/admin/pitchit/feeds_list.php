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
					                
                    					<!-- BEGIN SAMPLE TABLE PORTLET-->
                                <div>
                        <!--        <div style="text-align: left;">
                                    <div class="form-group">
                                        <div class="col-md-3" id="ajax_cat">

                                        </div>
                                        </div>
                                </div>-->
                        <div style="text-align: right; margin-right: 5px;"><button type="button" class="btn-info" onclick="addToHome()">Add to home</button></div>
                                </div>
                                <div class="portlet">
                                    <div class="portlet-title">
                                            <div class="caption">
<!--                                                    <i class="fa fa-cogs"></i>All Feeds url <span id="count_span">()</span>-->
                                            </div>
                                            <div class="tools">
                                                    <a href="javascript:;" class="collapse"></a>

                                            </div>
                                    </div>
                                    <div class="portlet-body flip-scroll">
                                        <script>
                                            function addToHome(){
                                                var favorite = [];
                                                var feedsValue = [];
                                                $.each($("input[name='checkbox']:checked"), function(){            
                                                    favorite.push($(this).val());
                                                });
                                                //alert("My favourite sports are: " + favorite.join(", "));return false;
                                              
                                                if(favorite.length > 0)
                                                {
                                                    for (var i = 0; i < favorite.length; i++) {
                                                        feedsValue.push({
                                                            guid   :    $('#guid_'+favorite[i]).val(),
                                                            title   :   $('#tr_'+favorite[i]).find('td:eq(1)').html(),
                                                            link    :   $('#tr_'+favorite[i]).find('td:eq(2)').html(),
                                                            desc    :   $('#tr_'+favorite[i]).find('td:eq(3)').html(),
                                                            date    :   $('#tr_'+favorite[i]).find('td:eq(4)').html()
                                                        });
                                                    }
                                                }
                                                
                                                $.ajax({
                                                    url      : '<?=base_url()?>'+'feeds/add_feeds',
                                                    type     : 'POST',
                                                    data     : { 'feeds_array':feedsValue },
                                                    success  : function(resp){//return false;
                                                        if(resp == '1'){
                                                            window.location.reload();
                                                        }else{
                                                            //alert("There are some problem to add feeds.")
                                                        }
                                                    },
                                                    error    : function(resp){
                                                         $.prompt("Sorry, something isn't working right.", {title:'Error'});
                                                    }
                                                 });
                                                
                                                console.log(feedsValue)
                                              
                                            }
                                
                                
                                        </script>  
                                        <table class="table table-bordered table-striped table-condensed flip-content">
                                        <thead class="flip-content">
                                            <tr>
                                                <th> <!--<input type="checkbox" id="all_check">--> </th>
<!--                                                <th> Image </th>-->
                                                <th> Title </th>
                                                <th> Link </th>
                                                <th>Description</th>
                                                <th>Date</th>
<!--                                                <th class="numeric">Action</th>-->
                                            </tr>
                                        </thead>
                                        <tbody id="feed_list_tbody">
                                        <?php 
                                        
                                            $i = 1;
                                            foreach($details as $row){
                                                //$content = $row->media->content->attributes();
                                                //echo $content->url;
                                                //$feeds_title = $this->mfeeds->getFeedsByTitle($row->title);
                                                $feeds_guid = $this->mfeeds->getFeedsByGuid($row->guid);
                                                //print_r($feeds_title);die;
                                            ?>
                                            <tr id="tr_<?= $i;?>">
                                                <td><input type="checkbox" name="checkbox" id="checkbox_<?= $i;?>" value="<?= $i;?>" class="checkbox1" <?php if($feeds_guid == "$row->guid"){echo "checked";}?>>
                                                    <input type="hidden" name="guid_<?= $i;?>" id="guid_<?= $i;?>" value="<?php echo $row->guid;?>">
                                                </td>
<!--                                                <td><img src="<?php echo $row->url;?>" height="30" /></td>-->
                                                <td><?php echo $row->title;?></td>
                                                <td><?php echo $row->link;?></td>
                                                <td> <?php echo $row->description;?></td>
                                                <td> <?php echo $row->pubDate;?></td>
                                                
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
<!-- END CONTAINER -->
<?=$this->load->view('admin/template/footer.php')?>