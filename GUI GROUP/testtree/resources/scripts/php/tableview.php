<html>
<link rel="stylesheet" media="screen" href="myTableStyleFinal.css" type="text/css">
<body>
<?php
echo "<div class=\"myTable\">";
$i=0;
$j=0;
$searchFlag=0;
$switchFlag=0;
$rowsChangedFlag=0;
$orderChangedFlag=0;
$tableChangedFlag=0;
$activeFlag=1;
$colIndex=1;
$localRowIndex=0;
$numPages=0;
$numColumns=0;
$rowsPerPage=5;
$currentPage=1;
$lastPage=1;
$checkboxPosition=1;
$columnNamesFlag=0;
$extraColumns=0;
$orderField="LastName";
$previousOrderField="LastName";
$order="ASC";
$searchFor="";
$previousSearchFor="";
$selection=array();
$replacementStringArray=array();
$selectionSize=0;
$delete=0;
$makeActive=0;
$makeInactive=0;
$remind=0;
$terminate=0;
$allQuery="";
$menteeQuery="SELECT M.LastName, M.FirstName, M.PreferredName, M.Email, M.status, M.MatchedWith, M.MatchDate FROM Mentee AS M";
$mentorQuery="SELECT M.LastName, M.FirstName, M.PreferredName, M.Email, M.status, M.MatchedWith FROM Mentor AS M";
$queryInUse=$allQuery;
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
			$selectionSize++;
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
		$orderChangedFlag=1;
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
	if(isset($_POST['newCurrentPage']) && $_POST['newCurrentPage']!=""){
		$currentPage=$_POST['newCurrentPage'];
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
		if($_POST['menu']=='makeActive')
			$makeActive=1;
		if($_POST['menu']=='makeInactive')
			$makeInactive=1;
		if($_POST['menu']=='remind')
			$remind=1;
		if($_POST['menu']=='terminate')
			$terminate=1;
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
	if(isset($_POST['query'])){
		$queryInUse=$_POST['query'];
	}
	if(isset($_POST['whichQuery'])){
		if($_POST['whichQuery']=="All")
			$queryInUse=$allQuery;
		else if($_POST['whichQuery']=="Mentor")
			$queryInUse=$mentorQuery;
		else if($_POST['whichQuery']=="Mentee")
			$queryInUse=$menteeQuery;
		$searchFlag=0;
		$tableChangedFlag=1;
	}
	if(isset($_POST['activeFlag']) && isset($_POST['previousActive'])){
		if($_POST['activeFlag']==0 && $_POST['previousActive']==1)
			$searchFlag=0;
		if(!$rowsChangedFlag && !$orderChangedFlag && !$searchFlag)
			$activeFlag=$_POST['activeFlag'];
		else
			$activeFlag=$_POST['previousActive'];
		if($activeFlag!=$_POST['previousActive'])
			$tableChangedFlag=1;
	}
}
if($orderField=="LastName"){
	$switchFlag=1;
}
if($currentPage!=$lastPage || $switchFlag){
	$switchTemp=$previousOrderField;
	$previousOrderField=$orderField;
	$orderField=$switchTemp;
}
if(!$activeFlag)
	$queryInUse=$allQuery;
$link = mysql_connect('oss-ci.cs.clemson.edu', 'cpsc472', 'myDB4dmin')
    or die('Could not connect: ' . mysql_error());
mysql_select_db('cpsc472') or die('Could not select database');

if($makeActive==1 && $selectionSize!=0)
{
	for($i=0; $i<$selectionSize; $i++){
		$query = "UPDATE Mentor SET Status='unmatched' WHERE Email='$selection[$i]' AND Status='inactive'";
		$result = mysql_query($query) or die('Query failed: ' . mysql_error());
		$query = "UPDATE Mentee SET Status='unmatched' WHERE Email='$selection[$i]' AND Status='inactive'";
		$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	}
}

