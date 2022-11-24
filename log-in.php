<?php include('config.php'); ?>
<?php
$err = "";
if (count($_POST)) {
	$myusername=$_POST['username'];
	$mypassword=$_POST['password'];
	
	$t_hasher = new PasswordHash(8, FALSE);

	$myusername = stripslashes($myusername);
	$myusername = mysql_real_escape_string($myusername);
	$sql="SELECT * FROM `user` WHERE username='$myusername' "; //and confirmation_code = ''"; // md5 removed
	$result=mysql_query($sql) or die(mysql_error());
	$count=mysql_num_rows($result);

	$details = mysql_fetch_assoc($result);
	
    if(  $t_hasher->CheckPassword($mypassword, $details['password'])){

		$_SESSION["username"] = $myusername;
		$_SESSION["fullname"] = $details['name'];
		$_SESSION["order_number"] = $details['order-number'];
		header("location:user-admin.php");
	}
	else {
		$err = "<strong>Wrong Username or Password.</strong>";
	}
}
?>
<?php include('header.php'); ?>

<section class="header header-style2 strapline" style="background:url(images/img_04.jpg) 50% 50%;  background:linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.4)), url(images/img_04.jpg) 50% 50% ; background-size:cover;">
    <div class="header-content">
	    <h1>
	LOG IN</h1><p class="adminStrapline">
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
<div class="numberCircle green-circle">3</div>
<p class="numberCircleType green-type">
Starting
</p>
</div>

</div>
</div>





	<div id="content">

 	<h3 class="green">Log-In</h3>
<?php
    
/*
	$t_hasher = new PasswordHash(8, FALSE);
    $hash = $t_hasher->HashPassword('SB-pcavd-99542');
    echo 	$hash;
*/

?>

	 	<p>Enter you password and username in the boxes provided.</p>
		<p>First time here? After logging in below, click on the 'activate assessment' link which will take you to your first module.</p>
		<p>Already a user? The programme will automatically begin where you last logged out. Continue to work through the modules by clicking on the 'activate assessment' link once you have logged in below..</p>


<?php
	if ($err != "") echo '<p class="error">'.$err.'</p>';
?>
<p id="required-note" style="display:none"><strong>Please enter username/password.</strong></p>
<form id="login_form" action="" method="post">
<table class="login-res">
<tr>
<td><p>Username</p>
<input id="username" name="username" type="text"   />
</td>
</tr>

<tr>

<td><p>Password</p>
<input id="password" name="password" type="password"   />
</td>
</tr>

<tr>
<td>
<div>
<a href="forgot-login.php" class="green-type">Forgot Password?</a>
</div>
<input id="logIn" name="" type="submit" value="Log-in"  class="log-button right" />
</td>
</tr>

</table>
</form>
<?php include 'detect_mobile.php'; ?>

    	<?php if (is_mobile()) { ?>

 <div style="width:96%; float:right; padding:2%"> 
 <p style="font-size:.8em; margin:0; padding:0">
<strong>Mobile Requirements:</strong><br/>
Android 3.x or higher, iPad (iOS 5.x or higher), Windows Phone 7.5 or higher, Windows RT.
 </p>
</div>

		<?php } else { ?>

<!-- dont show mobile requirements. -->

		<?php } ?>  




		</div><!-- content -->
		</div><!-- wrapper -->

<?php include('footer.php') ?>