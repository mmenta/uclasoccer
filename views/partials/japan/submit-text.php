<?php
// turn on error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

# database setup
if (strpos($_SERVER['HTTP_HOST'], "local") === false) {
	//server
	$dbserver = "mysql51-054.wc2.dfw1.stabletransit.com";	
} else {
	//local server
	$dbserver = "72.32.40.35";	
}
$dbusername = "512772_uclasoc";
$dbpassword = "J@pan2014$";
$dbname = "512772_uclasoccer";

function sqlsafe($value) {
	return str_replace("'", "''", $value);
}

foreach($_REQUEST as $name => $value) {
	${$name} = trim(stripslashes(sqlsafe($value)));
}

if ($action == "save") {
	$cnn = mysql_connect($dbserver, $dbusername, $dbpassword);
	$cmd = mysql_select_db($dbname, $cnn);		
	
	$strSQL = "insert into texts (full_name, city, message, ipnumber) values ('".$full_name."','".$city."','".$message."','".$_SERVER['REMOTE_ADDR']."');";
	$rst = mysql_query($strSQL);
	echo mysql_error();
	
	mysql_close($cnn);	
}