if($makeInactive==1 && $selectionSize!=0)
{
	for($i=0; $i<$selectionSize; $i++){
	$query="SELECT Status FROM Mentor WHERE Email='$selection[$i]'";
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$row=mysql_fetch_array($result);
	if(!empty($row)){
			$query = "UPDATE Mentor SET Status='inactive', MatchedWith='' WHERE Email='$selection[$i]' AND Status<>'inactive'";
			$result = mysql_query($query) or die('Query failed: ' . mysql_error());
			$query = "UPDATE Mentee SET Status='unmatched', MatchedWith='' WHERE MatchedWith='$selection[$i]'"; 
			$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	}
	else{
			$query="SELECT MatchedWith FROM Mentee WHERE Email='$selection[$i]'";
			$result = mysql_query($query) or die('Query failed: ' . mysql_error());
			$row=mysql_fetch_array($result);
			$email=$row['MatchedWith'];
			mysql_free_result($result);
			$query = "UPDATE Mentee SET Status='inactive', MatchedWith='', MatchDate='' WHERE Email='$selection[$i]' AND Status<>'inactive'";
			$result = mysql_query($query) or die('Query failed: ' . mysql_error());
			$query="SELECT MatchedWith FROM Mentor WHERE Email='$email'";
			$result = mysql_query($query) or die('Query failed: ' . mysql_error());
			$row=mysql_fetch_array($result);
			$val=$row['MatchedWith'];
			$newStringArray=explode(",",$val);
			mysql_free_result($result);
			$index=0;
			for($j=0; $j<count($newStringArray); $j++){
				if($newStringArray[$j]!=$selection[$i]){
					$replacementStringArray[$index]=$newStringArray[$j];
					$index++;
				}
			}
			$replacementString=implode(",",$replacementStringArray);
			if($replacementString==""){
				$query = "UPDATE Mentor SET Status='unmatched', MatchedWith='' WHERE MatchedWith='$selection[$i]'"; 
				$result = mysql_query($query) or die('Query failed: ' . mysql_error());
			}
			else{
				$query = "UPDATE Mentor SET MatchedWith='$replacementString' WHERE Email='$email'"; 
				$result = mysql_query($query) or die('Query failed: ' . mysql_error());	
			}
		}
	}
}

if($delete==1 && $selectionSize!=0)
{
	for($i=0; $i<$selectionSize; $i++){
	$query="SELECT Status FROM Mentor WHERE Email='$selection[$i]'";
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$row=mysql_fetch_array($result);
	if(!empty($row)){
			$query = "DELETE FROM Mentor WHERE Email='$selection[$i]'";
			$result = mysql_query($query) or die('Query failed: ' . mysql_error());
			$query = "UPDATE Mentee SET Status='unmatched', MatchedWith='' WHERE MatchedWith='$selection[$i]'"; 
			$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	}
	else{
			$query="SELECT MatchedWith FROM Mentee WHERE Email='$selection[$i]'";
			$result = mysql_query($query) or die('Query failed: ' . mysql_error());
			$row=mysql_fetch_array($result);
			$email=$row['MatchedWith'];
			mysql_free_result($result);
			$query = "DELETE FROM Mentee WHERE Email='$selection[$i]'";
			$result = mysql_query($query) or die('Query failed: ' . mysql_error());
			$query="SELECT MatchedWith FROM Mentor WHERE Email='$email'";
			$result = mysql_query($query) or die('Query failed: ' . mysql_error());
			$row=mysql_fetch_array($result);
			$val=$row['MatchedWith'];
			$newStringArray=explode(",",$val);
			mysql_free_result($result);
			$index=0;
			for($j=0; $j<count($newStringArray); $j++){
				if($newStringArray[$j]!=$selection[$i]){
					$replacementStringArray[$index]=$newStringArray[$j];
					$index++;
				}
			}
			$replacementString=implode(",",$replacementStringArray);
			if($replacementString==""){
				$query = "UPDATE Mentor SET Status='unmatched', MatchedWith='' WHERE MatchedWith='$selection[$i]'"; 
				$result = mysql_query($query) or die('Query failed: ' . mysql_error());
			}
			else{
				$query = "UPDATE Mentor SET MatchedWith='$replacementString' WHERE Email='$email'"; 
				$result = mysql_query($query) or die('Query failed: ' . mysql_error());	
			}
		}
	}
}

