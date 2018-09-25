<?php
	namespace Home\Model;
	use Think\Model;
	Class UserModel extends Model{
	//字段映射,写在这里才生效
    protected $_map=array(
            'zhanghao'=>'username',
            'word'=>'password',
            'youjian'=>'email',
            'zhuangtai'=>'status',
            'zhuceshijian'=>'create_time',
            'bianhao'=>'id'
        );
		//查询条件的三种定义方式
		public function sql_1(){
			//字符串
			$conditionString='status=1 OR is_vip=1';
			//数组
			$conditionArray=array(
					'status'=>1,
					'is_vip'=>1,
					'_logic'=>'or'
				);
			//对象
			$conditionClass=new \stdClass();
			$conditionClass->status=1;
			$conditionClass->is_vip=1;
		}
		//表达式查询
		public function sql_2(){
			$condition=array(
					'username'=>array('eq','tom'),
					'email'=>array('like','%jike%'),
					'score'=>array('egt',1000),
					'age'=>array('between','20,35'),
					'id'=>array('not in','1,5,99'),
					//表达式支持SQL语法查询
					'score'=>array('exp'=>'score+2')
				);
		}
		//快捷查询
		public function sql_3(){
			$condition=array(
				'username|email|mobile'=>I('post.account'),
				'password'=>md5(I('post.password')) 	
				);
		}
		//区间查询
		public function sql_4()
		{
			$condition=array(
					'age'=>array(
							array('egt',18),
							array('elt',35)
						)
					/*'score'=>array(
							array('elt',99),
							array('egt',1000),
							'or'
						)*/
				);
		}
		//组合查询
		public function sql_5(){
			$subCondition=array(
					'status'=>1,
					'age'=>array('gt',18),
					'_logic'=>'and'
				);
			$condition=array(
					'_string'=>'status=1 AND age>18',
					'_query'=>'status=1&age>18&_logic=and',
					'_complex'=>$subCondition
				);
		}
		//统计查询
		public function sql_6(){
			$this->count();
			$this->max('age');
			$this->min('age');
			$this->avg('age');
			$this->sum('age');
		}
		//sql查询
		public function sql_7(){
			M()->query('select * form jike_user where status=1');
			M()->excute("update jike_user set status=0 where id=1");
		}
		//动态查询
		public  function sql_8(){
			$this->getFeildByUsername('linda','email');//获取username等于linda的记录里面的email字段
			$this->getByUsername('linda');//获取uesrname等于linda的这条查询记录
		}
		//命名范围，合并条件
		protected $_scope=array(
				'latest'=>array(
						'order'=>'create_time desc',
						'limit'=>10
					),
				'vip'=>array(
						'where'=>array(
								'is_vip'=>1
							)
					)
			);
		//获取最近注册的10个用户
		public function getLatestUsers(){
			//$result=$this->order('create_time desc')->limit(10)->select();
			$result=$this->scope('latest')->select();
			return $result;
		}
		//获取最近注册的10个vip用户
		public function getLatestVipUsers(){
			/*$condition=array(
					'is_vip'=>1
				);*/
			$result=$this->scope('latest,vip',array('limit'=>20))->select();//可在这里中途改值
			return $result;
		}
		//获取10个VIP用户，要求2015年1月1日之前注册，并且按照积分score从高到低排序
		public function getLatestVipUser(){
			/*$condition=array(
					'is_vip'=>1
				);*/
			$result=$this
			->order('score desc')
			->where('create_time<'.strtotime('2015-1-1'))
			->scope('vip,latest')
			->select();
			return $result;
		}
	}
?>