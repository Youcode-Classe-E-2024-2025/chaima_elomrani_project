<?php
session_start();
include("../config/connexion.php");

if(!isset($_SESSION['user'])){
    header("Location:login_page.php");

    exit();
}

$database = new Connexion();
$conn = $database -> getconnexion();

try{
    $userID =$_SESSION['user']['id'];
    $query = "SELECT * FROM projects WHERE user_id = :user_id";

    $stmt = $conn ->prepare($query);
    $stmt ->bindParam(':user_id', $userID, PDO::PARAM_INT);
    $stmt -> execute();
    $projects = $stmt ->fetchAll(PDO::FETCH_ASSOC);

}catch(PDOException $e){
    $projects= [];
    error_log("makhedamch hadchi:" $e->getMessage());
}

?>
