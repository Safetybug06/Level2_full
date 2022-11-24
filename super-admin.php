  
  <?php include("config.php");?>
 
  <!-- php code start  -->

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

	header('location: super-admin1.php');

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

<!-- php Header include  -->

<?php include("header2.php");?>



  <!-- php code end  -->
 

<script type="text/javascript">	



$(document).ready(function() {		

  $('#site-select, #order_by').change(function() {

      $(this).parent('form').submit();

  });

});

//-->

</script>

  <!-- Start Sidebar Area -->
   <nav  class="side-menu-area style-two">
        <nav class="sidebar-nav" data-simplebar>
            <ul id="sidebar-menu" class="sidebar-menu">
              

                <li id="all_1" class="mm-active">
                    <a href="#" class="box-style d-flex align-items-center">
                        <div class="icon">
                            <img src="assets/images/icon/profile-2user.svg" alt="calendar">
                        </div>
                        <span class="menu-title">All Super Admins</span>
                    </a>
                </li>
                <li id="demo_user">
                    <a href="#" class="box-style d-flex align-items-center">
                        <div class="icon">
                            <img src="assets/images/icon/user-octagon.svg" alt="calendar">
                        </div>
                        <span class="menu-title">Demo Users</span>
                    </a>
                </li>
                <li id="content1">
                    <a href="#" class="box-style d-flex align-items-center">
                        <div class="icon">
                            <img src="assets/images/icon/advanced.svg" alt="calendar">
                        </div>
                        <span  class="menu-title">Create Demo users</span>
                    </a>
                </li>
                <li>
                    <a href="admin-logout.php" class="box-style d-flex align-items-center">
                        <div class="icon">
                            <img src="assets/images/icon/key.svg" alt="calendar">
                        </div>
                        <span  class="menu-title">Logout</span>
                    </a>
                </li>

             
            </ul>
        </nav>
    </nav>
    <!-- End Sidebar Area -->
            <!-- Start Main Content Area -->
            <main id="main" class="main-content-wrap3 style-two">

 
<!-- Start Total Visits Area -->
<div id="all" class="total-visits-browse-area">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-xxl-12">
                <div class="total-visits-content card-box-style">
                    <div class="main-title d-flex justify-content-between align-items-center">
                        <h3>Super Admin</h3>

                        <form action="" method="get">
                        <select id="order_by" name="order_by" class="form-select form-control" aria-label="Default select example">
                            <option selected>Sort</option>
                            <option value="fname"<?php if (isset($order_by)) { if($order_by == 'fname'){ echo ' selected="selected"'; }} ?>>First Name </option>

                            <option value="name"<?php if (isset($order_by)) { if($order_by == 'name'){ echo ' selected="selected"'; }} ?>>Last Name </option> <!-- default -->

                            <option value="order_number"<?php if (isset($order_by)) { if($order_by == 'order_number'){ echo ' selected="selected"'; }} ?>>Order No.</option>

                             <option value="activation"<?php if (isset($order_by)) { if($order_by == 'activation'){ echo ' selected="selected"'; }} ?>>Purchase History</option>

                        </select>
                        </form>
                        <!-- <form action="" method="post">
<input type="number" name="perpage" min="0" />
<input type="submit" name="Submit" value="Submit!" />
</form> -->

                    </div>

                    <table class="table table-bordered ">
                        <thead>
                            <tr>
                                <th scope="col">Order #</th>
                                <th scope="col">Customer</th>
                                <th scope="col">Admin User</th>
                                <th scope="col">Serials</th>
                                <th scope="col">Activated</th>
                                <th scope="col">Candidates</th>
                                <th scope="col">Accounts</th>
                            </tr>
                        </thead>
                        <tbody>







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
 

 <!-- if (isset($_POST['Submit'])) { 
    
    $_SESSION['perpage'] = $_POST['perpage'];
    } 
    else{
        $_SESSION['perpage'] = 20;
    }

 $results_per_page = $_SESSION['perpage']; -->
 

 



<?php

$x=1;

if($order_by){

    $sql="SELECT * FROM `sign-up` ORDER BY $order_by";

}else{

    $sql= "select * from `sign-up`"; 

}
// $result = mysql_query($sql);  
// $number_of_result = mysql_num_rows($result);  
// $number_of_page = ceil ($number_of_result / $results_per_page);  

// if (!isset ($_GET['page']) ) {  
//     $page = 1;  
// } else {  
//     $page = $_GET['page'];  
// }  

// $page_first_result = ($page-1) * $results_per_page;  



//echo $sql;

     
// $sql= "SELECT  * FROM  `sign-up`  LIMIT ". $page_first_result . ',' . $results_per_page;   
$result = mysql_query($sql) or die(mysql_error());



