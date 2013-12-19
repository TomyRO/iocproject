-- phpMyAdmin SQL Dump
-- version 4.0.6deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 19, 2013 at 07:45 AM
-- Server version: 5.5.34-0ubuntu0.13.10.1
-- PHP Version: 5.5.3-1ubuntu2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `iocproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_title` char(100) COLLATE utf8_unicode_ci NOT NULL,
  `category_link` char(100) COLLATE utf8_unicode_ci NOT NULL,
  `category_icon` char(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_title`, `category_link`, `category_icon`) VALUES
(1, 'Programming', 'programming', 'fa-html5'),
(2, 'Photography', 'photography', 'fa-camera'),
(3, 'Gardening', 'gardening', 'fa-pagelines'),
(4, 'Sports', 'sports', 'fa-trophy'),
(5, 'Mobile', 'mobile', 'fa-android'),
(6, 'Photoshop', 'photoshop', 'fa-picture-o'),
(7, 'Networking', 'networking', 'fa-sitemap');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_text` text COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `tutorial_id` int(11) NOT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_text`, `user_id`, `tutorial_id`) VALUES
(1, ' asfasdfasdf', 1, 1),
(2, ' asfasdfasdf', 1, 1),
(3, ' ', 1, 2),
(4, ' ', 1, 2),
(5, ' First comment', 1, 1),
(6, ' adasd', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tutorials`
--

CREATE TABLE IF NOT EXISTS `tutorials` (
  `tutorial_id` int(11) NOT NULL AUTO_INCREMENT,
  `tutorial_title` char(255) COLLATE utf8_unicode_ci NOT NULL,
  `tutorial_revision_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `tutorial_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tutorial_views` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tutorial_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tutorials`
--

INSERT INTO `tutorials` (`tutorial_id`, `tutorial_title`, `tutorial_revision_id`, `category_id`, `tutorial_create`, `tutorial_views`) VALUES
(1, 'How to cook an egg', 16, 2, '2013-12-04 23:18:18', 39),
(2, 'HTML in 5 easy steps', 17, 4, '2013-12-05 10:46:24', 24),
(3, '3 ways to cut a tree!', 18, 1, '2013-12-05 11:20:26', 10),
(4, 'Camera filter tips', 19, 1, '2013-12-19 00:15:04', 12);

-- --------------------------------------------------------

--
-- Table structure for table `tutorial_revisions`
--

CREATE TABLE IF NOT EXISTS `tutorial_revisions` (
  `tutorial_revision_id` int(11) NOT NULL AUTO_INCREMENT,
  `tutorial_id` int(11) NOT NULL,
  `tutorial_revision_content` text COLLATE utf8_unicode_ci NOT NULL,
  `tutorial_revision_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`tutorial_revision_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=20 ;

--
-- Dumping data for table `tutorial_revisions`
--

INSERT INTO `tutorial_revisions` (`tutorial_revision_id`, `tutorial_id`, `tutorial_revision_content`, `tutorial_revision_modified`, `user_id`) VALUES
(1, 1, '<p></p><h3>Test H3</h3>This is some sample text to test out the <b>WYSIWYG Control</b>.<p></p>', '2013-12-04 23:18:18', 1),
(2, 2, '<p></p><h3>Tutorialul smecherilor</h3><div><br></div><div><br></div><div>ndkaslh ahd kjas hdka&nbsp;</div>This is some sample text to test out the <b>WYSIWYG Control</b>.<p></p>', '2013-12-05 10:46:25', 1),
(3, 3, '<p></p><h1 style="text-align: center;">Cum sa adaugi un tutorial</h1>This is some sample text to test out the <b>WYSIWYG Control</b>.<p></p>', '2013-12-05 11:20:26', 1),
(4, 1, 'svdsvfv<p></p><h3></h3><p></p>', '2013-12-19 00:11:35', 1),
(5, 2, '<p></p><h3><b>asdasdsadtrol</b>.</h3><p></p>', '2013-12-19 00:12:00', 1),
(6, 2, '<p></p><h3>Tutorialul smecherilor</h3><div><br></div><div><br></div><div>ndkaslh ahd kjas hdka&nbsp;</div>This is some sample text to test out the <b>WYSIWYG Control</b>.<p></p>', '2013-12-19 00:13:55', 1),
(7, 1, 'd<p></p><h3></h3><p></p>', '2013-12-19 00:14:40', 1),
(8, 4, 'asdasdasd', '2013-12-19 00:15:04', 1),
(9, 4, 'xxxxxxxxxxxxx', '2013-12-19 00:15:17', 1),
(10, 4, 'asdasdasdasdasd', '2013-12-19 00:17:30', 1),
(11, 4, 'xxx', '2013-12-19 00:17:43', 1),
(12, 4, '<p>asdasdasd</p>\r\n', '2013-12-19 00:28:47', 1),
(13, 1, '<p>This is not a drill</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3>&nbsp;</h3>\r\n\r\n<p>&nbsp;</p>\r\n', '2013-12-19 00:48:51', 1),
(14, 2, '<p>&nbsp;</p>\r\n\r\n<h3>Tutorialul smecherilor</h3>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>ndkaslh ahd kjas hdka&nbsp;</p>\r\n\r\n<p>This is some sample text to test out the <strong>WYSIWYG Control</strong>.</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2013-12-19 01:00:37', 1),
(15, 2, '<p>&nbsp;</p>\r\n\r\n<h3>Tutorialul smecherilor</h3>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>ndkaslh ahd kjas hdka&nbsp;</p>\r\n\r\n<p>This is some sample text to test out the <strong>WYSIWYG Control</strong>.</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2013-12-19 01:01:36', 1),
(16, 1, '<p>This is not a drill</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3>&nbsp;</h3>\r\n\r\n<p>&nbsp;</p>\r\n', '2013-12-19 07:40:01', 1),
(17, 2, '<p>&nbsp;</p>\r\n\r\n<h3>Tutorialul smecherilor</h3>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>ndkaslh ahd kjas hdka&nbsp;</p>\r\n\r\n<p>This is some sample text to test out the <strong>WYSIWYG Control</strong>.</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2013-12-19 07:40:23', 1),
(18, 3, '<p>&nbsp;</p>\r\n\r\n<h1>Cum sa adaugi un tutorial</h1>\r\n\r\n<p>This is some sample text to test out the <strong>WYSIWYG Control</strong>.</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2013-12-19 07:41:16', 1),
(19, 4, '<p>asdasdasd</p>\r\n', '2013-12-19 07:42:04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_email` char(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_password` char(50) COLLATE utf8_unicode_ci NOT NULL,
  `user_name` char(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_favorites` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_email` (`user_email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=20 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_email`, `user_password`, `user_name`, `user_favorites`) VALUES
(1, 'adrian@example.com', '8287458823facb8ff918dbfabcd22ccb', 'Adrian Coman', '["1","3","6","7"]'),
(3, 'adrian.coman@hostway.ro', '8287458823facb8ff918dbfabcd22ccb', 'asdasdas', '["2","6","7"]'),
(19, 'adr.comadn@gmail.com', '8287458823facb8ff918dbfabcd22ccb', '', '[]');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
