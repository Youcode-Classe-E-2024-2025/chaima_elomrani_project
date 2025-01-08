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
    // echo dd($data);

    $this->task->name =$data['task_name'];
    $this->task->description =$data['task_description'];
    $this->task->start_date =$data['dueDate'];
    $this->task->end_date =$data['dueDate'];
    $this->task->status =$data['status'];
    $this->task->category_id =1;
    $this->task->tag =1;
    $this-> task->assigned_user_id =null;

    if($this->task->addTask()){
        header('Location: index.php?page=tasks_page');
        return true;
    }else{
        header('Location: index.php?page=admin_home');
        return false;
    }

    


   }

}