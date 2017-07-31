<?php
session_start();
include "database_connection.php";
$username = $_SESSION['VALID_USER_ID'];
if(!isset($_SESSION['VALID_USER_ID'])){
	header("location: index.php");
}


if((isset($_POST["loger"])) && ($_POST["loger"] == "loger"))
{ //making sure that the login button is clicked
	if(isset($_POST["checkbox"])){
		foreach ($_POST['checkbox'] as $selectedOption){
		$id = $selectedOption;
		mysql_query("DELETE FROM users WHERE id = '$id'");	
		}
	}
 }

?>
<!DOCTYPE html>
<html lang="en">

<head>

<script src="js/jquery.min.js" type="text/javascript"></script>
  <script type="text/JavaScript">
function toggleChecked(status) {
$(".checkbox").each( function() {
$(this).attr("checked",status);
})
}
</script>


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

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>

<body>

    <div id="wrapper">

      <?php include('top_nav.php');?>  
     <?php include('nav.php');?>



        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">View All Licences</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            View All Licences Below
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                            <form action="" method="post" class="niceform">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Fullname</th>
                                            <th>Licence Number</th>
                                            <th>Issuing State</th>
                                            <th>Date of Expiry</th>
                                            <th> Delete Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
			  $puter = mysql_query("select * from users") or die (mysql_error());
			  while ($row = mysql_fetch_array($puter))
			  {
			  $id = $row["id"];
			  $name = $row["name"];
			  $lincence = $row["lincence_no"];
			  $phone = $row["phone"];
			  $issued = $row["issued_date"];
			  $expiry = $row["expiry_date"];
			  $state = $row["state"];
			  
             echo"<tr class='odd gradeX'>
                                            <td><input type='checkbox' name='checkbox[]' value='$id' class='checkbox' />" . " ".$name."</td>
                                            <td>".$lincence."</td>
                                            <td>".$state."</td>
                                            <td class='center'>".$expiry."</td>
                                            <td class='center'>". $expiry ."</td>
                                        </tr>";
			  }
			  ?>
                                        
                                        </tbody>
                                </table>
               <input name="submit" type="submit" value="Delete Selected Admin (s)"  class="btn btn-lg btn-success btn-block"/>
				  <input name="loger" type="hidden" id="loger" value="loger"  />
                
                </form>
                            </div>
                            <br>
                            <!-- /.table-responsive -->
                            <div class="well">
                                <h4>Important Information</h4>
                                <p>For Each User you did not create, Never Hesitate to use the Delete Button. Thanks</p>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row"><!-- /.col-lg-6 --><!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->
          <div class="row"><!-- /.col-lg-6 --><!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->
          <div class="row"><!-- /.col-lg-6 --><!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="js/plugins/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').dataTable();
    });
    </script>

</body>

</html>
