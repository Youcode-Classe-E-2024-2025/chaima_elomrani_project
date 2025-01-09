<?php
require_once('./models/tasks_model.php');
require_once('./config/connexion.php');

class UpdateTaskController {
    private $taskModel;

    public function __construct() {
        global $database;
        $this->taskModel = new Task($database);
    }

    public function updateTask() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $task_id = filter_input(INPUT_POST, 'task_id', FILTER_VALIDATE_INT);
            $task_name = filter_input(INPUT_POST, 'task_name', FILTER_SANITIZE_STRING);
            $task_description = filter_input(INPUT_POST, 'task_description', FILTER_SANITIZE_STRING);
            $task_start_date = filter_input(INPUT_POST, 'task_start_date', FILTER_SANITIZE_STRING);
            $task_due_date = filter_input(INPUT_POST, 'task_due_date', FILTER_SANITIZE_STRING);
            $task_status = filter_input(INPUT_POST, 'task_status', FILTER_SANITIZE_STRING);
            
            $task_tags = isset($_POST['type']) ? (is_array($_POST['type']) ? implode(',', $_POST['type']) : $_POST['type']) : null;
            $task_category = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING);

            if ($task_id && $task_name) {
                try {
                    $result = $this->taskModel->updateTask(
                        $task_id,   
                        $task_name, 
                        $task_description, 
                        $task_start_date, 
                        $task_due_date, 
                        $task_status,
                        $task_category, 
                        $task_tags
                    );

                    if ($result) {
                  
                        header('Location: index.php?page=tasks_page&update=success');
                        exit();
                    } else {
                      
                        header('Location: index.php?page=tasks_page&update=failed');
                        exit();
                    }
                } catch (Exception $e) {
                
                    error_log('Task Update Error: ' . $e->getMessage());
                    header('Location: index.php?page=tasks_page&update=error');
                    exit();
                }
            } else {
         
                header('Location: index.php?page=tasks_page&update=invalid');
                exit();
            }
        }
    }
}


if (isset($_GET['action']) && $_GET['action'] === 'update_task') {
    $updateTaskController = new UpdateTaskController();
    $updateTaskController->updateTask();
}
?>
