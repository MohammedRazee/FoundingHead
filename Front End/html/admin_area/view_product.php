<h1 class="category-heading">Products</h1>
<br>
<table class="table">
        <tr>
            <th>Product Id</th>
            <th>Product Title</th>
            <th>Product Description</th>
            <th>Product Keywords</th>
            <th>Category</th>
            <th>Product Image 1</th>
            <th>Product Image 2</th>
            <th>Product Image 3</th>
            <th>Product Price</th>
            <th>Stock</th>
            <th>Product Date</th>
            <th>Product Status</th>
            <th>Remove Product</th>
        </tr>
    <?php
        $table_query = "SELECT * from `products`";
        $result = mysqli_query($con, $table_query);
        while($table_row = mysqli_fetch_assoc($result)) {
            $product_id  = $table_row['product_id'];
            $product_title  = $table_row['product_title'];
            $product_des  = $table_row['product_description'];
            $product_key  = $table_row['product_keywords'];
            $product_cat  = $table_row['category_id'];
            $product_image1  = $table_row['product_image1'];
            $product_image2  = $table_row['product_image2'];
            $product_image3  = $table_row['product_image3'];
            $product_price  = $table_row['product_price'];
            $product_stock  = $table_row['stock'];
            $product_date  = $table_row['date'];
            $product_status  = $table_row['status'];
    ?>

        <?php
            echo "<tr>
                    <td>$product_id</td>
                    <td>$product_title</td>
                    <td class='description'>$product_des</td>
                    <td>$product_key</td>
                    <td>$product_cat</td>
                    <td><img src='./product_images/$product_image1'></td>
                    <td><img src='./product_images/$product_image2'></td>
                    <td><img src='./product_images/$product_image3'></td>
                    <td>$product_price</td>
                    <td>$product_stock</td>
                    <td>$product_date</td>
                    <td>$product_status</td>";
        ?>
        
        <td>
            <form method="post">
                <input type="hidden" name="remove_cat" value="<?=$product_id?>">
                <input type="submit" name="remove_catter" value="&#9746;" class='category-remove button'></input>
            </form>

            <?php 
                if(isset($_POST['remove_catter'])) {
                    $remove_cat = $_POST['remove_cat'];
                    $remove_cat_query = "DELETE from `products` where product_id = $remove_cat";
                    $run_remove = mysqli_query($con, $remove_cat_query);
                    
                    echo "<script>window.open('./index.php?view_product', '_self')</script>";
                }
            
            ?>
        </td>
                
         
    <?php 
        echo "</tr>";
        }
    ?>
</table>
<br>
<br>
<div class="process-container view_categories">
    <form method="post" class="autoloaders category-loader">
        <input type="text" placeholder="Enter Product Id" name="prod" class="text-field" required>
        <input type="submit" value="Edit Any Product" name="edit_prod" class="submit">
    </form>
</div>

<?php 
    if(isset($_POST['edit_prod'])) {
        $prod_edit = $_POST['prod'];
        echo "<script>window.open('./index.php?edit_prod=$prod_edit', '_self')</script>";
    }
?>