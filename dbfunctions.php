<?php
error_reporting(E_ALL); 
ini_set('display_errors', 1); 

//////////////////////////////////////////////////////////////////////////////

//first connect to the database
//this is a persistent connection, but you could also just use connect
//obviously, to connect to a different database, you need to change all the names of functions
//that start mysql
function dbConnect() {
	$dbConn = mysql_pconnect ("mysql-server-1", "ksb9", "abcksb9354") ;
	if (!$dbConn )
	{
		print "<p>Cannot connect to database - check username and password<br/>";
		print mysql_error()."</p>";
		print "</body>";
   	print "</html>";
		exit();
	}
}


//select the database
function dbSelect() {
	$db = mysql_select_db("ksb9");
	if (!$db)
	{
		print "<p>Cannot connect to database $dbname</br>";
		print mysql_error()."</p>";
		print "</body>";
   	print "</html>";
		exit("Bye");
	}
}

function insertRow($query) {

	$insResult = mysql_query($query);
	if ($insResult)
   	print($query . " Record inserted<br/>");
	else
	//don't expect to come here unless program logic error
	//or some other problem with the database
		print $query. " " . mysql_error(). "<br/>";   //vital to know why it failed
}

function runQuery($query) {

	$result = mysql_query($query);
	if ($result) {
   	//print($query . "<br/>");
   	return $result;
   }
	else
	{
	//don't expect to come here unless program logic error
	//or some other problem with the database
		print $query. " " . mysql_error(). "<br/>";   //vital to know why it failed
		print "</body>";
   	print "</html>";
		exit("Bye");
	}		
}
function displayTable($result) {
	$numrows = mysql_num_rows($result);
	if ($numrows == 0)
	{
	   print "<p>There was nothing in the table</p>";	
   	print "</body>";
      print "</html>";
   	exit();
   }
   //set up table
   print '<table border = "1">';
   
   //print headings
   $fieldCount = mysql_num_fields($result);
   print "<tr>";
   
   for ($i=0; $i<$fieldCount; $i++) {              
       // Set some values
       $fieldName = mysql_field_name($result, $i);
       print "<th>".$fieldName."</th>";
   }
   print "</tr>";
   
   //output each line
   // the fetch function gets the next row from the resultset and puts it into $row
   while ($row = mysql_fetch_row($result) )
   {
   	print ("<tr>");
      for ($i=0; $i<$fieldCount; $i++) 
   	{
   		print ("<td>". $row[$i] . "</td>") ;  
   	}
   	print ("</tr>");
   }
   print ("</table>");
}
function displayVertTable($result) {
   $numrows = mysql_num_rows($result);
   if ($numrows == 0)
   {
   	print "<p>There was nothing in the table</p>";	
   	print "</body>";
      print "</html>";
   	exit();
   }
   //set up table
   print '<table border = "1">';
   $fieldCount = mysql_num_fields($result);
   $row = mysql_fetch_row($result);   
   for ($i=0; $i<$fieldCount; $i++) 
   {
   	 print ("<tr>");
       $fieldName = mysql_field_name($result, $i);
       print "<td><em>".$fieldName."</em></td>";
   	 print ("<td>". $row[$i] . "</td>") ; 
   	 print "</tr>";
   }
   print ("</table>");
}


?>