<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> <?php echo C('SOFT_NAME');?>|ace管理系统</title>

        <!-- basic styles -->

        <link href="/Study/PHP_WEB/ace_ismart/Public/Static/aceAdmin/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="/Study/PHP_WEB/ace_ismart/Public/Static/aceAdmin/css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="/Study/PHP_WEB/ace_ismart/Public/Admin/css/main.css">
        <!--[if IE 7]>
          <link rel="stylesheet" href="/Study/PHP_WEB/ace_ismart/Public/Static/aceAdmin/css/font-awesome-ie7.min.css" />
        <![endif]-->

        <!-- page specific plugin styles -->

        <link rel="stylesheet" href="/Study/PHP_WEB/ace_ismart/Public/Static/aceAdmin/css/jquery-ui-1.10.3.custom.min.css" />
        <!-- page specific plugin styles -->

        <link rel="stylesheet" href="/Study/PHP_WEB/ace_ismart/Public/Static/aceAdmin/css/jquery-ui-1.10.3.custom.min.css" />
        <link rel="stylesheet" href="/Study/PHP_WEB/ace_ismart/Public/Static/aceAdmin/css/chosen.css" />
        <link rel="stylesheet" href="/Study/PHP_WEB/ace_ismart/Public/Static/aceAdmin/css/datepicker.css" />
        <link rel="stylesheet" href="/Study/PHP_WEB/ace_ismart/Public/Static/aceAdmin/css/bootstrap-timepicker.css" />
        <link rel="stylesheet" href="/Study/PHP_WEB/ace_ismart/Public/Static/aceAdmin/css/daterangepicker.css" />
        <link rel="stylesheet" href="/Study/PHP_WEB/ace_ismart/Public/Static/aceAdmin/css/colorpicker.css" />
        <!-- ace styles -->

        <link rel="stylesheet" href="/Study/PHP_WEB/ace_ismart/Public/Static/aceAdmin/css/ace.min.css" />
        <link rel="stylesheet" href="/Study/PHP_WEB/ace_ismart/Public/Static/aceAdmin/css/ace-rtl.min.css" />
        <link rel="stylesheet" href="/Study/PHP_WEB/ace_ismart/Public/Static/aceAdmin/css/ace-skins.min.css" />

        <!--[if lte IE 8]>
          <link rel="stylesheet" href="/Study/PHP_WEB/ace_ismart/Public/Static/aceAdmin/css/ace-ie.min.css" />
        <![endif]-->

        <!-- inline styles related to this page -->

        <!-- ace settings handler -->

        <script src="/Study/PHP_WEB/ace_ismart/Public/Static/aceAdmin/js/ace-extra.min.js"></script>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

        <!--[if lt IE 9]>
        <script src="/Study/PHP_WEB/ace_ismart/Public/Static/aceAdmin/js/html5shiv.js"></script>
        <script src="/Study/PHP_WEB/ace_ismart/Public/Static/aceAdmin/js/respond.min.js"></script>
        <![endif]-->

    <!-- ----------------------------------- -->
    
    <link rel="stylesheet" type="text/css" href="/Study/PHP_WEB/ace_ismart/Public/Static/kindeditor/themes/default/default.css" />
    <!-- easyUI css样式 -->
    <link rel="stylesheet" type="text/css" href="/Study/PHP_WEB/ace_ismart/Public/Static/Easyui/themes/metro/easyui.css">
    <link rel="stylesheet" type="text/css" href="/Study/PHP_WEB/ace_ismart/Public/Static/Easyui/themes/color.css">
    <link rel="stylesheet" href="/Study/PHP_WEB/ace_ismart/Public/Static/aceAdmin/css/old/skin.css" />
    <!--/ easyUI css样式 -->
    <script type="text/javascript" src="/Study/PHP_WEB/ace_ismart/Public/Static/Jquery/jquery.min.js"></script>
    <script type="text/javascript" src="/Study/PHP_WEB/ace_ismart/Public/Static/Easyui/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="/Study/PHP_WEB/ace_ismart/Public/Static/Easyui/locale/easyui-lang-zh_CN.js"></script>
    <script charset="utf-8" src="/Study/PHP_WEB/ace_ismart/Public/Static/kindeditor/kindeditor.js"></script>
    <script charset="utf-8" src="/Study/PHP_WEB/ace_ismart/Public/Static/kindeditor/kindeditor-min.js"></script>
    <script charset="utf-8" src="/Study/PHP_WEB/ace_ismart/Public/Static/kindeditor/lang/zh_CN.js"></script>
    <script charset="utf-8" src="/Study/PHP_WEB/ace_ismart/Public/Static/Echarts/echarts.js"></script>
    <script charset="utf-8" src="/Study/PHP_WEB/ace_ismart/Public/Static/aceAdmin/js/old/base.js" /></script><script>
    var ke_pasteType=2;
    var ke_fileManagerJson="<?php echo U('Admin/FilesUpdata/filemanager');?>";
    var ke_uploadJson="<?php echo U('Admin/FilesUpdata/upload');?>";
    var ke_Uid='<?php echo session(C("AUTH_KEY"));;?>';
    var Root='/Study/PHP_WEB/ace_ismart';
    </script>
    <!-- ----------------------------------- -->
