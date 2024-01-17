<?php
class Cars {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAll() {
        $sql = "SELECT Cars.id, Customers.name as customer_name, CarTypes.type as car_type, Cars.name, Cars.license_plate 
                FROM Cars 
                INNER JOIN Customers ON Cars.customer_id = Customers.id
                INNER JOIN CarTypes ON Cars.car_type_id = CarTypes.id";
        $result = mysqli_query($this->db->conn, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function getCarById($id) {
        $sql = "SELECT Cars.id, Customers.name as customer_name, CarTypes.type as car_type, Cars.name, Cars.license_plate 
                FROM Cars 
                INNER JOIN Customers ON Cars.customer_id = Customers.id
                INNER JOIN CarTypes ON Cars.car_type_id = CarTypes.id
                WHERE Cars.id = ?";
        $stmt = mysqli_prepare($this->db->conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        return mysqli_fetch_assoc($result);
    }

    public function getCarsByCustomerId($customerId) {
        $sql = "SELECT Cars.id, Customers.name as customer_name, CarTypes.type as car_type, Cars.name, Cars.license_plate 
                FROM Cars 
                INNER JOIN Customers ON Cars.customer_id = Customers.id
                INNER JOIN CarTypes ON Cars.car_type_id = CarTypes.id
                WHERE Cars.customer_id = ?";
        $stmt = mysqli_prepare($this->db->conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $customerId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function getCarTypeIdById($id) {
        $sql = "SELECT Cars.car_type_id
                FROM Cars 
                WHERE Cars.id = ?";
        $stmt = mysqli_prepare($this->db->conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }

    public function getByCustomerId($customerId) {
        $query = "SELECT * FROM Cars WHERE customer_id = ?";
        $stmt = $this->db -> conn->prepare($query);
        $stmt->bind_param('i', $customerId);
        $stmt->execute();
        $result = $stmt->get_result();
        $cars = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $cars;
    }

    public function getLicensePlateByCustomerId($customerId) {
        // Lấy thông tin xe từ bảng cars
        $sql = "SELECT license_plate FROM cars WHERE customer_id = ?";
        $stmt = $this->db->conn->prepare($sql);
        $stmt->bind_param("i", $customerId);
        $stmt->execute();
        $result = $stmt->get_result();
        $cars = $result->fetch_all(MYSQLI_ASSOC);
    
        // Trả về một mảng chứa license_plate của tất cả các xe thuộc sở hữu của khách hàng
        return array_map(function($car) {
            return $car['license_plate'];
        }, $cars);
    }

    public function addCar($customer_id, $car_type_id, $name, $license_plate) {
        $sql = "INSERT INTO Cars (customer_id, car_type_id, name, license_plate) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($this->db->conn, $sql);
        mysqli_stmt_bind_param($stmt, 'iiss', $customer_id, $car_type_id, $name, $license_plate);
        mysqli_stmt_execute($stmt);
    }

    public function updateCar($car_type_id, $name, $license_plate, $id) {
        $sql = "UPDATE Cars SET  car_type_id = ?, name = ?, license_plate = ? WHERE id = ?";
        $stmt = mysqli_prepare($this->db->conn, $sql);
        mysqli_stmt_bind_param($stmt, 'issi', $car_type_id, $name, $license_plate, $id);
        return mysqli_stmt_execute($stmt);
    }

    public function deleteCar($id) {
        $sql = "DELETE FROM Cars WHERE id = ?";
        $stmt = mysqli_prepare($this->db->conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        return mysqli_stmt_execute($stmt);
    }
}
?>