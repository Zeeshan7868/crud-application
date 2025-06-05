<?php

    require_once("require/database_connection.php");

    if(isset($_REQUEST['action']) && $_REQUEST['action'] == "get_form" ){
        ?>
        <fieldset>
            <legend>User Form</legend>
                <table>
                    <tr>
                        <td>First Name</td>
                        <td><input type="text" name="first_name" id="first_name" required></td>
                    </tr>
                    <tr>
                        <td>Middle Name</td>
                        <td><input type="text" name="middle_name" id="middle_name" required></td>
                    </tr>
                    <tr>
                        <td>Last Name</td>
                        <td><input type="text" name="last_name" id="last_name" required></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><input type="email" name="email" id="email" required></td>
                    </tr>
                    <tr>
                        <td>Phone Number</td>
                        <td><input type="text" name="phone_number" id="phone_number" required></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <button onclick="add_user()">Add User</button>
                            <button onclick="cancel()">Cancel</button>
                        </td>
                    </tr>
                </table>
            
        </fieldset>
        <?php
    }

    if(isset($_REQUEST['action']) && $_REQUEST['action'] == "add_user" ){

        $query = "INSERT INTO user (first_name,middle_name,last_name,email,phone_number) values ('".$_REQUEST['first_name']."','".$_REQUEST['middle_name']."','".$_REQUEST['last_name']."','".$_REQUEST['email']."','".$_REQUEST['phone_number']."') ";
        $result = mysqli_query($connection,$query) or die("Failed To execute query:  ".mysqli_error($connection));
        if($result){
            echo "User Added successfully!...";
        }else{
            echo "User Not Added Successfully!....";
            }
    }


    if(isset($_REQUEST['action']) && $_REQUEST['action'] == "show_data" ){
        if(isset($_REQUEST['search'])){
            $query = "SELECT * from user where first_name like '%".$_REQUEST['search']."%' OR middle_name like '%".$_REQUEST['search']."%'  OR last_name like '%".$_REQUEST['search']."%'  OR email like '%".$_REQUEST['search']."%'  ORDER BY user_id DESC ";
        }else{
            $query = "SELECT * from user  ORDER BY user_id DESC";
        }
        $result = mysqli_query($connection,$query) or die("Failed To execute query:  ".mysqli_error($connection));

        if($result->num_rows > 0){
            $sr_no = 0;
                ?>
                <table border="1" cellpadding="5">
                    <tr>
                        <th>Sr NO</th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Action</th>
                    </tr>
                    <?php
            while($row = mysqli_fetch_assoc($result)){
                $sr_no++;
                ?>
                <tr>
                    <td><?= $sr_no ?></td>
                    <td><?= $row['first_name'] ?></td>
                    <td><?= $row['middle_name'] ?></td>
                    <td><?= $row['last_name'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['phone_number'] ?></td>
                    <td>
                    <button onclick="edit_user(<?= $row['user_id'] ?>)" >Edit</button>
                    <button onclick="
                     if(confirm('do you want to delete?')){
                        delete_user(<?= $row['user_id'] ?>)
                        }
                     ">Delete</button>
                    </td>
                </tr>
                <?php
            }
            ?>
            </table>
            <?php
        }
        
    }


    if(isset($_REQUEST['action']) && $_REQUEST['action'] == "edit_user" ){
        $query = "SELECT * from user where user_id=".$_REQUEST['user_id'];
        $result = mysqli_query($connection,$query);
        $row = mysqli_fetch_assoc($result);
        ?>
        <fieldset>
            <legend>Update Form</legend>
                <table>
                    <tr>
                        <td>First Name</td>
                        <td><input type="text" name="first_name" id="first_name" value="<?= $row['first_name'] ?>" required ></td>
                    </tr>
                    <tr>
                        <td>Middle Name</td>
                        <td><input type="text" name="middle_name" id="middle_name" value="<?= $row['middle_name'] ?>" required ></td>
                    </tr>
                    <tr>
                        <td>Last Name</td>
                        <td><input type="text" name="last_name" id="last_name" value="<?= $row['last_name'] ?>" required ></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><input type="email" name="email" id="email" value="<?= $row['email'] ?>" required></td>
                    </tr>
                    <tr>
                        <td>Phone Number</td>
                        <td><input type="text" name="phone_number" id="phone_number" value="<?= $row['phone_number'] ?>" required ></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <button onclick="update_user(<?= $row['user_id'] ?>)">Update User</button>
                            <button onclick="cancel()">Cancel</button>
                        </td>
                    </tr>
                </table>
            
        </fieldset>
        <?php
    }

    if(isset($_REQUEST['action']) && $_REQUEST['action'] == "delete_user" ){
        $query = "DELETE from user where user_id = ".$_REQUEST['user_id'];
        $result = mysqli_query($connection,$query) or die("Failed To execute query:  ".mysqli_error($connection));
        if($result){
            echo "User Deleted Successfully!...";
        }else{
            echo "User Not Deleted!...";
        }
    }

    if (isset($_REQUEST['action']) && $_REQUEST['action'] == "update_user") {
        $query = "UPDATE user SET first_name = '".$_REQUEST['first_name']."', middle_name = '".$_REQUEST['middle_name']."', last_name = '".$_REQUEST['last_name']." ',email = '".$_REQUEST['email']."', phone_number = '".$_REQUEST['phone_number']."' WHERE user_id = ".$_REQUEST['user_id'];
        $result = mysqli_query($connection, $query) or die("Query failed: " . mysqli_error($connection));
    
        if ($result) {
            echo "User updated successfully!...";
        } else {
            echo "User Not Updated!...";
        }
    }



?>