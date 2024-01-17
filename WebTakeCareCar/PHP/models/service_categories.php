<?php
class ServiceCategory {
    private $db;
    public function __construct() {
        $this->db = new Database;
    }

    public function getAll() {
       $sql ="SELECT * FROM servicecategories";
        $result = mysqli_query($this->db->conn, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function getCategoryById($id) {
        $sql = "SELECT * FROM servicecategories WHERE id = ?";
        $stmt = $this->db->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}


?>