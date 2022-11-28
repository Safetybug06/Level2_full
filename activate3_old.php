<?php include('config.php'); ?>



<?php



if (!isset($_SESSION["activate_email"]) || !strlen($_SESSION["activate_email"])) {



	header('location: activate.php');



	exit;



}



?>



<?php include('header.php'); ?>

<section class="header header-style2 strapline" style="background:url(images/img_04.jpg) 50% 50%;  background:linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.4)), url(images/img_04.jpg) 50% 50% ; background-size:cover;">

    <div class="header-content">

	    <h1>

	ACTIVATE</h1><p class="adminStrapline">

    Scroll down to activate</p>

    </div>

</section>





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





 	<h3 class="green">Activate</h3>



<p>An E-mail has been sent to <strong><?php echo $_SESSION["activate_email"] ?></strong>. This contains your unique password and completes activation.</p>

<p style="font-weight:bold">NB: If E-mail does not arrive please check spam/junk folder.</p>







			</div><!-- content -->

		</div><!-- wrapper -->



<?php include('footer.php') ?>



<?php unset($_SESSION["activate_email"]); ?>