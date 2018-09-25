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
    <!-- easyUI css样式 -->
    <link rel="stylesheet" type="text/css" href="/Public/Static/Easyui/themes/metro/easyui.css">
    <link rel="stylesheet" type="text/css" href="/Public/Static/Easyui/themes/color.css">
    <link rel="stylesheet" href="/Public/Static/aceAdmin/css/old/skin.css" />
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
<div class="fixed-bar" id="Addons_Bar">
	<div class="item-title">
		<div class="page-header">
			<h1>插件				<small>
					<i class="icon-double-angle-right"></i>
					<span class="lead">&nbsp;&nbsp;列表</span>
					<a class="top_a" href="JavaScript:void(0);" onclick="Data_Search('Addons_Search_From','Addons_Data_List');"><span>搜索</span></a>
					<?php if(Is_Auth('Admin/Addons/add')): ?><a class="top_a" href="<?php echo U('Admin/Addons/add');?>"><span>新增</span></a><?php endif; ?>
				</small>
			</h1>
		</div>
	</div>
</div>
<div style="display: none">
  <form id="Addons_Search_From" class="search_from">
	
    <div class="form-group">
			<label class="col-xs-2 control-label no-padding-right" for="form-field-1"> 插件名 : </label>

			<div class="col-xs-10">
				<input name="s_name" type="text" class="col-xs-10">			</div>
		</div>
		<div style="clear:both;">
			
		</div>
		<hr/><div class="form-group">
			<label class="col-xs-2 control-label no-padding-right" for="form-field-1"> 中文名 : </label>

			<div class="col-xs-10">
				<input name="s_title" type="text" class="col-xs-10">			</div>
		</div>
		<div style="clear:both;">
			
		</div>
		<hr/><div class="form-group">
			<label class="col-xs-2 control-label no-padding-right" for="form-field-1"> 插件描述 : </label>

			<div class="col-xs-10">
				<textarea class="col-xs-10 " name="description" style=" height:80px;"></textarea>			</div>
		</div>
		<div style="clear:both;">
			
		</div>
		<hr/><div class="form-group">
			<label class="col-xs-2 control-label no-padding-right" for="form-field-1"> 状态 : </label>

			<div class="col-xs-10">
				<select name="status" class="col-xs-7 col-sm-3 col-lg-3 col-md-3" id="s_status"  def-data="1"><option value="0"
				>禁用</option><option value="1"
				>启用</option></select><script type="text/javascript">
			var sel=document.getElementById('s_status');
			var opt=sel.getElementsByTagName('option');
			var def=sel.getAttribute('def-data');
			for(var i=0;i<opt.length;i++){
				if(def==opt[i].value){
					opt[i].setAttribute("selected","selected");
				};
			}
			</script>
						</div>
		</div>
		<div style="clear:both;">
			
		</div>
		<hr/><div class="form-group">
			<label class="col-xs-2 control-label no-padding-right" for="form-field-1"> 配置 : </label>

			<div class="col-xs-10">
				<textarea class="col-xs-10 " name="config" style=" height:80px;"></textarea>			</div>
		</div>
		<div style="clear:both;">
			
		</div>
		<hr/><div class="form-group">
			<label class="col-xs-2 control-label no-padding-right" for="form-field-1"> 作者 : </label>

			<div class="col-xs-10">
				<input name="s_author" type="text" class="col-xs-10">			</div>
		</div>
		<div style="clear:both;">
			
		</div>
		<hr/><div class="form-group">
			<label class="col-xs-2 control-label no-padding-right" for="form-field-1"> 版本号 : </label>

			<div class="col-xs-10">
				<input name="s_version" type="text" class="col-xs-10">			</div>
		</div>
		<div style="clear:both;">
			
		</div>
		<hr/><div class="form-group">
			<label class="col-xs-2 control-label no-padding-right" for="form-field-1"> 安装时间 : </label>

			<div class="col-xs-10">
				<input name="s_create_time_min" type="text" class="easyui-datetimebox" style="height:30px;"> - <input name="s_create_time_max" type="text" class="easyui-datetimebox" style="height:30px;">			</div>
		</div>
		<div style="clear:both;">
			
		</div>
		<hr/><div class="form-group">
			<label class="col-xs-2 control-label no-padding-right" for="form-field-1"> 是否有后台列表 : </label>

			<div class="col-xs-10">
				<select name="has_adminlist" class="col-xs-7 col-sm-3 col-lg-3 col-md-3" id="s_has_adminlist"  def-data="0"><option value="0"
				>否</option><option value="1"
				>是</option></select><script type="text/javascript">
			var sel=document.getElementById('s_has_adminlist');
			var opt=sel.getElementsByTagName('option');
			var def=sel.getAttribute('def-data');
			for(var i=0;i<opt.length;i++){
				if(def==opt[i].value){
					opt[i].setAttribute("selected","selected");
				};
			}
			</script>
						</div>
		</div>
		<div style="clear:both;">
			
		</div>
		<hr/>  </form>
</div>

<table id="Addons_Data_List"></table>

<script type="text/javascript">
$(function() {
	$("#Addons_Data_List").datagrid({
		url : "<?php echo U('Addons/index');?>",
		fit : true,
		striped : true,
		border : false,
		pagination : true,
		pageSize : 20,
		pageList : [ 10, 20, 50 ],
		pageNumber : 1,
		sortName : 'id',
		sortOrder : 'desc',
		toolbar : '#Addons_Bar',
		singleSelect : true,
		columns : [[
            {field : 'id',title : 'ID',width : 40,sortable:true},
{field : "name",title : "插件名",width :100,sortable:true},{field : "title",title : "中文名",width :100,sortable:true},{field : "description",title : "插件描述",width :100,sortable:true},{field : "status",title : "状态",width :100,sortable:true,formatter: function (value, row, index) {
			var op_status=new Array()
			op_status["0"]="禁用"
			op_status["1"]="启用"
			
			return op_status[value];
			}},
			{field : "config",title : "配置",width :100,sortable:true},{field : "author",title : "作者",width :100,sortable:true},{field : "version",title : "版本号",width :100,sortable:true},{field : "create_time",title : "安装时间",width :100,sortable:true,formatter: function (value, row, index) {
			return u_to_ymdhis(value)
		}},{field : "has_adminlist",title : "是否有后台列表",width :100,sortable:true,formatter: function (value, row, index) {
			var op_has_adminlist=new Array()
			op_has_adminlist["0"]="否"
			op_has_adminlist["1"]="是"
			
			return op_has_adminlist[value];
			}},
						{field : "operate",title : "操作",width : 200,formatter: function (value, row, index) {
				operate_menu='';
				
				<?php if(Is_Auth('Admin/Addons/edit')): ?>operate_menu = operate_menu+"<a href='<?php echo U('edit'); ?>&id="+row.id+"' >编辑</a>";<?php endif; ?>

				<?php if(Is_Auth('Admin/Addons/del')): ?>operate_menu = operate_menu+" | <a href='#' onclick=\"Data_Remove('<?php echo U('del'); ?>&id="+row.id+"','Addons_Data_List');\">删除</a>";<?php endif; ?>

				return operate_menu;
			}}
		]]
	});
})
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