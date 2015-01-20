<?php
include("conn.php");
set_time_limit(0);
date_default_timezone_set("UTC");

/*GET ALL BU*/
$sql = "SELECT * FROM admin_users
		LEFT JOIN admin_usersRoles ON admin_users.id = admin_usersRoles.admin_userID 
		WHERE  admin_usersRoles.roleID = 54";
$rows = $conn->Execute($sql);		

while(!$rows->EOF)
{
	echo "<br/>";
	echo $full_name 		= $rows->fields['full_name'];	
	echo $email_address 	= $rows->fields['email_address'];	
	echo $c_id 				= $rows->fields['countryID'];	

	$msg = "<label style='font-size:19px;font-family:Arial,Helvetica,sans-serif;color:#9e0b0f;'>San Miguel Brewing, International, LTD. </label><br/>
			<label style='font-size:12px;font-family:Arial,Helvetica,sans-serif;color:#777777;border-color: gray;'>Hi $full_name!<br/></label>
			<label style='font-size:12px;font-family:Arial,Helvetica,sans-serif;color:#777777;border-color: gray;'>Please check all new uploded items in Item Database. <br/>Date: ". date('Y-m-d') ."</label><br/>
			<br/>";
	
	if(reports($c_id,$conn)){
		$msg .= reports($c_id,$conn);
		//sendEmail($email_address, $msg, $full_name);
	}else{
		echo "nothing to send";
	}
	$rows->moveNext();
}


function sendEmail($email_address,$msg)
{
	include("smtpmail/library.php");
	include("smtpmail/classes/class.phpmailer.php");
	
	$email = $email_address;
    $mail  = new PHPMailer; 																 // call the class 
    $mail->IsSMTP(); 
    $mail->Host 	= SMTP_HOST; 															 //Hostname of the mail server
    $mail->Port 	= SMTP_PORT; 															 //Port of the SMTP like to be 25, 80, 465 or 587
    $mail->SMTPAuth = true; 																 //Whether to use SMTP authentication
    $mail->Username = SMTP_UNAME; 															 //Username for SMTP authentication any valid email created in your domain
    $mail->Password = SMTP_PWORD; 															 //Password for SMTP authentication
    $mail->AddReplyTo("do.not.reply@smg.sanmiguel.com.ph", "San Miguel Beer International"); //reply-to address
    $mail->SetFrom("do.not.reply@smg.sanmiguel.com.ph", "San Miguel Beer International"); 	 //From address of the mail
    // put your while loop here like below,
    $mail->Subject = "New Items in Item Database ".date('Y-m-d'); 							//Subject od your mail
    $mail->AddAddress($email, $full_name); 													//To address who will receive this email
    $mail->MsgHTML($msg); 																	//Put your body of the message you can place html code here
    $send = $mail->Send(); 																	//Send the mails
	
    if($send){
        echo '<center><h3 style="color:#009933;">Mail sent successfully</h3></center>';
    }
    else{
        echo '<center><h3 style="color:#FF3300;">Mail error: </h3></center>'.$mail->ErrorInfo;
    }
}


function reports($c_id,$conn)
{
$dayToday = date('Y-m-d');
$actions  = array(array('action'=>'add'));
$pCountry = "";

//MODULES
$dModules = array(array('dModule'=>'Item Database'));

$m = "";
$msg = "";

foreach($dModules as $d)
{
	extract($d);
	foreach($actions as $a)
	{
		extract($a);
		
		$sql = "SELECT rec_id, action, rec_name, 
				module_name, table_name, country.countryName as cName, 
				admin_users.full_name as fullName
				FROM logs 
				INNER JOIN country 	   ON country.id 	 = logs.country_id  
				INNER JOIN admin_users ON admin_users.id = logs.user_id
				WHERE logs.tdate = '$dayToday' 
				AND country_id= $c_id AND action='$action' AND module_name='$dModule' AND table_name='Items'
				GROUP BY rec_id 
				ORDER BY module_name";
		$records = $conn->Execute($sql);
		
		//print_r($records);
		
		if($records->RecordCount()>0)
		{			
			$c = "";	
			foreach($records as $r)
			{extract($r);
				//COUNTYR NAME
				if(($c=="" OR $c != $cName) AND $pCountry!=$cName){
					$msg .= "<label style='font-size:16px;font-family:Arial,Helvetica,sans-serif;color:#777777;'> <b>Country Name: $cName </b></label><br/>";
					$c    = $cName;
				}
				$pCountry = $cName;
			}
			
			$msg .="<table style='font-size:12px;font-family:Arial,Helvetica,sans-serif;color:#777777;border-color: gray;'>
					<tr> 
						<th style='width:100px;color:black;font-weight: bold;background:#FCD9D9'> Table 	 	 </th>
						<th style='width:100px;color:black;font-weight: bold;background:#FCD9D9'> Action   		 </th>
						<th style='width:100px;color:black;font-weight: bold;background:#FCD9D9'> Record ID	     </th>
						<th style='width:215px;color:black;font-weight: bold;background:#FCD9D9'> Record Name  	 </th>
						<th style='width:150px;color:black;font-weight: bold;background:#FCD9D9'> User  Name   	 </th>
					</tr>";
			
			$x=0;
			foreach($records as $r)
			{
			$cls = (($x++)%2) != 0 ? "style='background:#f9ebeb'" :  ""; 
			extract($r);
			$msg .= "<tr> 
						<td $cls> $table_name  	  </td> 
						<td $cls> $action  	  	  </td> 
						<td $cls> $rec_id  	  	  </td> 
						<td $cls> $rec_name 	  </td>
						<td $cls> $fullName 	  </td> 
					</tr> ";
			}
			
			$msg .= "</table><br/>";
		}
	}

}

return $msg;

}

?>