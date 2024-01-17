<?php
require_once '../../controller/database.php';
require_once '../../models/services.php';
require_once '../../models/car_types.php';
require_once '../../models/service_categories.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (!isset($_GET['id'])) {
        die('No car ID provided');
    }
    $id = $_GET['id'];
    
    $services = new Services();
    $service = $services->getServiceById($id);

    $serviceCategories = new ServiceCategory();
    $allServiceCategories = $serviceCategories->getAll();

    $carTypes = new CarTypes();
    $allCarTypes = $carTypes->getAll();

}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $services = new Services();
    $services->updateService($_POST['id'], $_POST['category_id'], $_POST['name'], $_POST['description'], $_POST['car_type_id'], $_POST['price']);
    header("Location: manage_services.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Service</title>
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
    </style>
</head>
<body>
<div class="container">
    <h2>Cập Nhật Thông Tin Dịch Vụ</h2>
    <form action="edit_service.php" method="post">
        <input type="hidden" name="id" value="<?= $service['id'] ?>">
        <div class="form-group">
            <label for="category_id">Loại Dịch Vụ:</label>
            <select id="category_id" name="category_id" required>
                <?php foreach ($allServiceCategories as $serviceCategory): ?>
                    <option value="<?= $serviceCategory['id'] ?>" <?= $service['category_name'] == $serviceCategory['name'] ? 'selected' : '' ?>><?= $serviceCategory['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="name">Tên Dịch Vụ:</label>
            <input type="text" id="name" name="name" required value="<?= $service['name'] ?>">
        </div>

        <div class="form-group">
            <label for="car_type">Loại Xe:</label>
            <select id="car_type_id" name="car_type_id" required>
                <?php foreach ($allCarTypes as $carType): ?>
                    <option value="<?= $carType['id'] ?>" <?= $service['car_type'] == $carType['type'] ? 'selected' : '' ?>><?= $carType['type'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="description">Mô Tả:</label>
            <input type="text" id="description" name="description" value="<?= $service['description'] ?>">
        </div>

        <div class="form-group">
            <label for="price">Giá:</label>
            <input type="text" id="price" name="price" value="<?= $service['price'] ?>">
        </div>

        <div class="form-group">
            <input type="button" value="Hủy" onclick="window.location.href='manage_services.php'">
            <input type="submit" value="Cập Nhật">
        </div>
    </form>
</div>
</body>
</html>