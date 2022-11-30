<?php include('config.php'); ?>
<?php

$err = "";

$sql = "SELECT * FROM user WHERE serial='".$_SESSION["serial"]."' LIMIT 1";
$query = mysql_query($sql);

if (!mysql_num_rows($query)) {
	header('location: activate.php');
	exit;
}

$serial_details = mysql_fetch_assoc($query);



if (count($_POST)) {

	$sql = "SELECT * FROM `user` WHERE username = '".mysql_real_escape_string($_POST["email"])."' AND ID != '".$serial_details['ID']."'";

	$query = mysql_query($sql);
	if (!mysql_num_rows($query)) {	
	
	//deactivate serial
		if(isset($_SESSION["admin_username"]) && isset($_POST['deactivate']) && (int)$_POST['deactivate']){
			if ($serial_details['activated'] == 'yes') 
			{
				if ($serial_details['1'] == "No") 
				{
            mysql_query("UPDATE user SET course='', language='', username='', password='', name='', activated='No', date_activated='', `1`='No', `2`='No', `3`='No', `4`='No', `5`='No', `6`='No', `7`='No', `8`='No', site_id='0' WHERE ID='".$serial_details['ID']."' LIMIT 1") or die(mysql_error());

            mysql_query("DELETE FROM user_attempts WHERE `user_id` = ".$serial_details['ID']);

            $sql = "UPDATE `sign-up` SET `number-activated` = `number-activated` - 1 WHERE order_number = '".$serial_details['order-number']."' LIMIT 1";
            mysql_query($sql) or die(mysql_error());

				}
			}
			if(isset($_SESSION['super_admin']) && $_SESSION['admin_type'] == 'super_admin'){
                if($_SESSION['super_admin'] == 'yes')
				{
  header('location: super-admin-serials.php?order_number='.$_SESSION["order_number"]);
                    exit;
                }
            }else{
if (isset($_SESSION["paginationBack"]) && (strlen($_SESSION["paginationBack"]) > 0 )){
                 header("location: admin-serials.php?". $_SESSION["paginationBack"] ."");
			exit; 

			} 
			else 
			{ 
			header('location: admin-serials.php'); 
			exit; 
			}
			
			
            }
		}
		

		
		
		
		$details = $serial_details;

		if( true ){			
			$first_name = $_POST["first_name"];

			$last_name = $_POST["last_name"];

			//$email = $_POST["email"];
			$email = trim($_POST["email"]);
			
			$courseSelect=$_POST["courseSelect"];
			//$activatedCourse=$_POST["activatedCourse"];
			//$testVar=$_POST["testVar"];
			$sql = "SELECT * FROM course WHERE course_ID = '".$_POST["courseSelect"]."'";
$resultCourse = mysql_query($sql) or die(mysql_error());
$courseActivation = mysql_fetch_assoc($resultCourse);
$activatedCourse = $courseActivation['course_name'];




			$language=$_POST["chosenLanguage"];

			$password=generatepassword();
            $t_hasher = new PasswordHash(8, FALSE);
            $hash = $t_hasher->HashPassword($password);
    
			// update the number-activated count
			
			if ($serial_details['activated'] == 'No') {
				$sql = "UPDATE `sign-up` SET `number-activated` = `number-activated` + 1 WHERE order_number = '".$details['order-number']."' LIMIT 1";
				mysql_query($sql) or die(mysql_error());
        if($serial_details['resit-order'] != '') {
          $sql = "UPDATE `sign-up` SET `number-activated` = `number-activated` + 1 WHERE order_number = '".$details['resit-order']."' LIMIT 1";
          mysql_query($sql) or die(mysql_error());
        }
			}

			$sql="UPDATE user SET course='$courseSelect', name='$first_name $last_name', username='$email', language='$language', activated='yes'";

		    if (isset($_SESSION["site_admin"]) && (int)$_SESSION["site_admin"]) 
		    $sql .= ", site_id='".(int)$_POST['site']."'";
			
			if ($serial_details['activated'] == 'No')
				$sql .= ", password='".$hash."', date_activated='".date('Y-m-d H:i:s')."'";
				
			$sql .= "  WHERE serial='".$_SESSION["serial"]."'";// md5 removed
			
			mysql_query($sql) or die(mysql_error());
			
			// if this is admin user and serial was already activated
			// this is just an update
			// no need to send email again
			if(isset($_SESSION["admin_username"]) && $serial_details['activated'] == 'yes') {
                
                
                if(isset($_SESSION['super_admin']) && $_SESSION['admin_type'] == 'super_admin'){
                    if($_SESSION['super_admin'] == 'yes'){
                        
                        header('location: super-admin-serials.php?order_number='.$_SESSION["order_number"]);
                        exit;
                    }
                }else{
                   
if (isset($_SESSION["paginationBack"]) && (strlen($_SESSION["paginationBack"]) > 0 )){
                 header("location: admin-serials.php?". $_SESSION["paginationBack"] ."");
			exit; 

			} 
			else 
			{ 
			header('location: admin-serials.php'); 
			exit; 
			}
			
			
                }
                
			}
			
			
			if (strstr($_SESSION["serial"], 'DEMO'))
				mysql_query("UPDATE `discount` SET ACTIVATED='1' WHERE `DISCOUNT`='".$_SESSION["serial"]."' LIMIT 1");

			$full_name=utf8_decode($first_name.' '.$last_name);

			$serial=$_SESSION['serial'];

			$serialno=formatserialno($serial);
      $suffix_resit = ($serial_details['resit-order'] != '') ? ' (Resit) ' : '';



			$message = "<html>			

			<body style=\"margin: 0; padding: 0\">	
			<table width=\"600\" border=\"1\" cellspacing=\"0\" cellpadding=\"5\">

			<tr>

			<td>

			<img src=\"{$site_url}/images/header.jpg\" width=\"600\" height=\"58\" alt=\"SafetyBugTraining.com\"/>
			</td>

			</tr>

			<tr>
			<td>
			<h2>Activation {$suffix_resit}</h2> 
			<p>Thank you <strong>{$full_name}</strong> for activating your serial for SafetyBugTraining.com, please <a href=\"{$site_url}log-in.php\">log-in here</a> to proceed.</p> 

			<h3 align=\"center\">Your Log-in</h3>

			<table width=\"100%\" border=\"1\" cellspacing=\"0\" cellpadding=\"5\">
			<tr>

			<th>Serial number:</th>

			<td align=\"center\">{$serialno}</td>

			</tr>
			<tr>

			<th>Course:</th>

			<td align=\"center\">{$activatedCourse}</td>

			</tr>
            <tr>

			<th>Language:</th>

			<td align=\"center\">{$language}</td>

			</tr>
			<tr>

			<th>Username:</th>

			<td align=\"center\">{$email}</td>

			</tr>

			<tr>

			<th>Password:</th>

			<td align=\"center\">{$password}</td>

			</tr>

			</table>

	<p>

</p>

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

		

			//$headers  = "From: do-not-reply@safetybugsecure.co.uk \n";
			//$headers .= "Content-type: text/html\r\n"; 	
			
			$subject = "Safety Bug Training Serial Activated - ".$full_name." - S. No. ".$serialno;
      
			if (is_email($email))
				//mail($email, $subject, $message, $headers);
                send_email($email, AUTOMATED_EMAIL, SMTP_HOST, SMTP_PORT, SMTP_USER, SMTP_PASS, COMPANY_NAME, $subject, $message);
			// send email to administrator					
			$first_order_number = explode("-", $details['order-number']);
			$first_order_number[1] = "01";
			$first_order_number = implode("-", $first_order_number);

			//set 'site' to default value
			if (!isset($_POST['site']))   $_POST['site'] = '0'; 
			
			
        $nrsr = mysql_num_rows(mysql_query("select siteID from redirects where siteID='".(int)$_POST['site']."'"));
	if($nrsr > 0){
           $rres = mysql_fetch_assoc(mysql_query("select email from redirects where siteID='".(int)$_POST['site']."'"));
          $cc_new = $rres['email']; //redirect cc email
        }else{
			
			
			$cc = "SELECT email, `cc-email` FROM `sign-up` WHERE order_number = '".$first_order_number."'"; 
			$result = mysql_query($cc) or die(mysql_error());
			$emails = mysql_fetch_assoc($result);

                        if($emails['cc-email'] != ''){
                            $cc_new = $emails['cc-email']; //sign-up cc email
                        }else{
                            $cc_new = $emails['email']; //sign-up admin email
                        }			

		}

                send_email($cc_new, AUTOMATED_EMAIL, SMTP_HOST, SMTP_PORT, SMTP_USER, SMTP_PASS, COMPANY_NAME, $subject, $message);
						

			unset($_SESSION["serial"]);

			$_SESSION['activate_email'] = $email;

			if(isset($_SESSION["admin_username"])){

			
                if(isset($_SESSION['super_admin']) && $_SESSION['admin_type'] == 'super_admin'){
                    
                    if($_SESSION['super_admin'] == 'yes'){
                        
                        header('location: super-admin-serials.php?order_number='.$_SESSION["order_number"]);
                        exit;
                    }
                }else{
                  
				 if (isset($_SESSION["paginationBack"]) && strlen($_SESSION["paginationBack"]) > 0 ) {
                 header("location: admin-serials.php?". $_SESSION["paginationBack"] ."");
			exit; 

			} 
			else 
			{ header('location: admin-serials.php'); 
			exit; }
			
                    
                }
                
                

			
            }else{

			     header("location: activate3.php");
                exit;
             }
				
           

		} else {
			unset($_SESSION["serial"]);
			header("location: activate.php?failed");

			exit;
		}

	} else { 

		$err = 'This email/username has been already registered';

	}

}
?>
<?php include('header2.php'); ?>
  <!-- Start Main Content Area -->
  <main class="main-content-wrap2">

             

