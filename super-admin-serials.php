 
 <?php include("config.php");?>
 <?php

if(!isset($_SESSION["super_admin"]) || ($_SESSION["admin_type"] != 'super_admin')) {

	header("location: admin.php");		

	exit;

}



if(isset($_GET['serial']))

{

$_SESSION["serial"] = $_GET['serial'];



header('location: activate2.php');



exit;

}



if (!isset($_GET['order_number'])) {

	header("location: super-admin.php");		

	exit;

}





unset($_SESSION["serial"]);



//$order_number=$_SESSION['order_number'];





$order_number = trim($_GET['order_number']);

$_SESSION['order_number'] = $order_number;



if(isset($_GET['id'])) {

if(strpos($order_number,'RES-') !== false) {

 $s=mysql_query("SELECT * FROM `user` WHERE `resit-order` like '".preg_replace('/\-(\d)*\-/', '-%-', $order_number)."' AND `ID`='".$_GET['id']."'"); 

} else 

 $s=mysql_query("SELECT * FROM `user` WHERE `order-number` like '".preg_replace('/\-(\d)*\-/', '-%-', $order_number)."' AND `ID`='".$_GET['id']."'");

 

 if(!mysql_num_rows($s)) header('Location: admin-serials.php');

 

	$r = mysql_fetch_assoc($s); 

//get course name

$sql = "SELECT * FROM course WHERE course_ID = '".$r['course']."'";

$courseResult = mysql_query($sql) or die(mysql_error());

$courseDetails = mysql_fetch_assoc($courseResult);

	

	$pdf_file = 'temp/'.(str_replace(' ', '_', $r['name'])).'-'.date('d-m-Y').'.pdf';

  $suffix_resit = ($r['resit-order'] != '') ? ' (Resit) ' : '';

	require_once(dirname(__FILE__)."/fpdf/fpdf.php");

	$pdf = new FPDF('L');

  $pdf->AddPage();

  $pdf->SetFont('Arial', '', 30);

  $pdf->Text(90, 50, 'Safety Bug Training Log-in' . $suffix_resit);

  $pdf->SetFont('Arial', '', 20);

  $pdf->Text(40, 95, 'Name:');

  $pdf->Text(90, 95, $r['name']);

  $pdf->Text(40, 105, 'Serial:');

  $pdf->Text(90, 105, formatserialno($r['serial']));

  $pdf->Text(40, 115, 'Course:');

  $pdf->Text(90, 115, $courseDetails['course_name']);

  

  $pdf->Text(40, 125, 'Username:');

  $pdf->Text(90, 125, $r['username']);



 if (!filter_var($r['username'], FILTER_VALIDATE_EMAIL)) {

	 $pdf->Text(40, 135, 'Set Password:');

     $pdf->Text(90, 135, ''.$site_url.'forgot-userlogin.php');

}else {

	   $pdf->Text(40, 135, 'Set Password:');

       $pdf->Text(90, 135, ''.$site_url.'forgot-login.php');

}





	$pdf->SetFont('Arial','',14);

			

	$pdf->Output($pdf_file);

	

	header('Content-disposition: attachment; filename='.(str_replace(' ', '_', $r['name'])).'-'.date('d-m-Y').'.pdf');

	header('Content-type: application/pdf');

	readfile($pdf_file);



}



$sql = "SELECT * FROM `sign-up` WHERE order_number = '".$order_number."'";

$query = mysql_query($sql);

if (!mysql_num_rows($query)) {

	header("location: super-admin.php");		

	exit;

}



$order_data = mysql_fetch_assoc($query);





if(isset($_GET['order_by'])) {

    

	$order_by = $_GET['order_by'];

}else{

    $order_by = 'activation';

}

?>
 <?php include("header2.php");?>
 
 <!-- Start Sidebar Area -->
 <nav class="side-menu-area style-two">
        <nav class="sidebar-nav" data-simplebar>
            <ul id="sidebar-menu" class="sidebar-menu">
              

                <li id="all_1" class="mm-active">
                    <a href="#" class="box-style d-flex align-items-center">
                        <div class="icon">
                            <img src="assets/images/icon/profile-2user.svg" alt="calendar">
                        </div>
                        <span class="menu-title">All Serials</span>
                    </a>
                </li>
                
                <li id="demo_user">
                    <a href="#" class="box-style d-flex align-items-center">
                        <div class="icon">
                            <img src="assets/images/icon/user-octagon.svg" alt="calendar">
                        </div>
                        <span class="menu-title">Additional Administrators</span>
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
                        <div class="others-title">
                            <h3><?php echo $order_data['paypal-name'] ?></h3>
                        </div>
                        

                       
                        
                    </div>
                    <div class="main-title d-flex justify-content-between align-items-center">
                    

                  
                        <form action="" method="get">

                     <input name="order_number" value="<?php if (isset($_GET['order_number'])) { echo $_GET['order_number']; } ?>" type="hidden" />

	                     <p>Sort results:</p>

	                 <select id="order_by" class="form-select form-control" name="order_by"   class="dropdown" >	

                   <option value="fname"<?php if (isset($order_by)) { if($order_by == 'fname'){ echo ' selected="selected"'; }} ?>>First Name </option>

                  <option value="name"<?php if (isset($order_by)) { if($order_by == 'name'){ echo ' selected="selected"'; }} ?>>Last Name (Alphabetically)</option> <!-- default -->

                  <option value="activation"<?php if (isset($order_by)) { if($order_by == 'activation'){ echo ' selected="selected"'; }} ?>>Activation Date</option>
    
                    </select>

