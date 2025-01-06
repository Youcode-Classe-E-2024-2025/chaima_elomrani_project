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
        $this->project = new Project($db);
    }

    public function createProject($data) {
        $this->project->name = $data['project-name'];
        $this->project->description = $data['project-description'];
        $this->project->type = $data['project-manager'];
        $this->project->created_date = $data['created-date'];
        $this->project->due_date = $data['due-date'];
        $this->project->chef_id = 1; 

        if($this->project->addProject()) {
            header("Location: index.php?page=all_projects");
            return true;
        } else {
            header("Location: index.php?page=admin_home");
            return false;
        }
    }

   
}
