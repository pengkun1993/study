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

<div class="fixed-bar" id="Example_Bar">
	<div class="item-title">
		<h3>案例</h3>
		<ul class="tab-base">
			<?php if(Is_Auth('Admin/Example/index')): ?><li><a href="<?php echo U('Admin/Example/index');?>"><span>列表</span></a></li><?php endif; ?>
			<li><a class="current"href="<?php echo U('Admin/Example/add');?>"><span>新增</span></a></li>
		</ul>
	</div>
</div>
<form id="Example_Form" method="post">
<table class="table tb-type2 nobdb">
	<tbody id="addtable">
		<tr>
			<td colspan="2" class="required">
				<label for="for_name">标题:</label>
			</td>
		</tr>
		<tr class="noborder">
			<td class="vatop rowform">
				<input name="title" type="text" class="easyui-textbox" style="height:30px;" value="" data-options="required:true"></td>
			<td class="vatop tips"></td>
		</tr>
		<tr>
			<td colspan="2" class="required">
				<label for="for_name">所属栏目:</label>
			</td>
		</tr>
		<tr class="noborder">
			<td class="vatop rowform">
				<select name="pid" class="easyui-combotree" style="height:30px;" data-options="value:'0',url:'<?php echo U("Admin/Function/get_categroy");?>&pid=-1&r_type=json',multiple:false,required:false,editable:false"></select>
			</td>
			<td class="vatop tips"></td>
		</tr>
		<tr>
			<td colspan="2" class="required">
				<label for="for_name">图片:</label>
			</td>
		</tr>
		<tr class="noborder">
			<td class="vatop rowform">
				<!-- <input id="img_picture_box" name="picture" value="" class="easyui-textbox" data-options="buttonText:'选择',buttonIcon:'iconfont icon-pic',prompt:'上传图片...',onClickButton:function(){updata_image('img_picture_box')}" style="width:250px;height:30px;" >
				<div id="J_imageview"></div> -->
				<input value="" name="picture" type="text" id="picturelis"/>
				<input id="img_picture_box" value="上传图片" type="button" />
				<div id="J_imageView"></div>
			</td>
			<td class="vatop tips"></td>
		</tr>
		<tr>
			<td colspan="2" class="required">
				<label for="for_name">内容:</label>
			</td>
		</tr>
		<tr class="noborder">
			<td class="vatop rowform">
				<textarea id="editor_content" name="content" config_date="0" style="width:700px;height:300px;" class="easyui-kindeditor"></textarea>
			</td>
			<td class="vatop tips"></td>
		</tr>
		<tr>
			<td colspan="2" class="required">
				<label for="for_name">状态:</label>
			</td>
		</tr>
		<tr class="noborder">
			<td class="vatop rowform">
				<select name="status" class="easyui-combobox" style="height:30px;" data-options="value:'1',multiple:false,required:true,editable:false">
					<option value="0" >隐藏</option>
					<option value="1" >显示</option>
				</select>
			</td>
			<td class="vatop tips"></td>
		</tr>
		<tr>
			<td colspan="2" class="required">
				<label for="for_name">显示顺序呢:</label>
			</td>
		</tr>
		<tr class="noborder">
			<td class="vatop rowform">
				<input name="sort" type="text" class="easyui-textbox" style="height:30px;" value="0" data-options="required:true"></td>
			<td class="vatop tips"></td>
		</tr>
	</tbody>
	<tfoot>
		<tr class="tfoot">
			<td colspan="2">
				<a class="easyui-linkbutton" href="JavaScript:void(0);" onclick="$('#Example_Form').submit();" data-options="iconCls:'iconfont icon-edit'">
					<span style="font-size: 14px; font-weight: 600;">提交</span>
				</a>
			</td>
		</tr>
	</tfoot>
</table>
</form>
<script type="text/javascript">
	KindEditor.ready(function(K) {
		var editor = K.editor({
			allowFileManager : true,
			pasteType:ke_pasteType,
			fileManagerJson: ke_fileManagerJson,
			uploadJson: ke_uploadJson,
			extraFileUploadParams: {
				uid: ke_Uid
			}
		});
		K('#img_picture_box').click(function() {
			editor.loadPlugin('multiimage', function() {
				editor.plugin.multiImageDialog({
					clickFn : function(urlList) {
						var div = K('#J_imageView');
						div.html('');
						var piclist="";
						K.each(urlList, function(i, data) {
							div.append('<img src="' + data.url + '">');
							piclist+=data.url+";";
						});
						$("#picturelis").val(piclist);
						editor.hideDialog();
					}
				});
			});
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