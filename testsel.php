<?php
$title = 'Tests';
$csslist = array('main.css', 'table.css');
include 'header.php';
?>

<div class="mainform">
	<div class="formq">
		<table class="table table-condensed">
		<tr>
			<td>ID</td>
			<td>Name</td>
			<td>Start Time</td>
			<td>End Time</td>
			<td>Status</td>
			<td></td>
		</tr>
		<?php
		$resp = SQLquery('SELECT * FROM `tests` order by id desc');
		$nowtime = time();
		foreach ($resp as $arr) {
			if ($nowtime < $arr['time_start']) 
				$status = 'style="color:#aaa;font-weight:555">Unavailable';
			elseif ($nowtime < $arr['time_end'])
				$status = 'style="color:#0a0;font-weight:555">Public';
			else
				$status = 'style="color:#f00;font-weight:555">Ended';
			?>
			<tr>
				<td><?=$arr['id']?></td>
				<td><a href="/quiz.php?testID=<?=$arr['id']?>"><?=$arr['name']?></a></td>
				<td><?=date('Y-m-d H:i:s', $arr['time_start'])?></td>
				<td><?=date('Y-m-d H:i:s', $arr['time_end'])?></td>
				<td <?=$status?></td>
			</tr>
			<?php
		}
		?>
		</table>
	</div>
	
</div>