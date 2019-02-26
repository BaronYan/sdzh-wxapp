-- 系统设置
DROP TABLE IF EXISTS `sdjy_config`;
CREATE TABLE `sdjy_config`(
  `config_id` BIGINT(20) unsigned NOT NULL AUTO_INCREMENT,
  `config_name` VARCHAR(255) NOT NULL,
  `config_value` longtext NULL,
  `config_candel` tinyint(1) DEFAULT 0 COMMENT '是否可以删除，0可以,1不可以',
  `config_remark` longtext NULL,
  PRIMARY KEY(`config_id`)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT '系统设置';
-- 课程系列分类表
DROP TABLE IF EXISTS `sdjy_sc_category`;
CREATE TABLE `sdjy_sc_category` (
  `scc_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `scc_title` varchar(255) NOT NULL COMMENT '分类名称',
  `scc_pid` bigint(20) unsigned DEFAULT 0 COMMENT '父分类',
  `scc_sort` int(10)  COMMENT '分类排序',
  PRIMARY KEY (`scc_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT '系列课程分类表';
-- 课程系列表
DROP TABLE IF EXISTS `sdjy_series`;
CREATE TABLE `sdjy_series` (
  `series_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `series_title` varchar(255) NOT NULL COMMENT '标题',
  `series_sub` varchar(255) COMMENT '子标题',
  `series_pic` varchar(255) COMMENT '系列主图',
  `series_content` longtext COMMENT '系列内容',
  `series_course` longtext COMMENT '系列对应的课程',
  `series_price` varchar(20) COMMENT '系列价格',
  `series_status` tinyint(1) COMMENT '状态 0 未发布，1 更新中，2 已完结',
  `series_category` bigint(20) COMMENT '系列分类',
  `series_addtime` varchar(20) COMMENT '添加时间',
  `series_teacher` longtext COMMENT '主讲老师',
  PRIMARY KEY (`series_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT '课程系列表';
-- 小课表
DROP TABLE IF EXISTS `sdjy_course`;
CREATE TABLE `sdjy_course` (
  `course_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `course_title` varchar(255) NOT NULL COMMENT '标题',
  -- `course_isseries` tinyint(1) COMMENT '是否是系列课程',
  `course_isfree` tinyint(1) COMMENT '是否是试看课程',
  `course_type` tinyint(1) COMMENT '课程类型 0 图文 1 视频',
  `course_video` varchar(500) COMMENT '课程视频',
  `course_content` longtext COMMENT '图文课程内容',
  `course_pics` varchar(500) COMMENT '课程主图',
  `course_teacher` longtext COMMENT '主讲老师',
  `course_sort` int(20) DEFAULT 0 COMMENT '排序',
  `course_addtime` varchar(20) COMMENT '添加时间',
  `course_status` tinyint(1) COMMENT '课程状态 上架，下架等',
  PRIMARY KEY (`course_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT '小课表';
-- 班级表
DROP TABLE IF EXISTS `sdjy_classes`;
CREATE TABLE `sdjy_classes` (
  `class_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `class_name` varchar(255) NOT NULL,
  `class_content` longtext,
  `class_seriesids` longtext,
  `class_studentids` longtext,
  `class_starttime` varchar(20) COMMENT '开班时间,无 代表永久开班',
  `class_endtime` varchar(20) COMMENT '结班时间,有 代表这个时间后就结束班级了',
  PRIMARY KEY (`class_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT '班级表';
-- 标签表
DROP TABLE IF EXISTS `sdjy_tag`;
CREATE TABLE `sdjy_tag` (
  `tag_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tag_name` VARCHAR(120),
  PRIMARY KEY (`tag_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT '标签表';
-- 系列课程标签表
DROP TABLE IF EXISTS `sdjy_tag_series_class`;
CREATE TABLE `sdjy_tag_series_class` (
  `tc_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tag_id` bigint(20) unsigned NOT NULL,
  `series_id` bigint(20),
  `class_id` bigint(20),
  PRIMARY KEY (`tc_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT '系列课程标签表';
-- 学员表
DROP TABLE IF EXISTS `sdjy_student`;
CREATE TABLE `sdjy_student` (
  `student_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `student_login` VARCHAR(120),
  `student_openid` VARCHAR(120),
  `student_wxmeta` longtext,
  `student_password` VARCHAR(255),
  `student_addtime` VARCHAR(20),
  `student_wx_signature` VARCHAR(50),
  `student_wx_rawData` longtext,
  PRIMARY KEY (`student_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT '学员表';
-- 学生班级表
DROP TABLE IF EXISTS `sdjy_class_student`;
CREATE TABLE `sdjy_class_student` (
  `cs_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `class_id` bigint(20) unsigned NOT NULL,
  `student_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`cs_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT '学生班级表';

-- 管理员表
DROP TABLE IF EXISTS `sdjy_manager`;
CREATE TABLE `sdjy_manager` (
  `manager_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `manager_login` varchar(255) NOT NULL,
  `manager_emial` varchar(255) NOT NULL,
  `manager_pass` varchar(255) NOT NULL,
  `manager_avatar` varchar(255),
  `manager_nickname` varchar(255),
  PRIMARY KEY (`manager_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT '管理员表';

-- 管理员操作日志表
DROP TABLE IF EXISTS `sdjy_managerlog`;
CREATE TABLE `sdjy_managerlog` (
  `ml_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `manager_id` bigint(20) NOT NULL,
  `ml_type` int(10) NOT NULL DEFAULT 1 COMMENT '1 登录日志',
  `ml_time` varchar(20),
  `ml_message` longtext,
  PRIMARY KEY (`ml_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT '管理员操作日志表';

-- 管理员 meta 表
DROP TABLE IF EXISTS `sdjy_managermeta`;
CREATE TABLE `sdjy_managermeta` (
  `managermeta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `manager_id` bigint(20) NOT NULL,
  `managermeta_name` varchar(255) NOT NULL,
  `managermeta_value` varchar(255),
  PRIMARY KEY (`managermeta_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT '管理员 meta 表';

DROP TABLE IF EXISTS `sdjy_banner`;
CREATE TABLE `sdjy_banner` (
  `banner_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `banner_title` varchar(255),
  `banner_url` varchar(255),
  `banner_sort` varchar(20),
  `addtime` varchar(20),
  PRIMARY KEY (`banner_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT '轮播图片';

DROP TABLE IF EXISTS `sdjy_posts`;
CREATE TABLE `sdjy_posts` (
  `posts_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `posts_type` tinyint(1) DEFAULT 0 COMMENT '0 默认文章,1 页面,3 关于我们',
  `posts_cate` varchar(255) COMMENT '文章分类',
  `posts_title` varchar(255) COMMENT '文章标题',
  `posts_content` longtext,
  `posts_addtime` varchar(20),
  `posts_editime` varchar(20),
  PRIMARY KEY (`posts_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT '文章';
