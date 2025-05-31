<?php
session_start();
if ($_SESSION['role'] !== 'hr') die('Access Denied');
include '../config/db.php';

// Fetch all employees for HR dashboard
$result = $conn->query("SELECT * FROM employees");
?>

<!DOCTYPE html>
<html>
<head>
    <title>HR Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            background: url('p1.jpeg') no-repeat center center fixed;
            background-size: cover;
            padding: 0;
        }

        .container {
            position: relative; /* For positioning logout button */
            width: 90%;
            max-width: 900px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0,0,0,0.1);
        }

        /* Logout button styles */
        .logout-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #dc3545; /* red */
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
            transition: background-color 0.3s;
        }

        .logout-btn:hover {
            background-color: #a71d2a;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ccc;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        a.edit, a.delete {
            color: #007bff;
            text-decoration: none;
            margin-right: 10px;
        }

        a.delete {
            color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="../auth/logout.php" class="logout-btn">Logout</a>

        <h2>HR Dashboard - Employee List</h2>

        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Skills</th>
                <th>Project</th>
                <th>Certifications</th>
                <th>Progress</th>
                <th>Actions</th>
            </tr>
            <?php while ($employee = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($employee['employee_id']) ?></td>
                    <td><?= htmlspecialchars($employee['name']) ?></td>
                    <td><?= htmlspecialchars($employee['skills']) ?></td>
                    <td><?= htmlspecialchars($employee['project_name']) ?> (<?= htmlspecialchars($employee['project_id']) ?>)</td>
                    <td><?= htmlspecialchars($employee['certifications']) ?></td>
                    <td><?= htmlspecialchars($employee['training_progress']) ?></td>
                    <td>
                        <a href="edit_employee.php?id=<?= $employee['employee_id'] ?>" class="edit">Edit</a>
                        <a href="delete_employee.php?id=<?= $employee['employee_id'] ?>" class="delete" onclick="return confirm('Are you sure to delete this employee?');">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
