<html>
<base href="http://oss-ci.cs.clemson.edu:8080/GUI%20GROUP/testtree/">
<link rel="stylesheet media="screen" href="resources/css/style.css" type"text/css"/>

<link rel="stylesheet" media="screen" href="resources/css/myTableStyle.css" type="text/css">

<body>

<?php include("../resources/templates/banner_log.html"); ?>
<?php include("../resources/templates/navbar_admin.html"); ?>

"spreadsheet"
<?php
echo "<div class=\"myTable\">";
$i=0;
$j=0;
$searchFlag=0;
$switchFlag=0;
$rowsChangedFlag=0;
$colIndex=1;
$localRowIndex=0;
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
$selection=array();
$delete=0;
$available=0;
$unavailable=0;
$make=0;
$remind=0;
$terminate=0;
$decline=0;
if($_POST)
{
	if(isset($_POST['rowsPerPage'])){
		$rowsPerPage = $_POST['rowsPerPage'];
	}
	if(isset($_POST['newRowsPerPage'])){
		if($_POST['newRowsPerPage']!=$_POST['rowsPerPage']){
			$rowsChangedFlag=1;
			$rowsPerPage = $_POST['newRowsPerPage'];
		}
	}
	if(isset($_POST['selection'])){
		foreach($_POST['selection'] as $values){
			$selection[$i]=$values;
			$i++;
		}
	}
	if(isset($_POST['order'])){
		$order = $_POST['order'];
	}
	if(isset($_POST['previousOrderField'])){
		$previousOrderField = $_POST['previousOrderField'];		}
	if(isset($_POST['orderField'])){
		$orderField = $_POST['orderField'];
		if($previousOrderField==$orderField && 					$order=="ASC")
			$order="DESC";
		else if($previousOrderField==$orderField && 				$order=="DESC")
			$order="ASC";
		else if($order=="DESC")
			$order="ASC";
	}
	if(isset($_POST['totalRows'])){
		$total=$_POST['totalRows'];
		$temp=intval($total)/intval($rowsPerPage);
		if(intval($total)%intval($rowsPerPage))
			$temp++;
		$numPages=intval($temp);
	}
	if(isset($_POST['numPages'])){
		$numPages = $_POST['numPages'];
	}
	if(isset($_POST['numColumns'])){
		$numColumns = $_POST['numColumns'];
	}
	if(isset($_POST['currentPage'])){
		$currentPage=$_POST['currentPage'];
	}
	if(isset($_POST['lastPage'])){
		$lastPage=$_POST['lastPage'];
		//Make sure page number is valid
		if($currentPage>$numPages){
			$currentPage=$_POST['lastPage'];
		}
		if($currentPage<1){
			$currentPage=$_POST['lastPage'];
		}

		//Make sure index is correct for first and back 
		else if($_POST['lastPage']>$currentPage){
			$switchFlag=1;
		}

		//Make sure index is correct for last and next
		else if($_POST['lastPage']<$currentPage){
			$switchFlag=1;
		}
	}
	if(isset($_POST['menu'])){
		if($_POST['menu']=='delete')
			$delete=1;
		if($_POST['menu']=='available')
			$available=1;
		if($_POST['menu']=='unavailable')
			$unavailable=1;
		if($_POST['menu']=='make')
			$make=1;
		if($_POST['menu']=='remind')
			$remind=1;
		if($_POST['menu']=='terminate')
			$terminate=1;
		if($_POST['menu']=='decline')
			$decline=1;
	}
	if(isset($_POST['searchFlag'])){
		$searchFlag=$_POST['searchFlag'];
	}
	if(isset($_POST['searchFor'])){
		if(substr($_POST['searchFor'],0,1)!="%" && $_POST			['searchFor']!=""){
			$filler="%";
			$searchFor="{$filler}{$_POST['searchFor']}{$filler}";
			$searchFlag=1;
			$currentPage=1;
		}
		else{
			$searchFor=$_POST['searchFor'];
			}
	}
	if(isset($_POST['previousSearchFor'])){
		$previousSearchFor=$_POST['previousSearchFor'];
		if($searchFor=="")
			$searchFor=$previousSearchFor;
	}
	$i=0;
}
if($orderField=="IDnumber"){
	$switchFlag=1;
}
if($currentPage!=$lastPage || $switchFlag){
	$switchTemp=$previousOrderField;
	$previousOrderField=$orderField;
	$orderField=$switchTemp;
}

