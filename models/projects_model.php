<?php
require_once("./config/connexion.php");

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
$dbConnection = new mysqli('localhost', 'root', '', 'project_management');
$sendProject = new sendProject($dbConnection);



class sendProject{
   
    private $conn;
    private $table ='projects';

    public $name;
    public $description;
    public $created_date;
    public $due_date;
    public $type;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function addProject (){
        $query = "INSERT INTO " . $this->table . " (name, description, created_date, due_date, type) VALUES (:project_name, :project_description, :created_date, :due_date, :project_type)";
        
        $stmt = $this->conn->prepare($query);

        $stmt-> bindParam(":project_name", $this->name);
        $stmt->bindParam(":project_description", $this->description);
        $stmt->bindParam(":created_date", $this->created_date);
        $stmt->bindParam(":due_date", $this->due_date);
        $stmt->bindParam(":project_type", $this->type);

        if($stmt->execute()){
            return true;
        }
        return false;

    }

}