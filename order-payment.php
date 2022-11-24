<?php

function orderpayment() {

	global $vat;

	global $site_url;

	

	$query = "SELECT  MAX(ID) as last_id FROM `sign-up` "; 

	

	$result = mysql_query($query) or die(mysql_error());

	

	$max_id = mysql_result($result, 0 , 'last_id' );

	$password=generateAdminPassword();



	if(!isset($_SESSION["admin_username"]))

	{

		$email=$_SESSION['paypal_email'];

		$checkEmailMatch = mysql_query("SELECT * FROM `sign-up` WHERE `email` = '$email'");

    	$emailMatchQuery = mysql_fetch_assoc($checkEmailMatch);

				if (mysql_num_rows($checkEmailMatch) > 0) 

				{

		$order_number = $emailMatchQuery['order_number'] ;

		$order_number = explode("-", $order_number);

		$order_number[1] = "%";

		$order_number = implode("-", $order_number);

        $ord_no = explode("-", $order_number);

        $ord_no[0] = $ord_no[1] = '%';

        $ord_no = implode('-', $ord_no);

		$r = mysql_query("SELECT * FROM `sign-up` WHERE `order_number` LIKE '".$ord_no."' ORDER BY  SUBSTRING(`sign-up`.`order_number`,4) DESC");

		$s = mysql_fetch_assoc($r);

		$order_number = explode("-", $s['order_number']);

		$order_number[1] = sprintf('%02d', $order_number[1] + 1);

        $order_number[0] = 'SBT';

		$order_number = implode("-", $order_number);

    	$user_password = 'blank password email';

        $password = 'blank password';

	    $_SESSION["admin_username"] = $emailMatchQuery['email'];

	    $_SESSION["admin_fullname"] = $emailMatchQuery['paypal-name'];	

	    $_SESSION["emailRecognisedAccount"] = $emailMatchQuery['account_type'];	

	 //   $_SESSION["emailRecognised"] = '1';	

			 }

		        else 

		     {

		$order_number = 'SBT-01-'.(100800 + $max_id + 1) . date('dmy');

		$user_password = $password; //unhashed

        $t_hasher = new PasswordHash(8, FALSE);

        $password = $t_hasher->HashPassword($password);  //hashed

		}

		

	}

		

		else

		{

		$order_number = $_SESSION['order_number'];  

		$order_number = explode("-", $order_number);

		$order_number[1] = "%";

		$order_number = implode("-", $order_number);

        $ord_no = explode("-", $order_number);

        $ord_no[0] = $ord_no[1] = '%';

        $ord_no = implode('-', $ord_no);

		$r = mysql_query("SELECT * FROM `sign-up` WHERE `order_number` LIKE '".$ord_no."' ORDER BY  SUBSTRING(`sign-up`.`order_number`,4) DESC");

		$s = mysql_fetch_assoc($r);

		$order_number = explode("-", $s['order_number']);

		$order_number[1] = sprintf('%02d', $order_number[1] + 1);

        $order_number[0] = 'SBT';

		$order_number = implode("-", $order_number);

    	$user_password = 'blank password email';

        $password = 'blank password';

				

	} 

	

	

    $business=ucfirst($_SESSION['account_type']);

	$first_name=ucfirst($_SESSION['paypal_first_name']);

	$last_name=ucfirst($_SESSION['paypal_last_name']);

    $email=$_SESSION['paypal_email'];

	$user_email= isset($_SESSION["admin_username"]) ? '' : $email;

	$multi_users=(int)$_SESSION['paypal_users'];

    $price_vat = $price = getOrderPrice($multi_users);

  



	$discount_amount = 0;

	$discount_voucher = $_SESSION['discount_voucher'];

	if (strlen($discount_voucher)) {

		$discount_voucher = str_replace(array(' ','-'), '', $discount_voucher);

		$sql = "SELECT * FROM `discount` WHERE `DISCOUNT`='$discount_voucher' OR `DISCOUNT`='".$_SESSION['discount_voucher']."' LIMIT 1";

		$query = mysql_query($sql);

		

		if (!mysql_num_rows($query)) {

			$discount_voucher = '';

		} else {

			$discount = mysql_fetch_assoc($query);

			$discount_amount = ($price * (float)$discount['VALUE'])/100;

			

			$price_vat = $price - $discount_amount;

		}

	}

	

	$computed_vat=$vat/100*$price_vat;

	$total=round($price_vat+$computed_vat, 2);





	if(isset($_SESSION["admin_username"]))

	{

	$sql = "INSERT INTO `sign-up` (`order_number`,`Serial_purchase`, `timestamp`, `reminder-cert1yr`) VALUES ('$order_number','$multi_users','".time()."', '0')" ;  

	mysql_query($sql);

	}

	else

	{

	$sql = "INSERT INTO `sign-up` (`order_number`,`paypal-name`, `account_type`, `email`, `Serial_purchase`, `timestamp`, `password`, `discount-code`) VALUES ('$order_number','$first_name $last_name', '$business','$user_email','$multi_users','".time()."', '$password', '$discount_voucher')" ;  

	mysql_query($sql);

	}

	

	



    

    for($i=1;$i<=$multi_users;$i++)	

    {	

      $serial=generateserialno();	



      $sql="insert into `user` (`serial`,`order-number`) VALUES ('$serial','$order_number')";	

      mysql_query($sql);



      $serials[] = $serial;

    }



			

	$message = "<html>

	<body style=\"margin: 0; padding: 0\">	

	<table width=\"600\" border=\"1\" cellspacing=\"0\" cellpadding=\"5\">	

	<tr>	

	<td>	

	<img src=\"{$site_url}/images/header.jpg\" width=\"600\" height=\"58\" alt=\"SafetyBugTraining.com\"/>	

	</td>	

	</tr>	

	<tr>

	<td>

	<h2>Order Details</h2> 

	Thank you for submitting your order to SafetyBugTraining.com.";

		 		if(isset($_SESSION["emailRecognisedAccount"]))  

				{

					$message .= "<br><br>Please note your email has been recognised by our system and serials placed in the original account.";			

				}

				$message .= "<br><br>

	<strong>Date: ".date('d-m-Y')."</strong><br>

	<strong>Reference No: {$order_number}</strong><br>

	<br>

	Name: {$first_name} {$last_name} ";

			 		if(isset($_SESSION["emailRecognisedAccount"]))  

				{

					 if  ($_SESSION["emailRecognisedAccount"] != "Personal") 

	                     {

		     $message .= "(".$_SESSION["emailRecognisedAccount"].")";	

                         }

				}

			   	else

				         {

                    if ($business != "Personal") 

	                     {

		          $message .= "({$business})";	

                         }

				}

					

		/*}

	    else  {

	    $post_sale_order_number = explode("-", $order_number);

        $post_sale_order_number_mod = 'SBT-01-' .  $post_sale_order_number[2] ;



	if ($post_sale_order_number_mod != "Personal") 

	                     {

		          $message .= "({$business})";	

                         }

	}*/



	$message .= "<br>	

    E-mail: {$email}<br><hr>

	<h3 align=\"center\">Product(s) ordered</h3>

	<table width=\"100%\" border=\"1\" cellspacing=\"0\" cellpadding=\"5\">

		<tr>

			<th width=\"400\">Description</th>

			<th align=\"right\">Amount</th>

		</tr>

		<tr>

			<td width=\"400\">Safety Bug Training License({$multi_users})</td>

			<td align=\"right\">&pound;".number_format($price,2)."</td>

		</tr>";

		

		if ($discount_amount && strlen($discount_voucher)) {

			$message .= "

			<tr style=\"background:#058040; color:#fff\">		

				<td align=\"right\" width=\"400\">Promotional Price: </td> 

					<td align=\"right\">&pound;".number_format($price_vat,2)."</td>

			</tr>";

		}

		

	$message .= "

		<tr>

		<td align=\"right\" width=\"400\">		

		 V.A.T: </td>

		 <td align=\"right\">&pound;".number_format($computed_vat,2)."

		 </td>	

		</tr>	

		<tr>	

			<td align=\"right\" width=\"400\">

				Order Total: </td> 

				<td align=\"right\">&pound;".number_format($total,2)."	

			</td>

		</tr>

	</table>

	<br>

	<table width=\"100%\" border=\"1\" cellspacing=\"0\" cellpadding=\"5\">	";

  /*if ($res != '') {

    $message .= "	<tr>

			<th>Serial #no</th>

      <th>Name</th>

			<th>Serial</th>

		</tr>";

	

    for ($i = 0; $i < $multi_users; $i++) {	

    $serial=formatserialno($serials[$i]);	

    $message .= "	

      <tr>

        <td>".($i+1)."</td>

        <td align=\"center\">".($user_names[$i])."</td>  

        <td align=\"center\">{$serial}</td>

      </tr>";	

    }

  } else {*/

    $message .= "	<tr>

			<th>Serial #no</th>

			<th>Serial</th>

		</tr>";

	

    for ($i = 0; $i < $multi_users; $i++) {	

    $serial=formatserialno($serials[$i]);	

    $message .= "	

      <tr>

        <td>".($i+1)."</td>

        <td align=\"center\">{$serial}</td>

      </tr>";	

    }

 // }

	

	

	$message .= "	

	</table>	

	<h3 align=\"center\">Activation</h3>

	<p>Please visit the following URL to activate serials: <a href=\"{$site_url}activate.php\">{$site_url}activate.php</a></p>	

	<h3 align=\"center\">Administration</h3>

	<p>To view module progress of any serial, please <a href=\"{$site_url}admin.php\">log-in</a> with the following username/password:<p>

	<table width=\"100%\" border=\"1\" cellspacing=\"0\" cellpadding=\"5\">

	<tr>

	<th>Username</th>

	<td align=\"center\">{$email}</td>

	</tr>

	<tr>

	<th>Password</th>

	<td align=\"center\">";

	

		if(!isset($_SESSION["admin_username"]))

	{

	  $message .= "{$user_password}";

	}

	else

				{

					$message .= "***********";

		}

		

		$message .= "</td>

	</tr>

	</table>

	<p>Please provide your reference number if you need to contact us with any queries.</p>

			<p>

			Kind regards

			</p>

			<p>			

			<strong>safetybugtraining.com</strong><br>

	Company No. 8210196 &amp; Vat Reg. 142 2589 19<br>

	Tel: 01223 258156<br>

	E-mail: <a href=\"mailto:info@safetybugtraining.com\">info@safetybugtraining.com</a>			

			</p>

	</td>	

	</tr>	

	<tr>	

	<td>	

	<img src=\"{$site_url}/images/footer.jpg\" width=\"600\" height=\"37\" alt=\"SafetyBugTraining.com\"/>	

	</td>	

	</tr>	

	</table>	

	</body>

	</html>";

  //  $headers  = "From: do-not-reply@safetybugsecure.co.uk \n";

   // $headers .= "Content-type: text/html\r\n"; 	

	$subject = "SafetyBugTraining Order ".$order_number."";

//echo $message;

	//@mail($email, $subject, $message, $headers);		

	//@mail('do-not-reply@safetybugsecure.co.uk', $subject, $message, $headers);	

    send_email($email, AUTOMATED_EMAIL, SMTP_HOST, SMTP_PORT, SMTP_USER, SMTP_PASS, COMPANY_NAME, $subject, $message);

	//send duplicate

    send_email('no-reply@safetybugtraining.com', AUTOMATED_EMAIL, SMTP_HOST, SMTP_PORT, SMTP_USER, SMTP_PASS, COMPANY_NAME, $subject, $message);

/*  if($res != '') {

    return $_SESSION['order_number'];

  }*/

	return $order_number;

}

?>