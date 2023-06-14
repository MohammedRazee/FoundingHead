<form method="post">
    <button class="payment" name="set_payment">Complete Payment</button>
    <button class="payment" name="set_payment_failed">Payment Failed</button>
    <?php 
        global $user_id;
        $invoice = $_SESSION['invoice'];
        $username = $_SESSION['username'];
        
        if(isset($_POST['set_payment'])) {
            // Updating order status
            $order_pay = "update `user_orders` set order_status = 'complete' where invoice_number = $invoice";
            $run_query = mysqli_query($con, $order_pay);

            // Creating a proper dispatch address for particular order
            $user_query = "select * from `user_table` where username = '$username'";
            $run_user = mysqli_query($con, $user_query);
            $user_row = mysqli_fetch_assoc($run_user);
            $street = $user_row['user_address_street'];
            $landmark = $user_row['user_address_landmark'];
            $zipcode = $user_row['zipcode'];
            $dispatch_query = "INSERT INTO `dispatch_address` (invoice_number, user_address_street, user_address_landmark, Pincode) values ($invoice, '$street', '$landmark', $zipcode)";
            $run_dispatch = mysqli_query($con, $dispatch_query);

            // Emptying cart for more orders
            $empty_cart = "delete from `cart_details` where user_id = $user_id";
            $empty_result = mysqli_query($con, $empty_cart);
            echo "<script>
                    alert('Order Placed');
                    window.open('./user_area/profile.php?orders', '_self');
                </script>";
            }
        elseif(isset($_POST['set_payment_failed'])) {
            $order_pay = "UPDATE `user_orders` set order_status = 'pending' where invoice_number = $invoice";
            $run_query = mysqli_query($con, $order_pay);
            echo "<script>
                    alert('Payment Failed');
                    window.open('./user_area/profile.php?orders', '_self');
                </script>";
        }

        // Updating the order in the admin_order table as well
        $check_admin_order = "SELECT * from `all_orders` where invoice_number = $invoice";
        $run_admin = mysqli_query($con, $check_admin_order);
        $order_num_rows = mysqli_num_rows($run_admin);

        $get_order = "SELECT * from user_orders where invoice_number = $invoice";
        $run_order = mysqli_query($con, $get_order);
        $current_order_row = mysqli_fetch_assoc($run_order);
        $order_id = $current_order_row['order_id'];
        $user_id = $current_order_row['user_id'];
        $quantity = $current_order_row['quan_order'];
        $amount_due = $current_order_row['amount_due'];
        $order_status = $current_order_row['order_status'];

        if($order_num_rows > 0) {
            $insert_query = "UPDATE `all_orders` set order_status = '$order_status' where invoice_number = $invoice";
            $run_insert = mysqli_query($con, $insert_query);
        }
        else {
            $insert_query = "INSERT into `all_orders` (order_id, user_id, invoice_number, amount_due, quantity, order_status) values ($order_id, $user_id, $invoice, $amount_due, $quantity, '$order_status')";
            $run_insert = mysqli_query($con, $insert_query);
        }
    ?>
</form>