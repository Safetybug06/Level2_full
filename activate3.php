<?php include('config.php'); ?>

<?php



if (!isset($_SESSION["activate_email"]) || !strlen($_SESSION["activate_email"])) {



	header('location: activate.php');



	exit;



}



?>
<?php include('header1.php'); ?>
<!-- Start Invoice Area -->
                <div class="invoice-area">
                    <div class="container-fluid">
                        <div class="card-box-style  ">
                            <div class="others-title">
                                <h1 style="text-align:center;">Activation Complete</h1>
            
                            </div>
                                <div class="">
                                     <p class="mt-2 mb-0 " style="text-align:center;"><br> An E-mail has been sent to <strong style="color: green;"> <?php echo $_SESSION["activate_email"] ?></strong> This contains your unique password and completes activation.</p>
                                    <p class="mt-2 mb-0" style="text-align:center;">   NB: If E-mail does not arrive please check spam/junk folder.</p>
                              
            
                                
                            </div>

            
                            
                        </div>
                    </div>
                </div>
                <!-- End Invoice Area -->
<?php include('footer1.php'); ?>