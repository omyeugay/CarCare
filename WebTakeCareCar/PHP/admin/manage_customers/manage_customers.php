<?php
    require_once '../../controller/database.php';
    require_once '../../models/customers.php';
    require_once '../../models/user.php';
    session_start();

    $user = new User();
    $user->checkLogin();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Customers</title>
    <style>
        body {
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
        table {
            width: 100%;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 15px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            outline: none;
            color: #fff;
            background-color: #4CAF50;
            border: none;
            border-radius: 15px;
        }

        .btn:hover {background-color: #3e8e41}

        .btn:active {
            background-color: #3e8e41;
            box-shadow: 0 5px #666;
            transform: translateY(4px);
        }
        h1 {
            text-align: center;
        }

        .container {
            width: 80%;
            margin: 0 auto;
        }

        table {
        width: 100%;
        margin-top: 20px;
        table-layout: fixed; /* This makes the table respect the widths set below */
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            overflow: hidden;  /* This will make text that is too long be hidden */
            text-overflow: ellipsis;  /* This will add ... to the end of text that is too long */
        }

        th:nth-child(1), td:nth-child(1) { width: 15%; }
        th:nth-child(2), td:nth-child(2) { width: 15%; }
        th:nth-child(3), td:nth-child(3) { width: 15%; }
        th:nth-child(4), td:nth-child(4) { width: 15%; }
        th:nth-child(5), td:nth-child(5) { width: 15%; }
        th:nth-child(6), td:nth-child(6) { width: 20%; }
    </style>
</head>
<body>
    <ul class="nav">
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){ ?>
            <li><a href="../manage_employees/manage_employees.php">Quản Lý Nhân Viên</a></li>
        <?php }else{  ?>
            <li style="opacity: 0.2;display: block;color: white;text-align: center;padding: 14px 16px;text-decoration: none; cursor:default;">Quản Lý Nhân Viên</li>
        <?php }; ?>
        <li><a href="../manage_customers/manage_customers.php">Quản Lý Khách Hàng</a></li>
        <li><a href="../manage_cars/manage_cars.php">Quản Lý Xe</a></li>
        <li><a href="../manage_services/manage_services.php">Quản Lý Dịch Vụ</a></li>
        <li><a href="../manage_appointments/manage_appointments.php">Quản Lý Đặt Lịch</a></li>
    </ul>

    <h1>Quản Lý Khách Hàng</h1>
    <hr>
    <div class="container">

        <table>
            <tr>
                <th>ID</th>
                <th>Tên Khách Hàng</th>
                <th>Số điện thoại</th>
                <th>Email</th>
                <th>Mật khẩu</th>
                <th><a href="add_customer.php" class="btn">Thêm khách hàng mới</a> </th>
            </tr>
            <?php
            // Create a new instance of Customers
            $customers = new Customers();
    
            // Get all customers
            $allCustomers = $customers->getAll();
    
            // Loop through the customers and display them in the table
            foreach ($allCustomers as $customer) {
                echo "<tr>";
                echo "<td>" . $customer['id'] . "</td>";
                echo "<td>" . $customer['name'] . "</td>";
                echo "<td>" . $customer['phone'] . "</td>";
                echo "<td>" . $customer['email'] . "</td>";
                echo "<td>" . $customer['password'] . "</td>";
                echo "<td>";
                echo "<a href='edit_customer.php?id=" . $customer['id'] . "' class='btn'>Cập nhật</a> | ";
                echo "<a href='delete_customer.php?id=" . $customer['id'] . "' class='btn'>Xóa</a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>