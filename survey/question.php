<?php
session_start();
include('../config.php'); 
//needs mailer functions

	if(!isset($_SESSION["username"]) && !isset($_SESSION["fullname"])) {
		header("location: ../log-in.php");	
		exit;	
	}
	
	
 if(empty($_SESSION['count'])) $_SESSION['count'] = 1;

if(isset($_POST['submit'])){
    $quesno = $_SESSION['count'];
    
    if(isset($_POST['questionButton']) == 'Very'){
        $_SESSION['ques_'.$quesno] = $_POST['questionButton'];
    }
	elseif(isset($_POST['questionButton']) == 'Mediocre'){
        $_SESSION['ques_'.$quesno] = $_POST['questionButton'];
    } 
	elseif(isset($_POST['questionButton']) == 'Not at all'){
        $_SESSION['ques_'.$quesno] = $_POST['questionButton'];
    }
	else 
	{
	 $_SESSION['generalComments'] = filter_var(ucwords($_POST['generalComments']), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
	}

$_SESSION['count']++;  
header('Location: question.php');
exit();
}

$questionNumber =  $_SESSION['count'];

$csv_lines = file('questions.csv');

if ($questionNumber > 5)
{

$body = 
"Survey received from following user:<br/>
<br/>
Name: ".$_SESSION['fullname']."<br/>
Course: ".$_SESSION["surveyCourse"]."<br/>
Language: ".$_SESSION['surveyLanguage']."<br/>
Order No: ".$_SESSION['surveyOrder']."<br/>
-----------------------------------------
<br/>
1. How effective was the course at helping you reach your learning objectives? ".$_SESSION['ques_1']."<br/>
2. How easy was the course to use? ".$_SESSION['ques_2']."<br/>
3. Were all the images and text in the course clearly visible? ".$_SESSION['ques_3']."<br/>
4. Was the information in the course easily Understandable? ".$_SESSION['ques_4']."<br/>
5. Do you have any comments regarding the course?<br/>
".$_SESSION['generalComments'];


$webMaster = "contactroberto@hotmail.com";
//$webMaster = "info@safetybugtraining.com";
$emailSubject = "Course Survey";

$success = send_email($webMaster, AUTOMATED_EMAIL, SMTP_HOST, SMTP_PORT, SMTP_USER, SMTP_PASS, COMPANY_NAME, $emailSubject, $body);


header('Location: complete.php');
//session_destroy();
exit();

}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xml:lang="en" xmlns= "http://www.w3.org/1999/xhtml">
<head>
<title>User Feedback</title>
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />

<link rel="stylesheet" type="text/css" href="../css/moduleQA.css"/>
<link rel="stylesheet" type="text/css" href="../css/fontSize1.css"/>


  
	<script src="../js/jquery-1.7.1.min.js" type="text/javascript"></script>
	<script src="jquery.survey.validate.min.js" type="text/javascript"></script>

<script type='text/javascript'>//<![CDATA[
$(function(){
function validationDemo() {

    $("#questionForm").validate({
        ignore:[],
		rules: {
            questionButton: {
                required: function () {
                    return $('[name="questionButton"]:checked').length === 0;
                }
            },
        },
        messages: {
            questionButton: {
                required: "Please select one"
            }
        },

        errorPlacement: function (error, el) {
if (el.attr('name') === 'questionButton') {     error.appendTo('#groupErrors');       } 
/*else {             error.appendAfter(el);            }*/
        },

    });
}

validationDemo();
});//]]> 

</script>

</head>
<body>
<?php  
/*
echo '$_SESSION["username"] ' .$_SESSION["username"];
echo '<br/>'; 
echo '$_SESSION["fullname"] ' .$_SESSION["fullname"];
*/
?>

   <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td width="10%">&nbsp;</td>	
                <td>

    <h3 class="moduleTitle">Course Feedback</h3>
    <hr/>
          <h3>Question <?php echo $questionNumber;?></h3>
<p class="moduleText">
<?php 
if ($questionNumber == 5)
{
?>
Do you have any comments regarding the course?
<?php 
} 
else
{
//echo $csv_lines[$questionNumber]; 
echo (isset($csv_lines[$questionNumber])) ? $csv_lines[$questionNumber]: '';
}
?>
</p>

<form id="questionForm"  action="#"   method="post">

<?php 
if ($questionNumber == 5)
{
?>

<textarea name="generalComments" class="surveyText"></textarea>
<?php 
}
else
{
?>

<table width="100%" border="0" cellspacing="0" cellpadding="1" > 

<tr>
<td>   
<label>
<input type="radio" id="radio01" name="questionButton"  value="Very" class="qaButton"  />
<span class="multipleChoice">Very</span>
</label>	
</td>
</tr>
 
<tr>
<td> 
<label> 
<input type="radio" id="radio02" name="questionButton"  value="Mediocre" class="qaButton"  />
<span class="multipleChoice">Mediocre</span>
</label>
</td>
</tr>

<tr>
<td>  
<label>
<input type="radio" id="radio03" name="questionButton"  value="Not at all" class="qaButton"  />
<span class="multipleChoice">Not at all</span>
</label>
</td>
</tr>
</table>
<?php 
}
?>

    <hr/>

	<input  type="submit" value="Submit"  name="submit"  class="log-button"     />
         <p class="q" id="groupErrors"></p>



</form>

            </td>
                <td width="10%">&nbsp;</td>	
            </tr>
        </table>


</body>
</html>
