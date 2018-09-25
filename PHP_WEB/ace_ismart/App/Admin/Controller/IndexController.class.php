<?php

namespace Admin\Controller;

/**
 * 后台首页控制器
 */
class IndexController extends AdminCoreController {

    /**
     * 后台首页操作
     */
    public function index(){
		$this->display ();
    }
	
    /**
     * 控制台
     */
    public function main(){
		$this->display ();
    }

	
    /**
     * 更新缓存
     */
    public function cache(){
		//Todo:这里需要操作
		D('Config')->cache();
		D('Action')->cache();
		D('ActionLog')->cache();
		$this->success('缓存更新成功！',U('Admin/Index/Index'));
    }
}