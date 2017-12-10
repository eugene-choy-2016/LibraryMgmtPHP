<?php

require '../model/UserDAO.php';
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
    echo "User created!";
}

?>

