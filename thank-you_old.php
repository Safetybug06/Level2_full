<?php include('config.php') ?>

<?php include('header.php') ?>
<script>
dataLayer.push({
'event': 'transaction',
'ecommerce': {
'purchase': {
'actionField': {
'id': '<?php echo  $_SESSION['dl_order_id']; ?>', // Order id goes here
'revenue': '<?php echo  $_SESSION['dl_order_total']; ?>', // Total transaction value (incl. tax and shipping)
'tax':'<?php echo  $_SESSION['dl_order_vat']; ?>', // Total tax value
},
'products': [{ // List of productFieldObjects.
'name': 'SBT Level2 Training', // Name or ID is required.
'id': 'LV2', // Product id goes here
'price': '<?php echo $_SESSION['order_unit_price']; ?>',
'category': 'Course',
'quantity': <?php echo  $_SESSION['paypal_users'];  ?>,
'order-type': '<?php echo  $_SESSION['dl_order-type'];?>',
'promo-code':  '<?php echo  $_SESSION['dl_voucher']; ?>'
}]
}
}
})
</script>    



<?php
orderpayment()
?>



<section class="header header-style2" style="background:linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.4)), url(images/img_04.jpg) 50% 50% ; background-size:cover;">

    <div class="header-content">

	    <h1>

	SIGN-UP	</h1>

    </div>

</section>





<div id="content">





 	<h3 class="green">Complete</h3>

     

            <p>

               <strong>Thank you for your purchase.</strong>

            </p>



            

            <p>

                A copy of your receipt with serials has been sent to <strong><?php echo $_SESSION['paypal_email']; ?></strong>.

            </p>



            <p>

Please <a href="<?php echo $site_url ?>admin-login.php"   style="text-decoration:underline">click here</a> to access the safety bug administration area.

            </p>







			</div><!-- content -->

		</div><!-- wrapper -->

        

       <script>
dataLayer.push({
'event': 'transaction',
'ecommerce': {
'purchase': {
'actionField': {
'id': '<?php echo  $_SESSION['dl_order_id']; ?>', // Order id goes here
'revenue': '<?php echo  $_SESSION['dl_order_total']; ?>', // Total transaction value (incl. tax and shipping)
'tax':'<?php echo  $_SESSION['dl_order_vat']; ?>', // Total tax value
},
'products': [{ // List of productFieldObjects.
'name': 'SBT Level2 Training', // Name or ID is required.
'id': 'LV2', // Product id goes here
'price': '<?php echo $_SESSION['order_unit_price']; ?>',
'category': 'Course',
'quantity': <?php echo  $_SESSION['paypal_users'];  ?>,
'order-type': '<?php echo  $_SESSION['dl_order-type'];?>',
'promo-code':  '<?php echo  $_SESSION['dl_voucher']; ?>'
}]
}
}
})
</script>    

        

        

<?php include 'footer.php'; ?>