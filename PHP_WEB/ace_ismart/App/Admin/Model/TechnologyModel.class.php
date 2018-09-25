<?php 
/*
 * 核心技术模型
 * Auth   : 逸风
 * Time   : 1465196293 
 * QQ     : 912524639
 * Email  : 912524639@qq.com
 * Site   : http://guanblog.sinaapp.com/
 */
 
namespace Admin\Model;
use Think\Model;

class TechnologyModel extends Model{
	
    /*模型中定义的表*/
	protected $tableName = 'technology'; 

    /* 自动验证规则 */
	protected $_validate = array(		array('title','require','&quot;标题必须输入&quot;'),

		array('head_pic','require','头图必须插入'),

 
	);

    /* 自动完成规则 */
	protected $_auto = array(
     
	);

}