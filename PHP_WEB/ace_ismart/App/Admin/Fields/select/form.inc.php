<?php

//清空返回表单内容
$from_return='';
//解析字段参数
$extra=unserialize($field_one['extra']);
//清空扩展显示内容
$extra_show="";
//判断表单 类型（新增,更改,搜索）
if($G_from_type=='add'){
	$extra_show=$extra_show.'value:\''.$field_one['value'].'\',';//如果是新增,表单值为填写的默认值
}elseif($G_from_type=='edit'){
	$extra_show=$extra_show.'value:\'{$_info["'.$field_one['name'].'"]}\',';//如果是更改，表单值为{$_info["表单名称"]}
}else{
	$extra_show=$extra_show.'value:\'\',';//如果是搜索,表单值为空
}

//设置表单类型
$combo_type="combobox";//默认为combobox
if($extra['form_type']=='1'){//如果为表单类型值为1，即普通下拉表单 
	$f_value='valueField';
	$f_text='textField';
	
	if($extra['type']==2){//如果参数的值为2，是获取某一字段的配置信息 
		$extra_show=$extra_show.'url:\'{:U("Admin/Function/get_field_option")}&f_id='.$field_one['id'].'&r_type=json\',valueField:\'key\',textField:\'val\',';
	}elseif($extra['type']==3){//如果参数的值为3，是获取某一配置的参数
		$extra_option_arr = explode('|',$extra['option']);
		if($extra_option_arr[1]==''){
			$extra_option_arr[1]='type';
			$extra_option_arr[2]='value';
		}
		$extra_show=$extra_show.'url:\'{:U("Admin/Function/get_config")}&cname='.$extra['option'].'&r_type=json\','.$f_value.':\''.$extra_option_arr[1].'\','.$f_text.':\''.$extra_option_arr[2].'\',';
	}elseif($extra['type']==4){
		$extra_option_arr = explode('|',$extra['option']);
		$extra_show=$extra_show.'url:\'{:U("'.$extra_option_arr[0].'")}&r_type=json\','.$f_value.':\''.$extra_option_arr[1].'\','.$f_text.':\''.$extra_option_arr[2].'\',';
	}
}

if($extra['form_type']=='2' && $extra['type']=='4'){//如果为表单类型值为2，即树形菜单 且 参数的值为4，即获取方法返回的值
	$combo_type="combotree";//设置表单类型为 combotree
	$extra_option_arr = explode('|',$extra['option']);
	$extra_show=$extra_show.'url:\'{:U("'.$extra_option_arr[0].'")}&r_type=json\','.$f_value.':\''.$extra_option_arr[1].'\','.$f_text.':\''.$extra_option_arr[2].'\',';
}
$F_NAME=$field_one['name'];
if($extra['multiple']==1){//是否支持多选 1为支持
	$F_NAME=$F_NAME.'[]';
	$extra_show=$extra_show.'multiple:true,cascadeCheck:false,';
}else{
	$extra_show=$extra_show.'multiple:false,';
}

if($extra['required']==1){//是否必填 1为必填
	$extra_show=$extra_show.'required:true,';
}else{
	$extra_show=$extra_show.'required:false,';
}

if($extra['editable']=='true'){//是否允许手写输入 1为允许
	$extra_show=$extra_show.'editable:true';
}else{
	$extra_show=$extra_show.'editable:false';
}
 
/*********生成添加页面表单文件************/
if($G_from_type=='add'){
		/*区分生成树还是图标下拉框还是普通下拉框*/
		if($extra['type']==1){
			$from_return = '<select name="'.$F_NAME.'" class="col-xs-7 col-sm-3 col-lg-3 col-md-3" id="s_'.$field_one['name'].'"  def-data="'.$field_one['value'].'">';
		}else{
			$from_return = '<select name="'.$F_NAME.'" class="col-xs-9 col-sm-2   easyui-'.$combo_type.'" data-options="'.$extra_show.'" style="height:30px;">';
		}
		/*生成option*/
		if($extra['type']==1){//如果数据来源是固定的那么就直接分解数据写入表单
			$ops = model_field_attr($extra['option']);
			foreach ($ops as $opkey=>$opkeyval){
				$from_return=$from_return.'<option value="'.$opkey.'"
				>'.$opkeyval.'</option>';
			}
		}
		$from_return=$from_return.'</select>';
		/*选出默认的选项*/
		if($extra['type']==1){
			$from_return=$from_return.'<script type="text/javascript">
			var sel=document.getElementById(\'s_'.$field_one['name'].'\');
			var opt=sel.getElementsByTagName(\'option\');
			var def=sel.getAttribute(\'def-data\');
			for(var i=0;i<opt.length;i++){
				if(def==opt[i].value){
					opt[i].setAttribute("selected","selected");
				};
			}
			</script>
			';
		}
/*********生成编辑页面表单文件************/
}elseif($G_from_type=='edit'){
	if($extra['type']==1){
		$from_return = '<select name="'.$F_NAME.'" class="col-xs-7 col-sm-3 col-lg-3 col-md-3" id="s_'.$field_one['name'].'"  def-data="{$_info[\''.$field_one['name'].'\']}">';
	}else{
		$from_return = '<select name="'.$F_NAME.'" class="col-xs-9 col-sm-2  easyui-'.$combo_type.'" data-options="'.$extra_show.'" style="height:30px;">';
	}
	if($extra['type']==1){//如果数据来源是固定的那么就直接分解数据写入表单
		$ops = model_field_attr($extra['option']);
		foreach ($ops as $opkey=>$opkeyval){
			$from_return=$from_return.'<option value="'.$opkey.'">'.$opkeyval.'</option>';
		}
	}	
	$from_return=$from_return.'</select>';
	if($extra['type']==1){
		$from_return=$from_return.'<script type="text/javascript">
		var sel=document.getElementById(\'s_'.$field_one['name'].'\');
		var opt=sel.getElementsByTagName(\'option\');
		var def=sel.getAttribute(\'def-data\');
		for(var i=0;i<opt.length;i++){
			if(def==opt[i].value){
				opt[i].setAttribute("selected","selected");
			};
		}
	</script>
	';
	}
/*********生成其他页面表单文件************/	
}else{
	/*区分生成树还是图标下拉框还是普通下拉框*/
		if($extra['type']==1){
			$from_return = '<select name="'.$F_NAME.'" class="col-xs-7 col-sm-3 col-lg-3 col-md-3" id="s_'.$field_one['name'].'"  def-data="'.$field_one['value'].'">';
		}else{
			$from_return = '<select name="'.$F_NAME.'" class="col-xs-9 easyui-'.$combo_type.'" data-options="'.$extra_show.'" style="height:30px;">';
		}
		/*生成option*/
		if($extra['type']==1){//如果数据来源是固定的那么就直接分解数据写入表单
			$ops = model_field_attr($extra['option']);
			foreach ($ops as $opkey=>$opkeyval){
				$from_return=$from_return.'<option value="'.$opkey.'"
				>'.$opkeyval.'</option>';
			}
		}
		$from_return=$from_return.'</select>';
		/*选出默认的选项*/
		if($extra['type']==1){
			$from_return=$from_return.'<script type="text/javascript">
			var sel=document.getElementById(\'s_'.$field_one['name'].'\');
			var opt=sel.getElementsByTagName(\'option\');
			var def=sel.getAttribute(\'def-data\');
			for(var i=0;i<opt.length;i++){
				if(def==opt[i].value){
					opt[i].setAttribute("selected","selected");
				};
			}
			</script>
			';
		}	
}
return $from_return;