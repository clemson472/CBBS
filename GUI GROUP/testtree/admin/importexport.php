<html>
<base href="http://oss-ci.cs.clemson.edu:8080/GUI%20GROUP/testtree/">
<link rel="stylesheet media="screen" href="resources/css/style.css" type"text/css"/>


<body>

<?php include("../resources/templates/banner_log.html"); ?>
<?php include("../resources/templates/navbar_admin.html"); ?>

<?php 
include("../../../Database/includes.php");
$host="oss-ci.cs.clemson.edu";
$user="cpsc472";
$password="myDB4dmin";
$dbname="cpsc472";

if(isset($_POST['export'])) {
	$database = mysqli_connect($host, $user, $password)
   or die('Could not connect to mysql');
	mysqli_select_db($database, $dbname) or die('Could not select database');
	
	$tablesToExport = Array("Mentor", "Mentee");
	$fileNameToExport = "thefile.csv";
	
	exportTablesToExcel($database, $tablesToExport, $fileNameToExport);
	echo "EXPORTED";
	}

if(isset($_POST['import'])) {
	$database = mysqli_connect($host, $user, $password)
   or die('Could not connect to mysql');
	mysqli_select_db($database, $dbname) or die('Could not select database');
	
	
	if ($_FILES["doc"]["error"] > 0) {
		echo "Error: " . $_FILES["file"]["error"] . "<br>";
  	}
	else {
		$filepath = $_FILES['doc']['tmp_name'];
  		echo "Upload: " . $_FILES["doc"]["name"] . "<br>";
  		echo "Type: " . $_FILES["doc"]["type"] . "<br>";
  		echo "Size: " . ($_FILES["doc"]["size"] / 1024) . " kB<br>";
  		echo "Stored in: " . $_FILES["doc"]["tmp_name"];
  		importDatabase($database, $filepath);
  	}	
	
	
	}


?>

<tr height="40"><td colspan="2" align="center">Import or Export Database Tables</td></tr>
<p>

<form action="admin/importexport.php" method="post" enctype="multipart/form-data" name="importForm">
	<input type="hidden" name="MAX_FILE_SIZE" value="15000000">
	<input name="doc" type="file" id="doc" size="50">
	<input name="import" type="submit" id="import" value="Import Database">
</form>

<form action="admin/importexport.php" method="post" name="exportForm">
	<input name="export" type="submit" id="export" value="Export Database">
</form>

</body>

</html>