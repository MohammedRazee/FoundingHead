<h1 class="order-heading">All Users</h1>
<br>
<table>
        <tr>
            <th>User Id</th>
            <th>Username</th>
            <th>User Email</th>
            <th>User IP</th>
            <th>User Phone Number</th>
        </tr>
    <?php
        $table_query = "select * from `user_table`";
        $result = mysqli_query($con, $table_query);
        while($table_row = mysqli_fetch_assoc($result)) {
            $user_id = $table_row['user_id'];
            $username = $table_row['username'];
            $user_email = $table_row['user_email'];
            $user_ip = $table_row['user_ip'];
            $user_mobile = $table_row['user_mobile'];
    ?>

        <?php
            echo "<tr>
                <td>$user_id</td>
                <td>$username</td>
                <td>$user_email</td>
                <td>$user_ip</td>
                <td>$user_mobile</td>";
            echo "</tr>";
        ?>
    <?php 
        }
    ?>
</table>