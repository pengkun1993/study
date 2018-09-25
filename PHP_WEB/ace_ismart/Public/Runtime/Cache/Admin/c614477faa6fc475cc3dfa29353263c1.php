<?php if (!defined('THINK_PATH')) exit();?>
<div class="fixed-bar" id="<?php echo ($ModelInfo['name']); ?>_Bar">
	<div class="item-title">
		<div class="page-header">
			<h1><?php echo ($ModelInfo['title']); ?>
				<small>
					<i class="icon-double-angle-right"></i>
					<span class="lead">&nbsp;&nbsp;列表</span>
					<a class="top_a" href="JavaScript:void(0);" onclick="Data_Search('<?php echo ($ModelInfo['name']); ?>_Search_From','<?php echo ($ModelInfo['name']); ?>_Data_List');"><span>搜索</span></a>
					<if condition="Is_Auth('Admin/<?php echo ($ModelInfo['name']); ?>/add')">
					<a class="top_a" href="{:U('Admin/<?php echo ($ModelInfo['name']); ?>/add')}"><span>新增</span></a>
					</if>
				</small>
			</h1>
		</div>
	</div>
</div>
<div style="display: none">
  <form id="<?php echo ($ModelInfo['name']); ?>_Search_From" class="search_from">
	
    <?php if(is_array($_Search)): $i = 0; $__LIST__ = $_Search;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$field): $mod = ($i % 2 );++$i;?><div class="form-group">
			<label class="col-xs-2 control-label no-padding-right" for="form-field-1"> <?php echo ($field['title']); ?> : </label>

			<div class="col-xs-10">
				<?php echo ($field['form']); ?>
			</div>
		</div>
		<div style="clear:both;">
			
		</div>
		<hr/><?php endforeach; endif; else: echo "" ;endif; ?>
  </form>
</div>

<table id="<?php echo ($ModelInfo['name']); ?>_Data_List"></table>

<script type="text/javascript">
$(function() {
	$("#<?php echo ($ModelInfo['name']); ?>_Data_List").datagrid({
		url : "{:U('<?php echo ($ModelInfo['name']); ?>/index')}",
		fit : true,
		striped : true,
		border : false,
		pagination : true,
		pageSize : 20,
		pageList : [ 10, 20, 50 ],
		pageNumber : 1,
		sortName : 'id',
		sortOrder : 'desc',
		toolbar : '#<?php echo ($ModelInfo["name"]); ?>_Bar',
		singleSelect : true,
		columns : [[
            {field : 'id',title : 'ID',width : 40,sortable:true},
<?php foreach ($_List as $key => $field ) { $extra=unserialize($field['extra']); if(in_array($field['type'],array('select','checkbox'))){ if($extra['type']==1 || $extra['type']==2){ $option=''; $option=model_field_attr($extra['option']); echo '{field : "'.$field["name"].'",title : "'.$field["title"].'",width :'.$field["l_width"].',sortable:true,formatter: function (value, row, index) {
			var op_'.$field["name"].'=new Array()
			'; foreach ($option as $key => $option_one ) { echo 'op_'.$field["name"].'["'.$key.'"]="'.$option_one.'"
			'; } echo '
			return op_'.$field["name"].'[value];
			}},
			'; } }elseif(in_array($field['type'],array('datetime'))){ if($extra['from_type']=='datetimebox'){ echo '{field : "'.$field["name"].'",title : "'.$field["title"].'",width :'.$field["l_width"].',sortable:true,formatter: function (value, row, index) {
			return u_to_ymdhis(value)
		}},'; }else{ echo '{field : "'.$field["name"].'",title : "'.$field["title"].'",width :'.$field["l_width"].',sortable:true,formatter: function (value, row, index) {
			return u_to_ymd(value)
		}},'; } }else{ echo '{field : "'.$field["name"].'",title : "'.$field["title"].'",width :'.$field["l_width"].',sortable:true},'; } }?>
			{field : "operate",title : "操作",width : 200,formatter: function (value, row, index) {
				operate_menu='';
				
				<if condition="Is_Auth('Admin/<?php echo $ModelInfo['name'];?>/edit')">
				operate_menu = operate_menu+"<a href='<?php echo "<?php echo U('edit'); ?>"; ?>&id="+row.id+"' >编辑</a>";
				</if>

				<if condition="Is_Auth('Admin/<?php echo $ModelInfo['name'];?>/del')">
				operate_menu = operate_menu+" | <a href='#' onclick=\"Data_Remove('<?php echo "<?php echo U('del'); ?>"; ?>&id="+row.id+"','<?php echo $ModelInfo['name'];?>_Data_List');\">删除</a>";
				</if>

				return operate_menu;
			}}
		]]
	});
})
</script>