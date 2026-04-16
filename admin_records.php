<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include('includes/dbconnect.php'); 

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}


$currentMonth = date('m');
$currentYear = date('Y');

$revenue_query = mysqli_query($conn, "SELECT 
    SUM(CASE WHEN courtID = 'Court 3' THEN 30 ELSE 20 END) as total_revenue,
    COUNT(*) as total_bookings
    FROM booking 
    WHERE MONTH(bookingDate) = '$currentMonth' AND YEAR(bookingDate) = '$currentYear'");

$rev_data = mysqli_fetch_assoc($revenue_query);
$monthly_revenue = $rev_data['total_revenue'] ?? 0;
$monthly_bookings = $rev_data['total_bookings'] ?? 0;


$year_rev_query = mysqli_query($conn, "SELECT 
    SUM(CASE WHEN courtID = 'Court 3' THEN 30 ELSE 20 END) as year_revenue
    FROM booking 
    WHERE YEAR(bookingDate) = '$currentYear'");
$year_revenue = mysqli_fetch_assoc($year_rev_query)['year_revenue'] ?? 0;

include('header.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Financial Overview - Butterfly Badminton</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { 
            font-family: 'Poppins', sans-serif; 
            background: linear-gradient(135deg, #0f0c29 0%, #302b63 50%, #24243e 100%) !important;
            background-attachment: fixed !important;
            color: #ffffff;
            margin: 0;
        }

        .admin-body { padding: 40px 5%; }
        
        /* Stats Bar */
        .stats-container { display: flex; gap: 20px; margin-bottom: 40px; }
        .stat-card { 
            flex: 1; 
            background: rgba(255, 255, 255, 0.1); 
            backdrop-filter: blur(15px);
            padding: 25px; 
            border-radius: 20px; 
            text-align: center; 
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .stat-card h3 { margin: 0; font-size: 0.8rem; color: #a29bfe; text-transform: uppercase; }
        .stat-card p { margin: 10px 0 0; font-size: 1.8rem; font-weight: bold; color: #fd79a8; }
        .revenue-highlight { border-bottom: 4px solid #00b894 !important; }

        /* Table Area */
        .admin-card { 
            background: rgba(255, 255, 255, 0.05); 
            backdrop-filter: blur(10px);
            padding: 30px; 
            border-radius: 20px; 
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background: rgba(108, 92, 231, 0.3); color: #fd79a8; padding: 15px; text-align: left; font-size: 0.8rem; }
        td { padding: 15px; border-bottom: 1px solid rgba(255, 255, 255, 0.1); }

        .status-paid { 
            background: #00b894; 
            color: white; 
            padding: 4px 10px; 
            border-radius: 12px; 
            font-size: 0.7rem; 
            font-weight: bold; 
        }
        .price-text { color: #00b894; font-weight: bold; }
    </style>
</head>
<body>

<div class="admin-body">
    <h1 style="text-align:center; color:#fd79a8;">BUTTERFLY REVENUE TRACKER</h1>
    
    <div class="stats-container">
        <div class="stat-card">
            <h3>Bookings (This Month)</h3>
            <p><?php echo $monthly_bookings; ?></p>
        </div>
        <div class="stat-card revenue-highlight">
            <h3>Revenue (This Month)</h3>
            <p>RM <?php echo number_format($monthly_revenue, 2); ?></p>
        </div>
        <div class="stat-card">
            <h3>Total Revenue (<?php echo date('Y'); ?>)</h3>
            <p>RM <?php echo number_format($year_revenue, 2); ?></p>
        </div>
    </div>

    <div class="admin-card">
        <h2>Recent Transactions</h2>
        <table>
            <thead>
                <tr>
                    <th>Member</th>
                    <th>Court</th>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Payment Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM booking ORDER BY bookingDate DESC";
                $result = mysqli_query($conn, $sql);

                while($row = mysqli_fetch_assoc($result)) {
                    $fee = ($row['courtID'] == 'Court 3') ? 30 : 20;
                    echo "<tr>
                            <td><strong>" . htmlspecialchars($row['username']) . "</strong></td>
                            <td>" . htmlspecialchars($row['courtID']) . "</td>
                            <td>" . $row['bookingDate'] . "</td>
                            <td class='price-text'>RM " . number_format($fee, 2) . "</td>
                            <td><span class='status-paid'>PAID</span></td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include('footer.php'); ?>
</body>
</html>