</form>
<?php



if ($order_by == 'fname')

    $order_by = " if(`name` = '' or `name` is null,1,0), `name` ASC ";

elseif ($order_by == 'activation')

    $order_by = " activated DESC, date_activated ASC ";    

else

    $order_by = " if(`name` = '' or `name` is null,1,0), substring_index(TRIM(`name`), ' ', -1) ";



?>		
<?php 

if(substr($order_number, 0, 3) == 'RES'){

 $condition = "`resit-order` ='".$order_number."'";

}

else {

 $condition = " `order-number` ='".$order_number."'";

}  

    if($order_by){

        $sql="SELECT * FROM `user` WHERE  $condition ORDER BY $order_by";

    }else{

       echo  $sql="SELECT * FROM `user` WHERE $condition `order-number` ='".$order_number."' ORDER BY activated DESC, date_activated ASC";

    }

   

   $data = mysql_query($sql) or die(mysql_error());   

   $count=mysql_num_rows($data); 

   

   $sql= "SELECT count(serial) as total_active FROM `user` WHERE activated='yes' AND $condition";//`order-number`='".$order_number."'";

   $initial_query = mysql_query($sql) or die("SQL error");

   $numrows = mysql_result($initial_query, 0, 'total_active');

?>
<form method="post" action="paypal.php">
                        <div class="others-title">
                            <h3> <?php echo $count?> Serials / <?php echo $numrows ; ?> Active</h3>
                        </div>

                    </div>
                   
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Order #</th>
                                <!-- <th scope="col">Site</th> -->
                                <th scope="col">Name</th>
                                <th scope="col">Course</th>
                                <th scope="col">Language</th>
                                <th scope="col">Progress</th>
                                <th scope="col">Status</th>
                                <th scope="col">Password</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 

$x=1;

while($row = mysql_fetch_array($data)) {



  $suffix_resit = '';

  if($row['resit-order'] != '') {

    $suffix_resit =  ' (Resit)';

  }

          

	if($row['activated']=="yes"){

	           $result='Activated';

	}  else  {

		$result='<u><a style="color: green;" href="super-admin-serials.php?serial='.$row['serial'].'">Admin Activation <strong>' . $suffix_resit . '</a></u>';

	}

	$completed_modules = 0;

	

	$sql = "SELECT * FROM course WHERE course_ID = '".$row['course']."'";

$courseResult = mysql_query($sql) or die(mysql_error());

$courseDetails = mysql_fetch_assoc($courseResult);

		      $total_modules = $courseDetails['modules']; 

		      if ($courseDetails['modules'] =='')  $total_modules = 8;





	for($i=1;$i<=$total_modules;$i++) {

		if($row[$i]=="No")

		{

			$i -= 1;

			break;

		}

	}

	$completed_modules = ($i > $total_modules) ? $total_modules : $i;

	

		 if ($courseDetails['course'] == 'allergen' && $completed_modules > 1 ) {

		  $completed_modules =  $completed_modules  - 1;

		  }

		  

          $result = ($i > $total_modules) ? "Passed" : $result;

	

	if($row['activated']=="yes" || $i > $total_modules)

	$link= "<u><a style='color: green;' href=\"super-admin-modules.php?x=".$row['ID']."\">".$completed_modules."/" . $courseDetails['modules_admin'] . " Modules".(($completed_modules >= $courseDetails['modules_admin']) ? ' (Cert. sent)' : '</a><u>');



	else

	{

		$link= " No Progress Found ";

	}

	echo "<tr>";

   echo "<td> <span>{$order_number} </span></td>";

 //  echo "<td  class=\"admin-border-right\">". formatserialno($row['serial'])."</td>";



      $ss__pass_active = ucwords($result) . 

                  (($row['activated'] == "yes" && strtotime($row['date_activated'])) ? ' : ' . date('d/m/y', strtotime($row['date_activated'])) 

                  . "  <u><a style='color: green;' href=\"admin-serials.php?serial=" . $row['serial'] . "\">(Update)</a></u>" : '');

				  

          if ($i > $total_modules) {

    

                $ss__pass_active = '<span class="passed-green" >Passed: ' . date('d/m/y', strtotime($row['date_activated'])) . '</span>';

              }

              

         



       echo "<td><span>" . mb_strimwidth($row['name'], 0, 25, "...") . "</span></td>";

       echo "<td><span>" . $courseDetails['course_name'] . "</span></td>";

       echo "<td ><span>" .ucwords($row['language'])."</span></td>";

       echo "<td ><span>".$link."</span></td>";
    //    <span ><a style="color: green;" href="http://"><u>1/8 Modules</u> </a></span>

	   echo "<td><span>" . $ss__pass_active . "</span></td>";

	   

   if($row['activated']=="yes"){?>

		<!-- <td class="admin-border-right download"><a href="super-admin-serials.php?order_number=<?php echo $_GET['order_number']?>&id=<?php echo $row['ID']?>"><i class="fa fa-download"></i></a></td> -->
        <td scope="row" class="present">
                                    <a href="super-admin-serials.php?order_number=<?php echo $_GET['order_number']?>&id=<?php echo $row['ID']?>">
                                        <img src="assets/images/icon/download.svg" width="40" alt="link">
                                    </a>
                                </td>
	<?php }else{

		echo "<td class=\"admin-border-right\">Not Found</td>";

	}

	

	echo "</tr>";

$x++;	

}	



