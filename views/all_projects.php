<?php
// session_start();
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
    <link rel="stylesheet" href="./styles/all_projects.css">
    

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
                <div class="projects-header-content">
                    <div class="projects-header-text">
                        <h1 class="projects-title">All Projects</h1>
                        <p class="projects-subtitle">View and manage all your ongoing and completed projects.</p>
                    </div>
                    <div class="projects-header-actions">
                        <button id="assignProjectsBtn" class="btn btn-secondary">
                            <i class="fas fa-users"></i> Assign Projects & Members
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Assign Projects and Members Modal -->
        <div id="assignProjectsModal" class="modal">
            <div class="modal-content">
                <span class="close-modal">&times;</span>
                <h2>Assign Projects and Members</h2>
                <form id="assignProjectForm" method="POST">
                    <div class="form-group">
                        <label for="projectsSelect">Select Projects</label>
                        <select id="projectsSelect">
                            <?php foreach ($projects as $project): ?>
                                <option value="<?php echo $project['id']; ?>">
                                    <?php echo htmlspecialchars($project['name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="assign-member">Assign Member</label>
                        <div style="display: flex; gap: 0.5rem;">
                            <input type="email" id="assign-member" name="assign_member"
                                placeholder="Enter member email">
                            <button type="button" id="add-member-btn" class="btn-secondary" style="padding: 0.75rem;">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>

                    <div id="member-list-container">
                        <ul id="member-list" class="member-list"></ul>
                    </div>

                    <input type="submit" class="btn btn-primary" value="Assign">
                </form>
            </div>
        </div>

        <div class="container">
            <?php
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
                        <div class="project-actions">
                            <a href="index.php?page=tasks_page&id_project=<?php echo $project['id']; ?>" 
                                class="view-tasks-btn">
                                <i class="fas fa-tasks"></i> View Tasks
                            </a>
                           
                        </div>
                        <input type="hidden" name="project_id" value="<?php echo $project['id']; ?>">
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

            <button type="submit" class="submit-btn">Save Project</button>
        </div>
    </form>


     <script src="./js/assignement.js" ></script>
    <script src="./js/project.js"></script>
      
</body>

</html> 