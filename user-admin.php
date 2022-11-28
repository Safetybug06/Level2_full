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
<?php include('header2.php'); ?>

    <!-- Start Sidebar Area -->
    <nav class="side-menu-area style-two">
        <nav class="sidebar-nav" data-simplebar>
            <ul id="sidebar-menu" class="sidebar-menu">
              

                <li id="dashboard_1" class="mm-active">
                    <a href="#" class="box-style d-flex align-items-center">
                        <div class="icon">
                            <img src="assets/images/icon/user-octagon.svg" alt="calendar">
                        </div>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>
                
                <li id="module1">
                    <a href="#" class="box-style d-flex align-items-center">
                        <div class="icon">
                            <img src="assets/images/icon/user-octagon.svg" alt="calendar">
                        </div>
                        <span class="menu-title">Course Modules</span>
                    </a>
                </li>
                <li id="certificate1">
                    <a href="#" class="box-style d-flex align-items-center">
                        <div class="icon">
                            <img src="assets/images/icon/document-copy.svg" alt="calendar">
                        </div>
                        <span  class="menu-title">Certificates</span>
                    </a>
                </li>
                <li>
                    <a href="logout.php" class="box-style d-flex align-items-center">
                        <div class="icon">
                            <img src="assets/images/icon/key.svg" alt="calendar">
                        </div>
                        <span  class="menu-title">Logout</span>
                    </a>
                </li>
                <!-- <li id="site_admin1">
                    <a href="#" class="box-style d-flex align-items-center">
                        <div class="icon">
                            <img src="assets/images/icon/fatrows.svg" alt="calendar">
                        </div>
                        <span  class="menu-title">Site Control</span>
                    </a>
                </li>
                <li id="add_serials">
                    <a href="register.html" class="box-style d-flex align-items-center">
                        <div class="icon">
                            <img src="assets/images/icon/advanced.svg" alt="calendar">
                        </div>
                        <span class="menu-title">Additional Serials</span>
                    </a>
                </li>
                <li id="add_serials">
                    <a href="#" class="box-style d-flex align-items-center">
                        <div class="icon">
                            <img src="assets/images/icon/layer.svg" alt="calendar">
                        </div>
                        <span class="menu-title">Course Progress</span>
                    </a>
                </li>
                <li id="qa1">
                    <a href="#" class="box-style d-flex align-items-center">
                        <div class="icon">
                            <img src="assets/images/icon/book.svg" alt="calendar">
                        </div>
                        <span class="menu-title">Download English Q/A</span>
                    </a>
                </li> -->

             
            </ul>
        </nav>
    </nav>
    <!-- End Sidebar Area -->
            <!-- Start Main Content Area -->
            <?php 
$sql = "SELECT * FROM course WHERE course_ID = '".$row['course']."'";
$result = mysql_query($sql) or die(mysql_error());
$courseDetails = mysql_fetch_assoc($result);

//echo  $courseDetails['course'];
//echo  '<br/>'; 
//echo  $courseDetails['course_name']; 

?>
            <main id="main" class="main-content-wrap3 style-two">


                  <!-- Start Overview Back Area -->
                  <div id="overview" class="overview-content-area">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-4 col-sm-6">
                                <div class="single-audience d-flex justify-content-between align-items-center">
                                    <div class="audience-content">
                                        <h5>Course</h5>
                                        <h4><?php echo  $courseDetails['course_name']; ?> </h4>
                                    </div>
                                    <div class="icon">
                                        <img src="assets/images/icon/note-2.svg" alt="white-profile-2user">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-sm-6">
                                <div class="single-audience d-flex justify-content-between align-items-center">
                                    <div class="audience-content">
                                        <h5>Language</h5>
                                        <h4><?php if(isset($row['language'])){ echo strtoupper  ($row['language']); } ?></h4>
                                    </div>
                                    <div class="icon">
                                        <img src="assets/images/icon/user-2.svg" alt="eye">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-sm-6">
                                <div class="single-audience d-flex justify-content-between align-items-center">
                                    <div class="audience-content">
                                        <h5>Total Modules</h5>
                                        <h4><?php if ($courseDetails['course'] == 'allergen') echo '5'; else echo $courseDetails['modules']; ?><span> </span></h4>
                                    </div>
                                    <div class="icon">
                                        <img src="assets/images/icon/people.svg" alt="timer">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Overview Back Area -->

              <!-- Start Welcome Back Area -->
              <div id="board" class="welcome-back-area">
                <div class="container-fluid">
                    <div class="welcome-back-content">
                        <span>Welcome</span>
                        <h2><?php echo  ucwords($_SESSION["fullname"]); ?></h2>
                        <p style="color: white;">You are sitting the <strong> <?php echo  $courseDetails['course_name']; ?>  </strong> course. Below you can see there are <?php if ($courseDetails['course'] == 'allergen') echo '5'; else echo $courseDetails['modules']; ?> <br> modules for you to complete. You must view the presentation and then answer the relevant Q/As</p>

                        <img class="welcome-img" src="assets/images/welcome.png" alt="welcome image">
                    </div>
                </div>
            </div>
            <!-- End Welcome Back Area -->
            
            