<!-- Process Section Start -->
<div class="rs-process style1  pt-100 pb-100 md-pt-70 md-pb-70">
<div class="container pb-54">
  <div class="process-effects-layer">
      <div class="row">
          
          <div class="col-lg-12 col-md-6 md-mb-30">
              <div class="rs-addon-number">
                  <div class="number-part">
                      <a href="#">
                      <div class="number-image">
                          <img src="assets/images/process/style1/power.png" alt="Process">
                      </div>
                  </a>
                      <div class="number-text">
                          <div> <span class="number-prefix">  </span></div>
                          <div class="number-title">
                              <h3 class="title">User Activation

                              </h3>
                          </div>
                          <div class="card-subtitle">
                             Admin can Activate New User / Modify Currunt User  from Here
                          </div>
                      </div>
                  </div>
              </div>
          </div>
        
      </div>
  </div>
</div>
</div>
<script type="text/javascript">	

$(document).ready(function(){

<?php if(isset($_SESSION["updateSerial"]) &&  $_SESSION["updateSerial"] == 'no') { ?>

		 $('#courseLangHeader').hide(); //hide lang select header
				<?php } ?>
				
<?php if(!isset($_SESSION["admin_username"])) { ?>

		 $('#courseLangHeader').hide(); //hide lang select header
				<?php } ?>
				
		$("#activate2_form").validate({
			rules: {
		first_name: "required",
		last_name: "required",
			email: {

				required: true,

				<?php if(isset($_SESSION["admin_username"]))

					  echo "minlength: 10"; 	

					if(!isset($_SESSION["admin_username"]))

					  echo "email: true";?>	

				

			},
		courseSelect: "required",
		chosenLanguage: "required"
				},
			
			highlight: function(element, errorClass, validClass) {
	$(element).css("borderColor", "#ff0000");		
		$(element).parents('.err_highlight').css("borderColor", "#ff0000");
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).css("borderColor", "");
			$(element).parents('.err_highlight').css("borderColor", "#fff");
		},
				
			messages: {
		first_name: "Please enter first name",
		last_name: "Please enter last name",
						<?php if(isset($_SESSION["admin_username"])) {?>	
email: "Please enter username (10 char.)",	
						<?php } elseif(!isset($_SESSION["admin_username"])) { ?>
				email: "Please enter valid email",
						<?php } ?>
						
		courseSelect: "Please select course",
		chosenLanguage: "Please select Language"
			},
			errorPlacement: function (error, el) {
           if (el.attr('name') === 'first_name') {error.appendTo('#error_1'); } 
		   if (el.attr('name') === 'last_name') {error.appendTo('#error_2'); } 
		   if (el.attr('name') === 'email') { error.appendTo('#error_3');}
		   if (el.attr('name') === 'courseSelect') {error.appendTo('#error_4'); }
           if (el.attr('name') === 'chosenLanguage') { error.appendTo('#error_5');}

 			
        },
			
		});
	// Handle changing Languages available
        $('#courseLang').change(function() {
        	if ( this.value == '1' ) {
            $('#fsl2_lang').show();
			$('#allergen_lang').hide();
		    $('#haccp_lang').hide();
	        $('#healthSafety_lang').hide();
	        $('#manualhandling_lang').hide();
	        $('#corona_lang').hide();
	        $('#coshh_lang').hide();
		    $('.err_highlight').show();
  			$('input[name=chosenLanguage]').attr('checked',false);
			$('#error_3').show();
		    $('#courseLangHeader').show();
		    $('#error_5').show();
          } 
		  else if ( this.value == '2' ) { 
		    $('#fsl2_lang').hide();
          	$('#allergen_lang').show();
		    $('#haccp_lang').hide();
	        $('#healthSafety_lang').hide();
		    $('#manualhandling_lang').hide();
	        $('#corona_lang').hide();
	        $('#coshh_lang').hide();
		    $('.err_highlight').show();
  			$('input[name=chosenLanguage]').attr('checked',false);
			$('#error_3').show();
		    $('#courseLangHeader').show();
			$('#error_5').show();
          }
		   else if ( this.value == '3' ) { 
		    $('#fsl2_lang').hide();
          	$('#allergen_lang').hide();
		    $('#haccp_lang').show();
	        $('#healthSafety_lang').hide();
	        $('#manualhandling_lang').hide();
	        $('#corona_lang').hide();
	        $('#coshh_lang').hide();
		    $('.err_highlight').show();
  			$('input[name=chosenLanguage]').attr('checked',false);
			$('#error_3').show();
		    $('#courseLangHeader').show();
			$('#error_5').show();
          }
            else if ( this.value == '4' ) { 
		    $('#fsl2_lang').hide();
          	$('#allergen_lang').hide();
		    $('#haccp_lang').hide();
	        $('#healthSafety_lang').show();
	        $('#manualhandling_lang').hide();
	        $('#corona_lang').hide();
	        $('#coshh_lang').hide();
		    $('.err_highlight').show();
  			$('input[name=chosenLanguage]').attr('checked',false);
			$('#error_3').show();
		    $('#courseLangHeader').show();
			$('#error_5').show();
          }
		    else if ( this.value == '5' ) { 
		    $('#fsl2_lang').hide();
          	$('#allergen_lang').hide();
		    $('#haccp_lang').hide();
	        $('#healthSafety_lang').hide();
	        $('#manualhandling_lang').show();
	        $('#corona_lang').hide();
	        $('#coshh_lang').hide();
		    $('.err_highlight').show();
  			$('input[name=chosenLanguage]').attr('checked',false);
			$('#error_3').show();
		    $('#courseLangHeader').show();
			$('#error_5').show();
          }
		    else if ( this.value == '6' ) { 
		    $('#fsl2_lang').hide();
          	$('#allergen_lang').hide();
		    $('#haccp_lang').hide();
	        $('#healthSafety_lang').hide();
	        $('#manualhandling_lang').hide();
	        $('#corona_lang').show();
	        $('#coshh_lang').hide();
		    $('.err_highlight').show();
  			$('input[name=chosenLanguage]').attr('checked',false);
			$('#error_3').show();
		    $('#courseLangHeader').show();
			$('#error_5').show();
          }
		    else if ( this.value == '7' ) { 
		    $('#fsl2_lang').hide();
          	$('#allergen_lang').hide();
		    $('#haccp_lang').hide();
	        $('#healthSafety_lang').hide();
	        $('#manualhandling_lang').hide();
	        $('#corona_lang').hide();
	        $('#coshh_lang').show();
		    $('.err_highlight').show();
  			$('input[name=chosenLanguage]').attr('checked',false);
			$('#error_3').show();
		    $('#courseLangHeader').show();
			$('#error_5').show();
          }
        else  { 
		    $('#courseLangHeader').hide();
		    $('#fsl2_lang').hide();
          	$('#allergen_lang').hide();
		    $('#haccp_lang').hide();
	        $('#healthSafety_lang').hide();
		    $('#manualhandling_lang').hide();
		    $('#corona_lang').hide();
		    $('#coshh_lang').hide();
	    	$('.err_highlight').hide();
		 	$('#error_3').hide();
			$('#error_5').hide();
          }
        })
		  
		  
	
	});

	


