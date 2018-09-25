<?php

$from_return='';

$extra=unserialize($field_one['extra']);
$extra_show="";

if($extra['required']==1){//是否必填
	$extra_show=$extra_show.'required:true';
}else{
	$extra_show=$extra_show.'required:false';
}

if($G_from_type=='add'){
	$from_return='<input name="'.$field_one['name'].'" type="text" class="col-xs-10 col-sm-3 col-lg-3 col-md-3" value="'.$field_one['value'].'">';
}elseif($G_from_type=='edit'){
	$from_return='<input name="'.$field_one['name'].'" type="text" class="col-xs-10 col-sm-3 col-lg-3 col-md-3" value="{$_info["'.$field_one['name'].'"]}" >';
}else{
	$from_return='<input name="s_'.$field_one['name'].'" type="text" class="col-xs-10">';
}

return $from_return;