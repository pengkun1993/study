<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<table>
		<tr>
			<td>出生年份</td>
			<td>{$birthday_year|default="没有数据"}</td>
		</tr>
		<tr>
			<td>年龄</td>
			<td>{$birthday_year|getAge}</td>
		</tr>
	</table>
	<?php $_FRIENDS_10315=get_user_friends(2);if(empty($_FRIENDS_10315)){echo $empty;}else{foreach ($_FRIENDS_10315 as $key => $jike_user) { echo ($jike_user["username"]); }} ?>
</body>
</html>