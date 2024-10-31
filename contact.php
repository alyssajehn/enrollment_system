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
    $contact_email = $_POST['contact_email'] ?? '';
    $mobile_number_1 = $_POST['mobile_number_1'] ?? '';
    $mobile_number_2 = $_POST['mobile_number_2'] ?? '';
    $student_address = $_POST['student_address'] ?? '';
    $contact_person_name = $_POST['contact_person_name'] ?? '';
    $contact_number = $_POST['contact_number'] ?? '';
    $contact_person_address = $_POST['contact_person_address'] ?? '';

    // Prepare INSERT statement
    $sql = "INSERT INTO contact_details (contact_email, mobile_number_1, mobile_number_2, student_address, contact_person_name, contact_number, contact_person_address) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Prepare and execute the statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $contact_email, $mobile_number_1, $mobile_number_2, $student_address, $contact_person_name, $contact_number, $contact_person_address);
    
    if ($stmt->execute()) {
        header("Location: parents.php");
        exit(); 
    } else {
        echo "Error: Unable to insert data. " . $stmt->error;
    }

    // Close statement
    $stmt->close();
    
    // Close connection
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
        <h2>Contact Details</h2>
        <form action="contact.php" method="POST">
            <table>
                <tr>
                    
                    <td><label for="contact_email">Email:</label></td>
                    <td><label for="mobile_number_1">Mobile Number 1:</label></td>
                    <td><label for="mobile_number_2">Mobile 2:</label></td>
                </tr>
               
                    <td><input type="text" name="contact_email" id="contact_email" placeholder="Enter email" required></td>
                    <td><input type="number" name="mobile_number_1" id="mobile_number_1" placeholder="Enter number" required></td>
                    <td><input type="number" name="mobile_number_2" id="mobile_number_2" placeholder="Enter number" required></td>
                </tr>
                <tr>
                    
                    <td><label for="student_address">Address:</label></td>
                
                
                </tr>
               
                    <td><input type="text" name="student_address" id="student_address" placeholder="Enter your  nickname" required></td>
                
                  
                </tr>
                <tr>
                    
                <td><label>Contact Person in case of Emergency</label></td>
    </tr>
    <tr>
                <td><label for="contact_person_name">Name:</label></td>
                    <td><label for="contact_number">Contact Number:</label></td>
                    <td><label for="contact_person_address">Address:</label></td>
                
                </tr>
               
                
                <td><input type="text" name="contact_person_name" id="contact_person_name" placeholder="Enter" required></td>
                    <td><input type="number" name="contact_number" id="contact_number" placeholder="Enter number" required></td>
                    <td><input type="text" name="contact_person_address" id="contact_person_address" placeholder="Enter address" required></td>
                    </td>
                    
         
            </table>
            <div class="buttons">
            <a href="reg.php" class="back-button">Back</a>
                
                
                <input type="submit" value="next">
                
            </div>
        </form>
    </section>
</div>



</body>
</html>
