/*
 Navicat Premium Data Transfer

 Source Server         : nhtai_com
 Source Server Type    : MySQL
 Source Server Version : 50739
 Source Host           : 8.210.150.102:3306
 Source Schema         : nhtai_com

 Target Server Type    : MySQL
 Target Server Version : 50739
 File Encoding         : 65001

 Date: 04/12/2022 15:08:34
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for caiji_725998
-- ----------------------------
DROP TABLE IF EXISTS `caiji_725998`;
CREATE TABLE `caiji_725998`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '标题',
  `url` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '链接',
  `img` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '缩略图',
  `lib_daoyan` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '导演',
  `lib_zhuyan` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '主演',
  `lib_guojia` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '国家',
  `lib_shangying` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '上映时间',
  `lib_pingfen` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '评分',
  `lib_content` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '简介',
  `type` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '电影分类',
  `status` int(5) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 77 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
