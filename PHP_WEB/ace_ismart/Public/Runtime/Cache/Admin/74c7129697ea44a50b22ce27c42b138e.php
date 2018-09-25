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

  <div class="fixed-bar" id="Config_Bar">
    <div class="item-title">
      <div class="page-header">
        <h1><a href="<?php echo U('Admin/Config/group');?>">网站设置</a>
          <small>
            <i class="icon-double-angle-right"></i>
            <?php if(is_array($type)): $i = 0; $__LIST__ = $type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$group): $mod = ($i % 2 );++$i;?><a style="margin-left:20px;" href="<?php echo U('?id='.$key);?>" <?php if($key == $id): ?>class="current"<?php endif; ?>><span ><?php echo ($group); ?>配置</span></a><?php endforeach; endif; else: echo "" ;endif; ?>
          </small>
        </h1>
      </div>
    </div>
  </div>
  <div class="col-xs-12 marg-top">
    <form class="form-horizontal" role="form" method="POST" id="Config_Form" action="<?php echo U('group');?>&id=<?php echo ($id); ?>">
      <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$config): $mod = ($i % 2 );++$i;?><div class="form-group">
          <label class="col-sm-1 control-label no-padding-right" for="form-<?php echo ($config["name"]); ?>"> <?php echo ($config["title"]); ?>: </label>

          <div class="col-xs-11">
            <?php switch($config["type"]): case "0": ?><input type="text" name="config[<?php echo ($config["name"]); ?>]" id="for_<?php echo ($config["name"]); ?>" value="<?php echo ($config["value"]); ?>" class="col-xs-9 col-sm-3"/><?php break;?>
            <?php case "1": ?><input type="text" name="config[<?php echo ($config["name"]); ?>]" id="for_<?php echo ($config["name"]); ?>" value="<?php echo ($config["value"]); ?>" class="col-xs-9 col-sm-3"/><?php break;?>
            <?php case "2": ?><textarea name="config[<?php echo ($config["name"]); ?>]" id="for_<?php echo ($config["name"]); ?>" type="text" class="col-xs-9 col-sm-3"><?php echo ($config["value"]); ?></textarea><?php break;?>
            <?php case "3": ?><textarea name="config[<?php echo ($config["name"]); ?>]" id="for_<?php echo ($config["name"]); ?>" type="text" class="col-xs-9 col-sm-3"><?php echo ($config["value"]); ?></textarea><?php break;?>
            <?php case "4": ?><select name="config[<?php echo ($config["name"]); ?>]" id="for_<?php echo ($config["name"]); ?>" class="col-xs-9 col-sm-3">
                <?php $_result=model_field_attr($config['extra']);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>"><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
              </select><?php break;?>
            <?php case "5": ?><input type="text" name="config[<?php echo ($config["name"]); ?>]" id="for_<?php echo ($config["name"]); ?>" value="<?php echo ($config["value"]); ?>" class="col-xs-9 col-sm-3"  config_date="1"><?php break; endswitch;?>
          <?php if(!empty($config["remark"])): ?><span class="help-inline col-xs-12 col-sm-9">
              <span class="middle"><?php echo ($config["remark"]); ?></span>
            </span><?php endif; ?>
          </div>
        </div>
        <hr/><?php endforeach; endif; else: echo "" ;endif; ?>
      <div class="clearfix">
        <div class="col-md-offset-1 col-md-9">
          <button class="btn btn-lg btn-success" type="button" onclick="$('#Config_Form').submit();">
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