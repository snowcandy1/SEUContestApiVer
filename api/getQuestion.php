<?php
require 'TokenAuth.php';

function gen_rng($n, $k) {
	$rng = range(0, $n - 1);
	shuffle($rng);
	$rng = array_slice($rng, 0, $k);
	return $rng;
}

$ff = false;
$testID = $_POST['testID'];
$sel = SQLquery('select * from `stu_answer_save` where `uid` = '.$loginUID.' and `testid` = '.$testID);
$questions = SQLquery('select `id`, `title`, `options`, `category` from `problems` where `testid` = '.$testID.' order by `id` asc');
if (!isset($sel[0]['prob_json'])) {
	$tst = gen_rng(count($questions), 50);
	$ff = true;
} else {
	$tst = json_decode($sel[0]['prob_json'], 1);
}
$res = [];
$resid = [];
foreach ($tst as $k) {
	$ii = $questions[$k];
	$resid[] = $k;
	$res[] = array(
			'question' => '('.$ii['id'].')'.$ii['title'], 
			'category' => $ii['category'],
			'options' => @json_decode($ii['options'], 1)
	);
}

if ($ff == true) SQLquery('insert into `stu_answer_save` values ('.$loginUID.', '.$testID.', '.$dbh->quote(json_encode($resid)).', "")');
echo json_encode($res, 384);