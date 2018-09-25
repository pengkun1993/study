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
	
<div class="fixed-bar" id="Applicant_Bar">
	<div class="item-title">
		<div class="page-header">
			<h1><a href="<?php echo U('Admin/Applicant/index');?>">应聘者信息</a>
				<small>
					<i class="icon-double-angle-right"></i>
					<span class="lead">&nbsp;&nbsp;详情</span>
				</small>
			</h1>
		</div>
	</div>
</div>
<div class="col-xs-12 marg-top">
	<div class="form-group">
		<p class="lead"> 
		应聘职位:
		<span class="remove_bold">
			<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i; if($data["id"] == $_info['position']): echo ($data["name"]); endif; endforeach; endif; else: echo "" ;endif; ?>
		</span> 
		</p>
	</div>
	<hr/>
	<div class="form-group">
		<p class="lead"> 
		姓名:
		<span class="remove_bold"><?php echo ($_info["name"]); ?></span> 
		</p>
	</div>
	<hr/>
	<div class="form-group">
		<p class="lead"> 
		性别:
		<span class="remove_bold">
		<?php switch($_info['sex']): case "1": ?>女<?php break;?>
			<?php case "0": ?>男<?php break; endswitch;?>
		</span> 
		</p>
	</div>
	<hr/>
	<div class="form-group">
		<p class="lead"> 
		出生日期:
		<span class="remove_bold"><?php echo (date('Y-m-d',$_info["birthday"])); ?></span> 
		</p>
	</div>
	<hr/>
	<div class="form-group">
		<p class="lead"> 
		籍贯:
		<span class="remove_bold"><?php echo ($_info["native"]); ?></span> 
		</p>
	</div>
	<hr/>
	<div class="form-group">
		<p class="lead"> 
		联系电话:
		<span class="remove_bold"><?php echo ($_info["tel"]); ?></span> 
		</p>
	</div>
	<hr/>
	<div class="form-group">
		<p class="lead"> 
		电子邮箱:
		<span class="remove_bold"><?php echo ($_info["email"]); ?></span> 
		</p>
	</div>
	<hr/>
	<div class="form-group">
		<p class="lead"> 
		学历:
		<span class="remove_bold">
		<?php switch($_info['degree']): case "0": ?>博士<?php break;?>
			<?php case "1": ?>硕士<?php break;?>
			<?php case "2": ?>本科<?php break;?>
			<?php case "3": ?>大专<?php break;?>
			<?php case "4": ?>高中<?php break;?>
			<?php case "5": ?>其他<?php break; endswitch;?>
		</span> 
		</p>
	</div>
	<hr/>
	<div class="form-group">
		<p class="lead"> 
		专业:
		<span class="remove_bold"><?php echo ($_info["major"]); ?></span> 
		</p>
	</div>
	<hr/>
	<div class="form-group">
		<p class="lead"> 
		学校:
		<span class="remove_bold"><?php echo ($_info["school"]); ?></span> 
		</p>
	</div>
	<hr/>
	<div class="form-group">
		<p class="lead"> 
		通讯地址:
		<span class="remove_bold"><?php echo ($_info["address"]); ?></span> 
		</p>
	</div>
	<hr/>
	<div class="form-group">
		<p class="lead"> 
		获奖经历:
		<span class="remove_bold"><?php echo ($_info["awards"]); ?></span> 
		</p>
	</div>
	<hr/>
	<div class="form-group">
		<p class="lead"> 
		工作经历:
		<span class="remove_bold"><?php echo ($_info["work"]); ?></span> 
		</p>
	</div>
	<hr/>
	<div class="form-group">
		<p class="lead"> 
		个人简介:
		<span class="remove_bold"><?php echo ($_info["introduce"]); ?></span> 
		</p>
	</div>
	<hr/>
	<div class="clearfix">
		<div class="col-md-offset-1 col-md-9">
			<button class="btn btn-lg btn-success" type="button" onclick="history.go(-1)" >
				<i class="icon-arrow-left bigger-110"></i>
				<span class="lead">返回</span>
			</button>
		</div>
	</div>
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