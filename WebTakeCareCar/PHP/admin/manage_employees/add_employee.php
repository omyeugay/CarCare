<?php
require_once '../../controller/database.php';
require_once '../../models/employees.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];


    $employees = new Employees();
    $result = $employees->addEmployee($name, $phone, $email, $password, $role);

    if ($result) {
        header('Location: manage_employees.php');
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Employee</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group select {
            width: 150px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .form-group input[type="submit"] {
            float: right;
            margin-right: 10px;
            width: 150px;
            background-color: #5cb85c;
            color: white;
            cursor: pointer;
        }
        .form-group input[type="submit"]:hover {
            background-color: #4cae4c;
        }

        .form-group input[type="button"] {
            float: right;
            width: 100px;
            background-color: #5cb85c;
            color: white;
            cursor: pointer;
        }
        .form-group input[type="button"]:hover {
            background-color: #4cae4c;
        }

        h1 {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Thêm Nhân Viên</h1>
    <hr>
    <div class="container">
        <form method="post" action="add_employee.php">
            <div class="form-group">
                <label for="name">Tên Nhân Viên:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="phone">Số Điện Thoại:</label>
                <input type="text" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="email">Mật khẩu:</label>
                <input type="text" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="role">Chức Danh:</label>
                <select id="role" name="role" required>
                    <option value="admin">Admin</option>
                    <option value="employee">Employee</option>
                </select>
            </div>
            <div class="form-group">
                <input type="button" onclick="window.location.href='manage_employees.php'" value="Hủy">
                <input type="submit" value="Thêm Nhân Viên">
            </div>
        </form>
    </div>
</body>
</html>