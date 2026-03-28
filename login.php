<?php
// login.php
session_start();
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    
    if(empty($email) || empty($password)){
        $_SESSION['login_error'] = "Please enter both email and password.";
        header("Location: index.php?action=login");
        exit;
    }
    
    // Prepare a select statement
    $sql = "SELECT id, username, email, password FROM users WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    
    // Bind variables
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Use fetch result only; rowCount() for SELECT is not reliable across PDO drivers
    if ($row && password_verify($password, $row['password'])) {
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['email'] = $row['email'];
        header("Location: dashboard.php");
        exit;
    }

    $_SESSION['login_error'] = "Invalid email or password.";
    header("Location: index.php?action=login");
    exit;
} else {
    // Force redirect back if directly accessed
    header("Location: index.php?action=login");
    exit;
}
?>
