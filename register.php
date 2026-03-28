<?php
// register.php
session_start();
require_once 'config.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and valid input
    $username = trim($_POST["username"] ?? '');
    $email = trim($_POST["email"] ?? '');
    $password = trim($_POST["password"] ?? '');

    if ($username === '' || $email === '' || $password === '') {
        $_SESSION['register_error'] = "Please fill in all fields.";
        header("Location: index.php?action=register");
        exit;
    }
    
    // Check if email already exists (use fetch; rowCount() is not reliable for SELECT in PDO)
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    
    if ($stmt->fetch()) {
        // Email exists, redirect back to register form with an error
        $_SESSION['register_error'] = "This email is already registered.";
        header("Location: index.php?action=register");
        exit;
    } else {
        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $pdo->prepare($sql);
        
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $hashed_password, PDO::PARAM_STR);
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            // Redirect to login page with success message
            $_SESSION['register_success'] = "Registration completed successfully. You can now login.";
            header("Location: index.php?action=login");
            exit;
        } else{
            $_SESSION['register_error'] = "Oops! Something went wrong. Please try again later.";
            header("Location: index.php?action=register");
            exit;
        }
    }
} else {
    // Force redirect back if directly accessed
    header("Location: index.php?action=register");
    exit;
}
?>
