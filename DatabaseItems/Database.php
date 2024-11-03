<?php

class Database {
    private PDO $dbConnection; // Private variable because no other class should directly interact with it.

    function __construct(){
        $this->createConnection();
    }

    /**
     * Is used to return the instance of dbConnection without directly accessing it.
     * @return PDO
     */
    public function get_dbConnection() : PDO {
        return $this->dbConnection;
    }

    private function createConnection() : void {
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
