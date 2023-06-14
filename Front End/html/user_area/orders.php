<h1 class="order-heading">Order History</h1>
<br>
<table>
        <tr>
            <th>Username</th>
            <th>Order Id</th>
            <th>Amount</th>
            <th>Delivery Charge</th>
            <th>Total Amount</th>
            <th>Invoice Number</th>
            <th>Number of Items</th>
            <th>Date of Order Placed</th>
            <th>Order Status</th>
        </tr>
    <?php
        $user_id = $_SESSION['user_id'];
        $username = $_SESSION['username'];
        $table_query = "select * from `user_orders` where user_id = $user_id";
        $result = mysqli_query($con, $table_query);
        while($table_row = mysqli_fetch_assoc($result)) {
            $order_id = $table_row['order_id'];
            $base_amount = $table_row['base_amount'];
            $delivery = $table_row['delivery'];
            $total_amount = $table_row['amount_due'];
            $invoice_num = $table_row['invoice_number'];
            $numof_prod = $table_row['total_products'];
            $order_date = $table_row['order_date'];
            $status = $table_row['order_status'];
    ?>

        <?php
            echo "<tr>
                <td>$username</td>
                <td>$order_id</td>
                <td>$base_amount</td>
                <td>$delivery</td>
                <td>$total_amount</td>
                <td>$invoice_num</td>
                <td>$numof_prod</td>
                <td>$order_date</td>";

            if($status === 'pending') {
                $_SESSION['invoice'] = $invoice_num;
                echo "<td><a href='../Checkout.php?order_summary'>$status</a></td>";
            }
            else {
                echo "<td>$status</td>";
            }
            echo "</tr>";
        ?>
        <!-- <tr>
            <td>$user_id</td>
            <td>$order_id</td>
            <td>$base_amount</td>
            <td>$delivery</td>
            <td>$total_amount</td>
            <td>$invoice_num</td>
            <td>$numof_prod</td>
            <td>$order_date</td>
            <td>$status</td>
        </tr> -->
    <?php 
        }
    ?>
</table>
<br>
<form action="" method="post" class="signup_container">
    <input type='submit' name='cancel_pending' value='Cancel Pending Order' class='button'>

    <?php 
        if(isset($_POST['cancel_pending'])) {
            $cancel_order = "DELETE FROM `user_orders` where order_status = 'pending' AND user_id = $user_id";
            $cancel_order_admin = "DELETE FROM `all_orders` where order_status = 'pending' AND user_id = $user_id";

            $run_cancel = mysqli_query($con, $cancel_order);
            $run_cancel_admin = mysqli_query($con, $cancel_order_admin);

            echo "<script>window.open('./profile.php?orders', '_self')</script>";
        }
    ?>

</form>