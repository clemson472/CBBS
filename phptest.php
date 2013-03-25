<?php $body = "<h1>Hello CPSC472/672!</h1>
<p>This is the default web page for this server.</p>
?>

<html>
  <body>
  <?php echo $body ?>


<? php

$host = "oss-ci.cs.clemson.edu";
$dbuser = "myDB4dmin";
$dbname = "cpsc472";
$sshuser = "cpsc472";
$sshpwd = "tigermints";


$connection = mysqli_connect($host, $dbuser, $dbpwd, $dbname);
if (mysqli_connect_errno($connection)){
	echo "FAILED TO CONNECT TO MYSQL";
}
else{
echo "CONNECTED TO MYSQL";
}

/*
$queryresult = mysqli_query($connection, "SELECT * FROM Mentor");

echo mysqli_fetch_array($queryresult);
*/

mysqli_close($connection);
?>

  </body>
</html>
