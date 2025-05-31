<?php
session_start();

// Redirect user to appropriate dashboard if already logged in
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] === 'hr') {
        header("Location: hr/dashboard.php");
        exit();
    } elseif ($_SESSION['role'] === 'employee') {
        header("Location: employee/dashboard.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Skill Tracking System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: url('p1.jpg') no-repeat center center fixed;
            background-size: cover;
            background-color: #f4f4f4;
        }
        .container {
            text-align: center;
            background-color: #ffffff;
            border-radius: 8px;
            padding: 40px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            margin-bottom: 30px;
        }
        .button {
            padding: 15px 25px;
            margin: 10px;
            background-color: #007bff;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to Employee Skill Tracking System</h1>
        <a href="login.html" class="button">Login</a>
        <a href="register.html" class="button">Register</a>
    </div>
</body>
</html>
