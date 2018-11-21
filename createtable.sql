CREATE TABLE `course` (
  `code` varchar(10) NOT NULL,
  `id` int(11) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `subject` varchar(10) NOT NULL,
  `language` varchar(5) NOT NULL,
  `periods` varchar(10) NOT NULL,
  `minects` int(11) NOT NULL,
  `maxects` int(11) NOT NULL,
  PRIMARY KEY (`code`)
);

CREATE TABLE `student` (
  `number` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`number`)
);

CREATE TABLE `keyword` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `word` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `attends` (
  `coursecode` varchar(10) NOT NULL,
  `stnumb` int(11) NOT NULL,
  `rate` int(11),
  PRIMARY KEY (`coursecode`,`stnumb`),
  KEY `stnumb` (`stnumb`),
  CONSTRAINT `attends_ibfk_1` FOREIGN KEY (`coursecode`) REFERENCES `course` (`code`),
  CONSTRAINT `attends_ibfk_2` FOREIGN KEY (`stnumb`) REFERENCES `student` (`number`)
);

CREATE TABLE `includes` (
  `kid` int(11) NOT NULL,
  `ccode` varchar(10) NOT NULL,
  PRIMARY KEY (`kid`,`ccode`),
  KEY `ccode` (`ccode`),
  CONSTRAINT `includes_ibfk_1` FOREIGN KEY (`ccode`) REFERENCES `course` (`code`),
  CONSTRAINT `includes_ibfk_2` FOREIGN KEY (`kid`) REFERENCES `keyword` (`id`)
)