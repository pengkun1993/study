<?php 
/*
 * 留言模型
 * Auth   : 逸风
 * Time   : 1465196857 
 * QQ     : 912524639
 * Email  : 912524639@qq.com
 * Site   : http://guanblog.sinaapp.com/
 */
 
namespace Admin\Model;
use Think\Model;

class MessageModel extends Model{
	
    /*模型中定义的表*/
	protected $tableName = 'message'; 

    /* 自动验证规则 */
	protected $_validate = array(		array('eamil','email','&quot;请输入正确的电子邮箱&quot;'),
array('email','require','&quot;请输入正确的电子邮箱&quot;'),

		array('message','require','&quot;请输入留言信息'),

 
	);

    /* 自动完成规则 */
	protected $_auto = array(
     
	);

}