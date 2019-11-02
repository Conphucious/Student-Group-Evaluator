use eval;
SET SQL_SAFE_UPDATES = 0;

TRUNCATE TABLE user; 
TRUNCATE TABLE course;
TRUNCATE TABLE enrollment;
TRUNCATE TABLE project; 
TRUNCATE TABLE project_list; 
TRUNCATE TABLE evaluation;
TRUNCATE TABLE student_evaluation;
TRUNCATE TABLE student_group;

					-- Test Users
INSERT INTO user
	(id, name, password, email_address, user_group_id) 
VALUES
-- Instructors (starts with 9) 9 digits
	(900000001, 'Randolph Odendahl', 'password', 'randolph.odendahl@oswego.edu', 3),
	(900000002, 'James P Early', 'password', 'james.early@oswego.edu', 2),
    (900000003, 'Daniel Schlegel', 'password', 'daniel.schlegel@oswego.edu', 2),
    (900000004, 'Jae Wong Lee', 'password', 'jaewoong.lee@oswego.edu', 2),
-- Students (starts with 1) 9 digits
	(100000001, 'Emily Bozogian', 'password', 'ebozogia@oswego.edu', 1),
	(100000002, 'Emily Domicolo', 'password', 'edomicol@oswego.edu', 1),
	(100000003, 'Zachary Gudlin', 'password', 'zgudlin@oswego.edu', 1),
	(100000004, 'Lindsey Garrigues', 'password', 'lgarrigu@oswego.edu', 1),
	(805398914, 'Phuc Nguyen', 'password', 'pnguyen3@oswego.edu', 1);


					-- Courses with instructors
INSERT INTO course 
	(code, section, name, description, instructor_id)
VALUES
	('CSC 399', '205 Spring 2019', 'Independent Study', 'Database applications', 900000001),
    ('ISC 330', '800 Spring 2019', 'Telecommunications', 'Learn about stuff', 900000001),
    ('CSC 322', '429 Spring 2019', 'Systems Programming', 'C and ASM', 900000004),
    ('CSC 482', '388 Spring 2019', 'Software Deployment', 'GOlang, Docker, AWS', 900000002),
    ('CSC 344', '571 Spring 2019', 'Programming Languages', 'C, Clojure, Scala, Prolog, Python', 900000003);

					-- Enroll students into courses
INSERT INTO enrollment
	(user_id, course_id)
VALUES
	(100000001, 2), -- emily b, ISC 330
    (100000002, 5), -- emily d, CSC 344
    (100000003, 4), -- zach, 482
    (805398914, 4), -- me, 482
    (100000004, 1), -- lindsey, CSC 399
    (805398914, 1); -- me, CSC 399
    
					-- Create projects
INSERT INTO project 
	(name, description)
VALUES
	('Turing Machine in C', 'Create a working turing machine in C'),
    ('Bomblab', 'Defuse the bomb before the due date'),
    ('C Palindrome', 'Write in C a program that checks palindrome words'),
    ('Wire Shark', 'Analyze the network data packets'),
	('Golang api', 'Get an API and make pull requests successfully'),
	('Golang unmarshall', 'Unmarshall an API pull request into a struct in go'),
    ('Custom Project', 'Create your own project using a database');
    
					-- Assign projects to their respective classes
INSERT INTO project_list 
	(project_id, course_id) 
VALUES 
    (1, 5),
    (2, 3),
    (3, 3),
    (4, 2),
    (5, 4),
    (6, 4),
    (7, 1);
    
    
INSERT INTO student_group (project_id, student_id) VALUE (7, 100000004);
INSERT INTO student_group (project_id, student_id) VALUE (7, 805398914);
INSERT INTO student_group (project_id, student_id) VALUE (7, 100000001);
INSERT INTO enrollment (user_id, course_id) VALUES (805398914, 2);

					-- Lindsey gives ME an eval
INSERT INTO evaluation (sender_id, recipient_id, points, comments) VALUE (100000004, 805398914, 1, 'The best at eeverything');
INSERT INTO student_evaluation (eval_id, project_id) VALUE (1, 7)



    