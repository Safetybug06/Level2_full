<?php include('../config.php'); ?>
<?php
if(!isset($_SESSION["admin_username"]) || !isset($_SESSION["admin_fullname"]) || !isset($_POST['reminder'])) {
	exit(false);
}

$sn__reminder = trim($_POST['reminder']);
$sn__uid = $_SESSION["user_id"];
mysql_query("UPDATE `sign-up` SET `reminder-cert1yr`='" . mysql_real_escape_string($sn__reminder) . "' WHERE ID='". $sn__uid ."'") or die(mysql_error());
if($sn__reminder == 1) 
  echo 'Resit notification On';
else echo 'Resit notification Off';