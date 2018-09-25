<?php 
/*
 * 发展历程模型
 * Auth   : 逸风
 * Time   : 1465196899 
 * QQ     : 912524639
 * Email  : 912524639@qq.com
 * Site   : http://guanblog.sinaapp.com/
 */
 
namespace Admin\Model;
use Think\Model;

class HistroyModel extends Model{
	
    /*模型中定义的表*/
	protected $tableName = 'histroy'; 

    /* 自动验证规则 */
	protected $_validate = array(		array('year','require','请输入年份'),

		array('state','require','请选择状态'),

 
	);

    /* 自动完成规则 */
	protected $_auto = array(
     
	);

}