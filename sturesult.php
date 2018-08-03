<?php
$title = 'StudentResult';
$csslist = array('main.css');
include 'header.php';
if ($Loginfo['flag'] <= FLAG_STU) {
	exit('你无权查看本页面。');
}
?>

<script src="/static/js/cookie.js" type="text/javascript"></script>
<script src="/static/js/searchResult.js" type="text/javascript"></script>

<div class="mainform">
	<div class="formq">
		<h4>学生成绩：</h4>
		<table>
		<tr>
		<td>选择院系：</td>
		<td><select id="depname" name="depname">
			<option value="01">[100172]建筑学院</option>
			<option value="02">[100180]机械工程学院</option>
			<option value="03">[100193]能源与环境学院</option>
			<option value="04">[100202]信息科学与工程学院</option>
			<option value="05">[100215]土木工程学院</option>
			<option value="06">[100225]电子科学与工程学院</option>
			<option value="07">[100234]数学系</option>
			<option value="07">[100234]数学学院</option>
			<option value="08">[100242]自动化学院</option>
			<option value="09">[100247]计算机科学与工程学院</option>
			<option value="10">[100259]物理系</option>
			<option value="10">[100259]物理学院</option>
			<option value="11">[100265]生物科学与医学工程学院</option>
			<option value="12">[100272]材料科学与工程学院</option>
			<option value="13">[100278]人文学院</option>
			<option value="14">[100285]经济管理学院</option>
			<option value="16">[100295]电气工程学院</option>
			<option value="17">[100304]外国语学院</option>
			<option value="19">[100314]化学化工学院</option>
			<option value="21">[100319]交通学院</option>
			<option value="22">[100331]仪器科学与工程学院</option>
			<option value="24">[100337]艺术学院</option>
			<option value="25">[100342]法学院</option>
			<option value="26">[100157]学习科学研究中心</option>
			<option value="41">[100351]医学院(生物工程)</option>
			<option value="42">[100365]公共卫生学院</option>
			<option value="43">[100372]医学院(临床医学)</option>
			<option value="57">[100247]网络空间安全学院</option>
			<option value="61">[100381]吴健雄学院</option>
			<option value="71">[100383]软件学院</option>
		</select></td>
		<td><button class="ui green button" onclick="getResult(document.getElementById('depname').value)">查询</button></td>
		</tr><tr>
		<td>查询学号：</td>
		<td><input type="text" id="stunum" name="stunum" placeholder="StuNumber"></td>
		<td><button class="ui black button" onclick="getResult(document.getElementById('stunum').value)">查询</button></td>
		</tr>
		</p>
	</div>
</div>