<?php include('config.php'); ?>
<?php include('header1.php'); ?>

<?php $users=$_SESSION['paypal_users'];

$gateway=$_SESSION['payment_gateway']; ?>

                <!-- Start Invoice Area -->
                <div class="invoice-area">
                    <div class="container-fluid">
                        <div class="card-box-style">
                            <div class="invoice-header mb-24 d-flex justify-content-between">
                                <div class="invoice-left-text">
                                    <h3 class="mb-0">Confirm Order</h3>
                                    <p class="mt-2 mb-0"><br> Please check the details of your order and your selected your preferred method of payment from our accepted payment options. Now 'confirm order'. From here you will be automatically directed to confirm your payment via SSL secure transaction. <br> <br> When payment is made you will be sent an e-mail confirming your order along with your unique 'serial number'. The 'serial number' supplied is the number you will need in order to activate your pass word and user name. You will need this in order to access the learning modules.</p>
                                </div>
            
                                
                            </div>
            
                          
            
                            <div class="invoice-table table-responsive mb-24">
                                <table class="table table-bordered">
                                    <thead bgcolor="grey">
                                        <tr>
                                        
                                            <th>Description</th>
                                         
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
            
                                    <tbody>
                                     
                                        <tr>
                                            <td  colspan="1"><strong>Safetbug Trainning License : <?php echo $users; ?> User(s)</strong></td>
                                            <?php $price = $price_vat = getOrderPrice($users); ?>
                                            <td >&pound;<?php echo number_format($price,2); ?></td>
                                        </tr>
                                        <?php

if (isset($_SESSION['discount_voucher']) && strlen($_SESSION['discount_voucher'])) {

    $discount_voucher = str_replace(array(' ','-'), '', $_SESSION['discount_voucher']);

    $sql = "SELECT * FROM `discount` WHERE `DISCOUNT`='$discount_voucher' OR `DISCOUNT`='".$_SESSION['discount_voucher']."' LIMIT 1";

    $query = mysql_query($sql);

    

    if (mysql_num_rows($query)) {

        $discount = mysql_fetch_assoc($query);

        

        $discount_amount = ($price * (float)$discount['VALUE'])/100;

        $discount_amount = round($discount_amount, 2);

        

        $price_vat = $price - $discount_amount;

?>

<tr style="background:#058040">

<td style="padding-right:4em">

<p style="text-align:right;color:#fff">Promotional Price:</p> 

</td>

<td><p class="form_type" style="color:#fff">&pound;<?php echo number_format(round($price_vat, 2),2); ?></p>

</td>

</tr>

<?php 	} else { ?>

<tr>

<td colspan="2" align="center"><strong>You have provided invalid Promotional Code</strong></td>

</tr>

<?php 	}

} ?>
                                        <tr>
                                            <td  colspan="1"><strong>VAT </strong></td>
                                            <td >&pound;<?php  $computed_vat=$vat/100*$price_vat; echo number_format($computed_vat,2); ?></td>
                                        </tr>
            
                                        <tr>
                                            <td class=" total" colspan="1"><strong>Total</strong></td>
                                            <td class=" total-price"><strong>&pound;<?php $total=round($price_vat+$computed_vat, 2); echo number_format($total,2); ?></strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
<!--             
                            <div class="invoice-btn text-end">
                              
                                <a href="#" class="default-btn">Confirm Order</a>
                            </div> -->




                            <?php if($gateway=="card") { 

$order_id = rand(99999, 9999999);

$fullname = ucfirst($_SESSION['paypal_first_name']).' '.ucfirst($_SESSION['paypal_last_name']);



?>

<form method="post" action="https://<?php echo $barclay_url; ?>" id="form1" name="form1">

<!-- general parameters -->

<input type="hidden" name="PSPID" value="<?php echo $PSPID; ?>">

<input type="hidden" name="ORDERID" value="<?php echo $order_id; ?>">

<input type="hidden" name="AMOUNT" value="<?php echo $total*100; ?>">

<input type="hidden" name="CURRENCY" value="GBP">

<input type="hidden" name="LANGUAGE" value="en_US">

<input type="hidden" name="CN" value="<?php echo $fullname;?>">

<input type="hidden" name="EMAIL" value="<?php echo $_SESSION['paypal_email']; ?>">

<input type="hidden" name="ACCEPTURL" value="<?php echo $site_url ?>bc_ipn.php">

<input type="hidden" name="DECLINEURL" value="<?php echo $site_url ?>decline.php">

<input type="hidden" name="CANCELURL" value="<?php echo $site_url ?>paypal2.php">

<!-- check before the payment: see Security: Check before the Payment -->

<?php $signature=sha1("ACCEPTURL=".$site_url."bc_ipn.php".$secretsig."AMOUNT=".($total*100).$secretsig."CANCELURL=".$site_url."paypal2.php".$secretsig."CN=".$fullname.$secretsig."CURRENCY=GBP".$secretsig."DECLINEURL=".$site_url."decline.php".$secretsig."EMAIL=".$_SESSION['paypal_email'].$secretsig."LANGUAGE=en_US".$secretsig."ORDERID=".$order_id.$secretsig."PSPID=".$PSPID.$secretsig); ?>

<input type="hidden" name="SHASIGN" value="<?php echo $signature; ?>">

<input name="Order with Card" type="submit"  value="Confirm Order"    class="btn btn-success"/>

</form>

<?php }   else {?>



<form id="paypal_form" action="https://<?php echo $paypal_url ?>/cgi-bin/webscr" method="post">  

<input type="hidden" name="business" value="<?php echo $paypal_email ?>"/>   

<input type="hidden" name="cmd" value="_cart"/>  

<input type="hidden" name="upload" value="1"/>  

<input type="hidden" name="item_name_1" value="<?php echo ($_SESSION['paypal_users'] == 1) ? 'Single User' : $_SESSION['paypal_users'].' Users'; ?>"/>  

<input type="hidden" name="amount_1" value="<?php echo $total; ?>"/>

<input type="hidden" name="first_name" value="<?php echo ucfirst($_SESSION['paypal_first_name']); ?>" />  

<input type="hidden" name="last_name" value="<?php echo ucfirst($_SESSION['paypal_last_name']); ?>" />  

<input type="hidden" name="email" value="<?php echo $_SESSION['paypal_email']; ?>"/> 

<input type="hidden" name="currency_code" value="GBP"/>

<input type="hidden" name="custom" value="<?php echo session_id(); ?>" /> 

<input type="hidden" name="rm" value="2"/>  

<input type="hidden" name="notify_url" value="<?php echo $site_url ?>ipn.php"/>

<input type="hidden" name="return" value="<?php echo $site_url ?>thank-you.php"/> 

<input name="Order with PayPal" type="submit"  value="Confirm Order"    class="btn btn-success" />

</form>

<?php } ?>




                        </div>
                    </div>
                </div>
                <!-- End Invoice Area -->


                <?php include('footer1.php'); ?>