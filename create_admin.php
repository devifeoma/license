<?php
session_start();
include "database_connection.php";
$username = $_SESSION['VALID_USER_ID'];
if(!isset($_SESSION['VALID_USER_ID'])){
	header("location: index.php");
}

//Check to see if the submit button has been clicked to process data
if(isset($_POST["submitted"]) && $_POST["submitted"] == "yes")
{
	//Variables Assignment
	$firstname = trim(strip_tags($_POST['firstname']));
	$lastname = trim(strip_tags($_POST['lastname']));
	$username = trim(strip_tags($_POST['username']));
	$user_password = trim(strip_tags($_POST['passwd']));
	$encrypted_md5_password = md5($user_password);
	$info = trim(strip_tags($_POST['info']));
	
	$check_for_duplicates = mysql_query("select * from `admin` where `username` = '".mysql_real_escape_string($username)."'");
	
	//Validate against empty fields
	if($firstname == "" || $lastname == "" || $username == "" || $user_password == "")
	{
		$error = '<br><div class="alert alert-danger alert-dismissable">Sorry, all fields are required to create a new account. Thanks.</div><br>';
	}
	else if(mysql_num_rows($check_for_duplicates) > 0) //Email address is unique within this system and must not be more than one
	{
		$error = '<br><div class="alert alert-danger alert-dismissable">Sorry, the Username already exist in the database and duplicate usernames are not allowed. Thanks.</div><br>';
	}
	else
	{
		if(mysql_query("insert into `admin` values('', '".mysql_real_escape_string($firstname)."', '".mysql_real_escape_string($lastname)."', '".mysql_real_escape_string($username)."', '".mysql_real_escape_string($encrypted_md5_password)."', '".mysql_real_escape_string($user_password)."', '".mysql_real_escape_string($info)."','".mysql_real_escape_string(date('d-m-Y'))."')"))
		{
			$_SESSION["VALID_USER_ID"] = $username;
			$_SESSION["USER_FULLNAME"] = strip_tags($firstname.'&nbsp;'.$lastname);
			header("location: dashboard.php");
		}
		else
		{
			$error = '<br><div class="alert alert-danger alert-dismissable">Sorry, your account could not be created at the moment. Please try again or contact the site admin to report this error if the problem persist. Thanks.</div><br>';
		}
	}
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

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

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
                    <h1 class="page-header">Create Administrator</h1>
                   
                      
                      <!---------------admin starts----------->
                      
                      <div class="panel panel-default">
                        <div class="panel-heading">
                            Create New Administrator
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                   
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                        <div class="form-group">
                                            <label>Firstname</label>
                                     <input class="form-control" placeholder="Enter the Admin Firstname Here" name="firstname">
                                            <p class="help-block">Enter the firstname of the Administrator</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Lastname</label>
                                            <input class="form-control" placeholder="Enter the Lastname Here" name="lastname">
                                            <p class="help-block">Enter the Lastname of the Administrator</p>
                                        
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Brief Information about the Administrator</label>
                                            <textarea class="form-control" rows="8" name="info"></textarea>
                                        </div>
                                        
                                       
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                                <div class="col-lg-6">
                                
                                    <label>Admin Username</label>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">@</span>
                                            <input type="text" class="form-control" placeholder="Username" name="username">
                                             </div><p class="help-block">Choose Username for new Admin.</p>
                                       
                                        <label>Admin Password</label>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon">*</span>
                                            <input type="password" class="form-control" name="passwd">
                                        </div><p class="help-block">Choose a new Password.</p>
                                        
                                        <hr>
                                          
<input type="hidden" name="submitted" id="submitted" value="yes">
<input type="submit" name="submit" id="" value="Create Admin" class="btn btn-lg btn-success btn-block" style="width:200px">
                                <!-- Change this to a button or input when using this as a form -->
                           <br>
                        &bull; <a href="dashboard.php">Cancel</a>
                                    </form>
                                    
                
                <div style="width:450px; margin:auto"> <?php echo $error;  ?></div>
                
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                      
                      <!-----admin Eds------------>
                      
                      
                                        
                </div>
                <!-- /.col-lg-12 -->
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

    <!-- Custom Theme JavaScript -->
    <script src="js/sb-admin-2.js"></script>

</body>

</html>

