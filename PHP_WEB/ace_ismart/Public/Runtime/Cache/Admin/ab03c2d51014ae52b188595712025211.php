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

<!-- page specific plugin styles -->

		<link rel="stylesheet" href="/Public/Static/aceAdmin/css/jquery-ui-1.10.3.custom.min.css" />
		<link rel="stylesheet" href="/Public/Static/aceAdmin/css/chosen.css" />
		<link rel="stylesheet" href="/Public/Static/aceAdmin/css/datepicker.css" />
		<link rel="stylesheet" href="/Public/Static/aceAdmin/css/bootstrap-timepicker.css" />
		<link rel="stylesheet" href="/Public/Static/aceAdmin/css/daterangepicker.css" />
		<link rel="stylesheet" href="/Public/Static/aceAdmin/css/colorpicker.css" />

<div class="fixed-bar" id="Model_Bar">
	<div class="item-title">
		<div class="page-header">
			<h1><a href="<?php echo U('Admin/Model/index');?>">模型管理</a>
				<small>
					<i class="icon-double-angle-right"></i>
					<span class="lead">&nbsp;&nbsp;编辑</span>
				</small>
			</h1>
		</div><!-- /.page-header -->
		<!-- <ul class="tab-base">
			<?php if(Is_Auth('Admin/Model/index')): ?><li><a href="<?php echo U('Admin/Model/index');?>"><span>列表</span></a></li><?php endif; ?>
			<li><a class="current" href="<?php echo U('Admin/Model/add');?>"><span>新增</span></a></li>
			<?php if(Is_Auth('Admin/Model/generate')): ?><li><a href="<?php echo U('Admin/Model/generate');?>"><span>系统化数据模型</span></a></li><?php endif; ?>
		</ul> -->
	</div>
</div>
	<div class="col-xs-12 marg-top">
		<form class="form-horizontal" role="form" method="POST" id="Model_Form">
			<div class="form-group">
				<label class="col-xs-2 col-sm-1 control-label no-padding-right" for="form-field-1"> 模型标识: </label>

				<div class="col-xs-11">
					<input type="text" id="form-field-1" placeholder="" class="col-xs-6 col-sm-3" name="name" value="<?php echo ($_info["name"]); ?>" />
					<span class="help-inline col-xs-12 col-sm-9">
						<span class="middle">请输入模型标识</span>
					</span>
				</div>
			</div>
			<div class="space-20"></div>

			<div class="form-group">
				<label class="col-xs-2 col-sm-1 control-label no-padding-right" for="form-field-1"> 模型名称: </label>

				<div class="col-xs-11">
					<input type="text" id="form-field-2" placeholder="" class="col-xs-6 col-sm-3" name="title" value="<?php echo ($_info["title"]); ?>"/>
					<span class="help-inline col-xs-12 col-sm-9">
						<span class="middle">请输入模型名称</span>
					</span>
				</div>
			</div>
			<div class="space-20"></div>

			<div class="form-group">
				<label class="col-xs-2 col-sm-1 control-label no-padding-right" for="form-field-1"> 表名: </label>

				<div class="col-xs-11">
					<input type="text" id="form-field-3" placeholder="" class="col-xs-6 col-sm-3" name="table_name" value="<?php echo ($_info["table_name"]); ?>"/>
					<span class="help-inline col-xs-12 col-sm-9">
						<span class="middle">模型的真实表名</span>
					</span>
				</div>
			</div>
			<div class="space-20"></div>	

			<div class="form-group">
				<label class="col-xs-2 col-sm-1 control-label no-padding-right" for="form-field-1"> 允许子模型: </label>

				<div class="col-xs-11">
					<select class="col-xs-6 col-sm-3" id="form-field-select-1" name="is_extend" value="<?php echo ($_info["is_extend"]); ?>">
						<option value="1">是</option>
						<option value="0">否</option>
					</select>
					<span class="help-inline col-xs-12 col-sm-9">
						<span class="middle" style="color:red;">如果模型非独立模型，选允许子模型,系统将会出错</span>
					</span>
				</div>
			</div>
			<div class="space-20"></div>		

			<div class="form-group">
				<label class="col-xs-2 col-sm-1 control-label no-padding-right" for="form-field-1"> 模型类型: </label>

				<div class="col-xs-11">
					<select class="col-xs-6 col-sm-3" id="form-field-select-2" name="extend" value="<?php echo ($_info["extend"]); ?>"  data-options="value:'0'">
						<option value="0">独立模型</option>
						<?php if(is_array($is_extend_list)): $i = 0; $__LIST__ = $is_extend_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['id']); ?>"><?php echo ($vo['title']); ?> [<?php echo ($vo['name']); ?>]</option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
					<span class="help-inline col-xs-12 col-sm-9">
						<span class="middle" style="color:red;">如果模型非独立模型，选允许子模型,系统将会出错</span>
					</span>
				</div>
			</div>
			<div class="space-20"></div>

			<div class="form-group">
				<label class="col-xs-2 col-sm-1 control-label no-padding-right" for="form-field-1"> 列表类型: </label>

				<div class="col-xs-11">
					<select class="col-xs-6 col-sm-3" id="form-field-select-3" name="list_type" value="<?php echo ($_info["list_type"]); ?>" data-options="value:'0'">
						<option value="0" >普通</option>
        				<option value="1" >树形</option>
					</select>
					<span class="help-inline col-xs-12 col-sm-9">
						<span class="middle" style="color:red;">如果模型非独立模型，选允许子模型,系统将会出错</span>
					</span>
				</div>
			</div>
			<div class="space-20"></div>	

			<div class="form-group">
				<label class="col-xs-2 col-sm-1 control-label no-padding-right" for="form-field-1"> 引擎类型: </label>

				<div class="col-xs-11">
					<select class="col-xs-6 col-sm-3" id="form-field-select-4" name="engine_type" value="<?php echo ($_info["engine_type"]); ?>">
						<option value="MyISAM">MyISAM</option>
						<option value="InnoDB">InnoDB</option>
		                <option value="MEMORY">MEMORY</option>
		                <option value="BLACKHOLE">BLACKHOLE</option>
		                <option value="MRG_MYISAM">MRG_MYISAM</option>
		                <option value="ARCHIVE">ARCHIVE</option>
					</select>
				</div>
			</div>
			<div class="space-20"></div>	

			<div class="form-group">
				<label class="col-xs-2 col-sm-1 control-label no-padding-right" for="form-field-1"> 状态: </label>

				<div class="col-xs-11">
					<select class="col-xs-6 col-sm-3" id="form-field-select-1" name="status" value="<?php echo ($_info["status"]); ?>" data-options="value:'1'">
						<option value="1">是</option>
						<option value="0">否</option>
					</select>
				</div>
			</div>
			<div class="space-20"></div>

			<div class="clearfix">
				<div class="col-md-offset-1 col-md-9">
					<button class="btn btn-lg btn-success" type="button" onclick="$('#Model_Form').submit();">
						<i class="icon-ok bigger-110"></i>
						<span class="lead">提交</span>
					</button>
				</div>
			</div>
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