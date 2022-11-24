<?php include('config.php'); ?>
<?php include('header.php'); ?>

<section class="header header-style2  strapline" style="background:url(images/img_04.jpg) 50% 50%;  background:linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.4)), url(images/img_04.jpg) 50% 50% ; background-size:cover;">
    <div class="header-content">
	    <h1>
	SIGN-UP</h1><p class="adminStrapline">
    Scroll down to sign-up</p>
    </div>
</section>

<div class="circle-wrapper">
    <div class="circle-container">
        <div class="numberCircle-container">
            <div class="numberCircle green-circle">1</div>
            <p class="numberCircleType green-type">
                Purchasing
            </p>
        </div>
        <div class="numberCircle-container">
            <div class="numberCircle grey-circle">2</div>
            <p class="numberCircleType grey-type">
                Activating
            </p>
        </div>
        <div class="numberCircle-container">
            <div class="numberCircle grey-circle">3</div>
            <p class="numberCircleType grey-type">
                Starting
            </p>
        </div>
    </div>
</div>

<div id="content">
    <script type="text/javascript">
      var numErrors = 0;
		$(document).ready(function() {
		// Show number of users box
    $('input:radio[name=orderUsers]').change(function() {
        if (this.value > 1) {
       $("#users").show();
            $("#order_product").val('');
        }
        else {
            $("#users").hide();
            $("#order_product").val('1');
          }
    });
		
		// Handle changing Account Type
        $('#account_type').change(function() {
        	if ( this.value == '2' ) {
          	// Show business box
            $('#account').show();
		  $('#business_name').val('');
          } else {
          	$('#account').hide();
            $('#business_name').val('Personal');
          }
        })
		
		
		  // Change card type pic
        $('#payment_gateway').change(function() {
        	if ( this.value == 'paypal' ) {
            $('#paypal-pic').show();
			$('#barclay-pic').hide();
          } else {
          	$('#paypal-pic').hide();
            $('#barclay-pic').show();
          }
        })
		
		
          // validate order form
          $("#orderForm").validate({
              highlight: function (element, errorClass, validClass) {
                  $(element).css("borderColor", "#ff0000");
                  if ($(element).data("hightlighed") == "1") {

                  } else {
                      $(element).data("hightlighed", 1);
                      numErrors++;
                  }
                  $("#required-note").css("display", "block");
              },
              unhighlight: function (element, errorClass, validClass) {
                  $(element).css("borderColor", "");


                  if ($(element).data("hightlighed") == "1") {
                      $(element).data("hightlighed", 0);
                      numErrors--;
                  }
                  if (numErrors == 0) {
                      $("#required-note").css("display", "none");
                  }
          },
          submitHandler: function () {
              var first_name = $("#order_first_name").val();
              var last_name = $("#order_last_name").val();
              var read = $("#order_read").val();
              var email = $("#order_email").val();
              var multi_users = parseInt($("#order_product").val());
		      var business = ($("#business_name").val());
              var payment_gateway = $("#payment_gateway").val();
              var discount_voucher = $("#discount_voucher").val();

              $.ajax({
                          url: "save_order_data.php",
                          type: 'POST',

              <!--
              
              data: "first_name=" + escape(first_name) + "&last_name=" + escape(last_name) + "&email=" + escape(email) + "&multi_users=" + escape(multi_users)  + "&payment_gateway="+escape(payment_gateway) + "&discount_voucher="+escape(discount_voucher) + "&business=" + escape(business),
              
              //-->
              
              async: false,
              dataType: "json",
              success: function(session_id) {
 
                          document.location.href = 'paypal2.php';
                          }
                          });			
              
              }, 
              rules: {
                          account: "required",
						  business: "required",
			              first_name: "required",
                          last_name: "required",
                          email: {
                                      required: true,
                                      email: true
              },
			  orderUsers: "required",
			  multi_users: {  required: true,  number: true	   },
		      read: "required"
			  },
              
			  messages: {
                        account: "Please select account type",
				   	    business: "Please enter business",
	                	first_name: "Please enter first name",
	                	last_name: "Please enter last name",
                        email: "Please enter valid email",
                        orderUsers: "Please select number of users",
                        multi_users: "Please confirm number of users",
                        read: "Please confirm Terms &amp; Conditions"
                         },
						 		errorPlacement: function (error, el) {
           if (el.attr('name') === 'account') {error.appendTo('#error_1'); } 
           if (el.attr('name') === 'business') {error.appendTo('#error_2'); } 
           if (el.attr('name') === 'first_name') {error.appendTo('#error_3'); } 
           if (el.attr('name') === 'last_name') {error.appendTo('#error_4'); } 
           if (el.attr('name') === 'email') {error.appendTo('#error_5'); } 
		   if (el.attr('name') === 'orderUsers') {error.appendTo('#error_6'); } 
		   if (el.attr('name') === 'multi_users') {error.appendTo('#error_7'); } 
		   if (el.attr('name') === 'read') {error.appendTo('#error_8'); } 
        },
		
		
		
                          });			});
                          </script>

    <h3 class="green">
      <?php 
      
      if (isset($_SESSION["admin_username"])) echo  "Additional Serials";
               else 
        echo "Sign-Up"; ?>
    </h3>
  <?php if (!isset($_SESSION["admin_username"])) { ?>
      <h4 class="green">Existing Customers</h4>
      <p>If you already have a business account setup with Safety Bug Training, simply login and order more codes in your business admin area. This will also you enable you to track the progress of your staff.</p>
      <h4 class="green">Individual Buyers</h4>
      <p>Simply enter your details (required for details on certificates) and click the 'continue' button to go through our secure checkout process. Please make sure you fill in all the mandatory fields marked with an asterisk (*).
      <h4 class="green">Multi Purchases</h4>

      <p>Select how many user licences you want to buy using the drop down menu. Next, select your preferred method of payment from our accepted payment options.
	  </p>
	  
      <p>If you require further support, or you would like to discuss corporate solutions please contact our support team on 01223 258156, or email <a href="mailto:info@safetybugtraining.com">info@safetybugtraining.com</a> and request a call back.</p>


<!--
	       <h4 class="green">Available Courses</h4>
      <p>Once signed-up choose from the following courses:</p>
<ul class="signUp">
<li>Food Safety Level2</li>
<li>Allergen Awareness</li>
	  </ul>
-->
	  
       <h4 class="green">Money Back Guarantee</h4>
      <p>Full money back guarantee available. See terms and conditions.</p>

	  
       <?php } ?>
	   
	   
	   

  <?php if (isset($_SESSION["admin_username"])) echo  "<p>Serials will appear in your admin account following purchase.</p>"; ?>
  <form id="orderForm" method="post"  action="#">
    <table class="login-res" >
  <?php
  if (isset($_SESSION["admin_username"])) {
    
    $results = mysql_query("SELECT * FROM `sign-up` WHERE `email`='" . $_SESSION["admin_username"] . "'");
    $data = mysql_fetch_assoc($results);
    $name = explode(" ", $data['paypal-name']);
    $last_name = str_replace($name[0], '', $data['paypal-name']);    
  ?>
      <input id="order_first_name" name="first_name" type="hidden" value="<?php echo $name[0] ?>" />  
      <input id="order_last_name" name="last_name" type="hidden" value="<?php echo trim($last_name); ?>" />  
      <input id="business_name" name="business" type="hidden" value="<?php echo $data['account_type'] ?>" />
      <input id="order_email" name="email" type="hidden" value="<?php echo $data['email'] ?>" />
	  <?php }
	  else { ?>
     
      <tr>
                <td><p>*Account Type</p>
                    <select id="account_type" name="account"  class="dropdown" >
                        <option value="">Please select</option>
                        <option value="1">Personal</option>
                        <option value="2">Business</option>
                    </select>
						<span id="error_1"></span>
                </td>
            </tr> 
                        <tr style="display:none;" id="account">
                <td><p>*Business Name</p><input id="business_name" name="business" type="text" class="text-field" />
						<span id="error_2"></span>
                <hr/></td>
            </tr>
            
            
            
             <tr>
          <td><p>*First Name(s)</p><input id="order_first_name" name="first_name" type="text"  class="text-field" />
						<span id="error_3"></span>
						</td>
      </tr>
      <tr>
          <td>
              <p>*Surname</p><input id="order_last_name" name="last_name" type="text"  class="text-field"  />
						<span id="error_4"></span>
			  </td>
      </tr>

      <tr>
          <td><p>*E-Mail</p><input id="order_email" name="email" type="text"  class="text-field" />
						<span id="error_5"></span>
		  </td>
      </tr>
<?php }

