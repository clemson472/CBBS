<?php
	//Create connection
	$con=mysqli_connect('oss-ci.cs.clemson.edu','cpsc472','myDB4dmin','');
	mysqli_select_db($con, "cpsc472");

	//Check connection
	if(mysqli_connect_errno($con))
	{
		echo "Failed to connect to database: " . mysqli_connect_error();
	}
	//If we successfully connected
	else
	{
		$data = array();
		$input = $_GET["q"];
		$addresses = mysqli_query($con, "SELECT Email, CONCAT(FirstName, ' ', LastName) AS Name FROM Mentee WHERE CONCAT(FirstName, ' ', LastName) LIKE '%$input%' UNION SELECT email, CONCAT(FirstName, ' ', LastName) AS Name FROM Mentor WHERE CONCAT(FirstName, ' ', LastName) LIKE '%$input%'");
		if($addresses)
		{
			while($row = mysqli_fetch_array($addresses))
			{
				$json = array();
				$json['value'] = $row['Email'];
				$json['name'] = $row['Name'];
				$data[] = $json;
			}
		} 
		header("Content-type: application/json");
		echo json_encode($data);
	}
?>
