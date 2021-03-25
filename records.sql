DROP DATABASE records;

CREATE DATABASE records;

USE records;

create table admin(
    admin_username varchar(100),
    admin_password varchar (100),
    PRIMARY KEY(admin_username)
);

create table students(
    student_id int NOT NULL AUTO_INCREMENT,
    student_username varchar(50),
    student_password varchar(100),
    student_fname varchar(50),
    student_mname varchar(50),
    student_lname varchar(50),
    student_no varchar(10),
    student_degree_program varchar(20),
    student_college varchar(50),
    student_max_units float(4,2),
    PRIMARY KEY(student_id)
);

create table courses(
    course_id int NOT NULL AUTO_INCREMENT,
    course_code varchar(20),
    course_title varchar(100),
    course_units float(4,2),
    course_max_students int,
    PRIMARY KEY(course_id)
);

create table student_course_cart(
    s_c_id int NOT NULL AUTO_INCREMENT,
    student_id int,
    course_id int,
    FOREIGN KEY (student_id) REFERENCES students(student_id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (course_id) REFERENCES courses(course_id) ON DELETE CASCADE ON UPDATE CASCADE,
    PRIMARY KEY(s_c_id)
);

create table student_course_enrolled(
    s_c_id int NOT NULL AUTO_INCREMENT,
    student_id int,
    course_id int,
    FOREIGN KEY (student_id) REFERENCES students(student_id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (course_id) REFERENCES courses(course_id) ON DELETE CASCADE ON UPDATE CASCADE,
    PRIMARY KEY(s_c_id)
);