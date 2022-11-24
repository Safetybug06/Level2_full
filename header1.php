<!doctype html>
<html lang="zxx">
    
<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Link Of CSS --> 
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
		<link rel="stylesheet" href="assets/css/owl.carousel.min.css">
		<link rel="stylesheet" href="assets/css/animate.min.css">
		<link rel="stylesheet" href="assets/css/remixicon.css">
		<link rel="stylesheet" href="assets/css/boxicons.min.css">
		<link rel="stylesheet" href="assets/css/iconsax.css">
		<link rel="stylesheet" href="assets/css/metismenu.min.css">
		<link rel="stylesheet" href="assets/css/simplebar.min.css">
		<link rel="stylesheet" href="assets/css/calendar.css">
        <link rel="stylesheet" href="assets/css/sweetalert2.min.css">
		<link rel="stylesheet" href="assets/css/jbox.all.min.css">
		<link rel="stylesheet" href="assets/css/editor.css">
		<link rel="stylesheet" href="assets/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/loaders.css">
		<link rel="stylesheet" href="assets/css/header.css">
		<link rel="stylesheet" href="assets/css/sidebar-menu.css">
		<link rel="stylesheet" href="assets/css/footer.css">
		<link rel="stylesheet" href="assets/css/style.css">
		<link rel="stylesheet" href="assets/css/responsive.css">
    
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/form-validator.min.js"></script>
        <script src="assets/js/contact-form-script.js"></script>
      


		<!-- Favicon -->
		<link rel="icon" type="image/png" href="assets/images/favicon.svg">
		<!-- Title -->
		<title>Joxi - Bootstrap 5 Admin Dashboard Template</title>
        <?php
$includeGoogle=array('paypal.php', 'admin.php', 'log-in.php');
$currentPage =basename( $_SERVER['PHP_SELF']);

if (in_array($currentPage, $includeGoogle))
    {
 include('process/googleAnalytics.php'); 
	}

?>
    </head>

    <body class="body-bg-f8faff">
		<!-- Start Preloader Area -->
		<div class="preloader">
            <img src="assets/images/Safetybug-logo.png" width="160" height="40" alt="main-logo">
        </div>
		<!-- End Preloader Area -->


        <?php
$adminUrl=array('admin-serials.php');
$currentPage =basename($_SERVER['PHP_SELF']);


if (in_array($currentPage, $adminUrl))
{
	if (isset($_GET['orderNumberSelect'])) {  
$orderNumberRef = ($_GET['orderNumberSelect']);
$_SESSION["paginationBack"] =  'orderNumberSelect='. $orderNumberRef;
}
	if (isset($_GET['page'])) {  
$pageRef = ($_GET['page']);
$_SESSION["paginationBack"] =  'orderNumberSelect='. $orderNumberRef ."&page=". $pageRef;
}


	}


?>

		<!-- Start All Section Area -->
        <div class="all-section-area">
            <!-- Start Header Area -->
            <div class="header-area">
                <div class="container-fluid">
                    <div class="header-content-wrapper">
                        
                            <nav class="navbar navbar-expand-lg bg-light navbar-custom-style">
                                <div class="container-fluid">
                                    <a class="navbar-brand" href="#">
                                        <img src="assets/images/Safetybug-logo.png" width="160" height="40" alt="main-logo">
                                    </a>
                                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                        <span class="navbar-toggler-icon"></span>
                                    </button>

                                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                                            <li class="nav-item">
                                                <a class="nav-link active" aria-current="page" href="http://safetybugtraining.com/">Home</a>
                                            </li>
                                          

                                            <li class="nav-item">
                                                <a class="nav-link" href="http://safetybugtraining.com/about/">About Us</a>
                                            </li>

                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Level 2 Courses
                                                </a>

                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="https://safetybugtraining.com/coshh/">Coshh</a></li>
                                                    <li><a class="dropdown-item" href="https://safetybugtraining.com/food-safety-and-hygiene-level-2/">Food Safety and Hygiene Level 2</a></li>
                                                    <li><a class="dropdown-item" href="https://safetybugtraining.com/allergen-awareness/">Allergen Awareness</a></li>
                                                    <li><a class="dropdown-item" href="https://safetybugtraining.com/haccp/">HACCP</a></li>
                                                    <li><a class="dropdown-item" href="https://safetybugtraining.com/health-and-safety/">Health and Safety</a></li>
                                                    <li><a class="dropdown-item" href="https://safetybugtraining.com/manual-handling/">Manual Handling</a></li>
                                                </ul>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link " aria-current="page" href="<?php $site_url ?>paypal.php">SIGN UP</a>
                                            </li>
                                        <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    YOUR COURSE
                                                </a>

                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="<?php $site_url ?>activate.php">Activate your course</a></li>
                                                    <li><a class="dropdown-item" href="<?php $site_url ?>admin.php">Administration</a></li>
                   
                                                    <li><a class="dropdown-item" href="login.html">Log In</a></li>
                                                </ul>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="http://safetybugtraining.com/contact-us/">Contact Us</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                   
                    </div>
                </div>
            </div>
            <!-- End Header Area -->

        

            <!-- Start Main Content Area -->
            <main class="main-content-wrap2">