</script>
 <div id="card" class="card-box-style2">
  <div class="others-title">
      <h3><?php if(isset($_SESSION["admin_username"])) echo ($serial_details['activated']=="yes") ? "Edit serial" : "Admin Serial Activation"; else echo "User Details"?></h3>
      <p><?php if ($serial_details['activated']!="yes") if(isset($_SESSION["admin_username"])) echo "To activate the serial on behalf of student, please provide the following information:"; else echo "To activate serial please provide the following information:"?></p>
    </div>
    <?php

			if ($err != "") echo '<p class="error" style="font-weight:bold; color:#ff0000; ">'.$err.'</p>';

		if ($serial_details['activated']=="yes")
		{
		//	if (isset($serial_details['name']))
				list($first_name, $last_name) = explode(' ', $serial_details['name']);
		}
		else
		{
				list($first_name, $last_name) = array('', '');
		}
		?>
  <form id="activate2_form" action="" method="post" class="row g-3">
  

<table class="activate-res">

        <div class="row">
           <div class="col"><p>First Name</p>
            <input name="first_name" type="text"  class="form-control" value="<?php echo (isset($_POST['first_name']) ? $_POST['first_name'] : $first_name); ?>"   <?php  if($serial_details['resit-order'] != '') { echo "readonly";} ?> class="valError" />
						<span id="error_1"></span>
						</td>

			</div>

			<div class="col">
                <p class="form-type-left">Last Name</p>
            <input name="last_name" type="text"  class="form-control" value="<?php echo (isset($_POST['last_name']) ? $_POST['last_name'] : $last_name); ?>" <?php  if($serial_details['resit-order'] != '') { echo "readonly";} ?>  />
						<span id="error_2"></span>
			
                        </div>
                        </div>

                        <div class="col-md-6">
			<p><?php if(isset($_SESSION["admin_username"])) echo "Username (10 char.)"; else echo "E-Mail";?></p>
            <input name="email"  id="email" type="text" class="form-control"  value="<?php echo (isset($_POST['email']) ? $_POST['email'] : $serial_details['username']); ?>"/>
						<span id="error_3"></span>
                        </div>

            

