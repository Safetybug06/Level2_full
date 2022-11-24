<?php include("config.php")?>

<?php

if(!isset($_SESSION["super_admin"]) || ($_SESSION["admin_type"] != 'super_admin')) {

	header("location: admin.php");		

	exit;

}

?>



<?php

  if(isset($_POST['reset-password'])) {

      $newPassword = generateAdminPassword();

      $userid = $_POST['userid'];

      

                $t_hasher = new PasswordHash(8, FALSE);

                $newHashedPassword = $t_hasher->HashPassword($newPassword);



                $sql="UPDATE `sign-up` SET password = '$newHashedPassword' WHERE ID='$userid' ";

                $result=mysql_query($sql);



  }

    

?>



<?php include('header.php'); ?>



<section class="header header-style2" style="background:linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.4)), url(images/img_04.jpg) 50% 50% ; background-size:cover;">

    <div class="header-content">

	    <h1>SUPER ADMIN</h1>

    </div>

</section>

        

	

            





<?php if(isset($_GET['ID'])) 

$sql = "select * from `sign-up` where ID = '".$_GET['ID']."'";

$result = mysql_query($sql) or die(mysql_error());

?>



<?php



while($row = mysql_fetch_assoc($result))



{



echo



    '<h4 class="center">'.$row['paypal-name'].'</h4>';

    ?>

    <div style='text-align:center;'>

        <form method="post" action="" style="padding-bottom:10px" >

            <input type="submit" name="reset-password"  class="log-button" value="Generate New Password" onclick="return confirm('This will set a new password for this user and display it on the screen one time only')">

            <input type="hidden" name="userid" value="<?php echo $row['ID'];?>">

        </form>

        

        <?php

            

            if(isset($newPassword)){

                echo "<h2>The new password for this user is: <strong>$newPassword</strong></h2><p>Please let them know before navigating away from this page as this will not be shown again.</p><p><strong>DO NOT REFRESH THIS PAGE</strong></p>";

            }

        ?>

    </div>

        <table  class="admin-serials"  >



	  <tr style="border-bottom:1px solid #C7C7C7;">



		<td  class="admin-border-right">Purchase Date</td>



		<td  class="admin-border-right" >Account Type</td>



		<td  class="admin-border-right">Email</td>

<td style="padding:10px">Discount Code</td>



	  </tr>



 



	  



 <?php



echo ' <tr>



<td  class="admin-border-right">'.date('jS M, Y', $row['timestamp']).'</td>



<td  class="admin-border-right">'.$row['account_type'].'</td>



<td  class="admin-border-right"><a href="mailto:'.$row['email'].'">'.$row['email'].'</a></td>

	<td style="padding:10px">'.(empty($row['discount-code']) ? 'not found' : $row['discount-code']).'</td>



</tr>		</table>';



}



?>







		</div><!-- wrapper -->



<?php include('footer.php') ?>