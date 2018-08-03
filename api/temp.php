<?php
function getans($str) {
	$u = str_split($str);
	$r = [];
	foreach($u as $v) {
		switch ($v) {
			case 'A': $A = 0; break;
			case 'B': $A = 1; break;
			case 'C': $A = 2; break;
			case 'D': $A = 3; break;
			case 'E': $A = 4; break;
			default : $A = -1; break;
		}
		if ($A >= 0) $r[] = $A;
	}
	return json_encode($r);
}
$dbh = new PDO('sqlite:question.db');
$sql = "select * from `q1`";
$sss = 'insert into `problems` values ';
$res = $dbh->query($sql)->fetchAll(PDO::FETCH_ASSOC);
$comma = '';
foreach ($res as $r) {
	$opt = [$r['c1'], $r['c2'], $r['c3'], $r['c4'], $r['c5']]; 
	$ans = getans($r['ans']);
	if (strlen($ans) > 3) $ctg = 2; else $ctg = 1;
	$sss .= $comma.'(null, 2, '.$dbh->quote($r['question']).', '.$dbh->quote(json_encode($opt, 256)).', '.$ctg.', '.$dbh->quote($ans).")\r\n";
	$comma = ',';
}

file_put_contents('.sql', $sss.';');