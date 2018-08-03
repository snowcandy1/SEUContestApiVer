<?php
require 'TokenAuth.php';
if (isset($_GET['major']))
	$major = substr($_GET['major'], 0, 8);
else
	$major = null;
// create view `seeStures` as select `sturesult`.*, `userinfo`.`stunum`, `userinfo`.`stuname`, `userinfo`.`dep`, `userinfo`.`major` from `sturesult` left join `userinfo` on `sturesult`.uid = `userinfo`.`uid`
if ($res['login']['flag'] <= 0) {
	$res['code'] = 1000;
	$res['resp'] = 'Access denied. ';
} else {
	$sql = 'SELECT * FROM `seestures` WHERE `stunum` LIKE '.$dbh->quote($major.'%').' ORDER BY `stunum` ASC';
	$resp = SQLquery($sql);
	$res['resp'] = $resp;
}
echo json_encode($res, 384);