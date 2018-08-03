<?php
if ($_SERVER['REQUEST_METHOD'] != 'POST') exit('[]');
header('Content-type: text/plain');
require '../function.php';
$dbName = 'seucontest';
require '../opensql.php';
$acc = $_POST['account'];
// $acc = 'admin';
$psw = $_POST['password'];
// $psw = '74f1efc9ae486db149d0ddcb47b35f68';
$sql = 'select * from `users` where username = '.$dbh->quote($acc).' and passwd = '.$dbh->quote($psw);
$res = $dbh->query($sql)->fetchAll(PDO::FETCH_ASSOC);
if (!isset($res[0])) {
	$resp = array('code' => 450, 'message' => "Wrong Password.");
} else {
	$uid = $res[0]['uid'];
	$token = tokenGet();
	$IP = $_SERVER['REMOTE_ADDR'];
	$auth = $res[0]['flag'];
	$sql = 'replace into `token` values ('.$uid.', '.$dbh->quote($token).', '.(time() + 7200).', '.$dbh->quote($IP).')';
	$res = $dbh->query($sql); 
	$resp = array('code' => 0, 'message' => "Succeed", 'token' => $token, 'auth' => intval($auth));
}
echo json_encode($resp);