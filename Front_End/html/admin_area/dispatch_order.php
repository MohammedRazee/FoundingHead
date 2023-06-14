<?php 
    global $con;
    $invoice = $_GET['dispatch_order'];

    // Getting the Address
    $get_address = "SELECT * from `dispatch_address` where invoice_number = $invoice";
    $get_address_query = mysqli_query($con, $get_address);
    $address_row = mysqli_fetch_assoc($get_address_query);

    $street = $address_row['user_address_street'];
    $landmark = $address_row['user_address_landmark'];
    $zipcode = $address_row['Pincode'];

    // Getting Order details
    $get_order = "SELECT * from `all_orders` where invoice_number = $invoice";
    $get_order_query = mysqli_query($con, $get_order);
    $order_row = mysqli_fetch_assoc($get_order_query);

    $order_id = $order_row['order_id'];
    $user_id = $order_row['user_id'];
    $amount_due = $order_row['amount_due'];
    $quantity = $order_row['quantity'];

    // Getting Zipcode Address
    $get_zip_add = "SELECT * from `zipcode_list` where Pincode = $zipcode";
    $get_zip_query = mysqli_query($con, $get_zip_add);
    $zip_row = mysqli_fetch_assoc($get_zip_query);

    $city = $zip_row['City'];
    $district = $zip_row['District'];
    $state = $zip_row['State'];
    $POname = $zip_row['PostOfficeName'];

    // Getting User Info
    $get_user = "SELECT * from `user_table` where user_id = $user_id";
    $get_user_query = mysqli_query($con, $get_user);
    $user_row = mysqli_fetch_assoc($get_user_query);

    $user_id = $user_row['user_id'];
    $username = $user_row['username'];
    $user_email = $user_row['user_email'];
    $user_mobile = $user_row['user_mobile'];
?>

<!-- Dispatch HTML -->
<div class="dispatch-container">
    <div class="in-order">
        <h2>Products in Order</h2>
        <div class="order-items">
            <?php 
                $noOf_items = 0;
                $length = strlen((string) $order_id);
                $n = $length - 3;
                $a = $order_id;
                $b = $quantity;
                
                for ($i=0; $i < $n; $i++) { 
                    if($i % 3 == 0) {
                        $product_id = $a % 10;
                        $temp = $b % 10;
                        $noOf_items = $noOf_items + $temp;
                        
                        // Getting Product Information
                        $get_prod = "SELECT * from `products` where product_id = $product_id";
                        $get_prod_query = mysqli_query($con, $get_prod);
                        $prod_row = mysqli_fetch_assoc($get_prod_query);

                        $product_image1 = $prod_row['product_image1'];
                        $product_title = $prod_row['product_title'];
            ?>
            <div class="item">
                <div class="item-image">
                    <img src="./product_images/<?=$product_image1?>">
                </div>
                <div class="item-name">
                    <h4><?=$product_title?></h4>
                </div>
                <div class="item-quantity">
                    <h4>Quantity: <i><?=$temp?></i></h4>
                </div>
            </div>

            <?php 
                }
                $a = $a / 10;
                $b = $b / 10;
            }
            ?>
        </div>
    </div>
    

    <div class="order-details">
        <h2>Order Details</h2>
        <div class="details">

        <!-- User Details -->
            <div class="user-details inner">
                <h3>User Details</h3>
                <div class="item">
                    <p class="heading">Username: </p>
                    <p class="value"><?=$username?></p>
                </div>
                <div class="item">
                    <p class="heading">User Email: </p>
                    <p class="value"><?=$user_email?></p>
                </div>
                <div class="item">
                    <p class="heading">User Mobile No: </p>
                    <p class="value"><?=$user_mobile?></p>
                </div>
            </div>

        <!-- Order Details -->
            <div class="order-details inner">
                <h3>Order Details</h3>
                <div class="item">
                    <p class="heading">Order_id: </p>
                    <p class="value"><?=$order_id?></p>
                </div>
                <div class="item">
                    <p class="heading">Total Amount: </p>
                    <p class="value"><?=$amount_due?></p>
                </div>
                <div class="item">
                    <p class="heading">Number of Products: </p>
                    <p class="value"><?=$noOf_items?></p>
                </div>
            </div>

        <!-- Address Details -->
            <div class="address-details inner">
                <h3>Address Details</h3>
                <div class="item">
                    <p class="heading">Street/Area: </p>
                    <p class="value"><?=$street?></p>
                </div>
                <div class="item">
                    <p class="heading">Landmark: </p>
                    <p class="value"><?=$landmark?></p>
                </div>
                <div class="item">
                    <p class="heading">City: </p>
                    <p class="value"><?=$city?></p>
                </div>
                <div class="item">
                    <p class="heading">District: </p>
                    <p class="value"><?=$district?></p>
                </div>
                <div class="item">
                    <p class="heading">Pincode: </p>
                    <p class="value"><?=$zipcode?></p>
                </div>
                <div class="item">
                    <p class="heading">State: </p>
                    <p class="value"><?=$state?></p>
                </div>
                <div class="item">
                    <p class="heading">Post Office Name: </p>
                    <p class="value"><?=$POname?></p>
                </div>
            </div>
        </div>
        <br>
        <div class="dispatch-order">
            <form action="" method="post" class="autoloaders">
                <input type="submit" name="dispatch_now" class="submit" value="Dispatch Order">
            </form>
        </div>
    </div>
</div>

<?php 
    if(isset($_POST['dispatch_now'])) {
        $insert_invoice = "INSERT into `tax_invoice` (invoice_number, order_id, user_id, amount_due, quantity, invoice_date) values ($invoice, $order_id, $user_id, $amount_due, $noOf_items, NOW())";
        $run_insert_query = mysqli_query($con, $insert_invoice);

        $update_admin_order = "UPDATE `all_orders` set order_status = 'dispatched' where invoice_number = $invoice";
        $run_update_admin = mysqli_query($con, $update_admin_order);

        $update_user_order = "UPDATE `user_orders` set order_status = 'dispatched' where invoice_number = $invoice";
        $run_update_user = mysqli_query($con, $update_user_order);

        echo "<script>window.open('index.php?dispatched_orders', '_self')</script>";
    }

?>