<?php
session_start();

include ("../config/connexion.php");
include ("../models/user.php");

// Initialize variables
$name = "";
$email = "";
$password = "";
$errors = [];

// Initialize database connection
$database = new Connexion();
$connexion = $database->getconnexion();

// Handle signup request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate inputs
    $name = htmlspecialchars(trim($_POST['name'] ?? ''));
    $email = htmlspecialchars(trim($_POST['email'] ?? ''));
    $password = trim($_POST['password'] ?? '');
    $confirm_password = trim($_POST['confirm_password'] ?? '');

    // Validation checks
    if (empty($name)) {
        $errors[] = "Name is required";
    }

    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    if (empty($password)) {
        $errors[] = "Password is required";
    } elseif (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters long";
    }

    if (empty($confirm_password)) {
        $errors[] = "Please confirm your password";
    } elseif ($password !== $confirm_password) {
        $errors[] = "Passwords do not match";
    }

    // If no errors, proceed with signup
    if (empty($errors)) {
        try {
            // Create user object
            $user = new User($connexion);

            // Set user properties
            $user->name = $name;
            $user->email = $email;
            $user->password = $password;

            // Attempt signup
            $result = $user->signup();

            // Check signup result
            if ($result === "Welcome to our site!") {
                // Successful signup
                $_SESSION['success_message'] = "Account created successfully. Please log in.";
                header("Location: ../views/login_page.php");
                exit();
            } else {
                // Signup failed
                $errors[] = $result;
            }
        } catch (Exception $e) {
            // Handle unexpected errors
            error_log("Signup error: " . $e->getMessage());
            $errors[] = "An unexpected error occurred. Please try again.";
        }
    }

    // If there are errors, store them in session to display on signup page
    $_SESSION['signup_errors'] = $errors;
    $_SESSION['signup_name'] = $name;
    $_SESSION['signup_email'] = $email;

    // Redirect back to signup page
    header("Location: login_page.php");
    exit();
}
?>