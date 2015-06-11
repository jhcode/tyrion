-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 21, 2014 at 02:39 PM
-- Server version: 5.5.35
-- PHP Version: 5.4.4-14+deb7u9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `xibudega`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE IF NOT EXISTS `activities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action` text NOT NULL,
  `to` text NOT NULL,
  `from` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `blocks`
--

CREATE TABLE IF NOT EXISTS `blocks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `blocked_id` int(11) NOT NULL,
  `blocker_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `book_url` varchar(255) NOT NULL,
  `added` int(255) NOT NULL,
  `modified` int(255) NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `name`, `description`, `book_url`, `added`, `modified`) VALUES
(1, 'Fuck Nigeria', 'A book on how much this country sucks', 'stuff', 1396369124, 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(100) NOT NULL,
  `event` varchar(255) NOT NULL,
  `time_created` int(255) NOT NULL,
  `start` int(255) NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE IF NOT EXISTS `chats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `resource_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `time` int(100) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `resource_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `time` int(100) NOT NULL,
  `comment` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `privacy` varchar(10) NOT NULL,
  `title` varchar(100) NOT NULL,
  `overview` text NOT NULL,
  `founder` varchar(100) NOT NULL,
  `created` int(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `privacy`, `title`, `overview`, `founder`, `created`) VALUES
(1, 'Public', 'Web Dev Freelance', 'This was the thing that i wanted do...', '1', 1398987973),
(2, 'Public', 'Le Francais ', 'nada', '1', 1399037036),
(3, 'Public', 'Study In Five Mins', 'hif''fwefdwjfwfj', '1', 1399209753),
(4, 'Public', 'Cryptography', 'The study of encryption/decryption and ciphers', '2', 1400540130);

-- --------------------------------------------------------

--
-- Table structure for table `course_members`
--

CREATE TABLE IF NOT EXISTS `course_members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(30) NOT NULL,
  `course_id` int(30) NOT NULL,
  `instructor` varchar(30) NOT NULL,
  `joined` int(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `course_members`
--

INSERT INTO `course_members` (`id`, `user_id`, `course_id`, `instructor`, `joined`) VALUES
(1, 1, 1, '', 1398987973),
(2, 1, 2, '', 1399037036),
(3, 1, 3, '', 1399209753),
(6, 2, 3, '', 1399894269),
(7, 2, 4, '', 1400540131);

-- --------------------------------------------------------

--
-- Table structure for table `course_outlines`
--

CREATE TABLE IF NOT EXISTS `course_outlines` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `outline` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `grade_systems`
--

CREATE TABLE IF NOT EXISTS `grade_systems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `school_id` int(11) NOT NULL,
  `details` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `school_id` (`school_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `type` text NOT NULL,
  `creator_id` int(11) NOT NULL,
  `avatar` text NOT NULL,
  `theme` varchar(50) NOT NULL,
  `overview` text NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `group_members`
--

CREATE TABLE IF NOT EXISTS `group_members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `joined` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `interests`
--

CREATE TABLE IF NOT EXISTS `interests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `invitations`
--

CREATE TABLE IF NOT EXISTS `invitations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL,
  `sender` int(11) NOT NULL,
  `recipient` int(11) NOT NULL,
  `place_id` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `levels`
--

CREATE TABLE IF NOT EXISTS `levels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `school_id` int(11) NOT NULL,
  `details` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `school_id` (`school_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `recipient_id` int(100) NOT NULL,
  `sender_id` int(100) NOT NULL,
  `viewed` tinyint(1) NOT NULL,
  `message` text NOT NULL,
  `created` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=121 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `recipient_id`, `sender_id`, `viewed`, `message`, `created`) VALUES
(119, 3, 1, 1, 'Yeah', 1400421133),
(120, 2, 1, 1, 'Yeah', 1400421144);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `version` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`version`) VALUES
(18);

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE IF NOT EXISTS `notices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(30) NOT NULL,
  `title` varchar(255) NOT NULL,
  `details` text NOT NULL,
  `info` text NOT NULL,
  `term` varchar(255) NOT NULL,
  `session` varchar(255) NOT NULL,
  `created` int(255) NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `notices`
--

INSERT INTO `notices` (`id`, `type`, `title`, `details`, `info`, `term`, `session`, `created`) VALUES
(8, 'image', 'Biceps are what I need', 'image file', '["image_1400696526.jpg"]', '', '', 1400696526),
(9, 'image', 'Wake up call', 'image file', '["image_1400699838.jpg"]', '', '', 1400699838),
(10, 'gallery', 'Coders Gallery', 'A gallery of coders images', '["68556_285289284937042_1108040038_n[1].jpg","202435_210706159059086_1763084859_o.jpg","551412_498759913506225_1075994167_n[1].jpg","552018_492633887470911_1309466261_n[1].jpg"]', '', '', 1400700875),
(11, 'gallery', 'Awesome progress', 'This is sweet and won''t break', '["1385700_10201788417684692_2065137952_n.jpg","1464626_412034685595834_1150833345_n.jpg","1506035_636656889735276_618004084_n.jpg"]', '', '', 1400700981);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(100) NOT NULL,
  `recipient_id` int(10) NOT NULL,
  `type_id` datetime NOT NULL,
  `viewed` tinyint(1) NOT NULL,
  `created` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `privileges`
--

CREATE TABLE IF NOT EXISTS `privileges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `controller` varchar(50) NOT NULL,
  `method` varchar(20) NOT NULL,
  `priority` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `is_manager` tinyint(1) NOT NULL DEFAULT '0',
  `is_teacher` tinyint(1) NOT NULL DEFAULT '0',
  `is_parent` tinyint(1) NOT NULL DEFAULT '0',
  `is_bursar` tinyint(1) NOT NULL DEFAULT '0',
  `is_regular` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `priority` (`priority`),
  KEY `is_regular` (`is_regular`),
  KEY `is_bursar` (`is_bursar`),
  KEY `is_parent` (`is_parent`),
  KEY `is_teacher` (`is_teacher`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `privileges`
--

INSERT INTO `privileges` (`id`, `name`, `controller`, `method`, `priority`, `parent_id`, `is_admin`, `is_manager`, `is_teacher`, `is_parent`, `is_bursar`, `is_regular`) VALUES
(1, 'school-logo', 'schools', 'profile', 1, 0, 1, 1, 1, 1, 1, 0),
(2, 'home', 'users', 'home', 2, 0, 1, 1, 1, 1, 1, 1),
(3, 'groups', 'groups', 'home', 4, 0, 0, 0, 0, 0, 0, 1),
(4, 'courses', 'courses', 'home', 5, 0, 0, 0, 0, 0, 0, 1),
(5, 'messages', 'messages', 'home', 3, 0, 1, 1, 1, 1, 1, 1),
(6, 'classroom', 'classroom', 'index', 6, 0, 1, 0, 0, 0, 0, 0),
(7, 'finance', 'finance', 'home', 7, 0, 0, 0, 0, 0, 0, 1),
(8, 'store', 'store', 'home', 8, 0, 0, 0, 0, 0, 0, 1),
(9, 'shelf', 'shelf', 'home', 9, 0, 0, 0, 0, 0, 0, 1),
(10, 'reports', 'reports', 'admin', 11, 0, 1, 0, 0, 0, 0, 0),
(11, 'kids', 'parents', 'kids', 10, 0, 0, 0, 0, 1, 0, 0),
(12, 'noticeboard', 'noticeboard', 'home', 4, 0, 1, 1, 1, 1, 1, 0),
(13, 'people', 'roles', 'index', 10, 0, 1, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE IF NOT EXISTS `resources` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(30) NOT NULL,
  `course_id` int(30) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `created` int(30) NOT NULL,
  `modified` int(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `resources`
--

INSERT INTO `resources` (`id`, `type`, `course_id`, `title`, `content`, `created`, `modified`) VALUES
(1, 'note', 4, 'The secrets of the gods', 'This awesome story on the secret of the gods', 1400637563, 1400637563),
(2, 'video', 4, 'The bitshifting operaition', 'http://www.youtube.com/watch?v=ip6RvnlmLsE', 1400637665, 1400637665);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(30) NOT NULL,
  `user_id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL,
  `created` int(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `user_id`, `school_id`, `created`) VALUES
(1, 'admin', 5, 2, 1400508255),
(2, 'admin', 6, 3, 1400508318);

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE IF NOT EXISTS `schools` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `principal` varchar(255) NOT NULL,
  `director` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `LGA` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `paid` tinyint(4) NOT NULL,
  `created` int(255) NOT NULL,
  `modified` int(255) NOT NULL,
  `admin_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`id`, `name`, `email`, `phone`, `principal`, `director`, `address`, `country`, `state`, `LGA`, `logo`, `active`, `paid`, `created`, `modified`, `admin_id`) VALUES
(1, 'Novaree', '', '', '', '', '', '', '', '', '', 1, 1, 1400508100, 0, 4),
(2, 'Assfood', '', '', '', '', '', '', '', '', '', 1, 1, 1400508255, 0, 5),
(3, 'TrailBlazers', '', '', '', '', '', '', '', '', '', 0, 1, 1400508318, 0, 6);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `session_id` varchar(140) NOT NULL,
  `ip_address` varchar(40) NOT NULL,
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) NOT NULL,
  `user_data` text NOT NULL,
  `viewed` tinyint(1) NOT NULL,
  `created` int(255) NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`, `viewed`, `created`) VALUES
('446b45870349356b0b0fdd06c78a6272', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.116 Safari/537.36', 1400700875, 'a:2:{s:9:"user_data";s:0:"";s:12:"user_details";O:8:"stdClass":30:{s:2:"id";s:1:"2";s:4:"type";s:0:"";s:9:"firstname";s:6:"Joseph";s:10:"middlename";s:1:"T";s:8:"lastname";s:3:"Rex";s:8:"username";s:0:"";s:8:"password";s:60:"$2a$07$IL73ekLCYt3zYg0WgmtqmOQVwhhfl7H0kvaEoiq4Yt0yF7FmFX50.";s:5:"email";s:22:"joerex@ostrich-dev.com";s:5:"phone";s:0:"";s:15:"facebook_handle";s:0:"";s:14:"twitter_handle";s:0:"";s:3:"dob";s:0:"";s:6:"gender";s:0:"";s:8:"verified";s:1:"1";s:6:"active";s:1:"0";s:9:"interests";s:0:"";s:10:"last_login";s:10:"1400674294";s:7:"created";s:10:"1398069819";s:8:"modified";s:1:"0";s:5:"image";s:14:"1398069819.jpg";s:8:"acc_name";s:0:"";s:7:"acc_no1";s:1:"0";s:7:"acc_no2";s:1:"0";s:9:"is_sadmin";s:1:"0";s:8:"is_admin";s:1:"0";s:9:"is_parent";s:1:"0";s:10:"is_manager";s:1:"0";s:10:"is_teacher";s:1:"0";s:10:"is_student";s:1:"0";s:9:"is_bursar";s:1:"0";}}', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `shelves`
--

CREATE TABLE IF NOT EXISTS `shelves` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(100) NOT NULL,
  `item_id` int(255) NOT NULL,
  `created` int(255) NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` int(30) NOT NULL,
  `activity` varchar(100) NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `facebook_handle` varchar(255) NOT NULL,
  `twitter_handle` varchar(255) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `verified` tinyint(1) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `interests` text NOT NULL,
  `last_login` int(255) NOT NULL,
  `created` int(255) NOT NULL,
  `modified` int(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `acc_name` varchar(255) NOT NULL,
  `acc_no1` int(255) NOT NULL,
  `acc_no2` int(255) NOT NULL,
  `is_sadmin` tinyint(1) NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `is_parent` tinyint(1) NOT NULL,
  `is_manager` tinyint(1) NOT NULL,
  `is_teacher` tinyint(1) NOT NULL,
  `is_student` tinyint(1) NOT NULL,
  `is_bursar` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `type`, `firstname`, `middlename`, `lastname`, `username`, `password`, `email`, `phone`, `facebook_handle`, `twitter_handle`, `dob`, `gender`, `verified`, `active`, `interests`, `last_login`, `created`, `modified`, `image`, `acc_name`, `acc_no1`, `acc_no2`, `is_sadmin`, `is_admin`, `is_parent`, `is_manager`, `is_teacher`, `is_student`, `is_bursar`) VALUES
(1, '', 'Five ', '', 'Alive', '', '$2a$07$Lvq4IR01nE9J8H1NG8F0EurhNwg6wTR4tAWrxtBALw04W4tSwWX3G', 'five@live.com', '', '', '', '', '', 1, 0, '', 1400649679, 1397746382, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2, '', 'Joseph', 'T', 'Rex', '', '$2a$07$IL73ekLCYt3zYg0WgmtqmOQVwhhfl7H0kvaEoiq4Yt0yF7FmFX50.', 'joerex@ostrich-dev.com', '', '', '', '', '', 1, 0, '', 1400686322, 1398069819, 0, '1398069819.jpg', '', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(3, '', 'Hello', '', 'Foods', '', '$2a$07$27YDqZ02WEsNsVbQjFNM2.T96SPiKoqQMeEsl/3LV/kjfG7e.aAGG', 'hello@foods.com', '', '', '', '', '', 0, 0, '', 1398280448, 1398172352, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(4, '', 'Novaree', '', 'admin', '', '$2a$07$0bbQXOQjkP2ALPZpoH5zieRRA8vBuKvpnNaS6fMP164e9tnJ/4qRC', 'sleep@home', '', '', '', '', '', 1, 0, '', 1400523405, 1400508100, 0, '', '', 0, 0, 0, 1, 0, 0, 0, 0, 0),
(5, '', 'Assfood', '', 'admin', '', '$2a$07$Kuyze4AX8jI0HUiArUmBputH/NrjAxpobDspXszgRuoD2PsFhcawS', 'play@work.com', '', '', '', '', '', 0, 0, '', 0, 1400508255, 0, '', '', 0, 0, 0, 1, 0, 0, 0, 0, 0),
(6, '', 'TrailBlazers', '', 'admin', '', '$2a$07$Qv1Yq3Pzs9pyAdm24ltgwuSKWdzqSAQckdAEENPzYuXZHp6R9X1cy', 'kesiena.akp@gmail.com', '', '', '', '', '', 1, 0, '', 1400509425, 1400508318, 0, '', '', 0, 0, 0, 1, 0, 0, 0, 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
