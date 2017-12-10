

<?php

//To Store a person object 
require 'model/User.php';
require 'Connection.php';
session_start(); //Start session

$userName = $_POST["username"];
$password = $_POST["password"];


//statement
$db = Connection::getConnection();
$stmt = $db->prepare("SELECT user_name,staff from user where user_name = ? AND password = ?");
$stmt->bind_param("ss", $userName, $password); //prepared statement
$stmt->execute();

$stmt->bind_result($userName, $staff);

if ($stmt->fetch()) {
    $session_user = new User($userName, $staff);
    $_SESSION["session_user"] = serialize($session_user);
    header('Location: mainmenu.php');
    die();
} else {
    header('Location: login.php?authenticate=false');
}
?>

