<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProManage - My Tasks</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --bg-primary: #f8f9fa;
            --bg-secondary: #ffffff;
            --text-primary: #2d3748;
            --text-secondary: #4a5568;
            --accent-primary: #3c366b;
            --accent-secondary: #4c51bf;
            --accent-tertiary: #667eea;
            --success: #48bb78;
            --warning: #ed8936;
            --danger: #e53e3e;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--bg-primary);
            color: var(--text-primary);
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        nav {
            background-color: var(--bg-secondary);
            box-shadow: var(--shadow);
            position: fixed;
            width: 100%;
            z-index: 1000;
        }

        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--accent-primary);
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--text-secondary);
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav-links a:hover,
        .nav-links a.active {
            color: var(--accent-primary);
        }

        .user-menu {
            position: relative;
        }

        .user-menu-btn {
            background: none;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-secondary);
        }

        .user-menu-content {
            position: absolute;
            right: 0;
            top: 100%;
            background-color: var(--bg-secondary);
            box-shadow: var(--shadow);
            border-radius: 5px;
            padding: 0.5rem 0;
            min-width: 150px;
            display: none;
        }

        .user-menu-content a {
            display: block;
            padding: 0.5rem 1rem;
            color: var(--text-secondary);
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .user-menu-content a:hover {
            background-color: var(--bg-primary);
        }

        main {
            padding-top: 5rem;
        }

        .tasks-header {
            background-color: var(--bg-secondary);
            padding: 2rem 0;
            margin-bottom: 2rem;
            box-shadow: var(--shadow);
        }

        .tasks-title {
            font-size: 2rem;
            color: var(--accent-primary);
            margin-bottom: 0.5rem;
        }

        .tasks-subtitle {
            color: var(--text-secondary);
        }

        .tasks-container {
            display: flex;
            gap: 2rem;
            overflow-x: auto;
            padding-bottom: 1rem;
        }

        .task-column {
            background-color: var(--bg-secondary);
            border-radius: 10px;
            padding: 1.5rem;
            box-shadow: var(--shadow);
            min-width: 300px;
            flex: 1;
        }

        .task-column h3 {
            font-size: 1.25rem;
            color: var(--accent-primary);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .task-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .task-card {
            background-color: var(--bg-primary);
            border-radius: 5px;
            padding: 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: move;
        }

        .task-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow);
        }

        .task-card h4 {
            font-size: 1rem;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .task-card p {
            font-size: 0.875rem;
            color: var(--text-secondary);
            margin-bottom: 0.5rem;
        }

        .task-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.75rem;
            color: var(--text-secondary);
        }

        .task-project {
            background-color: var(--accent-tertiary);
            color: white;
            padding: 0.25rem 0.5rem;
            border-radius: 20px;
        }

        .task-due-date {
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .dragging {
            opacity: 0.5;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            border-radius: 5px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .btn {
            display: inline-block;
            padding: 0.5rem 1rem;
            background-color: var(--accent-primary);
            color: white;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: var(--accent-secondary);
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .tasks-title {
                font-size: 1.5rem;
            }

            .tasks-container {
                flex-direction: column;
            }

            .task-column {
                min-width: auto;
            }
        }
    </style>
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
                </div>
                
                <div class="task-column" id="inprogress-column">
                    <h3><i class="fas fa-spinner"></i> In Progress</h3><div class="task-list"></div>
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
            <span class="close">&times;</span>
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
                    <label for="type">Type</label>
                    <select id="type" name="type">
                        <option value="1">Basic</option>
                        <option value="2">Bug</option>
                        <option value="3">Feature</option>
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
     <script>
        const addTaskBtn = document.getElementById('addTaskBtn');
        const taskModal = document.getElementById('taskModal');
        
 
        addTaskBtn.addEventListener('click', function (){
            taskModal.style.display="block";
        })
     </script>