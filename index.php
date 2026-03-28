<?php
session_start();
// Redirect to dashboard if the user is already logged in
if(isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Authentication System</title>
    <!-- Use Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- Animated background shapes -->
    <ul class="circles">
        <li></li><li></li><li></li><li></li><li></li>
    </ul>

    <!-- Main Auth Container -->
    <!-- The 'active' class determines whether to show Login or Registration first -->
    <div class="auth-container <?php echo (isset($_GET['action']) && $_GET['action'] == 'register') ? 'active' : ''; ?>" id="auth-container">
        
        <!-- Login Form -->
        <div class="form-box login">
            <h2>Welcome Back</h2>
            
            <?php
            // Display login errors if any
            if(isset($_SESSION['login_error'])) {
                echo '<div class="message error">' . htmlspecialchars($_SESSION['login_error']) . '</div>';
                unset($_SESSION['login_error']);
            }
            // Display registration success message if redirected from register.php
            if(isset($_SESSION['register_success'])) {
                echo '<div class="message success">' . htmlspecialchars($_SESSION['register_success']) . '</div>';
                unset($_SESSION['register_success']);
            }
            ?>

            <form action="login.php" method="POST">
                <div class="input-box">
                    <input type="email" name="email" placeholder="Email Address" required>
                </div>
                <div class="input-box">
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <button type="submit" class="btn">Login</button>
                <div class="switch-form">
                    Don't have an account? <a onclick="toggleForm()">Register</a>
                </div>
            </form>
        </div>

        <!-- Register Form -->
        <div class="form-box register">
            <h2>Create Account</h2>

            <?php
            // Display registration errors (e.g., email already exists)
            if(isset($_SESSION['register_error'])) {
                echo '<div class="message error">' . htmlspecialchars($_SESSION['register_error']) . '</div>';
                unset($_SESSION['register_error']);
            }
            ?>

            <form action="register.php" method="POST">
                <div class="input-box">
                    <input type="text" name="username" placeholder="Username" required autocomplete="off">
                </div>
                <div class="input-box">
                    <input type="email" name="email" placeholder="Email Address" required autocomplete="off">
                </div>
                <div class="input-box">
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <button type="submit" class="btn">Register</button>
                <div class="switch-form">
                    Already have an account? <a onclick="toggleForm()">Login here</a>
                </div>
            </form>
        </div>

    </div>

    <nav class="page-subnav" aria-label="Secondary">
        <a href="landing.php">← Back to landing page</a>
    </nav>

    <!-- Script to toggle between forms visually -->
    <script>
        function toggleForm() {
            const container = document.getElementById('auth-container');
            container.classList.toggle('active');
            
            // Clean up the URL parameters when visually switching forms so reloading works smoothly
            if(container.classList.contains('active')) {
                window.history.pushState({}, '', '?action=register');
            } else {
                window.history.pushState({}, '', '?action=login');
            }
        }
    </script>
</body>
</html>
