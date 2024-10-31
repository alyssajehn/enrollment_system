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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['contact_details_id'])) {
    $contact_details_id = $_POST['contact_details_id'];

    // Delete the contact details
    $sql_delete = "DELETE FROM contact_details WHERE contact_details_id = ?";
    $stmt_delete = $conn->prepare($sql_delete);
    $stmt_delete->bind_param("i", $contact_details_id);

    if ($stmt_delete->execute()) {
        echo "Contact details deleted successfully.";
    } else {
        echo "Error deleting contact details: " . $conn->error;
    }

    $stmt_delete->close();
}

$conn->close();
?>
