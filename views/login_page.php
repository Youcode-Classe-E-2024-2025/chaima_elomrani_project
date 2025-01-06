<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProManage - Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./styles/login.css">
   
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h1>Welcome Back</h1>
            <p>Log in to your ProManage account</p>
        </div>
        <form class="login-form" action="index.php?action=login_controller" method="POST">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <?php 
            if(isset($_SESSION['success_message'])) {
                echo '<div class="success-message">' . htmlspecialchars($_SESSION['success_message']) . '</div>';
                unset($_SESSION['success_message']);
            }
            if(isset($_SESSION['login_error'])) {
                echo '<div class="error-message">' . htmlspecialchars($_SESSION['login_error']) . '</div>';
                unset($_SESSION['login_error']);
            }
            ?>
            <button type="submit" class="login-btn">Log In</button>
        </form>
        <div class="forgot-password">
                <a href="#">Forgot your password?</a>
        </div>
        <div class="signup-link">
            <p>Don't have an account? <a href="index.php?page=signup">Sign up</a></p>
        </div>
    </div>

  
</body>
</html>
