<?php

include_once('config.php');



// PHP 4.1

$paypal_sandbox = false;



// read the post from PayPal system and add 'cmd'

$req = 'cmd=_notify-validate';



foreach ($_POST as $key => $value) {



	$value = urlencode(stripslashes($value));

	

	$req .= "&$key=$value";



}





// post back to PayPal system to validate

$header = "POST /cgi-bin/webscr HTTP/1.1\r\n";

$header .= "Content-Length: " . strlen($req) . "\r\n";

$header .= "Content-Type: application/x-www-form-urlencoded\r\n";

$header .= "Host: www.paypal.com\r\n";

$header .= "Connection: close\r\n\r\n";



$fp = fsockopen ('ssl://www.paypal.com', 443, $errno, $errstr, 30);







// assign posted variables to local variables



//$item_name = $_POST['item_name'];



//$item_number = $_POST['item_number'];



$payment_status = $_POST['payment_status'];



$payment_amount = $_POST['mc_gross'];



$payment_currency = $_POST['mc_currency'];



$txn_id = $_POST['txn_id'];



$receiver_email = $_POST['receiver_email'];



$payer_email = $_POST['payer_email'];





if (!$fp) {

	mail('safetybugtraining@gmail.com', 'ERROR CONNECTING', $errno.' '.$errstr);

	// HTTP ERROR



} else {

	fputs ($fp, $header . $req);

	

	while (!feof($fp)) {

	

		$res = fgets ($fp, 1024);

		

		//mail('safetybugtraining@gmail.com', 'CONNECTED', var_export($_POST, true).'---'.$res);

		

if (strcmp (trim($res), "VERIFIED") == 0) {

					

            include_once('order-payment.php');

			session_id($_POST['custom']); 

		

			//session_start();

			

			$data = file_get_contents('temp/data/'.$_POST['custom']);

			mail('safetybugtraining@gmail.com', 'DATA', $data);

      

			$_SESSION = unserialize($data);

		

			//include_once('config.php');



          $order_number = orderpayment();  

		

			if (is_file('temp/data/'.$_POST['custom'])) {

				//@unlink('temp/data/'.$_POST['custom']);

				

				$_SESSION['order_number'] = $order_number;

				

				//	append the order number to the file

				$h = fopen('temp/data/'.$_POST['custom'], 'w');

				fwrite($h, serialize($_SESSION));

				fclose($h);

			}

		

		//	mail("umosaics@gmail.com", $subject, $message, $headers);

	

		} else if (strcmp (trim($res), "INVALID") == 0) {

		

		// log for manual investigation

		

		}



	}



	fclose ($fp);



}



?>