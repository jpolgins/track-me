CREATE TABLE `records` (
  `id` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `timeSpent` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `records` (`timeSpent`, `description`, `createdAt`) VALUES
('6h', 'Making test task for Scandiweb', '2018-11-01 20:07:53'),
('1h', 'Writing and putting on a play', '2018-11-01 16:07:53'),
('2h30m', 'Creating and producing a show.', '2018-11-01 16:07:53'),
('49m', 'Producing a short film ', '2018-10-01 16:07:53'),
('1m', 'Participating in writing, painting, ceramics and jewellery-making workshops and exhibiting the resulting creations', '2018-10-01 14:07:53'),
('22h', 'Singing in a choir.', '2018-10-01 11:07:53'),
('3h', 'Supporting various organizations or humanitarian causes throughout the year.', '2017-12-05 11:07:53'),
('4h50m', 'Actively participating in a committee to improve the school climate and physical environment.', '2017-11-05 11:07:53'),
('2h', 'Visiting and participating in activities in retirement homes.', '2017-11-05 12:07:53'),
('6h', 'Becoming involved in the student radio station or the student council.', '2017-10-05 12:07:53'),
('6h', 'Playing sports in an organized competitive association.', '2017-09-05 12:07:53'),
('1h', 'Doing sports for fun (football, hockey, soccer, long-distance running, badminton).', '2017-09-04 12:07:53');
