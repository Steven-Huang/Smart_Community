<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>
</head>
<body>
	<form method="post" action="http://localhost/smart_community/index.php/Admin/users/do_add">
	user_icon_url:<input name='user_icon_url' type="text" /><br>
	Nick Name:<input name='user_nick_name' type="text" /><br>
	True Name:<input name='user_true_name' type="text" /><br>
	PassWord:<input name='user_password' type="password" /><br>
	PassWord confirmed:<input name='user_password_confirmed' type="password" /><br>
	Gender:<input name='user_gender' type="radio" value="1"/>
	<input name='user_gender' type="radio" value="2"/><br>
	POCN:<input name='user_pocn' type="text" /><br>
	Mobile:<input name='user_mobile' type="text" /><br>
	Email:<input name='user_email' type="text" /><br>
	ID Card:<input name='user_id_card_num' type="text" /><br>

	
	
	
	
	

		<input type="submit" />
	</form>
</body>
</html>