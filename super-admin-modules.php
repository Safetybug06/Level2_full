<?php include('config.php'); ?>

<?php
if(!isset($_SESSION["admin_username"]) || !isset ($_SESSION["admin_fullname"])) {

	header("location:admin.php");		

	exit;

}
//$email=$_SESSION['admin_username']; 
if ($_SESSION["admin_type"] == 'super_admin') {

	$sql = "SELECT `order-number` FROM user WHERE ID='".(int)$_GET['x']."'";

	$query = mysql_query($sql);

	

	$user_details = mysql_fetch_assoc($query);

}
?>


<section class="header header-style2" style="background:linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.4)), url(images/img_04.jpg) 50% 50% ; background-size:cover;">
    <div class="header-content">
	    <h1>ADMINISTRATION</h1>
    </div>
</section>
	

<?php 
   $user_id=$_SESSION['user_id']; 
   $sql="SELECT * FROM `user_attempts` WHERE `user_id` =".$_GET['x']." order by `attempt_time`,	`module` ";
   $data = mysql_query($sql) or die(mysql_error());
   
   $sql= "SELECT count( `module` ) AS total_attempts FROM `user_attempts` WHERE `user_id` = ".$_GET['x']." GROUP BY `module` ORDER BY `total_attempts` DESC LIMIT 1"; 
   $result=mysql_query($sql) or die(mysql_error());
   $r=mysql_fetch_assoc($result);
   
   $sql="select * from `user` where `ID`=".$_GET['x']."";
   $res=mysql_query($sql) or die(mysql_error());
   $sname=mysql_fetch_assoc($res);

	if(isset($_GET['force_download'])){
	$r = mysql_query("SELECT `attempt_time` FROM `user_attempts` WHERE `user_id` = '".$_GET['x']."' ORDER BY `attempt_time` DESC");
	$date = mysql_result($r,0);
	$date = strtotime($date);
	$date = date('d-m-Y',$date);
	$pdf_file = 'temp/'.(str_replace(' ', '_', $sname['name'])).'-'.date('d-m-Y').'.pdf';	
	generate_pdf($sname,$pdf_file,$date);
	header('Content-disposition: attachment; filename='.(str_replace(' ', '_', $sname['name'])).'-'.date('d-m-Y').'.pdf');
	header('Content-type: application/pdf');
	readfile($pdf_file);

	}

   
?>

<h4 class="center"><?php echo ucfirst($sname['name']); ?></h4>

  <?php   if (!mysql_num_rows($data))   
       { 
echo "No attempts found";
       } else {   ?>
	   
	   
  <div id="tableScroll">

    <table border="0" cellspacing="0" cellpadding="8" style="font-family:arial; border:1px solid #2F4E35; margin:auto">
  <tr>
    <td class="heading">Module</td>
	<?php for($i=1;$i<=$r['total_attempts'];$i++) { ?>
    <td class="heading">Attempt#<?php echo $i ?></td>
    <?php } ?>
  </tr>
  <tr>
  <?php 
	$status=0;
	$x=1;
	$i=0;
	$items = 0;
	$result=mysql_num_rows($data);
	while($row = mysql_fetch_array($data)) {
		if($status!=$row['module'])
		{
			if ((int)$status) {
				if ($i != $r['total_attempts'])
				{
					for ($j=$i;$j<$r['total_attempts'];$j++)
					{
						echo "<td></td>";
					}
				}
			}
			
			$status = $row['module'];
			
			$x++;
			
			if($x%2==0)	{ 
				$class='even';
			} else { 
				$class='odd'; 
			}			
			
			$i=0;
					echo"</tr><tr class=\"".$class."\">";
		    if ($sname['course'] =='2' && $status =='2')
			{
			echo"<td>2 (Part1)</td>";
			}
			elseif ($sname['course'] =='2' && $status =='3')
			{
			echo"<td>2 (Part2)</td>";
			}
			elseif ($sname['course'] =='2' && $status >'3')
			{
			$statusAllergen = $status - 1;
			echo"<td> ".$statusAllergen."</td>";
			}
			
			else
			{
			echo"<td> ".$row['module']."</td>";
		    }
	 	}
		
		$items++;
		
		$class = "";
		if(($row['status']=='pass')) //($items==$result) && 
		{  
			$class='highlight'; 			
		}
		echo "<td class='".$class."' nowrap=\"nowrap\">".date('H:i \<\b\r\/\> d M, Y', strtotime($row['attempt_time']))."</td>"; 
		$i++;
	}
	if ($i && $i != $r['total_attempts'])
	{
		for ($j=$i;$j<$r['total_attempts'];$j++)
		{
			echo "<td></td>";
		}
		$i=0;
	}
  ?>
  </tr>
</table>
<?php 	}	?>


  </div>

	<?php $sql = "SELECT * FROM course WHERE course_ID = '".$sname['course']."'";
$resultModules = mysql_query($sql) or die(mysql_error());
$details = mysql_fetch_assoc($resultModules);
	if($sname[$details['modules']]=="Yes"){
	?>
<h4 class="center">View Certificate</h4>
	<form method="get">
	<div style="  text-align:center; ">

<input name="" type="submit" id="" value="View as PDF"   class="log-button">
<input type="hidden" name="force_download" value="yes" />	
<input type="hidden" name="x" value="<?php echo $_GET['x'];?>" />	

</div>
</form>
<?php }?>

<?php  include('header.php'); ?>

<?php include('footer.php') ?>