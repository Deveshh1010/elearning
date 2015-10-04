-- phpMyAdmin SQL Dump
-- version 2.10.2
-- http://www.phpmyadmin.net
-- 
-- โฮสต์: localhost
-- เวลาในการสร้าง: 
-- รุ่นของเซิร์ฟเวอร์: 5.0.45
-- รุ่นของ PHP: 5.2.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- ฐานข้อมูล: `e-learning`
-- 

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `member_answer`
-- 

CREATE TABLE `member_answer` (
  `mans_id` int(9) NOT NULL auto_increment,
  `member_id` int(9) NOT NULL,
  `question_id` int(9) NOT NULL,
  `answer_id` int(9) NOT NULL,
  PRIMARY KEY  (`mans_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=154 ;

-- 
-- dump ตาราง `member_answer`
-- 

INSERT INTO `member_answer` VALUES (1, 23, 1, 4);
INSERT INTO `member_answer` VALUES (146, 23, 23, 89);
INSERT INTO `member_answer` VALUES (147, 23, 24, 93);
INSERT INTO `member_answer` VALUES (148, 23, 25, 97);
INSERT INTO `member_answer` VALUES (149, 23, 26, 101);
INSERT INTO `member_answer` VALUES (145, 23, 22, 88);
INSERT INTO `member_answer` VALUES (144, 23, 21, 81);
INSERT INTO `member_answer` VALUES (151, 23, 28, 109);
INSERT INTO `member_answer` VALUES (150, 23, 27, 105);
INSERT INTO `member_answer` VALUES (153, 23, 30, 117);
INSERT INTO `member_answer` VALUES (152, 23, 29, 113);
