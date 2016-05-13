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

 Date: 05/13/2016 17:41:22 PM
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
  `mobile` char(11) NOT NULL COMMENT '手机号',
  `email` varchar(50) NOT NULL COMMENT '邮箱',
  `id_card_num` varchar(18) NOT NULL COMMENT '身份证号',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `last_log_ip` char(15) NOT NULL DEFAULT '' COMMENT '上次登录IP',
  `last_log_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '上次登录时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `nick_name` (`nick_name`),
  UNIQUE KEY `mobile` (`mobile`),
  UNIQUE KEY `email` (`email`),
  KEY `id_card_num` (`id_card_num`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='管理员账号信息';

-- ----------------------------
--  Records of `sc_admin`
-- ----------------------------
BEGIN;
INSERT INTO `sc_admin` VALUES ('1', '121231', '123', '123', '1', '123', '123', '123', '123', '2016-04-26 09:13:04', '123', '2016-04-26 09:13:11'), ('2', '121231', '1234', '1234', '1', '123', '1234', '1234', '1234', '2016-04-26 09:13:04', '123', '2016-04-26 09:13:11'), ('3', '121231', '12345', '12345', '1', '123', '12345', '12345', '12345', '2016-04-26 09:13:04', '123', '2016-04-26 09:13:11'), ('4', '121231', '12346', '12346', '1', '123', '12346', '12346', '12346', '2016-04-26 09:13:04', '123', '2016-04-26 09:13:11'), ('5', '121231', '12347', '12347', '1', '123', '12347', '12347', '12347', '2016-04-26 09:13:04', '123', '2016-04-26 09:13:11'), ('6', '121231', '12348', '12348', '1', '123', '12348', '12348', '12348', '2016-04-26 09:13:04', '123', '2016-04-26 09:13:11'), ('7', '121231', '12349', '12349', '1', '123', '12349', '12349', '12349', '2016-04-26 09:13:04', '123', '2016-04-26 09:13:11'), ('8', '121231', '12340', '12340', '1', '123', '12340', '12340', '12340', '2016-04-26 09:13:04', '123', '2016-04-26 09:13:11'), ('9', null, 'admin', 'admin', '2', '949d54f4aeee55213fd9a07bba4d97aa', '13631431767', '1213@qq.com', '123123123121231212', '2016-05-10 10:39:59', '1', '2016-05-27 10:44:18'), ('10', null, 'fasdfasdf', 'adsfasdfas', '2', '98b107363e7879574be88688921f3c63', '13632532468', '11@qq.com', '441111111111111111', '2016-05-12 02:09:04', '', '2016-05-12 14:09:04');
COMMIT;

-- ----------------------------
--  Table structure for `sc_article`
-- ----------------------------
DROP TABLE IF EXISTS `sc_article`;
CREATE TABLE `sc_article` (
  `aid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '文章ID',
  `acid` int(11) NOT NULL COMMENT '文章分类ID',
  `atitle` varchar(150) NOT NULL COMMENT '标题',
  `keyword` varchar(100) NOT NULL COMMENT '关键词',
  `source` varchar(20) NOT NULL COMMENT '来源',
  `author` varchar(20) NOT NULL COMMENT '作者',
  `des` varchar(150) NOT NULL COMMENT '摘要',
  `content` mediumtext NOT NULL COMMENT '内容',
  `valid_time` date NOT NULL COMMENT '有效期',
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `create_id` char(11) NOT NULL COMMENT '创建人ID',
  `status` enum('1','0','-1','-2') NOT NULL DEFAULT '0' COMMENT '1->发布,0->待审核,-1->回收站,-2->彻底删除状态',
  `operate_time` datetime DEFAULT NULL COMMENT '审批时间',
  `operate_id` char(11) DEFAULT NULL COMMENT '审批人ID',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `sc_article`
