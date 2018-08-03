<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<link rel="stylesheet" href="/static/css/login.css">
</head>
<script src="/static/js/jquery-1.7.2.min.js" type="text/javascript"></script>
<body>

<div class="xwbox">
	<h1>东南大学校史知识竞赛</h1>
	<div class="mb2"><a class="act-but submit" href="/login.php" style="color: #FFFFFF">进入</a></div>
		
</div>

</body>
</html>

<script>
function a() {
	var x = Math.floor(Math.random() * 17);
	$(top.document.body).css("background", "url('/static/img/seu/" + x + ".jpg') fixed center center");
	return x;
}
setInterval("a()", 5000);
</script>