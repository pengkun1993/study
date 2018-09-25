<?php 
/*
 * 应聘者信息控制器
 * Auth   : 逸风
 * Time   : 2016年05月31日 
 * QQ     : 912524639
 * Email  : 912524639@qq.com
 * Site   : http://guanblog.sinaapp.com/
 */
 
namespace Admin\Controller;

class ApplicantController extends AdminCoreController {
	
	//系统默认模型
	private $Model = null;

    protected function _initialize() {
		//继承初始化方法
		parent::_initialize ();
		//设置控制器默认模型
        $this->Model = D('Applicant');
    }
	
    /* 列表(默认首页)
     * Auth   : 逸风
     * Time   : 2016年05月31日 
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
     * Time   : 2016年05月31日 
     **/
	protected function _search() {
		$map = array ();
		$post_data=I('post.');
		/* 名称：应聘职位 字段：position 类型：string*/
		if($post_data['s_position']!=''){
			$map['position']=array('like', '%'.$post_data['s_position'].'%');
		}
		/* 名称：姓名 字段：name 类型：string*/
		if($post_data['s_name']!=''){
			$map['name']=array('like', '%'.$post_data['s_name'].'%');
		}
		/* 名称：籍贯 字段：native 类型：string*/
		if($post_data['s_native']!=''){
			$map['native']=array('like', '%'.$post_data['s_native'].'%');
		}
		/* 名称：联系电话 字段：tel 类型：string*/
		if($post_data['s_tel']!=''){
			$map['tel']=array('like', '%'.$post_data['s_tel'].'%');
		}
		/* 名称：电子邮箱 字段：email 类型：string*/
		if($post_data['s_email']!=''){
			$map['email']=array('like', '%'.$post_data['s_email'].'%');
		}
		/* 名称：学历 字段：degree 类型：select*/
		if($post_data['s_degree']!=''){
			$map['degree']=$post_data['s_degree'];
		}
		/* 名称：专业 字段：major 类型：string*/
		if($post_data['s_major']!=''){
			$map['major']=array('like', '%'.$post_data['s_major'].'%');
		}
		/* 名称：学校 字段：school 类型：string*/
		if($post_data['s_school']!=''){
			$map['school']=array('like', '%'.$post_data['s_school'].'%');
		}
		/* 名称：通讯地址 字段：address 类型：string*/
		if($post_data['s_address']!=''){
			$map['address']=array('like', '%'.$post_data['s_address'].'%');
		}
		/* 名称：获奖经历 字段：awards 类型：textarea*/
		if($post_data['s_awards']!=''){
			$map['awards']=array('like', '%'.$post_data['s_awards'].'%');
		}
		/* 名称：工作经历 字段：work 类型：textarea*/
		if($post_data['s_work']!=''){
			$map['work']=array('like', '%'.$post_data['s_work'].'%');
		}
		/* 名称：个人简介 字段：introduce 类型：textarea*/
		if($post_data['s_introduce']!=''){
			$map['introduce']=array('like', '%'.$post_data['s_introduce'].'%');
		}
		return $map;
	}
    
    /* 添加
     * Auth   : 逸风
     * Time   : 2016年05月31日 
     **/
	public function add(){
		if(IS_POST){
			$post_data=I('post.');
 
			$data=$this->Model->create($post_data);
			if($data){
				$result = $this->Model->add($data);
				if($result){
					action_log('Add_Applicant', 'Applicant', $result);
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
     * Time   : 2016年05月31日 
     **/
	public function edit(){
		if(IS_POST){
			$post_data=I('post.');
 
			$data=$this->Model->create($post_data);
			if($data){
				$result = $this->Model->where(array('id'=>$post_data['id']))->save($data);
				if($result){
					action_log('Edit_Applicant', 'Applicant', $post_data['id']);
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
			$res=M('position')->where('state = 1 ')->field('id,name')->select();
			$this->assign('list',$res);
			$this->assign('_info', $_info);
        	$this->display();
		}
	}
	
    /* 删除
     * Auth   : 逸风
     * Time   : 2016年05月31日 
     **/
	public function del(){
		$id=I('get.id');
		empty($id)&&$this->error('参数不能为空！');
		$res=$this->Model->delete($id);
		if(!$res){
			$this->error($this->Model->getError());
		}else{
			action_log('Del_Applicant', 'Applicant', $id);
			$this->success('删除成功！');
		}
	}
}