<?php

/* 
 * To update user table after all modules passed.
 * 
 */

include 'config.php';

if (!isset($_SESSION["user_id"]) || empty($_POST) || !isset($_POST['year_ago']) || !isset($_POST['order_number']) || $_POST['year_ago'] < 1 || strpos($_POST['order_number'], '%') === false) {
  header('location:admin-serials.php'); exit;
}

$sn__years_ago = $_POST['year_ago'];
$order_number = $_POST['order_number'];

$s = mysql_query("SELECT * FROM `sign-up` WHERE `order_number` LIKE '" . $order_number . "' ORDER BY `sign-up`.`order_number` ");
  while ($r = mysql_fetch_assoc($s)) {
    $sql_D = "DELETE FROM `user` INNER JOIN user_attempts ON user_attempts.user_id = user.ID WHERE user.`8` = 'yes' AND user.username IS NULL AND user.activated = 'No' "
            . "AND user.date_activated < DATE_SUB(NOW(),INTERVAL " . $sn__years_ago . " YEAR) AND user.date_activated > DATE_SUB(NOW(),INTERVAL " . ($sn__years_ago + 1) . " YEAR) AND user_attempts.status = 'pass' AND user.`order-number` ='" . $r['order_number'] . "'";
    $sql = "SELECT DISTINCT ID, serial FROM `user` INNER JOIN user_attempts ON user_attempts.user_id = user.ID WHERE user.`8` = 'yes' AND user.username IS NULL AND user.activated = 'No' "
            . "AND user.date_activated < DATE_SUB(NOW(),INTERVAL " . $sn__years_ago . " YEAR) AND user.date_activated > DATE_SUB(NOW(),INTERVAL " . ($sn__years_ago + 1) . " YEAR) AND user_attempts.status = 'pass' AND user.`order-number` ='" . $r['order_number'] . "'";
   
    $data = mysql_query($sql) or die(mysql_error());    
    while ($row = mysql_fetch_assoc($data)) {
      $sql_del = "DELETE FROM user WHERE `order-number` = '" . $r['order_number'] . "' AND serial = '" . $row['serial'] . "'  AND ID = '" . $row['ID']. "'";
      mysql_query($sql_del) or die(mysql_error());
      
      $sql_del = "DELETE FROM user_attempts WHERE user_id = '" . $row['ID']. "'";
      mysql_query($sql_del) or die(mysql_error());
    }
  }
  
  header('location:admin-serials.php');
#$sql = "SELECT * FROM user u left join user_attempts ua ON ua.user_id = u.ID WHERE u.`8` = 'yes' AND u.username IS NULL AND u.activated = 'No' AND u.date_activated < DATE_SUB(NOW(),INTERVAL " . $sn__years_ago . " YEAR) AND ua.status = 'pass'";
#$data = mysql_query($sql) or die(mysql_error());
#while ($row = mysql_fetch_array($data)) {}
