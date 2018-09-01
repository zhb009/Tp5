<?php
	/* 客户端的访问信息写入数据库 */
	
	$clientAddr = $_SERVER['REMOTE_ADDR'];  	// 浏览当前页面的用户的 IP 地址
	$clientPost = $_SERVER['REMOTE_PORT']; 		// 用户机器上连接到 Web 服务器所使用的端口号
	$HTTP_REFERER = empty($_SERVER['HTTP_REFERER'])? '' : $_SERVER['HTTP_REFERER'];   // 引导用户代理到当前页的前一页的地址
	$HTTP_USER_AGENT = $_SERVER['HTTP_USER_AGENT'];  // 获取浏览器信息	
	
	$date = date('Y-m-d H:i:s');
	
	$db = @new mysqli('101.201.223.38','root','zhb24379442');
	if ($db -> connect_error) {
	    exit;
	}
	$db -> select_db('pagedb');
	$db -> query('set names utf8');
	$strSql = "insert into access_info values(NULL,'beijing','{$clientAddr}', {$clientPost}, '{$HTTP_REFERER}', '{$HTTP_USER_AGENT}', '1','{$date}')";
	$db -> query($strSql);
	$db -> close();
	
	/*
	CREATE TABLE `access_info` (
		`id` INT(32) UNSIGNED NOT NULL AUTO_INCREMENT,
		`node` CHAR(10) NOT NULL DEFAULT '' COMMENT '服务器地域节点',
		`addr` CHAR(32) NOT NULL DEFAULT '' COMMENT '访问用户的IP地址',
		`post` INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '用户机器上连接到 Web 服务器所使用的端口号',
		`referer` CHAR(255) NOT NULL DEFAULT '' COMMENT '引导用户代理到当前页的前一页的地址',
		`agent` CHAR(255) NOT NULL DEFAULT '' COMMENT '浏览器信息',
		`mobile` TINYINT(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT '1是PC访问，2是手机访问。',
		`time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
		PRIMARY KEY (`id`)
	)
	COLLATE='utf8_general_ci'
	ENGINE=MyISAM DEFAULT CHARSET=utf8
	PARTITION BY HASH (id)
	PARTITIONS 10
	*/
?>
