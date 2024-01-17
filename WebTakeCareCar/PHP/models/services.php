<?php
require_once 'service_prices.php';
class Services {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAll() {
        $sql = "SELECT Services.id, ServiceCategories.name as category_name, Services.name, CarTypes.type as car_type, Services.description, ServicePrices.price as price
                FROM Services
                INNER JOIN ServiceCategories ON Services.category_id = ServiceCategories.id
                INNER JOIN ServicePrices ON Services.id = ServicePrices.service_id
                INNER JOIN CarTypes ON ServicePrices.car_type_id = CarTypes.id";
        $result = mysqli_query($this->db->conn, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function getAllBase() {
        $sql = "SELECT * FROM Services";
        $result = mysqli_query($this->db->conn, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function getServiceById($id) {
        $sql = "SELECT Services.id, ServiceCategories.name as category_name, Services.name, CarTypes.type as car_type, Services.description, ServicePrices.price as price
                FROM Services
                INNER JOIN ServiceCategories ON Services.category_id = ServiceCategories.id
                INNER JOIN ServicePrices ON Services.id = ServicePrices.service_id
                INNER JOIN CarTypes ON ServicePrices.car_type_id = CarTypes.id
                where services.id = ?";
        $stmt = $this->db->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getServiceByIdBase($id) {
        $sql = "SELECT *
                FROM Services
                where services.id = ?";
        $stmt = $this->db->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getByCategoryId($categoryId) {
        $query = "SELECT * FROM services WHERE category_id = ?";
        $stmt = $this->db ->conn->prepare($query);
        $stmt->bind_param("i", $categoryId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function addService($category_id, $name,  $description, $car_type_id, $price) {
        $sql = "INSERT INTO Services (category_id, name,  description) VALUES ( ?, ?, ?)";
        $stmt = $this->db->conn->prepare($sql);
        $stmt->bind_param("iss", $category_id, $name, $description);
        $stmt->execute();
        // $select = "SELECT MAX(id) AS max_id FROM Services;";
        // $servicePrice = new ServicePrices();
        // $servicePrice->addServicePrice($select, $car_type_id, $price);
        $result = $this->db->conn->query("SELECT MAX(id) AS max_id FROM Services");
        $row = $result->fetch_assoc();
        $max_id = $row['max_id'];

        $servicePrice = new ServicePrices();
        $servicePrice->addServicePrice($max_id, $car_type_id, $price);
    }

    public function updateService($id, $category_id, $name, $description, $car_type_id, $price) {
        $sql = "UPDATE Services SET category_id = ?, name = ?, description = ? WHERE id = ?";
        $stmt = $this->db->conn->prepare($sql);
        $stmt->bind_param("issi", $category_id, $name, $description, $id);
        $stmt->execute();
        $servicePrice = new ServicePrices();
        $servicePrice->updateServicePrice($id, $car_type_id, $price);
        
    }

    public function deleteService($id) {
        $sql = "DELETE FROM Services WHERE id = ?";
        $stmt = $this->db->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

}
?>