<?php
session_start();
require_once('./config/connexion.php');
require_once('./models/tasks_model.php');

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
    // Set task properties from the submitted form data
    $this->task->name = $data['title'];
    $this->task->description = $data['description'];
    $this->task->start_date = $data['dueDate'];
    $this->task->end_date = null; // You can modify this if you want to track end date
    $this->task->status = $data['status'];
    $this->task->category = $data['type']; // Category ID from the form
    $this->task->tag = $data['type']; // Tag ID from the form (you might want to separate this)

    // Attempt to add the task
    if($this->task->addTask()){
        $_SESSION['message'] = "Task added successfully.";
        header('Location: index.php?page=tasks_page');
        exit();
    } else {
        $_SESSION['error'] = "Failed to add task.";
        header('Location: index.php?page=tasks_page');
        exit();
    }
   }
}