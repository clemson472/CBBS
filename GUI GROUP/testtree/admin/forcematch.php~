<html>
<base href="http://oss-ci.cs.clemson.edu:8080/GUI%20GROUP/testtree/">
<link rel="stylesheet media="screen" href="resources/style.css" type"text/css"/>
<body>

<?php

include("../resources/templates/banner_log.html");
include("../resources/templates/navbar_admin.html");

echo "<link rel=\"stylesheet\" media=\"screen\" href=\"resources/forcematchstyle.css\" type\"text/css\"/>";
echo "<div class=\"myTable\">";

$i=0;
$j=0;
$searchFlag=0;
$switchFlag=0;
$colIndex=1;
$localRowIndex=0;
$rowsDisplayed=0;
$globalRowIndex=0;
$numPages=0;
$numColumns=0;
$rowsPerPage=5;
$currentPage=1;
$lastPage=1;
$checkboxPosition=1;
$buttonPosition=5;
$columnNamesFlag=0;
$extraColumns=0;
$orderField="IDnumber";
$previousOrderField="IDnumber";
$order="ASC";
$searchFor="";
$previousSearchFor="";
$delete=0;
$available=0;
$unavailable=0;
$make=0;
$remind=0;
$terminate=0;
$decline=0;
/*
$selection;
$firstName="";
$middleName"";
$lastName="";
$status="";
*/
if($orderField=="IDnumber"){
	$switchFlag=1;
}
if($currentPage!=$lastPage || $switchFlag){
	$garbage=$previousOrderField;
	$previousOrderField=$orderField;
	$orderField=$garbage;
}
$link = mysql_connect('oss-ci.cs.clemson.edu', 'cpsc472', 'myDB4dmin')
    or die('Could not connect: ' . mysql_error());
mysql_select_db('cpsc472') or die('Could not select database');

//-----EXAMPLE-----//
// sending query
$result = mysql_query("SELECT FirstName, LastName FROM Mentee");
if (!$result) {
    die("Query to show fields from table failed");
}

$fields_num = mysql_num_fields($result);

echo "<table border='1'><tr>"; //Begin table

/*for($i=0; $i<$fields_num; $i++)
{
    $field = mysql_fetch_field($result);
    echo "<td>{$field->name}</td>";
}*/

echo "<td></td>";
echo "<td>Name</td>";
echo "<td><center>With Compatibility Factors</center></td>";

echo "</tr>\n";
// printing table rows
while($row = mysql_fetch_row($result))
{
    echo "<tr>";
	echo "<td><form><input type = \"checkbox\" name = \"selection\" value=\"a\"></form></td>";
    echo "<td>" . $row[0] . " " . $row[1] . "</td>";
	echo "<td><center>No</center></td>";
    echo "</tr>\n";
}
//-----EXAMPLE-----//

mysql_free_result($result);

mysql_close($link);
?></div>

</body>

</html>