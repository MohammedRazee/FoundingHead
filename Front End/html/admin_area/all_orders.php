<h1 class="order-heading">All Order History</h1>
<br>
<table>
        <tr>
            <th>User Id</th>
            <th>Order Id</th>
            <th>Total Amount</th>
            <th>Invoice Number</th>
            <th>Number of Items</th>
            <th>Date of Order Placed</th>
            <th>Order Status</th>
            <th>Dispatch Order</th>
        </tr>
    <?php
        $table_query = "select * from `all_orders`";
        $result = mysqli_query($con, $table_query);
        while($table_row = mysqli_fetch_assoc($result)) {
            $order_id = $table_row['order_id'];
            $user_id = $table_row['user_id'];
            $invoice_num = $table_row['invoice_number'];
            $amount_due = $table_row['amount_due'];
            $numof_prod = $table_row['quantity'];
            $date = $table_row['order_date'];
            $status = $table_row['order_status'];


    ?>

        <?php
            echo "<tr>
                <td>$user_id</td>
                <td>$order_id</td>
                <td>$amount_due</td>
                <td>$invoice_num</td>
                <td>$numof_prod</td>
                <td>$date</td>
                <td>$status</td>";

                if($status === 'complete') {
                    echo "<td><a href='./index.php?dispatch_order=$invoice_num'>dispatch</a></td>";
                }
                elseif($status === 'dispatched') {
                    echo "<td>
                            <form action='excel.php' method='post'>
                                <input type='hidden' value='$invoice_num' name='extract_invoice'>
                                <input type='submit' value='Download Invoice' name='excel_extract'>
                            </form>
                        </td>";
                }
                elseif($status === 'delivered') {
                    echo "<td>
                            <form action='excel.php' method='post'>
                                <input type='hidden' value='$invoice_num' name='extract_invoice'>
                                <input type='submit' value='Download Invoice' name='excel_extract'>
                            </form>
                        </td>";
                }

            echo "</tr>";
        ?>
    <?php 
        }
    ?>
</table>