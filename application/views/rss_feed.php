

<table>
    <?php 
    //echo "<pre>".print_r( $details )."</pre>";die;
    foreach($details as $row){?>
    <tr><td>Title : </td><td><?php echo $row->title;?></td></tr>
    <tr><td>Date : </td><td><?php echo $row->pubDate;?></td></tr>
    <tr><td width="10%">Description : </td><td><?php echo $row->description;?></td></tr>
    <tr><td></td></tr>
    <?php }?>
</table>