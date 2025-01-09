<?php
session_start();
require_once './config/connexion.php';
require_once './models/projects_model.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProManage - All Projects</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./styles/projects.css">
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

        .delete-btn {
            /* display: flex;
            flex-direction:row; */
            /* gap: 20px; */
            position: absolute;
            right: 50px;
            top: 35px;
            width: 20px;
            height: 25px;
            background: none;
            background: none;
            border: none;
            cursor: pointer;
            color: red;
            font-size: 1rem;
            transition: color 0.3s ease;

        }

        .delete-btn:hover {
            color: darkred;
        }

        .update_icon {
            width: 20px;
            height: 25px;
            position: absolute;
            right: 20px;
            top: 30px;
        }

        .message {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
        }

        .success-message {
            background-color: #dff0d8;
            color: #3c763d;
        }

        .error-message {
            background-color: #f2dede;
            color: #a94442;
        }

        .icons {
            display: flex;
            flex-direction: row;

        }

        .delete-btn {
            /* display: flex;
    flex-direction:row; */
            /* gap: 20px; */

            width: 20px;
            height: 25px;
            background: none;
            border: none;
            cursor: pointer;
            color: red;
            font-size: 1rem;
            position: absolute;
            top: 12%;
            /* transition: color 0.3s ease; */

        }

        .delete-btn:hover {
            color: darkred;
        }


        .update-btn {
            width: 20px;
            height: 25px;
            background: none;
            border: none;
            cursor: pointer;
            color: green;
            font-size: 1rem;
        }

        .update-project-form {
            width: 500px;
            max-width: 90%;
            max-height: 90vh;
            margin: 0 auto;
            background-color: var(--bg-secondary);
            border-radius: 10px;
            padding: 2rem;
            box-shadow: var(--shadow);
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1100;
            display: none;
            overflow: hidden;
        }


        .update-project-form .form-content {
            max-height: calc(90vh - 150px);
            overflow-y: auto;
            padding-right: 15px;
        }

        .update-project-form .form-content::-webkit-scrollbar {
            width: 8px;
        }

        .update-project-form .form-content::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .update-project-form .form-content::-webkit-scrollbar-thumb {
            background: var(--accent-primary);
            border-radius: 10px;
        }

        .update-project-form .form-content::-webkit-scrollbar-thumb:hover {
            background: #2a6f70;
        }

        .close-btn:hover,
        .close-btn:focus {
            color: rgb(255, 0, 0);
            text-decoration: none;
            cursor: pointer;
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
        <div class="projects-header">
            <div class="container">
                <h1 class="projects-title">All Projects</h1>
                <p class="projects-subtitle">View and manage all your ongoing and completed projects.</p>
            </div>
        </div>

        <div class="container">
            <?php
            // Display success or error messages
            if (isset($_SESSION['message'])): ?>
                <div class="message success-message">
                    <?php
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                    ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="message error-message">
                    <?php
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                    ?>
                </div>
            <?php endif; ?>

            <div class="projects-grid">
                <?php foreach ($projects as $project): ?>
                    <div class="project-card">
                        <div class="icons">
                            <!-- delete -->
                            <form method="POST" action="index.php?action=delete"
                                onsubmit="return confirm('Are you sure you want to delete this project?');">
                                <input type="hidden" name="project_id" value="<?= htmlspecialchars($project['id']) ?>">
                                <button type="submit" class="delete-btn">
                                    <i class="fa-solid fa-trash icon"></i>
                                </button>
                            </form>
                            <!-- update -->
                            <form method="POST" action="index.php?action=projects_controller">
                                <input type="hidden" name="project_id" value="<?= htmlspecialchars($project['id']) ?>">
                                <input type="hidden" name="project_name" value="<?= htmlspecialchars($project['name']) ?>">
                                <input type="hidden" name="project_description"
                                    value="<?= htmlspecialchars($project['description']) ?>">
                                <input type="hidden" name="project_due_date"
                                    value="<?= htmlspecialchars($project['due_date']) ?>">

                            </form>
                            <button type="button" id="editbtn" class="update-btn">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </button>
                        </div>
                        <h3><?= htmlspecialchars($project['name']) ?></h3>

                        <div class="project-card-content">
                            <p><?= htmlspecialchars($project['description']) ?></p>
                        </div>
                        <div class="project-card-footer">
                            <span class="project-status"> created in:
                                <?= htmlspecialchars($project['created_date']) ?></span>
                        </div>
                        <div>
                            <p><b>Assigned people: <span>chaima elomrani , malak elomrani</span></b></p>

                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </main>

    <!-- ********* update form ******** -->
    <form class="update-project-form" id="edit-form" method="POST" action="index.php?action=update_project">
        <div class="form-header">
            <h1 class="create-project-title">Project Details</h1>
            <button type="button" class="close-btn" id="close-btn">&times;</button>
        </div>
        <div class="form-content">
            <input type="hidden" id="edit-project-id" name="project_id">
            
            <div class="form-group">
                <label for="edit-project-name">Project Name</label>
                <input type="text" id="edit-project-name" name="project_name" required>
            </div>

            <div class="form-group">
                <label for="edit-project-description">Description</label>
                <textarea id="edit-project-description" name="project_description" required></textarea>
            </div>

            <div class="form-group-inline">
                <!-- <div class="form-group">
                    <label for="edit-created-date">Created Date</label>
                    <input type="date" id="edit-created-date" name="created_date" required>
                </div> -->
                <div class="form-group">
                    <label for="edit-due-date">Due Date</label>
                    <input type="date" id="edit-due-date" name="due_date" required>
                </div>
            </div>

            <div class="form-group">
                <label for="edit-project-type">Project Type</label>
                <select id="edit-project-type" name="project_type" required>
                    <option value="">Select type</option>
                    <option value="public">Public</option>
                    <option value="private">Private</option>
                </select>
            </div>

            <div class="form-group">
                <label for="assign-member">Assign Member</label>
                <div style="display: flex; gap: 0.5rem;">
                    <input type="text" id="assign-member" name="assign_member" placeholder="Enter member name">
                    <button type="button" id="add-member-btn" class="btn-secondary" style="padding: 0.75rem;">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>

            <div id="member-list-container">
                <ul id="member-list" class="member-list"></ul>
            </div>

            <button type="submit" class="submit-btn">Save Project</button>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const closeBtn = document.getElementById('close-btn');
            const editForm = document.getElementById('edit-form');
            const editButtons = document.querySelectorAll('.update-btn');

            // Populate form with project data
            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const projectCard = this.closest('.project-card');
                    
                    // Get project details from hidden inputs in the project card
                    const projectId = projectCard.querySelector('input[name="project_id"]').value;
                    const projectName = projectCard.querySelector('input[name="project_name"]').value;
                    const projectDescription = projectCard.querySelector('input[name="project_description"]').value;
                    const projectDueDate = projectCard.querySelector('input[name="project_due_date"]').value;

                    // Populate the edit form
                    document.getElementById('edit-project-id').value = projectId;
                    document.getElementById('edit-project-name').value = projectName;
                    document.getElementById('edit-project-description').value = projectDescription;
                    document.getElementById('edit-due-date').value = projectDueDate;

                    // Show the form
                    editForm.style.display = 'block';
                });
            });

            // Close form when close button is clicked
            closeBtn.addEventListener('click', () => {
                editForm.style.display = 'none';
            });
        });
    </script>

    <script src="js/project.js"></script>

</body>

</html>