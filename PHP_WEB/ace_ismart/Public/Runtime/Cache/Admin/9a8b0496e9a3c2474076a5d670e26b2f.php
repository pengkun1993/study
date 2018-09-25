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
      <div class="page-header">
        <h1><a href="<?php echo U('Admin/ModelField/index',array('model_id'=>I('get.model_id')));?>">字段管理</a>
          <small>
            <i class="icon-double-angle-right"></i>
            <span class="lead">&nbsp;&nbsp;修改</span>
          </small>
        </h1>
      </div>
    </div>
  </div>
  <div class="col-xs-12 marg-top">
      <form class="form-horizontal" role="form" method="POST" id="ModelField_Form">
      <div class="form-group">
        <label class="col-sm-1 control-label no-padding-right" for="for_name"> 字段名: </label>
        <div class="col-xs-11">
          <input name="name" id="for_name" value="<?php echo ($_info['name']); ?>" type="text" class="col-xs-9 col-sm-3" >
        </div>
      </div>
      <hr/>
      <div class="form-group">
        <label class="col-sm-1 control-label no-padding-right" for="for_title"> 字段标题: </label>
        <div class="col-xs-11">
          <input name="title" id="for_title" value="<?php echo ($_info['title']); ?>" type="text" class="col-xs-9 col-sm-3">
        </div>
      </div>
      <hr/>
      <div class="form-group">
        <label class="col-sm-1 control-label no-padding-right" for="for_type"> 数据类型:</label>
        <div class="col-xs-11">
          <select style="height:30px;" id="for_type" name="type" class="easyui-combobox col-xs-8 col-sm-3" data-options="value:'<?php echo ($_info['type']); ?>',multiple:false,required:false,editable:false, onSelect:function(rec){field_setting(rec.value)}">
              <?php if(is_array(C("FIELD_LIST"))): $i = 0; $__LIST__ = C("FIELD_LIST");if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["type"]); ?>"><?php echo ($vo["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
            <span class="middle"><strong style="color:#F00">&nbsp;&nbsp;&nbsp;修改数据类型后，字段参数会发生改变，请慎重！</strong>
            </span>
        </div>
      </div>
      <hr/>
      <div class="form-group">
        <label class="col-sm-1 control-label no-padding-right" for="for_field"> 字段定义: </label>
        <div class="col-xs-11">
          <select style="height:30px;float:left;" id="for_field" name="field" class="col-xs-8 col-sm-3 easyui-combobox" data-options="value:'<?php echo ($_info['field']); ?>',multiple:false">
          </select>
          <span class="middle">
            &nbsp;&nbsp;如果没有你想要的字段定义，可以直接输入
          </span>
        </div>
      </div>
      <hr/>
      <div class="form-group">
        <label class="col-sm-1 control-label no-padding-right"> 字段属性: </label>
        <div class="col-xs-11">
          <div id="extra"><?php echo ($form_data); ?></div>
        </div>
      </div>
      <hr/>
      <div class="form-group">
        <label class="col-sm-1 control-label no-padding-right" for="for_value"> 字段默认值:</label>
        <div class="col-xs-11">
          <input name="value" style="height:30px;" id="for_value" value="<?php echo ($_info['value']); ?>" type="text" class="col-xs-9 col-sm-3">
        </div>
      </div>
      <hr/>
      <div class="form-group">
        <label class="col-sm-1 control-label no-padding-right" for="for_remark"> 备注:</label>
        <div class="col-xs-11">
          <textarea name="remark" id="for_remark" class="col-xs-9 col-sm-3" style="height: 100px"><?php echo ($_info['remark']); ?></textarea>
        </div>
      </div>
      <hr/>
      <div class="form-group">
        <label class="col-sm-1 control-label no-padding-right" for="for_sort_l">字段排序:</label>
        <div class="col-xs-11">
          列表
            <input class="" style="height:30px;width: 40px" type="text" name="sort_l" id="for_sort_l" value="<?php echo ($_info['sort_l']); ?>">
            搜索
            <input class="" style="height:30px;width: 40px" type="text" name="sort_s" value="<?php echo ($_info['sort_s']); ?>">
            新增
            <input class="" style="height:30px;width: 40px" type="text" name="sort_a" value="<?php echo ($_info['sort_a']); ?>">
            修改
            <input class="" style="height:30px;width: 40px" type="text" name="sort_e" value="<?php echo ($_info['sort_e']); ?>">
            <span class="middle">
              &nbsp;&nbsp;如果为0,即不显示
            </span>
        </div>
      </div>
      <hr/>
      <div class="form-group">
        <label class="col-sm-1 control-label no-padding-right" for="for_l_width"> 字段默认值:</label>
        <div class="col-xs-11">
          <input name="l_width" style="height:30px;" id="for_l_width" value="<?php echo ($_info['l_width']); ?>" type="text" class="col-xs-9 col-sm-3">
        </div>
      </div>
      <hr/>
      <div class="form-group">
        <label class="col-sm-1 control-label no-padding-right" for="for_validate_rule">验证规则:</label>
        <div class="col-xs-11">
          <textarea name="validate_rule" id="for_validate_rule" class="col-xs-9 col-sm-3" style="height: 100px"><?php echo ($_info['validate_rule']); ?></textarea>
          <a id="for_validate_rule_c" href="JavaScript:void(0);">&nbsp;&nbsp;帮助生成</a>
        </div>
      </div>
      <hr />
      <div class="form-group">
        <label class="col-sm-1 control-label no-padding-right" for="for_auto_rule">完成规则:</label>
        <div class="col-xs-11">
          <textarea name="auto_rule" id="for_auto_rule" class="col-xs-9 col-sm-3"  style="height: 100px"><?php echo ($_info['auto_rule']); ?></textarea>
        </div>
      </div>
      <hr/>
      <div class="form-group">
        <label class="col-sm-1 control-label no-padding-right" for="for_status">状态:</label>
        <div class="col-xs-11">
          <select style="height:30px;" id="for_status" name="status" class="col-xs-7 col-sm-3" def-data="<?php echo ($_info['status']); ?>">
              <option value="0" >禁用</option>
              <option value="1" selected>启用</option>
            </select>
            <script type="text/javascript">
    var sel=document.getElementById('for_status');
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
      <hr/>
      <div class="clearfix">
        <div class="col-md-offset-1 col-md-9">
          <button class="btn btn-lg btn-success" type="button" onclick="$('#ModelField_Form').submit();">
            <i class="icon-ok bigger-110"></i>
            <span class="lead">提交</span>
          </button>
        </div>
      </div>
      <input type="hidden" name="model_id" value='<?php echo ($_info["model_id"]); ?>' />
      <input type="hidden" name="id" value='<?php echo ($_info["id"]); ?>' />
    </form>
    <script type="text/javascript">
      function field_setting(fieldtype) {
          if (fieldtype == "") {
              return false;
          }
          $.getJSON("<?php echo U('Admin/Function/field_setting');?>&r_type=json",{fieldtype:fieldtype}, function (data) {
              $('#extra').html(data.extra);
          $.parser.parse('#extra');
          });
        $('#for_field').combobox({
          url: '<?php echo U("Admin/Function/get_field_default");?>&fieldtype=' + fieldtype,
          valueField: 'id',
          textField: 'text'
        });
    }
  </script>
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