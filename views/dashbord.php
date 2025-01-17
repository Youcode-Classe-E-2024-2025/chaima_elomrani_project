<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProManage - Dashboard</title>
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

        .dashboard-header {
            background-color: var(--bg-secondary);
            padding: 2rem 0;
            margin-bottom: 2rem;
            box-shadow: var(--shadow);
        }

        .dashboard-title {
            font-size: 2rem;
            color: var(--accent-primary);
            margin-bottom: 0.5rem;
        }

        .dashboard-subtitle {
            color: var(--text-secondary);
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .dashboard-card {
            background-color: var(--bg-secondary);
            border-radius: 10px;
            padding: 1.5rem;
            box-shadow: var(--shadow);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .dashboard-card h3 {
            font-size: 1.25rem;
            color: var(--accent-primary);
            margin-bottom: 1rem;
        }

        .dashboard-card-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .dashboard-card-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: var(--accent-secondary);
        }

        .dashboard-card-icon {
            font-size: 3rem;
            color: var(--accent-tertiary);
            opacity: 0.2;
        }

        .chart-container {
            background-color: var(--bg-secondary);
            border-radius: 10px;
            padding: 1.5rem;
            box-shadow: var(--shadow);
            margin-top: 2rem;
        }

        .chart-title {
            font-size: 1.25rem;
            color: var(--accent-primary);
            margin-bottom: 1rem;
        }

        #activity-chart {
            width: 100%;
            height: 300px;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeInUp {
            animation: fadeInUp 0.5s ease-out;
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .dashboard-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <?php
    require_once('./controllers/dashboard_controller.php');
    require_once('./config/session.php');

    // Redirect if not logged in
    if (!isset($_SESSION['user_id'])) {
        header('Location: index.php?page=login_page');
        exit();
    }

    // Get dashboard data
    $dashboardData = $dashboardController->getDashboardData();

    // Get user's name (assuming it's stored in session)
    $userName = $_SESSION['user_name'] ?? 'User';
    ?>
    <nav>
        <div class="container nav-container">
            <div class="logo">ProManage</div>
            <div class="nav-links">
                <a href="index.php?page=admin_home">Home</a>
                <a href="index.php?page=dashbord">Dashboard</a>
                <a href="index.php?page=tasks_page">Tasks</a>
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
                    <a href="home.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <main>
        <div class="dashboard-header">
            <div class="container">
                <h1 class="dashboard-title">Welcome back, <?= $userName ?>!</h1>
                <p class="dashboard-subtitle">Here's an overview of your projects and tasks.</p>
            </div>
        </div>

        <div class="container">
            <div class="dashboard-grid">
                <div class="dashboard-card animate-fadeInUp" style="animation-delay: 0.1s;">
                    <h3>Total Projects</h3>
                    <div class="dashboard-card-content">
                        <span class="dashboard-card-number"><?= $dashboardData['total_projects'] ?></span>
                        <i class="fas fa-project-diagram dashboard-card-icon"></i>
                    </div>
                </div>
                <div class="dashboard-card animate-fadeInUp" style="animation-delay: 0.2s;">
                    <h3>Active Tasks</h3>
                    <div class="dashboard-card-content">
                        <span class="dashboard-card-number"><?= $dashboardData['active_tasks'] ?></span>
                        <i class="fas fa-tasks dashboard-card-icon"></i>
                    </div>
                </div>
                <div class="dashboard-card animate-fadeInUp" style="animation-delay: 0.3s;">
                    <h3>Completed Tasks</h3>
                    <div class="dashboard-card-content">
                        <span class="dashboard-card-numbe<?= $dashboardData['completed_tasks'] ?>r"></span>
                        <i class="fas fa-check-circle dashboard-card-icon"></i>
                    </div>
                </div>
            </div>

            <div class="chart-container animate-fadeInUp" style="animation-delay: 0.4s;">
                <h3 class="chart-title">Project Activity</h3>
                <canvas id="activity-chart"></canvas>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

        // Activity Chart
        const ctx = document.getElementById('activity-chart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [{
                    label: 'Tasks Completed',
                    data: <?= json_encode($dashboardData['tasks_completed']) ?>,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const animateOnScroll = (entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fadeInUp');
                    observer.unobserve(entry.target);
                }
            });
        };

        const observer = new IntersectionObserver(animateOnScroll, {
            root: null,
            rootMargin: '0px',
            threshold: 0.1
        });

        document.querySelectorAll('.dashboard-card, .chart-container').forEach(el => {
            observer.observe(el);
        });
    </script>
</body>

</html>