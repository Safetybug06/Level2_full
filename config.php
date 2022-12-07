<?php

    session_start();

    require 'classes/PasswordHash.php';


ini_set('display_errors',false);

/****** DATABASE SETTINGS *************************************/


$host="localhost"; 
$username="root"; 
$password=""; 
$db_name="givefehu_safetybug"; 


mysql_connect($host, $username, $password) or die('could not connect');

mysql_select_db($db_name) or die('failed selection');





/****** MODULE SETTINGS *****************************************/
$site_url="http://localhost/level2_full/";
// $site_url="/";



// Languages, you can add as many languages, just create a

// Folder with the same name under flash/ and modules/ for ex. flash/English and modules/English

// also add a flag icon under images/flag/<language>.png ex images/flag/English.png



$language_fsl2=array(
"Albanian",
"Arabic",
"Bengali",
"Bulgarian",
"Chinese",
"Croatian",
"Czech",
"English",
"Farsi",
"French",
"German",
"Greek",
"Gujarati",
"Hindi",
"Hungary",
"Indonesian",
"Italian",
"Kurdish",
"Latvian",
"Lithuanian",
"Polish",
"Portuguese",
"Punjabi",
"Romanian",
"Russian",
"Slovak",
"Spanish",
"Thai",
"Turkish",
"Ukrainian",
"Urdu",
"Vietnamese",
"Welsh"
);

$splitModules=array(
"Albanian",
"Arabic",
"Bengali",
"Bulgarian",
"Chinese",
"Croatian",
"Czech",
"English",
"Farsi",
"French",
"German",
"Greek",
"Gujarati",
"Hindi",
"Hungary",
"Indonesian",
"Italian",
"Kurdish",
"Latvian",
"Lithuanian",
"Polish",
"Portuguese",
"Punjabi",
"Romanian",
"Russian",
"Slovak",
"Spanish",
"Thai",
"Turkish",
"Ukrainian",
"Urdu",
"Vietnamese",
"Welsh"
);

$language_allergen=array(
"Bulgarian",
"Chinese",
"Croatian",
"Czech",
"English",
"Italian",
"Latvian",
"Lithuanian",
"Polish",
"Portuguese",
"Romanian",
"Russian",
"Slovak",
"Spanish",
"Turkish",
"Ukrainian"
);

$language_haccp=array(
"Albanian",
"Bulgarian",
"Czech",
"English",
"Hungary",
"Italian",
"Latvian",
"Lithuanian",
"Polish",
"Portuguese",
"Romanian",
"Russian",
"Slovak",
"Spanish"
);

$language_healthSafety=array(
"Albanian",
"Bulgarian",
"Czech",
"English",
"Hungary",
"Italian",
"Latvian",
"Lithuanian",
"Polish",
"Portuguese",
"Romanian",
"Russian",
"Slovak",
"Spanish"
);

$language_manualhandling=array(
"Bulgarian",
"English",
"Czech",
"Lithuanian",
"Polish",
"Portuguese",
"Russian",
"Slovak",
"Urdu"
);

$language_corona=array(
"English",
"Polish",
"Portuguese",
"Russian",
"Urdu"
);

$language_coshh=array(
"Bulgarian",
"English",
"Lithuanian",
"Polish",
"Portuguese",
"Russian",
"Slovak"
);




// set the prices for the license counts

// you can add or remove any number of licenses

// make sure you keep the structure same

$prices=array(

	"1"=>20, 
	"50"=>19,
	"199"=>18,
	"10000000"=>16

);

//resit price
//$resit_price = '12.00';


$vat=20;







/****** PAYPAL SETTINGS *****************************************/

// $paypal_email = 'safetybugtraining06@gmail.com';
// $paypal_email = 'trevor.tweed@btinternet.com';
// $paypal_email = 'safetybugtraining06@gmail.com';

// $paypal_url = 'www.paypal.com';

$paypal_email = 'sb-lhps514668951@business.example.com';

$paypal_url = 'www.sandbox.PayPal.com';


/****** BARCLAY CARDS SETTINGS *****************************************/

$barclay_url = 'payments.epdq.co.uk/ncol/prod/orderstandard.asp';



$PSPID="epdq8853202";

$secretsig="sbt09w43kdnfc883d";


/********* CHECK IF DEMO MODE *****************************************/
if (isset($_SESSION['order_number']) && ($_SESSION['order_number'] == 'SBT-01-DEMO'))
	define('DEMO_MODE', true);
else
	define('DEMO_MODE', false);



 include('functions.php'); 
 require 'PHPMailer/PHPMailerAutoload.php';  

 include('order-payment.php'); 

define('COMPANY_NAME', 'Safety Bug Training');
define('AUTOMATED_EMAIL', 'no-reply@safetybugtraining.com');
define('SMTP_HOST', 'smtp.mailtrap.io');
define('SMTP_PASS', 'defb12a44d87aa');
define('SMTP_USER', '4eb93049a83b8e');
define('SMTP_PORT', 2525); 
/* SSL 465 as opposed to TLS 587 */

// define('COMPANY_NAME', 'Safety Bug Training');
// define('AUTOMATED_EMAIL', 'no-reply@safetybugtraining.com');
// define('SMTP_HOST', 'business37.web-hosting.com');
// define('SMTP_PASS', 'fLmwqoNlnRtE');
// define('SMTP_USER', 'no-reply@safetybugtraining.com');
// define('SMTP_PORT', 465); 
/* SSL 465 as opposed to TLS 587 */

/*
define('COMPANY_NAME', 'Safety Bug Training');
define('AUTOMATED_EMAIL', 'safebug.training@gmail.com');
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PASS', 'sy%TGDT_42');
define('SMTP_USER', 'safebug.training@gmail.com');
define('SMTP_PORT', 587);
*/
//enable less secure apps. https://myaccount.google.com/security
//visit https://accounts.google.com/b/0/DisplayUnlockCaptcha





?>