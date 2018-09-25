<?php if (!defined('THINK_PATH')) exit();?>
<div class="fixed-bar" id="<?php echo ($ModelInfo['name']); ?>_Bar">
	<div class="item-title">
		<div class="page-header">
			<h1><?php echo ($ModelInfo['title']); ?>
				<small>
					<i class="icon-double-angle-right"></i>
					<span class="lead">&nbsp;&nbsp;列表</span>
					<if condition="Is_Auth('Admin/<?php echo ($ModelInfo['name']); ?>/add')">
					<a class="top_a" href="{:U('Admin/<?php echo ($ModelInfo['name']); ?>/add')}"><span>新增</span></a>
					</if>
				</small>
			</h1>
		</div>
	</div>
</div>
<table id="<?php echo ($ModelInfo['name']); ?>_Data_List"></table>
<style>
.tree-icon{ display:none}
</style>
<script type="text/javascript">
$(function() {
	$("#<?php echo ($ModelInfo['name']); ?>_Data_List").treegrid({
		url : "{:U('<?php echo ($ModelInfo['name']); ?>/index')}",
		fit : true,
		striped : true,
		border : false,
		idField:'id',
		treeField:'title',
		pagination : false,
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