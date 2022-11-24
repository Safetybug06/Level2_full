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

<?php include('header.php') ?>





<section class="header header-style2 strapline" style="background:url(images/img_04.jpg) 50% 50%;  background:linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.4)), url(images/img_04.jpg) 50% 50% ; background-size:cover;">

    <div class="header-content">

	    <h1>

	ACTIVATE</h1><p class="adminStrapline">

    Scroll down to activate</p>

    </div>

</section>









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





    

<div class="circle-wrapper">

<div class="circle-container">



<div class="numberCircle-container">

<div class="numberCircle grey-circle">1</div>

<p class="numberCircleType grey-type">

Purchasing

</p>

</div>



<div class="numberCircle-container">

<div class="numberCircle green-circle">2</div>

<p class="numberCircleType green-type">

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



 	<h3 class="green">Activate</h3>



<p>Enter the 16 digit serial number in the boxes provided, then click on the submit button. You will now automatically be taken to the final sign up page 'user details' to select your language.</p>



<?php



	if ($err != "") echo '<p style="font-weight:bold">'.$err.'</p>';



?>



<p id="required-note" style="display:none; font-weight:bold">Please enter serial</p>



<form id="activate_form" name="activate_form" action="" method="post">



<table class="activate-res">

<tr>



<td class="form-right-td">

<input name="serial1" type="text" maxlength="4"  class="activate-field required" onkeyup="autotab(this, document.activate_form.serial2)" />

<input name="serial2" type="text" maxlength="4"  class="activate-field required" onkeyup="autotab(this, document.activate_form.serial3)"   />

<input name="serial3" type="text" maxlength="4"  class="activate-field required" onkeyup="autotab(this, document.activate_form.serial4)" />

<input name="serial4"  type="text" maxlength="4" class="activate-field required" class="required" />

</td>

</tr>



<tr>



<td class="form-right-td"><br/><input name="" id="submit_btn" type="submit" value="Submit" class="log-button right"  /></td>

</tr>



</table>



</form>







			</div><!-- content -->

		</div><!-- wrapper -->



		

<?php include('footer.php') ?>