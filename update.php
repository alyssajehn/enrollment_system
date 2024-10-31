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

    // Fetch existing student information
    $sql_select = "SELECT * FROM student_information WHERE student_info_id = ?";
    $stmt_select = $conn->prepare($sql_select);
    $stmt_select->bind_param("i", $student_info_id);
    $stmt_select->execute();
    $result_select = $stmt_select->get_result();

    if ($result_select->num_rows > 0) {
        $row = $result_select->fetch_assoc();
        // Display update form with pre-filled data
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Update Student Information</title>
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
                <h2>Update Student Information</h2>
                <form action="update_process.php" method="POST">
                <input type="hidden" name="student_info_id" value="<?php echo $row['student_info_id']; ?>">
                    <label for="first_name">First Name:</label>
                    <input type="text" id="first_name" name="first_name" value="<?php echo $row['first_name']; ?>" required>
                    <label for="middle_name">Middle Name:</label>
                    <input type="text" id="middle_name" name="middle_name" value="<?php echo $row['middle_name']; ?>" required>
                    <label for="last_name">Last Name:</label>
                    <input type="text" id="last_name" name="last_name" value="<?php echo $row['last_name']; ?>" required>
                    <label for="extension_name">Extension Name:</label>
                    <input type="text" id="extension_name" name="extension_name" value="<?php echo $row['extension_name']; ?>" required>
                    <label for="nickname">Nickname:</label>
                    <input type="text" id="nickname" name="nickname" value="<?php echo $row['nickname']; ?>" required>
                    <label for="lrn_number">LRN:</label>
                    <input type="text" id="lrn_number" name="lrn_number" value="<?php echo $row['lrn_number']; ?>" required>
                    <label for="birthdate">Birthdate:</label>
                    <input type="date" id="birthdate" name="birthdate" value="<?php echo $row['birthdate']; ?>" required>
                    <label for="gender">Gender:</label>
                    <input type="text" id="gender" name="gender" value="<?php echo $row['gender']; ?>" required>
                    <label for="religion">Religion:</label>
                    <input type="text" id="religion" name="religion" value="<?php echo $row['religion']; ?>" required>
                    <label for="place_of_birth">Place of Birth:</label>
                    <input type="text" id="place_of_birth" name="place_of_birth" value="<?php echo $row['place_of_birth']; ?>" required>
                    <label for="have_been_hospitalized">Been Hospitalized:</label>
                    <input type="text" id="have_been_hospitalized" name="have_been_hospitalized" value="<?php echo $row['have_been_hospitalized']; ?>" required>
                    <label for="reason">Reason:</label>
                    <input type="text" id="reason" name="reason" value="<?php echo $row['reason']; ?>" required>
                    <label for="medical_history">Medical History:</label>
                    <input type="text" id="medical_history" name="medical_history" value="<?php echo $row['medical_history']; ?>" required>
                    <div class="buttons">
                        <a href="student-details.php" class="back-button">Back</a>
                        <input type="submit" value="Update">
                    </div>
                </form>
            </div>
        </body>
        </html>
        <?php
    } else {
        echo "Student information not found.";
    }

    $stmt_select->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
?>