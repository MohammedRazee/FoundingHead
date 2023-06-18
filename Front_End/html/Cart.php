<!-- Calling Files -->
<?php 
    include("./includes/connection.php");
    include_once("./functions/common_function.php");
    include("./functions/header_nav.php");
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
        <link rel="stylesheet" href="../css/cart.css">
        <link rel="icon" href="Images/Trident.png" type="image/x-icon"/>
            <link rel="preconnect" href="https://fonts.googleapis.com"> 
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Lora&display=swap" rel="stylesheet">
        <title>Founding Head</title>
    </head>

    <body>
        <?php 
            getnav();
            searchElse();
        ?>

        <form class="" method="post">
            <div class="page-container">
                <?php 
                    $num_rows = 0;
                    if(isset($_SESSION['username'])) {
                        $user_id = $_SESSION['user_id'];
                        $cart_count_query = "select * from `cart_details` where user_id = $user_id";
                        $counting_result = mysqli_query($con, $cart_count_query);
                        $num_rows = mysqli_num_rows($counting_result);
                        echo "<p data-value='$num_rows' id='row_value'></p>";
                ?>
                <section class="section">
                    <div class="cart-items">
                        <!-- php for cart items -->
                        <?php 
                            $ip = getIPAddress();
                            $total = 0;
                            $numof_product = 0;
                            $order_id = 0;
                            $random = mt_rand(100, 999);
                            $order_id = $order_id . $random;
                            $order_quan = 0;

                            $cart_query = "select * from `cart_details` where user_id = '$user_id'";
                            $result = mysqli_query($con, $cart_query);
                            while($row = mysqli_fetch_array($result)) {
                                $product_id = $row['product_id'];
                                $quantity = $row['quantity'];
                                
                                // Manipulating for order_id
                                $length = strlen((string) $product_id);
                                $x = 3 - $length;
                                while ($x > 0) {
                                    $order_id = $order_id . 0;
                                    $order_quan = $order_quan . 0;
                                    $x--;
                                }
                                $order_id = $order_id . $product_id;
                                $order_quan = $order_quan . $quantity;

                                $select_products = "select * from `products` where product_id = $product_id";
                                $result_products = mysqli_query($con, $select_products);
                                while($row_product_price = mysqli_fetch_array($result_products)) {
                                    $product_price = array($row_product_price['product_price']);
                                    $product_table = $row_product_price['product_price'];
                                    $product_title = $row_product_price['product_title'];
                                    $product_image1 = $row_product_price['product_image1'];
                                    $product_values = array_sum($product_price);
                                    $product_values = $product_values * $quantity;
                                    $total += $product_values;
                        ?>
                        <div class="item">
                            <div class="image-name">
                                <div class="cart-image">
                                    <?php 
                                        echo "<img src='./admin_area/product_images/$product_image1' alt='Cart Item 1'>";
                                    ?>
                                </div>
                                <div class="detail">
                                    <h3><?php echo $product_title;?></h3>
                                    <br>
                                    <p><b>Price:    </b>₹<?php echo $product_table;?></p>
                                </div>
                            </div>
                            
                            <div class="set-buttons">
                                <div class="quantity">
                                    <button type="button" class="sub">&minus;</button>
                                    <?php
                                        $select_product_quan = "select * from `cart_details` where product_id = $product_id";
                                        $result_quan = mysqli_query($con, $select_product_quan);
                                        $quantity_current = $row['quantity'];
                                        echo "<input type='text' name='qty[]' min='1' class='quantity-input' value='$quantity_current'>";
                                        $numof_product += $quantity_current;
                                    ?>
                                    <button type="button" class="add">&plus;</button>
                                </div>
                                <div class="move set-quan">
                                    <?php 
                                        echo "<input type='submit' value='Set Quantity' class='button quan' name='update_cart'>";
                                        if(isset($_POST['update_cart'])) {
                                            $qtys = $_POST['qty'];
                                            $cart_query_update = "select * from `cart_details` where user_id = $user_id";
                                            $result_update = mysqli_query($con, $cart_query_update);
                                            $i=0;
                                            while($update_row = mysqli_fetch_assoc($result_update)) {
                                                $accept = $qtys[$i];
                                                $update_column = $update_row['product_id'];
                                                $update_query = "update `cart_details` set quantity = $accept where product_id = $update_column";
                                                $implement_query = mysqli_query($con, $update_query);
                                                $i++;
                                            }
                                            echo "<script>window.open('Cart.php', '_self')</script>";
                                        }
                                        
                                    ?>
                                </div>
                                <div class="move">
                                    <form method="post">
                                        <input type="hidden" name="remove_id" value="<?php echo $product_id?>">
                                        <input type="submit" name="remove_item" value="Remove" class="button" style="cursor: pointer; background-color: #202226; border: none; color: white; padding: 10px 15px; width:100%;">
                                    </form>
                                    <?php
                                        if(isset($_POST['remove_item'])) {
                                            $remove_index = $_POST['remove_id'];
                                            $remove_query = "delete from `cart_details` where product_id = $remove_index";
                                            $remove_query_result = mysqli_query($con, $remove_query);
                                            echo "<script>window.open('Cart.php', '_self')</script>";
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php 
                            }
                        }
                        ?>
                    </div>

                    <?php 
                        $username = $_SESSION['username'];
                        $user_get = "select * from `user_table` where username = '$username'";
                        $result_user = mysqli_query($con, $user_get);
                        $user_zip_row = mysqli_fetch_assoc($result_user);
                        $zipcode = $user_zip_row['zipcode'];

                        $zip_get = "select * from `zipcode_list` where Pincode = $zipcode";
                        $zip_result = mysqli_query($con, $zip_get);
                        $zip_row = mysqli_fetch_assoc($zip_result);
                        $zip_charge = $zip_row['delivery_charge'];

                        $total_amount = $total + $zip_charge;
                    ?>

                    <div class="cart-checkout">
                        <div class="checkout-price">
                            <h3>Your Cart Total is:</h3>
                            <h5>₹ <?php echo "$total_amount"; ?></h5>
                        </div>
                        <?php 
                            echo "<input type='submit' class='button' name='checkout_now' value='Proceed to Checkout'></input>";

                            if(isset($_POST['checkout_now'])) {
                                $check_order = "select * from `user_orders` where user_id = $user_id AND order_status = 'pending'";
                                $run_check = mysqli_query($con, $check_order);
                                $get_check = mysqli_fetch_assoc($run_check);
                                $invoice_num = mt_rand();
                                if(mysqli_num_rows($run_check) > 0) {
                                    $invoice_num = $get_check['invoice_number'];
                                    $delte_row = "delete from `user_orders` where user_id = $user_id AND order_status = 'pending'";
                                    $run_delete = mysqli_query($con, $delte_row);
                                }
                                $_SESSION['invoice'] = $invoice_num;
                                $order_update = "insert into `user_orders` (order_id, user_id, base_amount, delivery, amount_due, invoice_number, total_products, quan_order, order_status) values ($order_id, $user_id, $total, $zip_charge, $total_amount, $invoice_num, $numof_product, $order_quan, 'pending')";
                                $run_order = mysqli_query($con, $order_update);
                                echo "<script>window.open('./Checkout.php', '_self')</script>";
                            }

                        ?>
                        
                    </div>
                </section>

                <div class="price-details">
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

                <?php 
                    }
                    else {
                        echo "<p data-value='0' id='row_value'></p>";
                        echo "<h1>Cart is Empty</h1>";
                    }
                ?>
                <div class="default">
                    <h1>Cart is Empty</h1>
                </div>
            </div>
        </form>

        <script src="../js/nav.js"></script>
        <script src="../js/cart.js"></script>
    </body>
    
</html>