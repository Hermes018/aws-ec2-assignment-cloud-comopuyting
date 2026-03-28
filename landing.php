<?php
// Test landing page (assignment demo entry). User data is collected on Login / Register.
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo Landing — User data → MySQL</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <ul class="circles">
        <li></li><li></li><li></li><li></li><li></li>
    </ul>

    <div class="auth-container landing-panel">
        <div class="landing-inner">
            <h1>Cloud user signup demo</h1>
            <p>
                This is a test landing page. Registrations store username, email, and a password hash in MySQL.
                Use the link below to open the form, then confirm the row in your database (phpMyAdmin, RDS query editor, or <code style="color:#fff;">mysql</code> CLI).
            </p>
            <a href="index.php" class="btn landing-btn">Go to login</a>
            <a href="index.php?action=register" class="btn landing-btn landing-btn-secondary">Go to registration</a>
        </div>
    </div>

</body>
</html>
