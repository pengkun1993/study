<?php
	namespace Admin\Model;
	use Think\Model;
	/**
	* 管理员类
	*/
	class ManagerModel extends Model
	{
		//用户登录验证
		function checkUser($username,$password){
			//防注入，先查询是否有这条记录在核对密码是否正确
			$data=$this->getByMg_name($username);//getBy可查询单个条件的数据
			if($data&&$data['mg_pwd']==$password){
				return $data;
			}else{
				return false;
			}
		}
	}
 ?>