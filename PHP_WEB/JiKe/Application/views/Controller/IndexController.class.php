<?php
namespace views\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $username='linda';
        $email='linda@qq.com';
        $age=18;

        $this ->assign('username',$username);
        $this ->assign('email',$email);
        $this ->assign('age',$age);
        $this->display();
    }
}