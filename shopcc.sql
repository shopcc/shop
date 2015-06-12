/*
SQLyog Ultimate v11.24 (32 bit)
MySQL - 5.5.24-log : Database - shopcc
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
USE `shopcc`;

/*Table structure for table `cz_address` */

CREATE TABLE `cz_address` (
  `address_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '地址编号',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '地址所属用户ID',
  `consignee` varchar(60) NOT NULL DEFAULT '' COMMENT '收货人姓名',
  `address_info` varchar(255) NOT NULL DEFAULT '0' COMMENT '省份，保存是ID',
  `street` varchar(100) NOT NULL DEFAULT '' COMMENT '街道地址',
  `zipcode` varchar(10) NOT NULL DEFAULT '' COMMENT '邮政编码',
  `telephone` varchar(20) NOT NULL DEFAULT '' COMMENT '电话',
  `mobile` varchar(20) NOT NULL DEFAULT '' COMMENT '移动电话',
  `sign_building` varchar(255) DEFAULT NULL,
  `best_time` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `is_default` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`address_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `cz_address` */

insert  into `cz_address`(`address_id`,`user_id`,`consignee`,`address_info`,`street`,`zipcode`,`telephone`,`mobile`,`sign_building`,`best_time`,`email`,`is_default`) values (2,1,'张三','天津市&nbsp;天津市&nbsp;河西区','某某路2号','11234','111111','1111111','123','123','1212@qq.com',0),(3,1,'张三','天津市&nbsp;天津市&nbsp;南开区','11111111111111','112322','13421234561','13437182716','1','111','1212@qq.com',0),(4,1,'hao123','黑龙江省&nbsp;七台河市&nbsp;桃山区','呜呜呜','112322','13421234561','13437182716','123','111','1212@qq.com',1),(9,1,'张三','天津市&nbsp;天津市&nbsp;南开区','11111111111111','112322','13421234561','13437182716','1','111','1212@qq.com',0);

/*Table structure for table `cz_admin` */

CREATE TABLE `cz_admin` (
  `admin_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '管理员编号',
  `username` varchar(60) NOT NULL DEFAULT '' COMMENT '管理员名称',
  `password` char(120) NOT NULL DEFAULT '' COMMENT '管理员密码',
  `email` varchar(50) NOT NULL DEFAULT '' COMMENT '管理员邮箱',
  `add_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `last_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后时间',
  `role_id` int(8) NOT NULL DEFAULT '0' COMMENT '管理组',
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `cz_admin` */

insert  into `cz_admin`(`admin_id`,`username`,`password`,`email`,`add_time`,`last_time`,`role_id`) values (1,'admin','96e79218965eb72c92a549dd5a330112','admin@itcast.cn',0,0,20),(2,'hao123','96e79218965eb72c92a549dd5a330112','add@qq.com',0,0,20);

/*Table structure for table `cz_attribute` */

CREATE TABLE `cz_attribute` (
  `attr_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `type_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `attr_name` varchar(60) NOT NULL DEFAULT '',
  `attr_input_type` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `attr_type` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `attr_values` text,
  `attr_index` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `sort_order` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `is_linked` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `attr_group` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`attr_id`),
  KEY `cat_id` (`type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=219 DEFAULT CHARSET=utf8;

/*Data for the table `cz_attribute` */

insert  into `cz_attribute`(`attr_id`,`type_id`,`attr_name`,`attr_input_type`,`attr_type`,`attr_values`,`attr_index`,`sort_order`,`is_linked`,`attr_group`) values (1,1,'作者',1,0,'啊啊\r\n啊啊',0,0,0,0),(2,1,'出版社',0,0,'',0,0,0,0),(3,1,'图书书号/ISBN',0,0,'',0,0,0,0),(4,1,'出版日期',0,0,'',0,0,0,0),(5,1,'开本',0,0,'',0,0,0,0),(6,1,'图书页数',0,0,'',0,0,0,0),(7,1,'图书装订',1,0,'平装\r\n黑白',0,0,0,0),(8,1,'图书规格',0,0,'',0,0,0,0),(9,1,'版次',0,0,'',0,0,0,0),(10,1,'印张',0,0,'',0,0,0,0),(11,1,'字数',0,0,'',0,0,0,0),(12,1,'所属分类',0,0,'',0,0,0,0),(13,2,'中文片名',0,0,'',0,0,0,0),(14,2,'英文片名',0,0,'',0,0,0,0),(15,2,'商品别名',0,0,'',0,0,0,0),(16,2,'介质/格式',1,0,'HDCD\r\nDTS\r\nDVD\r\nDVD9\r\nVCD\r\nCD\r\nTAPE\r\nLP',0,0,0,0),(17,2,'片装数',0,0,'',0,0,0,0),(18,2,'国家地区',0,0,'',0,0,0,0),(19,2,'语种',1,0,'中文\r\n英文\r\n法文\r\n西班牙文',0,0,0,0),(20,2,'导演/指挥',0,0,'',0,0,0,0),(21,2,'主唱',0,0,'',0,0,0,0),(22,2,'所属类别',1,0,'古典\r\n流行\r\n摇滚\r\n乡村\r\n民谣\r\n爵士\r\n蓝调\r\n电子\r\n舞曲\r\n国乐\r\n民族\r\n怀旧\r\n经典\r\n人声\r\n合唱\r\n发烧\r\n试音\r\n儿童\r\n胎教\r\n轻音乐\r\n世界音乐\r\n庆典音乐\r\n影视音乐\r\n新世纪音乐\r\n大自然音乐',0,0,0,0),(23,2,'长度',0,0,'',0,0,0,0),(24,2,'歌词',1,0,'有\r\n无',0,0,0,0),(25,2,'碟片代码',0,0,'',0,0,0,0),(26,2,'ISRC码',0,0,'',0,0,0,0),(27,2,'发行公司',0,0,'',0,0,0,0),(28,2,'出版',0,0,'',0,0,0,0),(29,2,'出版号',0,0,'',0,0,0,0),(30,2,'引进号',0,0,'',0,0,0,0),(31,2,'版权号',0,0,'',0,0,0,0),(32,3,'中文片名',0,0,'',0,0,0,0),(33,3,'英文片名',0,0,'',0,0,0,0),(34,3,'商品别名',0,0,'',0,0,0,0),(35,3,'介质/格式',1,0,'HDCD\r\nDTS\r\nDVD\r\nDVD9\r\nVCD',0,0,0,0),(36,3,'碟片类型',1,0,'单面\r\n双层',0,0,0,0),(37,3,'片装数',0,0,'',0,0,0,0),(38,3,'国家地区',0,0,'',0,0,0,0),(39,3,'语种/配音',1,0,'中文\r\n英文\r\n法文\r\n西班牙文',0,0,0,0),(40,3,'字幕',0,0,'',0,0,0,0),(41,3,'色彩',0,0,'',0,0,0,0),(42,3,'中文字幕',1,0,'有\r\n无',0,0,0,0),(43,3,'导演',0,0,'',0,0,0,0),(44,3,'表演者',0,0,'',0,0,0,0),(45,3,'所属类别',1,0,'爱情\r\n偶像\r\n生活\r\n社会\r\n科幻\r\n神话\r\n武侠\r\n动作\r\n惊险\r\n恐怖\r\n传奇\r\n人物\r\n侦探\r\n警匪\r\n历史\r\n军事\r\n戏剧\r\n舞台\r\n经典\r\n名著\r\n喜剧\r\n情景\r\n动漫\r\n卡通\r\n儿童\r\n伦理激情',0,0,0,0),(46,3,'年份',0,0,'',0,0,0,0),(47,3,'音频格式',0,0,'',0,0,0,0),(48,3,'区码',0,0,'',0,0,0,0),(49,3,'碟片代码',0,0,'',0,0,0,0),(50,3,'ISRC码',0,0,'',0,0,0,0),(51,3,'发行公司',0,0,'',0,0,0,0),(52,3,'出版 ',0,0,'',0,0,0,0),(53,3,'出版号',0,0,'',0,0,0,0),(54,3,'引进号',0,0,'',0,0,0,0),(55,3,'版权号',0,0,'',0,0,0,0),(56,4,'网络制式',0,0,'',0,0,0,0),(57,4,'支持频率/网络频率',0,0,'',0,0,0,0),(58,4,'尺寸体积',1,0,'   ',0,0,0,0),(59,4,'外观样式/手机类型',1,0,'翻盖\r\n滑盖\r\n直板\r\n折叠\r\n手写',0,0,0,0),(60,4,'主屏参数/内屏参数',0,0,'',0,0,0,0),(61,4,'副屏参数/外屏参数',0,0,'',0,0,0,0),(62,4,'清晰度',0,0,'',0,0,0,0),(63,4,'色数/灰度',1,0,'   ',0,0,0,0),(64,4,'长度',0,0,'',0,0,0,0),(65,4,'宽度',0,0,'',0,0,0,0),(66,4,'厚度',0,0,'',0,0,0,0),(67,4,'屏幕材质',0,0,'',0,0,0,0),(68,4,'内存容量',0,0,'',0,0,0,0),(69,4,'操作系统',0,0,'',0,0,0,0),(70,4,'通话时间',0,0,'',0,0,0,0),(71,4,'待机时间',0,0,'',0,0,0,0),(72,4,'标准配置',0,0,'',0,0,0,0),(73,4,'WAP上网',0,0,'',0,0,0,0),(74,4,'数据业务',0,0,'',0,0,0,0),(75,4,'天线位置',1,0,'内置\r\n外置',0,0,0,0),(76,4,'随机配件',0,0,'',0,0,0,0),(77,4,'铃声',0,0,'',0,0,0,0),(78,4,'摄像头',0,0,'',0,0,0,0),(79,4,'彩信/彩e',1,0,'支持\r\n不支持',0,0,0,0),(80,4,'红外/蓝牙',0,0,'',0,0,0,0),(81,4,'价格等级',1,0,'高价机\r\n中价机\r\n低价机',0,0,0,0),(82,5,'型号',0,0,'',0,0,0,0),(83,5,'详细规格',0,0,'',0,0,0,0),(84,5,'笔记本尺寸',0,0,'',0,0,0,0),(85,5,'处理器类型',0,0,'',0,0,0,0),(86,5,'处理器最高主频',0,0,'',0,0,0,0),(87,5,'二级缓存',0,0,'',0,0,0,0),(88,5,'系统总线',0,0,'',0,0,0,0),(89,5,'主板芯片组',0,0,'',0,0,0,0),(90,5,'内存容量',0,0,'',0,0,0,0),(91,5,'内存类型',0,0,'',0,0,0,0),(92,5,'硬盘',0,0,'',0,0,0,0),(93,5,'屏幕尺寸',0,0,'',0,0,0,0),(94,5,'显示芯片',0,0,'',0,0,0,0),(95,5,'标称频率',0,0,'',0,0,0,0),(96,5,'显卡显存',0,0,'',0,0,0,0),(97,5,'显卡类型',0,0,'',0,0,0,0),(98,5,'光驱类型',0,0,'',0,0,0,0),(99,5,'电池容量',0,0,'',0,0,0,0),(100,5,'其他配置',0,0,'',0,0,0,0),(101,6,'类型',0,0,'',0,0,0,0),(102,6,'最大像素/总像素  ',0,0,'',0,0,0,0),(103,6,'有效像素',1,0,'  ',0,0,0,0),(104,6,'光学变焦倍数',0,0,'',0,0,0,0),(105,6,'数字变焦倍数',0,0,'',0,0,0,0),(106,6,'操作模式',0,0,'',0,0,0,0),(107,6,'显示屏类型',0,0,'',0,0,0,0),(108,6,'显示屏尺寸',0,0,'',0,0,0,0),(109,6,'感光器件',0,0,'',0,0,0,0),(110,6,'感光器件尺寸',0,0,'',0,0,0,0),(111,6,'最高分辨率',0,0,'',0,0,0,0),(112,6,'图像分辨率',0,0,'',0,0,0,0),(113,6,'传感器类型',0,0,'',0,0,0,0),(114,6,'传感器尺寸',0,0,'',0,0,0,0),(115,6,'镜头',0,0,'',0,0,0,0),(116,6,'光圈',0,0,'',0,0,0,0),(117,6,'焦距',0,0,'',0,0,0,0),(118,6,'旋转液晶屏',1,0,'支持\r\n不支持',0,0,0,0),(119,6,'存储介质',0,0,'',0,0,0,0),(120,6,'存储卡',1,0,'  记录媒体\r\n存储卡容量',0,0,0,0),(121,6,'影像格式',1,0,'    静像\r\n动画',0,0,0,0),(122,6,'曝光控制',0,0,'',0,0,0,0),(123,6,'曝光模式',0,0,'',0,0,0,0),(124,6,'曝光补偿',0,0,'',0,0,0,0),(125,6,'白平衡',0,0,'',0,0,0,0),(126,6,'连拍',0,0,'',0,0,0,0),(127,6,'快门速度',0,0,'',0,0,0,0),(128,6,'闪光灯',1,0,'内置\r\n外置',0,0,0,0),(129,6,'拍摄范围',1,0,'  ',0,0,0,0),(130,6,'自拍定时器',0,0,'',0,0,0,0),(131,6,'ISO感光度',0,0,'',0,0,0,0),(132,6,'测光模式',0,0,'',0,0,0,0),(133,6,'场景模式',0,0,'',0,0,0,0),(134,6,'短片拍摄',0,0,'',0,0,0,0),(135,6,'外接接口',0,0,'',0,0,0,0),(136,6,'电源',0,0,'',0,0,0,0),(137,6,'电池使用时间',0,0,'',0,0,0,0),(138,6,'外形尺寸',0,0,'',0,0,0,0),(139,6,'标配软件',0,0,'',0,0,0,0),(140,6,'标准配件',0,0,'',0,0,0,0),(141,6,'兼容操作系统',0,0,'',0,0,0,0),(142,7,'编号',0,0,'',0,0,0,0),(143,7,'类型',0,0,'',0,0,0,0),(144,7,'外型尺寸',0,0,'',0,0,0,0),(145,7,'最大像素数',0,0,'',0,0,0,0),(146,7,'光学变焦倍数',0,0,'',0,0,0,0),(147,7,'数字变焦倍数',0,0,'',0,0,0,0),(148,7,'显示屏尺寸及类型',0,0,'',0,0,0,0),(149,7,'感光器件',0,0,'',0,0,0,0),(150,7,'感光器件尺寸',0,0,'',0,0,0,0),(151,7,'感光器件数量',0,0,'',0,0,0,0),(152,7,'像素范围',0,0,'',0,0,0,0),(153,7,'传感器数量',0,0,'',0,0,0,0),(154,7,'传感器尺寸',0,0,'',0,0,0,0),(155,7,'水平清晰度',0,0,'',0,0,0,0),(156,7,'取景器',0,0,'',0,0,0,0),(157,7,'数码效果',0,0,'',0,0,0,0),(158,7,'镜头性能',0,0,'',0,0,0,0),(159,7,'对焦方式',0,0,'',0,0,0,0),(160,7,'曝光控制',0,0,'',0,0,0,0),(161,7,'其他接口',0,0,'',0,0,0,0),(162,7,'随机存储',0,0,'',0,0,0,0),(163,7,'电池类型',0,0,'',0,0,0,0),(164,7,'电池供电时间',0,0,'',0,0,0,0),(165,8,'产地',0,0,'',0,0,0,0),(166,8,'产品规格/容量',0,0,'',0,0,0,0),(167,8,'主要原料',0,0,'',0,0,0,0),(168,8,'所属类别',1,0,'彩妆\r\n化妆工具\r\n护肤品\r\n香水',0,0,0,0),(169,8,'使用部位',0,0,'',0,0,0,0),(170,8,'适合肤质',1,0,'油性\r\n中性\r\n干性',0,0,0,0),(171,8,'适用人群',1,0,'女性\r\n男性',0,0,0,0),(172,9,'上市日期',1,0,'2008年01月\r\n2008年02月\r\n2008年03月\r\n2008年04月\r\n2008年05月\r\n2008年06月\r\n2008年07月\r\n2008年08月\r\n2008年09月\r\n2008年10月\r\n2008年11月\r\n2008年12月\r\n2007年01月\r\n2007年02月\r\n2007年03月\r\n2007年04月\r\n2007年05月\r\n2007年06月\r\n2007年07月\r\n2007年08月\r\n2007年09月\r\n2007年10月\r\n2007年11月\r\n2007年12月',1,0,0,0),(173,9,'手机制式',1,0,'GSM,850,900,1800,1900\r\nGSM,900,1800,1900,2100\r\nCDMA\r\n双模（GSM,900,1800,CDMA 1X）\r\n3G(GSM,900,1800,1900,TD-SCDMA )',1,1,1,0),(174,9,'理论通话时间',0,0,'',0,2,0,0),(175,9,'理论待机时间',0,0,'',0,3,0,0),(176,9,'铃声',0,0,'',0,4,0,0),(177,9,'铃声格式',0,0,'',0,5,0,0),(178,9,'外观样式',1,0,'翻盖\r\n滑盖\r\n直板\r\n折叠',1,6,1,0),(179,9,'中文短消息',0,0,'',0,7,0,0),(180,9,'存储卡格式',0,0,'',0,0,0,0),(181,9,'内存容量',0,0,'',2,0,0,0),(182,9,'操作系统',0,0,'',0,0,0,0),(183,9,'K-JAVA',0,0,'',0,0,0,0),(184,9,'尺寸体积',1,0,'3.5英寸\r\n4英寸\r\n5.5英寸',0,0,0,0),(185,9,'颜色',1,1,'黑色\r\n白色\r\n蓝色\r\n金色\r\n粉色\r\n银色\r\n灰色\r\n深李色\r\n黑红色\r\n黑蓝色\r\n白紫色',1,0,0,0),(186,9,'屏幕颜色',1,0,'1600万\r\n262144万',1,0,1,1),(187,9,'屏幕材质',1,0,'TFT',0,0,0,1),(188,9,'屏幕分辨率',1,0,'320×240 像素\r\n240×400 像素\r\n240×320 像素\r\n176x220 像素',1,0,0,1),(189,9,'屏幕大小',0,0,'',0,0,0,1),(190,9,'中文输入法',0,0,'',0,0,0,2),(191,9,'情景模式',0,0,'',0,0,0,2),(192,9,'网络链接',0,0,'',0,0,0,2),(193,9,'蓝牙接口',0,0,'',0,0,0,0),(194,9,'数据线接口',0,0,'',0,0,0,2),(195,9,'电子邮件',0,0,'',0,0,0,2),(196,9,'闹钟',0,0,'',0,35,0,4),(197,9,'办公功能',0,0,'',0,0,0,4),(198,9,'数码相机',0,0,'',1,0,0,3),(199,9,'像素',0,0,'',0,0,0,3),(200,9,'传感器',0,0,'',0,0,0,0),(201,9,'变焦模式',0,0,'',0,0,0,3),(202,9,'视频拍摄',0,0,'',0,0,0,3),(203,9,'MP3播放器',0,0,'',0,0,0,3),(204,9,'视频播放',0,0,'',0,0,0,3),(205,9,'CPU频率',0,0,'',0,0,0,0),(206,9,'收音机',0,0,'',0,0,0,3),(207,9,'耳机接口',0,0,'',0,0,0,3),(208,9,'闪光灯',0,0,'',0,0,0,3),(209,9,'浏览器',0,0,'',0,0,0,2),(210,9,'配件',1,2,'线控耳机\r\n蓝牙耳机\r\n数据线',0,0,0,0);

/*Table structure for table `cz_auth` */

CREATE TABLE `cz_auth` (
  `auth_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `auth_name` varchar(20) NOT NULL COMMENT '权限名称',
  `auth_pid` smallint(6) unsigned NOT NULL COMMENT '父id',
  `auth_c` varchar(32) NOT NULL DEFAULT '' COMMENT '控制器',
  `auth_a` varchar(32) NOT NULL DEFAULT '' COMMENT '操作方法',
  `auth_level` tinyint(4) NOT NULL DEFAULT '0' COMMENT '权限级别',
  PRIMARY KEY (`auth_id`)
) ENGINE=InnoDB AUTO_INCREMENT=152 DEFAULT CHARSET=utf8;

/*Data for the table `cz_auth` */

insert  into `cz_auth`(`auth_id`,`auth_name`,`auth_pid`,`auth_c`,`auth_a`,`auth_level`) values (101,'商品管理',0,'','',0),(102,'订单管理',0,'','',0),(103,'权限管理',0,'','',0),(104,'商品列表',101,'Goods','showlist',1),(106,'添加新商品',101,'Goods','add',1),(107,'订单列表',102,'Order','showlist',1),(108,'订单查询',102,'Order','look',1),(109,'订单打印',102,'Order','print',1),(110,'管理员列表',103,'Manager','showlist',1),(111,'角色列表',103,'Role','showlist',1),(112,'权限列表',103,'Auth','showlist',1),(113,'商品品牌',101,'Brand','showlist',1),(114,'商品分类',101,'Category','alllist',1),(115,'商品类型',101,'Type','showlist',1),(116,'添加分类',114,'Category','add',2),(119,'商品编辑',104,'Goods','edit',2),(120,'商品保存',104,'Goods','save',2),(121,'商品删除',104,'Goods','del',2),(122,'商品查询',104,'Goods','up',2),(123,'删除主图',104,'Goods','dropimg',2),(124,'删除相册',104,'Goods','drop_image',2),(125,'删除属性',104,'Goods','delattr',2),(126,'属性列表',104,'Goods','getattrlist',2),(127,'商品属性',115,'Attribute','showlist',2),(128,'添加属性',115,'Attribute','add',2),(129,'编辑属性',115,'Attribute','edit',2),(130,'属性删除',115,'Attribute','del',2),(131,'批量删除属性',115,'Attribute','batch',2),(132,'添加权限',112,'Auth','add',2),(133,'编辑权限',112,'Auth','edit',2),(134,'删除权限',112,'Auth','del',2),(135,'添加品牌',113,'Brand','add',2),(136,'编辑品牌',113,'Brand','edit',2),(137,'删除品牌',113,'Brand','del',2),(138,'删除品牌Logo',113,'Brand','droplogo',2),(139,'编辑分类',114,'Category','edit',2),(140,'删除分类',114,'Category','del',2),(141,'转移商品',114,'Category','move',2),(142,'添加类型',115,'Type','add',2),(143,'编辑类型',115,'Type','edit',2),(144,'删除类型',115,'Type','del',2),(145,'会员管理',0,'#','#',0),(146,'会员列表',145,'User','showlist',1),(147,'添加会员',146,'User','add',2),(148,'编辑会员',146,'User','edit',2),(149,'删除会员',146,'User','del',2),(150,'收货地址',146,'User','address_list',2),(151,'用户评论',101,'Comment','comment_list',1);

/*Table structure for table `cz_brand` */

CREATE TABLE `cz_brand` (
  `brand_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(60) NOT NULL DEFAULT '',
  `brand_logo` varchar(120) NOT NULL DEFAULT '',
  `brand_desc` text NOT NULL,
  `site_url` varchar(255) NOT NULL DEFAULT '',
  `sort_order` tinyint(3) unsigned NOT NULL DEFAULT '50',
  `is_show` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`brand_id`),
  KEY `is_show` (`is_show`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `cz_brand` */

insert  into `cz_brand`(`brand_id`,`brand_name`,`brand_logo`,`brand_desc`,`site_url`,`sort_order`,`is_show`) values (1,'诺基亚','./data/uploads/20150426/553c4d6cdb05f.jpg','公司网站：http://www.nokia.com.cn/\r\n\r\n客服电话：400-880-0123','http://www.nokia.com.cn/',50,1),(2,'摩托罗拉','./data/uploads/20150426/553c4d803d55a.JPG','官方咨询电话：4008105050\r\n售后网点：http://www.motorola.com.cn/service/carecenter/search.asp ','http://www.motorola.com.cn',50,1),(3,'多普达','./data/uploads/20150426/553c4d90a458d.jpg','官方咨询电话：4008201668\r\n售后网点：http://www.dopod.com/pc/service/searchresult2.php ','http://www.dopod.com ',50,1),(4,'飞利浦','./data/uploads/20150426/553c4d9f084c2.JPG','官方咨询电话：4008800008\r\n售后网点：http://www.philips.com.cn/service/mustservice/index.page ','http://www.philips.com.cn ',50,1),(5,'夏新','./data/uploads/20150426/553c4e13165e8.jpg','官方咨询电话：4008875777\r\n售后网点：http://www.amobile.com.cn/service_fwyzc.asp ok','http://www.amobile.com.cn',50,1),(6,'三星','./data/uploads/20150425/553b7b28104a8.PNG','官方咨询电话：8008105858\n售后网点：http://cn.samsungmobile.com/cn/support/search_area_o.jsp ','http://cn.samsungmobile.com',50,1),(7,'索爱','./data/uploads/20150425/553b7b28104a8.PNG','官方咨询电话：4008100000\n售后网点：http://www.sonyericsson.com/cws/common/contact?cc=cn&lc=zh ','http://www.sonyericsson.com.cn/',50,1),(8,'LG','./data/uploads/20150425/553b7b28104a8.PNG','官方咨询电话：4008199999\n售后网点：http://www.lg.com.cn/front.support.svccenter.retrieveCenter.laf?hrefId=9 ','http://cn.wowlg.com',50,1),(9,'联想','./data/uploads/20150425/553b7b28104a8.PNG','官方咨询电话：4008188818\n售后网点：http://www.lenovomobile.com/service/kf-wanglou.asp','http://www.lenovomobile.com/',50,1),(10,'金立','./data/uploads/20150425/553b7b28104a8.PNG','官方咨询电话：4007796666\n售后网点：http://www.gionee.net/service.asp ','http://www.gionee.net',50,1),(11,'  恒基伟业','','官方咨询电话：4008899126\n售后网点：http://www.htwchina.com/htwt/wexiu.shtml ','',50,1),(12,'1','./data/uploads/20150427/553e0da790b8f.JPG','22','23',50,1);

/*Table structure for table `cz_cart` */

CREATE TABLE `cz_cart` (
  `cart_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '购物车ID',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `goods_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品ID',
  `goods_name` varchar(100) NOT NULL DEFAULT '' COMMENT '商品名称',
  `goods_img` varchar(255) NOT NULL DEFAULT '' COMMENT '商品图片',
  `goods_attr` varchar(255) NOT NULL DEFAULT '' COMMENT '商品属性',
  `goods_number` smallint(5) unsigned NOT NULL DEFAULT '1' COMMENT '商品数量',
  `market_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '市场价格',
  `goods_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '成交价格',
  `subtotal` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '小计',
  `goods_attr_id` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cart_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cz_cart` */

/*Table structure for table `cz_category` */

CREATE TABLE `cz_category` (
  `cat_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(90) NOT NULL DEFAULT '',
  `cat_desc` varchar(255) NOT NULL DEFAULT '',
  `parent_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `sort_order` tinyint(1) unsigned NOT NULL DEFAULT '50',
  `measure_unit` varchar(15) NOT NULL DEFAULT '',
  `show_in_nav` tinyint(1) NOT NULL DEFAULT '0',
  `is_show` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `filter_attr` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cat_id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

/*Data for the table `cz_category` */

insert  into `cz_category`(`cat_id`,`cat_name`,`cat_desc`,`parent_id`,`sort_order`,`measure_unit`,`show_in_nav`,`is_show`,`filter_attr`) values (1,'手机类型','&lt;script&gt;alert(\'abc\');&lt;/script&gt;s',0,50,'1',1,1,'173'),(2,'CDMA手机','',1,50,'',0,1,'6'),(3,'GSM手机','',1,50,'台',0,1,'185,189,173,178'),(4,'3G手机','',1,50,'',0,1,'28'),(5,'双模手机','',1,50,'',0,1,'18'),(6,'手机配件','',0,50,'',0,1,'0'),(7,'充电器','',6,50,'',0,1,'0'),(8,'耳机','',6,50,'',0,1,'0'),(9,'电池','',6,50,'',0,1,'0'),(11,'读卡器和内存卡','',6,50,'',0,1,'0'),(12,'充值卡','',0,50,'',0,1,'0'),(13,'小灵通/固话充值卡','',12,50,'',0,1,'0'),(14,'移动手机充值卡','',12,50,'',0,1,'0'),(15,'联通手机充值卡','',12,50,'',0,1,'0'),(16,'测试分类','1啊啊',0,50,'个',1,1,'0'),(18,'二级分类','啊',16,50,'',0,1,'0');

/*Table structure for table `cz_comment` */

CREATE TABLE `cz_comment` (
  `comment_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `comment_type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '0[商品]1[文章]',
  `id_value` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `email` varchar(60) NOT NULL DEFAULT '',
  `user_name` varchar(60) NOT NULL DEFAULT '',
  `content` text,
  `comment_rank` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `add_time` int(10) unsigned NOT NULL DEFAULT '0',
  `ip_address` varchar(15) NOT NULL DEFAULT '',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `replay` varchar(255) DEFAULT NULL,
  `replay_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `parent_id` (`parent_id`),
  KEY `id_value` (`id_value`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*Data for the table `cz_comment` */

insert  into `cz_comment`(`comment_id`,`comment_type`,`id_value`,`email`,`user_name`,`content`,`comment_rank`,`add_time`,`ip_address`,`status`,`parent_id`,`user_id`,`replay`,`replay_name`) values (3,0,33,'hao123@qq.com','hao123','wwwwwwwwwwww',2,1429748130,'127.0.0.1',1,0,1,'111s','admin'),(4,0,33,'ecshop@ecshop.com','hao123','ccccccccccccccccccccccc',3,1429748130,'127.0.0.1',1,0,1,NULL,NULL),(5,0,33,'12341@qq.com','hao333','wwwwwwwwwwwwwwwwwwwwww',2,1429748130,'127.0.0.1',1,0,2,NULL,NULL),(6,0,33,'123124@cc.com','hao333','很好很好',5,1429748130,'127.0.0.1',1,0,2,NULL,NULL),(7,0,33,'ecshop@ecshop.com','hao333','ecshop@ecshop.com',5,1429748130,'127.0.0.1',1,0,2,NULL,NULL),(8,0,33,'hao123@qq.com','匿名用户','sss',0,1431191229,'127.0.0.1',1,0,0,NULL,NULL),(9,0,33,'123@qq.com','匿名用户','22',0,1431192338,'127.0.0.1',1,0,0,NULL,NULL),(10,0,31,'z123@qq.com','hao123','很好很好',0,1431760163,'127.0.0.1',1,0,1,NULL,NULL),(11,0,31,'z123@qq.com','hao123','手机很棒，已收到货了。',0,1431760163,'127.0.0.1',1,0,1,NULL,NULL),(12,0,31,'dasd@qq.com','hao123','外观很漂亮',0,1431760328,'127.0.0.1',1,0,1,NULL,NULL),(13,0,23,'ww@qq.com','hao123','wwww',0,1431831687,'127.0.0.1',1,0,1,NULL,NULL),(14,0,23,'ww@qq.com','匿名用户','www',0,1431833150,'127.0.0.1',1,0,0,NULL,NULL),(15,0,23,'ww@qq.com','匿名用户','www',0,1431835944,'127.0.0.1',1,0,0,NULL,NULL),(16,0,1,'c2@qq.com','匿名用户','sss',0,1432003691,'127.0.0.1',0,0,0,NULL,NULL);

/*Table structure for table `cz_gallery` */

CREATE TABLE `cz_gallery` (
  `img_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '图片编号',
  `goods_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品ID',
  `img_url` varchar(250) NOT NULL DEFAULT '' COMMENT '图片URL',
  `thumb_url` varchar(250) NOT NULL DEFAULT '' COMMENT '缩略图URL',
  `img_desc` varchar(120) NOT NULL DEFAULT '' COMMENT '图片描述',
  PRIMARY KEY (`img_id`),
  KEY `goods_id` (`goods_id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;

/*Data for the table `cz_gallery` */

insert  into `cz_gallery`(`img_id`,`goods_id`,`img_url`,`thumb_url`,`img_desc`) values (1,1,'./data/uploads/goods/20150427/1_P_1240902890730.gif','./data/uploads/goods/20150427/1_thumb_P_1240902890139.jpg',''),(2,1,'./data/uploads/goods/20150427/1_P_1240904370445.jpg','./data/uploads/goods/20150427/1_thumb_P_1240904370846.jpg',''),(3,1,'./data/uploads/goods/20150427/1_P_1240904371414.jpg','./data/uploads/goods/20150427/1_thumb_P_1240904371539.jpg',''),(4,1,'./data/uploads/goods/20150427/1_P_1240904371355.jpg','./data/uploads/goods/20150427/1_thumb_P_1240904371335.jpg',''),(6,3,'./data/uploads/goods/20150427/3_P_1241422082461.jpg','./data/uploads/goods/20150427/3_thumb_P_1241422082160.jpg',''),(7,4,'./data/uploads/goods/20150427/4_P_1241422402169.jpg','./data/uploads/goods/20150427/4_thumb_P_1241422402909.jpg',''),(8,5,'./data/uploads/goods/20150427/5_P_1241422518168.jpg','./data/uploads/goods/20150427/5_thumb_P_1241422518416.jpg',''),(9,7,'./data/uploads/goods/20150427/7_P_1241422785926.jpg','./data/uploads/goods/20150427/7_thumb_P_1241422785889.jpg',''),(10,8,'./data/uploads/goods/20150427/8_P_1241425513388.jpg','./data/uploads/goods/20150427/8_thumb_P_1241425513834.jpg',''),(11,8,'./data/uploads/goods/20150427/8_P_1241425891781.JPG','./data/uploads/goods/20150427/8_thumb_P_1241425891460.jpg','正面'),(12,8,'./data/uploads/goods/20150427/8_P_1241425891193.jpg','./data/uploads/goods/20150427/8_thumb_P_1241425892547.jpg','背面'),(13,8,'./data/uploads/goods/20150427/8_P_1241425892941.JPG','./data/uploads/goods/20150427/8_thumb_P_1241425892356.jpg','侧面'),(14,9,'./data/uploads/goods/20150427/9_P_1241511871575.jpg','./data/uploads/goods/20150427/9_thumb_P_1241511871787.jpg',''),(15,12,'./data/uploads/goods/20150427/12_P_1241965978060.jpg','./data/uploads/goods/20150427/12_thumb_P_1241965978845.jpg',''),(16,12,'./data/uploads/goods/20150427/12_P_1241966218046.jpg','./data/uploads/goods/20150427/12_thumb_P_1241966218835.jpg',''),(17,12,'./data/uploads/goods/20150427/12_P_1241966218391.jpg','./data/uploads/goods/20150427/12_thumb_P_1241966218843.jpg',''),(18,13,'./data/uploads/goods/20150427/13_P_1241967762510.jpg','./data/uploads/goods/20150427/13_thumb_P_1241967762510.jpg',''),(19,13,'./data/uploads/goods/20150427/13_P_1241968002659.jpg','./data/uploads/goods/20150427/13_thumb_P_1241968002193.jpg',''),(20,14,'./data/uploads/goods/20150427/14_P_1241968492774.jpg','./data/uploads/goods/20150427/14_thumb_P_1241968492168.jpg',''),(21,14,'./data/uploads/goods/20150427/14_P_1241968492721.jpg','./data/uploads/goods/20150427/14_thumb_P_1241968492995.jpg',''),(22,14,'./data/uploads/goods/20150427/14_P_1241968492279.jpg','./data/uploads/goods/20150427/14_thumb_P_1241968492674.jpg',''),(23,16,'./data/uploads/goods/20150427/16_P_1241968949498.jpg','./data/uploads/goods/20150427/16_thumb_P_1241968949965.jpg',''),(24,17,'./data/uploads/goods/20150427/17_P_1241969394354.jpg','./data/uploads/goods/20150427/17_thumb_P_1241969394537.jpg',''),(25,19,'./data/uploads/goods/20150427/19_P_1241970140820.jpg','./data/uploads/goods/20150427/19_thumb_P_1241970140527.jpg',''),(26,19,'./data/uploads/goods/20150427/19_P_1241970140600.jpg','./data/uploads/goods/20150427/19_thumb_P_1241970140229.jpg',''),(27,19,'./data/uploads/goods/20150427/19_P_1241970175007.jpg','./data/uploads/goods/20150427/19_thumb_P_1241970175086.jpg',''),(28,22,'./data/uploads/goods/20150427/22_P_1241971076061.jpg','./data/uploads/goods/20150427/22_thumb_P_1241971076595.jpg',''),(29,23,'./data/uploads/goods/20150427/23_P_1241971556661.jpg','./data/uploads/goods/20150427/23_thumb_P_1241971556920.jpg',''),(30,24,'./data/uploads/goods/20150427/24_P_1241971981420.jpg','./data/uploads/goods/20150427/24_thumb_P_1241971981834.jpg',''),(31,25,'./data/uploads/goods/20150427/25_P_1241972709888.jpg','./data/uploads/goods/20150427/25_thumb_P_1241972709070.jpg',''),(32,26,'./data/uploads/goods/20150427/26_P_1241972789025.jpg','./data/uploads/goods/20150427/26_thumb_P_1241972789061.jpg',''),(33,27,'./data/uploads/goods/20150427/27_P_1241972894128.jpg','./data/uploads/goods/20150427/27_thumb_P_1241972894915.jpg',''),(34,28,'./data/uploads/goods/20150427/28_P_1241972976099.jpg','./data/uploads/goods/20150427/28_thumb_P_1241972976277.jpg',''),(35,29,'./data/uploads/goods/20150427/29_P_1241973022876.jpg','./data/uploads/goods/20150427/29_thumb_P_1241973022886.jpg',''),(36,30,'./data/uploads/goods/20150427/30_P_1241973114554.jpg','./data/uploads/goods/20150427/30_thumb_P_1241973114166.jpg',''),(38,20,'./data/uploads/goods/20150427/20_P_1242106490582.jpg','./data/uploads/goods/20150427/20_thumb_P_1242106490836.jpg',''),(39,21,'./data/uploads/goods/20150427/21_P_1242109298519.jpg','./data/uploads/goods/20150427/21_thumb_P_1242109298525.jpg',''),(40,31,'./data/uploads/goods/20150427/31_P_1242110412503.jpg','./data/uploads/goods/20150427/31_thumb_P_1242110412614.jpg',''),(41,32,'./data/uploads/goods/20150427/32_P_1242110760641.jpg','./data/uploads/goods/20150427/32_thumb_P_1242110760997.jpg',''),(42,15,'./data/uploads/goods/20150427/15_P_1242973362276.jpg','./data/uploads/goods/20150427/15_thumb_P_1242973362611.jpg',''),(43,10,'./data/uploads/goods/20150427/10_P_1242973436620.jpg','./data/uploads/goods/20150427/10_thumb_P_1242973436219.jpg',''),(46,36,'./data/uploads/goods/20150428/553f5f51718a4.jpg','./data/uploads/goods/20150428/thumb_553f5f51718a4.jpg',''),(47,36,'./data/uploads/goods/20150428/553f5f517a15e.PNG','./data/uploads/goods/20150428/thumb_553f5f517a15e.PNG',''),(48,36,'./data/uploads/goods/20150428/553f5f517d427.JPG','./data/uploads/goods/20150428/thumb_553f5f517d427.JPG',''),(49,32,'./data/uploads/goods/20150504/55477616c25d8.JPG','./data/uploads/goods/20150504/thumb_55477616c25d8.JPG',''),(50,33,'./data/uploads/goods/20150504/5547781241f42.JPG','./data/uploads/goods/20150504/thumb_5547781241f42.JPG',''),(51,34,'./data/uploads/goods/20150504/55477b5e8b82d.jpg','./data/uploads/goods/20150504/thumb_55477b5e8b82d.jpg','');

/*Table structure for table `cz_goods` */

CREATE TABLE `cz_goods` (
  `goods_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品ID',
  `goods_sn` varchar(30) NOT NULL DEFAULT '' COMMENT '商品货号',
  `goods_name` varchar(100) NOT NULL DEFAULT '' COMMENT '商品名称',
  `goods_brief` varchar(255) NOT NULL DEFAULT '' COMMENT '商品简单描述',
  `goods_desc` text COMMENT '商品详情',
  `cat_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '商品所属类别ID',
  `brand_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '商品所属品牌ID',
  `market_price` decimal(10,2) DEFAULT '0.00' COMMENT '市场价',
  `shop_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '本店价格',
  `promote_price` decimal(10,2) DEFAULT '0.00' COMMENT '促销价格',
  `promote_start_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '促销起始时间',
  `promote_end_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '促销截止时间',
  `goods_img` varchar(250) NOT NULL DEFAULT '' COMMENT '商品图片',
  `goods_thumb` varchar(250) NOT NULL DEFAULT '' COMMENT '商品缩略图',
  `goods_number` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '商品库存',
  `warn_number` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '库存警告值',
  `goods_weight` decimal(10,3) unsigned NOT NULL DEFAULT '0.000' COMMENT '商品重量',
  `click_count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '点击次数',
  `type_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '商品类型ID',
  `is_promote` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否促销，默认为0不促销',
  `is_best` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否精品,默认为0',
  `is_new` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否新品，默认为0',
  `is_hot` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否热卖,默认为0',
  `is_onsale` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '是否上架,默认为1',
  `is_shipping` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `sort_order` tinyint(8) NOT NULL DEFAULT '50',
  `add_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`goods_id`),
  KEY `cat_id` (`cat_id`),
  KEY `brand_id` (`brand_id`),
  KEY `type_id` (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;

/*Data for the table `cz_goods` */

insert  into `cz_goods`(`goods_id`,`goods_sn`,`goods_name`,`goods_brief`,`goods_desc`,`cat_id`,`brand_id`,`market_price`,`shop_price`,`promote_price`,`promote_start_time`,`promote_end_time`,`goods_img`,`goods_thumb`,`goods_number`,`warn_number`,`goods_weight`,`click_count`,`type_id`,`is_promote`,`is_best`,`is_new`,`is_hot`,`is_onsale`,`is_shipping`,`sort_order`,`add_time`) values (1,'ECS000000','KD876','111','       很多朋友都已经抢先体验了3G网络的可视通话、高速上网等功能。LG KD876手机支持TD-SCDMA/GSM双模单待，便于测试初期GSM网络和TD网络之间的切换和共享。\r\n\r\n       LG KD876手机整体采用银色塑料材质，特殊的旋转屏设计是本机的亮点，而机身背部的300万像素摄像头也是首发的六款TD-SCDMA手机中配置最高的。LG KD876手机屏幕下方设置有外键盘，该键盘由左/右软键、通话/挂机键、返回键、五维摇杆组成，摇杆灵敏度很高，定位准确。KD876的内键盘由标准12个电话键和三个功能键、一个内置摄像头组成。三个功能键分别为视频通话、MP3、和菜单键，所有按键的手感都比较一般，键程适中，当由于按键排列过于紧密，快速发短信时很容易误按，用户在使用时一定要多加注意。LG KD876手机机身周边的接口设计非常简洁，手机的厚度主要来自屏幕旋转轴的长度，如果舍弃旋屏设计的话，估计厚度可以做到10mm以下。',4,1,'1665.60','1388.00','0.00',0,0,'./data/uploads/goods/20150427/1_G_1240902890755.jpg','./data/uploads/goods/20150427/1_thumb_G_1240902890710.jpg',998,1,'0.100',24,9,0,1,1,1,1,1,100,1240902890),(2,'ECS000004','诺基亚N85原装充电器','','',8,1,'69.60','58.00','0.00',0,0,'./data/uploads/goods/20150427/4_G_1241422402722.jpg','./data/uploads/goods/20150427/4_thumb_G_1241422402467.jpg',16,1,'0.000',1,9,0,0,0,1,1,0,100,1241422402),(3,'ECS000002','诺基亚原装5800耳机','','',8,1,'81.60','68.00','0.00',0,0,'./data/uploads/goods/20150427/3_G_1241422082168.jpg','./data/uploads/goods/20150427/3_thumb_G_1241422082679.jpg',24,1,'0.000',3,6,0,0,0,1,1,0,100,1241422082),(4,'ECS000005','索爱原装M2卡读卡器','','',11,7,'24.00','20.00','0.00',0,0,'./data/uploads/goods/20150427/5_G_1241422518773.jpg','./data/uploads/goods/20150427/5_thumb_G_1241422518886.jpg',7,1,'0.000',3,2,0,1,1,1,1,0,100,1241422518),(5,'ECS000006','胜创KINGMAX内存卡','','',11,0,'50.40','42.00','0.00',0,0,'./data/uploads/goods/20150427/7_G_1241422785856.jpg','',15,1,'0.000',0,6,0,0,0,1,1,0,100,1241422573),(6,'ECS000007','诺基亚N85原装立体声耳机HS-82','','',8,1,'120.00','100.00','0.00',0,0,'./data/uploads/goods/20150427/7_G_1241422785856.jpg','./data/uploads/goods/20150427/7_thumb_G_1241422785492.jpg',20,1,'0.000',1,2,0,0,0,1,1,0,100,1241422785),(7,'ECS000008','飞利浦9@9v','','',3,4,'478.79','399.00','385.00',1241366400,1417276800,'./data/uploads/goods/20150427/8_G_1241425513055.jpg','./data/uploads/goods/20150427/8_thumb_G_1241425513488.jpg',1,1,'0.075',15,9,1,1,1,1,1,0,100,1241425512),(8,'ECS000009','诺基亚E66','','',3,1,'2757.60','2298.00','0.00',0,0,'./data/uploads/goods/20150427/9_G_1241511871574.jpg','./data/uploads/goods/20150427/9_thumb_G_1241511871555.jpg',3,1,'0.121',22,9,0,1,1,1,1,0,100,1241511871),(9,'ECS000010','索爱C702c','','',3,0,'1593.60','1328.00','1250.00',0,1277827200,'./data/uploads/goods/20150427/10_G_1242973436141.jpg','./data/uploads/goods/20150427/10_thumb_G_1242973436403.jpg',7,1,'0.000',11,9,1,0,0,1,1,0,100,1241965622),(11,'ECS000012','摩托罗拉A810','','',3,2,'1179.60','983.00','960.00',1241107200,1255104000,'./data/uploads/goods/20150427/12_G_1241965978209.jpg','./data/uploads/goods/20150427/12_thumb_G_1241965978410.jpg',8,1,'0.000',13,9,1,0,1,0,1,0,100,1245297652),(12,'ECS000013','诺基亚5320 XpressMusic','','',3,1,'1573.20','1311.00','0.00',0,0,'./data/uploads/goods/20150427/13_G_1241968002233.jpg','./data/uploads/goods/20150427/13_thumb_G_1241968002527.jpg',8,1,'0.000',14,9,0,0,0,1,1,0,100,1241967762),(13,'ECS000014','诺基亚5800XM','','',4,1,'3150.00','2625.00','0.00',0,0,'./data/uploads/goods/20150427/14_G_1241968492932.jpg','./data/uploads/goods/20150427/14_thumb_G_1241968492116.jpg',1,1,'0.000',9,9,0,0,0,1,1,0,100,1241968492),(14,'ECS000015','摩托罗拉A810','','',3,2,'945.60','788.00','0.00',0,0,'./data/uploads/goods/20150427/15_G_1242973362318.jpg','./data/uploads/goods/20150427/15_thumb_G_1242973362970.jpg',3,1,'0.000',8,9,0,0,1,1,1,0,100,1241968703),(15,'ECS000016','恒基伟业G101','','',1,11,'988.00','823.33','0.00',0,0,'./data/uploads/goods/20150427/16_G_1241968949002.jpg','./data/uploads/goods/20150427/16_thumb_G_1241968949103.jpg',0,1,'0.000',3,9,0,0,0,0,0,0,100,1241968949),(16,'ECS000017','夏新N7','','',3,5,'2760.00','2300.00','0.00',0,0,'./data/uploads/goods/20150427/17_G_1241969394677.jpg','./data/uploads/goods/20150427/17_thumb_G_1241969394587.jpg',1,1,'0.000',3,9,0,1,0,1,1,0,100,1241969394),(17,'ECS000018','夏新T5','','',4,5,'3453.60','2878.00','0.00',0,0,'./data/uploads/goods/20150427/7_G_1241422785856.jpg','./data/uploads/goods/20150427/10_thumb_G_1242973436403.jpg',1,1,'0.000',0,9,0,0,0,0,1,0,100,1241969533),(18,'ECS000019','三星SGH-F258','从整体来看，三星SGH-F258比较时尚可爱，三围尺寸为94×46×17.5mm，重量为96克，曲线柔和具有玲珑美感\r\n','',3,6,'1029.60','858.00','0.00',0,0,'./data/uploads/goods/20150427/19_G_1241970175091.jpg','./data/uploads/goods/20150427/19_thumb_G_1241970175208.jpg',12,1,'0.000',9,9,0,1,1,1,1,0,100,1241970139),(19,'ECS000020','三星BC01','','',3,6,'336.00','280.00','238.00',1241884800,1251648000,'./data/uploads/goods/20150427/20_G_1242106490663.jpg','./data/uploads/goods/20150427/20_thumb_G_1242106490058.jpg',12,1,'0.000',14,9,1,1,1,1,1,0,100,1241970417),(20,'ECS000021','金立 A30','','',3,10,'2400.00','2000.00','0.00',0,0,'./data/uploads/goods/20150427/21_G_1242109298873.jpg','./data/uploads/goods/20150427/21_thumb_G_1242109298150.jpg',40,1,'0.000',4,9,0,0,0,0,1,0,100,1241970634),(21,'ECS000022','多普达Touch HD','','',3,3,'7198.80','5999.00','0.00',0,0,'./data/uploads/goods/20150427/22_G_1241971076358.jpg','./data/uploads/goods/20150427/22_thumb_G_1241971076803.jpg',1,1,'0.010',15,9,0,1,1,0,1,0,100,1241971076),(22,'ECS000023','诺基亚N96','','',5,1,'4440.00','3700.00','0.00',0,0,'./data/uploads/goods/20150427/23_G_1241971556855.jpg','./data/uploads/goods/20150427/23_thumb_G_1241971556399.jpg',100,1,'0.000',18,9,0,1,1,0,1,0,100,1241971488),(23,'ECS000024','P806','','',3,9,'2400.00','2000.00','1850.00',1243785600,1277827200,'./data/uploads/goods/20150427/24_G_1241971981284.jpg','./data/uploads/goods/20150427/24_thumb_G_1241971981429.jpg',98,1,'0.000',41,9,1,1,1,1,1,0,100,1241971981),(24,'ECS000025','小灵通/固话50元充值卡','','',13,0,'57.59','48.00','0.00',0,0,'./data/uploads/goods/20150427/25_G_1241972709544.jpg','./data/uploads/goods/20150427/25_thumb_G_1241972709885.jpg',2,1,'0.000',1,0,0,1,0,1,1,0,100,1241972709),(25,'ECS000026','小灵通/固话20元充值卡','','',13,0,'22.80','19.00','0.00',0,0,'./data/uploads/goods/20150427/26_G_1241972789293.jpg','./data/uploads/goods/20150427/26_thumb_G_1241972789393.jpg',2,1,'0.000',1,0,0,0,0,1,1,0,100,1241972789),(26,'ECS000027','联通100元充值卡','','',15,0,'100.00','95.00','0.00',0,0,'./data/uploads/goods/20150427/27_G_1241972894061.jpg','./data/uploads/goods/20150427/27_thumb_G_1241972894068.jpg',1,1,'0.000',4,0,0,1,1,1,1,0,100,1241972894),(27,'ECS000028','联通50元充值卡','','',15,0,'50.00','45.00','0.00',0,0,'./data/uploads/goods/20150427/28_G_1241972976313.jpg','./data/uploads/goods/20150427/28_thumb_G_1241972976986.jpg',0,1,'0.000',0,0,0,0,0,1,1,0,100,1241972976),(28,'ECS000029','移动100元充值卡','','',14,0,'0.00','90.00','0.00',0,0,'./data/uploads/goods/20150427/29_G_1241973022206.jpg','./data/uploads/goods/20150427/29_thumb_G_1241973022239.jpg',0,1,'0.000',1,0,0,1,0,1,1,0,100,1241973022),(29,'ECS000030','移动20元充值卡','','',14,0,'21.00','18.00','0.00',0,0,'./data/uploads/goods/20150427/30_G_1241973114234.jpg','./data/uploads/goods/20150427/30_thumb_G_1241973114800.jpg',7,1,'0.000',2,0,0,1,0,1,1,0,100,1241973114),(30,'ECS000031','摩托罗拉E8 ','','',3,2,'1604.39','1337.00','0.00',0,0,'./data/uploads/goods/20150427/31_G_1242110412332.jpg','./data/uploads/goods/20150427/31_thumb_G_1242110412996.jpg',1,1,'0.000',5,7,0,0,0,0,0,0,100,1242110412),(31,'ECS000032','诺基亚N85','','',3,0,'3612.00','3010.00','2750.00',0,1417276800,'./data/uploads/goods/20150427/32_G_1242110760868.jpg','./data/uploads/goods/20150427/32_thumb_G_1242110760196.jpg',98,1,'0.000',20,9,1,0,1,0,1,0,100,1242110760),(32,'ECS0000001','测试商品','1111','',3,1,'200.00','111.00','0.00',2015,2015,'./data/uploads/goods/20150504/5547761682271.jpg','./data/uploads/goods/20150504/thumb_5547761682271.jpg',111,1,'0.100',2,1,0,0,0,0,1,1,50,0),(33,'ECS000009','测试商品二','222222222','',2,3,'2000.00','1388.00','1001.00',2015,2015,'./data/uploads/goods/20150504/55477811e4ca6.PNG','./data/uploads/goods/20150504/thumb_55477811e4ca6.PNG',80,1,'0.222',13,1,0,0,1,0,1,1,50,0),(34,'ECS0000011','测试商品四','11','啊啊啊啊啊啊',3,2,'10000.00','1388.00','1200.00',2015,2015,'./data/uploads/goods/20150504/55477b5e529f7.PNG','./data/uploads/goods/20150504/thumb_55477b5e529f7.PNG',100,1,'0.500',2,9,0,0,0,0,1,1,50,0),(54,'','测试商品','','',5,1,'0.00','111.00','0.00',0,0,'','',0,1,'0.000',0,0,0,0,0,0,0,0,50,0),(55,'111','123','','',1,2,'11.00','1111.00','11.00',1434556800,1435248000,'','',0,1,'0.000',0,0,0,0,0,0,0,0,50,0);

/*Table structure for table `cz_goods_attr` */

CREATE TABLE `cz_goods_attr` (
  `goods_attr_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `goods_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `attr_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `attr_value` text,
  `attr_price` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`goods_attr_id`),
  KEY `goods_id` (`goods_id`),
  KEY `attr_id` (`attr_id`)
) ENGINE=MyISAM AUTO_INCREMENT=192 DEFAULT CHARSET=utf8;

/*Data for the table `cz_goods_attr` */

insert  into `cz_goods_attr`(`goods_attr_id`,`goods_id`,`attr_id`,`attr_value`,`attr_price`) values (1,1,172,'2008年01月','0'),(2,1,180,'MicroSD','0'),(3,1,181,'512MB','0'),(4,1,182,'Android','0'),(5,1,184,'3.5英寸','0'),(6,1,186,'1600万','0'),(7,1,187,'TFT','0'),(8,1,188,'320×240 像素','0'),(9,1,185,'黑色','50'),(10,1,210,'线控耳机','30'),(11,1,173,'GSM,850,900,1800,1900','0'),(12,1,178,'翻盖','0'),(13,2,172,'2008年02月','0'),(14,2,180,'MicroSD','0'),(15,2,181,'512MB','0'),(16,2,182,'Android','0'),(17,2,184,'4英寸','0'),(18,2,186,'1600万','0'),(19,2,187,'TFT','0'),(20,2,188,'176x220 像素','0'),(21,2,185,'白色','100'),(22,2,185,'黑色','50'),(23,2,185,'金色','200'),(24,2,173,'CDMA','0'),(25,2,178,'直板','0'),(26,7,172,'2008年03月','0'),(27,7,180,'MicroSD','0'),(28,7,181,'512MB','0'),(29,7,182,'Android','0'),(30,7,184,'3.5英寸','0'),(31,7,186,'262144万','0'),(32,7,187,'TFT','0'),(33,7,188,'240×400 像素','0'),(34,7,185,'蓝色','200'),(35,7,185,'黑色','300'),(36,7,173,'双模（GSM,900,1800,CDMA 1X）','0'),(37,7,178,'滑盖','0'),(38,8,172,'2008年05月','0'),(39,8,180,'MicroSD','0'),(40,8,181,'512MB','0'),(41,8,182,'Android','0'),(42,8,184,'3.5英寸','0'),(43,8,186,'1600万','0'),(44,8,187,'TFT','0'),(45,8,188,'240×320 像素','0'),(46,8,185,'银色','30'),(47,8,210,'线控耳机','20'),(48,8,210,'蓝牙耳机','30'),(49,8,173,'GSM,900,1800,1900,2100','0'),(50,8,178,'翻盖','0'),(51,9,172,'2008年04月','0'),(52,9,180,'MicroSD','0'),(53,9,181,'1GB','0'),(54,9,182,'Window8','0'),(55,9,184,'4英寸','0'),(56,9,186,'262144万','0'),(57,9,187,'TFT','0'),(58,9,188,'240×400 像素','0'),(59,9,185,'灰色','100'),(60,9,185,'黑色','30'),(61,9,178,'直板','0'),(62,11,172,'2008年09月','0'),(63,11,180,'MicroSD','0'),(64,11,181,'512MB','0'),(65,11,182,'Android','0'),(66,11,184,'3.5英寸','0'),(67,11,186,'1600万','0'),(68,11,187,'TFT','0'),(69,11,188,'240×400 像素','0'),(70,11,185,'黑红色','300'),(71,11,185,'白色','150'),(72,11,173,'GSM,850,900,1800,1900','0'),(73,11,178,'滑盖','0'),(74,12,172,'2008年11月','0'),(75,12,180,'MicroSD','0'),(76,12,181,'1GB','0'),(77,12,182,'Android','0'),(78,12,184,'3.5英寸','0'),(79,12,186,'1600万','0'),(80,12,187,'TFT','0'),(81,12,188,'240×400 像素','0'),(82,12,185,'银色','80'),(83,12,185,'白色','70'),(84,12,173,'双模（GSM,900,1800,CDMA 1X）','0'),(85,12,178,'翻盖','0'),(86,13,172,'2008年05月','0'),(87,13,180,'MicroSD','0'),(88,13,181,'512MB','0'),(89,13,182,'Android','0'),(90,13,184,'3.5英寸','0'),(91,13,186,'1600万','0'),(92,13,187,'TFT','0'),(93,13,188,'240×400 像素','0'),(94,13,185,'白色','100'),(95,13,185,'黑色','50'),(96,13,178,'直板','0'),(97,14,172,'2008年07月','0'),(98,14,180,'MicroSD','0'),(99,14,181,'512MB','0'),(100,14,182,'Android','0'),(101,14,184,'3.5英寸','0'),(102,14,186,'1600万','0'),(103,14,187,'TFT','0'),(104,14,185,'金色','300'),(105,14,185,'黑色','200'),(106,14,178,'滑盖','0'),(107,15,172,'2008年09月','0'),(108,15,180,'MicroSD','0'),(109,15,181,'384MB','0'),(110,15,182,'Android','0'),(111,15,185,'粉色','100'),(112,15,185,'蓝色','120'),(113,15,178,'直板','0'),(114,16,172,'2008年06月','0'),(115,16,180,'MicroSD','0'),(116,16,181,'128MB','0'),(117,16,182,'Android','0'),(118,16,185,'白色','100'),(119,16,178,'翻盖','0'),(120,17,172,'2008年08月','0'),(121,17,180,'MicroSD','0'),(122,17,181,'512MB','0'),(123,17,182,'Android','0'),(124,17,184,'3.5英寸','0'),(125,17,186,'1600万','0'),(126,17,187,'TFT','0'),(127,17,188,'320×240 像素','0'),(128,17,185,'黑色','100'),(129,17,178,'直板','0'),(130,18,172,'2008年10月','0'),(131,18,180,'MicroSD','0'),(132,18,181,'256MB','0'),(133,18,182,'Android','0'),(134,18,185,'黑色','100'),(135,18,185,'白色','150'),(136,18,173,'GSM,900,1800,1900,2100','0'),(137,18,178,'折叠','0'),(138,19,172,'2008年02月','0'),(139,19,180,'MicroSD','0'),(140,19,181,'512MB','0'),(141,19,182,'Android','0'),(142,19,184,'3.5英寸','0'),(143,19,185,'黑色','100'),(144,19,185,'粉色','80'),(145,19,178,'滑盖','0'),(146,20,172,'2008年10月','0'),(147,20,180,'MicroSD','0'),(148,20,181,'128MB','0'),(149,20,182,'Android','0'),(150,20,184,'3.5英寸','0'),(151,20,186,'1600万','0'),(152,20,187,'TFT','0'),(153,20,188,'320×240 像素','0'),(154,20,203,'支持','0'),(155,20,204,'支持','0'),(156,20,206,'支持','0'),(157,20,185,'黑色','50'),(158,20,185,'灰色','120'),(159,20,178,'滑盖','0'),(160,21,172,'2008年08月','0'),(161,21,180,'MicroSD','0'),(162,21,181,'512MB','0'),(163,21,182,'Android','0'),(164,21,184,'3.5英寸','0'),(165,21,186,'1600万','0'),(166,21,187,'TFT','0'),(167,21,188,'320×240 像素','0'),(168,21,185,'白色','100'),(169,21,178,'滑盖','0'),(170,22,172,'2008年04月','0'),(171,22,180,'MicroSD','0'),(172,22,181,'512MB','0'),(173,22,182,'Android','0'),(174,22,184,'3.5英寸','0'),(175,22,188,'240×400 像素','0'),(176,22,185,'黑色','200'),(177,22,185,'白色','100'),(178,22,173,'CDMA','0'),(179,22,178,'直板','0'),(180,23,172,'2008年04月','0'),(181,23,180,'MicroSD','0'),(182,23,181,'512MB','0'),(183,23,182,'Android','0'),(184,23,184,'3.5英寸','0'),(185,23,186,'1600万','0'),(186,23,187,'TFT','0'),(187,23,188,'320×240 像素','0'),(188,23,185,'白色','120'),(189,23,185,'黑色','130'),(190,23,173,'GSM,900,1800,1900,2100','0'),(191,23,178,'直板','0');

/*Table structure for table `cz_goods_cat` */

CREATE TABLE `cz_goods_cat` (
  `goods_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `cat_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`goods_id`,`cat_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `cz_goods_cat` */

insert  into `cz_goods_cat`(`goods_id`,`cat_id`) values (54,2),(54,3),(54,4),(55,1);

/*Table structure for table `cz_goods_type` */

CREATE TABLE `cz_goods_type` (
  `type_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `type_name` varchar(60) NOT NULL DEFAULT '',
  `enabled` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `attr_group` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `cz_goods_type` */

insert  into `cz_goods_type`(`type_id`,`type_name`,`enabled`,`attr_group`) values (1,'书',1,''),(2,'音乐',1,''),(3,'电影',1,''),(4,'手机',1,''),(5,'笔记本电脑',1,''),(6,'数码相机',1,''),(7,'数码摄像机',1,''),(8,'化妆品',1,''),(9,'精品手机',1,'');

/*Table structure for table `cz_order` */

CREATE TABLE `cz_order` (
  `order_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '订单ID',
  `order_sn` varchar(30) NOT NULL DEFAULT '' COMMENT '订单号',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `address_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '收货地址id',
  `order_status` int(2) NOT NULL DEFAULT '0' COMMENT '订单状态 1 待付款 2 待发货 3 已发货 4 已完成',
  `postscripts` varchar(255) NOT NULL DEFAULT '' COMMENT '订单附言',
  `shipping_id` tinyint(4) NOT NULL DEFAULT '0' COMMENT '送货方式ID',
  `pay_id` tinyint(4) NOT NULL DEFAULT '0' COMMENT '支付方式ID',
  `goods_amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '商品总金额',
  `order_amount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '订单总金额',
  `order_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '下单时间',
  PRIMARY KEY (`order_id`),
  KEY `user_id` (`user_id`),
  KEY `address_id` (`address_id`),
  KEY `pay_id` (`pay_id`),
  KEY `shipping_id` (`shipping_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `cz_order` */

insert  into `cz_order`(`order_id`,`order_sn`,`user_id`,`address_id`,`order_status`,`postscripts`,`shipping_id`,`pay_id`,`goods_amount`,`order_amount`,`order_time`) values (1,'2015051409044216',1,2,4,'啊啊啊啊',1,1,'1388.00','1388.00',1431608682),(2,'2015051512181657',1,2,2,'',2,1,'10120.00','10130.00',1431620296),(3,'2015051512184033',1,2,2,'',1,1,'95.00','95.00',1431620320),(4,'2015051512190218',1,2,2,'',1,1,'2050.00','2050.00',1431620342),(5,'2015051512193167',1,2,0,'',1,1,'18.00','18.00',1431620371),(6,'2015051512202767',1,2,1,'',1,1,'3076.00','3076.00',1431620427),(7,'2015051512205841',1,2,1,'',3,1,'2298.00','2318.00',1431620458),(8,'2015051512212536',1,2,1,'',3,1,'58.00','78.00',1431620485),(9,'2015051512215575',1,2,1,'',3,1,'1388.00','1408.00',1431620515),(10,'2015051512221626',1,2,1,'',2,2,'20.00','30.00',1431620536),(11,'2015051510240541',1,4,1,'',2,1,'6940.00','6950.00',1431656645),(12,'2015052302513088',1,4,1,'',2,1,'2120.00','2130.00',1432320690);

/*Table structure for table `cz_order_goods` */

CREATE TABLE `cz_order_goods` (
  `rec_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '编号',
  `order_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '订单ID',
  `goods_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品ID',
  `goods_name` varchar(100) NOT NULL DEFAULT '' COMMENT '商品名称',
  `goods_img` varchar(250) NOT NULL DEFAULT '' COMMENT '商品图片',
  `market_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '商品价格',
  `goods_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '成交价格',
  `goods_number` smallint(5) unsigned NOT NULL DEFAULT '1' COMMENT '购买数量',
  `goods_attr` varchar(255) NOT NULL DEFAULT '' COMMENT '商品属性',
  `subtotal` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '商品小计',
  PRIMARY KEY (`rec_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `cz_order_goods` */

insert  into `cz_order_goods`(`rec_id`,`order_id`,`goods_id`,`goods_name`,`goods_img`,`market_price`,`goods_price`,`goods_number`,`goods_attr`,`subtotal`) values (1,1,33,'测试商品二','./data/uploads/goods/20150504/thumb_55477811e4ca6.PNG','2000.00','1388.00',1,'','0.00'),(2,2,31,'诺基亚N85','./data/uploads/goods/20150427/32_thumb_G_1242110760196.jpg','5361.00','5060.00',2,'颜色:黑色[2000]<br/>配件:蓝牙耳机[50]','0.00'),(3,3,26,'联通100元充值卡','./data/uploads/goods/20150427/27_thumb_G_1241972894068.jpg','100.00','95.00',1,'','0.00'),(4,4,23,'P806','./data/uploads/goods/20150427/24_thumb_G_1241971981429.jpg','2450.00','2050.00',1,'颜色:黑色[50]','0.00'),(5,5,29,'移动20元充值卡','./data/uploads/goods/20150427/30_thumb_G_1241973114800.jpg','10.50','9.00',2,'','0.00'),(6,6,1,'KD876','./data/uploads/goods/20150427/1_thumb_G_1240902890710.jpg','1676.80','1538.00',2,'颜色:黑色[100]<br/>配件:线控耳机[50]','0.00'),(7,7,8,'诺基亚E66','./data/uploads/goods/20150427/9_thumb_G_1241511871555.jpg','2757.60','2298.00',1,'颜色:黑色[]','0.00'),(8,8,2,'诺基亚N85原装充电器','./data/uploads/goods/20150427/4_thumb_G_1241422402467.jpg','69.60','58.00',1,'','0.00'),(9,9,33,'测试商品二','./data/uploads/goods/20150504/thumb_55477811e4ca6.PNG','2000.00','1388.00',1,'','0.00'),(10,10,4,'索爱原装M2卡读卡器','./data/uploads/goods/20150427/5_thumb_G_1241422518886.jpg','24.00','20.00',1,'','0.00'),(11,11,33,'测试商品二','./data/uploads/goods/20150504/thumb_55477811e4ca6.PNG','1666.67','1156.67',6,'','0.00'),(12,12,23,'P806','./data/uploads/goods/20150427/24_thumb_G_1241971981429.jpg','2520.00','2120.00',1,'颜色:白色[120]','0.00');

/*Table structure for table `cz_payment` */

CREATE TABLE `cz_payment` (
  `pay_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT '支付方式ID',
  `pay_name` varchar(30) NOT NULL DEFAULT '' COMMENT '支付方式名称',
  `pay_desc` varchar(255) NOT NULL DEFAULT '' COMMENT '支付方式描述',
  `enabled` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '是否启用，默认启用',
  `pay_code` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`pay_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `cz_payment` */

insert  into `cz_payment`(`pay_id`,`pay_name`,`pay_desc`,`enabled`,`pay_code`) values (1,'货到付款','货到付款',1,'cod'),(2,'余额支付','使用帐户余额支付。只有会员才能使用，通过设置信用额度，可以透支。',1,'balance');

/*Table structure for table `cz_region` */

CREATE TABLE `cz_region` (
  `region_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '地区ID',
  `parent_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '父ID',
  `region_name` varchar(30) NOT NULL DEFAULT '' COMMENT '地区名称',
  `region_type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '地区类型 1 省份 2 市 3 区(县)',
  PRIMARY KEY (`region_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cz_region` */

/*Table structure for table `cz_role` */

CREATE TABLE `cz_role` (
  `role_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(20) NOT NULL COMMENT '角色名称',
  `role_auth_ids` varchar(128) NOT NULL DEFAULT '' COMMENT '权限ids,1,2,5',
  `role_auth_ac` text COMMENT '控制器-操作,控制器-操作,控制器-操作',
  `role_desc` mediumtext NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

/*Data for the table `cz_role` */

insert  into `cz_role`(`role_id`,`role_name`,`role_auth_ids`,`role_auth_ac`,`role_desc`) values (20,'经理','101,104,106,113,114,115,107,108,109,110,111,112','Goods-edit,Goods-save,Goods-del,Goods-up,Goods-dropimg,Goods-showlist,Goods-add,Brand-showlist,Category-add,Category-alllist,Type-showlist',''),(21,'主管','101,106,102,109','Goods-brand,Order-print','');

/*Table structure for table `cz_shipping` */

CREATE TABLE `cz_shipping` (
  `shipping_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT '编号',
  `shipping_name` varchar(30) NOT NULL DEFAULT '' COMMENT '送货方式名称',
  `shipping_desc` varchar(255) NOT NULL DEFAULT '' COMMENT '送货方式描述',
  `shipping_fee` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '送货费用',
  `enabled` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '是否启用，默认启用',
  PRIMARY KEY (`shipping_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `cz_shipping` */

insert  into `cz_shipping`(`shipping_id`,`shipping_name`,`shipping_desc`,`shipping_fee`,`enabled`) values (1,'普通快递','配送的运费是固定的','12.00',1),(2,'邮局平邮','邮局平邮的描述内容。','10.00',1),(3,'城际快递','配送的运费是固定的','20.00',1);

/*Table structure for table `cz_user` */

CREATE TABLE `cz_user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户编号',
  `user_name` varchar(50) NOT NULL DEFAULT '' COMMENT '用户名',
  `email` varchar(50) NOT NULL DEFAULT '' COMMENT '电子邮箱',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '用户密码,md5加密',
  `reg_time` int(20) unsigned NOT NULL DEFAULT '0' COMMENT '用户注册时间',
  `last_time` int(20) NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `balance` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '余额',
  `last_ip` varchar(30) NOT NULL COMMENT '最近登录IP',
  `sex` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '性别',
  `birthday` date NOT NULL DEFAULT '0000-00-00' COMMENT '用户生日',
  `msn` varchar(60) NOT NULL COMMENT '用户msn',
  `qq` varchar(20) NOT NULL COMMENT '用户QQ',
  `mobile_phone` varchar(20) NOT NULL COMMENT '手机号码',
  `is_validated` tinyint(3) NOT NULL DEFAULT '0' COMMENT '是否已验证',
  `passwd_question` varchar(60) DEFAULT NULL COMMENT '密码问题',
  `passwd_answer` varchar(255) DEFAULT NULL COMMENT '密码答案',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

/*Data for the table `cz_user` */

insert  into `cz_user`(`user_id`,`user_name`,`email`,`password`,`reg_time`,`last_time`,`balance`,`last_ip`,`sex`,`birthday`,`msn`,`qq`,`mobile_phone`,`is_validated`,`passwd_question`,`passwd_answer`) values (1,'hao123','zyf8985957@163.com','96e79218965eb72c92a549dd5a330112',111,1430448859,'0.00','127.0.0.1',1,'1987-06-24','123123@qq.com','211412','13437192710',0,'old_address','北极'),(2,'hao333','hao333@qq.com','7c1eb97f08056d4a7cde33f20037798e',1430811154,1430811154,'0.00','127.0.0.1',0,'0000-00-00','','','',0,NULL,NULL),(17,'hao1234','hao1234@qq.com','ad7cb4de8b24e6a91f5bf2c3a079af82',1430841774,1430841774,'0.00','127.0.0.1',0,'0000-00-00','hao1234@qq.com','243241','1324134',0,'old_address','13241324');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