-- ----------------------------
BEGIN;
INSERT INTO `sc_article` VALUES ('1', '1', '1', '1', '1', '1', '1', '1', '2016-05-13', '2016-05-13 11:31:50', '1', '1', null, null, '0'), ('2', '1', '1', '1', '1', '1', '1', '1', '2016-05-13', '2016-05-13 11:31:50', '1', '0', null, null, '0'), ('41', '2', '1', '1', '1', '1', '1', '1', '2016-05-13', '2016-05-13 11:31:50', '1', '1', null, null, '0'), ('42', '2', '1', '1', '1', '1', '1', '1', '2016-05-13', '2016-05-13 11:31:50', '1', '0', null, null, '0'), ('43', '3', 'YES', '1', '1', '1', '1', '1', '2016-05-13', '2016-05-13 11:31:50', '1', '1', null, null, '0'), ('44', '3', 'no', '1', '1', '1', '1', '1', '2016-05-13', '2016-05-13 11:31:50', '1', '0', null, null, '0'), ('45', '3', 'no', '1', '1', '1', '1', '1', '2016-05-13', '2016-05-13 11:31:50', '1', '0', null, null, '0'), ('46', '3', 'YES', '1', '1', '1', '1', '1', '2016-05-13', '2016-05-13 11:31:50', '1', '1', null, null, '0'), ('47', '1', '121313', '123', '12312312', '3121231231', '12312313', '%26amp%3Blt%3Bp%26amp%3Bgt%3B12123123%26amp%3Blt%3B%2Fp%26amp%3Bgt%3B', '2016-05-27', '2016-05-13 17:04:38', 'U00000027', '0', null, null, '0'), ('48', '3', '121231', '12123123123', '12123123', '2123123', '12123123', '%26amp%3Blt%3Bp%26amp%3Bgt%3B12123123123%26amp%3Blt%3B%2Fp%26amp%3Bgt%3B', '2016-05-26', '2016-05-13 17:05:10', 'U00000027', '0', null, null, '333'), ('49', '1', '11231231', '1213', '123123123', '12123123132', '12123123', '%26amp%3Blt%3Bp%26amp%3Bgt%3B123123123%26amp%3Blt%3B%2Fp%26amp%3Bgt%3B', '2016-05-19', '2016-05-13 17:13:48', 'U00000027', '0', null, null, '0'), ('50', '51', '1212312312', '1213', '121231231231', '121231231', '12123123', '%26amp%3Blt%3Bp%26amp%3Bgt%3B12123123%26amp%3Blt%3B%2Fp%26amp%3Bgt%3B', '2016-05-26', '2016-05-13 17:14:08', 'U00000027', '0', null, null, '0'), ('51', '1', '45456456', '1%2C2%2C3%2C4', '4564564564564', '5456456456456', '12123123123', '%26amp%3Blt%3Bp%26amp%3Bgt%3B1212123123%26amp%3Bamp%3Bnbsp%3B%26amp%3Bamp%3Bnbsp%3B%26amp%3Bamp%3Bnbsp%3B%26amp%3Bamp%3Bnbsp%3B1212312%26amp%3Blt%3B%2Fp%26amp%3Bgt%3B', '2016-05-25', '2016-05-13 17:36:21', 'U00000027', '0', null, null, '0');
COMMIT;

