<?php
session_start();
include('includes/dbconnect.php');

$user = $_SESSION['login_member'];

$court = $_POST['courtID'];
$date = $_POST['bookingDate'];
$time = $_POST['timeSlot'];

$sql = "INSERT INTO booking (username, courtID, bookingDate, timeSlot) 
        VALUES ('$user', '$court', '$date', '$time')";

if (mysqli_query($conn, $sql)) {
    echo "<script>alert('Booking Successful!'); window.location.href='history.php';</script>";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>