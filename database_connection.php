<?php
///Database Connection Settings
$host = "localhost";
$user = "root";
$password = "";
$database = "frsc";
$connection_str = mysql_connect($host,$user,$password) or die("could not connect to database");
$select_db = mysql_select_db($database) or die ("could not select database");
?>
