

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


<?php include('header1.php'); ?>



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
                                
                                <h3>Administration</h3>
                            </div>
                          
                            <div class="card-box-style">
                            <?php

                if ($err != "") echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>'.$err.'
               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';

                      ?>
                           
                                <!-- Button trigger modal -->
                                <button type="button" style="float: right;" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
                                    Know More?
                                </button>
 
                                <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Administration Info</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                                                    <strong> The programme is supplied with a free data base. This can be used by the administrator to see how and when learners are progressing through the e-learning modules and assessments.</strong>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                                    <strong>You can also access learners log in details and copies of certificates, so they will never be lost.</strong> 
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    <strong>Access to the data base is supplied to the purchaser of the programme. The purchaser can assign further administrators if required.</strong> 
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    <strong>If you are an employer and you have purchased several serial numbers you will automatically receive these serial numbers along with a web link to access the administrator data base directly via the administration link. From here you can easily allocate activation codes to learners.</strong> 
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                               
                                                
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Understood</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form id="login_form" class="account-wrap" action="" method="post">
                                <div class="form-group mb-24 icon">
                                    <input id="username" name="username" type="text" class="form-control" placeholder="Username">
                                    <img src="assets/images/icon/sms.svg" alt="sms">
                                </div>
                                <div class="form-group mb-24 icon">
                                    <input id="password" name="password" type="password" class="form-control" placeholder="Password">
                                    <img src="assets/images/icon/key.svg" alt="key">
                                </div>
                              
                                <div class="form-group mb-24">
                                    <a href="forget-password.html" class="forgot">Forgot Password?</a>
                                </div>
                                <div class="form-group mb-24">
                                    <button id="logIn" name="" type="submit" class="default-btn">Log In</button>
                                </div>
                                <div class="form-group mb-24 text-center">
                                    <p class="account">Not A Member? <a href="register.html">Create An Account</a></p>
                                </div>
                            </form>

                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Account Area -->


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




               
  <?php include('footer1.php'); ?>
