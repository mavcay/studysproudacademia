
CREATE DATABASE ssprout_db;

USE ssprout_db;

CREATE TABLE admin (
  Admin_ID INT NOT NULL AUTO_INCREMENT,
  Admin_FName VARCHAR(35) NOT NULL,
  Admin_LName VARCHAR(35) NOT NULL,
  Admin_MInitial VARCHAR(5),
  Admin_Email VARCHAR(50) NOT NULL,
  Admin_Password VARCHAR(25) NOT NULL,
  Admin_PhoneNum VARCHAR(20),
  PRIMARY KEY (Admin_ID)
);

CREATE TABLE student (
  Student_ID INT NOT NULL AUTO_INCREMENT,
  Student_FName VARCHAR(35) NOT NULL,
  Student_LName VARCHAR(35) NOT NULL,
  Student_MInitial VARCHAR(5),
  Student_Email VARCHAR(50) NOT NULL,
  Student_Password VARCHAR(25) NOT NULL,
  Student_PhoneNum VARCHAR(20),
  Student_GradeLevel INTEGER NOT NULL,
  PRIMARY KEY (Student_ID)
);

CREATE TABLE teacher (
  Teacher_ID INT NOT NULL AUTO_INCREMENT,
  Teacher_FName VARCHAR(35) NOT NULL,
  Teacher_LName VARCHAR(35) NOT NULL,
  Teacher_MInitial VARCHAR(5),
  Teacher_Email VARCHAR(50) NOT NULL,
  Teacher_Password VARCHAR(25) NOT NULL,
  Teacher_PhoneNum VARCHAR(20),
  PRIMARY KEY (Teacher_ID)
);

CREATE TABLE subject (
  Subject_ID INT NOT NULL AUTO_INCREMENT,
  Subject_Name VARCHAR(40) NOT NULL,
  Subject_Description VARCHAR(200),
  Subject_Schedule VARCHAR(60),
  Subject_Section VARCHAR(40),
  PRIMARY KEY (Subject_ID)
);

CREATE TABLE content (
  Content_ID INT NOT NULL AUTO_INCREMENT,
  Content_Type VARCHAR(50) NOT NULL,
  Content_Title VARCHAR(40) NOT NULL,
  Content_Website VARCHAR(50) NOT NULL,
  Content_Link VARCHAR(170) NOT NULL,
  Subject_ID INT NOT NULL,
  Teacher_ID INT NOT NULL,
  PRIMARY KEY (Content_ID)
);

CREATE TABLE enrollment (
  Student_ID INT NOT NULL,
  Subject_ID INT NOT NULL,
  Payment_Status VARCHAR(30) NOT NULL DEFAULT 'Not Paid',
  Stud_FinalGrade DOUBLE(5,2),
  Remarks VARCHAR(20),
  PRIMARY KEY (Student_ID, Subject_ID)
);

CREATE TABLE assignment (
  Teacher_ID INT NOT NULL,
  Subject_ID INT NOT NULL,
  PRIMARY KEY (Teacher_ID, Subject_ID)
);



ALTER TABLE enrollment
ADD CONSTRAINT fk_stud_id_enr
FOREIGN KEY (Student_ID)
REFERENCES student(Student_ID);

ALTER TABLE enrollment
ADD CONSTRAINT fk_sub_id_enr
FOREIGN KEY (Subject_ID)
REFERENCES subject(Subject_ID);

ALTER TABLE assignment
ADD CONSTRAINT fk_tec_id_as
FOREIGN KEY (Teacher_ID)
REFERENCES teacher(Teacher_ID);

ALTER TABLE assignment
ADD CONSTRAINT fk_sub_id_as
FOREIGN KEY (Subject_ID)
REFERENCES subject(Subject_ID);

ALTER TABLE content
ADD CONSTRAINT fk_tec_id_con
FOREIGN KEY (Teacher_ID)
REFERENCES teacher(Teacher_ID);

ALTER TABLE content
ADD CONSTRAINT fk_sub_id_con
FOREIGN KEY (Subject_ID)
REFERENCES subject(Subject_ID);

ALTER TABLE student AUTO_INCREMENT=10000;
ALTER TABLE teacher AUTO_INCREMENT=1000;
ALTER TABLE admin AUTO_INCREMENT=100;

INSERT INTO admin (
  Admin_FName, 
  Admin_LName, 
  Admin_MInitial, 
  Admin_Email, 
  Admin_Password, 
  Admin_PhoneNum	
) 
VALUES (
  'John', 
  'Doe', 
  'A', 
  'johndoe@example.com', 
  'securePassword123', 
  '9123456789'
);
