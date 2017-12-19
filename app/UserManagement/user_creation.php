<?php
require '../model/UserDAO.php';
include('../protect/staff_protection.php');
session_start(); //Start session

$username = $_POST["username"];
$password = $_POST["password"];
$isStaff = $_POST["selectStaff"];
$permission = 0;

if($isStaff == "yes"){
    $permission = 1;
}

$success = UserDAO::createUser($username,$password,$permission);

if($success){
    header("Location:add_user.php?success=1");
}else{
    header("Location:add_user.php?success=0");
}
session_end();
exit();

?>

