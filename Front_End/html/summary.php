<form action="" method="post">
    <div class="cart-items">
        <!-- php for cart items -->
        <?php 
            if(isset($_SESSION['username'])) {
                $user_id = $_SESSION['user_id'];
            }
            $ip = getIPAddress();
            $total = 0;

            $cart_query = "select * from `cart_details` where user_id = '$user_id'";
            $result = mysqli_query($con, $cart_query);
            while($row = mysqli_fetch_array($result)) {
                $product_id = $row['product_id'];
                $quantity = $row['quantity'];
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
                    <p><b>Price: </b>₹<?php echo $product_table;?></p>
                    <?php
                        $select_product_quan = "select * from `cart_details` where product_id = $product_id";
                        $result_quan = mysqli_query($con, $select_product_quan);
                        $quantity_current = $row['quantity'];
                    ?>
                    <p> <b>Quantity:</b> <i><?=$quantity_current?></i></p>
                </div>
            </div>
        </div>
        <?php 
            }
        }
        ?>
    </div>
</form>