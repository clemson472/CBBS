Success!

<?php

mysql_close($mysqlconnection);

$username = "cpsc472";
$pwd = "myDB4dmin";
$dbname = "cpsc472";
$host = "oss-ci.cs.clemson.edu";

$sqlconnection = mysqli_connect($host,$username,$pwd,$dbname);

if(mysqli_connect_errno($sqlconnection)){
	echo "diddnt work";
}
else{
echo "it actually worked";
}




mysql_close($mysqlconnection);

?>