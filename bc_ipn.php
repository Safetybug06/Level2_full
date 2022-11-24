<?php
include_once('config.php');
include_once('order-payment.php');
// assign posted variables to local variables

$order_id = $_REQUEST['orderID'];

//$amount = $_REQUEST['AMOUNT'];

//$currency = $_REQUEST['CURRENCY'];

//$payment_method = $_REQUEST['PM'];

//$acc_code = $_REQUEST['ACCEPTANCE'];

$status = $_REQUEST['STATUS'];

//$card_no = $_REQUEST['CARDNO'];

$pay_id = $_REQUEST['PAYID'];

$error = $_REQUEST['NCERROR'];

//$brand = $_REQUEST['BRAND'];

$shasign = $_REQUEST['SHASIGN'];

//$sha_out=sha1("ACCEPTANCE=".$acc_code.$secretsig."AMOUNT=".$amount.$secretsig."BRAND=".$brand.$secretsig."CARDNO=".$card_no.$secretsig."CURRENCY=".$currency.$secretsig."ORDERID=".$order_id.$secretsig."NCERROR=".$error.$secretsig."PAYID=".$pay_id.$secretsig."PM=".$payment_method.$secretsig."STATUS=".$status.$secretsig); 

$sha_out=sha1("NCERROR=".$error.$secretsig."ORDERID=".$order_id.$secretsig."PAYID=".$pay_id.$secretsig."STATUS=".$status.$secretsig);

mail('umosaic.test@gmail.com', 'BC data', var_export($_REQUEST, true)."\n\n".$sha_out."\n\n"."NCERROR=".$error.$secretsig."ORDERID=".$order_id.$secretsig."PAYID=".$pay_id.$secretsig."STATUS=".$status.$secretsig."\n\n".var_export($_SESSION, true)."\n\n");

if (strtoupper($sha_out) == $shasign && in_array((int)$status, array(5,9))) {

    $order_number = orderpayment();
	
	$session_id = session_id();
	
	if (is_file('temp/data/'.$session_id)) {
		//@unlink('temp/data/'.$_POST['custom']);
		
		$_SESSION['order_number'] = $order_number;
		
		//	append the order number to the file
		$h = fopen('temp/data/'.$session_id, 'w');
		fwrite($h, serialize($_SESSION));
		fclose($h);
	}
	
	header('Location: thank-you.php');



}

else {
	header('Location: decline.php');
}
//fclose ($fp);
?>