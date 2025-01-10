<?php

class Connexion
{
    private $host = "localhost";
    private $db = "project_management";
    private $username = "root";
    private $password = "";
    private $conn;

    public function getconnexion() {
        try {
            $pdo = new PDO(
                "mysql:host=localhost;dbname=project_management",
                "root",
                "",
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
            return $pdo;
        } catch (PDOException $e) {
            error_log("Erreur de connexion: " . $e->getMessage());
            die("Erreur de connexion à la base de données");
        }
    }
}

$database = (new Connexion())->getconnexion();
?>