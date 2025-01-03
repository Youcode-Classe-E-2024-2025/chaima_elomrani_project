<?php
require_once("../config/connexion.php");
require_once("../models/user.php");
require_once("../models/role.php");
require_once("UserController.php");

$database = new Connexion();
$connexion = $database->getconnexion();

$user = new User($connexion);
$userController = new UserController();
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        // Hardcoded admin check
        if ($email === 'chaima@gmail.com' && $password === 'chaima') {
            $_SESSION['user'] = [
                'email' => $email,
                'role' => 'admin'
            ];
            header('Location: ../views/admin_home.php');
            exit();
        }

        // Regular login process
        $loginResult = $userController->login($email, $password);
        
        if ($loginResult['success']) {
            $_SESSION['user'] = $loginResult['user'];
            header('Location: ../views/first_page.php');
            exit();
        } else {
            $_SESSION['login_error'] = $loginResult['message'];
            header('Location: ../views/login_page.php');
            exit();
        }
    } catch (Exception $e) {
        $_SESSION['login_error'] = $e->getMessage();
        header('Location: ../views/first_page.php');
        exit();
    }
}

?>
