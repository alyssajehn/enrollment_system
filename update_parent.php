<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "enrollmentsystemdb";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['parents_info_id'])) {
    $parents_info_id = $_POST['parents_info_id'];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch existing contact information
    $sql_select = "SELECT * FROM parents_information WHERE parents_info_id = ?";
    $stmt_select = $conn->prepare($sql_select);
    $stmt_select->bind_param("i", $parents_info_id);
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
                <h2>Update Parents Details</h2>
                <form action="update_process.php" method="POST">
                    <input type="hidden" name="parents_info_id" value="<?php echo $row['parents_info_id']; ?>">
                    <label for="mothers_maiden_name">Mother's Maiden Name:</label>
                    <input type="text" id="mothers_maiden_name" name="mothers_maiden_name" value="<?php echo htmlspecialchars($row['mothers_maiden_name']); ?>" required>
                    <label for="fathers_name">Father's Name:</label>
                    <input type="text" id="fathers_name" name="fathers_name" value="<?php echo htmlspecialchars($row['fathers_name']); ?>" required>
                    <label for="reason_for_not_specifying_maidens_name">Reason for not specifying mother's maiden name:</label>
                    <input type="text" id="reason_for_not_specifying_maidens_name" name="reason_for_not_specifying_maidens_name" value="<?php echo htmlspecialchars($row['reason_for_not_specifying_maidens_name']); ?>" required>
                    <label for="guardian_name">Guardian Name:</label>
                    <input type="text" id="guardian_name" name="guardian_name" value="<?php echo htmlspecialchars($row['guardian_name']); ?>" required>
                    <label for="guardian_contact_no">Guardian Contact Number:</label>
                    <input type="text" id="guardian_contact_no" name="guardian_contact_no" value="<?php echo htmlspecialchars($row['guardian_contact_no']); ?>" required>
                    <label for="guardian_address">Guardian Address:</label>
                    <input type="text" id="guardian_address" name="guardian_address" value="<?php echo htmlspecialchars($row['guardian_address']); ?>" required>
                    <label for="occupation">Occupation:</label>
                    <input type="text" id="occupation" name="occupation" value="<?php echo htmlspecialchars($row['occupation']); ?>" required>
                    <label for="office_address">Office Address:</label>
                    <input type="text" id="office_address" name="office_address" value="<?php echo htmlspecialchars($row['office_address']); ?>" required>
                    <label for="ethnicity">Ethnicity:</label>
                    <input type="text" id="ethnicity" name="ethnicity" value="<?php echo htmlspecialchars($row['ethnicity']); ?>" required>
                    <label for="mother_tongue">Mother Tongue:</label>
                    <input type="text" id="mother_tongue" name="mother_tongue" value="<?php echo htmlspecialchars($row['mother_tongue']); ?>" required>
                    <label for="other_spoken_languages">Other Spoken Languages:</label>
                    <input type="text" id="other_spoken_languages" name="other_spoken_languages" value="<?php echo htmlspecialchars($row['other_spoken_languages']); ?>" required>
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
        echo "Parents details not found.";
    }

    $stmt_select->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
