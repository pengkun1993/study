<?php 
	namespace Admin\Controller;
	use Admin\Controller\Commontroller;
	/**
	* 后台产品管理
	*/
	class GoodsController extends CommonController
	{
		public function showList()
		{
			$goods=D('goods');
			//获得当前记录总条数
			$total=$goods->count();
			$per=10;//每页显示记录条数
			//示例化分页类
			$page=new \Component\Page($total,$per);
			//获取本页显示的信息
			$sql="select * from sw_goods ".$page->limit;
			$data=$goods->query($sql);
			//获取页码信息
			$pagelist=$page->fpage();
			$this->assign('pagelist',$pagelist);
			$this->assign('goods_data',$data);
			$this->display();
		}

		public function add()
		{
			if(IS_POST){
				if($_FILES){
					$upload=new \Think\Upload();
					$info = $upload->uploadOne($_FILES['goods_img']);

					if(!$info){
						echo $upload->getError();exit();
					}else{
						//储存上传的图片
						$bigImg=$info['savepath'].$info['savename'];
						$_POST['goods_big_img']=$bigImg;
						//示例话图像类
						$image=new \Think\Image();
						//打开原图
						$bigImgPath=$upload->rootPath.$bigImg;
						$image->open($bigImgPath);
						//生成缩略图
						$image->thumb(150,150);
						$smallImg=$info['savepath'].'small_'.$info['savename'];
						$image->save($upload->rootPath.$smallImg);
						$_POST['goods_small_img']=$smallImg;
					}
				}
				$goods=D('goods');
				$data=$_POST;
				$b=$goods->add($data);
				if($b){
					$this->success('添加成功',U("goods/showList"));
					//echo "添加成功";
				}else{
					$this->error('添加失败',U("goods/showList"));
					//echo "添加失败";
				}
			}else{
				$this->display();
			}	
			
		}

		public function upd($id)
		{
			if(IS_GET){
			$data=D('goods')->find($id);
			$this ->assign('data',$data);
			$this ->display();
			}elseif(IS_POST){
				$data=$_POST;
				$goods=D('goods');
				$b=$goods->where('goods_id='.$id)->save($data);
				if($b){
					$this->success('修改成功',U('goods/showList'));
				}else{
					$this->error('修改失败',U('goods/showList'));
				}
			}
		}
	}
 ?>