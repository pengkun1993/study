<?php
	namespace Home\Model;
	use Think\Model;
	Class CommonModel extends Model{
		public function strmake($str){
			return md5($str);
		}
	}
?>