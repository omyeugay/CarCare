<?php
    require_once '../../controller/database.php';
    require_once '../../models/customers.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $customer = new Customers();
        $customer->addCustomer($name, $phone, $email, $password);

        header("Location: manage_customers.php");
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Customer</title>
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
            width: 130px;
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
        <h1 style="text-align: center">Thêm Khách Hàng</h1>
        <hr>
        <form method="post" action="add_customer.php">
            <div class="form-group">
                <label for="name">Tên Khách Hàng:</label>
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
                <label for="password">Mật Khẩu:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <input type="button" onclick="window.location.href='manage_customers.php'" value="Hủy">
                <input type="submit" value="Thêm Khách Hàng">
            </div>
        </form>
    </div>
</body>
</html>