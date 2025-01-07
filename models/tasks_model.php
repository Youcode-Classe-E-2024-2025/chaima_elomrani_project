<?php
// require_once('./config/connexion.php');
// require_once('./controllers/task_controller.php');
class Task
{
    private $conn;
    private $table = 'tasks';

    public $name;
    public $description;
    public $start_date;
    public $due_date;
    public $status;
    public $category;
    public $tag;




    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function displayTasks()
    {
        $sql = "SELECT tasks.*, category.name AS category_name FROM tasks LEFT JOIN category ON tasks.category = category.id ORDER BY tasks.start_date DESC";
        $result = $this->conn->query($sql);

        if ($result) {
            return $result->fetch_All(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }

    public function addTask()
    {
        $query = "INSERT INTO tasks (name, description, start_date, due_date, status, category, tag) 
                  VALUES (:task_name, :task_description, :start_date, :due_date, :status, :category, :tag)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":task_name", $this->name);
        $stmt->bindParam(":task_description", $this->description);
        $stmt->bindParam(":start_date", $this->start_date);
        $stmt->bindParam(":due_date", $this->due_date);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":category", $this->category);
        $stmt->bindParam(":tag", $this->tag);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}

$database = new mysqli('localhost', 'root', '', 'project_management');
$sendTask = new Task($database);


$viewTasks = new Task($database);
$tasks = $viewTasks-> displayTasks();







$dbConnection = new mysqli('localhost', 'root', '', 'project_management');

if ($dbConnection->connect_error) {
    echo ("Connection failed: " . $dbConnection->connect_error);
}

$tags_query = "SELECT id, name FROM tags";
$tags_result = $dbConnection->query($tags_query);
$tags = [];

if ($tags_result) {
    while ($tag = $tags_result->fetch_assoc()) {
        $tags[] = $tag;
    }
} else {
    error_log("Failed to fetch tags: " . $dbConnection->error);
}

$categories_query = "SELECT id, name FROM category";
$categories_result = $dbConnection->query($categories_query);
$categories = [];

if ($categories_result) {
    while ($category = $categories_result->fetch_assoc()) {
        $categories[] = $category;
    }
} else {
    error_log("Failed to fetch categories: " . $dbConnection->error);
}

$dbConnection->close();