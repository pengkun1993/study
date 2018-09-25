<?php

function Is_Auth($Auth_Rule){
	$Auth = new \Common\Libs\Auth();
	$AUTH_KEY=session(C('AUTH_KEY'));
	//判断当前认证key是否不在 超级管理组配置中,或者当前模块是否为非认证模块
	if (! is_admin($AUTH_KEY) && ! in_array ( CONTROLLER_NAME, explode ( ",", C ( "NOT_AUTH_MODULE" ) ) )) {
		//当前权限表达式
		$Auth_Rule = MODULE_NAME . '/' . CONTROLLER_NAME . '/' . ACTION_NAME;
		if (! $Auth->check ($Auth_Rule,$AUTH_KEY)) {
			return false;
		}else{
			return true;
		}
	}else{
		return true;
	}
}
/**
 * 格式化字节大小
 * @param  number $size      字节数
 * @param  string $delimiter 数字和单位分隔符
 * @return string            格式化后的带单位的大小
 * @author 逸风 <zhangtao@ismart-teh.cn>
 */
function format_bytes($size, $delimiter = '') {
    $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
    for ($i = 0; $size >= 1024 && $i < 5; $i++) $size /= 1024;
    return round($size, 2) . $delimiter . $units[$i];
}