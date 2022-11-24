<?php include('config.php'); ?>
<?php 
if (isset($_SESSION["admin_username"]) || !isset($_SESSION["admin_fullname"])) {


		header("location: admin-serials.php");		

	}
   

else {

    
	header("location: admin-logout.php");		
}

?>