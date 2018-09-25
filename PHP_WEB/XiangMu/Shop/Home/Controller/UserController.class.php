<?php
	namespace Home\Controller;
	use Think\Controller;
	/**
	* 用户控制表
	*/
	class UserController extends Controller
	{
		function login()
		{
			if(IS_POST){
				$user=D('user');
				//触发自动验证
				/*$b=$user->create();
				if($b){*/
					$where['username']=$_POST['username'];
					$where['password']=$_POST['password'];
					$b=$user->where($where)->select();
					if(!empty($b)){
						echo "success";
					}else{
						echo "failure";
					}
				/*}else{
					$error_data=$user->geterror();
					$this ->assign('error_data',$error_data);
				}*/
			}else{
			$this->display();
			}
		}
		function register()
		{
			$user=D('user');
			if(IS_POST){
				//触发自动验证
				$b=$user->create();
				if(!$b){
					//获取用户输入旧的数据
					$old_data=$_POST;
					$this ->assign('old_data',$old_data);
					//获取错误提示信息
					$data_error=$user->getError();
					$this ->assign('error_data',$data_error);
				}else{
					//将user_hobby数组转换为用逗号隔开的字符串，便于录入数据库
					$user->user_hobby=implode(',',$_POST['user_hobby']);
					//存在create方法的情况下用add可直接添加进数据库
					$b1=$user->add();
					if($b1){
						$this->success('注册成功',U('index/index'));
					}else{
						$this->error('注册失败',U('index/index'));
					}
				}
			}
			$this->display();
		}
		function _empty(){
			echo "非法操作";
		}
	}
 ?>