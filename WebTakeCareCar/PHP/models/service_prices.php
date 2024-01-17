<?php
class servicePrices {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAll() {
        $sql = "SELECT * FROM serviceprices";
        $stmt = $this->db->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $servicePrices = $result->fetch_all(MYSQLI_ASSOC);
        return $servicePrices;
    }

    public function addServicePrice($service_id, $car_type_id, $price) {
        $sql = "INSERT INTO serviceprices (service_id, car_type_id, price) VALUES (?, ?, ?)";
        $stmt = $this->db->conn->prepare($sql);
        $stmt->bind_param("iii", $service_id, $car_type_id, $price);
        $stmt->execute();
    }

    public function updateServicePrice($service_id, $car_type_id, $price) {
        $sql = "UPDATE serviceprices SET price = ?, car_type_id = ? WHERE service_id = ? ";
        $stmt = $this->db->conn->prepare($sql);
        $stmt->bind_param("iii", $price, $car_type_id, $service_id );
        $stmt->execute();
    }
}

?>