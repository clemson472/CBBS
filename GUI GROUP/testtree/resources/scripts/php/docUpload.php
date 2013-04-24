<?php

//added to redirect errors to log file (hopefully)
ini_set('error.log', '/tmp/script_errors.log');
ini_set('log_errors', 'On');
ini_set('display_errors', 'Off');


echo "Attempting to upload picture! <br>";
// if something was posted, start the process...
if(isset($_POST['upload'])) {

	// define the posted file into variables
	echo "\nDefining file into variables<br>";
	$name = $_FILES['doc']['name'];
	$tmp_name = $_FILES['doc']['tmp_name'];
	$type = $_FILES['doc']['type'];
	$size = $_FILES['doc']['size'];

	// if the mime type is anything other than what we specify below, kill it
	if(!(
			$type=='application/pdf' ||
			$type=='application/doc' ||
			$type=='application/docx' ||
			$type=='application/msword'
	)) {
		echo $type .  " is not an acceptable format.<br>";
		echo  '<a href="uploadDoc.html">Click here</a> to try again.'  ;
		die();
	}

	// if the file size is larger than 15 MB, kill it
	if($size>'15000000') {
		echo $name . " is over 15MB. Please make it smaller.<br>";
		echo '<a href="upload.php">Click here</a> to try again.' ;
		die();
	}

	// if your server has magic quotes turned off, add slashes manually
	if(!get_magic_quotes_gpc()) {
		$name = addslashes($name);
	}

	// open up the file and extract the data/content from it
	$extract = fopen($tmp_name, 'r');
	$content = fread($extract, $size);
	$content = addslashes($content);
	fclose($extract);
	
	echo "<br>contents extracted!<br>";
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



// change username to be based on login credentials
	$TARGET_PATH = "../uploads/".$name;
	$USER_NAME = "cyrus";
	
	if (file_exists($TARGET_PATH)) {
		$_SESSION['error'] = "A file with that name already exists";
		header("Location: index.html");
		exit;
	}
	
	
	if (move_uploaded_file($tmp_name, $TARGET_PATH)) {
	// NOTE: This is where a lot of people make mistakes.
	// We are *not* putting the image into the database; we are putting a reference to the file's location on the server
		$sql = "insert into docs (username, name, type, size) values ('$USER_NAME', '$name', '$type', '$size');";
		$result = mysqli_query($con, $sql);
		if(!$result) {
			echo "Could not insert data into DB: " . mysqli_error()."<br>".mysqli_errno();
			echo "<br><br> Query: ".$sql;
		}
		exit;
	}
	else {
	// A common cause of file moving failures is because of bad permissions on the directory attempting to be written to
	// Make sure you chmod the directory to be writeable
		$_SESSION['error'] = "Could not upload file.  Check read/write persmissions on the directory";
		echo "Could not upload file.  Check read/write persmissions on the directory";
	    	echo "<br>".$TARGET_PATH;
		
	//header("Location: index.html");
    	exit;
	}
	
	
}
?>
