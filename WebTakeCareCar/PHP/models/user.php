<?php
// require_once '../controller/database.php';
class User {
    private $db;

    public function __construct() {
        $this->db = new Database;
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    
    public function login($email, $password) {
        // Assume $this->db is your database connection
        $stmt = $this->db->conn->prepare("SELECT * FROM employees WHERE email = ? AND password = ?");
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];
            return true;
        } else {
            return false;
        }
    }

    public function logInUser($emailUser, $passwordUser) {
        $stmt = $this->db->conn->prepare("SELECT * FROM customers WHERE email = ? AND password = ?");
        $stmt->bind_param("ss", $emailUser, $passwordUser);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $customer = $result->fetch_assoc();
            $_SESSION['emailUser'] = $customer['email'];
            $_SESSION['idUser'] = $customer['id'];
            return true;
        } else {
            return false;
        }
    }

    public function checkLogin() {
        if (!isset($_SESSION['email'])) {
            header("Location: ../login.php");
            exit();
        }
    }

    public function checkRole() {
        if ($_SESSION['role'] !== 'admin') {
            header("Location: login.php");
            exit(); 
        }
    }
}
?>