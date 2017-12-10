<?php

require("User.php");
require '../Connection.php';

/**
 * Description of UserDAO
 * DAO for CRUD operations for User
 * 
 */
class UserDAO {

    public static function createUser($userName, $password, $isStaff) {
        
        //statement
        $db = Connection::getConnection();
        $stmt = $db->prepare("INSERT INTO user VALUES (?,?,?)");
        $stmt->bind_param("ssi", $userName, $password,$isStaff); //prepared statement
        $stmt->execute();
        
        if($stmt->affected_rows > 0){
            return true;
        }
    }

}
