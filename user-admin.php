<?php include('config.php'); ?>
<?php
unset($_SESSION["returnAdmin"]);


   	if(!isset($_SESSION["username"]) && !isset($_SESSION["fullname"])) {
    header("location: log-in.php");	
   		exit;
   	}
   	$email=$_SESSION['username']; 
   	$sql = "SELECT * FROM user WHERE username='$email'";
   	$result=mysql_query($sql) or die(mysql_error());
   	$row = mysql_fetch_assoc($result);
   	if(!is_email($email)) {
	   	$first_order_number = explode("-", $row['order-number']);
	   	$first_order_number[1] = "01";
	   	$first_order_number = implode("-", $first_order_number);
	           
	    $nrsr = mysql_num_rows(mysql_query("select siteID from redirects where siteID='".$row['site_id']."'"));
		if($nrsr > 0){
	      $rres = mysql_fetch_assoc(mysql_query("select email from redirects where siteID='".$row['site_id']."'"));
	      $email = $rres['email']; 
	   	} else{
	       	$r = mysql_query("SELECT `email`, `cc-email` FROM `sign-up` WHERE `order_number`='".$first_order_number."'");
	       	$emails = mysql_fetch_assoc($r);
	       	if($emails['cc-email'] != ''){
	           $email = $emails['cc-email'];
	        }else{
	           $email = $emails['email'];
	        }
	   }
   }
?>
<?php include('header.php'); ?>
<section class="header header-style2" style="background:linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.4)), url(images/img_04.jpg) 50% 50% ; background-size:cover;">
   <div class="header-content">
      <h1>
         ASSESSMENT
      </h1>
   </div>
</section>
<div class="circle-wrapper">
   <div class="circle-container">
      <div class="numberCircle-container">
         <div class="numberCircle grey-circle">1</div>
         <p class="numberCircleType grey-type">
            Purchasing
         </p>
      </div>
      <div class="numberCircle-container">
         <div class="numberCircle grey-circle">2</div>
         <p class="numberCircleType grey-type">
            Activating
         </p>
      </div>
      <div class="numberCircle-container">
         <div class="numberCircle green-circle">3</div>
         <p class="numberCircleType green-type">
            Starting
         </p>
      </div>
   </div>
</div>
<?php 
$sql = "SELECT * FROM course WHERE course_ID = '".$row['course']."'";
$result = mysql_query($sql) or die(mysql_error());
$courseDetails = mysql_fetch_assoc($result);

//echo  $courseDetails['course'];
//echo  '<br/>'; 
//echo  $courseDetails['course_name']; 

?>



