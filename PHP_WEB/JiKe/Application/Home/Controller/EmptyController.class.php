<?php 
	namespace Home\Controller;
	use Think\Controller;
	/**
	* 空控制器，当浏览器访问找不到的控制器是就会显示这个页面
	*/
	class EmptyController extends Controller
	{
		
		function _empty()
		{
			echo "访问的控制器不存在";
		}
	}
 ?>