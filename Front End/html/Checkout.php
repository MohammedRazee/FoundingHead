<!-- Calling Files -->
<?php 
    include("includes/connection.php");
    include_once("functions/common_function.php");
    include("functions/header_nav.php");
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="../Images/Trident.png" type="image/x-icon"/>
        <link rel="stylesheet" href="../css/nav-merch.css">
        <link rel="stylesheet" href="../css/checkout.css">
        <link rel="stylesheet" href="../css/user_areas.css"> 
        <link rel="icon" href="Images/Trident.png" type="image/x-icon"/>
            <link rel="preconnect" href="https://fonts.googleapis.com"> 
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Lora&display=swap" rel="stylesheet">
        <title>Founding Head</title>
    </head>

    <body class="back-fade">
        <?php 
            global $con;
            getnav();
            searchElse();

            $user_id = $_SESSION['user_id'];
            $orders = "select * from `user_orders` where user_id = $user_id";
            $result_query = mysqli_query($con, $orders);
            $order_row = mysqli_fetch_assoc($result_query);
            $numof_product = $order_row['total_products'];
            $zip_charge = $order_row['delivery'];
            $total = $order_row['base_amount'];
            $total_amount = $order_row['amount_due'];
        ?>

        <div class="page-container back-fade">
            <div class="confirm-section back-fade">
                <?php 
                    global $con;
                    $Pusername = $_SESSION['username'];
                    $select_query = "select * from `user_table` where username = '$Pusername'";
                    $result_query = mysqli_query($con, $select_query);
                    $row = mysqli_fetch_assoc($result_query);
                    $Puser_id = $row['user_id'];
                    $Ppassword = $row['user_password'];
                    $Puser_email = $row['user_email'];
                    $Puser_image = $row['user_image'];
                    $Puser_street = $row['user_address_street'];
                    $Puser_town = $row['user_address_town'];
                    $Puser_state = $row['user_address_state'];
                    $Puser_landmark = $row['user_address_landmark'];
                    $Pzipcode = $row['zipcode'];
                    $Puser_mobile = $row['user_mobile'];
                ?>

                <div class="progression-bar back-front">
                    <a href="./Checkout.php?address_edit"><button class="progress">Confirm address</button></a>
                    <a href="./Checkout.php?order_summary"><button class="progress">Confirm Order</button></a>
                    <a href="./Checkout.php?payment"><button class="progress">Confirm Payment</button></a>
                </div>
                <div class="editing-area back-front">
                    <?php 
                        if(isset($_GET['address_edit'])) {
                            include("./user_area/address.php");
                            echo "<button type='button' id='accessButton'>Edit Address</button>";
                        }
                        elseif(isset($_GET['order_summary'])) {
                            include("./summary.php");
                        }
                        elseif(isset($_GET['payment'])) {
                            include("./Payment.php");
                        }
                    ?>
                </div>
            </div>

            <div class="price-details back-front">
                <div class="etem price-heading">
                    <h2>Price Details</h2>
                </div>

                <div class="etem prices">
                    <h3>Price<sub>(<?php echo "$numof_product";?>)</sub>:</h3>
                    <p>₹<?php echo "$total"; ?></p>
                    <h3>Delivery charge:</h3>
                    <p>₹<?php echo "$zip_charge";?></p>
                </div>
                
                <div class="etem amount">
                    <h2>Total Amount:</h2>
                    <p>₹<?php echo "$total_amount";?></p>
                </div>
            </div>
        </div>

        <script src="../js/checkout.js"></script>
        <script src="../js/nav.js"></script>
    </body>

</html>