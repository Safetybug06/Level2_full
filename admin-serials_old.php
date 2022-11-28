<?php include('config.php'); ?>

<?php

if (!isset($_SESSION["admin_username"]) || !isset($_SESSION["admin_fullname"])) {

  header("location: admin.php");

  exit;

}





if (isset($_GET['serial'])) {  

  $_SESSION["serial"] = $_GET['serial'];

  $_SESSION["updateSerial"] = $_GET['update'];

  header('location: activate2.php');

  exit;

}

unset($_SESSION["serial"]);

$order_number = $_SESSION['order_number'];



if (isset($_GET['id'])) {

  $s = mysql_query("SELECT * FROM `user` WHERE `order-number` like '" . preg_replace('/\-(\d)*\-/', '-%-', $order_number) . "' AND `ID`='" . $_GET['id'] . "'");

  if (!mysql_num_rows($s))

    header('Location: admin-serials.php');

  $r = mysql_fetch_assoc($s);

 

 		$namePass = $r['name'];

		$namePassUTF8 =	utf8_decode($namePass); 

 $pdf_file = 'temp/' . (str_replace(' ', '_', $namePassUTF8)) . '-' . date('d-m-Y') . '.pdf';

$user_id = $r['ID'];



//get course name

$sql = "SELECT * FROM course WHERE course_ID = '".$r['course']."'";

$courseResult = mysql_query($sql) or die(mysql_error());

$courseDetails = mysql_fetch_assoc($courseResult);





  $suffix_resit = ($r['resit-order'] != '') ? ' (Resit) ' : '';

  require_once(dirname(__FILE__) . "/fpdf/fpdf.php");

  $pdf = new FPDF('L');

  $pdf->AddPage();

  $pdf->SetFont('Arial', '', 30);

  $pdf->Text(90, 50, 'Safety Bug Training Log-in' . $suffix_resit);

  $pdf->SetFont('Arial', '', 20);

  $pdf->Text(40, 95, 'Name:');

  // encode name into UTF 8

  $pdf->Text(90, 95, $namePassUTF8);

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





  $pdf->SetFont('Arial', '', 14);







  $pdf->Output($pdf_file);



  header('Content-disposition: attachment; filename=' . (str_replace(' ', '_', $namePassUTF8)) . '-' . date('d-m-Y') . '.pdf');

  header('Content-type: application/pdf');

  readfile($pdf_file);

}

if (isset($_POST['checkbox']) && count($_POST['checkbox']) > 0) {

  foreach ($_POST['checkbox'] as $del_id) {

    $sql = "DELETE FROM login WHERE ID=' " . $del_id . " ' ";

    $result = mysql_query($sql) or die(mysql_error());

  }

}

$err = "";

if (count($_POST) && isset($_POST['name'])) {

  $email_post = $_POST['email'];

  $emailCheck = mysql_query("SELECT Email FROM login WHERE Email = '$email_post'");

  $count = mysql_num_rows($emailCheck);

  if ($count) {

    $err = "Email already exist";

  } else {

      

    $t_hasher = new PasswordHash(8, FALSE);

    $hash = $t_hasher->HashPassword($_POST[password]);



    $sql = "INSERT INTO `login` (Name, Position, Email,Password,Order_Number) VALUES ('$_POST[name]','$_POST[position]','$_POST[email]','$hash','$order_number')";

    mysql_query($sql) or die(mysql_error());

              $lastid = mysql_insert_id();



    require_once 'classes/Email.php';



    $name = $_SESSION["admin_fullname"];

    $email_content = "<html>	

			

			

			<body style=\"margin: 0; padding: 0\">

			

			

			

			<table width=\"600\" border=\"1\" cellspacing=\"0\" cellpadding=\"5\">

			<tr>

			<td>

			<img src=\"{$site_url}/images/header.jpg\" width=\"600\" height=\"58\" alt=\"SafetyBugTraining.com\"/>

			</td>

			</tr>

			<tr>

			

			<td>

			

			<h2>Admin Log-in</h2> 

			

			<p>{$name} has set you up as an <strong>Administrator</strong> so you can view candidate progress, on {$site_url}</p> 

			<h3 align=\"center\">Your Log-in</h3>

			<table width=\"100%\" border=\"1\" cellspacing=\"0\" cellpadding=\"5\">

			

				<tr>

				<th>Username:</th>

				<td align=\"center\">{$email_post}</td>

				</tr>

				<tr>

				<th>Password:</th>

				<td align=\"center\">This will be given to you verbally</td>

				</tr>

				</table>

				<br/>

				

			<p><strong>Please login at the following url : <a href=\"{$site_url}admin.php\">{$site_url}admin.php </a> </strong></p>

			<p>

			

			

			Kind regards

			

			</p>

			<p>

			

			<strong>safetybugtraining.com</strong>

			

			</p>

			

			</td>

			

			</tr>

			<tr>

			<td>

			<img src=\"{$site_url}/images/footer.jpg\" width=\"600\" height=\"37\" alt=\"SafetyBugTraining.com\"/>

			</td>

			</tr>

			</table>

			</body>

			

			</html>";

			

	$subject  = 'Your Administrator Account Details';



    send_email($_POST['email'], AUTOMATED_EMAIL, SMTP_HOST, SMTP_PORT, SMTP_USER, SMTP_PASS, COMPANY_NAME, $subject, $email_content);



  }

}



