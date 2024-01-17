<?php
    require_once '../../controller/database.php';
    require_once '../../models/appointments.php';
    require_once '../../models/user.php';
    session_start();

    $user = new User();
    $user->checkLogin();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Quản Lý Đặt Lịch</title>
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
        h2 {
            text-align: center;
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
        /* Set the width of each column */
        th:nth-child(1), td:nth-child(1) { width: 3%; }
        th:nth-child(2), td:nth-child(2) { width: 10%; }
        th:nth-child(3), td:nth-child(3) { width: 10%; }
        th:nth-child(4), td:nth-child(4) { width: 7%; }
        th:nth-child(5), td:nth-child(5) { width: 5%; }
        th:nth-child(6), td:nth-child(6) { width: 10%; }
        th:nth-child(7), td:nth-child(7) { width: 13%; }
        th:nth-child(8), td:nth-child(8) { width: 13%; }
        th:nth-child(9), td:nth-child(9) { width: 7%; }
        th:nth-child(10), td:nth-child(10) { width: 7%; }
        th:nth-child(11), td:nth-child(11) { width: 10%; }
        th:nth-child(12), td:nth-child(12) { width: 15%; }

        h1 {
            text-align: center;
        }
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

    <h1>Quản Lý Đặt Lịch</h1>
    <hr>
    <table>
        <tr>
            <th>ID</th>
            <th>Tên Khách Hàng</th>
            <th>Số điện thoại</th>
            <th>Tên Xe</th>
            <th>Loại Xe</th>
            <th>Biển Số</th>
            <th>Loại Dịch Vụ</th>
            <th>Dịch Vụ</th>
            <th>Ngày Hẹn</th>
            <th>Giờ Hẹn</th>
            <th>Trạng Thái</th>
            <th><a href="add_appointment.php" class="btn">Đặt Lịch</a></th>
        </tr>
        <?php
        // Create a new instance of Appointments
        $appointments = new Appointments();

        // Get all appointments
        $allAppointments = $appointments->getAll();

        // Loop through the appointments and display them in the table
        foreach ($allAppointments as $appointment) {
            echo "<tr>";
            echo "<td>" . $appointment['id'] . "</td>";
            echo "<td>" . $appointment['customer_name'] . "</td>";
            echo "<td>" . $appointment['customer_phone'] . "</td>";
            echo "<td>" . $appointment['car_name'] . "</td>";
            echo "<td>" . $appointment['car_type'] . "</td>";
            echo "<td>" . $appointment['car_license_plate'] . "</td>";
            echo "<td>" . $appointment['category_names'] . "</td>";
            echo "<td>" . $appointment['service_names'] . "</td>";
            echo "<td>" . $appointment['appointment_date'] . "</td>";
            echo "<td>" . $appointment['appointment_time'] . "</td>";
            echo "<td>" . $appointment['status'] . "</td>";
            echo "<td>";
                echo "<a href='edit_appointment.php?id=" . $appointment['id'] . "' class='btn'>Cập nhật</a> | ";
                echo "<a href='delete_appointment.php?id=" . $appointment['id'] . "' class='btn'>Xóa</a>";
                echo "<a href='../manage_invoices/manage_invoices.php?id=" . $appointment['id'] . "' class='btn' style= 'margin-top: 10px; width: 70%;'>Xem Hóa Đơn</a>";
            echo "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>