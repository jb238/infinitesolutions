<?php
error_reporting(E_ALL); 
ini_set('display_errors', 1); 
include ("dbfunctions.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
</head>

<?php
session_start();
//connect to database
dbConnect() ;
//dbSelect("$username");
dbSelect();

$user = $_POST['user'];
$password = $_POST['pwd'];

$query = "SELECT * FROM users WHERE username= '$user' AND password = '$password'";

$result = runQuery($query);
$numrows = mysql_num_rows($result);

if ( $numrows > 0) {
// Set username session variable
$_SESSION['username'] = $_POST['user'];
// Jump to secured page
header('Location: Summary.html');
}
else {
// Jump to login page
header('Location: login.html');
}

?>

<body>
</body>
</html>
