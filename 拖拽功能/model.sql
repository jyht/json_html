/*
Navicat MySQL Data Transfer

Source Server         : root
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : xing

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2020-03-26 13:22:28
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for model
-- ----------------------------
DROP TABLE IF EXISTS `model`;
CREATE TABLE `model` (
  `model_id` varchar(255) DEFAULT NULL,
  `txt` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of model
-- ----------------------------
INSERT INTO `model` VALUES ('draggable1', '1');
INSERT INTO `model` VALUES ('draggable2', '2');
INSERT INTO `model` VALUES ('draggable3', '3');
INSERT INTO `model` VALUES ('draggable4', '4');
INSERT INTO `model` VALUES ('draggable6', '6');
INSERT INTO `model` VALUES ('draggable5', '5');
INSERT INTO `model` VALUES ('draggable7', '7');
INSERT INTO `model` VALUES ('draggable8', '8');
INSERT INTO `model` VALUES ('draggable9', '9');
INSERT INTO `model` VALUES ('draggable10', '10');
INSERT INTO `model` VALUES ('draggable11', '11');
