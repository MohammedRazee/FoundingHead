<?php 
    // include("../includes/connection.php");
    global $Puser_id, $Pusername, $Puser_email, $Puser_image, $Puser_mobile, $con;
    echo "<section class='signup-section'>
            <h1>Edit Details</h1>

            <form method='post' enctype='multipart/form-data' class='signup_container' id='signup_form'>
            
            <!-- Email -->
            <div class='item'>
                <label for='email'>Email Id</label>
                <input type='text' name='email' autofocus='' autocapitalize='none' autocomplete='email' required id='id_email' value='$Puser_email'>
            </div>
            
            <!-- Username -->
            <div class='item'>
                <label for='username'>Username</label>
                <input type='text' name='username' autofocus='' autocapitalize='none' required id='id_username' value='$Pusername'>
            </div>
            
            <!-- User Image -->
            <div class='item'>
                <label for='user_image'>Your Profile Image</label>
                <input type='file' id='user_image' name='user_image'>
            </div>
            
            <!-- Mobile Number -->
            <div class='item'>
                <label for='mobile'>Mobile Number</label>
                <input type='text' name='mobile' autofocus='' autocapitalize='none' required id='id_mobile' value='$Puser_mobile'>
                <p id='invalid_number'></p>
            </div>
            
            <!-- Submit -->
            <input type='submit' name='submit' value='Submit' class='button'>
            </form>
        </section>";

    if(isset($_POST['submit'])) {
        $email = $_POST['email'];
        $name = $_POST['username'];
        $mobile = $_POST['mobile'];
        

        if($_FILES['user_image']['error'] === UPLOAD_ERR_OK) {
            $previous_image = './user_images/'.$Puser_image;
            if(file_exists($previous_image)) {
                unlink($previous_image);
            }

            $user_image = $_FILES['user_image']['name'];
            $temp_user_image = $_FILES['user_image']['tmp_name'];
            move_uploaded_file($temp_user_image, "./user_images/$user_image");
            $update_query = "update `user_table` set user_email = '$email', username = '$name', user_image = '$user_image', user_mobile = '$mobile' where user_id = $Puser_id";
            $result_query = mysqli_query($con, $update_query);
        }
        else {
            $update_query = "update `user_table` set user_email = '$email', username = '$name', user_mobile = '$mobile' where user_id = $Puser_id";
            $result_query = mysqli_query($con, $update_query);
        }

        echo "<script>alert('Details updated')</script>";
        echo "<script>window.open('profile.php', '_self')</script>";

    }
?>


