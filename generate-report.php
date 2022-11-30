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
<?php include('header2.php'); ?>
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

            <!-- Start Main Content Area -->
            <main class="main-content-wrap2">

             
		
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


             <!-- Process Section Start -->
             <div class="rs-process style1  pt-100 pb-100 md-pt-70 md-pb-70">
           <div class="container pb-54">
               <div class="process-effects-layer">
                   <div class="row">
                       
                       <div class="col-lg-12 col-md-6 md-mb-30">
                           <div class="rs-addon-number">
                               <div class="number-part">
                                   <a href="generate-report.html">
                                   <div class="number-image">
                                       <img src="assets/images/process/style1/report.png" alt="Process">
                                   </div>
                               </a>
                                   <div class="number-text">
                                       <div> <span class="number-prefix">  </span></div>
                                       <div class="number-title">
                                           <h3 class="title">Print Report

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
           
              <div id="card" class="card-box-style2">
               <div class="others-title">
                   <h3>Generate Report</h3>
               </div>
               
               <form id="generate-pdf" action="print.php" method="post" class="row g-3">
             
              

                   <h3>Select Course</h3>
            
                   <div class="col-md-6">
                       
                       <select id="" name="courseSelect"  class="form-select form-control">
                           <option value="" selected>Please select</option>
                           <?php $sql_course = "SELECT * FROM course ORDER BY course_ID"; $courseSelect = mysql_query($sql_course); ?>
            <?php while($row = mysql_fetch_assoc($courseSelect)) { ?>
                <option value="<?php echo $row['course_ID'] ?>"><?php echo $row['course_name'] ?></option>
                           <?php } ?>
                          
                       </select>
                       <span id="error_1"></span>
                   </div>
                   
                   
                    <h3>Course Activity</h3>
                    <p>Please select the date range of the report you wish to print.</p>
            
                   <div class="col-md-6">
                       
                       <select id="" name="courseActivity"   class="form-select form-control">
                           <option value="" selected>Please select</option>
                           <option value="7" >Last 7 Days</option>
                           <option value="30">Last 30 Days</option>
                           <option value="365">Last 12 Months</option>
                       </select>
                       <span id="error_2"></span>
                   </div>
                   
                   <h3>Select Site</h3>
       
       
                   <div class="col-md-6">
                   <?php if (isset($_SESSION["site_admin"]) && (int) $_SESSION["site_admin"]) { ?>
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

?>  				<span id="error_3"></span>
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
					<!-- <td><input name="submit" type="submit" value="Generate Report"  class="log-button"  /></td>	
                    <td>    <input name="cancel" type="button" value="Cancel"  class="log-button" onClick="document.location.href='admin-serials.php'" /></td> -->
</tr>

</table>





                       <!-- <select id="account_type" name="account"  class="form-select form-control">
                           <option value="" selected>Please select</option>
                           <option value="1" >Mayfair</option>
                           <option value="2">Vadodara</option>
                           <option value="2">Gujarat</option>
                           <option value="2">Rajkot</option>
                       </select> -->
                   </div>
                   
                    
                 
                 
                   <div class="col-12">
                   <td><input name="submit" type="submit" value="Generate Report"  class="btn btn-success"  /></td>	
                    <td>    <input name="cancel" type="button" value="Cancel"  class="btn btn-danger" onClick="document.location.href='admin-serials.php'" /></td>
                       <!-- <button type="submit" class="btn btn-success">Generate Report</button>
                       <button type="cancel" class="btn btn-danger">Cancel</button> -->
                   </div>
                   
               </form>
               
           </div>


       


           </main>
            <!-- End Main Content Area -->
<?php include('footer2.php'); ?>