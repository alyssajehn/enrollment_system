<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "enrollmentsystemdb";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['contact_details_id'])) {
    $contact_details_id = $_POST['contact_details_id'];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch existing contact information
    $sql_select = "SELECT * FROM contact_details WHERE contact_details_id = ?";
    $stmt_select = $conn->prepare($sql_select);
    $stmt_select->bind_param("i", $contact_details_id);
    $stmt_select->execute();
    $result_select = $stmt_select->get_result();

    if ($result_select->num_rows > 0) {
        $row = $result_select->fetch_assoc();
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Update Contact Details</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f9f9f9;
                }
                .container {
                    max-width: 600px;
                    margin: 0 auto;
                    padding: 20px;
                    background-color: #fff;
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
                input[type="text"], input[type="email"] {
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
                <h2>Update Contact Details</h2>
                <form action="update_process.php" method="POST">
                    <input type="hidden" name="contact_details_id" value="<?php echo $row['contact_details_id']; ?>">
                    <label for="contact_email">Email:</label>
                    <input type="email" id="contact_email" name="contact_email" value="<?php echo $row['contact_email']; ?>" required>
                    <label for="mobile_number_1">Mobile Number 1:</label>
                    <input type="text" id="mobile_number_1" name="mobile_number_1" value="<?php echo $row['mobile_number_1']; ?>" required>
                    <label for="mobile_number_2">Mobile Number 2:</label>
                    <input type="text" id="mobile_number_2" name="mobile_number_2" value="<?php echo $row['mobile_number_2']; ?>">
                    <label for="student_address">Address:</label>
                    <input type="text" id="student_address" name="student_address" value="<?php echo $row['student_address']; ?>" required>
                    <label for="contact_person_name">Contact Person Name:</label>
                    <input type="text" id="contact_person_name" name="contact_person_name" value="<?php echo $row['contact_person_name']; ?>" required>
                    <label for="contact_number">Contact Number:</label>
                    <input type="text" id="contact_number" name="contact_number" value="<?php echo $row['contact_number']; ?>" required>
                    <label for="contact_person_address">Contact Person Address:</label>
                    <input type="text" id="contact_person_address" name="contact_person_address" value="<?php echo $row['contact_person_address']; ?>" required>
                    <div class="buttons">
                        <a href="contact-details.php" class="back-button">Back</a>
                        <input type="submit" value="Update">
                    </div>
                </form>
            </div>
        </body>
        </html>
        <?php
    } else {
        echo "Contact details not found.";
    }

    $stmt_select->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
