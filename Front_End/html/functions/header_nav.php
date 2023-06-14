<?php 
    // Calling database for some reason
    include('./includes/connection.php');
    include_once('./functions/common_function.php');

    function getnav() {

        global $con;
        $cart_items = cart_item();
        echo "<nav class='nav'>
                <ul class='nav-menu'>
                    <li class='menu-items'>
                        <a href='index.php' class='nav-link'>Home</a>
                    </li>
                    <li class='menu-items'>
                        <a href='Community-FAQ.php' class='nav-link'>Community FAQ</a>
                    </li>
                    <li class='menu-items'>
                        <div class='nav-link'><a href='Merch.php' class='nav-link'>Merchandise</a></div>
                    </li>";

        if(isset($_SESSION['username'])) {
            echo "<li class='menu-items'>
                    <div class='nav-link'>
                        <a href='./user_area/Logout.php' class='nav-link'>Logout</a>
                    </div>
                </li>";
        }

        
        echo "</ul>

                <div class='nav-logo'>
                    <a href='./index.php' title='Goto Home Page'><img src='../Images/Founding Head white.png' alt='Home Logo'></a>
                </div>


                <div class='nav-buttons'>
                    <div class='search-section'>
                        <form action'' method='get'>
                            <input class='search-bar' type='search' placeholder='Search' name='search_data'>
                            <input class='search-button' type='submit' value='Search' name='search_data_product'>
                        </form>
                    </div>
                    <div class='cart button'>
                        <a href='./Cart.php' target='_self' title='Cart'><img src='../Images/cart logo.png' alt='cart_logo'><sub>$cart_items</sub></a>
                    </div>";

        if(!isset($_SESSION['username'])) {
            echo "<div class='login button'>
                    <a href='./user_area/Login.php' target='_self' title='Login'><img src='../Images/login.png' alt='login_logo'></a>
                    </div>";
        }
        else {
            $username_set = $_SESSION['username'];
            $user_query = "select * from `user_table` where username = '$username_set'";
            $result_query = mysqli_query($con, $user_query);
            $row = mysqli_fetch_assoc($result_query);
            $user_id = $row['user_id'];
            $user_image = $row['user_image'];
            echo "<div class='login button'>
                    <a href='./user_area/profile.php' target='_self' title='Profile'><img src='./user_area/user_images/$user_image' alt='profile' class='user-profile'></a>
                    </div>";
        }
                
        echo "<div class='menu-hamburger'>
                    <span class='bar'></span>
                    <span class='bar'></span>
                    <span class='bar'></span>
                </div>
            </div>
             </nav>";
    }
?>