$link = mysql_connect('mysql1.cs.clemson.edu', 'wcrisle', 'letmein')
    or die('Could not connect: ' . mysql_error());
mysql_select_db('wcrisle_201208_cpsc462') or die('Could not select database');
if($searchFlag){
	$sizeQuery = "SELECT * FROM STUDENT WHERE fName LIKE 	'" . 	$searchFor ."' OR lName LIKE '" . $searchFor ."' OR 	mInitial LIKE '" . $searchFor ."'";
	$result = mysql_query($sizeQuery) or die('Query failed: ' 	. mysql_error());
	$total=mysql_num_rows($result);
	$temp=intval($total)/intval($rowsPerPage);
	if(intval($total)%intval($rowsPerPage))
		$temp++;
	$numPages=intval($temp);
	mysql_free_result($result);
}

if($rowsChangedFlag)
	$currentPage=1;
if(($numPages==0 || $rowsChangedFlag) && !$searchFlag){
	$sizeQuery = "SELECT * FROM STUDENT";
	$result = mysql_query($sizeQuery) or die('Query failed: ' . mysql_error());
	$total=mysql_num_rows($result);
	$temp=intval($total)/intval($rowsPerPage);
		if(intval($total)%intval($rowsPerPage))
			$temp++;
	$numPages=intval($temp);
	while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) 
	{
		foreach ($line as $col_value)
			$numColumns++;
	}
	$numColumns=intval($numColumns/$total);
	mysql_free_result($result);
}
/*
if($delete==1)
{
	$query = "SELECT * FROM STUDENT";
	$result = mysql_query($query) or die('Query failed: ' . 	mysql_error());
	while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) 
	{
		if($i!=$selection){
				$i++;
				continue;
			}
		foreach ($line as $col_value) {
			if($j==1)
				$lastName=$col_value;
			if($j==2)
				$firstName=$col_value;	
			if($j==3)
				$middleName=$col_value;
			if($j==4){
				if($col_value==1)
					$status="Mentee";
				else
					$status="Mentor";
			}
			if($j==5)
				continue;
			j++;
		}
	}
	mysql_free_result($result);
	if($status=="Mentee"){
		$query = "DELETE FROM Mentee WHERE FirstName='" . 			$firstName . "' AND MiddleName='" . $middleName . "' 			AND LastName='" . $lastName . "'";
	}
	else if($status=="Mentor"){
		$query = "DELETE FROM Mentor WHERE FirstName='" . 			$firstName . "' AND MiddleName='" . $middleName . "' 			AND LastName='" . $lastName . "'";
	}
	$result = mysql_query($query) or die('Query failed: ' . 	mysql_error());		
	mysql_free_result($result);
}
*/
echo "<h2>Mentors/Mentees</h2>";
$offset=$rowsPerPage*($currentPage-1);
if($searchFor!=""){
	$query = "SELECT * FROM STUDENT WHERE fName LIKE '" .        	$searchFor ."' OR lName LIKE '" . $searchFor ."' OR 	mInitial LIKE '" . $searchFor ."' LIMIT $rowsPerPage 	OFFSET $offset";
}
else{
	$query = "SELECT * FROM STUDENT LIMIT $rowsPerPage OFFSET 	$offset";
	}
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
$numRows=mysql_num_rows($result);
echo "<FORM method = \"post\" action = \"resources/scripts/php/test3.php\" >";
echo "Name Match:<Input type = \"text\" name =\"searchFor\">";
echo "<INPUT type = \"submit\" value = \"GO\">";
echo "<br />";
if($numPages==0)
	echo "No records found";
		echo "<table>\n";
		$test=array();
		$index=0;
		while($row=mysql_fetch_assoc($result)){
			$test[$index]=$row;
			$index++;
		}
		function build_sorter($key) {
			return function ($a, $b) use ($key){
        			return strcmp($a[$key],$b[$key]);
			};
		}
		usort($test, build_sorter($orderField));
		if($order=="DESC")
			$test=array_reverse($test);
		for($index=0; $index<$numRows; $index++) {
			echo "\t<tr>\n";
			foreach ($test[$index] as $col_value) {
				$selectionValue=$test[$index]["IDnumber"];
				if($columnNamesFlag==0){
					for($i=0; $i<$numColumns+2; $i++){
						if($i==($checkboxPosition-1)){
							echo "\t\t<td>Check</td>								\n";
							$extraColumns++;
						}
						else if($i==$buttonPosition){
							echo "\t\t<td>Button</td>								\n";
							$extraColumns++;
						}
						else{
							$temp=mysql_field_name							($result,($i-$extraColumns));
					echo "<td class=\"columnHeaders\"> 						<INPUT type = \"submit\" name =							\"orderField\" value = \"$temp\">						</td>";
						}
					}
					$columnNamesFlag=1;
					echo "\t</tr>\n";
					echo "\t<tr>\n";
				}
				if($colIndex==$checkboxPosition){
					echo "\t\t<td><INPUT type = \"checkbox\" name = \"selection[]\" value=\"$selectionValue\"></td>\n";
					echo "\t\t<td>$col_value</td>\n";
				}
				else if($colIndex==$buttonPosition){
					echo "\t\t<td><INPUT type = \"radio\" name = \"add\" value=\"$col_value\"></td>\n";
					echo "\t\t<td>$col_value</td>\n";
				}
				else
					echo "\t\t\t<td>$col_value</td>\n";
				if($colIndex==14){
					$colIndex=1;
					$localRowIndex++;
				}
				else
					$colIndex++;
			}
		echo "\t</tr>\n";
		}
		echo "</table>\n";
