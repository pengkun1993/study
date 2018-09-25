<?php
namespace Validates\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $userModel=D('user');
        if(IS_POST){
        	if($userModel->create()&&$userModel->add()){
        		$this->success($userModel->username.'注册成功');
        	}else{
        		$users=$userModel->select();
        		$this->assign('users',$users);
        		$this->assign('errors',$userModel->getError());
        		$this ->assign('old',I('post.'));
        		$this->display();
        	}
        }else{
        	$users=$userModel->select();
        	$this ->assign('users',$users);
        	$this->display();
        }
    }
}