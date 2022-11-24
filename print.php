<?php 

include('config.php');


$sql = "SELECT * FROM course WHERE course_ID = '".$_POST['courseSelect']."'";
$result = mysql_query($sql) or die(mysql_error());
$courseDetails = mysql_fetch_assoc($result);


$_SESSION['numberModules'] = $courseDetails['modules'];
  


if (!isset($_SESSION["admin_username"]) || !isset($_SESSION["admin_fullname"])) {
  header("location: admin.php");
  exit;
}
if(isset($_SESSION['posteddata']))
  unset($_SESSION['posteddata']);


$_SESSION['posteddata'] = $_POST;



 
function get_completed_date($user_id){
    $sql = "SELECT * FROM `user_attempts` where `user_id` = $user_id and `module` = '".$_SESSION['numberModules']."' and `status` = 'pass' and `course_ID` = '".$_POST['courseSelect']."'    order by `attempt_time` desc";
    $data = mysql_query($sql);
    $row = mysql_fetch_row($data);
    
    if($row){
      return date('d/m/y',strtotime($row[2]));
    }else{
      return "N/A";
    }
}
function get_color_bars($user_id){
    $sql = "SELECT * FROM `user_attempts` where `user_id` = $user_id and `status` = 'pass' and `module` = '".$_SESSION['numberModules']."'  and `course_ID` = '".$_POST['courseSelect']."'  order by `attempt_time` desc";
    $data = mysql_query($sql);
    $row = mysql_fetch_row($data);
    
    if($row)
	{
	
    if($_POST['courseSelect'] == 1)
	{
      return '<div class="green"></div>
<div class="green"></div>
<div class="green"></div>
<div class="green"></div>
<div class="green"></div>
<div class="green"></div>
<div class="green"></div>
<div class="green"></div>';
    }
	else {
      return '<div class="green"></div>
<div class="green"></div>
<div class="green"></div>
<div class="green"></div>
<div class="green"></div>';
    }
	
	}
	
	
	
	else{
        $sql_usr = "SELECT count(*) as ct FROM `user_attempts` where `user_id` = $user_id and `status` = 'pass'  order by `attempt_time` asc";
        $data_usr = mysql_query($sql_usr);
        $row_usr = mysql_fetch_row($data_usr);
        $str_usr = "";
	    if($_POST['courseSelect'] == 2)
		{
        if($data_usr)
        {
		if ($row_usr[0] == '1' || $row_usr[0] == '2')
		{
		  $str_usr = '<div class="red"></div>
              <div class="grey"></div>
              <div class="grey"></div>
              <div class="grey"></div>
              <div class="grey"></div>';
		}
		elseif ($row_usr[0] == '3')
		{
		  $str_usr = '<div class="red"></div>
              <div class="red"></div>
              <div class="grey"></div>
              <div class="grey"></div>
              <div class="grey"></div>';
	    }
		elseif ($row_usr[0] == '4')
		{
		  $str_usr = '<div class="red"></div>
              <div class="red"></div>
              <div class="red"></div>
              <div class="grey"></div>
              <div class="grey"></div>';
	    }
		else 
		{
		  $str_usr = '<div class="red"></div>
              <div class="red"></div>
              <div class="red"></div>
              <div class="red"></div>
              <div class="grey"></div>';
		}
	    }
		
			  }
			  
			  
			  
			  
			  
			  else  if($data_usr)
			  {
			  
		   for($t=0;$t< $_SESSION['numberModules']; $t++){
              if($t<$row_usr[0]){
                $str_usr = $str_usr.'<div class="red"></div>';  
              }
              else{
                $str_usr = $str_usr.'<div class="grey"></div>';  
              }
          }
        }
		

		
        return $str_usr;
    }
	
	
	
}






