-- phpMyAdmin SQL Dump
-- version 4.0.6deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 04, 2013 at 11:44 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

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
-- Table structure for table `tutorials`
--

CREATE TABLE IF NOT EXISTS `tutorials` (
  `tutorial_id` int(11) NOT NULL AUTO_INCREMENT,
  `tutorial_title` char(255) COLLATE utf8_unicode_ci NOT NULL,
  `tutorial_revision_id` int(11) NOT NULL,
  `tutorial_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`tutorial_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tutorials`
--

INSERT INTO `tutorials` (`tutorial_id`, `tutorial_title`, `tutorial_revision_id`, `tutorial_create`) VALUES
(1, 'asdasda', 1, '2013-12-04 23:18:18');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tutorial_revisions`
--

INSERT INTO `tutorial_revisions` (`tutorial_revision_id`, `tutorial_id`, `tutorial_revision_content`, `tutorial_revision_modified`, `user_id`) VALUES
(1, 1, '<p></p><h3>Test H3</h3>This is some sample text to test out the <b>WYSIWYG Control</b>.<p></p>', '2013-12-04 23:18:18', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=18 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_email`, `user_password`, `user_name`, `user_favorites`) VALUES
(1, 'adr.coman@gmail.com', '8287458823facb8ff918dbfabcd22ccb', 'Adrian Coman', '["3","6"]'),
(3, 'adrian.coman@hostway.ro', '8287458823facb8ff918dbfabcd22ccb', 'asdasdas', '["2","6","7"]');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
