<?php
    include("../includes/connection.php");
    if(isset($_POST['insert_product'])) {

        $product_title = $_POST['product_title'];
        $product_description = $_POST['product_description'];
        $product_keywords = $_POST['product_keywords'];
        $product_category = $_POST['product_category'];
        $product_price = $_POST['product_price'];
        $product_stock = $_POST['product_stock'];
        $product_status = "true";
        
        // Accessing Images
        $product_image1 = $_FILES['product_image1']['name'];
        $product_image2 = $_FILES['product_image2']['name'];
        $product_image3 = $_FILES['product_image3']['name'];

        // Accessing image temp name
        $temp_image1 = $_FILES['product_image1']['tmp_name'];
        $temp_image2 = $_FILES['product_image2']['tmp_name'];
        $temp_image3 = $_FILES['product_image3']['tmp_name'];

        // Moving images
        move_uploaded_file($temp_image1, "./product_images/$product_image1");
        move_uploaded_file($temp_image2, "./product_images/$product_image2");
        move_uploaded_file($temp_image3, "./product_images/$product_image3");

        // Insert query
        $insert_products = "INSERT into `products` (product_title, product_description, product_keywords, category_id, product_image1, product_image2, product_image3, product_price, stock, date, status) values ('$product_title', '$product_description', '$product_keywords', '$product_category', '$product_image1', '$product_image2','$product_image3', '$product_price', $product_stock, NOW(), '$product_status')";

        $result_query = mysqli_query($con, $insert_products);
        if($result_query) {
            echo "<script>alert('Successfully added Product')</script>";
        }
    }
?>

<div class="process-container add-product">
    <h1>Add a Product</h1>
    <form action="" method="post" enctype="multipart/form-data" class="product-loader">

    <!-- Product Title -->
        <div class="product-data product-title">
            <label for="product_title">Product Title</label>
            <input type="text" id="product_title" class="product-input" name="product_title" placeholder="Enter the product title" autocomplete="off" requried>
        </div>

    <!-- Product Description -->
        <div class="product-data product-description">
            <label for="product_description">Product Description</label>
            <input type="text" id="product_description" class="product-input" name="product_description" placeholder="Enter the product description" autocomplete="off" requried>
        </div>

    <!-- Keywords -->
        <div class="product-data product-keywords">
            <label for="product_keywords">Keywords</label>
            <input type="text" id="product_keywords" class="product-input" name="product_keywords" placeholder="Enter keywords" autocomplete="off" requried>
        </div>

    <!-- Category -->
        <div class="product-data product-add-category">
            <select name="product_category" id="product_category">
                <option value="0">Select a Category</option>
                <?php
                    $select_query = "select * from `categories`";
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
            <label for="product_image1">Product Image</label>
            <input type="file" id="product_image1" name="product_image1" requried>
        </div>
    <!-- Image 2 -->
        <div class="product-data product-image">
            <label for="product_image2">Product Image</label>
            <input type="file" id="product_image2" class="product-image-input" name="product_image2" requried>
        </div>
    <!-- Image 3 -->
        <div class="product-data product-image">
            <label for="product_image3">Product Image</label>
            <input type="file" id="product_image3" name="product_image3" requried>
        </div>

    <!-- Price -->
        <div class="product-data product-price">
            <label for="product_price">Enter Price</label>
            <input type="text" id="product_price" class="product-input" name="product_price" placeholder="Enter product price" autocomplete="off" requried>
        </div>

    <!-- Stock -->
        <div class="product-data product-price">
            <label for="product_price">Add Quantity</label>
            <input type="text" id="product_stock" class="product-input" name="product_stock" placeholder="Enter your stock" autocomplete="off" requried>
        </div>

    <!-- Submit -->
        <div class="product-data product-submit">
            <input type="submit" name="insert_product" value="Add Product">
        </div>
    </form>
</div>