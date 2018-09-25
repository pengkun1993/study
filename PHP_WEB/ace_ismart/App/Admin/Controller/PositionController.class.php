<?php 
/*
 * 招聘职位控制器
 * Auth   : 逸风
 * Time   : 2016年06月06日 
 * QQ     : 912524639
 * Email  : 912524639@qq.com
 * Site   : http://guanblog.sinaapp.com/
 */
 
namespace Admin\Controller;

class PositionController extends AdminCoreController {
	
	//系统默认模型
	private $Model = null;

    protected function _initialize() {
		//继承初始化方法
		parent::_initialize ();
		//设置控制器默认模型
        $this->Model = D('Position');
    }
	
    /* 列表(默认首页)
     * Auth   : 逸风
     * Time   : 2016年06月06日 
     **/
	public function index(){
		if (IS_POST) {
			$post_data = I ( 'post.' );
			$post_data ['first'] = $post_data ['rows'] * ($post_data ['page'] - 1);
			$map = array ();
        	$map = $this->_search();
			$total = $this->Model->where ( $map )->count ();
			if ($total == 0) {
				$_list = '';
			} else {
				$_list = $this->Model->where ( $map )->order ( $post_data ['sort'] . ' ' . $post_data ['order'] )->limit ( $post_data ['first'] . ',' . $post_data ['rows'] )->select ();
			}
			$data = array (
					'total' => $total,
					'rows' => $_list 
			);
			$this->ajaxReturn ( $data );
		} else {
        	$this->meta_title = '模型列表';
			$this->display ();
		}
	}
	
    /* 搜索
     * Auth   : 逸风
     * Time   : 2016年06月06日 
     **/
	protected function _search() {
		$map = array ();
		$post_data=I('post.');
		/* 名称：职位名称 字段：name 类型：string*/
		if($post_data['s_name']!=''){
			$map['name']=array('like', '%'.$post_data['s_name'].'%');
		}
		/* 名称：工作地点 字段：place 类型：string*/
		if($post_data['s_place']!=''){
			$map['place']=array('like', '%'.$post_data['s_place'].'%');
		}
		/* 名称：招聘人数 字段：number 类型：num*/
		if($post_data['s_number']!=''){
			$map['number']=$post_data['s_number'];
		}
		/* 名称：薪资待遇 字段：salary 类型：string*/
		if($post_data['s_salary']!=''){
			$map['salary']=array('like', '%'.$post_data['s_salary'].'%');
		}
		/* 名称：发布日期 字段：publicdate 类型：datetime*/
		if($post_data['s_publicdate_min']!=''){
			$map['publicdate'][]=array('gt',strtotime($post_data['s_publicdate_min']));
		}
		if($post_data['s_publicdate_max']!=''){
			$map['publicdate'][]=array('lt',strtotime($post_data['s_publicdate_max']));
		}
		/* 名称：结束日期 字段：enddate 类型：datetime*/
		if($post_data['s_enddate_min']!=''){
			$map['enddate'][]=array('gt',strtotime($post_data['s_enddate_min']));
		}
		if($post_data['s_enddate_max']!=''){
			$map['enddate'][]=array('lt',strtotime($post_data['s_enddate_max']));
		}
		/* 名称：工作内容 字段：content 类型：editor*/
		if($post_data['s_content']!=''){
			$map['content']=$post_data['s_content'];
		}
		/* 名称：岗位要求 字段：request 类型：editor*/
		if($post_data['s_request']!=''){
			$map['request']=$post_data['s_request'];
		}
		/* 名称：状态 字段：state 类型：select*/
		if($post_data['s_state']!=''){
			$map['state']=$post_data['s_state'];
		}
		return $map;
	}
    
    /* 添加
     * Auth   : 逸风
     * Time   : 2016年06月06日 
     **/
	public function add(){
		if(IS_POST){
			$post_data=I('post.');
 
			$data=$this->Model->create($post_data);
			if($data){
				$result = $this->Model->add($data);
				if($result){
					action_log('Add_Position', 'Position', $result);
					$this->success ( "操作成功！",U('index'));
				}else{
					$error = $this->Model->getError();
					$this->error($error ? $error : "操作失败！");
				}
			}else{
                $error = $this->Model->getError();
                $this->error($error ? $error : "操作失败！");
			}
		}else{
        	$this->display();
		}
	}
	
    /* 编辑
     * Auth   : 逸风
     * Time   : 2016年06月06日 
     **/
	public function edit(){
		if(IS_POST){
			$post_data=I('post.');
 
			$data=$this->Model->create($post_data);
			if($data){
				$result = $this->Model->where(array('id'=>$post_data['id']))->save($data);
				if($result){
					action_log('Edit_Position', 'Position', $post_data['id']);
					$this->success ( "操作成功！",U('index'));
				}else{
					$error = $this->Model->getError();
					$this->error($error ? $error : "操作失败！");
				}
			}else{
                $error = $this->Model->getError();
                $this->error($error ? $error : "操作失败！");
			}
		}else{
			$_info=I('get.');
			$_info = $this->Model->where(array('id'=>$_info['id']))->find();
			$this->assign('_info', $_info);
        	$this->display();
		}
	}
	
    /* 删除
     * Auth   : 逸风
     * Time   : 2016年06月06日 
     **/
	public function del(){
		$id=I('get.id');
		empty($id)&&$this->error('参数不能为空！');
		$res=$this->Model->delete($id);
		if(!$res){
			$this->error($this->Model->getError());
		}else{
			action_log('Del_Position', 'Position', $id);
			$this->success('删除成功！');
		}
	}
}