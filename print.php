<?php
session_start();
include "database_connection.php";
if(!isset($_SESSION['VALID_USER_ID'])){
	header("location: index.php");
}
$lincence = $_SESSION['IDCARD'];
$sql = "SELECT * FROM `users` WHERE `lincence_no`='$lincence'  LIMIT 1";
$retval = mysql_query($sql);
$count = mysql_num_rows($retval);
if($retval){
	while($rows = mysql_fetch_array($retval)){
		$id = $rows['id'];
		$name = $rows['name'];
		$gender = $rows['gender'];
		$blood_group = $rows['blood_group'];
		$phone = $rows['phone'];
		$dob = $rows['dob'];
		$address = $rows['address'];
		$issued_date = $rows['issued_date'];
		$expiry_date = $rows['expiry_date'];
		$state = $rows['state'];
		$the_image = $rows['the_image'];
		$date = $rows['date'];
	}
}else{
	//
}

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
             
                 <div class="form-group"><br><br>
                    <div style="width:700px">
      
<table align="center" class="table table-striped table-bordered table-hover">
        <tbody><tr>
          <td width="218" height="260" align="left" valign="top">
           <img src="upload_folder/<?php echo $the_image; ?>" width="227" height="242" />
         </td>
          <td width="451" align="left" valign="top">
		  <table width="428"  class="table table-striped table-bordered table-hover">
        <tr>
          <td height="25" colspan="2"><strong>NATIONAL DRIVERS LICENCE</strong></td>
          </tr>
        <tr>
          <td width="145" height="25"><strong>Fullname</strong></td>
          <td width="272"><?php echo $name; ?></td>
        </tr>
          <tr>
            <td>Date Of Birth</td>
            <td><?php echo $dob ?></td>
          </tr>
          <tr>
            <td><strong>Gender</strong></td>
            <td><?php echo $gender; ?></td>
          </tr>
          <tr>
            <td height="22"><strong>Licence Number</strong></td>
            <td><?php echo $lincence; ?></td>
          </tr>
          <tr>
            <td height="22">Issued: </td>
            <td><strong><?php echo $issued_date. " ".$state ." State";  ?></strong></td>
          </tr>
          <tr>
          <td height="22">Expiry Date</td>
          <td><strong><?php echo $expiry_date; ?></strong></td>
          </tr>
         </table>            
       </td>
        </tr>
      </tbody></table>
    </div><a href="javascript:window.print()">Print Licence</a> | <a href="dashboard.php">Exit</a>
                      </div>
             
        
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

