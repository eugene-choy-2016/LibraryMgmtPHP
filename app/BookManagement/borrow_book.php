<?php
require "../model/User.php";
require "../model/BookDAO.php";
include('../protect/login_protection.php');

$source = $_POST["source"]; //which URL directed to here
$book_id = $_POST["bookID"]; //which book i wanna borrow



$session_user = unserialize($_SESSION["session_user"]);
$username = $session_user->getUserName();

$status = BookDAO::borrowBook($username, $book_id);

header("Location:".$source."?borrowStatus=".$status);
exit();
?>