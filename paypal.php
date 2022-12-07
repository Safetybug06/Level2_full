<?php include('config.php'); ?>
<?php include('header1.php'); ?>

<h3 style="text-align: center;" class="card-text mt-24 mb-24" >
<?php 
      
      if (isset($_SESSION["admin_username"])) echo  "Additional Serials";
               ?>
               </h3>
     <!-- Process Section Start -->

     <?php if (!isset($_SESSION["admin_username"])) { ?>
     <div class="rs-process style1  pt-100 pb-100 md-pt-70 md-pb-70">
            <div class="container pb-54">
                <div class="process-effects-layer">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 md-mb-30">
                            <div class="rs-addon-number">
                                <div class="number-part">
                                    <a href="register.html">
                                    <div class="number-image-active">
                                        <img src="assets/images/process/style1/signup.png" alt="Process">
                                    </div>
                                </a>
                                    <div class="number-text">
                                        <div class="number-area"> <span class="number-prefix"> 1 </span></div>
                                        <div class="number-title">
                                            <h3 class="title"> Sign-Up</h3>
                                        </div>
                                         <div id="indi" class="alert alert-secondary" role="alert">
                                                <h4 class="alert-heading">Individual Buyers</h4>
                                                Simply enter your details (required for details on certificates) and click the 'continue' button to go through our secure checkout process. Please make sure you fill in all the mandatory fields marked with an asterisk (*). <br>
                                        
                                            </div>
                                         <div id="multi" style="display: none;" class="alert alert-success" role="alert">
                                                <h4 class="alert-heading">Multi Purchases</h4>
                                                Select how many user licences you want to buy using the drop down menu. Next, select your preferred method of payment from our accepted payment options.
                                            </div>
                                           
                                         <div class="alert alert-secondary" role="alert">
                                                <h4 class="alert-heading">Money Back Guarantee</h4>
                                                Full money back guarantee available. See terms and conditions.
                                             </div>

                                             <div class="card-text">
                                                <button class="btn btn-secondary mb-1" id="multi1"> Multiple Purchase? </button>
                                            </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 md-mb-30">
                            <div class="rs-addon-number">
                                <div class="number-part">
                                    <a href="activate.php">
                                    <div class="number-image">
                                        <img src="assets/images/process/style1/power.png" alt="Process">
                                    </div>
                                </a>
                                    <div class="number-text">
                                        <div class="number-area"> <span class="number-prefix"> 2 </span></div>
                                        <div class="number-title">
                                            <h3 class="title">Activate

                                            </h3>
                                        </div>
                                       
                                        <a href="activate.php">  <div class="btn btn-secondary mb-1" role="alert">
                                            <h4 class="alert-heading"> Click Here for Activate</h4>
                                            If You already Purchased Serials Click here For Activation 
                                        </div></a>
                                        <a href="log-in.php">
                                        <div class="btn btn-secondary mb-1" role="alert">
                                            <h4 class="alert-heading"> Click Here for Login</h4>
                                            If You already Activated Serials
                                        </div>
                                    </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                      
                    </div>
                </div>
            </div>
         </div>
              <!-- Process Section End -->

              <?php } ?>

              


              <div id="card" class="card-box-style2">
                <div class="others-title">
                    <h3><?php if (isset($_SESSION["admin_username"])) echo  "<p>Serials will appear in your admin account following purchase.</p>";
                    else echo "Sign-Up" ?></h3>
                    
                </div>
               
                <form id="orderForm" method="post"  action="#" class="row g-3">
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
     


                    <div class="col-md-6">
                        <label for="inputState" class="form-label">Account Type</label>
                        <select id="account_type" name="account"  class="form-select form-control">
                            <option value="" selected>Please select</option>
                            <option value="1" >personal</option>
                            <option value="2">Business</option>
                        </select>
                        <span id="error_1"></span>
                    </div>
                    <div class="col-md-6">
                        <label for="inputEmail4" class="form-label">Email</label>
                        <input type="email" class="form-control" id="order_email" name="email">
                        <span id="error_5"></span>
                    </div>
                    <div class="pb-24" style="display:none;" id="account">
                        <div class="row">
                            <div class="col">
                                <input id="business_name" name="business" type="text" class="form-control" placeholder="Business Name" aria-label="First name">
                                <span id="error_2"></span>
                            </div>
                           
                        </div>
                    </div>
                    <div class="pb-24">
                        <div class="row">
                            <div class="col">
                                <input id="order_first_name" name="first_name" type="text"  class="form-control" placeholder="First name" aria-label="First name">
                                <span id="error_3"></span>
                            </div>
                            <div class="col">
                                <input id="order_last_name" name="last_name" type="text" class="form-control" placeholder="Last name" aria-label="Last name">
                                <span id="error_4"></span>
                            </div>
                        </div>
                    </div>
                    <?php }

                         ?>  
                    <fieldset class="row mb-3">
                        <legend class="col-form-label col-sm-2 pt-0">*User License</legend>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="orderUsers"  value="1" checked>
                                <label class="form-check-label" for="gridRadios1">
                                    Single user £20.00
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="orderUsers"  value="2">
                                <label class="form-check-label" for="gridRadios2">
                                    2 - 50 users £19.00
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="orderUsers"  value="3">
                                <label class="form-check-label" for="gridRadios3">
                                    51 - 199 users £18.00
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="orderUsers"  value="4">
                                <label class="form-check-label" for="gridRadios4">
                                    200+ users £16.00
                                </label>
                                <span id="error_6"></span>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="row mb-3" style="display:none;" id="users">
                        <legend class="col-form-label col-sm-2 pt-0 ">Specify User required</legend>
                    
                        <div class="col-sm-2 ">
                                <input type="number" name="multi_users" value="1" min="0" max="10000" maxlength="5"  class="form-control" id="order_product">
                                <!-- <input type="range" name="multi_users" min="0" max="1000" maxlength="4" value="1" oninput="this.nextElementSibling.value = this.value" class="form-control" id="order_product">
                                 <output>1</output> -->
                                <span id="error_7">
                                
                        </div>
                        <div class="col-sm-2 ">
                                
                               
                        </div>
                    </fieldset>
                    <div class="col-md-6">
                        <label for="inputState" class="form-label">*Payment with</label>
                        <select id="payment_gateway" name="gateway" class="form-select form-control">
                            <option selected value="paypal">PayPal</option>
                            <option value="card">Credit/Debit Card</option>
                        </select>
                    </div>
                  
                    <div class="col-md-4" id="promo" style="display: none;"  >
                        <label for="inputEmail4"  class="form-label">Promotional Code</label>
                        <input type="text" placeholder="DEMO-1234-1234-1234" class="form-control" id="discount_voucher" name="discount_voucher">
                    </div>
                    <div class="card-text">
                        <button id="show"> have coupan? </button>
                    </div>
                    <div class="col-12">
                        <div class="form-check">
                        <p class="checkboxvalid"><input name="read" type="checkbox" value="" />*Read <a href="http://safetybugtraining.com/terms-conditions/" target="_blank">Terms &amp; Conditions</a></p>
									<span id="error_8">
                          
                        </div>
                    </div>
                    <div class="col-3">
                        <button name="Order with PayPal" type="submit"  value="Order Now" class="btn btn-success">Order Now</button>
                        
                        <div>
                        <?php if (isset($_SESSION["admin_username"])) { ?><br/><input name="cancel" type="button" value="Cancel"  class="btn btn-danger" onClick="document.location.href = 'admin-serials.php'" /><?php } ?>
                        </div>
                    </div>
                </form>

                <div class="card-text">
                    <td>
                <p>(*)Required field
                    <br>
                    (Price excludes VAT)
                </p>
            </td>
            <td>
                <img src="assets/images/payment/payapal.gif" style="max-width: 222px; width: 100%; height: auto; border: 0px; display: inline;" alt="PayPal accepted" id="paypal-pic">
                <div id="barclay-pic" style="display: none;">
                <img  src="assets/images/payment/crds-barclay.gif" style="max-width: 222px; width: 100%; height: auto; border: 0px; display: inline;"  alt="Barclay Card accepted">
                </div>
            </td>
                </div>
            </div>
            <script>
            $(window).ready( function() {
           if($(window).width() > 850) {
           $('#card').addClass('card-box-style2');
           $('#card').removeClass('card-box-style');
           }else{
           $('#card').addClass('card-box-style');
           $('#card').removeClass('card-box-style2');
            }
            })
            </script>

            <script>
      $(document).ready(function(){
     $("#show").click(function(e){
        e.preventDefault();
      $("#promo").show();
     });
     $("#show").click(function(e){
        e.preventDefault();
      $("#show").hide();
     });
     $("#multi1").click(function(e){
        e.preventDefault();
      $("#multi").show();
     });
     $("#multi1").click(function(e){
        e.preventDefault();
      $("#multi1").hide();
     });
     $("#multi1").click(function(e){
        e.preventDefault();
      $("#indi").hide();
     });
       });
    </script>
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
                  $(element).css("borderColor", "red");


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
     <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <?php include('footer1.php'); ?>