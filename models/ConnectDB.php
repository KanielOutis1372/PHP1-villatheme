<?php
    class ConnectDB {
        public static function getConnection() {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "db_huy2";
        
            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
        
            // Check connection
            if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            return false;
            }
            else  {
                return $conn;
            }
        }
    }

    // if (ConnectDB::getConnection()) {
    //     echo "Connected successfully";
    // }
    // else {
    //     echo "Connection failed";
    // }
?>