$email_user = $_SESSION['admin_username'];



if (isset($_GET['filter_by'])) {

  $_SESSION['filter_by'] = $_GET['filter_by'];

}



if (isset($_GET['order_by'])) {

  $_SESSION['order_by'] = $_GET['order_by'];

}





$filter_by = isset($_SESSION['filter_by']) ? $_SESSION['filter_by'] : '';

$order_by = isset($_SESSION['order_by']) ? $_SESSION['order_by'] : '';





?>





<?php include('header.php'); ?>



<section class="header header-style2" style="background:linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.4)), url(images/img_04.jpg) 50% 50% ; background-size:cover;">

    <div class="header-content">

        <h1>ADMINISTRATION</h1>

    </div>

</section>













<!-- Site Admin -->



<?php if (isset($_SESSION["site_admin"]) && (int) $_SESSION["site_admin"]) { ?>

  <form method="get">

      <p>Filter results:</p>

      <select id="site-select" name="filter_by"  class="site-select dropdown" >

          <option value="">Order Number</option>

          <option value="name"<?php if (isset($filter_by) && $filter_by == 'name') echo ' selected="selected"'; ?>>Name</option>

          <option value="split"<?php if (isset($filter_by) && $filter_by == 'split') echo ' selected="selected"'; ?>>Split-by-Site</option>

          <?php

          $sites = array();

          $sql_site = "SELECT * FROM site WHERE order_number='" . $_SESSION['order_number'] . "' ORDER BY site";

          $query_site = mysql_query($sql_site);

          ?>

  <?php $i = 0;

  while ($row = mysql_fetch_assoc($query_site)) {

    ?>

            <option value="<?php echo $row['id'] ?>"<?php if (isset($filter_by) && $filter_by == $row['id']) echo ' selected="selected"'; ?>><?php echo $row['site'] ?></option>



    <?php $sites[$row['id']] = $row;

  }

  ?>

      </select>



  </form>

  <p></p>

  <form method="get">

      <p>Sort results:</p>

      <select id="order_by" name="order_by"   class="dropdown" >	

          <option value="fname"<?php if (isset($order_by) && $order_by == 'fname') echo ' selected="selected"'; ?>>First Name (Alphabetically)</option>

          <option value="name"<?php if (empty($order_by) || $order_by == 'name') echo ' selected="selected"'; ?>>Last Name (Alphabetically)</option> <!-- default -->

          <option value="activation"<?php if (isset($order_by) && $order_by == 'activation') echo ' selected="selected"'; ?>>Activation Date</option>

      </select>

  </form>

  <p></p>



<?php } ?>





<!-- Normal admin -->



<?php

$order_number = explode("-", $order_number);

$order_number[1] = "%";

$order_number = implode("-", $order_number);

$ss__order_number = $order_number;

if (!(int) $_SESSION["site_admin"])

  $filter_by = '';

if (!empty($filter_by) && $filter_by != 'split' && $filter_by != 'name' && !(int) $filter_by)

  $filter_by = '';



if (!empty($order_by) && $order_by != 'activation' && $order_by != 'fname')

  $order_by = '';



if ($order_by == 'activation')

  $order_by = " activated DESC, date_activated ASC ";

elseif ($order_by == 'fname')

  $order_by = " if(name = '' or name is null,1,0), name ASC ";

else

  $order_by = " if(name = '' or name is null,1,0), substring_index(TRIM(name), ' ', -1) ";





  

  

  

/////////////////////////     Pagination      /////////////////////////////



if (isset($_SESSION["pagination"]) && (int) $_SESSION["pagination"]) 

