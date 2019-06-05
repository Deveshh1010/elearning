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
-- โครงสร้างตาราง `exam_answer`
-- 

CREATE TABLE `exam_answer` (
  `answer_id` int(9) NOT NULL auto_increment,
  `question_id` int(9) NOT NULL,
  `ans_text` text collate utf8_unicode_ci,
  PRIMARY KEY  (`answer_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=121 ;

-- 
-- dump ตาราง `exam_answer`
-- 

INSERT INTO `exam_answer` VALUES (1, 1, 'คอยเราด้วย');
INSERT INTO `exam_answer` VALUES (2, 1, 'คอยแต่หึง');
INSERT INTO `exam_answer` VALUES (3, 1, 'คอยย้วย');
INSERT INTO `exam_answer` VALUES (4, 1, 'คอยจะแทงแต่หวย');
INSERT INTO `exam_answer` VALUES (5, 2, 'ตึกปลาแหมด');
INSERT INTO `exam_answer` VALUES (6, 2, 'ตึกแสด');
INSERT INTO `exam_answer` VALUES (7, 2, 'ตึกกลางแดด');
INSERT INTO `exam_answer` VALUES (8, 2, 'ตึกระแท้ด');
INSERT INTO `exam_answer` VALUES (9, 3, 'การบานของดอกในตอนเช้า และการหุบของดอกในตอนเย็น');
INSERT INTO `exam_answer` VALUES (10, 3, 'การแพร่กระจายของเมล็ดโดยอาศัยลม');
INSERT INTO `exam_answer` VALUES (11, 3, 'การตายของพืชเมื่อได้รับอุณหภูมิต่ำมาก ๆ');
INSERT INTO `exam_answer` VALUES (12, 3, 'การงอกของเมล็ดหลังจากนำไปแช่น้ำ');
INSERT INTO `exam_answer` VALUES (13, 4, 'แม่เก็บผักได้ 10 กำ');
INSERT INTO `exam_answer` VALUES (14, 4, 'วันนี้มีนักเรียนมาเรียน 23 คน');
INSERT INTO `exam_answer` VALUES (15, 4, 'ดวงจันทร์');
INSERT INTO `exam_answer` VALUES (16, 4, 'สวนสัตว์แห่งหนึ่งมีเสือ 8 ตัว');
INSERT INTO `exam_answer` VALUES (17, 5, 'กรอกข้อมูลลงตาราง');
INSERT INTO `exam_answer` VALUES (18, 5, 'เขียนแผนภูมิรูปภาพ');
INSERT INTO `exam_answer` VALUES (19, 5, 'เขียนแผนภูมิแท่ง');
INSERT INTO `exam_answer` VALUES (20, 5, 'จำแนกและจัดประเภทข้อมูล');
INSERT INTO `exam_answer` VALUES (21, 6, '2  ตัว');
INSERT INTO `exam_answer` VALUES (22, 6, '3  ตัว');
INSERT INTO `exam_answer` VALUES (23, 6, '4  ตัว');
INSERT INTO `exam_answer` VALUES (24, 6, '5  ตัว');
INSERT INTO `exam_answer` VALUES (25, 7, '8 คน');
INSERT INTO `exam_answer` VALUES (26, 7, '12 คน');
INSERT INTO `exam_answer` VALUES (27, 7, '16 คน');
INSERT INTO `exam_answer` VALUES (28, 7, '18 คน');
INSERT INTO `exam_answer` VALUES (29, 8, '5 กิโลกรัม');
INSERT INTO `exam_answer` VALUES (30, 8, '10 กิโลกรัม');
INSERT INTO `exam_answer` VALUES (31, 8, '15 กิโลกรัม');
INSERT INTO `exam_answer` VALUES (32, 8, '20 กิโลกรัม');
INSERT INTO `exam_answer` VALUES (33, 9, '151 คน');
INSERT INTO `exam_answer` VALUES (34, 9, '153 คน');
INSERT INTO `exam_answer` VALUES (35, 9, '155 คน');
INSERT INTO `exam_answer` VALUES (36, 9, '157 คน');
INSERT INTO `exam_answer` VALUES (37, 10, '279 คน');
INSERT INTO `exam_answer` VALUES (38, 10, '281 คน');
INSERT INTO `exam_answer` VALUES (39, 10, '283 คน');
INSERT INTO `exam_answer` VALUES (40, 10, '285 คน');
INSERT INTO `exam_answer` VALUES (41, 11, 'ไก่จ๋า');
INSERT INTO `exam_answer` VALUES (42, 11, 'ไก่ทอด');
INSERT INTO `exam_answer` VALUES (43, 11, 'ไก่เน่า');
INSERT INTO `exam_answer` VALUES (44, 11, 'น้องไก่');
INSERT INTO `exam_answer` VALUES (45, 12, 'ผัวมีเมียอยู่แล้วแล้วมีเพิ่ม');
INSERT INTO `exam_answer` VALUES (46, 12, 'ผัวมีเมียตัวเล็ก');
INSERT INTO `exam_answer` VALUES (47, 12, 'ผัวมีเมียคนเดียว');
INSERT INTO `exam_answer` VALUES (48, 12, 'ไม่มีข้อถูก');
INSERT INTO `exam_answer` VALUES (49, 13, 'ไข่น้อย');
INSERT INTO `exam_answer` VALUES (50, 13, 'ไก่');
INSERT INTO `exam_answer` VALUES (51, 13, 'เป็ด');
INSERT INTO `exam_answer` VALUES (52, 13, 'อสุจิ');
INSERT INTO `exam_answer` VALUES (53, 14, 'ปาหัวเมีย');
INSERT INTO `exam_answer` VALUES (54, 14, 'สวมหัว');
INSERT INTO `exam_answer` VALUES (55, 14, 'ฟังเพลง');
INSERT INTO `exam_answer` VALUES (56, 14, 'เหน็บเอว');
INSERT INTO `exam_answer` VALUES (57, 15, 'ไข่ปลา');
INSERT INTO `exam_answer` VALUES (58, 15, 'กลายพันธุ์จากเหี้ย');
INSERT INTO `exam_answer` VALUES (59, 15, 'ออกจากดอทเอ');
INSERT INTO `exam_answer` VALUES (60, 15, 'ดาวอังคาร');
INSERT INTO `exam_answer` VALUES (61, 16, 'นั่งดู');
INSERT INTO `exam_answer` VALUES (62, 16, 'โหลดหนัง18+');
INSERT INTO `exam_answer` VALUES (63, 16, 'โหลดหนัง20+');
INSERT INTO `exam_answer` VALUES (64, 16, 'ถูกทุกข้อ');
INSERT INTO `exam_answer` VALUES (65, 17, 'ธรรมะ');
INSERT INTO `exam_answer` VALUES (66, 17, 'ปรัชญา');
INSERT INTO `exam_answer` VALUES (67, 17, 'ศิลปะ!!!');
INSERT INTO `exam_answer` VALUES (68, 17, 'อะไรนะตะเอง');
INSERT INTO `exam_answer` VALUES (69, 18, 'วันแม่');
INSERT INTO `exam_answer` VALUES (70, 18, 'วันศุกร์');
INSERT INTO `exam_answer` VALUES (71, 18, 'วันพรุ่งนี้');
INSERT INTO `exam_answer` VALUES (72, 18, 'วันนั้น');
INSERT INTO `exam_answer` VALUES (73, 19, '10');
INSERT INTO `exam_answer` VALUES (74, 19, '9');
INSERT INTO `exam_answer` VALUES (75, 19, '8');
INSERT INTO `exam_answer` VALUES (76, 19, '7');
INSERT INTO `exam_answer` VALUES (77, 20, 'ศึกษาหาความรู้');
INSERT INTO `exam_answer` VALUES (78, 20, 'เป็นแหล่งสำหรับจีบสาวจีบหนุ่ม');
INSERT INTO `exam_answer` VALUES (79, 20, 'แม่บอก');
INSERT INTO `exam_answer` VALUES (80, 20, 'มีห้องนอนแอร์');
INSERT INTO `exam_answer` VALUES (88, 22, 'a');
INSERT INTO `exam_answer` VALUES (87, 22, 'b');
INSERT INTO `exam_answer` VALUES (81, 21, 'a');
INSERT INTO `exam_answer` VALUES (82, 21, 'b');
INSERT INTO `exam_answer` VALUES (83, 21, 'c');
INSERT INTO `exam_answer` VALUES (84, 21, 'd');
INSERT INTO `exam_answer` VALUES (85, 22, 'r');
INSERT INTO `exam_answer` VALUES (86, 22, 'w');
INSERT INTO `exam_answer` VALUES (89, 23, '1');
INSERT INTO `exam_answer` VALUES (90, 23, '2');
INSERT INTO `exam_answer` VALUES (91, 23, '3');
INSERT INTO `exam_answer` VALUES (92, 23, '4');
INSERT INTO `exam_answer` VALUES (93, 24, 'd');
INSERT INTO `exam_answer` VALUES (94, 24, 'a');
INSERT INTO `exam_answer` VALUES (95, 24, 'b');
INSERT INTO `exam_answer` VALUES (96, 24, 'x');
INSERT INTO `exam_answer` VALUES (97, 25, 'yhn');
INSERT INTO `exam_answer` VALUES (98, 25, 'vbn');
INSERT INTO `exam_answer` VALUES (99, 25, 'fgki');
INSERT INTO `exam_answer` VALUES (100, 25, 'bhu');
INSERT INTO `exam_answer` VALUES (101, 26, 'j');
INSERT INTO `exam_answer` VALUES (102, 26, 'assd');
INSERT INTO `exam_answer` VALUES (103, 26, 'dasd');
INSERT INTO `exam_answer` VALUES (104, 26, 'asda');
INSERT INTO `exam_answer` VALUES (105, 27, '5');
INSERT INTO `exam_answer` VALUES (106, 27, '7');
INSERT INTO `exam_answer` VALUES (107, 27, '9');
INSERT INTO `exam_answer` VALUES (108, 27, '10');
INSERT INTO `exam_answer` VALUES (109, 28, 'asddf');
INSERT INTO `exam_answer` VALUES (110, 28, 'rgdfdfdf');
INSERT INTO `exam_answer` VALUES (111, 28, 'gserhg');
INSERT INTO `exam_answer` VALUES (112, 28, 'fsdfdfd');
INSERT INTO `exam_answer` VALUES (113, 29, 'sdgasdg');
INSERT INTO `exam_answer` VALUES (114, 29, 'gasdg');
INSERT INTO `exam_answer` VALUES (115, 29, 'gadgasd');
INSERT INTO `exam_answer` VALUES (116, 29, 'fgasdf');
INSERT INTO `exam_answer` VALUES (117, 30, 'dfg');
INSERT INTO `exam_answer` VALUES (118, 30, 'df');
INSERT INTO `exam_answer` VALUES (119, 30, 'dfg');
INSERT INTO `exam_answer` VALUES (120, 30, 'fgsdfg');
