<?php 

session_start();
if (isset($_SESSION['userId']) && !empty(trim($_SESSION['userId']))) {
  header('Location: index.php'); // Redirect to the index page
  // echo "helloooo. ".$_SESSION['userId'];
    exit(); // Stop further execution
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Login Page</title>
</head>
<body>
    <nav class="navbar">
        <img src="images/logo333.png" alt="Logo" class="logo">
        <button class="signin-button" onclick="window.location.href = 'register.php'">Sign Up</button>
    </nav>
    
    <div class="login-container">
        <form class="login-form" action="signin.php" method="POST">
            <h1 class="login-heading">Welcome Back!</h1>
            <input type="text" placeholder="Email" name="email" class="login-input" required>
            <input type="password" placeholder="Password" name="password" class="login-input" required>
            <div class="remember-me-container">
                <input type="checkbox" id="remember-me" class="remember-checkbox">
                <label for="remember-me" class="remember-label">Remember me</label>
            </div>
            <button type="submit" class="login-button">Login</button>
            <p class="forgot-password">Forgot Password?</p>
        </form>
    </div>
</body>
</html>