if($terminate==1 && $selectionSize!=0)
{
	for($i=0; $i<$selectionSize; $i++){
	$query="SELECT Status FROM Mentor WHERE Email='$selection[$i]'";
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$row=mysql_fetch_array($result);
	if(!empty($row)){
			$query = "UPDATE Mentor SET MatchedWith='' WHERE Email='$selection[$i]' AND Status<>'inactive'";
			$result = mysql_query($query) or die('Query failed: ' . mysql_error());
			$query = "UPDATE Mentee SET Status='unmatched', MatchedWith='' WHERE MatchedWith='$selection[$i]'"; 
			$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	}
	else{
		$query="SELECT MatchedWith FROM Mentee WHERE Email='$selection[$i]'";
			$result = mysql_query($query) or die('Query failed: ' . mysql_error());
			$row=mysql_fetch_array($result);
			$email=$row['MatchedWith'];
			mysql_free_result($result);
			$query = "UPDATE Mentee SET MatchedWith='', MatchDate='' WHERE Email='$selection[$i]' AND Status<>'inactive'";
			$result = mysql_query($query) or die('Query failed: ' . mysql_error());
			$query="SELECT MatchedWith FROM Mentor WHERE Email='$email'";
			$result = mysql_query($query) or die('Query failed: ' . mysql_error());
			$row=mysql_fetch_array($result);
			$val=$row['MatchedWith'];
			$newStringArray=explode(",",$val);
			mysql_free_result($result);
			$index=0;
			for($j=0; $j<count($newStringArray); $j++){
				if($newStringArray[$j]!=$selection[$i]){
					$replacementStringArray[$index]=$newStringArray[$j];
					$index++;
				}
			}
			$replacementString=implode(",",$replacementStringArray);
			if($replacementString==""){
				$query = "UPDATE Mentor SET Status='unmatched', MatchedWith='' WHERE MatchedWith='$selection[$i]'"; 
				$result = mysql_query($query) or die('Query failed: ' . mysql_error());
			}
			else{
				$query = "UPDATE Mentor SET MatchedWith='$replacementString' WHERE Email='$email'"; 
				$result = mysql_query($query) or die('Query failed: ' . mysql_error());	
			}
		}
	}
}

