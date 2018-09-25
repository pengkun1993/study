<?php if (!defined('THINK_PATH')) exit();?>	<div class="fixed-bar" id="<?php echo ($ModelInfo['name']); ?>_Bar">
		<div class="item-title">
			<div class="page-header">
				<h1><a href="{:U('Admin/<?php echo ($ModelInfo['name']); ?>/index')}"><?php echo ($ModelInfo['title']); ?></a>
					<small>
						<i class="icon-double-angle-right"></i>
						<span class="lead">&nbsp;&nbsp;新增</span>
					</small>
				</h1>
			</div>
		</div>
	</div>
	<div class="col-xs-12 marg-top">
		<form class="form-horizontal" role="form" method="POST" id="<?php echo ($ModelInfo['name']); ?>_Form">
			<?php if(is_array($Form)): $i = 0; $__LIST__ = $Form;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$FormShow): $mod = ($i % 2 );++$i;?><div class="form-group">
					<label class="col-xs-5 col-sm-1 control-label no-padding-right" for="form-field-1"><?php echo ($FormShow['title']); ?>:</label>

					<div class="col-xs-11">
						<?php echo ($FormShow['form']); ?>
						<?php if(!empty($$FormShow['remark'])): ?><span class="help-inline col-xs-12 col-sm-9">
							<span class="middle"><?php echo ($FormShow['remark']); ?></span>
						</span><?php endif; ?>
					</div>
				</div>
				<hr/><?php endforeach; endif; else: echo "" ;endif; ?>
			<div class="clearfix">
				<div class="col-md-offset-1 col-md-9">
					<button class="btn btn-lg btn-success" type="button" onclick="$('#<?php echo ($ModelInfo['name']); ?>_Form').submit();">
						<i class="icon-ok bigger-110"></i>
						<span class="lead">提交</span>
					</button>
				</div>
			</div>
		</form>
	</div>