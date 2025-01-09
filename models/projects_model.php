<?php
require_once("./config/connexion.php");

class Project
{
    private $conn;
    private $table = 'projects';

    public $name;
    public $description;
    public $created_date;
    public $due_date;
    public $type;


    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function displayProjects()
    {
        $sql = "SELECT * FROM projects"; 
        $result = $this->conn->query($sql);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }


    public function addProject()
    {
        $query = "INSERT INTO " . $this->table . " (name, description, created_date, due_date, type) VALUES (:project_name, :project_description, :created_date, :due_date, :project_type)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":project_name", $this->name);
        $stmt->bindParam(":project_description", $this->description);
        $stmt->bindParam(":created_date", $this->created_date);
        $stmt->bindParam(":due_date", $this->due_date);
        $stmt->bindParam(":project_type", $this->type);

        if ($stmt->execute()) {
            return true;
        }
        return false;

    }



    public function deleteProject($project_id)
    {
        $query = "DELETE FROM projects  WHERE id = :project_id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":project_id", $project_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }



    public function updateProject($id,$name, $description,$type,$due_date){
       $query="UPDATE projects SET id =?, name =?, description =?, due_date=?";
       $stmt = $this->conn->prepare($query);

       $stmt->bindParam("siis",$id,$name,$description,$due_date);

       try{
        return $stmt->execute();
       }catch(PDOException $e){
        error_log('error',$e->getMessage());
        return false;
       }
    }

}









$dbConnection = new mysqli('localhost', 'root', '', 'project_management');
$sendProject = new Project($dbConnection);


$viewProjects = new Project($dbConnection);
$projects = $viewProjects->displayProjects();


