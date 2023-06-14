<?php 
    // creating connection
    include ('./includes/connection.php');

    // function for merch display
    function getmerch() {

        global $con;
        
        if(!isset($_GET['category'])) {
            if(!isset($_GET['search_data_product'])) {

                $select_query = "select * from `products` order by rand()";
                $result_query = mysqli_query($con, $select_query);

                while($row = mysqli_fetch_assoc($result_query)) {
                    $product_id = $row['product_id'];
                    $product_title = $row['product_title'];
                    $product_image1 = $row['product_image1'];
                    $product_price = $row['product_price'];

                    echo "<div class='items'>
                            <a href='./Product-Description.php?product_id=$product_id' target='_blank'>
                                <img src='./admin_area/product_images/$product_image1' alt='$product_title'>
                                <h5>$product_title</h5>
                            </a>
                            <p>₹ $product_price</p>
                        </div>";
                }
            }           
        }
    }

    // function for displaying categories
    function getCategories() {

        global $con;

        if(isset($_GET['category'])) {
            $category_id = $_GET['category'];
            $select_query = "select * from `products` where category_id = $category_id";
            $result_query = mysqli_query($con, $select_query);
            $num_rows = mysqli_num_rows($result_query);

            if($num_rows == 0) {
                echo "<section class='grid-container'>
                        <h1 class='category-unavailable'>There are no Items for this Category.... Yet</h1>
                    </section>";
            }
            else {
                while($row = mysqli_fetch_assoc($result_query)) {
                    $product_id = $row['product_id'];
                    $product_title = $row['product_title'];
                    $product_image1 = $row['product_image1'];
                    $product_price = $row['product_price'];
                    $category_id = $row['category_id'];
    
                    echo "<div class='items'>
                            <a href='./Product-Description.php?product_id=$product_id' target='_blank'>
                                <img src='./admin_area/product_images/$product_image1' alt='$product_title'>
                                <h5>$product_title</h5>
                            </a>
                            <p>₹ $product_price</p>
                        </div>";
                }
            }
            
        }
        
    }

    function searchProduct() {
        global $con;

        if(isset($_GET['search_data_product'])) {
            $search_data_value = $_GET['search_data'];
            $search_query = "select * from `products` where product_keywords like '%$search_data_value%'";
            $result_query = mysqli_query($con, $search_query);
            $num_rows = mysqli_num_rows($result_query);

            if($num_rows == 0) {
                echo "<section class='grid-container'>
                        <h1 class='category-unavailable'>There are no Items for this Search.... Yet</h1>
                    </section>";
            }
            else {
                while($row = mysqli_fetch_assoc($result_query)) {
                    $product_id = $row['product_id'];
                    $product_title = $row['product_title'];
                    $product_image1 = $row['product_image1'];
                    $product_price = $row['product_price'];
    
                    echo "<div class='items'>
                            <a href='./Product-Description.php?product_id=$product_id' target='_blank'>
                                <img src='./admin_area/product_images/$product_image1' alt='$product_title'>
                                <h5>$product_title</h5>
                            </a>
                            <p>₹ $product_price</p>
                        </div>";
                }
            }
            
        }
    }

    // Searching from other pages
    function searchElse() {
        if(isset($_GET['search_data_product'])) {
            $search_data_value1 = $_GET['search_data'];
            echo "<script>window.open('Merch.php?search_data=$search_data_value1&search_data_product=Search', '_self')</script>";
        }
    }

    // function for product description

    function getProductDescription() {

        global $con;
        
        if(isset($_GET['product_id'])) {
            $product_id = $_GET['product_id'];
            $select_query = "select * from `products` where product_id = $product_id";
            $result_query = mysqli_query($con, $select_query);

            while($row = mysqli_fetch_assoc($result_query)) {
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_description = $row['product_description'];
                $product_image1 = $row['product_image1'];
                $product_image2 = $row['product_image2'];
                $product_image3 = $row['product_image3'];
                $product_price = $row['product_price'];

                echo "<ul data-slides>
                        <li class='slide' data-active>
                            <img src='./admin_area/product_images/$product_image1' alt='$product_title'>
                        </li>
                        <li class='slide'>
                            <img src='./admin_area/product_images/$product_image2' alt='$product_title'>
                        </li>
                        <li class='slide'>
                            <img src='./admin_area/product_images/$product_image3' alt='$product_title'>
                        </li>
                    </ul>";
            }
        }
    }


    // function for suggestions area
    function moreOptions() {

        global $con;

        $select_query = "select * from `products` order by rand() limit 0,3";
        $result_query = mysqli_query($con, $select_query);

        while($row = mysqli_fetch_assoc($result_query)) {
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_image1 = $row['product_image1'];
            $product_price = $row['product_price'];

            echo "<div class='items'>
                    <a href='Product-Description.php?product_id=$product_id'>
                        <img src='./admin_area/product_images/$product_image1' alt='$product_title'>
                        <h5>$product_title</h5>
                    </a>
                    <p>₹ $product_price</p>
                </div>";
        }
    }


    // Get IP address function
    function getIPAddress() {  
        //whether ip is from the share internet  
         if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                    $ip = $_SERVER['HTTP_CLIENT_IP'];  
            }  
        //whether ip is from the proxy  
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
         }  
    //whether ip is from the remote address  
        else{  
                 $ip = $_SERVER['REMOTE_ADDR'];  
         }  
         return $ip;  
    }  


    // cart function
    function cart() {

        if(isset($_GET['add_to_cart'])) {
            global $con;
            $ip = getIPAddress();
            $user_id = $_SESSION['user_id'];

            $get_product_id = $_GET['add_to_cart'];
            $select_query = "select * from `cart_details` where user_id=$user_id and product_id=$get_product_id";
            $result_query = mysqli_query($con, $select_query);
            $num_rows = mysqli_num_rows($result_query);
            if($num_rows > 0) {
                echo "<script>alert('Item is already present in the cart!')</script>";
                echo "<script>window.open('Product-Description.php?product_id=$get_product_id', '_self')</script>";
            }
            else {
                $insert_query = "insert into `cart_details` (product_id, user_id, ip_address, quantity) values ($get_product_id, $user_id, '$ip', 1)";
                $result_query = mysqli_query($con, $insert_query);
                echo "<script>alert('Item added to cart!')</script>";
                echo "<script>window.open('Merch.php', '_self')</script>";
            }
        }
    }


    // Category Browser
    function browser() {

        global $con;

        $select_categories = "select * from `categories`";
        $result_categories = mysqli_query($con, $select_categories);
        while($row_data = mysqli_fetch_assoc($result_categories)) {
            $category_title = $row_data['category_title'];
            $category_id = $row_data['category_id'];
            echo "<a href='Merch.php?category=$category_id' class='options'>$category_title</a>";
        }
    }


    // getting the number of items in cart
    function cart_item() {
        global $con;

        if(isset($_SESSION['username'])) {
            $user_id = $_SESSION['user_id'];
            $select_query = "select * from `cart_details` where user_id = $user_id";
            $result_query = mysqli_query($con, $select_query);
            $count_cart_items = mysqli_num_rows($result_query);
    
            return $count_cart_items;
        }
        else {
            return 0;
        }
    }


    // total price function
    function total_cart_price() {
        global $con;

        $ip = getIPAddress();
        $total = 0;
        $cart_query = "select * from `cart_details` where ip_address = '$ip'";
        $result = mysqli_query($con, $cart_query);
        while($row = mysqli_fetch_array($result)) {
            $product_id = $row['product_id'];
            $select_products = "select * from `products` where product_id = $product_id";
            $result_products = mysqli_query($con, $select_products);
            while($row_product_price = mysqli_fetch_array($result_products)) {
                $product_price = array($row_product_price['product_price']);
                $product_values = array_sum($product_price);
                $total += $product_values;
            }
        }
        echo $total;
    }
?>