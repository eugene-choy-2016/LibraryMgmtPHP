<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Update User Details</title>
        <?php
        require '../model/User.php';
        include('../protect/staff_protection.php');
        ?>
        <script>
            function validateForm() {
                var username = document.forms["updateUser"]["user"].value;
                var password = document.forms["updateUser"]["password"].value;

                if (username == "" || password == "") {
                    alert("All field must be filled out.");
                    return false;
                }

                if (password.length < 5) {
                    alert("Password needs to be more than 5 characters.");
                    return false;
                }
            }

            function confirmation() {
                alert("Are you sure you want to delete this user? Once deleted the user cannot be recovered")
                return true;
            }

        </script>
    </head>
    <body>

        <form action="../mainmenu.php">
            <input type="submit" value="Back to Main Menu">
        </form>
        <h1>Update User Details</h1>
        <?php
        $username = "";
        $retrievedPassword = "";
        $retrievedStaffPermission = 0;
        $userRetrieved = 0;

        //get current session user
        $session_user = unserialize($_SESSION["session_user"]);

        if (isset($_SESSION["retrieve_user"])) {
            $retrieved = unserialize($_SESSION["retrieve_user"]);
            $username = $retrieved->getUserName();
            $retrievedPassword = $retrieved->getPassword($session_user);
            $retrievedStaffPermission = $retrieved->getIsStaff();
            $userRetrieved = 1;
            unset($_SESSION["retrieve_user"]);
        }
        ?>

        <form name="retrieveUser" action="retrieve_user.php" method="GET">
            Username: <input type="text" name="username" value="<?php echo $username; ?>"/>
            <input type="submit"/> 
        </form><br/><br/>
        
        <h2>Retrieved User</h2>

        <form name="updateUser" action="update_user.php" method="POST" onsubmit="return validateForm()">
            Username: <input type="text" name="user" value="<?php echo $username; ?>" readonly><br/><br/>
            Password: <input type="password" name="password" value="<?php echo $retrievedPassword ?>"><br/><br/>
            Staff: <select name="staff">
                <?php
                //if current Staff permission is 1
                if ($retrievedStaffPermission == 1) {
                    ?>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                    <?php
                } else {
                    ?>
                    <option value="no">No</option>
                    <option value="yes">Yes</option>
                    <?php
                }
                ?>
            </select><br/><br/>

            <?php
            if ($userRetrieved == 1) {
                ?>
                <input type="submit" value="Update User">


            </form><br/>

            <form action="delete_user.php" method="POST" onsubmit="return confirmation()">
                <input type="hidden" name="user" value="<?php echo $username; ?>">
                <input type="submit" value="Delete User">
            </form><br/>
            <?php
        }
        ?>
        <?php
        if (isset($_GET["success"]) && $_GET["success"] == 1) {
            ?>
            <font color="green">Successfully Updated!</font><br/>
            <?php
        } elseif (isset($_GET["success"]) && $_GET["success"] == 0) {
            ?>
            <font color="red">Updated failed!</font><br/>
            <?php
        } elseif(isset($_GET["deleted"]) && $_GET["deleted"] == 1){
        ?>
            <font color="green">Successfully Deleted!</font><br/>
        <?php
        } elseif(isset($_GET["deleted"]) && $_GET["deleted"] == 0){
        ?>
            <font color="red">Delete failed!</font><br/>
        <?php
        } elseif ($userRetrieved == 0 && isset ($_GET["retrieval"]) ){
        ?>
            <font color="red">User do not exist!</font><br/>
        <?php
        }
        ?>


    </body>
</html>
