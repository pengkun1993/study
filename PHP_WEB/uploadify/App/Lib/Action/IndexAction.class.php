<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
    function index(){
		$data['session_tem']=session_id();
		$this->data=$data;
		$this->display();
    }

	function upload(){
		import('ORG.Net.UploadFile');
		$upload = new UploadFile();
		$upload->maxSize = 2097152; // 设置附件上传大小不超过2MB
        $upload->allowExts = array ('jpg', 'gif', 'png', 'jpeg' ); // 设置附件上传类型
		$upload->savePath='Uploads/images/'.date("Y-m-d").'/';
		$upload->thumb = true;
		//设置需要生成缩略图的文件后缀
		$upload->thumbPrefix = 't_';  //生产1张缩略图
		 //设置缩略图最大宽度
		$upload->thumbMaxWidth = '200';
		$upload->thumbMaxHeight = '200';
		$upload->saveRule = "uniqid";
		$this->_mkdir($upload->savePath);
		if($upload->upload()){
			import("@.ORG.Util.Image");
			$info=$upload->getUploadFileInfo();
			$info=$info[0];
			$imgurl=$info['savepath'].$info['savename'];
			$img=new Image();
			$img->water($imgurl,SITE_DIR.'/Public/images/shuiyin.png');
			$this->ajaxReturn($imgurl,$info,1,'json');;
		}else{
			$this->ajaxReturn('',$upload->getErrorMsg(),0,'json');
		}
	}

	function save(){
		/*相册封面，根据自己需求写业务逻辑代码*/
		$cover=I('post.cover');
		/*上传的图片处理，根据自己需求写业务逻辑代码*/
		$album=explode(',',trim(I('post.album'),','));
		foreach($album as $k =>$v){
			if(!in_array($v,$list)){
				$t=explode('+',$v);
				$tmp=explode('/',$t[0]);
				$num=count($tmp)-1;
				$str=$tmp[$num];
				$n[]=array('title'=>$t[1],'src'=>$t[0],'src_thumb'=>str_replace($str,'t_'.$str,$t[0]),'date'=>time());
			}
		}	
		if(!empty($n)){
			M('img')->AddAll($n);
		}
	}

	function del(){
		/*删除图片*/
		$t=urldecode(I('post.path'));
		$t1=explode('+',$t);
		$src=$t1[0];
		$tmp=explode('/',$src);
		$num=count($tmp)-1;
		$str=$tmp[$num];
		@unlink($src);
		@unlink(str_replace($str,'t_'.$str,$src));
	}

	function _mkdir($Folder){ // 创建图片上传目录和缩略图目录
        if(!is_dir($Folder)){
			$dir = explode('/',$Folder);
			foreach($dir as $v){
				if($v){
					$d .= $v . '/';
					if(!is_dir($d)){
						$state = mkdir($d);
						if(!$state){
							die('在创建目录' . $d . '时出错！');
						}							
					}
				}
			}
        }
    }
}