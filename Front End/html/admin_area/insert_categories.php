<?php 
    include("../includes/connection.php");

    if(isset($_POST['insert_cat'])) {
        $category_title = $_POST['cat_title'];

        // Select value from database
        $select_query = "select * from `categories` where category_title = '$category_title'";
        $result_select = mysqli_query($con, $select_query);
        $number = mysqli_num_rows($result_select);
        if($number > 0) {
            echo "<script>alert('Category is already present')</script>";
        }
        else {
            $insert_query = "insert into `categories` (category_title) values('$category_title')";
            $result = mysqli_query($con, $insert_query);

            if($result) {
                echo "<script>alert('Category has been added')</script>";
            }
        }
    
        
    }
?>

<div class="process-container insert_categories">
    <h1>Make a New Category</h1>
    <form action="" method="post" class="autoloaders category-loader">
        <input type="text" placeholder="Insert a Category" name="cat_title" class="text-field" required>
        <input type="submit" value="Insert" name="insert_cat" class="submit">
    </form>
</div>