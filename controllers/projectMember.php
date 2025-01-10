<?php
class TeamMember {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function assignMembersToProject($projectId, $members) {
        try {
            error_log("Début assignMembersToProject - projectId: $projectId");
            error_log("Members: " . print_r($members, true));

            // Validate inputs
            if (empty($projectId)) {
                throw new Exception("Project ID is required");
            }

            if (!is_array($members) || empty($members)) {
                throw new Exception("Members list is empty or invalid");
            }

            $this->pdo->beginTransaction();

            // Vérifier si le projet existe
            $stmt = $this->pdo->prepare("SELECT id FROM projects WHERE id = ?");
            $stmt->execute([$projectId]);
            if (!$stmt->fetch()) {
                throw new Exception("Project not found");
            }

            $insertStmt = $this->pdo->prepare(
                "INSERT INTO team_members (user_id, project_id) 
                 VALUES ((SELECT id FROM users WHERE email = ?), ?)"
            );

            $results = ['success' => [], 'errors' => []];

            foreach ($members as $member_email) {
                try {
                    $clean_email = trim(str_replace('×', '', $member_email));
                    
                    // Validate email
                    if (!filter_var($clean_email, FILTER_VALIDATE_EMAIL)) {
                        throw new Exception("Invalid email format");
                    }

                    error_log("Processing member: $clean_email");

                    // Vérifier si l'utilisateur existe
                    $userStmt = $this->pdo->prepare("SELECT id FROM users WHERE email = ?");
                    $userStmt->execute([$clean_email]);
                    $userId = $userStmt->fetchColumn();

                    if (!$userId) {
                        // Créer l'utilisateur s'il n'existe pas
                        $createUserStmt = $this->pdo->prepare(
                            "INSERT INTO users (name, email, password, role) 
                             VALUES (?, ?, ?, (SELECT id FROM roles WHERE name = 'team_member'))"
                        );
                        
                        $name = explode('@', $clean_email)[0];
                        $tempPassword = password_hash(uniqid(), PASSWORD_DEFAULT);
                        
                        $createUserStmt->execute([$name, $clean_email, $tempPassword]);
                        $userId = $this->pdo->lastInsertId();
                    }

                    // Check if user is already a member of the project
                    $checkMemberStmt = $this->pdo->prepare(
                        "SELECT COUNT(*) FROM team_members WHERE user_id = ? AND project_id = ?"
                    );
                    $checkMemberStmt->execute([$userId, $projectId]);
                    $isMember = $checkMemberStmt->fetchColumn();

                    if ($isMember) {
                        $results['success'][] = $clean_email . ' (already a member)';
                        continue;
                    }

                    // Ajouter l'utilisateur au projet
                    $teamMemberStmt = $this->pdo->prepare(
                        "INSERT IGNORE INTO team_members (user_id, project_id) VALUES (?, ?)"
                    );
                    $teamMemberStmt->execute([$userId, $projectId]);
                    
                    $results['success'][] = $clean_email;
                    error_log("Member added successfully: $clean_email");

                } catch (Exception $e) {
                    error_log("Error processing member $clean_email: " . $e->getMessage());
                    $results['errors'][] = [
                        'email' => $clean_email,
                        'error' => $e->getMessage()
                    ];
                }
            }

            $this->pdo->commit();
            error_log("Transaction committed successfully");
            
            if (empty($results['success']) && !empty($results['errors'])) {
                throw new Exception("Failed to add any members");
            }

            return [
                'success' => true,
                'message' => 'Members processed',
                'details' => $results
            ];

        } catch (Exception $e) {
            error_log("Error in assignMembersToProject: " . $e->getMessage());
            $this->pdo->rollBack();
            throw $e;
        }
    }
}