<?php include('../config.php'); ?>
<?php
if(!isset($_SESSION["admin_username"]) || !isset($_SESSION["admin_fullname"])) {
	exit;
}

$cc_email = trim($_POST['cc_email']);

if (empty($cc_email))
	$cc_email = $_SESSION['admin_username'];
	
mysql_query("UPDATE `sign-up` SET `cc-email`='".mysql_real_escape_string($cc_email)."' WHERE order_number='".$_SESSION['order_number']."' LIMIT 1");

$_SESSION["cc-email"]  = $cc_email;

echo $cc_email;