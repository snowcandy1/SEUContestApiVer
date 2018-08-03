<?php
include 'function.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$url = $hostname.'api/userLogin.php';
	$post = array('account' => $_POST['logname'], 'password' => getpasswd($_POST['logpass']));
	$req = sendRequest($url, $post);
	$res = json_decode($req, 1);
	// echo $url.'<br>'.$req; exit;
	if ($res['code'] == 0) {
		setck('seuToken', $res['token']);
		if ($res['auth'] != 0) 
			$goto = 'settings';
		else
			$goto = 'quiz';
		header('Location: '.$goto.'.php');
	} elseif ($res['code'] == 450) {
		echo '<script>alert("Wrong Password.");</script>';
	} else {
		echo '<script>alert("您的账号因短时间多次错误登录，已被锁定，即将进入申诉界面……");</script>';
	}
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<link rel="stylesheet" href="/static/css/login.css">
</head>
<body>

<script src="/static/js/jquery-1.7.2.min.js" type="text/javascript"></script>

<div class="xwbox">
	<h3>Login</h3>
	<form action="#" id="log1n" name="f" method="post">
		<div class="input_outer">
			<span class="u_user"></span>
			<input name="logname" class="text" onFocus=" if(this.value=='User') this.value=''" onBlur="if(this.value=='') this.value='User'" value="User" style="color: #FFFFFF !important" type="text">
		</div>
		<div class="input_outer">
			<span class="us_uer"></span>
			<label class="l-login login_password" style="color: rgb(255, 255, 255);display: block;">Password</label>
			<input name="logpass" class="text" style="color: #FFFFFF !important; position:absolute; z-index:100;" onFocus="$('.login_password').hide()" onBlur="if(this.value=='') $('.login_password').show()" value="" type="password">
		</div>
		<div class="mb2"><a class="act-but submit" href="#" onclick="document.getElementById('log1n').submit()" style="color: #FFFFFF">登录</a></div>
		<!--<input name="savesid" value="0" id="check-box" class="checkbox" type="checkbox"><span>记住用户名</span>-->
	</form>
	<div class="sas">
		<a href="#" onclick="alert('注册界面')">注册</a>
	</div>
	
</div>

</body>
</html>