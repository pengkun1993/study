<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
       $birthday_year=1993;
       $this ->assign('birthday_year',$birthday_year);
       $this->display();
    }
}