</table>








<?php if(isset($_SESSION["admin_username"])){?>
    <div class="alert alert-dark" role="alert">
                    The first and last name will appear on certificate. The username will be used for course log-in and can be any combination of words, numbers and symbols <strong> (at least 10 characters in length)</strong>. If candidate's email address is used a email confirming login will be sent this address and copied to relevant administrator.
                </div>



	
	<?php if($serial_details['activated']=="yes"){ ?>
		<?php
			if ($serial_details['1'] == 'No' && $serial_details['resit-order'] == '')  {
		?>
 	<h3 class="green">Deactivate</h3>
				<p>You may 'deactivate' and re-use this serial (no modules have been passed).</p>
<table  class="activate-res">
					<tr>
		
		
					<td><p class="form-type-left">Deactivate Serial:</p>
					
						<table>
						<tr>
						<td width="26"><input name="deactivate" type="radio" value="1" /></td>
						<td width="34"><p class="form-type-left"  style="margin:0px; padding:0px">Yes</p></td>
						</tr>
						<tr>
						<td width="26"><input name="deactivate" type="radio" value="0" checked="checked" /></td>
						<td width="34"><p class="form-type-left"  style="margin:0px; padding:0px">No</p></td>
						</tr>
						</table>
		
					</td>
		
					</tr>
				</table>
		<?php  } ?>
	<?php } ?>

	<?php if (isset($_SESSION["site_admin"]) && (int)$_SESSION["site_admin"]) { ?>
 	<h3 class="green">Select Site</h3>
		<p>Allocate user to particular site</p>
	

				
		
		
					
                    <div class="col-md-6">
					<select id="" name="site"   class="dropdown form-control" >
				<option value="">--Unspecified--</option>
						<?php $sql_site = "SELECT * FROM site WHERE order_number='".$_SESSION['order_number']."' ORDER BY site"; $query_site = mysql_query($sql_site); ?>
						<?php while($row = mysql_fetch_assoc($query_site)) { ?>
						<option value="<?php echo $row['id'] ?>"<?php if ($serial_details['site_id'] == $row['id']) echo ' selected="selected"'; ?>><?php echo $row['site'] ?></option>
						<?php } ?>
					</select>
                    </div>
		
		

		
	
	
	<?php }  ?>



		
<?php } ?>
					

