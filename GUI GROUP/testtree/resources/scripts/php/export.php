<?php 


include("../../../../../Database/includes.php");

$host="oss-ci.cs.clemson.edu";
$user="cpsc472";
$password="myDB4dmin";
$dbname="cpsc472";

$database = mysql_connect($host, $user, $password)
    or die('Could not connect: ' . mysql_error());
mysql_select_db($database, $dbname) or die('Could not select database');


/*-------------
    EXPORT
-------------*/

$tablesToExport = Array("Mentor", "Mentee");
$fileNameToExport = "thefile.csv";


?>