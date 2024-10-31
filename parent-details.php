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

// Fetch data from parents_information table
$sql = "SELECT parents_info_id, mothers_maiden_name, fathers_name, reason_for_not_specifying_maidens_name, guardian_name, guardian_contact_no, guardian_address, occupation, office_address, ethnicity, mother_tongue, other_spoken_languages FROM parents_information";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parents Details</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Georgia&display=swap">
    <style>
         body {
            font-family: 'Georgia', serif;
            background-color: #f2cf3d;
            color: #333;
            line-height: 1.6;
            overflow-x: hidden;
        }

        .container {
            max-width:  1000px;
            margin: 0 auto;
            padding: 10px;
        }

        nav {
            overflow: hidden;
            text-align: right;
            background-color: #6a0611;
        }

        nav a {
            float: right;
            display: block;
            color: #fff;
            text-align: right;
            padding: 14px 16px;
            text-decoration: none;
            font-family: 'Roboto', serif;
        }

        nav a:hover {
            background-color: #6a0611;
            color: black;
        }

        .header-content {
            text-align: center;
            padding: 10px 0;
        }

        .header-content h1 {
            font-size: 3em;
            margin-bottom: 20px;
        }

        .logo {
            display: inline-block;
            vertical-align: middle;
            margin-right: 15px;
        }

        .school-name {
            display: inline-block;
            vertical-align: middle;
            font-size: 2.5em;
            color: #6a0611;
        }

        .details-section {
            background-color: #fff;
            border-radius: 1px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 15px;
            margin-top: 30px;
            margin-bottom: 20px;
            font-family: 'Roboto', serif;
        }

        h2 {
            margin-bottom: 20px;
            font-size: 2rem;
            text-align: center;
            color: #6a0611;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border: 1px solid #ddd;
        }

        td {
            padding: 8px;
            border: 1px solid #ddd;
        }

        .back-button {
            background-color: #6a0611; 
            color: white; 
            padding: 5px 10px; 
            border: none; 
            border-radius: 5px; 
            cursor: pointer; 
            margin-top: 20px; 
            display: block; 
            text-decoration: none; 
            text-align: center;
        }

        .back-button:hover {
            background: #000;
        }

        .nav-buttons {
            text-align: center;
            margin-bottom: 20px;
        }

        .nav-buttons button {
            background-color: #6a0611;
            color: white;
            border: none;
            padding: 10px 20px;
            margin: 0 5px;
            cursor: pointer;
            border-radius: 5px;
        }

        .nav-buttons button:hover {
            background-color: #000;
        }

        .section {
            display: none;
        }

        .section.active {
            display: block;
        }
        th {
            padding: 5px; /* Add padding to the table header cells */
            text-align: left; /* Align text to the left within the cells */
            border: 1px solid #ddd;
        }
    
    th#id-column {
        background-color: #6a0611; /* Choose your desired background color */
        color: white; /* Text color */
        padding: 8px; /* Padding for the header cell */
        text-align: left; 
    }

.action-column {
    width: 150px;
    text-align: center;
}

.action-column button {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 5px 10px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 12px;
    margin: 2px;
    cursor: pointer;
    border-radius: 3px;
}

.action-column button:hover {
    background-color: #45a049;
}

.delete-button {
    background-color: #f44336;
}

.delete-button:hover {
    background-color: #da190b;
}

.edit-button {
    background-color: #008CBA;
}

.edit-button:hover {
    background-color: #007A99;
}
    </style>
    
</head>


<header>
    <div class="header-content">
        <img src="logo-removebg-preview.png" alt="School Logo" class="logo" width="100" height="100">
        <div class="school-name">ST. ALPHONUS LIGUORI INTEGRATED SCHOOL</div>
    </div>
</header>

<nav>
        <a class="navbar-link" href="contact_us.php">Contact Us</a>
        <a href="about.php">About us</a>
        <a href="main.php">Home</a>
    </nav>

<div class="container">
    <div class="nav-buttons">
        <button onclick="redirectTo('student-details.php')">Student Details</button>
        <button onclick="redirectTo('contact-details.php')">Contact Details</button>
        <button onclick="redirectTo('parent-details.php')">Parent Details</button>
        <button onclick="redirectTo('enrollment-details.php')">Enrollment Details</button>
        <button onclick="redirectTo('previous-details.php')">Previous School Details</button>
    </div>



    <div class="container">
        <section class="details-section">
            <h2>Parents Details</h2>
            <table>
            <?php
            // Fetch data from contact_details table
            $sql = "SELECT parents_info_id, mothers_maiden_name, fathers_name, reason_for_not_specifying_maidens_name, guardian_name, guardian_contact_no, guardian_address, occupation, office_address, ethnicity, mother_tongue, other_spoken_languages FROM parents_information";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // Output data of each row
              // Inside the while loop of your contact-details.php
while($row = $result->fetch_assoc()) {
    echo "<tr>
                                <th id='id-column'>Parents Info ID</th>
                                <td>" . htmlspecialchars($row["parents_info_id"]) . "</td>
                            </tr>
                            <tr>
                                <th>Mother's Maiden Name</th>
                                <td>" . htmlspecialchars($row["mothers_maiden_name"]) . "</td>
                            </tr>
                            <tr>
                                <th>Father's Name</th>
                                <td>" . htmlspecialchars($row["fathers_name"]) . "</td>
                            </tr>
                            <tr>
                                <th>Reason for not specifying mother's maiden name</th>
                                <td>" . htmlspecialchars($row["reason_for_not_specifying_maidens_name"]) . "</td>
                            </tr>
                            <tr>
                                <th>Guardian Name</th>
                                <td>" . htmlspecialchars($row["guardian_name"]) . "</td>
                            </tr>
                            <tr>
                                <th>Guardian Contact Number</th>
                                <td>" . htmlspecialchars($row["guardian_contact_no"]) . "</td>
                            </tr>
                            <tr>
                                <th>Guardian Address</th>
                                <td>" . htmlspecialchars($row["guardian_address"]) . "</td>
                            </tr>
                            <tr>
                                <th>Occupation</th>
                                <td>" . htmlspecialchars($row["occupation"]) . "</td>
                            </tr>
                            <tr>
                                <th>Office Address</th>
                                <td>" . htmlspecialchars($row["office_address"]) . "</td>
                            </tr>
                            <tr>
                                <th>Ethnicity</th>
                                <td>" . htmlspecialchars($row["ethnicity"]) . "</td>
                            </tr>
                            <tr>
                                <th>Mother Tongue</th>
                                <td>" . htmlspecialchars($row["mother_tongue"]) . "</td>
                            </tr>
                            <tr>
                                <th>Other Spoken Languages</th>
                                <td>" . htmlspecialchars($row["other_spoken_languages"]) . "</td>
                                <td class='action-column'>
                                    <form action='update_parent.php' method='POST' style='display: inline-block;'>
                                        <input type='hidden' name='parents_info_id' value='" . $row["parents_info_id"] . "'>
                                        <button type='submit' class='edit-button'>Update</button>
                                    </form>
                                    <form action='delete_parent.php' method='POST' style='display: inline-block;'>
                                        <input type='hidden' name='parents_info_id' value='" . $row["parents_info_id"] . "'>
                                        <button type='submit' class='delete-button'>Delete</button>
                                    </form>
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>No parents details found</td></tr>";
                }
                ?>
            </table>
        </section>
    </div>

<script>
function redirectTo(page) {
    window.location.href = page;
}
</script>
</body>
</html>

<?php
// Close connection
$conn->close();
?>
