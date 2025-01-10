<?php
require_once('./config/connexion.php');

class DashboardModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getTotalProjects() {
        $query = "SELECT COUNT(*) as total_projects FROM projects";
        $result = $this->conn->query($query);
        return $result ? $result->fetch_assoc()['total_projects'] : 0;
    }

    public function getTotalActiveTasks() {
        $query = "SELECT COUNT(*) as active_tasks FROM tasks WHERE status != 'completed'";
        $result = $this->conn->query($query);
        return $result ? $result->fetch_assoc()['active_tasks'] : 0;
    }

    public function getTotalCompletedTasks() {
        $query = "SELECT COUNT(*) as completed_tasks FROM tasks WHERE status = 'completed'";
        $result = $this->conn->query($query);
        return $result ? $result->fetch_assoc()['completed_tasks'] : 0;
    }

    public function getProjectActivityData() {
        $query = "SELECT 
            DAYNAME(created_date) as day, 
            COUNT(*) as task_count 
            FROM tasks 
            WHERE created_date >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)
            GROUP BY DAYNAME(created_date)
            ORDER BY FIELD(day, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')";
        
        $result = $this->conn->query($query);
        $data = [];

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        return $data;
    }

    public function getTasksCompletedByDay() {
        $query = "SELECT 
            DAYNAME(updated_date) as day, 
            COUNT(*) as task_count 
            FROM tasks 
            WHERE status = 'completed' 
            AND updated_date >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)
            GROUP BY DAYNAME(updated_date)
            ORDER BY FIELD(day, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')";
        
        $result = $this->conn->query($query);
        $data = array_fill(0, 7, 0);
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $index = array_search($row['day'], $days);
                if ($index !== false) {
                    $data[$index] = intval($row['task_count']);
                }
            }
        }

        return $data;
    }
}

// Create a global dashboard model instance
$dashboardModel = new DashboardModel($database);
?>