?>  
<tr>
                <td><p>*User License</p>
<label><input type="radio" name="orderUsers"  value="1">Single user &pound;20.00</label>
<br/>
<label><input type="radio" name="orderUsers"  value="2">2 - 50 users &pound;19.00</label>
<br/>
<label><input type="radio" name="orderUsers" value="3">51 - 199 users &pound;18.00</label>
<br/>
<label><input type="radio" name="orderUsers"  value="4">200+ users &pound;16.00</label>
<br/>
		<span id="error_6"></span>
                </td>
            </tr> 
            <tr style="display:none;" id="users">
                <td><fieldset><p>*Specify Users Required</p><input id="order_product" value="1" name="multi_users" type="text" class="text-field" /></fieldset>
					<span id="error_7">
					</td>
            </tr>
            <tr>
                <td><p>*Payment with</p>
                    <select id="payment_gateway" name="gateway" class="dropdown"  >
                    <option value="paypal">PayPal</option>
                    <option value="card">Credit/debit card</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><p>Promotional Code</p>
                    <input id="discount_voucher" name="discount_voucher" type="text"  class="text-field" />
                </td>
            </tr>
            <tr>	
                <td><p class="checkboxvalid"><input name="read" type="checkbox" value="" />*Read <a href="http://safetybugtraining.com/terms-conditions/" target="_blank">Terms &amp; Conditions</a></p>
									<span id="error_8"></td> 
            </tr>
            <tr>
                <td><input name="Order with PayPal" type="submit"  value="Order Now"   class="log-button  right" /></td>
            </tr>
            <tr>
                <td><?php if (isset($_SESSION["admin_username"])) { ?><br/><input name="cancel" type="button" value="Cancel"  class="log-button right" onClick="document.location.href = 'admin-serials.php'" /><?php } ?></td>
            </tr>
            <tr>  
                <td><p class="form-type-sml" >(*)Required field<br/>(Price excludes VAT)</p></td> 
            </tr>
            
             <tr>  
                <td>
                <img src="images/crds-paypal.gif"  style="max-width:222px; height:72px; width:100%; height:auto; border:0;"  alt="PayPal accepted" id="paypal-pic">
                <img src="images/crds-barclay.gif"  style="max-width:222px; height:72px; width:100%; height:auto; border:0; display:none"  alt="Barclay Card accepted" id="barclay-pic">

               </td> 
            </tr>
            
        </table>
    </form>
</div><!-- content -->
</div><!-- wrapper -->
<?php include('footer.php') ?>