<h3>Select Course</h3>

<div class="col-md-6">


					<select id="courseLang" name="courseSelect"   class="form-select form-control  valError" 				
					<?php $sql = "SELECT * FROM user_attempts WHERE user_id = '".$serial_details['ID']."'";
$countAttempts = mysql_query($sql) or die(mysql_error());
$countAttemptsResult = mysql_fetch_assoc($countAttempts);
$_SESSION['disableSelect'] = $countAttemptsResult;
if ($_SESSION['disableSelect'] > 0) {  ?>disabled <?php } ?>>
				<option value="">--Unspecified--</option>
						<?php $sql_course = "SELECT * FROM course ORDER BY course_name ASC"; 
						$courseSelect = mysql_query($sql_course); ?>
						<?php while($row = mysql_fetch_assoc($courseSelect)) { ?>
						<option value="<?php echo $row['course_ID'] ?>"<?php if ($serial_details['course'] == $row['course_ID']) echo ' selected="selected"'; ?>><?php echo $row['course_name'] ?></option>
						<?php } ?>
					</select>
<?php  if ($_SESSION['disableSelect'] > 0) {  ?>
            <input name="courseSelect"  type="text"  value="<?php echo $serial_details['course']?>" hidden="hidden" />
<?php } ?>	
					<span id="error_4"></span>
		
		</div>


 	<h3 class="green" id="courseLangHeader">Course Language</h3>
	 
			<span id="error_5"></span>

		