{      



if (isset($_GET['orderNumberSelect'])) {

  $_SESSION['orderNumberSelect'] = $_GET['orderNumberSelect'];

} else



{

  $_SESSION['orderNumberSelect'] = mysql_result(mysql_query("SELECT `order_number` FROM `sign-up` WHERE `order_number` LIKE '" . str_replace('SBT', '%', $order_number) . "' ORDER BY SUBSTRING_INDEX(order_number, '-', -2) DESC LIMIT 1"),0);

}



$orderNumberSelect = isset($_SESSION['orderNumberSelect']) ? $_SESSION['orderNumberSelect'] : '';







$s = mysql_query("SELECT `order_number` FROM `sign-up` WHERE `order_number` LIKE '" . str_replace('SBT', '%', $order_number) . "' ORDER BY SUBSTRING_INDEX(order_number, '-', -2) DESC");

?> 

   <form method="get" >

      <p>Order Number:</p>

      <select id="orderSelect" name="orderNumberSelect"   class="dropdown" >

<?php

		while ($r = mysql_fetch_assoc($s)) {

?> 



<option value="<?php echo $r['order_number'];?>" <?php if (isset($orderNumberSelect) && $orderNumberSelect ==  $r['order_number']) echo 'selected="selected"'; ?>><?php echo $r['order_number'];?></option>

 <?php   } ?> 

      </select>

  </form>

  <?php 

 

$tbl_name="user";		//your table name

	// How many adjacent pages should be shown on each side?

	$adjacents = 3;

	

	/* 

	   First get total number of rows in data table. 

	   If you have a WHERE clause in your query, make sure you copy it here.

	*/

    $order_by = " if(name = '' or name is null,1,0), substring_index(TRIM(name), ' ', -1) ";

	$query = "SELECT COUNT(*) as num FROM $tbl_name  WHERE `order-number` = '". $_SESSION["orderNumberSelect"] ."' ORDER BY $order_by  ";

	$total_pages = mysql_fetch_array(mysql_query($query));

	$total_pages = $total_pages['num'];

	

	/* Setup vars for query. */

	$targetpage = "admin-serials.php"; 	//your file name  (the name of this file)

	$limit = 100; 								//how many items to show per page

		if (isset($_GET['page']))  

		{

	$page = $_GET['page'];

		} else {	$page = "";}

	if($page) 

		$start = ($page - 1) * $limit; 			//first item to display on this page

	else

		$start = 0;	

	

	/* Get data. */

	$sql = "SELECT * FROM $tbl_name   WHERE `order-number` = '". $_SESSION["orderNumberSelect"] ."' ORDER BY $order_by LIMIT $start, $limit";

	$data = mysql_query($sql);

    $NumberRows = mysql_num_rows($data);

	

	/* Setup page vars for display. */

	if ($page == 0) $page = 1;					//if no page var is given, default to 1.

	$prev = $page - 1;							//previous page is page - 1

	$next = $page + 1;							//next page is page + 1

	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.

	$lpm1 = $lastpage - 1;						//last page minus 1

	

	/* 

		Now we apply our rules and draw the pagination object. 

		We're actually saving the code to a variable in case we want to draw it more than once.

	*/

	$pagination = "";

	if($lastpage > 1)

	{	

		$pagination .= "<div class=\"pagination\">";

		//previous button

		if ($page > 1) 

			$pagination.= "<a href=\"$targetpage?orderNumberSelect=". $_SESSION["orderNumberSelect"] ."&page=$prev\">&laquo; Previous</a>";

		else

			$pagination.= "<span class=\"disabled\">&laquo; Previous</span>";	

		

		//pages	

		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up

		{	

			for ($counter = 1; $counter <= $lastpage; $counter++)

			{

				if ($counter == $page)

					$pagination.= "<span class=\"current\">$counter</span>";

				else

					$pagination.= "<a href=\"$targetpage?orderNumberSelect=". $_SESSION["orderNumberSelect"] ."&page=$counter\">$counter</a>";					

			}

		}

		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some

		{

			//close to beginning; only hide later pages

			if($page < 1 + ($adjacents * 2))		

			{

				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)

				{

					if ($counter == $page)

						$pagination.= "<span class=\"current\">$counter</span>";

					else

						$pagination.= "<a href=\"$targetpage?orderNumberSelect=". $_SESSION["orderNumberSelect"] ."&page=$counter\">$counter</a>";					

				}

				$pagination.= "...";

				$pagination.= "<a href=\"$targetpage?orderNumberSelect=". $_SESSION["orderNumberSelect"] ."&page=$lpm1\">$lpm1</a>";

				$pagination.= "<a href=\"$targetpage?orderNumberSelect=". $_SESSION["orderNumberSelect"] ."&page=$lastpage\">$lastpage</a>";		

			}

			//in middle; hide some front and some back

			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))

			{

				$pagination.= "<a href=\"$targetpage?orderNumberSelect=". $_SESSION["orderNumberSelect"] ."&page=1\">1</a>";

				$pagination.= "<a href=\"$targetpage?orderNumberSelect=". $_SESSION["orderNumberSelect"] ."&page=2\">2</a>";

				$pagination.= "...";

				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)

				{

					if ($counter == $page)

						$pagination.= "<span class=\"current\">$counter</span>";

					else

						$pagination.= "<a href=\"$targetpage?orderNumberSelect=". $_SESSION["orderNumberSelect"] ."&page=$counter\">$counter</a>";					

				}

				$pagination.= "...";

				$pagination.= "<a href=\"$targetpage?orderNumberSelect=". $_SESSION["orderNumberSelect"] ."&page=$lpm1\">$lpm1</a>";

				$pagination.= "<a href=\"$targetpage?orderNumberSelect=". $_SESSION["orderNumberSelect"] ."&page=$lastpage\">$lastpage</a>";		

			}

			//close to end; only hide early pages

			else

			{

				$pagination.= "<a href=\"$targetpage?orderNumberSelect=". $_SESSION["orderNumberSelect"] ."&page=1\">1</a>";

				$pagination.= "<a href=\"$targetpage?orderNumberSelect=". $_SESSION["orderNumberSelect"] ."&page=2\">2</a>";

				$pagination.= "...";

				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)

				{

					if ($counter == $page)

						$pagination.= "<span class=\"current\">$counter</span>";

					else

						$pagination.= "<a href=\"$targetpage?orderNumberSelect=". $_SESSION["orderNumberSelect"] ."&page=$counter\">$counter</a>";					

				}

			}

		}

		

		//next button

		if ($page < $counter - 1) 

			$pagination.= "<a href=\"$targetpage?orderNumberSelect=". $_SESSION["orderNumberSelect"] ."&page=$next\">Next &raquo;</a>";

		else

			$pagination.= "<span class=\"disabled\">Next &raquo;</span>";

		$pagination.= "</div>\n";		

	}



    $sql = "SELECT count(serial) as total_active FROM `user` WHERE activated='yes' AND `order-number`='". $_SESSION["orderNumberSelect"] ."'";

    $initial_query = mysql_query($sql) or die("SQL error");

    $numrows = mysql_result($initial_query, 0, 'total_active');

			

    ?>

                   <h4 class="center"><?php echo $start ?>-<?php echo $start + $NumberRows ?> of <?php echo $total_pages ?> serials (<?php echo $numrows; ?> active)</h4>     

   <!-- include table -->

