<?php
session_start();
include "database_connection.php";
$username = $_SESSION['VALID_USER_ID'];
if(!isset($_SESSION['VALID_USER_ID'])){
header("location: index.php");
}
$error = "";
//Check to see if the submit button has been clicked to process data
if((isset($_POST["loger2"])) && ($_POST["loger2"] == "loger2"))
{
	
/////////////////////random numbers		
	function random_num($size) {
	$alpha_key = '';
	$keys = range('A', 'Z');
	
	for ($i = 0; $i < 4; $i++) {
		$alpha_key .= $keys[array_rand($keys)];
	}

	$length = $size - 2;

	$key = '';
	$keys = range(0, 9);

	for ($i = 0; $i < $length; $i++) {
		$key .= $keys[array_rand($keys)];
	}

	return $alpha_key . $key;
}

$yes = random_num(10);	
/////////////////////////	
	
	//////////////////////////////////posting
	$name = strtoupper($_POST['name']);
	$gender = $_POST['gender'];
	$blood_group = $_POST['blood_group'];
	$phone = $_POST['phone'];	
	$dob_day = $_POST['dob_day'];
	$dob_month = $_POST['dob_month'];
	$dob_year = $_POST['dob_year'];	
	$dob = $dob_day."-".$dob_month."-".$dob_year;
	$address = $_POST['address'];
	$i_day = $_POST['i_day'];
	$i_month = $_POST['i_month'];
	$i_year = $_POST['i_year'];
	$issued = $i_day." ".$i_month." ".$i_year;
	$e_day = $_POST['e_day'];
	$e_month = $_POST['e_month'];
	$e_year = $_POST['e_year'];
	$expiry = $e_day." ".$e_month." ".$e_year;
	$state = $_POST['state'];
	$date = date('d-m-Y');
	$lincence = $yes;
	if(isset($_POST['the_image']) || !is_null($_POST['the_image'])){$the_image = $_POST['the_image'];}
    else
    {
$error = " <div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Sorry, this Image already exists.<BR> Please rename the image and try again!</div>";
	}
	if($name == "" || $phone == "" ||  $address == "")
	{
$error = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Please make sure that no field is empty.</div><br>';
	}
	else{if(move_uploaded_file($_FILES["the_image"]["tmp_name"],"upload_folder/" . $_FILES["the_image"]["name"]))
    {
$sql = "INSERT INTO `users`
(id, name, gender, blood_group, phone,  dob, address, lincence_no, issued_date, expiry_date, state, the_image, date) VALUES
('','{$name}', '{$gender}', '{$blood_group}', '{$phone}', '{$dob}', '{$address}', '{$lincence}', '{$issued}','{$expiry}', '{$state}','".$_FILES['the_image']['name']."', '{$date}')";
  
	$run_query = mysql_query($sql);
	if($run_query == true){
	$_SESSION["IDCARD"] = $lincence;
	header("location: print.php");
    }
    else
	{
$error = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Sorry, you cannot register this Licence at the moment. Thanks.</div><br>';
           }
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
                 <br> 
                                                            
                <div style="width:600px; margin:auto" id="signup_status"><?php echo $error; ?></div>
                
<div id="vasPhoto_uploads_Name" align="center" style="visibility:hidden"></div><!-- Display Response or Resultsto be uploaded -->

                      <!---------------admin starts----------->
                      
                      <div class="panel panel-default">
                        <div class="panel-heading">
                            Create New Licence
                 
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                   
<form method="post" action="create_user.php" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Fullname</label>
                                     <input class="form-control" name="name" placeholder="Fullname">
                                        </div>
                                        
                                         <div class="form-group">
                                            <label>Date of Birth:</label><br>
                                     <div style="width:150px; float:left"><select class="form-control" name="dob_day">
                                                <option value="">Date</option>
                                                  <?php for($i=1; $i<=31; $i++){if($i==15){
													echo "<option value='$i' selected>$i</option>";}
													else{
														echo "<option value='$i'>$i</option>";
														}}
														?>
                                            </select></div>
                                     <div style="width:180px; float:left"><select class="form-control" name="dob_month">
                                                <option value=""> Select Month</option>
                                                 <option value="01">January</option>
                                                 <option value="02">February</option>
                                                 <option value="03">March</option>
                                                 <option value="04">April</option>
                                                 <option value="05">May</option>
                                                 <option value="06">June</option>
                                                 <option value="07">July</option>
                                                 <option value="08">August</option>
                                                 <option value="09">September</option>
                                                 <option value="10">October</option>
                                                 <option value="11">November</option>
                                                 <option value="12">December</option>
                                            </select></div>
                                     <div style="width:150px; float:left"><select class="form-control" name="dob_year">
                                                <option value="">Date</option>
                                                  <?php for($i=1945; $i<=2000; $i++){if($i==1998){
													echo "<option value='$i' selected>$i</option>";}
													else{
														echo "<option value='$i'>$i</option>";
														}}
														?>
                                            </select></div>    
                                            <div style="clear:both"></div>                                
                                        </div>
                                        
                                        
                                        <div class="form-group">
                                            <label>Gender</label>
                                            <select class="form-control" name="gender">
                                                <option value="">Select Gender</option>
                                                <option value="MALE">Male</option>
                                                <option value="FEMALE">Female</option>
                                            </select>
                                        </div>
                                        
                                         
                                        
                                         <div class="form-group">
                                            <label>Blood Group:</label>
                                     <select class="form-control" name="blood_group">
                                                <option value="">Select Blood Group</option>
                                                <option value="AA">AA</option>
                                                <option value="AB">AB</option>
                                                <option value="O+">O+</option>
                                            </select>
                                        </div>  
                                       <div class="form-group">
                                            <label>Phone Number:</label>
                                     <input class="form-control" name="phone" placeholder="Enter Phone Number">
                                        </div>
                  
                                </div>
                                
                                                                     
                                        
                                <!-- /.col-lg-6 (nested) -->
                                <div class="col-lg-6">
                                    <label>Address</label>      
                                     <div class="form-group">
                                     <input type="text" class="form-control" placeholder="Enter your address" name="address">
                                        </div>
                                        
                                        
                                        
                                        <label>Date of Issuance:</label>      
                                     <div class="form-group">
                                     <div style="width:150px; float:left">
                                      <select class="form-control" name="i_day">
                                                <option value="">Date</option>
                                                  <?php for($i=1; $i<=31; $i++){if($i==26){
													echo "<option value='$i' selected>$i</option>";}
													else{
														echo "<option value='$i'>$i</option>";
														}}
														?>
                                            </select></div>
                                     <div style="width:150px; float:left"> <select class="form-control" name="i_month">
                                                <option value=""> Select Month</option>
                                                 <option value="JAN">January</option>
                                                 <option value="FEB">February</option>
                                                 <option value="MAR">March</option>
                                                 <option value="APR">April</option>
                                                 <option value="MAY">May</option>
                                                 <option value="JUN">June</option>
                                                 <option value="JUL">July</option>
                                                 <option value="AUG">August</option>
                                                 <option value="SEPT">September</option>
                                                 <option value="OCT">October</option>
                                                 <option value="NOV">November</option>
                                                 <option value="DEC">December</option>
                                            </select></div>
                                     <div style="width:150px; float:left"> <select class="form-control" name="i_year">
                                                <option value="">Year</option>
                                                  <?php for($i=2000; $i<=2016; $i++){if($i==2016){
													echo "<option value='$i' selected>$i</option>";}
													else{
														echo "<option value='$i'>$i</option>";
														}}
														?>
                                            </select></div>
                                     <br>  <br>
                                        </div>
                                        
                                       
<label>Expiry Date: <i>(<span style="color:#F00">This is Usually a day before this exact date Next Year</span>)</i></label>      
                                     <div class="form-group">
                                     <div style="width:150px; float:left">
                                      <select class="form-control" name="e_day">
                                                <option value="">Date</option>
                                                  <?php for($i=1; $i<=31; $i++){if($i==0){
													echo "<option value='$i' selected>$i</option>";}
													else{
														echo "<option value='$i'>$i</option>";
														}}
														?>
                                            </select></div>
                                     <div style="width:150px; float:left"> <select class="form-control" name="e_month">
                                                <option value=""> Select Month</option>
                                                 <option value="JAN">January</option>
                                                 <option value="FEB">February</option>
                                                 <option value="MAR">March</option>
                                                 <option value="APR">April</option>
                                                 <option value="MAY">May</option>
                                                 <option value="JUN">June</option>
                                                 <option value="JUL">July</option>
                                                 <option value="AUG">August</option>
                                                 <option value="SEPT">September</option>
                                                 <option value="OCT">October</option>
                                                 <option value="NOV">November</option>
                                                 <option value="DEC">December</option>
                                            </select></div>
                                     <div style="width:150px; float:left"> <select class="form-control" name="e_year">
                                                <option value="">Year</option>
                                                  <?php for($i=2000; $i<=2020; $i++){if($i==2019){
													echo "<option value='$i' selected>$i</option>";}
													else{
														echo "<option value='$i'>$i</option>";
														}}
														?>
                                            </select></div>
                                            <br>  <br>
                                        </div>
                                       
                                       
                                       
                                      <label>Issuing State</label>      
                                     <div class="form-group">
                                     <select class="form-control" name="state">
                                                <option value=""> Select Issuing State</option>
                                                 <option>Outside Nigeria</option>
<option value="ABUJA">ABUJA FCT</option>
<option value="ABIA">ABIA</option>
<option value="ADAMAWA">ADAMAWA</option>
<option value="AKWA IBOM">AKWA IBOM</option>
<option value="ANAMBRA" selected>ANAMBRA</option>
<option value="BAUCHI">BAUCHI</option>
<option value="BAYELSA">BAYELSA</option>
<option value="BENUE">BENUE</option>
<option value="BORNO">BORNO</option>
<option value="CROSS RIVER">CROSS RIVER</option>
<option value="DELTA">DELTA</option>
<option value="EBONYI">EBONYI</option>
<option value="EDO">EDO</option>
<option value="EKITI">EKITI</option>
<option value="ENUGU">ENUGU</option>
<option value="GOMBE">GOMBE</option>
<option value="IMO">IMO</option>
<option value="JIGAWA">JIGAWA</option>
<option value="KADUNA">KADUNA</option>
<option value="KANO">KANO</option>
<option value="KATSINA">KATSINA</option>
<option value="KEBBI">KEBBI</option>
<option value="KOGI">KOGI</option>
<option value="KWARA">KWARA</option>
<option value="LAGOS">LAGOS</option>
<option value="NASSARAWA">NASSARAWA</option>
<option value="NIGER">NIGER</option>
<option value="OGUN">OGUN</option>
<option value="ONDO">ONDO</option>
<option value="OSUN">OSUN</option>
<option value="OYO">OYO</option>
<option value="PLATEAU">PLATEAU</option>
<option value="RIVERS">RIVERS</option>
<option value="SOKOTO">SOKOTO</option>
<option value="TARABA">TARABA</option>
<option value="YOBE">YOBE</option>
<option value="ZAMFARA">ZAMFARA</option>
</select>
                                        </div>
                                       
                                
                                 <label>Upload Passport</label>      
                                     <div class="form-group">
                                      <input type="file" style="height:30px" name="the_image">
                                        </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        
                   
                                        
                           <div style="width:700px; margin:40px">
                           
                           <table width="289" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="202">
    
    
<input type="hidden" name="loger2" id="loger2" value="loger2">
<input type="submit" name="submit" id="" value="Registe Licence" style="width:200px" class="btn btn-lg btn-success btn-block" >
 
    <td width="19">&nbsp;</td>
    <td width="68">
        <button type="button" class="btn btn-danger"  style="width:200px">Cancel</button></td>
  </tr>
</table>
                                                                           
</div>
                         
                           </form>
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

