<?php
$title = 'Quiz';
$csslist = array('main.css');
include 'header.php';
$testID = $_GET['testID'];
$resp = SQLquery('SELECT * FROM `tests` where id = '.$testID);
if (!(isset($resp[0]) && $resp[0]['time_start'] < time() && $resp[0]['time_end'] > time()))
	exit('试卷生成失败，考试不存在或无权访问。');
$req = sendRequest($hostname.'api/getQuestion.php?seuToken='.$myToken, array('testID' => $testID));
// exit($req);
$questions = json_decode($req, 1);
// print_r($questions);
// exit;
$cnt = count($questions);
$anses = [];
if (isset($_COOKIE['myAnswer'])) 
	$anses = json_decode(urldecode($_COOKIE['myAnswer']), 1);
else {
	$query = SQLquery('select * from `stu_answer_save` where uid = '.$loginUID.' and testid = '.$testID);
	if (isset($query[0]['ans_json'])) $anses = json_decode($query[0]['ans_json'], 1);
}
if (!is_array($anses)) $anses = [];
?>
<script>
	var answer = [1007<?php for ($i = 1; $i <= $cnt; $i++) echo ','.((isset($anses[$i])?$anses[$i]:0)); ?>];
</script>
<script src="/static/js/cookie.js" type="text/javascript"></script>
<script src="/static/js/quiz.js" type="text/javascript"></script>
<div class="mainform">
	<div class="formq">
		<?php 
		 $i = 0; 
		foreach ($questions as $Q) { $i++; ?>
		<p id="subform<?=$i?>">
			<a id="q<?=$i?>"></a>
			<p id="question<?=$i?>">问题<?=$i?>. <?=$Q['question']?></p>
			<table id="subTable<?=$i?>" style="border:0;">
				<?php $num = 0; 
				if (!isset($Q['options'])) $Q['options'] = ['√', '×'];
				foreach ($Q['options'] as $C) {
					$num++; if ($num % 2 == 1) echo '<tr>';
					?>
					<td id="ans_<?=$i?>_<?=$num?>" onclick="setAnswer(<?=$i?>,<?=$num?>);" style="padding: 0px 22px 0px 0px"><?=chr(ord('A') - 1 + $num)?>.<?=$C?></td>
				<?php if ($num % 2 == 0) echo '</tr>'; } ?>
			</table>
		</p>
		<?php } ?>
	</div>
	<div class="buttons">
		<button onclick="saveAns()" class="ui blue button">保存</button>
		<button onclick="confirmClear()" class="ui blue button">清空</button>
		<button onclick="postAnswer(<?=$testID?>)" class="ui orange button">提交</button>
	</div>
</div>

<div class="problist">
	<div style="height: 100%;overflow-y: scroll;-ms-overflow-style: -ms-autohiding-scrollbar;-webkit-overflow-scrolling: touch;">
	<?php for ($i = 1; $i <= $cnt; $i++) { ?>
		<p><a id="href<?=$i?>" href="#q<?=$i?>">Question. <?=$i?></a></p>
	<?php } ?>
	</div>
</div>

</body>
</html>