<?php include('process/admin-serial-table.php'); ?>

<div style="float:left; width:100%;">

<?=$pagination?>

</div>

	

	<?php 

// close if statement

}















/////////////////////////        default display (order by Order Number)       /////////////////////////////





elseif (empty($filter_by))

{



   $s = mysql_query("SELECT * FROM `sign-up` WHERE `order_number` LIKE '" . str_replace('SBT', '%', $order_number) . "' ORDER BY SUBSTRING_INDEX(order_number, '-', -2) ASC");

  while ($r = mysql_fetch_assoc($s)) {

    if(strpos($r['order_number'],'RES-') !== false) {

      ?>

      <h4 class="center"><?php echo $r['Serial_Purchase'];?> Serials (Resit)</h4>

      <table  class="admin-serials" >

        <tr style="border-bottom:1px solid #C7C7C7;">

            <td class="admin-border-right">Order #</td>

        </tr>

        <tr>

            <td class="admin-border-right"><?php echo $r['order_number'];?></td>

        </tr>

      </table>

      <?php

    } else {

    $sql = "SELECT * FROM `user` WHERE `order-number` ='" . $r['order_number'] . "' ORDER BY $order_by";

    $data = mysql_query($sql) or die(mysql_error());

    $sql = "SELECT count(serial) as total_active FROM `user` WHERE activated='yes' AND `order-number`='" . $r['order_number'] . "'";

    $initial_query = mysql_query($sql) or die("SQL error");

    $numrows = mysql_result($initial_query, 0, 'total_active');

    $count = mysql_num_rows($data);

    ?>



    <h4 class="center"><?php echo $count ?> Serials / <?php echo $numrows; ?> Active </h4>

   <!-- include table -->

<?php include('process/admin-serial-table.php'); ?>

    <?php

    }

  }

}  





/////////////////////////       order by name   /////////////////////////////

elseif ($filter_by == 'name') {

  $check_all = NULL;

  $sql = "SELECT * FROM `user` WHERE `order-number` LIKE '" . str_replace('SBT', '%', $order_number) . "' ORDER BY $order_by";

  $data = mysql_query($sql) or die(mysql_error());

  $sql = "SELECT count(serial) as total_active FROM `user` WHERE activated='yes' AND `order-number` LIKE '" . str_replace('SBT', '%', $order_number) . "'";

  $initial_query = mysql_query($sql) or die("SQL error");

  $numrows = mysql_result($initial_query, 0, 'total_active');

  $count = mysql_num_rows($data);

  ?>



  <h4 class="green"><?php echo $count ?> Serials / <?php echo $numrows; ?> Active </h4>

   <!-- include table -->

<?php include('process/admin-serial-table.php'); ?>



  <?php

} 

/////////////////////////     split by site    /////////////////////////////

     elseif ($filter_by == 'split') {

  // get all sites

  if (isset($sites) && is_array($sites)) {

    $filter_sites = $sites;

    $filter_sites[] = array('id' => 0, 'site' => 'Site Unallocated');

    $filter_sites[] = array('id' => -1, 'site' => 'Unactivated');

    foreach ($filter_sites as $site) {

      // get site serials

      $sql = "SELECT * FROM `user` WHERE `order-number` LIKE '" . str_replace('SBT', '%', $order_number) . "' " . ($site['id'] >= 0 ? " AND site_id = '" . $site['id'] . "' AND activated='yes'" : " AND activated='No'") . " ORDER BY $order_by";

      $data = mysql_query($sql) or die(mysql_error());

      $count = mysql_num_rows($data);

      ?>

   

      <h4 class="center"><?php echo $site['site'] ?> - <?php echo $count ?> Serials</h4>

      <?php

      if ($count) {

        ?>

   <!-- include table -->

<?php include('process/admin-serial-table.php'); ?>



        <?php

      } else {

        echo '<p style="text-align:center">No Serials Found</p>';

      }

	  

	  

    }

  }

} 



/////////////////////////    individual site    /////////////////////////////



