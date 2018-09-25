<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> <?php echo C('SOFT_NAME');?>|ace管理系统</title>

        <!-- basic styles -->

        <link href="/Work/PHP_WEB/ace_ismart/Public/Static/aceAdmin/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="/Work/PHP_WEB/ace_ismart/Public/Static/aceAdmin/css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="/Work/PHP_WEB/ace_ismart/Public/Admin/css/main.css">
        <!--[if IE 7]>
          <link rel="stylesheet" href="/Work/PHP_WEB/ace_ismart/Public/Static/aceAdmin/css/font-awesome-ie7.min.css" />
        <![endif]-->

        <!-- page specific plugin styles -->

        <link rel="stylesheet" href="/Work/PHP_WEB/ace_ismart/Public/Static/aceAdmin/css/jquery-ui-1.10.3.custom.min.css" />
        <!-- page specific plugin styles -->

        <link rel="stylesheet" href="/Work/PHP_WEB/ace_ismart/Public/Static/aceAdmin/css/jquery-ui-1.10.3.custom.min.css" />
        <link rel="stylesheet" href="/Work/PHP_WEB/ace_ismart/Public/Static/aceAdmin/css/chosen.css" />
        <link rel="stylesheet" href="/Work/PHP_WEB/ace_ismart/Public/Static/aceAdmin/css/datepicker.css" />
        <link rel="stylesheet" href="/Work/PHP_WEB/ace_ismart/Public/Static/aceAdmin/css/bootstrap-timepicker.css" />
        <link rel="stylesheet" href="/Work/PHP_WEB/ace_ismart/Public/Static/aceAdmin/css/daterangepicker.css" />
        <link rel="stylesheet" href="/Work/PHP_WEB/ace_ismart/Public/Static/aceAdmin/css/colorpicker.css" />
        <!-- ace styles -->

        <link rel="stylesheet" href="/Work/PHP_WEB/ace_ismart/Public/Static/aceAdmin/css/ace.min.css" />
        <link rel="stylesheet" href="/Work/PHP_WEB/ace_ismart/Public/Static/aceAdmin/css/ace-rtl.min.css" />
        <link rel="stylesheet" href="/Work/PHP_WEB/ace_ismart/Public/Static/aceAdmin/css/ace-skins.min.css" />

        <!--[if lte IE 8]>
          <link rel="stylesheet" href="/Work/PHP_WEB/ace_ismart/Public/Static/aceAdmin/css/ace-ie.min.css" />
        <![endif]-->

        <!-- inline styles related to this page -->

        <!-- ace settings handler -->

        <script src="/Work/PHP_WEB/ace_ismart/Public/Static/aceAdmin/js/ace-extra.min.js"></script>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

        <!--[if lt IE 9]>
        <script src="/Work/PHP_WEB/ace_ismart/Public/Static/aceAdmin/js/html5shiv.js"></script>
        <script src="/Work/PHP_WEB/ace_ismart/Public/Static/aceAdmin/js/respond.min.js"></script>
        <![endif]-->

    <!-- ----------------------------------- -->
    
    <link rel="stylesheet" type="text/css" href="/Work/PHP_WEB/ace_ismart/Public/Static/kindeditor/themes/default/default.css" />
    <!-- easyUI css样式 -->
    <link rel="stylesheet" type="text/css" href="/Work/PHP_WEB/ace_ismart/Public/Static/Easyui/themes/metro/easyui.css">
    <link rel="stylesheet" type="text/css" href="/Work/PHP_WEB/ace_ismart/Public/Static/Easyui/themes/color.css">
    <link rel="stylesheet" href="/Work/PHP_WEB/ace_ismart/Public/Static/aceAdmin/css/old/skin.css" />
    <!--/ easyUI css样式 -->
    <script type="text/javascript" src="/Work/PHP_WEB/ace_ismart/Public/Static/Jquery/jquery.min.js"></script>
    <script type="text/javascript" src="/Work/PHP_WEB/ace_ismart/Public/Static/Easyui/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="/Work/PHP_WEB/ace_ismart/Public/Static/Easyui/locale/easyui-lang-zh_CN.js"></script>
    <script charset="utf-8" src="/Work/PHP_WEB/ace_ismart/Public/Static/kindeditor/kindeditor.js"></script>
    <script charset="utf-8" src="/Work/PHP_WEB/ace_ismart/Public/Static/kindeditor/kindeditor-min.js"></script>
    <script charset="utf-8" src="/Work/PHP_WEB/ace_ismart/Public/Static/kindeditor/lang/zh_CN.js"></script>
    <script charset="utf-8" src="/Work/PHP_WEB/ace_ismart/Public/Static/Echarts/echarts.js"></script>
    <script charset="utf-8" src="/Work/PHP_WEB/ace_ismart/Public/Static/aceAdmin/js/old/base.js" /></script><script>
    var ke_pasteType=2;
    var ke_fileManagerJson="<?php echo U('Admin/FilesUpdata/filemanager');?>";
    var ke_uploadJson="<?php echo U('Admin/FilesUpdata/upload');?>";
    var ke_Uid='<?php echo session(C("AUTH_KEY"));;?>';
    var Root='/Work/PHP_WEB/ace_ismart';
    </script>
    <!-- ----------------------------------- -->
