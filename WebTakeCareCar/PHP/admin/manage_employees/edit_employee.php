<?php
require_once '../../controller/database.php';
require_once '../../models/employees.php';

// $id = null;

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (!isset($_GET['id'])) {
        die('No employee ID provided');
    }
    $id = $_GET['id'];

    $employees = new Employees();
    $employee = $employees->getEmployeeById($id);

    if (!$employee) {
        die('Employee not found!');
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $employees = new Employees();
    $employees->updateEmployee($id, $name, $phone, $email, $password, $role);

    header('Location: manage_employees.php');
}



?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Employee</title>
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
            width: 100px;
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
    <h1>Cập nhật thông tin nhân viên</h1>
    <hr>
    <div class="container">
        <form action="edit_employee.php" method="post">
            <input type="hidden" name="id" value="<?php echo $employee['id']; ?>">
            <div class="form-group">
                <label for="name">Tên:</label>
                <input type="text" id="name" name="name" value="<?php echo $employee['name']; ?>">
            </div>
            <div class="form-group">
                <label for="phone">Số điện thoại:</label>
                <input type="text" id="phone" name="phone" value="<?php echo $employee['phone']; ?>">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" value="<?php echo $employee['email']; ?>">
            </div>
            <div class="form-group">
                <label for="password">Mật khẩu:</label>
                <input type="text" id="password" name="password" value="<?php echo $employee['password']; ?>">
            </div>
            <div class="form-group">
                <label for="role">Chức danh:</label>
                <select id="role" name="role">
                    <option value="admin" <?php echo $employee['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
                    <option value="employee" <?php echo $employee['role'] == 'employee' ? 'selected' : ''; ?>>Employee</option>
                </select>
            </div>
            <div class="form-group">
                <input type="button" value="Hủy" onclick="window.location.href='manage_employees.php'">
                <input type="submit" value="Cập nhật">
            </div>
        </form>
    </div>
</body>
</html>