if($currentPage<$numPages)
	$Next=$currentPage+1;
else
	$Next=$currentPage;
if($currentPage>1)
	$Back=$currentPage-1;
else
	$Back=$currentPage;
print <<<_HTML_
	
		<INPUT type = "hidden" name = "currentPage" value="$currentPage" >
		<INPUT type = "hidden" name = "totalRows" value="$total" >
		<INPUT type = "hidden" name = "lastPage" value="$currentPage" >
		<INPUT type = "hidden" name = "numPages" value="$numPages" >
		<INPUT type = "hidden" name = "numColumns" value="$numColumns" >
		<INPUT type = "hidden" name = "order" value="$order" 			>
		<INPUT type = "hidden" name = "previousOrderField" value="$orderField" >
		<INPUT type = "hidden" name = "offset" value="$offset" >
		<INPUT type = "hidden" name = "searchFlag" value="$searchFlag" >
		<INPUT type = "hidden" name = "previousSearchFor" value="$searchFor" >
		<Input type = "hidden" name = "rowsPerPage" value="$rowsPerPage">
		<select name="menu">
		<option>--Select Action--</option>
		<option value="delete">Delete</option>
		<option value="available">Available to Match</option>
		<option value="unavailable">Unavailable to Match</option>
		<option value="make">Make Mentor And Mentee</option>
		<option value="remind">Remind User Password</option>
		<option value="terminate">Terminate Match</option>
		<option value="deline">Decline Match</option>
		</select>
		<br />
		<INPUT type = "submit" value = "Go">
		<br />
		$currentPage / $numPages
		<Input type = "text" name = "currentPage" >
		<br />
		<button type = "submit" name ="currentPage" value = "1" >First</button>
		<button type = "submit" name ="currentPage" value = "$Back" >Back</button>
		<INPUT type = "submit" value = "Go" >
		<button type = "submit" name ="currentPage" value = "$Next" >Next</button>
		<button type = "submit" name ="currentPage" value = "$numPages" >Last</button>
		Rows per page: <Input type = "text" name = "newRowsPerPage" value="$rowsPerPage">
		<INPUT type = "submit" value = "Apply">
		</FORM>
_HTML_;
echo "</FORM>\n";
mysql_free_result($result);
mysql_close($link);
echo "</div>";
?>

</body>

</html>