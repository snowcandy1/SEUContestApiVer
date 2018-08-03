<?php
header('Content-type: text/plain');
error_reporting(0);
$dbh = new PDO('sqlite:question.db');
$array = array();
for ($i = 0; $i < 100; $i++) {
	$sql = "select * from `q1`";
	$res = $dbh->query($sql)->fetchAll(PDO::FETCH_ASSOC);
	$c = @count($res);
	$id = mt_rand(0,$c - 1);
	$q = $res[$id];
	array_push($array, array(
		'question' => '('.$q['id'].')'.$q['question'], 
		'category' => 1, 
		'options' => array(
			$q['c1'], $q['c2'], $q['c3'], $q['c4'], $q['c5'] 
		)
	));
}
echo json_encode($array, 384);