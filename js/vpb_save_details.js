//Open Login Box
function vpb_open_login_box() 
{
	$("#attendance_management_system").hide();
	$("#vpb_reset_password_box").hide();
	$("#vpb_open_signup_box").hide();
	$("#vpb_reset_password_box_question_and_answer").hide();
	$("#vpb_change_password_box").hide();
	$("#vpb_change_password_box_done").hide();
	$("#vpb_users_login_box").fadeIn();
	$("#login_status").html('');
}

//Open Forgot Password Box
function vpb_open_reset_password_box() 
{
	$("#attendance_management_system").hide();
	$("#vpb_users_login_box").hide();
	$("#vpb_open_signup_box").hide();
	$("#vpb_reset_password_box_question_and_answer").hide();
	$("#vpb_change_password_box").hide();
	$("#vpb_change_password_box_done").hide();
	$("#vpb_reset_password_box").fadeIn();
	$("#reset_password_status").html('');
}

//Open Sign-Up Box
function vpb_open_signup_box() 
{
	$("#attendance_management_system").hide();
	$("#vpb_reset_password_box").hide();
	$("#vpb_users_login_box").hide();
	$("#vpb_reset_password_box_question_and_answer").hide();
	$("#vpb_change_password_box").hide();
	$("#vpb_change_password_box_done").hide();
	$("#vpb_open_signup_box").fadeIn();
	$("#signup_status").html('');
}

//Change password process
function vpb_change_password()
{
	var username_reset = $("#username_reset").val();
	var new_password = $("#new_password").val();
	var verify_pass = $("#verify_pass").val();
	
	if(username_reset == "")
	{
		$("#change_password_status").html('<div class="info">Sorry, your username could not be verified any longer at the moment. Please refresh this page and try again. Thanks.</div>');
	}
	else if(new_password == "")
	{
		$("#change_password_status").html('<div class="info">Please enter your desired new password in the field provided above to proceed. Thanks.</div>');
		$("#new_password").focus();
	}
	else if(verify_pass == "")
	{
		$("#change_password_status").html('<div class="info">Please verify your provided new password to proceed. Thanks.</div>');
		$("#verify_pass").focus();
	}
	else if(verify_pass != new_password)
	{
		$("#change_password_status").html('<div class="info">Passwords did not match. Both New Password and Verify Password fields must be the same to proceed please. Thanks.</div>');
		$("#verify_pass").focus();
	}
	else
	{
		var dataString = 'username_reset=' + username_reset + '&new_password=' + new_password + '&page=vpb_change_password';
		$.ajax({
			type: "POST",
			url: "vpb_save_details.php",
			data: dataString,
			cache: false,
			beforeSend: function() 
			{
				$("#change_password_status").html('<br clear="all"><br clear="all"><div align="left"><font style="font-family:Verdana, Geneva, sans-serif; font-size:15px; color:black;">Please wait</font> <img src="images/loadings.gif" alt="Loading...." align="absmiddle" title="Loading...."/></div><br clear="all">');
			},
			success: function(response)
			{
				var response_brought = response.indexOf("completed");
				if(response_brought != -1)
				{
					$("#change_password_status").html('');
					$("#vpb_change_password_box").hide();
					$("#vpb_change_password_box_done").fadeIn();
					$("#account_passwor_changeed_successfully").html(response);
				}
				else
				{
					$("#change_password_status").fadeIn(1000).html(response);
				}
			}
		});
	}
}