</head>
<body>

<link rel="stylesheet" type="text/css" href="<?php echo ($ADDON_PATH); ?>base.css">
<div class="fixed-bar datagrid-toolbar">
  <div class="item-title">
    <h3>系统信息</h3>
  </div>
</div>
<div class="info-panel">
  <dl>
    <dt>
      <h3>系统信息</h3>
      <div class="ps-container">
        <ul>
  <?php if(is_array($server_info)): $i = 0; $__LIST__ = $server_info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><?php echo ($key); ?>  <span><?php echo ($vo); ?></span></li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
        <div class="ps-scrollbar-x" style="left: 0px; bottom: 3px; width: 0px;"></div>
        <div class="ps-scrollbar-y" style="top: 0px; right: 3px; height: 25px;"></div>
      </div>
    </dt>
    <dd>
      <ul>
        <li class="w50pre none"><a href='<?php echo C("SOFT_SITE");?>' target='_blank'><?php echo C('SOFT_NAME').C('SOFT_VERSION');?></a></li>
        <li class="w50pre none"><a href="<?php echo C('SOFT_BBS');?>" target='_blank'>官方论坛</a></li>
      </ul>
    </dd>
  </dl>
  <dl>
    <dt>
      <h3>版权信息</h3>
      <div class="ps-container">
        <ul>
          <li>版权所有  <span><a href="<?php echo C('SOFT_SITE');?>" target="_blank"><?php echo C('SOFT_NAME');?></a></span></li>
          <li>负责人  <span><?php echo C('SOFT_NAME');?></span></li>
          <li>软件作者  <span><a href="<?php echo C('SOFT_AUTHOR_SITE');?>" target="_blank"><?php echo C('SOFT_AUTHOR');?></a></span></li>
          <li>联系邮箱  <span><?php echo C('SOFT_AUTHOR_EMAIL');?></span></li>
        </ul>
        <div class="ps-scrollbar-x" style="left: 0px; bottom: 3px; width: 0px;"></div>
        <div class="ps-scrollbar-y" style="top: 0px; right: 3px; height: 25px;"></div>
      </div>
    </dt>
    <dd>
      <ul>
        <li class="w50pre none"><a href="<?php echo C('SOFT_AUTHOR_SITE');?>" target='_blank'>负责人：<?php echo C('SOFT_AUTHOR');?></a></li>
        <li class="w50pre none"><a href='tencent://message/?uin=<?php echo C("SOFT_AUTHOR_QQ");?>&Site=<?php echo C('SOFT_SITE');?>&Menu=yes' target='_blank'>QQ:<?php echo C('SOFT_AUTHOR_QQ');?></a></li>
      </ul>
    </dd>
  </dl>
  <div class=" clear"></div>
</div>

<!-- basic scripts -->

        <!-- <![endif]-->

        <!--[if IE]>
        <script src="/Study/PHP_WEB/ace_ismart/Public/Static/aceAdmin/js/jquery-2.0.3.min.js"></script>
        <![endif]-->

        <!--[if !IE]> -->

        <script type="text/javascript">
            window.jQuery || document.write("<script src='/Study/PHP_WEB/ace_ismart/Public/Static/aceAdmin/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
        </script>

        <!-- <![endif]-->

        <!--[if IE]>
            <script type="text/javascript">
             window.jQuery || document.write("<script src='/Study/PHP_WEB/ace_ismart/Public/Static/aceAdmin/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
            </script>
        <![endif]-->

        <script type="text/javascript">
            if("ontouchend" in document) document.write("<script src='/Study/PHP_WEB/ace_ismart/Public/Static/aceAdmin/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
        </script>
        <script src="/Study/PHP_WEB/ace_ismart/Public/Static/aceAdmin/js/bootstrap.min.js"></script>
        <script src="/Study/PHP_WEB/ace_ismart/Public/Static/aceAdmin/js/typeahead-bs2.min.js"></script>

        <!-- page specific plugin scripts -->
        <script src="/Study/PHP_WEB/ace_ismart/Public/Static/aceAdmin/js/jquery.ui.touch-punch.min.js"></script>
        <script src="/Study/PHP_WEB/ace_ismart/Public/Static/aceAdmin/js/markdown/markdown.min.js"></script>
        <script src="/Study/PHP_WEB/ace_ismart/Public/Static/aceAdmin/js/markdown/bootstrap-markdown.min.js"></script>
        <script src="/Study/PHP_WEB/ace_ismart/Public/Static/aceAdmin/js/jquery.hotkeys.min.js"></script>
        <script src="/Study/PHP_WEB/ace_ismart/Public/Static/aceAdmin/js/bootstrap-wysiwyg.min.js"></script>
        <script src="/Study/PHP_WEB/ace_ismart/Public/Static/aceAdmin/js/bootbox.min.js"></script>

        <!-- ace scripts -->

        <script src="/Study/PHP_WEB/ace_ismart/Public/Static/aceAdmin/js/ace-elements.min.js"></script>
        <script src="/Study/PHP_WEB/ace_ismart/Public/Static/aceAdmin/js/ace.min.js"></script>
        <script src="/Study/PHP_WEB/ace_ismart/Public/Static/aceAdmin/js/editor.js"></script>
</body>
</html>