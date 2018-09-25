<?php
	require_once('./response.class.php'); //该文件对数据进行封装
	require_once('./file.class.php');//该文件用于缓存控制
/************转化为Json数据输出************/
	/*$arr = array(
		'id'=>1 ,
		'name'=>'pengkun', 
		);
	$data='输出Json数据';//该文本是utf8编码的，所以可以输出
	$newData=iconv('utf-8', 'gbk', $data);//转换字符串的编码格式
	var_dump($newData);
	var_dump(json_encode($newData));//json封装方法，只能封装utf8编码的*/


/************Json数据封装******************/
	
	/*$arr = array(
		'id'=>1 ,
		'name'=>'pengkun', 
		);
	echo Response::json(200,'数据返回成功',$arr);//调用Json封装数据*/


/************xml数据输出*************/
	/*header("Content_Type:text/xml");//header向浏览器传送一个头信息,改为xml显示模式可以更好的显示
	$xml="<? xml version='1.0' encoding='utf-8' ?>\n";
			$xml.="<root>\n";
			$xml.="<code>200</code>\n";
			$xml.="<message>返回数据成功</message>\n";
			$xml.="<data>\n";
			$xml.="<id>1</id>\n";
			$xml.="<name>pengkun</name>\n";
			$xml.="</data>\n";//\n用于换行，显示更友好
			$xml.="</root>";
	echo $xml;*/


/************xml数据封装******************/
	/*$data=array(
		 	'id'=>1,
		 	'name'=>'pengkun',
		 	'type'=>array(1,3,4),//键为0,1,2，xml的节点不能为数字，故会出错
		);
	echo Response::xmlEncode(200,'成功返回消息',$data);*/


/************数据封装综合******************/
	/*$data=array(
		 	'id'=>1,
		 	'name'=>'pengkun',
		 	'type'=>array(1,3,4),
		 	'test'=>array(23,43,6,4,array('adafa',121),),
		);
	echo Response::show(200,'success',$data,'xml');*/

/************缓存文件的写入读取删除******************/
	$data=array(
		 	'id'=>1,
		 	'name'=>'pengkun',
		 	'type'=>array(1,3,4),
		 	'test'=>array(23,43,6,4,array('adafa',121),),
		);
	$file=new File();
	//写入
		if($file->cacheData('index_mk_cache',$data)){ 
			echo 'success';
		}else{
			echo 'error';
		}
	//读取
		//var_dump($file->cacheData('index_mk_cache'));
	//删除
		//var_dump($file->cacheData('index_mk_cache','DEL'));
?>