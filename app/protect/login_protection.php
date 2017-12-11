<?php
//user must be logged in to continue
session_start();

//If invalid credentials
if (!isset($_SESSION["session_user"]) ) {
    header('Location: ../app/login.php?logged=false');
    session_end();
    exit();
}
?>