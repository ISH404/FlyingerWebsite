<?php

class Database {
    // Private variables because no other class should directly call them.
    private $dbConnection;

    function __construct(){
        $this->createConnection();
    }

    /**
     * Is used to return the instance of dbConnection without directly accessing it.
     * @return mixed
     */
    public function get_dbConnection(){
        return $this->dbConnection;
    }

    private function createConnection(){
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "profileapp";

        //Try creating a connection with the database
        try {
            $this->dbConnection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $this->dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $dbConnection = null;
            echo "DatabaseItems error: " . $e->getMessage();
        }
    }
}
