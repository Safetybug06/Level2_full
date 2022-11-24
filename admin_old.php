<?php include('config.php'); ?>

<?php

$err = "";
if (count($_POST)) {
	$myusername=$_POST['username'];
	$mypassword=$_POST['password'];
	
	$t_hasher = new PasswordHash(8, FALSE);

	
	$myusername = stripslashes($myusername);
	$myusername = mysql_real_escape_string($myusername);
	$sql="SELECT * FROM `sign-up` WHERE Email='$myusername' "; //and confirmation_code = ''"; // md5 removed

	$result=mysql_query($sql) or die(mysql_error());

	$count=mysql_num_rows($result);
		while($details = mysql_fetch_assoc($result)){


        if($t_hasher->CheckPassword($mypassword, $details['password'])){
            $_SESSION["admin_type"] = "main"; 
        
            $_SESSION["admin_username"] = $myusername;
        
            $_SESSION["admin_fullname"] = $details['paypal-name'];		
        
            $_SESSION["order_number"] = $details['order_number'];		

            $_SESSION["account_type"] = $details['account_type'];
						
            $_SESSION["user_id"]=$details['ID'];
        
            $_SESSION["cc-email"]=$details['cc-email'];
			
		    $_SESSION["site_admin"]=(int)$details['site-admin'];
        
            $_SESSION["pagination"]=(int)$details['pagination'];
			
		    $_SESSION["gateway"]=(int)$details['gateway'];
            if (isset($_SESSION["gateway"]) && (int) $_SESSION["gateway"]) 		
			{
		    header("location: gateway.php");	
			}
            else
			{
            header("location: admin-serials.php");		
            }
            exit;
        
        }
}
	

	$sql1="SELECT * FROM `login` l LEFT JOIN `sign-up` s ON l.Order_Number = s.order_number WHERE l.Email='$myusername'  LIMIT 1";

	$result1=mysql_query($sql1) or die(mysql_error());

	$count=mysql_num_rows($result1);	

		$fetch_details = mysql_fetch_assoc($result1);			
    if(  $t_hasher->CheckPassword($mypassword, $fetch_details['Password'])){

		$_SESSION["admin_username"] = $myusername;

		$_SESSION["admin_fullname"] = $fetch_details['Name'];		

		$_SESSION["order_number"] = $fetch_details['Order_Number'];		

		$_SESSION["user_id"]=$fetch_details['ID'];

		if ($fetch_details['Super_Admin']=="yes") {		

			$_SESSION["super_admin"] = 'yes';
			$_SESSION["admin_type"] = "super_admin";
			header("location: super-admin.php");

		} else {
			$_SESSION["admin_type"] = "Additional";
			$_SESSION["site_admin"] = (int)$fetch_details['site-admin'];
			$_SESSION["pagination"] = (int)$fetch_details['pagination'];
		
			unset($_SESSION["super_admin"]);

			header("location: admin-serials.php");
		}	

		

		exit;

	}

	

	$err = "Wrong username or password.";

}
?>
<?php include('header.php'); ?>




<section class="header header-style2 strapline" style="background:url(images/img_04.jpg) 50% 50%;  background:linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.4)), url(images/img_04.jpg) 50% 50% ; background-size:cover;">
    <div class="header-content">
	    <h1>
	ADMINISTRATION</h1><p class="adminStrapline">
    Scroll down to login</p>
    </div>
</section>



<script type="text/javascript">	

    var numErrors = 0;

	$(document).ready(function() {
	// validate order form
	$("#login_form").validate({
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
			username: {
				required	: true,
			},
			password: "required",
		},
		messages: {			
			username: "",
			password: "",			
		}
	});	
	});

	</script>
    
    
    
<div class="circle-wrapper">
<div class="circle-container">

<div class="numberCircle-container">
<div class="numberCircle grey-circle">1</div>
<p class="numberCircleType grey-type">
Purchasing
</p>
</div>

<div class="numberCircle-container">
<div class="numberCircle grey-circle">2</div>
<p class="numberCircleType grey-type">
Activating
</p>
</div>


<div class="numberCircle-container">
<div class="numberCircle grey-circle">3</div>
<p class="numberCircleType grey-type">
Starting
</p>
</div>

</div>
</div>




	<div id="content">



 	<h3 class="green">Administration</h3>
<p>The programme is supplied with a free data base. This can be used by the administrator to see how and when learners are progressing through the e-learning modules and assessments.</p>
<p>You can also access learners log in details and copies of certificates, so they will never be lost.</p>
<p>Access to the data base is supplied to the purchaser of the programme. The purchaser can assign further administrators if required.</p>
<p>If you are an employer and you have purchased several serial numbers you will automatically receive these serial numbers along with a web link to access the administrator data base directly via the administration link. From here you can easily allocate activation codes to learners.</p>
<ul class="user-admin">
<li>Enter your user name and password in the boxes provided to get started.</li>
</ul>


<?php
	if ($err != "") echo '<p style="font-weight:bold; color:#ff0000; ">'.$err.'</p>';
?>


<p id="required-note" style="display:none"><strong>Please enter username/password.</strong></p>
<form id="login_form" action="" method="post">
<table class="login-res">
<tr>
<td>
<p>Username</p>
<input id="username" name="username" type="text"   /></td>
</tr>

<tr>
<td>
<p>Password</p>
<input id="password" name="password" type="password"    /></td>
</tr>

<tr>
<td>	
<div>
<a href="forgot-admin_login.php" class="green-type">Forgot Password?</a>
</div>
<input id="logIn" name="" type="submit" value="Login" class="log-button right"  />


</td>
</tr>

</table>
</form>



    
			</div><!-- content -->
		</div><!-- wrapper -->

		

		

<?php include('footer.php') ?>