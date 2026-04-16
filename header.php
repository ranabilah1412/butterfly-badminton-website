<nav style="background: #a29bfe; padding: 10px 20px; color: white; font-family: Arial; display: flex; align-items: center; justify-content: space-between;">
    
    <div style="display: flex; align-items: center;">
        <a href="index.php">
            <img src="logo.png.png" alt="Logo" width="38" height="44" style="height: 40px; width: auto; margin-right: 25px; vertical-align: middle;">
        </a>

        <a href="index.php" style="color: black; margin-right: 20px; text-decoration: none;">Home</a>
        <a href="booking.php" style="color: black; margin-right: 20px; text-decoration: none;">Book Now</a>
        <a href="history.php" style="color: black; margin-right: 20px; text-decoration: none;">My History</a>
        <a href="about.php" style="color: black; margin-right: 20px; text-decoration: none;">About Us</a>
        <a href="plans.php" style="color: black; margin-right: 20px; text-decoration: none;">Plans</a>
    </div>

    <div>
      <?php if(isset($_SESSION['login_member'])): ?>
      <span>
                Hello, <strong><?php echo $_SESSION['login_member']; ?></strong>! 
      <a href="logout.php" style="color: black; margin-left: 15px; text-decoration: none;">Logout</a>
      </span>
      <?php else: ?>
      <a href="login.php" style="color: black; text-decoration: none;">Login</a>
      <?php endif; ?>
    </div>
</nav>