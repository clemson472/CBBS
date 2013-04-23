<html>
<base href="http://oss-ci.cs.clemson.edu:8080/GUI%20GROUP/testtree/">
<link rel="stylesheet media="screen" href="resources/css/style.css" type"text/css"/>
<body>

<?php

include("../resources/templates/banner_log.html");
include("../resources/templates/navbar_admin.html");
echo "<link rel=\"stylesheet\" media=\"screen\" href=\"resources/css/forcematchstyle.css\" type\"text/css\"/>"; //LOAD STYLE SHEET

/*-------------------
	Variables
--------------------*/
$i=0;
$host="oss-ci.cs.clemson.edu";
$user="cpsc472";
$password="myDB4dmin";
$dbname="cpsc472";
$searchForMentee="";
$searchForMentor="";
$selectedMentee="Nothing";
$selectedMentor="Nothing";

/*-------------------
	Search
-------------------*/

if(isset($_POST['searchsubmit'])){
	if(isset($_POST['searchForMentee'])){
		$searchForMentee = $_POST['searchForMentee'];
	}

	if(isset($_POST['searchForMentor'])){
		$searchForMentor = $_POST['searchForMentor'];
	}
}

/*if(isset($_POST['matchsubmit'])){
	if(isset($_POST['selectedMentee'])){
		$selectedMentee = $_POST['selectedMentee'];
	}

	if(isset($_POST['selectedMentor'])){
		$selectedMentor = $_POST['selectedMentor'];
	}
}*/

/*-------------------
	Connect to DB
-------------------*/

$link = mysql_connect($host, $user, $password)
    or die('Could not connect: ' . mysql_error());
mysql_select_db($dbname) or die('Could not select database');

echo "<table width=\"95%\" border=\"0\" align=\"center\">";
echo "<tr height=\"40\"><td colspan=\"2\" align=\"center\">FORCE MATCH</td></tr>"; //FORCE MATCH HEADER
echo "<tr height=\"40\"><td align=\"center\">MENTEE</td><td width=\"50%\" align=\"center\">MENTOR</td></tr>"; //MENTEE MENTOR HEADERS

/*-------------------
	 Mentee Search
--------------------*/

echo "<tr height=\"80\"><td align=\"center\">";
echo "<form method = \"post\">";
echo "Search <input type = \"text\" name =\"searchForMentee\" value='{$searchForMentee}'></input>";
echo "<input type = \"submit\" name = \"searchsubmit\" value = \"GO\"></input>";
echo "</td>";

/*-------------------
	 Mentor Search
--------------------*/

echo "<td align=\"center\">";
echo "Search <input type = \"text\" name =\"searchForMentor\" value='{$searchForMentor}'></input>";
echo "<input type = \"submit\" name = \"searchsubmit\" value = \"GO\"></input>";
echo "</form method = \"post\"></td></tr>";

echo "<form>";
echo "<tr>"; //BEGIN MENTOR MENTEE TABLES

/*-------------------
	 Mentee Table
--------------------*/

echo "<td><div style=\"height: 250px; overflow-y: scroll;\"><table class=\"forcematch\" align=\"center\">"; //BEGIN MENTEE TABLE

//Set Query for Mentees
if($searchForMentee != ""){
	$query = "SELECT FirstName, LastName FROM Mentee WHERE CONCAT(FirstName, ' ', LastName) LIKE '" . $searchForMentee . "' 
	OR FirstName LIKE '" . $searchForMentee . "' OR LastName LIKE '" . $searchForMentee . "'";
}
else{
	$query = "SELECT FirstName, LastName FROM Mentee";
}
//Query for Mentees
$result = mysql_query($query);
if (!$result) {
    die("Query to show fields from table failed");
}
$numRows=mysql_num_rows($result); //Get # of rows

// printing table rows
if($numRows>0){

	echo "<tr><td></td><td>Name</td><td align=\"center\">With Compatibility Factors</td></tr>"; //MENTEE TABLE HEADERS
	
	while($row = mysql_fetch_row($result))
	{
		echo "<tr>";
		echo "<td><input type = \"checkbox\" name = \"selectedMentee\" value=$row[0]></td>";
		echo "<td>" . $row[0] . " " . $row[1] . "</td>";
		echo "<td><center>No</center></td>";
		echo "</tr>";
	}
}
else {
		echo "<tr></tr><tr><td>No Records Found</td></tr>";
}

echo "<tr></tr>";
echo "</table></div></td>"; //END MENTEE TABLE
mysql_free_result($result);

/*-------------------
	 Mentor Table
--------------------*/

echo "<td><div style=\"height: 250px; overflow-y: scroll;\"><table class=\"forcematch\" align=\"center\">"; //BEGIN MENTEE TABLE

//Set Query for Mentors
if($searchForMentor != ""){
	$query = "SELECT FirstName, LastName FROM Mentor WHERE CONCAT(FirstName, ' ', LastName) LIKE '" . $searchForMentor . "' 
	OR FirstName LIKE '" . $searchForMentor . "' OR LastName LIKE '" . $searchForMentor . "'";
}
else{
	$query = "SELECT FirstName, LastName FROM Mentor";
}
//Query for Mentors
$result = mysql_query($query);
if (!$result) {
    die("Query to show fields from table failed");
}
$numRows=mysql_num_rows($result); //Get # of rows

// printing table rows

if($numRows>0){

	echo "<tr><td></td><td>Name</td><td align=\"center\">With Compatibility Factors</td></tr>"; //MENTEE TABLE HEADERS
	
	while($row = mysql_fetch_row($result))
	{
		echo "<tr>";
		echo "<td><input type = \"checkbox\" name = \"selectedMentor\" value=$row[0]></td>";
		echo "<td>" . $row[0] . " " . $row[1] . "</td>";
		echo "<td><center>No</center></td>";
		echo "</tr>";
	}
}
else {
		echo "<tr></tr><tr><td>No Records Found</td></tr>";
}

echo "<tr></tr>";
echo "</table></div></td>"; //END MENTOR TABLE
echo "</tr>"; //END MENTEE MENTOR TABLES

echo "<tr><td colspan=\"2\" align=\"center\" height=\"120\"><input type = \"submit\" name = \"matchsubmit\" value = \"MATCH\"></input></td></tr>";
echo "</form>";

mysql_free_result($result);
mysql_close($link);

?>

</body>
</html>