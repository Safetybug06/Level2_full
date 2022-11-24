<?php include("config.php");?>
<?php
if(!isset($_SESSION["super_admin"]) || ($_SESSION["admin_type"] != 'super_admin')) {
	header("location: admin.php");		
	exit;
}

if (count($_POST) && isset($_POST['add_discount_code'])) {
	// generate discount code
	$serial = generateserialno(true);
	$order_number = 'SBT-01-DEMO'; // order number for demo
	extract($_POST);
	
	$discount = (float)$discount;
	
	$sql="insert into `user` (`serial`,`order-number`) VALUES ('$serial','$order_number')";
	mysql_query($sql) or die(mysql_error().' in '.$sql);
	
	$sql = "insert into `discount` (`DISCOUNT`, `VALUE`, `NAME`, `EMAIL`) VALUES ('$serial', '$discount', '$first_name $last_name', '$email')";
	mysql_query($sql) or die(mysql_error().' in '.$sql);
	
	// send email with demo searial	
	$serial=formatserialno($serial);
	
	$message = "<html>
				<body style=\"margin: 0; padding: 0\">
					<table border=\"1\" cellpadding=\"5\" cellspacing=\"0\" width=\"600\">
						<tr>
							<td><img alt=\"SafetyBugTraining.com\" height=\"58\" src= \"{$site_url}/images/header.jpg\" width=\"600\"></td>
						</tr>
				
						<tr>
							<td>
								<h2>Demo Serial</h2>
				
								<p>Here is your Demo Serial to try one complementary module of
								SafetyBugTraining.com.</p>Name: {$first_name} {$last_name}<br>
								E-mail: {$email}<br>
								<hr>
								
								<h3 style=\"text-align: center\">Product(s) ordered</h3>
				
								<table border=\"1\" cellpadding=\"5\" cellspacing=\"0\" width=\"100%\">
									<tr>
										<th>Description</th>
				
										<th>Amount</th>
									</tr>
				
									<tr>
										<td>Safety Bug Training License(Demo Serial)</td>
				
										<td align=\"center\">FREE</td>
									</tr>
				
									<tr>
										<td align=\"right\">V.A.T:</td>
				
										<td align=\"center\">FREE</td>
									</tr>
				
									<tr>
										<td align=\"right\">Order Total:</td>
				
										<td align=\"center\">FREE</td>
									</tr>
								</table><br>
				
								<table border=\"1\" cellpadding=\"5\" cellspacing=\"0\" width=\"100%\">
									<tr>
										<th>Serial #no</th>
				
										<th>Serial</th>
									</tr>
				
									<tr>
										<td>1</td>
				
										<td align=\"center\">{$serial}</td>
									</tr>
								</table>
				
								<h3 style=\"text-align: center\">Activation</h3>
				
								<p>Please log-in at the followng URL to activate yor demo serial:
								<a href=\"{$site_url}activate.php\">{$site_url}activate.php</a></p>
				
		<p>

		

		<strong>safetybugtraining.com</strong><br/>
Company No. 8210196 &amp; Vat Reg. 142 2589 19<br/>
Tel: 01223 258156<br/>
E-mail: <a href=\"mailto:info@safetybugtraining.com\">info@safetybugtraining.com</a>
		

		</p>
							</td>
						</tr>
				
						<tr>
							<td><img alt=\"SafetyBugTraining.com\" height=\"37\" src= \"{$site_url}/images/footer.jpg\" width=\"600\"></td>
						</tr>
					</table>
				</body>
				</html>";
				
	//$headers  = "From: do-not-reply@safetybugsecure.co.uk \n";
    //$headers .= "Content-type: text/html\r\n"; 	
	$subject = "Safety Bug Training Demo Serial";
	//mail($email, $subject, $message, $headers);
	send_email($email, AUTOMATED_EMAIL, SMTP_HOST, SMTP_PORT, SMTP_USER, SMTP_PASS, COMPANY_NAME, $subject, $message);
	header('location: super-admin.php');
	exit;
}


if(isset($_GET['filter_by'])) {
	$_SESSION['filter_by'] = $_GET['filter_by'];
}

