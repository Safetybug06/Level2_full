<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

<title>Safety Bug Training</title>


<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

<!-- nav -->
<link rel='stylesheet' id='creativecode-style-css'  href='css/style.css?ver=4.5.3' type='text/css' media='all' />
<link rel='stylesheet' id='creativecode-custom-css-css'  href='css/style2.css?ver=4.5.3' type='text/css' media='all' /> 

<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A400%2C600%7CPermanent+Marker%3A400%7CUbuntu%3A400&#038;" rel="stylesheet">

<script src='js/script.min.js?ver=4.5.3'></script>

<!-- defaults -->
<link type="text/css" rel="stylesheet" href="css/main.css"/>
<script src="js/jquery-1.7.1.min.js"></script>
<script src="js/jquery.validation.min.js"></script>

<?php
$includeGoogle=array('paypal.php', 'admin.php', 'log-in.php');
$currentPage =basename( $_SERVER['PHP_SELF']);

if (in_array($currentPage, $includeGoogle))
    {
 include('process/googleAnalytics.php'); 
	}

?>
</head>
<body class="page-template-template-white-menu-bar">


<nav id="header" class="navbar navbar-custom navbar-fixed-top" role="navigation">
    <div class="container-full">
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" id="mobile-button" data-target=".navbar-main-collapse">
                <span class="icon-bar top-bar"></span>
                <span class="icon-bar middle-bar"></span>
                <span class="icon-bar bottom-bar"></span>
            </button>
            <a class="navbar-brand" href="http://safetybugtraining.com">
                   <img id="logo" src="images/SBT-logo.svg" width="216px" alt="SBT Logo">                  
                    <img id="logo-retina" src="images/SBT-logo.svg" width="216px" alt="SBT Logo">           
                            <img id="logo-white" src="images/SBT-logo.svg" width="216px" alt="SBT Logo">  
                                      </a>

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

</div>
        <div class="collapse navbar-collapse navbar-right navbar-main-collapse" id="desktop-menu">
            <div class="menu-top-menu-container" >
            <ul id="primary-menu" class="nav navbar-nav" >
 
<?php if(isset($_SESSION["admin_username"])){ ?>
<li id="menu-item-140" style="line-height:20px">
<?php echo strtoupper  ($_SESSION["admin_fullname"]);?></li>
<?php }  

elseif (isset($_SESSION["username"])){ ?>
<li id="menu-item-140"  style="line-height:20px">
<?php echo strtoupper ($_SESSION["fullname"]);?></li>
<li id="menu-item-140"  style="line-height:20px;"><img src="images/flag/<?php if(isset($row['language'])){ echo $row['language']; }?>.png" alt="Safety Bug Training"  width="25" height="5" /></li>
<li id="menu-item-140"  style="line-height:20px"><?php if(isset($row['language'])){ echo strtoupper  ($row['language']); } ?> VERSION</li>

<?php }  
else { ?>
	<li id="menu-item-140" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-140"><a href="http://safetybugtraining.com/">Home</a></li>
<?php }  ?>



