<?php
	namespace Home\Model;
	use Think\Model;
	/**
	* 用户数据模型
	*/
	class UserModel extends Model
	{
		protected $patchValidate = true;
		protected $_validate=array(
			array('username','require','用户名不能为空'),
			array('password','5,18','密码长度为5到18位',1,'length'),
			array('password2','password','两次输入的密码不一致',1,'confirm'),
			array('user_email','require','邮箱不能为空'),
			array('user_email','email','邮箱格式不正确'),
			array('user_qq','/^[1-9]\d{4,9}$/','qq格式不正确',2),
			array('user_tel','require','请输入手机号码'),
			array('user_tel','/^[1]\d{10}$/','手机格式不正确',1),
			array('user_xueli','2,3,4,5','请选择学历',1,'in'),
			array('user_hobby','check_hobby','请至少选择一项爱好',1,'callback')
			);
		//验证爱好最少存在一个
		function check_hobby($name){
		if(!empty($name)&&count($name)>=1){
			return true;
		}else{
			return false;
		}
	}
	}
 ?>