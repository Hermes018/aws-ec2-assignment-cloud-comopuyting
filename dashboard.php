<?php
// dashboard.php
session_start();

// Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])){
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Use Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        /* Specific overrides for the dashboard expanding */
        .dashboard-container {
            width: 600px;
            height: auto;
            padding: 40px;
            text-align: center;
        }
        .dashboard-container h1 {
            color: #fff;
            font-size: 32px;
            margin-bottom: 20px;
        }
        .dashboard-container p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 18px;
            margin-bottom: 30px;
        }
        .user-info {
            background: rgba(0, 0, 0, 0.2);
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
            text-align: left;
        }
        .user-info strong {
            color: #fff;
        }
        .user-info span {
            color: rgba(255, 255, 255, 0.9);
            display: block;
            margin-bottom: 10px;
        }
        .logout-btn {
            background: #ff4757;
            color: #fff;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 30px;
            font-weight: 600;
            display: inline-block;
            transition: all 0.3s ease;
        }
        .logout-btn:hover {
            background: #ff6b81;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 71, 87, 0.3);
        }
    </style>
</head>
<body>

    <!-- Animated background shapes -->
    <ul class="circles">
        <li></li><li></li><li></li><li></li><li></li>
    </ul>

    <div class="auth-container dashboard-container">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
        <p>You have successfully logged into the system.</p>
        
        <div class="user-info">
            <strong>Your Profile Details:</strong><br><br>
            <span>User ID: <?php echo htmlspecialchars($_SESSION['user_id']); ?></span>
            <span>Username: <?php echo htmlspecialchars($_SESSION['username']); ?></span>
            <span>Email: <?php echo htmlspecialchars($_SESSION['email']); ?></span>
        </div>
        
        <a href="logout.php" class="logout-btn">Log Out</a>
    </div>

</body>
</html>
