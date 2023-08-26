<?php 
    include('../includes/connection.php');
    $output = '';

    if(isset($_POST['excel_extract'])) {
        $invoice = $_POST['extract_invoice'];

        // Tax_invoice data
        $tax_sql = "SELECT * from `tax_invoice` where invoice_number = $invoice";
        $run_tax = mysqli_query($con, $tax_sql);
        $tax_rows = mysqli_fetch_assoc($run_tax);

        $order_id = $tax_rows['order_id'];
        $user_id = $tax_rows['user_id'];
        $amount_due = $tax_rows['amount_due'];
        $noOf_items = $tax_rows['quantity'];
        $invoice_date = $tax_rows['invoice_date'];

        $output .= '
            <table>
                <tr>
                    <th>Invoice Number</th>
                    <th>Order Id</th>
                    <th>Total Number of Items</th>
                    <th>Date of Order</th>
                </tr>
                <tr>
                    <td>'.$invoice.'</td>
                    <td>'.$order_id.'</td>
                    <td>'.$noOf_items.'</td>
                    <td>'.$invoice_date.'</td>
                </tr>
            </table>
            <br>
        ';


        // Getting Products
        $length = strlen((string) $order_id);
        $n = $length - 3;
        $a = $order_id;

        $get_quantity = "SELECT * from `all_orders` where invoice_number = $invoice";
        $get_quantity_query = mysqli_query($con, $get_quantity);
        $quantity_rows = mysqli_fetch_assoc($get_quantity_query);
        $quantity = $quantity_rows['quantity'];
        $b = $quantity;

        $output .= '
            <table>
                <tr>
                    <th>Product Id</th>
                    <th>Product Title</th>
                    <th>Product Price</th>
                    <th>Number of Products</th>
                </tr>
        ';

        // for ($i=0; $i < $n; $i++) {
        //     if($i % 3 == 0) {
            while ($b > 1) {
                $product_id = $a % 1000;
                $temp = $b % 1000;

                $get_products = "SELECT * from `products` where product_id = $product_id";
                $get_products_query = mysqli_query($con, $get_products);
                $product_rows = mysqli_fetch_assoc($get_products_query);
                $product_title = $product_rows['product_title'];
                $product_price = $product_rows['product_price'];

                $output .= '
                    <tr>
                        <td>'.$product_id.'</td>
                        <td>'.$product_title.'</td>
                        <td>'.$product_price.'</td>
                        <td>'.$temp.'</td>
                    </tr>
                ';
                        
            
            $a = $a / 1000;
            $b = $b / 1000;
        }

        $output .= '
                <tr>
                    <td></td>
                    <th>Total</th>
                    <td>'.$amount_due.'</td>
                    <td>'.$noOf_items.'</td>
                </tr>
            </table>
            <br>
        ';

        // Getting Address
        $get_dispatch_address = "SELECT * from `dispatch_address` where invoice_number = $invoice";
        $run_address_dispatch = mysqli_query($con, $get_dispatch_address);
        $dispatch_rows = mysqli_fetch_assoc($run_address_dispatch);
        
        $street = $dispatch_rows['user_address_street'];
        $landmark = $dispatch_rows['user_address_landmark'];
        $Pincode = $dispatch_rows['Pincode'];

        $get_address_details = "SELECT * from `zipcode_list` where Pincode = $Pincode";
        $run_address_details = mysqli_query($con, $get_address_details);
        $pindress_rows = mysqli_fetch_assoc($run_address_details);

        $city = $pindress_rows['City'];
        $district = $pindress_rows['District'];
        $state = $pindress_rows['State'];
        $POName = $pindress_rows['PostOfficeName'];

        // Getting User Information
        $get_user_info = "SELECT * from `user_table` where user_id = $user_id";
        $run_user_info = mysqli_query($con, $get_user_info);
        $user_info_rows = mysqli_fetch_assoc($run_user_info);

        $username = $user_info_rows['username'];
        $user_mobile = $user_info_rows['user_mobile'];

        $output .= '
            <table>
                <tr>
                    <th>Billing Address</th>
                </tr>
                <tr>
                    <td>'.$street.'</td>
                </tr>
                <tr>
                    <td>'.$landmark.'</td>
                </tr>
                <tr>
                    <td>'.$city.'</td>
                </tr>
                <tr>
                    <td>'.$district.'</td>
                </tr>
                <tr>
                    <td>'.$Pincode.'</td>
                </tr>
                <tr>
                    <td>'.$state.'</td>
                </tr>
                <tr>
                    <td>'.$POName.'</td>
                </tr>
                <tr>
                    <td>Phone: '.$user_mobile.'</td>
                </tr>
            </table>
            <br>

            <table>
                <tr>
                    <th>Shipping Address</th>
                </tr>
                <tr>
                    <td>'.$street.'</td>
                </tr>
                <tr>
                    <td>'.$landmark.'</td>
                </tr>
                <tr>
                    <td>'.$city.'</td>
                </tr>
                <tr>
                    <td>'.$district.'</td>
                </tr>
                <tr>
                    <td>'.$Pincode.'</td>
                </tr>
                <tr>
                    <td>'.$state.'</td>
                </tr>
                <tr>
                    <td>'.$POName.'</td>
                </tr>
                <tr>
                    <td>Phone: '.$user_mobile.'</td>
                </tr>
            </table>
        ';
        header("Content-Type: application/xls");
        header("Content-Disposition: attachment; filename=invoce-$invoice.xls");
        echo $output;

    }
?>