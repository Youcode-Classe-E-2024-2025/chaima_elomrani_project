<?php
require_once './config/connexion.php';
require_once './controllers/projectMember.php';
require_once './controllers/projects_controller.php';
// require_once './controllers/projectMember.php';

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

    public function getProjectDetails($projectId) {
        try {
            $stmt = $this->conn->prepare("
                SELECT id, name, description, status, 
                       DATE_FORMAT(start_date, '%Y-%m-%d') as start_date, 
                       DATE_FORMAT(end_date, '%Y-%m-%d') as end_date 
                FROM projects 
                WHERE id = ?"
            );
            $stmt->bind_param("i", $projectId);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        } catch (Exception $e) {
            error_log("Error fetching project details: " . $e->getMessage());
            return null;
        }
    }

    public function getProjectTeamMembers($projectId) {
        try {
            $stmt = $this->conn->prepare("
                SELECT DISTINCT u.id, u.name, u.email 
                FROM users u
                JOIN team_members tm ON u.id = tm.user_id
                WHERE tm.project_id = ?"
            );
            $stmt->bind_param("i", $projectId);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (Exception $e) {
            error_log("Error fetching project team members: " . $e->getMessage());
            return [];
        }
    }

    public function getProjectTasks($projectId) {
        try {
            $stmt = $this->conn->prepare("
                SELECT id, title, status 
                FROM tasks 
                WHERE project_id = ?"
            );
            $stmt->bind_param("i", $projectId);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (Exception $e) {
            error_log("Error fetching project tasks: " . $e->getMessage());
            return [];
        }
    }
}

$dbConnection = new mysqli('localhost', 'root', '', 'project_management');
$sendProject = new Project($dbConnection);

$viewProjects = new Project($dbConnection);
$projects = $viewProjects->displayProjects();
