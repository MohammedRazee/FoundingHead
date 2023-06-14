<div class="process-container add-product">
    <h1>Edit a Product</h1>
    <form method="post" enctype="multipart/form-data" class="product-loader">
        <?php 
            $product_id = $_GET['edit_prod'];
            $show_current_prod = "SELECT * from `products` where product_id = $product_id";
            $run_prod = mysqli_query($con, $show_current_prod);
            $current_prod_rows = mysqli_fetch_assoc($run_prod);
                $Cproduct_title = $current_prod_rows['product_title'];
                $Cproduct_des = $current_prod_rows['product_description'];
                $Cproduct_key = $current_prod_rows['product_keywords'];
                $Cproduct_category = $current_prod_rows['category_id'];
                $Cproduct_image1 = $current_prod_rows['product_image1'];
                $Cproduct_image2 = $current_prod_rows['product_image2'];
                $Cproduct_image3 = $current_prod_rows['product_image3'];
                $Cproduct_price = $current_prod_rows['product_price'];
                $Cproduct_stock = $current_prod_rows['stock'];
        ?>

    <!-- Product Title -->
        <div class="product-data product-title">
            <label for="product_title">Product Title</label>
            <input type="text" id="product_title" class="product-input" name="product_title" value="<?=$Cproduct_title?>" autocomplete="off" requried>
        </div>

    <!-- Product Description -->
        <div class="product-data product-description">
            <label for="product_description">Product Description</label>
            <input type="text" id="product_description" class="product-input" name="product_description" value="<?=$Cproduct_des?>" autocomplete="off" requried>
        </div>

    <!-- Keywords -->
        <div class="product-data product-keywords">
            <label for="product_keywords">Keywords</label>
            <input type="text" id="product_keywords" class="product-input" name="product_keywords" value="<?=$Cproduct_key?>" autocomplete="off" requried>
        </div>

    <!-- Category -->
        <div class="product-data product-add-category">
            <select name="product_category" id="product_category" requried>
                    <option value='0'>Select a Category</option>
                <?php
                    $select_query = "SELECT * from `categories`";
                    $result_query = mysqli_query($con, $select_query);

                    while($row=mysqli_fetch_assoc($result_query)) {
                        $category_title = $row['category_title'];
                        $category_id = $row['category_id'];

                        echo "<option value='$category_id'>$category_title</option>";

                    }
                ?>
            </select>
        </div>

    <!-- Image 1 -->
        <div class="product-data product-image">
            <label for="product_image1">Edit Product Image</label>
            <input type="file" id="product_image1" name="product_image1">
            <img src="./product_images/<?=$Cproduct_image1?>">
        </div>
    <!-- Image 2 -->
        <div class="product-data product-image">
            <label for="product_image2">Edit Product Image</label>
            <input type="file" id="product_image2" name="product_image2">
            <img src="./product_images/<?=$Cproduct_image2?>">
        </div>
    <!-- Image 3 -->
        <div class="product-data product-image">
            <label for="product_image3">Edit Product Image</label>
            <input type="file" id="product_image3" name="product_image3">
            <img src="./product_images/<?=$Cproduct_image3?>">
        </div>

    <!-- Price -->
        <div class="product-data product-price">
            <label for="product_price">Enter Price</label>
            <input type="text" id="product_price" class="product-input" name="product_price" value="<?=$Cproduct_price?>" autocomplete="off" requried>
        </div>

    <!-- Stock -->
        <div class="product-data product-price">
            <label for="product_price">Add Quantity</label>
            <input type="text" id="product_stock" class="product-input" name="product_stock" value="<?=$Cproduct_stock?>" autocomplete="off" requried>
        </div>

    <!-- Submit -->
        <div class="product-data product-submit">
            <input type="submit" name="edit_product" value="Edit Product">
        </div>
    </form>
</div>

<?php
        global $con;
        $product_id = $_GET['edit_prod'];    
        if(isset($_POST['edit_product'])) {
            $product_title = $_POST['product_title'];
            $product_description = $_POST['product_description'];
            $product_keywords = $_POST['product_keywords'];
            $product_category = $_POST['product_category'];
            $product_price = $_POST['product_price'];
            $product_stock = $_POST['product_stock'];
            
            
            if($_FILES['product_image1']['error'] === UPLOAD_ERR_OK) {
                $previous_prod_image = './product_images/'.$Cproduct_image1;
                if(file_exists($previous_prod_image)) {
                    unlink($previous_prod_image);
                }
                $product_image1 = $_FILES['product_image1']['name'];
                $temp_image1 = $_FILES['product_image1']['tmp_name'];
                move_uploaded_file($temp_image1, "./product_images/$product_image1");
    
                $update_product_image = "UPDATE `products` set product_image1 = '$product_image1' where product_id = $product_id";
                $run_image_update = mysqli_query($con, $update_product_image);                
            }
            
            if($_FILES['product_image2']['error'] === UPLOAD_ERR_OK) {
                $previous_prod_image = './product_images/'.$Cproduct_image2;
                if(file_exists($previous_prod_image)) {
                    unlink($previous_prod_image);
                }
                $product_image2 = $_FILES['product_image2']['name'];
                $temp_image2 = $_FILES['product_image2']['tmp_name'];
                move_uploaded_file($temp_image2, "./product_images/$product_image2");
                
                $update_product_image = "UPDATE `products` set product_image2 = '$product_image2' where product_id = $product_id";
                $run_image_update = mysqli_query($con, $update_product_image);                
            }
            
            if($_FILES['product_image3']['error'] === UPLOAD_ERR_OK) {
                $previous_prod_image = './product_images/'.$Cproduct_image3;
                if(file_exists($previous_prod_image)) {
                    unlink($previous_prod_image);
                }
                $product_image3 = $_FILES['product_image3']['name'];
                $temp_image3 = $_FILES['product_image3']['tmp_name'];
                move_uploaded_file($temp_image3, "./product_images/$product_image3");
                
                $update_product_image = "UPDATE `products` set product_image3 = '$product_image3' where product_id = $product_id";
                $run_image_update = mysqli_query($con, $update_product_image);
            }

            if($product_category != 0) {
                $update_products = "update `products` set product_title = '$product_title', product_description = '$product_description', product_keywords = '$product_keywords', category_id = $product_category, product_price = '$product_price', stock = $product_stock where product_id=$product_id";
            }
            else {
                $update_products = "update `products` set product_title = '$product_title', product_description = '$product_description', product_keywords = '$product_keywords', product_price = '$product_price', stock = $product_stock where product_id=$product_id";
            }
            
            
            $result_query = mysqli_query($con, $update_products);
    
            if($result_query) {
                echo "<script>alert('Successfully Edited Product')</script>";
                echo "<script>window.open('./index.php?view_product', '_self')</script>";
            }
            
        }
?>