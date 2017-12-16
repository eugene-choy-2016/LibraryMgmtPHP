

<?php
include 'config.php';
//To Store a person object 
require 'model/User.php';
require 'PDOConnection.php';
session_start(); //Start session

$userName = $_POST["username"];
$password = $_POST["password"];


//statement
$db = PDOConnection::getConnection();
$stmt = $db->prepare("SELECT user_name,staff from user where user_name = ? AND password = ?");
$stmt->setFetchMode(PDO::FETCH_CLASS,'User');
$stmt->execute(array($userName,$password));



if ($session_user = $stmt->fetch()) {
    print_r($session_user);
    $_SESSION["session_user"] = serialize($session_user);
    echo "Success";
    header('Location: mainmenu.php');
    die();
} else {
    header('Location: login.php?authenticate=false');
}
?>

