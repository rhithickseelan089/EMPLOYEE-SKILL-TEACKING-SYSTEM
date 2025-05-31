<?php
session_start();
include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    $login_error = '';

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            if ($user['role'] === 'hr') {
                header("Location: ../hr/dashboard.php");
                exit();
            } else {
                header("Location: ../employee/dashboard.php");
                exit();
            }
        } else {
            $login_error = "Invalid password.";
        }
    } else {
        $login_error = "User not found.";
    }
} else {
    // No POST data, redirect back or show error
    header("Location: ../login.html");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Status</title>
    <style>
         body {
            font-family: Arial, sans-serif;
            background: #f1f1f1;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .message-box {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            text-align: center;
            width: 350px;
        }

        .message-box h2 {
            color: #333;
        }

        .error {
            color: red;
            font-weight: bold;
            margin-top: 15px;
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }

        .back-link:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="message-box">
        <h2>Login Failed</h2>
        <?php if (!empty($login_error)): ?>
            <div class="error"><?= htmlspecialchars($login_error) ?></div>
        <?php endif; ?>
        <a class="back-link" href="../login.html">← Back to Login</a>
    </div>
</body>
</html>
