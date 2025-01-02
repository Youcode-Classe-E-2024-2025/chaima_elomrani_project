<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProManage - Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/login.css">
   
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h1>Welcome Back</h1>
            <p>Log in to your ProManage account</p>
        </div>
        <form class="login-form">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="login-btn">Log In</button>
        </form>
        <div class="forgot-password">
            <a href="#">Forgot your password?</a>
        </div>
        <div class="signup-link">
            <p>Don't have an account? <a href="signup.php">Sign up</a></p>
        </div>
    </div>

    <script>
        document.querySelector('.login-form').addEventListener('submit', function(e) {
            e.preventDefault();
            // Add your login logic here
            console.log('Login form submitted');
        });
    </script>
</body>
</html>

