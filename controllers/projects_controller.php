<?php
// session_start();
require_once './config/connexion.php';
require_once './models/projects_model.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newProject = new ProjectController();
    $newProject->createProject($_POST);
}

class ProjectController
{
    private $db;
    private $project;

    public function __construct()
    {
        $database = new connexion();
        $db = $database->getconnexion();
        $this->project = new Project($db);
    }

    public function createProject($data)
    {
        $this->project->name = $data['project-name'];
        $this->project->description = $data['project-description'];
        $this->project->type = $data['project-manager'];
        // $this->project->created_date = $data['created-date'];
        $this->project->due_date = $data['due-date'];
        $this->project->chef_id = 1;

        if ($this->project->addProject()) {
            header("Location: index.php?page=all_projects");
            return true;
        } else {
            header("Location: index.php?page=admin_home");
            return false;
        }
    }





    public function editProject()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $project_id = filter_input(INPUT_POST, $_POST['project_id'], FILTER_VALIDATE_INT);
                $project_name = filter_input(INPUT_POST, $_POST['project_name'], FILTER_SANITIZE_STRING);
                $project_description = filter_input(INPUT_POST, $_POST['project_description'], FILTER_SANITIZE_STRING);
                $due_date = filter_input(INPUT_POST, $_POST['project_due_date'], FILTER_SANITIZE_STRING);

                if ($project_id && $project_name) {
                    try {
                        $result = $this->project->updateProject($project_id, $project_name, $project_description, $due_date);
                        if ($result) {
                            header('Location :index.php?page:all_projects');
                        } else {
                            header('Location: index.php?page=error404');
                        }
                    } catch (Exception $e) {
                        error_log('project cant be updated' . $e->getMessage());
                        header('Location: index.php?page=error404');
                        exit();
                    }
                } else {
                    header('Location: index.php?page=error404');
                    exit();
                }
            }
        }
    }


}




if (isset($_GET['action']) && $_GET['action'] === 'update_task') {
    $updateProject = new ProjectController();
    $updateProject->editProject();
}