?>
<!-- 
                            <tr>
                                <td>
                                    <span>SBT-01-100841141212</span>
                                </td>
                               
                                <td>
                                    <span>Suraj Tiwari </span>
                                </td>
                                <td>
                                    <span>Food Safety Level2</span>
                                </td>
                                <td>
                                    <span>Chiness</span>
                                </td>
                                <td>
                                    <span ><a style="color: green;" href="http://"><u>1/8 Modules</u> </a></span>
                                </td>
                                <td >
                                    <span >Activated :27/03/19<a style="color: green;" href="http://"> <u>(updated)</u> </a></span>
                                </td>
                           
                                <td scope="row" class="present">
                                    <a href="index.html">
                                        <img src="assets/images/icon/link.svg" alt="link">
                                    </a>
                                </td>
                        
                            </tr> -->
                           
                           

                          

                           
                        </tbody>
                    </table>
                </div>
            </div>

           
        </div>
    </div>
</div>
<!-- End Total Visits Area -->

<!-- Start Total Visits Area -->
<div id="demo" class="total-visits-browse-area" style="display: none;">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-xxl-12">
                <div class="total-visits-content card-box-style">
                    <div class="main-title d-flex justify-content-between align-items-center">
                        <div class="others-title">
                        <h3>Additional Administrators for <?php echo $order_data['paypal-name'] ?></h3>
                    </div>
                    
              
                    </div>

                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Position</th>
                                <th scope="col">Username</th>
                                <th scope="col">Password</th>
                                <th scope="col">Date Created</th>
                                
                                
                            </tr>
                        </thead>
                        <tbody>
                        <?php

$fetch_admin = "select * from login WHERE Order_Number = '".$order_number."'";

$new_admin = mysql_query($fetch_admin) or die(mysql_error());

$count=mysql_num_rows($new_admin);

while($new = mysql_fetch_array($new_admin)) 

{

	echo '<tr>

<td><span>'.$new['Name'].'</span></td>

<td><span>'.$new['Position'].'</span></td>

<td><span>'.$new['Email'].'</span></td>

<td><span>'.$new['Password'].'</span></td>

<td><span>'.$new['Date_Created'].'</span></td>

	</tr>';

}



if (!mysql_num_rows($new_admin)) {

	echo '<tr><td colspan="6">No Additional Administators</td></tr>';

}

?>
                            <!-- <tr>
                                <td>
                                    <span>Suraj</span>
                                </td>
                                <td>
                                    <span>Manager</span>
                                </td>
                                <td>
                                    <span>Username@sghs</span>
                                </td>
                               
                                <td>
                                    <span >********</span>
                                </td>
                                <td>
                                    <span >2022-07-12 17:01:41</span>
                                </td>
                               
                            </tr>
   -->
                        </tbody>
                    </table>


                   
                    
                </div>
            </div>

           
        </div>
    </div>
</div>

<!-- End Total Visits Area -->
<!-- certicate  -->
<script>
            $(document).ready(function(){
              $("#demo_user").click(function(){
                $("#all").hide();
              });
              $("#demo_user").click(function(){
                $("#demo").show();
              });
              $("#demo_user").click(function(){
                $("#certificates").hide();
              });
              $("#demo_user").click(function(){
                $("#site_admin").hide();
              });
              $("#demo_user").click(function(){
                $("#qa").hide();
              });
             
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
        <script type="text/javascript">	

<!--

	$(document).ready(function() {		

		$('#site-select, #order_by').change(function() {

			$(this).parent('form').submit();

		});

	});

	//-->

</script>

<?php include("footer2.php");?>
 