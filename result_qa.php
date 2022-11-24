<?php include('config.php'); 


	if(!isset($_SESSION["username"]) && !isset($_SESSION["fullname"])) {
    header("location: log-in.php");
		exit;	
	}
	
	if(isset($_SESSION['courseFinished'])) {
	header("location: logout.php");	
	exit;	
	}
	
    if(isset($_SESSION['returnAdmin'])) {
	header("location: user-admin.php");	
	exit;	
	}

	unset($_SESSION['random_questions']);
	unset($_SESSION['attempt']);
    unset($_SESSION['last_answered']);

	$current_module = (int)$_GET['module'];
	
	$sql = "SELECT * FROM user WHERE username='".$_SESSION['username']."' AND `".$current_module."`='Yes'";
	$query = mysql_query($sql);
 	$details = mysql_fetch_assoc($query);

	
	$sql = "SELECT * FROM course WHERE course_ID = '".$details['course']."'";
    $result = mysql_query($sql) or die(mysql_error());
    $courseDetails = mysql_fetch_assoc($result);


	
date_default_timezone_set('Europe/London');
$timestamp = time(); 
$_SESSION['timeInsert'] = date('Y-m-d H:i:s', $timestamp);

	mysql_query("insert into user_attempts (`module`, `attempt_time`, `status`, `user_id`, `course_ID`) values ('$current_module', '". $_SESSION['timeInsert'] ."', 'pass', '".$details['ID']."', '".$details['course']."')") or die(mysql_error()); 

$_SESSION['returnAdmin'] = 1;




	
	if ($current_module == $courseDetails['modules'] || DEMO_MODE) {
	
			 //reset password
		if (DEMO_MODE) {
			$sql="UPDATE `user` SET `".$current_module."`='No' WHERE username= '".$_SESSION["username"]."'";
            mysql_query($sql);
		}else{
	    $sql_update_user = "UPDATE user SET username = NULL, password = NULL, activated = 'No', date_activated = '". $_SESSION['timeInsert'] ."'    WHERE username= '".$_SESSION["username"]."'";
	    mysql_query($sql_update_user);
	
		 //get variables for survey
	$_SESSION["surveyLanguage"] = $details['language'];
    $_SESSION["surveyOrder"] = $details['order-number'];
	$_SESSION["surveyCourse"] = $courseDetails['course_name'];
    $_SESSION['courseFinished'] = 1;
	}
	
	
		// send the pdf
		date_default_timezone_set('Europe/London');
		
		$pdf_file = 'temp/'.(str_replace(' ', '_', $_SESSION['fullname'])).'-'.date('d-m-Y').'.pdf';
		
		generate_pdf($details,$pdf_file);
		
		// email the generated pdf
		$email_content = "<html>	
		
		
		<body style=\"margin: 0; padding: 0; font-family:arial\">
		
		
		
		<table width=\"600\" border=\"1\" cellspacing=\"0\" cellpadding=\"5\">
		<tr>
		<td>
		<img src=\"{$site_url}/images/header.jpg\" width=\"600\" height=\"58\" alt=\"SafetyBugTraining.com\"/>
		</td>
		</tr>
		<tr>
		
		<td>
		
		<h2>Congratulations</h2>";
		
		if (DEMO_MODE) {
			$email_content .= "<p>You have successfully passed the demo module for Safety Bug Training. Please find attached your Safety Bug Training certificate.</p>";
			
			$sql = "SELECT d.* FROM user u LEFT JOIN discount d ON u.serial=d.DISCOUNT WHERE u.username='".$_SESSION['username']."' AND u.`order-number`='SBT-01-DEMO' ORDER BY ID DESC";
			$d_query = mysql_query($sql);
			
			if (mysql_num_rows($d_query)) {
				$discount = mysql_fetch_assoc($d_query);
				$email_content .= "<p>We are also pleased to offer a ".$discount['VALUE']."% discount when you wish to purchase serials. Please enter the following code \"".$discount['DISCOUNT']."\" on our sign-up form: <a href=\"{$site_url}paypal.php\">{$site_url}paypal.php</a></p>";
			}
		} else 
			$email_content .= "
            <p>You have successfully passed all modules of the <strong>".$courseDetails['course_name']." </strong> course. Please find attached your Safety Bug Training certificate.</p>"; 	
			
		$email_content .= "
		Kind regards
		
		</p>
			<p>

		

		<strong>safetybugtraining.com</strong><br/>
Company No. 8210196 &amp; Vat Reg. 142 2589 19<br/>
Tel: 01223 258156<br/>
E-mail: <a href=\"mailto:info@safetybugtraining.com\">info@safetybugtraining.com</a>
		

		</p>
		
		</td>
		
		</tr>
		<tr>
		<td>
		<img src=\"{$site_url}/images/footer.jpg\" width=\"600\" height=\"37\" alt=\"SafetyBugTraining.com\"/>
		</td>
		</tr>
		</table>
		</body>
		
		</html>";
		
		if (!DEMO_MODE) {
			$first_order_number = explode("-", $_SESSION["order_number"]);
			$first_order_number[1] = "01";
			$first_order_number = implode("-", $first_order_number);
                        
                        $nrsr = mysql_num_rows(mysql_query("select siteID from redirects where siteID='".$details['site_id']."'"));
                        if($nrsr > 0){
                           $rres = mysql_fetch_assoc(mysql_query("select email from redirects where siteID='".$details['site_id']."'"));
                           
                           if(!is_email($_SESSION['username'])){			
                                $email_id = $rres['email'];
                                $ccemail_id = $rres['email'];
                            } else {
                                $email_id = $_SESSION['username'];
                                $ccemail_id = $rres['email'];
                            }
                           
                        }else{
                            $r = mysql_query("SELECT `email`, `cc-email` FROM `sign-up` WHERE `order_number`='".$first_order_number."'");
                            $emails = mysql_fetch_assoc($r);
                            if($emails['cc-email'] != ''){
                $email = $emails['cc-email'];
             }else{
                $email = $emails['email'];
             }
                            
                            if(!is_email($_SESSION['username'])){			
                                $email_id = $email;
                                $ccemail_id = $email;
                            } else {
                                $email_id = $_SESSION['username'];
                                $ccemail_id = $email;
                            }
                        }
                        
		} else {  //if demo mode
		$email_id = $_SESSION['username'];
		$ccemail_id = $_SESSION['username'];
		}
		
		
		require_once 'classes/Email.php';
		
		$cc_new['email'] =  $ccemail_id;
		
		$serial = $details['serial'];
		$serialno=formatserialno($serial);

		$subject = 'Safety Bug Training Certificate - '.$_SESSION['fullname'].' S. No. '.$serialno;

        send_email_with_attachment($email_id, AUTOMATED_EMAIL, SMTP_HOST, SMTP_PORT, SMTP_USER, SMTP_PASS, COMPANY_NAME, $subject, $email_content, $cc_new['email'], $pdf_file);
	

	}
	
