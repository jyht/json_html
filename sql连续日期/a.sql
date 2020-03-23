/*
Navicat MySQL Data Transfer

Source Server         : root
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : jyht

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2020-03-07 13:49:20
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for a
-- ----------------------------
DROP TABLE IF EXISTS `a`;
CREATE TABLE `a` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `log` varchar(255) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of a
-- ----------------------------
INSERT INTO `a` VALUES ('1', '1-1', '2020-03-01 12:35:43');
INSERT INTO `a` VALUES ('2', '3-3', '2020-03-02 12:35:57');
INSERT INTO `a` VALUES ('3', '3-3', '2020-03-02 12:36:10');
INSERT INTO `a` VALUES ('4', '3-3', '2020-03-02 12:36:30');
INSERT INTO `a` VALUES ('5', '7-1', '2020-03-07 12:58:08');
INSERT INTO `a` VALUES ('6', '2-2', '2020-03-05 13:08:33');
INSERT INTO `a` VALUES ('7', '2-2', '2020-03-05 13:08:46');
INSERT INTO `a` VALUES ('8', '1-1', '2020-03-04 13:48:42');
