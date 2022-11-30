<?php include('config.php'); 

if (!isset($_SESSION["admin_username"]) || !isset($_SESSION["admin_fullname"])) {
  header("location: admin.php");
  exit;
}

if (isset($_SESSION["gatewayLogout"]) && ($_SESSION["gatewayLogout"]) == 1) {
  header("location: admin-logout.php");
  exit;
}

$_SESSION["admin_fullname"] = $_SESSION["account_type"];

if(isset($_POST['gatewaySelect']))
{
	$sql="SELECT `ID`, `paypal-name`,  `site-admin`, `cc-email`, `pagination` FROM `sign-up` WHERE `order_number`='".$_POST['gatewaySelect']."'  ";
	
	$result=mysql_query($sql);

	$count=mysql_num_rows($result);
		while($details = mysql_fetch_assoc($result)){
        
            $_SESSION["admin_fullname"] = $details['paypal-name'];		
        
            $_SESSION["order_number"] = $_POST['gatewaySelect'];		
        
            $_SESSION["user_id"]=$details['ID'];
        
            $_SESSION["cc-email"]=$details['cc-email'];
			
		    $_SESSION["site_admin"]=(int)$details['site-admin'];
        
            $_SESSION["pagination"]=(int)$details['pagination'];
			
		  //  $_SESSION["gateway"]=(int)$details['gateway'];
			
			$_SESSION["gatewayLogout"]=1;
       
            header("location: admin-serials.php");		
            exit;

}
}
?>

<?php include('header.php'); ?>

<section class="header header-style2 strapline" style="background:url(images/img_04.jpg) 50% 50%;  background:linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.4)), url(images/img_04.jpg) 50% 50% ; background-size:cover;">
    <div class="header-content">
	    <h1>
	Gateway Page</h1>
    </div>
</section>


	
	
	<div id="content">



 	<h3 class="green">Choose Account</h3>
<p>Please choose which account you wish to manage:</p>

<form id="gateway_form" action="" method="post">

<table class="login-res">
<tr>
<td>
					<select id="" name="gatewaySelect"   class="dropdown" >
						<?php 
						$sql_gateway = "SELECT * FROM gateway WHERE primary_account='".$_SESSION['order_number']."' "; 
						$query_gateway = mysql_query($sql_gateway); ?>
						<?php while($row = mysql_fetch_assoc($query_gateway)) { ?>
						<option value="<?php echo $row['associated'] ?>"><?php echo $row['name'] ?></option>
						<?php } ?>
					</select>

</td>
</tr>
<tr>
<td>
<br/><input name="submit" type="submit" value="Submit"  class="log-button"  />
</td>
</tr>
</table>
</form>
					
    
			</div><!-- content -->
		</div><!-- wrapper -->
		

<?php include('footer.php') ?>