while($row = mysql_fetch_assoc($result)) 



 {



//if($x%2==0)	{ 



//		$class='even';



//	} else { 



//		$class='odd'; 



//	}



echo '<tr>




<td>
 <span>'.$row['order_number'].'</span>
</td>

<td>
 <span>'.$row['paypal-name'].'</span>
</td>
<td>
 <span>'.$row['email'].'</span>
</td>
<td>
 <span>'.$row['Serial_Purchase'].'</span>
</td>
<td>
 <span>'.$row['number-activated'].'</span>
</td>

<td>
   <span><a style="color: green;" href="super-admin-serials.php?order_number='.$row['order_number'].'"> <u> View </u></a></span>
 </td>
 <td>
   <span><a style="color: green;" href="super-admin-contact.php?ID='.$row['ID'].'"> <u> View </u></a></span>
</td>





</tr>';$x++;



}



?>
                         

                          

                           
                        </tbody>
                    </table>

                    <?php
    //       for($page = 1; $page<= $number_of_page; $page++) {  
    //   echo '<a href = "super-admin1.php?page=' . $page . '">' . $page . ' </a>';  
    //   }  
     ?>
                </div>
            </div>

           
        </div>
    </div>
</div>
<!-- End Total Visits Area -->

<?php

 	$sql = "SELECT *, LEFT(DISCOUNT, 1) as code_char FROM discount ORDER BY code_char DESC, ACTIVATED DESC";

	$query = mysql_query($sql);

 ?>

<!-- Start Total Visits Area -->
<div id="demo" class="total-visits-browse-area" style="display: none;">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-xxl-12">
                <div class="total-visits-content card-box-style">
                    <div class="main-title d-flex justify-content-between align-items-center">
                        <h3>Demo Users</h3>

                       
                    </div>

                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">E-mail</th>
                                <th scope="col">Discount Code/Serials</th>
                                <th scope="col">Discount(%)</th>
                                <th scope="col" class="present">Activated</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                          
                            <?php while ($row = mysql_fetch_assoc($query)) { ?>

             <tr 

              <? 



               ?>  



<td>
 <span><?= $row['NAME'] ?></span>
 </td>
 <td>
 <span><?= $row['EMAIL'] ?></span>
 </td>
 <td>
 <span><?= $row['DISCOUNT'] ?></span>
 </td>
 <td>
 <span><?= $row['VALUE'] ?></span>
 </td>
 <td class="present">
  <span><?= !strstr($row['DISCOUNT'], 'DEMO') ? 'N/A' : ($row['ACTIVATED'] ? 'Yes' : 'No') ?></span>
  </td>



 </tr>

<?php  } ?>  
  
                        </tbody>
                    </table>
                </div>
            </div>

           
        </div>
    </div>
</div>
<!-- End Total Visits Area -->
<!-- form -->
<p id="required-note" style="display:none;"><strong>Please complete the required fields</strong></p>
<div id="content" class="card-box-style" style="display: none;">
    <div class="others-title">
        <h3>Send Demo Serials</h3>
    </div>
    <p id="required-note" style="display:none;"><strong>Please complete the required fields</strong></p>
    
    <form id="orderForm" method="post"  action="" class="row g-3">
        <div class="col-md-6">
            <label for="inputEmail4" class="form-label">*First Name</label>
            <input id="order_first_name" name="first_name" type="text" class="form-control" required="required" >
        </div>
        <div class="col-md-6">
            <label for="inputEmail4" class="form-label">*Surname</label>
            <input id="order_last_name" name="last_name" type="text" class="form-control" required="required">
        </div>
        <div class="col-md-6">
            <label for="inputEmail4" class="form-label">*Email</label>
            <input id="order_email" name="email" type="email" class="form-control" required="required" >
        </div>
        <div class="col-md-2">
            <label for="inputEmail4" class="form-label">*Discount value(%)</label>
            <input id="" name="discount" type="number" max="100" class="form-control" required="required">
        </div>
        
        
        
       
       
        <div class="col-12">
        <input type="hidden" name="add_discount_code" />

         <input name="" type="submit"  value="Submit"  class="btn btn-primary" />
            
        </div>
    </form>
</div>
<!-- end form -->

<!-- script for validation  -->





<!-- script for tab hide and show  -->
<script>
            $(document).ready(function(){
              $("#demo_user").click(function(){
                $("#all").hide();
              });
              $("#demo_user").click(function(){
                $("#demo").show();
              });
              $("#demo_user").click(function(){
                $("#content").hide();
              });
              $("#content1").click(function(){
                $("#all").hide();
              });
              $("#content1").click(function(){
                $("#demo").hide();
              });
              $("#content1").click(function(){
                $("#content").show();
              });
              $("#content1").click(function(){
                $("#all").hide();
              });
              $("#content1").click(function(){
                $("#demo").hide();
              });
              $("#content1").click(function(){
                $("#content").show();
              });
              $("#all_1").click(function(){
                $("#all").show();
              });
              $("#all_1").click(function(){
                $("#demo").hide();
              });
              $("#all_1").click(function(){
                $("#content").hide();
              });
            });
            </script>

<script type="text/javascript">	

var numErrors = 0;

$(document).ready(function() {

    // validate order form
   

    $("#orderForm").validate({

       

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

       <script>
        $(window).ready( function() {
       if($(window).width() > 850) {
       $('#main').addClass('style-two');
       $('#main').removeClass('style1');
       }else{
       $('#main').addClass('style1');
       $('#main').removeClass('style-two');
        }
        })
        </script>
        
 <?php include("footer2.php");?>