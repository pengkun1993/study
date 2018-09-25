<?php

namespace Admin\Controller;
use Common\Controller\CoreController;

class PublicController extends CoreController {
	
    public function login($map = ''){
        if(IS_POST || $map!=''){
			if($map==''){
				$username = I ( "post.username", "", "trim" );
				$password = md5(I ( "post.password", "", "trim" ));
				if (empty ( $username ) || empty ( $password )) {
					$this->error ( "用户名或者密码不能为空，请重新输入！", U ( C ( 'AUTH_USER_GATEWAY' ) ) );
				}
				$map = array (
						'username' => $username,
						'password' => $password,
						'status' => 1 
				);
			}
			$UserInfo = M ( 'User' )->where ( $map )->find ();
			if ($UserInfo) {
				$AGA_Data=M('AuthGroupAccess')->where (array('uid'=>$UserInfo['id']))->find ();
				$AG_Data=M('AuthGroup')->where (array('id'=>$AGA_Data['group_id']))->find ();
				$UserInfo['group_id']=$AGA_Data['group_id'];
				$UserInfo['group_title']=$AG_Data['title'];
				if(!in_array($UserInfo['group_id'],array(1,2)) && !(in_array ($UserInfo['id'], C ( 'AUTH_ADMIN' ) ))){
					$this->error ( '你不是管理员组用户所以无法登录！' ,U('Public/login'));
				}
				session(C('AUTH_KEY'),$UserInfo['id']);
				session('UserInfo',$UserInfo);
				if(C('?ADMIN_REME')){
					$admin_reme=C('ADMIN_REME');
				}else{
					$admin_reme=3600;
				}
				if(I("post.rember_password")){
					cookie('rw',$map,$admin_reme);
				}
				action_log('Admin_Login', 'User', $UserInfo ['id']);
				$this->success ( "登录成功！", U ( C ( 'AUTH_USER_INDEX' ) ) );
			} else {
				$this->error ( "用户名密码错误或者此用户已被禁用！", U ( C ( 'AUTH_USER_GATEWAY' ) ) );
			}
        } else {
            if(is_login()){
                $this->redirect('Index/index');
            }else{
				$map=cookie('rw');
				if((count($map)>0)){
                	$this->login($map);
				}else{
                	$this->display();
				}
            }
        }
    }

    /* 退出登录 */
    public function logout(){
		if (!is_login()) {
			$this->error ( "尚未登录", U ( C ( 'AUTH_USER_GATEWAY' ) ) );
		}else{
			action_log('Admin_Logout', 'User', is_login());
			session ( null );
			cookie('rw',null);
			if (session ( C ( 'AUTH_KEY' ) )) {
				$this->error ( "退出失败", U ( C ( 'AUTH_USER_INDEX' ) ) );
			}else{
				$this->success ( "退出成功！", U ( C ( 'AUTH_USER_GATEWAY' ) ) );
			}
		}
    }

}