<div id="content">
   <h3 class="green">Welcome, <?php echo  ucwords($_SESSION["fullname"]); ?></h3>
   <p>You are sitting the <strong><?php echo  $courseDetails['course_name']; ?></strong> course. Below you can see there are <?php if ($courseDetails['course'] == 'allergen') echo '5'; else echo $courseDetails['modules']; ?> modules for you to complete. You must view the presentation and then answer the relevant Q/As.</p>
   <ul class="user-admin">
      <li>You must answer all Q/As correct for each module to progress</li>
      <li>If you answer any 2 questions incorrectly, you must start the module again</li>
      <li>Once you pass all <?php if ($courseDetails['course'] == 'allergen') echo '5'; else echo $courseDetails['modules']; ?> modules you will be awarded your Certificate</li>
   </ul>
   <h3 class="green">Modules</h3>

   <table  class="admin-serials" >
      <tr style="border-bottom:1px solid #C7C7C7;">
         <td class="admin-border-right center-text">Module</td>
         <td class="admin-border-right center-text">Safety Bug Training</td>
         <td style="padding:10px"  class="center-text">Status</td>
      </tr>
      <?php 

	  
         for($i=1; $i<= $courseDetails['modules']; $i++){
         	if($row[$i]=="No") {
         		$current_module=$i;
         		break;
         	}
         
         	if ($i == $courseDetails['modules']) {
         		$current_module = $courseDetails['modules'] +1;
         	}
         }
         
 $passed = 'No'; 
 if ($courseDetails['course'] == 'fsl2') {
 for($i = 1; $i <= $courseDetails['modules']; $i++): ?>
	      <tr>
	         <td class="admin-border-right  center-text"><?php echo $i ?></td>
	         <td class="admin-border-right  center-text">
	         	<?php if($i == 1 && $i == $current_module): ?>
	         		<a href="<?php echo 'course/'.$courseDetails['course'].'/'.$row['language'].'/html5/module'.$current_module ?>">Activate Assessment</a>
					
	         	<?php elseif($i == 2 && $i == $current_module): ?>	
	         		<!-- check if current language exist in split modules array -->
	         		<?php if (in_array($row['language'], $splitModules)): ?>
		         		Activate Assessment  
         <?php  if (isset($_GET['partNumber'])) {  ?> Part1 &#124; <?php  }  else    {  ?>
		         		<a href="<?php echo 'course/'.$courseDetails['course'].'/'.$row['language'].'/html5/module'.$current_module ?>part1">Part1</a> 
		         		&#124; <?php    } if (isset($_GET['partNumber'])) {  ?>
		         		<a href="<?php echo 'course/'.$courseDetails['course'].'/'.$row['language'].'/html5/module'.$current_module ?>">Part2</a>
                        <?php  }  else  {  ?> Part2  <?php 		 }       ?>	
	         		<?php else: ?>
	         			<a href="<?php echo 'course/'.$courseDetails['course'].'/'.$row['language'].'/html5/module'.$current_module ?>">Activate Assessment</a>
	         		<?php endif; ?>
	         	<?php elseif($i == 3 && $i == $current_module): ?>	
	         		<!-- check if current language exist in split modules array -->
	         		<?php if (in_array($row['language'], $splitModules)): ?>
		         		Activate Assessment 
         <?php  if (isset($_GET['partNumber'])) {  ?> Part1 &#124; <?php  }  else    {  ?>
		         		<a href="<?php echo 'course/'.$courseDetails['course'].'/'.$row['language'].'/html5/module'.$current_module ?>part1">Part1</a> 
		         		&#124; <?php    } if (isset($_GET['partNumber'])) {  ?>
		         		<a href="<?php echo 'course/'.$courseDetails['course'].'/'.$row['language'].'/html5/module'.$current_module ?>">Part2</a>
                        <?php  }  else  {  ?> Part2  <?php 		 }       ?>	
	         		<?php else: ?>
	         			<a href="<?php echo 'course/'.$courseDetails['course'].'/'.$row['language'].'/html5/module'.$current_module ?>">Activate Assessment</a>
	         		<?php endif; ?>
	         	<?php elseif($i == $current_module): ?>	
	         		<a href="<?php echo 'course/'.$courseDetails['course'].'/'.$row['language'].'/html5/module'.$current_module ?>">Activate Assessment</a>
	         	<?php else: ?>
	         		<?php echo 'Locked'; ?>
	         	<?php endif;?>
	         </td>
	         <td style="padding:10px"  class="center-text"><?php if($row[$i]=="Yes") echo "Complete"; else echo "-";?></td>
	      </tr>
      <?php 
           endfor; 
		   echo '</table>';
			 }
             elseif ($courseDetails['course'] == 'allergen') {
			 ?>
   <tr>
   <td  class="admin-border-right  center-text">1</td>
   <td  class="admin-border-right  center-text"><?php if($i == 1 && $i == $current_module){ ?><a href="<?php echo 'course/'.$courseDetails['course'].'/'.$row['language'].'/html5/module'.$current_module ?>">Activate Assessment</a><?php } else { echo 'Locked'; }?></td>
   <td  class="admin-border-right  center-text"><?php if ($row['1'] == 'No') echo '-'; else echo "Complete";?></td>
   </tr>
      <tr>
   <td  class="admin-border-right  center-text">2</td>
   <td  class="admin-border-right  center-text"><?php if($i == 2 && $i == $current_module){ ?>
     Activate Assessment <a href="<?php echo 'course/'.$courseDetails['course'].'/'.$row['language'].'/html5/module'.$current_module ?>">Part1</a> &#124; Part2
   
   <?php } else if($i == 3 && $i == $current_module){ ?>
    Activate Assessment Part1 &#124; <a href="<?php echo 'course/'.$courseDetails['course'].'/'.$row['language'].'/html5/module'.$current_module ?>">Part2</a> 
   <?php } else { echo 'Locked'; }?>
</td>
   <td  class="admin-border-right  center-text"><?php if ($row['3'] == 'No') echo '-'; else echo "Complete";?></td>
   </tr>	 
			 
   <?php	 
  for($i = 4; $i <= $courseDetails['modules']; $i++): ?>

   <tr>
   <td class="admin-border-right  center-text"><?php echo $i - 1; ?></td>
   
      <td class="admin-border-right  center-text">
	  
          <?php if($i == $current_module): ?>
   <a href="<?php echo 'course/'.$courseDetails['course'].'/'.$row['language'].'/html5/module'.$current_module ?>">Activate Assessment</a>
	</td>
	             	<?php else: ?>
	         		<?php echo 'Locked'; ?>
	<?php  endif;  ?>
    	
		</td>

	   <td style="padding:10px"  class="center-text"><?php if($row[$i]=="Yes") echo "Complete"; else echo "-";?></td>
    </tr>
			<?php 
                   endfor; 
                   echo '</table>';
                    } 
					
					 else {
 
  for($i = 1; $i <= $courseDetails['modules']; $i++): ?>

   <tr>
   <td class="admin-border-right  center-text"><?php echo $i; ?></td>
   
      <td class="admin-border-right  center-text">
	  
          <?php if($i == $current_module): ?>
   <a href="<?php echo 'course/'.$courseDetails['course'].'/'.$row['language'].'/html5/module'.$current_module ?>">Activate Assessment</a>
	</td>
	             	<?php else: ?>
	         		<?php echo 'Locked'; ?>
	<?php  endif;  ?>
    	
		</td>

	   <td style="padding:10px"  class="center-text"><?php if($row[$i]=="Yes") echo "Complete"; else echo "-";?></td>
    </tr>
			<?php 
                   endfor; 
                   echo '</table>';
                    } 
					
					
					
					
            ?>


   

	  
   <h3 class="green">Certificate</h3>
 <p>When you have completed all modules your certificate will be sent to <strong> <?php echo $email; ?></strong> in PDF format.</p>

</div>
<!-- content -->
</div><!-- wrapper -->
<?php include 'footer.php'; ?>