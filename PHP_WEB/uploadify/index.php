<?php
//ini_set('session.use_trans_sid', 0);
//系统当前时间
define('SYS_TIME', time());
define('SITE_DIR', dirname(__FILE__));              // 站点目录
define('SITE_URL','http://localhost/uploadify/');
define('PIC_URL','http://localhost/uploadify/');
define('APP_NAME', 'App');                          // 定义项目名称
define('APP_PATH', SITE_DIR.'/App/');               // 定义项目路径
define('APP_DEBUG', true);                          // 开启DEBUG
define('THINK_PATH', SITE_DIR.'/ThinkPHP/');   // 定义ThinkPHP框架路径
//define('ENGINE_NAME','cluster');                    // 使用云引擎
require(THINK_PATH."ThinkPHP.php");                 // 加载框架入口文件