<?php
class Mentor
{
    function getMatchedWith($database, $email)
    {
	$result = "SELECT MatchedWith FROM Mentor WHERE Email='$email'";

	$queryResult = mysqli_query($database,$result);
	$row = mysqli_fetch_array($queryResult);

	$stringResult = (string)$row[0];

	return $stringResult;
    }

    function removeMentor($database,$mentorEmail) 	
    {
	$tableQuery = mysqli_query($database,"SELECT Email FROM Mentee");
	
	//Remove all matches to this Mentor from the Mentee table
	while($row = mysqli_fetch_array($tableQuery))
	{
	    //Remove this Mentor from the current Mentee's MathcedWith
	    removeMatch($database,$mentorEmail,$row[0]);
	}

	//Remove this mentor from the Mentor table
	$query = generateDeleteQuery("Mentor","Email",$mentorEmail);
	mysqli_query($database,$query);
    }

    function setMatchedWith($database,$email,$data) 
    {
	$columns = array("Email","MatchedWith");
	$rowData = array($email,$data);
	$query = generateUpdateQuery("Mentor",$columns,$rowData);
	mysqli_query($database,$query);
    }
    
    function addMentor($database,$columns,$values)
    {
	$query = generateInsertQuery("Mentor",$columns,$values);
	mysqli_query($database,$query);
    }

    /*
     * Removes all rows from the Mentor table.
     */
    function clear($database)
    {
	mysqli_query($database,"DELETE FROM Mentor");
    }
}
?>
