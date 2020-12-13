CREATE DATABASE roster;

DROP TABLE IF EXISTS `Member`;
DROP TABLE IF EXISTS `User`;
DROP TABLE IF EXISTS `Course`;

CREATE TABLE `User` (
    user_id     INTEGER NOT NULL AUTO_INCREMENT,
    name        VARCHAR(128) UNIQUE,
    PRIMARY KEY(user_id)
) ENGINE=InnoDB CHARACTER SET=utf8;

INSERT INTO `user`(`user_id`, `name`) VALUES
(1,"Greer"),
(2,"Aiva"),
(3,"Eduards"),
(4,"Finnen"),
(5,"Suzi"),
(6,"Zak"),
(7,"Aisha"),
(8,"Astra"),
(9,"Nick"),
(10,"Oluwatoni"),
(11,"Janie"),
(12,"Andrew"),
(13,"Christy"),
(14,"Peggy"),
(15,"Shaw");


CREATE TABLE Course (
    course_id     INTEGER NOT NULL AUTO_INCREMENT,
    title         VARCHAR(128) UNIQUE,
    PRIMARY KEY(course_id)
) ENGINE=InnoDB CHARACTER SET=utf8;


INSERT INTO `course`(`course_id`, `title`) VALUES 
(1,"si106"),
(2,"si110"),
(3,"si206");


CREATE TABLE Member (
    user_id       INTEGER,
    course_id     INTEGER,
    role          INTEGER,

    CONSTRAINT FOREIGN KEY (user_id) REFERENCES `User` (user_id)
      ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT FOREIGN KEY (course_id) REFERENCES Course (course_id)
       ON DELETE CASCADE ON UPDATE CASCADE,

    PRIMARY KEY (user_id, course_id)
) ENGINE=InnoDB CHARACTER SET=utf8;

INSERT INTO `member`(`user_id`, `course_id`, `role`) VALUES
(6,2,1),
(12,3,0),
(7,2,0),
(13,3,0),
(8,2,0),
(9,2,0),
(2,1,0),
(14,3,0),
(15,3,0),
(3,1,0),
(4,1,0),
(11,3,1),
(1,1,1),
(10,2,0),
(5,1,0);



-- Greer, si106, Instructor
-- Aiva, si106, Learner
-- Eduards, si106, Learner
-- Finnen, si106, Learner
-- Suzi, si106, Learner
-- Zak, si110, Instructor
-- Aisha, si110, Learner
-- Astra, si110, Learner
-- Nick, si110, Learner
-- Oluwatoni, si110, Learner
-- Janie, si206, Instructor
-- Andrew, si206, Learner
-- Christy, si206, Learner
-- Peggy, si206, Learner
-- Shaw, si206, Learner

