<?php
require 'TokenAuth.php';
$newpass = getpasswd(trim($_POST['newpass']));
$rsp = SQLquery("UPDATE `users` SET `passwd` = '$newpass' WHERE `users`.`uid` = $loginUID;");
$res['resp'] = 'Password changed.';
echo json_encode($res);