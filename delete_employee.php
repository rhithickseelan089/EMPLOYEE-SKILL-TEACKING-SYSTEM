<?php
session_start();
if ($_SESSION['role'] !== 'hr') die('Access Denied');
include '../config/db.php';

$id = $_GET['id'];
$stmt = $conn->prepare("DELETE FROM employees WHERE employee_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: dashboard.php");
?>
