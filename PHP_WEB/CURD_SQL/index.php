<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用入口文件
/*测试
$module=isset($_GET['m'])?$_GET['m']:'index';
$action=isset($_GET['c'])?$_GET['c']:'index';
$mooc=new $module();
$mooc->$action();
class index{
	function __construct(){
		echo '调用了index控制器<br/>';
	}
	function index(){
		echo "调用了index控制器的index方法<br/>";
	}
	function test(){
		echo "调用了index控制器的test方法";
	}
}*/
// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');

// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',true);
//定义项目名称
define('APP_NAME', 'APP');
// 定义应用目录
define('APP_PATH','./APP/');

// 引入ThinkPHP入口文件
require './ThinkPHP/ThinkPHP.php';

// 亲^_^ 后面不需要任何代码了 就是如此简单