// Get terminology CSV
$terminology_csv = 'course/terminology/'.$details['language'].'/terminology.csv';
$csv = array();
 if(($terminology_handle = fopen($terminology_csv, "r")) !== FALSE)
 {
    while(($terminology = fgetcsv($terminology_handle, 1000, ",")) !== FALSE)
    {
        $csv[] = $terminology;
    }
 }
 fclose($terminology_handle);	
 
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xml:lang="en" xmlns= "http://www.w3.org/1999/xhtml">
<head>
<title>Examination</title>
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<link rel="stylesheet" type="text/css" href="css/moduleQA.css"/>

<?php 
if ($details['language'] == 'Arabic' || $details['language'] == 'Urdu' || $details['language'] == 'Thai' || $details['language'] == 'Kurdish' || $details['language'] == 'Bengali')
{ 
?>
<link rel="stylesheet" type="text/css" href="css/fontSize3.css"/>
<?php
} 
else if ($details['language'] == 'Hindi' || $details['language'] == 'Gujarati' || $details['language'] == 'Punjabi')
{ 
?>
<link rel="stylesheet" type="text/css" href="css/fontSize2.css"/>
<?php
}
else
{ 
?>
<link rel="stylesheet" type="text/css" href="css/fontSize1.css"/>
<?php
}
?>
</head>
<body>



<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="10%">&nbsp;</td>
<td>
      <h3 class="moduleTitle"><?php /*Module*/echo $csv[7][1].' '; 
			 if ($courseDetails['course'] == 'allergen' && $current_module == '2') 
			 		{
			 echo $current_module . ' (Part1)';
			        }
			 elseif ($courseDetails['course'] == 'allergen' && $current_module == '3') 
		        	{
			 echo $current_module -1 . ' (Part2)';
			        }
					elseif ($courseDetails['course'] == 'allergen' && $current_module > '3')
					{
			 echo $current_module -1;
			        }
					else
					{
			 echo $current_module;
			        }
			 
 ?>: <?php /*result*/ echo $csv[9][1]; ?></h3>
<hr/>

<?php if (DEMO_MODE) { ?>

			
  <h3 class="moduleTitle">Safety Bug Training Demo</h3>
 <p class="moduleText">Thank you for trying the demo of Safety Bug Training. <a href="download_certificate.php" target="_blank">Please click here to download your 'watermarked' demo certificate.</a> A copy has also been sent to the following email <?= $_SESSION["username"] ?>. The demo is set-up so you can try this module as many times as you wish.</p>
<?php } else { ?>


	<?php if ($current_module == $courseDetails['modules']) { ?>
      <h3><?php /*Congratulations. You have passed all modules!*/ echo $csv[16][1]; ?></h3>
	 
 <p class="moduleText"><a href="download_certificate.php" target="_blank"><?php /*Please click here to download your certificate*/ echo $csv[17][1]; ?></a>.</p>


	<?php } else { ?>
 <h3><?php /*Congratulations. You have passed this module.*/ echo $csv[15][1]; ?></h3>
	<?php } ?>

	
	<?php 	if ($current_module == $courseDetails['modules']) 	{ ?>
	
     <div class="surveyButtonContainer">
        <div class="surveyLeft">
	<form method="post" action="">
	<input type="button" value="<?php /*Log-Out*/ echo $csv[5][1]; ?>" 
	onclick="location.href='logout.php';"      class="log-button" />
	</form>
    </div>      
      <div class="surveyRight">
    <form method="post" action="">
	<input type="button" value="<?php /*Take Survey*/ echo $csv[6][1]; ?>" 
	onclick="location.href='survey/question.php';"      class="log-button" />
	</form>  </div>
     </div>
    	<?php } else { ?>
        	<form method="post" action="">
	<input type="button" value="<?php /*Proceed*/ echo $csv[3][1]; ?>" 
	onclick="location.href='user-admin.php';"    class="log-button" />
	</form><?php }  } ?>
</td>
<td width="10%">&nbsp;</td>
</tr>
</table>
</body>
</html>