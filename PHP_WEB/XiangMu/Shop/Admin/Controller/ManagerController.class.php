<?php
	namespace Admin\Controller;
	use Admin\Controller\CommonController;
	/**
	* 后台管理员控制器
	*/
	class ManagerController extends CommonController
	{
		function login()
		{
			if(IS_POST){
				$verify = new \Think\Verify();
				$b1=$verify->check($_POST['captcha']);
				if(!$b1){
					$error_message="验证码错误";
					$this ->assign('error_message',$error_message);
				}else{
					$manager=D('manager');
					$res=$manager->checkUser(I('post.admin_user'),I('post.admin_pwd'));
					if($res){
						session('mg_id',$res['mg_id']);
						session('mg_name',$res['mg_name']);
						$this->redirect('index/index');
					}else{
						$error_message="用户名或密码输入错误";
						$this ->assign('error_message',$error_message);
					}
				}
			}
			$this->display();
			
		}
		function logout(){
			session(null);
			$this->redirect('manager/login');
		}
		public function verifyImg()
		{	
			$config=array(
				'fontSize'=>14,
				'useCurve'=>false,
				'length'  =>4,
				'imageH'  =>28,
				'imageW'  =>100,
				'fontttf' =>'4.ttf',
				);
			$verify = new \Think\Verify($config);
			$verify->entry();
		}
		public function test()
		{
			echo "test";
		}
	}
 ?>