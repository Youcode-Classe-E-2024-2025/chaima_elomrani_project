<?php
session_start(); 
require_once './config/connexion.php';
require_once './models/projects_model.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newProject = new ProjectController();
    $newProject->createProject($_POST);
}

class ProjectController { 
   private $db;
    private $project;

    public function __construct() {
        $database = new connexion();
        $db = $database->getconnexion();
        $this->project = new sendProject($db);
    }

    public function createProject($data) {
        $this->project->name = $data['project-name'];
        $this->project->description = $data['project-description'];
        $this->project->type = $data['project-manager'];
        $this->project->created_date = $data['created-date'];
        $this->project->due_date = $data['due-date'];
        $this->project->chef_id = 1; 

        if($this->project->addProject()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteProject($project_id) {
        // Validate project ID
        if (!is_numeric($project_id)) {
            return false;
        }

        // Create database connection
        $db = DatabaseConfig::getConnection();
        
        // Create project model instance
        $project = new sendProject($db);
        
        // Attempt to delete the project
        if ($project->deleteProject($project_id)) {
            // Redirect to all projects page with success message
            $_SESSION['message'] = "Project deleted successfully.";
            header("Location: index.php?page=all_projects");
            exit();
        } else {
            // Set error message if deletion fails
            $_SESSION['error'] = "Failed to delete project.";
            header("Location: index.php?page=all_projects");
            exit();
        }
    }
}
