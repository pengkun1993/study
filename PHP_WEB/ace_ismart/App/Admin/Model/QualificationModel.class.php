<?php 
/*
 * 企业资质模型
 * Auth   : 逸风
 * Time   : 1465196904 
 * QQ     : 912524639
 * Email  : 912524639@qq.com
 * Site   : http://guanblog.sinaapp.com/
 */
 
namespace Admin\Model;
use Think\Model;

class QualificationModel extends Model{
	
    /*模型中定义的表*/
	protected $tableName = 'qualification'; 

    /* 自动验证规则 */
	protected $_validate = array(		array('title','require','请输入标题'),

		array('state','require','请选择状态信息'),

 
	);

    /* 自动完成规则 */
	protected $_auto = array(
     
	);

}