elseif ((int) $filter_by) {

  $sql = "SELECT * FROM site WHERE id='" . (int) $filter_by . "' LIMIT 1";

  $query = mysql_query($sql);



  if (mysql_num_rows($query)) {



    $site = mysql_fetch_assoc($query);



    // get site serials

    $sql = "SELECT * FROM `user` WHERE `order-number` LIKE '" . str_replace('SBT', '%', $order_number) . "' AND site_id = '" . (int) $filter_by . "' AND activated='yes' ORDER BY $order_by";

    $data = mysql_query($sql) or die(mysql_error());

    $count = mysql_num_rows($data);

    ?>

   

    <h4 class="green"><?php echo $site['site'] ?> - <?php echo $count ?> Serials</h4>

    <?php

    if ($count) {

      ?>

   <!-- include table -->

<?php include('process/admin-serial-table.php'); ?>

      <?php

    } else {

      echo '<p style="text-align:center">No Serials Found</p>';

    }

	



  }

}

?>









<!--  bottom admin items  -->



<?php if ($_SESSION["admin_type"] != "Additional") { ?>

  <h4 class="center">Additional Serials</h4>

  <?php 

 

  $order_number = $_SESSION['order_number'];

//echo "$order_number";

  ?>

 <form method="post" action="paypal.php"> 

  <div style="margin:auto; text-align:center; ">

      <input  type="submit"  value="Purchase"  class="log-button">

      <!-- <p class="additional-serials">Add serials to your account</p>  -->

  </div><br/>

  

<?php } ?>

  </form>

  

    <h4 class="center">Course Progress</h4>

       <div style="margin:auto; text-align:center; ">  

      <input type="button"  onclick="window.location.href='generate-report.php'"  value="Print Report"  class="log-button">

    </div><br/>

      

    <h4 class="center">Download English Q/A</h4>

       <div style="text-align:center;">  

	<select id="courseSelect" class="dropdown" style="width:30%;" >

<?php $sql_course = "SELECT * FROM course ORDER BY course_ID"; $courseSelect = mysql_query($sql_course); ?>

<?php while($row = mysql_fetch_assoc($courseSelect)) { ?>

<option value="<?php echo $row['course_ID'] ?>"><?php echo $row['course_name'] ?></option>

<?php } ?>

</select>     



<input id="allergenQA" type="button"  onclick="window.open('course/allergen/download/Allergen.pdf');"  value="Download"  class="log-button" style="display:none;">

<input id="fsl2QA" type="button"  onclick="window.open('course/fsl2/download/FoodSafetyLevel2.pdf');"  value="Download"  class="log-button">

 </div>

	

	<br/>

    

    

<?php if (isset($_SESSION["admin_type"]) && $_SESSION["admin_type"] == "main") { ?>

  <form method ="post" style="margin:0">

      <h4 class="center">Additional Administrators</h4>







      <table  class="admin-serials"  style="margin:0" >

          <tr style="border-bottom:1px solid #C7C7C7;">

              <td  class="admin-border-right">Name</td>

              <td  class="admin-border-right">Position</td>

              <td  class="admin-border-right">Username</td>

              <td  class="admin-border-right">Password</td>

              <td  class="admin-border-right">Date Created</td>

              <td style="padding:10px">Select</td>

          </tr>

          <?php

          $fetch_admin = "select * from login WHERE Order_Number = '" . $order_number . "'";

          $new_admin = mysql_query($fetch_admin) or die(mysql_error());

          $count = mysql_num_rows($new_admin);

          while ($new = mysql_fetch_array($new_admin)) {

            echo '<tr>

	<td  class="admin-border-right">' . $new['Name'] . '</td>

	<td  class="admin-border-right">' . $new['Position'] . '</td>

	<td  class="admin-border-right">' . $new['Email'] . '</td>';

	if(isset($_POST['password']) && $new['ID'] == $lastid){

    	echo '<td  class="admin-border-right">'.$_POST['password'].'</td>';

	}else{

    	echo '<td  class="admin-border-right">***********</td>';

	}

		echo '<td  class="admin-border-right">' . $new['Date_Created'] . '</td>';

            ?>

            <td  class="download"><input name="checkbox[]" type="checkbox" id="checkbox[]" value="<?php echo $new['ID']; ?>"></td>

            <?php

            echo '</tr>';

          }

          if (!mysql_num_rows($new_admin)) {

            echo '<tr><td colspan="6">No Additional Administrators</td></tr>';

          }

          ?>

      </table>

      <div>	

          <p style="text-align:center;">

              <input id="my-button" name="add" type="button" value="Add New"  class="log-button" />

              <input name="delete" type="submit" id="delete" value="Delete Selected"   class="log-button"  >

              <input id="cancel-button"  type="button" value="Cancel" style=" display:none;"   class="log-button"  /></p>

      </div>

  </form>

  <script>

    $(document).ready(function(){

      $('#add_new_admin').hide();

      $('#my-button').click(function() { $('#add_new_admin').show(); $('#cancel-button').show(); });

      $('#cancel-button').click(function() { $('#add_new_admin').hide(); $('#cancel-button').hide(); });

    });</script>

  <script>

    var numErrors = 0;

    $(document).ready(function() {

    // validate order form

    $("#add_new_admin form").validate({

    highlight: function(element, errorClass, validClass) {

    $(element).css("borderColor", "#ff0000");

    if ($(element).data("hightlighed") == "1") {



    } else {

    $(element).data("hightlighed", 1);

    numErrors++;

    }

    $('#required-note').show();

    },

            unhighlight: function(element, errorClass, validClass) {

            $(element).css("borderColor", "");

            if ($(element).data("hightlighed") == "1") {

            $(element).data("hightlighed", 0);

            numErrors--;

            }

            if (!numErrors)

                    $('#required-note').hide();

            },

            rules: {

            name: "required",

                    position: "required",

                    required	: true,

                    email 		: true

            },

            messages: {

            name: "",

                    position: "",

                    email : ""

            }

    });

    });</script>

  <div id="add_new_admin" style="display:none;">

      <form method="post">

          <table   style="background:#F7F7F7;margin:0" >

              <tr>

                  <td>*Name:<br/><input id="name" name="name" type="text" class="required"   /></td>

                  <td>*Position:<br/><input id="position" name="position" class="required" type="text"  /></td>

                  <td>*E-mail (Username):<br/><input id="email" name="email" type="text" class="email required"  /></td>

                  <td>Password (automatic)<br/><input name="password" type="text"  value="<?php $password = generateAdminPassword();

          echo $password;

          ?>" readonly="readonly"/></td>

              </tr>



          </table>

          <p id="required-note" style="display:none; font-weight:bold">

              Please complete all fields correctly</p>

          <div style="width:100%;  background:#F7F7F7">

              <input type="submit" value="Confirm and Create"   class="log-button" />

              <input type="hidden" value="<?php echo $password;?>" name="the_new_password"    />

              <p style="color:#ff0000">NB: This will create the new log-in and send email to the new administrator (excluding the password). You will see the password on the screen and must communicate this to the new administrator. <strong>The new password will only be shown once - if you navigate away they will have to reset their password</strong></p>



          </div>



      </form>

  </div>

<?php } ?>     

