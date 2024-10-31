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
    $school_name = $_POST['school_name'] ?? '';
    $school_address = $_POST['school_address'] ?? '';

    // Prepare INSERT statement
    $sql = "INSERT INTO previous_school_details (school_name, school_address) VALUES (?, ?)";

    // Prepare and execute the statement
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error: " . $conn->error); // Check for errors in preparing the statement
    } else {
        $stmt->bind_param("ss", $school_name, $school_address);
        if ($stmt->execute()) {
            $stmt->close(); // Close the statement
            $conn->close(); // Close the connection
            header("Location: success.php"); // Redirect to enrollment.php
            exit();
        } else {
            echo "Error: Unable to insert data. " . $stmt->error;
        }
    }
}

// Close statement and connection (if not already closed due to successful execution)
if (isset($stmt)) {
    $stmt->close();
}
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
    margin-bottom: 1px;
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
        .requirements {
            margin-top: 1px;
        }

        .requirements ul {
            list-style-type: disc;
            margin-left: 20px;
        }
        

        .requirements div {
          
            margin-bottom: 8px;
        }

        .important-note {
            margin-top: 20px;
            font-weight: bold;
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
    <h2>Previous School</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td><label for="school_name">Previous School Name:</label></td>
                    <td><label for="school_address">Previous School Address:</label></td>
                </tr>
                <tr>
                    <td><input type="text" name="school_name" id="school_name" placeholder="Enter school name" required style="width: 200px;"></td>
                    <td><input type="text" name="school_address" id="school_address" placeholder="Enter school address" required style="width: 200px;"></td>
                </tr>
                <tr>
                    <td colspan="2"><h2>Requirements for New Students</h2></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="requirements">
                            <ul>
                                <li>Philippine Statistics Authority (PSA) Birth Certificate (Original or Photocopy)</li>
                                <li>1 pc. 1x1 Latest ID Picture</li>
                                <li>1 pc. Long Brown Envelope (to be submitted on the 1st day of classes)</li>
                                <li>Certificate of Good Moral Character (for Intermediate, JHS, SHS students only)</li>
                                <li>JHS Certificate of Completion (Incoming Grade 11)</li>
                                <li>Report Card with Learner Reference Number (SF 9)</li>
                                <li>Transcript of Records (SF 10)</li>
                                <li>Education Service Contracting (ESC) Certification from the Principal (ESC Grantees only)</li>
                                <li>Qualified Voucher Recipient (QVR) Certificate (for Qualified SHS Voucher Applicant)</li>
                                <!-- Add more requirements as needed -->
                            </ul>
                            <div><strong>Create a ZIP file with the aforementioned requirements. Follow this format for the zip filename: "(SURNAME)-(FIRSTNAME)-(GRADELEVEL)-REQUIREMENTS.zip"</strong></div>
                            <div><strong>For example: PEREZ-JOHN-GRADE11-REQUIREMENTS.zip</strong></div>
                            <div>You can skip the submission of other requirements except Form 137 (Report Card). Please note that your application will be temporary unless the requirements are complete.</div>
                            <div class="important-note">To complete your enrollment, create a Google Drive folder and place the ZIP file containing your requirements. Share the folder via Gmail to enrollment@salisonline.com.</div>
                        </div>
                    </td>
                </tr>
                
                
                


                    
         
            </table>
            <div class="buttons">
                <a href="parents.php" class="back-button">Back</a>
               
                <input type="submit" value="submit" name="next">
                
            </div>
        </form>
    </section>
</div>




</body>
</html>
