<?php 
    global $Puser_id, $Ppassword, $Puser_street, $Puser_town, $Puser_state, $Puser_landmark, $Pzipcode, $con;
    echo "<section class='signup-section'>
            <h1>Change Password</h1>

            <form method='post' class='signup_container' id='signup_form'>
                <!-- Password -->
                <div class='item'>
                    <label for='pass'>Verify Old Password</label>
                    <input type='password' name='pass' id='id_password' required>
                    
                    <div class='show-button'>
                        <input type='checkbox' onclick='PassShow()'>Show Password
                    </div>
                </div>

                <!-- New Password -->
                <div class='item'>
                    <label for='pass'>New Password</label>
                    <input type='text' name='con_pass' id='id_conpassword' required>
                    <p id='password_missmatch'></p>
                </div>
                
                <!-- Submit -->
                <input type='submit' name='submit' value='Submit' class='button'>
            </form>
        </section>";

    if(isset($_POST['submit'])) {
        $old_password = $_POST['pass'];
        $new_password = $_POST['con_pass'];

        if(password_verify($old_password, $Ppassword)) {
            $hash_new = password_hash($new_password, PASSWORD_DEFAULT);
            $update_query = "update `user_table` set user_password = '$hash_new'";
            $result_query = mysqli_query($con, $update_query);

            echo "<script>alert('Password updated')</script>";
            echo "<script>window.open('profile.php', '_self')</script>";
        }
        else {
            echo "<script>alert('Incorrect Password')</script>";
        }
    }
?>