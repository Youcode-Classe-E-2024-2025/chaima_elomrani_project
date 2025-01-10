<?php
session_start();
include_once "config/helper.php";
include_once "config/connexion.php";
include_once "controllers/projectMember.php";

// Handle AJAX request for assigning members
if (isset($_GET['action']) && $_GET['action'] === 'assign_members') {
    header('Content-Type: application/json');
    
    try {
        // Get raw POST data
        $rawData = file_get_contents('php://input');
        $data = json_decode($rawData, true);

        if (!$data || !isset($data['projectId']) || !isset($data['members'])) {
            throw new Exception('Invalid request data');
        }

        // Create TeamMember instance
        $teamMember = new TeamMember($database);

        // Assign members to project
        $result = $teamMember->assignMembersToProject($data['projectId'], $data['members']);

        // Return JSON response
        echo json_encode($result);
        exit;
    } catch (Exception $e) {
        error_log('Error in assign_members: ' . $e->getMessage());
        echo json_encode([
            'success' => false,
            'message' => $e->getMessage()
        ]);
        exit;
    }
}

if (isset($_GET['action'])) {
    include_once "./controllers/" . $_GET['action'] . ".php";
}

if (isset($_GET['page'])) {
    include_once "./views/" . $_GET['page'] . ".php";
} else {
    include_once "./views/home.php";
}