<?php include('config.php'); ?>
<?php include('header1.php'); ?>  

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

<?php if (isset($_SESSION['paypal_email'])){

orderpayment()

?>
<?php 	} else { ?>

    <strong>You Have Invalid Move</strong></td>
    <?php 	}

 ?>

                
                
                <!-- Start Invoice Area -->
                <div class="invoice-area">
                    <div class="container-fluid">
                        <div class="card-box-style  ">
                            <div class="others-title">
                                <h1 style="text-align:center;">Order Completed</h1>
            
                            </div>
                                <div class="">
                                    <h4 class="mb-0 " style="text-align:center;" >Thank You For Purcahasing</h4>
                                    <p class="mt-2 mb-0 " style="text-align:center;"><br>  Copy of your receipt with serials has been sent to <strong> <?php echo $_SESSION['paypal_email']; ?></strong></p>
                                    <p class="mt-2 mb-0" style="text-align:center;">Please <a style="color: green;"  href="<?php echo $site_url ?>admin-login.php"> <u> click here</u></a>  to access the safety bug administration area.</p>
                              

                            </div>

            
                            
                        </div>
                    </div>
                </div>
                <!-- End Invoice Area -->

                <?php include('footer1.php'); ?>  