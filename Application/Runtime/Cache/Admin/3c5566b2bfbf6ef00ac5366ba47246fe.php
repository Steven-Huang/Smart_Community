<?php if (!defined('THINK_PATH')) exit();?>login
<form method="post" action="checklogin">
	<select name="role">
		<option value="users">业主</option>
		<option value="mgrs">物业</option>
		<option value="admin">管理员</option>
	</select>
	True Name:<input name='username' type="text" /><br>
	PassWord:<input name='password' type="password" /><br>
<input type="checkbox" name="remember" />
<input type="submit" />
</form>