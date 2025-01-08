<?php

class User
{
    private $conn;
    private $table = 'users'; 

    public $id;
    public $name;
    public $email;
    public $password;
    public $role; 

    public function __construct(PDO $db)
    {
        $this->conn = $db;
        $this->role = 2; 
    }

    private function validateInput()
    {
        // Basic input validation
        if (empty($this->name) || empty($this->email) || empty($this->password)) {
            return false;
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        return true;
    }

    private function uniqueEmail($email)
    {
        $query = "SELECT id FROM " . $this->table . " WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

    public function signup()
    {
        if (!$this->validateInput()) {
            return "Invalid input. Please check your details.";
        }

        if ($this->uniqueEmail($this->email)) {
            return "Email already exists. Try another one!";
        }

        $query = "INSERT INTO " . $this->table . " (name, email, password, role) VALUES (:name, :email, :password, :role)";
        $stmt = $this->conn->prepare($query);

        $hashed_password = password_hash($this->password, PASSWORD_DEFAULT);

        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':role', $this->role, PDO::PARAM_INT);


        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return "Welcome to our site!";
        } else {
            $errorInfo = $stmt->errorInfo();
            error_log("Signup failed: " . print_r($errorInfo, true));
            return "An error occurred during registration.";
        }

    }

    public function login()
    {
        if (!$this->validateInput()) {
            return [
                "status" => "error",
                "message" => "Entrées invalides. Veuillez vérifier vos informations."
            ];
        }

        $query = "SELECT id, email, password, role FROM " . $this->table . " WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':email', $this->email);


        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (password_verify($this->password, $user['password'])) {
                return [
                    'status' => true,
                    'message' => 'Connexion réussie',
                    'user' => [
                        "id" => $user["id"],
                        "email" => $user["email"],
                        "role" => $user["role"]
                    ]
                ];
            } else {
                return [
                    "status" => false,
                    "message" => "Mot de passe incorrect"
                ];
            }
        } else {
            return [
                "status" => false,
                "message" => "Utilisateur non trouvé"
            ];
        }



    }
}
?>  