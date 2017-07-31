<?php
session_start();
$id = $_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>FEDERAL ROAD SAFETY COMMISSION</title>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="css/plugins/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>

<body>

    <div id="wrapper">

      <?php include('top_nav.php');?>  
     <?php include('nav.php');?>


        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                  <h1 class="page-header">ReValidate Licence</h1>
                 <div class="form-group">
                     <div style="width:1000px; margin:auto">
                     
                     <?php
					 include "database_connection.php";
$sql = "SELECT * FROM `users` WHERE `id`='$id'  LIMIT 1";
$retval = mysql_query($sql);
$count = mysql_num_rows($retval);
if($retval){
	while($rows = mysql_fetch_array($retval)){
		$id = $rows['id'];
		$name = $rows['name'];
		$gender = $rows['gender'];
		$phone = $rows['phone'];
		$dob = $rows['dob'];
		$state = $rows['state'];
		$lincence_no = $rows['lincence_no'];
	}
}else{
	//
}
?>
                      <form action="<?php $_SERVER['PHP_SELF'];?>" method="post" name="form1" id="form1">
                                            <label>Driver's Licence No</label>
                                     <input class="form-control" value="<?php "FRSC". $state ."-".$id; ?>"  name="lincence_no" readonly><br>
                                     <input name="loger2" type="hidden" id="loger2" value="loger2" />
                         <input type="submit" name="button" id="" value="Generate Lincence number" class="btn btn-lg btn-success btn-block" >            
                                     </form>
                                     </div></div>
               
        <hr>
          
          <?php 
		 	//update starts
if(isset($_POST["loger2"]) && $_POST["loger2"] == "loger2")
{$lincence = $_POST['lincence_no'];
$check_for_duplicates = mysql_query("select * from `users` where `lincence_no` = '$lincence'");
if($lincence == "")
	{$msg = 'Please Select User';}
	else if(mysql_num_rows($check_for_duplicates) > 0) //username is unique within this system and must not be more than one
	{$msg = '<div class="info">Sorry, This user has been Previously Created</div><br>';}	
	else{
		$query = (mysql_query("update users SET lincence_no = '$lincence' WHERE `phone` = '".mysql_real_escape_string($_SESSION["LICENCE"])."' LIMIT 1 "));								
	header('location: dashboard.php');	
	}
}//closes update
?>
 </div>
    <!-- /#wrapper -->

    <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="js/plugins/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/sb-admin-2.js"></script>
<?php

?>
</body>

</html>

