<?php
	//database info
	$con_Host = "localhost";
	$con_User = "root";
	$con_Pass = "";
	$con_DB = "thisapp";

	$thisDB = new MySQLi($con_Host, $con_User, $con_Pass, $con_DB);

	if ($thisDB->connect_errno) {
		die("ERROR: " . $thisDB->connect_error);
	}
?>