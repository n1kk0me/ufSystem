# ufSystem

###### Database ######

CREATE TABLE `apptable` (
  `userID` int(11) NOT NULL,
  `userNo` var(11) NOT NULL,
  `userEmail` varchar(60) NOT NULL,
  `userPass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;