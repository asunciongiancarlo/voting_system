<center>	<div id='login_body'>		<p style='padding:100px;'>		Forgot Password Form		<?php 			echo "<form name='form' id='newUser' action='".HTTP_PATH."forgot_password/send' method='post'> 					<table style='margin-top: -92px;color:white;'>						<tr>							<td><label>Full Name:</label></td>							<td><input name='full_name' id='full_name' value='' style='width: 130%;'></td>						</tr>						<tr>							<td><label>User Name:</label></td>							<td><input name='user_name' id='user_name' value='' style='width: 130%;'> </td>						</tr>						<tr>							<td><label>Email Address:</label> </td>							<td><input name='email_address2' id='email_address2' value='' style='width: 130%;'></td>						</tr>						<tr>					</table>					<input type='button' name='Submit' value='Submit' onclick='validate()' style='margin-right: -293px;'>				  </form>";		?>	</div></center><script>function validate(){	var full_name 	  = document.getElementById('full_name').value;	var user_name 	  = document.getElementById('user_name').value;	var email_address2 = document.getElementById('email_address2').value;	var msg			  = "";		if(full_name=='' || full_name==' ') msg += 'Enter full name \n';	if(full_name=='' || full_name==' ') msg += 'Enter user name \n';	if(validateEmail(email_address2))    msg += 'Enter a valid email \n';		if(msg==''){		document.getElementById('newUser').submit();	}else{ 		alert(msg); 		}}function validateEmail(email){	var filter=/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;	var filter2=/--/i;	 	if(email=='') return true;	if (filter2.test(email))		return true;	if (filter.test(email)) 		return false;	else		return true;}</script><style>	#login_body {	background-image: url(../img/background2.png);	margin-top: -35px;	height: 341px;	width: 556px;	background-repeat: repeat -y;	margin-top:50px;	color:white;	font-family:calibri;	}</style>