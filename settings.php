<?php
$title = 'Settings';
$csslist = array('main.css');
include 'header.php';
// echo '<script>alert("'.$_SESSION['seuToken'].'");</script>';
?>

<script src="/static/js/cookie.js" type="text/javascript"></script>
<script src="/static/js/settings.js" type="text/javascript"></script>

<div class="mainform">
	<div class="formq">
		<h4>修改密码：</h4>
			<p>输入密码：<input type="password" id="newpass" name="newpass" placeholder="Password"></p>
			<p>确认密码：<input type="password" id="newpass2" name="newpass2" placeholder="Password"></p>
			<button class="ui orange button" onclick="changePswd()">修改</button><span id="passchange">...</span>
	<?php if ($Loginfo['flag'] > FLAG_STU) {?>
	
		<h4>添加账号：</h4>
		<p>单个添加：</p>
		<p>
			UserName: <input class="text" id="uname" name="uname" placeholder="UserName" onkeydown="if(event.keyCode==13) createUserOne(document.getElementById('uname').value, document.getElementById('pswd').value, document.getElementById('authone').value);">
		</p>
		<p>
			Password: <input type="password" id="pswd" name="pswd" placeholder="Password" onkeydown="if(event.keyCode==13) createUserOne(document.getElementById('uname').value, document.getElementById('pswd').value, document.getElementById('authone').value);">
		</p>
		<select id="authone" name="authone">
			<?php if ($Loginfo['flag'] > FLAG_STU) {?><option value ="<?=FLAG_STU?>">Student</option> <?php } ?>
			<?php if ($Loginfo['flag'] > FLAG_ASI) {?><option value ="<?=FLAG_ASI?>">Assistant</option> <?php } ?>
			<?php if ($Loginfo['flag'] > FLAG_TEA) {?><option value ="<?=FLAG_TEA?>">Teacher</option> <?php } ?>
			<?php if ($Loginfo['flag'] > FLAG_ADM) {?><option value ="<?=FLAG_ADM?>">Administrator</option> <?php } ?>
		</select>
		<button class="ui blue button" onclick="createUserOne(document.getElementById('uname').value, document.getElementById('pswd').value, document.getElementById('authone').value)">添加</button> <span id="addoneresult"></span>
		<p>批量添加：(格式如下，一行一个)</p>
		<p>
			<textarea id="t1" rows="5" cols="70">username:password:auth(学生可以不用:auth)</textarea>
		</p>
		<p>
			文件添加：<input type="file" id="uploaders" onchange="jsReadFiles(this.files)"/>
			<button class="ui orange button" onclick="createUsers()">添加</button>
		</p>
		<p id="manyres"></p>
		
	
	<?php } ?></div>
</div>
<div class="problist">
	<div style="height: 100%;overflow-y: scroll;-ms-overflow-style: -ms-autohiding-scrollbar;-webkit-overflow-scrolling: touch;">
		<p><a href="/settings">基础设置</a></p>
	</div>
</div>