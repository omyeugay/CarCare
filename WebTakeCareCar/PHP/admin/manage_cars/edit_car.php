<?php
require_once '../../controller/database.php';
require_once '../../models/cars.php';
require_once '../../models/customers.php';
require_once '../../models/car_types.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (!isset($_GET['id'])) {
        die('No car ID provided');
    }
    $id = $_GET['id'];

    $cars = new cars();
    $car = $cars->getCarById($id);

    $carTypes = new CarTypes();
    $allCarTypes = $carTypes->getAll();

    if (!$car) {
        die('car not found!');
    }
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $car_type_id = $_POST['car_type_id'];
    $name = $_POST['name'];
    $license_plate = $_POST['license_plate'];

    $cars = new cars();
    $cars->updateCar( $car_type_id, $name, $license_plate, $id);

    header('Location: manage_cars.php');
}

?>

<!-- The HTML and JavaScript code is the same as in add_car.php, but the form fields are populated with the existing car details. -->

<!DOCTYPE html>
<html>
<head>
    <title>Edit Car</title>
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
    <h1>Câp Nhật Thông Tin Xe</h1>
    <hr>
    <div class="container">
        <form action="edit_car.php?" method="post">
            <input type="hidden" id = "id" name="id" value="<?php echo $car['id']; ?>">
            <div class="form-group">
                <label for="car_type">Loại xe:</label>
                <select id="car_type_id" name="car_type_id" required>
                    <?php foreach ($allCarTypes as $cartype): ?>
                        <option value="<?= $cartype['id'] ?>" <?php echo $car['car_type'] == $cartype['type'] ? 'selected' : ''; ?>><?= $cartype['type'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="name">Nhãn hiệu:</label>
                <input type="text" id="name" name="name" value="<?= $car['name'] ?>">
            </div>

            <div class="form-group">
                <label for="license_plate">Biển số:</label>
                <input type="text" id="license_plate" name="license_plate" value="<?= $car['license_plate'] ?>">
            </div>
            
            <div class="form-group">
                <input type="button" value="Hủy" onclick="window.location.href='manage_cars.php'">
                <input type="submit" value="Cập nhật">
            </div>
        </form>
    </div>

    <!-- The JavaScript code is the same as in add_car.php -->
</body>
</html>