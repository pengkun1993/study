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
    
    <link rel="stylesheet" type="text/css" href="/Public/Static/kindeditor/themes/default/default.css" />
    <!-- easyUI css样式 -->
    <link rel="stylesheet" type="text/css" href="/Public/Static/Easyui/themes/metro/easyui.css">
    <link rel="stylesheet" type="text/css" href="/Public/Static/Easyui/themes/color.css">
    <link rel="stylesheet" href="/Public/Static/aceAdmin/css/old/skin.css" />
    <!--/ easyUI css样式 -->
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

<div class="fixed-bar" id="Model_Bar">
	<div class="item-title">
		<div class="page-header">
			<h1>模型管理&nbsp;&nbsp;
				<small>
					<i class="icon-double-angle-right"></i>
					<span class="lead">&nbsp;&nbsp;列表</span>
					<?php if(Is_Auth('Admin/Model/add')): ?><a class="top_a" href="<?php echo U('Admin/Model/add');?>"><span>新增</span></a><?php endif; ?>
					<?php if(Is_Auth('Admin/Model/generate')): ?><a class="top_a" href="<?php echo U('Admin/Model/generate');?>"><span>系统化数据模型</span></a><?php endif; ?>
				</small>
			</h1>
		</div>
	</div>
</div>
<table id="Model_Data_List">
</table>

<!-- ---------------------提示自动生成危险 ------------------------------>
<style>
	tr[datagrid-row-index="1"] td,tr[datagrid-row-index="10"] td,tr[datagrid-row-index="16"] td{
		color:red;
	}
</style>
<!-- ---------------------提示自动生成危险 ------------------------------>

<script type="text/javascript">
$(function() {
	$("#Model_Data_List").datagrid({
		url : "<?php echo U('Model/index');?>",
		fit : true,
		striped : true,
		border : false,
		pagination : true,
		pageSize : 20,
		pageList : [ 10, 20, 50 ],
		pageNumber : 1,
		sortName : 'id',
		sortOrder : 'desc',
		toolbar : '#Model_Bar',
		singleSelect : true,
		columns : [[
            {field : 'name',title : '标识',width : 100,sortable:true},
            {field : 'title',title : '名称',width : 100,sortable:true},
            {field : 'is_extend',title : '允许子模型',width : 80,sortable:true,formatter: function (value, row, index) {
				var op_is_extend=new Array()
				op_is_extend[0]="否"
				op_is_extend[1]="是"
				return op_is_extend[value];
			}},
            {field : 'extend',title : '继承的模型',width : 100,sortable:true},
            {field : 'list_type',title : '列表类型',width : 60,sortable:true,formatter: function (value, row, index) {
				var op_list_type=new Array()
				op_list_type[0]="普通"
				op_list_type[1]="树形"
				return op_list_type[value];
			}},
            {field : 'status',title : '状态',width : 40,sortable:true,formatter: function (value, row, index) {
				var op_status=new Array()
				op_status[0]="禁用"
				op_status[1]="启用"
				return op_status[value];
			}},
            {field : 'engine_type',title : '数据库引擎',width : 70,sortable:true,formatter: function (value, row, index) {
				var op_engine_type=new Array()
				op_engine_type['MyISAM'] = 'MyISAM'
				op_engine_type['InnoDB'] = 'InnoDB'
				op_engine_type['MEMORY'] = 'MEMORY'
				op_engine_type['BLACKHOLE'] = 'BLACKHOLE'
				op_engine_type['MRG_MYISAM'] = 'MRG_MYISAM'
				op_engine_type['ARCHIVE'] = 'ARCHIVE'
				return op_engine_type[value];
			}},
			{field : 'operate',title : '操作',width : 200,formatter: function (value, row, index) {
				operate_menu='';
				<?php if(Is_Auth('Admin/Model/build')): ?>operate_menu = operate_menu+"<a href='<?php echo U('Admin/Model/build'); ?>&model_id="+row.id+"' >生成文件</a>";<?php endif; ?>

				<?php if(Is_Auth('Admin/ModelField/index')): ?>operate_menu = operate_menu+" | <a href='<?php echo U('Admin/ModelField/index'); ?>&model_id="+row.id+"' >字段管理</a>";<?php endif; ?>

				<?php if(Is_Auth('Admin/Model/edit')): ?>operate_menu = operate_menu+" | <a href='<?php echo U('Admin/Model/edit'); ?>&id="+row.id+"' >编辑</a>";<?php endif; ?>

				<?php if(Is_Auth('Admin/Model/del')): ?>operate_menu = operate_menu+" | <a href='#' onclick=Data_Remove('<?php echo U('Admin/Model/del'); ?>&id="+row.id+"','Model_Data_List')>删除</a>";<?php endif; ?>

				return operate_menu;
			}}
		]]
	});
});
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