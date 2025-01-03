<?php
require_once __DIR__ . '/../config/connexion.php';
require_once __DIR__ . '/../models/user.php';

class UserController {
    private $conn;
    private $user;

    public function __construct() {
        $database = new Connexion();
        $this->conn = $database->getconnexion();
        $this->user = new User($this->conn);
    }

    public function login($email, $password) {
        // Sanitize inputs
        $email = htmlspecialchars(strip_tags($email));
        $password = htmlspecialchars(strip_tags($password));

        // Set user properties
        $this->user->email = $email;
        $this->user->password = $password;

        // Attempt login
        return $this->user->login();
    }
}
?>
