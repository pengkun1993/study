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
</head>
<body>
<div class="fixed-bar" id="Applicant_Bar">
	<div class="item-title">
		<h3>应聘者信息</h3>
		<ul class="tab-base">
			<?php if(Is_Auth('Admin/Applicant/index')): ?><li><a href="<?php echo U('Admin/Applicant/index');?>"><span>列表</span></a></li><?php endif; ?>
			<li><a class="current"href="<?php echo U('Admin/Applicant/add');?>"><span>新增</span></a></li>
		</ul>
	</div>
</div>
<form id="Applicant_Form" method="post">
<table class="table tb-type2 nobdb">
	<tbody>
	<tr>
			<td colspan="2" class="required"><label for="for_name">应聘职位:</label></td>
		</tr>
		<tr class="noborder">
			<td class="vatop rowform"><input name="position" type="text" class="easyui-textbox" style="height:30px;" value="4" data-options="required:false"></td>
			<td class="vatop tips"></td>
		</tr><tr>
			<td colspan="2" class="required"><label for="for_name">姓名:</label></td>
		</tr>
		<tr class="noborder">
			<td class="vatop rowform"><input name="name" type="text" class="easyui-textbox" style="height:30px;" value="" data-options="required:true"></td>
			<td class="vatop tips"></td>
		</tr><tr>
			<td colspan="2" class="required"><label for="for_name">性别:</label></td>
		</tr>
		<tr class="noborder">
			<td class="vatop rowform"><select name="sex" class="easyui-combobox" style="height:30px;" data-options="value:'0',multiple:false,required:true,editable:false"><option value="0" >男</option><option value="1" >女</option></select></td>
			<td class="vatop tips"></td>
		</tr><tr>
			<td colspan="2" class="required"><label for="for_name">出生日期:</label></td>
		</tr>
		<tr class="noborder">
			<td class="vatop rowform"><input name="birthdate" value="" type="text" class="easyui-datebox" style="height:30px;" data-options="required:false"></td>
			<td class="vatop tips"></td>
		</tr><tr>
			<td colspan="2" class="required"><label for="for_name">籍贯:</label></td>
		</tr>
		<tr class="noborder">
			<td class="vatop rowform"><input name="birthplace" type="text" class="easyui-textbox" style="height:30px;" value="" data-options="required:true"></td>
			<td class="vatop tips"></td>
		</tr><tr>
			<td colspan="2" class="required"><label for="for_name">联系电话:</label></td>
		</tr>
		<tr class="noborder">
			<td class="vatop rowform"><input name="tel" type="text" class="easyui-textbox" style="height:30px;" value="" data-options="required:true"></td>
			<td class="vatop tips"></td>
		</tr><tr>
			<td colspan="2" class="required"><label for="for_name">电子邮箱:</label></td>
		</tr>
		<tr class="noborder">
			<td class="vatop rowform"><input name="email" type="text" class="easyui-textbox" style="height:30px;" value="" data-options="required:true"></td>
			<td class="vatop tips"></td>
		</tr><tr>
			<td colspan="2" class="required"><label for="for_name">学历:</label></td>
		</tr>
		<tr class="noborder">
			<td class="vatop rowform"><select name="degree" class="easyui-combobox" style="height:30px;" data-options="value:'',multiple:false,required:false,editable:false"><option value="0" >博士</option><option value="1" >硕士</option><option value="2" >本科</option><option value="3" >大专</option><option value="4" >高中</option><option value="5" >其他</option></select></td>
			<td class="vatop tips"></td>
		</tr><tr>
			<td colspan="2" class="required"><label for="for_name">专业:</label></td>
		</tr>
		<tr class="noborder">
			<td class="vatop rowform"><input name="major" type="text" class="easyui-textbox" style="height:30px;" value="" data-options="required:true"></td>
			<td class="vatop tips"></td>
		</tr><tr>
			<td colspan="2" class="required"><label for="for_name">学校:</label></td>
		</tr>
		<tr class="noborder">
			<td class="vatop rowform"><input name="school" type="text" class="easyui-textbox" style="height:30px;" value="" data-options="required:true"></td>
			<td class="vatop tips"></td>
		</tr><tr>
			<td colspan="2" class="required"><label for="for_name">通讯地址:</label></td>
		</tr>
		<tr class="noborder">
			<td class="vatop rowform"><input name="address" type="text" class="easyui-textbox" style="height:30px;" value="" data-options="required:true"></td>
			<td class="vatop tips"></td>
		</tr><tr>
			<td colspan="2" class="required"><label for="for_name">获奖经历:</label></td>
		</tr>
		<tr class="noborder">
			<td class="vatop rowform"><input name="awards" value="" type="text" class="easyui-textbox" data-options="required:false,multiline:true" style="width:300px; height:80px;"></td>
			<td class="vatop tips"></td>
		</tr><tr>
			<td colspan="2" class="required"><label for="for_name">工作经历:</label></td>
		</tr>
		<tr class="noborder">
			<td class="vatop rowform"><input name="work" value="" type="text" class="easyui-textbox" data-options="required:false,multiline:true" style="width:300px; height:80px;"></td>
			<td class="vatop tips"></td>
		</tr><tr>
			<td colspan="2" class="required"><label for="for_name">个人简介:</label></td>
		</tr>
		<tr class="noborder">
			<td class="vatop rowform"><input name="introduce" value="" type="text" class="easyui-textbox" data-options="required:false,multiline:true" style="width:300px; height:80px;"></td>
			<td class="vatop tips"></td>
		</tr>	</tbody>
	<tfoot>
		<tr class="tfoot">
			<td colspan="2"><a class="easyui-linkbutton" href="JavaScript:void(0);" onclick="$('#Applicant_Form').submit();" data-options="iconCls:'iconfont icon-edit'"><span style="font-size: 14px; font-weight: 600;">提交</span></a></td>
		</tr>
	 </tfoot>
</table>
</form>
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