<?php
return array(
	//'配置项'=>'配置值'
	'DB_TYPE'=>'mysql',//数据类型
	'DB_HOST'=>'localhost',//'DB_HOST'=>'localhost,localhost1,localhost2',//数据服务器地址,写多个是有主从服务器,这里只做演示没有多个服务器故不使用
	'DB_NAME'=>'muke',//数据库名
	'DB_USER'=>'root',//数据库用户名
	'DB_PWD'=>'782041',//数据库用户密码
	'DB_PORT'=>'3306',//数据库端口号
	'DB_PREFIX'=>'mk_',//数据库表前缀
	//开启主从读写分离
	//'DB_RW_SEPARATE'=>true,
	//多个主数据库服务器
	//'DB_MASTER_NUM'=>'2',
);