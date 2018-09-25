<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    	//$this->creatUser();
    	//$this->updateUserStatus('2');
    	//$this->deleteUser(1);
        //$this->listUsers(); 
        //$this->showUser(3);
        //dump(D('user')->getLatestVipUser());
        //$this->updateUserStatusAR(5);
        //$this->creatUserM();
        $this->listUsers();
        $this->display();
    }

    //用映射方式新增用户
    private function creatUserM(){
        $userAttribute=array(
            'zhanghao'=>'tom',
            'word'=>md5('111'),
            'youjian'=>'tom@qq.com',
            'zhuceshijian'=>date("Y-m-d"),
            'zhuangtai'=>0
        );
        $userModel=D('user');
        $userModel->create($userAttribute);
        $userModel->add();
    }
    //新增用户
    private function creatUser(){
    	$userAttribute=array(
    		'username'=>'kun',
    		'password'=>md5('111'),
    		'email'=>'kun@qq.com',
    		'create_time'=>date("Y-m-d"),
    		'status'=>1
    	);

    	D('user')->add($userAttribute);
    }
    //ActiveRecord模式的新增用户
    private function creatuserAR()
    {
        $user=D('user');
        $user->username='yao';
        $user->password='yao';
        $user->email='yao@qq.com';
        $user->create_time=date("Y-m-d H:i:s");
        $user->status=1;
        $user->add(); 
    }
    //读取全部用户
    private function listUsers()
    {
    	dump(D('user')->select());
    }
    //更新用户
    private function updateUserStatus($userid)
    {
    	$userUpdateAttribute=array(
    		'id'=>$userid,
    		'status'=>'0'
    		);
    	D('user')->save($userUpdateAttribute);
    }
    //ActiveRecord模式的更新用户
    private function updateUserStatusAR($userid)
    {
        $user=D('user');
        $user->id=$userid;
        $user->status=0;
        $user->save();
    }
    //删除用户
    private function deleteUser($userid)
    {
    	D('user')->delete($userid);
    }
    //读取单条数据
    private function showUser($userid)
    {
    	dump(D('user')->find($userid));
    }
}