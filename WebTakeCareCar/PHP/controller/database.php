<?php
class Database {
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "quanglycarcare";
    public $conn;

    public function __construct() {
        // Create connection
        $this->conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname);

        // Check connection
        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

    }
}
?>