<?php if(isset($_SESSION["admin_username"])){ ?>
	<li id="menu-item-140" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-140">
 <?php   
$superAdminModules=array('super-admin-modules.php');
$allowed=array('super-admin-serials.php' , 'super-admin-contact.php');
$allowed2=array('activate2.php', 'paypal.php', 'paypal2.php', 'admin-modules.php');
$currentPage =basename($_SERVER['PHP_SELF']);

if (in_array($currentPage, $allowed))
    {
	echo "<a  href=\"super-admin.php\">BACK</a>"; 
	}
	
elseif (in_array($currentPage, $superAdminModules))
    {
	echo "<a  href=\"super-admin-serials.php?order_number=".$_SESSION["order_number"]."\">BACK</a>"; 
	}	
	

elseif (in_array($currentPage, $allowed2))
	{
        if(isset($_SESSION['super_admin']) && $_SESSION['admin_type'] == 'super_admin'){
                if($_SESSION['super_admin'] == 'yes'){
                  echo "<a  href='super-admin-serials.php?order_number=".$_SESSION["order_number"]."'>BACK</a>"; 
                }
            }
			else
			{  
			if (isset($_SESSION["paginationBack"]) && strlen($_SESSION["paginationBack"]) > 0 ) 
			{
                    echo "<a  href=\"admin-serials.php?". $_SESSION["paginationBack"] ."\">BACK</a>"; 
			} 
			else 
			{   
			echo "<a  href=\"admin-serials.php\">BACK</a>"; 
            }
			}
	}
else 
{
	echo "<a  href=\"admin-logout.php\">LOG OUT</a>" ;
	}
	?>
    </li>


<?php }  
elseif (isset($_SESSION["username"])){ ?>
	<li id="menu-item-140" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-140"><a href="logout.php">LOG OUT</a></li>
<?php }  
else { 
?>
<li id="menu-item-209" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-209"><a href="http://safetybugtraining.com/about/">About</a></li>




<li id="menu-item-214" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-214"><a href="#">Level 2 Courses</a>
<ul class="sub-menu">
	<li id="menu-item-215" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-215"><a href="https://safetybugtraining.com/covid-19/">Covid-19</a></li>
	<li id="menu-item-215" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-215"><a href="https://safetybugtraining.com/food-safety-and-hygiene-level-2/">Food Safety and Hygiene Level 2</a></li>
		<li id="menu-item-215" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-215"><a href="https://safetybugtraining.com/allergen-awareness/">Allergen Awareness</a></li>
		<li id="menu-item-215" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-215"><a href="https://safetybugtraining.com/haccp/">HACCP</a></li>
				<li id="menu-item-215" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-215"><a href="https://safetybugtraining.com/health-and-safety/">Health and Safety</a></li>
				<li id="menu-item-215" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-215"><a href="https://safetybugtraining.com/manual-handling/">Manual Handling</a></li>
</ul>
</li>
<li id="menu-item-216" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-216"><a href="paypal.php">Sign Up</a></li>
<li id="menu-item-217" class="menu-item menu-item-type-post_type menu-item-object-page current-page-ancestor current-menu-ancestor current-menu-parent current-page-parent current_page_parent current_page_ancestor menu-item-has-children menu-item-217"><a href="#">Your Course</a>
<ul class="sub-menu">
	<li id="menu-item-218" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-191 current_page_item menu-item-218"><a href="activate.php">Activate your course</a></li>
	<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-219"><a href="admin.php">Administration</a></li>
	<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-220"><a href="log-in.php">Log In</a></li>
</ul>
</li>


<li id="menu-item-222" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-222"><a href="http://safetybugtraining.com/contact-us/">Contact Us</a></li>
<?php }  ?>
</ul></div>        </div>




        <div class="" id="mobile-menu">
            <div class="mobile-top"></div>
            <div class="mobile-bottom"></div>
            <div class="mobile-content">
                <div class="mobile-menu-logo">
                    <a href="http://safetybugtraining.com">
                        <img src="images/SBT-logo.svg"  alt="SBT Logo">
                    </a>
                </div>
                <div class="menu-top-menu-container">
                
<ul id="mobile-menu-items" class="nav navbar-nav"  style="color:#fff">
 
<?php if(isset($_SESSION["admin_username"])){ ?>
<li id="menu-item-140" class="  " style="line-height:20px">
<?php echo strtoupper  ($_SESSION["admin_fullname"]);?></li>
<?php }  

elseif (isset($_SESSION["username"])){ ?>
<li id="menu-item-140" class="  " style="line-height:20px">
<?php echo strtoupper ($_SESSION["fullname"]);?></li>
<li id="menu-item-140" class="  " style="line-height:20px;"><img src="images/flag/<?php if(isset($row['language'])){ echo $row['language']; }?>.png" alt="Safety Bug Training"  width="25" height="5" /></li>
<li id="menu-item-140" class="  " style="line-height:20px"><?php if(isset($row['language'])){  echo strtoupper  ($row['language']); }?> VERSION</li>

<?php }  
else { ?>
	<li id="menu-item-140" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-140"><a href="http://safetybugtraining.com/">Home</a></li>
<?php }  ?>



