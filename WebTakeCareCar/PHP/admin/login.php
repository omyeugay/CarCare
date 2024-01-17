<?php
    require_once '../controller/database.php';
    require_once '../models/user.php';

    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $user = new User();
        if ($user->login($email, $password)) {
            header("Location: ./manage_appointments/manage_appointments.php");
            exit();
        } else {
            echo "Invalid username or password";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        form {
            background-color: white;
            padding: 40px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: none;
            color: white;
            background-color: #5C6BC0;
        }

        input[type="submit"]:hover {
            background-color: #3F51B5;
        }
    </style>
</head>
<body>
    <form action="login.php" method="POST">
        <label for="email">Email:</label>
        <input type="text" id="email" name="email">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password">
        <input type="checkbox" id="remember" name="remember">Nhớ Mật Khẩu
        <br>
        <br>
        <input type="submit" value="Login">
    </form>
</body>
</html>