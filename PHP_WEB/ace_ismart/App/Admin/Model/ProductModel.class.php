<?php 
/*
 * 产品与服务模型
 * Auth   : 逸风
 * Time   : 1465196120 
 * QQ     : 912524639
 * Email  : 912524639@qq.com
 * Site   : http://guanblog.sinaapp.com/
 */
 
namespace Admin\Model;
use Think\Model;

class ProductModel extends Model{
	
    /*模型中定义的表*/
	protected $tableName = 'product'; 

    /* 自动验证规则 */
	protected $_validate = array(		array('title','require','标题必须输入'),

 
	);

    /* 自动完成规则 */
	protected $_auto = array(
    		array("pubtime","strtotime",3,"function"),
     
	);

}