<?php
class CarTypes {
    private $id;
    private $type;
    private $db;

    public function __construct() {
        $this->db = new Database();

    }

    public function getAll() {
        $sql = "SELECT * from cartypes";
        $result = mysqli_query($this->db->conn, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}
?>