//Vaslidate Answer for password reset process
function vpb_reset_password_question_and_answer()
{
	var username_reset = $("#username_reset").val();
	var security_answer = $("#security_answer").val();
	
	if(username_reset == "")
	{
		$("#reset_password_qa_status").html('<div class="info">Sorry, your username could not be verified any longer at the moment. Please refresh this page and try again. Thanks.</div>');
	}
	else if(security_answer == "")
	{
		$("#reset_password_qa_status").html('<div class="info">Please enter your security answer in the required field to proceed.</div>');
		$("#security_answer").focus();
	}
	else
	{
		var dataString = 'username_reset=' + username_reset + '&security_answer=' + security_answer + '&page=vpb_reset_password_answer_validation';
		$.ajax({
			type: "POST",
			url: "vpb_save_details.php",
			data: dataString,
			cache: false,
			beforeSend: function() 
			{
				$("#reset_password_qa_status").html('<br clear="all"><br clear="all"><div align="left"><font style="font-family:Verdana, Geneva, sans-serif; font-size:15px; color:black;">Please wait</font> <img src="images/loadings.gif" alt="Loading...." align="absmiddle" title="Loading...."/></div><br clear="all">');
			},
			success: function(response)
			{
				var response_brought = response.indexOf("validated");
				if(response_brought != -1)
				{
					$("#reset_password_qa_status").html('');
					$("#vpb_reset_password_box_question_and_answer").hide();
					$("#vpb_change_password_box").fadeIn();
				}
				else
				{
					$("#security_answer").val('').focus();
					$("#reset_password_qa_status").fadeIn(1000).html(response);
				}
			}
		});
	}
}

//Vaslidate Username for password reset process
function vpb_reset_password_username_validation()
{
	var username_reset = $("#username_reset").val();
	
	if(username_reset == "")
	{
		$("#reset_password_status").html('<div class="info">Please enter your account username in the required field to proceed.</div>');
		$("#username_reset").focus();
	}
	else
	{
		var dataString = 'username_reset=' + username_reset + '&page=vpb_reset_password_username_validation';
		$.ajax({
			type: "POST",
			url: "vpb_save_details.php",
			data: dataString,
			cache: false,
			beforeSend: function() 
			{
				$("#reset_password_status").html('<br clear="all"><br clear="all"><div align="left"><font style="font-family:Verdana, Geneva, sans-serif; font-size:15px; color:black;">Please wait</font> <img src="images/loadings.gif" alt="Loading...." align="absmiddle" title="Loading...."/></div><br clear="all">');
			},
			success: function(response)
			{
				var response_brought = response.indexOf("validated");
				if(response_brought != -1)
				{
					$("#reset_password_status").html('');
					$("#vpb_reset_password_box").hide();
					$("#vpb_reset_password_box_question_and_answer").fadeIn();
					$("#fullname_and_security_question").html(response);
				}
				else
				{
					$("#reset_password_status").fadeIn(1000).html(response);
				}
			}
		});
	}
}

