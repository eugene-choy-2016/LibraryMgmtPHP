<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
    require 'model/User.php';
    session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            
            $user = unserialize($_SESSION["session_user"]);
            echo "Username is ".$user->getUserName();
        ?>
    </body>
</html>
