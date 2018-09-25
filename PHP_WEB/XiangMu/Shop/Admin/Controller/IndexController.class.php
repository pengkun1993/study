<?php 
	namespace Admin\Controller;
	use Admin\Controller\CommonController;
	/**
	* 后台主控制器
	*/
	class IndexController extends CommonController
	{
		public function index()
		{
			//获取当前系统给定义的常量
			/*$data=get_defined_constants('user')['user'];
			dump($data);*/
			$this->display();
		}
		public function head()
		{
			$this->display();
		}
		public function left()
		{
			//获取角色id
			$sql = "select * from sw_manager where mg_id=".session('mg_id');
			$res1=M()->query($sql);
			//获取权限列表
			if($res1[0]['mg_role_id']==0){
				$res0=M('auth')->where('auth_level=0')->select();
				$res1=M('auth')->where('auth_level=1')->select();
				$this ->assign('res0',$res0);
				$this ->assign('res1',$res1);
			}else{
				$res2=M('role')->where('role_id='.$res1[0]['mg_role_id'])->find();
				$where3['auth_id']=array('in',$res2['role_auth_ids']);
				$where3['auth_level']=array('eq',0);
				$res3=M('auth')->where($where3)->select();
				$where4['auth_id']=array('in',$res2['role_auth_ids']);
				$where4['auth_level']=array('eq',1);
				$res4=M('auth')->where($where4)->select();
				$this ->assign('res0',$res3);
				$this ->assign('res1',$res4);
			}
			$this->display();
		}
		public function right()
		{
			$this->display();
		}
	}
 ?>