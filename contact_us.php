<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Body Styling */
        body {
            font-family: 'Georgia', serif;
            background-color: #f2cf3d;
            color: #333;
            line-height: 1.6;
            overflow-x: hidden;
            margin: 0;
            padding: 0;
        }

        /* Container */
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Header Styling */
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

        /* Contact Container */
        .contact-container {
            width: 60%;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .contact-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        h1 {
            text-align: center;
            color: #6a0611;
            margin-bottom: 20px;
            font-size: 2.5em;
            letter-spacing: 1px;
            font-family: 'Roboto', serif;
        }

        .contact-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            gap: 20px;
        }

.contact-details, .map-container {
    width: 48%;
    padding: 20px;
    background-color: #fafafa;
    border: 1px solid #e0e0e0;
    border-radius: 10px;
}

.contact-details h2, .map-container h2, .social-media h2 {
    color: #6a0611;
    margin-bottom: 15px;
    font-size: 1.5em;
    font-family: 'Roboto', serif;
}

.contact-details p {
    margin: 10px 0;
    color: #666666;
    line-height: 1.6;
    display: flex;
    align-items: center;
}

.contact-details p i {
    margin-right: 10px;
    color: #6a0611;
}

.map-container iframe {
    width: 100%;
    height: 300px;
    border: 0;
    border-radius: 10px;
}

.social-media {
    text-align: center;
    margin-top: 30px;
    font-family: 'Roboto', serif;
    
}

.social-icons a {
    display: inline-block;
    margin: 0 15px;
    color: #333333;
    text-decoration: none;
    font-size: 1.5em;
    transition: color 0.3s ease;
}

.social-icons a i {
    margin-right: 5px;
}

.social-icons a:hover {
    color: #555555;
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
            <div class="school-name">ST. ALPHONSUS LIGUORI INTEGRATED SCHOOL</div>
        </div>
    </header>

    <nav>
        <a class="navbar-link" href="contact_us.php">Contact Us</a>
        <a href="about.php">About us</a>
        <a href="main.php">Home</a>
    </nav>

    <div class="contact-container">
        <h1>Contact Information</h1>
        <div class="contact-info">
            <div class="contact-details">
                <h2>Get in Touch</h2>
                <p><i class="fas fa-envelope"></i>Email: salis_molino91@yahoo.com.ph</p>
                <p><i class="fas fa-phone"></i>Phone: (046) 476 5034</p>
                <p><i class="fas fa-map-marker-alt"></i>Address: Addas Village 2, Molino, Bacoor, Philippines</p>
            </div>
            <div class="map-container">
                <h2>Our Location</h2>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3856.241762908054!2d120.96420691534115!3d14.411918290131246!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33962a3f67a1568f%3A0xa1a7a5e0d007ea!2sAddas%202%20Village%2C%20Molino%20II%2C%20Bacoor%2C%20Cavite%2C%20Philippines!5e0!3m2!1sen!2sus!4v1652440646882!5m2!1sen!2sus" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
        <div class="social-media">
            <h2>Follow Us</h2>
            <div class="social-icons">
                <a href="https://www.facebook.com/Liguorians?mibextid=LQQJ4d" target="_blank"><i class="fab fa-facebook-f"></i>Facebook</a>
                
                
            </div>
        </div>
    </div>
    <footer>
        &copy; 2024 ST. ALPHONUS LIGUORI INTEGRATED SCHOOL
    </footer>
</body>
</html>
