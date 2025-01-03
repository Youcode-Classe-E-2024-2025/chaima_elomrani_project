<?php
include("../config/connexion.php");

class ViewProjects {
    private $conn;

    public function __construct($host, $username, $password, $dbname) {
        $this->conn = new mysqli($host, $username, $password, $dbname);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function displayProjects() {
        $sql = "SELECT name, description, created_date , due_date FROM projects"; // Correction : 'decription' devient 'description'
        $result = $this->conn->query($sql);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }

    public function __destruct() {
        $this->conn->close();
    }
}

// Instanciation de la classe et affichage des projets
$db = new ViewProjects('localhost', 'root', '', 'project_management');
$projects = $db->displayProjects();

