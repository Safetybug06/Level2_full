<?php include('config.php');



if (!isset($_SESSION["admin_username"]) || !isset($_SESSION["admin_fullname"])) {

    header("location: admin.php");

    exit;
}



if (isset($_SESSION["gatewayLogout"]) && ($_SESSION["gatewayLogout"]) == 1) {

    header("location: admin-logout.php");

    exit;
}



$_SESSION["admin_fullname"] = $_SESSION["account_type"];



if (isset($_POST['gatewaySelect'])) {

    $sql = "SELECT `ID`, `paypal-name`,  `site-admin`, `cc-email`, `pagination` FROM `sign-up` WHERE `order_number`='" . $_POST['gatewaySelect'] . "'  ";



    $result = mysql_query($sql);



    $count = mysql_num_rows($result);

    while ($details = mysql_fetch_assoc($result)) {



        $_SESSION["admin_fullname"] = $details['paypal-name'];



        $_SESSION["order_number"] = $_POST['gatewaySelect'];



        $_SESSION["user_id"] = $details['ID'];



        $_SESSION["cc-email"] = $details['cc-email'];



        $_SESSION["site_admin"] = (int)$details['site-admin'];



        $_SESSION["pagination"] = (int)$details['pagination'];



        //  $_SESSION["gateway"]=(int)$details['gateway'];



        $_SESSION["gatewayLogout"] = 1;



        header("location: admin-serials.php");

        exit;
    }
}

?>
<?php include('header1.php'); ?>
<!-- Process Section Start -->
<div id="content" class="rs-process style1  pt-100 pb-100 md-pt-70 md-pb-70">
    <div class="container pb-54">
        <div class="process-effects-layer">
            <div class="row">

                <div class="col-lg-12 col-md-6 md-mb-30">
                    <div class="rs-addon-number">
                        <div class="number-part">
                            <a href="#">
                                <div class="number-image">
                                    <img src="assets/images/bg/gateway.png" alt="Process">
                                </div>
                            </a>
                            <div class="number-text">
                                <div> <span class="number-prefix"> </span></div>
                                <div class="number-title">
                                    <h3 class="title">Gateway Page

                                    </h3>
                                </div>
                                <div class="card-subtitle">
                                    Admin can Login Different gateway from here
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
        <h3>Chooose Account</h3>
    </div>

    <form id="gateway_form" action="" method="post" class="row g-3">



        <p>Please choose which account you wish to manage:</p>

        <div class="col-md-6">

            <select id="" name="gatewaySelect" class="form-select form-control">
                <?php

                $sql_gateway = "SELECT * FROM gateway WHERE primary_account='" . $_SESSION['order_number'] . "' ";

                $query_gateway = mysql_query($sql_gateway); ?>

                <?php while ($row = mysql_fetch_assoc($query_gateway)) { ?>

                    <option value="<?php echo $row['associated'] ?>"><?php echo $row['name'] ?></option>

                <?php } ?>

            </select>
        </div>

        <div class="col-12">
            <button name="submit" type="submit" value="Submit" class="btn btn-success">manage</button>

        </div>

    </form>

</div>
<?php include('footer1.php'); ?>