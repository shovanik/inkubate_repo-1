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
							
					<input type="hidden" name="hour_id" id="hour_id" value=""/>		
							</tbody>
    </table>