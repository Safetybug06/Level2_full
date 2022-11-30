<?php include('config.php'); ?>

<?php 
ini_set('display_errors',1);  error_reporting(E_ALL);
$err = "";
$count = 0;
$count2 = 0;
$showresetform = false;
$showrequestform = true;
if(isset($_POST['request'])) {
    /*
    if(!$_POST['username'] OR !$_POST['code']){
		$err= "You must fill in both fields";
    }else{
      */
    
	$username=mysql_real_escape_string($_POST['username']) ;
	//$code=mysql_real_escape_string($_POST['code']) ;

	$sql="select ID, username from user where username='$username'";
	$result=mysql_query($sql);

	$count=mysql_num_rows($result);
	if($count==1){

		$details=mysql_fetch_array($result);
        $user_id = $details['ID'];
        $showresetform = true;
      
	} else {

		$err= "Invalid Username";

	}	
    }


if(isset($_POST['reset'])){
                 $showresetform = true;
				  $userID__reset = $_POST['userID__reset'];
	          $num = 0;
			  
			  
	$sql="select ID, username from user where ID='$userID__reset'";
              $result=mysql_query($sql) or die(mysql_error());
              $num=mysql_num_rows($result);
              if($num == 1){
                       //$r=mysql_fetch_array($result);
                       
                      $password = $_POST['password'];
                      $password_confirm = $_POST['password_confirm'];
                      $uppercase = preg_match('@[A-Z]@', $password);
                      $lowercase = preg_match('@[a-z]@', $password);
                      $number    = preg_match('@[0-9]@', $password);
                      if(!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
                          $err = "Your password must contain at least 1 number, 1 uppercase letter, 1 lowercase letter and be at least 8 characters long"; 
                      }elseif($password_confirm != $password){
                          $err = "Your passwords don't match"; 
                      }else{   
                        $t_hasher = new PasswordHash(8, FALSE);
                        $newpassword = $t_hasher->HashPassword($password);
                        $sql="UPDATE `user` SET password = '$newpassword' where ID='$userID__reset' ";
                        $result=mysql_query($sql);
                          
                        $err = "Your new password has been set. You can now use it to <a href=\"log-in.php\" style=\"color: #058040;\">log in</a>.";
                      //  $sql="DELETE FROM password_reset_codes  where id='$token' ";
                       // $result=mysql_query($sql);
                        $showresetform = false;
                        $showrequestform = false;
                    }
                }else{
                    $err = 'Something went wrong. Please try again.';
                }
    
    
}

?>

<?php include('header.php') ?>




<section class="header header-style2" style="background:linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.4)), url(images/img_04.jpg) 50% 50% ; background-size:cover;">
    <div class="header-content">
	    <h1>
Forgotten LOG IN</h1>
    </div>
</section>

        
<div id="content">



    <?php
        if($showresetform){
            ?>
		<h3 class="green">Set Password</h3>
		<?php if($err){
    		echo '<p style="color:red;">'.$err.'</p>';
		}

		 ?>
         
		<p>Please enter a new password</p>

		

		<form id="email_form" action="" method="post">
	<table <table class="login-res">
				<tr>
					<td><p>New Password:</p>   
                      <p><input id="password" name="password" type="password" class="text-field"  /></p>
                    </td>
				</tr>
				<tr>
					<td><p>Re-type new password:</p>   
                      <p><input id="password_confirm" name="password_confirm" type="password" class="text-field"  /></p>
           <input name="userID__reset" type="hidden" value="<?php echo  $user_id; ?>"  />
        <!--  <input  type="text" value="<?php // echo  $username; ?>"  /> -->
                    </td>
				</tr>
				<tr>
			<td><br/>
            <input name="reset" type="submit" value="Submit"  class="log-button right" />
            </td>
				</tr>
			</table>
		</form>
<?php            
            
        }elseif($showrequestform){
            
?>
		<h3 class="green">Forgotten Log-In</h3>
		<?php if($err){
    		echo '<p style="color:red;">'.$err.'</p>';
		}

		 ?>
        
		<p>Please enter your username.</p>

		

		<form id="email_form" action="" method="post">
 <table class="login-res">
				<tr>
					<td><p>Username:</p>   
                      <p><input id="username" name="username" type="text" class="text-field"  /></p>
                    </td>
				</tr>

				<tr>
			<td><br/>
            <input name="request" type="submit" value="Submit"  class="log-button right" />
            </td>
				</tr>
			</table>
		</form>

<?php
            }else{
              ?>  
                    <h3 class="green">Set password</h3>
                    <?php if($err){
                        echo '<p style="color:red;">'.$err.'</p>';
                    }
                    ?>
                    <p style="padding-bottom: 30px;">&nbsp;</p>
                    <?php
                    
            }

?>


		</div><!-- content -->
		</div><!-- wrapper -->
        
        
        
<?php include('footer.php') ?>