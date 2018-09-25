<?php
	namespace Home\Controller;
	use Think\Controller;
	/**
	* 货物处理控制器
	*/
	class GoodsController extends Controller
	{
		//商品列表
			function showList()
			{
				$goods=D('goods');
				$data=$goods->select();
				$this ->assign('data',$data);
				$this->display();
			}
		//商品详情
			function detail(){
				$this->display();
			}
	}
 ?>