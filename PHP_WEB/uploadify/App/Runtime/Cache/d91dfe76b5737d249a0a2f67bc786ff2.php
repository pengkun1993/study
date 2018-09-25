<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Cache-control" content="private, must-revalidate" />
<title>uploadify无刷新多图片上传</title>
<script type="text/javascript" src="__PUBLIC__/js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/uploadify-v3.1/jquery.uploadify-3.1.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/ThinkBox/jquery.ThinkBox.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/zeroclipboard/ZeroClipboard.js"></script>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/style.css" media="all">
<link rel="stylesheet" type="text/css" href="__PUBLIC__/js/ThinkBox/css/ThinkBox.css" media="all">
<link rel="stylesheet" type="text/css" href="__PUBLIC__/js/uploadify-v3.1/uploadify.css" media="all">
<script type="text/javascript">
function getElementOffset(e){
	 var t = e.offsetTop;
	 var l = e.offsetLeft;
	 var w = e.offsetWidth;
	 var h = e.offsetHeight-1;

	 while(e=e.offsetParent) {
	 t+=e.offsetTop;
	 l+=e.offsetLeft;
	 }
	 return {
	 top : t,
	 left : l,
	 width : w,
	 height : h
	 }
}

function copyUrl(o){
    var imgurl = $(o).parent().parent().attr('data-src');
    var input_field = $('#copytocpbord').find('input[type=text]');
    var input_btn = $('#copytocpbord').find('input[type=button]');
    var pos = getElementOffset(o);
    input_field.val(imgurl);
    
    if(pos.left+360 > document.documentElement.clientWidth){
        $('#copytocpbord').css('left',document.documentElement.clientWidth-360);
    }else{
        $('#copytocpbord').css('left',pos.left);
    }
    $('#copytocpbord').css('top',pos.top+pos.height);
    $('#copytocpbord').show();
    
    clipobj = copy_clip(imgurl,'cp_click','click_cp_button');
    $('#copytocpbord').find('input[name=close]').unbind('click').bind('click',function(){
		$('#copytocpbord').hide();
        clipobj.destroy();
	});
}
function click_cp_button(){
    var pos = getElementOffset($('#cp_click').get(0));
    $('#copyedok').css('left',pos.left);
    $('#copyedok').css('top',pos.top);
    $('#copyedok').show().animate({opacity: 1.0}, 1000).fadeOut();
    $('#copytocpbord').animate({opacity: 1.0}, 1000).fadeOut();
}
function copy_clip(copy,bid,func){
	var clip = new ZeroClipboard.Client();
	clip.setText('');
	clip.setHandCursor( true );
	clip.addEventListener('mouseOver',function(client) { 
		clip.setText(copy);
	});

	clip.addEventListener('complete',function(o){
	    clip.destroy();
		eval(func+'();');
	})
	clip.glue(bid);
	return clip;
}

