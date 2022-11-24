<?php 
include('config.php');

if(!isset($_SESSION["username"]) && !isset($_SESSION["fullname"])) {
    header("location: log-in.php");	
	exit;	
}

if (isset($_SESSION['test_started_on'])) {
    $sql = "SELECT * FROM user WHERE username='".$_SESSION['username']."'";
    $query = mysql_query($sql);
    $row=mysql_fetch_assoc($query);

    $user_id = $row['ID'];
    for ($i = 1; $i <= 8; $i++) {
        if ($row[$i] == "No") {
            $current_module = $i;
            break;
        }
    }
	

$sql = "SELECT * FROM course WHERE course_ID = '".$row['course']."'";
$result = mysql_query($sql) or die(mysql_error());
$courseDetails = mysql_fetch_assoc($result);


    mysql_query("insert into user_attempts (`module`, `attempt_time`, `status`, `user_id`, `course_ID`) values ('".$current_module."',UTC_TIMESTAMP(), 'fail', '$user_id', '".$row['course']."')");
}
else 
{
	header("location: user-admin.php");	
	exit;	
}

// Get terminology CSV
$terminology_csv = 'course/terminology/'.$row['language'].'/terminology.csv';
$csv = array();
 if(($terminology_handle = fopen($terminology_csv, "r")) !== FALSE)
 {
    while(($terminology = fgetcsv($terminology_handle, 1000, ",")) !== FALSE)
    {
        $csv[] = $terminology;
    }
 }
 fclose($terminology_handle);
 
 
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xml:lang="en" xmlns= "http://www.w3.org/1999/xhtml">
<head>
<title>Examination</title>
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<link rel="stylesheet" type="text/css" href="css/moduleQA.css"/>

<?php 
if ($row['language'] == 'Arabic' || $row['language'] == 'Urdu' || $row['language'] == 'Thai' || $row['language'] == 'Kurdish' || $row['language'] == 'Bengali')
{ 
?>
<link rel="stylesheet" type="text/css" href="css/fontSize3.css"/>
<?php
} 
else if ($row['language'] == 'Hindi' || $row['language'] == 'Gujarati' || $row['language'] == 'Punjabi')
{ 
?>
<link rel="stylesheet" type="text/css" href="css/fontSize2.css"/>
<?php
}
else
{ 
?>
<link rel="stylesheet" type="text/css" href="css/fontSize1.css"/>
<?php
}
?>

</head>
<body>


<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="10%">&nbsp;</td>
<td>
 <h3 class="moduleTitle"><?php /*Failed Module*/ echo $csv[12][1]; ?></h3>  
       <p class="moduleText"><?php /*You must complete the module within 10 minutes.*/ echo $csv[14][1]; ?></p>                           
					<div class="buttons-fail">
                                     <div class="button-fail-left">
                         	<form method="post" action="">
	<input type="button" value="<?php /*Please Try Again*/ echo $csv[4][1]; ?>" 
	onclick="location.href='user-admin.php';"      class="log-button" />
	</form>
        </div>
           
	</div>
                         
    
        <?php unset($_SESSION['attempt']); 
		unset($_SESSION['random_questions']); 
		unset($_SESSION['test_started_on']); 
		unset($_SESSION['correct_answer_count']);
$_SESSION['returnAdmin'] = 1;
		?>
</td>
<td width="10%">&nbsp;</td>
</tr>
</table>
</body>
</html>