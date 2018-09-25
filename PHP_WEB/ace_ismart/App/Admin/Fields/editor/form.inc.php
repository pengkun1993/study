<?php

$from_return='';

$extra=unserialize($field_one['extra']);

if($G_from_type=='add'){
	$from_return='
	<div class="col-xs-12 col-sm-6 col-lg-6 col-md-6">
	<div class="wysiwyg-editor editor" id="'.$field_one['name'].'_editor">'.$field_one['value'].'</div>
	<textarea style="display:none" id="editor_'.$field_one['name'].'" name="'.$field_one['name'].'">'.$field_one['value'].'</textarea>
	
	<script type="text/javascript">
		$("#content_editor").blur(function()
		{
			$("#editor_'.$field_one['name'].'").html($("#'.$field_one['name'].'_editor").html());
		})

	</script>
	</div>';
}elseif($G_from_type=='edit'){
	$from_return='
	<div class="col-xs-12 col-sm-6 col-lg-6 col-md-6">
	<div class="wysiwyg-editor editor" id="'.$field_one['name'].'_editor">{$_info["'.$field_one['name'].'"]|htmlspecialchars_decode}</div>
	<textarea style="display:none" id="editor_'.$field_one['name'].'" name="'.$field_one['name'].'">{$_info["'.$field_one['name'].'"]|htmlspecialchars_decode}</textarea>
	<script type="text/javascript">
		$("#content_editor").blur(function()
		{
			$("#editor_'.$field_one['name'].'").html($("#'.$field_one['name'].'_editor").html());
		})

	</script>
	</div>';
}else{
	$from_return='
	<div class="col-xs-12">
	<div class="wysiwyg-editor editor" id="'.$field_one['name'].'_editor">'.$field_one['value'].'</div>
	<textarea style="display:none" id="editor_'.$field_one['name'].'" name="'.$field_one['name'].'">'.$field_one['value'].'</textarea>
	<script type="text/javascript">
		$("#content_editor").blur(function()
		{
			$("#editor_'.$field_one['name'].'").html($("#'.$field_one['name'].'_editor").html());
		})

	</script>
	</div>';
}

return $from_return;