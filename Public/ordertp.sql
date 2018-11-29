/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : ordertp

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-10-23 13:38:04
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for order
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pname` varchar(255) NOT NULL DEFAULT '0' COMMENT '产品名',
  `prname` varchar(255) NOT NULL DEFAULT '0' COMMENT '价格名',
  `price` int(11) NOT NULL DEFAULT '0' COMMENT '价格',
  `realname` varchar(255) NOT NULL DEFAULT '0' COMMENT '姓名',
  `realid` varchar(255) NOT NULL DEFAULT '0' COMMENT '身份证号',
  `telephone` varchar(255) NOT NULL DEFAULT '0' COMMENT '手机',
  `province` varchar(255) NOT NULL DEFAULT '0' COMMENT '省直辖市',
  `city` varchar(255) NOT NULL DEFAULT '0' COMMENT '地级市',
  `county` varchar(255) NOT NULL DEFAULT '0' COMMENT '区县',
  `address` varchar(255) NOT NULL DEFAULT '0' COMMENT '地址',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `crtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `isok` tinyint(4) NOT NULL DEFAULT '0' COMMENT '审核',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '订单状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of order
-- ----------------------------

-- ----------------------------
-- Table structure for price
-- ----------------------------
DROP TABLE IF EXISTS `price`;
CREATE TABLE `price` (
  `prid` int(11) NOT NULL AUTO_INCREMENT,
  `fpid` int(11) NOT NULL COMMENT '父级id',
  `prname` varchar(255) NOT NULL DEFAULT '0' COMMENT '价格名',
  `price` int(11) NOT NULL DEFAULT '0' COMMENT '价格',
  `wximg` varchar(255) NOT NULL DEFAULT '0',
  `crtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`prid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of price
-- ----------------------------

-- ----------------------------
-- Table structure for product
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `premark` varchar(255) NOT NULL DEFAULT '0' COMMENT '产品代码',
  `pname` varchar(255) NOT NULL DEFAULT '0' COMMENT '产品名字',
  `crtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`pid`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of product
-- ----------------------------
INSERT INTO `product` VALUES ('1', 'FBYYS', '腹壁营养素', '2017-10-20 13:29:22');
INSERT INTO `product` VALUES ('2', 'shushanjun', '舒善菌', '2017-10-20 17:18:50');
INSERT INTO `product` VALUES ('3', 'dswe', '迪斯维尔', '2017-10-20 17:19:32');
INSERT INTO `product` VALUES ('4', 'yingerbao', '婴儿葆', '2017-10-20 17:27:54');
INSERT INTO `product` VALUES ('5', 'ceshichanpin', '测试产品', '2017-10-20 17:31:01');
INSERT INTO `product` VALUES ('6', 'ceshi', '测试产品02', '2017-10-20 17:33:17');
INSERT INTO `product` VALUES ('7', 'ceshi03', '测试产品03', '2017-10-20 17:40:28');
INSERT INTO `product` VALUES ('8', 'ceshi04', '测试产品04', '2017-10-20 17:43:01');