//Users Account Creation
function vpb_users_registration() 
{
	var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	var case_no = $("#case_no").val();
	var case_cat = $("#case_cat").val();
	var client_name = $("#client_name").val();
	var client_phone = $("#client_phone").val();
	var court = $("#court").val();
	var lawyer = $("#lawyer").val();
	var status = $("#status").val();
	var client_add = $("#client_add").val();
	var case_title = $("#case_title").val();
	var rte1 = $("#rte1").val();
	var date = $("#date").val();
	
	if(case_no == "")
	{
		$("#signup_status").html('<div class="info">Please enter the Case Number in the required field to proceed.</div>');
		$("#case_no").focus();
	}
	else if(vpb_username == "")
	{
		$("#signup_status").html('<div class="info">Please enter a valid Reg. No. in its field to proceed.</div>');
		$("#susername").focus();
	}
	else if(theclass == "")
	{
		$("#signup_status").html('<div class="info">Please select your present class. Thanks.</div>');
		$("#stheclass").focus();
	}
	else if(term == "")
	{
		$("#signup_status").html('<div class="info">Please select your current term. Thanks.</div>');
		$("#sterm").focus();
	}
	else if(theyear == "")
	{
		$("#signup_status").html('<div class="info">Please select the current session. Thanks.</div>');
		$("#stheyear").focus();
	}
	else if(vpb_email == "")
	{
		$("#signup_status").html('<div class="info">Please enter your email address to proceed.</div>');
		$("#semail").focus();
	}
	else if(reg.test(vpb_email) == false)
	{
		$("#signup_status").html('<div class="info">Please enter a valid email address to proceed.</div>');
		$("#semail").focus();
	}
	else if(vpb_passwd == "")
	{
		$("#signup_status").html('<div class="info">Please enter your desired password to proceed.</div>');
		$("#spasswd").focus();
	}
	else if(question == "")
	{
		$("#signup_status").html('<div class="info">Please select a security question of your choice from the listed questions.<br>This question will be used during password reset process should you forget your password. Thanks.</div>');
		$("#squestion").focus();
	}
	else if(answer == "")
	{
		$("#signup_status").html('<div class="info">Please enter a desired security answer in the required field.<br>This answer will be used during password reset process should you forget your password. Thanks.</div>');
		$("#sanswer").focus();
	}
	else if(the_image === null || the_image === undefined)
	{
		$("#signup_status").html('<div class="info">Please upload your passport photograph. Thanks.</div>');
		$("#sthe_image").focus();
	}
	else
	{
		var dataString = 'vpb_fullname='+ vpb_fullname + '&vpb_username=' + vpb_username + '&theclass=' + theclass + '&term=' + term + '&theyear=' + theyear + '&email=' + vpb_email + '&passwd=' + vpb_passwd + '&question=' + question + '&answer=' + answer + '&the_image=' + the_image + '&page=users_registration';
		$.ajax({
			type: "POST",
			url: "vpb_save_details.php",
			data: dataString,
			cache: false,
			beforeSend: function() 
			{
				$("#signup_status").html('<br clea="all"><center><div align="center" style=""><font style="font-family:Verdana, Geneva, sans-serif; font-size:12px; color:black;">Please wait</font> <img src="images/loadings.gif" alt="Loading...." align="absmiddle" title="Loading...."/></div><center><br clea="all">');
			},
			success: function(response)
			{
				var returned_response = response.indexOf('completed');
				if(returned_response != -1)
				{
					$("#sfullname").val('');
					$("#susername").val('');
					$("#stheclass").val('');
					$("#sterm").val('');
					$("#stheyear").val('');
					$("#semail").val('');
					$("#spasswd").val('');
					$("#sanswer").val('');
					$("#sthe_image").val('');
					$("#signup_status").html('');
					vpb_open_signup_box();
					$("#success_status").html('<div class="info">Registration for <b>'+vpb_fullname+'</b> was successfull. <a href="">Continue</a>.</div>');
				}
				else
				{
					$("#signup_status").fadeIn(1000).html(response);
				}
			}
		});
	}
}

//Users Login
function vpb_users_login() 
{
	var vpb_username = $("#username").val();
	var vpb_passwd = $("#passwd").val();
	
	if(vpb_username == "")
	{
		$("#login_status").html('<div class="info">Please enter your account email address to proceed.</div>');
		$("#username").focus();
	}
	else if(vpb_passwd == "")
	{
		$("#login_status").html('<div class="info">Please enter your account password to go.</div>');
		$("#passwd").focus();
	}
	else
	{
		var dataString = 'username=' + vpb_username + '&passwd=' + vpb_passwd + '&page=users_login';
		$.ajax({
			type: "POST",
			url: "vpb_save_details.php",
			data: dataString,
			cache: false,
			beforeSend: function() 
			{
				$("#login_status").html('<br clear="all"><br clear="all"><div align="left"><font style="font-family:Verdana, Geneva, sans-serif; font-size:15px; color:black;">Please wait</font> <img src="images/loadings.gif" alt="Loading...." align="absmiddle" title="Loading...."/></div><br clear="all">');
			},
			success: function(response)
			{
				var response_brought = response.indexOf('login_process_completed_successfully=yes');
				if (response_brought != -1) 
				{
					$("#login_status").html('');
					window.location.replace(response);
				}
				else
				{
					$("#login_status").fadeIn(1000).html(response);
				}
			}
		});
	}
}