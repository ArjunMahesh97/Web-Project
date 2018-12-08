-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 07, 2018 at 04:41 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spazzo`
--

DELIMITER $$
--
-- Functions
--
DROP FUNCTION IF EXISTS `insertUser`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `insertUser` (`email` VARCHAR(30), `name` VARCHAR(20), `pwd` VARCHAR(20), `invite` VARCHAR(20), `place` VARCHAR(20), `prof` VARCHAR(20), `web` VARCHAR(50)) RETURNS VARCHAR(20) CHARSET latin1 BEGIN
          DECLARE id VARCHAR(20);
          set id ='0';
          if not exists( select uid from users where email =  uid) 
          THEN
               insert into users (uid,fullname,passwords,invite_code,city,profession,website) values (email,name,pwd,invite,place,prof,web);
               select fullname into id from users where name=fullname;
               return id;
          ELSE               
               set id='0';
               return id;
          END IF;
     END$$

DROP FUNCTION IF EXISTS `validateUser`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `validateUser` (`email` VARCHAR(30), `pwd` VARCHAR(20)) RETURNS VARCHAR(30) CHARSET latin1 BEGIN
    	  DECLARE id VARCHAR(30);	
    	  set id= '0';	
          if exists( select * from users where email=uid and pwd=passwords) 
          THEN 
          	   select fullname
               into id 
               from users
               where uid=email;
               RETURN id;
          ELSE
               set id='0';
               RETURN id;
          END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image` (
  `uid` varchar(30) NOT NULL,
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `file` varchar(200) DEFAULT NULL,
  `views` int(11) DEFAULT '0',
  `likes` int(10) DEFAULT '0',
  PRIMARY KEY (`uid`,`image_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

DROP TABLE IF EXISTS `skills`;
CREATE TABLE IF NOT EXISTS `skills` (
  `uid` varchar(30) NOT NULL,
  `skill1` varchar(20) NOT NULL,
  `skill2` varchar(20) NOT NULL,
  `skill3` varchar(20) NOT NULL,
  `skill4` varchar(20) NOT NULL,
  `skill5` varchar(20) NOT NULL,
  `skill6` varchar(20) NOT NULL,
  `skill7` varchar(20) NOT NULL,
  `skill8` varchar(20) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `uid` varchar(30) NOT NULL,
  `fullname` varchar(20) NOT NULL,
  `passwords` varchar(20) NOT NULL,
  `invite_code` varchar(20) NOT NULL,
  `city` varchar(20) NOT NULL,
  `profession` varchar(20) NOT NULL,
  `website` varchar(50) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `fullname`, `passwords`, `invite_code`, `city`, `profession`, `website`) VALUES
('arjunmahesh97@gmail.com', 'arjun', 'abc123', '99999', 'bangalore', 'engineer', 'abc'),
('abc', 'a', 'abc', '12345', 'a', 'a', 'a'),
('abc@gmail.com', 's', 'abc123', '67854', 'a', 'a', 'a'),
('arjun97@gmail.com', 'a', 'aaa', '56577', 'a', 'a', 'a'),
('arjun11@gmail.com', 'arjunm', 'abc123', '69696', 'bangalore', 'engineer', 'abc@xyz'),
('aditya@gmail.com', 'aditya', 'abc', '02002', 'bangalore', 'engineer', 'https://mikewazowski.com'),
('adaitya@gmail.com', 'a', 'abc', '91234', 'a', 'a', 'http://a.com'),
('adaaitya@gmail.com', 'asdsad', 'aa', '10000', 'a', 'a', 'https://a.com'),
('akash@gmail.com', 'akash', 'abc123', '14545', 'a', 'a', 'https://a.com'),
('akash2@gmail.com', 'akash2', 'a', '98989', 'a', 'a', 'https://a.com'),
('adaaitnya@gmail.com', 'akash3', 'a', '85025', 'a', 'a', 'https:/a.com'),
('anusha@gmail.com', 'anusha', 'aaaaa', '88540', 'bangalore', 'nerd', 'https:/a.com'),
('mahesh@gmail.com', 'mahesh', 'a', '56395', 'a', 'a', 'https://a.com');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
