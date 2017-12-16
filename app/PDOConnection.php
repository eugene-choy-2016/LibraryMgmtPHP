<?php


/**
 * Connection class using PDO
 *
 * 
 */
class PDOConnection {
    //put your code here
    public static function getConnection(){
        try{
            $handler = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_DATABASE,DB_USERNAME,DB_PASSWORD);
            $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $handler;
            
        } catch (PDOException $e) {
            echo "Database not found";
            die();
        }
        
    }
}

//For PDO fetch OO --> you need to set fetch mode
//$query->setFetchMode(PDO::FETCH_CLASS,'GuessBookEntry');