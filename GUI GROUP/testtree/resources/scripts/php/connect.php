<?php
// Values to be set based on actual server credentials
	$server = "oss-ci.cs.clemson.edu";
	$username = "cpsc472";
	$password = "myDB4dmin";
	$database = "cpsc472";

	$con = mysqli_connect("$server", "$username", "$password") or die("Connection Error");
	$db_con = mysqli_select_db($con, $database);
	if(!$db_con) {
		echo "<br>Error connecting to database :".$database;
		die("<br>Database selection Error: ".mysqli_error());
	}
	 
?>
