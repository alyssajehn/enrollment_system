<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
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
            border: 1px solid #000;
        }

        td {
            padding: 8px;
            border: 1px solid #000;
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
         /* Table Styling */
         .details-section {
            background-color: #fff;
            border-radius: 1px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 15px;
            margin-top: 30px;
            margin-bottom: 20px;
            font-family: 'Roboto', serif;
         }
        
    
    th#id-column {
        background-color: #6a0611; /* Choose your desired background color */
        color: white; /* Text color */
        padding: 8px; /* Padding for the header cell */
        text-align: left; 
    }
    footer {
            padding: 10px 0;
            text-align: center;
            font-family: Arial, sans-serif;
            color: #fff;
            
            width: 100%;
            bottom: 0;
            z-index: 100;
        }
    
    </style>
</head>
<body>

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
    <section class="details-section">
       
        <table>
    
        <form action="en-details.php" method="POST">
            <input type="text" name="lrn" placeholder="Enter LRN" required autocomplete = "off">
            <input type="submit" value="View Details">
        </form>
        <?php
        // Check if LRN is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['lrn'])) {
            $lrn = $_POST['lrn'];
            
            // Database connection
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "enrollmentsystemdb";
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Query to retrieve student information based on LRN
            $sql = "SELECT * FROM student_information WHERE lrn_number = '$lrn'";
            $result = $conn->query($sql);

            // Display retrieved data in a table
            if ($result->num_rows > 0) {
                echo "<h2>Student Details</h2>";
                echo "<table>";
                echo "<tr><th id='id-column'>Field</th><th id='id-column'>Value</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    foreach ($row as $key => $value) {
                        echo "<tr><td>" . ucwords(str_replace("_", " ", $key)) . "</td><td>$value</td></tr>";
                    }
                }
                echo "</table>";
            } else {
                echo "<p>No student found with the provided LRN.</p>";
            }

            $conn->close();
        }
        ?>
    </div>
    <footer>
        &copy; 2024 ST. ALPHONUS LIGUORI INTEGRATED SCHOOL
    </footer>
</body>
</html>
