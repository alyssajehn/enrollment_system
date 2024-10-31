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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $grade_level = $_POST['grade_level'] ?? '';
    $payment_schedule = $_POST['payment_schedule'] ?? '';

    // Prepare INSERT statement
    $sql = "INSERT INTO enrollment_details (grade_level, payment_schedule) 
            VALUES (?, ?)";

    // Prepare and execute the statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $grade_level, $payment_schedule);
    
    if ($stmt->execute()) {
        // Redirect based on grade_level and payment_schedule
        if ($grade_level == "Grade 11" && $payment_schedule == "Full Cash Basic") {
            header("Location: full_cash.php");
        } elseif ($grade_level == "Grade 11" && $payment_schedule == "Semi-Annual") {
            header("Location: semi_annual.php");
        } elseif ($grade_level == "Grade 11" && $payment_schedule == "Quarterly") {
            header("Location: quarterly.php");
        } elseif ($grade_level == "Grade 11" && $payment_schedule == "Monthly Basis") {
            header("Location: monthly_basis.php");
        } elseif ($grade_level == "Grade 12" && $payment_schedule == "Full Cash Basic") {
            header("Location: g12full_cash.php");
        } elseif ($grade_level == "Grade 12" && $payment_schedule == "Semi-Annual") {
            header("Location: g12semi_annual.php");
        } elseif ($grade_level == "Grade 12" && $payment_schedule == "Quarterly") {
            header("Location: g12quarterly.php");
        } elseif ($grade_level == "Grade 12" && $payment_schedule == "Monthly Basis") {
            header("Location: g12monthly_basis.php");
        } else {
            header("Location: other_page.php"); // Adjust this as needed
        }
        exit(); 
    } else {
        echo "Error: Unable to insert data. " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senior High School Enrollment System</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Georgia&display=swap">
    <style>
        /* Reset default browser styles */
        body, label, input, select, button, textarea {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body Styling */
        body {
            font-family: 'Georgia', serif;
            background-color: #f2cf3d;
            color: #333;
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* Container */
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Header Styling */
        nav {
            overflow: hidden;
            text-align: right;
            border: 2px;
            background-color: #6a0611;
        }

        nav a {
            float: right;
            display: block;
            color: #fff;
            text-align: right;
            padding: 14px 16px;
            text-decoration: none;
            font-family: 'Roboto', serif;
        }

        nav a:hover {
            background-color: #6a0611;
            color: black;
        }

        .header-content {
            text-align: center;
            padding: 10px 0;
        }

        .header-content h1 {
            font-size: 3em;
            margin-bottom: 20px;
        }

        .logo {
            display: inline-block;
            vertical-align: middle;
            margin-right: 15px;
        }

        .school-name {
            display: inline-block;
            vertical-align: middle;
            font-size: 2.5em;
            color: #6a0611;
        }

        /* Form Section */
        .form-section {
            background-color: #fff;
            border-radius: 1px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 15px;
            margin-top: 30px;
            margin-bottom: 20px;
            font-family: 'Roboto', serif;
        }

        h2 {
            margin-bottom: 20px;
            font-size: 2rem;
            text-align: center;
            color: #6a0611;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-size: 1rem; /* Adjusted label font size */
        }

        input[type="submit"] {
            background-color: green;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
            display: block;
            margin-right: 2%;
        }

        /* Add CSS for table layout */
        .form-section table {
            width: 100%;
            margin-top: 20px;
        }

        .form-section td {
            padding: 10px;
        }

        .form-section label {
            font-weight: bold;
            color: #000;
            margin-bottom: 1px;
            display: block; /* Make the label a block element */
        }

        .form-section input[type="text"],
        .form-section select,
        .form-section input[type="email"],
        .form-section input[type="tel"],
        .form-section input[type="number"],
        .form-section input[type="password"],
        .form-section input[type="checkbox"] {
            padding: 10px;
            width: calc(100% - 22px);
            margin-bottom: 5px;
        }

        .form-section input[type="checkbox"] + label {
            margin-left: 5px; /* Adjust margin between checkbox and label */
        }

        .form-section .buttons {
            display: flex;
            justify-content: space-between;
        }

        .form-section .back-button {
            background-color: #6a0611;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
            display: block;
            margin-left: 2%;
            text-decoration: none; /* Remove underline from text */
        }

        .form-section .back-button:hover {
            background: #000;
        }
    </style>
    <script>
        function redirectToPage() {
            var gradeLevel = document.getElementById('grade_level').value;
            var paymentSchedule = document.getElementById('payment_schedule').value;

            if (gradeLevel == "Grade 11" && paymentSchedule == "Full Cash Basic") {
                window.location.href = "full_cash.php";
            } else if (gradeLevel == "Grade 11" && paymentSchedule == "Semi-Annual") {
                window.location.href = "semi_annual.php";
            } else if (gradeLevel == "Grade 11" && paymentSchedule == "Quarterly") {
                window.location.href = "quarterly.php";
            } else if (gradeLevel == "Grade 11" && paymentSchedule == "Monthly Basis") {
                window.location.href = "monthly_basis.php";
            } else if (gradeLevel == "Grade 12" && paymentSchedule == "Full Cash Basic") {
                window.location.href = "g12full_cash.php";
            } else if (gradeLevel == "Grade 12" && paymentSchedule == "Semi-Annual") {
                window.location.href = "g12semi_annual.php";
            } else if (gradeLevel == "Grade 12" && paymentSchedule == "Quarterly") {
                window.location.href = "g12quarterly.php";
            } else if (gradeLevel == "Grade 12" && paymentSchedule == "Monthly Basis") {
                window.location.href = "g12monthly_basis.php";
            } else {
                // Add other conditions and redirects as necessary
            }
        }
    </script>
</head>
<body>

<header>
    <div class="header-content">
        <img src="logo-removebg-preview.png" alt="School Logo" class="logo" width="100" height="100">
        <div class="school-name">ST. ALPHONSUS LIGUORI INTEGRATED SCHOOL</div>
    </div>
</header>

<nav>
        <a class="navbar-link" href="contact_us.php">Contact Us</a>
        <a href="about.php">About us</a>
        <a href="main.php">Home</a>
    </nav>

<div class="container">
    <section class="form-section">
        <h2>Enrollment Details</h2>
        <form action="" method="POST" onsubmit="redirectToPage()"> <!-- Updated action to point to the same script -->
            <table>
                <tr>
                    <td><label for="grade_level">Grade Level:</label></td>
                    <td><label for="payment_schedule">Payment Schedule:</label></td>
                </tr>
                <tr>
                    <td>
                        <select name="grade_level" id="grade_level" required>
                            <option value="">--Select--</option>
                            <option value="Grade 11">Grade 11- STEM</option>
                            <option value="Grade 11">Grade 11- HUMSS</option>
                            <option value="Grade 12">Grade 12- STEM</option>
                            <option value="Grade 11">Grade 12- HUMSS</option>
                        </select>
                    </td>
                    
                    <td>
                        <select name="payment_schedule" id="payment_schedule" required>
                            <option value="">--Select--</option>
                            <option value="Full Cash Basic">Full Cash Basic</option>
                            <option value="Semi-Annual">Semi-Annual</option>
                            <option value="Quarterly">Quarterly</option>
                            <option value="Monthly Basis">Monthly Basis</option>
                            <option value="Other">Other</option>
                        </select>
                    </td>
                </tr>
            </table>
            <div class="buttons">
                <a href="previous.php" class="back-button">Back</a>
                <input type="submit" value="next">
            </div>
        </form>
    </section>
</div>

</body>
</html>
