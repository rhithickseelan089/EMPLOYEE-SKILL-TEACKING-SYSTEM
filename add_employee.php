<?php
session_start();
if ($_SESSION['role'] !== 'hr') die('Access Denied');
include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $skills = $_POST['skills'];
    $project_name = $_POST['project_name'];
    $project_id = $_POST['project_id'];
    $certifications = $_POST['certifications'];
    $training_progress = $_POST['training_progress'];

    $stmt = $conn->prepare("INSERT INTO employees (name, skills, project_name, project_id, certifications, training_progress) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $name, $skills, $project_name, $project_id, $certifications, $training_progress);
    $stmt->execute();

    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Employee</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f1f3f6;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            background: white;
            margin: 50px auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-top: 15px;
            font-weight: bold;
        }

        input[type="text"] {
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        button {
            margin-top: 25px;
            padding: 12px;
            background-color: #007bff;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .back-link {
            display: block;
            margin-top: 20px;
            text-align: center;
            color: #007bff;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Add New Employee</h2>
    <form method="POST">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" required>

        <label for="skills">Skills</label>
        <input type="text" name="skills" id="skills" required>

        <label for="project_name">Project Name</label>
        <input type="text" name="project_name" id="project_name">

        <label for="project_id">Project ID</label>
        <input type="text" name="project_id" id="project_id">

        <label for="certifications">Certifications</label>
        <input type="text" name="certifications" id="certifications">

        <label for="training_progress">Training Progress</label>
        <input type="text" name="training_progress" id="training_progress">

        <button type="submit">Add Employee</button>
    </form>

    <a class="back-link" href="dashboard.php">← Back to Dashboard</a>
</div>
</body>
</html>
