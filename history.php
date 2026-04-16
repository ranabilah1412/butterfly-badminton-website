<?php
session_start();
include('includes/dbconnect.php');

if (!isset($_SESSION['login_member'])) {
    header("Location: login.php");
    exit();
}

$currentUser = $_SESSION['login_member'];

$sql = "SELECT * FROM booking WHERE username = '$currentUser' ORDER BY bookingDate DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>My Booking History - Butterfly Badminton</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* EXACT CSS FROM YOUR PREVIOUS CODE */
        body { 
            font-family: 'Poppins', 'Segoe UI', Arial, sans-serif; 
            margin: 0; 
            background: linear-gradient(135deg, #0f0c29 0%, #302b63 50%, #24243e 100%);
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: #ffffff;
        }

        .booking-container { 
            max-width: 800px; /* Slightly wider for the table */
            margin: 50px auto; 
            background: rgba(255, 255, 255, 0.1); 
            backdrop-filter: blur(15px); 
            padding: 40px; 
            border-radius: 20px; 
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.5);
        }

        h1 { 
            text-align: center; 
            color: #fd79a8; 
            text-transform: uppercase;
            letter-spacing: 2px;
            text-shadow: 0 0 10px rgba(253, 121, 168, 0.5);
            margin-bottom: 5px;
        }

        p { text-align: center; color: #a29bfe; margin-bottom: 30px; }

        /* Table Styling adjusted to fit the theme */
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 20px;
            background: rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            overflow: hidden;
        }

        th, td { 
            padding: 15px; 
            text-align: left; 
            border-bottom: 1px solid rgba(255, 255, 255, 0.1); 
        }

        th { 
            background-color: rgba(108, 92, 231, 0.3); 
            color: #fd79a8; 
        }

        .back-link { text-align: center; margin-top: 25px; }
        .back-link a { color: #fd79a8; text-decoration: none; font-weight: bold; }
        .back-link a:hover { text-decoration: underline; }
    </style>
</head>
<body>

<?php include('header.php'); ?>

<div class="booking-container">
    <h1>My History</h1>
    <p>Welcome back, <?php echo htmlspecialchars($currentUser); ?>!</p>

    <table>
        <thead>
            <tr>
                <th>Court</th>
                <th>Date</th>
                <th>Time Slot</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['courtID']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['bookingDate']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['timeSlot']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3' style='text-align:center;'>No bookings found. <a href='booking.php' style='color:#fd79a8;'>Book now!</a></td></tr>";
            }
            ?>
        </tbody>
    </table>

    <div class="back-link">
        <a href="index.php">Back to Home</a>
    </div>
</div>

<?php include('footer.php'); ?>

</body>
</html>