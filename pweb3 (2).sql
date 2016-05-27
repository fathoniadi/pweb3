-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 28, 2016 at 04:06 AM
-- Server version: 5.5.49-0ubuntu0.14.04.1
-- PHP Version: 5.5.35-1+donate.sury.org~trusty+4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pweb3`
--

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(100) DEFAULT NULL,
  `owner` varchar(100) DEFAULT NULL,
  `Event_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`group_id`),
  KEY `group_ibfk_1` (`owner`),
  KEY `group_ibfk_2` (`Event_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`group_id`, `group_name`, `owner`, `Event_id`) VALUES
(1, 'bersihin rumah gw', 'fathoniadi', 17),
(2, 'Group Baru', 'fathoniadi', 28),
(3, 'Haha', 'fathoniadi', 29),
(4, 'asdasd', 'fathoniadi', 30),
(5, 'Coba lagi', 'fathoniadi', 31),
(6, 'asdad', 'fathoniadi', 32),
(7, 'xfsdf', 'fathoniadi', 33),
(8, 'asdasd', 'fathoniadi', 34),
(9, 'asdasd', 'fathoniadi', 35),
(10, 'asdasd', 'fathoniadi', 36),
(13, 'Hai', 'fathoniadi', 39);

--
-- Triggers `group`
--
DROP TRIGGER IF EXISTS `addUserListAfterNewPost`;
DELIMITER //
CREATE TRIGGER `addUserListAfterNewPost` AFTER INSERT ON `group`
 FOR EACH ROW insert into groupListUser(groupList_username, groupList_groupId) values(new.`owner`, new.`group_id`)
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `groupComment`
--

CREATE TABLE IF NOT EXISTS `groupComment` (
  `groupComment_id` int(11) NOT NULL AUTO_INCREMENT,
  `groupComment_text` varchar(255) NOT NULL,
  `groupComment_groupId` int(11) NOT NULL,
  `groupComment_user` varchar(100) NOT NULL,
  `groupComment_Replyto` int(11) DEFAULT NULL,
  `groupComment_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`groupComment_id`,`groupComment_user`),
  KEY `fk_groupComment_group1_idx` (`groupComment_groupId`),
  KEY `fk_groupComment_userAccount1_idx` (`groupComment_user`),
  KEY `groupcomment_ibfk_4` (`groupComment_Replyto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `groupComment`
--

INSERT INTO `groupComment` (`groupComment_id`, `groupComment_text`, `groupComment_groupId`, `groupComment_user`, `groupComment_Replyto`, `groupComment_date`) VALUES
(10, 'blaba', 1, 'fathoniadi', NULL, '2016-05-21 19:51:59'),
(15, 'duh gimana nih ya gw bingung banget sumpah', 1, 'fathoniadi', NULL, '2016-05-21 20:23:56'),
(16, 'eh seriusan lu mau bersihin rumah gw?', 1, 'fathoniadi', NULL, '2016-05-21 20:25:53'),
(17, 'alhamdulillah rek :"', 1, 'fathoniadi', NULL, '2016-05-21 20:26:05'),
(18, 'anjirrrr', 1, 'fathoniadi', NULL, '2016-05-21 21:10:29'),
(19, 'more more', 1, 'fathoniadi', NULL, '2016-05-21 21:10:41'),
(20, 'heleh', 1, 'fathoniadi', NULL, '2016-05-21 21:10:56'),
(21, 'asdasd', 13, 'mdbagas', NULL, '2016-05-27 12:39:02');

--
-- Triggers `groupComment`
--
DROP TRIGGER IF EXISTS `addCommentGroup`;
DELIMITER //
CREATE TRIGGER `addCommentGroup` AFTER INSERT ON `groupComment`
 FOR EACH ROW begin
	insert into userAction(actionID, action_user, action_type) values(new.groupComment_id, new.groupComment_user, 3);
end
//
DELIMITER ;
DROP TRIGGER IF EXISTS `deleteCommentGroup`;
DELIMITER //
CREATE TRIGGER `deleteCommentGroup` AFTER DELETE ON `groupComment`
 FOR EACH ROW begin
	delete from userAction where actionId = old.groupComment_id and action_user = old.groupComment_user;
end
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `groupListUser`
--

CREATE TABLE IF NOT EXISTS `groupListUser` (
  `groupList_username` varchar(100) NOT NULL,
  `groupList_groupId` int(11) DEFAULT NULL,
  `groupList_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`groupList_id`),
  KEY `fk_userAccount_has_group_group1_idx` (`groupList_groupId`),
  KEY `fk_userAccount_has_group_userAccount1_idx` (`groupList_username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `groupListUser`
--

INSERT INTO `groupListUser` (`groupList_username`, `groupList_groupId`, `groupList_id`) VALUES
('fathoniadi', 1, 1),
('fathoniadi', 3, 2),
('fathoniadi', 13, 3),
('mdbagas', NULL, 5),
('mdbagas', 13, 13);

-- --------------------------------------------------------

--
-- Table structure for table `postComment`
--

CREATE TABLE IF NOT EXISTS `postComment` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_text` varchar(255) NOT NULL,
  `comment_post` int(11) NOT NULL,
  `comment_user` varchar(100) NOT NULL,
  `comment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`comment_id`),
  KEY `fk_postComment_postEvent1_idx` (`comment_post`),
  KEY `fk_postComment_userAccount1_idx` (`comment_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `postComment`
--

INSERT INTO `postComment` (`comment_id`, `comment_text`, `comment_post`, `comment_user`, `comment_date`) VALUES
(1, 'asdasdasd', 15, 'fathoniadi', '2016-05-19 17:36:10'),
(2, 'asdasdas', 14, 'fathoniadi', '2016-05-19 17:36:29'),
(3, 'adasdasd', 15, 'fathoniadi', '2016-05-19 17:38:23'),
(4, 'adasdasd', 17, 'fathoniadi', '2016-05-22 08:16:28'),
(5, 'sdfsdfsdf', 17, 'fathoniadi', '2016-05-22 08:16:33'),
(6, 'sdfsfslmflsdfmlsdfmldsf', 17, 'fathoniadi', '2016-05-22 08:16:39'),
(7, 'adasdsd', 16, 'fathoniadi', '2016-05-22 08:16:46'),
(8, 'sdfsdfdf', 17, 'fathoniadi', '2016-05-22 08:16:49'),
(9, 'asdasdasd', 11, 'fathoniadi', '2016-05-22 08:41:27'),
(10, '1', 17, 'fathoniadi', '2016-05-22 08:45:29'),
(11, '2', 17, 'fathoniadi', '2016-05-22 08:45:32'),
(12, '3', 17, 'fathoniadi', '2016-05-22 08:45:35');

-- --------------------------------------------------------

--
-- Table structure for table `postEvent`
--

CREATE TABLE IF NOT EXISTS `postEvent` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_text` text NOT NULL,
  `post_photo` varchar(100) DEFAULT NULL,
  `post_owner` varchar(100) NOT NULL,
  `post_location` int(11) NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `post_nameEvent` varchar(100) NOT NULL,
  PRIMARY KEY (`post_id`),
  KEY `fk_postEvent_userAccount1_idx` (`post_owner`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `postEvent`
--

INSERT INTO `postEvent` (`post_id`, `post_text`, `post_photo`, `post_owner`, `post_location`, `post_date`, `post_nameEvent`) VALUES
(11, '11.2 adsad1', '34059_fathoniadi.png', 'fathoniadi', 1, '2015-12-31 17:49:00', 'Update 11.2'),
(14, 'adasdlaksdj', NULL, 'fathoniadi', 1, '2016-05-19 18:28:31', '14'),
(15, 'asdasd', NULL, 'fathoniadi', 1, '2016-05-19 18:28:31', '15'),
(16, 'asdasd', NULL, 'mdbagas', 1, '2016-05-19 18:28:31', '16'),
(17, 'Gambar', '59713_fathoniadi.jpg', 'fathoniadi', 1, '2016-05-21 01:44:08', 'Gambar'),
(18, 'asdasda', NULL, 'fathoniadi', 1, '2015-12-31 18:00:00', 'Bersih bersih keputih'),
(27, 'lorem ipsum dolor sit amet something i got to doooo doo bop zippity wop bippity lorem ipsum dolor sit amet something i got to doooo doo bop zippity wop bippity lorem ipsum dolor sit amet something i got to doooo doo bop zippity wop bippitylorem ipsum dolor sit amet something i got to doooo doo bop zippity wop bippitylorem ipsum dolor sit amet something i got to doooo doo bop zippity wop bippitylorem ipsum dolor sit amet something i got to doooo doo bop zippity wop bippity', NULL, 'fathoniadi', 1, '2016-05-22 02:11:09', 'bersihin rumah gw'),
(28, 'Heheh', NULL, 'fathoniadi', 1, '2015-12-31 18:00:00', 'Group Baru'),
(29, 'asdasd', NULL, 'fathoniadi', 1, '2015-12-31 18:00:00', 'Haha'),
(30, 'asdasd', NULL, 'fathoniadi', 1, '2015-12-31 18:00:00', 'asdasd'),
(31, 'asdasd', NULL, 'fathoniadi', 1, '2015-12-31 18:00:00', 'Coba lagi'),
(32, 'sdasd', NULL, 'fathoniadi', 1, '2015-12-31 18:00:00', 'asdad'),
(33, 'sfsdf', NULL, 'fathoniadi', 1, '2015-12-31 18:00:00', 'xfsdf'),
(34, 'dasda', NULL, 'fathoniadi', 1, '2015-12-31 18:00:00', 'asdasd'),
(35, 'asdas', NULL, 'fathoniadi', 1, '2015-12-31 18:00:00', 'asdasd'),
(36, 'asdasd', NULL, 'fathoniadi', 1, '2016-01-01 18:00:00', 'asdasd'),
(39, 'Hai', NULL, 'fathoniadi', 1, '2015-12-31 18:00:00', 'Hai');

--
-- Triggers `postEvent`
--
DROP TRIGGER IF EXISTS `auto_newGroup`;
DELIMITER //
CREATE TRIGGER `auto_newGroup` AFTER INSERT ON `postEvent`
 FOR EACH ROW insert into `group`(group_name, `owner`, Event_id) values(new.post_nameEvent, new.post_owner, new.post_id)
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `postJoin`
--

CREATE TABLE IF NOT EXISTS `postJoin` (
  `join_id` int(11) NOT NULL AUTO_INCREMENT,
  `join_post` int(11) NOT NULL,
  `join_user` varchar(100) NOT NULL,
  `join_flag` int(11) DEFAULT '0',
  PRIMARY KEY (`join_id`),
  KEY `fk_postJoin_postEvent1_idx` (`join_post`),
  KEY `fk_postJoin_userAccount1_idx` (`join_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `postJoin`
--

INSERT INTO `postJoin` (`join_id`, `join_post`, `join_user`, `join_flag`) VALUES
(32, 11, 'fathoniadi', 1),
(40, 17, 'mdbagas', 0),
(41, 11, 'mdbagas', 0),
(43, 16, 'fathoniadi', 0),
(56, 39, 'mdbagas', 0);

--
-- Triggers `postJoin`
--
DROP TRIGGER IF EXISTS `addUserListAfterJoin`;
DELIMITER //
CREATE TRIGGER `addUserListAfterJoin` AFTER INSERT ON `postJoin`
 FOR EACH ROW begin
	set @g_id = (select group_id from `group` where Event_id = new.join_post);
	insert into groupListUser(groupList_username, groupList_groupId) values(new.join_user, @g_id);
    insert into userAction(actionID, action_user, action_type) values(new.join_id, new.join_user, 2);
end
//
DELIMITER ;
DROP TRIGGER IF EXISTS `addUserListAfterUnJoin`;
DELIMITER //
CREATE TRIGGER `addUserListAfterUnJoin` AFTER DELETE ON `postJoin`
 FOR EACH ROW begin
	set @g_id = (select group_id from `group` where Event_id = old.join_post);
	delete from groupListUser where groupList_username = old.join_user and groupList_groupId = @g_id;
    delete from userAction where actionId = old.join_id and action_user = old.join_user;
end
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `postLike`
--

CREATE TABLE IF NOT EXISTS `postLike` (
  `like_id` int(11) NOT NULL AUTO_INCREMENT,
  `like_post` int(11) NOT NULL,
  `like_user` varchar(100) NOT NULL,
  PRIMARY KEY (`like_id`),
  KEY `fk_postLike_postEvent1_idx` (`like_post`),
  KEY `fk_postLike_userAccount1_idx` (`like_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `postLike`
--

INSERT INTO `postLike` (`like_id`, `like_post`, `like_user`) VALUES
(14, 14, 'fathoniadi'),
(33, 17, 'mdbagas'),
(34, 11, 'mdbagas'),
(35, 15, 'fathoniadi'),
(42, 17, 'fathoniadi'),
(43, 16, 'fathoniadi'),
(44, 11, 'fathoniadi');

--
-- Triggers `postLike`
--
DROP TRIGGER IF EXISTS `userAction_like`;
DELIMITER //
CREATE TRIGGER `userAction_like` AFTER INSERT ON `postLike`
 FOR EACH ROW begin
	insert into userAction(actionId, action_user, action_type) values(new.like_id, new.like_user,1);
end
//
DELIMITER ;
DROP TRIGGER IF EXISTS `userAction_unlike`;
DELIMITER //
CREATE TRIGGER `userAction_unlike` AFTER DELETE ON `postLike`
 FOR EACH ROW delete from userAction where actionId = old.like_id;
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `userAccount`
--

CREATE TABLE IF NOT EXISTS `userAccount` (
  `username` varchar(100) NOT NULL,
  `password` varchar(70) NOT NULL,
  `email` varchar(70) NOT NULL,
  `dateJoin` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lastLogin` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `userAccount`
--

INSERT INTO `userAccount` (`username`, `password`, `email`, `dateJoin`, `lastLogin`) VALUES
('fathoniadi', '89e6d2b383471fc370d828e552c19e65', 'fathoni.adi@gmail.com', '2016-05-16 14:14:23', NULL),
('fathoniadi2', 'c4ca4238a0b923820dcc509a6f75849b', 'fathoni.adi2@gmail.com', '2016-05-16 17:16:33', NULL),
('mdbagas', 'c4ca4238a0b923820dcc509a6f75849b', 'mdbagas@gmail.com', '2016-05-16 17:11:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `userAction`
--

CREATE TABLE IF NOT EXISTS `userAction` (
  `userAction_id` int(11) NOT NULL AUTO_INCREMENT,
  `actionId` int(11) DEFAULT NULL,
  `action_user` varchar(11) DEFAULT NULL,
  `action_type` int(11) DEFAULT NULL,
  PRIMARY KEY (`userAction_id`),
  KEY `action_user_fk` (`action_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `userAction`
--

INSERT INTO `userAction` (`userAction_id`, `actionId`, `action_user`, `action_type`) VALUES
(6, 56, 'mdbagas', 2);

-- --------------------------------------------------------

--
-- Table structure for table `userDetail`
--

CREATE TABLE IF NOT EXISTS `userDetail` (
  `user_fullname` varchar(100) DEFAULT NULL,
  `user_location` int(11) DEFAULT NULL,
  `user_photo` varchar(100) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `lengkap` int(11) DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `userDetail`
--

INSERT INTO `userDetail` (`user_fullname`, `user_location`, `user_photo`, `username`, `lengkap`) VALUES
('Fathoni Adi Kurniawan', 1, NULL, 'fathoniadi', 0),
('Bagas', 1, NULL, 'mdbagas', 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `group`
--
ALTER TABLE `group`
  ADD CONSTRAINT `group_ibfk_1` FOREIGN KEY (`owner`) REFERENCES `userAccount` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `group_ibfk_2` FOREIGN KEY (`Event_id`) REFERENCES `postEvent` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `groupComment`
--
ALTER TABLE `groupComment`
  ADD CONSTRAINT `groupcomment_ibfk_4` FOREIGN KEY (`groupComment_Replyto`) REFERENCES `groupComment` (`groupComment_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_groupComment_group1` FOREIGN KEY (`groupComment_groupId`) REFERENCES `group` (`group_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_groupComment_userAccount1` FOREIGN KEY (`groupComment_user`) REFERENCES `userAccount` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `groupListUser`
--
ALTER TABLE `groupListUser`
  ADD CONSTRAINT `fk_userAccount_has_group_group1` FOREIGN KEY (`groupList_groupId`) REFERENCES `group` (`group_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_userAccount_has_group_userAccount1` FOREIGN KEY (`groupList_username`) REFERENCES `userAccount` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `postComment`
--
ALTER TABLE `postComment`
  ADD CONSTRAINT `fk_postComment_postEvent1` FOREIGN KEY (`comment_post`) REFERENCES `postEvent` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_postComment_userAccount1` FOREIGN KEY (`comment_user`) REFERENCES `userAccount` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `postEvent`
--
ALTER TABLE `postEvent`
  ADD CONSTRAINT `fk_postEvent_userAccount1` FOREIGN KEY (`post_owner`) REFERENCES `userAccount` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `postJoin`
--
ALTER TABLE `postJoin`
  ADD CONSTRAINT `fk_postJoin_postEvent1` FOREIGN KEY (`join_post`) REFERENCES `postEvent` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_postJoin_userAccount1` FOREIGN KEY (`join_user`) REFERENCES `userAccount` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `postLike`
--
ALTER TABLE `postLike`
  ADD CONSTRAINT `fk_postLike_postEvent1` FOREIGN KEY (`like_post`) REFERENCES `postEvent` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_postLike_userAccount1` FOREIGN KEY (`like_user`) REFERENCES `userAccount` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `userAction`
--
ALTER TABLE `userAction`
  ADD CONSTRAINT `action_user_fk` FOREIGN KEY (`action_user`) REFERENCES `userAccount` (`username`);

--
-- Constraints for table `userDetail`
--
ALTER TABLE `userDetail`
  ADD CONSTRAINT `fk_userDetail_userAccount` FOREIGN KEY (`username`) REFERENCES `userAccount` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
