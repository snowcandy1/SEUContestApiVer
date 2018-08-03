$(document).ready(function() {
	var scookie = getCookie('myAnswer');
	if (scookie != 0) {
		var anss = JSON.parse(scookie);
	} else 
		var anss = answer;
	anss.forEach(function(elem, s) {
			$("#ans_" + s + "_" + elem).css("text-shadow", "0px 0px 2px #00f");
		})
});

function countAnswer() {
	var cnt = 0;
	answer.forEach(function(elem, s) {
			if (elem == 0) cnt++; 
		})
	return cnt;
}

function setAnswer(q, a) {
	$("#ans_" + q + "_" + a).css("text-shadow", "0px 0px 2px #00f");
	$("#href" + q).css("text-shadow", "0px 0px 2px #00f");
	$("#ans_" + q + "_" + answer[q]).css("text-shadow", "0px 0px 2px #666");
	answer[q] = a;
	setCookie('myAnswer', JSON.stringify(answer));
}

function confirmClear(){
	var con = confirm('是否清空答题数据？');
	if (con) { setCookie('myAnswer', ''); location.reload(); }
}

function saveAns() {
	$.getJSON("/api/saveAnswer.php?seuToken=" + getCookie('seuToken'), function(json){
		alert(json.resp);
	});
}

function post(URL, PARAMS) { 
      var temp = document.createElement("form"); 
      temp.action = URL; 
      temp.method = "post"; 
      temp.style.display = "none"; 
      for (var x in PARAMS) { 
        var opt = document.createElement("textarea"); 
        opt.name = x; 
        opt.value = PARAMS[x]; // alert(opt.name) 
        temp.appendChild(opt); 
        } 
      document.body.appendChild(temp); 
      temp.submit(); return temp; 
    }

function postAnswer(tid) {
	var con = confirm('确认要提交吗？你还有' + countAnswer() + '题未完成。');
	if (con) { 
		post("/ansresult.php", {"tid":tid, "ans":JSON.stringify(answer)});
	}
}

