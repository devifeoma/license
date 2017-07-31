<?php
session_start();
ob_start();

//Include the database connection file
include "database_connection.php";
$error = "";
//Check to see if the submit button has been clicked to process data
if(isset($_POST["submitted"]) && $_POST["submitted"] == "yes")
{
	//Variables Assignment
	$username = trim(strip_tags($_POST['username']));
	$user_password = trim(strip_tags($_POST['passwd']));
	$encrypted_md5_password = md5($user_password);
	
	$validate_user_information = mysql_query("select * from `admin` where `username` = '".mysql_real_escape_string($username)."' and `password` = '".mysql_real_escape_string($encrypted_md5_password)."'");
	
	//Validate against empty fields
	if($username == "" || $user_password == "")
	{                           
	$error = '<br><div class="alert alert-danger alert-dismissable">Sorry, all fields are required to log into The System.</div><br>';
	}
	elseif(mysql_num_rows($validate_user_information) == 1) //Check if the information of the user are valid or not
	{
		//The submitted info of the user are valid therefore, grant the user access to the system by creating a valid session for this user and redirect this user to the welcome page
		$get_user_information = mysql_fetch_array($validate_user_information);
		$_SESSION["VALID_USER_ID"] = $username;
		$_SESSION["USER_FULLNAME"] = strip_tags($get_user_information["firstname"].'&nbsp;'.$get_user_information["lastname"]);
		header("location: dashboard.php");
	}
	else
	{
		//The submitted info the user are invalid therefore, display an error message on the screen to the user
		$error = '<br><div class="info">Sorry, you have provided incorrect information. Please enter correct user information to proceed. Thanks.</div><br>';
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

    <!-- Custom CSS -->
    <link href="css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                       
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="username" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="passwd" type="password" value="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>
                                
<input type="hidden" name="submitted" id="submitted" value="yes">
<input type="submit" name="submit" id="" value="Login" style="margin-right:50px;" class="btn btn-lg btn-success btn-block">

                                <!-- Change this to a button or input when using this as a form -->
                            </fieldset>
                        </form>
                        
                    </div>
                </div>
                
                <div style="width:450px; margin:auto"><?php echo $error; ?></div>
                
                
            </div>
        </div>
    </div>

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
