<?php 
    // Calling database for some reason
    include('../includes/connection.php');

    function getInnerNav() {

        global $con;
        $cart_items = cart_item_num();
        echo "<nav class='nav'>
                <ul class='nav-menu'>
                    <li class='menu-items'>
                        <a href='../index.php' class='nav-link'>Home</a>
                    </li>
                    <li class='menu-items'>
                        <a href='../Community-FAQ.php' class='nav-link'>Community FAQ</a>
                    </li>
                    <li class='menu-items'>
                        <div class='nav-link'><a href='../Merch.php' class='nav-link'>Merchandise</a></div>
                    </li>";

                    if(isset($_SESSION['username'])) {
                        echo "<li class='menu-items'>
                                <div class='nav-link'>
                                    <a href='../user_area/Logout.php' target='_self' class='nav-link'>Logout</a>
                                </div>
                            </li>";
                    }
        
        echo "</ul>

                <div class='nav-logo'>
                    <a href='../index.php' title='Goto Home Page'><img src='../../Images/Founding Head white.png' alt='Home Logo'></a>
                </div>


                <div class='nav-buttons'>
                    <div class='search-section'>
                        <form action'' method='get'>
                            <input class='search-bar' type='search' placeholder='Search' name='search_data'>
                            <input class='search-button' type='submit' value='Search' name='search_data_product'>
                        </form>
                    </div>

                    <div class='cart button'>
                        <a href='../Cart.php' target='_self' title='Cart'><img src='../../Images/cart logo.png' alt='cart_logo'><sub>$cart_items</sub></a>
                    </div>";
                    
        if(!isset($_SESSION['username'])) {
            echo "<div class='login button'>
                    <a href='../user_area/Login.php' target='_self' title='Login'><img src='../../Images/login.png' alt='login_logo'></a>
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
                    <a href='../user_area/profile.php' target='_self' title='Profile'><img src='../user_area/user_images/$user_image' alt='profile' class='user-profile'></a>
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

    // getting the number of items in cart
    function cart_item_num() {
        global $con;

        if(isset($_SESSION['username'])) {
            $user_id = $_SESSION['user_id'];
            $select_query = "select * from `cart_details` where user_id = $user_id";
            $result_query = mysqli_query($con, $select_query);
            $count_cart_items = mysqli_num_rows($result_query);
    
            return $count_cart_items;
        }
        else {
            return 0;
        }
    }

    // Get IP address function
    function getIPAddress_inner() {  
         if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                    $ip = $_SERVER['HTTP_CLIENT_IP'];  
            }  
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
         }  
        else{  
                 $ip = $_SERVER['REMOTE_ADDR'];  
         }  
         return $ip;  
    }  

    // Searching function for inner pages
    function searchElseInner() {
        if(isset($_GET['search_data_product'])) {
            $search_data_value1 = $_GET['search_data'];
            echo "<script>window.open('../Merch.php?search_data=$search_data_value1&search_data_product=Search', '_self')</script>";
        }
    }

    // Registration of New User
    function registration() {

        global $con;
        if(isset($_POST['submit'])) {
            $email = $_POST['email'];
            $username = $_POST['username'];
            $password = $_POST['pass'];
            $hash_password = password_hash($password, PASSWORD_DEFAULT);
            $address = $_POST['address_street'];
            $town = $_POST['address_town'];
            $state = $_POST['address_state'];
            $landmark = $_POST['address_landmark'];
            $mobile_num = $_POST['mobile'];
            $zipcode = $_POST['zipcode'];
            $ip = getIPAddress_inner();

            // Select Query
            $select_query = "select * from `user_table` where username = '$username' or user_email = '$email' or user_mobile = '$mobile_num'";
            $result = mysqli_query($con, $select_query);
            $rows_count = mysqli_num_rows($result);

            if($rows_count == 0) {
                // Image acceptance
                $user_image = $_FILES['user_image']['name'];
                $temp_user_image = $_FILES['user_image']['tmp_name'];
                move_uploaded_file($temp_user_image, "./user_images/$user_image");

                $input_query = "insert into `user_table` (username, user_email, user_password, user_image, user_ip, user_address_street, user_address_town, user_address_state, user_address_landmark, zipcode, user_mobile) values ('$username', '$email', '$hash_password', '$user_image', '$ip', '$address','$town','$state','$landmark', '$zipcode', '$mobile_num')";
                $input_query_db = mysqli_query($con, $input_query);
                if($input_query_db) {
                    echo "<script>alert('User Added')</script>";
                    echo "<script>window.open('./profile.php', '_self')</script>";
                }
            }
            else {
                echo "<script>
                        alert('User Already Exists!!!');
                    </script>";
            }

            
        }
    }

    // Login of User
    function login_user() {
        global $con;

        if(isset($_POST['submit'])) {
            $username = $_POST['username'];
            $password = $_POST['pass'];
            $select_query = "select * from `user_table` where username = '$username'";
            $result = mysqli_query($con, $select_query);
            $num_rows = mysqli_num_rows($result);
            $row_data = mysqli_fetch_assoc($result);
            if($num_rows > 0) {
                $user_id = $row_data['user_id'];
                if(password_verify($password, $row_data['user_password'])) {
                    $_SESSION['username'] = $username;
                    $_SESSION['user_id'] = $user_id;
                    echo "<script>alert('User verified')</script>";
                    echo "<script>window.open('./profile.php', '_self')</script>";
                }
                else {
                    echo "<script>
                            document.addEventListener('DOMContentLoaded', ()=> {
                                const wrongpass = document.querySelector('.badpass');
                                wrongpass.textContent = 'Incorrect Password';
                            });
                        </script>";
                }
            }
            else {
                echo "<script>
                        document.addEventListener('DOMContentLoaded', ()=> {
                            const errorfield = document.querySelector('.nouser');
                            errorfield.textContent = 'Username does not exist';
                        });
                    </script>";
            }

        }
    }
?>