<!-- Start Total Visits Area -->
 <div id="dashboard" class="total-visits-browse-area">
    <div class="card-box-style">
        <div class="others-title">
            <h3>Instructions</h3>
        </div>

        <div class="alert alert-primary card-box-style" role="alert">
          <strong>1. </strong> You must answer all Q/As correct for each module to progress
        </div>
        <div class="alert alert-primary card-box-style" role="alert">
          <strong>2. </strong> If you answer any 2 questions incorrectly, you must start the module again
        </div>
        <div class="alert alert-primary card-box-style" role="alert">
          <strong>3. </strong> Once you pass all 5 modules you will be awarded your Certificate
        </div>
       
    </div>
</div>
<!-- End Total Visits Area -->

<!-- Start Total Visits Area -->
<div id="module" class="total-visits-browse-area" style="display: none;">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-xxl-12">
                <div class="total-visits-content card-box-style">
                    <div class="main-title d-flex justify-content-between align-items-center">
                        <div class="others-title">
                        <h3>Course Modules</h3>
                    </div>
                    <!-- <ul>
                  
                        <button type="button" id="add_admin1" class="btn btn-outline-success mb-1">Add New</button>
                       
                        <button type="button" class="btn btn-outline-danger mb-1">Deleted Selected</button>
                     
                    </ul>  -->
              
                    </div>

                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th scope="col">Modules</th>
                                <th scope="col">Safety Bug Training</th>
                                <th scope="col" >Status</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <!-- <tr>
                                <td>
                                    <span>1</span>
                                </td>
                               
                                <td>
                                    <span ><a style="color: green;" href="http://"><u>Activate Assessment</u> </a></span>
                                </td>
                                <td>
                                    <span> - </span>
                                </td>
                               
                                
                            </tr> -->
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
            <a style="color: green;" href="<?php echo 'course/'.$courseDetails['course'].'/'.$row['language'].'/html5/module'.$current_module ?>">Activate Assessment</a>
           
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
                <a style="color: green;" href="<?php echo 'course/'.$courseDetails['course'].'/'.$row['language'].'/html5/module'.$current_module ?>">Activate Assessment</a>
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
                <a style="color: green;" href="<?php echo 'course/'.$courseDetails['course'].'/'.$row['language'].'/html5/module'.$current_module ?>">Activate Assessment</a>
            <?php endif; ?>
        <?php elseif($i == $current_module): ?>	
            <a style="color: green;" href="<?php echo 'course/'.$courseDetails['course'].'/'.$row['language'].'/html5/module'.$current_module ?>">Activate Assessment</a>
        <?php else: ?>
            <?php echo 'Locked'; ?>
        <?php endif;?>
    </td>
    <td style="padding:10px"  class="center-text"><?php if($row[$i]=="Yes") echo "Complete 🏳️‍🌈"; else echo "-";?></td>
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
<td  class="admin-border-right  center-text"><?php if ($row['1'] == 'No') echo '-'; else echo "Complete 🏳️‍🌈";?></td>
</tr>
<tr>
<td  class="admin-border-right  center-text">2</td>
<td  class="admin-border-right  center-text"><?php if($i == 2 && $i == $current_module){ ?>
Activate Assessment <a href="<?php echo 'course/'.$courseDetails['course'].'/'.$row['language'].'/html5/module'.$current_module ?>">Part1</a> &#124; Part2

<?php } else if($i == 3 && $i == $current_module){ ?>
Activate Assessment Part1 &#124; <a href="<?php echo 'course/'.$courseDetails['course'].'/'.$row['language'].'/html5/module'.$current_module ?>">Part2</a> 
<?php } else { echo 'Locked'; }?>
</td>
<td  class="admin-border-right  center-text"><?php if ($row['3'] == 'No') echo '-'; else echo "Complete 🏳️‍🌈";?></td>
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

