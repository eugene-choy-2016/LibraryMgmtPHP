<?php

require '../model/UserDAO.php';
session_start(); //Start session

$session_user = unserialize($_SESSION["session_user"]);
$username = $_GET["username"];

$retrievedUser = UserDAO::retrieveUser($username, $session_user);
$_SESSION["retrieve_user"] = serialize($retrievedUser);

header("location:update_user_details.php");
exit();

?>
