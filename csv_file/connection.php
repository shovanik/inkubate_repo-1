<?php
$db = mysql_connect("localhost", "websoluz_databas", "A*y#h^*#s}[M") or die("Could not connect.");

if(!$db) 

	die("no db");

if(!mysql_select_db("websoluz_inkubatesdb",$db))

 	die("No database selected.");
?>