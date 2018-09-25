<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> <?php echo C('SOFT_NAME');?>|ace管理系统</title>

        <!-- basic styles -->

        <link href="/Public/Static/aceAdmin/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="/Public/Static/aceAdmin/css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="/Public/Admin/css/main.css">
        <!--[if IE 7]>
          <link rel="stylesheet" href="/Public/Static/aceAdmin/css/font-awesome-ie7.min.css" />
        <![endif]-->

        <!-- page specific plugin styles -->

        <link rel="stylesheet" href="/Public/Static/aceAdmin/css/jquery-ui-1.10.3.custom.min.css" />
        <!-- page specific plugin styles -->

        <link rel="stylesheet" href="/Public/Static/aceAdmin/css/jquery-ui-1.10.3.custom.min.css" />
        <link rel="stylesheet" href="/Public/Static/aceAdmin/css/chosen.css" />
        <link rel="stylesheet" href="/Public/Static/aceAdmin/css/datepicker.css" />
        <link rel="stylesheet" href="/Public/Static/aceAdmin/css/bootstrap-timepicker.css" />
        <link rel="stylesheet" href="/Public/Static/aceAdmin/css/daterangepicker.css" />
        <link rel="stylesheet" href="/Public/Static/aceAdmin/css/colorpicker.css" />
        <!-- ace styles -->

        <link rel="stylesheet" href="/Public/Static/aceAdmin/css/ace.min.css" />
        <link rel="stylesheet" href="/Public/Static/aceAdmin/css/ace-rtl.min.css" />
        <link rel="stylesheet" href="/Public/Static/aceAdmin/css/ace-skins.min.css" />

        <!--[if lte IE 8]>
          <link rel="stylesheet" href="/Public/Static/aceAdmin/css/ace-ie.min.css" />
        <![endif]-->

        <!-- inline styles related to this page -->

        <!-- ace settings handler -->

        <script src="/Public/Static/aceAdmin/js/ace-extra.min.js"></script>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

        <!--[if lt IE 9]>
        <script src="/Public/Static/aceAdmin/js/html5shiv.js"></script>
        <script src="/Public/Static/aceAdmin/js/respond.min.js"></script>
        <![endif]-->

    <!-- ----------------------------------- -->
    <link href="/Public/Admin/images/favicon.ico" mce_href="/Public/Admin/images/favicon.ico" rel="bookmark" type="image/x-icon" /> 
    <link href="/Public/Admin/images/favicon.ico" mce_href="/Public/Admin/images/favicon.ico" rel="icon" type="image/x-icon" /> 
    <link href="/Public/Admin/images/favicon.ico" mce_href="/Public/Admin/images/favicon.ico" rel="shortcut icon" type="image/x-icon" /> 
    
    <link rel="stylesheet" type="text/css" href="/Public/Static/kindeditor/themes/default/default.css" />
    <!-- ----------------------------------- -->
        <link rel="stylesheet" type="text/css" href="/Public/Static/Easyui/themes/metro/easyui.css">
        <link rel="stylesheet" type="text/css" href="/Public/Static/Easyui/themes/color.css">
        <link rel="stylesheet" href="/Public/Static/aceAdmin/css/old/skin.css" />
    <!-- ----------------------------------- -->
    <script type="text/javascript" src="/Public/Static/Jquery/jquery.min.js"></script>
    <script type="text/javascript" src="/Public/Static/Easyui/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="/Public/Static/Easyui/locale/easyui-lang-zh_CN.js"></script>
    <script charset="utf-8" src="/Public/Static/kindeditor/kindeditor.js"></script>
    <script charset="utf-8" src="/Public/Static/kindeditor/kindeditor-min.js"></script>
    <script charset="utf-8" src="/Public/Static/kindeditor/lang/zh_CN.js"></script>
    <script charset="utf-8" src="/Public/Static/Echarts/echarts.js"></script>
    <script charset="utf-8" src="/Public/Static/aceAdmin/js/old/base.js" /></script><script>
    var ke_pasteType=2;
    var ke_fileManagerJson="<?php echo U('Admin/FilesUpdata/filemanager');?>";
    var ke_uploadJson="<?php echo U('Admin/FilesUpdata/upload');?>";
    var ke_Uid='<?php echo session(C("AUTH_KEY"));;?>';
    var Root='';
    </script>
    <!-- ----------------------------------- -->
</head>
<body>

<div class="fixed-bar" id="ModelField_Bar">
	<div class="item-title">
		<h3>模型管理</h3>
		<ul class="tab-base">
			<?php if(Is_Auth('Admin/Model/index')): ?><li><a href="<?php echo U('Admin/Model/index');?>"><span>模型列表</span></a></li><?php endif; ?>
			<li><a class="current" href="JavaScript:void(0);" onclick="Data_Reload('ModelField_Data_List');"><span>字段列表</span></a></li>
			<?php if(Is_Auth('Admin/ModelField/add')): ?><li><a href="<?php echo U('Admin/ModelField/add',array('model_id'=>I('get.model_id')));?>"><span>新增</span></a></li><?php endif; ?>
		</ul>
	</div>
