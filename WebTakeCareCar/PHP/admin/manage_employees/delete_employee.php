<?php
require_once '../../controller/database.php';
require_once '../../models/employees.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'];

    $employees = new Employees();
    $employees->deleteEmployee($id);

    header('Location: manage_employees.php');
}
?>