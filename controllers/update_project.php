<?php
require_once('./config/connexion.php');
require_once('./models/projects_model.php');

class UpdateProjectController {
    private $projectModel;

    public function __construct() {
        global $database;
        $this->projectModel = new Project($database);
    }

    public function updateProject() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate and sanitize inputs
            $project_id = filter_input(INPUT_POST, 'project_id', FILTER_VALIDATE_INT);
            $project_name = filter_input(INPUT_POST, 'project_name', FILTER_SANITIZE_STRING);
            $project_description = filter_input(INPUT_POST, 'project_description', FILTER_SANITIZE_STRING);
            $project_due_date = filter_input(INPUT_POST, 'due_date', FILTER_SANITIZE_STRING);

            // Additional validation
            if (!$project_id || !$project_name || !$project_description || !$project_due_date) {
                error_log('Invalid input for project update');
                header('Location: index.php?page=all_projects&update=invalid');
                exit();
            }

            try {
                $result = $this->projectModel->updateProject(
                    $project_id, 
                    $project_name, 
                    $project_description, 
                    $project_due_date
                );

                if ($result) {
                    // Redirect with success message
                    header('Location: index.php?page=all_projects&update=success');
                    exit();
                } else {
                    // Redirect with error message
                    header('Location: index.php?page=all_projects&update=failed');
                    exit();
                }
            } catch (Exception $e) {
                // Log the error and redirect
                error_log('Project Update Error: ' . $e->getMessage());
                header('Location: index.php?page=all_projects&update=error');
                exit();
            }
        }
    }
}

// Handle the update project action
if (isset($_GET['action']) && $_GET['action'] === 'update_project') {
    $updateProjectController = new UpdateProjectController();
    $updateProjectController->updateProject();
}
?>
