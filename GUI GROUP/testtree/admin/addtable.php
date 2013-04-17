<?php
$con=mysqli_connect("localhost","cyrus","gotigers","pics");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

// Create table
$sql="CREATE TABLE docs (username VARCHAR ( 30 ) NOT NULL PRIMARY KEY COMMENT 'unique user id',  name VARCHAR( 30 ) NOT NULL COMMENT 'file name',  type VARCHAR( 30 ) NOT NULL COMMENT 'MIME type',  size INT( 11 ) NOT NULL COMMENT 'file size');";

// Execute query
if (mysqli_query($con,$sql))
  {
  echo "Table docs created successfully";
  }
else
  {
  echo "Error creating table: " . mysqli_error();
  }
