<h1 class="category-heading">Categories</h1>
<br>
<table class="table">
        <tr>
            <th>Category Id</th>
            <th>Category Title</th>
            <th>Remove Category</th>
        </tr>
    <?php
        $table_query = "SELECT * from `categories`";
        $result = mysqli_query($con, $table_query);
        while($table_row = mysqli_fetch_assoc($result)) {
            $category_id  =$table_row['category_id'];
            $category_title  =$table_row['category_title'];
    ?>

        <?php
            echo "<tr>
                    <td>$category_id</td>
                    <td>$category_title</td>";
        ?>
        
        <td>
            <form method="post">
                <input type="hidden" name="remove_cat" value="<?=$category_id?>">
                <input type="submit" name="remove_catter" value="&#9746;" class='category-remove button'></input>
            </form>

            <?php 
                if(isset($_POST['remove_catter'])) {
                    $remove_cat = $_POST['remove_cat'];
                    $remove_cat_query = "DELETE from `categories` where category_id = $remove_cat";
                    $run_remove = mysqli_query($con, $remove_cat_query);

                    // Erasing category from product as well
                    $remove_product_cat = "UPDATE `products` set category_id = NULL where category_id = $remove_cat";
                    $get_remove_cat_prod = mysqli_query($con, $remove_product_cat);
                    
                    echo "<script>window.open('./index.php?view_category', '_self')</script>";
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
    <h3>Edit Any Category</h3>
    <form method="post" class="autoloaders category-loader">
        <input type="text" placeholder="Category to Edit (Insert Id)" name="cat_title_old" class="text-field" required>
        <input type="text" placeholder="New Category" name="cat_title_new" class="text-field" required>
        <input type="submit" value="Edit" name="edit_cat" class="submit">
    </form>
</div>

<?php 
    if(isset($_POST['edit_cat'])) {
        $old_cat = $_POST['cat_title_old'];
        $new_cat = $_POST['cat_title_new'];

        $edit_query = "update `categories` set category_title = '$new_cat' where category_id = $old_cat";
        $run_edit = mysqli_query($con, $edit_query);

        echo "<script>window.open('./index.php?view_category', '_self')</script>";
    }
?>