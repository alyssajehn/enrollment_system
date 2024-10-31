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
    if (isset($_POST["previous_school_id"]) && !isset($_POST["update"])) {
        // Fetch existing previous school details
        $previous_school_id = $_POST["previous_school_id"];

        $sql = "SELECT school_name, school_address FROM previous_school_details WHERE previous_school_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $previous_school_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $school_name = $row["school_name"];
            $school_address = $row["school_address"];
        } else {
            echo "Record not found.";
            exit;
        }
        $stmt->close();
    } elseif (isset($_POST["update"])) {
        // Update previous school details
        $previous_school_id = $_POST["previous_school_id"];
        $school_name = $_POST["school_name"];
        $school_address = $_POST["school_address"];

        $sql = "UPDATE previous_school_details SET school_name = ?, school_address = ? WHERE previous_school_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $school_name, $school_address, $previous_school_id);

        if ($stmt->execute()) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }
        $stmt->close();
        $conn->close();
        header("Location: previous-details.php");
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Previous School Details</title>
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
    <h2>Update Previous School Details</h2>
    <form action="update_process.php" method="POST">
        <input type="hidden" name="previous_school_id" value="<?php echo $previous_school_id; ?>">
        <label for="school_name">School Name:</label>
        <input type="text" id="school_name" name="school_name" value="<?php echo $school_name; ?>" required><br>
        <label for="school_address">School Address:</label>
        <input type="text" id="school_address" name="school_address" value="<?php echo $school_address; ?>" required><br>
        <div class="buttons">
                        <a href="previous-details.php" class="back-button">Back</a>
                        <input type="submit" value="Update">
                    </div>
                </form>
            </div>
        </body>
        </html>
        