if($queryInUse!=$allQuery){
	$searchQueryPart=" WHERE M.FirstName LIKE 	'" . 	$searchFor ."' OR M.LastName LIKE '" . $searchFor ."' OR 	M.PreferredName LIKE '" . $searchFor ."'";
	if($activeFlag && $searchFlag)
		$activePart=" AND M.Status<>'inactive'";
	else if(!$activeFlag && $searchFlag)
		$activePart=" AND M.Status='inactive'";
	else if($activeFlag && !$searchFlag)
		$activePart=" WHERE M.Status<>'inactive'";
	else if(!$activeFlag && !$searchFlag)
		$activePart=" WHERE M.Status='inactive'";
}
	else{
	$searchQueryPart=" WHERE FirstName LIKE '" . $searchFor ."' OR LastName LIKE '" . $searchFor ."' OR PreferredName LIKE '" . $searchFor ."'";
	if($activeFlag && $searchFlag)
		$wholeAllQuery="(SELECT LastName, FirstName, PreferredName, Email, IsMentee, IsMentor, MatchedWith, Status FROM Mentee WHERE (FirstName LIKE '" . $searchFor ."' OR LastName LIKE '" . $searchFor ."' OR PreferredName LIKE '" . $searchFor ."') AND Status<>'inactive') UNION (SELECT LastName, FirstName, PreferredName, Email, IsMentee, IsMentor, MatchedWith, Status FROM Mentor WHERE (FirstName LIKE '" . $searchFor ."' OR LastName LIKE '" . $searchFor ."' OR PreferredName LIKE '" . $searchFor ."') AND Status<>'inactive')";
	else if(!$activeFlag && $searchFlag)
		$wholeAllQuery="(SELECT LastName, FirstName, PreferredName, Email, IsMentee, IsMentor, MatchedWith, Status FROM Mentee WHERE (FirstName LIKE '" . $searchFor ."' OR LastName LIKE '" . $searchFor ."' OR PreferredName LIKE '" . $searchFor ."') AND Status='inactive') UNION (SELECT LastName, FirstName, PreferredName, Email, IsMentee, IsMentor, MatchedWith, Status FROM Mentor WHERE (FirstName LIKE '" . $searchFor ."' OR LastName LIKE '" . $searchFor ."' OR PreferredName LIKE '" . $searchFor ."') AND Status='inactive')";
	else if($activeFlag && !$searchFlag)
		$wholeAllQuery="(SELECT LastName, FirstName, PreferredName, Email, IsMentee, IsMentor, MatchedWith, Status FROM Mentee WHERE Status<>'inactive') UNION (SELECT LastName, FirstName, PreferredName, Email, IsMentee, IsMentor, MatchedWith, Status FROM Mentor WHERE Status<>'inactive')";
	else if(!$activeFlag && !$searchFlag)
		$wholeAllQuery="(SELECT LastName, FirstName, PreferredName, Email, IsMentee, IsMentor, MatchedWith, Status FROM Mentee WHERE Status='inactive') UNION (SELECT LastName, FirstName, PreferredName, Email, IsMentee, IsMentor, MatchedWith, Status FROM Mentor WHERE Status='inactive')";
	}
if($tableChangedFlag)
	$searchFlag=0;
if($searchFlag){
	if($queryInUse!=$allQuery)
		$sizeQuery = "{$queryInUse}{$searchQueryPart}{$activePart}";
	else
		$sizeQuery=$wholeAllQuery;
	$result = mysql_query($sizeQuery) or die('Query failed: ' 	. mysql_error());
	$total=mysql_num_rows($result);
	$temp=intval(intval($total)/intval($rowsPerPage));
	if(intval($total)%intval($rowsPerPage))
		$temp++;
	$numPages=intval($temp);
	mysql_free_result($result);
}
if($rowsChangedFlag || $tableChangedFlag)
	$currentPage=1;
