<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    	/**
    	 * json转excel文件
    	 * @var string
    	 */
    	/*$filename="./data/life.json";
    	$json_string=file_get_contents($filename);
    	$arr = json_decode($json_string,true);
    	$arr1=[];
    	for($i=0;$i<count($arr['series']);$i++){
    		$arr1=array_merge($arr1,$arr['series'][$i]);
    	}
		$b=create_xls($arr1);
		dump($b);*/
		/**
		 * 读取excel文件
		 * @var [type]
		 */
        $data=import_excel('./data/life.xls');
        // $data2=import_excel('./data/2013.csv');
        dump($data);
    }
}