if(isset($_GET['order_by'])) {
    
	$_SESSION['order_by'] = $_GET['order_by'];
}

$filter_by = isset($_SESSION['filter_by']) ? $_SESSION['filter_by'] : '';
$order_by = isset($_SESSION['order_by']) ? $_SESSION['order_by'] : 'activation';


?>

<!--
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="eng" lang="eng">
<head>
<title>Safety Bug Training</title>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" />
<meta name="keywords" content="Safety Bug Training" />
<meta name="description" content="" />
<link rel="stylesheet" type="text/css" href="css/main.css"/>
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/jquery.validation.min.js"></script>
-->


<?php include('header.php'); ?>

<section class="header header-style2" style="background:linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.4)), url(images/img_04.jpg) 50% 50% ; background-size:cover;">
    <div class="header-content">
	   <h1>SUPER ADMIN</h1>
    </div>
</section>

<script type="text/javascript">	
    var numErrors = 0;
	$(document).ready(function() {
		// validate order form
		$("#orderForm").validate({
			highlight: function(element, errorClass, validClass) {
	$(element).css("borderColor", "#ff0000");
				if($(element).data("hightlighed") == "1") {
					
				} else {
					$(element).data("hightlighed", 1);
					numErrors++;
				}
				$("#required-note").css("display", "block");
			},
			unhighlight: function(element, errorClass, validClass) {
		$(element).css("borderColor", "");
	
				if($(element).data("hightlighed") == "1") {
					$(element).data("hightlighed", 0);
					numErrors--;
				}
				if(numErrors == 0) {
					$("#required-note").css("display", "none");
				}
			},
			rules: {
				first_name: "required",
				last_name: "required",
				email: {
					required: true,
					email: true
				},
				discount : {
					required: true,
					number: true
				}
			},
			messages: {
				first_name: "",
				last_name: "",
				email: "",
				discount: ""
			}
		});
	});
</script>


</head>
<body>


<form action="" method="get">
	<p>Sort results:</p>
	<select id="order_by" name="order_by"   class="dropdown" >	
            <option value="fname"<?php if (isset($order_by)) { if($order_by == 'fname'){ echo ' selected="selected"'; }} ?>>First Name (Alphabetically)</option>
            <option value="name"<?php if (isset($order_by)) { if($order_by == 'name'){ echo ' selected="selected"'; }} ?>>Last Name (Alphabetically)</option> <!-- default -->
            <option value="order_number"<?php if (isset($order_by)) { if($order_by == 'order_number'){ echo ' selected="selected"'; }} ?>>Order No.</option>
                  <option value="activation"<?php if (isset($order_by)) { if($order_by == 'activation'){ echo ' selected="selected"'; }} ?>>Purchase History</option>
                    </select>
</form>

<?php
    
   /* if (!empty($order_by) && $order_by != 'activation' && $order_by != 'fname')
    $order_by = '';*/

if ($order_by == 'order_number')
	    $order_by = " substr(`order_number`, 7), timestamp ASC ";
    //  $order_by = "order_number, timestamp ASC";
	//   $order_by = " substring_index(TRIM(`order_number`), '-', -1) ";
elseif ($order_by == 'fname')
    $order_by = " if(`paypal-name` = '' or `paypal-name` is null,1,0), `paypal-name` ASC ";
elseif ($order_by == 'activation')
    $order_by = " timestamp ASC ";    
else
    $order_by = " if(`paypal-name` = '' or `paypal-name` is null,1,0), substring_index(TRIM(`paypal-name`), ' ', -1) ";

    /*$sql="SELECT * FROM `sign-up` ORDER BY $order_by";
   $data = mysql_query($sql) or die(mysql_error());*/
   
?>
<h4 class="center">Super Admin</h4>   
   
   
  <table  class="admin-serials" >	 
   <tr style="border-bottom:1px solid #C7C7C7;">
	<td  class="admin-border-right">Order #</td>
		<td  class="admin-border-right">Customer</td>

	<td  class="admin-border-right">Admin User</td>
<!-- 	<td  class="admin-border-right">Admin Pass</td> -->
	


		<td  class="admin-border-right">Serials</td>

		<td  class="admin-border-right">Activated</td>

		<td  class="admin-border-right">Candidates</td>

		<td style="padding:10px">Account</td>

	  </tr>

