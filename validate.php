<?php
  session_start();
	include "database_connection.php";	   
if((isset($_GET["number"]))){ 
       $number = $_GET["number"];
		       
if ($number <> "")	{
	$re = mysql_query("select * from users where lincence_no = '$number' LIMIT 1");
	     if (mysql_num_rows($re) == 0){
			$msg = "ERROR!!  The Licence Number you entered is not registered";
		}
		else
		{
			$puts = mysql_fetch_array($re);
			$msg = json_encode($puts);
		}

	}
 }
    echo $msg;
?> 
