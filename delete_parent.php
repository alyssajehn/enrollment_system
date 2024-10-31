<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "enrollmentsystemdb";


// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['parents_info_id'])) {
    // Validate input (you may add more validation as needed)
    $parents_info_id = $_POST['parents_info_id'];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql_delete = "DELETE FROM parents_information WHERE parents_info_id = ?";
    $stmt_delete = $conn->prepare($sql_delete);
    $stmt_delete->bind_param("i", $parents_info_id);

    if ($stmt_delete->execute()) {
        // Redirect back to student information page after successful delete
        header("Location: parent-details.php");
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