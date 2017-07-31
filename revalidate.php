<?php
session_start();
$msg = "";
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
                      <form action="revalidate.php" method="post" name="form1" id="form1">
                          <label>Driver's Licence No</label>
                          
                         <input class="form-control" placeholder="Enter the Licence Number" name="lincence_no"><br>
                         
                         
                         <input name="loger1" type="hidden" id="loger1" value="loger1" />
                         <input type="submit" name="button" id="" value="ReValidate Licence" class="btn btn-lg btn-success btn-block" >            
                       </form>
                                     </div>
                                      </div>
               
        <hr>
          
          <?php
		  include "database_connection.php";
		   $msg = "";
if((isset($_POST["loger1"])) && ($_POST["loger1"] == "loger1"))
{ //making sure that the login button is clicked
$lincence_no = $_POST["lincence_no"];
	if ($lincence_no <> "")
	{
		$sresult = mysql_query("select * from users where lincence_no = '$lincence_no'");
		if (mysql_num_rows($sresult) == 0){
			$msg = "The Licence Number you entered is not registered";
		}else{
		$re = mysql_query("select * from users where lincence_no = '$lincence_no'");
			$puts = mysql_fetch_array($re);
			$lincence = $puts["lincence_no"];
			$name = $puts["name"];
			$the_image = $puts["the_image"];
			$issued_date = $puts["issued_date"];
			$expiry_date = $puts["expiry_date"];
			$gender = $puts["gender"];
			$phone = $puts["phone"];
		$msg = " * * * View user details below";			
			echo '<div>
      
<table align="center" class="table table-striped table-bordered table-hover">
        <tbody><tr>
          <td width="250" height="270" align="left" valign="top">
           <img src="upload_folder/'.$the_image .'" width="250" height="278" />
         </td>
          <td width="587" align="left" valign="top">
		  <table width="591"  class="table table-striped table-bordered table-hover">
        <tr>
          <td height="25" colspan="2"><strong>Licence Owner Details</strong></td>
          </tr>
        <tr>
          <td width="117" height="25"><strong>Fullname</strong></td>
          <td width="433">'.$name.'</td>
        </tr>
          <tr>
            <td><strong>Gender</strong></td>
            <td>'.$gender.'</td>
          </tr>
        <tr>
          <td><strong>Phone</strong></td>
          <td>'. $phone.'</td>
        </tr>
          <tr>
          <td height="22"><strong>Licence Number</strong></td>
          <td>'.$lincence_no.'</td>
        </tr>
		
		   <tr>
		     <td height="22" colspan="2">Date of Issue: <strong>'.$issued_date.'</strong></td>
		     </tr>
         <tr>
		     <td height="22" colspan="2">Expiry Date: <strong>'.$expiry_date.'</strong></td>
		     </tr>
         </table>            
       </td>
        </tr>
      </tbody></table>
    </div>';
		}
	}else{
		$msg = "Your must enter the Licence Number";
	}
}
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

