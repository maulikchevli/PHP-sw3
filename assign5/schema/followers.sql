CREATE TABLE `followers` (
  `username` varchar(20) NOT NULL,
  `follower` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `followers`
--

INSERT INTO `followers` (`username`, `follower`) VALUES
('maulikchevli', 'mau'),
('mau', 'maulikchevli'),
('maulikchevli', 'MaulikMaulik'),
('naman', 'MaulikMaulik'),
('mau', 'naman'),
('maulikchevli', 'naman');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`username`,`follower`),
  ADD KEY `follower` (`follower`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `followers`
--
ALTER TABLE `followers`
  ADD CONSTRAINT `followers_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `followers_ibfk_2` FOREIGN KEY (`follower`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

