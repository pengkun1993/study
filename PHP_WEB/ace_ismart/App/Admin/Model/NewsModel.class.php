<?php 
/*
 * 新闻模型
 * Auth   : 逸风
 * Time   : 1465196268 
 * QQ     : 912524639
 * Email  : 912524639@qq.com
 * Site   : http://guanblog.sinaapp.com/
 */
 
namespace Admin\Model;
use Think\Model;

class NewsModel extends Model{
	
    /*模型中定义的表*/
	protected $tableName = 'news'; 

    /* 自动验证规则 */
	protected $_validate = array(		array('title','require','标题不能为空'),
		array('status','require','请输入状态'),
 
	);

    /* 自动完成规则 */
	protected $_auto = array(
    		array("pubtime","strtotime",3,"function"),
     
	);

}