if($_POST['submit'] == "Generate Report")
{
   // if(!isset($_POST['selectSite'])){
      $order_number = $_SESSION['order_number'];
      $order_number = explode("-", $order_number);
      $order_number[1] = "%";
      $res_order_number = $order_number;
      $res_order_number[0] = 'RES';
      $order_number = implode("-", $order_number);
      $res_order_number = implode('-', $res_order_number);
      $ss__order_number = $order_number;


      $s = mysql_query("SELECT * FROM `sign-up` WHERE `order_number` LIKE '" . str_replace('SBT', '%', $order_number) . "' ORDER BY SUBSTRING_INDEX(order_number, '-', -2) ASC");
      
       $order_array = array();
       while ($r = mysql_fetch_assoc($s)) {


          if(strpos($r['order_number'],'RES-') !== false) {
            

          }else{
            $order_array[] = "'".$r['order_number']."'";
          }
          
      }
      
      $order_array = array_filter($order_array);

      if (!empty($order_array)) {
          $order_str = implode (", ", $order_array);
      }


    if(isset($_POST['selectSite'])){
     
        $sitearr = array_filter($_POST['selectSite']);
    }

    if(isset($_POST['courseActivity'])){
      if(isset($_POST['selectSite'])){
        if(in_array("All Sites",$sitearr)){
          $sitearr = array_flip($sitearr);
          unset($sitearr['All Sites']);
          $sitearr = array_values(array_flip($sitearr));
        }
      }

      
if($_POST['courseActivity'] == "7"){
              $courseact = $_POST['courseActivity'];
              

               if(isset($_POST['selectSite'])){
                  if (in_array("unallocated", $_POST['selectSite']) && count($_POST['selectSite']) == 1){
                      
                      $all_query = "SELECT * FROM `user` as u,`user_attempts` as ua,`site` as s where ua.`attempt_time` > DATE_SUB(NOW(), INTERVAL 7 DAY) and u.`order-number` IN ( $order_str ) and u.`site_id` = 0 and u.`ID` = ua.`user_id` and ua.`module` = 1   and ua.`course_ID` = '".$_POST['courseSelect']."'  group by u.`ID` ORDER BY ua.`attempt_time` DESC";
                  }
                   elseif (in_array("unallocated", $_POST['selectSite'])){
                      $all_query = "SELECT * FROM `user` as u,`user_attempts` as ua,`site` as s where ua.`attempt_time` > DATE_SUB(NOW(), INTERVAL 7 DAY) and u.`order-number` IN ( $order_str ) and (u.`site_id` = s.`id` || u.`site_id` = 0) and u.`ID` = ua.`user_id` and ua.`module` = 1  and ua.`course_ID` = '".$_POST['courseSelect']."'   group by u.`ID` ORDER BY ua.`attempt_time` DESC";

                  }else{
                      $site_str = implode (", ", $sitearr);
                      $all_query = "SELECT * FROM `user` as u,`user_attempts` as ua,`site` as s where ua.`attempt_time` > DATE_SUB(NOW(), INTERVAL 7 DAY) and u.`site_id` IN ( $site_str ) and u.`site_id` = s.`id` and u.`ID` = ua.`user_id` and ua.`module` = 1  and ua.`course_ID` = '".$_POST['courseSelect']."'   group by u.`ID` ORDER BY ua.`attempt_time` DESC";
                  }
               }else{
                
                $all_query = "SELECT * FROM `user` as u,`user_attempts` as ua where u.`order-number` IN ( $order_str ) and ua.`attempt_time` > DATE_SUB(NOW(), INTERVAL 7 DAY) and u.`ID` = ua.`user_id`  and ua.`module` = 1   and ua.`course_ID` = '".$_POST['courseSelect']."'  group by u.`ID` ORDER BY ua.`attempt_time` DESC";
               }

      
              
              $final_query = mysql_query($all_query);
              $main_number_of_rows = mysql_num_rows($final_query);  
              if($main_number_of_rows >= 0){
                $total_pages = ceil($main_number_of_rows/30);
              }else{
                $total_pages = 1;
              }

        }else if($_POST['courseActivity'] == "30"){
              $courseact = $_POST['courseActivity'];
              
              if(isset($_POST['selectSite'])){


                if (in_array("unallocated", $_POST['selectSite']) && count($_POST['selectSite']) == 1){
                      
                      $all_query = "SELECT * FROM `user` as u,`user_attempts` as ua,`site` as s where ua.`attempt_time` > DATE_SUB(NOW(), INTERVAL 30 DAY) and u.`order-number` IN ( $order_str ) and u.`site_id` = 0 and u.`ID` = ua.`user_id` and ua.`module` = 1   and ua.`course_ID` = '".$_POST['courseSelect']."'  group by u.`ID` ORDER BY ua.`attempt_time` DESC";
                  }
                   elseif (in_array("unallocated", $_POST['selectSite'])){
                      $all_query = "SELECT * FROM `user` as u,`user_attempts` as ua,`site` as s where ua.`attempt_time` > DATE_SUB(NOW(), INTERVAL 30 DAY) and u.`order-number` IN ( $order_str ) and (u.`site_id` = s.`id` || u.`site_id` = 0) and u.`ID` = ua.`user_id` and ua.`module` = 1   and ua.`course_ID` = '".$_POST['courseSelect']."'  group by u.`ID` ORDER BY ua.`attempt_time` DESC";
                  }else{
                      $site_str = implode (", ", $sitearr);
                      $all_query = "SELECT * FROM `user` as u,`user_attempts` as ua,`site` as s where ua.`attempt_time` > DATE_SUB(NOW(), INTERVAL 30 DAY) and u.`site_id` IN ( $site_str ) and u.`site_id` = s.`id` and u.`ID` = ua.`user_id` and ua.`module` = 1   and ua.`course_ID` = '".$_POST['courseSelect']."'  group by u.`ID` ORDER BY ua.`attempt_time` DESC";
                  }
              }else{
                
                $all_query = "SELECT * FROM `user` as u,`user_attempts` as ua where u.`order-number` IN ( $order_str ) and ua.`attempt_time` > DATE_SUB(NOW(), INTERVAL 30 DAY) and u.`ID` = ua.`user_id` and ua.`module` = 1  and ua.`course_ID` = '".$_POST['courseSelect']."'   group by u.`ID` ORDER BY ua.`attempt_time` DESC";
              }
              
              
              $final_query = mysql_query($all_query);
              $main_number_of_rows = mysql_num_rows($final_query);  
              if($main_number_of_rows >= 0){
                $total_pages = ceil($main_number_of_rows/30);
              }else{
                $total_pages = 1;
              }
			  
			 } else if($_POST['courseActivity'] == "12"){
              $courseact = $_POST['courseActivity'];
              
              if(isset($_POST['selectSite'])){


                if (in_array("unallocated", $_POST['selectSite']) && count($_POST['selectSite']) == 1){
                      
                      $all_query = "SELECT * FROM `user` as u,`user_attempts` as ua,`site` as s where ua.`attempt_time` > DATE_SUB(NOW(), INTERVAL 12 MONTH) and u.`order-number` IN ( $order_str ) and u.`site_id` = 0 and u.`ID` = ua.`user_id` and ua.`module` = 1   and ua.`course_ID` = '".$_POST['courseSelect']."'  group by u.`ID` ORDER BY ua.`attempt_time` DESC";
                  }
                   elseif (in_array("unallocated", $_POST['selectSite'])){
                      $all_query = "SELECT * FROM `user` as u,`user_attempts` as ua,`site` as s where ua.`attempt_time` > DATE_SUB(NOW(), INTERVAL 12 MONTH) and u.`order-number` IN ( $order_str ) and (u.`site_id` = s.`id` || u.`site_id` = 0) and u.`ID` = ua.`user_id` and ua.`module` = 1   and ua.`course_ID` = '".$_POST['courseSelect']."'  group by u.`ID` ORDER BY ua.`attempt_time` DESC";
                  }else{
                      $site_str = implode (", ", $sitearr);
                      $all_query = "SELECT * FROM `user` as u,`user_attempts` as ua,`site` as s where ua.`attempt_time` > DATE_SUB(NOW(), INTERVAL 12 MONTH) and u.`site_id` IN ( $site_str ) and u.`site_id` = s.`id` and u.`ID` = ua.`user_id` and ua.`module` = 1   and ua.`course_ID` = '".$_POST['courseSelect']."'  group by u.`ID` ORDER BY ua.`attempt_time` DESC";
                  }
              }else{
                
                $all_query = "SELECT * FROM `user` as u,`user_attempts` as ua where u.`order-number` IN ( $order_str ) and ua.`attempt_time` > DATE_SUB(NOW(), INTERVAL 12 MONTH) and u.`ID` = ua.`user_id` and ua.`module` = 1  and ua.`course_ID` = '".$_POST['courseSelect']."'   group by u.`ID` ORDER BY ua.`attempt_time` DESC";
              }
              
              
              $final_query = mysql_query($all_query);
              $main_number_of_rows = mysql_num_rows($final_query);  
              if($main_number_of_rows >= 0){
                $total_pages = ceil($main_number_of_rows/30);
              }else{
                $total_pages = 1;
              }
			  
			  

        }

    }

}
if($main_number_of_rows == 0){
    if(isset($_POST['selectSite']) && isset($_POST['courseActivity'])){
      header("location: generate-report.php?err=nositeactivtity");
      exit;
      }
      if(!isset($_POST['selectSite']) && isset($_POST['courseActivity'])){
      header("location: generate-report.php?err=noactivtity");
      exit;
      }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title></title>
<link type="text/css" rel="stylesheet" href="css/main.css"/>
  <!-- Normalize or reset CSS with your favorite library -->
  <link rel="stylesheet" href="css/normalize.css">

  <!-- Load paper.css for happy printing -->
  <link rel="stylesheet" href="css/paper.css">
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A400%2C600%7CPermanent+Marker%3A400%7CUbuntu%3A400&#038;" rel="stylesheet">
  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "landscape" if you need -->

  
<style type="text/css">
@page                {size:A4}
body                 {font-family:arial}
.main-table          {border:1px solid #000; border-collapse:collapse}
.main-table td       {border:1px solid #000; height:25px; font-size:12px; margin:2px 2px 1px 2px; padding-left:2px}
/*.grey                {width:22px; height:1px; border-top:24px solid #F5F5F5; margin:2px 2px 1px 2px; float:left}*/
.grey                {width:22px; height:1px; border-top:24px solid #F5F5F5; margin:2px 2px 1px 2px; float:left}
.green               {width:22px; height:1px; border-top:24px solid #058040; margin:2px 2px 1px 2px; float:left}
.red                 {width:22px; height:1px; border-top:24px solid #FF0000; margin:2px 2px 1px 2px; float:left}
.bottom              {width:714px;  position: absolute;    bottom: 50px;  left: 40px; right: 40px;    font-size:13px}
</style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="A4"><script>
function myFunction() {
    window.print();
}
</script>
<button onClick="myFunction()" class="log-button"  style="position: fixed; top: 20px; right: 190px; z-index:100000" >Print Report</button>
<button onClick="document.location.href='generate-report.php'"  class="log-button"  style="position: fixed; top: 20px; right: 20px; z-index:100000" >Back</button>
  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
  

<?php
if($_POST['courseActivity'] == "12"){
    $duration = "12 Months";
  } 
  if($_POST['courseActivity'] == "7"){
    $duration = "7 Days";
  }  
  if($_POST['courseActivity'] == "30"){
    $duration = "30 Days";
  }   
if($main_number_of_rows > 0){

if($final_query)
{ 
  

    $cnt = 1;
    $page = 1;

    while ($row_data = mysql_fetch_assoc($final_query)) {

      if(($cnt%30) == 1){


?>
              <section class="sheet padding-10mm">

              
              <article>
              <table  style="width:100%; margin-bottom:15px">
              <tr>
              <td style="width:50%;"><img src="images/logo.png" alt="safety bug logo"/></td>
			                <td style="width:20%;"></td>
              <td style="width:30%; ">
		  <span style="font-size:19px;"><?php echo $courseDetails['course_name']; ?></span>
			  <br/>
		<span style="font-size:16px;">Progress Report: <strong><?php echo $duration; ?></strong></span>
			  </td>
              </tr>
              </table>

              <table width="100%" cellspacing="0" cellpadding="0" class="main-table">
              <tr style="font-weight:bold">
                   <td>Name</td>
                       <?php  if(isset($_POST['selectSite'])){ ?><td>Site</td> <?php } ?>
                      <td>Started</td>
                      <td>Completed</td>
               
 <td style="width:<?php   if($_POST['courseSelect'] == "1") { echo '210'; } else { echo '131'; } ?>px">Module Progress</td> 
              </tr>
        <?php 
        }
        ?>
<!--  header   -->

              <tr>         
 <td><?php echo $row_data['name']; ?></td>
 <?php  if(isset($_POST['selectSite'])){ ?><td><?php if($row_data['site_id'] <> 0) echo $row_data['site']; else echo "--"; ?></td><?php } ?>
  <td ><?php echo date('d/m/y',strtotime($row_data['attempt_time'])); //echo $startdte;  ?></td>
  <td ><?php echo get_completed_date($row_data['ID']); ?></td>
 <td>
<?php echo get_color_bars($row_data['ID']); ?>
</td>
</tr>  


        <?php if(($cnt%30) == 0 || $cnt == mysql_num_rows($final_query)){

          ?>

              </table>


        
        
<!--  footer  -->
<table class="bottom">
  <tr>
    <td style="width:70%;"><span style="font-weight:bold; line-height:20px">SafetyBugTraining Ltd.</span> 126 High Street, Cambridge, Cambridgeshire CB21 4JT<br/>Company No. 8210196 &#124; VAT Reg. 142258919 </td>
    <td style="width:30%; text-align:right;">Page <?php echo $page; ?>/<?php echo $total_pages; ?></td>
  </tr>
</table>
</article>

  </section>

          <?php $page++; } ?>



   <?php 
   $cnt++;
 }
 }
}
else{
  
  ?>
  <section class="sheet padding-10mm">

              
              <article>
              <table  style="width:100%; margin-bottom:15px">
              <tr>
              <td style="width:50%;"><img src="images/logo.png" alt="safety bug logo"/></td>
              <td style="width:50%;  font-size:20px; text-align:right">Progress Report: <span style="font-weight:bold"><?php echo $duration; ?></span></td>
              </tr>
              </table>

              <table width="100%" cellspacing="0" cellpadding="0" class="main-table">
              <tr style="font-weight:bold">
                   <td>Name</td>
                      <td>Site</td> 
                      <td>Started</td>
                      <td>Completed</td>
                      <td style="width:210px">Module Progress</td> 
              </tr>
              <tr>         
 <td colspan="5">No Records Found!!!</td>
</td>
</tr>  
</table>

        
        
        
        
<!--  footer  -->
<table class="bottom">
  <tr>
    <td style="width:70%;"><span style="font-weight:bold; line-height:20px">SafetyBugTraining Ltd.</span> 126 High Street, Cambridge, Cambridgeshire CB21 4JT<br/>Company No. 8210196 &#124; VAT Reg. 142258919 </td>
    <td style="width:30%; text-align:right;">Page 1/1</td>
  </tr>
</table>
</article>

  </section>
  <?php
  
}



   ?>   
      


        
  
 
  
 
</body>

</html>