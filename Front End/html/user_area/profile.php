<!-- Calling files -->
<?php 
    include('../includes/connection.php');
    include('../functions/inner_functions.php');
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../css/nav-merch.css">
        <link rel="stylesheet" href="../../css/profile.css">
        <link rel="stylesheet" href="../../css/user_areas.css">
        <link rel="icon" href="../../Images/Trident.png" type="image/x-icon"/>
            <link rel="preconnect" href="https://fonts.googleapis.com"> 
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Lora&display=swap" rel="stylesheet">
        <title>Founding Head</title>
    </head>

    <body class="back-fade">
        <?php
            getInnerNav();
            searchElseInner();
        ?>

        <div class="page-container back-fade">
            <div class="browser">
                <div class="user-info back-front">
                    <div class="user-image">
                        <?php 
                            global $con;
                            $Pusername = $_SESSION['username'];
                            $select_query = "select * from `user_table` where username = '$Pusername'";
                            $result_query = mysqli_query($con, $select_query);
                            $row = mysqli_fetch_assoc($result_query);
                            $Puser_id = $row['user_id'];
                            $Ppassword = $row['user_password'];
                            $Puser_email = $row['user_email'];
                            $Puser_image = $row['user_image'];
                            $Puser_street = $row['user_address_street'];
                            $Puser_town = $row['user_address_town'];
                            $Puser_state = $row['user_address_state'];
                            $Puser_landmark = $row['user_address_landmark'];
                            $Pzipcode = $row['zipcode'];
                            $Puser_mobile = $row['user_mobile'];

                            echo "<img src='./user_images/$Puser_image' alt='User Image'>";
                            ?>
                    </div>
                    <div class="user-name">
                        <p>Hello,</p>
                        <?php 
                            echo "<h3>$Pusername</h3>";
                            
                        ?>
                    </div>
                </div>

                <div class="user-options back-front">
                    <div class="option-items">
                        <h2>Account Settings</h2>
                        <?php 
                            echo "<ul class='option-list'>
                                    <a href='./profile.php?details'><li class='item'>Edit Details</li></a>
                                    <a href='./profile.php?address'><li class='item'>Edit Address</li></a>
                                    <a href='./profile.php?password_change'><li class='item'>Change Password</li></a>
                                    <a href='./profile.php?orders'><li class='item'>View Orders</li></a>
                                    <a href='./Logout.php'><li class='item'>Logout</li></a>
                                </ul>";
                        ?>
                    </div>
                </div>
            </div>

            <div class="content back-front">
                <?php 
                    if(isset($_GET['details'])) {
                        include("./details.php");
                    }
                    elseif(isset($_GET['address'])) {
                        include("./address.php");
                    }
                    elseif(isset($_GET['password_change'])) {
                        include("./password_change.php");
                    }
                    elseif(isset($_GET['orders'])) {
                        include("./orders.php");
                    }
                    else {
                        include('./landing.php');
                    }
                ?>
            </div>
        </div>

        <script src="../../js/nav.js"></script>
        <script src="../../js/login.js"></script>
    </body>
</html>