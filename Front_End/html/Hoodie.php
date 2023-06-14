<!-- Connecting Database -->
<?php 
    include("includes/connection.php");
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
            <link href="https://fonts.googleapis.com/css2?family=Lora&display=swap" rel="stylesheet">
        <title>Founding Head</title>
    </head>
    <body>
        <nav class="nav">
            <ul class="nav-menu">
                <li class="menu-items">
                    <a href="index.php" class="nav-link">Home</a>
                </li>
                <li class="menu-items">
                    <a href="Community-FAQ.php" class="nav-link">Community FAQ</a>
                </li>
                <li class="menu-items">
                    <div class="nav-link merch-dropdown"><a href="Merch.php" class="nav-link">Merchandise</a></div>
                </li>
            </ul>

            <div class="menu-hamburger">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>

            <div class="nav-logo">
                <img src="../Images/Founding Head white.png" alt="Home Logo">
            </div>

            <div class="nav-buttons">
                <div class="cart button">
                    <a href="Individual-Product/Cart.php" target="_self"><img src="../Images/cart logo.png" alt="cart_logo"></a>
                </div>

                <div class="login button">
                    <a href="Individual-Product/Login.php" target="_self"><img src="../Images/login.png" alt="login_logo"></a>
                </div>
            </div>
            
        </nav>

        <div class="page-container">
            <aside class="browser">
                <div class="browser-container">
                    <h2>Select Your Fit GymBro</h2>
                    <?php 
                        $select_categories = "select * from `categories`";
                        $result_categories = mysqli_query($con, $select_categories);
                        while($row_data = mysqli_fetch_assoc($result_categories)) {
                            $category_title = $row_data['category_title'];
                            $category_id = $row_data['category_id'];
                            echo "<a href='Hoodies.php?category=$category_id' class='options'>$category_title</a>";
                        }
                    ?>
                    <!-- <a href="#" class="options active">Hoodies</a>
                    <a href="Tshirts.php" class="options">Tshirts</a>
                    <a href="Caps.php" class="options">Caps</a>
                    <a href="Equipments.php" class="options">Equipment</a> -->
                </div>
                
            </aside>

            <section class="grid-container">
                <div class="items">
                    <a href="Individual-Product/Product-Description.php" target="_blank">
                        <img src="../Images/Figma-Merchandise/Hoodies/Hoodie 1.png" alt="Hoodie #1">
                        <h5>Hoodie 1</h5>
                    </a>
                    <p>₹ 1000</p>
                </div>
                <div class="items">
                    <a href="Individual-Product/Product-Description.php" target="_blank">
                        <img src="../Images/Figma-Merchandise/Hoodies/Hoodie 2.png" alt="Hoodie #2">
                        <h5>Hoodie 2</h5>
                    </a>
                    <p>₹ 1000</p>
                </div>
                <div class="items">
                    <a href="Individual-Product/Product-Description.php" target="_blank">
                        <img src=" ../Images/Figma-Merchandise/Hoodies/Hoodie 3.png" alt="Hoodie #3">
                        <h5>Hoodie 3</h5>
                    </a>
                    <p>₹ 1000</p>
                </div>
                <div class="items">
                    <a href="Individual-Product/Product-Description.php" target="_blank">
                        <img src="../Images/Figma-Merchandise/Hoodies/Hoodie 4.png" alt="Hoodie #4">
                        <h5>Hoodie 4</h5>
                    </a>
                    <p>₹ 1000</p>
                </div>
                <div class="items">
                    <a href="Individual-Product/Product-Description.php" target="_blank">
                        <img src="../Images/Figma-Merchandise/Hoodies/Hoodie 5.png" alt="Hoodie #5">
                        <h5>Hoodie 5</h5>
                    </a>
                    <p>₹ 1000</p>
                </div>
                <div class="items">
                    <a href="Individual-Product/Product-Description.php" target="_blank">
                        <img src="../Images/Figma-Merchandise/Hoodies/Hoodie 6.png" alt="Hoodie #6">
                        <h5>Hoodie 6</h5>
                    </a>
                    <p>₹ 1000</p>
                </div>
                <div class="items">
                    <a href="Individual-Product/Product-Description.php" target="_blank">
                        <img src="../Images/Figma-Merchandise/Hoodies/Hoodie 7.png" alt="Hoodie #7">
                        <h5>Hoodie 7</h5>
                    </a>
                    <p>₹ 1000</p>
                </div>
                <div class="items">
                    <a href="Individual-Product/Product-Description.php" target="_blank">
                        <img src="../Images/Figma-Merchandise/Hoodies/Hoodie 8.png" alt="Hoodie #8">
                        <h5>Hoodie 8</h5>
                    </a>
                    <p>₹ 1000</p>
                </div>
            </section>
        </div>

        <div class="footer">
            <h1>Join Us To Be Who You Are Meant To Be</h1>
        </div>

        <script src="../js/nav.js"></script>
    </body>
</html>