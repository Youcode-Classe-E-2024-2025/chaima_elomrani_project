<?php
require_once('./config/connexion.php');

$database = new Connexion();
$connexion = $database->getconnexion();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $projectId = $_POST['project_id'];

    if($projectId){
        try{
            $pdo = new PDO('mysql:host=localhost;dbname=project_management', 'root', '');

            $stmt = $pdo->prepare('DELETE FROM tasks WHERE id = :id');
            $stmt->bindParam(':id', $projectId, PDO::PARAM_INT);
            $stmt ->execute();

            header("Location: index.php?page=tasks_page");
            echo "projects has been deleted successfully";
            exit;
   
        }catch (Exception $e) {
            $_SESSION['delete_error'] = $e->getMessage();
            var_dump($_SESSION);
            exit();
        }
    }else{
        header("Location:index.php?page=error404");
        exit;
    }
}




