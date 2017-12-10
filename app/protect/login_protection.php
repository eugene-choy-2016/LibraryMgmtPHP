<?php
//user must be logged in to continue
require '../model/User.php';
session_start();

//If invalid credentials
if (!isset($_SESSION["session_user"])) {
    header('Location: ../login.php?logged=false');
    session_end();
    exit();
}
?>