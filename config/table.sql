
CREATE DATABASE project_management;
USE project_management;


CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role INT NOT NULL,
    FOREIGN KEY (role) REFERENCES roles(id),
);

CREATE TABLE task_to_user (
    id INT AUTO_INCREMENT PRIMARY KEY ,
    tasks_id INT,
    user_id INT ,
    FOREIGN key (tasks_id) REFERENCES tasks(id),
    FOREIGN key (user_id) REFERENCES users(id)
    
);

CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name ENUM('admin', 'team_member') NOT NULL
);


CREATE TABLE projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    created_date DATE NOT NULL,
    type ENUM('private', 'public') NOT NULL,
    chef_id INT not null , 
    FOREIGN KEY (chef_id) REFERENCES users(id)
);




CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    start_date DATE,
    due_date DATE,
    status ENUM('ToDo', 'In Progress', 'Done') NOT NULL,
    category INT , 
    project_id INT,
    assigned_user_id INT,
    tag INT , 
    FOREIGN KEY (tag) REFERENCES tags(id),
    FOREIGN KEY (category) REFERENCES category(id),
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE,
    FOREIGN KEY (assigned_user_id) REFERENCES users(id) ON DELETE SET NULL
);


CREATE TABLE category (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);


CREATE TABLE tags (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);


CREATE TABLE team_members (
    user_id INT,
    project_id INT,
    PRIMARY KEY (user_id, project_id),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE
);


-- insertion *******************************
INSERT INTO roles (name) VALUES
('admin'),
('team_member');

INSERT INTO users (name, email, password, role) VALUES
('Alice', 'alice@example.com', 'password123', 1),
('Bob', 'bob@example.com', 'password123', 2),
('Charlie', 'charlie@example.com', 'password123', 2),
('Diana', 'diana@example.com', 'password123', 2),
('Eve', 'eve@example.com', 'password123', 1),
('Frank', 'frank@example.com', 'password123', 2),
('Grace', 'grace@example.com', 'password123', 2);

INSERT INTO category (name) VALUES
('Bug Fix'),
('Feature Development'),
('Testing'),
('Documentation'),
('Design');


INSERT INTO tags (name) VALUES
('Urgent'),
('High Priority'),
('Low Priority'),
('Enhancement'),
('Backend'),
('Frontend'),
('Database');


INSERT INTO projects (name, description, created_date, type, chef_id) VALUES
('Website Redesign', 'Redesign the company website.', '2024-01-01', 'private', 1),
('Mobile App Development', 'Develop a new mobile app.', '2024-02-15', 'public', 5),
('API Integration', 'Integrate APIs for the existing project.', '2024-03-10', 'private', 1),
('Database Optimization', 'Optimize the database for better performance.', '2024-04-05', 'public', 5),
('Marketing Campaign', 'Launch a new marketing campaign.', '2024-05-20', 'private', 1);


INSERT INTO tasks (name, description, start_date, due_date, status, category, project_id, assigned_user_id, tag) VALUES
('Create Wireframes', 'Design the wireframes for the homepage.', '2024-01-10', '2024-01-20', 'In Progress', 5, 1, 2, 6),
('Fix Login Bug', 'Resolve the issue with user login.', '2024-01-15', '2024-01-18', 'ToDo', 1, 3, 3, 1),
('Backend API Development', 'Develop APIs for user management.', '2024-02-01', '2024-02-10', 'Done', 2, 2, 2, 5),
('Database Indexing', 'Add indexes to improve query speed.', '2024-02-05', '2024-02-15', 'ToDo', 4, 4, 6, 7),
('Write User Guide', 'Document the application features.', '2024-03-01', '2024-03-10', 'ToDo', 3, 1, 7, 4),
('UI Testing', 'Test the user interface for usability.', '2024-03-05', '2024-03-15', 'In Progress', 3, 1, 2, 2),
('Set Up CI/CD Pipeline', 'Implement continuous integration and deployment.', '2024-04-01', '2024-04-10', 'Done', 2, 2, 1, 3);



INSERT INTO task_to_user (tasks_id, user_id) VALUES
(1, 2),
(2, 3),
(3, 2),
(4, 4),
(5, 1),
(6, 2),
(7, 1);


INSERT INTO team_members (user_id, project_id) VALUES
(2, 1),
(3, 1),
(4, 1),
(5, 2),
(6, 2),
(7, 3),
(1, 4),
(2, 4),
(3, 5);


