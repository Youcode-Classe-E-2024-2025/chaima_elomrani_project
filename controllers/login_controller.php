<?php

require_once("../config/connexion.php");
require_once("../models/user.php");

$database = new Connexion();
$connexion = $database->getconnexion();

$user = new User($connexion);

if($_SERVER['REQUEST_METHOD'] === 'POST'){
   
    $user->email = htmlspecialchars(strip_tags($_POST['email']));
    $user->password = htmlspecialchars(strip_tags($_POST['password']));

    $result = $user -> login();

    if($result['status']=== 'success'){
        $_SESSION['user'] = $result['user'];

        header("Location: ../views/home.php");
        exit();
    }else{
        $_SESSION['login_error'] = $result['message'];
        header("Location: ../views/home.php");
        exit();
    }
}

?>
