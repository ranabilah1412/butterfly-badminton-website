<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include('includes/dbconnect.php'); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];

 
    $adminUser = "ButterFlyBadmintonAD";
    $adminPass = "BB2026";

    if ($user === $adminUser && $pass === $adminPass) {
        $_SESSION['login_member'] = "System Admin";
        $_SESSION['role'] = "admin"; 
        header("Location: admin_records.php"); 
        exit();
    }

    $user = mysqli_real_escape_string($conn, $user);
    $pass = mysqli_real_escape_string($conn, $pass);

    $sql = "SELECT * FROM members WHERE username = '$user' AND password = '$pass'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) == 1) {
        $_SESSION['login_member'] = $user; 
        $_SESSION['role'] = 'user';
        header("location: booking.php"); 
        exit();
    } else {
        $error = "Invalid Username or Password!";
    }
}
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login - Butterfly Badminton</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { 
            font-family: 'Poppins', 'Segoe UI', Arial, sans-serif; 
            margin: 0; 
            background: linear-gradient(135deg, #0f0c29 0%, #302b63 50%, #24243e 100%) !important;
            background-attachment: fixed !important;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            color: white;
        }

        .login-container { 
            flex: 1; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            padding: 40px 20px; 
        }

        /* Frosted Glass Login Box */
        form { 
            background: rgba(255, 255, 255, 0.08); 
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            padding: 40px; 
            border-radius: 20px; 
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 15px 35px rgba(0,0,0,0.4); 
            width: 100%; 
            max-width: 380px; 
            text-align: center;
        }

        h2 { 
            color: #fd79a8; 
            margin-bottom: 30px; 
            text-transform: uppercase; 
            letter-spacing: 2px;
            text-shadow: 0 0 10px rgba(253, 121, 168, 0.5);
        }

        label {
            display: block;
            text-align: left;
            margin-bottom: 5px;
            font-size: 0.85rem;
            color: #a29bfe;
            margin-left: 5px;
        }

        input[type="text"], input[type="password"] { 
            width: 100%; 
            padding: 12px 15px; 
            margin-bottom: 20px; 
            border: 1px solid rgba(255, 255, 255, 0.2); 
            border-radius: 10px; 
            background: rgba(255, 255, 255, 0.9);
            color: #333;
            font-size: 1rem;
            box-sizing: border-box;
            transition: 0.3s;
        }

        input[type="text"]:focus, input[type="password"]:focus {
            outline: none;
            border-color: #fd79a8;
            box-shadow: 0 0 10px rgba(253, 121, 168, 0.4);
        }

        /* Gradient Button */
        input[type="submit"] { 
            width: 100%; 
            padding: 15px; 
            background: linear-gradient(to right, #6c5ce7, #0984e3);
            color: white; 
            border: none; 
            border-radius: 10px; 
            cursor: pointer; 
            font-size: 1rem; 
            font-weight: bold; 
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: 0.4s;
            margin-top: 10px;
        }

        input[type="submit"]:hover { 
            background: #fd79a8; 
            box-shadow: 0 0 20px rgba(253, 121, 168, 0.6);
            transform: scale(1.02);
        }

        .error-msg { 
            color: #fff; 
            background: rgba(217, 83, 79, 0.6); 
            padding: 12px; 
            border-radius: 10px; 
            margin-bottom: 20px; 
            font-size: 0.9rem; 
            border: 1px solid #d9534f;
        }

        .footer-note {
            margin-top: 20px;
            font-size: 0.8rem;
            opacity: 0.7;
        }
    </style>
</head>
<body>
    <?php include('header.php'); ?>

    <div class="login-container">
        <form method="POST" action="">
            <i class="fas fa-butterfly" style="font-size: 40px; color: #fd79a8; margin-bottom: 15px;"></i>
            <h2>Member Login</h2>
            
            <?php if(isset($error)): ?>
                <div class="error-msg">
                    <i class="fas fa-exclamation-circle"></i> <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <label for="username">Username</label>
            <input type="text" name="username" id="username" required placeholder="Your username"> 
            
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required placeholder="Your password">
            
            <input type="submit" name="submit" value="Sign In">

            <div class="footer-note">
                Welcome back to the Butterfly Badminton Club
            </div>
        </form>
    </div>

    <?php include('footer.php'); ?>
</body>
</html>