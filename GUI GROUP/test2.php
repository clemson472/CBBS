<html style=\"height: 100%; width: 100%;\">
<body style=\"height: 100%; width: 100%; margin: 0; padding: 0;\">
<?php
$i=0;
$j=0;
$colIndex=1;
$localRowIndex=0;
$rowsDisplayed=0;
$globalRowIndex=0;
$rowsPerPage=5;
$currentPage=1;
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
if($_POST)
{
	if($_POST['rowsPerPage']){
		$rowsPerPage = $_POST['rowsPerPage'];
	}
	if($_POST['totalRows']){
		$total=$_POST['totalRows'];
		$temp=intval($total)/intval($rowsPerPage);
		if(intval($total)%intval($rowsPerPage))
			$temp++;
		$numPages=intval($temp);
	}
	if($_POST['currentPage']){
		$currentPage=$_POST['currentPage'];
	}
	if($_POST['globalRowIndex']){
		$globalRowIndex=$_POST['globalRowIndex'];
	}
	if($_POST['lastPage']){
		if($_POST['lastPage']==1 && $_POST['lastPage']==$currentPage)
			$globalRowIndex=0;
		else if($_POST['lastPage']>$currentPage)
			$globalRowIndex-=($rowsPerPage*2);
		else if($_POST['lastPage']==$numPages && $_POST['lastPage']==$currentPage)
			$globalRowIndex-=($rowsPerPage);
	}
	if($_POST['menu']){
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
	}/*
	if($_POST['selection']){
		$selection=$_POST['selection'];
	}*/
}

$link = mysql_connect('mysql1.cs.clemson.edu', 'wcrisle', 'letmein')
    or die('Could not connect: ' . mysql_error());
mysql_select_db('wcrisle_201208_cpsc462') or die('Could not select database');

if(empty($_POST['totalRows'])){
	$sizeQuery = "SELECT * FROM STUDENT";
	$result = mysql_query($sizeQuery) or die('Query failed: ' . mysql_error());
	$total=mysql_num_rows($result);
	$temp=intval($total)/intval($rowsPerPage);
		if(intval($total)/intval($rowsPerPage))
			$temp++;
	mysql_free_result($result);
}

$numPages=intval($temp);
$lowerBound=intval(($currentPage-1)*										$rowsPerPage);
$upperBound=intval(($currentPage)*
				$rowsPerPage);
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
$query = "SELECT * FROM STUDENT";
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
echo "<h2>Test Table</h2>";
		//echo "<table>\n";
		echo "<table cellspacing=\"0\" border=\"1\" style=\"height: 50px;\">\n";
		while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
			if($globalRowIndex==$upperBound)
				break;
			if($localRowIndex<$lowerBound){
				$localRowIndex++;
				continue;
			}
			echo "\t<tr>\n";
			foreach ($line as $col_value) {
				if($colIndex==5){
					echo "\t\t<td><INPUT type = \"radio\" name = \"add\"></td>\n";
				}
				if($colIndex==1){
					echo "\t\t<td><INPUT type = \"checkbox\" name = \"selection\" value=$globalRowIndex></td>\n";
					echo "\t\t<td>$col_value</td>\n";
				}
				else
					echo "\t\t\t<td>$col_value</td>\n";
				if($colIndex==14){
					$colIndex=1;
					$localRowIndex++;
					$globalRowIndex++;
					$rowsDisplayed++;
				}
				else
					$colIndex++;
			}
		echo "\t</tr>\n";
		}
		echo "</table>\n";
$difference=$rowsPerPage-$rowsDisplayed;
for($i=0; $i<$difference; $i++)
	$globalRowIndex++;

if($currentPage<$numPages)
	$Next=$currentPage+1;
else
	$Next=$currentPage;
if($currentPage>1)
	$Back=$currentPage-1;
else
	$Back=$currentPage;
print <<<_HTML_
		<FORM method = "post" action = "http://localhost/test2.php">
		<INPUT type = "hidden" name = "currentPage" value="$currentPage" >
		<INPUT type = "hidden" name = "totalRows" value="$total" >
		<INPUT type = "hidden" name = "globalRowIndex" value="$globalRowIndex" >
		<INPUT type = "hidden" name = "lastPage" value="$currentPage" >
		
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
		<INPUT type = "submit" style="height: 25px; width: 30px" value = "Go">
		<br />
		<button type = "submit" name ="currentPage" value = "$Back" >Back</button>
		<button type = "submit" name ="currentPage" value = "$Next" >Next</button>
		$currentPage / $numPages Rows per page: <input type = "text" name = "rowsPerPage" value="$rowsPerPage">
		<INPUT type = "submit" value = "Apply">
		</FORM>
_HTML_;

mysql_free_result($result);
mysql_close($link);
?>
</body>
</html>
