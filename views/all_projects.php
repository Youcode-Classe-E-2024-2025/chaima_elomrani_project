<?php
include("../models/projects_model.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProManage - All Projects</title>
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

        .projects-header {
            background-color: var(--bg-secondary);
            padding: 2rem 0;
            margin-bottom: 2rem;
            box-shadow: var(--shadow);
        }

        .projects-title {
            font-size: 2rem;
            color: var(--accent-primary);
            margin-bottom: 0.5rem;
        }

        .projects-subtitle {
            color: var(--text-secondary);
        }

        .projects-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .project-card {
            background-color: var(--bg-secondary);
            border-radius: 10px;
            padding: 1.5rem;
            box-shadow: var(--shadow);
            transition: transform 0.3s ease;
        }

        .project-card:hover {
            transform: translateY(-5px);
        }

        .project-card h3 {
            font-size: 1.25rem;
            color: var(--accent-primary);
            margin-bottom: 1rem;
        }

        .project-card-content {
            margin-bottom: 1rem;
        }

        .project-card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .project-status {
            padding: 0.25rem 0.5rem;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: bold;
        }

        .status-active {
            background-color: #c6f6d5;
            color: #22543d;
        }

        .status-completed {
            background-color: #e9d8fd;
            color: #553c9a;
        }

        .status-on-hold {
            background-color: #feebc8;
            color: #7b341e;
        }

        .project-members {
            display: flex;
        }

        .project-member {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: var(--accent-tertiary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: bold;
            margin-left: -10px;
        }

        .project-member:first-child {
            margin-left: 0;
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .projects-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <nav>
        <div class="container nav-container">
            <div class="logo">ProManage</div>
            <div class="nav-links">
                <a href="home.php">Home</a>
                <a href="dashbord.php">Dashboard</a>
                <a href="all_projects.php">All Projects</a>
                <a href="creat_project.php" class="active">Create Project</a>
            </div>
            <div class="user-menu">
                <button class="user-menu-btn">
                    <i class="fas fa-user-circle"></i>

                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="user-menu-content">
                    <a href="#"><i class="fas fa-user"></i> Profile</a>
                    <a href="#"><i class="fas fa-cog"></i> Settings</a>
                    <a href="home.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </div>
            </div>
        </div>
    </nav>
    <main>
        <div class="projects-header">
            <div class="container">
                <h1 class="projects-title">All Projects</h1>
                <p class="projects-subtitle">View and manage all your ongoing and completed projects.</p>
            </div>
        </div>

        <div class="container">
            <div class="projects-grid">
                <?php foreach ($projects as $project): ?>
                    <div class="project-card">
                        <h3><?= htmlspecialchars($project['name']) ?></h3>
                        <div class="project-card-content">
                            <p><?= htmlspecialchars($project['description']) ?></p>
                        </div>
                        <div class="project-card-footer">
                          <span class="project-status"> created in: <?= htmlspecialchars($project['created_date']) ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
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

        // Animate project cards on scroll
        const projectCards = document.querySelectorAll('.project-card');

        const animateOnScroll = (entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = 1;
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        };

        const options = {
            root: null,
            rootMargin: '0px',
            threshold: 0.1
        };

        const observer = new IntersectionObserver(animateOnScroll, options);

        projectCards.forEach(card => {
            card.style.opacity = 0;
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            observer.observe(card);
        });
    </script>
</body>

</html>