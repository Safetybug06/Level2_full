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
<?php include('header1.php'); ?>
<link rel="stylesheet" href=
"https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />

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
        <!-- Start Account Area -->
        <div class="account-area">
            <div class="d-table">
                <div class="d-table-cell">
                    <div class="container">
                        <div class="account-content">
                            <div class="account-header">
                                <a href="index.html">
                                    <img src="assets/images/SBT-logo-01.png" width="160" height="40" alt="main-logo">
                                </a>
                                <h3>Course Login</h3>
                            </div>
                            <div id="successMessage" class="alert alert-secondary alert-dismissible fade show" role="alert">
                                <strong>First time here?</strong> After logging in below, click on the 'activate assessment' link which will take you to your first module.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Already a user?</strong>The programme will automatically begin where you last logged out. Continue to work through the modules by clicking on the 'activate assessment' link once you have logged in below.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>


                            <?php

if ($err != "") echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
<strong>'.$err.'
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';

      ?>
                            <form id="login_form" action="" method="post" class="account-wrap">
                                <div class="form-group mb-24 icon">
                                    <input id="username" name="username" type="text"  class="form-control" placeholder="Username">
                                    <img src="assets/images/icon/sms.svg" alt="sms">
                                </div>
                                <div class="form-group mb-24 icon">
                                    <input id="password" name="password" type="password"  class="form-control" placeholder="Password">
                                    <img src="assets/images/icon/key.svg" alt="key">
									<i style="align-items: right;" class="bi bi-eye-slash" 
                                    id="togglePassword"></i>
                                </div>
                                <div class="form-group mb-24">
                                    <a href="forgot-login.php" class="forgot">Forgot Password?</a>
                                </div>
                                <div class="form-group mb-24">
                                    <button id="logIn" name="" type="submit" value="Log-in"  class="default-btn">Log In</button>
                                </div>
                                <div class="form-group mb-24 text-center">
                                    <p class="account">Not A Member? <a href="paypal.php">Create An Account</a></p>
                                </div>
                            </form>

                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<script>
            const togglePassword = document
                .querySelector('#togglePassword');
      
            const password = document.querySelector('#password');
      
            togglePassword.addEventListener('click', () => {
      
                // Toggle the type attribute using
                // getAttribure() method
                const type = password
                    .getAttribute('type') === 'password' ?
                    'text' : 'password';
                      
                password.setAttribute('type', type);
      
                // Toggle the eye and bi-eye icon
                this.classList.toggle('bi-eye');
            });
        </script>
		<script>
           

		//    This Script For Hidding Div After defined time interval 

// $(function() {
//     setTimeout(function() {
//   $('#successMessage').fadeOut('slow');
// }, 10000);
// });
//         </script>
        <!-- End Account Area -->
<?php include('footer1.php'); ?>