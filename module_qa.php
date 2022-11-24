<?php
include('config.php');

if (!isset($_SESSION["username"]) && !isset($_SESSION["fullname"])) {
    header("location: log-in.php");
    exit;
}

if(isset($_SESSION['returnAdmin'])) {
header("location: user-admin.php");	
exit;	
	}
	
	
	
$cheating = false;
$correct_answer = false;

$answers = array(
    'A' => 1,
    'B' => 2,
    'C' => 3,
    'D' => 4
);

$sql = "SELECT * FROM user WHERE username='" . $_SESSION['username'] . "'";
$query = mysql_query($sql);
$row = mysql_fetch_assoc($query);

$user_id = $row['ID'];


$sql = "SELECT * FROM course WHERE course_ID = '".$row['course']."'";
$result = mysql_query($sql) or die(mysql_error());
$courseDetails = mysql_fetch_assoc($result);



for ($i = 1; $i <= $courseDetails['modules'] ; $i++) {
    if ($row[$i] == "No") {
        $current_module = $i;
        break;
    }
}



if ($current_module != 1) {
    $sql = "SELECT * FROM user WHERE username='" . $_SESSION['username'] . "' AND `" . ($current_module - 1) . "`='Yes'";
    $query = mysql_query($sql);

    if (!mysql_num_rows($query)) {
        $cheating = true;
    }
}

$passed = false;

if (!$cheating) {

    $sql = "SELECT * FROM user WHERE username='" . $_SESSION['username'] . "'";
    $query = mysql_query($sql);

    $details = mysql_fetch_assoc($query);
    $i = 1;
    while ($details[$i] == 'Yes') {
        $passed = $i;

        $i++;
    }
}
$module_csv = 'course/'.$courseDetails['course'].'/'.$details['language'].'/modules/qa_module'.$current_module.'.csv';

// Get terminology CSV
$terminology_csv = 'course/terminology/'.$details['language'].'/terminology.csv';


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
<?php
$current_question = isset($_GET['question']) ? (int) $_GET['question'] : 1;
if (!$current_question)
    $current_question = 1;

$handle = fopen($module_csv, 'r');

if ($current_question != 1 && $current_module . '_' . ($current_question - 1) != $_SESSION['last_answered']) {
    list($current_module, $current_question) = explode('_', $_SESSION['last_answered']);

    header('location: module_qa.php?module=' . $current_module . '&question=' . ($current_question + 1));
    exit();
}

$incorrect_answer = false;

$data = array();

$module_title = fgetcsv($handle);

$row = 1;
$dataset = array();
while ($content = fgetcsv($handle)) {
    $dataset[] = $content;
    $row++;
}

if ($courseDetails['course'] == 'fsl2' && $details['language'] == 'English') {
    if (!isset($_SESSION['random_questions'])) {
        $randomized = array();

        for ($i = 1; $i <= 5; $i++) {
            while (true) {
                $random_question = rand(1, count($dataset) - 1);
                if (!in_array($random_question, $randomized)) {
                    $randomized[$i] = $random_question;
                    break;
                }
            }
        }

        $_SESSION['random_questions'] = $randomized;
    } else
        $randomized = $_SESSION['random_questions'];

    $data = $dataset[$randomized[$current_question]];
} else {
    $data = isset($dataset[$current_question]) ? $dataset[$current_question] : array();
}


if (!count($data)) {
    header('location: module_qa.php?module=' . $current_module . '&question=1');
    exit;
}



if (!isset($_SESSION['attempt'])) {
    $attempt = 0;
    $_SESSION['attempt'] = $attempt;
}

if (count($_POST)) {

    if (isset($_POST['answer']) && ($_POST['answer'] == $data[6])) {
        $_SESSION['last_answered'] = $current_module . '_' . $current_question;
        $correct_answer = true;
    } else {
        $incorrect_answer = true;
        $_SESSION['attempt'] ++;
    }
}



if (!$cheating) {
    $attempt = isset($_SESSION['attempt']) ? $_SESSION['attempt'] : 0;
    $_SESSION['current_module'] = $current_module;
}

$allowed_time = 10; // in minutes

