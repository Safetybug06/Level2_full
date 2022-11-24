<?php

	session_start();
	
	header("Content-Type: application/json");
	
	$sesion_id = session_id();
	$_SESSION['account_type'] = $_POST['business'];
	$_SESSION['paypal_first_name'] = $_POST['first_name'];
	$_SESSION['paypal_last_name'] = $_POST['last_name'];
	$_SESSION['paypal_email'] = $_POST['email'];
	$_SESSION['paypal_users'] =  $_POST['multi_users'];
	$_SESSION['payment_gateway'] = $_POST['payment_gateway'];
	$_SESSION['discount_voucher'] = $_POST['discount_voucher'];
	if (is_file('temp/data/'.$sesion_id))
		@unlink('temp/data/'.$sesion_id);
	
	$data = serialize($_SESSION);
	$handle = fopen('temp/data/'.$sesion_id, 'w');
	fwrite($handle, $data);
	fclose($handle);
	
	echo json_encode($sesion_id);
	
?>