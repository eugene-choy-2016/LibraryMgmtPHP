<?php
require '../Connection.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ShelfDAO
 *
 * 
 */
class ShelfDAO {
        /**
     * Return all the Shelf in the Database
     * @return Array of rows in the DB , -1 if there is any error
     */
    public static function retrieveAll() {
        //statement
        $db = Connection::getConnection();
        //Get all the books along with the Shelf it is located at
        $stmt = $db->prepare("SELECT shelf_id , shelf_name FROM `shelf`");
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
