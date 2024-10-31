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
    $first_name = $_POST['first_name'] ?? '';
    $middle_name = $_POST['middle_name'] ?? '';
    $last_name = $_POST['last_name'] ?? '';
    $extension_name = $_POST['extension_name'] ?? '';
    $nickname = $_POST['nickname'] ?? '';
    $lrn_number = $_POST['lrn_number'] ?? '';
    $birthdate = $_POST['birthdate'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $religion = $_POST['religion'] ?? '';
    $place_of_birth = $_POST['place_of_birth'] ?? '';
    $have_been_hospitalized = isset($_POST['have_been_hospitalized']) ? 1 : 0;
    $reason = $_POST['reason'] ?? '';
    $medical_history = $_POST['medical_history'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $account_type = $_POST['account_type'] ?? '';

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if the LRN number already exists
    $sql_check = "SELECT * FROM student_information WHERE lrn_number = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $lrn_number);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        // LRN number already exists
        echo "Error: LRN number already exists. Please use a unique LRN number.";
    } else {
        // Prepare INSERT statement
        $sql = "INSERT INTO student_information (first_name, middle_name, last_name, extension_name, nickname, lrn_number, birthdate, gender, religion, place_of_birth, have_been_hospitalized, reason, medical_history, username, password, account_type) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Prepare and execute the statement
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssssssssssss", $first_name, $middle_name, $last_name, $extension_name, $nickname, $lrn_number, $birthdate, $gender, $religion, $place_of_birth, $have_been_hospitalized, $reason, $medical_history, $username, $hashed_password, $account_type);

if ($stmt->execute()) {
    header("Location: contact.php");
    exit(); 
} else {
    echo "Error: Unable to insert data. " . $stmt->error;
}

// Close statement
$stmt->close();

    }

    // Close statement and connection
    $stmt_check->close();
    $conn->close();
}
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
        */* Reset CSS */
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
            color:white ; 
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
        <h2>Personal Information</h2>
        <form action="reg.php" method="POST">
            <table>
                <tr>
                    
                    <td><label for="first_name">First Name:</label></td>
                    <td><label for="middle_name">Middle Name:</label></td>
                    <td><label for="last_name">Last Name:</label></td>
                    <td><label for="extension_name">Extension Name:</label></td>
                </tr>
               
                    <td><input type="text" name="first_name" id="first_name" placeholder="Enter your first name" required></td>
                    <td><input type="text" name="middle_name" id="middle_name" placeholder="Enter your middle name" required></td>
                    <td><input type="text" name="last_name" id="last_name" placeholder="Enter your last name" required></td>
                    <td><input type="text" name="extension_name" id="extension_name" placeholder="Enter your extension name" required></td>
                </tr>
                <tr>
                    
                    <td><label for="nickname">Nickname:</label></td>
                    <td><label for="lrn_number">LRN:</label></td>
                    <td><label for="birthdate">Birthdate:</label></td>
                
                </tr>
               
                    <td><input type="text" name="nickname" id="nickname" placeholder="Enter your  nickname" required></td>
                    <td><input type="number" name="lrn_number" id="lrn_number" placeholder="Enter your LRN" required></td>
                    <td><input type="date" name="birthdate" id="birthdate" placeholder="dd/mm/yyyy" required></td>
                  
                </tr>
                <tr>
                    
                <td><label for="gender">Gender:</label></td>
                    <td><label for="religion">Religion:</label></td>
                    <td><label for="place_of_birth">Place of Birth:</label></td>
                
                </tr>
               
                <td>
                        <select name="gender" id="gender" required>
                        <option value="">--Select--</option>
                            <option value="Female">Female</option>
                            <option value="Male">Male</option>
                        </select>
                    </td>
                    
                    
    <td>
        
            <select name="religion" id="religion" required>
                <option value="">--Select--</option>
                <option value="Roman Catholic">Roman Catholic</option>
                <option value="Iglesia ni Cristo">Iglesia ni Cristo</option>
                <option value="Islam">Islam</option>
                <option value="Protestant">Protestant</option>
                <option value="Buddhism">Buddhism</option>
                <option value="Hinduism">Hinduism</option>
                <option value="Other">Other</option>
            </select>
     
    </td>


                    <td><input type="text" name="place_of_birth" id="place_of_birth" placeholder="Enter your birth place" required></td>
                  
                </tr>
                <tr>
    <td><label for="have_been_hospitalized">Medical History:</label></td>
    <td><label for="reason">Reason:</label></td>
    <td><label for="medical_history">Medical History:</label></td>
</tr>
<tr>
    <td><input type="checkbox" name="have_been_hospitalized" id="have_been_hospitalized"><label for="have_been_hospitalized "required>I have been hospitalized</label></td>
    <td><input type="text" name="reason" id="reason" placeholder="Reason" required></td>
     <td><input type="text" name="medical_history" id="medical_history" placeholder="Medical History" required></td>
</tr>
<tr>
                    <td><label for="username">Username:</label></td>
                    <td><label for="password">Password:</label></td>
                    <td><label for="account_type">Account Type</label></td>
                </tr>
                
                <tr>
                    <td><input type="text" name="username" id="username" placeholder="Enter a username" required></td>
                    <td><input type="password" name="password" id="password" placeholder="Enter a password" required></td>
                
                
                <td>
                <select id="account_type" name="account_type" required>
                    <option value="Admin">Admin</option>
                    <option value="Student">Student</option>
                </select>
    </td>
    </tr>
            </div>

            </table>
            <div class="buttons">
                <a href="main.php" class="back-button">Back</a>
                
                
                <input type="submit" value="next">
            </div>
        </form>
    </section>
</div>



</body>
</html>