<table  class="err_highlight activate-res">

<tr>

<td>



<!-- FSL2 Langauge choices -->
<table   style="border-spacing:10px;  border-collapse: separate; margin:0;<?php if ($serial_details['course'] != '1'){ ?>  display:none <?php } ?>"  id="fsl2_lang">

<?php 
for($i=0;$i<count($language_fsl2);$i++){ ?>

<tr>

<td><p class="form-type-left"><?php echo $language_fsl2[$i]; ?></p></td>

<td><input name="chosenLanguage" type="radio" value="<?php echo $language_fsl2[$i]; ?>" <?php if (isset($serial_details['language']) && $serial_details['course'] == '1' && $serial_details['language'] == $language_fsl2[$i]) echo 'checked="checked"';?>/></td>

<td><img src="images/flag/<?php echo $language_fsl2[$i]; ?>.png" width="36" height="32" alt=""/></td>

</tr>

<?php 
}
 ?>

</table>


<!-- Allergen Langauge choices -->
<table   style="border-spacing:10px;  border-collapse: separate; margin:0;<?php if ($serial_details['course'] != '2'){ ?>  display:none <?php } ?>"  id="allergen_lang">

<?php 

for($i=0;$i<count($language_allergen);$i++){ ?>

<tr>

<td><p class="form-type-left"><?php echo $language_allergen[$i]; ?></p></td>

<td><input name="chosenLanguage" type="radio" value="<?php echo $language_allergen[$i]; ?>" <?php if (isset($serial_details['language']) && $serial_details['course'] == '2' && $serial_details['language'] == $language_allergen[$i]) echo 'checked="checked"';?>/></td>

<td><img src="images/flag/<?php echo $language_allergen[$i]; ?>.png" width="36" height="32" alt=""/></td>

</tr>

<?php 
}
?>
</table>




