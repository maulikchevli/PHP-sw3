CREATE TABLE `followers` (
  `username` varchar(20) NOT NULL,
  `follower` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `followers`
--

INSERT INTO `followers` (`username`, `follower`) VALUES
('maulik', 'suprit'),
('maulik', 'harsh'),
('maulik', 'naman'),
('suprit', 'maulik'),
('suprit', 'harsh'),
('harsh', 'maulik');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `followers`
--
ALTER TABLE `followers`
  ADD KEY `username` (`username`),
  ADD KEY `follower` (`follower`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `followers`
--
ALTER TABLE `followers`
  ADD CONSTRAINT `followers_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`),
  ADD CONSTRAINT `followers_ibfk_2` FOREIGN KEY (`follower`) REFERENCES `user` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION;

