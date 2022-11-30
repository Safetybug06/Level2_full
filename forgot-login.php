<?php require('config.php'); ?>
<?php 

$err = "";



$sent_to = false;



if(count($_POST)) {

	$email=mysql_real_escape_string($_POST['email']) ;



	$sql="select ID, username,name from user where username='$email'";



	$result=mysql_query($sql);



	$count=mysql_num_rows($result);

	if($count==1){



		$details=mysql_fetch_array($result);



		$name=ucfirst($details['name']);



        $token = bin2hex(openssl_random_pseudo_bytes(16));

		//$password=rand(100000,999999);

        mysql_query("DELETE FROM password_resets WHERE user_id = '".$details['ID']."'");

		$sql="INSERT INTO password_resets (user_id, user_type, token, created_at) VALUES (

		    '".$details['ID']."',

		    'user',

		    '$token',

		    NOW()

		    

		    ) "; 

            

		mysql_query($sql);

		



		$message = "<html>	

		<body style=\"margin: 0; padding: 0\">

		



		<table width=\"600\" border=\"1\" cellspacing=\"0\" cellpadding=\"5\">



		<tr>



		<td>



		<img src=\"{$site_url}/images/header.jpg\" width=\"600\" height=\"58\" alt=\"SafetyBugTraining.com\"/>



		</td>



		</tr>



		<tr>



		



		<td>



		



		<h2>Forgotten Password</h2> 



		



		<p>Thank you <strong>{$name}</strong> for requesting a new password for SafetyBugTraining.com. If you didn't make this request then please ignore this email.</p> 



		<h3 align=\"center\">Reset your password</h3>



		



			<p>Click the following link to set a new password (link will expire in 2 hours):</p>



			<p>".$site_url."reset-password.php?reset={$token}</p>

<br/>



		<p>



		



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



		



		$subject = "Safety Bug Training Forgotten Password";

        //

		//

        //

		//$headers  = "From: do-not-reply@safetybugsecure.co.uk \n";

        //

		//$headers .= "Content-type: text/html\n";

        //

		



	send_email($email, AUTOMATED_EMAIL, SMTP_HOST, SMTP_PORT, SMTP_USER, SMTP_PASS, COMPANY_NAME, $subject, $message);





		



		//echo $message;		



		$sent_to = $email;



	} else {



		$err= "Invalid Email-id Entered";



	}	



}



?>

<?php require('header1.php'); ?>


<script type="text/javascript">	



	var numErrors = 0;

	$(document).ready(function() {



		// validate order form



		$("#email_form").validate({



			highlight: function(element, errorClass, validClass) {



			$(element).css("borderColor", "#ff0000");	



				if($(element).data("hightlighed") == "1") {

				} else {



					$(element).data("hightlighed", 1);



					numErrors++;



				}



				$("#required-note").css("display", "block");



			},



			unhighlight: function(element, errorClass, validClass) {



		$(element).css("borderColor", "");	



		



				if($(element).data("hightlighed") == "1") {



					$(element).data("hightlighed", 0);



					numErrors--;



				}



				if(numErrors == 0) {



					$("#required-note").css("display", "none");



				}



			},



			rules: {



				email: {



					required	: true,



					email 		: true



				},



			},



			messages: {			



				email: "",		



			}



		});	



	});



</script>
	<!-- Start Account Area -->
    <div id="content" class="account-area">
            <div class="d-table">
                <div class="d-table-cell">
                    <div class="container">
                        <div class="account-content">
                            <div class="account-header">
                                <a href="index.html">
                                    <img src="assets/images/SBT-logo-01.png" width="160" height="40" alt="main-logo">
                                </a>
                                <h3>Forget Password</h3>
                            </div>
        
                            <div class="alert alert-success" role="alert">
                                <h4 class="alert-heading">Account Recovery!</h4>
                                <?php if($err){

echo '<p style="color:red;">'.$err.'</p>';

}



if ($sent_to) { ?>



<p>A password reset link has been sent to <strong><?php echo $sent_to ?></strong></p>



     <p class="forgotten-password">(Please check 'spam' folder if email does not arrive).</p>

    

    



<?php } else { ?>
    <p>Please enter E-mail used for activation </p>  
                            </div>
        
                            <form id="email_form" action="" method="post" class="account-wrap">
                                <div class="form-group mb-24 icon">
                                    <input id="email" name="email" type="text" class="form-control" placeholder="Email">
                                    <img src="assets/images/icon/sms.svg" alt="sms">
                                </div>
                                <div class="form-group mb-24">
                                    <button name="" type="submit" value="Submit" class="default-btn">Submit</button>
                                </div>
                                <div class="form-group mb-24">
                                    <p class="account text-center">I don't have an email, <a href="forgot-userlogin.php"> just a username</a></p>
                                </div>
                            </form>
                            <?php } ?>
        
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Account Area -->

<?php require('footer1.php'); ?>
