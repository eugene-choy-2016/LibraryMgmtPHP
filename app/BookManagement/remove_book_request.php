<?php
require "../model/User.php";
require "../model/BookDAO.php";
include('../protect/staff_protection.php');

$session_user = $_SESSION["session_user"];
$book_id = $_POST["book_id"];

//Ensure user is staff
//Although this page itself can only be accessed by staff
$status = BookDAO::deleteBook($book_id, $session_user);
header("Location:remove_book.php?delete=".$status);
exit();
?>