<!-- HACCP Langauge choices -->
<table   style="border-spacing:10px;  border-collapse: separate; margin:0;<?php if ($serial_details['course'] != '3'){ ?>  display:none <?php } ?>"  id="haccp_lang">

<?php 

for($i=0;$i<count($language_haccp);$i++){ ?>

<tr>

<td><p class="form-type-left"><?php echo $language_haccp[$i]; ?></p></td>

<td><input name="chosenLanguage" type="radio" value="<?php echo $language_haccp[$i]; ?>" <?php if (isset($serial_details['language']) && $serial_details['course'] == '3' && $serial_details['language'] == $language_haccp[$i]) echo 'checked="checked"';?>/></td>

<td><img src="images/flag/<?php echo $language_haccp[$i]; ?>.png" width="36" height="32" alt=""/></td>

</tr>

<?php 
}
?>
</table>

<!-- Health and Safety Langauge choices -->
<table   style="border-spacing:10px;  border-collapse: separate; margin:0;<?php if ($serial_details['course'] != '4'){ ?>  display:none <?php } ?>"  id="healthSafety_lang">

<?php 

for($i=0;$i<count($language_healthSafety);$i++){ ?>

<tr>

<td><p class="form-type-left"><?php echo $language_healthSafety[$i]; ?></p></td>

<td><input name="chosenLanguage" type="radio" value="<?php echo $language_healthSafety[$i]; ?>" <?php if (isset($serial_details['language']) && $serial_details['course'] == '4' && $serial_details['language'] == $language_healthSafety[$i]) echo 'checked="checked"';?>/></td>

<td><img src="images/flag/<?php echo $language_healthSafety[$i]; ?>.png" width="36" height="32" alt=""/></td>

</tr>

<?php 
}
?>
</table>

<!-- Manual Handling Langauge choices -->
<table   style="border-spacing:10px;  border-collapse: separate; margin:0;<?php if ($serial_details['course'] != '5'){ ?>  display:none <?php } ?>"  id="manualhandling_lang">

<?php 

for($i=0;$i<count($language_manualhandling);$i++){ ?>

<tr>

<td><p class="form-type-left"><?php echo $language_manualhandling[$i]; ?></p></td>

<td><input name="chosenLanguage" type="radio" value="<?php echo $language_manualhandling[$i]; ?>" <?php if (isset($serial_details['language']) && $serial_details['course'] == '5' && $serial_details['language'] == $language_manualhandling[$i]) echo 'checked="checked"';?>/></td>

<td><img src="images/flag/<?php echo $language_manualhandling[$i]; ?>.png" width="36" height="32" alt=""/></td>

</tr>

<?php 
}
?>
</table>



<!-- COVID-19 Langauge choices -->
<table   style="border-spacing:10px;  border-collapse: separate; margin:0;<?php if ($serial_details['course'] != '6'){ ?>  display:none <?php } ?>"  id="corona_lang">

<?php 

for($i=0;$i<count($language_corona);$i++){ ?>

<tr>

<td><p class="form-type-left"><?php echo $language_corona[$i]; ?></p></td>

<td><input name="chosenLanguage" type="radio" value="<?php echo $language_corona[$i]; ?>" <?php if (isset($serial_details['language']) && $serial_details['course'] == '6' && $serial_details['language'] == $language_corona[$i]) echo 'checked="checked"';?>/></td>

<td><img src="images/flag/<?php echo $language_corona[$i]; ?>.png" width="36" height="32" alt=""/></td>

</tr>

<?php 
}
?>
</table>



<!-- COSHH Langauge choices -->
<table   style="border-spacing:10px;  border-collapse: separate; margin:0;<?php if ($serial_details['course'] != '7'){ ?>  display:none <?php } ?>"  id="coshh_lang">

<?php 

