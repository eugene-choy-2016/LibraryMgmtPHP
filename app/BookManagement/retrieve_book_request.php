<?php
require "../model/User.php";
require "../model/BookDAO.php";
include('../protect/staff_protection.php');

//get book_id
$book_id = $_GET['book_id'];
//get book object
$book = BookDAO::retrieveBook($book_id);

if($book){
    $_SESSION['retrieved_book'] = serialize($book);
}else{
    $_SESSION['retrieved_book'] = false;
}
header("Location:remove_book.php");
exit();
?>