</head>
<body>

  <body class="login-layout">
    <div class="main-container">
      <div class="main-content">
        <div class="row">
          <div class="col-sm-10 col-sm-offset-1">
            <div class="login-container">
              <div class="center">
                <h1>
                  <i class="icon-leaf green"></i>
                  <span class="red">中科鸿合</span>
                  <span class="white">系统管理平台</span>
                </h1>
                <h4 class="blue">&copy; <?php echo C('SOFT_NAME');?>—— V <?php echo C('SOFT_VERSION');?></h4>
              </div>

              <div class="space-6"></div>

              <div class="position-relative">
                <div id="login-box" class="login-box visible widget-box no-border">
                  <div class="widget-body">
                    <div class="widget-main">
                      <h4 class="header blue lighter bigger">
                        <i class="icon-coffee green"></i>
                        请输入您的账号信息
                      </h4>

                      <div class="space-6"></div>

                      <form action="<?php echo U('login');?>" method="POST">
                        <fieldset>
                          <label class="block clearfix">
                            <span class="block input-icon input-icon-right">
                              <input type="text" class="form-control" placeholder="用户名" name="username" />
                              <i class="icon-user"></i>
                            </span>
                          </label>

                          <label class="block clearfix">
                            <span class="block input-icon input-icon-right">
                              <input type="password" class="form-control" placeholder="密码" name="password" />
                              <i class="icon-lock"></i>
                            </span>
                          </label>

                          <div class="space"></div>

                          <div class="clearfix">
                            <label class="inline">
                              <input type="checkbox" class="ace" name="rember_password" />
                              <span class="lbl"> 记住密码</span>
                            </label>
                            
                            <button type="button" class="width-35 pull-right btn btn-sm btn-primary" onclick="submit();">
                              <i class="icon-key"></i>
                              登录
                            </button>
                          </div>

                          <div class="space-4"></div>
                        </fieldset>
                      </form>
                    </div><!-- /widget-main -->

                    <div class="toolbar clearfix">
                      <div>
                        <a href="#" onclick="show_box('forgot-box'); return false;" class="forgot-password-link">
                        </a>
                      </div>
                      <div>
                        <a href="#" return false;" class="forgot-password-link">
                          联系管理员
                          <i class="icon-arrow-right"></i>
                        </a>
                      </div>
                    </div>
                  </div><!-- /widget-body -->
                </div><!-- /login-box -->

                <div class="toolbar center">
                  <a href="#" onclick="show_box('login-box'); return false;" class="back-to-login-link">
                    Back to login
                    <i class="icon-arrow-right"></i>
                  </a>
                </div>
              </div><!-- /position-relative -->
            </div><!--/login-container-->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!--/main-content-->
    </div><!-- /.main-container -->

    <!-- inline scripts related to this page -->

    <script type="text/javascript">
      function show_box(id) {
       jQuery('.widget-box.visible').removeClass('visible');
       jQuery('#'+id).addClass('visible');
      }
    </script>
  </body>

<!-- basic scripts -->

        <!-- <![endif]-->

        <!--[if IE]>
        <script src="/Work/PHP_WEB/ace_ismart/Public/Static/aceAdmin/js/jquery-2.0.3.min.js"></script>
        <![endif]-->

        <!--[if !IE]> -->

        <script type="text/javascript">
            window.jQuery || document.write("<script src='/Work/PHP_WEB/ace_ismart/Public/Static/aceAdmin/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
        </script>

        <!-- <![endif]-->

        <!--[if IE]>
            <script type="text/javascript">
             window.jQuery || document.write("<script src='/Work/PHP_WEB/ace_ismart/Public/Static/aceAdmin/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
            </script>
        <![endif]-->

        <script type="text/javascript">
            if("ontouchend" in document) document.write("<script src='/Work/PHP_WEB/ace_ismart/Public/Static/aceAdmin/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
        </script>
        <script src="/Work/PHP_WEB/ace_ismart/Public/Static/aceAdmin/js/bootstrap.min.js"></script>
        <script src="/Work/PHP_WEB/ace_ismart/Public/Static/aceAdmin/js/typeahead-bs2.min.js"></script>

        <!-- page specific plugin scripts -->
        <script src="/Work/PHP_WEB/ace_ismart/Public/Static/aceAdmin/js/jquery.ui.touch-punch.min.js"></script>
        <script src="/Work/PHP_WEB/ace_ismart/Public/Static/aceAdmin/js/markdown/markdown.min.js"></script>
        <script src="/Work/PHP_WEB/ace_ismart/Public/Static/aceAdmin/js/markdown/bootstrap-markdown.min.js"></script>
        <script src="/Work/PHP_WEB/ace_ismart/Public/Static/aceAdmin/js/jquery.hotkeys.min.js"></script>
        <script src="/Work/PHP_WEB/ace_ismart/Public/Static/aceAdmin/js/bootstrap-wysiwyg.min.js"></script>
        <script src="/Work/PHP_WEB/ace_ismart/Public/Static/aceAdmin/js/bootbox.min.js"></script>

        <!-- ace scripts -->

        <script src="/Work/PHP_WEB/ace_ismart/Public/Static/aceAdmin/js/ace-elements.min.js"></script>
        <script src="/Work/PHP_WEB/ace_ismart/Public/Static/aceAdmin/js/ace.min.js"></script>
        <script src="/Work/PHP_WEB/ace_ismart/Public/Static/aceAdmin/js/editor.js"></script>
</body>
</html>