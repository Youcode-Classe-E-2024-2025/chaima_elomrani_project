<?php
session_start();

require_once ("./config/connexion.php");
require_once ("./models/user.php");

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

    if (empty($errors)) {
        try {
            $user = new User($connexion);

            $user->name = $name;
            $user->email = $email;
            $user->password = $password;

            $result = $user->signup();

            if ($result === "Welcome to our site!") {
                $_SESSION['success_message'] = "Account created successfully. Please log in.";
                header(header: "Location: index.php?page=login_page");
                exit();
            } else {
                $errors[] = $result;
            }
        } catch (Exception $e) {
            $errors[] = "An unexpected error occurred. Please try again.";
            throw new Exception($e->getMessage());
        }
    }

    $_SESSION['signup_errors'] = $errors;
    $_SESSION['signup_name'] = $name;
    $_SESSION['signup_email'] = $email;

    header("Location: index.php?page=login_page");
    exit();
}
?>