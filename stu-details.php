<?php
session_start(); // Start session to store user ID

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "enrollmentsystemdb";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from form
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement to fetch user details
    $sql = "SELECT user_id FROM users WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $input_username, $input_password);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Check if user exists
    if ($user) {
        // Store user_id in session
        $_SESSION['user_id'] = $user['user_id'];

        // Redirect to details page
        header("Location: details.php");
        exit();
    } else {
        echo "Invalid username or password.";
    }

    $stmt->close();
    $conn->close();
    exit();
}

// If user is already authenticated (session exists), display details
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Fetch student_info_id based on user_id from student_information table
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement to fetch student_info_id
    $sql_student = "SELECT student_info_id FROM student_information WHERE user_id = ?";
    $stmt_student = $conn->prepare($sql_student);
    $stmt_student->bind_param("i", $user_id);
    $stmt_student->execute();
    $result_student = $stmt_student->get_result();
    $student_info = $result_student->fetch_assoc();

    if ($student_info) {
        $student_info_id = $student_info['student_info_id'];

        // Fetch contact details based on student_info_id
        $sql_contact = "SELECT * FROM contact_details WHERE student_info_id = ?";
        $stmt_contact = $conn->prepare($sql_contact);
        $stmt_contact->bind_param("i", $student_info_id);
        $stmt_contact->execute();
        $result_contact = $stmt_contact->get_result();
        $contact_info = $result_contact->fetch_assoc();

        // Fetch parents information based on student_info_id
        $sql_parents = "SELECT * FROM parents_information WHERE student_info_id = ?";
        $stmt_parents = $conn->prepare($sql_parents);
        $stmt_parents->bind_param("i", $student_info_id);
        $stmt_parents->execute();
        $result_parents = $stmt_parents->get_result();
        $parents_info = $result_parents->fetch_assoc();

        // Fetch previous school details based on student_info_id
        $sql_previous = "SELECT * FROM previous_school_details WHERE student_info_id = ?";
        $stmt_previous = $conn->prepare($sql_previous);
        $stmt_previous->bind_param("i", $student_info_id);
        $stmt_previous->execute();
        $result_previous = $stmt_previous->get_result();
        $previous_info = $result_previous->fetch_assoc();

        // Fetch enrollment details based on student_info_id
        $sql_enrollment = "SELECT * FROM enrollment_details WHERE student_info_id = ?";
        $stmt_enrollment = $conn->prepare($sql_enrollment);
        $stmt_enrollment->bind_param("i", $student_info_id);
        $stmt_enrollment->execute();
        $result_enrollment = $stmt_enrollment->get_result();
        $enrollment_info = $result_enrollment->fetch_assoc();

        // Display the fetched details
        ?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Student Details</title>
            <!-- Add your CSS styles here -->
            <style>
                /* Add your CSS styles for formatting */
            </style>
        </head>
        <body>
            <h2>Student Details</h2>
            <h3>Student Information</h3>
            <p>
                Name: <?php echo $student_info['first_name'] . ' ' . $student_info['last_name']; ?><br>
                LRN Number: <?php echo $student_info['lrn_number']; ?><br>
                Birthdate: <?php echo $student_info['birthdate']; ?><br>
                <!-- Add other student information fields as needed -->
            </p>

            <h3>Contact Details</h3>
            <p>
                Email: <?php echo $contact_info['contact_email']; ?><br>
                Mobile Number 1: <?php echo $contact_info['mobile_number_1']; ?><br>
                <!-- Add other contact details fields as needed -->
            </p>

            <h3>Parents Information</h3>
            <p>
                Mother's Maiden Name: <?php echo $parents_info['mothers_maiden_name']; ?><br>
                Father's Name: <?php echo $parents_info['fathers_name']; ?><br>
                <!-- Add other parents information fields as needed -->
            </p>

            <h3>Previous School Details</h3>
            <p>
                School Name: <?php echo $previous_info['school_name']; ?><br>
                School Address: <?php echo $previous_info['school_address']; ?><br>
                <!-- Add other previous school details fields as needed -->
            </p>

            <h3>Enrollment Details</h3>
            <p>
                Grade Level: <?php echo $enrollment_info['grade_level']; ?><br>
                Payment Schedule: <?php echo $enrollment_info['payment_schedule']; ?><br>
                <!-- Add other enrollment details fields as needed -->
            </p>
        </body>
        </html>

        <?php

    } else {
        echo "Student information not found.";
    }

    $conn->close();
}
?>
