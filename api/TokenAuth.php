<?php
include '../function.php';
$dbName = 'seucontest';
require '../opensql.php';
header('Content-type: text/plain');
$myToken = isset($_GET['seuToken']) ? $_GET['seuToken'] : '0';
$sql = 'select * from `token` where `token` = '.$dbh->quote($myToken).' and `expire_time` >= '.time();
$res = SQLquery($sql);
if (isset($res[0]['uid'])) {
	$loginUID = $res[0]['uid'];
	$sql = 'select * from `users` where `uid` = '.$loginUID;
	$res = array(
				'code' => 0, 
				'login' => SQLquery($sql)[0]
				);
	unset($res['login']['passwd']);
} else {
	$res = array('code' => 20000);
	exit(json_encode($res));
}

define('FLAG_STU', 0); // 学生权限
define('FLAG_ASI', 10); // 辅导员权限
define('FLAG_TEA', 20); // 教师权限
define('FLAG_ADM', 30); // 管理权限
define('FLAG_MAX', 100); // 后台权限