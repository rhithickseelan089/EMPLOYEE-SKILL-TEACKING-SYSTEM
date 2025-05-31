<?php
session_start();
if ($_SESSION['role'] !== 'hr') die('Access Denied');
include '../config/db.php';

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $skills = $_POST['skills'];
    $project_name = $_POST['project_name'];
    $project_id = $_POST['project_id'];
    $certifications = $_POST['certifications'];
    $training_progress = $_POST['training_progress'];

    $stmt = $conn->prepare("UPDATE employees SET name=?, skills=?, project_name=?, project_id=?, certifications=?, training_progress=? WHERE employee_id=?");
    $stmt->bind_param("ssssssi", $name, $skills, $project_name, $project_id, $certifications, $training_progress, $id);
    $stmt->execute();

    header("Location: dashboard.php");
    exit();
}

$stmt = $conn->prepare("SELECT * FROM employees WHERE employee_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$employee = $result->fetch_assoc();
?>

<h2>Edit Employee</h2>
<form method="POST">
    Name: <input type="text" name="name" value="<?= $employee['name'] ?>" required><br>
    Skills: <input type="text" name="skills" value="<?= $employee['skills'] ?>" required><br>
    Project Name: <input type="text" name="project_name" value="<?= $employee['project_name'] ?>"><br>
    Project ID: <input type="text" name="project_id" value="<?= $employee['project_id'] ?>"><br>
    Certifications: <input type="text" name="certifications" value="<?= $employee['certifications'] ?>"><br>
    Training Progress: <input type="text" name="training_progress" value="<?= $employee['training_progress'] ?>"><br>
    <button type="submit">Update</button>
</form>
<a href="dashboard.php">Back to Dashboard</a>