if (isset($_SESSION['test_started_on'])) {
    
} else {
    $_SESSION['test_started_on'] = time();
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"  >
<html lang="en" xml:lang="en" xmlns= "http://www.w3.org/1999/xhtml"   

<?php 

if ($details['language'] == 'Kurdish' || $details['language'] == 'Urdu' || $details['language'] == 'Arabic' || $details['language'] == 'Farsi')
{ 
echo "dir=\"rtl\"";
}

?>>


      <head>
        <title>Examination</title>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
        <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
<link rel="stylesheet" type="text/css" href="css/moduleQA.css"/>

<?php 
if ($details['language'] == 'Arabic' || $details['language'] == 'Urdu' || $details['language'] == 'Thai' || $details['language'] == 'Kurdish' || $details['language'] == 'Bengali')
{ 
?>
<link rel="stylesheet" type="text/css" href="css/fontSize3.css"/>
<?php
} 
else if ($details['language'] == 'Hindi' || $details['language'] == 'Gujarati' || $details['language'] == 'Punjabi')
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


       
<?php 
if (DEMO_MODE) { ?>
            <style>
                body {background:url(images/demo-bg.jpg)}
            </style>
<?php }
 ?>

       



    </head>
    <body>


        <div id="blk-wrapper">

            <div id="icon-wrapper">    
                <div id="icon-container">
                    <div class="<?php echo ($attempt < 2) ? 'icon-on' : 'icon-off' ?>" style="float:left"></div>
                    <div class="<?php echo ($attempt < 1) ? 'icon-on' : 'icon-off' ?>" style="float:right"></div>
                </div>
            </div>

            <div id="score-container"> <p class="score-icon"><?php echo (int) $attempt < 2 ? (2 - (int) $attempt) .'x'.  /*CHANCE REMAINING*/ $csv[0][1] :  /*FAILED ATTEMPT*/ $csv[1][1] ?></p></div>
            <div id="time-container"> 
                <p class="time-readout"><span  id="r"></span></p>
            </div>
            <?php $elapsed_time = time() - (int) $_SESSION['test_started_on']; ?>
     <script type="text/javascript">
                time =<?php echo ceil(($allowed_time - $elapsed_time / 60) * 60) ?>, r = document.getElementById('r'), tmp = time;
                if (time > 0) {
                    var timer = setInterval(function () {
                        var c = tmp--, m = (c / 60) >> 0, s = (c - m * 60) + '';
                        r.textContent = m + ':' + (s.length > 1 ? '' : '0') + s
                        //tmp!=0||(tmp=time);
                        if (tmp == 0) {
                            clearInterval(timer);
                            location.href = 'module_timeout.php';
                        }
                    }, 1000);
                }
            </script>   
        </div>

		
<?php 
/*
echo  '<br/>';
echo  '$courseDetails["course_ID"] '.   $courseDetails['course_ID'];
echo  '<br/>';
echo  '$current_module '.   $current_module;
echo  '<br/>';
echo  '$current_question '.   $current_question;
echo  '<br/>';
echo  '<br/>';
*/
?>
		
		
<!-- div1 -->
		
<div class="moduleContainer">



<?php
if  ($courseDetails["course_ID"] == 7)  
{   
if  ($current_module == 4 && $current_question == 5 ) {
?>
				<div class="modulePicRight">
<img src="images/COSHH/<?php echo $data[8] ?>" style="width:100%">  
</div>
		
<?php    } 
else if  ($current_module == 5 && $current_question == 3 ) {
?>
				<div class="modulePicRight">
<img src="images/COSHH/<?php echo $data[8] ?>" style="width:100%">  
</div>
		
<?php    } 
} 
 ?>       


	
	
	
	
<div 
<?php
if  ($courseDetails["course_ID"] == 7)  
{   
if  ($current_module == 4 && $current_question == 5 )  {
?>
 class="questionHalf" 
<?php   } 
else if  ($current_module == 5 && $current_question == 3 ) {  ?>   
 class="questionHalf"  <?php    }  
else  {  ?>   class="questionFull"  <?php    }   
}   else  {  ?>   class="questionFull"  <?php    }   ?>
 	>
	
	
	
             <h3 class="moduleTitle"><?php /*Module*/ echo $csv[7][1].' ';  
			 if ($courseDetails['course'] == 'allergen' && $current_module == '2') 
			 		{
			 echo $current_module . ' (Part1): ' . $module_title[0];
			        }
			 elseif ($courseDetails['course'] == 'allergen' && $current_module == '3') 
		        	{
			 echo $current_module -1 . ' (Part2): ' . $module_title[0];
			        }
					elseif ($courseDetails['course'] == 'allergen' && $current_module > '3')
					{
			 echo $current_module -1 . ': ' . $module_title[0];
			        }
					else
					{
			 echo $current_module . ': ' . $module_title[0];
			        }
 ?></h3>
		 
						 
             
                    <?php   if ($attempt < 2) { ?>
            <h3><?php /*Question*/ echo $csv[8][1].' '.$current_question; ?></h3>
                            <p class="moduleText"><?php echo $data[0] ?></p>						
                            <form method="post" action="" id="form1">
        <?php if (strlen($data[1])) { ?>
            <?php echo $data[1] ?>
                                <?php } ?>	


<?php
if  ($courseDetails["course_ID"] == 7)  
{   
if  ($current_module == 4 && $current_question == 5 ) {
?>
				<div class="modulePicRes">
<img src="images/COSHH/<?php echo $data[8] ?>" style="width:100%">  
</div>
		
<?php    } 
else if  ($current_module == 5 && $current_question == 3 ) {
?>
				<div class="modulePicRes">
<img src="images/COSHH/<?php echo $data[8] ?>" style="width:100%">  
</div>
		
<?php    } 
} 
 ?>       
								
								
								
								
                                <table width="100%" border="0" cellspacing="0" cellpadding="1" > 
                                    
									<tr>
                                        <td>
										  <label>
                  <input name="answer" type="radio" value="A" class="qaButton" <?php if ($correct_answer) {
                                    echo ' disabled="disabled"';
                                    if ($_POST['answer'] == 'A') echo ' checked="checked"';
                                }  ?> />
                    <span class="multipleChoice"><?php echo $data[2] ?></span>
									  </label>	
									  </td>
                                    </tr>
									
                                 <tr>
                             <td>
							<label>
							 <input name="answer" type="radio" value="B" class="qaButton" <?php if ($correct_answer) {
                                    echo ' disabled="disabled"';
                                    if ($_POST['answer'] == 'B') echo ' checked="checked"';
                                }  ?> />
              <span class="multipleChoice"><?php echo $data[3] ?></span>
									  </label>
									  </td>
                                    </tr>
									
        <?php if (strlen($data[4]) && strlen($data[5])) { ?>
                                        <tr>
                                            <td>
								  <label>
					<input name="answer" type="radio" value="C" class="qaButton" <?php if ($correct_answer) {
                echo ' disabled="disabled"';
                if ($_POST['answer'] == 'C') echo ' checked="checked"';
            }  ?> />
                <span class="multipleChoice"><?php echo $data[4] ?></span>
										  </label>
								 </td>
                            </tr>
										
                                        <tr>
                                            <td>
									  <label>
						<input name="answer" type="radio" value="D" class="qaButton" <?php if ($correct_answer) {
                                echo ' disabled="disabled"';
                                if ($_POST['answer'] == 'D') echo ' checked="checked"';
                            }  ?> />
            <span class="multipleChoice"><?php echo $data[5] ?></span>
									  </label>
									  </td>							
                                        </tr>
                                <?php } ?>
                                </table>

					
                                <?php if ($correct_answer) { ?>
                                    <?php
                                    $current_question++;
                                    if ($current_question == $row - 1 || ($details['language'] == 'English' && $current_question > 5)) {
                                        $sql = "UPDATE `user` SET `" . $current_module . "`='Yes' WHERE username= '" . $_SESSION["username"] . "'";
                                        mysql_query($sql);
                                        
                                        unset($_SESSION['test_started_on']);

                                        $next_link = 'result_qa.php?module=' . $current_module;
                                    } else {
                                        $next_link = 'module_qa.php?module=' . $current_module . '&question=' . $current_question;
                                    }
                                    ?>
                                    <h3><?php /*Correct!!*/ echo $csv[10][1]; ?></h3>
                                    <p class="moduleText"><?php /*Answer*/ echo $data[7]; ?></p>
                              <input type="button" onclick="window.location.href = '<?php  /*Module*/ echo $next_link ?>'" value="<?php /*Proceed*/ echo $csv[3][1]; ?>" class="log-button" />
                            <?php } else { ?>

                                    <hr/>
                                    <input name="submit" type="submit" value="<?php  /*Submit*/ echo $csv[2][1]; ?>"  class="log-button" />
                            <?php } ?>
                            </form>
                       
                        <?php } else { ?>
              <p class="moduleText"><?php echo  /*Failed Module. You answered the question incorrectly 2 times.*/ $csv[13][1]; ?></p>	
                            <div class="buttons-fail">

                             <div class="button-fail-left">                            	<form method="post">
	<input type="button" value="<?php echo  /*Please Try Again*/ $csv[4][1]; ?>" 
	onclick="location.href='user-admin.php'"      class="log-button">
	</form>  </div></div>
	
<?php 
date_default_timezone_set('Europe/London');
$timestamp = time(); 
$timeInsert = date('Y-m-d H:i:s', $timestamp);
	
mysql_query("insert into user_attempts (`module`, `attempt_time`, `status`, `user_id`, `course_ID`) values ('$current_module','$timeInsert', 'fail', '$user_id', '".$details['course']."')"); 
			  
               unset($_SESSION['attempt']);
               unset($_SESSION['random_questions']); 
			   unset($_SESSION['test_started_on']); 
			   $_SESSION['returnAdmin'] = 1;
?>
			   
			   
                            <script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
             <script type="text/javascript">
						//	$('#time-container').hide();
                                jQuery('#time-container').hide();
                                if (typeof timer !== 'undefined')
                                    clearInterval(timer);
                            </script>
                        <?php } ?>
                        <?php if ($incorrect_answer && $attempt < 2) { ?>
              <p class="moduleText"><?php  /*That is incorrect (please try again)*/ echo $csv[11][1]; ?></p>
                        <?php } ?>

</div>
	
		
		
</div>
<!-- div1 -->
		
		
	
		
		
		
    </body>
</html>