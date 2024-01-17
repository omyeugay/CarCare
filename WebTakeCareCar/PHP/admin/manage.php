<?php
require_once '../controller/database.php';
require_once '../models/user.php';

$user = new User();
$user->checkLogin();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body{
            margin: 0;
        }

        .nav {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #333;
        }
        .nav li {
            float: left;
        }
        .nav li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }
        .nav li a:hover {
            background-color: #111;
        }
    </style>
</head>
<body>
    <ul class="nav">
        <?php if ($_SESSION['role'] == 'admin'){ ?>
            <li><a href="./manage_employees/manage_employees.php">Quản Lý Nhân Viên</a></li>
        <?php }else{  ?>
            <li style="opacity: 0.2;display: block;color: white;text-align: center;padding: 14px 16px;text-decoration: none; cursor:default;">Quản Lý Nhân Viên</li>
        <?php }; ?>
        <li><a href="./manage_customers/manage_customers.php">Quản Lý Khách Hàng</a></li>
        <li><a href="./manage_cars/manage_cars.php">Quản Lý Xe</a></li>
        <li><a href="./manage_services/manage_services.php">Quản Lý Dịch Vụ</a></li>
        <li><a href="./manage_appointments/manage_appointments.php">Quản Lý Đặt Lịch</a></li>
        <li><a href="./manage_invoices/manage_invoices.php">Quản lý Hóa Đơn</a></li>
    </ul>
</body>
</html>
