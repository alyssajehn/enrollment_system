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
    $mothers_maiden_name = $_POST['mothers_maiden_name'] ?? '';
    $fathers_name = $_POST['fathers_name'] ?? '';
    $reason_for_not_specifying_maidens_name = $_POST['reason_for_not_specifying_maidens_name'] ?? '';
    $guardian_name = $_POST['guardian_name'] ?? '';
    $guardian_contact_no = $_POST['guardian_contact_no'] ?? '';
    $guardian_address = $_POST['guardian_address'] ?? '';
    $occupation = $_POST['occupation'] ?? '';
    $office_address = $_POST['office_address'] ?? '';
    $ethnicity = $_POST['ethnicity'] ?? '';
    $mother_tongue = $_POST['mother_tongue'] ?? '';
    $other_spoken_languages = $_POST['other_spoken_languages'] ?? '';

    // Prepare INSERT statement
    $sql = "INSERT INTO parents_information (mothers_maiden_name, fathers_name, reason_for_not_specifying_maidens_name, guardian_name, guardian_contact_no, guardian_address, occupation, office_address, ethnicity, mother_tongue, other_spoken_languages) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare and execute the statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssss", $mothers_maiden_name, $fathers_name, $reason_for_not_specifying_maidens_name, $guardian_name, $guardian_contact_no, $guardian_address, $occupation, $office_address, $ethnicity, $mother_tongue, $other_spoken_languages);
    
    if ($stmt->execute()) {
        header("Location: previous.php");
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
        <div class="school-name">ST. ALPHONUS LIGUORI INTEGRATED SCHOOL</div>
    </div>
</header>

<nav>
    
    <a class="navbar-link" href="edit.php">Contact Us</a>
    <a href="about.php">About us</a>
    <a href="main.php">Home</a>
</nav>

<div class="container">
    <section class="form-section">
        <h2>Enrollment Details</h2>
        <form action="" method="POST"> <!-- Action is the current file -->
            <table>
                <tr>
                    
                    <td><label for="grade_level">Grade Level:</label></td>
                    <td><label for="payment_schedule">Payment Schedule:</label></td>
                
                </tr>
               <td>
                <select name="grade_level" id="grade_level" required>

                <option value="Grade 12">Grade 12</option>
            </select>
    </td>
    <td>
        
        <select name="payment_schedule" id="payment_schedule" required>
            
            <option value="Full Cash Basic"> Full Cash Basic</option>
            <option value="Semi-Annual">Semi-Annual</option>
            <option value="Quarterly">Quarterly</option>
            <option value="Monthly Basis">Monthly Basis</option>
            <option value="Other">Other</option>
        </select>
 
</td>
  </tr>
                <tr>
                    
                    <td><label for="student_address">Breakdown of Fees</label></td>
                
                
                    <table style="border-collapse: collapse; width: 100%;">
    <tr>
        <td style="border: 1px solid black; background-color: lightblue;"><label>LEVEL</label></td>
        <td style="border: 1px solid black; background-color: lightblue;"><label>TUITION FEES</label></td>
        <td style="border: 1px solid black; background-color: lightblue;"><label>MISC FEES</label></td>
        <td style="border: 1px solid black; background-color: lightblue;"><label>BOOKS</label></td>
        <td style="border: 1px solid black; background-color: lightblue;"><label>TOTAL</label></td>
        <td style="border: 1px solid black; background-color: lightblue;"><label>DEPED SUBSIDY</label></td>
        <td style="border: 1px solid black; background-color: lightblue;"><label>GRAND TOTAL (TF, MISC, BOOKS)</label></td>
    </tr>
    <tr>
        <td style="border: 1px solid black;">Grade 12</td>
        <td style="border: 1px solid black;">34,452</td>
        <td style="border: 1px solid black;">20,494</td>
        <td style="border: 1px solid black;"></td>
        <td style="border: 1px solid black;">54,946</td>
        <td style="border: 1px solid black;">14,000</td>
        <td style="border: 1px solid black;"><label>40,946</label></td>
    </tr>


<tr>
    <td><label for="student_address">Payment Schedule</label></td>


<table style="border-collapse: collapse; width: 100%;">
    <tr>
        <td style="border: 1px solid black; background-color: lightblue;"><label>LEVEL</label></td>
        <td style="border: 1px solid black; background-color: lightblue;"><label>PAYMENT SCHEDULE</label></td>
        <td style="border: 1px solid black; background-color: lightblue;"><label>UPON ENROLLMENT</label></td>
        <td style="border: 1px solid black; background-color: lightblue;"><label>NEXT PAYMENT</label></td>
    </tr>
    <tr>
        <td style="border: 1px solid black;">Grade 12</td>
        <td style="border: 1px solid black;">Full Cash Basis</td>
        <td style="border: 1px solid black;">54,946</td>
        <td style="border: 1px solid black;"></td>
        
    </tr>
      
         
            </table>
            <div class="buttons">
                <a href="enrollment.php" class="back-button">Back</a>
                
                <input type="submit" value="next">
                
            </div>
        </form>
    </section>
</div>



</body>
</html>
