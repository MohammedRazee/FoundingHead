<?php 
    // Calling database for some reason
    include('../includes/connection.php');

    // Admin Nav Panel
    function adminNav() {
        global $con;
        echo "<nav class='nav'>
                <ul class='nav-menu'>
                    <li class='menu-items'>
                        <a href='../index.php' class='nav-link'>Visit Site</a>
                    </li>";



                    // <li class='menu-items'>
                    //     <a href='../Community-FAQ.php' class='nav-link'>Community FAQ</a>
                    // </li>
                    // <li class='menu-items'>
                    //     <div class='nav-link'><a href='../Merch.php' class='nav-link'>Merchandise</a></div>
                    // </li>




                    if(isset($_SESSION['admin_user'])) {
                        echo "<li class='menu-items'>
                                <div class='nav-link'>
                                    <a href='../user_area/Logout.php' target='_self' class='nav-link'>Logout</a>
                                </div>
                            </li>";
                    }
        
        echo "</ul>

                <div class='nav-logo'>
                    <a href='#' title='Goto Admin Page'><img src='../../Images/Founding Head white.png' alt='Home Logo'></a>
                </div>";
                
        echo "<div class='menu-hamburger'>
                    <span class='bar'></span>
                    <span class='bar'></span>
                    <span class='bar'></span>
                </div>
            </div>
                </nav>";
            
    }

    // Login Admin
    function login_admin() {
        global $con;

        if(isset($_POST['submit'])) {
            $admin_user = $_POST['admin_user'];
            $password = $_POST['pass'];
            $select_query = "select * from `admin_table` where admin_user = '$admin_user'";
            $result = mysqli_query($con, $select_query);
            $num_rows = mysqli_num_rows($result);
            $row_data = mysqli_fetch_assoc($result);
            if($num_rows > 0) {
                $admin_id = $row_data['admin_id'];
                if(password_verify($password, $row_data['admin_password'])) {
                    $_SESSION['admin_user'] = $admin_user;
                    $_SESSION['admin_id'] = $admin_id;
                    echo "<script>alert('Admin Verified')</script>";
                    echo "<script>window.open('./index.php', '_self')</script>";
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
                            errorfield.textContent = 'Who you sneaking here?';
                        });
                    </script>";
            }

        }
    }

    // Register Admins
    function admin_register() {
        global $con;
        if(isset($_POST['submit'])) {
            $email = $_POST['email'];
            $admin_user = $_POST['admin_user'];
            $password = $_POST['pass'];
            $hash_password = password_hash($password, PASSWORD_DEFAULT);
            $mobile_num = $_POST['mobile'];
            $ip = getIPAddress_admin();

            // Select Query
            $select_query = "select * from `admin_table` where admin_user = '$admin_user' or admin_email = '$email' or admin_mobile = '$mobile_num'";
            $result = mysqli_query($con, $select_query);
            $rows_count = mysqli_num_rows($result);

            if($rows_count == 0) {
                // Image acceptance
                $admin_image = $_FILES['admin_image']['name'];
                $temp_admin_image = $_FILES['admin_image']['tmp_name'];
                move_uploaded_file($temp_admin_image, "./admin_images/$admin_image");

                $input_query = "insert into `admin_table` (admin_user, admin_email, admin_password, admin_image, admin_ip,  admin_mobile) values ('$admin_user', '$email', '$hash_password', '$admin_image', '$ip', '$mobile_num')";
                $input_query_db = mysqli_query($con, $input_query);
                if($input_query_db) {
                    echo "<script>alert('Admin Added')</script>";
                    echo "<script>window.open('./index.php', '_self')</script>";
                }
            }
            else {
                echo "<script>
                        alert('Admin Already Exists!!!');
                    </script>";
            }

            
        }
    }

    // Get IP address function
    function getIPAddress_admin() {  
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
?>