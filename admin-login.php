<?php include('config.php'); ?>
<?php 
if (!empty($_SESSION['paypal_email'])) {

 $sql="SELECT * FROM `sign-up` Where email='".$_SESSION['paypal_email']."'LIMIT 1";
 $result=mysql_query($sql) or die(mysql_error());
 
 $count=mysql_num_rows($result);
	

	if($count==1){
		$details = mysql_fetch_assoc($result);

		

		$_SESSION["admin_type"] = "main"; 
		
		$_SESSION["admin_username"] = $details['email'];
	
	    //$_SESSION["admin_username"] = str_replace(array('[',']'), '', $details['email']);

		$_SESSION["admin_fullname"] = $details['paypal-name'];		

		$_SESSION["order_number"] = $details['order_number'];		

	 	$_SESSION["user_id"]=$details['ID'];

		$_SESSION["site_admin"]=(int)$details['site-admin'];

		$_SESSION["cc-email"]=$details['cc-email'];



		header("location: admin-serials.php");		

		exit;

	}


	
	
header('HTTP/1.0 404 Not Found');
exit;
}
else {
	header("location: admin-logout.php");		
}

?>