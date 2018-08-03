function createUserOne(un, pw, au) {
	$.getJSON("/api/createUser.php?seuToken=" + getCookie('seuToken') + "&uname=" + un + "&pass=" + pw + "&auth=" + au, function(json){
	  $("#addoneresult").html(json.resp);
	  if (json.code == 0) {
		  $("#addoneresult").css('text-shadow', '0px 0px 2px #666');
	  } else {
		  $("#addoneresult").css('text-shadow', '0px 0px 2px #600');
	  }
	});
}

function jsReadFiles(files) {
        if (files.length) {
            var file = files[0];
            var reader = new FileReader(); //new一个FileReader实例
            if (/text+/.test(file.type)) { //判断文件类型，是不是text类型
                reader.onload = function() {
                    $('#t1').val(this.result);
					// alert(this.result);
                }
                reader.readAsText(file);
            } 
        }
    }
	
	
function createUsers() {
	// alert($('#t1').val());
	$.post("/api/createManyUsers.php?seuToken=" + getCookie('seuToken'), { "ur": $('#t1').val() },
	   function(data){
		$('#manyres').html(data.resp);
		if (data.code == 0) {
		  $("#manyres").css('text-shadow', '0px 0px 2px #666');
		  } else {
			  $("#manyres").css('text-shadow', '0px 0px 2px #600');
		  }
	   },"json");
	
}

function changePswd() {
	var newpass = document.getElementById('newpass').value;
	var newpass2 = document.getElementById('newpass2').value;
	if (newpass != newpass2) {
		alert("两次密码输入不相同，请重新输入");
		document.getElementById('newpass').value = '';
		document.getElementById('newpass2').value = '';
	} else {
		$.post("/api/chgangePassword.php?seuToken=" + getCookie('seuToken'), { "newpass": newpass },
		   function(data){
			$('#passchange').html(data.resp);
			alert(data.resp);
			if (data.code == 0) {
			  $("#passchange").css('text-shadow', '0px 0px 2px #666');
			  } else {
				  $("#passchange").css('text-shadow', '0px 0px 2px #600');
			  }
		   },"json");
	}
}