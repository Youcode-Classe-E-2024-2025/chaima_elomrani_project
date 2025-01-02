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

        .nav-links a:hover, .nav-links a.active {
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
            <div class="logo">ProManage</div>
            <div class="nav-links">
                <a href="dashbord.php">Dashboard</a>
                <a href="first_page.php">All Projects</a>
                <a href="mytasks.php">My Tasks</a>
                <a href="creat_project.php" class="active">Create Project</a>
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
                    <a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a>
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
            <div class="tasks-container">
                <div class="task-column" id="todo">
                    <h3><i class="fas fa-list"></i> To Do</h3>
                    <div class="task-list">
                        <div class="task-card" draggable="true">
                            <h4>Design new landing page</h4>
                            <p>Create a modern and engaging landing page for the e-commerce platform.</p>
                            <div class="task-meta">
                                <span class="task-project">E-commerce Redesign</span>
                                <span class="task-due-date"><i class="far fa-calendar"></i> Jun 15</span>
                            </div>
                        </div>
                        <div class="task-card" draggable="true">
                            <h4>Implement user authentication</h4>
                            <p>Set up secure user authentication for the mobile app.</p>
                            <div class="task-meta">
                                <span class="task-project">Mobile App</span>
                                <span class="task-due-date"><i class="far fa-calendar"></i> Jun 20</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="task-column" id="in-progress">
                    <h3><i class="fas fa-spinner"></i> In Progress</h3>
                    <div class="task-list">
                        <div class="task-card" draggable="true">
                            <h4>Optimize database queries</h4>
                            <p>Improve the performance of database queries for faster loading times.</p>
                            <div class="task-meta">
                                <span class="task-project">E-commerce Redesign</span>
                                <span class="task-due-date"><i class="far fa-calendar"></i> Jun 18</span>
                            </div>
                        </div>
                        <div class="task-card" draggable="true">
                            <h4>Create onboarding tutorial</h4>
                            <p>Develop an interactive onboarding tutorial for new app users.</p>
                            <div class="task-meta">
                                <span class="task-project">Mobile App</span>
                                <span class="task-due-date"><i class="far fa-calendar"></i> Jun 22</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="task-column" id="done">
                    <h3><i class="fas fa-check"></i> Done</h3>
                    <div class="task-list">
                        <div class="task-card" draggable="true">
                            <h4>Set up CI/CD pipeline</h4>
                            <p>Implement continuous integration and deployment for the project.</p>
                            <div class="task-meta">
                                <span class="task-project">E-commerce Redesign</span>
                                <span class="task-due-date"><i class="far fa-calendar-check"></i> Completed</span>
                            </div>
                        </div>
                        <div class="task-card" draggable="true">
                            <h4>Design app icon</h4>
                            <p>Create an eye-catching app icon for the mobile application.</p>
                            <div class="task-meta">
                                <span class="task-project">Mobile App</span>
                                <span class="task-due-date"><i class="far fa-calendar-check"></i> Completed</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        // User menu toggle
        const userMenuBtn = document.querySelector('.user-menu-btn');
        const userMenuContent = document.querySelector('.user-menu-content');

        userMenuBtn.addEventListener('click', () => {
            userMenuContent.style.display = userMenuContent.style.display === 'block' ? 'none' : 'block';
        });

        // Close user menu when clicking outside
        document.addEventListener('click', (event) => {
            if (!event.target.closest('.user-menu')) {
                userMenuContent.style.display = 'none';
            }
        });

        // Drag and drop functionality
        const taskCards = document.querySelectorAll('.task-card');
        const taskColumns = document.querySelectorAll('.task-column');

        taskCards.forEach(card => {
            card.addEventListener('dragstart', dragStart);
            card.addEventListener('dragend', dragEnd);
        });

        taskColumns.forEach(column => {
            column.addEventListener('dragover', dragOver);
            column.addEventListener('dragenter', dragEnter);
            column.addEventListener('dragleave', dragLeave);
            column.addEventListener('drop', drop);
        });

        function dragStart() {
            this.classList.add('dragging');
        }

        function dragEnd() {
            this.classList.remove('dragging');
        }

        function dragOver(e) {
            e.preventDefault();
        }

        function dragEnter(e) {
            e.preventDefault();
            this.classList.add('drag-over');
        }

        function dragLeave() {
            this.classList.remove('drag-over');
        }

        function drop() {
            this.classList.remove('drag-over');
            const card = document.querySelector('.dragging');
            this.querySelector('.task-list').appendChild(card);
        }
    </script>
</body>
</html>

