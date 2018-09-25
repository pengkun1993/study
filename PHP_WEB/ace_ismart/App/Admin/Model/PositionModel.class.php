<?php 
/*
 * 招聘职位模型
 * Auth   : 逸风
 * Time   : 1465196912 
 * QQ     : 912524639
 * Email  : 912524639@qq.com
 * Site   : http://guanblog.sinaapp.com/
 */
 
namespace Admin\Model;
use Think\Model;

class PositionModel extends Model{
	
    /*模型中定义的表*/
	protected $tableName = 'position'; 

    /* 自动验证规则 */
	protected $_validate = array(		array('state','require','请输入状态信息'),

 
	);

    /* 自动完成规则 */
	protected $_auto = array(
    		array("publicdate","strtotime",3,"function"),
    		array("enddate","strtotime",3,"function"),
     
	);

}