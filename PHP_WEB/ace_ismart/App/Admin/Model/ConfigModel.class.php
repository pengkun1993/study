<?php 
/*
 * 配置管理模型
 * Auth   : 逸风
 * Time   : 2016年01月13日 
 * QQ     : 419204836
 * Email  : zhangtao@ismart-tech.cn
 * Site   : http://www.ismart-tech.cn/
 */
 
namespace Admin\Model;
use Think\Model;

class ConfigModel extends Model{

    /* 自动验证规则 */
	protected $_validate = array( 
	);

    /* 自动完成规则 */
	protected $_auto = array( 
	);

	public function cache(){
		S('DB_CONFIG_DATA',null);
		$config = $this->getField ( 'name,value' );
		S('DB_CONFIG_DATA', $config);
	}
}