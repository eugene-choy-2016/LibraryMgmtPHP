<?php
require '../model/UserDAO.php';
session_start(); //Start session

$username = $_POST["user"];
$success = UserDAO::deleteUser($username);

if($success){
    header("Location:update_user_details.php?deleted=1");
}else{
    header("Location:update_user_details.php?deleted=0");
}


session_end();
exit();
?>
