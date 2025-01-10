<?php
session_start();
require_once("./config/connexion.php");
require_once("./config/helper.php");
require_once("./models/tasks_model.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newTask = new TaskController();
    $newTask->creatTask($_POST);
}

class TaskController{
   private $db;
   private $task;

   public function __construct(){
    $database = new Connexion();
    $db = $database->getconnexion();
    $this->task = new Task($db);
   }

   public function creatTask($data){
    // Validate required fields
    if (empty($data['task_name']) || empty($data['task_description']) || empty($data['dueDate']) || empty($data['status'])) {
        error_log("Task creation failed: Missing required fields");
        header('Location: index.php?page=tasks_page&error=missing_fields');
        return false;
    }

    // Ensure project_id is set
    $project_id = isset($data['project_id']) ? intval($data['project_id']) : null;
    if (!$project_id) {
        error_log("Task creation failed: No project ID provided");
        header('Location: index.php?page=tasks_page&error=no_project');
        return false;
    }

    // Set task properties
    $this->task->name = $data['task_name'];
    $this->task->description = $data['task_description'];
    $this->task->start_date = date('Y-m-d'); // Current date as start date
    $this->task->end_date = $data['dueDate'];
    $this->task->status = $data['status'];
    $this->task->category = isset($data['category']) ? intval($data['category']) : 1;
    $this->task->tag = isset($data['tag']) ? intval($data['tag']) : 1;

    // Attempt to add task
    if($this->task->addTask($project_id)){
        header('Location: index.php?page=tasks_page&id_project=' . $project_id . '&success=task_created');
        return true;
    } else {
        header('Location: index.php?page=tasks_page&id_project=' . $project_id . '&error=task_creation_failed');
        return false;
    }
   }
}