for($i=0;$i<count($language_coshh);$i++){ ?>

<tr>

<td><p class="form-type-left"><?php echo $language_coshh[$i]; ?></p></td>

<td><input name="chosenLanguage" type="radio" value="<?php echo $language_coshh[$i]; ?>" <?php if (isset($serial_details['language']) && $serial_details['course'] == '7' && $serial_details['language'] == $language_coshh[$i]) echo 'checked="checked"';?>/></td>

<td><img src="images/flag/<?php echo $language_coshh[$i]; ?>.png" width="36" height="32" alt=""/></td>

</tr>

<?php 
}
?>
</table>








</td>

</tr>

</table>



<div class="col-12">
<input name="submit" type="submit" value="Submit"  class="btn btn-success"  />
<?php 
    
if(isset($_SESSION['super_admin']) && $_SESSION['admin_type'] == 'super_admin'){

    if($_SESSION['super_admin'] == 'yes'){

        ?>
    <input name="cancel" type="button" value="Cancel"   class="log-button btn btn-danger" onclick="document.location.href='super-admin-serials.php?order_number=<?php echo $_SESSION["order_number"]; ?>'" />
    <?php
    }
}
else
{
 	 if (isset($_SESSION["paginationBack"]) && strlen($_SESSION["paginationBack"]) > 0 ) { ?>
    <input name="cancel" type="button" value="Cancel"  class="log-button" onclick="document.location.href='admin-serials.php?<?php echo "". $_SESSION["paginationBack"] .""  ?>'" />
		<?php 	} 
			else 
			{       ?>
    <input name="cancel" type="button" value="Cancel"  class="log-button btn btn-danger" onclick="document.location.href='admin-serials.php'" />
    <?php
}
    }
    
?>
</div>

</form>

  <!-- <form class="row g-3">
   <div class="pb-24">
       <div class="row">
           <div class="col">
               <input type="text" class="form-control" placeholder="First name" aria-label="First name">
           </div>
           <div class="col">
               <input type="text" class="form-control" placeholder="Last name" aria-label="Last name">
           </div>
       </div>
   </div>
  
      <div class="col-md-6">
          <label for="inputEmail4" class="form-label">Username (10 char)</label>
          <input type="text" minlength="10" maxlength="20" value="Surajtiwari" class="form-control" id="inputEmail4">
      </div>
      <div class="alert alert-dark" role="alert">
       The first and last name will appear on certificate. The username will be used for course log-in and can be any combination of words, numbers and symbols <strong> (at least 10 characters in length)</strong>. If candidate's email address is used a email confirming login will be sent this address and copied to relevant administrator.
   </div>

       <h3>Select Site</h3>


      <div class="col-md-6">
         
          <select id="account_type" name="account"  class="form-select form-control">
              <option value="" selected>Please select</option>
              <option value="1" >Mayfair</option>
              <option value="2">Vadodara</option>
              <option value="2">Gujarat</option>
              <option value="2">Rajkot</option>
          </select>
      </div>
      
       <h3>Select Course</h3>

      <div class="col-md-6">
          
          <select id="account_type" name="account"  class="form-select form-control">
              <option value="" selected>Please select</option>
              <option value="1" >COSHH</option>
              <option value="2">HACCP</option>
              <option value="2">Health and Safety</option>
          </select>
      </div>
      
      <h3>Course Language</h3>
      <fieldset class="row mb-3 mt-3">
          <legend class="col-form-label col-sm-2 pt-0">*Array Will Be Diplay</legend>
         
      </fieldset>
    
      <div class="col-12">
          <button type="submit" class="btn btn-success">Submit</button>
          <button type="cancel" class="btn btn-danger">Cancel</button>
      </div>
      
  </form>
   -->
</div>




  
</main>

<!-- End Main Content Area -->

<script>
            $(window).ready( function() {
           if($(window).width() > 850) {
           $('#card').addClass('card-box-style2');
           $('#card').removeClass('card-box-style');
           }else{
           $('#card').addClass('card-box-style');
           $('#card').removeClass('card-box-style2');
            }
            })
            </script>
<?php include('footer2.php'); ?>