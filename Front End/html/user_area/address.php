<?php 
    global $Puser_id, $Puser_street, $Puser_town, $Puser_state, $Puser_landmark, $Pzipcode, $con;
    echo "<section class='signup-section'>
            <h1>Edit Address</h1>

            <form method='post' class='signup_container disable_form' id='signup_form'>
                <!-- Address -->
                <div class='item'>
                    <label for='address_street'>Address <i>(Area and Street)</i></label>
                    <input type='text' name='address_street' autofocus='' autocapitalize='none' required id='id_address' value='$Puser_street'>
                </div>

                <div class='item'>
                    <label for='address_town'>City/District/Town</label>
                    <input type='text' name='address_town' autofocus='' autocapitalize='none' required id='id_address' value='$Puser_town'>
                </div>

                <div class='item'>
                    <label for='address_state'>State</label>
                    <input type='text' name='address_state' autofocus='' autocapitalize='none' required id='id_address' value='$Puser_state'>
                </div>

                <div class='item'>
                    <label for='address_landmark'>Landmark <i>(Optional)</i></label>
                    <input type='text' name='address_landmark' autofocus='' autocapitalize='none' id='id_address' value='$Puser_landmark'>
                </div>

                <!-- Zipcode -->
                <div class='item'>
                    <label for='zipcode'>Zipcode</label>
                    <input type='text' name='zipcode' autofocus='' autocapitalize='none' required id='id_zipcode' value='$Pzipcode'>
                </div>
                
                <!-- Submit -->
                <input type='submit' name='submit' value='Submit' class='button'>
            </form>
        </section>";

    if(isset($_POST['submit'])) {
        $street = $_POST['address_street'];
        $town = $_POST['address_town'];
        $state = $_POST['address_state'];
        $landmark = $_POST['address_landmark'];
        $zipcode = $_POST['zipcode'];

        $update_query = "update `user_table` set user_address_street = '$street', user_address_town = '$town', user_address_state = '$state', user_address_landmark = '$landmark', zipcode = '$zipcode'";

        $result_query = mysqli_query($con, $update_query);

        echo "<script>alert('Address updated')</script>";
        if(isset($_GET['details'])) {
            echo "<script>window.open('./profile.php', '_self')</script>";
        }
        elseif(isset($_GET['address_edit'])) {
            echo "<script>window.open('./Checkout.php?address_edit', '_self')</script>";
        }
    }
?>