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
        session_start();
        ?>
    </head>
    <body>
        <h1>Update User Details</h1>
        <?php
        $username = "";
        $retrievedPassword = "";
        $retrievedStaffPermission = 0;
        
        //get current session user
        $session_user = unserialize($_SESSION["session_user"]);

        if (isset($_SESSION["retrieve_user"])) {
            $retrieved = unserialize($_SESSION["retrieve_user"]);
            $username = $retrieved->getUserName();
            $retrievedPassword = $retrieved->getPassword($session_user);
            $retrievedStaffPermission = $retrieved->getIsStaff();
            unset($_SESSION["retrieve_user"]);
        }
        ?>

        <form name="retrieveUser" action="retrieve_user.php" method="GET">
            Username: <input type="text" name="username" value="<?php echo $username; ?>"/>
            <input type="submit"/> 
        </form><br/><br/>
        <h2>Retrieved User</h2><br/>
        <form name="updateUser" action="update_user.php" method="POST">
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
            <input type="submit" value="Update User">
        </form><br/>
        
        <form action="delete_user.php" method="POST" float=>
            <input type="hidden" name="user" value="<?php echo $username; ?>">
            <input type="submit" value="Delete User">
        </form>

    </body>
</html>
