<!-- Calling Files -->
<?php 
    include("includes/connection.php");
    include("functions/common_function.php");
    include("functions/header_nav.php");
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="../Images/Trident.png" type="image/x-icon"/>
        <link rel="stylesheet" href="../css/merch.css">
        <link rel="stylesheet" href="../css/nav-merch.css">
        <link rel="icon" href="Images/Trident.png" type="image/x-icon"/>
            <link rel="preconnect" href="https://fonts.googleapis.com"> 
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Lora&display=swap" rel="stylesheet">x-icon 
        <title>Founding Head</title>
    </head>
    <body>

        <?php 
            getnav();
            cart();
        ?>
        
        <div class="page-container">
            <aside class="browser">
                <div class="browser-container">
                    <h2>Select Your Fit GymBro</h2>
                    <a href='Merch.php' class='options active'>View All</a>
                    <?php 
                        browser();
                    ?>
                </div>
                
            </aside>

            <section class="grid-container">

                <?php
                    // Calling function
                    searchProduct();
                    getmerch();
                    getCategories();
                ?>
                <p><?php cart_item();?></p>

            </section>
        </div>

        <div class="footer">
                <h3>Developed by: </h3>
                <a href="https://github.com/MohammedRazee/" target="_blank">@MdRazee</a>
                <a href="https://github.com/vin23sanity" target="_blank">@VinayakPradhan</a>
            </div>

        <script src="../js/nav.js"></script>
    </body>
</html>