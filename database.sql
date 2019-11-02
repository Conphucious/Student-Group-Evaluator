USE EVAL;
DROP TABLE IF EXISTS user, user_group, course, enrollment, project, project_list, evaluation, student_evaluation, student_group, class_group;

CREATE TABLE user_group (
	id INT PRIMARY KEY,
    type VARCHAR(45) NOT NULL,
    is_admin TINYINT DEFAULT 0
);

-- Define user groups
INSERT INTO user_group 
	(id, type, is_admin)
VALUES 
	(1, 'Student', 0),
    (2, 'Instructor', 0),
    (3, 'Instructor', 1),
    (0, 'Administrator', 1);

CREATE TABLE user (
  id INT PRIMARY KEY,
  profile_image VARCHAR(45) DEFAULT 'images/default.png',
  name VARCHAR(45) NOT NULL,
  password VARCHAR(45) NOT NULL,
  email_address VARCHAR(45) NOT NULL UNIQUE,
  user_group_id INT REFERENCES user_group(id),
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Create administrator account for management system
INSERT INTO user
	(id, name, password, email_address, user_group_id) 
VALUES
    -- (111111111, 'Randolph Odendahl', 'password', 'randolph.odendahl@oswego.edu', 2),
	-- (805398914, 'Phuc Nguyen', 'password', 'pnguyen3@oswego.edu', 1),
    (000000000, 'Admin', 'password', 'admin@localhost.com', 0);


CREATE TABLE course (
	id INT AUTO_INCREMENT PRIMARY KEY,
    code TEXT NOT NULL,
    section TEXT,
    name TEXT NOT NULL,
    description TEXT,
    instructor_id INT REFERENCES user(id)
);

CREATE TABLE enrollment (
	id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT REFERENCES user(id),
    course_id INT REFERENCES course(id),
    enroll_date DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE project (
	id INT AUTO_INCREMENT PRIMARY KEY,
    name TEXT NOT NULL,
    description TEXT
);

CREATE TABLE project_list (
	id INT AUTO_INCREMENT PRIMARY KEY,
    project_id INT REFERENCES project(id),
	course_id INT REFERENCES course(id)
);

CREATE TABLE evaluation (
	id INT AUTO_INCREMENT PRIMARY KEY,
    sender_id INT REFERENCES user(id),
    recipient_id INT REFERENCES user(id),
    points INT(1) NOT NULL,
    comments TEXT,
    posted_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE student_evaluation (
	id INT AUTO_INCREMENT PRIMARY KEY,
    eval_id INT REFERENCES evaluation(id),
    project_id INT REFERENCES project(id)
);

CREATE TABLE student_group (
	id INT AUTO_INCREMENT PRIMARY KEY,
    project_id INT REFERENCES project(id),
	student_id INT REFERENCES user(id)
);


