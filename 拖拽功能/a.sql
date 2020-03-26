/*
Navicat MySQL Data Transfer

Source Server         : root
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : xing

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2020-03-26 13:28:59
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for a
-- ----------------------------
DROP TABLE IF EXISTS `a`;
CREATE TABLE `a` (
  `id` int(3) DEFAULT NULL,
  `xulie` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of a
-- ----------------------------
INSERT INTO `a` VALUES ('1', 'draggable4,draggable10,draggable11,draggable1,draggable3,draggable9,draggable6,draggable7,draggable5,draggable2,draggable8');
