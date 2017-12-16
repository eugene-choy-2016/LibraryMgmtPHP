<?php

require("Book.php");
require '../Connection.php';
require '../PDOConnection.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BookDAO
 * DAO for CRUD operations for Book
 * 
 */
class BookDAO {

    /**
     * 
     * @param string $searchTerm
     * @return array Array of rows in the DB , -1 if there is any error
     */
    public static function search($searchTerm) {
        //echo "i entered here";
        //statement
        $db = Connection::getConnection();
        //Return books which has ID,name,author,desription or tags that match the searchTerm
        $stmt = $db->prepare("  SELECT book_id,book_name,book_description,
                                book_author,shelf.shelf_name, borrowed FROM book
                                INNER JOIN shelf ON shelf.shelf_id = book.shelf_id
                                WHERE book_id LIKE ?
                                OR book_name LIKE ?
                                OR book_author LIKE ?
                                OR book_description LIKE ?
                                OR tags LIKE ?");

        $searchTermWOperator = "%" . $searchTerm . "%";
        $stmt->bind_param("sssss", $searchTermWOperator, $searchTermWOperator, $searchTermWOperator, $searchTermWOperator, $searchTermWOperator); //prepared statement
        $stmt->execute();

        if ($result = $stmt->get_result()) {

            if ($result->num_rows <= 0) {
                return -1;
            }

            $rows = $result->fetch_all(MYSQLI_ASSOC);
            return $rows;
        }
    }

    /**
     * Return all the Books in the Database
     * @return Array of rows in the DB , -1 if there is any error
     */
    public static function retrieveAll() {
        //statement
        $db = PDOConnection::getConnection();
        //Get all the books along with the Shelf it is located at
        $stmt = $db->prepare("SELECT book_id,book_name,book_description,"
                . "book_author,Shelf.shelf_name, borrowed FROM `book` "
                . "INNER JOIN shelf WHERE shelf.shelf_id = book.shelf_id");
        $stmt->setFetchMode(PDO::FETCH_CLASS,'Book');
        $stmt->execute();
        //if succesful
        if ($result = $stmt->fetchAll()) {
            
            if (sizeof($result) <= 0) {
                return -1;
            }
            
            return $result;
        }
    }

    public static function addBook($book_name, $book_description, $book_author, $tags, $shelf_id) {
        //Check nothing is blank
        if ($book_name == "" || $book_description == "" || book_author == "" || tags == "" || shelf_id == "") {
            return false;
        }

        //statement
        $db = Connection::getConnection();
        $stmt = $db->prepare("INSERT INTO book "
                . "(book_name,book_description,book_author,tags,shelf_id) "
                . "VALUES (?,?,?,?,?)");
        $stmt->bind_param("ssssi", $book_name, $book_description, $book_author, $tags, $shelf_id); //prepared statement
        $stmt->execute();


        if ($stmt->affected_rows > 0) {
            return true;
        }
        return false;
    }

    public static function borrowBook($user_id, $book_id) {
        if (BookDAO::isBorrowed($book_id)) {
            return false;
        }
        //Add borrow record
        //if fail return false
        if (!BookDAO::addBookBorrowRecord($book_id, $user_id)) {
            return false;
        }
        //Change book status to borrowed
        return BookDAO::updateBorrowed($book_id);
        //return success if success
    }

    private static function updateBorrowed($book_id) {
        //statement
        $db = Connection::getConnection();
        $stmt = $db->prepare("UPDATE `book` SET `borrowed` = '1' WHERE `book`.`book_id` = ?;");
        $stmt->bind_param("i", $book_id); //prepared statement
        $stmt->execute();


        if ($stmt->affected_rows > 0) {
            return true;
        }
        return false;
    }

    private static function isBorrowed($book_id) {
        //statement
        $db = Connection::getConnection();
        $stmt = $db->prepare("select borrowed from book where book_id = ?");
        $stmt->bind_param("i", $book_id); //prepared statement
        $stmt->execute();

        if ($result = $stmt->get_result()) {

            if ($result->num_rows <= 0) {
                return -1;
            }

            $row = $result->fetch_assoc();
            if ($row["borrowed"]) {
                return true;
            }
            return false;
        }
    }

    private static function addBookBorrowRecord($book_id, $user_id) {
        //Check nothing is blank
        if ($book_id == "" || $user_id == "") {
            return false;
        }

        //get Timestamp
        date_default_timezone_set('Asia/Singapore');
        $date = date_create();
        $time_stamp = date_format($date, 'Y-m-d H:i:s') . "\n";

        //statement
        $db = Connection::getConnection();
        $stmt = $db->prepare("INSERT INTO borrowed_book "
                . "(borrowed_date,book_id,user_name) "
                . "VALUES (?,?,?)");
        $stmt->bind_param("sis", $time_stamp, $book_id, $user_id); //prepared statement
        $stmt->execute();


        if ($stmt->affected_rows > 0) {
            return true;
        }
        return false;
    }

}
