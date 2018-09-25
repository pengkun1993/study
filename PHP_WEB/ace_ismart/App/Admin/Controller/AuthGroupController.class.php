<?php 
/*
 * 用户组控制器
 * Auth   : 逸风
 * Time   : 2016年06月06日 
 * QQ     : 912524639
 * Email  : 912524639@qq.com
 * Site   : http://guanblog.sinaapp.com/
 */
 
namespace Admin\Controller;

class AuthGroupController extends AdminCoreController {
	
	//系统默认模型
	private $Model = null;

    protected function _initialize() {
		//继承初始化方法
		parent::_initialize ();
		//设置控制器默认模型
        $this->Model = D('AuthGroup');
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
		/* 名称：用户组标题 字段：title 类型：string*/
		if($post_data['s_title']!=''){
			$map['title']=array('like', '%'.$post_data['s_title'].'%');
		}
		/* 名称：用户组状态 字段：status 类型：select*/
		if($post_data['s_status']!=''){
			$map['status']=$post_data['s_status'];
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
$post_data["rules"]=I("post.rules");$post_data["rules"]=implode(",",$post_data["rules"]); 
			$data=$this->Model->create($post_data);
			if($data){
				$result = $this->Model->add($data);
				if($result){
					action_log('Add_AuthGroup', 'AuthGroup', $result);
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
$post_data["rules"]=I("post.rules");$post_data["rules"]=implode(",",$post_data["rules"]); 
			$data=$this->Model->create($post_data);
			if($data){
				$result = $this->Model->where(array('id'=>$post_data['id']))->save($data);
				if($result){
					action_log('Edit_AuthGroup', 'AuthGroup', $post_data['id']);
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
			action_log('Del_AuthGroup', 'AuthGroup', $id);
			$this->success('删除成功！');
		}
	}
}