<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>

    <head>
        <?php
        session_start();
        if (isset($_SESSION["session_user"])) {
            header('Location: ../app/mainmenu.php');
            session_end();
            exit();
        }
        ?>

        <meta charset="UTF-8">
        <title>Login Page</title>
    </head>
    <body>
        <h1>Library Management System</h1>
        <form action="authenticate.php" method="post" name="login">
            Username <input type="text" name="username"/><br/><br/>
            Password <input type="password" name="password"/><br/><br/>
            <input type="submit"/>
            <br/>
            <br/>

            <?php
            //If invalid credentials
            if (isset($_GET['authenticate'])) {
                ?>
                <font color="red">Invalid username/password !</font>
                <?php
            }

            if (isset($_GET['logged'])) {
                ?>
                <font color="red">Please login to proceed !</font>
                <?php
            }
            ?>

        </form>
    </body>
</html>
