<?php
	/**
	* 缓存文件写入、读取、删除
	*/
	class File
	{
		private $_dir;//默认缓存路径
		const EXT='.txt';//定义文件后缀
		function __construct()
		{
			$this->_dir=dirname(__FILE__).'/files/';//设置默认缓存文件，在当前目录下的files文件夹
		}
		/**
		* 缓存文件写入、读取、删除
		* @param string $key 文件名
		* @param  $value 录入的数据
		* @param string $path 文件路径
		* return boolen 
		*/
		public function cacheData($key,$value='',$path=''){
			$filename=$this->_dir.$path.$key.self::EXT;//缓存文件
			if ($value!='') { 
				if($value=='DEL'){
					return @unlink($filename);
				}else{
					$dir=dirname($filename);//返回路径中的目录部分
					if (!is_dir($dir)) { //判断是否存在该文件，不存在就创建一个
						mkdir($dir,0777) ;
					}
					return file_put_contents($filename,json_encode($value));//按Json方式写入文件
				}
			}else{
				if(is_file($filename)){
					return json_decode(file_get_contents($filename),true);//转化为正常数据读取
				}else{
					return "文件不存在";
				}
			}
		}
	}
?>