<?php

require_once '../config/connexion.php';
require_once '../models/projects_model.php';

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
        $this->project->chef_id = $_SESSION['user_id']; // Assuming you have user authentication in place

        if($this->project->create()) {
            return true;
        } else {
            return false;
        }
    }
}

var_dump($_POST);