<?php
session_start();
include('includes/dbconnect.php');


$type = $_POST['payment_type'];
$user = $_SESSION['login_member'];
$sql  = ""; 


if ($type == 'membership') {
    $tier = mysqli_real_escape_string($conn, $_POST['tier']);
    
    $sql = "UPDATE members SET membershipType = '$tier' WHERE username = '$user'";
} 
else if ($type == 'booking') {
    $court = mysqli_real_escape_string($conn, $_POST['court']);
    $date  = mysqli_real_escape_string($conn, $_POST['date']);
    $time  = mysqli_real_escape_string($conn, $_POST['time']);
    
    
    $sql = "INSERT INTO booking (username, courtID, bookingDate, timeSlot) 
            VALUES ('$user', '$court', '$date', '$time')";
}


if ($sql != "") {
    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('Payment Successful! Your " . ($type == 'booking' ? 'booking' : 'membership') . " is confirmed.'); 
                window.location.href='index.php';
              </script>";
    } else {
        echo "Error updating database: " . mysqli_error($conn);
    }
} else {
    echo "Invalid payment request.";
}
?>