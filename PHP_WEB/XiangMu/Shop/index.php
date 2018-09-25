<?php 
	// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');

//定义前台css、js、img、路径
define('SITE', 'http://shop.com/');
define('HOME_CSS', SITE.'home/public/css/');
define('HOME_JS',SITE.'home/public/js/');
define('HOME_IMG',SITE.'home/public/img/');
//定义后台css、js、img、路径
define('ADMIN_CSS', SITE.'Admin/public/css/');
define('ADMIN_JS',SITE.'Admin/public/js/');
define('ADMIN_IMG',SITE.'Admin/public/img/');

//定义上传目录
define('UPLOAD_PATH',SITE.'Uploads/');

// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',true);

// 引入ThinkPHP入口文件
require '../ThinkPHP/ThinkPHP.php';
 ?>