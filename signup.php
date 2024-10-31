<?php
session_start();
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

$success_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Normalize username to lowercase for case-insensitive comparison
    $username = strtolower($username);

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hashed_password);

    if ($stmt->execute()) {
        $success_message = "Account successfully created!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f8f8f8;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .login-container {
        width: 400px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        padding: 40px;
    }

    .login-header h2 {
        font-size: 28px;
        color: #333;
        margin-bottom: 10px;
    }

    .login-header p {
        font-size: 16px;
        color: #666;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        font-size: 16px;
        color: #333;
        display: block;
        margin-bottom: 5px;
    }

    input[type="text"],
    input[type="password"] {
        width: calc(100% - 24px);
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
        transition: border-color 0.3s;
    }

    input[type="text"]:focus,
    input[type="password"]:focus {
        border-color: #007bff;
    }

    button {
        margin-top: 20px;
        margin-bottom: 40px;
        width: 100%;
        padding: 12px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    button:hover {
        background-color: #0056b3;
    }

    .footer-links {
        margin-bottom: 20px;
        display: flex;
        justify-content: space-between;
        font-size: 14px;
        color: #333;
    }

    .footer-links a {
        color: #007bff;
        text-decoration: none;
        transition: color 0.3s;
    }

    .footer-links a:hover {
        color: #0056b3;
    }

    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var successMessage = "<?php echo $success_message; ?>";
            if (successMessage) {
                alert(successMessage);
                setTimeout(function() {
                    window.location.href = "login.php";
                }, 3000);
            }
        });
    </script>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h3>Let's create you an account to get started!</h3>
            
        </div>
        
        <form id="login-form" action="" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required autocomplete="off">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>



            <button type="submit">Create Account</button>
            <div class="footer-links">
                <a href="login.php">Already have an account?</a>
                <a href="">Forgot password?</a> 
            </div>
            
        </form>
    </div>
</body>
</html>
