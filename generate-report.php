<?php include('config.php'); ?>
<?php
/*echo "<pre>";
print_r($_SESSION);
exit;*/
if (!isset($_SESSION["admin_username"]) || !isset($_SESSION["admin_fullname"])) {
  header("location: admin.php");
  exit;
}

?>

<?php include('header.php'); ?>
<?php
if (isset($_GET['err']) && ($_GET['err'] == "nositeactivtity")){
	//unset($_SESSION['posteddata']);
	?>
	<script type="text/javascript">
		$(document).ready(function() {
		alert("No activity for sites selected");
		});
	</script>
	<?php
}
else{
	unset($_SESSION['posteddata']);
}
?>
<?php
if (isset($_GET['err']) && ($_GET['err'] == "noactivtity")){
	//unset($_SESSION['posteddata']);
	?>
	<script type="text/javascript">
		$(document).ready(function() {
		alert("No activity for date range selected");
		});
	</script>
	<?php

}else{
	unset($_SESSION['posteddata']);
}
?>
<div style="display: none;"><?php echo "<pre>";
print_r($_SESSION); ?></div>
<section class="header header-style2" style="background:linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.4)), url(images/img_04.jpg) 50% 50% ; background-size:cover;">
    <div class="header-content">
	    <h1>Print Report</h1>
    </div>
</section>






	<div id="content">

		
<script type="text/javascript">	

	$(document).ready(function() {
		$("#generate-pdf").validate({
		
		rules: {
		courseSelect: "required",
		courseActivity: "required",
		"selectSite[]": "required",
		},
			
		highlight: function(element, errorClass, validClass) {
	$(element).css("borderColor", "#ff0000");		
	//	$(element).parents('.err_highlight').css("borderColor", "#ff0000");
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).css("borderColor", "");
	//		$(element).parents('.err_highlight').css("borderColor", "#fff");
		},		

		messages: {
		courseSelect: "Please select course",
		courseActivity: "Please select course activity",
		"selectSite[]": "Please select sites"
		},
		
					errorPlacement: function (error, el) {
           if (el.attr('name') === 'courseSelect') {error.appendTo('#error_1'); } 
           if (el.attr('name') === 'courseActivity') {error.appendTo('#error_2'); } 
           if (el.attr('name') === 'selectSite[]') {error.appendTo('#error_3'); } 
        },

	});	
	});	


</script>


 	<h3 class="green">Generate Report</h3>

	
	


		

		
		<form id="generate-pdf" action="print.php" method="post">
		
<table class="activate-res">
<tr>
<td><p class="form-type-left"><strong>Course:</strong></p>
<select id="" name="courseSelect"   class="dropdown" >
<option value="">--Unspecified--</option>
<?php $sql_course = "SELECT * FROM course ORDER BY course_ID"; $courseSelect = mysql_query($sql_course); ?>
<?php while($row = mysql_fetch_assoc($courseSelect)) { ?>
<option value="<?php echo $row['course_ID'] ?>"><?php echo $row['course_name'] ?></option>
<?php } ?>
</select>
						<span id="error_1"></span>
</td>
</tr>
</table>
		
		
		
<table class="activate-res">
<tr>
<td>
<p class="form-type-left"><strong>Course Activity:</strong></p>
		<p>Please select the date range of the report you wish to print.</p>

<select id="" name="courseActivity"   class="dropdown" >
<option value="">--Unspecified--</option>
<!-- <option value="all">All time</option> -->
<option value="7">Last 7 days</option>
<option value="30">Last 30 days</option>
<option value="365">Last 12 months</option>
</select>
						<span id="error_2"></span>
</td>
</tr>
</table>







<?php if (isset($_SESSION["site_admin"]) && (int) $_SESSION["site_admin"]) { ?>

<p class="form-type-left"><strong>Select Site(s)</strong></p>
<p>Please select which sites to include in the report.</p>

<script type='text/javascript'>//<![CDATA[
$(window).load(function(){
$('#select-all').on('change', function() {
  $('.listSite input[type="checkbox"]').not( document.getElementById( "unallocated" ) ).prop('checked', this.checked);
});
$('.listSite input[type="checkbox"]').on('change', function () {
  var allChecked = $('.listSite input:checked').length === $('.listSite input').length;
  $('#select-all').prop('checked', allChecked);
});
});//]]> 

</script>
<?php 
$ord_id = $_SESSION['order_number'];

$sites_fetch = mysql_query("SELECT * FROM `site` where `order_number` =  '$ord_id' order by `id` ASC");
if (mysql_num_rows($sites_fetch)){

?>
						<span id="error_3"></span>
<table class="activate-res" style="border:1px solid #fff;">
<tr>
					<td><input  type="checkbox" value="All Sites"  id="select-all"  name="selectSite[]"></td>	
                    <td>All Sites</td>
</tr>
<?php while ($row = mysql_fetch_assoc($sites_fetch)) { ?>
<tr>
					<td  class="listSite"><input name="selectSite[]" type="checkbox" value="<?php echo $row['id']; ?>"   ></td>	
                    <td><?php echo $row['site']; ?></td>
</tr>

<?php } ?>
                    
  
<tr  style="background-color:#f2f2f2">
					<td  class="listSite1"><input id="unallocated" name="selectSite[]" type="checkbox" value="unallocated"  ></td>	
                    <td>Unallocated</td>
</tr>
		</table>

	<?php } } ?>

<table class="activate-res">
<tr>
					<td><input name="submit" type="submit" value="Generate Report"  class="log-button"  /></td>	
                    <td>    <input name="cancel" type="button" value="Cancel"  class="log-button" onClick="document.location.href='admin-serials.php'" /></td>
</tr>

</table>

</form>



			</div><!-- content -->
		</div><!-- wrapper -->
        
<?php include('footer.php') ?>