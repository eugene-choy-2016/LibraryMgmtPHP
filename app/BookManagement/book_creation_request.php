<?php
require "../model/User.php";
require "../model/BookDAO.php";
include('../protect/staff_protection.php');
//Ensure this operation only can be accessed by staff

//Get the parameters
$book_name = $_POST["book_name"];
$book_description = $_POST["book_description"];
$book_author = $_POST["author"];
$tags = $_POST["tags"];
$shelf_id = $_POST["selectShelf"];

$status = BookDAO::addBook($book_name, $book_description, $book_author, $tags, $shelf_id);

header("Location:add_book.php?status=".$status);
exit();

?>

