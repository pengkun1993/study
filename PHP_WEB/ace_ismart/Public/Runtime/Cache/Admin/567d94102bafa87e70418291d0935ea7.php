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
	<div class="fixed-bar" id="Addons_Bar">
		<div class="item-title">
			<div class="page-header">
				<h1><a href="<?php echo U('Admin/Addons/index');?>">插件</a>
					<small>
						<i class="icon-double-angle-right"></i>
						<span class="lead">&nbsp;&nbsp;编辑</span>
					</small>
				</h1>
			</div>
		</div>
	</div>
	<div class="col-xs-12 marg-top">
		<form class="form-horizontal" role="form" method="POST" id="Addons_Form">
			<div class="form-group">
					<label class="col-xs-5 col-sm-1 control-label no-padding-right" for="form-field-1">插件名:</label>

					<div class="col-xs-11">
						<input name="name" type="text" class="col-xs-10 col-sm-3 col-lg-3 col-md-3" value="<?php echo ($_info["name"]); ?>" >											</div>
				</div>
				<hr/><div class="form-group">
					<label class="col-xs-5 col-sm-1 control-label no-padding-right" for="form-field-1">中文名:</label>

					<div class="col-xs-11">
						<input name="title" type="text" class="col-xs-10 col-sm-3 col-lg-3 col-md-3" value="<?php echo ($_info["title"]); ?>" >											</div>
				</div>
				<hr/><div class="form-group">
					<label class="col-xs-5 col-sm-1 control-label no-padding-right" for="form-field-1">插件描述:</label>

					<div class="col-xs-11">
						<textarea class="col-xs-10 col-sm-3 col-lg-3 col-md-3" name="description" value="<?php echo ($_info["description"]); ?>"  style=" height:80px;"><?php echo ($_info["description"]); ?></textarea>											</div>
				</div>
				<hr/><div class="form-group">
					<label class="col-xs-5 col-sm-1 control-label no-padding-right" for="form-field-1">状态:</label>

					<div class="col-xs-11">
						<select name="status" class="col-xs-7 col-sm-3 col-lg-3 col-md-3" id="s_status"  def-data="<?php echo ($_info['status']); ?>"><option value="0">禁用</option><option value="1">启用</option></select><script type="text/javascript">
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
				<hr/><div class="form-group">
					<label class="col-xs-5 col-sm-1 control-label no-padding-right" for="form-field-1">配置:</label>

					<div class="col-xs-11">
						<textarea class="col-xs-10 col-sm-3 col-lg-3 col-md-3" name="config" value="<?php echo ($_info["config"]); ?>"  style=" height:80px;"><?php echo ($_info["config"]); ?></textarea>											</div>
				</div>
				<hr/><div class="form-group">
					<label class="col-xs-5 col-sm-1 control-label no-padding-right" for="form-field-1">作者:</label>

					<div class="col-xs-11">
						<input name="author" type="text" class="col-xs-10 col-sm-3 col-lg-3 col-md-3" value="<?php echo ($_info["author"]); ?>" >											</div>
				</div>
				<hr/><div class="form-group">
					<label class="col-xs-5 col-sm-1 control-label no-padding-right" for="form-field-1">版本号:</label>

					<div class="col-xs-11">
						<input name="version" type="text" class="col-xs-10 col-sm-3 col-lg-3 col-md-3" value="<?php echo ($_info["version"]); ?>" >											</div>
				</div>
				<hr/><div class="form-group">
					<label class="col-xs-5 col-sm-1 control-label no-padding-right" for="form-field-1">安装时间:</label>

					<div class="col-xs-11">
						<input name="create_time" value="<?php echo (date('Y-m-d H:i:s',$_info["create_time"])); ?>" type="text" class="easyui-datetimebox col-xs-6 col-sm-3 col-lg-3 col-md-3"style="height:30px;" data-options="required:false">											</div>
				</div>
				<hr/><div class="form-group">
					<label class="col-xs-5 col-sm-1 control-label no-padding-right" for="form-field-1">是否有后台列表:</label>

					<div class="col-xs-11">
						<select name="has_adminlist" class="col-xs-7 col-sm-3 col-lg-3 col-md-3" id="s_has_adminlist"  def-data="<?php echo ($_info['has_adminlist']); ?>"><option value="0">否</option><option value="1">是</option></select><script type="text/javascript">
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
				<hr/>			<div class="clearfix">
				<div class="col-md-offset-1 col-md-9">
					<button class="btn btn-lg btn-success" type="button" onclick="$('#Addons_Form').submit();">
						<i class="icon-ok bigger-110"></i>
						<span class="lead">提交</span>
					</button>
				</div>
			</div>
			<input name="id" type="hidden" value="<?php echo I('get.id');?>" />
		</form>
	</div>
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