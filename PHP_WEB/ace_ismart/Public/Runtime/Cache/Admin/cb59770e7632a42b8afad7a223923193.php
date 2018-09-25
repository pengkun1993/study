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

  <div class="fixed-bar" id="DataBase_Bar">
    <div class="item-title">
    	<div class="page-header">
		    <h1>数据备份
				<small>
					<i class="icon-double-angle-right"></i>
					<span class="lead">&nbsp;&nbsp;列表</span>
					<a class="top_a" id="export" href="JavaScript:void(0);" onClick="export_table();"><span>备份表</span></a>
			        <a class="top_a" id="optimize" href="JavaScript:void(0);" onClick="optimize();"><span>优化表</span></a>
			        <a class="top_a" id="repair" href="JavaScript:void(0);" onClick="repair();"><span>修复表</span></a>
				</small>
			</h1>
		</div>
    </div>
  </div>
    <table id="DataBase_Data_List">
      <thead>
        <tr>
          <th data-options="field:'ids',width:50"></th>
          <th data-options="field:'name',width:200">表名</th>
          <th data-options="field:'rows',width:120">数据量</th>
          <th data-options="field:'data_length',width:120">数据大小</th>
          <th data-options="field:'create_time',width:160">创建时间</th>
          <th data-options="field:'info',width:160">备份状态</th>
          <th data-options="field:'action',width:120">操作</th>
        </tr>
      </thead>
  <form id="export-form"  method="post">
      <tbody>
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$table): $mod = ($i % 2 );++$i;?><tr>
            <td><input class="ids" checked="chedked" type="checkbox" name="tables[]" value="<?php echo ($table["name"]); ?>"></td>
            <td><?php echo ($table["name"]); ?></td>
            <td><?php echo ($table["rows"]); ?></td>
            <td><?php echo (format_bytes($table["data_length"])); ?></td>
            <td><?php echo ($table["create_time"]); ?></td>
            <td><div class="<?php echo ($table["name"]); ?>_box info_box">-</div></td>
            <td><a href="<?php echo U('optimize?tables='.$table['name']);?>">优化表</a>&nbsp; <a href="<?php echo U('repair?tables='.$table['name']);?>">修复表</a></td>
          </tr><?php endforeach; endif; else: echo "" ;endif; ?>
      </tbody>
  </form>
    </table>
<script type="text/javascript">
$(function() {
	$("#DataBase_Data_List").datagrid({
		fit : true,
		striped : true,
		border : false,
		toolbar : '#DataBase_Bar',
	});
})
//优化表
var var_optimize=0;
function optimize(){
	if(var_optimize==1){
		alert('正在优化请稍等...');
	}else{
		$('#optimize').html('<span>正在优化,请勿关闭或者刷新窗口</span>');
		var_optimize=1;
				$.messager.show({
					title:'操作成功',
					msg:'优化开始，时间可能较长，请勿关闭窗口，或重新打开',
					timeout:10000,
					showType:'slide'
				});
		$.post('<?php echo U("optimize");?>', $('#export-form').serialize(), function(data){
			if(data.status){
				$.messager.show({
					title:'成功信息',
					msg:data.info,
					timeout:3000,
					showType:'slide'
				});
			} else {
				$.messager.alert('失败信息',data.info,'');
			}
			$('#optimize').html('<span>优化表</span>');
			var_optimize=0;
		}, "json");
	}
	return false;
}
//修复表
var var_repair=0;
function repair(){
	if(var_repair==1){
		alert('正在修复请稍等...');
	}else{
		$('#repair').html('<span>正在修复,请勿关闭或者刷新窗口</span>');
		var_repair=1;
				$.messager.show({
					title:'操作成功',
					msg:'修复开始，时间可能较长，请勿关闭窗口，或重新打开',
					timeout:3000,
					showType:'slide'
				});
		$.post('<?php echo U("repair");?>', $('#export-form').serialize(), function(data){
			if(data.status){
				$.messager.show({
					title:'成功信息',
					msg:data.info,
					timeout:10000,
					showType:'slide'
				});
			} else {
				$.messager.alert('失败信息',data.info,'');
			}
			$('#repair').html('<span>修复表</span>');
			var_repair=0;
		}, "json");
	}
	return false;
}
//备份表
var var_export_table=0;
function export_table(){
	if(var_export_table==1){
		alert('正在备份请稍等...');
	}else{
		$('#export').html('<span>正在备份,请勿关闭或者刷新窗口</span>');
		var_export_table=1;
		$.post('<?php echo U("export");?>', $('#export-form').serialize(), function(data){
			if(data.status){
				tables = data.tables;
				backup(data.tab);
				$.messager.show({
					title:'操作成功',
					msg:'备份开始，时间可能较长，请勿关闭窗口，或重新打开',
					timeout:10000,
					showType:'slide'
				});
				window.onbeforeunload = function(){ return "正在备份数据库，请不要关闭！" }
			} else {
				$.messager.alert('失败信息',data.info,'');
			}
			var_export_table=0;
		}, "json");
	}
	return false;
}

        function backup(tab, status){
            status && showmsg(tab.id, "开始备份...(0%)");
            $.get("<?php echo U('export');?>", tab, function(data){
                if(data.status){
                    showmsg(tab.id, data.info);
                    if(!$.isPlainObject(data.tab)){
						$.messager.show({
							title:'备份成功',
							msg:'备份完成，点击重新备份',
							timeout:3000,
							showType:'slide'
						});
						$('.info_box').html('-')
						$('#export').html('<span>备份表</span>');
                        window.onbeforeunload = function(){ return null }
                        return true;
                    }else{
                    	backup(data.tab, tab.id != data.tab.id);
					}
                }
            }, "json");

        }

        function showmsg(id, msg){
            $('.'+tables[id]+'_box').html(msg);
        }
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