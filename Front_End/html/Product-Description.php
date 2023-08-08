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
        <link rel="stylesheet" href="../css/nav-merch.css">
        <link rel="stylesheet" href="../css/product-slider.css">
        <link rel="stylesheet" href="../css/product.css">
            <link rel="preconnect" href="https://fonts.googleapis.com"> 
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Lora&display=swap" rel="stylesheet">
        <title>Founding Head</title>
    </head>

    <body>
        
        <?php 
            getnav();
            searchElse();
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

            <div class="product-display-container">
                <div class="product-display">
                    <section aria-label="Newest Photos" class="">
                        <div class="carousel" data-carousel>
                            <button class="carousel-button prev" data-carousel-button="prev">&#8656;</button>
                            <button class="carousel-button next" data-carousel-button="next">&#8658;</button>
                            <?php 
                                getProductDescription();
                            ?>
                        </div>
                    </section>
    
                    <div class="buy-buttons">
                        <?php 
                            $product_id = $_GET['product_id'];

                            if(isset($_SESSION['username'])) {
                                echo "<button class='add-to-cart'><a href='./Merch.php?add_to_cart=$product_id'>Add To Cart</a></button>";
                            }
                            else {
                                echo "<button class='add-to-cart'><a href='./user_area/Login.php' target='_blank'>Login to Add To Cart</a></button>";
                            }
                        ?>
                    </div>
                </div>
            </div>

            <div class="product-details">
                <div class="product-description">
                    <h2>Product Description</h2>

                    <?php 
                        $product_id = $_GET['product_id'];
                        $select_query = "select * from `products` where product_id = $product_id";
                        $result_query = mysqli_query($con, $select_query);
                        $row = mysqli_fetch_assoc($result_query);
                        $product_description = $row['product_description'];
                        echo "<p>$product_description</p>";

                    ?>

                </div>

                <!-- <div class="sizes info">
                    <h3>Select Size:</h3>
                    <button class="item-size small">S</button>
                    <button class="item-size">M</button>
                    <button class="item-size">L</button>
                    <button class="item-size">XL</button>
                </div> -->

                <div class="price info">
                    <h3>Pay For Gainz:</h3>

                    <?php 

                        $product_id = $_GET['product_id'];
                        $select_query = "select * from `products` where product_id = $product_id";
                        $result_query = mysqli_query($con, $select_query);
                        $row = mysqli_fetch_assoc($result_query);
                        $product_price = $row['product_price'];
                        echo "<p>₹ $product_price</p>";

                    ?>

                </div>

                <!-- <div class="zip-code info">
                    <input type="text">
                    <button type="submit">Check you Zip Code</button>
                </div> -->

                <div class="extras">
                    <h1>More from Founding Head</h1>
                    <div class="more-options">
                            <?php 
                                moreOptions();
                            ?>
                        
                    </div>
                </div>
            </div>
        </div>
        
        <script src="../js/nav.js"></script>
        <script src="../js/slider.js"></script>
        <script src="../js/product-page.js"></script>
    </body>
</html>