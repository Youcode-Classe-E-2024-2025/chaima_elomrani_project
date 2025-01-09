<?php

class Connexion
{
    private $host = "localhost";
    private $db = "project_management";
    private $username = "root";
    private $password = "";
    private $conn;

    public function getconnexion() {
        // Create mysqli connection
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db);

        // Check connection
        if ($this->conn->connect_error) {
            throw new Exception("Database connection failed: " . $this->conn->connect_error);
        }

        return $this->conn;
    }
}

// Create a global database connection
$database = (new Connexion())->getconnexion();
?>