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
        <h1>Add New User</h1>
        <form name="userCreation" action="user_creation.php" method="post" onsubmit="return validateForm()">
            Username <input type="text" name="username"/><br/><br/>
            Password <input type="password" name="password"/><br/><br/>
            Staff Account <select name="selectStaff">
                <option value="no">No</option>
                <option value="yes">Yes</option>
            </select><br/><br/>
            <input type="submit"/>
        </form>
    </body>
</html>
