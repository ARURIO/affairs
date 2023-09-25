DROP DATABASE IF EXISTS affairs;
CREATE DATABASE affairs
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;

USE affairs;

CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    date_registration TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    email VARCHAR(128),
    user_name VARCHAR(128),
    user_password CHAR(255)
);
CREATE TABLE projects (
    project_id INT AUTO_INCREMENT PRIMARY KEY,
    character_code VARCHAR(128),
    project_name VARCHAR(128),
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);
CREATE TABLE tasks (
    task_id INT AUTO_INCREMENT PRIMARY KEY,
    date_of_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status TINYINT(1) NOT NULL DEFAULT 0,
    name_tasks VARCHAR(255) NOT NULL,
    project_name VARCHAR(255) NOT NULL ,
    file_link VARCHAR(255),
    date_of_completion DATE,
    user_id INT,
    project_id INT,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (project_id) REFERENCES projects(project_id)
);

CREATE INDEX u_id ON users(user_id);
CREATE INDEX p_id ON projects(project_id);
CREATE INDEX t_id ON tasks(task_id);
CREATE INDEX t_status ON tasks(status);
