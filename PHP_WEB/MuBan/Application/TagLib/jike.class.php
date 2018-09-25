<?php 
	namespace TagLib;
	use Think\Template\TagLib;
	/**
	* 
	*/
	class jike extends TagLib
	{
		
		protected $tags=array(
				'friends'=>array(
						'attr'=>'uid',
						'close'=>1
					),
			);
		public function _friends($tag,$c)
		{
			$id=$tag['uid'];
			$name=$tag['name'];
			$empty=$tag['empty'];
			$unique=rand();

			$parse_string='<?php ';
	    	$parse_string.='$_FRIENDS_'.$unique.'=get_user_friends('.$id.');';
	    	$parse_string.='if(empty($_FRIENDS_'.$unique.')){echo $empty;}';
	    	$parse_string.='else';
	    	$parse_string.='{';
	    	$parse_string.='foreach ($_FRIENDS_' . $unique . ' as $key => $' . $name . ') {';
	    	$parse_string.='?>';
	    	$parse_string.=$c;
	    	$parse_string.='<?php ';
	    	$parse_string.='}';
	    	$parse_string.='}';
	    	$parse_string.=' ?>';

			return $parse_string;
		}
	}
?>