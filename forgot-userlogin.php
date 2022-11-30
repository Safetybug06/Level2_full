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

<?php include('header1.php'); ?>
<link rel="stylesheet" href=
"https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
<!-- Start Account Area -->
<div id="content" class="account-area">
            <div class="d-table">
                <div class="d-table-cell">
                    <div class="container">
                        <div class="account-content">
                            <div class="account-header">
                                <a href="index.html">
                                    <img src="assets/images/SBT-logo-01.png" width="160" height="40" alt="main-logo">
                                </a>
                                <h3>Forget Login</h3>
                            </div>
        
                            <div class="alert alert-success" role="alert">
                                <h4 class="alert-heading">Account Recovery!</h4>
                                <?php

if($showresetform){

    ?>

<h3 class="green">Set Password</h3>

<?php if($err){

    echo '<p style="color:red;">'.$err.'</p>';

}



 ?>
                                <!-- <p id="before">Please Enter Your Username</p> -->
                                
                                <p>Please enter a new password</p>
                                <!-- <p id="set_pass" style="display: none;">Your New password has been Set. <br> You Can use This Link For <strong> <a href="login.html"> Login </a> </strong> </p> -->
                               
                            </div>
        
                            <form  id="email_form" action="" method="post"  class="account-wrap">
                                <!-- <div id="before1" class="form-group mb-24 icon">
                                    <input type="email" class="form-control" placeholder="Username">
                                    <img src="assets/images/icon/sms.svg" alt="sms">
                                </div> -->
                                <div id="after1"  class="form-group mb-24 icon">
                                    <input id="password" name="password" type="password" class="form-control" placeholder="New Password">
                                    <img src="assets/images/icon/key.svg" alt="sms">
                                    <i style="align-items: right;" class="bi bi-eye-slash" 
                                    id="togglePassword"></i>
                                </div>
                                <div id="after2"  class="form-group mb-24 icon">
                                    <input id="password_confirm" name="password_confirm" type="password" class="form-control" placeholder="Re-type New Password">
                                    <input name="userID__reset" type="hidden" value="<?php echo  $user_id; ?>"  />
                                    <img src="assets/images/icon/key.svg" alt="sms">
                                    <!-- <i style="align-items: right;" class="bi bi-eye-slash" 
                                    id="togglePassword1"></i> -->
                                </div>
                                <!-- <div id="before_btn" class="form-group mb-24">
                                    <button  type="button" class="default-btn">Submit</button>
                                </div> -->
                                <div id="after_btn"  class="form-group mb-24">
                                    <button  name="reset" type="submit" value="Submit" class="default-btn">Submit</button>
                                </div>
                                
                            </form>
                            <?php            

            

        }elseif($showrequestform){

            

?>
<!-- <h3 class="green">Forgotten Log-In</h3> -->

<?php if($err){

    echo '<p style="color:red;">'.$err.'</p>';

}



 ?>



<p>Please enter your username.</p>


                            <form id="email_form" action="" method="post" class="account-wrap">
                                <div id="before1" class="form-group mb-24 icon">
                                    <input id="username" name="username" type="text" class="form-control" placeholder="Username">
                                    <img src="assets/images/icon/sms.svg" alt="sms">
                                </div>
                                <!-- <div id="after1" style="display: none;" class="form-group mb-24 icon">
                                    <input type="password" class="form-control" placeholder="New Password">
                                    <img src="assets/images/icon/key.svg" alt="sms">
                                </div>
                                <div id="after2" style="display: none;" class="form-group mb-24 icon">
                                    <input type="password" class="form-control" placeholder="Re-type New Password">
                                    <img src="assets/images/icon/key.svg" alt="sms">
                                </div>
                                <div id="before_btn" class="form-group mb-24">
                                    <button  type="button" class="default-btn">Submit</button>
                                </div> -->
                                <div  class="form-group mb-24">
                                    <button  name="request" type="submit" value="Submit" class="default-btn">Submit</button>
                                </div>
                                
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
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- End Account Area -->
        <script>
            const togglePassword = document
                .querySelector('#togglePassword');
      
            const password = document.querySelector('#password');
      
            togglePassword.addEventListener('click', () => {
      
                // Toggle the type attribute using
                // getAttribure() method
                const type = password
                    .getAttribute('type') === 'password' ?
                    'text' : 'password';
                      
                password.setAttribute('type', type);
      
                // Toggle the eye and bi-eye icon
                this.classList.toggle('bi-eye');
            });
        </script>	<script>
            const togglePassword = document
                .querySelector('#togglePassword1');
      
            const password = document.querySelector('#password_confirm');
      
            togglePassword.addEventListener('click', () => {
      
                // Toggle the type attribute using
                // getAttribure() method
                const type = password
                    .getAttribute('type') === 'password' ?
                    'text' : 'password';
                      
                password.setAttribute('type', type);
      
                // Toggle the eye and bi-eye icon
                this.classList.toggle('bi-eye');
            });
        </script>

<?php include('footer1.php'); ?>
