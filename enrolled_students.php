<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "enrollmentsystemdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Fetch enrolled students
$sql = "SELECT student_info_id, first_name,middle_name,last_name, lrn_number, birthdate, gender, reg_date FROM student_information";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrolled Students</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1000px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: green;
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 15px;
            text-align: left;
        }
        
        .back-button {
            display: inline-block;
            padding: 10px 20px;
            background: #141e28;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: #141e28;
            font-size: 1rem;
            margin-top: 20px;
        }

        .back-button:hover {
            background: blue;
        }
        th {
            background-color: #141e28;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        @media (max-width: 768px) {
            .container {
                width: 90%;
            }
            table, th, td {
                display: block;
                width: 100%;
            }
            th {
                text-align: right;
            }
            td {
                text-align: right;
                padding-left: 50%;
                position: relative;
            }
            td:before {
                content: attr(data-label);
                position: absolute;
                left: 0;
                width: 50%;
                padding-left: 15px;
                font-weight: bold;
                text-align: left;
                background-color: #f8f9fa;
            }
            
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Enrolled Students</h1>
        <?php if ($result->num_rows > 0): ?>
            <table>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>LRN</th>
                    <th>Birthdate</th>
                    <th>Gender</th>
                    <th>Timestamp</th>
                </tr>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td data-label="ID"><?php echo $row['student_info_id']; ?></td>
                        <td data-label="First Name"><?php echo $row['first_name']; ?></td>
                        <td data-label="Middle Name"><?php echo $row['middle_name']; ?></td>
                        <td data-label="Last Name"><?php echo $row['last_name']; ?></td>
                        <td data-label="LRN"><?php echo $row['lrn_number']; ?></td>
                        <td data-label="Birthdate"><?php echo $row['birthdate']; ?></td>
                        <td data-label="Gender"><?php echo $row['gender']; ?></td>
                        <td data-label="Timestamp"><?php echo $row['reg_date']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
            <a href="main.php" class="back-button">Back to Main Page</a>
        <?php else: ?>
            <p>No students enrolled yet.</p>
        <?php endif; ?>
        <?php $conn->close(); ?>
    </div>
</body>
</html>
