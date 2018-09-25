<?php 
	namespace Home\Controller;
	use Think\Controller;
	/**
	* 
	*/
	class UserController extends Controller
	{
		
		public function index()
		{
			//echo "user控制器的index方法";
			//$this->ajaxReturn(getTestData(),'xml');
			$server=I('server.HTTP_HOST');
			dump($server);
		}

		public function edit()
		{
			$user=I('get.user',null);
			if($user==='jike'){
				$this->success('您好即可',U('User/index'),3);
			}else{
				$this->error('您不是即可',U('User/login'),3);
			}
		}
		public function login()
		{
			echo "user控制器的login方法";
		}
	}
?>