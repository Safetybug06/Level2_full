<?php
session_start();

	if(!isset($_SESSION["username"]) && !isset($_SESSION["fullname"])) {
		header("location: ../log-in.php");	
		exit;	
	}
?>
	
	
	
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xml:lang="en" xmlns= "http://www.w3.org/1999/xhtml">
<head>
<title>User Feedback</title>
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />

<link rel="stylesheet" type="text/css" href="../css/moduleQA.css"/>
<link rel="stylesheet" type="text/css" href="../css/fontSize1.css"/>


</head>

<body>

   <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td width="10%">&nbsp;</td>	
                <td>


  <h3 class="moduleTitle">Course Feedback</h3>
    <hr/>
   
          <p class="moduleText"><strong>Thank you</strong> for participating in our survey.</p>


<div class="form-container">


             	<form method="post">
	<input type="button" value="Log-Out" 
	onclick="location.href='../logout.php';"      class="log-button">
	</form>
	
	
</div>

 





</body>
</html>
