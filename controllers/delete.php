<?php
require_once('./config/connexion.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $projectId = $_POST['project_id'] ?? null;

    if($projectId){
        try{
            $pdo = new PDO('mysql:host=localhost;dbname=project_management', 'root', '');

            $stmt = $pdo->prepare('DELETE FROM projects WHERE id = :id');
            $stmt->bindParam(':id', $projectId, PDO::PARAM_INT);
            $stmt ->execute();

            header("Location: index.php?page=all_projects");
            echo "projects has been deleted successfully";
            exit;
   
        }catch(PDOException $e){
            echo"erroooooor" $e->getMessage();
        }
    }else{
        header("Location:index.php?page=error404");
    }
}