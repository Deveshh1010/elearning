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
-- โครงสร้างตาราง `exam`
-- 

CREATE TABLE `exam` (
  `exam_id` int(9) NOT NULL auto_increment,
  `unit_id` int(20) NOT NULL,
  `start_date` int(11) NOT NULL,
  `finish_date` int(11) NOT NULL,
  `show_ans` int(1) NOT NULL default '0',
  `type` varchar(1) collate utf8_unicode_ci NOT NULL default 'E' COMMENT 'ประเภทข้อสอบ',
  PRIMARY KEY  (`exam_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

-- 
-- dump ตาราง `exam`
-- 

INSERT INTO `exam` VALUES (1, 1, 1313145000, 1313146800, 1, 'E');
INSERT INTO `exam` VALUES (3, 2, 1314836400, 1314838800, 1, 'E');
INSERT INTO `exam` VALUES (4, 1, 1313137800, 1313139600, 1, 'T');
