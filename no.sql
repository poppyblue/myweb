/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50553
Source Host           : 127.0.0.1:3306
Source Database       : web

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2019-04-17 09:20:47
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for config
-- ----------------------------
DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT '表id',
  `name` varchar(50) DEFAULT NULL COMMENT '配置的key键名',
  `value` varchar(100) DEFAULT NULL COMMENT '配置的val值',
  `type` varchar(64) DEFAULT NULL COMMENT '配置分组',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=89 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of config
-- ----------------------------
INSERT INTO `config` VALUES ('60', 'smtp_server', 'smtp.qq.com', 'smtp');
INSERT INTO `config` VALUES ('61', 'smtp_port', '465', 'smtp');
INSERT INTO `config` VALUES ('62', 'smtp_user', '331549185@qq.com', 'smtp');
INSERT INTO `config` VALUES ('63', 'smtp_pwd', 'alyhokcwugxdbhff', 'smtp');
INSERT INTO `config` VALUES ('64', 'regis_smtp_enable', '1', 'smtp');
INSERT INTO `config` VALUES ('88', 'email_id', '曾辉', 'smtp');

-- ----------------------------
-- Table structure for mess
-- ----------------------------
DROP TABLE IF EXISTS `mess`;
CREATE TABLE `mess` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mess` varchar(255) DEFAULT NULL,
  `send_id` int(11) DEFAULT NULL,
  `to_id` int(11) DEFAULT NULL,
  `send_time` int(11) DEFAULT NULL,
  `read` tinyint(255) DEFAULT '0' COMMENT '0 未读  1已读',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mess
-- ----------------------------
INSERT INTO `mess` VALUES ('1', '你好，想咨询一下', '40', '78', '1549680009', '0');
INSERT INTO `mess` VALUES ('2', '你什么时候有空', '40', '78', '1549680119', '0');
INSERT INTO `mess` VALUES ('3', '老师，请问报报什么时候交？', '78', '40', '1549680119', '0');

-- ----------------------------
-- Table structure for news
-- ----------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `create_time` int(11) DEFAULT NULL,
  `top` tinyint(2) DEFAULT '1' COMMENT '1 正常 2至顶',
  `visible` tinyint(2) DEFAULT '1' COMMENT '1可见 0隐藏',
  `views` int(11) DEFAULT '0' COMMENT '阅读次数',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of news
-- ----------------------------
INSERT INTO `news` VALUES ('56', '1', '1', '关于社会实践的相关通知', '<p></p><p></p><p>6<span style=\"font-weight: bold;\">6666</span></p><p></p><p>kk&nbsp;</p><table border=\"0\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\"><tbody><tr><th>&nbsp;33</th><th>&nbsp;ee</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th></tr><tr><td>&nbsp;33</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>&nbsp;33</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>&nbsp;3</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>&nbsp;33</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></tbody></table><p><br></p>', '1554017541', '2', '0', '0');
INSERT INTO `news` VALUES ('58', '2', '1', 'test23', '<p></p><p>1111111</p><p></p><p>333</p>', '1548849247', '2', '0', '0');
INSERT INTO `news` VALUES ('59', '1', '1', 'test3', '<p>1111111</p>', '1548849278', '1', '1', '0');
INSERT INTO `news` VALUES ('60', '1', '1', '关于社会实践的相关通知', '<p></p><p>1111111</p><p></p><p>iii</p>', '1548849313', '1', '1', '0');
INSERT INTO `news` VALUES ('65', '2', '1', '77', '<p>88</p>', '1553584053', '2', '2', '0');
INSERT INTO `news` VALUES ('66', '2', '1', '66', '<p><br></p>', '1554016201', '1', '1', '0');
INSERT INTO `news` VALUES ('67', '2', '1', '1', '<p>55</p>', '1554016461', '1', '1', '0');
INSERT INTO `news` VALUES ('68', '2', '1', 'h', '<p>h</p>', '1554016481', '1', '1', '0');
INSERT INTO `news` VALUES ('69', '2', '1', '秀梅', '<p></p><p></p><p><img src=\"/uploads/20190331/f6f75689732a034251bf1b5b0190552b.JPG\" style=\"max-width:100%;\"><br></p><p><img src=\"http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/50/pcmoren_huaixiao_org.png\" alt=\"[坏笑]\" data-w-e=\"1\"><br></p><p></p><p><br></p>', '1554019173', '1', '1', '0');
INSERT INTO `news` VALUES ('70', '3', '3', '寺', '<p>寺<br/></p>', '1554021992', '1', '1', '0');
INSERT INTO `news` VALUES ('71', '1', '1', '7777777', '<p style=\"line-height: 16px;\"><img src=\"http://webtest1.com/js/ueditor/dialogs/attachment/fileTypeImages/icon_txt.gif\"/><a style=\"font-size:12px; color:#0066cc;\" href=\"/uploads/file/20190331/1554038118.xlsx\" title=\"2016分组情况.xlsx\">2016分组情况.xlsx</a></p><p><img src=\"/uploads/image/20190331/1554038124.jpg\" title=\"1554038124.jpg\" alt=\"IMG_2454.JPG\"/></p>', '1554037893', '2', '1', '0');
INSERT INTO `news` VALUES ('72', '1', '1', '33', '<p>33</p>', '1555463884', '1', '1', '0');

-- ----------------------------
-- Table structure for news_type
-- ----------------------------
DROP TABLE IF EXISTS `news_type`;
CREATE TABLE `news_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of news_type
-- ----------------------------
INSERT INTO `news_type` VALUES ('1', '社会新闻');
INSERT INTO `news_type` VALUES ('2', '3381');
INSERT INTO `news_type` VALUES ('3', '444');
INSERT INTO `news_type` VALUES ('7', '言');
INSERT INTO `news_type` VALUES ('10', '33');
INSERT INTO `news_type` VALUES ('18', 'TEST');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL COMMENT '用户名',
  `nickname` varchar(255) DEFAULT NULL,
  `pwd` varchar(70) DEFAULT NULL COMMENT '密码',
  `role_id` mediumint(8) DEFAULT NULL COMMENT '分组ID',
  `email` varchar(30) DEFAULT NULL COMMENT '邮箱',
  `realname` varchar(10) DEFAULT NULL COMMENT '真实姓名',
  `gender` varchar(10) DEFAULT '',
  `tel` varchar(30) DEFAULT NULL COMMENT '电话号码',
  `login_time` int(11) DEFAULT NULL COMMENT '最后登录时间',
  `status` tinyint(2) DEFAULT '1' COMMENT '状态',
  `avatar` varchar(120) DEFAULT '' COMMENT '头像',
  PRIMARY KEY (`id`),
  KEY `user_username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', '1', '110', 'c4ca4238a0b923820dcc509a6f75849b', '1', '', '1', '女', '2', '1482132862', '1', '/uploads/20190331/5bb0edfe1916f8c47cf229fd04fe4474.JPG');
INSERT INTO `user` VALUES ('2', '2', null, 'c4ca4238a0b923820dcc509a6f75849b', '1', '', '平易容1', '女', '', '1549680319', '1', '');
INSERT INTO `user` VALUES ('3', '2018021001000108', null, 'eccbc87e4b5ce2fe28308fd9f2a7baf3', '3', 'macrohui29@sina.com', '邓承杰', '男', null, null, '0', '');
INSERT INTO `user` VALUES ('4', '2018021001000115', null, 'c4ca4238a0b923820dcc509a6f75849b', '3', null, '李小文', '男', null, null, '1', '');
INSERT INTO `user` VALUES ('5', '2018021001000117', null, 'c4ca4238a0b923820dcc509a6f75849b', '3', null, '舒毅', '男', null, null, '1', '');
INSERT INTO `user` VALUES ('6', 'v', null, null, '1', '', '', '', '', null, '1', '');
INSERT INTO `user` VALUES ('7', '3', null, 'c4ca4238a0b923820dcc509a6f75849b', '2', '', '1', '', '', null, '1', '');
INSERT INTO `user` VALUES ('8', 'MM', null, null, '1', '', '', '', '', null, '1', '');
INSERT INTO `user` VALUES ('9', 'kk', null, null, '1', '', '', '', '', null, '1', '');
INSERT INTO `user` VALUES ('10', '2019021001000102', null, 'b5490bf0f7f4c98b2e095b11bf209ab7', '3', null, '李四2', '女', null, null, '1', '');
INSERT INTO `user` VALUES ('11', '2019021001000103', null, '67cff2be70159a33d7523802e1189889', '3', null, '李四3', '女', null, null, '1', '');
INSERT INTO `user` VALUES ('12', '2019021001000104', null, '96d8b8529ed3e8b96da3a51c458c6297', '3', null, '李四4', '女', null, null, '1', '');
INSERT INTO `user` VALUES ('13', '66', null, null, '4', '88', '88', '', '88', null, '1', '');
INSERT INTO `user` VALUES ('14', '001', null, null, '2', '', '', '', '', null, '1', '');
INSERT INTO `user` VALUES ('15', '2019021001000106', null, '1a18d68f902fd55291f640ad52b71abd', '3', null, '李四6', '男', null, null, '1', '');
INSERT INTO `user` VALUES ('16', '2019021001000107', null, '6298f666e508f4d05f13ceef95bb8e71', '3', null, '李四7', '男', null, null, '1', '');
INSERT INTO `user` VALUES ('17', '2019021001000108', null, '872576fefa4da47f2146b90496753416', '3', null, '李四8', '男', null, null, '1', '');
INSERT INTO `user` VALUES ('18', '', null, null, '1', '', '', '', '', null, '1', '');
INSERT INTO `user` VALUES ('19', '已', null, null, '1', '', '', '', '', null, '1', '');
INSERT INTO `user` VALUES ('20', 'bb', null, null, '1', '', '', '', '', null, '1', '');
INSERT INTO `user` VALUES ('21', 'bnnvbvb', null, null, '1', '', '', '', '', null, '1', '');
INSERT INTO `user` VALUES ('22', '31', null, null, '1', '', '', '', '', null, '1', '');
INSERT INTO `user` VALUES ('23', '4', null, null, '3', '', '', '', '', null, '1', '');
INSERT INTO `user` VALUES ('24', 'r', null, null, '1', '', '', '', '', null, '1', '');
INSERT INTO `user` VALUES ('25', 'n', null, null, '1', '', '', '', '', null, '1', '');
INSERT INTO `user` VALUES ('26', '3', null, null, '1', '', '', '', '', null, '1', '');
INSERT INTO `user` VALUES ('27', 'f', null, null, '1', '', '', '', '', null, '1', '');
INSERT INTO `user` VALUES ('28', 'n', null, null, '1', '', '', '', '', null, '1', '');
INSERT INTO `user` VALUES ('29', 'nn', null, null, '1', '', '', '', '', null, '1', '');
INSERT INTO `user` VALUES ('30', '止', null, null, '1', '', '', '', '', null, '1', '');
INSERT INTO `user` VALUES ('31', '大', null, null, '1', '', '', '', '', null, '1', '');
INSERT INTO `user` VALUES ('32', '33', null, null, '1', '', '', '', '', null, '1', '');
INSERT INTO `user` VALUES ('33', '子', null, null, '1', '', '', '', '', null, '1', '');
INSERT INTO `user` VALUES ('34', '子了', null, null, '1', '', '', '', '', null, '1', '');
INSERT INTO `user` VALUES ('35', '忆', null, null, '1', '', '', '', '', null, '1', '');
INSERT INTO `user` VALUES ('36', '7', null, 'c4ca4238a0b923820dcc509a6f75849b', '1', '', '', '', '', null, '1', '');
INSERT INTO `user` VALUES ('39', '77', '77', '28dd2c7955ce926456240b2ff0100bde', null, 'macro22h@tom.com', null, '', null, null, '1', '');

-- ----------------------------
-- Table structure for user_role
-- ----------------------------
DROP TABLE IF EXISTS `user_role`;
CREATE TABLE `user_role` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(20) NOT NULL DEFAULT '',
  `rules` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_role
-- ----------------------------
INSERT INTO `user_role` VALUES ('1', '超级管理员', '1,2,6,9,10,11,12,13,14,15,16,17,');
INSERT INTO `user_role` VALUES ('2', '老师', '11,12,13,14,15,17,');
INSERT INTO `user_role` VALUES ('3', '学生', null);
INSERT INTO `user_role` VALUES ('4', '游客1', null);

-- ----------------------------
-- Table structure for user_rule
-- ----------------------------
DROP TABLE IF EXISTS `user_rule`;
CREATE TABLE `user_rule` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `href` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `icon` varchar(20) DEFAULT NULL COMMENT '样式',
  `pid` int(5) NOT NULL DEFAULT '0' COMMENT '父栏目ID',
  `sort` int(11) DEFAULT '0' COMMENT '排序',
  `addtime` int(11) DEFAULT '0' COMMENT '添加时间',
  `menu` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_rule
-- ----------------------------
INSERT INTO `user_rule` VALUES ('1', 'System', '系统管理', '1', 'fa-gavel', '0', '0', '1446535750', '1');
INSERT INTO `user_rule` VALUES ('2', 'auth/index', '菜单管理', '1', 'fa-cogs', '1', '1', '1446535789', '1');
INSERT INTO `user_rule` VALUES ('9', 'user/index', '用户管理', '1', 'fa-user', '1', '3', '0', '1');
INSERT INTO `user_rule` VALUES ('6', 'user/role', '角色管理', '1', 'fa-users', '1', '2', '0', '1');
INSERT INTO `user_rule` VALUES ('10', 'user/userdel', '删除用户', '1', '1', '9', '1', '0', '0');
INSERT INTO `user_rule` VALUES ('11', 'user', '个人管理', '1', 'fa-user-circle', '0', '2', '0', '1');
INSERT INTO `user_rule` VALUES ('12', 'user/info', '个人信息维护', '1', 'fa-address-card', '11', '1', '0', '1');
INSERT INTO `user_rule` VALUES ('13', 'user/infosave', '保存', '1', 'icon', '12', '1', '0', '0');
INSERT INTO `user_rule` VALUES ('14', 'user/pwdreset', '修改密码', '1', 'fa-key', '11', '2', '0', '1');
INSERT INTO `user_rule` VALUES ('15', 'news', '新闻管理', '1', 'fa-newspaper-o', '0', '3', '0', '1');
INSERT INTO `user_rule` VALUES ('16', 'news/type', '类别管理', '1', 'fa-bars', '15', '1', '0', '1');
INSERT INTO `user_rule` VALUES ('17', 'news/index', '新闻管理', '1', 'fa-file-text-o', '15', '2', '0', '1');
