<?php 
session_start(); 
include('header.php'); 
?>

<!DOCTYPE html>
<html>
<head>
    <title>About Us - Butterfly Badminton Club</title>
    <style>
        
        body { 
            font-family: 'Poppins', 'Segoe UI', Arial, sans-serif; 
            margin: 0; 
            background: linear-gradient(135deg, #0f0c29 0%, #302b63 50%, #24243e 100%);
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: #ffffff;
        }
        
        .container { max-width: 1100px; margin: 50px auto; padding: 20px; }
        
        .about-section { 
            display: flex; 
            align-items: center; 
            gap: 50px; 
            margin-bottom: 60px;
            
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            padding: 40px;
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .about-text { flex: 1; }
        .about-image { flex: 1; text-align: center; }
        .about-image img { 
            width: 100%; 
            max-width: 400px;
            border-radius: 15px; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.5); 
            border: 2px solid rgba(253, 121, 168, 0.3); 
        }

        h1 { 
            color: #fd79a8; 
            font-size: 36px; 
            text-transform: uppercase;
            letter-spacing: 2px;
            text-shadow: 0 0 10px rgba(253, 121, 168, 0.5);
        }

        h2 { color: #fd79a8; margin-bottom: 20px; }
        h4 { color: #a29bfe; font-size: 1.2rem; margin-bottom: 10px; }
        
        p { line-height: 1.8; font-size: 17px; color: #d1d1d1; }
        strong { color: #fd79a8; }

        .mission-box { 
            background: rgba(108, 92, 231, 0.15); 
            backdrop-filter: blur(10px);
            padding: 40px; 
            border-left: 5px solid #fd79a8; 
            border-radius: 10px;
            margin-bottom: 60px;
        }

        .features-grid {
            display: flex; 
            justify-content: space-around; 
            margin-top: 30px;
            gap: 20px;
        }

        .feature-item {
            background: rgba(255, 255, 255, 0.05);
            padding: 20px;
            border-radius: 15px;
            width: 30%;
            transition: 0.3s;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .feature-item:hover {
            transform: translateY(-10px);
            background: rgba(255, 255, 255, 0.1);
            border-color: #fd79a8;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="about-section">
      <div class="about-text">
            <h1>Our Story</h1>
            <p>Founded in 2024, <strong>Butterfly Badminton Court</strong> started with a simple vision: to provide a world-class arena for badminton enthusiasts in our community.</p>
            <p>Whether you are a casual player looking for weekend fun or a competitive athlete training for the next big tournament, our courts are designed to give you the best experience possible.</p>
        </div>
        <div class="about-image">
            <img src="court.jpg" alt="Badminton Court"/>
        </div>
    </div>

    <div class="mission-box">
        <h2>Our Mission</h2>
        <p>To promote a healthy lifestyle through badminton by providing high-quality facilities, professional coaching, and a vibrant community atmosphere for players of all ages and skill levels.</p>
    </div>

    <div style="margin-top: 60px; text-align: center;">
        <h2>Why Play at Butterfly?</h2>
        <div class="features-grid">
            <div class="feature-item">
                <h4>Quality Floors</h4>
                <p>Anti-slip, shock-absorbing mats for safety.</p>
            </div>
            <div class="feature-item">
                <h4>Great Lighting</h4>
                <p>Glare-free LED lights for perfect visibility.</p>
            </div>
            <div class="feature-item">
                <h4>Easy Booking</h4>
                <p>Our custom system makes booking a breeze!</p>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
</body>
</html>