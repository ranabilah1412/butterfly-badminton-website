<?php 
session_start(); 
include('header.php'); 
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Home - Butterfly Badminton Court</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        body { 
            font-family: 'Poppins', 'Segoe UI', Arial, sans-serif; 
            margin: 0; 
            
            background: linear-gradient(135deg, #0f0c29 0%, #302b63 50%, #24243e 100%);
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: #ffffff;
            overflow-x: hidden;
        }
        
        
        .hero-banner {
            padding: 120px 20px;
            text-align: center;
            background: rgba(0, 0, 0, 0.2);
        }

        .hero-banner h1 { 
            font-size: 3.5rem; 
            margin-bottom: 10px; 
            letter-spacing: 2px;
            color: #fd79a8; 
            text-shadow: 0 0 15px rgba(253, 121, 168, 0.6);
            text-transform: uppercase;
        }

        .hero-banner p { 
            font-size: 1.2rem; 
            margin-bottom: 40px; 
            opacity: 0.9;
            color: #a29bfe; 
        }

        
        .cta-button {
            background: linear-gradient(to right, #6c5ce7, #0984e3);
            color: white;
            padding: 16px 45px;
            text-decoration: none;
            font-size: 1.1rem;
            border-radius: 50px;
            font-weight: bold;
            transition: 0.4s;
            display: inline-block;
            box-shadow: 0 4px 15px rgba(108, 92, 231, 0.4);
            border: none;
        }

        .cta-button:hover { 
            background: #fd79a8; 
            transform: scale(1.05);
            box-shadow: 0 0 25px rgba(253, 121, 168, 0.7);
            color: white;
        }

        
        .info-section {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 30px;
            padding: 80px 10%;
            background: rgba(0, 0, 0, 0.3);
        }

        .info-box {
            background: rgba(255, 255, 255, 0.05); 
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 40px 25px;
            text-align: center;
            flex: 1;
            min-width: 280px;
            max-width: 350px;
            transition: all 0.4s ease;
        }

        .info-box:hover {
            transform: translateY(-15px);
            background: rgba(255, 255, 255, 0.1);
            border-color: #fd79a8; 
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }

        .info-box i {
            font-size: 3rem;
            color: #fd79a8; 
            margin-bottom: 25px;
            filter: drop-shadow(0 0 10px rgba(253, 121, 168, 0.5));
        }

        .info-box h3 { 
            color: #ffffff; 
            margin-bottom: 15px; 
            font-size: 1.5rem;
            letter-spacing: 1px;
        }

        .info-box p {
            font-size: 1rem;
            line-height: 1.7;
            color: #d1d1d1;
        }

       
        html { scroll-behavior: smooth; }
    </style>
</head>
<body>

    <section class="hero-banner">
        <?php if(isset($_SESSION['login_member'])): ?>
            <h1>Welcome Back, <?php echo htmlspecialchars($_SESSION['login_member']); ?>!</h1>
            <p>Ready to dominate the court today?</p>
            <a href="booking.php" class="cta-button">Book Your Slot</a>
        <?php else: ?>
            <h1>Smash Your Limits.</h1>
            <p>Experience Butterfly Badminton's professional neon-lit courts.</p>
            <a href="login.php" class="cta-button">Get Started Now</a>
        <?php endif; ?>
    </section>

    <section class="info-section">
        <div class="info-box">
            <i class="fas fa-medal"></i>
            <h3>Premium Courts</h3>
            <p>International-standard flooring with pro-grip tech for maximum safety and performance.</p>
        </div>
        
        <div class="info-box">
            <i class="fas fa-bolt"></i>
            <h3>Quick Booking</h3>
            <p>No waiting. View live availability and secure your preferred court in just a few clicks.</p>
        </div>
        
        <div class="info-box">
            <i class="fas fa-trophy"></i>
            <h3>Expert Coaching</h3>
            <p>Master your smash and footwork with training from our certified badminton professionals.</p>
        </div>
    </section>

    <?php include('footer.php'); ?>

</body>
</html>