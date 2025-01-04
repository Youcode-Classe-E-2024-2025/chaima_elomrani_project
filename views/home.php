<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProManage - Professional Project Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./assets/home.css">
  
</head>
<body>
    <nav>
        <div class="container nav-container">
            <div class="logo">ProManage</div>
            <div class="nav-links">
                <a href="#home">Home</a>
                <a href="#projects">Projects</a>
                <a href="#features">Features</a>
            </div>
            <a href="views/login_page.php" class="sign-in-btn">Sign In</a>
        </div>
    </nav>

    <header class="hero" id="home">
        <div class="container">
            <h1>Elevate Your Project Management</h1>
            <p>Streamline your workflow, collaborate seamlessly, and achieve your goals with ProManage.</p>
            <a href="views/login_page.php" class="cta-btn">Get Started</a>
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