</div>
<table id="ModelField_Data_List"></table>
<script type="text/javascript">
$(function () {
	$("#ModelField_Data_List").datagrid({
		url : "<?php echo U('Admin/ModelField/index');?>&model_id=<?php echo I('get.model_id');?>",
		fit : true,
		striped : true,
		border : false,
		pagination : true,
		pageSize : 50,
		pageList : [10, 20, 50],
		pageNumber : 1,
		sortName : 'id',
		sortOrder : 'desc',
		toolbar : '#ModelField_Bar',
		singleSelect:true,
		columns : [[
			{field : 'title',title : '字段标题',width : 100,sortable:true},
			{field : 'name',title : '字段名',width : 100,sortable:true},
			{field : 'type',title : '数据类型',width : 100,sortable:true,formatter: function (value, row, index) {
				var op_type=new Array()
				op_type['num'] = '数字'
				op_type['string'] = '文本框'
				op_type['textarea'] = '文本区域'
				op_type['datetime'] = '日期时间'
				op_type['select'] = '下拉框'
				op_type['checkbox'] = '选择'
				op_type['editor'] = '编辑器'
				op_type['pictures'] = '图片'
				op_type['files'] = '附件'
				return op_type[value];
			}},
			{field : 'remark',title : '备注',width : 100,sortable:true},
			{field : 'status',title : '状态',width : 100,sortable:true,formatter: function (value, row, index) {
				var op_status=new Array()
				op_status[0]="禁用"
				op_status[1]="启用"
				return op_status[value];
			}},
			{field : 'sort_l',title : '列表',width : 40,sortable:true},
			{field : 'sort_s',title : '搜索',width : 40,sortable:true},
			{field : 'sort_a',title : '新增',width : 40,sortable:true},
			{field : 'sort_e',title : '修改',width : 40,sortable:true},
			{field : 'l_width',title : '列表宽度',width : 55,sortable:true},
			{field : 'validate_time',title : '验证时间',width : 100,sortable:true,sortable:true,formatter: function (value, row, index) {
				var op_validate_time=new Array()
				op_validate_time[1]="新增"
				op_validate_time[2]="修改"
				op_validate_time[3]="全部"
				return op_validate_time[value];
			}},
			{field : 'auto_time',title : '完成时间',width : 100,sortable:true,formatter: function (value, row, index) {
				var op_auto_time=new Array()
				op_auto_time[1]="新增"
				op_auto_time[2]="修改"
				op_auto_time[3]="全部"
				return op_auto_time[value];
			}},
			{field : 'operate',title : '操作',width : 200,formatter: function (value, row, index) {
				operate_menu='';
				<?php if(Is_Auth('Admin/ModelField/edit')): ?>operate_menu = operate_menu+"<a href='<?php echo U('Admin/ModelField/edit'); ?>&id="+row.id+"&model_id=<?php echo I('get.model_id'); ?>' >编辑</a>";<?php endif; ?>

				<?php if(Is_Auth('Admin/ModelField/del')): ?>operate_menu = operate_menu+" | <a href='#' onclick=Data_Remove('<?php echo U('Admin/ModelField/del'); ?>&id="+row.id+"','ModelField_Data_List')>删除</a>";<?php endif; ?>

				return operate_menu;
			}}
		]],
	});
})
</script>
</script>

<!-- basic scripts -->

        <!-- <![endif]-->

        <!--[if IE]>
        <script src="/Public/Static/aceAdmin/js/jquery-2.0.3.min.js"></script>
        <![endif]-->

        <!--[if !IE]> -->

        <script type="text/javascript">
            window.jQuery || document.write("<script src='/Public/Static/aceAdmin/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
        </script>

        <!-- <![endif]-->

        <!--[if IE]>
            <script type="text/javascript">
             window.jQuery || document.write("<script src='/Public/Static/aceAdmin/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
            </script>
        <![endif]-->

        <script type="text/javascript">
            if("ontouchend" in document) document.write("<script src='/Public/Static/aceAdmin/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
        </script>
        <script src="/Public/Static/aceAdmin/js/bootstrap.min.js"></script>
        <script src="/Public/Static/aceAdmin/js/typeahead-bs2.min.js"></script>

        <!-- page specific plugin scripts -->

        <script src="/Public/Static/aceAdmin/js/jquery-ui-1.10.3.custom.min.js"></script>
        <script src="/Public/Static/aceAdmin/js/jquery.ui.touch-punch.min.js"></script>
        <script src="/Public/Static/aceAdmin/js/markdown/markdown.min.js"></script>
        <script src="/Public/Static/aceAdmin/js/markdown/bootstrap-markdown.min.js"></script>
        <script src="/Public/Static/aceAdmin/js/jquery.hotkeys.min.js"></script>
        <script src="/Public/Static/aceAdmin/js/bootstrap-wysiwyg.min.js"></script>
        <script src="/Public/Static/aceAdmin/js/bootbox.min.js"></script>

        <!-- ace scripts -->

        <script src="/Public/Static/aceAdmin/js/ace-elements.min.js"></script>
        <script src="/Public/Static/aceAdmin/js/ace.min.js"></script>
        <script src="/Public/Static/aceAdmin/js/editor.js"></script>
</body>
</html>