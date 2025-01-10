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
        try {
            $stmt = $this->conn->query($query);

            if (!$stmt) {
                error_log("Query failed: " . implode(', ', $this->conn->errorInfo()));
                return [];
            }

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('PDO Exception: ' . $e->getMessage());
            return [];
        }
    }

    public function addProject()
    {
        $query = "INSERT INTO " . $this->table . " (name, description, due_date, type) VALUES (:name, :description, :due_date, :type)";

        try {
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':name', $this->name, PDO::PARAM_STR);
            $stmt->bindParam(':description', $this->description, PDO::PARAM_STR);
            $stmt->bindParam(':due_date', $this->due_date, PDO::PARAM_STR);
            $stmt->bindParam(':type', $this->type, PDO::PARAM_STR);

            if ($stmt->execute()) {
                return true;
            }
            error_log('Execute failed: ' . implode(', ', $stmt->errorInfo()));
            return false;
        } catch (PDOException $e) {
            error_log('PDO Exception: ' . $e->getMessage());
            return false;
        }
    }

    public function updateProject($id, $name, $description, $due_date){
        $query = "UPDATE projects SET name = :name, description = :description, due_date = :due_date WHERE id = :id";
        
        try {
            $stmt = $this->conn->prepare($query);
            
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':due_date', $due_date, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            $result = $stmt->execute();

            if (!$result) {
                error_log('Execute failed: ' . implode(', ', $stmt->errorInfo()));
                return false;
            }

            return true;
        } catch (PDOException $e) {
            error_log('PDO Exception: ' . $e->getMessage());
            return false;
        }
    }

    public function deleteProject($project_id)
    {
        $query = "DELETE FROM projects WHERE id = :id";

        try {
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $project_id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                return true;
            }
            error_log('Execute failed: ' . implode(', ', $stmt->errorInfo()));
            return false;
        } catch (PDOException $e) {
            error_log('PDO Exception: ' . $e->getMessage());
            return false;
        }
    }

    public function getProjectDetails($projectId) {
        try {
            $stmt = $this->conn->prepare("
                SELECT id, name, description, status, 
                       DATE_FORMAT(start_date, '%Y-%m-%d') as start_date, 
                       DATE_FORMAT(end_date, '%Y-%m-%d') as end_date 
                FROM projects 
                WHERE id = :id"
            );
            $stmt->bindParam(':id', $projectId, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
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
                WHERE tm.project_id = :id"
            );
            $stmt->bindParam(':id', $projectId, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            error_log("Error fetching project team members: " . $e->getMessage());
            return [];
        }
    }

    public function getProjectTasks($projectId) {
        try {
            $stmt = $this->conn->prepare("
                SELECT id, title, status 
                FROM tasks 
                WHERE project_id = :id"
            );
            $stmt->bindParam(':id', $projectId, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            error_log("Error fetching project tasks: " . $e->getMessage());
            return [];
        }
    }
}

$dbConnection = new PDO('mysql:host=localhost;dbname=project_management', 'root', '');
$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sendProject = new Project($dbConnection);

$viewProjects = new Project($dbConnection);
$projects = $viewProjects->displayProjects();