<?php
    session_start();
    require_once './controller/database.php';
    require_once './models/cars.php';

    $cars = new Cars();
    $allCars = $cars->getCarsByCustomerId($_SESSION['idUser']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            margin: 0;
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
        th:nth-child(6), td:nth-child(6) { width: 15%; }

        .back {
            position: absolute;
            width: 80px;
            height: 44px;
            line-height: 44px;
            text-align: center;
            font-size: 20px;
            background-color: #3e8e41;
            color: #fff;
            border-radius: 15px;
            left: 20px;
        }

        .back-link {
            color: #fff;
            text-decoration: none;
            display: block;
        }
    </style>
</head>
<body>
    <div class="back"><a class="back-link" href="main.php">Trở lại</a></div>
    <h1>Quản Lý Xe</h1>
    <hr>
    <div class="container">

        <table>
            <tr>
                <th>STT</th>
                <th>Nhãn hiệu</th>
                <th>Loại xe</th>
                <th>Biển số</th>
                <th><a href="./admin/manage_cars/add_car_by_customer.php" class="btn">Thêm xe mới</a> </th>
            </tr>
            <!-- You will need to loop through your cars data here -->
            <?php
            $count = 1;
            foreach ($allCars as $car) {
                echo "<tr>";
                echo "<td>" . $count . "</td>";
                echo "<td>" . $car['name'] . "</td>";
                echo "<td>" . $car['car_type'] . "</td>";
                echo "<td>" . $car['license_plate'] . "</td>";
                echo "<td>";
                echo "<a href='./admin/manage_cars/edit_car_by_customer.php?id=" . $car['id'] . "' class='btn'>Cập nhật</a> | ";
                echo "<a href='./admin/manage_cars/delete_car_by_customer.php?id=" . $car['id'] . "' class='btn'>Xóa</a>";
                echo "</td>";
                echo "</tr>";
                $count++;
            }
            ?>
        </table>
    </div>
</body>
</html>