<?php

require("Book.php");
require '../Connection.php';
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

    public static function retrieveAll() {
        //statement
        $db = Connection::getConnection();
        //Get all the books along with the Shelf it is located at
        $stmt = $db->prepare("SELECT book_id,book_name,book_description,"
                . "book_author,Shelf.shelf_name, borrowed FROM `book` "
                . "INNER JOIN shelf WHERE shelf.shelf_id = book.shelf_id");
        $stmt->execute();
        //if succesful
        if ($result = $stmt->get_result()) {

            if ($result->num_rows <= 0) {
                return -1;
            }
            
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            return $rows;

        }
    }

}
