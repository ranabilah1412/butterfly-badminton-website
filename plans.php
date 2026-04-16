<?php 
session_start(); 
include('header.php'); 
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Membership Plans - Butterfly Badminton</title>
    <style>
        
        body { 
            font-family: 'Poppins', 'Segoe UI', Arial, sans-serif; 
            margin: 0; 
            padding: 0;
            min-height: 100vh;
            background: linear-gradient(135deg, #0f0c29 0%, #302b63 50%, #24243e 100%) !important;
            background-attachment: fixed !important;
            background-size: cover !important;
            color: #ffffff;
        }

        
        .wrapper { 
            max-width: 1000px; 
            margin: 0 auto; 
            padding: 80px 20px; 
            display: flex;
            flex-direction: column;
            align-items: center; 
            text-align: center; 
        }
        
        h1 { 
            color: #fd79a8; 
            text-transform: uppercase;
            letter-spacing: 2px;
            text-shadow: 0 0 10px rgba(253, 121, 168, 0.5);
            margin-bottom: 10px;
            font-size: 2.5rem;
        }

        .tagline { 
            color: #a29bfe; 
            margin-bottom: 50px; 
            font-size: 1.1rem;
        }

        .pricing-container { 
            display: flex; 
            justify-content: center; 
            align-items: stretch;
            gap: 30px; 
            flex-wrap: wrap; 
            width: 100%;
        }
        
        /* Glass Plan Cards */
        .plan-card { 
            background: rgba(255, 255, 255, 0.08); 
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.1); 
            padding: 40px 30px; 
            width: 300px; 
            border-radius: 20px; 
            transition: all 0.4s ease;
            box-shadow: 0 15px 35px rgba(0,0,0,0.3);
            display: flex;
            flex-direction: column;
        }
        
        .plan-card:hover { 
            transform: translateY(-15px); 
            border-color: #fd79a8;
            box-shadow: 0 15px 40px rgba(253, 121, 168, 0.3);
        }
        
        .plan-card h2 { color: #ffffff; margin: 0; font-size: 1.8rem; }
        
        .price { 
            font-size: 36px; 
            font-weight: bold; 
            color: #fd79a8; 
            margin: 20px 0; 
            text-shadow: 0 0 10px rgba(253, 121, 168, 0.3);
        }

        .features { 
            list-style: none; 
            padding: 0; 
            text-align: left; 
            margin: 20px 0;
            flex-grow: 1; /* Ensures buttons align at the bottom */
        }
        
        .features li { 
            padding: 12px 0; 
            border-bottom: 1px solid rgba(255, 255, 255, 0.05); 
            color: #d1d1d1;
            font-size: 0.95rem;
        }
        
        .select-btn { 
            display: block; 
            background: linear-gradient(to right, #6c5ce7, #0984e3);
            color: white; 
            padding: 15px; 
            text-decoration: none; 
            border-radius: 10px; 
            font-weight: bold;
            text-transform: uppercase;
            transition: 0.3s;
            border: none;
        }

        .select-btn:hover { 
            background: #fd79a8; 
            box-shadow: 0 0 20px rgba(253, 121, 168, 0.6);
            color: white;
            transform: scale(1.02);
        }
        
        .premium { 
            border: 2px solid #fd79a8; 
            background: rgba(253, 121, 168, 0.05); 
            position: relative;
        }

        .premium-tag {
            position: absolute;
            top: -15px;
            left: 50%;
            transform: translateX(-50%);
            background: #fd79a8;
            color: #0f0c29;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: bold;
            text-transform: uppercase;
        }
    </style>
</head>
<body>

<div class="wrapper">
    <h1>Our Membership Plans</h1>
    <p class="tagline">Choose the best tier for your badminton journey!</p>

    <div class="pricing-container">
        <div class="plan-card">
            <h2>Basic</h2>
            <div class="price">RM 30<span style="font-size: 16px; opacity: 0.7;">/mo</span></div>
            <ul class="features">
                <li>✅ Off-peak hour access</li>
                <li>✅ Standard Court access</li>
                <li>❌ No coaching included</li>
                <li>❌ No free shuttlecocks</li>
            </ul>
            <a href="payment.php?type=membership&tier=Basic" class="select-btn">Join Basic</a>
        </div>

        <div class="plan-card premium">
            <div class="premium-tag">Most Popular</div>
            <h2 style="color: #fd79a8;">Premium ⭐</h2>
            <div class="price">RM 80<span style="font-size: 16px; opacity: 0.7;">/mo</span></div>
            <ul class="features">
                <li>✅ 24/7 Court Booking</li>
                <li>✅ Air-conditioned Courts</li>
                <li>✅ 2 hrs coaching/month</li>
                <li>✅ Free shuttlecocks</li>
            </ul> 
			<a href="payment.php?type=membership&tier=Premium" class="select-btn">Join Premium</a>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>

</body>
</html>