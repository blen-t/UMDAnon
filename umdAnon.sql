DROP DATABASE IF EXISTS umdAnon;

CREATE DATABASE umdAnon;

CREATE TABLE IF NOT EXISTS admin(
    admin_id INT AUTO_INCREMENT,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    UID INT,
	  directoryid VARCHAR(255) NOT NULL,
	  pass VARCHAR(255) NOT NULL,
    PRIMARY KEY (admin_id)
);

CREATE TABLE IF NOT EXISTS departments(
	department_id INT AUTO_INCREMENT,
    department_name VARCHAR(225) NOT NULL,
    PRIMARY KEY(department_id)
);

CREATE TABLE IF NOT EXISTS comments(
	  comment_id INT AUTO_INCREMENT,
    comment_text VARCHAR(225) NOT NULL,
    time_entered TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    department_id INT NOT NULL,
    PRIMARY KEY(comment_id),
    FOREIGN KEY(department_id)
		REFERENCES departments(department_id)
);

INSERT INTO departments (department_id, department_name)
	VALUES (1, "dining"), (2, "DOTS"), (3, "Health and wellness"), (4, "Academic concerns"),
    (5, "Campus concerns"), (6, "Housing concerns");

INSERT INTO admin (admin_id, first_name, last_name, UID,directoryid,pass)
	VALUES (1, "George", "Baker", 123456789,"George",123456),
  (2, "Admin", "User", 111111111, "admin", "admin"),
  (3, "Donal", "Heidenblad", 222222222,"donal",123456); =
