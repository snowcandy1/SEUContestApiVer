<?php
require 'TokenAuth.php';
if (!isset($_COOKIE['myAnswer'])) $res['resp'] = '保存失败';
else {
	$query = 'UPDATE `stu_answer_save` SET `ans_json`='.$dbh->quote($_COOKIE['myAnswer']).' WHERE `uid` = 1 and `testid` = 2';
	SQLquery($query);
	$res['resp'] = '答案保存成功@';
}echo json_encode($res);