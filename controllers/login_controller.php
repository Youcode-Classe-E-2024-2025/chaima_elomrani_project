<?php
require_once("./config/connexion.php");
require_once("./models/user.php");
require_once("./models/role.php");
require_once("./controllers/UserController.php");


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
                'role' => 'admin',
                'id'=> '1',
            ];
            header('Location: index.php?page=admin_home');
            exit();
        }

        // Regular login process
        $loginResult = $userController->login($email, $password);
        
        if ($loginResult['status']) {
            $_SESSION['user'] = $loginResult['user'];
            $_SESSION['user_id'] = $loginResult['id'];
            header('Location:index.php');
            exit();
        } else {
            $_SESSION['login_error'] = $loginResult['message'];
            header('Location: index.php?page=login_page');
            exit();
        }
    } catch (Exception $e) {
        $_SESSION['login_error'] = $e->getMessage();
        var_dump($_SESSION);
        exit();
    }
} 



