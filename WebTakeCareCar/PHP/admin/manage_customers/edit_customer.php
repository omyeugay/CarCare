<?php
require_once '../../controller/database.php';
require_once '../../models/customers.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (!isset($_GET['id'])) {
        die('No customer ID provided');
    }
    $id = $_GET['id'];

    $customers = new Customers();
    $customer = $customers->getCustomerById($id);

    if (!$customer) {
        die('Customer not found!');
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $customers = new Customers();
    $customers->updateCustomer($id, $name, $phone, $email, $password);

    header('Location: manage_customers.php');
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Customer</title>
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
        <h1 style="text-align: center">Cập nhật thông tin khách hàng</h1>
        <hr>
        <form action="edit_customer.php" method="post">
            <input type="hidden" name="id" value="<?php echo $customer['id']; ?>">
            <div class="form-group">
                <label for="name">Tên:</label>
                <input type="text" id="name" name="name" value="<?php echo $customer['name']; ?>">
            </div>
            <div class="form-group">
                <label for="phone">Số điện thoại:</label>
                <input type="text" id="phone" name="phone" value="<?php echo $customer['phone']; ?>">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" value="<?php echo $customer['email']; ?>">
            </div>
            <div class="form-group">
                <label for="password">Mật khẩu:</label>
                <input type="text" id="password" name="password" value="<?php echo $customer['password']; ?>">
            </div>
            <div class="form-group">
                <input type="button" value="Hủy" onclick="window.location.href='manage_customers.php'">
                <input type="submit" value="Cập nhật">
            </div>
        </form>
    </div>
</body>
</html>
