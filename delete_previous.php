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
    $previous_school_id = $_POST["previous_school_id"];

    $sql = "DELETE FROM previous_school_details WHERE previous_school_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $previous_school_id);

    if ($stmt->execute()) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
    $stmt->close();
    $conn->close();
    header("Location: previous-details.php");
    exit;
}
?>
