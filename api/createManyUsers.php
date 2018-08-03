<?php
require 'TokenAuth.php';
error_reporting(0);
// if (isset($_POST['ur'])) echo $_POST['ur']; else echo '???';
$posts = str_replace("\r\n", "\n", $_POST['ur']);
$posts = explode("\n", $posts);
$res['resp'] = null;
$res['fail'] = [];
$sss = null;
$Scnt = 0;
foreach ($posts as $cnt => $c) {
	$c = explode(':', $c);
	if (!isset($c[1])) continue;
	$uname = $c[0];
	$passwd = getpasswd($c[1]);
	$auth = isset($c[2]) ? $c[2] : 0;
	$rsp = SQLquery('select * from `users` where username = '.$dbh->quote($uname));
	if (isset($rsp[0])) {
		$res['code'] = 20;
		$res['resp'] .= "Failed to create user '".$uname."' --- username already exists.<br>";
		$res['fail'][] = $cnt;
	} elseif ($auth > $res['login']['flag']) {
		$res['code'] = 1000;
		$res['resp'] .= "Failed to create user '".$uname."' --- access denied.<br>";
		$res['fail'][] = $cnt;
	} else {
		if ($sss != null) $sss .= ',';
		$sss .= '(null, '.$dbh->quote($uname).', '.$dbh->quote($passwd).', '.$dbh->quote($auth).')';
		$Scnt++;
	}
}
if ($sss) $res = SQLquery('insert into `users` values '.$sss);
$res['resp'] .= $Scnt.' users created.';
echo json_encode($res);