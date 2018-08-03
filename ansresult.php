<?php
/**
  非Mysql情况下本页面需重新替换
**/
$title = 'StudentResult';
$csslist = array('main.css');
include 'header.php';
$ans = json_decode($_POST['ans'], 1);
array_shift($ans);
$tid = intval($_POST['tid']);
$resp = SQLquery('SELECT * FROM `sturesult` WHERE `uid` = '.$loginUID.' AND `testid` = '.$tid);
if (isset($resp[0])) {
	echo '<script>alert("重复提交，成绩将不计.");</script>';
	$rep = true;
	// exit();
} else
	$rep = false;
$resp = SQLquery('SELECT * FROM `stu_answer_save` WHERE `uid` = '.$loginUID.' AND `testid` = '.$tid);
if (!isset($resp[0])) {
	echo '未作答试卷，将跳转回原页面。';
	header('Refresh: 3; url=/quiz.php?testID='.$tid);
	exit();
} else 
	$resp = $resp[0];
$problems = json_decode($resp['prob_json'], 1);
$comma = false;
$problemID = null;
foreach ($problems as $prob) {
	if ($comma == false) $comma = true; else $problemID .= ', ';
	$problemID .= $prob;
}
$sql = 'SELECT * FROM `problems` where id in ('.$problemID.') order by field(id, '.$problemID.')';
$resp = SQLquery($sql);
$score = 0;
$WA = [];
foreach ($resp as $id => $rsp) {
	$rsp_answer = json_decode($rsp['answer'], 1);
	if (in_array($ans[$id] - 1, $rsp_answer))
		$score++;
	else
		$WA[] = $id;
}
if ($rep != true) $reSp = SQLquery('insert into `sturesult` values(null, '.$loginUID.', '.$tid.', '.$score.', '.time().')');
$reSp = SQLquery('delete from `stu_answer_save` WHERE `uid` = '.$loginUID.' AND `testid` = '.$tid);
?>
<div class="mainform">
	<div class="formq">
		<h1>提交成功！</h1>
		<h2>您的得分为：<?=$score?></h2>
		<h3>下面是你做错的题目：</h3>
		<?php foreach($WA as $id) {
			?>
			<p id="subform<?=$id?>">
			<p id="question<?=$id?>">问题<?=$id + 1?>. <?=$resp[$id]['title']?></p>
			<?php $TrueAns = json_decode($resp[$id]['answer'], 1);
			$Options = json_decode($resp[$id]['options'], 1);
			$TA = null;
				foreach($TrueAns as $S) {
					$TA .= '<br>'.chr(ord('A') + $S).'.'.$Options[$S];
				}?>
			<p>答案：<?=$TA?></p>
			<p style="text-shadow:0px 0px 2px #f00">
				你的答案：<?=($ans[$id] > 0) ? ($Options[$ans[$id] - 1]) : '...'?>
			</p>
		</p>
			<?php
		}?>
	</div>
</div>