if(($numPages==0 || $rowsChangedFlag || $tableChangedFlag) && !$searchFlag){
	$numColumns=0;
	if($queryInUse!=$allQuery)
		$sizeQuery = "{$queryInUse}{$activePart}";
	else
		$sizeQuery=$wholeAllQuery;
	$result = mysql_query($sizeQuery) or die('Query failed: ' . mysql_error());
	$total=mysql_num_rows($result);
	$temp=intval(intval($total)/intval($rowsPerPage));
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

echo "<h2>Mentors/Mentees</h2>";
$offset=$rowsPerPage*($currentPage-1);
$queryLimitPart=" ORDER BY LastName LIMIT $rowsPerPage OFFSET $offset";
if($searchFor!="" && $searchFlag){
	if($queryInUse!=$allQuery)
		$query = "{$queryInUse}{$searchQueryPart}{$activePart}{$queryLimitPart}";
	else
		$query="{$wholeAllQuery}{$queryLimitPart}";
}
else{
	if($queryInUse!=$allQuery)
		$query = "{$queryInUse}{$activePart}{$queryLimitPart}";
	else
		$query="{$wholeAllQuery}{$queryLimitPart}";
}
$result = mysql_query($query) or die('Query failed: ' . mysql_error());
$numRows=mysql_num_rows($result);
echo "<FORM method = \"post\" action = \"admin/spreadsheet.php\" >";

if($queryInUse==$allQuery && $activeFlag)
	echo "<INPUT type = \"radio\" name =\"doNothing\" value = \"All\" checked>All";
else
	echo "<INPUT type = \"radio\" name =\"whichQuery\" value = \"All\" onclick=\"this.form.submit();\">All";

if($queryInUse==$mentorQuery && $activeFlag)
	echo "<INPUT type = \"radio\" name =\"doNothing\" value = 	\"Mentor\" checked>Mentor Only";
else
	echo "<INPUT type = \"radio\" name =\"whichQuery\" value = 	\"Mentor\" onclick=\"this.form.submit();\">Mentor Only";

if($queryInUse==$menteeQuery && $activeFlag)
	echo "<INPUT type = \"radio\" name =\"doNothing\" value = 	\"Mentee\" checked>Mentee Only";
else
	echo "<INPUT type = \"radio\" name =\"whichQuery\" value = 	\"Mentee\" onclick=\"this.form.submit();\">Mentee Only";

if(!$activeFlag)
	echo "<INPUT type = \"radio\" name =\"activeFlag\" value = 	\"1\" checked>Inactive";
else
	echo "<INPUT type = \"radio\" name =\"activeFlag\" value = 	\"0\" onclick=\"this.form.submit();\">Inactive";

echo "<div class=\"blueButton\">";
echo "Name Match:<Input type = \"text\" name =\"searchFor\">";
echo "<INPUT type = \"submit\" value = \"GO\">";
echo "</div>";
echo "<br />";
if($numPages==0)
	echo "No records found";
echo "<table>";
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
		echo "<tr>";
		foreach ($test[$index] as $col_value) {
			$selectionValue=$test[$index]["Email"];
			if($columnNamesFlag==0){
				for($i=0; $i<$numColumns+1; $i++){
					if($i==($checkboxPosition-1)){
						echo "<td class=\"columnHeaders\">Check</td>";
						$extraColumns++;
					}
					else{
						$temp=mysql_field_name($result,							($i-$extraColumns));
					echo "<td class=\"columnHeaders\"> 						<INPUT type = \"submit\" name =							\"orderField\" value = \"$temp\">						</td>";
					}
				}
				$columnNamesFlag=1;
				echo "</tr>";
				echo "<tr>";
			}
			if($colIndex==$checkboxPosition){
				echo "<td><INPUT type = \"checkbox\" name = \"selection[]\" value=\"$selectionValue\"></td>";
				echo "<td>$col_value</td>";
			}
			else
				echo "<td>$col_value</td>";
			if($colIndex==$numColumns){
				$colIndex=1;
				$localRowIndex++;
			}
			else
				$colIndex++;
		}
	echo "</tr>";
	}
echo "</table>";
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
		<INPUT type = "hidden" name = "query" value = "$queryInUse">
		<INPUT type = "hidden" name = "previousActive" value = "$activeFlag">
		<br />
		<div class="rowsPerPageText">
		$currentPage / $numPages
		<button type = "submit" name ="currentPage" value = "1" >First</button>
		<button type = "submit" name ="currentPage" value = "$Back" >Back</button>
		<INPUT type = "submit" value = "Go" >
		<Input type = "text" name = "newCurrentPage" >
		<button type = "submit" name ="currentPage" value = "$Next" >Next</button>
		<button type = "submit" name ="currentPage" value = "$numPages" >Last</button>
		Rows per page: <Input type = "text" name = "newRowsPerPage" value="$rowsPerPage">
		<button type = "submit" value = "Apply">Apply				</button>
		</div>
		<br />
		<div class="blueButton">
		<select name="menu">
		<option>--Select Action--</option>
		<option value="delete">Delete</option>
		<option value="makeActive">Make Active</option>
		<option value="makeInactive">Make Inactive</option>
		<option value="remind">Remind User Password</option>
		<option value="terminate">Terminate Match</option>
		</select>
		<INPUT type = "submit" value = "Go">
		</div>
		</FORM>
_HTML_;
echo "</FORM>";
mysql_free_result($result);
mysql_close($link);
echo "</div>";
?>
</body>
</html>

