DROP DATABASE IF EXISTS affairs;
CREATE DATABASE affairs
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;

USE affairs;

CREATE TABLE users (
    id_users INT AUTO_INCREMENT PRIMARY KEY,
    date_registration TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    email VARCHAR(128),
    user_name VARCHAR(128),
    user_password CHAR(255)
);
CREATE TABLE categories (
    id_categories INT AUTO_INCREMENT PRIMARY KEY,
    name_category VARCHAR(128),
    id_users INT,
    FOREIGN KEY (id_users) REFERENCES users(id_users)
);
CREATE TABLE tasks (
    id_tasks INT AUTO_INCREMENT PRIMARY KEY,
    date_of_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status TINYINT(1) NOT NULL DEFAULT 0,
    name_tasks VARCHAR(255) NOT NULL,
    file_link VARCHAR(255),
    date_of_completion DATE,
    id_users INT,
    id_categories INT,
    FOREIGN KEY (id_users) REFERENCES users(id_users),
    FOREIGN KEY (id_categories) REFERENCES categories(id_categories)
);

CREATE INDEX u_id N users(id_users);
CREATE INDEX c_id ON categories(id_categories);
CREATE INDEX t_id ON tasks(id_tasks);
CREATE INDEX t_status ON tasks(status);