-- ----------------------------
--  Table structure for `sc_article_cat`
-- ----------------------------
DROP TABLE IF EXISTS `sc_article_cat`;
CREATE TABLE `sc_article_cat` (
  `acid` int(11) NOT NULL AUTO_INCREMENT COMMENT '分类ID',
  `afid` int(11) NOT NULL COMMENT '父类ID',
  `aname` varchar(80) NOT NULL COMMENT '分类名字',
  `sort` int(2) NOT NULL DEFAULT '0' COMMENT '排序',
  `acreate_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`acid`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `sc_article_cat`
-- ----------------------------
BEGIN;
INSERT INTO `sc_article_cat` VALUES ('1', '0', '小区通知', '0', '2016-05-12 14:04:36'), ('2', '0', '政府公告', '0', '2016-05-12 14:04:51'), ('3', '0', '办事指南', '0', '2016-05-12 14:05:07'), ('50', '0', '便民服务', '0', '2016-05-13 15:34:35'), ('51', '50', '卫生清洁', '0', '2016-05-13 15:35:02');
COMMIT;

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
--  Table structure for `sc_feedback`
-- ----------------------------
DROP TABLE IF EXISTS `sc_feedback`;
CREATE TABLE `sc_feedback` (
  `fb_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '投诉工单ID',
  `fb_to` varchar(30) NOT NULL COMMENT '目标人/单位名称',
  `fb_type` enum('1','2','3','4','5','6','7','8','9') NOT NULL COMMENT '1，环境卫生；2，服务技能；3，服务态度；4，服务时限；5，公共设施；6，监控投诉；7，安全事故；8，其他投诉; 9, 表扬',
  `fb_content` text NOT NULL COMMENT '内容',
  `fb_materials` varchar(250) NOT NULL COMMENT '上传材料的URL',
  `fb_create_time` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '提交时间',
  `fb_create_id` int(11) unsigned NOT NULL COMMENT '操作人',
  `fb_status` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0，待处理；1，已处理',
  `fb_results` varchar(250) DEFAULT NULL COMMENT '处理结果',
  `fb_operate_id` int(11) unsigned DEFAULT NULL COMMENT '操作人',
  `fb_operate_time` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '操作时间',
  PRIMARY KEY (`fb_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='投诉管理(feedback complaint)';

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
  `mobile` char(11) NOT NULL COMMENT '手机号',
  `email` varchar(50) NOT NULL COMMENT '邮箱',
  `id_card_num` varchar(18) NOT NULL COMMENT '身份证号',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `last_log_ip` char(15) NOT NULL DEFAULT '' COMMENT '上次登录IP',
  `last_log_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '上次登录时间',
  `if_aprvd` enum('0','1','-1') NOT NULL DEFAULT '0' COMMENT '物业是否通过审批，0->待审批，1->审批通过， -1->审批不通过',
  PRIMARY KEY (`id`),
  KEY `nick_name` (`nick_name`),
  KEY `mobile` (`mobile`),
  KEY `email` (`email`),
  KEY `id_card_num` (`id_card_num`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='物业管理者账号信息';

-- ----------------------------
--  Records of `sc_mgrs`
-- ----------------------------
BEGIN;
INSERT INTO `sc_mgrs` VALUES ('1', '1', '1', '1', '1', '1', '1', '1', '1', '2016-05-18 16:28:26', '1', '2016-05-05 16:28:30', '1'), ('2', '2', '2', '2', '2', '2', '2', '2', '2', '2016-05-27 16:28:52', '2', '2016-05-05 16:28:58', '0'), ('3', null, '1231', '123123', '97477d07fe32d39ba87bdd6e378b4ba7', '2', '13631431767', '12123@qq.com', '123123121231231231', '2016-05-10 10:31:40', '1', '2016-05-10 10:33:31', '0'), ('4', null, '12314', '123123', '89faffabd6aa961212731253baa96fae', '2', '13631431763', '121231@qq.com', '123123121231231232', '2016-05-10 10:32:34', '1', '2016-05-10 10:33:34', '0'), ('5', null, '123145', '123123', '8b506bb19e56bb53b4f435685f84445b', '2', '13631431762', '12123141@qq.com', '123123121231231236', '2016-05-10 10:35:13', '1', '2016-05-20 10:44:43', '0'), ('6', null, '123', '123', '64a90249d05e0ab880c54f269d9c21f4', '2', '13631525286', '123@qqqq.cpm', '123111111111111111', '2016-05-10 10:46:00', '', '2016-05-10 10:46:00', '0');
COMMIT;

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
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 COMMENT='RBAC数据库';

-- ----------------------------
--  Records of `sc_node`
-- ----------------------------
BEGIN;
INSERT INTO `sc_node` VALUES ('8', 'admin', '后台', '1', null, '100', '0', '1'), ('14', 'Index', '显示', '1', null, '100', '8', '2'), ('9', 'users', '业主', '1', null, '100', '8', '2'), ('10', 'index', '显示', '1', null, '100', '9', '3'), ('11', 'add', '添加', '1', null, '100', '9', '3'), ('12', 'edit', '编辑', '1', null, '100', '9', '3'), ('16', 'index', '显示主页', '1', null, '100', '14', '3'), ('17', 'logout', '退出', '1', null, '100', '14', '3'), ('19', 'access', '权限操作', '1', null, '100', '8', '2'), ('20', 'index', '用户列表', '1', null, '100', '19', '3'), ('21', 'role', '角色列表', '1', null, '100', '19', '3'), ('22', 'node', '节点列表', '1', null, '100', '19', '3'), ('23', 'add_user', '添加/编辑用户', '1', null, '100', '19', '3'), ('24', 'del_user', '删除用户', '1', null, '100', '19', '3'), ('25', 'add_node', '添加/编辑节点', '1', null, '100', '19', '3'), ('26', 'del_node', '删除节点', '1', null, '100', '19', '3'), ('27', 'add_role', '添加/编辑角色', '1', null, '100', '19', '3'), ('28', 'del_role', '删除角色', '1', null, '100', '19', '3'), ('29', 'access', '权限配置', '1', null, '100', '19', '3'), ('50', 'as', 'asdf', '1', null, '100', '49', '3'), ('43', 'womwen', 'sdfasdf', '1', null, '100', '0', '1'), ('44', 'asf', 'sdf', '1', null, '100', '0', '1'), ('45', 'sf', 'asdf', '1', null, '100', '0', '1'), ('46', '123121', '123123123', '1', null, '100', '0', '1'), ('47', '', '', '1', null, '100', '0', '0'), ('48', 'asdf', 'asdf', '1', null, '100', '14', '3'), ('49', 'asdf', 'asdf', '1', null, '100', '8', '2'), ('51', '我们', '阿斯顿发斯蒂芬', '1', null, '100', '19', '3'), ('52', 'adm暗室逢灯', '阿斯蒂芬', '1', null, '100', '0', '1'), ('53', 'women', 'women', '1', null, '100', '14', '3'), ('54', 'new', 'asdf', '1', null, '100', '0', '1');
COMMIT;

-- ----------------------------
--  Table structure for `sc_notice`
-- ----------------------------
DROP TABLE IF EXISTS `sc_notice`;
CREATE TABLE `sc_notice` (
  `n_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '小区通知/政府公告/办事指南 ID',
  `n_type` set('1','2','3') NOT NULL COMMENT '1->小区通知,2->政府公告,3->办事指南(可多选)',
  `n_titile` varchar(20) NOT NULL COMMENT '标题',
  `n_author` varchar(20) NOT NULL COMMENT '作者',
  `n_source` varchar(20) NOT NULL COMMENT '来源',
  `n_abstracts` varchar(255) NOT NULL COMMENT '摘要',
  `n_valid_time` datetime NOT NULL COMMENT '有效期',
  `n_content` text NOT NULL COMMENT '内容',
  `n_keywords` varchar(20) NOT NULL COMMENT '关键词',
  `n_status` enum('1','0','-1') NOT NULL DEFAULT '0' COMMENT '1->发布,0->待审核,-1->回收站',
  `n_create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `n_create_id` char(11) NOT NULL COMMENT '创建人ID',
  `n_operate_time` datetime DEFAULT NULL COMMENT '审批时间',
  `n_operate_id` char(11) DEFAULT NULL COMMENT '审批人ID',
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
  UNIQUE KEY `name` (`name`) USING BTREE,
  KEY `pid` (`pid`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=114 DEFAULT CHARSET=utf8 COMMENT='RBAC数据库';

-- ----------------------------
--  Records of `sc_role`
-- ----------------------------
BEGIN;
INSERT INTO `sc_role` VALUES ('1', '超级管理员', null, '1', '系统超级管理员，拥有全部权限'), ('2', '业主', null, '1', '业主，拥有部分权限'), ('3', '物业管理', null, '1', '物业管理人员，拥有部分权限'), ('4', '保安', null, '1', '保安'), ('5', '维修人员', null, '1', '维修人员'), ('6', '保洁员', null, '1', '保洁员'), ('7', '未分配角色', null, '1', '未分配角色'), ('107', '123123', null, '1', '121231'), ('108', 'test', null, '1', 'test'), ('109', 'asdf', null, '1', 'sdf'), ('110', 'sdfasdf', null, '1', 'sdfasdfsdf'), ('111', 'addf', null, '1', 'asdfasdfasd'), ('112', 'asdfasdf', null, '1', 'asdfasdf'), ('113', '我们', null, '1', '氨基酸的联发科');
COMMIT;

-- ----------------------------
--  Table structure for `sc_role_user`
-- ----------------------------
DROP TABLE IF EXISTS `sc_role_user`;
CREATE TABLE `sc_role_user` (
  `role_id` int(9) unsigned DEFAULT NULL,
  `user_id` char(32) DEFAULT NULL,
  `user_type` char(1) DEFAULT NULL COMMENT 'M - 物业，U - 业主，A - 超级管理员',
  KEY `group_id` (`role_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='RBAC数据库';

-- ----------------------------
--  Records of `sc_role_user`
-- ----------------------------
BEGIN;
INSERT INTO `sc_role_user` VALUES ('1', '27', 'U'), ('5', '28', 'U'), ('1', '1', 'A'), ('1', null, 'A'), ('107', '41', 'U'), ('2', '37', 'U'), ('2', '38', 'U'), ('2', '39', 'U'), ('2', '40', 'U'), ('2', '36', 'U'), ('1', '3', 'A'), ('1', '4', 'A'), ('1', '5', 'A'), ('1', null, 'A'), ('1', '2', 'A');
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
  `mobile` char(11) NOT NULL COMMENT '手机号',
  `email` varchar(50) NOT NULL COMMENT '邮箱',
  `id_card_num` varchar(18) NOT NULL COMMENT '身份证号',
  `create_time` datetime NOT NULL COMMENT '用户创建时间',
  `last_log_ip` char(15) NOT NULL DEFAULT '' COMMENT '上次登录IP',
  `last_log_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '上次登录时间',
  `if_aprvd` enum('0','1','-1') NOT NULL DEFAULT '0' COMMENT '用户是否通过审批，0->待审批，1->审批通过， -1->审批不通过',
  PRIMARY KEY (`id`),
  UNIQUE KEY `nick_name` (`nick_name`) USING BTREE,
  UNIQUE KEY `mobile` (`mobile`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `id_card_num` (`id_card_num`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8 COMMENT='业主信息';

-- ----------------------------
--  Records of `sc_users`
-- ----------------------------
BEGIN;
INSERT INTO `sc_users` VALUES ('27', '123123', 'admin', 'admin', '4910d7fcdc3d1c078bf62a17526d6c6a', '2', '123', '123', '123', '123456789123456789', '2016-04-14 11:28:23', '::1', '2016-05-12 05:01:07', '1'), ('28', '222222', 'guest', '1231', '202cb962ac59075b964b07152d234b70', '2', '1234', '1234', '1234', '1234', '2016-04-18 02:08:57', '::1', '2016-04-25 09:50:14', '1'), ('36', '456', '456', '456', '250cf8b51c773f3f8dc8b4be867a9a02', '2', '456', '456', '456', '456', '2016-04-20 09:31:29', '', '2016-04-20 09:31:29', '1'), ('37', '789', '789', '789', '68053af2923e00204c3ca7c6a3150cf7', '2', '789', '789', '789', '789', '2016-04-20 09:32:50', '', '2016-04-20 09:32:50', '1'), ('38', '753', '753', '753', '6f2268bd1d3d3ebaabb04d6b5d099425', '2', '753', '753', '753', '753', '2016-04-20 09:34:08', '', '2016-04-20 09:34:08', '1'), ('39', '159', '159', '159', '140f6969d5213fd0ece03148e62e461e', '2', '159', '159', '159', '159', '2016-04-20 09:35:21', '', '2016-04-20 09:35:21', '1'), ('40', '789789', '789789', '789789', '21b95a0f90138767b0fd324e6be3457b', '1', '789789', '789789', '789789', '789789', '2016-04-20 09:36:49', '', '2016-04-20 09:36:49', '1'), ('41', '456456', '456456', '456456', 'b51e8dbebd4ba8a8f342190a4b9f08d7', '2', '456456', '456456', '456456', '456456', '2016-04-20 09:37:54', '', '2016-04-20 09:37:54', '0'), ('42', null, 'wo', 'wo', 'e0a0862398ccf49afa6c809d3832915c', '2', 'wo', '0', 'wo', 'wo', '2016-05-09 10:46:50', '', '2016-05-09 10:46:50', '0'), ('43', null, 'wo0', 'wo0', 'e0a0862398ccf49afa6c809d3832915c', '1', 'wo0', '1', 'wo0', 'wo0', '2016-05-09 10:51:12', '', '2016-05-09 10:51:12', '0'), ('44', null, 'aadf', 'sadf', '912ec803b2ce49e4a541068d495ab570', '2', 'asdfasdf', '5', 'asdf', 'asdf', '2016-05-09 10:53:19', '', '2016-05-09 10:53:19', '0'), ('45', null, 'asdf', 'asdf', '202cb962ac59075b964b07152d234b70', '2', '123', '1231231231', '123@123.com', '1111111', '2016-05-09 11:41:28', '', '2016-05-09 11:41:28', '0'), ('46', null, 'admin1', 'admin1', '202cb962ac59075b964b07152d234b70', '1', 'admin1', '12342535', 'admin1@qq.com', '1234567891234567', '2016-05-10 09:12:47', '', '2016-05-10 09:12:47', '0'), ('47', null, 'admin2', 'admin2', '4910d7fcdc3d1c078bf62a17526d6c6a', '1', 'admin2', '13631431767', 'admin2@qq.com', '1', '2016-05-10 09:21:37', '', '2016-05-10 09:21:37', '0'), ('48', null, 'admin5', 'admin5', 'e15f350072ed4d82b76312ad871af05c', '1', '4564564564564', '13631431766', '45646545@qq.com', '456456456456456456', '2016-05-10 10:05:21', '', '2016-05-10 10:05:21', '0'), ('49', null, 'admin6', 'admin6', 'bab593ebf29b0499f2739d690dca334a', '1', '4564564564564', '13631431763', '456465451@qq.com', '789456123456123', '2016-05-10 10:14:01', '', '2016-05-10 10:14:01', '0'), ('50', null, 'admin7', 'admin7', '5af5b21664d5a87ac6b5e7d4b78fb527', '1', '4564564564564', '13631431762', '4456465451@qq.com', '111112333333333338', '2016-05-10 10:15:08', '', '2016-05-10 10:15:08', '0'), ('51', null, '456456a', '4564564a', 'ff0a87924ec50fbc62450b19afbc5fa7', '2', '123', '13631431536', '123@1231.com', '123222222222222222', '2016-05-10 10:41:17', '', '2016-05-10 10:41:17', '0');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
