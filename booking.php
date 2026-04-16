<?php
session_start();
include('includes/dbconnect.php'); 

if (!isset($_SESSION['login_member'])) {
    header("Location: login.php");
    exit();
}

// Logic to handle selections and database checks
$selCourt = isset($_POST['courtID']) ? $_POST['courtID'] : '';
$selDate = isset($_POST['bookingDate']) ? $_POST['bookingDate'] : '';

$bookedSlots = [];
if ($selCourt != '' && $selDate != '') {
    $selCourtEsc = mysqli_real_escape_string($conn, $selCourt);
    $selDateEsc = mysqli_real_escape_string($conn, $selDate);
    
    $sql = "SELECT timeSlot FROM booking WHERE courtID = '$selCourtEsc' AND bookingDate = '$selDateEsc'";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)) {
        $bookedSlots[] = trim($row['timeSlot']); 
    }
}

$slots = [
    "08:00:00" => "08:00 AM - 09:00 AM",
    "09:00:00" => "09:00 AM - 10:00 AM",
    "10:00:00" => "10:00 AM - 11:00 AM",
    "15:00:00" => "03:00 PM - 04:00 PM",
    "16:00:00" => "04:00 PM - 05:00 PM",
    "17:00:00" => "05:00 PM - 06:00 PM",
    "18:00:00" => "06:00 PM - 07:00 PM",
    "19:00:00" => "07:00 PM - 08:00 PM",
    "20:00:00" => "08:00 PM - 09:00 PM",
    "21:00:00" => "09:00 PM - 10:00 PM"
];
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Book a Court - Butterfly Badminton</title>
    <style>
        body { 
            font-family: 'Poppins', 'Segoe UI', Arial, sans-serif; 
            margin: 0; 
            /* Your exact colors from the previous code */
            background: linear-gradient(135deg, #0f0c29 0%, #302b63 50%, #24243e 100%);
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: #ffffff;
        }

        .booking-container { 
            max-width: 500px; 
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

        label { display: block; margin-top: 15px; color: #fff; font-weight: 500; }

        select, input[type="date"] { 
            width: 100%; 
            padding: 12px; 
            margin-top: 8px; 
            border-radius: 8px; 
            border: 1px solid rgba(255, 255, 255, 0.3);
            background: rgba(255, 255, 255, 0.9); 
            color: #333; 
            box-sizing: border-box;
            font-size: 1rem;
        }

        .btn-submit { 
            width: 100%; 
            padding: 15px; 
            background: linear-gradient(to right, #6c5ce7, #0984e3);
            color: white; 
            border: none; 
            font-weight: bold; 
            cursor: pointer; 
            margin-top: 30px; 
            border-radius: 8px;
            transition: all 0.4s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 4px 15px rgba(108, 92, 231, 0.4);
        }

        .btn-submit:hover { 
            background: #fd79a8; 
            box-shadow: 0 0 20px rgba(253, 121, 168, 0.8);
            transform: translateY(-2px);
        }

        option:disabled { background-color: #ddd; color: #888; font-style: italic; }

        .back-link { text-align: center; margin-top: 25px; }
        .back-link a { color: #fd79a8; text-decoration: none; font-weight: bold; }
        .back-link a:hover { text-decoration: underline; }
    </style>
</head>

<body>
    <?php include('header.php'); ?>

    <div class="booking-container">
        <h1>Book a Court</h1>
        <p>Welcome, <?php echo htmlspecialchars($_SESSION['login_member']); ?>!</p>

        <form action="" method="POST" id="bookingForm">
            <label>Select Court:</label>
            <select name="courtID" required onchange="this.form.submit()">
                <option value="">-- Choose a Court --</option>
                <option value="Court 1" <?php if($selCourt == 'Court 1') echo 'selected'; ?>>Court 1 (Standard)</option>
                <option value="Court 2" <?php if($selCourt == 'Court 2') echo 'selected'; ?>>Court 2 (Standard)</option>
                <option value="Court 3" <?php if($selCourt == 'Court 3') echo 'selected'; ?>>Court 3 (Premium)</option>
            </select>

            <label>Select Date:</label>
            <input type="date" name="bookingDate" value="<?php echo $selDate; ?>" required onchange="this.form.submit()">

            <label>Time Slot:</label>
            <select name="timeSlot" id="timeSlot" required <?php if(!$selDate || !$selCourt) echo 'disabled'; ?>>
                <option value="">-- Select Time --</option>
                <?php 
                foreach($slots as $dbValue => $displayLabel) {
                    $isBooked = in_array($dbValue, $bookedSlots);
                    $disabled = $isBooked ? 'disabled' : '';
                    $label = $isBooked ? $displayLabel . " (BOOKED)" : $displayLabel;
                    
                    echo "<option value='$dbValue' $disabled>$label</option>";
                }
                ?>
            </select>

            <input type="button" value="Confirm My Booking" class="btn-submit" onclick="finalSubmit()">
        </form>
        
        <div class="back-link">
            <a href="index.php">Back to Home</a>
        </div>
    </div>

    <script>
    function finalSubmit() {
    var court = document.getElementsByName('courtID')[0].value;
    var date = document.getElementsByName('bookingDate')[0].value;
    var time = document.getElementById('timeSlot').value;
    
    if(court == "" || date == "" || time == "") {
        alert("Please complete all selection fields!");
        return;
    }

    // Pass the court, date, and time to payment.php
    window.location.href = "payment.php?type=booking&court=" + court + "&date=" + date + "&time=" + time;
}
    </script>
    <?php include('footer.php'); ?>
</body>
</html>