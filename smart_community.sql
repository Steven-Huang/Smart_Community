/*
 Navicat Premium Data Transfer

 Source Server         : mysql
 Source Server Type    : MySQL
 Source Server Version : 50711
 Source Host           : localhost
 Source Database       : smart_community

 Target Server Type    : MySQL
 Target Server Version : 50711
 File Encoding         : utf-8

 Date: 04/22/2016 18:01:50 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `sc_access`
-- ----------------------------
DROP TABLE IF EXISTS `sc_access`;
CREATE TABLE `sc_access` (
  `role_id` smallint(6) unsigned NOT NULL,
  `node_id` smallint(6) unsigned NOT NULL,
  `module` varchar(50) DEFAULT NULL,
  KEY `groupId` (`role_id`),
  KEY `nodeId` (`node_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='RBAC数据库';

-- ----------------------------
--  Records of `sc_access`
-- ----------------------------
BEGIN;
INSERT INTO `sc_access` VALUES ('6', '9', null), ('6', '8', null), ('5', '21', null), ('5', '20', null), ('5', '19', null), ('5', '12', null), ('7', '10', null), ('4', '8', null), ('4', '9', null), ('4', '10', null), ('4', '11', null), ('4', '12', null), ('6', '10', null), ('6', '11', null), ('6', '12', null), ('5', '11', null), ('5', '10', null), ('5', '9', null), ('5', '17', null), ('5', '16', null), ('5', '14', null), ('5', '8', null), ('5', '22', null), ('1', '29', null), ('1', '28', null), ('1', '27', null), ('1', '26', null), ('1', '25', null), ('1', '24', null), ('1', '23', null), ('1', '22', null), ('1', '21', null), ('1', '20', null), ('1', '19', null), ('1', '12', null), ('1', '11', null), ('1', '10', null), ('1', '9', null), ('1', '17', null), ('1', '16', null), ('1', '14', null), ('1', '8', null);
COMMIT;

-- ----------------------------
--  Table structure for `sc_admin`
-- ----------------------------
DROP TABLE IF EXISTS `sc_admin`;
CREATE TABLE `sc_admin` (
  `id` int(8) unsigned zerofill NOT NULL AUTO_INCREMENT COMMENT '管理员ID',
  `icon_url` varchar(100) DEFAULT NULL COMMENT '管理员头像',
  `nick_name` varchar(10) NOT NULL COMMENT '昵称',
  `true_name` varchar(10) NOT NULL COMMENT '真实姓名',
  `gender` enum('1','2') NOT NULL COMMENT '1表示男，2表示女',
  `password` char(50) NOT NULL COMMENT '管理员密码，MD5格式',
  `mobile` int(20) unsigned NOT NULL COMMENT '手机号',
  `email` varchar(50) NOT NULL COMMENT '邮箱',
  `id_card_num` char(18) NOT NULL COMMENT '身份证号',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `last_log_ip` char(15) NOT NULL COMMENT '上次登录IP',
  `last_log_time` datetime NOT NULL COMMENT '上次登录时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `nick_name` (`nick_name`),
  UNIQUE KEY `mobile` (`mobile`),
  UNIQUE KEY `email` (`email`),
  KEY `id_card_num` (`id_card_num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理员账号信息';

-- ----------------------------
--  Table structure for `sc_book_places`
-- ----------------------------
DROP TABLE IF EXISTS `sc_book_places`;
CREATE TABLE `sc_book_places` (
  `bp_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '场地申请工单ID',
  `u_id` int(10) unsigned NOT NULL COMMENT '申请人',
  `bp_create_time` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '申请时间',
  `bp_start_time` datetime NOT NULL COMMENT '申请使用开始时间',
  `bp_end_time` datetime NOT NULL COMMENT '申请使用结束时间',
  `bp_type` enum('1','2','3') NOT NULL COMMENT '1->会议室，2->广场，3->游泳池',
  `bp_purpose` enum('1','2','3') NOT NULL COMMENT '1->个人使用，2->团体活动，3->商业用途',
  `bp_attend_num` int(4) unsigned NOT NULL COMMENT '参与人数',
  `bp_content` text NOT NULL COMMENT '申请内容',
  `bp_materials` varchar(250) NOT NULL COMMENT '申请材料 URL',
  `bp_status` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT '0->待审核，1->审核通过，2->审核失败',
  `w_id` int(10) unsigned NOT NULL COMMENT '操作人',
  `bp_operate_time` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '操作时间',
  PRIMARY KEY (`bp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='场地申请（book place）';

-- ----------------------------
--  Table structure for `sc_feedback_complaint`
-- ----------------------------
DROP TABLE IF EXISTS `sc_feedback_complaint`;
CREATE TABLE `sc_feedback_complaint` (
  `fc_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '投诉工单ID',
  `fc_type` enum('1','2','3','4','5','6','7','8') NOT NULL COMMENT '1，环境卫生；2，服务技能；3，服务态度；4，服务时限；5，公共设施；6，监控投诉；7，安全事故；8，其他投诉',
  `fc_content` text NOT NULL COMMENT '投诉内容',
  `fc_materials` varchar(250) NOT NULL COMMENT '投诉材料URL',
  `fc_create_time` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '提交时间',
  `fc_status` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0，待处理；1，已处理',
  `fc_results` varchar(250) NOT NULL COMMENT '处理结果',
  `w_id` int(10) unsigned NOT NULL COMMENT '操作人',
  `fc_operate_time` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '操作时间',
  PRIMARY KEY (`fc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='投诉管理(feedback complaint)';

-- ----------------------------
--  Table structure for `sc_feedback_praise`
-- ----------------------------
DROP TABLE IF EXISTS `sc_feedback_praise`;
CREATE TABLE `sc_feedback_praise` (
  `fp_id` int(11) NOT NULL,
  `fp_to` varchar(50) NOT NULL COMMENT '被表扬人/单位',
  `fp_content` text NOT NULL COMMENT '表扬内容',
  `fp_materials` varchar(250) NOT NULL COMMENT '表扬材料URL',
  `fp_create_time` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '提交时间',
  `fp_status` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0，待处理；1，已处理',
  `fp_results` varchar(250) NOT NULL COMMENT '处理结果',
  `w_id` int(10) unsigned NOT NULL COMMENT '操作人',
  `fc_operate_time` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '操作时间',
  PRIMARY KEY (`fp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='表扬管理（feedback praise）';

-- ----------------------------
--  Table structure for `sc_fees`
-- ----------------------------
DROP TABLE IF EXISTS `sc_fees`;
CREATE TABLE `sc_fees` (
  `f_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '费用单号',
  `u_id` int(1) unsigned NOT NULL COMMENT '用户ID',
  `f_pre_pay_left` decimal(10,3) unsigned NOT NULL COMMENT '预付费用余额',
  `f_water` decimal(10,3) unsigned NOT NULL COMMENT '水费',
  `f_electricity` decimal(10,3) unsigned NOT NULL COMMENT '电费',
  `f_gas` decimal(10,3) unsigned NOT NULL COMMENT '燃气费',
  `f_heat` decimal(10,3) unsigned NOT NULL COMMENT '暖气费',
  `f_property` decimal(10,3) unsigned NOT NULL COMMENT '物业费',
  `f_cleaning` decimal(10,3) unsigned NOT NULL COMMENT '卫生费',
  `f_park` decimal(10,3) unsigned NOT NULL COMMENT '停车费',
  `f_others` decimal(10,3) unsigned NOT NULL COMMENT '其他费用',
  `f_create_time` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '费用产生时间',
  PRIMARY KEY (`f_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='费用管理';

-- ----------------------------
--  Table structure for `sc_house_info`
-- ----------------------------
DROP TABLE IF EXISTS `sc_house_info`;
CREATE TABLE `sc_house_info` (
  `h_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '房产ID',
  `h_prov` varchar(10) NOT NULL COMMENT '所在省份',
  `h_city` varchar(10) NOT NULL COMMENT '所在城市',
  `h_region` varchar(10) NOT NULL COMMENT '所在区域',
  `h_comm` varchar(10) NOT NULL COMMENT '所在小区',
  `h_block_num` int(11) unsigned NOT NULL COMMENT '所在楼号',
  `h_room_num` int(11) unsigned NOT NULL COMMENT '门牌号',
  `h_room_size` double(4,3) NOT NULL COMMENT '户型大小',
  `h_owner_name` varchar(10) NOT NULL COMMENT '业主名称',
  `h_owner_id_card_num` char(18) NOT NULL COMMENT '业主身份证号',
  `h_owner_mobile` varchar(20) NOT NULL COMMENT '业主手机号',
  `h_email` varchar(50) NOT NULL COMMENT '邮箱',
  `h_pocn` varchar(30) NOT NULL COMMENT 'property ownership certificate number 房产证号',
  PRIMARY KEY (`h_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='业主房产基本信息，由物业整理';

-- ----------------------------
--  Table structure for `sc_mgrs`
-- ----------------------------
DROP TABLE IF EXISTS `sc_mgrs`;
CREATE TABLE `sc_mgrs` (
  `id` int(8) unsigned zerofill NOT NULL AUTO_INCREMENT COMMENT '业主ID',
  `icon_url` varchar(100) DEFAULT NULL COMMENT '头像',
  `nick_name` varchar(10) NOT NULL COMMENT '昵称',
  `true_name` varchar(10) NOT NULL COMMENT '真实姓名',
  `password` char(50) NOT NULL COMMENT '业主密码，MD5格式',
  `gender` enum('1','2') NOT NULL COMMENT '1表示男，2表示女',
  `mobile` int(20) unsigned NOT NULL COMMENT '手机号',
  `email` varchar(50) NOT NULL COMMENT '邮箱',
  `id_card_num` char(18) NOT NULL COMMENT '身份证号',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `last_log_ip` char(15) NOT NULL COMMENT '上次登录IP',
  `last_log_time` datetime NOT NULL COMMENT '上次登录时间',
  `if_aprvd` enum('0','1','-1') NOT NULL DEFAULT '0' COMMENT '物业是否通过审批，0->待审批，1->审批通过， -1->审批不通过',
  PRIMARY KEY (`id`),
  KEY `nick_name` (`nick_name`),
  KEY `mobile` (`mobile`),
  KEY `email` (`email`),
  KEY `id_card_num` (`id_card_num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='物业管理者账号信息';

-- ----------------------------
--  Table structure for `sc_node`
-- ----------------------------
DROP TABLE IF EXISTS `sc_node`;
CREATE TABLE `sc_node` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `remark` varchar(255) DEFAULT NULL,
  `sort` smallint(6) unsigned DEFAULT NULL,
  `pid` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `level` (`level`),
  KEY `pid` (`pid`),
  KEY `status` (`status`),
  KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COMMENT='RBAC数据库';

-- ----------------------------
--  Records of `sc_node`
-- ----------------------------
BEGIN;
INSERT INTO `sc_node` VALUES ('8', 'Admin', '后台', '1', null, '100', '0', '1'), ('14', 'Index', '显示', '1', null, '100', '8', '2'), ('9', 'Users', '业主', '1', null, '100', '8', '2'), ('10', 'index', '显示', '1', null, '100', '9', '3'), ('11', 'add', '添加', '1', null, '100', '9', '3'), ('12', 'edit', '编辑', '1', null, '100', '9', '3'), ('16', 'index', '显示主页', '1', null, '100', '14', '3'), ('17', 'logout', '退出', '1', null, '100', '14', '3'), ('19', 'Access', '权限操作', '1', null, '100', '8', '2'), ('20', 'index', '用户列表', '1', null, '100', '19', '3'), ('21', 'role', '角色列表', '1', null, '100', '19', '3'), ('22', 'node', '节点列表', '1', null, '100', '19', '3'), ('23', 'add_user', '添加/编辑用户', '1', null, '100', '19', '3'), ('24', 'del_user', '删除用户', '1', null, '100', '19', '3'), ('25', 'add_node', '添加/编辑节点', '1', null, '100', '19', '3'), ('26', 'del_node', '删除节点', '1', null, '100', '19', '3'), ('27', 'add_role', '添加/编辑角色', '1', null, '100', '19', '3'), ('28', 'del_role', '删除角色', '1', null, '100', '19', '3'), ('29', 'Access', '权限配置', '1', null, '100', '19', '3');
COMMIT;

-- ----------------------------
--  Table structure for `sc_notice`
-- ----------------------------
DROP TABLE IF EXISTS `sc_notice`;
CREATE TABLE `sc_notice` (
  `n_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '小区通知/政府公告/办事指南 ID',
  `n_type` set('1','2','3') NOT NULL COMMENT '1->小区通知,2->政府公告,3->办事指南(可多选)',
  `n_source` varchar(20) NOT NULL,
  `n_titile` varchar(20) NOT NULL,
  `n_pub_date` datetime NOT NULL COMMENT '发布时间',
  `n_valid_time` datetime NOT NULL COMMENT '有效期',
  `n_content` text NOT NULL COMMENT '内容',
  `n_keywords` varchar(20) NOT NULL COMMENT '关键词',
  `n_author` varchar(20) NOT NULL COMMENT '作者',
  `n_status` enum('1','0') NOT NULL DEFAULT '0' COMMENT '1->发布,0->未发布',
  PRIMARY KEY (`n_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='小区通知/政府公告/办事指南';

-- ----------------------------
--  Table structure for `sc_parking_fee_pre_pay`
-- ----------------------------
DROP TABLE IF EXISTS `sc_parking_fee_pre_pay`;
CREATE TABLE `sc_parking_fee_pre_pay` (
  `pf_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '预付停车费工单ID',
  `u_id` int(10) unsigned NOT NULL,
  `pf_is_vip` enum('0','1') NOT NULL COMMENT '判断是否月卡用户，0->不是，1->是',
  `pf_license_num` varchar(20) NOT NULL COMMENT '车牌号',
  `pf_type` enum('1','2') NOT NULL COMMENT '1，露天停车场；2，地下停车库',
  `pf_period` enum('1','3','6','12') DEFAULT NULL COMMENT '缴费时长（月用户），1->一个月,3->三个月,6->六个月,12->一年',
  `pf_money` decimal(10,3) unsigned NOT NULL COMMENT '缴费金额',
  `pf_create_time` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '缴费时间',
  PRIMARY KEY (`pf_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='预付停车费（parking_fee_pre_pay）';

-- ----------------------------
--  Table structure for `sc_parking_manage`
-- ----------------------------
DROP TABLE IF EXISTS `sc_parking_manage`;
CREATE TABLE `sc_parking_manage` (
  `p_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '停车工单ID',
  `u_id` int(10) unsigned NOT NULL COMMENT '申请人',
  `p_license_num` varchar(20) NOT NULL COMMENT '车牌号',
  `p_start_time` datetime NOT NULL COMMENT '停车开始时间',
  `p_end_time` datetime NOT NULL COMMENT '停车结束时间',
  `p_fee_balance` decimal(5,0) NOT NULL COMMENT '预缴停车费余额',
  `p_fee_current` decimal(5,0) NOT NULL COMMENT '实时停车费',
  `p_pay_status` enum('0','1') NOT NULL COMMENT '0->未缴费/余额不足，1->已缴费',
  `p_pay_time` datetime NOT NULL COMMENT '缴费时间',
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='停车管理';

-- ----------------------------
--  Table structure for `sc_property_fee_pre_pay`
-- ----------------------------
DROP TABLE IF EXISTS `sc_property_fee_pre_pay`;
CREATE TABLE `sc_property_fee_pre_pay` (
  `pp_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '预付管理费工单ID',
  `pp_period` enum('1','3','6','12') NOT NULL COMMENT '缴费时长，1->一个月,3->三个月,6->六个月,12->一年',
  `pp_money` decimal(10,3) unsigned NOT NULL COMMENT '缴费金额',
  `pf_create_time` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '缴费时间',
  PRIMARY KEY (`pp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='预付管理费（property_fee_pre_pay）';

-- ----------------------------
--  Table structure for `sc_release_goods`
-- ----------------------------
DROP TABLE IF EXISTS `sc_release_goods`;
CREATE TABLE `sc_release_goods` (
  `rg_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '物品放行工单号',
  `u_id` int(10) unsigned NOT NULL COMMENT '申请人',
  `rg_items` varchar(50) NOT NULL COMMENT '放行物品',
  `rg_status` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT '0->待审核,1->审核通过,2->审核失败',
  `w_id` varchar(10) NOT NULL COMMENT '操作人',
  `rg_operate_time` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '操作时间',
  PRIMARY KEY (`rg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='物品放行（release Goods）';

-- ----------------------------
--  Table structure for `sc_repair`
-- ----------------------------
DROP TABLE IF EXISTS `sc_repair`;
CREATE TABLE `sc_repair` (
  `r_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '维修工单号',
  `r_create_time` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '工单生成时间',
  `u_id` int(10) unsigned NOT NULL COMMENT '报修人',
  `r_type` enum('1','2') NOT NULL COMMENT '1->私人住宅,2->公告设施',
  `r_pri_items` enum('0','1','2','3','4','5','6') NOT NULL DEFAULT '0' COMMENT '[私人住宅报修项目]: 0->默认没有选择项目，1->管道疏通，2->水电维修，3->房屋维修，4->开锁/换锁，5->线路维修，6->其他',
  `r_pub_items` enum('0','1','2','3','4','5','6') NOT NULL DEFAULT '0' COMMENT '[公共设施报修项目]: 0->默认没有选择项目，1->照明设施，2->住房主体设施，3->电梯设施，4->供水设施，5->供电设施，6->其他',
  `r_details` text NOT NULL COMMENT '详细说明',
  `r_pic` varchar(100) NOT NULL COMMENT '故障图（支持多图）',
  `r_status` enum('0','1','2','3') NOT NULL DEFAULT '0' COMMENT '0->待处理, 1->处理成功, 2->处理失败, 3->用户撤销',
  `w_id` int(10) unsigned NOT NULL COMMENT '操作人',
  `r_operate_time` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '操作时间',
  PRIMARY KEY (`r_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `sc_role`
-- ----------------------------
DROP TABLE IF EXISTS `sc_role`;
CREATE TABLE `sc_role` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `pid` smallint(6) DEFAULT NULL,
  `status` tinyint(1) unsigned DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=102 DEFAULT CHARSET=utf8 COMMENT='RBAC数据库';

-- ----------------------------
--  Records of `sc_role`
-- ----------------------------
BEGIN;
INSERT INTO `sc_role` VALUES ('1', '超级管理员', null, '1', '系统超级管理员，拥有全部权限'), ('2', '业主', null, '1', '业主，拥有部分权限'), ('3', '物业管理', null, '1', '物业管理人员，拥有部分权限'), ('4', '保安', null, '1', '保安'), ('5', '维修人员', null, '1', '维修人员'), ('6', '保洁员', null, '1', '保洁员'), ('0', '无', null, '1', '未分配角色');
COMMIT;

-- ----------------------------
--  Table structure for `sc_role_user`
-- ----------------------------
DROP TABLE IF EXISTS `sc_role_user`;
CREATE TABLE `sc_role_user` (
  `role_id` int(9) unsigned DEFAULT NULL,
  `user_id` char(32) DEFAULT NULL,
  `user_type` char(1) NOT NULL COMMENT 'M - 物业，U - 业主，A - 超级管理员',
  KEY `group_id` (`role_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='RBAC数据库';

-- ----------------------------
--  Records of `sc_role_user`
-- ----------------------------
BEGIN;
INSERT INTO `sc_role_user` VALUES ('0', '28', 'M'), ('1', '27', 'U'), ('0', '41', 'U');
COMMIT;

-- ----------------------------
--  Table structure for `sc_users`
-- ----------------------------
DROP TABLE IF EXISTS `sc_users`;
CREATE TABLE `sc_users` (
  `id` int(8) unsigned zerofill NOT NULL AUTO_INCREMENT COMMENT '业主ID',
  `icon_url` varchar(100) DEFAULT NULL COMMENT '头像',
  `nick_name` varchar(10) NOT NULL COMMENT '昵称',
  `true_name` varchar(10) NOT NULL COMMENT '真实姓名',
  `password` char(50) NOT NULL COMMENT '业主密码，MD5格式',
  `gender` enum('1','2') NOT NULL COMMENT '1表示男，2表示女',
  `h_pocn` varchar(30) NOT NULL COMMENT 'property ownership certificate number 房产证号',
  `mobile` int(20) unsigned NOT NULL COMMENT '手机号',
  `email` varchar(50) NOT NULL COMMENT '邮箱',
  `id_card_num` char(18) NOT NULL COMMENT '身份证号',
  `create_time` datetime NOT NULL COMMENT '用户创建时间',
  `last_log_ip` char(15) NOT NULL DEFAULT '' COMMENT '上次登录IP',
  `last_log_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '上次登录时间',
  `if_aprvd` enum('0','1','-1') NOT NULL DEFAULT '0' COMMENT '用户是否通过审批，0->待审批，1->审批通过， -1->审批不通过',
  PRIMARY KEY (`id`),
  UNIQUE KEY `nick_name` (`nick_name`) USING BTREE,
  UNIQUE KEY `mobile` (`mobile`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `id_card_num` (`id_card_num`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COMMENT='业主信息';

-- ----------------------------
--  Records of `sc_users`
-- ----------------------------
BEGIN;
INSERT INTO `sc_users` VALUES ('27', '123123', 'admin', '1231', '202cb962ac59075b964b07152d234b70', '2', '123', '123', '123', '123', '2016-04-14 11:28:23', '::1', '2016-04-22 05:51:29', '1'), ('28', '222222', 'guest', '1231', '202cb962ac59075b964b07152d234b70', '2', '1234', '1234', '1234', '1234', '2016-04-18 02:08:57', '::1', '2016-04-18 01:50:23', '1'), ('36', '456', '456', '456', '250cf8b51c773f3f8dc8b4be867a9a02', '2', '456', '456', '456', '456', '2016-04-20 09:31:29', '', '2016-04-20 09:31:29', '0'), ('37', '789', '789', '789', '68053af2923e00204c3ca7c6a3150cf7', '2', '789', '789', '789', '789', '2016-04-20 09:32:50', '', '2016-04-20 09:32:50', '0'), ('38', '753', '753', '753', '6f2268bd1d3d3ebaabb04d6b5d099425', '2', '753', '753', '753', '753', '2016-04-20 09:34:08', '', '2016-04-20 09:34:08', '0'), ('39', '159', '159', '159', '140f6969d5213fd0ece03148e62e461e', '2', '159', '159', '159', '159', '2016-04-20 09:35:21', '', '2016-04-20 09:35:21', '0'), ('40', '789789', '789789', '789789', '21b95a0f90138767b0fd324e6be3457b', '1', '789789', '789789', '789789', '789789', '2016-04-20 09:36:49', '', '2016-04-20 09:36:49', '0'), ('41', '456456', '456456', '456456', 'b51e8dbebd4ba8a8f342190a4b9f08d7', '2', '456456', '456456', '456456', '456456', '2016-04-20 09:37:54', '', '2016-04-20 09:37:54', '0');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
