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
-- โครงสร้างตาราง `exam_question`
-- 

CREATE TABLE `exam_question` (
  `question_id` int(9) NOT NULL auto_increment,
  `exam_id` int(9) NOT NULL,
  `answer_id` int(9) default '0',
  `question` text collate utf8_unicode_ci,
  PRIMARY KEY  (`question_id`),
  FULLTEXT KEY `question` (`question`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=31 ;

-- 
-- dump ตาราง `exam_question`
-- 

INSERT INTO `exam_question` VALUES (1, 1, 4, 'การรอคอยแบบใดที่ทรมานที่สุด');
INSERT INTO `exam_question` VALUES (2, 1, 6, 'ตึกประเภทใดที่ทรุดโทรมง่ายมากที่สุด');
INSERT INTO `exam_question` VALUES (3, 1, 12, 'ข้อใดไม่ใช่การตอบสนองต่อสิ่งเร้าของพืช');
INSERT INTO `exam_question` VALUES (4, 1, 15, 'ข้อใดไม่ใช่ข้อมูล');
INSERT INTO `exam_question` VALUES (5, 1, 20, 'สิ่งที่ควรทำเป็นอันดับแรกในการนำเสนอข้อมูลคือข้อใด');
INSERT INTO `exam_question` VALUES (6, 1, 23, 'ปลา	ไก่	สุนัข	หมู	ห่าน หอย	แมว	เป็ด	หมึก	แกะ กระต่าย	กุ้ง	นก	ม้า	กระรอก จากข้อมูลมีสัตว์ปีกกี่ตัว');
INSERT INTO `exam_question` VALUES (7, 1, 27, 'นักเรียนเดินทางมาโรงเรียนโดยรถประจำทางทั้งหมดกี่คน');
INSERT INTO `exam_question` VALUES (8, 1, 31, 'ชาวประมงจับปลาได้มากกว่ากุ้งกี่กิโลกรัม');
INSERT INTO `exam_question` VALUES (9, 1, 34, 'ถ้าผลการสอบถามนี้มากจากนักเรียน 500 คน  กีฬาที่นักเรียนกลุ่มนี้ชอบมากที่สุดมีกี่คน');
INSERT INTO `exam_question` VALUES (10, 1, 38, 'ถ้ามีนักเรียนที่ชอบว่ายน้ำกับเทนนิสมากกว่าฟุตบอล 3 คน  นักเรียนที่ชอบว่ายน้ำมีกี่คน');
INSERT INTO `exam_question` VALUES (11, 3, 44, 'ไก่อะไรอะหร่อย');
INSERT INTO `exam_question` VALUES (12, 3, 45, 'คำว่าเมียน้อยมาจากไหน');
INSERT INTO `exam_question` VALUES (13, 3, 52, 'อะไรอยู่ใน ...วย');
INSERT INTO `exam_question` VALUES (14, 3, 54, 'หูฟังไว้ใช้ทำอะไร');
INSERT INTO `exam_question` VALUES (15, 3, 57, 'ปลามาจากไหน');
INSERT INTO `exam_question` VALUES (16, 3, 64, 'บิททอเร้นไว้ทำอะไร');
INSERT INTO `exam_question` VALUES (17, 3, 67, 'ชีวิตสัตว์โลกคืออะไร');
INSERT INTO `exam_question` VALUES (18, 3, 69, 'พรุ่งนี้วันอะไร');
INSERT INTO `exam_question` VALUES (19, 3, 73, 'คะแนนเต็มสิบให้เท่าไร');
INSERT INTO `exam_question` VALUES (20, 3, 80, 'ทำไมเด็กต้องเรียน');
INSERT INTO `exam_question` VALUES (21, 4, 81, 'a');
INSERT INTO `exam_question` VALUES (22, 4, 88, 'asd');
INSERT INTO `exam_question` VALUES (23, 4, 89, 'bbb');
INSERT INTO `exam_question` VALUES (24, 4, 93, 'zxc');
INSERT INTO `exam_question` VALUES (25, 4, 97, 'ujmuyhndf');
INSERT INTO `exam_question` VALUES (26, 4, 101, 'sdassdf');
INSERT INTO `exam_question` VALUES (27, 4, 105, 'dfhjsadh');
INSERT INTO `exam_question` VALUES (28, 4, 109, '123456789');
INSERT INTO `exam_question` VALUES (29, 4, 113, 'dfga sdgeatjs asd');
INSERT INTO `exam_question` VALUES (30, 4, 117, 'serhyus hasdgaer ');
