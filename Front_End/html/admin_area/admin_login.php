<!-- Calling files -->
<?php 
    include('../includes/connection.php');
    include('../functions/admin_functions.php');
    @session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../css/nav-merch.css">
        <link rel="stylesheet" href="../../css/login.css">
        <link rel="icon" href="../../Images/Trident.png" type="image/x-icon"/>
            <link rel="preconnect" href="https://fonts.googleapis.com"> 
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Lora&display=swap" rel="stylesheet">
        <title>Founding Head</title>
    </head>

    <body>
        <?php 
            adminNav();
            login_admin();
        ?>
        <div class="page-container">

            <section class="login-section border">
                <h1>Welcome Boss Man</h1>
    
                <form method="post" class="form">

                    <!-- Username -->
                    <div class="item">
                        <label for="username">Admin</label>
                        <input type="text" name="admin_user" autofocus="" autocapitalize="none" autocomplete="username" required="" id="id_username">
                        <p class="nouser"></p>
                    </div>

                    <!-- Password -->
                    <div class="item">
                        <label for="pass">Password</label>
                        <input type="password" name="pass" autocomplete="current-password" required="" id="id_password">

                        <div class="show-button">
                            <input type="checkbox" onclick="PassShow()">Show Password
                        </div>
                        <p class="badpass"></p>
                    </div>

                    <!-- Submit -->
                    <input type="submit" name="submit" value="Submit" class="button">
                </form>

                <!-- <div class="signup">
                    <h4>Join the Crew-></h4>
                    <h5><a href="./admin_register.php">Register Admin</a></h5>
                </div> -->
            </section>

            <!-- <div class="footer">
                <h1>Join Us To Be Who You Are Meant To Be</h1>
            </div> -->
            
        </div>
        
        
        <script src="../../js/nav.js"></script>
        <script src="../../js/login.js"></script>
    </body>
</html>