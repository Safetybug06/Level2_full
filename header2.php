<!doctype html>
<html lang="zxx">

<head>
    <!-- header 2 contain part till header div  -->
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
		<!-- <link rel="stylesheet" href="assets/css/calendar.css"> -->
        <link rel="stylesheet" href="assets/css/sweetalert2.min.css">
		<!-- <link rel="stylesheet" href="assets/css/jbox.all.min.css"> -->
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
        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
		<!-- Favicon -->
		<link rel="icon" type="image/png" href="assets/images/favicon.svg">
        
		<!-- Title -->
		<title>Safetbug Training</title>
        <?php
$includeGoogle=array('paypal.php', 'admin.php', 'log-in.php');
$currentPage =basename( $_SERVER['PHP_SELF']);

if (in_array($currentPage, $includeGoogle))
    {
 include('process/googleAnalytics.php'); 
	}

?>
    </head>
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
    <body class="body-bg-f8faff">
		<!-- Start Preloader Area -->
		<div class="preloader">
            <img src="assets/images/Safetybug white.png" width="160" alt="main-logo">
        </div>
		<!-- End Preloader Area -->

			<!-- Start All Section Area -->
            <div class="all-section-area">
            <!-- Start Header Area -->
            <div class="header-area header-style-three">
                <div class="container-fluid">
                    <div class="header-content-wrapper">
                        <div class="header-content d-flex justify-content-between align-items-center">
                            <div class="header-left-content d-flex">
                                <div class="responsive-burger-menu d-block d-lg-none">
                                    <span class="top-bar"></span>
                                    <span class="middle-bar"></span>
                                    <span class="bottom-bar"></span>
                                </div>
        
                                <div class="main-logo">
                                    <a href="index.html">
                                        <img src="assets/images/Safetybug white.png" width="250" alt="main-logo">
                                    </a>
                                </div>
            
                              

                                <div class="option-item for-mobile-devices d-block d-lg-none">
                                    <i class="search-btn ri-search-line"></i>
                                    <i class="close-btn ri-close-line"></i>
                                    
                                    
                                </div>
                            </div>
                            
                            <div class="header-right-content d-flex align-items-center">
                                <div class="header-right-option">
                                    <a href="#" class="dropdown-item fullscreen-btn" id="fullscreen-button">
                                        <img src="assets/images/icon/maximize.svg" alt="maximize">
                                    </a>
                                </div>
        
                               
        
                                <div class="header-right-option dropdown profile-nav-item pt-0 pb-0">
                                    <a class="dropdown-item dropdown-toggle avatar d-flex align-items-center" href="#" id="navbarDropdown-4" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <!-- <img src="assets/images/avatar.png" alt="avatar"> -->
                                        <div class="d-none d-lg-block d-md-block">
                                        <?php if(isset($_SESSION["admin_username"])){ ?>
                                            <h3><?php echo strtoupper  ($_SESSION["admin_fullname"]);?></h3>
                                            <span> Admin</span>
                                            <?php }  ?>
                                        </div>
                                    </a>
        
                                    
                                </div>
        
                                
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Header Area -->