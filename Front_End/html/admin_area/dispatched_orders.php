<h1 class="order-heading">Dispatched Orders</h1>
<br>
<table>
        <tr>
            <th>Invoice Number</th>
            <th>Order Id</th>
            <th>User Id</th>
            <th>Payment Receieved</th>
            <th>Number of Items</th>
            <th>Date of Order Placed</th>
            <th>Download Invoice</th>
            <th>Confirm Delivery</th>
        </tr>
    <?php
        $table_query = "select * from `tax_invoice`";
        $result = mysqli_query($con, $table_query);
        while($table_row = mysqli_fetch_assoc($result)) {
            $invoice = $table_row['invoice_number'];
            $order_id = $table_row['order_id'];
            $user_id = $table_row['user_id'];
            $amount_due = $table_row['amount_due'];
            $numof_prod = $table_row['quantity'];
            $date = $table_row['invoice_date'];
    ?>

        <?php
            echo "<tr>
                <td>$invoice</td>
                <td>$order_id</td>
                <td>$user_id</td>
                <td>$amount_due</td>
                <td>$numof_prod</td>
                <td>$date</td>
                <td>
                    <form action='excel.php' method='post'>
                        <input type='hidden' value='$invoice' name='extract_invoice'>
                        <input type='submit' value='Download Invoice' name='excel_extract'>
                    </form>
                </td>
                <td>
                    <form method='post'>
                        <input type='submit' value='Confirm Delivery' name='del_con'>
                    </form>
                </td>";
            echo "</tr>";
        ?>
    <?php 
        }
    ?>
</table>

<br>

<?php
    if(isset($_POST['del_con'])) {
        $update_order_admin = "UPDATE `all_orders` set order_status = 'delivered' where invoice_number = $invoice";
        $update_order_user = "UPDATE `user_orders` set order_status = 'delivered' where invoice_number = $invoice";

        $run_cancel_admin = mysqli_query($con, $update_order_admin);
        $run_cancel_user = mysqli_query($con, $update_order_user);

        echo "<script>window.open('./index.php?all_orders', '_self')</script>";
    }
?>