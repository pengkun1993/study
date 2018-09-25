<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ThinkPHP模型自动验证和填充</title>
        <!-- Bootstrap CSS -->
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>

        <div class="container" style="margin-top:32px;">
            <a class="btn btn-primary" data-toggle="modal" href='#modal-id'>新增用户</a>
            <!-- 用户列表 -->
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>username</th>
                        <th>email</th>
                        <th>password</th>
                        <th>create_time</th>
                        <th>status</th>
                        <th>birthday</th>
                        <th>sex</th>
                        <th>ip</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(is_array($users)): $i = 0; $__LIST__ = $users;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$user): $mod = ($i % 2 );++$i;?><tr>
                        <td><?php echo ($user["id"]); ?></td>
                        <td><?php echo ($user["username"]); ?></td>
                        <td><?php echo ($user["email"]); ?></td>
                        <td><?php echo ($user["password"]); ?></td>
                        <td><?php echo (date('Y-m-d H:i:s',$user["create_time"])); ?></td>
                        <td><?php echo ($user["status"]); ?></td>
                        <td><?php echo ($user["birthday"]); ?></td>
                        <td><?php echo ($user["sex"]); ?></td>
                        <td><?php echo ($user["ip"]); ?></td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>
            <hr/>
        </div>
        <div class="modal fade" id="modal-id">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">新增用户</h4>
                    </div>
                    <div class="modal-body">
                        <form action="/check_data/" method="POST" class="form-horizontal" role="form">
                            <!-- 用户名 -->
                            <div class="form-group">
                                <label class="col-xs-2">用户名</label>
                                <div class="col-xs-6">
                                    <input type="text" class="form-control" name="username" value="<?php echo ($old["username"]); ?>">
                                </div>
                                <div class="col-xs-4">
                                    <?php if(isset($errors['username'])): ?><b><?php echo ($errors["username"]); ?></b><?php endif; ?>
                                </div>
                            </div>
                            <!-- 电子邮件 -->
                            <div class="form-group">
                                <label class="col-xs-2">电子邮件</label>
                                <div class="col-xs-6">
                                    <input type="text" class="form-control" name="email" value="<?php echo ($old["email"]); ?>">
                                </div>
                                <div class="col-xs-4">
                                    <?php if(isset($errors['email'])): ?><b><?php echo ($errors["email"]); ?></b><?php endif; ?>
                                </div>
                            </div>
                            <!-- 密码 -->
                            <div class="form-group">
                                <label class="col-xs-2">密码</label>
                                <div class="col-xs-6">
                                    <input type="password" class="form-control" name="password"  value="<?php echo ($old["password"]); ?>">
                                </div>
                                <div class="col-xs-4">
                                    <?php if(isset($errors['password'])): ?><b><?php echo ($errors["password"]); ?></b><?php endif; ?>
                                </div>
                            </div>
                            <!-- 确认密码 -->
                            <div class="form-group">
                                <label class="col-xs-2">确认密码</label>
                                <div class="col-xs-6">
                                    <input type="password" class="form-control" name="confirm_password"  value="<?php echo ($old["confirm_password"]); ?>">
                                </div>
                                <div class="col-xs-4">
                                    <?php if(isset($errors['confirm_password'])): ?><b><?php echo ($errors["confirm_password"]); ?></b><?php endif; ?>
                                </div>
                            </div>
                            <!-- 生日 -->
                            <div class="form-group">
                                <label class="col-xs-2">生日</label>
                                <div class="col-xs-6">
                                    <input type="text" class="form-control" name="birthday"  value="<?php echo ($old["birthday"]); ?>">
                                </div>
                                <div class="col-xs-4">
                                    <?php if(isset($errors['birthday'])): ?><b><?php echo ($errors["birthday"]); ?></b><?php endif; ?>
                                </div>
                            </div>
                            <!-- 性别 -->
                            <div class="form-group">
                                <label class="col-xs-2">性别</label>
                                <div class="col-xs-6">
                                    <select name="sex" class="form-control">
                                        <option value="0">不确定</option>
                                        <option value="1">男</option>
                                        <option value="2">女</option>
                                    </select>
                                </div>
                                <div class="col-xs-4">
                                    <?php if(isset($errors['sex'])): ?><b><?php echo ($errors["sex"]); ?></b><?php endif; ?>
                                </div>
                            </div>
                            <!-- 猜猜看-->
                            <div class="form-group">
                                <label class="col-xs-2">有多少人</label>
                                <div class="col-xs-6">
                                    <input type="text" class="form-control" name="friends"  value="<?php echo ($old["friends"]); ?>">
                                </div>
                                <div class="col-xs-4">
                                    <?php if(isset($errors['friends'])): ?><b><?php echo ($errors["friends"]); ?></b><?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-10 col-sm-offset-2">
                                    <button type="submit" class="btn btn-primary">注册</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- jQuery -->
        <script src="//code.jquery.com/jquery.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

        <?php if(isset($errors)): ?><script type="text/javascript">
	                      $(function(){
	                                $('#modal-id').modal('show');
	                      });
	        </script><?php endif; ?>

    </body>
</html>