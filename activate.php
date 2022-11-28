<?php include('config.php'); ?>
<?php

$err = "";

if (count($_POST)) {



	$myserial=$_POST['serial1'];

	$myserial.=$_POST['serial2'];

	$myserial.=$_POST['serial3'];

	$myserial.=$_POST['serial4'];

	$myserial = stripslashes($myserial);

	$myserial = mysql_real_escape_string($myserial);

	$sql="SELECT * FROM `user` WHERE serial='$myserial'AND activated='no'";

	$result=mysql_query($sql) or die(mysql_error());

	$count=mysql_num_rows($result);

    if($count==1 )

	{

		$details = mysql_fetch_assoc($result);

		$_SESSION["serial"] = $myserial;

		header("location: activate2.php");

		exit;

	}

	else

	{

		$err = "You have entered an invalid serial number or has been already activated.";

	}

}



if(isset($_GET['failed']))

	$err= "You have entered an invalid serial number or has been already activated.";

?>


<?php include('header1.php'); ?>
<script type="text/javascript">	

<!--

	var numErrors = 0;



	$(document).ready(function() {

		// validate order form

		$("#activate_form").validate({

			highlight: function(element, errorClass, validClass) {

				$(element).css("borderColor", "#ff0000");		

				$("#required-note").css("display", "block");

				element.blur();

			},

			unhighlight: function(element, errorClass, validClass) {

					$(element).css("borderColor", "");

					$("#required-note").css("display", "none");

			},

			messages: {

				serial1 : '',

				serial2 : '',

				serial3 : '',

				serial4 : ''

			}

		});	

	});

	function autotab(original,destination)

	{	

		if (original.getAttribute&&original.value.length==original.getAttribute("maxlength"))

		destination.focus()

	}

-->

</script>

            <!-- Process Section Start -->
            <div class="rs-process style1  pt-100 pb-100 md-pt-70 md-pb-70">
                <div class="container pb-54">
                    <div class="process-effects-layer">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 md-mb-30" style="opacity: 50%;" >
                                <div class="rs-addon-number">
                                    <div class="number-part">
                                        <a href="paypal.php">
                                        <div class="number-image">
                                            <img src="assets/images/process/style1/1.png" alt="Process">
                                        </div>
                                    </a>
                                        <div class="number-text">
                                            <div class="number-area"> <span class="number-prefix"> 1 </span></div>
                                            <div class="number-title">
                                                <h3 class="title"> Purchased</h3>
                                            </div>
                                            <div class="card-subtitle">
                                               Purchase Completed
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 md-mb-30">
                                <div class="rs-addon-number">
                                    <div class="number-part">
                                        <a href="activate.html">
                                        <div class="number-image-active">
                                            <img src="assets/images/process/style1/2.png" alt="Process">
                                        </div>
                                    </a>
                                        <div class="number-text">
                                            <div class="number-area"> <span class="number-prefix"> 2 </span></div>
                                            <div class="number-title">
                                                <h3 class="title">Activation
    
                                                </h3>
                                            </div>
                                            <div class="card-subtitle">
                                                Enter You Activation Code In Below Boxes
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6" style="opacity: 50%;">
                                <div class="rs-addon-number">
                                    <div class="number-part">
                                        <a href="user-admin.php">
                                        <div class="number-image">
                                            <img src="assets/images/process/style1/4.png" alt="Process">
                                        </div>
                                    </a>
                                        <div class="number-text">
                                            <div class="number-area"> <span class="number-prefix"> 3 </span></div>
                                            <div class="number-title">
                                                <h3 class="title">Start Course</h3>
                                            </div>
                                            <div class="card-subtitle">
                                               Once You activate Course You Will Received Id Pass In Your E-mail
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                  </div>
                  <!-- Process Section End -->

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
                                <h3>Activate your Account</h3>
                            </div>
                            <div class="alert alert-success" role="alert">
                                <h4 class="alert-heading">Enter the 16 digit serial number</h4>
                                <p>In the boxes provided, then click on the submit button. You will now automatically be taken to the final sign up page 'user details' to select your language.</p>
                               
<?php



if ($err != "") echo '<p style="color:red;font-weight:bold">'.$err.'</p>';



?>

<p id="required-note" style="display:none; color:red; font-weight:bold">Please enter serial</p>

                            </div>
                            
                           
                            <form  id="activate_form" name="activate_form" action="" method="post" class="account-wrap">
                                <div class="row g-1 mb-24">
                                    
                                    <div class="col-sm">
                                        <input name="serial1" type="text" maxlength="4" placeholder="1234"  class="form-control required" onkeyup="autotab(this, document.activate_form.serial2)" />
                                    </div>
                                    <div class="col-sm">
                                        <input name="serial2" type="text" maxlength="4" placeholder="1234"  class="form-control required" onkeyup="autotab(this, document.activate_form.serial3)"   />
                                    </div>
                                    <div class="col-sm">
                                        <input name="serial3" type="text" maxlength="4" class="form-control required" placeholder="1234" onkeyup="autotab(this, document.activate_form.serial4)" />
                                    </div>
                                    <div class="col-sm">
                                        <input name="serial4" type="text" maxlength="4" class="form-control required" placeholder="1234"  />
                                    </div>
                                </div>
                                <div class="progress mb-3">
                                    <div class="progress-bar progress-bar-striped bg-success" role="progressbar" aria-label="Success striped example" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="form-group mb-24">
                                    <button name="" id="submit_btn" type="submit" value="Submit" class="default-btn">Submit</button>
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
        <!-- End Account Area -->

<!-- 
     
        <script>
            function autotab(current,to){
                if (current.getAttribute && 
                  current.value.length==current.getAttribute("maxlength")) {
                    to.focus() 
                    }
            }
            </script> -->
<?php include('footer2.php'); ?>