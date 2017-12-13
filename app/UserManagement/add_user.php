<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Add New User</title>
        <?php
        require "../model/User.php";
        include('../protect/staff_protection.php');
        ?>
        <script>
            function validateForm(){
                var username = document.forms["userCreation"]["username"].value;
                var password = document.forms["userCreation"]["password"].value;
                
                if(username == "" || password== ""){
                    alert("All field must be filled out.");
                    return false;
                }
                
                if(password.length < 5){
                    alert("Password needs to be more than 5 characters.");
                    return false;
                }
            }
        </script>
    </head>
    <body>
        <form action="../mainmenu.php">
            <input type="submit" value="Back to Main Menu">
        </form>
        <h1>Add New User</h1>
        <form name="userCreation" action="user_creation.php" method="post" onsubmit="return validateForm()">
            Username <input type="text" name="username"/><br/><br/>
            Password <input type="password" name="password"/><br/><br/>
            Staff Account <select name="selectStaff">
                <option value="no">No</option>
                <option value="yes">Yes</option>
            </select><br/><br/>
            <input type="submit"/>
        </form><br/>
        
        <?php
            if(isset($_GET["success"]) && $_GET["success"] == 1){
        ?>
        <font color="green">User successfully created!</font>
        <?php
            }else if(isset($_GET["success"]) && $_GET["success"] == 0){
        ?>
        <font color="red">User failed to be created!</font>
        <?php
            }
        ?>
    </body>
</html>
