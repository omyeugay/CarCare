<?php
require_once '../../controller/database.php';
require_once 'persons.php';

class Employees extends Persons {
    private $db;
    private $role;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAll() {
        $sql = "SELECT * FROM employees";
        $result = mysqli_query($this->db->conn, $sql);

        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }

    public function getEmployeeById($id) {
        $sql = "SELECT * FROM employees WHERE id = ?";
        $stmt = mysqli_prepare($this->db->conn, $sql);

        if ($stmt === false) {
            die('Error preparing statement: ' . mysqli_error($this->db->conn));
        }

        $bindResult = mysqli_stmt_bind_param($stmt, 'i', $id);

        if ($bindResult === false) {
            die('Error binding parameters: ' . mysqli_error($this->db->conn));
        }

        $executeResult = mysqli_stmt_execute($stmt);

        if ($executeResult === false) {
            die('Error executing statement: ' . mysqli_error($this->db->conn));
        }

        $result = mysqli_stmt_get_result($stmt);

        return mysqli_fetch_assoc($result);
    }

    public function addEmployee($name, $phone, $email, $password, $role) {
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

        // Validate role
        if ($role !== 'admin' && $role !== 'employee') {
            throw new Exception("Sai định dạng chức danh.");
        }

        $sql = "INSERT INTO employees (name, phone, email, password, role) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($this->db->conn, $sql);
        mysqli_stmt_bind_param($stmt, 'sssss', $name, $phone, $email, $password, $role);
        return mysqli_stmt_execute($stmt);
    }

    public function deleteEmployee($id) {
        $sql = "DELETE FROM employees WHERE id = $id";
        $result = mysqli_query($this->db->conn, $sql);

        if ($result === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . mysqli_error($this->db->conn);
        }
    }

    public function updateEmployee($id, $name, $phone, $email, $password, $role) {
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

        // Validate role
        if ($role !== 'admin' && $role !== 'employee') {
            throw new Exception("Sai định dạng chức danh.");
        }

        $sql = "UPDATE employees SET name = ?, phone = ?, email = ?, password = ?, role = ? WHERE id = ?";
        $stmt = mysqli_prepare($this->db->conn, $sql);
        mysqli_stmt_bind_param($stmt, 'sssssi', $name, $phone, $email, $password, $role, $id);
        $result = mysqli_stmt_execute($stmt);

        if ($result === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . mysqli_error($this->db->conn);
        }
    }
}
?>