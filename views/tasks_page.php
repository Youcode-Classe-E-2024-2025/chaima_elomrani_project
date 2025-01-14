<?php
$project = $_GET['id_project'];
require_once('./models/tasks_model.php');
require_once('./controllers/delete_task.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProManage - My Tasks</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./styles/tasks.css">

</head>

<body>
    <style>
        .add-member {
            /* position : absolute; */
            top: 20px;
            right: 80px;
            width: 20px;
            height: 25px;
            background: none;
            border: none;
            cursor: pointer;
            color: black;
            /* color: red; */
            font-size: 1rem;
            /* transition: color 0.3s ease;     */

        }
    </style>
    <nav>
        <div class="container nav-container">
            <a href="#" class="logo">ProManage</a>
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
                    <div class="task-list">
                        <?php
                        foreach ($tasks as $task):
                            if ($task['status'] === 'ToDo'):
                                ?>
                                <div class="task-card" draggable="true">
                                    <div class="icons">

                                        <form method="POST" action="index.php?action=delete_task"
                                            onsubmit="return confirm('Are you sure you want to delete this project?');">
                                            <input type="hidden" name="project_id" value="<?= htmlspecialchars($task['id']) ?>">
                                            <button type="submit" class="delete-btn">
                                                <i class="fa-solid fa-trash icon"></i>
                                            </button>
                                        </form>
                                        <form method="POST" action="index.php?action=edit_task">
                                            <input type="hidden" name="project_id" value="<?= htmlspecialchars($task['id']) ?>">
                                            <button type="submit" class="update-btn">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </button>
                                        </form>
                                      
                                    </div>
                                    <a href="" class="add-member">
                                            <i class="fa-solid fa-user"></i>
                                        </a>

                                    <h4><?= htmlspecialchars($task['name']) ?></h4>
                                    <!-- <span class="tag">urgent</span> -->
                                    <p><?= htmlspecialchars($task['description']) ?></p>
                                    <div class="task-meta">
                                        <span
                                            class="task-project"><?= htmlspecialchars($task['category_name'] ?? 'Uncategorized') ?></span>
                                        <span class="task-due-date"><i class="far fa-calendar"></i>
                                            <?= htmlspecialchars($task['start_date']) ?></span>
                                    </div>
                                </div>
                                <?php
                            endif;
                        endforeach;
                        ?>
                    </div>
                </div>


                <div class="task-column" id="inprogress-column">
                    <h3><i class="fas fa-spinner"></i> In Progress</h3>
                    <div class="task-list">
                        <?php
                        foreach ($tasks as $task):
                            if ($task['status'] === 'In Progress'):
                                ?>
                                <div class="task-card" draggable="true">
                                    <div class="icons">
                                        <form method="POST" action="index.php?action=delete_task"
                                            onsubmit="return confirm('Are you sure you want to delete this project?');">
                                            <input type="hidden" name="project_id" value="<?= htmlspecialchars($task['id']) ?>">
                                            <button type="submit" class="delete-btn">
                                                <i class="fa-solid fa-trash icon"></i>
                                            </button>
                                        </form>
                                        <form method="POST" action="index.php?action=edit_task">
                                            <input type="hidden" name="project_id" value="<?= htmlspecialchars($task['id']) ?>">
                                            <button type="submit" class="update-btn">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <a href="" class="add-member">
                                        <i class="fa-solid fa-user"></i>
                                    </a>
                                    <h4><?= htmlspecialchars($task['name']) ?></h4>
                                    <p><?= htmlspecialchars($task['description']) ?></p>
                                    <div class="task-meta">
                                        <span
                                            class="task-project"><?= htmlspecialchars($task['category_name'] ?? 'Uncategorized') ?></span>
                                        <span class="task-due-date"><i class="far fa-calendar"></i>
                                            <?= htmlspecialchars($task['start_date']) ?></span>
                                    </div>
                                </div>
                                <?php
                            endif;
                        endforeach;
                        ?>
                    </div>
                </div>

                <div class="task-column" id="done-column">
                    <h3><i class="fas fa-check"></i> Done</h3>
                    <div class="task-list">
                        <?php
                        foreach ($tasks as $task):
                            if ($task['status'] === 'Done'):
                                ?>
                                <div class="task-card" draggable="true">
                                    <div class="icons">
                                        <form method="POST" action="index.php?action=delete_task"
                                            onsubmit="return confirm('Are you sure you want to delete this project?');">
                                            <input type="hidden" name="project_id" value="<?= htmlspecialchars($task['id']) ?>">
                                            <button type="submit" class="delete-btn">
                                                <i class="fa-solid fa-trash icon"></i>
                                            </button>
                                        </form>
                                        <form method="POST" action="index.php?action= edit_task">
                                            <input type="hidden" name="project_id" value="<?= htmlspecialchars($task['id']) ?>">
                                            <button type="submit" class="update-btn">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </button>
                                        </form>
                                       
                                    </div>
                                    <a href="" class="add-member" id="add-member">
                                            <i class="fa-solid fa-user"></i>
                                        </a>


                                    <h4><?= htmlspecialchars($task['name']) ?></h4>
                                    <p><?= htmlspecialchars($task['description']) ?></p>
                                    <div class="task-meta">
                                        <span
                                            class="task-project"><?= htmlspecialchars($task['category_name'] ?? 'Uncategorized') ?></span>
                                        <span class="task-due-date"><i class="far fa-calendar"></i>
                                            <?= htmlspecialchars($task['start_date']) ?></span>
                                    </div>
                                </div>
                                <?php
                            endif;
                        endforeach;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div id="taskModal" class="modal">
        <div class="modal-content">
            <span class="close" id="close">&times;</span>
            <h2>Add New Task</h2>
            <form id="taskForm" action="index.php?action=task_controller" method="POST">
                <input type="hidden" name="action" value="add_task">
                <input type="hidden" name="project_id" value="<?php echo $project; ?>">
                <div class="form-group">
                    <label for="task_name">Title</label>
                    <input type="text" id="title" name="task_name" required>
                </div>
                <div class="form-group">
                    <label for="task_description">Description</label>
                    <textarea id="description" name="task_description"></textarea>
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
                        <option value="ToDo">To Do</option>
                        <option value="In Progress">In Progress</option>
                        <option value="Done">Done</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="type">Tag</label>
                    <select id="type" name="tag" multiple>

                        <?php
                        foreach ($tags as $tag) {
                            ?>
                            <option value="<?php echo htmlspecialchars($tag['id']) ?>">
                                <?php echo htmlspecialchars($tag['name']) ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select id="category" name="category">
                        <option value="">Select Category</option>
                        <?php
                        foreach ($categories as $category) {
                            ?>
                            <option value="<?php echo htmlspecialchars($category['id']) ?>">
                                <?php echo htmlspecialchars($category['name']) ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="dueDate">Due Date</label>
                    <input type="date" id="dueDate" name="dueDate" required>
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
    <script src="./js/tasks.js"></script>

    {{ ... }}
    </div>
    </main>

    <!-- Update Task Modal -->
    <div id="updateTaskModal" class="modal">
        <div class="modal-content">
            <span class="close-btn">&times;</span>
            <h2>Update Task</h2>
            <form id="updateTaskForm" method="POST" action="index.php?action=update_task">
                <input type="hidden" id="update-task-id" name="task_id" value="">

                <div class="form-group">
                    <label for="update-task-name">Task Name</label>
                    <input type="text" id="update-task-name" name="task_name" required>
                </div>

                <div class="form-group">
                    <label for="update-task-description">Description</label>
                    <textarea id="update-task-description" name="task_description" rows="4"></textarea>
                </div>

                <div class="form-group">
                    <label for="type">Tag</label>
                    <select id="type" name="tag" multiple>

                        <?php
                        foreach ($tags as $tag) {
                            ?>
                            <option value="<?php echo htmlspecialchars($tag['id']) ?>">
                                <?php echo htmlspecialchars($tag['name']) ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select id="category" name="category">
                        <option value="">Select Category</option>
                        <?php
                        foreach ($categories as $category) {
                            ?>
                            <option value="<?php echo htmlspecialchars($category['id']) ?>">
                                <?php echo htmlspecialchars($category['name']) ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="update-task-status">Status</label>
                    <select id="update-task-status" name="task_status">
                        <option value="ToDo">To Do</option>
                        <option value="In Progress">In Progress</option>
                        <option value="Done">Done</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="update-task-start-date">Start Date</label>
                    <input type="date" id="update-task-start-date" name="task_start_date">
                </div>

                <div class="form-group">
                    <label for="update-task-due-date">Due Date</label>
                    <input type="date" id="update-task-due-date" name="task_due_date">
                </div>

                <button type="submit" class="update">Update Task</button>
            </form>
        </div>
    </div>





<!-- form to assign task  -->
    <div id="form_to_assign">
      <div id="assignTasksModal" class="assign_task_modal">
      <div class="modal-content" id="modal-content">
                <span class="close-modal">&times;</span>
                <h2>Assign Projects and Members</h2>
                <form id="assignTaskForm" method="POST">
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
       </div>

    <script src="./js/tasks.js"></script>

</body>

</html>