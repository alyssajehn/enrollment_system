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
    $enrollment_details_id = $_POST["enrollment_details_id"];

    $sql = "DELETE FROM enrollment_details WHERE enrollment_details_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $enrollment_details_id);

    if ($stmt->execute()) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
    $stmt->close();
    $conn->close();
    header("Location: enrollment-details.php");
    exit;
}
?>
