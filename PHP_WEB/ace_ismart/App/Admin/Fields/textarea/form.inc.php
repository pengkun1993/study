<?php

$from_return='';

$extra=unserialize($field_one['extra']);
$extra_show="";

if($extra['required']==1){//是否必填
	$extra_show=$extra_show.'required:true';
}else{
	$extra_show=$extra_show.'required:false';
}

if($extra['width']==''){
	$extra['width']='300px';
}
if($extra['height']==''){
	$extra['height']='80px';
}


if($G_from_type=='add'){
	$from_return='<textarea class="col-xs-10 col-sm-3 col-lg-3 col-md-3" name="'.$field_one['name'].'" style=" height:'.$extra['height'].';">'.$field_one['value'].'</textarea>';
}elseif($G_from_type=='edit'){
	$from_return='<textarea class="col-xs-10 col-sm-3 col-lg-3 col-md-3" name="'.$field_one['name'].'" value="{$_info["'.$field_one['name'].'"]}"  style=" height:'.$extra['height'].';">{$_info["'.$field_one['name'].'"]}</textarea>';
}else{
	$from_return='<textarea class="col-xs-10 " name="'.$field_one['name'].'" style=" height:'.$extra['height'].';">'.$field_one['value'].'</textarea>';
}

return $from_return;