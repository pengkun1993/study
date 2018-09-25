<?php 
/*
 * 轮播图模型
 * Auth   : 逸风
 * Time   : 1465196049 
 * QQ     : 912524639
 * Email  : 912524639@qq.com
 * Site   : http://guanblog.sinaapp.com/
 */
 
namespace Admin\Model;
use Think\Model;

class LunboModel extends Model{
	
    /*模型中定义的表*/
	protected $tableName = 'lunbo'; 

    /* 自动验证规则 */
	protected $_validate = array(		array('title','require','请输入轮播图标题'),

 
	);

    /* 自动完成规则 */
	protected $_auto = array(
     
	);

}