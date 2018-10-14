CREATE TABLE `student` (
  `rollNum` char(8) NOT NULL,
  `name` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` text NOT NULL,
  `registeredCourse` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `student`
  ADD PRIMARY KEY (`rollNum`);

-- 
CREATE TABLE `course` (
  `rollNum` char(8) NOT NULL,
  `elective` varchar(20) NOT NULL,
  `club` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `course`
  ADD PRIMARY KEY (`rollNum`);

ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`rollNum`) REFERENCES `student` (`rollNum`);
