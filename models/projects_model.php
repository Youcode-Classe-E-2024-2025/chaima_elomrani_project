<?php
require_once './config/connexion.php';

class Project
{
    public $conn;
    private $table = 'projects';

    public $name;
    public $description;
    public $due_date;
    public $type;

    public function __construct($db){
        $this->conn = $db;
    }

    public function displayProjects() {
        $query = "SELECT * FROM " . $this->table;
        $result = $this->conn->query($query);

        if (!$result) {
            error_log("Query failed: " . $this->conn->error);
            return [];
        }

        $projects = [];
        while ($row = $result->fetch_assoc()) {
            $projects[] = $row;
        }

        return $projects;
    }

    public function addProject()
    {
        $query = "INSERT INTO " . $this->table . " (name, description, due_date, type) VALUES (?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);

        if (!$stmt) {
            error_log('Prepare failed: ' . $this->conn->error);
            return false;
        }

        $stmt->bind_param("ssss", $this->name, $this->description, $this->due_date, $this->type);

        if ($stmt->execute()) {
            return true;
        }
        error_log('Execute failed: ' . $stmt->error);
        return false;
    }

    public function updateProject($id, $name, $description, $due_date){
        $query = "UPDATE projects SET name = ?, description = ?, due_date = ? WHERE id = ?";
        
        $stmt = $this->conn->prepare($query);
        
        if (!$stmt) {
            error_log('Prepare failed: ' . $this->conn->error);
            return false;
        }

        $stmt->bind_param("sssi", $name, $description, $due_date, $id);

        $result = $stmt->execute();

        if (!$result) {
            error_log('Execute failed: ' . $stmt->error);
            $stmt->close();
            return false;
        }

        $stmt->close();
        return true;
    }

    public function deleteProject($project_id)
    {
        $query = "DELETE FROM projects  WHERE id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $project_id);

        if ($stmt->execute()) {
            return true;
        }
        error_log('Execute failed: ' . $stmt->error);
        return false;
    }
}

$dbConnection = new mysqli('localhost', 'root', '', 'project_management');
$sendProject = new Project($dbConnection);

$viewProjects = new Project($dbConnection);
$projects = $viewProjects->displayProjects();
