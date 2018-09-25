<?php 
/*
 * 应聘者信息模型
 * Auth   : 逸风
 * Time   : 1464678712 
 * QQ     : 912524639
 * Email  : 912524639@qq.com
 * Site   : http://guanblog.sinaapp.com/
 */
 
namespace Admin\Model;
use Think\Model;

class ApplicantModel extends Model{
	
    /*模型中定义的表*/
	protected $tableName = 'applicant'; 

    /* 自动验证规则 */
	protected $_validate = array(		array('native','require','请输入籍贯信息'),
		array('tel','/^1[0-9]\d{9}/','联系方式格式不正确'),
		array('birthday','checkBirthday','请输入合理的出生日期',0,'function',3),
		array('email','email','请输入正确的邮箱'),
 
	);

    /* 自动完成规则 */
	protected $_auto = array(
    		array("birthday","strtotime",3,"function"),
     
	);

}