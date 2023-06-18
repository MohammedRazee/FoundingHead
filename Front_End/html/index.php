<!-- Calling Files -->
<?php 
    include("includes/connection.php");
    include("functions/common_function.php");
    include("./functions/header_nav.php");
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/home.css">
        <link rel="stylesheet" href="../css/nav.css">
        <link rel="stylesheet" href="../css/slider.css">
        <link rel="icon" href="../Images/Trident.png" type="image/x-icon"/>
            <link rel="preconnect" href="https://fonts.googleapis.com"> 
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Lora&display=swap" rel="stylesheet">
        <title>Founding Head</title>
    </head>
    
    <body>
        <div class="page-grid-container">

            <div class="hero block">
                <a href="index.php" target="_self">
                    <img src="../Images/Founding Head white.png" alt="Founding Head Logo"> 
                </a>
            </div>

            <?php 
                getnav();
                searchElse();
            ?>
            
            <div class="content">
                <div class="merch-section section">
                    <h3 class="title"><a href="./Merch.php" target="_blank">Shop for our new Collection</a></h3>
                    <section aria-label="Newest Photos">
                        <div class="carousel" data-carousel>
                            <button class="carousel-button prev" data-carousel-button="prev">&#8656;</button>
                            <button class="carousel-button next" data-carousel-button="next">&#8658;</button>
                            <ul data-slides>
                                <li class="slide" data-active>
                                    <img src="../images/Merch image.png" alt="Merchendise #1">
                                </li>
                                <li class="slide">
                                    <img src="../images/Merch image 2.png" alt="Merchendise #2">
                                </li>
                                <li class="slide">
                                    <img src="../images/Merch image 3.png" alt="Merchendise #3">
                                </li>
                            </ul>
                        </div>
                    </section>
                </div>

                <div class="community-section section">
                    <h3 class="title"><a href="./Community-FAQ.php" target="_blank">Join us at Founding Head</a></h3>
                    <section aria-label="Newest Photos">
                        <div class="carousel" data-carousel>
                            <button class="carousel-button prev" data-carousel-button="prev">&#8656;</button>
                            <button class="carousel-button next" data-carousel-button="next">&#8658;</button>
                            <ul data-slides>
                                <li class="slide" data-active>
                                    <img src="../images/Community image.png" alt="Community #1">
                                </li>
                                <li class="slide">
                                    <img src="../images/Community image 2.png" alt="Community #2">
                                </li>
                                <li class="slide">
                                    <img src="../images/Community image 3.png" alt="Community #3">
                                </li>
                            </ul>
                        </div>
                    </section>
                </div>
            </div>

            <div class="sidebar">
                <div class="power-text">
                    <img src="../images/photo13.jfif" alt="Newsletter">
                    <p>Join our Newsletter for 10% more Gainz</p>
                </div>

                <div class="email">
                    <form action="">
                        <label for="Newsletter-email">Email</label>
                        <br>
                        <input type="email" name="Newsletter-email" id="news-mail" placeholder="sample@gmail.com">
                        <button type="submit">Submit</button>
                    </form>
                </div>

                <div class="social-icons">
                    <a href="https://www.facebook.com/profile.php?id=100087129261273" target="_blank"><img src="../images/facebook.png" alt="facebook icon"></a>
                    <a href="https://www.instagram.com/foundinghead/" target="_blank"><img src="../images/instagram.png" alt="instagram icon"></a>
                </div>
            </div>

            <div class="footer">
                <h3>Developed by: </h3>
                <a href="https://github.com/MohammedRazee/" target="_blank">@MdRazee</a>
                <a href="https://github.com/vin23sanity" target="_blank">@VinayakPradhan</a>
            </div>

        </div>

        <script src="../js/slider.js" defer></script>
        <script src="../js/home.js" defer></script>
        <script src="../js/nav.js" defer></script>
    </body>
</html>