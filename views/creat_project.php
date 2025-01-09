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
    <link rel="stylesheet" href="./styles/projects_form.css">
   
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
                    <!-- <div class="form-group">
                        <label for="created-date">Created Date</label>
                        <input type="date" id="created-date" name="created-date" required>
                    </div> -->
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
                <div class="form-group">
                <label for="assignMember">Assign Member</label>
                <div style="display: flex; gap: 0.5rem;">
                    <input type="text" id="assignMember" name="assignMember" placeholder="Enter member name">
                    <button type="button" id="addMemberBtn" class="btn btn-secondary">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>

            <div id="memberListContainer">
                <ul id="memberList" class="member-list"></ul>
            </div>
                <button type="submit" class="submit-btn">Create Project</button>
            </form>
        </div>
    </main>



    <script src="./js/creat_project.js" ></script>

    
</body>

</html>