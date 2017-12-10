<?php

include ("config.php");

class Connection {

    public static function getConnection() {
        $db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
        if ($db->connect_error) {
            echo "Connection issue";
            die("Connection failed: " . $db->connect_error);
        }
        return $db;
    }

}