<?php if(isset($_SESSION["admin_username"])){ ?>
	<li id="menu-item-140" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-140">
 <?php 
 

$currentPage =basename( $_SERVER['PHP_SELF']);

if (in_array($currentPage, $allowed))
    {
	echo "<a  href=\"super-admin.php\">BACK</a>"; 
	}
	
elseif (in_array($currentPage, $superAdminModules))
    {
	echo "<a  href=\"super-admin-serials.php?order_number=".$_SESSION["order_number"]."\">BACK</a>"; 
	}
	
	
elseif (in_array($currentPage, $allowed2))
	{
        if(isset($_SESSION['super_admin']) && $_SESSION['admin_type'] == 'super_admin'){
                if($_SESSION['super_admin'] == 'yes'){
                   
                    echo "<a  href='super-admin-serials.php?order_number=".$_SESSION["order_number"]."'>BACK</a>"; 
                }
            }else
			{  
			if (isset($_SESSION["paginationBack"]))
			{
			if (strlen($_SESSION["paginationBack"]) > 0 ) {
                    echo "<a  href=\"admin-serials.php?". $_SESSION["paginationBack"] ."\">BACK</a>"; 
			} 
			else 
			{    echo "<a  href=\"admin-serials.php\">BACK</a>"; }
			
            }
			}

	}
else {
	echo "<a  href=\"admin-logout.php\">LOG OUT</a>" ;
	}
	?>
    </li>


    
<?php }  
elseif (isset($_SESSION["username"])){ ?>
	<li id="menu-item-140" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-140"><a href="logout.php">LOG OUT</a></li>
<?php }  
else { 
?>
<li id="menu-item-209" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-209"><a href="http://safetybugtraining.com/about/">About</a></li>



<li id="menu-item-214" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-214"><a href="#">Level 2 Courses</a>
<ul class="sub-menu">
	<li id="menu-item-215" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-215"><a href="https://safetybugtraining.com/covid-19/">Covid-19</a></li>
	<li id="menu-item-215" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-215"><a href="https://safetybugtraining.com/food-safety-and-hygiene-level-2/">Food Safety and Hygiene Level 2</a></li>
		<li id="menu-item-215" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-215"><a href="https://safetybugtraining.com/allergen-awareness/">Allergen Awareness</a></li>
		<li id="menu-item-215" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-215"><a href="https://safetybugtraining.com/haccp/">HACCP</a></li>
				<li id="menu-item-215" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-215"><a href="https://safetybugtraining.com/health-and-safety/">Health and Safety</a></li>
					<li id="menu-item-215" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-215"><a href="https://safetybugtraining.com/manual-handling/">Manual Handling</a></li>
		
</ul>
</li>
<li id="menu-item-216" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-216"><a href="paypal.php">Sign Up</a></li>
<li id="menu-item-217" class="menu-item menu-item-type-post_type menu-item-object-page current-page-ancestor current-menu-ancestor current-menu-parent current-page-parent current_page_parent current_page_ancestor menu-item-has-children menu-item-217"><a href="#">Your Course</a>
<ul class="sub-menu">
	<li id="menu-item-218" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-191 current_page_item menu-item-218"><a href="activate.php">Activate your course</a></li>
	<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-219"><a href="admin.php">Administration</a></li>
	<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-220"><a href="log-in.php">Log In</a></li>
	
</ul>
</li>

<li id="menu-item-222" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-222"><a href="http://safetybugtraining.com/contact-us/">Contact Us</a></li>
<?php }  ?>
</ul>
</div>           
 </div>
        </div>
    </div>
    <!-- /.container -->
</nav>






<!-- 
HEADER .PHP<br/>
<a href="v">Activate Your Course</a><br/>
<a href="log-in.php">Log-In</a><br/>
<a href="admin.php">Administration</a><br/>
<a href="paypal.php">Sign-up</a>needed for paypal.php admin additional serials -->

<div id="wrapper">

         

