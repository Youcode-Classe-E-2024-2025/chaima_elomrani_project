<?php
// include("../config/connexion.php");


// class Project {
//     private $db;

//     public function __construct($db) {
//         $this->db = $db;
//     }

//     public function create($name, $description) {
//         $name = $this->db->escapeString($name);
//         $description = $this->db->escapeString($description);
//         // $team_members = $this->db->escapeString($team_members);

//         $sql = "INSERT INTO projects (name, description) VALUES ('$name', '$description')";
        
//         if ($this->db->query($sql)) {
//             return true;
//         } else {
//             return false;
//         }
//     }
// }

// // Usage
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $db = new Database("localhost", "root", "", "project_management");
//     $project = new Project($db);

//     $name = $_POST["project_name"];
//     $description = $_POST["project_description"];
    

//     if ($project->create($name, $description )) {
//         echo "Project created successfully!";
//     } else {
//         echo "Error creating project.";
//     }

//     $db->close();
// }
