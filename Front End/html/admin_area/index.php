<!-- Calling files -->
<?php 
    include('../includes/connection.php');
    include('../functions/admin_functions.php');
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../css/admin.css">
        <link rel="stylesheet" href="../../css/nav-merch.css">
        <link rel="stylesheet" href="../../css/admin_process.css">
        <link rel="icon" href="../../Images/Trident.png" type="image/x-icon"/>
            <link rel="preconnect" href="https://fonts.googleapis.com"> 
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Lora&display=swap" rel="stylesheet">
        <title>Admin Dashboard</title>
    </head>

    <body>
        <?php
            if(!isset($_SESSION['admin_user'])) {
                echo "<script>window.open('./admin_login.php', '_self')</script>";
            }
            adminNav();
        ?>

        <div class="page-container back-fade">
            <div class="browser">
                <div class="user-info back-front">
                    <div class="user-image">
                        <?php 
                            global $con;
                            $Padmin_user = $_SESSION['admin_user'];
                            $select_query = "select * from `admin_table` where admin_user = '$Padmin_user'";
                            $result_query = mysqli_query($con, $select_query);
                            $row = mysqli_fetch_assoc($result_query);
                            $Padmin_id = $row['admin_id'];
                            $Ppassword = $row['admin_password'];
                            $Padmin_email = $row['admin_email'];
                            $Padmin_image = $row['admin_image'];
                            $Padmin_mobile = $row['admin_mobile'];

                            echo "<img src='./admin_images/$Padmin_image' alt='admin Image'>";
                            ?>
                    </div>
                    <div class="admin-name">
                        <p>Hello,</p>
                        <?php 
                            echo "<h3>$Padmin_user</h3>";
                            
                        ?>
                    </div>
                </div>

                <div class="user-options back-front">
                    <div class="option-items">
                        <h2>Account Settings</h2>
                        <?php 
                            echo "<ul class='option-list'>
                                    <a href='./index.php?insert_category'><li class='item'>Add Categories</li></a>
                                    <a href='./index.php?view_category'><li class='item'>View Categories</li></a>
                                    <a href='./index.php?add_product'><li class='item'>Add Product</li></a>
                                    <a href='./index.php?view_product'><li class='item'>View Products</li></a>
                                    <a href='./index.php?all_orders'><li class='item'>All Orders</li></a>
                                    <a href='./index.php?dispatched_orders'><li class='item'>Dispatched Orders</li></a>
                                    <a href='./index.php?list_users'><li class='item'>List Users</li></a>
                                    <a href='./index.php?list_admins'><li class='item'>List Admins</li></a>
                                    <a href='./admin_register.php?check=663' target='_blank'><li class='item'>Add Admin</li></a>
                                    <a href='./Logout.php'><li class='item'>Logout</li></a>
                                </ul>";
                        ?>
                    </div>
                </div>
            </div>

            <div class="content back-front">
                <?php 
                    if(isset($_GET["insert_category"])) {
                        include('insert_categories.php');
                    }
                    elseif(isset($_GET["view_category"])) {
                        include('view_category.php');
                    }
                    elseif(isset($_GET["add_product"])) {
                        include('add_product.php');
                    }
                    elseif(isset($_GET["view_product"])) {
                        include('view_product.php');
                    }
                    elseif(isset($_GET["edit_prod"])) {
                        include('edit_product.php');
                    }
                    elseif(isset($_GET["all_orders"])) {
                        include('all_orders.php');
                    }
                    elseif(isset($_GET["dispatch_order"])) {
                        include('dispatch_order.php');
                    }
                    elseif(isset($_GET["dispatched_orders"])) {
                        include('dispatched_orders.php');
                    }
                    elseif(isset($_GET["list_users"])) {
                        include('list_users.php');
                    }
                    elseif(isset($_GET["list_admins"])) {
                        include('list_admins.php');
                    }
                    
                ?>
            </div>
        </div>
        <script src="../../js/nav.js"></script>
        <script src="../../js/admin.js"></script>

    </body>
</html>