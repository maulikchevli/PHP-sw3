CREATE TABLE `customer` (
  `rollNum` char(8) NOT NULL,
  `name` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `customer`
  ADD PRIMARY KEY (`rollNum`);

-- 

CREATE TABLE `files` (
  `rollNum` char(8) NOT NULL,
  `fileName` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `files`
  ADD KEY `rollNum` (`rollNum`);

ALTER TABLE `files`
  ADD CONSTRAINT `files_ibfk_1` FOREIGN KEY (`rollNum`) REFERENCES `customer` (`rollNum`) ON DELETE CASCADE ON UPDATE CASCADE;

