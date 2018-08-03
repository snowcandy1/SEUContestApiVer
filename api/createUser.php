<?php
require 'TokenAuth.php';
$uname = $_GET['uname'];
$passwd = getpasswd($_GET['pass']);
$auth = $_GET['auth'];
$rsp = SQLquery('select * from `users` where username = '.$dbh->quote($uname));
if (isset($rsp[0])) {
	$res['code'] = 20;
	$res['resp'] = 'This user name already exists. ';
} elseif ($auth > $res['login']['flag']) {
	$res['code'] = 1000;
	$res['resp'] = 'Access denied. ';
} else {
	$rsp = SQLquery('insert into `users` values (null, '.$dbh->quote($uname).', '.$dbh->quote($passwd).', '.$dbh->quote($auth).')');
	$res['resp'] = 'Success! Username: '.$uname.' & Password: '.$passwd;
}
echo json_encode($res);