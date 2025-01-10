<?php
require_once './models/projectMember.php';
require_once './config/connexion.php';

$connexion = new Connexion();
$pdo = $connexion->getconnexion(); 

class TeamMemberController {
    private $teamMember;

    public function __construct($pdo) {
        try {
            $this->teamMember = new TeamMember($pdo);
        } catch (Exception $e) {
            error_log("Erreur construction: " . $e->getMessage());
            throw $e;
        }
    }

    public function handleRequest() {
        header('Content-Type: application/json');

        try {
            error_log("Méthode reçue: " . $_SERVER['REQUEST_METHOD']);
            
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                return $this->handlePostRequest();
            } else {
                throw new Exception('Method not allowed');
            }
        } catch (Exception $e) {
            error_log("Erreur handleRequest: " . $e->getMessage());
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => $e->getMessage()
            ]);
            exit;
        }
    }

    private function handlePostRequest() {
        try {
            $json_data = file_get_contents('php://input');
            error_log("Données reçues: " . $json_data);

            if (!$json_data) {
                throw new Exception('No data received');
            }

            $data = json_decode($json_data, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception('Invalid JSON data: ' . json_last_error_msg());
            }

            error_log("Données décodées: " . print_r($data, true));

            if (!isset($data['projectId']) || !isset($data['members'])) {
                throw new Exception('Missing required fields');
            }

            $result = $this->teamMember->assignMembersToProject(
                $data['projectId'],
                $data['members']
            );

            error_log("Résultat: " . print_r($result, true));
            echo json_encode($result);
            exit;
        } catch (Exception $e) {
            error_log("Erreur handlePostRequest: " . $e->getMessage());
            throw $e;
        }
    }
}

try {
    error_log("Initialisation du contrôleur");
    $controller = new TeamMemberController($pdo);
    $controller->handleRequest();
} catch (Exception $e) {
    error_log("Erreur principale: " . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}

$controller = new TeamMemberController($pdo);
$controller->handleRequest();