<td style="padding:10px"  class="center-text"><?php if($row[$i]=="Yes") echo "Complete 🏳️‍🌈"; else echo "-";?></td>
</tr>
   <?php 
          endfor; 
          echo '</table>';
           } 
           
            else {

for($i = 1; $i <= $courseDetails['modules']; $i++): ?>

<tr>
<td class="admin-border-right  center-text"><?php echo $i; ?></td>

<td>
    <span>

 <?php if($i == $current_module): ?>
<a style="color: green;" href="<?php echo 'course/'.$courseDetails['course'].'/'.$row['language'].'/html5/module'.$current_module ?>"><u>Activate Assessment</u></a>
</span>
</td>
            <?php else: ?>
            <?php echo 'Locked'; ?>
<?php  endif;  ?>

</td>

<td style="padding:10px"  class="center-text"><?php if($row[$i]=="Yes") echo "Completed 🏳️‍🌈"; else echo "-";?></td>
</tr>
   <?php 
          endfor; 
          echo '</tbody></table>';
           } 
           
           
           
           
   ?>
                            <!-- <tr>
                                <td>
                                    <span>3</span>
                                </td>
                                <td>
                                    <span>Locked</span>
                                </td>
                                <td>
                                    <span> - </span>
                                </td>
                               
                                
                            </tr>
                            <tr>
                                <td>
                                    <span>4</span>
                                </td>
                                <td>
                                    <span>Locked</span>
                                </td>
                                <td>
                                    <span> - </span>
                                </td>
                               
                                
                            </tr>
  
                        </tbody>
                    </table> -->


                  
                   
                </div>
            </div>

           
        </div>
    </div>
</div>

<!-- End Total Visits Area -->
<!-- certicate  -->
<!-- form -->
<div id="certificates" class="card-box-style" style="display: none;" >
    <div class="others-title">
        <h3>Certificate E-mail</h3>
    </div>
      
       <!-- <form class="row g-3 card-box-style">
        
        <div class="col-md-6">
            <label for="inputEmail4" class="form-label">*Email</label>
            <input type="email" value="rakesh@gmail.com" class="form-control" id="inputEmail4">
            
        </div>
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary">Update</button>
            <button type="submit" class="btn btn-success">Set to default</button>
        </div>

        </form> -->
     
     
    <div class="alert alert-warning alert-dismissible fade show g-3 card-box-style" role="alert">
        <strong>Note</strong> When you have completed all modules your certificate will be sent to <strong><?php echo $email; ?></strong> in PDF format.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

    </div>
   

    
    
</div>
<!-- certicate end  -->

<!-- end form -->
   
            

          
            <!-- End Main Content Area -->

            <script>
            $(document).ready(function(){
              $("#module1").click(function(){
                $("#dashboard").hide();
              });
              $("#module1").click(function(){
                $("#module").show();
              });
              $("#module1").click(function(){
                $("#certificates").hide();
              });
              $("#module1").click(function(){
                $("#overview").hide();
              });
              $("#module1").click(function(){
                $("#board").hide();
              });
              $("#module1").click(function(){
                $("#site_admin").hide();
              });
              $("#module1").click(function(){
                $("#qa").hide();
              });
              $("#certificate1").click(function(){
                $("#dashboard").hide();
              });
              $("#certificate1").click(function(){
                $("#module").hide();
              });
              $("#certificate1").click(function(){
                $("#site_admin").hide();
              });
              $("#certificate1").click(function(){
                $("#qa").hide();
              });
              $("#certificate1").click(function(){
                $("#certificates").show();
              });
              $("#certificate1").click(function(){
                $("#overview").hide();
              });
              $("#certificate1").click(function(){
                $("#board").hide();
              });
              $("#dashboard_1").click(function(){
                $("#overview").show();
              });
              $("#dashboard_1").click(function(){
                $("#board").show();
              });
              $("#dashboard_1").click(function(){
                $("#dashboard").show();
              });
              $("#dashboard_1").click(function(){
                $("#module").hide();
              });
              $("#dashboard_1").click(function(){
                $("#certificates").hide();
              });
              $("#dashboard_1").click(function(){
                $("#site_admin").hide();
              });
              $("#dashboard_1").click(function(){
                $("#qa").hide();
              });
              $("#add_admin1").click(function(){
                $("#add_admin").show();
              });
              $("#create").click(function(){
                $("#add_admin").hide();
              });
              $("#site_admin1").click(function(){
                $("#site_admin").show();
              });
              $("#site_admin1").click(function(){
                $("#dashboard").hide();
              });
              $("#site_admin1").click(function(){
                $("#module").hide();
              });
              $("#site_admin1").click(function(){
                $("#certificates").hide();
              });
              $("#site_admin1").click(function(){
                $("#qa").hide();
              });
              $("#qa1").click(function(){
                $("#qa").show();
              });
              $("#qa1").click(function(){
                $("#site_admin").hide();
              });
              $("#qa1").click(function(){
                $("#dashboard").hide();
              });
              $("#qa1").click(function(){
                $("#module").hide();
              });
              $("#qa1").click(function(){
                $("#certificates").hide();
              });
              $("#add_site1").click(function(){
                $("#add_site").show();
              });
              $("#add_site_btn").click(function(){
                $("#add_site").hide();
              });
              $("#add_redirect1").click(function(){
                $("#add_redirect").show();
              });
              $("#add_redirect_btn").click(function(){
                $("#add_redirect").hide();
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


<?php include('footer2.php'); ?>