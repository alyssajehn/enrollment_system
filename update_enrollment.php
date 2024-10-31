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
    if (isset($_POST["update"])) {
        $enrollment_details_id = $_POST["enrollment_details_id"];
        $grade_level = $_POST["grade_level"];
        $payment_schedule = $_POST["payment_schedule"];

        $sql = "UPDATE enrollment_details SET grade_level = ?, payment_schedule = ? WHERE enrollment_details_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $grade_level, $payment_schedule, $enrollment_details_id);

        if ($stmt->execute()) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }
        $stmt->close();
        $conn->close();
        header("Location: enrollment-details.php");
        exit;
    } else {
        $enrollment_details_id = $_POST["enrollment_details_id"];

        $sql = "SELECT grade_level, payment_schedule FROM enrollment_details WHERE enrollment_details_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $enrollment_details_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $grade_level = $row["grade_level"];
            $payment_schedule = $row["payment_schedule"];
        } else {
            echo "No record found";
        }
        $stmt->close();
    }
} else {
    $grade_level = "";
    $payment_schedule = "";
    $enrollment_details_id = "";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Enrollment Details</title>
    <style>
                /* Add your CSS styles here */
                /* Example styles */
                body {
                    font-family: Arial, sans-serif;
                }
                .container {
                    max-width: 600px;
                    margin: 0 auto;
                    padding: 20px;
                    background-color: #f9f9f9;
                    border: 1px solid #ddd;
                    border-radius: 5px;
                }
                h2 {
                    text-align: center;
                    color: #6a0611;
                }
                label {
                    display: block;
                    margin-bottom: 10px;
                }
                input[type="text"], input[type="date"], select {
                    width: 100%;
                    padding: 8px;
                    margin-bottom: 15px;
                    border: 1px solid #ccc;
                    border-radius: 4px;
                    box-sizing: border-box;
                }
                input[type="submit"] {
                    background-color: #6a0611;
                    color: white;
                    padding: 10px 15px;
                    border: none;
                    border-radius: 4px;
                    cursor: pointer;
                    font-size: 16px;
                }
                input[type="submit"]:hover {
                    background-color: #45060a;
                }
                .buttons {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                }
                .back-button {
                    background-color: #6a0611; 
                    color: white; 
                    padding: 10px 15px; 
                    border: none; 
                    border-radius: 4px; 
                    text-decoration: none; 
                    text-align: center;
                }
                .back-button:hover {
                    background-color: #45060a;
                }
            </style>
</head>
<body>
<div class="container">
    <h2>Update Enrollment Details</h2>
    <form action="update_process.php" method="POST">
        <input type="hidden" name="enrollment_details_id" value="<?php echo $enrollment_details_id; ?>">
        <label for="grade_level">Grade Level:</label>
        <input type="text" id="grade_level" name="grade_level" value="<?php echo $grade_level; ?>" required><br>
        <label for="payment_schedule">Payment Schedule:</label>
        <input type="text" id="payment_schedule" name="payment_schedule" value="<?php echo $payment_schedule; ?>" required><br>
        <div class="buttons">
                        <a href="enrollment-details.php" class="back-button">Back</a>
                        <input type="submit" value="Update">
                    </div>
                </form>
            </div>
    </form>
</body>
</html>
