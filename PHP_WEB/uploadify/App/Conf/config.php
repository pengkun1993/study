<?php
return array( 
	'TMPL_L_DELIM'=>'<{',
	'TMPL_R_DELIM'=>'}>',
	 /* 日志设置 */
    'LOG_RECORD'            => true,   // 默认不记录日志
    'LOG_TYPE'              => 3, // 日志记录类型 0 系统 1 邮件 3 文件 4 SAPI 默认为文件方式
    'LOG_DEST'              => '', // 日志记录目标
    'LOG_EXTRA'             => '', // 日志记录额外信息
    'LOG_LEVEL'             => 'EMERG,ALERT,CRIT,ERR',// 允许记录的日志级别
    'LOG_FILE_SIZE'         => 2097152,	// 日志文件大小限制
    'LOG_EXCEPTION_RECORD'  => false,    // 是否记录异常信息日志
	 /* 模板引擎设置 */
    'TMPL_TEMPLATE_SUFFIX'  => '.html',     // 默认模板文件后缀
    'TMPL_FILE_DEPR'        =>  '/', //模板文件MODULE_NAME与ACTION_NAME之间的分割符
	//数据库配置信息
	'DB_TYPE'   => 'mysql', // 数据库类型
	'DB_HOST'   => 'localhost', // 服务器地址
	'DB_NAME'   => '', // 数据库名
	'DB_USER'   => '', // 用户名
	'DB_PWD'    => '', // 密码 
	'DB_PORT'   => 3306, // 端口
	'DB_PREFIX' => 'tbl_', // 数据库表前缀
	'TMPL_PARSE_STRING' => array(
		//'__PUBLIC__' => '', // 更改默认的/Public 替换规则  
		//'__PUBLIC__' => APP_PATH.'Public',
		//'__JS__' => '/Public/Admin/js/', // 增加新的JS类库路径替换规则      
		//'__CSS__' => '/Public/Admin/css/', // 增加新的上传路径替换规则 
		//'__IMAGES__'=>'Public/Admin/images/',
		//'__ORG__'=>'App/Lib/Org/',
		'__SITE_URL__' => 'http://localhost/uploadify',
		'__PIC_URL__' => 'http://localhost/uploadify',
	),
);
//end