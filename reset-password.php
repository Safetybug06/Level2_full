<?php include('config.php'); ?>

<?php 
    $count=0;
	$token= mysql_real_escape_string($_GET['reset']);

	$sql="select * from password_resets where token='$token' and created_at > DATE_SUB(NOW(), INTERVAL 2 HOUR)";

	$result=mysql_query($sql) ;

	$count=mysql_num_rows($result);
	
	
	    if($count==1){
    	    $valid = true;
            $row = mysql_fetch_assoc($result);
            $presetID = $row['id'];
            $user_id = $row['user_id'];
            $user_type = $row['user_type'];
    	    
    	    if(in_array($user_type, array('user','sign-up','login'))){
        	    $count=0;
                $sql="select * from `$user_type` where ID='$user_id' ";
                $result=mysql_query($sql);
                $count=mysql_num_rows($result);
                if($count==1){
                    
                    $user = mysql_fetch_assoc($result);
                    
                    if($user_type == 'login'){
                        $column_name = 'Password';
                    }else{
                        $column_name = 'password';
                        
                    }
                }
          }
          
          
          if(isset($_POST['submit'])){
              
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
                $sql="UPDATE `$user_type` SET $column_name = '$newpassword' where ID='$user_id' ";
                $result=mysql_query($sql);
                  
                $err = "Your new password has been set";
                $sql="DELETE FROM password_resets  where id='$presetID' ";
                $result=mysql_query($sql);

              }
              
              
              
              
          }
    	    
            
    }else{
        echo 'Link expired';exit;
    }

?>

<?php include('header.php') ?>




<section class="header header-style2" style="background:linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.4)), url(images/img_04.jpg) 50% 50% ; background-size:cover;">
    <div class="header-content">
	    <h1>Reset your password</h1>
    </div>
</section>

        
<div id="content">

		<h3 class="green">Type a new password</h3>
		<?php if(isset($err)){
    		echo '<p style="color:red;">'.$err.'</p>';
		}

		 ?>

		

		<form action="" method="post">
            <table class="login-res">
				<tr>
					<td><p>Type new password:</p>   
                      <input id="password" name="password" type="password" class="text-field"  />
                    </td>
				</tr>
				<tr>
					<td><p>Re-type new password:</p>   
                      <input id="password_confirm" name="password_confirm" type="password" class="text-field"  />
                    </td>
				</tr>
				<tr>
			<td><br/>
            <input name="submit" type="submit" value="Submit"  class="log-button right" />
            </td>
				</tr>
			</table>
		</form>




		</div><!-- content -->
		</div><!-- wrapper -->
        
        
        
<?php include('footer.php') ?>