<?php
// require_once 'controllers/projects_controller.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProManage - Create Project</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --bg-primary: #f5f5f5;
            --bg-secondary: #ffffff;
            --text-primary: #333333;
            --text-secondary: #666666;
            --accent-primary: #2c7a7b;
            --accent-secondary: #e67e22;
            --accent-tertiary: #6b46c1;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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
            max-width: 800px;
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

        .create-project-header {
            background-color: var(--bg-secondary);
            padding: 2rem 0;
            margin-bottom: 2rem;
            box-shadow: var(--shadow);
        }

        .create-project-title {
            font-size: 2rem;
            color: var(--accent-primary);
            margin-bottom: 0.5rem;
        }

        .create-project-subtitle {
            color: var(--text-secondary);
        }

        .create-project-form {
            background-color: var(--bg-secondary);
            border-radius: 10px;
            padding: 2rem;
            box-shadow: var(--shadow);
            /* max-width : 800px; */

        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--text-primary);
            font-weight: 500;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            color: var(--text-primary);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-group select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23333'%3E%3Cpath d='M7 10l5 5 5-5z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 1.5em;
        }

        .form-group-inline {
            display: flex;
            gap: 1rem;
        }

        .form-group-inline>* {
            flex: 1;
        }

        .submit-btn {
            background-color: var(--accent-primary);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: flex;
            justify-self: center;
        }

        .submit-btn:hover {
            background-color: #236c6d;
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .create-project-title {
                font-size: 1.5rem;
            }

            .form-group-inline {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <nav>
        <div class="container nav-container">
            <div class="logo">ProManage</div>
            <div class="nav-links">
                <a href="index.php?page=home">Home</a>
                <a href="index.php?page=dashbord">Dashboard</a>
                <a href="index.php?page=all_projects">All Projects</a>
                <a href="index.php?page=creat_project" class="active">Create Project</a>
            </div>
            <div class="user-menu">
                <button class="user-menu-btn">
                    <i class="fas fa-user-circle"></i>
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
        <div class="create-project-header">
            <div class="container">
                <h1 class="create-project-title">Create New Project</h1>
                <p class="create-project-subtitle">Start a new project and set it up for success.</p>
            </div>
        </div>
        <div class="container">
            <form class="create-project-form" method="POST" action="index.php?action=projects_controller">
                <div class="form-group">
                    <label for="project-name">Project Name</label>
                    <input type="text" id="project-name" name="project-name" required>
                </div>
                <div class="form-group">
                    <label for="project-description">Project Description</label>
                    <textarea id="project-description" name="project-description" required></textarea>
                </div>
                <div class="form-group-inline">
                    <div class="form-group">
                        <label for="created-date">Created Date</label>
                        <input type="date" id="created-date" name="created-date" required>
                    </div>
                    <div class="form-group">
                        <label for="due-date">due Date</label>
                        <input type="date" id="due-date" name="due-date" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="project-manager">Project Type</label>
                    <select id="project-manager" name="project-manager" required>
                        <option value="">Select type</option>
                        <option value="public">public</option>
                        <option value="private">private</option>
                    </select>
                </div>
                <button type="submit" class="submit-btn">Create Project</button>
            </form>
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

    </script>
</body>

</html>