<p></p>





<script>

  $(document).ready(function(){

    $('#add_new_site').hide();

    $('#my-button-site').click(function() { $('#add_new_site').show(); $('#cancel-button-site').show(); });

    $('#cancel-button-site').click(function() { $('#add_new_site').hide(); $('#cancel-button-site').hide(); });

  });</script>



<script>

  var numErrors = 0;

		$(document).ready(function() {

			// validate order form

			$("#add_new_admin form").validate({

				highlight: function(element, errorClass, validClass) {

				$(element).css("borderColor", "#ff0000");	

					if($(element).data("hightlighed") == "1") {

						

					} else {

						$(element).data("hightlighed", 1);

						numErrors++;

					}

					$('#required-note').show();

				},

				unhighlight: function(element, errorClass, validClass) {

					$(element).css("borderColor", "");	

					if($(element).data("hightlighed") == "1") {

						$(element).data("hightlighed", 0);

						numErrors--;

					}

					if (!numErrors)

						$('#required-note').hide();

				},

				rules: {

					name: "required",

					position: "required",		

					required	: true,

					email 		: true		

				},

				messages: {			

					name: "",

					position: "",						

					email : ""

				}

			});	

		});

  </script>



<?php if (isset($_SESSION["site_admin"]) && (int) $_SESSION["site_admin"] && $_SESSION["admin_type"] == "main") { ?>

  <h4 class="center">Site Admin</h4>

  <form  method="post" id="delete_site">

      <table  class="admin-serials" style="margin:0" >

          <tr style="border-bottom:1px solid #C7C7C7;">

              <td class="admin-border-right">Site</td>

              <td class="admin-border-right">Select</td>

          </tr>

          <tbody id="sites_list">

              <?php if (isset($sites) && is_array($sites)) {

                foreach ($sites as $row) {

                  ?>

                  <tr>

                      <td class="admin-border-right"><?php echo $row['site'] ?></td>

                      <td style="padding:10px"><input name="delete_site[]" type="checkbox" id="site_<?php echo $row['id'] ?>" value="<?php echo $row['id'] ?>"></td>

                  </tr>

      <?php

      $i++;

    }

  }

  ?>

          

          

  <?php if (!mysql_num_rows($query_site)) { ?>

                <tr>

                    <td colspan="10">No Sites Added</td>

                </tr>

  <?php } ?>

          </tbody>

      </table>       



      <div><p style="text-align:center;">



              <input id="my-button-site" name="add" type="button" value="Add New"   class="log-button"   />

              <input name="delete-site" type="submit" id="delete" value="Delete Selected"   class="log-button">

              <input id="cancel-button-site"  type="button" value="Cancel" style=" display:none;"    class="log-button"/>

        </p>

      </div>

  </form>



  <div id="add_new_site" style="display:none;">

      <form method="post" id="add_site">

          <table   style="background:#F7F7F7;margin:0" >

              <tr>

                  <td>*Site:<input  name="site" type="text"  class="required" /></td>

              </tr>



          </table>

          <p id="required-note2" style="display:none;">

              Please enter the new site</p>

          <div style="width:100%;  background:#F7F7F7">

              <input  type="submit" value="Confirm new site"   class="log-button" />

          </div>



      </form>

  </div>



  <script>

      <!--

      $(document).ready(function() {

			$('#add_site').submit(function() {

			$('#add_new_site').hide();

				$('#cancel-button-site').hide();

				$('#sites_list tfoot').hide();

				

				jQuery.post('process/update-sites.php', $('#add_site').serialize(), function(data) {

					$('#sites_list').html(data);

					$('#siteSelectid2').load('process/update-sites.php?mode=select2&selected=<?php if (isset($_GET['filter_by'])) echo $_GET['filter_by']; ?>');

                                        //$('#site-select').load('process/update-sites.php?mode=select&selected=<?php if (isset($_GET['filter_by'])) echo $_GET['filter_by']; ?>');

				});

                                

				

				return false;

			});

			

			$('#delete_site').submit(function() {

				if (window.confirm('Are you sure you want to delete them?')) {

					jQuery.post('process/update-sites.php', $('#delete_site').serialize(), function(data) {

						$('#sites_list').html(data);

					$('.site-select').load('process/update-sites.php?mode=select&selected=<?php if (isset($_GET['filter_by'])) echo $_GET['filter_by']; ?>');

					});

				}

				

				return false;

			});

		});

      //-->

  </script>

    

<?php } ?>





  

  

          

