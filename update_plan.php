<?php
session_start();
include('includes/dbconnect.php'); 

if (isset($_GET['tier']) && isset($_SESSION['login_member'])) {
    $plan = $_GET['tier'];
    $user = $_SESSION['login_member'];

    
    $sql = "UPDATE members SET membershipType = '$plan' WHERE username = '$user'";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Success! You are now a $plan member.'); window.location.href='booking.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header("Location: login.php");
}
?>