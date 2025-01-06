<?php
require_once('./config/connexion.php');
require_once('./controllers/task_controller.php');
require_once('./models/tasks_model.php');

// Database connection
$dbConnection = new mysqli('localhost', 'root', '', 'project_management');

if ($dbConnection->connect_error) {
    die("Connection failed: " . $dbConnection->connect_error);
}

// Fetch tags from the database
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

$tasks_query = "
    SELECT t.*, c.name AS category_name 
    FROM tasks t 
    LEFT JOIN category c ON t.category = c.id
    ORDER BY t.start_date DESC
";
$tasks_result = $dbConnection->query($tasks_query);
$tasks = [];

if ($tasks_result) {
    while ($task = $tasks_result->fetch_assoc()) {
        $tasks[] = $task;
    }
} else {
    error_log("Failed to fetch tasks: " . $dbConnection->error);
}

// Close the database connection
$dbConnection->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProManage - My Tasks</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./styles/tasks.css">

</head>

<body>
    <nav>
        <div class="container nav-container">
            <a href="#" class="logo">ProManage</a>
            <div class="nav-links">
                <a href="home.php">Home</a>
                <a href="dashbord.php">Dashboard</a>
                <a href="first_page.php">All Projects</a>
                <a href="mytasks.php" class="active">My Tasks</a>
                <a href="creat_project.php">Create Project</a>
            </div>
            <div class="user-menu">
                <button class="user-menu-btn">
                    <i class="fas fa-user-circle"></i>
                    <span>John Doe</span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="user-menu-content">
                    <a href="#"><i class="fas fa-user"></i> Profile</a>
                    <a href="#"><i class="fas fa-cog"></i> Settings</a>
                    <a href="#" id="logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <main>
        <div class="tasks-header">
            <div class="container">
                <h1 class="tasks-title">My Tasks</h1>
                <p class="tasks-subtitle">Manage and track your tasks across different projects.</p>
            </div>
        </div>

        <div class="container">
            <button id="addTaskBtn" class="btn">Add New Task</button>
            <div class="tasks-container">
                <div class="task-column" id="todo-column">
                    <h3><i class="fas fa-list"></i> To Do</h3>
                    <div class="task-list"></div>
                    <div class="task-list">
                      <?php
                      foreach($tasks as $task) :
                      ?>
                        <div class="task-card" draggable="true">
                            <h4><?= htmlspecialchars($task['name']) ?></h4>
                            <p><?= htmlspecialchars($task['description']) ?></p>
                            <div class="task-meta">
                                <span class="task-project"><?= htmlspecialchars($task['category_name'] ?? 'Uncategorized') ?></span>
                                <span class="task-due-date"><i class="far fa-calendar"></i> <?= htmlspecialchars($task['start_date']) ?></span>
                            </div>
                        </div>
                      <?php
                      endforeach;
                      ?>
                    </div>
                </div>

                <div class="task-column" id="inprogress-column">
                    <h3><i class="fas fa-spinner"></i> In Progress</h3>
                    <div class="task-list"></div>
                </div>

                <div class="task-column" id="done-column">
                    <h3><i class="fas fa-check"></i> Done</h3>
                    <div class="task-list"></div>
                </div>
            </div>
        </div>
    </main>

    <div id="taskModal" class="modal">
        <div class="modal-content">
            <span class="close" id="close">&times;</span>
            <h2>Add New Task</h2>
            <form id="taskForm" action="index.php" method="POST">
                <input type="hidden" name="action" value="add_task">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description"></textarea>
                </div>
                <div class="form-group">
                    <label for="priority">Priority</label>
                    <select id="priority" name="priority">
                        <option value="1">Low</option>
                        <option value="2" selected>Medium</option>
                        <option value="3">High</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status">
                        <option value="1">To Do</option>
                        <option value="2">In Progress</option>
                        <option value="3">Done</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="type">Tag</label>
                    <select id="type" name="type" multiple>

                        <?php
                        foreach ($tags as $tag) {
                            ?>
                            <option value="<?php echo htmlspecialchars($tag['id']) ?>"><?php echo htmlspecialchars($tag['name']) ?></option>
                            <?php
                        }
                        ?>
                       
                    </select>
                </div>
                <div class="form-group">
                    <label for="type">Category</label>
                    <select id="type" name="type">
                     <option value="">Select Category</option>
                        <?php
                        foreach ($categories as $category) {
                            ?>
                            <option value="<?php echo htmlspecialchars($category['id']) ?>"><?php echo htmlspecialchars($category['name']) ?></option>
                            <?php
                        }
                        ?>

                    </select>
                </div>
                <div class="form-group">
                    <label for="dueDate">Due Date</label>
                    <input type="date" id="dueDate" name="dueDate">
                </div>
                <button type="submit" class="btn">Add Task</button>
            </form>
        </div>
    </div>

    <div id="detailsModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div id="taskDetails"></div>
        </div>
    </div>
    <script src="./js/tasks.js"></script>