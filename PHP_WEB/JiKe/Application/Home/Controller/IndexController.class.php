<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
	public function _before_index()//前置操作先执行
	{
		echo "before <br/>";
	}
    public function index(){
    	//echo "index <br/>"; 
    	$this->listActionsUrl();   
    }
    public function _after_index()//后置操作随后执行
    {
    	echo "after <br/>";
    }
    public function listAction(){//系统占用的字符串，定义提示错误，可通过用定义前缀的方法实现，config中
    	echo 'list';
    }
    private function listActionsUrl()
    {
    	echo "当前的URL模式为：".C('URL_MODEL');
    	echo "<hr/>";
    	echo "User控制器的index操作方法的URL为：<a href=\"".U('Home/User/index')."\">".U('Home/User/index')."</a>";
    	echo "<hr/>";
    	echo "User控制器的edit操作方法的URL为：<a href=\"".U('Home/User/edit')."\">".U('Home/User/edit')."</a>";
    	echo "<hr/>";
    	echo "User控制器的login操作方法的URL为：<a href=\"".U('Home/User/login')."\">".U('Home/User/login')."</a>";
    	echo "<hr/>";
    }
}