function rename_pic(o){
    var info = $(o).parent();
    var info_txt = info.text();
	var str=$(o).parent().parent().attr('data-path');	
	var arr=str.split('+');
	var path=arr[0];
    info.html('<input id="input_id" type="text" value="'+info_txt+'" class="ipt_2" />');
    var input = $('#input_id');
    input.focus();
    input.select();
    input.blur(
        function(){
			if(info_txt!=this.value){
				var album=$('#album').val();
				var str1=path+'+'+info_txt;
				var str2=path+'+'+this.value;
				str=album.replace(str1,str2);
				//alert(str1+str2);
				info.html('<a onclick="rename_pic(this)">'+this.value+'</a>');
				$('#album').val(str);
			}else{
				info.html('<a onclick="rename_pic(this)">'+this.value+'</a>');
			}
        }
    );
    /*input.unbind('keypress').bind('keypress',
        function(e){
            if(e.keyCode == 13){
                input.blur();
            }
        }
    );*/
}
function rename_pic1(o){
    var info = $(o).parent().parent().find('.info');
    var info_txt = info.text();
	var path=$(o).parent().parent().attr('data-path');
    info.html('<input id="input_id" type="text" value="'+info_txt+'" class="ipt_2" />');
    var input = $('#input_id');
    input.focus();
    input.select();
    input.blur(
        function(){
			if(info_txt!=this.value){
				var album=$('#album').val();
				var arr=path.split('+');
				var str2=arr[0]+'+'+this.value;
				str=album.replace(path,str2);
				info.html('<a onclick="rename_pic(this)">'+this.value+'</a>');
				$('#album').val(str);
			}else{
				info.html('<a onclick="rename_pic(this)">'+this.value+'</a>');
			}
        }
    );
}
function del_pic(o){
	var parent=$(o).parent().parent();
	var str=parent.attr('data-path');	
	var arr=str.split('+');
	var path=arr[0];	
	if(confirm('确定要删除吗？')){
		$.ajax({
			type: "POST",   //访问WebService使用Post方式请求
			url: '<?php echo U("Index/del");?>', //调用WebService的地址和方法名称组合---WsURL/方法名
			data:"path="+encodeURI(path),
			success: function(data){	
				parent.animate({opacity: 'hide' }, "slow");
				var album=$('#album').val();
				var tmp=album.replace(str+',','');
				var tmp1=tmp.replace(','+str,'');
				var tmp2=tmp1.replace(str,'');
				$('#album').val(tmp2);
			}
		});
	}
}
function set_pic_cover(o){
	var str=$(o).parent().parent().attr('data-path');
	var arr=str.split('+');
	$('#cover').val(arr[0]);			
	var pos = getElementOffset($(o).parent().parent().find('span.img').get(0));
	//var pos = getElementOffset(o);   
    $('#info_msg').css('top',pos.top+20);
	$('#info_msg').css('left',pos.left);
	//$('#info_msg').css('top',pos.top-50);
	$('#info_msg').html('已设为封面');
	//$('#info_msg').show();
	$('#info_msg').show().animate({opacity: 1.0}, 1000).fadeOut();
	$("div[class='selected']").hide();
	$(o).parent().parent().find("div[class='selected']").show();
}
$(function (){
		$("#upload").uploadify({
			'queueSizeLimit' : 20,
			'removeTimeout' : 0.5,
			'preventCaching' : true,
			'multi'    : true,
			'swf' 			: '__PUBLIC__/js/uploadify-v3.1/uploadify.swf',
			'uploader' 		: '<?php echo U("Index/upload");?>?PHPSESSID=<?php echo ($data["session_tem"]); ?>',//PHPSESSID为登录用户要用到的，在判断登录的地方用到
			'buttonText' 	: '<img src="__PUBLIC__/images/add.png">',
			'width' 		: '84',
			'height' 		: '30',
			'fileTypeExts'	: '*.jpg; *.png; *.gif;',
			'onUploadSuccess' : function(file, data, response){
				var data = $.parseJSON(data);	
				if(data['status'] == 0){
					$.ThinkBox.error(data['info'],{'delayClose':3000});
					return;
				}
				//var img='<img src="__PIC_URL__/'+data['data']+'?random='+Math.random()+'" width="100" height="80" /> ';
				var img='<li data-src="__PIC_URL__/'+data['data']+'" data-path="'+data['data']+'+未命名"><span class="img"><img src="__PIC_URL__/'+data['data']+'?random='+Math.random()+'" width="100" height="80" border="0"/></span><span class="info"><a onclick="rename_pic(this)">未命名</a></span><span class="control"><a href="javascript:void(0)" onclick="copyUrl(this)"><img src="__PUBLIC__/images/copyu.gif" alt="复制网址" title="复制网址" /></a><a href="javascript:;" onclick="del_pic(this)" ><img src="__PUBLIC__/images/delete.gif" alt="直接删除" title="直接删除" /></a><a href="javascript:void(0)" onclick="set_pic_cover(this)"><img src="__PUBLIC__/images/cover.gif" alt="设为封面" title="设为封面" /></a><a href="javascript:void(0)" onclick="rename_pic1(this)"><img src="__PUBLIC__/images/rename.gif" alt="修改标题" title="修改标题" /></a></span><div class="selected" ></div></li>'
				//两个预览窗口赋值
				$('#pic_list').append(img);
				//隐藏表单赋值
				/*第一张图片为封面*/
				if(!$('#cover').val()){
					$('#cover').val(data['data']);
					$("div[class='selected']").show();
				}
				$('#album').val($('#album').val()+','+data['data']+'+未命名');
		     }
		});
	});
</script>

</head>
<body>
<form action="__URL__/save" name="myform" id="myform" method="post">
<div style="width:610px; height:auto; border:1px solid #e1e1e1; font-size:12px; padding:10px;">
	<!-- <div id="thumbnails">
	<ul id="pic_list" style="margin:5px;" class="album"></ul>
	<div style="clear: both;"></div>
	</div> -->
	<input type="file"  id="upload" name="upload"  size="2"/>
	<input name="cover" type="hidden" id="cover" value="" />
	<input name="album" type="hidden" id="album" value="" />
</div>
<div id="info_msg" style="display:none;width:100px;"></div>
<div id="copyedok" style="display:none">已经拷贝到剪贴板！</div>
<!-- <div id="copytocpbord" style="display:none;">
    <input type="text" class="ipt_3" value="" /> <input id="cp_click" type="button" class="btn" value="复制到剪切板" /> <input type="button" class="btn" name="close" value="关闭" />
</div> -->
<input type="submit" value="提交"/>
<!--
<div id="movetoalbum" style="display:none;">
    <span class="album"><select name="albums"></select></span>&nbsp;&nbsp; <input type="button" name="move" class="btn" value="移动" /> <input type="button" class="btn" name="close" value="关闭" />
</div>-->
</form>
</body>
</html>