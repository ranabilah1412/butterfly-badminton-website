<?php
session_start();
include('includes/dbconnect.php');

if (!isset($_SESSION['login_member'])) {
    header("Location: login.php");
    exit();
}


$type  = isset($_GET['type']) ? $_GET['type'] : '';
$tier  = isset($_GET['tier']) ? $_GET['tier'] : ''; 
$court = isset($_GET['court']) ? $_GET['court'] : '';
$date  = isset($_GET['date']) ? $_GET['date'] : '';
$time  = isset($_GET['time']) ? $_GET['time'] : '';

$price = 0;


if ($type == 'membership') {
    $price = ($tier == 'Premium') ? 80 : 30;
} 

else if ($type == 'booking') {
    if ($court == 'Court 3') {
        $price = 30; 
    } else {
        $price = 20; 
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Secure Payment - Butterfly Badminton</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { 
            font-family: 'Poppins', sans-serif; 
            margin: 0; 
            background: linear-gradient(135deg, #0f0c29 0%, #302b63 50%, #24243e 100%);
            background-attachment: fixed;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .payment-box {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            padding: 40px;
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            width: 400px;
            text-align: center;
            box-shadow: 0 15px 35px rgba(0,0,0,0.5);
        }

        h2 { color: #fd79a8; margin-bottom: 10px; text-transform: uppercase; }
        .details-text { color: #a29bfe; margin-bottom: 20px; font-size: 0.9rem; line-height: 1.6; }
        .amount { font-size: 42px; font-weight: bold; color: #fff; margin-bottom: 25px; }
        
        input {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            background: rgba(255, 255, 255, 0.9);
            color: #333;
            box-sizing: border-box;
        }

        .pay-btn {
            width: 100%;
            padding: 15px;
            background: linear-gradient(to right, #6c5ce7, #0984e3);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 20px;
            text-transform: uppercase;
            transition: 0.3s;
        }

        .pay-btn:hover { background: #fd79a8; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(253, 121, 168, 0.4); }
    </style>
</head>
<body>

<div class="payment-box">
    <i class="fas fa-lock" style="font-size: 40px; color: #fd79a8; margin-bottom: 15px;"></i>
    <h2>Secure Checkout</h2>
    
    <div class="details-text">
        <?php if($type == 'membership'): ?>
            Membership Plan: <strong><?php echo $tier; ?></strong>
        <?php else: ?>
            Booking: <strong><?php echo $court; ?></strong><br>
            Date: <?php echo $date; ?> | Time: <?php echo $time; ?>
        <?php endif; ?>
    </div>

    <div class="amount">RM <?php echo number_format($price, 2); ?></div>

    <form action="process_payment.php" method="POST">
        <input type="hidden" name="payment_type" value="<?php echo $type; ?>">
        <input type="hidden" name="tier" value="<?php echo $tier; ?>">
        <input type="hidden" name="court" value="<?php echo $court; ?>">
        <input type="hidden" name="date" value="<?php echo $date; ?>">
        <input type="hidden" name="time" value="<?php echo $time; ?>">
        
        <input type="text" placeholder="Cardholder Name" required>
        <input type="text" placeholder="Card Number (16 Digits)" maxlength="16" required>
        <div style="display: flex; gap: 10px;">
            <input type="text" placeholder="MM/YY" maxlength="5" required>
            <input type="password" placeholder="CVV" maxlength="3" required>
        </div>
        
        <button type="submit" class="pay-btn">Confirm & Pay</button>
    </form>
    
    <div style="margin-top: 20px; font-size: 11px; opacity: 0.6;">
        <i class="fas fa-check-circle"></i> Secure 256-bit SSL Encrypted Payment
    </div>
</div>

</body>
</html>