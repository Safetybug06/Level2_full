<?php include('../config.php'); ?>
<?php
if(!isset($_SESSION["admin_username"]) || !isset($_SESSION["admin_fullname"]) || !isset($_SESSION["site_admin"]) || !(int)$_SESSION["site_admin"]) {
	exit;
}

if (isset($_POST['site']) && !empty($_POST['site'])) {
	mysql_query("INSERT INTO site SET order_number='".$_SESSION['order_number']."', site='".trim(mysql_real_escape_string($_POST['site']))."'");
}

if (isset($_POST['delete_site']) && !empty($_POST['delete_site']) && is_array($_POST['delete_site'])) {
	foreach ($_POST['delete_site'] as $site_id) {
		mysql_query("DELETE FROM site WHERE order_number='".$_SESSION['order_number']."' AND id='".(int)$site_id."'");
		mysql_query("DELETE FROM redirects WHERE order_number='".$_SESSION['order_number']."' AND siteID='".(int)$site_id."'");
	}
}


if (isset($_GET['mode']) && $_GET['mode'] == 'select') {
    echo '<option value="">Choose Site</option>
<option value="split"'.(isset($_GET['selected']) && $_GET['selected'] == 'split' ? ' selected="selected"' : '').'>Split-by-Site</option>';
}

if (isset($_GET['mode']) && $_GET['mode'] == 'select2') {
    echo '<option value="">Choose Site</option>';
}

$sql = "SELECT * FROM site WHERE order_number='".$_SESSION['order_number']."' ORDER BY site";
$query = mysql_query($sql);

if (isset($_GET['mode']) && ($_GET['mode'] == 'select2')) {
 while($row = mysql_fetch_assoc($query)) {	
?> 
	<option value="<?php echo $row['id'] ?>"<?php if (isset($_GET['selected']) && (int)$_GET['selected'] == $row['id']) echo ' selected="selected"'; ?>><?php echo $row['site'] ?></option>
<?php }die;}

$i = 0; while($row = mysql_fetch_assoc($query)) {
	if (isset($_GET['mode']) && ($_GET['mode'] == 'select' || $_GET['mode'] == 'select2')) {
?> 
	<option value="<?php echo $row['id'] ?>"<?php if (isset($_GET['selected']) && (int)$_GET['selected'] == $row['id']) echo ' selected="selected"'; ?>><?php echo $row['site'] ?></option>
<?php } else { ?>
	<tr>
	  <td class="admin-border-right"><?php echo $row['site'] ?></td>
		 <td style="padding:10px"><input name="delete_site[]" type="checkbox" id="site_<?php echo $row['id'] ?>" value="<?php echo $row['id'] ?>"></td>
	</tr>
<?php } ?>
<?php $i++; } ?>  