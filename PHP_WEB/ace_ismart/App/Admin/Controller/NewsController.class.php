<?php 
/*
 * 新闻控制器
 * Auth   : 逸风
 * Time   : 2016年06月06日 
 * QQ     : 912524639
 * Email  : 912524639@qq.com
 * Site   : http://guanblog.sinaapp.com/
 */
 
namespace Admin\Controller;

class NewsController extends AdminCoreController {
	
	//系统默认模型
	private $Model = null;

    protected function _initialize() {
		//继承初始化方法
		parent::_initialize ();
		//设置控制器默认模型
        $this->Model = D('News');
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
		/* 名称：标题 字段：title 类型：string*/
		if($post_data['s_title']!=''){
			$map['title']=array('like', '%'.$post_data['s_title'].'%');
		}
		/* 名称：内容 字段：content 类型：editor*/
		if($post_data['s_content']!=''){
			$map['content']=$post_data['s_content'];
		}
		/* 名称：摘要 字段：abstract 类型：textarea*/
		if($post_data['s_abstract']!=''){
			$map['abstract']=array('like', '%'.$post_data['s_abstract'].'%');
		}
		/* 名称：关键词 字段：keywords 类型：string*/
		if($post_data['s_keywords']!=''){
			$map['keywords']=array('like', '%'.$post_data['s_keywords'].'%');
		}
		/* 名称：发布时间 字段：pubtime 类型：datetime*/
		if($post_data['s_pubtime_min']!=''){
			$map['pubtime'][]=array('gt',strtotime($post_data['s_pubtime_min']));
		}
		if($post_data['s_pubtime_max']!=''){
			$map['pubtime'][]=array('lt',strtotime($post_data['s_pubtime_max']));
		}
		/* 名称：状态 字段：status 类型：select*/
		if($post_data['s_status']!=''){
			$map['status']=$post_data['s_status'];
		}
		/* 名称：是否推荐 字段：recommend 类型：select*/
		if($post_data['s_recommend']!=''){
			$map['recommend']=$post_data['s_recommend'];
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
					action_log('Add_News', 'News', $result);
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
					action_log('Edit_News', 'News', $post_data['id']);
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
			action_log('Del_News', 'News', $id);
			$this->success('删除成功！');
		}
	}
}