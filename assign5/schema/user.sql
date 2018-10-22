CREATE TABLE `user` (
  `username` varchar(20) NOT NULL,
  `userType` int(2) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `birthDate` date NOT NULL,
  `bio` text,
  `emailVerified` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `userType`, `firstName`, `lastName`, `email`, `password`, `birthDate`, `bio`, `emailVerified`) VALUES
('mau', 1, 'maulik', 'maulik', 'maulikchevliwork@gmail.com', '$2y$10$N642YKQdKh0JBQAkoQ/cduVhl7v9Hi8a/D4vPWRYb62zqHKekEG4q', '2018-10-01', 'Hey there! This is my first account.\r\n\r\nhehe :)', 0),
('maulikchevli', 2, 'maulik', 'chevli', 'maulikchevliwork@gmail.com', '$2y$10$UnSUqbq3kqm9Rj7Mp4SZuOMB1RYzRsappAN1Sk9vRyKaK0goaUBBS', '2018-10-03', 'jjajajaj', 1),
('MaulikMaulik', 1, 'maulik', 'maulik', 'maulik@maulik', '$2y$10$1CyWCRRVgoWK7v6Baj0DiOclBLwFbXExC88lf7u9WzO4NE1ahwcpi', '1998-11-11', 'its me.', 0),
('naman', 1, 'naman', 'chevli', 'maulikchevliwork@gmail.com', '$2y$10$fJWqechATtW86aDstk8Zmek8nylpEi/OTFTmU0vHZGJMB4.tVQcVG', '1999-01-15', 'Hello!', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

