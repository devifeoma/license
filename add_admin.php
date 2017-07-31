<?php
include "database_connection.php";
//Variables Assignment
	$firstname = "System";
	$lastname = "Administrator";
	$username = "admin";
	$password = "admin";
	$password1 = md5($password);
$info = "Admin Test Info";

	$sql = "insert into `admin` (id,firstname, lastname, username, password, pass, info, date)values('', '$firstname', '$lastname', '$username', '$password1','$password', '$info', '".mysql_real_escape_string(date('d-m-Y'))."')";
	$retval = mysql_query($sql);
if(!$retval){
	echo "Sorry, there was an error adding the username and password.";
	exit();
}else{
	echo 'Admin Successfully created. <a href="index.php">Click here to login</a>';
	exit();
}
?>