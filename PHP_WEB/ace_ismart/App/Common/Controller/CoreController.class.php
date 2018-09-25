<?php

namespace Common\Controller;
use Think\Controller;

class CoreController extends Controller {
	
	//全局用户信息
	public $UserInfo;
	
	/**
	 * 后台控制器初始化
	 */
	protected function _initialize() {
		
		/*读取系统配置*/
		$config = S ( 'DB_CONFIG_DATA' );
		if (! $config) {
			$config = S ( 'DB_CONFIG_DATA' );
		}
		C ( $config );
		
		/*如果有用户登录，读取用户信息*/
		if (session ( C ( 'AUTH_KEY' ) ) > 0) {
			$this->UserInfo = session ( 'UserInfo' );
			$this->assign ( 'UserInfo', $this->UserInfo );
		}
	}
	
}