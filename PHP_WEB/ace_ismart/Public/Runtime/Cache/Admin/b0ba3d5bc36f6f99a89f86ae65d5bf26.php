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
<div class="fixed-bar" id="User_Bar">
	<div class="item-title">
		<div class="page-header">
			<h1>用户				<small>
					<i class="icon-double-angle-right"></i>
					<span class="lead">&nbsp;&nbsp;列表</span>
					<a class="top_a" href="JavaScript:void(0);" onclick="Data_Search('User_Search_From','User_Data_List');"><span>搜索</span></a>
					<?php if(Is_Auth('Admin/User/add')): ?><a class="top_a" href="<?php echo U('Admin/User/add');?>"><span>新增</span></a><?php endif; ?>
				</small>
			</h1>
		</div>
	</div>
</div>
<div style="display: none">
  <form id="User_Search_From" class="search_from">
	
    <div class="form-group">
			<label class="col-xs-2 control-label no-padding-right" for="form-field-1"> 用户名 : </label>

			<div class="col-xs-10">
				<input name="s_username" type="text" class="col-xs-10">			</div>
		</div>
		<div style="clear:both;">
			
		</div>
		<hr/><div class="form-group">
			<label class="col-xs-2 control-label no-padding-right" for="form-field-1"> 昵称/姓名 : </label>

			<div class="col-xs-10">
				<input name="s_nickname" type="text" class="col-xs-10">			</div>
		</div>
		<div style="clear:both;">
			
		</div>
		<hr/><div class="form-group">
			<label class="col-xs-2 control-label no-padding-right" for="form-field-1"> 邮箱 : </label>

			<div class="col-xs-10">
				<input name="s_email" type="text" class="col-xs-10">			</div>
		</div>
		<div style="clear:both;">
			
		</div>
		<hr/><div class="form-group">
			<label class="col-xs-2 control-label no-padding-right" for="form-field-1"> 余额 : </label>

			<div class="col-xs-10">
				<input name="s_amount" type="text" class="easyui-numberbox" class="col-xs-10">			</div>
		</div>
		<div style="clear:both;">
			
		</div>
		<hr/><div class="form-group">
			<label class="col-xs-2 control-label no-padding-right" for="form-field-1"> 积分 : </label>

			<div class="col-xs-10">
				<input name="s_point" type="text" class="easyui-numberbox" class="col-xs-10">			</div>
		</div>
		<div style="clear:both;">
			
		</div>
		<hr/><div class="form-group">
			<label class="col-xs-2 control-label no-padding-right" for="form-field-1"> 创建时间 : </label>

			<div class="col-xs-10">
				<input name="s_create_time_min" type="text" class="easyui-datetimebox" style="height:30px;"> - <input name="s_create_time_max" type="text" class="easyui-datetimebox" style="height:30px;">			</div>
		</div>
		<div style="clear:both;">
			
		</div>
		<hr/><div class="form-group">
			<label class="col-xs-2 control-label no-padding-right" for="form-field-1"> 更新时间 : </label>

			<div class="col-xs-10">
				<input name="s_update_time_min" type="text" class="easyui-datetimebox" style="height:30px;"> - <input name="s_update_time_max" type="text" class="easyui-datetimebox" style="height:30px;">			</div>
		</div>
		<div style="clear:both;">
			
		</div>
		<hr/><div class="form-group">
			<label class="col-xs-2 control-label no-padding-right" for="form-field-1"> 状态 : </label>

			<div class="col-xs-10">
				<select name="status" class="col-xs-9 easyui-combobox" data-options="value:'',url:'<?php echo U("Admin/Function/get_field_option");?>&f_id=83&r_type=json',valueField:'key',textField:'val',multiple:false,required:false,editable:false" style="height:30px;"></select>			</div>
		</div>
		<div style="clear:both;">
			
		</div>
		<hr/>  </form>
</div>

<table id="User_Data_List"></table>

<script type="text/javascript">
$(function() {
	$("#User_Data_List").datagrid({
		url : "<?php echo U('User/index');?>",
		fit : true,
		striped : true,
		border : false,
		pagination : true,
		pageSize : 20,
		pageList : [ 10, 20, 50 ],
		pageNumber : 1,
		sortName : 'id',
		sortOrder : 'desc',
		toolbar : '#User_Bar',
		singleSelect : true,
		columns : [[
            {field : 'id',title : 'ID',width : 40,sortable:true},
{field : "username",title : "用户名",width :100,sortable:true},{field : "nickname",title : "昵称/姓名",width :100,sortable:true},{field : "email",title : "邮箱",width :100,sortable:true},{field : "amount",title : "余额",width :100,sortable:true},{field : "point",title : "积分",width :100,sortable:true},{field : "create_time",title : "创建时间",width :150,sortable:true,formatter: function (value, row, index) {
			return u_to_ymdhis(value)
		}},{field : "update_time",title : "更新时间",width :150,sortable:true,formatter: function (value, row, index) {
			return u_to_ymdhis(value)
		}},{field : "status",title : "状态",width :50,sortable:true,formatter: function (value, row, index) {
			var op_status=new Array()
			op_status["0"]="禁用"
			op_status["1"]="启用"
			op_status["2"]="审核中"
			
			return op_status[value];
			}},
						{field : "operate",title : "操作",width : 200,formatter: function (value, row, index) {
				operate_menu='';
				
				<?php if(Is_Auth('Admin/User/edit')): ?>operate_menu = operate_menu+"<a href='<?php echo U('edit'); ?>&id="+row.id+"' >编辑</a>";<?php endif; ?>

				<?php if(Is_Auth('Admin/User/del')): ?>operate_menu = operate_menu+" | <a href='#' onclick=\"Data_Remove('<?php echo U('del'); ?>&id="+row.id+"','User_Data_List');\">删除</a>";<?php endif; ?>

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