<?php

$x=1;
if($order_by){
    $sql="SELECT * FROM `sign-up` ORDER BY $order_by";
}else{
    $sql= "select * from `sign-up`"; 
}

//echo $sql;
     
$result = mysql_query($sql) or die(mysql_error());

while($row = mysql_fetch_assoc($result)) 

 {

//if($x%2==0)	{ 

//		$class='even';

//	} else { 

//		$class='odd'; 

//	}

echo '<tr>

<td class="admin-border-right">'.$row['order_number'].'</td>

<td class="admin-border-right">'.$row['paypal-name'].'</td>

<td class="admin-border-right">'.$row['email'].'</td>


<td class="admin-border-right">'.$row['Serial_Purchase'].'</td>

<td class="admin-border-right">'.$row['number-activated'].'</td>

<td class="admin-border-right"><a href="super-admin-serials.php?order_number='.$row['order_number'].'">View</a></td>
	<td style="padding:10px"><a href="super-admin-contact.php?ID='.$row['ID'].'">View</a></td>

</tr>';$x++;

}

?>

 </table>
 
 
 
 <?php
 	$sql = "SELECT *, LEFT(DISCOUNT, 1) as code_char FROM discount ORDER BY code_char DESC, ACTIVATED DESC";
	$query = mysql_query($sql);
 ?>
 
<h4 class="center">Demo Serials</h4>
  <table  class="admin-serials" > 
	  <tr style="border-bottom:1px solid #C7C7C7;">
	<td  class="admin-border-right">Name</td>
    	<td  class="admin-border-right">E-mail</td>
		<td  class="admin-border-right">Discount Code/Serial</td>
		<td  class="admin-border-right">Discount(%)</td>
		<td style="padding:10px">Activated</td>
	  </tr>
<?php while ($row = mysql_fetch_assoc($query)) { ?>
     <tr 
	 <? 
	// if  ($row['NAME'] == "GENERIC") 
	// {
	// echo 		 "class=\"even\"";  
//	 }
	// else 
	// {
	//echo "class=\"odd\""; 
//	 }
	 ?>  >
     
     
		<td class="admin-border-right"><?= $row['NAME'] ?></td>
		<td class="admin-border-right"><?= $row['EMAIL'] ?></td>
		<td class="admin-border-right"><?= $row['DISCOUNT'] ?></td>
		<td class="admin-border-right"><?= $row['VALUE'] ?></td>
	<td style="padding:10px"><?= !strstr($row['DISCOUNT'], 'DEMO') ? 'N/A' : ($row['ACTIVATED'] ? 'Yes' : 'No') ?></td>
	  </tr>
<?php  } ?>  
	</table> 
 
<h4 class="center">Send Demo Serial</h4>

	<div id="content">
<p  >

When you click 'submit' an email will be sent directly to the email provided containing demo-serial.

</p>


<p id="required-note" style="display:none;"><strong>Please complete the required fields</strong></p>

<form id="orderForm" method="post"  action="">
<table  style="width:60%">
  <tr>
    <td ><p>*First Name</p>
<input id="order_first_name" name="first_name" type="text"  />
</td>
  </tr>
  <tr>
    <td><p>*Surname</p>
<input id="order_last_name" name="last_name" type="text"    />
</td>
  </tr>




  <tr>


    <td>
<p>*Customer E-Mail</p>
<input id="order_email" name="email" type="text" /></td>

  </tr>
  
  <tr>
	<td><p>*Discount Value(%)</p>
    <input id="" name="discount" type="text" /></td>
  </tr>


  <tr  >



  <td>
    <p>
*Required
</p>
   <input type="hidden" name="add_discount_code" />
   <input name="" type="submit"  value="Submit"  class="log-button right" />

</td>



  </tr>


</table>



</form>



		
	</div><!-- content -->
    
		</div><!-- wrapper -->

		
 <script type="text/javascript">	
<!--
	$(document).ready(function() {		
		$('#site-select, #order_by').change(function() {
			$(this).parent('form').submit();
		});
	});
	//-->
</script>
 

<?php include('footer.php') ?>