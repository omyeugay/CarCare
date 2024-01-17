<?php
// require_once '../../controller/database.php';
require_once 'persons.php';


class Customers extends Persons {
    // Database connection
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Get all customers
    public function getAll() {
        $sql = "SELECT * FROM customers";
        $result = mysqli_query($this->db->conn, $sql);

        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }

    public function getCustomerById($id) {
        $sql = "SELECT * FROM customers WHERE id = ?";
        $stmt = mysqli_prepare($this->db->conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    public function addCustomer($name, $phone, $email, $password) {
        $phonePattern = '/^\d{10}$/';
        $phone = filter_var($phone, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $phonePattern)));

        if ($phone === false) {
            echo "<script type='text/javascript'>alert('Số điện thoại phải có chính xác 10 chữ số và không bao gồm chữ cái. Vui lòng nhập lại..');</script>";
            return false;
        }

        // Validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Sai định dạnh Email.");
        }

        $sql = "INSERT INTO customers (name, phone, email, password) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($this->db->conn, $sql);
        mysqli_stmt_bind_param($stmt, 'ssss', $name, $phone, $email, $password);
        return mysqli_stmt_execute($stmt);
    }

    public function updateCustomer($id, $name, $phone, $email, $password) {
        $phonePattern = '/^\d{10}$/';
        $phone = filter_var($phone, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $phonePattern)));

        if ($phone === false) {
            echo "<script type='text/javascript'>alert('Số điện thoại phải có chính xác 10 chữ số và không bao gồm chữ cái. Vui lòng nhập lại..');</script>";
            return false;
        }

        // Validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Sai định dạnh Email.");
        }

        $sql = "UPDATE customers SET name = ?, phone = ?, email = ?, password = ? WHERE id = ?";
        $stmt = mysqli_prepare($this->db->conn, $sql);
        mysqli_stmt_bind_param($stmt, 'ssssi', $name, $phone, $email, $password, $id);
        return mysqli_stmt_execute($stmt);
    }

    public function deleteCustomer($id) {
        $sql = "DELETE FROM customers WHERE id = ?";
        $stmt = mysqli_prepare($this->db->conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        return mysqli_stmt_execute($stmt);
    }
}