<?php   if (isset($_SESSION["admin_type"]) && $_SESSION["admin_type"] == "main") {     ?>

      

  <h4 class="center">Certificate E-mail</h4>



  <div style="background:#F7F7F7; margin:auto; text-align:center">



      <form  method="post" id="update_cc" >



          <p style="text-align:center;">

              <!-- Duplicate Certificate/Activation E-mail to:<br/> -->

              <input name="cc_email"  type="text"  value="<?php echo!empty($_SESSION["cc-email"]) ? $_SESSION["cc-email"] : $_SESSION['admin_username']; ?>" style="width:30%"  />

              <input id="my-button" name="add" type="submit" value="Update"   class="log-button"  /> 

              <input id="reset-cc" name="add" type="button" value="Set to default"  class="log-button"  /></p>

      </form>

      <p style=" display:none" id="cc_update_message">Certificate E-mail updated successfully</p>

  </div>

  <p style="border:#C7C7C7 1px solid; border-radius:3px;margin:auto; width:60%; text-align:center; font-weight:bold;  margin-top:1.5em; margin-bottom: 1.5em; padding:2em">NB: If Certificate or Activation E-mail does not arrive, please check your junk/spam folder and ensure 'no-reply@safetybugtraining.com' is marked as safe sender.</p>

  <script>

  <!--

  $(document).ready(function() {

		$('#reset-cc').click(function() {

			$(this).siblings('input[name="cc_email"]').val('<?php echo $_SESSION['admin_username'] ?>');

			$('#update_cc').submit();

			

			return false;

		});

		

		$("#update_cc").validate({

			highlight: function(element, errorClass, validClass) {

				$(element).parent().css("backgroundColor", "#4F6E55");

				if($(element).data("hightlighed") == "1") {

					

				} else {

					$(element).data("hightlighed", 1);

					numErrors++;

				}

				$('#required-note2').show();

			},

			unhighlight: function(element, errorClass, validClass) {

				$(element).parent().css("backgroundColor", "");

				if($(element).data("hightlighed") == "1") {

					$(element).data("hightlighed", 0);

					numErrors--;

				}

				if (!numErrors)

					$('#required-note2').hide();

			},

			rules: {

				cc_email: {

					required: true,

					email: true

				}	

			},

			messages: {			

				cc_email: ""

			},

			submitHandler: function() { 

				jQuery.post('process/update-cc.php', $('#update_cc').serialize(), function(data) {

					$('#cc_update_message').show();

					setTimeout(function() {$("#cc_update_message").fadeOut()}, 5000);

					$('input[name="cc_email"]').val(data);

				});

				

				return false;

			}

		});	

    $("#updt-button").click(function(){

      jQuery.post('process/update-reminder.php', $('#frm-reminder').serialize(), function(data) {

        $('#updt-reminder-message').html(data);

      

					$('#updt-reminder-message').show();				

          setTimeout(function() {$("#updt-reminder-message").fadeOut()}, 5000);

				});

    });

	});

      //-->

    	</script>

       

<?php  }   ?>



<!--  E-mail Notifications  -->

<?php $msg = '';

