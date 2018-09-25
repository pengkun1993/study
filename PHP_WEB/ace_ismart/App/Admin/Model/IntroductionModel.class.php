<?php 
/*
 * 公司简介模型
 * Auth   : 逸风
 * Time   : 1465196893 
 * QQ     : 912524639
 * Email  : 912524639@qq.com
 * Site   : http://guanblog.sinaapp.com/
 */
 
namespace Admin\Model;
use Think\Model;

class IntroductionModel extends Model{
	
    /*模型中定义的表*/
	protected $tableName = 'introduction'; 

    /* 自动验证规则 */
	protected $_validate = array(		array('content','require','必须填写文字内容'),

		array('state','require','必须设置状态且只有一个为可用'),

 
	);

    /* 自动完成规则 */
	protected $_auto = array(
     
	);

}