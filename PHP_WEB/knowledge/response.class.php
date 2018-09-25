<?php
	class Response{
		/*
		*按照综合方式输出通信数据
		* @param integer $code 状态码
		* @param string $message 提示信息
		* @param array $data 数据
		* @param string $type 数据封装类型
		* return string
		*/
		public static function show($code,$message='',$data=array(),$type){
			if(!is_numeric($code)){
				return '';
			}

			$result=array(
				'code'=>$code,
				'message'=>$message,
				'data'=>$data,
			);
			if ($type=='json') {
				return self::json($code,$message,$data);
			}elseif($type=='xml'){
				return self::xmlEncode($code,$message,$data);
			}elseif($type=='array'){//用于程序员查看调试，不可直接被接口识别
				return var_dump($result);
			}else{  //可继续添加别的功能
				return '';
			}
		}
		/*
		*按照Json方式输出通信数据
		*@param integer $code 状态码
		*@param string $message 提示信息
		*@param array $data 数据
		*return string
		*/
		public static function json($code,$message='',$data=array()){
			if(!is_numeric($code)){
				return '';
			}

			$result=array(
				'code'=>$code,
				'message'=>$message,
				'data'=>$data,
			);
			return json_encode($result);
			exit;
		}

		/*
		*按照xml方式输出通信数据
		*@param integer $code 状态码
		*@param string $message 提示信息
		*@param array $data 数据
		*return string
		*/
		public static function xmlEncode($code,$message='',$data){
			if(!is_numeric($code)){
				return '';
			}
			$result=array(
				'code'=>$code,
				'message'=>$message,
				'data'=>$data,
			);
			$xml="<?xml version='1.0' encoding='utf-8'?>\n";
			$xml.="<root>\n";
			$xml.= self::xmlToEncode($result);
			$xml.="</root>\n";
			header("Content_Type:text/xml");
			return $xml;
		}
		public static function xmlToEncode($data){
			$xml=$sttr='';
			foreach ($data as $key => $value) {
				if(is_numeric($key)){
					$sttr="id=".$key;
					$key="item";
				}
				$xml.="<{$key} {$sttr}>";
				$xml.=is_array($value) ? self::xmlToEncode($value) : $value;
				$xml.="</{$key}>\n";
			}
			return $xml;
		}
		
	}
?>