if (isset($_SESSION["site_admin"]) && (int) $_SESSION["site_admin"] && $_SESSION["admin_type"] == "main") { 

//delete site email

if (isset($_POST['checkbox']) ) {

  foreach ($_POST['checkbox'] as $del_siteEmail) {

    $sql = "DELETE FROM `redirects` WHERE siteID=' " . $del_siteEmail . " ' ";

    $result = mysql_query($sql) or die(mysql_error());  }  }

//add site email	

if (count($_POST) && isset($_POST['siteEmailSelect'])) {

   $email_post = $_POST['siteEmail'];

   $selectOption = $_POST['siteEmailSelect'];

   

   $enrs = mysql_num_rows(mysql_query("select siteID from redirects where siteID='".$selectOption."' and order_number='".$order_number."'"));

   if($enrs == 0){

        $sql = "INSERT INTO `redirects` (siteID,order_number,email) VALUES ('$selectOption','$order_number','$email_post')";

        mysql_query($sql) or die(mysql_error()); 

          header("Location: ".basename($_SERVER['REQUEST_URI']));die;

   }else{

       $msg = "This email id already added in redirect";

   }



 }

  ?>

      <form method="post" id="add_site_email">

 <h4 class="center">Certificate E-mail Redirects</h4>

 <div style="text-align: center; color: #FF0000;"><?=$msg?></div>

      <table  class="admin-serials" style="margin:0" >

          <tr style="border-bottom:1px solid #C7C7C7;">



              <td class="admin-border-right">Site</td>

                            <td class="admin-border-right">Email</td>

                         <td class="admin-border-right">Select</td>

          </tr>



          <?php

          $fetch_admin_siteEmail = "select *,site.site from `redirects` inner join site on site.id=redirects.siteID WHERE redirects.order_number = '" . $order_number . "'";

          $new_admin_siteEmail = mysql_query($fetch_admin_siteEmail) or die(mysql_error());

          $count_siteEmail = mysql_num_rows($new_admin_siteEmail);

          while ($new_siteEmail = mysql_fetch_array($new_admin_siteEmail)) {

            echo '<tr>

	<td  class="admin-border-right">' . $new_siteEmail['site'] . '</td>

	<td  class="admin-border-right">' . $new_siteEmail['email'] . '</td>';

            ?>

             <td style="padding:10px"><input name="checkbox[]" type="checkbox" id="checkbox[]" value="<?php echo $new_siteEmail['siteID']; ?>"></td>

            <?php

            echo '</tr>';

          }

          if (!mysql_num_rows($new_admin_siteEmail)) {

            echo '<tr><td>No Certificate Redirects</td><td></td><td></td></tr>';

          }

          ?>

          </table>

      <div><p style="text-align:center;">



              <input id="my-button-site-email" name="add" type="button" value="Add New"   class="log-button"   />

              <input name="delete-site-email" type="submit" id="delete" value="Delete Selected"   class="log-button">

              <input id="cancel-button-site-email"  type="button" value="Cancel" style=" display:none;"    class="log-button"/>

     </p>  

      </div></form>

      

            <div id="add_new_site_email" style="display:none;">

      <form method="post" id="add_site">

          <table   style="background:#F7F7F7;margin:0" >

              <tr>

                  <td>*Site:     <?php 

$ord_id = $_SESSION['order_number'];



$sites_fetch = mysql_query("SELECT * FROM `site` where `order_number` =  '$ord_id' order by `id` ASC");

?>

                      <select id="siteSelectid2"  name="siteEmailSelect"  class="dropdown" required>



                      <?php

if (mysql_num_rows($sites_fetch)){



?>

  

<option value="" >Choose Site</option> 



<?php while ($row = mysql_fetch_assoc($sites_fetch)) { ?>

           <option value="<?php echo $row['id']; ?>"><?php echo $row['site']; ?></option>

<?php } ?>       



   <!--  <option value="Unallocated">Unallocated</option>  -->

          <?php } ?>

                      </select></td>

           <td>*E-mail:<br/><input id="siteEmail" name="siteEmail" type="text" class="email required"  /></td>

              </tr>



          </table>

          <p id="required-note2" style="display:none;">

              Please enter the new site</p>

          <div style="width:100%;  background:#F7F7F7">

              <input  type="submit" value="Confirm new E-mail Redirect"   class="log-button" />

          </div>



      </form>

  </div>

  <script>

  $(document).ready(function(){

    $('#add_new_site_email').hide();

    $('#my-button-site-email').click(function() { $('#add_new_site_email').show(); $('#cancel-button-site-email').show(); });

    $('#cancel-button-site-email').click(function() { $('#add_new_site_email').hide(); $('#cancel-button-site-email').hide(); });

  });</script>

  <script>

  var numErrors = 0;

		$(document).ready(function() {

			// validate order form

			$("#add_new_site_email form").validate({

				highlight: function(element, errorClass, validClass) {

				$(element).css("borderColor", "#ff0000");	

					if($(element).data("hightlighed") == "1") {

						

					} else {

						$(element).data("hightlighed", 1);

						numErrors++;

					}

					$('#required-note').show();

				},

				unhighlight: function(element, errorClass, validClass) {

					$(element).css("borderColor", "");	

					if($(element).data("hightlighed") == "1") {

						$(element).data("hightlighed", 0);

						numErrors--;

					}

					if (!numErrors)

						$('#required-note').hide();

				},

				rules: {

						siteEmail 		: true		

					

				},

				messages: {			

				siteEmail : "",

				siteEmailSelect: ""

				}

			});	

		});

  </script>

<?php } ?>















<script>



    $(document).ready(function() {

      $('#site-select, #order_by, #orderSelect').change(function() {

        $(this).parent('form').submit();

      });

    /* download button change function */

        $('#courseSelect').change(function() 

		{

		

        if ( this.value == '1' ) {

        $('#allergenQA').hide();

		    $('#fsl2QA').show();

        } 

        if ( this.value == '2' ) 

		{

        $('#allergenQA').show();

		    $('#fsl2QA').hide();

		}

	

	  });

	

    });

	

	

	

	

	

	



</script>

    

<!-- wrapper -->

<?php include('footer.php') ?>