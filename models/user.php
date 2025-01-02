<?php

class User {
    private $conn;
    private $table = 'users'; // Define the table name explicitly

    public $id;
    public $name;
    public $email;
    public $password;
    public $role; // Add role property

    public function __construct(PDO $db){
        $this->conn = $db;
        $this->role = 2; // Default to team_member (assuming role 2 is team_member)
    }

    private function validateInput() {
        // Basic input validation
        if (empty($this->name) || empty($this->email) || empty($this->password)) {
            return false;
        }
        
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        
        return true;
    }

    private function uniqueEmail($email){
        $query = "SELECT id FROM " . $this->table . " WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

    public function signup(){
        // Validate input first
        if (!$this->validateInput()) {
            return "Invalid input. Please check your details.";
        }

        // Check if email already exists
        if ($this->uniqueEmail($this->email)) {
            return "Email already exists. Try another one!";
        }
        
        // Prepare insertion query - include role
        $query = "INSERT INTO " . $this->table . " (name, email, password, role) VALUES (:name, :email, :password, :role)";
        $stmt = $this->conn->prepare($query);

        // Hash the password
        $hashed_password = password_hash($this->password, PASSWORD_DEFAULT);

        // Bind parameters correctly
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':role', $this->role, PDO::PARAM_INT);

        try {
            // Debug: Add error info reporting
            $stmt->execute();
            
            // Check if any rows were affected
            if ($stmt->rowCount() > 0) {
                return "Welcome to our site!";
            } else {
                // Log the full error details
                $errorInfo = $stmt->errorInfo();
                error_log("Signup failed: " . print_r($errorInfo, true));
                return "An error occurred during registration.";
            }
        } catch (PDOException $e) {
            // Log the full exception
            error_log("PDO Exception: " . $e->getMessage());
            return "Database error: " . $e->getMessage();
        }
    }
    
}
?>