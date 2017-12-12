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
        $stmt->bind_param("ssi", $userName, $password, $isStaff); //prepared statement
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            return true;
        }
    }

    public static function retrieveUser($userName, User $sessionUser) {
        //If staff User, then retrievUser
        if ($sessionUser->getIsStaff() == 1) {
            //statement
            $db = Connection::getConnection();
            $stmt = $db->prepare("SELECT password,staff FROM user where user_name =?");
            $stmt->bind_param("s", $userName); //prepared statement
            $stmt->execute();
            
            //if succesful
            if($result = $stmt->get_result()){
                $rows = $result->fetch_assoc();
                
                if($result->num_rows <= 0){
                    return -1;
                }
                
                $retrievedPassword = $rows["password"];
                $staffPermission = $rows["staff"];
                $retrievedUser = new User($userName,$staffPermission);
                $retrievedUser->setPassword($retrievedPassword, $sessionUser);
                return $retrievedUser;
            }
            return -1;
            
        }
        return -1;
    }
    
    public static function updateUser($userName,$password,$staff){
        //statement
        $db = Connection::getConnection();
        $stmt = $db->prepare("UPDATE `user` SET `password` = ? , `staff` = ? WHERE `user`.`user_name` = ?");
        $stmt->bind_param("sis",$password,$staff,$userName); //prepared statement
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            return true;
        }
        return false;
    }

    public static function deleteUser($userName) {
        //statement
        $db = Connection::getConnection();
        $stmt = $db->prepare("DELETE FROM user where user_name =?");
        $stmt->bind_param("s", $userName); //prepared statement
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            return true;
        }
        return false;
    }

}
