<?php include('config.php'); ?>

<?php 

$err = "";

$sent_to = false;

if(count($_POST)) {

	$email=mysql_real_escape_string($_POST['email']) ;

	$sql="select ID, `paypal-name`,email from `sign-up` where `email`='$email'";



	$result=mysql_query($sql);



	$count=mysql_num_rows($result);

        if($count==1){

            $user_type = 'sign-up';

        }

	



	if (!$count) {



		$sql="select ID, Name as `paypal-name`, Email as email, Password as password from `login` where `Email`='$email'";

        

		$result=mysql_query($sql);



		$count=mysql_num_rows($result);

        if($count==1){

            $user_type = 'login';

        }

	}

	if($count==1){

		$details=mysql_fetch_array($result);

		$name=ucfirst($details['paypal-name']);

        $token = bin2hex(openssl_random_pseudo_bytes(16));

		

		$sql="INSERT INTO password_resets (user_id, user_type, token, created_at) VALUES (

		    '".$details['ID']."',

		    '$user_type',

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

		

		<strong>safetybugtraining.com</strong>

		

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

		

		//$headers  = "From: do-not-reply@safetybugsecure.co.uk \n";

		//$headers .= "Content-type: text/html\n";

		

		//mail($email, $subject, $message, $headers);			

        send_email($email, AUTOMATED_EMAIL, SMTP_HOST, SMTP_PORT, SMTP_USER, SMTP_PASS, COMPANY_NAME, $subject, $message);

		//echo $message;		

		$sent_to = $email;

	} else {

		$err= "Invalid Email-id Entered";

	}	

}

?>

<?php include('header.php') ?>







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





<section class="header header-style2" style="background:linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.4)), url(images/img_04.jpg) 50% 50% ; background-size:cover;">

    <div class="header-content">

	    <h1>

Forgotten LOG IN</h1>

    </div>

</section>





<div id="content">







 	<h3 class="green">Forgotten Log-In</h3>

		<?php if($err){

    		echo '<p style="color:red;">'.$err.'</p>';

		}



        if ($sent_to) { ?>

		<p>A password reset link has been sent to <strong><?php echo $sent_to ?></strong></p>

        <!--<p class="forgotten-password">(Please check 'spam' folder if email does not arrive).</p>-->

                

                

		<?php } else { ?>

		<p>Please enter E-mail used for Signup</p>

		<?php if (strlen($err)) { echo '<p class="error">'.$err.'</p>'; } ?>

	<form id="email_form" action="" method="post">

	<table <table class="login-res">

				<tr>

<td><p>E-Mail:</p>

<input id="email" name="email" type="text" class="text-field"  /></td>

				</tr>

				<tr>

			<td><br/>

            <input name="" type="submit" value="Submit"  class="log-button right" />		</td>

				</tr>

			</table>

		</form>

		<?php } ?>







		</div><!-- content -->

		</div><!-- wrapper -->

        

        

<?php include('footer.php') ?>