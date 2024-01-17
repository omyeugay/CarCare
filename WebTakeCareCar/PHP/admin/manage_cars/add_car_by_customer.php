<?php
session_start();
require_once '../../controller/database.php';
require_once '../../models/cars.php';
require_once '../../models/customers.php';
require_once '../../models/car_types.php';

$customers = new Customers();
$allCustomers = $customers->getAll();

$customer = $customers->getCustomerById($_SESSION['idUser']);

$carTypes = new CarTypes();
$allCarTypes = $carTypes->getAll();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_id = $_POST['customer_id'];
    $car_type_id = $_POST['car_type_id'];
    $name = $_POST['name'];
    $license_plate = $_POST['license_plate'];

    $cars = new Cars();
    $cars->addCar($customer_id, $car_type_id, $name, $license_plate);

    header("Location: ../../infoCars.php");
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Car</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0 0 20px 0;
            background-color: #f0f0f0;
        }
        .container {
            width: 80%;
            margin: 40px auto;
            /* padding: 20px; */
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
    <h1>Thêm thông tin xe</h1>
    <hr>
    <div class="container">
        <form action="add_car.php" method="post">
            <input type="hidden" name="customer_id" value="<?php echo $customer['id']?>">
            <div class="form-group">
                <label for="customer_id">Tên khách hàng:</label>
                <input type="text" id= "customer_id" name="customer_name" value="<?php echo $customer['name']?>" disabled>
            </div>

            <div class="form-group">
                <label for="phone">Số điện thoại:</label>
                <input type="text" id="phone" name="phone" value="<?php echo $customer['phone'] ?>" disabled>
            </div>

            <div class="form-group">
                <label for="car_type_id">Loại xe:</label>
                <select id="car_type_id" name="car_type_id" required>
                    <?php foreach ($allCarTypes as $cartype): ?>
                        <option value="<?= $cartype['id'] ?>"><?= $cartype['type'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="name">Nhãn hiệu:</label>
                <input type="text" id="name" name="name">
            </div>
            <div class="form-group">
                <label for="license_plate">Biển số:</label>
                <input type="text" id="license_plate" name="license_plate" >
            </div>
            
            <div class="form-group">
                <input type="button" value="Hủy" onclick="window.location.href='manage_cars.php'">
                <input type="submit" value="Thêm">
            </div>
        </form>
    </div>

</body>
    
</html>