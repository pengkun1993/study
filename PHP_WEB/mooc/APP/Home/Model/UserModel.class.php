<?php
	namespace Home\Model;
	use Think\Model;
	class UserModel extends CommonModel{   //实例化用户自己的模型，user是表名
		protected $_scope=array(
		/*'命名范围的标识名'=>array(
			'属性'=>'值',
		支持的范围有where limit field order table page having group distinct
		)*/
		'jige'=>array(
				'where'=>array(
					'score'=>array('egt',60),
				),
				'order'=>'user_id desc',
				'limit'=>10,
			),
		'ziduan'=>array(
				'field'=>'nick_name',
				'limit'=>5,//后面的可以覆盖前面的
			),
		);
	}
?>