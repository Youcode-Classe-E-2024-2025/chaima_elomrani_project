<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProManage - Professional Project Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/home.css">

</head>

<body>
    <style>
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
    </style>
    <nav>
        <div class="container nav-container">
            <div class="logo">ProManage</div>
            <div class="nav-links">
                <a href="admin_home.php">Home</a>
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

    <header class="hero" id="home">
        <div class="container">
            <h1>Elevate Your Project Management</h1>
            <p>Streamline your workflow, collaborate seamlessly, and achieve your goals with ProManage.</p>
            <a href="all_projects.php" class="cta-btn">See Projects</a>
        </div>
    </header>

    <section class="features" id="features">
        <div class="container">
            <h2>Powerful Features</h2>
            <div class="feature-grid">
                <div class="feature-card">
                    <i class="fas fa-tasks feature-icon"></i>
                    <h3>Task Management</h3>
                    <p>Organize and prioritize tasks with ease.</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-chart-line feature-icon"></i>
                    <h3>Analytics</h3>
                    <p>Gain insights with detailed project analytics.</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-users feature-icon"></i>
                    <h3>Team Collaboration</h3>
                    <p>Work together seamlessly with your team.</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-clock feature-icon"></i>
                    <h3>Time Tracking</h3>
                    <p>Monitor project progress and time spent.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="projects" id="projects">
        <div class="container">
            <h2>Public Projects</h2>
            <div class="project-grid">
                <div class="project-card">
                    <img src="../images/image1.jpg" alt="Project 1" class="project-image">
                    <div class="project-info">
                        <h3>E-commerce Platform</h3>
                        <p>A scalable e-commerce solution for small businesses.</p>
                        <div class="project-tags">
                            <span class="project-tag">Web Development</span>
                            <span class="project-tag">E-commerce</span>
                        </div>
                    </div>
                </div>
                <div class="project-card">
                    <img src="../images/image2.jpg" alt="Project 2" class="project-image">
                    <div class="project-info">
                        <h3>Fitness Tracker App</h3>
                        <p>Mobile app for tracking workouts and nutrition.</p>
                        <div class="project-tags">
                            <span class="project-tag">Mobile App</span>
                            <span class="project-tag">Health & Fitness</span>
                        </div>
                    </div>
                </div>
                <div class="project-card">
                    <img src="../images/image3.jpg" alt="Project 3" class="project-image">
                    <div class="project-info">
                        <h3>Data Visualization Dashboard</h3>
                        <p>Interactive dashboard for visualizing complex datasets.</p>
                        <div class="project-tags">
                            <span class="project-tag">Data Science</span>
                            <span class="project-tag">Visualization</span>
                        </div>
                    </div>
                </div>
                <div class="project-card">
                    <img src="../images/image4.jpg" alt="Project 3" class="project-image">
                    <div class="project-info">
                        <h3>Data Visualization Dashboard</h3>
                        <p>Interactive dashboard for visualizing complex datasets.</p>
                        <div class="project-tags">
                            <span class="project-tag">Data Science</span>
                            <span class="project-tag">Visualization</span>
                        </div>
                    </div>
                </div>
                <div class="project-card">
                    <img src="../images/image5.jpg" alt="Project 3" class="project-image">
                    <div class="project-info">
                        <h3>Data Visualization Dashboard</h3>
                        <p>Interactive dashboard for visualizing complex datasets.</p>
                        <div class="project-tags">
                            <span class="project-tag">Data Science</span>
                            <span class="project-tag">Visualization</span>
                        </div>
                    </div>
                </div>
                <div class="project-card">
                    <img src="../images/image6.jpg" alt="Project 3" class="project-image">
                    <div class="project-info">
                        <h3>Data Visualization Dashboard</h3>
                        <p>Interactive dashboard for visualizing complex datasets.</p>
                        <div class="project-tags">
                            <span class="project-tag">Data Science</span>
                            <span class="project-tag">Visualization</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; 2023 ProManage. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // ****************user_menue******************************
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

        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Animate feature cards on scroll
        const featureCards = document.querySelectorAll('.feature-card');
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

        featureCards.forEach(card => {
            card.style.opacity = 0;
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            observer.observe(card);
        });

        projectCards.forEach(card => {
            card.style.opacity = 0;
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            observer.observe(card);
        });
    </script>
</body>

</html>