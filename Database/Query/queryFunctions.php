<?php
/* 
 * Generates a query to update a row in $tableName 
 * Assumes that $columns[0] and $rowData[0] correspond
 * to the primary key of the table and therefore will
 * not be changed by the update.
 */
function generateUpdateQuery($tableName, $columns, $rowData)
{
    //Genereate the SET part of the query
    $i = 0;
    $set = "";

    for($i = 0; $i < count($columns); $i=$i+1)
    {
	//Check if the data value has been put inside single-quotes and add
	//them if needed
	$len = strlen($rowData[$i]);
	if( $len <= 1 || $rowData[$i][0] != "'" || $rowData[$i][$len-1] != "'" )
	    $set = $set . $columns[$i] . "='" . $rowData[$i] . "'";
	else
	    $set = $set . $columns[$i] . "=" . $rowData[$i];

	if ($i+1 < count($columns))
	    $set = $set . ",";
    }

    $len = strlen($rowData[0]);
    if( $len <= 1 || $rowData[0][0] != "'" || $rowData[0][$len-1] != "'" )
	return "UPDATE " . $tableName . " SET " . $set . " WHERE " . $columns[0] . "='" . $rowData[0] . "'";
    else
	return "UPDATE " . $tableName . " SET " . $set . " WHERE " . $columns[0] . "=" . $rowData[0];
}

/*
 * Generates a query to insert a row into $tableName, where
 * the row has the values $values in the corresponding $columns.
 *
 * The return value is a string which can be used as a query to
 * the database.
 */
function generateInsertQuery($tableName,$columns,$values)
{
    $i = 0;
    $columnString = "";
    $valueString = "";

    for($i = 0; $i < count($columns); $i++)
    {
	if($i > 0)
	{
	    $columnString = $columnString . "," . $columns[$i];
	    
	    $len = strlen($values[$i]);
	    if( $len <= 1 || $values[$i][0] != "'" || $values[$i][$len-1] != "'" )
		$valueString  = $valueString . ",'" . $values[$i] . "'";
	    else
		$valueString  = $valueString . "," . $values[$i];
	}
	else
	{
	    $columnString = $columns[0];

	    $len = strlen($values[0]);
	    if( $len <= 1 || $values[0][0] != "'" || $values[0][$len-1] != "'" )
		$valueString  = "'" . $values[0] . "'";
	    else
		$valueString  = $values[0];
	}
    }
    
    //INSERT INTO table_name (column1, column2, column3,...)
    //VALUES (value1, value2, value3,...) 
    return "INSERT INTO $tableName ($columnString) VALUES ($valueString)";
}

/*
 * Generates a query to delete a row or rows from
 * $tableName, where the row(s) to be deleted are
 * specified by the $column,$value pair.
 * 
 * The return value is a string which can be used as a query to
 * the database.
 */
function generateDeleteQuery($tableName,$column,$value)
{
    $len = strlen($value);
    if( $len <= 1 || $value[0] != "'" || $value[$len-1] != "'" )
	return "DELETE FROM $tableName WHERE $column='$value'";
    else
	return "DELETE FROM $tableName WHERE $column=$value";
}
?>
