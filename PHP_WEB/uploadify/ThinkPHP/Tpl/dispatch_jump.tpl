<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>跳转提示</title>
</head>
<body>
<DIV id=divPage align="center">
  <TABLE cellSpacing=0 cellPadding=0 width=540 align=center border=0>
    <TBODY>
      <TR>
    <TD height="150"><div align="center"><!-- --></div></TD>
      </TR>
    </TBODY>
  </TABLE>
  <TABLE 
style="BORDER-RIGHT: #6666FF 2px solid; BORDER-TOP: #6666FF 2px solid; BORDER-LEFT: #6666FF 2px solid; BORDER-BOTTOM: #6666FF 2px solid" 

cellSpacing=0 cellPadding=10 width=540 align=center border=0>
    <TBODY>
      <TR>
    <TD style="BORDER-BOTTOM: blue 1px dotted; height:60px"><h2 class="red">
	<present name="message"><img src='__PUBLIC__/images/ok.png' align="absmiddle"><?php echo($message); ?><else/><img src='__PUBLIC__/images/error.png' align="absmiddle"><?php echo($error); ?></present></h2></TD>
      </TR>
      <TR>
    <TD height="30">本页面将在<SPAN class=red14b id=wait><?php echo($waitSecond); ?></SPAN>秒钟后将自动转入，如果您的浏览器不能自动跳转请点击 [<a href="<?php echo($jumpUrl); ?>" style="color:red" id="href">这里</a>]</TD>
      </TR>
    </TBODY>
  </TABLE>
</DIV>
<script type="text/javascript">
(function(){
var wait = document.getElementById('wait'),href = document.getElementById('href').href;
var interval = setInterval(function(){
	var time = --wait.innerHTML;
	if(time <= 0) {
		location.href = href;
		clearInterval(interval);
	};
}, 1000);
})();
</script>
</body>
</html>