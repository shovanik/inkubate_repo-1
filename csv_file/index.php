<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Upload page</title>
<style type="text/css">
body {
	background: #E3F4FC;
	font: normal 14px/30px Helvetica, Arial, sans-serif;
	color: #2b2b2b;
}
a {
	color:#898989;
	font-size:14px;
	font-weight:bold;
	text-decoration:none;
}
a:hover {
	color:#CC0033;
}

h1 {
	font: bold 14px Helvetica, Arial, sans-serif;
	color: #CC0033;
}
h2 {
	font: bold 14px Helvetica, Arial, sans-serif;
	color: #898989;
}
#container {
	background: #CCC;
	margin: 100px auto;
	width: 945px;
}
#form 			{padding: 20px 150px;}
#form input     {margin-bottom: 20px;}
</style>
</head>
<body>
<div id="container">
<div id="form">

<?php

include "connection.php"; //Connect to Database

//$deleterecords = "TRUNCATE TABLE users22"; //empty the table of its current records
//mysql_query($deleterecords);

//Upload File
if (isset($_POST['submit'])) {
	if (is_uploaded_file($_FILES['filename']['tmp_name'])) {
		echo "<h1>" . "File ". $_FILES['filename']['name'] ." uploaded successfully." . "</h1>";
		echo "<h2>Displaying contents:</h2>";
		//readfile($_FILES['filename']['tmp_name']);
        	
	}

	//Import uploaded file to Database
	$handle = fopen($_FILES['filename']['tmp_name'], "r");
    $data = fgetcsv($handle, 1000, ",");
    //echo '<pre/>';print_r($data = fgetcsv($handle, 1000, ","));die;
    //echo $data[0];die;
    $i = 0;
	while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
	   
       //echo '<pre/>'.$data[9].'<br/>';
       
       
       $sql = "SELECT * FROM `users` WHERE `username`='".$data[0]."'";
       $result = mysql_query($sql);
       $rowcount = mysql_num_rows($result);
       
       
       if($data[9] == 'Male')
       {
         $gender = '1';
         //echo count($data[9]);
         
       }
       elseif($data[9] == 'Female')
       {
         $gender = '2';
         
       }
       else
       {
         $gender = '';
         //$i = $i+1;
       }
       
       if($data[11] == 'Duplicate' || $data[11] == 'Tester' || $data[11] == 'Admin')
       {
         $duplicate = '1';
         //echo count($data[9]);
         
       }
       else
       {
        $duplicate = '0';
       }
       //echo 'hi'.$rowcount;
       if($rowcount > 0)
       {
       
       
       echo $import = "UPDATE users SET `age`='".$data[7]."',`gender`='".$gender."', `user_type` = '1',`is_exist` = '1', `status_id` = '1' , `duplicate` = '".$duplicate."' WHERE `username`='".$data[0]."'";
		//$import="INSERT into users(item1,item2,item3,item4,item5) values('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]')";

		mysql_query($import) or die(mysql_error());
      }
      else
      {
        $today = date('Y-m-d h:i:s');
        $date = $data[5];
       $dob = date('Y-m-d h:i:s', strtotime($date));
        
        $import="INSERT into users(username,email,password,name_first,name_middle,name_last,date_of_birth,postal_code,age,gender,created,modified_date,status_id,is_exist,user_type,duplicate) values('".$data[0]."','".$data[0]."','".md5('123456')."','".$data[2]."','".$data[3]."','".$data[4]."','".$dob."','".$data[8]."','".$data[7]."','".$gender."','".$today."','".$today."','1','1','1','".$duplicate."')";

		mysql_query($import) or die(mysql_error());
      }
      //$i++;
	}
    //echo $i;

	fclose($handle);

	print "Import done";

	//view upload form
}else {

	print "Upload new csv by browsing to file and clicking on Upload<br />\n";

	print "<form enctype='multipart/form-data' action='index.php' method='post'>";

	print "File name to import:<br />\n";

	print "<input size='50' type='file' name='filename'><br />\n";

	print "<input type='submit' name='submit' value='Upload'></form>";

}

?>
SELECT * FROM `users` WHERE `user_type` = '1' and `gender` = '1' and `is_exist` = '1' and `status_id` = '1' and `duplicate` = '0'
</div>
</div>
</body>
</html>