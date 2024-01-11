--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `students` (
                                           `id` int(11) NOT NULL AUTO_INCREMENT,
                                           `name` varchar(100) NOT NULL,
                                           `email` varchar(50) NOT NULL,
                                           PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET = latin1 AUTO_INCREMENT = 4;

--
-- Dumping data for table `employees`
--

INSERT INTO `students` (`id`, `name`, `email`) VALUES
                    (1, 'Jackie Ross', 'jackie.ross@example.com'),
                    (2,'Logan Bennett', 'logan.bennett@example.com'),
                    (3, 'Judy Fuller', 'judy.fuller@example.com');