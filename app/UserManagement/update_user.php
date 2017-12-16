<?php
require '../model/UserDAO.php';
session_start();

$userName = $_POST["user"];
$updatedPassword = $_POST["password"];
$staff = $_POST["staff"];

if($staff == "yes"){
    $staff = 1;
}else{
    $staff = 0;
}

$success = UserDAO::updateUser($userName,$updatedPassword, $staff);

if($success){
    header("Location:update_user_details.php?success=1");
}else{
    header("Location:update_user_details.php?success=0");
}

?>

