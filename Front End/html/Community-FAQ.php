<!-- Calling Fields -->
<?php 
    include("functions/header_nav.php");
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/faq.css">
        <link rel="stylesheet" href="../css/nav-merch.css">
        <link rel="icon" href="../Images/Trident.png" type="image/x-icon"/>
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

        <section class="content">
            <aside class="image left">
                <img src="../Images/Community-aside 1.png" alt="Side Image">
            </aside>

            <div class="faqs">
                <h1>Your Questions Matter</h1>
                <h2>Welcome to our Community FAQ</h2>
                <br><br>
                <h3 class="question">Q: What is an e-commerce clothing store?</h3>
                <p class="answer">A: An e-commerce clothing store is an online platform where customers can browse, select and purchase clothing items.</p>

                <br>

                <h3 class="question">Q: What are the benefits of shopping at an e-commerce clothing store?</h3>
                <p class="answer">A: Shopping at an e-commerce clothing store offers several benefits such as convenience, a wide range of options, better deals and discounts, and easy returns..</p>

                <br>

                <h3 class="question">Q: How can I find the right size of clothing when shopping online?</h3>
                <p class="answer">A: The best way to find the right size of clothing when shopping online is to check the size chart provided by the store and compare it with your measurements.</p>

                <br>

                <h3 class="question">Q: How can I pay for my purchase at an e-commerce clothing store?</h3>
                <p class="answer">A: E-commerce clothing stores typically offer several payment options such as credit cards, debit cards, net banking, and online payment wallets.</p>

                <br>

                <h3 class="question">Q: How long does it take for my order to be delivered?</h3>
                <p class="answer">A: The delivery time of your order depends on several factors such as your location, the shipping method you choose, and the availability of the product. Most e-commerce clothing stores provide estimated delivery times on their website.</p>

                <br>

                <h3 class="question">Q: Can I return an item purchased from an e-commerce clothing store?</h3>
                <p class="answer">A: Yes, most e-commerce clothing stores have a return policy that allows customers to return the items they have purchased. However, the return policy may vary from store to store, so it's best to check the policy before making a purchase.</p>

                <br>

                <h3 class="question">Q: How can I track my order?</h3>
                <p class="answer">A: You can track your order by using the tracking number provided by the store. Most e-commerce clothing stores provide a tracking link that you can use to track your order online.</p>

                <br>
                
                <h3 class="question">Q: Are there any discounts or promo codes available for e-commerce clothing stores?</h3>
                <p class="answer">A: Yes, many e-commerce clothing stores offer discounts and promo codes for their customers. You can usually find these codes on the store's website or social media pages.</p>
            </div>

            <aside class="image right">
                <img src="../Images/Community-aside 2.png" alt="Side Image">
            </aside>
        </section>

        <div class="footer">
            <h1>Join Us To Be Who You Are Meant To Be</h1>
        </div>

        <script src="../js/nav.js"></script>
    </body>
</html>