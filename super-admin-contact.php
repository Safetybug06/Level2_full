<?php include('config.php'); ?>
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
<?php include('header2.php'); ?>
<?php if(isset($_GET['ID'])) 

$sql = "select * from `sign-up` where ID = '".$_GET['ID']."'";

$result = mysql_query($sql) or die(mysql_error());

?>

 <!-- Start Sidebar Area -->
 <nav class="side-menu-area style-two">
        <nav class="sidebar-nav" data-simplebar>
            <ul id="sidebar-menu" class="sidebar-menu">
              

                <li id="all_1" class="mm-active">
                    <a href="#" class="box-style d-flex align-items-center">
                        <div class="icon">
                            <img src="assets/images/icon/user-octagon.svg" alt="calendar">
                        </div>
                        <span class="menu-title">Account Details</span>
                    </a>
                </li>

            </ul>
        </nav>
    </nav>
    <!-- End Sidebar Area -->
            <!-- Start Main Content Area -->
            <main class="main-content-wrap3 style-two">

<!-- Start Total Visits Area -->
 <div id="all" class="total-visits-browse-area">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-xxl-12">
                <div class="total-visits-content card-box-style">
                    <div id="liveAlertPlaceholder">
                        </div>
                        <?php

            

if(isset($newPassword)){

    echo "
    <div class='alert alert-warning alert-dismissible' role='alert'>
      <div>The new <strong> password </strong> for this user is: <h1> $newPassword </h1> </div>
      <h6> Please let them know before navigating away from this page as this will not be shown again. </h6>
      <h4>* DO NOT REFRESH THIS PAGE *</h4>
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
}

?>
                    <div class="main-title d-flex justify-content-between align-items-center">
                        <div class="others-title">
                            <h3><?php while($row = mysql_fetch_assoc($result)) { echo '<h4 class="center">'.$row['paypal-name'].'</h4>'; ?></h3>
                        </div>

                        <form method="post" action="" style="padding-bottom:10px" >
                        <!-- <button type="submit" name="reset-password" id="liveAlertBtn" value="Generate New Password" class="btn btn-outline-success mb-1" onclick="return confirm('This will set a new password for this user and display it on the screen one time only')">Generate New Password </button> -->
                        <input type="submit" name="reset-password"   class="btn btn-outline-success mb-1" value="Generate New Password" onclick="return confirm('This will set a new password for this user and display it on the screen one time only')">
                        <input type="hidden" name="userid" value="<?php echo $row['ID'];?>">
                        
                        </form>
                      
                        
                    
                    </div>
                   

                    <table class="table align-middle table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Purchase Date</th>
                                <th scope="col">Account type</th>
                                <th scope="col">Email</th>
                                <th scope="col">Discount Code</th>
                              
                            </tr>
                        </thead>
                        <tbody>
  
                            <?php



echo ' <tr>



<td><span>'.date('jS M, Y', $row['timestamp']).'</span></td>



<td><span>'.$row['account_type'].'</span></td>



<td><span><a style="color: green;" href="mailto:'.$row['email'].'"><u>'.$row['email'].'</u></a></span></td>

	<td><span>'.(empty($row['discount-code']) ? 'not found' : $row['discount-code']).'</span></td>



</tr>';


                            }




?>




                          

                           
                        </tbody>
                    </table>
                </div>
            </div>

           
        </div>
    </div>
</div>
<!-- End Total Visits Area -->
<script>
            $(document).ready(function(){
             
             
              $("#all_1").click(function(){
                $("#all").show();
              });
              $("#all_1").click(function(){
                $("#demo").hide();
              });
              $("#all_1").click(function(){
                $("#certificates").hide();
              });
              $("#all_1").click(function(){
                $("#site_admin").hide();
              });
              $("#all_1").click(function(){
                $("#qa").hide();
              });
             
            });
            </script>
              </script>
       <!-- <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script> -->
       <script>
            const alertPlaceholder = document.getElementById('liveAlertPlaceholder')

            const alert = (message, type,password) => {
            const wrapper = document.createElement('div')
            wrapper.innerHTML = [
                `<div class="alert alert-${type} alert-dismissible" role="alert">`,
                `   <div>${message} <h1> ${password} </h1> </div>`,
                `   <h6> Please let them know before navigating away from this page as this will not be shown again. </h6>`,
                `   <h4>* DO NOT REFRESH THIS PAGE *</h4>`,
                '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
                '</div>'
            ].join('')

            alertPlaceholder.append(wrapper)
            }

            const alertTrigger = document.getElementById('liveAlertBtn')
            if (alertTrigger) {
                alertTrigger.addEventListener('click', () => {
                    alert('The new <strong> password </strong> for this user is: ', 'warning','php')
                })
            }
        </script>
   
<?php include('footer2.php'); ?>
