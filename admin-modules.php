<?php include('config.php'); ?>

<?php
if (!isset($_SESSION["admin_username"]) || !isset($_SESSION["admin_fullname"])) {

    header("location:admin.php");

    exit;
}
?>



<?php
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM `user_attempts` WHERE `user_id` =" . $_GET['x'] . " order by `attempt_time`,	`module` ";
$data = mysql_query($sql) or die(mysql_error());


$sql = "SELECT count( `module` ) AS total_attempts FROM `user_attempts` WHERE `user_id` = " . $_GET['x'] . " GROUP BY `module` ORDER BY `total_attempts` DESC LIMIT 1";
$result = mysql_query($sql) or die(mysql_error());
$r = mysql_fetch_assoc($result);

$sql = "select * from `user` where `ID`=" . $_GET['x'] . "";
$res = mysql_query($sql) or die(mysql_error());
$sname = mysql_fetch_assoc($res);

if (isset($_GET['force_download'])) {
    $getCertDate = mysql_query("SELECT `date_activated` FROM `user` WHERE `ID` = '" . $_GET['x'] . "' ");
    $date = mysql_result($getCertDate, 0);
    $date = strtotime($date);
    $date = date('d-m-Y', $date);
    $pdf_file = 'temp/' . (str_replace(' ', '_', $sname['name'])) . '-' . date('d-m-Y') . '.pdf';
    generate_pdf($sname, $pdf_file, $date);
    header('Content-disposition: attachment; filename=' . (str_replace(' ', '_', $sname['name'])) . '-' . date('d-m-Y') . '.pdf');
    header('Content-type: application/pdf');
    readfile($pdf_file);
}


?>
<?php include('header2.php'); ?>
<link type="text/css" rel="stylesheet" href="css/main.css"/>
<main class="main-content-wrap2">
    <!-- Start Default Table Area -->
    <div class="default-table-area">
        <div class="container-fluid">


            <div class="card-box-style">
                <div class="others-title">
                    <h2 style="text-align: center;"><?php
                                                    echo ucfirst($sname['name']);
                                                    ?></h2>
                                                     <?php   if (!mysql_num_rows($data))   
       { 
echo "No attempts found";
       } else {   ?>

                </div>

                <table class="table table-bordered ">
                    <thead>
                        <!-- <tr>
                            <th scope="col">#</th>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Handle</th>
                        </tr> -->
                        <tr >
                        <th scope="col">Module</th>
	<?php for($i=1;$i<=$r['total_attempts'];$i++) { ?>
        <th scope="col">Attempt#<?php echo $i ?></th>
    <?php } ?>
  </tr>
                    </thead>
                    <tbody>
                        
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
				$class='table-primary';
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
		if(($row['status']=='pass')) 
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
<?php 
}	
?>
	
	
  </div>

            </div>


        </div>
    </div>
    <div class="default-table-area">
        <div class="container-fluid">
        <?php 
$sql = "SELECT * FROM course WHERE course_ID = '".$sname['course']."'";
$resultModules = mysql_query($sql) or die(mysql_error());
$details = mysql_fetch_assoc($resultModules);

?>

	<?php  
		if($sname[$details['modules']]=="Yes"){
	?>
<form method="get">
            <div style="text-align: center;" class="card-box-style">
                <div class="others-title">
                    <h3>View certificate</h3>
                </div>

                <button name="" type="submit" id="" value="View as PDF" class="btn btn-outline-success">View as PDF</button>
                <input type="hidden" name="force_download" value="yes" />	
<input type="hidden" name="x" value="<?php echo $_GET['x'];?>" />	
            </div>

            </form>
            <?php }?>
        </div>
    </div>
    <!-- End Default Table Area -->
    <?php include('footer2.php'); ?>