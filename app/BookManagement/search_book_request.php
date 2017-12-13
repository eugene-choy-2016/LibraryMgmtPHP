<?php

require '../model/BookDAO.php';
include('../protect/login_protection.php');
session_start(); //Start session

$searchValue = $_GET["searchValue"];
//echo $searchValue;
$rows = BookDAO::search($searchValue);


$_SESSION["searchResults"] = serialize($rows);

header("Location:search_book.php?searchValue=" . $searchValue);
?>

