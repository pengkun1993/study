<?php 
/*
 * 插件模型
 * Auth   : 逸风
 * Time   : 1465196926 
 * QQ     : 912524639
 * Email  : 912524639@qq.com
 * Site   : http://guanblog.sinaapp.com/
 */
 
namespace Admin\Model;
use Think\Model;

class AddonsModel extends Model{
	
    /*模型中定义的表*/
	protected $tableName = 'addons'; 

    /* 自动验证规则 */
	protected $_validate = array( 
	);

    /* 自动完成规则 */
	protected $_auto = array(
    		array("create_time","strtotime",3,"function"),
     
	);

}