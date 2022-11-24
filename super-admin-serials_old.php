<?php include('config.php'); ?>

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
<?php include('header.php'); ?>

<section class="header header-style2" style="background:linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.4)), url(images/img_04.jpg) 50% 50% ; background-size:cover;">
    <div class="header-content">
	    <h1>SUPER ADMIN</h1>
    </div>
</section>

<form action="" method="get">
    <input name="order_number" value="<?php if (isset($_GET['order_number'])) { echo $_GET['order_number']; } ?>" type="hidden" />
	<p>Sort results:</p>
	<select id="order_by" name="order_by"   class="dropdown" >	
            <option value="fname"<?php if (isset($order_by)) { if($order_by == 'fname'){ echo ' selected="selected"'; }} ?>>First Name (Alphabetically)</option>
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

<h4 class="center"><?php echo $order_data['paypal-name'] ?>: <?php echo $count?> Serials / <?php echo $numrows ; ?> Active</h4>
  <table  class="admin-serials" >	
   <tr style="border-bottom:1px solid #C7C7C7;">
		<td class="admin-border-right">Order #</td>
		<!--<td   class="admin-border-right">Serial</td>-->
        <td class="admin-border-right">Name</td>
	    <td class="admin-border-right">Course</td>
		<td class="admin-border-right">Language</td>
		<td class="admin-border-right">Module Progress</td>
	    <td class="admin-border-right">Status</td>
        <td class="admin-border-right">Password</td>
	    </tr>
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
		$result='<a href="super-admin-serials.php?serial='.$row['serial'].'">Admin Activation <strong>' . $suffix_resit . '</a>';
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
	$link= "<a href=\"super-admin-modules.php?x=".$row['ID']."\">".$completed_modules."/" . $courseDetails['modules_admin'] . " Modules".(($completed_modules >= $courseDetails['modules_admin']) ? ' (Cert. sent)' : '');

	else
	{
		$link= " - ";
	}
	echo "<tr>";
   echo "<td  class=\"admin-border-right\">{$order_number}</td>";
 //  echo "<td  class=\"admin-border-right\">". formatserialno($row['serial'])."</td>";

      $ss__pass_active = ucwords($result) . 
                  (($row['activated'] == "yes" && strtotime($row['date_activated'])) ? ' : ' . date('d/m/y', strtotime($row['date_activated'])) 
                  . "  <a href=\"admin-serials.php?serial=" . $row['serial'] . "\">(Update)</a>" : '');
				  
          if ($i > $total_modules) {
    
                $ss__pass_active = '<span class="passed-green" >Passed: ' . date('d/m/y', strtotime($row['date_activated'])) . '</span>';
              }
              
         

       echo "<td class=\"admin-border-right\">" . mb_strimwidth($row['name'], 0, 25, "...") . "</td>";
       echo "<td class=\"admin-border-right\">" . $courseDetails['course_name'] . "</td>";
       echo "<td  class=\"admin-border-right\">" .ucwords($row['language'])."</td>";
       echo "<td  class=\"admin-border-right\">".$link."</td>";
	   echo "<td class=\"admin-border-right\">" . $ss__pass_active . "</td>";
	   
   if($row['activated']=="yes"){?>
		<td class="admin-border-right download"><a href="super-admin-serials.php?order_number=<?php echo $_GET['order_number']?>&id=<?php echo $row['ID']?>"><i class="fa fa-download"></i></a></td>
	<?php }else{
		echo "<td class=\"admin-border-right\">-</td>";
	}
	
	echo "</tr>";
$x++;	
}	

?>
   </table>

   <p></p>
   

   
   
   
<h4 class="center">Additional Administrators</h4>
  <table  class="admin-serials" >	
   <tr style="border-bottom:1px solid #C7C7C7;">
<td  class="admin-border-right">Name</td>
<td  class="admin-border-right">Position</td>
<td  class="admin-border-right">Username</td>
<td  class="admin-border-right">Password</td>
	<td style="padding:10px">Date Created</td>
	  </tr>
<?php
$fetch_admin = "select * from login WHERE Order_Number = '".$order_number."'";
$new_admin = mysql_query($fetch_admin) or die(mysql_error());
$count=mysql_num_rows($new_admin);
while($new = mysql_fetch_array($new_admin)) 
{
	echo '<tr>
<td  class="admin-border-right">'.$new['Name'].'</td>
<td  class="admin-border-right">'.$new['Position'].'</td>
<td  class="admin-border-right">'.$new['Email'].'</td>
<td  class="admin-border-right">'.$new['Password'].'</td>
<td style="padding:10px">'.$new['Date_Created'].'</td>
	</tr>';
}

if (!mysql_num_rows($new_admin)) {
	echo '<tr><td colspan="6">No Additional Administators</td></tr>';
}
?>
	</table>
</form>
	</div>
<!-- wrapper -->
<script type="text/javascript">	
<!--
	$(document).ready(function() {		
		$('#site-select, #order_by').change(function() {
			$(this).parent('form').submit();
		});
	});
	//-->
</script>
<?php include('footer.php') ?>