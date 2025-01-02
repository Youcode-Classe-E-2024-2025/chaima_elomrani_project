<?php

class Connexion
{
    private $host = "localhost";
    private $db = "project_management";
    private $username = "root";
    private $password = "";
    private $conn;

    public function getconnexion(): PDO {
        $this->conn = null;

        try {
            // Fix the PDO connection string
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Remove debug echo
            // echo "safe rah tconnecta";
        } catch (PDOException $e) {
            // Throw exception instead of echoing
            throw new Exception("Database connection failed: " . $e->getMessage());
        }

        return $this->conn;
    }
}
?>