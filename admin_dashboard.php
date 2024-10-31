<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['account_type'] != 'Admin') {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "enrollmentsystemdb";

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['delete'])) {
    $student_info_id = $_POST['student_info_id'];
    // Delete student details from all related tables
    $conn->query("DELETE FROM contact_details WHERE student_info_id = '$student_info_id'");
    $conn->query("DELETE FROM parents_information WHERE student_info_id = '$student_info_id'");
    $conn->query("DELETE FROM enrollment_details WHERE student_info_id = '$student_info_id'");
    $conn->query("DELETE FROM previous_school_details WHERE student_info_id = '$student_info_id'");
    $conn->query("DELETE FROM student_information WHERE student_info_id = '$student_info_id'");
}

$students = $conn->query("
    SELECT si.student_info_id, si.first_name, si.last_name, ed.grade_level,
           IF(ed.student_info_id IS NOT NULL, 'Enrolled', 'Not Enrolled') AS status
    FROM student_information si
    LEFT JOIN enrollment_details ed ON si.student_info_id = ed.student_info_id
");

if (!$students) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }
        h2 {
            text-align: center;
            color: #6a0611;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #ffffff;
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #6a0611;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        a {
            color: #007BFF;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .edit-btn, .delete-btn {
            padding: 8px 12px;
            margin-right: 5px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }
        .edit-btn {
            background-color: #28a745;
            color: #fff;
        }
        .delete-btn {
            background-color: #dc3545;
            color: #fff;
        }
        .logout-link {
            display: block;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<h2>Admin Home</h2>
<p>Welcome, <?php echo htmlspecialchars($_SESSION['username'] ?? ''); ?>!</p>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Grade Level</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($student = $students->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($student['student_info_id'] ?? ''); ?></td>
            <td><?php echo htmlspecialchars($student['first_name'] ?? ''); ?></td>
            <td><?php echo htmlspecialchars($student['last_name'] ?? ''); ?></td>
            <td><?php echo htmlspecialchars($student['grade_level'] ?? ''); ?></td>
            <td><?php echo htmlspecialchars($student['status'] ?? ''); ?></td>
            <td class="actions">
                <a class="edit-btn" href="student-details.php?student_info_id=<?php echo htmlspecialchars($student['student_info_id'] ?? ''); ?>">Update</a>
                <form action="admin_dashboard.php" method="post" style="display:inline;">
                    <input type="hidden" name="student_info_id" value="<?php echo htmlspecialchars($student['student_info_id'] ?? ''); ?>">
                    <button class="delete-btn" type="submit" name="delete">Delete</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>
<a class="logout-link" href="logout.php">Logout</a>
</body>
</html>

<?php $conn->close(); ?>
