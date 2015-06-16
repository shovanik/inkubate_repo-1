<?php
//this file is to create a link between 
//sql server invitation tables(invitations, invitation_request) 
//and mysql invitation table(invites)
define("DB_HOST", "localhost");
define("DB_NAME", "websoluz_inkubatesdb");
define("DB_USER", "websoluz_databas");
define("DB_PASS", "A*y#h^*#s}[M");
/*define("DB_NAME", "inkubate");
define("DB_USER", "root");
define("DB_PASS", "redhat456");*/
 $mysql=($GLOBALS["___mysqli_ston"] = mysqli_connect(DB_HOST,  DB_USER,  DB_PASS)) or die ('I cannot connect to the database because: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
    ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . constant('DB_NAME'))) or die ('I cannot access the database because: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
    
 $invitation_sql = "Select invitation_requests.id, 
 			   invitations.created_usr_id, 
 			   invitations.recipient_usr_id, 
 			   invitation_requests.name, 
 			   invitation_requests.email_address,
 			   invitation_requests.create_date,
 			   invitation_requests.invitation_request_guid
 			   from invitation_requests 
 			   left join invitations on invitation_requests.invitation_guid = invitations.invitation_guid 
 			   where invitation_requests.referenced_in_invites = 0
 			   AND invitation_requests.status_id != '4' LIMIT 500
 			   ";
 //echo "purchaserequest@rcds.org";
// echo $crontab_sql;
 $invitation_result = mysqli_query($GLOBALS["___mysqli_ston"], $invitation_sql) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
 //print_r($invitation_result)."<br>";
 //$invitation_row = mysqli_fetch_assoc($invitation_result);
 //print_r($invitation_row);
// $count = 0;
while($invitation_row = mysqli_fetch_assoc($invitation_result))
{  
	//print_r($invitation_row);
	$invitation_row['recipient_usr_id'] = ($invitation_row['recipient_usr_id'] > 0) ? $invitation_row['recipient_usr_id'] : 0;
	$invitation_row['created_usr_id'] = ($invitation_row['created_usr_id'] > 0) ? $invitation_row['created_usr_id'] : 0;
	print_r($invitation_row)."<br>";
	$name =  mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $invitation_row['name']);
	//$date = date("Y-m-d h:i:s");
	
	//print_r($crontab_row);
	$invites_sql = "INSERT INTO `invites`(`user_id`, `friend_name`, `friend_email`, `created`, `is_deleted`, `status`, `invitation_request_id`) VALUES ('{$invitation_row['created_usr_id']}','{$name}','{$invitation_row['email_address']}','{$invitation_row['create_date']}','0','1','{$invitation_row['invitation_request_guid']}')";
	
        mysqli_query($GLOBALS["___mysqli_ston"], $invites_sql) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
        $id = mysqli_insert_id($GLOBALS["___mysqli_ston"]);
        
    	if($id > 0)
    	{
    		//$id = mysqli_insert_id($GLOBALS["___mysqli_ston"]);
    		$sql = "UPDATE `invitation_requests` SET `referenced_in_invites`='{$id}' where invitation_request_guid = '{$invitation_row['invitation_request_guid']}' limit 1";
    		echo $sql."<br>";
    		$result = mysqli_query($GLOBALS["___mysqli_ston"], $sql) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
    		if($invitation_row['recipient_usr_id'] > 0)
    		{
	    		$user_sql = "UPDATE `users` SET `invite_by`='{$invitation_row['created_usr_id']}',invite_id='{$id}' where id = '{$invitation_row['recipient_usr_id']}' limit 1";
	    		//echo $user_sql;
	    		$user_result = mysqli_query($GLOBALS["___mysqli_ston"], $user_sql) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
	    		
	    		$address_sql = "INSERT INTO `author_address_books`(user_id,address_user_id,is_deleted,status) VALUES ('{$invitation_row['created_usr_id']}','{$invitation_row['recipient_usr_id']}','0','1')";
	    		$user_result = mysqli_query($GLOBALS["___mysqli_ston"], $address_sql) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
	    	}
    	}
    	//$count++;
} 	
//echo $count;
//ALTER TABLE `users` CHANGE `invite_id` `invite_id` INT(11) NULL DEFAULT '0';
	//ALTER TABLE `users` CHANGE `invite_by` `invite_by` INT(11) NULL DEFAULT '0';
	
	//UPDATE `invitation_requests` SET `referenced_in_invites`='0' 
	//UPDATE `users` SET `invite_id`='0', invite_by = '0'
	//Truncate invites;
	//Truncate author_address_books;
 
?>
