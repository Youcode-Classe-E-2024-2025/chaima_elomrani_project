<?php
require_once('./config/connexion.php');
// Database connection
$dbConnection = new mysqli('localhost', 'root', '', 'project_management');

if ($dbConnection->connect_error) {
    die("Connection failed: " . $dbConnection->connect_error);
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