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
        <link rel="icon" href="../../Images/Trident.png" type="image/x-icon"/>
        <link rel="stylesheet" href="../../css/nav-merch.css">
        <link rel="stylesheet" href="../../css/login.css">
        <link rel="icon" href="../Images/Trident.png" type="image/x-icon"/>
            <link rel="preconnect" href="https://fonts.googleapis.com"> 
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Lora&display=swap" rel="stylesheet">
        <title>Founding Head</title>
    </head>

    <body>
        <?php 
            adminNav();
            admin_register();

            $check = $_GET['check'];
            if($check != 663) {
                echo "alert('Not valid input')";
                echo "<script>window.open('../index.php', '_self')</script>";
            }
        ?>

        <div class="page-container signcon">

            <section class="signup-section">
                <h1>Sign Up</h1>
    
                <form method="post" enctype="multipart/form-data" class="signup_container" id="signup_form">

                    <!-- Email -->
                    <div class="item">
                        <label for="email">Email Id</label>
                        <input type="text" name="email" autofocus="" autocapitalize="none" autocomplete="email" required id="id_email" placeholder="simple@example.com">
                    </div>

                    <!-- Admin Name -->
                    <div class="item">
                        <label for="username">Your Name</label>
                        <input type="text" name="admin_user" autofocus="" autocapitalize="none" required id="id_username" placeholder="First and Last">
                    </div>
                    
                    <!-- Password -->
                    <div class="item">
                        <label for="pass">Password</label>
                        <input type="password" name="pass" id="id_password" required>
                        
                        <div class="show-button">
                            <input type="checkbox" onclick="PassShow()">Show Password
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="item">
                        <label for="pass">Confirm Password</label>
                        <input type="text" name="con_pass" id="id_conpassword" required>
                        <p id="password_missmatch"></p>
                    </div>

                    <!-- User Image -->
                    <div class="item">
                        <label for="admin_image">Your Profile Image</label>
                        <input type="file" id="user_image" name="admin_image" requried>
                    </div>

                    <!-- Mobile Number -->
                    <div class="item">
                        <label for="mobile">Mobile Number</label>
                        <input type="text" name="mobile" autofocus="" autocapitalize="none" required id="id_mobile" placeholder="10 digits">
                        <p id="invalid_number"></p>
                    </div>
                    
                    <!-- Submit -->
                    <input type="submit" name="submit" value="Submit" class="button">
                </form>

                <!-- <div class="signup">
                    <h4>Already a JimBro?</h4>
                    <h5><a href="Login.php">Login</a></h5>
                </div> -->
            </section>
            
        </div>
        

        <script src="../../js/nav.js"></script>
        <script src="../../js/login.js"></script>
    </body>
</html>