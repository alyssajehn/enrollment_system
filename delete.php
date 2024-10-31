<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "enrollmentsystemdb";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['student_info_id'])) {
    // Validate input (you may add more validation as needed)
    $student_info_id = $_POST['student_info_id'];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Delete student information
    $sql_delete = "DELETE FROM student_information WHERE student_info_id = ?";
    $stmt_delete = $conn->prepare($sql_delete);
    $stmt_delete->bind_param("i", $student_info_id);

    if ($stmt_delete->execute()) {
        // Redirect back to student information page after successful delete
        header("Location: student-details.php");
        exit();
    } else {
        echo "Error deleting student information: " . $stmt_delete->error;
    }

    $stmt_delete->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
