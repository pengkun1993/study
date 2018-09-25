<?PHP
namespace Admin\Controller;
	use Think\Controller;
	/**
	* 父类控制器
	*/
	class CommonController extends Controller
	{
		function __construct()
		{
			//调用父类构造方法
			parent::__construct();	
			//过滤访问权限
			//当前的控制器和方法
			$now_ac=CONTROLLER_NAME."-".ACTION_NAME;
			//公共控制器和方法，所有人都可以访问的
			$allow_ac=array('Index-index','Index-head','Index-left','Index-right','Manager-login','Manager-verifyImg','Manager-logout');
			if(empty($_SESSION['mg_id'])){
				//$arr=array('Manager-login','Manager-verifyImg');
				if(($now_ac!='Manager-login')&&($now_ac!='Manager-verifyImg')){
			 		$this->redirect('manager/login');
			 	}
			}else{
			//获取用户所具有的权限
				$res=M('manager')->where('mg_id='.session('mg_id'))->find();
				$data=M('role')->where('role_id='.$res['mg_role_id'])->find();
				$role_ac=$data['role_auth_ac'];
				if(!in_array($now_ac,$allow_ac) && $res['mg_role_id']!=0 && !strpos($role_ac,$now_ac)){
					$this->error('没有访问权限',U('manager/login'));
				}
			}
		}
		
	}
?>