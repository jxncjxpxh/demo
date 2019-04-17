CREATE TABLE if NOT EXISTS `su_adlog_--tablenamedate--` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`softtype` VARCHAR(50) NULL DEFAULT NULL COMMENT '所属产品类型',
	`softcode` INT(11) NULL DEFAULT '0' COMMENT '所属产品标识',
	`mac` VARCHAR(50) NULL DEFAULT NULL COMMENT '计算机唯一标识码',
	`channel` VARCHAR(50) NULL DEFAULT NULL COMMENT '渠道号',
	`softver` VARCHAR(20) NULL DEFAULT NULL COMMENT '软件版本号',
	`sysver` VARCHAR(20) NULL DEFAULT NULL COMMENT '计算机系统版本',
	`dtime` VARCHAR(14) NULL DEFAULT NULL COMMENT '数据上传时间',
	`ctime` VARCHAR(14) NULL DEFAULT NULL COMMENT '数据上传服务器时间',
	`bit` VARCHAR(5) NULL DEFAULT NULL COMMENT '系统位数',
	`signature` VARCHAR(50) NULL DEFAULT NULL COMMENT '数据校验字符串',
	`stype` VARCHAR(50) NULL DEFAULT NULL COMMENT '执行操作类型(open,click,hideLately,close)',
	`adid` INT(10) NOT NULL DEFAULT '0' COMMENT '广告id',
	`duration` INT(11) NOT NULL DEFAULT '0' COMMENT '广告存活时间',
	`datajson` TEXT NULL DEFAULT NULL COMMENT '数据信息',
	`uuid` VARCHAR(50) NULL DEFAULT NULL COMMENT '保存程序生成的一个GUID值',
	`caller` VARCHAR(256) NOT NULL DEFAULT '' COMMENT '弹窗程序由谁调用起来的',
	`userkey` VARCHAR(50) NULL DEFAULT NULL COMMENT '客户端标识',
	`flag` TINYINT(4) NOT NULL DEFAULT '1' COMMENT '数据标记1 正常 2伪造数据',
	`addtime` INT(11) NULL DEFAULT NULL,
	`adddate` INT(8) NOT NULL DEFAULT '0',	
	PRIMARY KEY (`id`, `adddate`),
	INDEX `channel` (`channel`),
	INDEX `softver` (`softver`),
	INDEX `stype` (`stype`),
	INDEX `flag` (`flag`),
	INDEX `mac` (`mac`),
	INDEX `uuid` (`uuid`),
	INDEX `addtime` (`addtime`)
)
COMMENT='广告弹出模块日志上报'
COLLATE='utf8_general_ci'