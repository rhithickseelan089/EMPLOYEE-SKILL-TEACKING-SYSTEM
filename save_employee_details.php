<?php
session_start();
if ($_SESSION['role'] !== 'employee') die('Access Denied');
include '../config/db.php';

$employee_id = $_POST['employee_id'];
$name = $_POST['name'];
$skills = $_POST['skills'];
$project_name = $_POST['project_name'];
$project_id = $_POST['project_id'];
$certifications = $_POST['certifications'];
$training_progress = $_POST['training_progress'];

// Save details only once
$stmt = $conn->prepare("INSERT INTO employees (employee_id, name, skills, project_name, project_id, certifications, training_progress) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("issssss", $employee_id, $name, $skills, $project_name, $project_id, $certifications, $training_progress);
$stmt->execute();

header("Location: dashboard.php");
exit();
